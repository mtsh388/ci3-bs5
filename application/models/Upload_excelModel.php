<?php
class Upload_excelModel extends CI_Model
{
    public function get_detail()
    {
        return $this->db->get('tbl_excel_detail')->result_array();
    }
    public function insert_detail($trans)
    {
        $data = $this->db->get_where('tbl_excel_temp', ['trans' => $trans])->result_array();
        foreach ($data as $data) {
            $a = $data['a'];
            $b = $data['b'];
            $c = $data['c'];
            $d = $data['d'];
            $isi = [
                'a' => $a,
                'b' => $b,
                'c' => $c,
                'd' => $d,
            ];
            $detail = $this->db->query("SELECT COUNT(*) AS jml FROM tbl_excel_detail WHERE a='$a'")->row_array();
            if ($detail['jml'] > 0) {
                $action = $this->db->where('a', $a)->update('tbl_excel_detail', $isi);
            } else {
                $action = $this->db->insert('tbl_excel_detail', $isi);
            }
        }
        if ($action) {
            return true;
        } else {
            return false;
        }
    }
    public function insertTemp($a, $b, $c, $d, $trans)
    {
        $data_insert = [
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'd' => $d,
            'trans' => $trans
        ];
        $this->db->insert('tbl_excel_temp', $data_insert);
        if ($a == '' || $b == '' || $c == '' || $d == '') {
            $notes = 'Field blank';
        } else {
            $duplicate = $this->db->query("SELECT COUNT(*) jml FROM tbl_excel_temp WHERE a='$a' AND b='$b' AND c='$c' AND d='$d' AND trans='$trans'")->row_array();
            if ($duplicate['jml'] > 1) {
                $notes = 'Duplicate record';
            } else {
                $exist = $this->db->query("SELECT COUNT(*) jml FROM tbl_excel_detail WHERE a='$a'")->row_array();
                if ($exist['jml'] > 0) {
                    $notes = 'Already exist';
                } else {
                    $notes = 'OK';
                }
            }
        }
        $update = [
            'notes' => $notes
        ];
        return $this->db->where('a', $a)->where('trans', $trans)->update('tbl_excel_temp', $update);
    }
    public function delete_temp($trans)
    {
        return $this->db->where('trans', $trans)->delete('tbl_excel_temp');
    }
    public function lastid()
    {
        $id = $this->db->query("SELECT MAX(trans)  AS lastid FROM tbl_excel_temp")->row_array();
        $lastid = $id['lastid'] + 1;
        return $lastid;
    }
    public function serverside_temp($trans, $order, $dir, $start, $length)
    {

        $sql = "SELECT id,trans,notes,COUNT(*) AS qty 
		FROM tbl_excel_temp
		WHERE trans = '$trans'
		GROUP BY notes";

        if (!empty($order)) {

            $sql .= " ORDER BY $order $dir";
        }
        if ($start != NULL) {

            $sql .= " limit $start , $length";
        }

        return $this->db->query($sql)->result_array();
    }
    public function count_notes($trans)
    {
        return $this->db->query("SELECT (SELECT COUNT(*) FROM tbl_excel_temp WHERE notes = 'OK' AND trans='$trans') AS ok, (SELECT COUNT(*) FROM tbl_excel_temp WHERE trans='$trans') AS jml")->row_array();
    }
    public function get_data_result_temp($id)
    {

        $query = $this->db->prepare("SELECT idTrans,notes,COUNT(*) AS total 
		FROM tbl_netlog_main_table_mb51_detail_temp
		WHERE idTrans = ?
		GROUP BY notes");
        $query->bindValue(1, $id);
        try {
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }
}
