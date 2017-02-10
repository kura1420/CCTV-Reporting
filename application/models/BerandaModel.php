<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BerandaModel extends CI_Model
{
	
	public function listLastIssue() {
		$sql = $this->db->query("
	       SELECT 
	         B.store_name,
	         A.issue_priority,
	         A.issue_status
	       FROM issue A 
	       LEFT JOIN store B ON A.store_id = B.store_id 
	       ORDER BY A.issue_id DESC LIMIT 5
	    ")->result();

	    return $sql;
	}

	public function summaryStatusIssue() {
		$sql = $this->db->query("
			SELECT 
        	*
        	FROM 
        	(
        		(SELECT COUNT(*) AS menunggu FROM issue WHERE issue_status = 0) AS menunggu,
          		(SELECT COUNT(*) AS 'di terima' FROM issue WHERE issue_status = 1) AS diterima,
          		(SELECT COUNT(*) AS 'di proses' FROM issue WHERE issue_status = 2) AS diproses,
          		(SELECT COUNT(*) AS selesai FROM issue WHERE issue_status = 3) AS selesai,
          		(SELECT COUNT(*) AS 'di tolak' FROM issue WHERE issue_status = 4) AS ditolak
        	)
      	")->result();

      	return $sql;
	}

}