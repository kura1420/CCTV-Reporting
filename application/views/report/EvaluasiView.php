<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    
    <div class="row">
									<div class="col-sm-6">
										<div class="widget-box transparent">
											<div class="widget-body">
												<div class="widget-main no-padding">
													<div id="chart1" style="min-width: 310px; height: 260px; margin: 0 auto"></div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->

									<div class="col-sm-6">
										<div class="widget-box transparent">
											<div class="widget-body">
												<div class="widget-main no-padding">
													<div id="chart2" style="min-width: 310px; height: 260px; margin: 0 auto"></div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div>
								</div><!-- /.row -->

	<div class="row">
									<div class="col-sm-6">
										<div class="widget-box transparent">
											<div class="widget-body">
												<div class="widget-main no-padding">
													<div id="chart3" style="min-width: 310px; height: 260px; margin: 0 auto"></div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->

									<div class="col-sm-6">
										<div class="widget-box transparent">
											<div class="widget-body">
												<div class="widget-main no-padding">
													<div id="chart4" style="min-width: 310px; height: 260px; margin: 0 auto"></div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div>
								</div>

    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->

<?php 
echo $itk->tolak;
?>

<script>
	var selesai = <?=$tm->selesai?>;
	var tolak = <?=$tk->tolak?>;
	var tidaklaporan = <?=$tl->tidaklaporan ?>;
	var peroutlet = <?=$loResult?>;
	var issueterima = <?=$itm->terima?>;
	var drillissueterima = <?=$rctmResult?>;
	var issuetolak = <?=$itk->tolak?>;
	var drillissuetolak = <?=$rctkResult?>;
</script>