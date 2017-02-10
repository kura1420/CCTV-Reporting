<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudModel extends CI_Model
{

  public function genId($id, $table, $format, $cut)
  {
    $table = $this->db->query("SELECT $id FROM $table")->result();

    if (count($table) == 0) {
      $x = 1;
    } else {
      $countRecord  = count($table) - 1;

      foreach ($table as $value) {
        $z[] = substr($value->$id, $cut);
      }
      sort($z);

      $x = $z[$countRecord] + 1;
    }

    $r = $format . $x;

    return $r;
  }

  public function listData($table)
  {
    return $this->db->get_where($table, array('delete_by' => ''));
  }

  public function saveData($table, $data)
  {
    $this->db->insert($table, $data);
  }

  public function whereData($table, $id, $x)
  {
    return $this->db->get_where($table, array($id => $x));
  }

  public function updateData($id, $x, $table, $data)
  {
    $this->db->where($id, $x);
    $this->db->update($table, $data);
  }

  public function listDataTrash($table) {
    $query = $this->db->query("SELECT * FROM $table WHERE delete_by != ''");

    return $query;
  }

}
