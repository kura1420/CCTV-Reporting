<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
					<li class="<?php if ($this->uri->segment(1) == 'beranda'): echo 'active'; else: null; endif; ?>">
						<a href="<?=base_url('beranda')?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Beranda </span>
						</a>

						<b class="arrow"></b>
					</li>

					<?php if ($this->session->userdata('level') == 4): ?>
					<li class="<?php if ($this->uri->segment(1) == 'issue' && $this->uri->segment(2) == 'tambah'): echo 'active'; else: null; endif; ?>">
						<a href="<?=base_url('issue/tambah/')?>">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Buat Issue </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="<?php if ($this->uri->segment(1) == 'issue' && $this->uri->segment(2) == 'issuestore' || $this->uri->segment(1) == 'issue' && $this->uri->segment(2) == 'lihat'): echo 'active'; else: null; endif; ?>">
						<a href="<?=base_url('issue/liststore/')?>">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> List Issue </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php endif; ?>

					<?php if ($this->session->userdata('level') < 4): ?>
					<li class="<?php if ($this->uri->segment(1) == 'issue'): echo 'active open'; else: null; endif; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Issue </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url('issue/listbaru/')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Issue Baru
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url('issue/listkonfirmasi/')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Konfirmasi Issue
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url('issue/listproses/')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Proses Issue
								</a>

								<b class="arrow"></b>
							</li>

              <li class="">
								<a href="<?=base_url('issue/listselesai/')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Issue Selesai
								</a>

								<!-- <li class="">
								<a href="<?=base_url('issue/listditolak/')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Issue Ditolak
								</a>

								<b class="arrow"></b>
							</li> -->
						</ul>
					</li>
					<?php endif; ?>

					<?php if ($this->session->userdata('level') == 2): ?>
					<li class="<?php if ($this->uri->segment(1) == 'report'): echo 'active open'; else: null; endif; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text"> Report </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url('report/perissue/')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Report Per Issue
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?=base_url('report/evaluasi/')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Report Evaluasi
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<?php endif; ?>

					<?php if ($this->session->userdata('level') == 3): ?>
					<li class="<?php if ($this->uri->segment(1) == 'pengguna' || $this->uri->segment(1) == 'store'): echo 'active open'; else: null; endif; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-gear"></i>
							<span class="menu-text"> Pengaturan </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url('pengguna')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pengguna
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url('store')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Store
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="<?php if ($this->uri->segment(1) == 'dataterhapus'): echo 'active open'; else: null; endif; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-trash"></i>
							<span class="menu-text"> Data Terhapus </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url('dataterhapus/pengguna')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pengguna
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url('dataterhapus/store')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Store
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<?php endif; ?>

				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
