<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dswitch
{
	
	function statusCase($value) {
		  switch ($value) {
      case 0:
                                    $x = '<span class="label">Menunggu</span>';
                                    break;

                                  case 1:
                                    $x = '<span class="label label-info">Sudah Diterima</span>';
                                    break;

                                  case 2: 
                                    $x = '<span class="label label-warning">
                        Di proses
                      </span>';
                                    break;

                                  case 3:
                                    $x = '<span class="label label-success">Selesai</span>';
                                    break;

                                  case 4:
                                    $x = '<span class="label label-inverse">Di tolak</span>';
                                    break;
                                  
                                  default:
                                    $x = 'Status belum di definisi';
                                    break;
    }

    return $x;
	}

  function statusPriority($value) {
    switch ($value) {
                                  case 0:
                                    $x = '<i class="fa fa-flag blue bigger-130"></i> Menunggu';
                                    break;

                                  case 1:
                                    $x = '<i class="fa fa-flag green bigger-130"></i> Mudah';
                                    break;

                                  case 2: 
                                    $x = '<i class="fa fa-flag orange bigger-130"></i> Sedang';
                                    break;

                                  case 3:
                                    $x = '<i class="fa fa-flag red bigger-130"></i> Tinggi';
                                    break;
                                  
                                  default:
                                    $x = 'Status belum di definisi';
                                    break;
                                }

                                return $x;
  }

  function statusConfirm($value) {
    switch ($value) {
                                  case 0:
                                    $x = '<i class="ace-icon fa fa-bell-o bigger-110 purple"></i> Menunggu';
                                    break;

                                  case 1:
                                    $x = '<i class="ace-icon fa fa-check bigger-110 green"></i> Di Terima';
                                    break;

                                  case 2: 
                                    $x = '<i class="ace-icon fa fa-times bigger-110 red"></i> Di Tolak';
                                    break;
                                  
                                  default:
                                    $x = 'Status belum di definisi';
                                    break;
                                }

                                return $x;
  }
}