<?php
class PdfModel extends CI_Model
{
    public function download_pdf()
    {
        return $this->db->get("tbl_user")->result_array();
    }
}
