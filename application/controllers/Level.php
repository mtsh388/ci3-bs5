<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level extends CI_Controller
{
    var $menu;
    var $idlevel;
    var $iduser;
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model([
            'UsersModel' => 'M_user',
            'MenuModel' => 'M_menu',
            'LevelModel' => 'M_level'
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
            'title' => 'Level',
            'menu' => $this->menu,
            'breadcrumb' => $this->M_menu->breadcrumb($this->menu),
            'idlevel' => $this->idlevel,
            'iduser' => $this->iduser,
            'akses' => $this->M_menu->akses($this->menu, $this->idlevel),
            'user' => $this->M_user->getWhere($this->iduser),
            'station' => $this->M_menu->get_stations($this->idlevel),
            'data_level' => $this->M_level->get_all()
        ];
        $this->load->view('template/header', $data);
        $this->load->view('level/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add()
    {
        $akses = $this->M_menu->akses($this->menu, $this->idlevel);
        if ($akses['c'] == "Y") {
            $level = $this->input->post("inputlevel");
            $level_exist = $this->M_level->level_exist($level);
            if ($level_exist['jml'] > 0) {
                $result['msg'] = 'Level already exist';
            } else {
                $insert = $this->M_level->add($level);
                if ($insert == NULL) {
                    $result['msg'] = 'Created failed. Please try again';
                } else {
                    $list_menu = $this->M_menu->list_menu();
                    foreach ($list_menu as $list_menu) {
                        $this->M_menu->add_akses($insert, $list_menu['id']);
                    }
                    $result['msg'] = 'OK';
                }
            }
        } else {
            $result['msg'] = 'Your not access';
        }
        echo json_encode($result);
    }
    public function update()
    {
        $akses = $this->M_menu->akses($this->menu, $this->idlevel);
        if ($akses['u'] == "Y") {
            $id = $this->input->post("idlevel");
            $level = $this->input->post("inputlevel");
            $old = $this->M_level->level_old($id, $level);
            if ($old['jml'] > 0) {
                if (!$this->M_level->update($id, $level)) {
                    $result['msg'] = 'Updated failed. Please try again';
                } else {
                    $result['msg'] = 'OK';
                }
            } else {
                $level_exist = $this->M_level->level_exist($level);
                if ($level_exist['jml'] > 0) {
                    $result['msg'] = 'Level already exist';
                } else {
                    if (!$this->M_level->update($id, $level)) {
                        $result['msg'] = 'Updated failed. Please try again';
                    } else {
                        $result['msg'] = 'OK';
                    }
                }
            }
        } else {
            $result['msg'] = 'Your not access. Please call administrator';
        }
        echo json_encode($result);
    }

    public function delete()
    {
        $menu = $this->uri->segment(1);
        $idlevel = $this->session->userdata('idlevel');
        $akses = $this->M_menu->akses($menu, $idlevel);
        if ($akses['d'] == "Y") {
            $id = $this->input->post("idlevel");
            if (!$this->M_level->delete($id)) {
                $result['msg'] = 'Deleted failed. Please try again';
            } else {
                $result['msg'] = 'OK';
            }
        } else {
            $result['msg'] = 'Your not access';
        }
        echo json_encode($result);
    }

    public function data_level()
    {
        $id = $_POST['id'];
        $data = $this->M_level->get_level($id);

        $result['idlevel'] = $data['id'];
        $result['level'] = $data['level'];
        $result['modal_title_level'] = 'Edit Level';

        echo json_encode($result);
    }
}
