<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model([
            'UsersModel' => 'M_user',
            'MenuModel' => 'M_menu',
            'PdfModel' => 'M_pdf',
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
        $idlevel = $this->session->userdata('idlevel');
        $data = [
            'title' => 'Application',
            'station' => $this->M_menu->get_stations($idlevel),
            'breadcrumb' => $this->M_menu->breadcrumb($this->menu),
            'idlevel' => $idlevel,
            'menu' => $this->menu,
            'iduser' => $this->iduser,
            'idlevel' => $this->idlevel,
            'akses' => $this->akses
        ];

        $this->load->view('template/header', $data);
        $this->load->view('pdf/index', $data);
        $this->load->view('template/footer', $data);
    }
    public function table()
    {
        $requestData = $_REQUEST;
        $search = $requestData['search']['value'];
        $id             = $_POST['id'];
        if ($id == 'users') {
            $columns        = array('id', 'nama_lengkap', 'username', 'email', 'aktif', 'level', 'jalan', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'id');
            $order            = $columns[$requestData['order'][0]['column']];
            $dir            = $requestData['order'][0]['dir'];
            $start            = NULL;
            $length            = NULL;

            $query             = $this->M_user->table($id, $search, $order, $dir, $start, $length);
            $totalData         = count($query);
            $totalFiltered     = $totalData;

            $start            = $requestData['start'];
            $length            = $requestData['length'];

            $query             = $this->M_user->table($id, $search, $order, $dir, $start, $length);

            $data = array();
            $no = 1 + $start;

            foreach ($query as $row) {
                $nestedData   = array();
                $nestedData[] = $no++;
                $nestedData[] = $row['nama_lengkap'];
                $nestedData[] = $row['username'];
                $nestedData[] = $row['email'];
                $nestedData[] = $row['aktif'];
                $nestedData[] = $row['level'];
                $nestedData[] = $row['jalan'];
                $nestedData[] = $row['kelurahan'];
                $nestedData[] = $row['kecamatan'];
                $nestedData[] = $row['kota'];
                $nestedData[] = $row['provinsi'];
                $nestedData[] = "
                <a href=\"#\" onclick=\"download_pdf(" . $row['id'] . ")\" class=\"btn btn-info btn-flat btn-social btn-sm\"><i class=\"bi bi-download\"></i></a> 
                <a href=\"#\" onclick=\"DeleteUser(" . $row['id'] . ")\" class=\"btn btn-danger btn-flat btn-social btn-sm\"><i class=\"bi bi-trash\"></i></a> 
                ";
                $data[] = $nestedData;
            }
            $output_data = array(
                "draw"            => intval($requestData['draw']),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );
        }
        echo json_encode($output_data);
    }
    public function dn_qr_pdf()
    {
        include("./application/libraries/html2pdf/_tcpdf_5.9.206/tcpdf.php");

        $data = $this->M_pdf->download_pdf();
        // $custom_layout = array(100, 100);
        // $pdf = new TCPDF('L', PDF_UNIT, $custom_layout, true, 'UTF-8', false, false);
        $pdf = new TCPDF('P', PDF_UNIT, '', true, 'UTF-8', false, false);
        $pdf->SetMargins(3, 3, 3);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetFont('helvetica', '', 11);
        $style = array(
            'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        foreach ($data as $data) {
            $pdf->AddPage();
            $pdf->write2DBarcode($data['username'], 'QRCODE,H', '', '8', 50, 50, $style, 'R');
            $pdf->Text('16', '2', 'QRCODE H');
            $pdf->lastPage();
        }
        $pdf->Output('QR-Code - ' . date('Ymd') . '.pdf', 'D');
    }
    public function dn_pdf()
    {
        include("./application/libraries/html2pdf/_tcpdf_5.9.206/tcpdf.php");

        $data = $this->M_pdf->download_pdf();
        $custom_layout = array(60, 90);
        $pdf = new TCPDF('L', PDF_UNIT, $custom_layout, true, 'UTF-8', false, false);
        $pdf->SetMargins(3, 3, 3);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        // add a page
        $pdf->SetFont('times', '', 7.9);
        // define barcode style

        foreach ($data as $data) {
            $params = $pdf->serializeTCPDFtagParameters(array($data['username'], 'C128', '', '', 35, 10, 0.3, array('position' => 'C', 'border' => false, 'padding' => 0, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
            $pdf->AddPage();
            $html = '
			<table border="0">
			<tr style"margin:0px;padding:0px;">
				<th align="center" colspan="2"><tcpdf method="write1DBarcode" params="' . $params . '" /></th>
			</tr>
			';
            $html .=  '
			</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->lastPage();
            // echo $html;
        }
        // die;
        $pdf->Output('Label Box - ' . date('YmdHis') . '.pdf', 'D');
    }
}
