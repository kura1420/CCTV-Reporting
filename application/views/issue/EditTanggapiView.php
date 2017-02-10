<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    
    <div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <h3 class="header smaller lighter blue"><?=ucfirst($this->page)?></h3>

    <?=form_open("issue/tanggapi/" . $row->issue_id, array('class' => 'form-horizontal'))?>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Identitas" value="<?=$row->issue_id?>" name="issue_id" readonly="readonly">
                      <div style="color: red;"><?=form_error('issue_id')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pelapor</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Identitas" value="<?=$row->account_identity?>" name="account_identity" readonly="readonly">
                      <div style="color: red;"><?=form_error('account_identity')?></div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Store</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Identitas" value="<?=$row->store_name?>" name="store_id" readonly="readonly">
                      <div style="color: red;"><?=form_error('store_id')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Identitas" value="<?=$row->issue_title?>" name="issue_title" readonly="readonly">
                      <div style="color: red;"><?=form_error('issue_title')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pelanggan</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Pelanggan" value="<?=$row->issue_customer?>" name="issue_customer" readonly="readonly">
                      <div style="color: red;"><?=form_error('issue_customer')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Pelapor</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="8" name="issue_notepelapor" readonly><?=$row->issue_notepelapor?></textarea>
					  <div style="color: red;"><?=form_error('issue_notepelapor')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Status Prioritas</label>
                    <div class="col-sm-5">
<?=$this->dswitch->statusPriority($row->issue_priority)?>
                      <div style="color: red;"><?=form_error('issue_priority')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Keterangan CCTV</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="8" name="issue_notecctv" readonly><?=$row->issue_notecctv?></textarea>
            <div style="color: red;"><?=form_error('issue_notecctv')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Konfirmasi</label>
                    <div class="col-sm-5">
                      <?php 
                      $options = array(
                        '' => '- Pilih -',
                        '1' => 'Terima',
                        '2' => 'Tolak'
                      );
                      echo form_dropdown('issue_confirmstatus', $options, '', 'class="form-control"');
                      ?>
                      <div style="color: red;"><?=form_error('issue_confirmstatus')?></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Management</label>
                    <div class="col-sm-8">
                      <textarea class="form-control editor1" rows="8" name="issue_notemanagement"></textarea>
            <div style="color: red;"><?=form_error('issue_notemanagement')?></div>
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
