<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model([
            'UsersModel' => 'M_user',
            'MenuModel' => 'M_menu',
            'LevelModel' => 'M_level',
            'WilayahModel' => 'M_wilayah'
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
        $this->load->view('wilayah/index', $data);
        $this->load->view('template/footer', $data);
    }
    public function update()
    {
        $result['tab'] = $_POST['tab'];
        if ($result['tab'] == 'provinsi') {
            $idprovinsi = $_POST['idprovinsi'];
            $inputprovinsi = $_POST['inputprovinsi'];
            $status = $_POST['statusprovinsi'];
            $update = $this->M_wilayah->update_provinsi($idprovinsi, $inputprovinsi, $status);
            if ($update) {
                $result['msg'] = 'OK';
            } else {
                $result['msg'] = 'Updated Provinsi Failed. Plese Try Again';
            }
        } elseif ($result['tab'] == 'kota') {

            $provinsi = explode('|', $_POST['selectidprovinsi']);

            $idprovinsi = $provinsi[0];
            $idkota = $_POST['idkota'];
            $inputkota = $_POST['inputkota'];
            $status = $_POST['statuskota'];
            $update = $this->M_wilayah->update_kota($idprovinsi, $idkota, $inputkota, $status);
            if ($update) {
                $result['msg'] = 'OK';
            } else {
                $result['msg'] = 'Updated Kota Failed. Plese Try Again';
            }
        } elseif ($result['tab'] == 'kecamatan') {
            $idprovinsi = $_POST['selectidprovinsi'];
            $idkota = $_POST['selectidprovinsi'];
            $idkecamatan = $_POST['idkecamatan'];
            $inputkecamatan = $_POST['inputkecamatan'];
            $status = $_POST['statuskecamatan'];
            $update = $this->M_wilayah->update_kecamatan($idkota, $idkecamatan, $inputkecamatan, $status);
            if ($update) {
                $result['msg'] = 'OK';
            } else {
                $result['msg'] = 'Updated Kecamatan Failed. Plese Try Again';
            }
        } elseif ($result['tab'] == 'kelurahan') {

            $idkecamatan = $_POST['selectidkecamatan'];
            $idkelurahan = $_POST['idkelurahan'];
            $inputkelurahan = $_POST['inputkelurahan'];
            $status = $_POST['statuskelurahan'];
            $update = $this->M_wilayah->update_kelurahan($idkecamatan, $idkelurahan, $inputkelurahan, $status);
            if ($update) {
                $result['msg'] = 'OK';
            } else {
                $result['msg'] = 'Updated Kelurahan Failed. Plese Try Again';
            }
        }
        echo json_encode($result);
    }
    public function add()
    {
        $result['tab'] = $_POST['tab'];
        if ($result['tab'] == 'provinsi') {
            // ADD PROVINSI
            $inputprovinsi = $_POST['inputprovinsi'];
            $id = NULL;

            $insert = $this->M_wilayah->add_provinsi($inputprovinsi);
            if ($insert) {
                $result['msg'] = 'OK';
            } else {
                $result['msg'] = 'Created Provinsi Failed. Plese Try Again';
            }
        } elseif ($result['tab'] == 'kota') {
            // ADD KOTA
            $inputidprovinsi = $_POST['selectidprovinsi'];
            $inputkota = $_POST['inputkota'];
            $id = NULL;
            $insert = $this->M_wilayah->add_kota($inputidprovinsi, $inputkota);
            if ($insert) {
                $result['msg'] = 'OK';
            } else {
                $result['msg'] = 'Created Kota Failed. Plese Try Again';
            }
        } elseif ($result['tab'] == 'kecamatan') {
            //ADD KECAMATAN
            $inputidkota = $_POST['selectidkota'];
            $inputkecamatan = $_POST['inputkecamatan'];
            $id = NULL;
            $insert = $this->M_wilayah->add_kecamatan($inputidkota, $inputkecamatan);
            if ($insert) {
                $result['msg'] = 'OK';
            } else {
                $result['msg'] = 'Created Kecamatan Failed. Plese Try Again';
            }
        } elseif ($result['tab'] == 'kelurahan') {
            //ADD KELURAHAN
            $inputidkecamatan = $_POST['selectidkecamatan'];
            $inputkelurahan = $_POST['inputkelurahan'];
            $id = NULL;

            $insert = $this->M_wilayah->add_kelurahan($inputidkecamatan, $inputkelurahan);
            if ($insert) {
                $result['msg'] = 'OK';
            } else {
                $result['msg'] = 'Created Kelurahan Failed. Plese Try Again';
            }
        }
        echo json_encode($result);
    }
    public function delete()
    {
        $result['tab'] = $_POST['tab'];
        $id =  $_POST['id'];
        $delete = $this->M_wilayah->deleted($id, $result['tab']);
        if ($delete) {
            $result['msg'] = 'OK';
        } else {
            $result['msg'] = 'Deleted Provinsi Failed. Please Try Again';
        }
        echo json_encode($result);
    }
    public function table()
    {
        $requestData = $_REQUEST;
        $search = $requestData['search']['value'];
        $id             = $_POST['id'];
        if ($id == 'provinsi') {
            $columns        = array('id', 'provinsi', 'status', 'id');
            $order            = $columns[$requestData['order'][0]['column']];
            $dir            = $requestData['order'][0]['dir'];
            $start            = NULL;
            $length            = NULL;

            $query             = $this->M_wilayah->table($id, $search, $order, $dir, $start, $length);
            $totalData         = count($query);
            $totalFiltered     = $totalData;

            $start            = $requestData['start'];
            $length            = $requestData['length'];

            $query             = $this->M_wilayah->table($id, $search, $order, $dir, $start, $length);

            $data = array();
            $no = 1 + $start;

            foreach ($query as $row) {
                if ($row['status'] == 1) {
                    $status = 'Active';
                } else {
                    $status = 'Non Active';
                }
                $nestedData   = array();
                $nestedData[] = $no++;
                $nestedData[] = $row['provinsi'];
                $nestedData[] = $status;
                $nestedData[] = "
                <a href=\"#\" onclick=\"ModalProvinsi(" . $row['id'] . ")\" class=\"btn btn-info btn-flat btn-social btn-sm\"><i class=\"bi bi-pencil-square\"></i></a> 
                <a href=\"#\" onclick=\"DeleteProvinsi(" . $row['id'] . ")\" class=\"btn btn-danger btn-flat btn-social btn-sm\"><i class=\"bi bi-trash\"></i></a> 
                ";
                $data[] = $nestedData;
            }
            $output_data = array(
                "draw"            => intval($requestData['draw']),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );
        } elseif ($id == 'kota') {
            $columns        = array('id', 'kota', 'status', 'id');
            $order            = $columns[$requestData['order'][0]['column']];
            $dir            = $requestData['order'][0]['dir'];
            $start            = NULL;
            $length            = NULL;

            $query             = $this->M_wilayah->table($id, $search, $order, $dir, $start, $length);
            $totalData         = count($query);
            $totalFiltered     = $totalData;

            $start            = $requestData['start'];
            $length            = $requestData['length'];

            $query             = $this->M_wilayah->table($id, $search, $order, $dir, $start, $length);

            $data = array();
            $no = 1 + $start;

            foreach ($query as $row) {
                if ($row['status'] == 1) {
                    $status = 'Active';
                } else {
                    $status = 'Non Active';
                }
                $nestedData   = array();
                $nestedData[] = $no++;
                $nestedData[] = $row['kota'];
                $nestedData[] = $status;
                $nestedData[] = "
                <a href=\"#\" onclick=\"ModalKota(" . $row['id'] . ")\" class=\"btn btn-info btn-flat btn-social btn-sm\"><i class=\"bi bi-pencil-square\"></i></a> 
                <a href=\"#\" onclick=\"DeleteKota(" . $row['id'] . ")\" class=\"btn btn-danger btn-flat btn-social btn-sm\"><i class=\"bi bi-trash\"></i></a> 
                ";
                $data[] = $nestedData;
            }
            $output_data = array(
                "draw"            => intval($requestData['draw']),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );
        } elseif ($id == 'kecamatan') {
            $columns        = array('id', 'kecamatan', 'status', 'id');
            $order            = $columns[$requestData['order'][0]['column']];
            $dir            = $requestData['order'][0]['dir'];
            $start            = NULL;
            $length            = NULL;

            $query             = $this->M_wilayah->table($id, $search, $order, $dir, $start, $length);
            $totalData         = count($query);
            $totalFiltered     = $totalData;

            $start            = $requestData['start'];
            $length            = $requestData['length'];

            $query             = $this->M_wilayah->table($id, $search, $order, $dir, $start, $length);

            $data = array();
            $no = 1 + $start;

            foreach ($query as $row) {
                if ($row['status'] == 1) {
                    $status = 'Active';
                } else {
                    $status = 'Non Active';
                }
                $nestedData   = array();
                $nestedData[] = $no++;
                $nestedData[] = $row['kecamatan'];
                $nestedData[] = $status;
                $nestedData[] = "
                <a href=\"#\" onclick=\"ModalKecamatan(" . $row['id'] . ")\" class=\"btn btn-info btn-flat btn-social btn-sm\"><i class=\"bi bi-pencil-square\"></i></a> 
                <a href=\"#\" onclick=\"DeleteKecamatan(" . $row['id'] . ")\" class=\"btn btn-danger btn-flat btn-social btn-sm\"><i class=\"bi bi-trash\"></i></a> 
                ";
                $data[] = $nestedData;
            }
            $output_data = array(
                "draw"            => intval($requestData['draw']),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );
        } elseif ($id == 'kelurahan') {
            $columns        = array('id', 'kelurahan', 'status', 'id');
            $order            = $columns[$requestData['order'][0]['column']];
            $dir            = $requestData['order'][0]['dir'];
            $start            = NULL;
            $length            = NULL;

            $query             = $this->M_wilayah->table($id, $search, $order, $dir, $start, $length);
            $totalData         = count($query);
            $totalFiltered     = $totalData;

            $start            = $requestData['start'];
            $length            = $requestData['length'];

            $query             = $this->M_wilayah->table($id, $search, $order, $dir, $start, $length);

            $data = array();
            $no = 1 + $start;

            foreach ($query as $row) {
                if ($row['status'] == 1) {
                    $status = 'Active';
                } else {
                    $status = 'Non Active';
                }
                $nestedData   = array();
                $nestedData[] = $no++;
                $nestedData[] = $row['kelurahan'];
                $nestedData[] = $status;
                $nestedData[] = "
                <a href=\"#\" onclick=\"ModalKelurahan(" . $row['id'] . ")\" class=\"btn btn-info btn-flat btn-social btn-sm\"><i class=\"bi bi-pencil-square\"></i></a> 
                <a href=\"#\" onclick=\"DeleteKelurahan(" . $row['id'] . ")\" class=\"btn btn-danger btn-flat btn-social btn-sm\"><i class=\"bi bi-trash\"></i></a> 
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
    public function data_provinsi()
    {
        $id = $_POST['id'];
        $provinsi = NULL;
        $data = $this->M_wilayah->get_where_provinsi($id, $provinsi);
        $result['status'] = $data['status'];
        $result['idprovinsi'] = $data['id'];
        $result['provinsi'] = $data['provinsi'];
        $result['modal_title_Provinsi'] = 'Edit Provinsi';
        echo json_encode($result);
    }
    public function data_kota()
    {
        $id = $_POST['id'];
        $kota = NULL;
        $data = $this->M_wilayah->get_where_kota($id, $kota);
        $result['status'] = $data['status'];
        $result['idkota'] = $data['id'];
        $result['idprovinsi'] = $data['idprovinsi'];
        $result['provinsi'] = $data['provinsi'];
        $result['kota'] = $data['kota'];
        $result['modal_title_kota'] = 'Edit Kota';
        echo json_encode($result);
    }
    public function data_kecamatan()
    {
        $id = $_POST['id'];
        $kecamatan = NULL;
        $data = $this->M_wilayah->get_where_kecamatan($id, $kecamatan);
        $result['status'] = $data['status'];
        $result['idkota'] = $data['idkota'];
        $result['idprovinsi'] = $data['idprovinsi'];
        $result['provinsi'] = $data['provinsi'];
        $result['kota'] = $data['kota'];
        $result['kecamatan'] = $data['kecamatan'];
        $result['idkecamatan'] = $data['id'];
        $result['modal_title_kecamatan'] = 'Edit Kecamatan';
        echo json_encode($result);
    }
    public function data_kelurahan()
    {
        $id = $_POST['id'];
        $kelurahan = NULL;
        $data = $this->M_wilayah->get_where_kelurahan($id, $kelurahan);
        $result['idprovinsi'] = $data['idprovinsi'];
        $result['provinsi'] = $data['provinsi'];
        $result['idkota'] = $data['idkota'];
        $result['kota'] = $data['kota'];
        $result['idkecamatan'] = $data['idkecamatan'];
        $result['kecamatan'] = $data['kecamatan'];
        $result['idkelurahan'] = $data['id'];
        $result['kelurahan'] = $data['kelurahan'];
        $result['status'] = $data['status'];
        $result['modal_title_kelurahan'] = 'Edit Kelurahan';
        echo json_encode($result);
    }

    public function pilih_provinsi()
    {
        $key  = 0;
        $data = array();
        if (!$_POST) {
            $keyword = '';
        } else {
            $keyword = $_POST['search'];
        }
        $list_trans = $this->M_wilayah->pilih_provinsi($keyword);
        foreach ($list_trans as $r) {
            $data[$key]['id']   = $r['id'];
            $data[$key]['text'] = $r['provinsi'];
            $key++;
        }
        echo json_encode($data);
    }
    public function pilih_kota()
    {
        if (!empty($_POST['idprovinsi'])) {
            $provinsi = explode('|', $_POST['idprovinsi']);
            $idprovinsi = $provinsi[0];
        } else {
            $provinsi = '';
            $idprovinsi = '';
        }

        $key = 0;
        $data = array();
        $count = count($_REQUEST);
        if ($count > 1) {
            $keyword = $_POST['search'];
        } else {
            $keyword = '';
        }
        $list_trans = $this->M_wilayah->pilih_kota($idprovinsi, $keyword);
        foreach ($list_trans as $r) {
            $data[$key]['id']   = $r['id'] . '|' . $r['kota'];
            $data[$key]['text'] = $r['kota'];
            $key++;
        }
        echo json_encode($data);
    }
    public function pilih_kecamatan()
    {
        if (!empty($_POST['idkota'])) {
            $kota = explode('|', $_POST['idkota']);
            $idkota = $kota[0];
        } else {
            $kota = '';
            $idkota = '';
        }

        $key = 0;
        $data = array();
        $count = count($_REQUEST);
        if ($count > 1) {
            $keyword = $_POST['search'];
        } else {
            $keyword = '';
        }
        $list_trans = $this->M_wilayah->pilih_kecamatan($idkota, $keyword);
        foreach ($list_trans as $r) {
            $data[$key]['id']   = $r['id'] . '|' . $r['kecamatan'];
            $data[$key]['text'] = $r['kecamatan'];
            $key++;
        }
        echo json_encode($data);
    }
    public function cek_provinsi()
    {
        $inputprovinsi = $_POST['inputprovinsi'];
        $action = $_POST['action'];
        $cek = $this->M_wilayah->nums_provinsi($action, $inputprovinsi);
        if ($cek > 0) {
            $result = false;
        } else {
            $result = true;
        }
        echo json_encode($result);
    }
    public function cek_kota()
    {
        $inputkota = $_POST['inputkota'];
        $action = $_POST['action'];
        $cek = $this->M_wilayah->nums_kota($action, $inputkota);
        if ($cek > 0) {
            $result = false;
        } else {
            $result = true;
        }
        echo json_encode($result);
    }
    public function cek_kecamatan()
    {
        $inputkecamatan = $_POST['inputkecamatan'];
        $action = $_POST['action'];
        $cek = $this->M_wilayah->nums_kecamatan($action, $inputkecamatan);
        if ($cek > 0) {
            $result = false;
        } else {
            $result = true;
        }
        echo json_encode($result);
    }
    public function cek_kelurahan()
    {
        $inputkelurahan = $_POST['inputkelurahan'];
        $action = $_POST['action'];
        $cek = $this->M_wilayah->nums_kelurahan($action, $inputkelurahan);
        if ($cek > 0) {
            $result = false;
        } else {
            $result = true;
        }
        echo json_encode($result);
    }
}
