<?php
class UsersModel extends CI_Model
{
    public function getAll($where = null)
    {
        if ($where) {
            return $this->db->get('tbl_user')->where($where)->result_array();
        } else {
            return $this->db->get('tbl_user')->result_array();
        }
    }
    public function getWhere($iduser)
    {
        return $this->db->get('tbl_user', ['id' => $iduser])->row_array();
    }
    public function table($id, $search, $order, $dir, $start, $length)
    {
        if ($id == 'users') {
            $sql = "SELECT a.nama_lengkap, a.username, a.email, a.aktif, b.level, a.jalan, c.kelurahan, d.kecamatan, e.kota, f.provinsi, a.id 
                    FROM tbl_user a 
                    JOIN tbl_level b 
                    ON a.idlevel=b.id 
                    JOIN tbl_kelurahan c 
                    ON a.idkelurahan=c.id
                    JOIN tbl_kecamatan d
                    ON a.idkecamatan=d.id
                    JOIN tbl_kota e
                    ON a.idkota=e.id
                    JOIN tbl_provinsi f
                    ON a.idprovinsi=f.id  
                    WHERE a.id IS NOT NULL";
            if (!empty($search)) {
                $sql .= " AND nama_lengkap LIKE '$search' 
                          OR username LIKE '$search'
                          OR email LIKE '$search'
                          OR aktif LIKE '$search'
                          OR `level` LIKE '$search'
                          OR jalan LIKE '$search'
                          OR kelurahan LIKE '$search'
                          OR kecamatan LIKE '$search'
                          OR kota LIKE '$search'
                          OR provinsi LIKE '$search'
                        ";
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

    public function data_user($id)
    {
        return $this->db->select("a.*, b.level, a.jalan, c.kelurahan, d.kecamatan, e.kota, f.provinsi")
            ->from("tbl_user a")
            ->join("tbl_level b", "a.idlevel=b.id")
            ->join("tbl_kelurahan c", "a.idkelurahan=c.id")
            ->join("tbl_kecamatan d", "a.idkecamatan=d.id")
            ->join("tbl_kota e", "a.idkota=e.id")
            ->join("tbl_provinsi f", "a.idprovinsi=f.id")
            ->where('a.id', $id)
            ->get()
            ->row_array();
    }
}
