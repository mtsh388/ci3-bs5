<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
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
            'title' => 'Menus',
            'breadcrumb' => $this->M_menu->breadcrumb($this->menu),
            'station' => $this->M_menu->get_stations($this->idlevel),
            'user' => $this->M_user->getWhere($this->iduser),
            'idlevel' => $this->idlevel,
            'akses' => $this->M_menu->akses($this->menu, $this->idlevel),
            'data_station' => $this->M_menu->get_station_all(),
            'data_station_modul' => $this->M_menu->get_station_all(),
            'data_station_menu' => $this->M_menu->get_station_all(),
            'data_modul' => $this->M_menu->get_modul_all(),
            'data_modul_menu' => $this->M_menu->get_modul_all(),
            'data_menu' => $this->M_menu->get_menu_all(),
            'data_akses_menu' => $this->M_menu->get_akses_all(),
            'menu' => $this->menu,
        ];

        $this->load->view('template/header', $data);
        // $this->load->view('template/icon', $data);
        $this->load->view('menus/index', $data);
        $this->load->view('template/footer', $data);
    }
    public function add()
    {
        $result['tab'] = $_POST['tab'];

        if ($this->akses['c'] == 'Y') {
            if ($result['tab'] == "stations") {
                $result['action'] = $_POST['action'];
                $inputstation = $_POST['inputstation'];
                $inputiconstation = $_POST['inputiconstation'];
                $cek_exist = $this->M_menu->station_exist($inputstation);
                if ($cek_exist['jml'] > 0) {
                    $result['msg'] = 'Station already exist';
                } else {
                    $add = $this->M_menu->add_station($inputstation, $inputiconstation);
                    if ($add) {
                        $result['msg'] = 'OK';
                    } else {
                        $result['msg'] = 'Created station failed. Please try again';
                    }
                }
            } elseif ($result['tab'] == "moduls") {
                $result['action'] = $_POST['action'];
                $idstation = $_POST['idstation'];
                $modul = $_POST['inputmodul'];
                $icon = $_POST['inputiconmodul'];
                $cek_exist = $this->M_menu->modul_exist($modul);
                if ($cek_exist['jml'] > 0) {
                    $result['msg'] = 'Modul already exist';
                } else {
                    $add = $this->M_menu->add_modul($idstation, $modul, $icon);
                    if ($add) {
                        $result['msg'] = 'OK';
                    } else {
                        $result['msg'] = 'Created modul failed. Please try again';
                    }
                }
            } elseif ($result['tab'] == "menus") {
                $result['action'] = $_POST['action'];
                $idstation = $_POST['idstation'];
                $idmodul = $_POST['idmodul'];
                $menu = $_POST['inputmenu'];
                $link = strtolower($_POST['link']);
                $icon = $_POST['inputiconmenu'];
                $cek_exist = $this->M_menu->menu_exist($link);
                if ($cek_exist['jml'] > 0) {
                    $result['msg'] = 'Link already exist';
                } else {
                    $controller = fopen('application/controllers/' . ucfirst($link) . '.php', 'w');
                    if (!$controller) {
                        $result['msg'] = 'Create controller failed. Please call administrator';
                    } else {
                        if (!fwrite($controller, "<?php
                        defined('BASEPATH') or exit('No direct script access allowed');
                        
                        class " . ucfirst($link) . " extends CI_Controller
                        {
                            
                        }
                        ")) {
                            $result['msg'] = 'Write controller failed. Please call administrator';
                        } else {
                            $views = 'application/views/' . $link;
                            if (!mkdir($views, 0700, true)) {
                                unlink('application/controllers/' . ucfirst($link) . ',php');
                                $result['msg'] = 'Create folder views failed. Please call administrator';
                            } else {
                                $view = fopen($views . '/index.php', 'w');
                                if (!$view) {
                                    unlink('application/controllers/' . ucfirst($link) . '.php');
                                    rmdir('application/views/' . $link);
                                    $result['msg'] = 'Created file index failed. Please call administrator';
                                } else {
                                    if (!fwrite($view, '<div class="container-fluid p-3">
                                    </div>
                                    </main>')) {
                                        unlink('application/controllers/' . ucfirst($link) . '.php');
                                        rmdir('application/views/' . $link);
                                        unlink('application/views/' . $link . '/index.php');
                                        $result['msg'] = 'Write file index failed. Please call administrator';
                                    } else {
                                        $model = fopen('application/models/' . ucfirst($link) . 'Model.php', 'w');
                                        if (!$model) {
                                            unlink('application/controllers/' . ucfirst($link) . '.php');
                                            rmdir('application/views/' . $link);
                                            unlink('application/views/' . $link . '/index.php');
                                            $result['msg'] = 'Created model failed. Please call administrator';
                                        } else {
                                            if (!fwrite($model, "<?php
                                            class " . ucfirst($link) . "Model extends CI_Model
                                            {
                                            
                                            }")) {
                                                unlink('application/controllers/' . ucfirst($link) . '.php');
                                                rmdir('application/views/' . $link);
                                                unlink('application/views/' . $link . '/index.php');
                                                unlink('application/models/' . ucfirst($link) . 'Model.php');
                                                $result['msg'] = 'Write model failed. Please call administrator';
                                            } else {
                                                $add = $this->M_menu->add_menu($idstation, $idmodul, $menu, $icon, $link);

                                                if ($add == NULL) {
                                                    unlink('application/controllers/' . ucfirst($link) . '.php');
                                                    rmdir('application/views/' . $link);
                                                    unlink('application/views/' . $link . '/index.php');
                                                    unlink('application/models/' . ucfirst($link) . 'Model.php');
                                                    $result['msg'] = 'Created menu failed. Please try again';
                                                } else {
                                                    $list_level = $this->M_level->get_all();
                                                    foreach ($list_level as $list_level) {
                                                        $this->M_menu->add_akses($list_level['id'], $add);
                                                    }
                                                    $result['msg'] = 'OK';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } elseif ($result['tab'] == "akses") {
                # code...
            } else {
                $result['msg'] = "Tab not found. Please call administrator";
            }
        } else {
            $result['msg'] = "Your not have access";
        }

        echo json_encode($result);
    }
    public function update()
    {
        $result['tab'] = $_POST['tab'];
        if ($this->akses['u'] == 'Y') {
            if ($result['tab'] == 'stations') {
                $idstation = $_POST['idstation'];
                $inputstation = $_POST['inputstation'];
                $inputiconstation = $_POST['inputiconstation'];
                $station_old = $this->M_menu->get_old_station($idstation, $inputstation);
                if ($station_old['jml'] > 0) {
                    $update = $this->M_menu->update_station($idstation, $inputstation, $inputiconstation);
                    if ($update) {
                        $result['msg'] = "OK";
                    } else {
                        $result['msg'] = "Updated station failed. Please try again";
                    }
                } else {
                    $cek_exist = $this->M_menu->station_exist($inputstation);
                    if ($cek_exist['jml'] > 0) {
                        $result['msg'] = 'Station already exist';
                    } else {
                        $update = $this->M_menu->update_station($idstation, $inputstation, $inputiconstation);
                        if ($update) {
                            $result['msg'] = "OK";
                        } else {
                            $result['msg'] = "Updated station failed. Please try again";
                        }
                    }
                }
            } elseif ($result['tab'] == 'moduls') {
                $idstation = $_POST['idstation'];
                $idmodul = $_POST['idmodul'];
                $modul = $_POST['inputmodul'];
                $icon = $_POST['inputiconmodul'];
                $modul_old = $this->M_menu->get_old_modul($idmodul, $modul);
                if ($modul_old['jml'] > 0) {
                    $update = $this->M_menu->update_modul($idstation, $idmodul, $modul, $icon);
                    if ($update) {
                        $result['msg'] = 'OK';
                    } else {
                        $result['msg'] = 'Updated modul failed. Please try again';
                    }
                } else {
                    $cek_exist = $this->M_menu->modul_exist($modul);
                    if ($cek_exist['jml'] > 0) {
                        $result['msg'] = 'Modul already exist';
                    } else {
                        $update = $this->M_menu->update_modul($idstation, $idmodul, $modul, $icon);
                        if ($update) {
                            $result['msg'] = 'OK';
                        } else {
                            $result['msg'] = 'Updated modul failed. Please try again';
                        }
                    }
                }
            } elseif ($result['tab'] == 'menus') {
                $idstation = $_POST['idstation'];
                $idmodul = $_POST['idmodul'];
                $idmenu = $_POST['idmenu'];
                $menu = $_POST['inputmenu'];
                $link = $_POST['link'];
                $icon = $_POST['inputiconmenu'];
                $menu_old = $this->M_menu->get_old_menu($idmenu, $menu);
                if ($menu_old['jml'] > 0) {
                    $update = $this->M_menu->update_menu($idstation, $idmodul, $idmenu, $menu, $icon, $link);
                    if ($update) {
                        $result['msg'] = 'OK';
                    } else {
                        $result['msg'] = 'Updated menu failed. Please try again';
                    }
                } else {
                    $cek_exist = $this->M_menu->menu_exist($link);
                    if ($cek_exist['jml'] > 0) {
                        $result['msg'] = 'Link already exist';
                    } else {
                        $update = $this->M_menu->update_menu($idstation, $idmodul, $idmenu, $menu, $icon, $link);
                        if ($update) {
                            $result['msg'] = 'OK';
                        } else {
                            $result['msg'] = 'Updated menu failed. Please try again';
                        }
                    }
                }
            } elseif ($result['tab'] == 'akses') {
                $id = $_POST['id'];
                $create = $_POST['create'];
                $read = $_POST['read'];
                $delete = $_POST['delete'];
                $update = $_POST['update'];
                $update_data = $this->M_menu->update_where_akses($id, $create, $read, $update, $delete);
                if ($update_data) {
                    $result['msg'] = 'OK';
                } else {
                    $result['msg'] = 'Updated failed. Please try again';
                }
            } else {
                $result['msg'] = 'Tab not found. Please call administrator';
            }
        } else {
            $result['msg'] = "Your not have access";
        }

        echo json_encode($result);
    }
    public function delete()
    {
        $result['tab'] = $_POST['tab'];
        if ($this->akses['d'] == "Y") {
            if ($result['tab'] == 'stations') {
                $idstation = $_POST['idstation'];
                $delete = $this->M_menu->delete_station($idstation);
                if ($delete) {
                    $result['msg'] = "OK";
                } else {
                    $result['msg'] = "Delete station not success. Please try again";
                }
            } elseif ($result['tab'] == 'moduls') {
                $idmodul = $_POST['idmodul'];
                $delete = $this->M_menu->delete_modul($idmodul);
                if ($delete) {
                    $result['msg'] = "OK";
                } else {
                    $result['msg'] = "Delete modul not success. Please try again";
                }
            } elseif ($result['tab'] == 'menus') {
                $idmenu = $_POST['idmenu'];
                $data_menu = $this->M_menu->get_menu($idmenu);
                $link = $data_menu['link'];
                $views = 'application/views/' . $link;
                $file = $views . '/index.php';
                $controller = 'application/controllers/' . ucfirst($link) . '.php';
                $model = 'application/models/' . ucfirst($link) . 'Model.php';
                if (!file_exists($views)) {
                    $result['msg'] = 'Folder not exist. Please call administrator';
                } else {
                    if (!unlink($file)) {
                        $result['msg'] = 'Delete file failed. Please call administrator';
                    } else {
                        if (!rmdir($views)) {
                            $result['msg'] = 'Delete views failed. Please call administrator';
                        } else {
                            if (!unlink($controller)) {
                                $result['msg'] = 'Delete controller failed. Please call administrator';
                            } else {
                                if (!unlink($model)) {
                                    $result['msg'] = 'Delete model failed. Please call administrator';
                                } else {
                                    $delete = $this->M_menu->delete_menu($idmenu);
                                    if ($delete) {
                                        $result['msg'] = "OK";
                                    } else {
                                        $result['msg'] = "Delete menu not success. Please try again";
                                    }
                                }
                            }
                        }
                    }
                }
            } elseif ($result['tab'] == 'akses') {
                # code...
            } else {
                $result['msg'] = 'Tab not found. Please call administrator';
            }
        } else {
            $result['msg'] = 'Your not have access';
        }

        echo json_encode($result);
    }
    public function data_station()
    {
        $id = $_POST['id'];
        $data = $this->M_menu->get_station($id);

        $result['idstation'] = $data['id'];
        $result['station'] = $data['station'];
        $result['icon_station'] = $data['icon'];
        $result['modal_title_station'] = 'Edit Station';

        echo json_encode($result);
    }
    public function data_modul()
    {
        $id = $_POST['id'];
        $data = $this->M_menu->get_modul($id);

        $result['idmodul'] = $data['id'];
        $result['idstation'] = $data['idstation'];
        $result['station'] = $data['station'];
        $result['modul'] = $data['modul'];
        $result['icon_modul'] = $data['icon'];
        $result['modal_title_modul'] = 'Edit Modul';

        echo json_encode($result);
    }
    public function data_menu()
    {
        $id = $_POST['id'];
        $data = $this->M_menu->get_menu($id);

        $result['idmodul'] = $data['idmodul'];
        $result['idstation'] = $data['idstation'];
        $result['idmenu'] = $data['id'];
        $result['menu'] = $data['menu'];
        $result['link'] = $data['link'];
        $result['icon_menu'] = $data['icon'];
        $result['modal_title_menu'] = 'Edit Menu';

        echo json_encode($result);
    }
}
