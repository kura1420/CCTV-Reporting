<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <h3 class="header smaller lighter blue"><?=ucfirst($this->page)?> <button onClick="location.href='<?=base_url("store")?>'" class="btn btn-minier btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></h3>

    <?=form_open("store/tambah/", array('class' => 'form-horizontal'))?>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Identitas" value="<?=$genId?>" name="store_id" readonly="readonly">
                      <div style="color: red;"><?=form_error('store_id')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Nama" value="<?=set_value('store_name')?>" name="store_name">
                      <div style="color: red;"><?=form_error('store_name')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-5">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?=set_value('store_email')?>" name="store_email">
                      <div style="color: red;"><?=form_error('store_email')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Telp</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Telp" value="<?=set_value('store_telp')?>" name="store_telp">
                      <div style="color: red;"><?=form_error('store_telp')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pelapor</label>
                    <div class="col-sm-5">
                      <?php
                      $options[''] = '- Pilih Pelapor -';
                      foreach ($listPelapor as $value) {
                        $options[$value->account_username] = ucfirst($value->account_identity);
                      }

                      echo form_dropdown('account_username', $options, '', 'class="form-control"');
                      ?>
                      <div style="color: red;"><?=form_error('account_username')?></div>
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
