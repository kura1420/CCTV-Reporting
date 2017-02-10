<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class READY_Controller extends CI_Controller
{

  public $title = "CLI";
  public $desc = "CCTV Laporan Issue";
  private $template = array();

  function __construct()
  {
    parent::__construct();

    $this->load->model('CssCore');
    $this->load->model('JsCore');
  }

  function css($addCss = '')
  {
    $data = array(
      array($this->CssCore->cssDefault()),
      (! empty($addCss) ? $addCss : null),
      array($this->CssCore->cssFontAwesome())
    );

    return $data;
  }

  function js($addJs = '')
  {
    $data = array(
      array($this->JsCore->jsDefault()),
      (! empty($addJs) ? $addJs : null),
    );

    return $data;
  }

  function singleLayout($data, $addCss, $addJs)
  {
    $loadDataCss['loadCss'] = $this->css($addCss);
    $loadDataJs['loadJs']   = $this->js($addJs);

    // load plugin
    $this->template['cssData']  = $this->load->view('_singleLayouts/LoadCss', $loadDataCss, true);
    $this->template['jsData']   = $this->load->view('_singleLayouts/LoadJs', $loadDataJs, true);

    // load html
    $this->template['content']  = $this->load->view($this->content, $data, true);

    $this->load->view('_singleLayouts/FrontView', $this->template);
  }

  function layout($data, $addCss, $addJs)
  {
    $loadDataCss['loadCss'] = $this->css($addCss);
    $loadDataJs['loadJs']   = $this->js($addJs);

    // load plugin
    $this->template['cssData']  = $this->load->view('_layouts/LoadCss', $loadDataCss, true);
    $this->template['jsData']   = $this->load->view('_layouts/LoadJs', $loadDataJs, true);

    // load html
    $this->template['header']   = $this->load->view('_layouts/HeaderView', null,true);
    $this->template['leftMenu'] = $this->load->view('_layouts/LeftMenuView', null,true);
    $this->template['breadcrumb'] = $this->load->view('_layouts/BreadcrumbView', null,true);
    $this->template['content']  = $this->load->view($this->content, $data, true);
    $this->template['footer']   = $this->load->view('_layouts/FooterView', null,true);

    $this->load->view('_layouts/FrontView', $this->template);
  }

}
