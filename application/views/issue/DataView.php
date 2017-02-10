<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->

    <h3 class="header smaller lighter blue"><?=ucfirst($this->page)?>
      <!-- <button onClick="window.history.back()" class="btn btn-minier btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button> -->
      <a href="<?=base_url('issue')?>" class="btn btn-minier btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php 
switch ($this->session->userdata('level')) {
    case 2:
        if (! empty($row->issue_cctv) && empty($row->issue_management)) {
            echo '<a href="'.base_url("issue/tanggapi/".$row->issue_id).'" class="btn btn-minier btn-success"><span class="glyphicon glyphicon-pencil"></span> Tanggapi</a>';
        }
        break;

    case 3:
        if (empty($row->issue_cctv)) {
            echo '<a href="'.base_url("issue/konfirmasi/".$row->issue_id).'" class="btn btn-minier btn-warning"><span class="glyphicon glyphicon-pencil"></span> Konfirmasi</a>';
        }

        if (! empty($row->issue_cctv) && ! empty($row->issue_management) && empty($row->issue_finish)) {
            echo '<a href="'.base_url("issue/laporan/".$row->issue_id).'" class="btn btn-minier btn-danger"><span class="glyphicon glyphicon-pencil"></span> Laporan</a>';
        }
        break;
    
    default:
        echo '';
        break;
}
?>

      </h3>

    <div>
                                        <div id="user-profile-1" class="user-profile row">

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="profile-user-info profile-user-info-striped">
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> ID Issue </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->store_id)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Store </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->store_name)?></span>
                                                        </div>
                                                    </div>

                            <div class="profile-info-row">
                                                        <div class="profile-info-name"> Judul </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_title)?></span>
                                                        </div>
                                                    </div>

                            <div class="profile-info-row">
                                                        <div class="profile-info-name"> Pelanggan </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_customer)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Pelapor </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->account_identity)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Pic. CCTV </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_cctv)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Tanggal Laporan Issue</div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_start)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Tanggal Selesai Issue </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_finish)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Status Issue </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username">
<?=$this->dswitch->statusCase($row->issue_status)?>
                                                            </span>
                                                        </div>
                                                    </div>

<?php if ($this->session->userdata('level') != 4): ?>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Status Prioritas </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username">
<?=$this->dswitch->statusPriority($row->issue_priority)?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Status Konfirmasi </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username">
<?=$this->dswitch->statusConfirm($row->issue_confirmstatus)?>
                                                            </span>
                                                        </div>
                                                    </div>
<?php endif; ?>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Keterangan Pelapor </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_notepelapor)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Gambar Pelapor </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username">
                                                                <?php
                                                                if (! empty($listPicPelapor)) {
                                                                    foreach ($listPicPelapor as $value) {
                                                                    echo '<a href="'.base_url('uploads/' . $value->pic_name).'">';
                                                                        echo '<img src="'.base_url('uploads/' . $value->pic_name).'" width="200px" height="150px"" style="border: 1px solid blue"/> ';
                                                                    echo '</a>';
                                                                    }
                                                                }
                                                                ?>
                                                                
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Keterangan CCTV </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_notecctv)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Keterangan Management </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_notemanagement)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Keterangan Laporan </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->issue_notelaporan)?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Gambar Laporan </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username">
                                                                <?php
                                                                if (! empty($listPicCCTV)) {
                                                                    foreach ($listPicCCTV as $value) {
                                                                    echo '<a href="'.base_url('uploads/' . $value->pic_name).'">';
                                                                        echo '<img src="'.base_url('uploads/' . $value->pic_name).'" width="200px" height="150px"" style="border: 1px solid blue"/> ';
                                                                    echo '</a>';
                                                                    }
                                                                }
                                                                ?>
                                                                
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <?php if ($this->session->userdata('level') == 2): ?>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Total Waktu Pengerjaan Issue </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username">
                                                            <?php
                                                            if (! empty($row->issue_finish)) {
                                                                echo $this->counttime->countCaseTime($row->issue_start, $row->issue_finish);
                                                            }
                                                            ?></span>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->
