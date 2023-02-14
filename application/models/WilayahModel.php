<?php

use LDAP\Result;

class WilayahModel extends CI_Model
{
    public function get_all_provinsi()
    {
        return $this->db->get('tbl_provinsi')->result_array();
    }
    public function get_where_provinsi($id = NULL, $provinsi = NULL)
    {
        if ($id != NULL) {
            $data = ['id' => $id];
        }
        if ($provinsi != NULL) {
            $data = ['provinsi' => $provinsi];
        }
        return $this->db->where($data)->get('tbl_provinsi')->row_array();
    }
    public function nums_provinsi($action, $provinsi)
    {
        if ($action == 'add') {
            return $this->db->where('provinsi', $provinsi)->get('tbl_provinsi')->num_rows();
        } else {
            return $this->db->where_not_in('provinsi', $provinsi)->get_where('tbl_provinsi', ['provinsi' => $provinsi])->num_rows();
        }
    }
    public function nums_kota($action, $kota)
    {
        if ($action == 'add') {
            return $this->db->where('kota', $kota)->get('tbl_kota')->num_rows();
        } else {
            return $this->db->where_not_in('kota', $kota)->get_where('tbl_kota', ['kota' => $kota])->num_rows();
        }
    }
    public function nums_kecamatan($action, $kecamatan)
    {
        if ($action == 'add') {
            return $this->db->where('kecamatan', $kecamatan)->get('tbl_kecamatan')->num_rows();
        } else {
            return $this->db->where_not_in('kecamatan', $kecamatan)->get_where('tbl_kecamatan', ['kecamatan' => $kecamatan])->num_rows();
        }
    }
    public function nums_kelurahan($action, $kelurahan)
    {
        if ($action == 'add') {
            return $this->db->where('kelurahan', $kelurahan)->get('tbl_kelurahan')->num_rows();
        } else {
            return $this->db->where_not_in('kelurahan', $kelurahan)->get_where('tbl_kelurahan', ['kelurahan' => $kelurahan])->num_rows();
        }
    }
    public function get_where_kota($id = NULL, $kota = NULL)
    {
        if ($id != NULL) {
            $data = ['a.id' => $id];
        }
        if ($kota != NULL) {
            $data = ['a.kota' => $kota];
        }
        // return $this->db->query("SELECT a.id, a.kota, a.idprovinsi, b.provinsi 
        //                         FROM tbl_kota a 
        //                         JOIN tbl_provinsi b 
        //                         ON a.idprovinsi=b.id
        //                         WHERE a.id <> ''")->row_array();

        return $this->db->select("a.id, a.kota, a.status, a.idprovinsi, b.provinsi")
            ->from("tbl_kota a")
            ->join("tbl_provinsi b", "a.idprovinsi=b.id")
            ->where($data)
            ->get()
            ->row_array();
    }
    public function get_where_kecamatan($id = NULL, $kecamatan = NULL)
    {
        if ($id != NULL) {
            $data = ['a.id' => $id];
        }
        if ($kecamatan != NULL) {
            $data = ['a.kecamatan' => $kecamatan];
        }
        return $this->db->select("a.id, a.kecamatan, a.status, a.idkota, b.kota, c.id AS idprovinsi, c.provinsi")
            ->from("tbl_kecamatan a")
            ->join("tbl_kota b", "a.idkota=b.id")
            ->join("tbl_provinsi c", "b.idprovinsi=c.id")
            ->where($data)
            ->get()
            ->row_array();
    }
    public function get_where_kelurahan($id = NULL, $kelurahan = NULL)
    {
        if ($id != NULL) {
            $data = ['a.id' => $id];
        }
        if ($kelurahan != NULL) {
            $data = ['a.kelurahan' => $kelurahan];
        }
        return $this->db->select("a.id, a.kelurahan, a.status, a.idkecamatan, b.kecamatan, b.idkota, c.kota, c.idprovinsi, d.provinsi")
            ->from("tbl_kelurahan a")
            ->join("tbl_kecamatan b", "a.idkecamatan=b.id")
            ->join("tbl_kota c", "b.idkota=c.id")
            ->join("tbl_provinsi d", "c.idprovinsi=d.id")
            ->where($data)
            ->get()
            ->row_array();
    }

