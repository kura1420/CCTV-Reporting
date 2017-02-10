<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JsCore extends CI_Model
{

  function jsDefault()
  {
    $data = array(
      link_js('assets/js/jquery-2.1.4.min.js')
    );

    return $data;
  }

}
