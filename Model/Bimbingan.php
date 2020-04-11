<?php
require_once("./Config/Koneksi.php");

class Bimbingan extends Koneksi
{
    private $table = "tbl_bimbingan";

    public function construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $sql = $this->conn->query("SELECT * FROM {$this->table}");
        return $sql->fetchAll();
    }
    
    function delete($id)
    {
        $deleted = $this->conn->query("DELETE FROM {$this->table} WHERE id = '{$id}'");
        return ($deleted > 0);
    }

    function addBimbingan($data = array())
    {
        $fieldname = implode(",", array_keys($data)); //implode : fungsi untuk mengubah array mjd string dang menyambung nya dengan karakter tertentu 
        $fiedlvalue = "";
        foreach ($data as $key => $val) {
            $fiedlvalue = ($fiedlvalue == "") ? "?" : $fiedlvalue . ", ?";
        }

        $sql = "INSERT INTO " . $this->table . " (" . $fieldname . ") values (" . $fiedlvalue . ")";
        $q = $this->conn->prepare($sql);
        $q->execute(array_values($data));

        return ($this->conn->lastInsertId() > 0) ? true : false;
    }

    function editBimbingan($id, $data = array())
    {
        $dataset = "";
        foreach ($data as $key => $val) {
            $dataset = ($dataset == "") ? $key . " = ?" : $dataset . ", " . $key . " = ?";
        }
        $sql = "UPDATE " . $this->table . " SET " . $dataset . " WHERE id = " . $id;
        $q = $this->conn->prepare($sql);
        $q->execute(array_values($data));

        return ($q->rowCount() > 0) ? true : false;
    }
}
