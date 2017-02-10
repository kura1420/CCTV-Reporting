<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends READY_Controller
{

  public $page = 'Store';

  public function __construct() {
    parent::__construct();

    if (empty($this->session->userdata('login'))): redirect(base_url('masuk')); endif;

    $this->load->model('CrudModel');
  }

  public function index() {
    if ($this->session->userdata('level') == 3) {
      $data['listStore'] = $this->db->query("SELECT DISTINCT * FROM store WHERE delete_by = ''")->result();

      $this->content = 'store/IndexView';

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

  public function debug()
  {
    $table = $this->db->query("SELECT store_id FROM store")->result();

    if (count($table) == 0) {
      $x = 1;
    } else {
      $countRecord  = count($table) - 1;

      foreach ($table as $value) {
        $z[] = substr($value->store_id, 7);
      }
      sort($z);

      $x = $z[$countRecord];
    }
  }

  public function tambah() {
    if ($this->session->userdata('level') == 3) {
      $data['genId'] = $this->CrudModel->genId('store_id', 'store', 'CB-STR-', '7');

      $data['listPelapor'] = $this->db->query("SELECT * FROM account WHERE account_level = 4 AND delete_by = ''")->result();

      $this->form_validation->set_rules('store_id', 'id', 'min_length[3]|required|is_unique[store.store_id]');
      $this->form_validation->set_rules('store_name', 'nama', 'min_length[3]|required');
      $this->form_validation->set_rules('store_email', 'email', 'valid_email|required|is_unique[store.store_email]');
      $this->form_validation->set_rules('store_telp', 'telp', 'min_length[9]|numeric|required');
      $this->form_validation->set_rules('account_username', 'pelapor', 'required');

      if ($this->form_validation->run() == FALSE) {
        $this->content = 'store/AddView';

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
        $dataPost = array(
          'store_id' => $this->input->post('store_id'),
          'store_name' => $this->input->post('store_name'),
          'store_email' => $this->input->post('store_email'),
          'store_telp' => $this->input->post('store_telp'),
          'create_by' => $this->session->userdata('username'),
          'create_date' => date("Y/m/d H:i:s")
        );
        $this->CrudModel->saveData('store', $dataPost);

        $dtlPost = array(
          'account_username' => $this->input->post('account_username'),
          'store_id' => $this->input->post('store_id')
        );
        $this->CrudModel->saveData('account_store', $dtlPost);

        redirect('store/lihat/' . $this->input->post('store_id'), 'refresh');
      }
    } else {
      show_404();
    }
  }

  public function lihat($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $data['row'] = $this->db->query("SELECT * FROM store WHERE store_id = '$id'")->row();
        $data['listPelapor'] = $this->db->query("SELECT * FROM account_store A LEFT JOIN account B ON A.account_username = B.account_username WHERE A.store_id = '$id'")->result();

        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'store/DataView';

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

  public function perbarui($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $data['row'] = $this->CrudModel->whereData('store', 'store_id', $id)->row();

        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $data['listPelaporStore'] = $this->db->query("SELECT * FROM account_store A INNER JOIN account B ON A.account_username = B.account_username WHERE A.store_id = '$id'")->result();
          $data['listPelapor'] = $this->db->query("SELECT * FROM account WHERE account_level = 4 AND delete_by = ''")->result();

          $this->form_validation->set_rules('store_name', 'nama', 'min_length[3]|required');
          if ($data['row']->store_email != $this->input->post('store_email')) {
            $this->form_validation->set_rules('store_email', 'email', 'valid_email|required|is_unique[store.store_email]');
          }
          $this->form_validation->set_rules('store_telp', 'telp', 'min_length[9]|numeric|required');
          $this->form_validation->set_rules('account_username', 'pelapor', 'trim');

          if ($this->form_validation->run() == FALSE) {
            $this->content = 'store/EditView';

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
            $postData = array(
              'store_name' => $this->input->post('store_name'),
              'store_email' => $this->input->post('store_email'),
              'store_telp' => $this->input->post('store_telp'),
              'update_by' => $this->session->userdata('username'),
              'update_date' => date("Y/m/d H:i:s")
            );
            $this->CrudModel->updateData('store_id', $this->input->post('store_id'), 'store', $postData);

            $listPelapor = $this->input->post('account_username[]');
            if (! empty($listPelapor)) {
              $dtlData = array(
                'account_username' => $this->input->post('account_username'),
                'store_id' => $this->input->post('store_id')
              );
              $this->CrudModel->saveData('account_store', $dtlData);
            }

            redirect(base_url('store/lihat/' . $this->input->post('store_id')), 'refresh');
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }  else {
      show_404();
    }
  }

  public function hapuspelapor($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      $row = $this->CrudModel->whereData('account_store', 'line', $id)->row();

      $this->db->delete('account_store', array('line' => $id));

      redirect('store/perbarui/' . $row->store_id, 'refresh');
    } else {
      show_404();
    }
  }

  public function hapus($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $row = $this->CrudModel->whereData('store', 'store_id', $id)->row();

        if (! isset($row)) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
            $postData = array(
              'delete_by' => $this->session->userdata('username'),
              'delete_date' => date("Y/m/d H:i:s")
            );
            $this->CrudModel->updateData('store_id', $row->store_id, 'store', $postData);

            redirect(base_url('store'), 'refresh');
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

}
