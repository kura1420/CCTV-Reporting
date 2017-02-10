<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<table width="100%" border="0">
<tr>
	<td><img src="<?=base_url("assets/images/logo.jpg") ?>" width="150px" height="150px"></td>
	<td><h1><u><?=strtoupper("PT. Trans Coffee") ?></u></h1></td>
</tr>
</table>

<table border="1" width="100%" style="margin-top: 10px;">
	<tr>
		<td colspan="4" align="center" height="50px"><h3><?=strtoupper("CCTV Issue") ?></h3></td>
	</tr>
	<tr>
		<td width="200px"><b><?=strtoupper("ID Issue")?></b></td>
		<td width="150px"><?=$row->issue_id?></td>
		<td><b><?=strtoupper("Status") ?></b></td>
		<td><?=$this->dswitch->statusCase($row->issue_status)?></td>
	</tr>
	<tr>
		<td><b><?=strtoupper("Store")?></b></td>
		<td><?=ucfirst($row->store_name)?></td>
		<td><b><?=strtoupper("Tanggal Mulai")?></b></td>
		<td>
			<?php
			$x = strtotime($row->issue_start);
			echo date("d/m/Y", $x);
			?>
		</td>
	</tr>
	<tr>
		<td><b><?=strtoupper("Perihal")?></b></td>
		<td><?=ucfirst($row->issue_title)?></td>
		<td><b><?=strtoupper("Tanggal Selesai")?></b></td>
		<td>
			<?php
			$y = strtotime($row->issue_finish);

			echo date("d/m/Y", $y);
			?>
		</td>
	</tr>
	<tr>
		<td><b><?=strtoupper("Nama Pelapor")?></b></td>
		<td><?=ucfirst($p->account_identity)?></td>
		<td><b><?=strtoupper("Nama Pelanggan")?></b></td>
		<td><?=ucfirst($row->issue_customer)?></td>
	</tr>
	<tr><td height="20px" style="border: none;"></td></tr>
	<tr>
		<td><b><?=strtoupper("Keterangan Pelapor")?></b></td>
		<td colspan="3"><?=ucfirst($row->issue_notepelapor)?></td>
	</tr>
	<tr><td height="20px" style="border: none;"></td></tr>
	<tr>
		<td><b><?=strtoupper("Pic. CCTV")?></b></td>
		<td><?=ucfirst($c->account_identity)?></td>
		<td><b><?=strtoupper("Prioritas Issue")?></b></td>
		<td bgcolor="
		<?php 
		switch ($row->issue_priority) {
			case 0:
				echo '';
				break;

			case 1:
				echo 'blue';
				break;

			case 2:
				echo 'yellow';
				break;

			case 3:
				echo 'red';
				break;
			
			default:
				echo 'black';
				break;
		}
		?>
		"><?=$this->dswitch->statusPriority($row->issue_priority)?></td>
	</tr>
	<tr>
		<td height="20px" style="border: none;"></td>
	</tr>
	<tr>
		<td><b><?=strtoupper("Keterangan Admin CCTV")?></b></td>
		<td colspan="3"><?=$row->issue_notecctv?></td>
	</tr>
	<tr>
		<td height="20px" style="border: none;"></td>
	</tr>
	<tr>
		<td><b><?=strtoupper("Konfirmasi")?></b></td>
		<td><?=$this->dswitch->statusConfirm($row->issue_confirmstatus)?></td>
	</tr>
	<tr>
		<td height="20px" style="border: none;"></td>
	</tr>
	<tr>
		<td><b><?=strtoupper("Keterangan Management")?></b></td>
		<td colspan="3"><?=$row->issue_notemanagement?></td>
	</tr>
	<tr>
		<td height="20px" style="border: none;"></td>
	</tr>
	<tr>
		<td><b><?=strtoupper("Keterangan Laporan")?></b></td>
		<td colspan="3"><?=$row->issue_notelaporan?></td>
	</tr>
	<tr>
		<td><b><?=strtoupper("Lampiran Pelapor")?></b></td>
	</tr>
	<tr>
		<td></td>
		<?php 
		if (! empty($listPicPelapor)) {
			foreach ($listPicPelapor as $value) {
			echo '<td>';
				echo '<img src="'.base_url('uploads/' . $value->pic_name).'" width="100px" height="100px" />';
			echo '</td>';
			}
		}
		?>
	</tr>
	<tr>
		<td><b><?=strtoupper("Lampiran Laporan")?></b></td>
	</tr>
	<tr>
		<td></td>
		<?php 
		if (! empty($listPicCCTV)) {
			foreach ($listPicCCTV as $value) {
			echo '<td>';
				echo '<img src="'.base_url('uploads/' . $value->pic_name).'" width="100px" height="100px" />';
			echo '</td>';
			}
		}
		?>
	</tr>

</table>

</body>
</html>