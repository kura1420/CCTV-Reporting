<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->

    <h3 class="header smaller lighter blue"><?=ucfirst($this->page)?> <button onClick="location.href='<?=base_url("pengguna")?>'" class="btn btn-minier btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button> <button onClick="location.href='<?=base_url("pengguna/perbarui/" . $row->account_username)?>'" class="btn btn-minier btn-warning"><span class="glyphicon glyphicon-edit"></span> Perbarui</button></h3>

    <div>
    									<div id="user-profile-1" class="user-profile row">
    										<div class="col-xs-12 col-sm-3 center">
    											<div>
    												<span class="profile-picture">
    													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?=base_url('assets/images/avatars/profile-pic.jpg')?>" />
    												</span>

    												<div class="space-4"></div>

    												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
    													<div class="inline position-relative">
    														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
    															<i class="ace-icon fa fa-circle light-green"></i>
    															&nbsp;
    															<span class="white"><?=ucfirst($row->account_identity)?></span>
    														</a>
    													</div>
    												</div>
    											</div>
    										</div>

    										<div class="col-xs-12 col-sm-9">
    											<div class="profile-user-info profile-user-info-striped">
    												<div class="profile-info-row">
    													<div class="profile-info-name"> Username </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?=ucfirst($row->account_username)?></span>
    													</div>
    												</div>

    												<div class="profile-info-row">
    													<div class="profile-info-name"> Tingkat </div>

    													<div class="profile-info-value">
                                <?php
                                switch ($row->account_level) {
                                  case 1:
                                    echo ucfirst('Root');
                                    break;

                                  case 2:
                                    echo ucfirst('Management');
                                    break;

                                  case 3:
                                    echo ucfirst('CCTV');
                                    break;

                                  case 4:
                                    echo ucfirst('Pelapor');
                                    break;

                                  default:
                                    echo 'User belum diberi hak akses level';
                                    break;
                                }
                                ?>
    													</div>
    												</div>

                            <div class="profile-info-row">
    													<div class="profile-info-name"> Create By </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?=ucfirst($row->create_by)?></span>
    													</div>
    												</div>

                            <div class="profile-info-row">
    													<div class="profile-info-name"> Create Date </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?php if ($row->create_date != '0000-00-00 00:00:00'): echo $row->create_date; endif;?></span>
    													</div>
    												</div>

                            <div class="profile-info-row">
    													<div class="profile-info-name"> Update By </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?=ucfirst($row->update_by)?></span>
    													</div>
    												</div>

                            <div class="profile-info-row">
    													<div class="profile-info-name"> Update Date </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?php if ($row->update_date != '0000-00-00 00:00:00'): echo $row->update_date; endif;?></span>
    													</div>
    												</div>

    											</div>
    										</div>
    									</div>
    								</div>
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->
