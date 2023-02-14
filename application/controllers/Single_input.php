<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Single_input extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model([
            'UsersModel' => 'M_user',
            'MenuModel' => 'M_menu',
            'LevelModel' => 'M_level',
            'Upload_excelModel' => 'M_U_Excel',
            'Single_inputModel' => 'M_S_Input'
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
            'title' => 'Form I Excel',
            'breadcrumb' => $this->M_menu->breadcrumb($this->menu),
            'station' => $this->M_menu->get_stations($this->idlevel),
            'user' => $this->M_user->getWhere($this->iduser),
            'idlevel' => $this->idlevel,
            'menu' => $this->menu,
            'akses' => $this->M_menu->akses($this->menu, $this->idlevel),
        ];

        $this->load->view('template/header', $data);
        $this->load->view('single_input/index', $data);
        $this->load->view('template/footer', $data);
    }
    public function pilih_select()
    {
    }
}
