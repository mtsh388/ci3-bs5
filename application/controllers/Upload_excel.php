<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_excel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model([
            'UsersModel' => 'M_user',
            'MenuModel' => 'M_menu',
            'LevelModel' => 'M_level',
            'Upload_excelModel' => 'M_U_Excel'
        ]);
        $this->menu = $this->uri->segment(1);
        $this->iduser = $this->session->userdata('iduser');
        $this->idlevel = $this->session->userdata('idlevel');
        $this->akses = $this->M_menu->akses($this->menu, $this->idlevel);
        if ($this->session->userdata('iduser') == null) {
            redirect(base_url());
        }
    }
    public function index()
    {
        $data = [
            'title' => 'Upload Excel',
            'breadcrumb' => $this->M_menu->breadcrumb($this->menu),
            'station' => $this->M_menu->get_stations($this->idlevel),
            'user' => $this->M_user->getWhere($this->iduser),
            'idlevel' => $this->idlevel,
            'menu' => $this->menu,
            'akses' => $this->M_menu->akses($this->menu, $this->idlevel),
            'data_detail' => $this->M_U_Excel->get_detail()
        ];
        $this->load->view('template/header', $data);
        $this->load->view('Upload_excel/index', $data);
        $this->load->view('template/footer', $data);
    }
    public function add()
    {
        include('./application/libraries/tcpdf/PHPExcel/IOFactory.php');
        include('./application/libraries/PHPExcel/simplexlsx.class.php');
        $trans = $_POST['trans'];
        if ($trans == '') {
            $trans = $this->M_U_Excel->lastid();
        } else {
            $trans = $_POST['trans'];
            $this->M_U_Excel->delete_temp($trans);
        }
        $file_size        = $_FILES['fileupload']["size"];
        $file_name        = $_FILES['fileupload']["name"];
        $file_temp        = $_FILES['fileupload']["tmp_name"];
        $file_type        = $_FILES['fileupload']["type"];
        $ext              = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $alias            = date("YmdHis") . "- Coba"  . "." . $ext;
        $file_path        = "assets/temp/files/" . $alias;
        $header = "A|B|C|D";

        $maximun_size      = 1024 * (1024 * 5); //5MB
        if ($ext != "xlsx" or $file_type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
            $result['msg'] = "Wrong Extention. Check File!";
            $result['kirim'] = 1;
        } else {
            if ($file_size > $maximun_size) {
                $result['msg'] = "File to Big. Max 5 MB";
                $result['kirim'] = 1;
            } else {
                if (!move_uploaded_file($file_temp, $file_path)) {
                    $result['msg'] = "Failed Check File. Try again!";
                    $result['kirim'] = 1;
                } else {
                    $inputFileType     = PHPExcel_IOFactory::identify($file_path);
                    $objReader         = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel     = $objReader->load($file_path);
                    $sheet             = $objPHPExcel->getSheet(0);
                    $highestRow     = $sheet->getHighestRow();
                    $highestColumn     = $sheet->getHighestColumn();
                    if ($highestRow < 2) {

                        $result['msg'] = "File Empty";
                    } else {
                        $rowData     = $sheet->rangeToArray('A' . 1 . ':' . $highestColumn . 1, NULL, FALSE, TRUE);
                        $header_field = implode("|", $rowData[0]);

                        if (substr($header_field, -1) == '|') {
                            $count = strlen($header_field);
                            $min = $count - 1;
                            // $headerF = substr($header_field, 0, $min);
                            $headerF = str_replace(array(" |", "| "), "|", $header_field);
                        } else {
                            $headerF = $header_field;
                        }
                        // $header_field = strtoupper(rtrim(trim($header_field),'|'));
                        // $header		  = strtoupper($header);
                        if ($headerF != $header) {

                            $result['msg'] = "Wrong Header. Check File!";
                        } else {
                            for ($row = 2; $row <= $highestRow; $row++) {
                                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, TRUE);
                                $a                      = trim($rowData[0][0]);
                                $b                      = trim($rowData[0][1]);
                                $c                      = trim($rowData[0][2]);
                                $d                      = trim($rowData[0][3]);
                                $insert = $this->M_U_Excel->insertTemp($a, $b, $c, $d, $trans);
                            }
                            if ($insert) {
                                $result['msg'] = 'OK';
                                $result['trans'] = $trans;
                            } else {
                                $result['msg'] = 'Check file failed';
                            }
                        }
                    }
                    $count_notes = $this->M_U_Excel->count_notes($trans);
                    $result['kirim'] = $count_notes['ok'] - $count_notes['jml'];
                    unlink($file_path);
                }
            }
        }
        echo json_encode($result);
    }
    public function submitdetail()
    {
        $trans = $_POST['trans'];
        $submit = $this->M_U_Excel->insert_detail($trans);
        if ($submit) {
            $result['msg'] = "OK";
        } else {
            $result['msg'] = "Submited failed";
        }
        echo json_encode($result);
    }
    public function data_notes()
    {
        $requestData = $_REQUEST;
        $columns     = array('id', 'notes', 'qty');

        $trans      = $_POST['trans'];

        $order            = $columns[$requestData['order'][0]['column']];
        $dir            = $requestData['order'][0]['dir'];
        $start            = NULL;
        $length            = NULL;

        $query             = $this->M_U_Excel->serverside_temp($trans, $order, $dir, $start, $length);
        $totalData         = count($query);
        $totalFiltered     = $totalData;

        $start            = intval($requestData['start']);
        $length            = intval($requestData['length']);

        $query             = $this->M_U_Excel->serverside_temp($trans, $order, $dir, $start, $length);
        $data = array();
        $no = 1 + $start;
        foreach ($query as $row) {
            $nestedData   = array();
            $nestedData[] = $no++;
            $nestedData[] = $row['notes'];
            $nestedData[] = $row['qty'];

            $data[] = $nestedData;
        }
        // var_dump($data);
        $output_data = array(
            "draw"            => intval($requestData['draw']),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($output_data);
    }
}
