<?php
class LevelModel extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('tbl_level')->result_array();
    }
    public function get_level($id)
    {
        return $this->db->get_where('tbl_level', ['id' => $id])->row_array();
    }
    public function level_old($id, $level)
    {
        return $this->db->query("SELECT COUNT(*) AS jml FROM tbl_level WHERE id='$id' AND `level`='$level'")->row_array();
    }
    public function level_exist($level)
    {
        return $this->db->query("SELECT COUNT(*) AS jml FROM tbl_level WHERE `level`='$level'")->row_array();
    }
    public function pilih_level($keyword)
    {
        if (!empty($keyword)) {
            $like = " AND `level` LIKE '%" . $keyword . "%' ";
        } else {
            $like = "";
        }
        return $this->db->query("SELECT id, `level` FROM tbl_level WHERE id <> '' $like ORDER BY `level` ASC")->result_array();
    }
    public function add($level)
    {
        $data = [
            'level' => $level
        ];
        $this->db->insert('tbl_level', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    public function update($id, $level)
    {
        $data = [
            'level' => $level
        ];
        return $this->db->where('id', $id)->update('tbl_level', $data);
    }
    public function delete($id)
    {
        return $this->db->where('id', $id)->delete("tbl_level");
    }
}
