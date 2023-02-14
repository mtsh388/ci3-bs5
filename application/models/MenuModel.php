<?php
class MenuModel extends CI_Model
{
    //Stations
    public function get_stations($idlevel)
    {
        return $this->db->query("SELECT a.id, a.station, a.icon, c.link
        FROM `tbl_station` a
        JOIN `tbl_modul` b
        ON a.id=b.`idstation`
        JOIN `tbl_menu` c
        ON b.`id`=c.`idmodul`
        JOIN `tbl_akses` e
        ON c.id=e.`idmenu`
        WHERE idlevel='$idlevel' GROUP BY a.id")->result_array();
        // return $this->db->get('tbl_station')->result_array();
    }
    public function get_station($id)
    {
        return $this->db->query("SELECT a.id , a.station , a.icon FROM tbl_station a WHERE a.id='$id'")->row_array();
    }

    public function delete_station($id)
    {
        return $this->db->where('id', $id)->delete('tbl_station');
    }
    public function add_station($station, $icon)
    {
        $data = [
            'station' => $station,
            'icon' => $icon
        ];
        return $this->db->insert('tbl_station', $data);
    }
    public function station_exist($station)
    {
        return $this->db->query("SELECT COUNT(*) AS jml FROM tbl_station WHERE station='$station'")->row_array();
    }
    public function get_old_station($idstation, $station)
    {
        return $this->db->query("SELECT COUNT(*) AS jml FROM tbl_station WHERE id='$idstation' AND station='$station'")->row_array();
    }
    public function update_station($idstation, $inputstation, $inputiconstation)
    {
        $data = [
            "station" => $inputstation,
            "icon" => $inputiconstation,
        ];
        return $this->db->where("id", $idstation)->update("tbl_station", $data);
    }
    // TUTUP Station

    // Moduls
    public function get_modul($id)
    {
        return $this->db->query("SELECT a.id, a.modul, a.icon, b.id AS idstation, b.`station` FROM tbl_modul a JOIN tbl_station b WHERE a.id='$id'")->row_array();
    }
    public function get_modul_all()
    {
        return $this->db->query("SELECT a.id AS idmodul, a.modul, a.icon FROM tbl_modul a ")->result_array();
    }
    public function add_modul($idstation, $modul, $icon)
    {
        $data = [
            'idstation' => $idstation,
            'modul' => $modul,
            'icon' => $icon
        ];
        return $this->db->insert('tbl_modul', $data);
    }
    public function modul_exist($modul)
    {
        return $this->db->query("SELECT COUNT(*) AS jml FROM tbl_modul WHERE modul='$modul'")->row_array();
    }
    public function get_old_modul($id, $modul)
    {
        return $this->db->query("SELECT COUNT(*) AS jml FROM tbl_modul WHERE id='$id' AND modul='$modul'")->row_array();
    }
    public function update_modul($idstation, $idmodul, $modul, $icon)
    {
        $data = [
            "idstation" => $idstation,
            "modul" => $modul,
            "icon" => $icon,
        ];
        return $this->db->where("id", $idmodul)->update("tbl_modul", $data);
    }
    public function delete_modul($idmodul)
    {
        return $this->db->where('id', $idmodul)->delete('tbl_modul');
    }
    // Tutup Modul

    // Menu
    public function list_menu()
    {
        return $this->db->get('tbl_menu')->result_array();
    }
    public function get_menu_all()
    {
        return $this->db->query("SELECT a.id AS idmenu, a.menu, a.link, a.icon FROM tbl_menu a ")->result_array();
    }
    public function get_menu($id)
    {
        return $this->db->query("SELECT a.id, a.menu, a.link, a.icon, b.id AS idmodul, c.`id` AS idstation FROM tbl_menu a JOIN tbl_modul b ON a.`idmodul`=b.`id` JOIN `tbl_station` c ON a.`idstation`=c.`id` WHERE a.id='$id'")->row_array();
    }
    public function breadcrumb($menu)
    {
        return $this->db->query("SELECT a.menu, a.link, c.station, b.modul
        FROM tbl_menu a 
        JOIN tbl_modul b 
        ON a.`idmodul`=b.`id` 
        JOIN `tbl_station` c 
        ON a.`idstation`=c.`id` 
        WHERE a.link='$menu'")->row_array();
    }
    public function menu_exist($link)
    {
        return $this->db->query("SELECT COUNT(*) AS jml FROM tbl_menu WHERE link='$link'")->row_array();
    }
    public function add_menu($idstation, $idmodul, $menu, $icon, $link)
    {
        $data = [
            'idstation' => $idstation,
            'idmodul' => $idmodul,
            'menu' => $menu,
            'icon' => $icon,
            'link' => $link
        ];
        $this->db->insert('tbl_menu', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    public function get_old_menu($id, $menu)
    {
        return $this->db->query("SELECT COUNT(*) AS jml FROM tbl_menu WHERE id='$id' AND menu='$menu'")->row_array();
    }
    public function update_menu($idstation, $idmodul, $idmenu, $menu, $icon, $link)
    {
        $data = [
            "idstation" => $idstation,
            "idmodul" => $idmodul,
            "id" => $idmenu,
            "menu" => $menu,
            "icon" => $icon,
            "link" => $link
        ];
        return $this->db->where("id", $idmenu)->update("tbl_menu", $data);
    }
    public function delete_menu($idmenu)
    {
        return $this->db->where('id', $idmenu)->delete('tbl_menu');
    }
    // Tutup Menu

    // Akses
    public function akses($menu, $idlevel)
    {
        return $this->db->query("SELECT * FROM tbl_menu a JOIN tbl_akses b ON a.`id`=b.`idmenu` WHERE link='$menu' AND idlevel='$idlevel'")->row_array();
    }
    public function get_station_all()
    {
        return $this->db->query('SELECT a.id AS idstation, a.station , a.icon FROM tbl_station a')->result_array();
    }

    public function add_akses($idlevel, $idmenu)
    {
        if ($idlevel == '1') {
            $data = [
                'idlevel' => $idlevel,
                'idmenu' => $idmenu,
                'c' => 'Y',
                'r' => 'Y',
                'u' => 'Y',
                'd' => 'Y'
            ];
        } else {
            $data = [
                'idlevel' => $idlevel,
                'idmenu' => $idmenu,
                'c' => 'N',
                'r' => 'N',
                'u' => 'N',
                'd' => 'N'
            ];
        }

        return $this->db->insert('tbl_akses', $data);
    }
    public function get_akses_all()
    {
        return $this->db->query('SELECT e.`station`,c.level, d.`modul`, a.menu, b.id AS idakses, b.c, b.r, b.u, b.d 
        FROM tbl_menu a 
        JOIN tbl_akses b
        ON a.`id`=b.`idmenu`
        JOIN tbl_level c
        ON b.idlevel=c.id
        JOIN tbl_modul d
        ON a.`idmodul`=d.`id`
        JOIN tbl_station e
        ON e.`id`=d.`idstation`')->result_array();
    }

    public function update_where_akses($id, $create, $read, $update, $delete)
    {
        if ($create == 'true') {
            $create = 'Y';
        } else {
            $create = 'N';
        }
        if ($read == 'true') {
            $read = 'Y';
        } else {
            $read = 'N';
        }
        if ($update == 'true') {
            $update = 'Y';
        } else {
            $update = 'N';
        }
        if ($delete == 'true') {
            $delete = 'Y';
        } else {
            $delete = 'N';
        }
        $data = [
            'c' => $create,
            'r' => $read,
            'u' => $update,
            'd' => $delete
        ];
        return $this->db->where('id', $id)->update('tbl_akses', $data);
    }
    // TUTUP Akses
}
