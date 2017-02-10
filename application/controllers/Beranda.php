<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends READY_Controller
{

  public $page = 'Beranda';

  public function __construct()
  {
    parent::__construct();

    if (empty($this->session->userdata('login'))): redirect(base_url('masuk')); endif;

    $this->load->model('CrudModel');
    $this->load->model('BerandaModel');
    $this->load->library('dswitch');
  }

  public function index()
  {
    switch ($this->session->userdata('level')) {
      case 1:
        redirect(base_url('beranda/aplikasi'), 'refresh');
        break;

      case 2:
        redirect(base_url('beranda/management'), 'refresh');
        break;

      case 3:
        redirect(base_url('beranda/cctv'), 'refresh');
        break;

      case 4:
        redirect(base_url('beranda/pelapor'), 'refresh');
        break;

      default:
        redirect(base_url('masuk'), 'refresh');
        break;
    }
  }

  public function aplikasi()
  {
    if ($this->session->userdata('level') == 1) {
      $data['listIssueTerbaru'] = $this->BerandaModel->listLastIssue();

      $ssi = $this->BerandaModel->summaryStatusIssue();
      foreach ($ssi[0] as $key => $value) {
        $rssi[] = array(
          'name' => ucfirst($key),
          'y' => (int)$value
        );
      }
      $data['summaryStatusIssue'] = json_encode($rssi);

      $this->content = 'beranda/IndexAplikasiView';

      $this->layout(
        (! empty($data)) ? $data : null,
        $addCss = array(
          'assets/css/ace.min.css',
          'assets/css/ace-skins.min.css',
          'assets/css/ace-rtl.min.css',
        ),
        $addJs = array(
          'assets/js/custome/Beranda.js',
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

  public function management()
  {
    if ($this->session->userdata('level') == 2) {
      $this->content = 'beranda/IndexManagementView';

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
          'assets/js/ace.min.js'
        )
      );
    } else {
      show_404();
    }
  }

  public function cctv()
  {
    if ($this->session->userdata('level') == 3) {
      $this->content = 'beranda/IndexCctvView';

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
          'assets/js/ace.min.js'
        )
      );
    } else {
      show_404();
    }
  }

  public function pelapor()
  {
    if ($this->session->userdata('level') == 4) {
      $this->content = 'beranda/IndexPelaporView';

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
          'assets/js/ace.min.js'
        )
      );
    } else {
      show_404();
    }
  }

}
