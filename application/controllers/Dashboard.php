<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model([
            'UsersModel' => 'M_user',
            'MenuModel' => 'M_menu'
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
        // $a = 3;
        // $aA = array("a", "b", "c");
        // $bB = array("aA", "bB", "cC", "dD");
        // for ($i = 1; $i <= $a; $i++) {
        //     $tr[] = '000' . $i . '<br>';
        // }
        // foreach ($tr as $tr) {
        //     # code...
        // }
        // var_dump($tr);
        // die;
        $idlevel = $this->session->userdata('idlevel');
        $data = [
            'title' => 'Application',
            'station' => $this->M_menu->get_stations($idlevel),
            'idlevel' => $idlevel,
            'menu' => $this->menu,
            'iduser' => $this->iduser,
            'idlevel' => $this->idlevel,
            'akses' => $this->akses
        ];

        $this->load->view('template/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/footer', $data);
    }
}
