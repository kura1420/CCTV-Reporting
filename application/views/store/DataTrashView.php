<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->

    <h3 class="header smaller lighter blue"><?=ucfirst($this->page)?>
      <button onClick="location.href='<?=base_url("dataterhapus/store")?>'" class="btn btn-minier btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></h3>

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
    															<span class="white"><?=ucfirst($row->store_name)?></span>
    														</a>
    													</div>
    												</div>
    											</div>
    										</div>

    										<div class="col-xs-12 col-sm-9">
    											<div class="profile-user-info profile-user-info-striped">
    												<div class="profile-info-row">
    													<div class="profile-info-name"> ID Store </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?=ucfirst($row->store_id)?></span>
    													</div>
    												</div>

                            <div class="profile-info-row">
    													<div class="profile-info-name"> Nama </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?=ucfirst($row->store_name)?></span>
    													</div>
    												</div>

                            <div class="profile-info-row">
    													<div class="profile-info-name"> Email </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?=ucfirst($row->store_email)?></span>
    													</div>
    												</div>

                            <div class="profile-info-row">
    													<div class="profile-info-name"> Telp </div>

    													<div class="profile-info-value">
    														<span class="editable" id="username"><?=ucfirst($row->store_telp)?></span>
    													</div>
    												</div>

    												<div class="profile-info-row">
    													<div class="profile-info-name"> Pelapor </div>

    													<div class="profile-info-value">
                                <?php
                                foreach ($listPelapor as $value) {
                                  echo ucfirst($value->account_identity) . ', ';
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

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Detele By </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?=ucfirst($row->delete_by)?></span>
                                                        </div>
                                                    </div>

                            <div class="profile-info-row">
                                                        <div class="profile-info-name"> Detele Date </div>

                                                        <div class="profile-info-value">
                                                            <span class="editable" id="username"><?php if ($row->delete_date != '0000-00-00 00:00:00'): echo $row->delete_date; endif;?></span>
                                                        </div>
                                                    </div>

    											</div>
    										</div>
    									</div>
    								</div>
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->
