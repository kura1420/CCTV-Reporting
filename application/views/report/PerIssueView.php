<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <h3 class="header smaller lighter blue"><?=ucfirst($this->page . ucfirst(" Per-Issue"))?></h3>

    <form class="form-horizontal" id="fm" method="post">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-1 control-label">CCTV</label>
                    <div class="col-sm-2">
                      <?php 
                      $options[''] = '- Pilih CCTV -';
                        foreach ($listCctv as $value) {
                          $options[$value->account_username] = ucfirst($value->account_identity);
                        }

                      echo form_dropdown('account_username', $options, '', 'class="form-control" id="account_username"');
                      ?>
                    </div>

                    <label for="inputEmail3" class="col-sm-1 control-label">Store</label>
                    <div class="col-sm-3">
                      <select class="form-control" id="store_id" name="store_id">
                        <option value="">- Pilih Store -</option>
                      </select>
                    </div>

                    <label for="inputEmail3" class="col-sm-1 control-label">ID Issue</label>
                    <div class="col-sm-2">
                      <select class="form-control" id="issue_id" name="issue_id">
                        <option value="">- Pilih ID Issue -</option>
                      </select>
                    </div>

                    <button id="btnLoadData" class="btn btn-sm btn-primary" type="button">Load Data</button>
                  </div>
								</form>

                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Store</th>
                      <th>ID Issue</th>
                      <th>Judul</th>
                      <th>Status Issue</th>
                      <th>Prioritas</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody id="resultData"></tbody>
                </table>

    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->

<script>
  var getStore = '<?=base_url("report/dataStore")?>';
  var getIssue = '<?=base_url("report/dataIssue")?>';
  var getData = '<?=base_url("report/dataPerstore")?>';
</script>