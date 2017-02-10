<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportModel extends CI_Model {

	public function countDiterima()
	{
		$sql = "SELECT COUNT(*) AS selesai FROM issue WHERE issue_status = 3";

		return $this->db->query($sql)->row();
	}

	public function countDitolak()
	{
		$sql = "SELECT COUNT(*) AS tolak FROM issue WHERE issue_status = 4";

		return $this->db->query($sql)->row();
	}

	public function countTidakLaporan()
	{
		$sql = "SELECT COUNT(*) AS tidaklaporan FROM store WHERE store_id NOT IN (SELECT store_id FROM issue)";

		return $this->db->query($sql)->row();
	}

	public function countLaporanOutlet()
	{
		$sql = "SELECT
				a.store_name,
				(SELECT COUNT(*) FROM issue WHERE store_id = a.store_id) AS jml
				FROM store a";

		return $this->db->query($sql)->result();
	}

	public function countIssueTerima()
	{
		$sql = "SELECT COUNT(*) AS terima FROM issue WHERE issue_status = 1";

		return $this->db->query($sql)->row();
	}

	public function countIssueDitolak()
	{
		$sql = "SELECT COUNT(*) AS tolak FROM issue WHERE issue_status = 4";

		return $this->db->query($sql)->row();
	}

	public function resultCctvTerima()
	{
		$sql = "SELECT
				a.account_identity,
				(SELECT COUNT(*) FROM issue WHERE issue_cctv = a.account_username AND issue_status = 1) as terima
				FROM account a
				WHERE a.account_level = 3";

		return $this->db->query($sql)->result();
	}

	public function resultCctvTolak()
	{
		$sql = "SELECT
				a.account_identity,
				(SELECT COUNT(*) FROM issue WHERE issue_cctv = a.account_username AND issue_status = 4) as tolak
				FROM account a
				WHERE a.account_level = 3";

		return $this->db->query($sql)->result();
	}

}

/* End of file ReportModel.php */
/* Location: ./application/models/ReportModel.php */