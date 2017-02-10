<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    
    <div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <h3 class="header smaller lighter blue"><?=ucfirst($this->page)?></h3>

    <?=form_open_multipart("issue/tambah/", array('class' => 'form-horizontal'))?>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Identitas" value="<?=$genId?>" name="issue_id" readonly="readonly">
                      <div style="color: red;"><?=form_error('issue_id')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Store</label>
                    <div class="col-sm-5">
                      <?php 
                      $options[''] = '- Pilih -';
                      foreach ($listStore as $values) {
                        $options[$values->store_id] = ucfirst($values->store_name);
                      }
                      echo form_dropdown('store_id', $options, '', 'class="form-control"');
                      ?>
                      <div style="color: red;"><?=form_error('store_id')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Judul" value="<?=set_value('issue_title')?>" name="issue_title">
                      <div style="color: red;"><?=form_error('issue_title')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pelanggan</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Pelanggan" value="<?=set_value('issue_customer')?>" name="issue_customer">
                      <div style="color: red;"><?=form_error('issue_customer')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea class="form-control editor1" rows="8" name="issue_notepelapor"></textarea>
					  <div style="color: red;"><?=form_error('issue_notepelapor')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                  <label for="add" class="col-sm-2 control-label">Tambah Gambar</label>
                    <div class="col-sm-7">
                        <table class="table" width="100%" id="tblImg">
                            <tr>
                                <td>Upload Gambar:</td>
                                <td>Aksi</td>
                            </tr>
                            <tr>
                                <td><input type="file" name="pic_name[]" class="form-control" /></td>
                                <td><a href="javascript:void(0);" id="addImg" class="btn btn-success btn-sm">Tambah Upload</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                  </div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Kirim
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


    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->
