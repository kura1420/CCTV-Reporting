<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataterhapus extends READY_Controller
{

  public $page = 'Data Terhapus';

  public function __construct()
  {
    parent::__construct();

    if (empty($this->session->userdata('login'))): redirect(base_url('masuk')); endif;

    $this->load->model('CrudModel');
  }

  public function pengguna() {
    if ($this->session->userdata('level') == 3) {
      $data['listAccount'] = $this->CrudModel->listDataTrash('account')->result();

      $this->content = 'account/IndexTrashView';

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
          'assets/js/jquery.dataTables.min.js',
          'assets/js/jquery.dataTables.bootstrap.min.js',
          'assets/js/ace-elements.min.js',
          'assets/js/ace.min.js',
          'assets/js/custome/Pengguna.js'
        )
      );
    } else {
      show_404();
    }
  }

  public function penggunalihat($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $data['row'] = $this->CrudModel->whereData('account', 'account_username', $id)->row();

        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'account/DataTrashView';

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
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function penggunakembalikan($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $row = $this->CrudModel->whereData('account', 'account_username', $id)->row();

        if (! isset($row)) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $postData = array(
            'delete_by' => '',
            'delete_date' => ''
          );
          $this->CrudModel->updateData('account_username', $row->account_username, 'account', $postData);

          redirect(base_url('dataterhapus/pengguna/'), 'refresh');
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function store() {
    if ($this->session->userdata('level') == 3) {
      $data['listStore'] = $this->CrudModel->listDataTrash('store')->result();

      $this->content = 'store/IndexTrashView';

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
          'assets/js/jquery.dataTables.min.js',
          'assets/js/jquery.dataTables.bootstrap.min.js',
          'assets/js/ace-elements.min.js',
          'assets/js/ace.min.js',
          'assets/js/custome/Pengguna.js'
        )
      );
    } else {
      show_404();
    }
  }

  public function storelihat($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $data['row'] = $this->CrudModel->whereData('store', 'store_id', $id)->row();
        $data['listPelapor'] = $this->db->query("SELECT * FROM account_store A LEFT JOIN account B ON A.account_username = B.account_username WHERE A.store_id = '$id'")->result();

        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'store/DataTrashView';

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
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function storekembalikan($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $row = $this->CrudModel->whereData('store', 'store_id', $id)->row();

        if (! isset($row)) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $postData = array(
            'delete_by' => '',
            'delete_date' => ''
          );
          $this->CrudModel->updateData('store_id', $row->store_id, 'store', $postData);

          redirect(base_url('dataterhapus/store/'), 'refresh');
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

}
