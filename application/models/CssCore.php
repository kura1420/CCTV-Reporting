<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CssCore extends CI_Model
{

  function cssDefault()
  {
    $data = array(
      link_css('assets/css/bootstrap.min.css')
    );

    return $data;
  }

  function cssFontAwesome()
  {
    $data = array(
      link_css('assets/font-awesome/4.5.0/css/font-awesome.min.css'),
      link_css('assets/css/fonts.googleapis.com.css')
    );

    return $data;
  }

}
