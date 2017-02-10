<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->

    <h3 class="header smaller lighter blue"><?=ucfirst($this->page)?></h3>

    <div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>ID</th>
														<th>Nama</th>
														<th>Email</th>
                            <th>Telp</th>
														<th>Aksi</th>
													</tr>
												</thead>

												<tbody>
                          <?php
                          foreach ($listStore as $value) {
                            echo '<tr>';
                              echo '<td>'. ucfirst($value->store_id) .'</td>';
                              echo '<td>'. ucfirst($value->store_name) .'</td>';
                              echo '<td>'. ucfirst($value->store_email).'</td>';
                              echo '<td>'. ucfirst($value->store_telp).'</td>';
                              echo '<td>
                              <div class="hidden-sm hidden-xs action-buttons">
                              																<a class="blue" href="'. base_url('dataterhapus/storelihat/' . $value->store_id) .'">
                              																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
                              																</a>

                              																<a class="green" href="'. base_url('dataterhapus/storekembalikan/' . $value->store_id) .'">
                              																	<i class="ace-icon fa fa-check-square-o bigger-130"></i>
                              																</a>
                              															</div>
                              </td>';
                            echo '</tr>';
                          }
                          ?>
												</tbody>
											</table>
										</div>

    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->
