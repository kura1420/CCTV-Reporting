<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends READY_Controller {

	public $page = 'Report';

  	public function __construct()
  	{
    	parent::__construct();

    	if (empty($this->session->userdata('login'))): redirect(base_url('masuk')); endif;

    	$this->load->model('CrudModel');
    	$this->load->model('ReportModel');

    	$this->load->library('dswitch');
    	$this->load->library('counttime');
  	}

  	public function perissue()
  	{
  		if ($this->session->userdata('level') == 2) {
  			$data['listCctv'] = $this->db->query("SELECT * FROM account WHERE account_level = '3' AND delete_by = ''")->result();

  			$this->content = 'report/PerIssueView';

          	$this->layout(
            	(! empty($data)) ? $data : null,
            	$addCss = array(
              	'assets/css/ace.min.css',
              	'assets/css/ace-skins.min.css',
              	'assets/css/ace-rtl.min.css',
            	),
            	$addJs = array(
              	'assets/js/callJsMobile.js',
              	'assets/js/bootstrap.min.js',
              	'assets/js/ace-elements.min.js',
              	'assets/js/ace.min.js',
              	'assets/js/custome/Reportperissue.js'
            	)
          	);
  		} else {
  			show_404();
  		} 		
  	}

  	public function dataStore()
  	{
  		if ($this->session->userdata('level') == 2) {
  			try {
  					$account = $this->input->post('account_username');
  					$listStore = $this->db->query("SELECT * FROM store WHERE store_id IN (SELECT store_id FROM issue WHERE issue_cctv = '$account')")->result();

  					if (empty($listStore)) {
  						echo '<option value="">- Pilih Store -</option>';
  					} else {
  						echo '<option value="">- Pilih Store -</option>';

  						foreach ($listStore as $key => $value) {
  							echo '<option value="'.$value->store_id.'">'.ucfirst($value->store_name).'</option>';
  						}
  					}
  					  				
  			} catch (Exception $e) {
  				echo $e->getMessage();
  			}
  		} else {
  			show_404();
  		}  		
  	}

  	public function dataIssue()
  	{
  		if ($this->session->userdata('level') == 2) {
  			$account = $this->input->post('account_username');
  			$store = $this->input->post('store_id');

  			$listIssue = $this->db->query("SELECT * FROM issue WHERE issue_cctv = '$account' AND store_id = '$store'")->result();

  			if (empty($listIssue)) {
  				echo '<option value="">- Pilih Issue -</option>';
  			} else {
  				echo '<option value="">- Pilih Issue -</option>';

  				foreach ($listIssue as $key => $value) {
  					echo '<option value="'.$value->issue_id.'">'.ucfirst($value->issue_id).'</option>';
  				}
  			}  			
  		} else {
  			show_404();
  		}  		
  	}

    public function dataPerstore()
    {
      if ($this->session->userdata('level') == 2) {
        $account = $this->input->post('account_username');
        $store = $this->input->post('store_id');
        $issue = $this->input->post('issue_id');

        if ($account != '' && $store != '' && $issue != '') {
          $q = "SELECT 
              a.*,
              b.*
            FROM issue a
            INNER JOIN store b ON a.store_id = b.store_id
            WHERE a.issue_cctv = '$account' AND a.store_id = '$store' AND a.issue_id = '$issue'";
        } elseif ($account != '' && $store != '') {
          $q = "SELECT 
              a.*,
              b.*
            FROM issue a
            INNER JOIN store b ON a.store_id = b.store_id
            WHERE a.issue_cctv = '$account' AND a.store_id = '$store'";
        } else {
          $q = "SELECT 
              a.*,
              b.*
            FROM issue a
            LEFT JOIN store b ON a.store_id = b.store_id
            WHERE a.issue_cctv = '$account'";
        }
        

          $sql = $this->db->query($q)->result();

          try {
            if (! $sql) {
              throw new Exception("Error Processing Request", 1);
            } else {
              foreach ($sql as $key => $value) {
                echo '<tr>';
                  echo '<td>'.$value->store_name.'</td>';
                  echo '<td>'.$value->issue_id.'</td>';
                  echo '<td>'.$value->issue_title.'</td>';
                  echo '<td>'.$this->dswitch->statusCase($value->issue_status).'</td>';
                  echo '<td>'.$this->dswitch->statusPriority($value->issue_priority).'</td>';
                  echo '<td><a class="blue" target="_blank" href="'. base_url('report/printPdf/' . $value->issue_id) .'">
                                                                <i class="ace-icon fa fa-print bigger-130"></i>
                                                              </a></td>';
                echo '</tr>';
              }
            }
            
          } catch (Exception $e) {
            echo $e->getMessage();
          }
      } else {
        show_404();
      }
    }

    public function printPdf($id = FALSE) 
    {
      if ($this->session->userdata('level') == 2) {
        try {
          if (empty($id)) {
            throw new Exception("Error Processing Request", 1);
          } else {
            $data['row'] = $this->db->query("
              SELECT 
                a.*,
                b.*
              FROM issue a
              LEFT JOIN store b ON a.store_id = b.store_id
              WHERE a.issue_id = '$id'
            ")->row();

            $data['p'] = $this->db->get_where('account', array('account_username' => $data['row']->issue_pelapor))->row();
            $data['c'] = $this->db->get_where('account', array('account_username' => $data['row']->issue_cctv))->row();
            $data['m'] = $this->db->get_where('account', array('account_username' => $data['row']->issue_management))->row();

            $data['listPicPelapor'] = $this->db->query("SELECT * FROM issue_pic WHERE issue_id = '$id' AND pic_fromlevelaccount = 4")->result();

            $data['listPicCCTV'] = $this->db->query("SELECT * FROM issue_pic WHERE issue_id = '$id' AND pic_fromlevelaccount = 3")->result();

            if (! $data['row'] && ! $data['p'] && ! $data['c'] && ! $data['m']) {
              throw new Exception("Error Processing Request Get Data", 1);
            } else {
              ob_start();

              $this->load->view('report/PdfView', $data);

              $html = ob_get_contents();
              ob_end_clean();

              require_once('./assets/plugin/mpdf/mpdf.php');
              $pdf = new mPDF('utf-8', 'A4');
              $pdf->AddPage('P');
              $pdf->WriteHtml($html);
              $pdf->Output('PrintReport.pdf', 'I');
            }            
          }          
        } catch (Exception $e) {
          echo $e->getMessage();
        }
      } else {
        show_404();
      }      
    }




    public function evaluasi()
    {
      if ($this->session->userdata('level') == 2) {
        $data['tm'] = $this->ReportModel->countDiterima();
        $data['tk'] = $this->ReportModel->countDitolak();
        $data['tl'] = $this->ReportModel->countTidakLaporan();

        $lo = $this->ReportModel->countLaporanOutlet();
        foreach ($lo as $value) {
          $loJson[] = array(
            "name" => (string)$value->store_name,
            "y" => (int)$value->jml
          );
        }
        $data['loResult'] = json_encode($loJson);

        $data['itm'] = $this->ReportModel->countIssueTerima();
        $rctm = $this->ReportModel->resultCctvTerima();
        foreach ($rctm as $value) {
          $x = array(
            array($value->account_identity, (int)$value->terima),
          );
        }
        $data['rctmResult'] = json_encode($x);

        $data['itk'] = $this->ReportModel->countIssueDitolak();
        $rctk = $this->ReportModel->resultCctvTolak();
        foreach ($rctk as $value) {
          $y = array(
              array($value->account_identity, (int)$value->tolak),
          );
        }
        $data['rctkResult'] = json_encode($y);


        $this->content = 'report/EvaluasiView';

        $this->layout(
          (! empty($data)) ? $data : null,
          $addCss = array(
            'assets/css/ace.min.css',
            'assets/css/ace-skins.min.css',
            'assets/css/ace-rtl.min.css',
          ),
          $addJs = array(
            'assets/js/custome/ReportEvaluasi.js',
            'assets/js/callJsMobile.js',
            'assets/js/bootstrap.min.js',
            'assets/plugin/highcharts/highcharts.js',
            'assets/plugin/highcharts/modules/data.js',
            'assets/plugin/highcharts/modules/drilldown.js',
            'assets/js/ace-elements.min.js',
            'assets/js/ace.min.js'
          )
        );
      } else {
        show_404();
      }
      
    }

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */