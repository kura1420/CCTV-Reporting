<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <h3 class="header smaller lighter blue"><?=ucfirst($this->page)?> <button onClick="location.href='<?=base_url("pengguna")?>'" class="btn btn-minier btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></h3>

    <?=form_open("pengguna/tambah/", array('class' => 'form-horizontal'))?>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Identitas</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Identitas" value="<?=set_value('account_identity')?>" name="account_identity">
                      <div style="color: red;"><?=form_error('account_identity')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Username" value="<?=set_value('account_username')?>" name="account_username">
                      <div style="color: red;"><?=form_error('account_username')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-5">
                      <input type="password" class="form-control" id="inputEmail3" placeholder="Password" name="account_password">
                      <div style="color: red;"><?=form_error('account_password')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tingkat</label>
                    <div class="col-sm-5">
                      <select class="form-control" name="account_level">
                        <option value="">- Pilih Tingkat -</option>
                        <!-- <option value="1">Administrator</option> -->
                        <option value="2">Management</option>
                        <option value="3">CCTV</option>
                        <option value="4">Pelapor</option>
                      </select>
                      <div style="color: red;"><?=form_error('account_level')?></div>
                    </div>
                  </div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Simpan
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Ulangi
											</button>
										</div>
									</div>
								<?=form_close()?>
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->
