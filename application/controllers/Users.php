<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
        $this->idlevel = $this->session->userdata('idlevel');
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
            'title' => 'Application',
            'station' => $this->M_menu->get_stations($this->idlevel),
            'breadcrumb' => $this->M_menu->breadcrumb($this->menu),
            'idlevel' => $this->idlevel,
            'menu' => $this->menu,
            'iduser' => $this->iduser,
            'idlevel' => $this->idlevel,
            'akses' => $this->akses
        ];
        $this->load->view('template/header', $data);
        $this->load->view('users/index', $data);
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
                <a href=\"#\" onclick=\"ModalUsers(" . $row['id'] . ")\" class=\"btn btn-info btn-flat btn-social btn-sm\"><i class=\"bi bi-pencil-square\"></i></a> 
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
    public function data_users()
    {
        $id = $_POST['id'];
        $data = $this->M_user->data_user($id);
        $result['id'] = $data['id'];
        $result['namalengkap'] = $data['nama_lengkap'];
        $result['username'] = $data['username'];
        $result['email'] = $data['email'];
        $result['aktif'] = $data['aktif'];
        $result['idlevel'] = $data['idlevel'];
        $result['level'] = $data['level'];
        $result['jalan'] = $data['jalan'];
        $result['idkelurahan'] = $data['idkelurahan'];
        $result['kelurahan'] = $data['kelurahan'];
        $result['idkecamatan'] = $data['idkecamatan'];
        $result['kecamatan'] = $data['kecamatan'];
        $result['idkota'] = $data['idkota'];
        $result['kota'] = $data['kota'];
        $result['idprovinsi'] = $data['idprovinsi'];
        $result['provinsi'] = $data['provinsi'];
        $result['modal_title_users'] = 'Edit Users';

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
        $key  = 0;
        $data = array();
        $idprovinsi = NULL;
        if (!$_POST) {
            $keyword = '';
        } else {
            $keyword = $_POST['search'];
        }
        $list_trans = $this->M_wilayah->pilih_kota($idprovinsi, $keyword);
        foreach ($list_trans as $r) {
            $data[$key]['id']   = $r['id'];
            $data[$key]['text'] = $r['kota'];
            $key++;
        }
        echo json_encode($data);
    }
    public function pilih_kecamatan()
    {
        $key  = 0;
        $idkota = NULL;
        $data = array();
        if (!$_POST) {
            $keyword = '';
        } else {
            $keyword = $_POST['search'];
        }
        $list_trans = $this->M_wilayah->pilih_kecamatan($idkota, $keyword);
        foreach ($list_trans as $r) {
            $data[$key]['id']   = $r['id'];
            $data[$key]['text'] = $r['kecamatan'];
            $key++;
        }
        echo json_encode($data);
    }
    public function pilih_kelurahan()
    {
        $key  = 0;
        $data = array();
        if (!$_POST) {
            $keyword = '';
        } else {
            $keyword = $_POST['search'];
        }
        $list_trans = $this->M_wilayah->pilih_kelurahan($keyword);
        foreach ($list_trans as $r) {
            $data[$key]['id']   = $r['id'];
            $data[$key]['text'] = $r['kelurahan'];
            $key++;
        }
        echo json_encode($data);
    }
    public function pilih_level()
    {
        $key  = 0;
        $data = array();
        if (!$_POST) {
            $keyword = '';
        } else {
            $keyword = $_POST['search'];
        }
        $list_trans = $this->M_level->pilih_level($keyword);
        foreach ($list_trans as $r) {
            $data[$key]['id']   = $r['id'];
            $data[$key]['text'] = $r['level'];
            $key++;
        }
        echo json_encode($data);
    }
}
