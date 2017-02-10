<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends READY_Controller
{

  public $page = 'Pengguna';

  public function __construct() {
    parent::__construct();

    if (empty($this->session->userdata('login'))): redirect(base_url('masuk')); endif;

    $this->load->model('CrudModel');
  }

  public function index() {
    if ($this->session->userdata('level') == 3) {
      $data['listAccount'] = $this->CrudModel->listData('account')->result();

      $this->content = 'account/IndexView';

      $this->layout(
        (! empty($data)) ? $data : null,
        $addCss = array(
              'assets/css/ace.min.css',
              'assets/plugin/datatables/jquery.dataTables.min.css',
              'assets/css/ace-skins.min.css',
              'assets/css/ace-rtl.min.css',
            ),
            $addJs = array(
              'assets/js/callJsMobile.js',
              'assets/js/bootstrap.min.js',
              'assets/plugin/datatables/jquery.dataTables.min.js',
              'assets/plugin/datatables/dataTables.bootstrap.js',
              'assets/js/ace-elements.min.js',
              'assets/js/ace.min.js',
              'assets/js/custome/Pengguna.js'
            )
      );
    } else {
      show_404();
    }
  }

  public function tambah() {
    if ($this->session->userdata('level') == 3) {
      $this->form_validation->set_rules('account_username', 'username', 'min_length[6]|alpha_numeric|required|is_unique[account.account_username]');
      $this->form_validation->set_rules('account_password', 'password', 'min_length[6]|required');
      $this->form_validation->set_rules('account_level', 'tingkat', 'required');
      $this->form_validation->set_rules('account_identity', 'identitas', 'min_length[6]|required');

      if ($this->form_validation->run() == FALSE) {
        $this->content = 'account/AddView';

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
          'account_username' => $this->input->post('account_username'),
          'account_password' => md5($this->input->post('account_password')),
          'account_level' => $this->input->post('account_level'),
          'account_identity' => $this->input->post('account_identity'),
          'create_by' => $this->session->userdata('username'),
          'create_date' => date("Y/m/d H:i:s")
        );
        $this->CrudModel->saveData('account', $dataPost);

        redirect('pengguna/lihat/' . $this->input->post('account_username'), 'refresh');
      }
    } else {
      show_404();
    }
  }

  public function lihat($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $data['row'] = $this->CrudModel->whereData('account', 'account_username', $id)->row();

        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'account/DataView';

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
        $data['row'] = $this->CrudModel->whereData('account', 'account_username', $id)->row();

        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->form_validation->set_rules('account_password', 'password', 'min_length[6]');
          $this->form_validation->set_rules('account_level', 'tingkat', 'required');
          $this->form_validation->set_rules('account_identity', 'identitas', 'min_length[6]|required');

          if ($this->form_validation->run() == FALSE) {
            $this->content = 'account/EditView';

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
            if (empty($this->input->post('account_password'))) {
              $postData = array(
                'account_level' => $this->input->post('account_level'),
                'account_identity' => $this->input->post('account_identity'),
                'update_by' => $this->session->userdata('username'),
                'update_date' => date("Y/m/d H:i:s")
              );
            } else {
              $postData = array(
                'account_password' => md5($this->input->post('account_password')),
                'account_level' => $this->input->post('account_level'),
                'account_identity' => $this->input->post('account_identity'),
                'update_by' => $this->session->userdata('username'),
                'update_date' => date("Y/m/d H:i:s")
              );
            }

            $this->CrudModel->updateData('account_username', $this->input->post('account_username'), 'account', $postData);

            redirect(base_url('pengguna/lihat/' . $this->input->post('account_username')), 'refresh');
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }  else {
      show_404();
    }
  }

  public function hapus($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      try {
        $row = $this->CrudModel->whereData('account', 'account_username', $id)->row();

        if (! isset($row)) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          if ($row->account_username == 'root') {
            echo "<script>alert('User utama tidak bisa dihapus !');</script>";

            redirect(base_url('pengguna'), 'refresh');
          } else {
            $postData = array(
              'delete_by' => $this->session->userdata('username'),
              'delete_date' => date("Y/m/d H:i:s")
            );
            $this->CrudModel->updateData('account_username', $row->account_username, 'account', $postData);

            redirect(base_url('pengguna'), 'refresh');
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function keluar()
  {
    $this->session->sess_destroy();

    redirect(base_url('masuk'), 'refresh');
  }

}