    public function pilih_provinsi($keyword)
    {
        if (!empty($keyword)) {
            $like = " AND provinsi LIKE '%" . $keyword . "%' ";
        } else {
            $like = "";
        }
        return $this->db->query("SELECT id, provinsi FROM tbl_provinsi WHERE id <> '' $like ORDER BY provinsi ASC")->result_array();
    }
    public function pilih_kota($idprovinsi, $keyword)
    {
        if (!empty($idprovinsi)) {
            $like = " AND idprovinsi='$idprovinsi' ";
        } else {
            $like = "";
        }

        if (!empty($keyword)) {
            $like .= " AND kota LIKE '%" . $keyword . "%' ";
        } else {
            $like .= "";
        }

        return $this->db->query("SELECT id, kota FROM tbl_kota WHERE id <> '' $like ORDER BY kota ASC LIMIT 0,9")->result_array();
    }
    public function pilih_kecamatan($idkota, $keyword)
    {
        if (!empty($idkota)) {
            $like = " AND idkota='$idkota' ";
        } else {
            $like = "";
        }

        if (!empty($keyword)) {
            $like .= " AND kecamatan LIKE '%" . $keyword . "%' ";
        } else {
            $like .= "";
        }
        return $this->db->query("SELECT id, kecamatan FROM tbl_kecamatan WHERE id <> '' $like ORDER BY kecamatan ASC LIMIT 0,9")->result_array();
    }
    public function pilih_kelurahan($keyword)
    {
        if (!empty($keyword)) {
            $like = " AND kelurahan LIKE '%" . $keyword . "%' ";
        } else {
            $like = "";
        }
        return $this->db->query("SELECT id, kelurahan FROM tbl_kelurahan WHERE id <> '' $like ORDER BY kelurahan ASC LIMIT 0,9")->result_array();
    }
    public function table($id, $search, $order, $dir, $start, $length)
    {
        if ($id == 'provinsi') {
            $sql = "SELECT * FROM tbl_provinsi WHERE id IS NOT NULL";
            if (!empty($search)) {
                $sql .= " AND provinsi LIKE '%$search%' ";
            }
        } elseif ($id == 'kota') {
            $sql = "SELECT * FROM tbl_kota WHERE id IS NOT NULL";
            if (!empty($search)) {
                $sql .= " AND kota LIKE '%$search%' ";
            }
        } elseif ($id == 'kecamatan') {
            $sql = "SELECT * FROM tbl_kecamatan WHERE id IS NOT NULL";
            if (!empty($search)) {
                $sql .= " AND kecamatan LIKE '%$search%' ";
            }
        } elseif ($id == 'kelurahan') {
            $sql = "SELECT * FROM tbl_kelurahan WHERE id IS NOT NULL";
            if (!empty($search)) {
                $sql .= " AND kelurahan LIKE '%$search%' ";
            }
        }

        if (!empty($order)) {

            $sql .= " ORDER BY $order $dir";
        }

        if ($start != NULL) {
            $sql .= " limit $start , $length";
        }   

        return $this->db->query($sql)->result_array();
    }

    // ADD
    public function add_provinsi($inputprovinsi)
    {
        $data = [
            'provinsi' => $inputprovinsi
        ];
        return $this->db->insert('tbl_provinsi', $data);
    }
    public function add_kota($inputidprovinsi, $inputkota)
    {
        $data = [
            'idprovinsi' => $inputidprovinsi,
            'kota' => $inputkota,
        ];
        return $this->db->insert('tbl_kota', $data);
    }
    public function add_kecamatan($inputidprovinsi, $inputidkota, $inputkecamatan)
    {
        $data = [
            'idprovinsi' => $inputidprovinsi,
            'idkota' => $inputidkota,
            'kecamatan' => $inputkecamatan,
        ];
        return $this->db->insert('tbl_kecamatan', $data);
    }
    public function add_kelurahan($inputidprovinsi, $inputidkota, $inputidkecamatan, $inputkelurahan)
    {
        $data = [
            'idprovinsi' => $inputidprovinsi,
            'idkota' => $inputidkota,
            'idkecamatan' => $inputidkecamatan,
            'kelurahan' => $inputkelurahan,
        ];
        return $this->db->insert('tbl_kelurahan', $data);
    }
    // TUTUP ADD

    // UPDATE
    public function update_provinsi($id, $inputprovinsi, $status)
    {
        $data = [
            'provinsi' => $inputprovinsi,
            'status' => $status
        ];
        return $this->db->where('id', $id)->update('tbl_provinsi', $data);
    }

    public function update_kota($idprovinsi, $idkota, $inputkota, $status)
    {
        $data = [
            'idprovinsi' => $idprovinsi,
            'kota' => $inputkota,
            'status' => $status
        ];
        return $this->db->where('id', $idkota)->update('tbl_kota', $data);
    }
    public function update_kecamatan($idkota, $idkecamatan, $inputkecamatan, $status)
    {
        $data = [
            'idkota' => $idkota,
            'kecamatan' => $inputkecamatan,
            'status' => $status
        ];
        return $this->db->where('id', $idkecamatan)->update('tbl_kecamatan', $data);
    }
    public function update_kelurahan($idkecamatan, $idkelurahan, $inputkelurahan, $status)
    {
        $data = [
            'idkecamatan' => $idkecamatan,
            'kelurahan' => $inputkelurahan,
            'status' => $status
        ];
        return $this->db->where('id', $idkelurahan)->update('tbl_kelurahan', $data);
    }
    // TUTUP UPDATE

    // DELETE
    public function deleted($id, $tab)
    {
        if ($tab == 'provinsi') {
            $delete = $this->db->where('id', $id)->delete('tbl_provinsi');
            $delete = $this->db->where('id', $id)->delete('tbl_kota');
            $delete = $this->db->where('id', $id)->delete('tbl_kecamatan');
            $delete = $this->db->where('id', $id)->delete('tbl_kelurahan');
        } elseif ($tab == 'kota') {
            $delete = $this->db->where('id', $id)->delete('tbl_kota');
            $delete = $this->db->where('id', $id)->delete('tbl_kecamatan');
            $delete = $this->db->where('id', $id)->delete('tbl_kelurahan');
        } elseif ($tab == 'kecamatan') {
            $delete = $this->db->where('id', $id)->delete('tbl_kecamatan');
            $delete = $this->db->where('id', $id)->delete('tbl_kelurahan');
        } elseif ($tab == 'kelurahan') {
            $delete = $this->db->where('id', $id)->delete('tbl_kelurahan');
        }
        return $delete;
    }
    //TUTUP DELETE
}
