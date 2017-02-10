<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends READY_Controller
{

  public $page = 'Masuk';

  public function __construct()
  {
    parent::__construct();

    if (! empty($this->session->userdata('login'))): redirect(base_url('beranda'), 'refresh'); endif;

    $this->load->model('CrudModel');
  }

  public function index()
  {
    $this->content = 'account/LoginView';

    $this->singleLayout(
      (! empty($data)) ? $data : null,
      $addCss = array(
        'assets/css/ace.min.css',
        'assets/css/ace-rtl.min.css',
      ),
      $addJs = array()
    );
  }

  public function proses()
  {
    $this->form_validation->set_rules('account_username', 'username', 'required');
    $this->form_validation->set_rules('account_password', 'password', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->content = 'account/LoginView';

      $this->singleLayout(
        (! empty($data)) ? $data : null,
        $addCss = array(
          'assets/css/ace.min.css',
          'assets/css/ace-rtl.min.css',
        ),
        $addJs = array()
      );
    } else {
      $username = $this->input->post('account_username');
      $password = md5($this->input->post('account_password'));

      $dataAccount = $this->db->query("SELECT * FROM account WHERE BINARY account_username LIKE '%$username%' AND account_password = '$password' AND delete_by = ''")->row();

      if (empty($dataAccount)) {
        // wrong username password
        $this->session->set_flashdata('wrongLogin', '<div class="alert alert-danger" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													Username dan password anda salah
											  	</div>');

        redirect(base_url('masuk'), 'refresh');
      } else {
        if ($dataAccount->account_level == 4) {
          $dataStore = $this->db->query("
            SELECT 
              A.*,
              B.store_name
            FROM account_store A 
            LEFT JOIN store B ON A.store_id = B.store_id
            WHERE A.account_username = '$username'
          ")->result();

          if (empty($dataStore)) {
            $this->session->set_flashdata('wrongLogin', '<div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          Hi Pelapor, Silahkan konfirmasi dahulu ke administrator untuk  mapping store anda.
                          </div>');

            redirect(base_url('masuk'), 'refresh');
          } else {
            // set session
            $sessionLogin = array(
              'username' => $dataAccount->account_username,
              'level' => $dataAccount->account_level,
              'identity' => $dataAccount->account_identity,
              'login' => TRUE
            );
            $this->session->set_userdata($sessionLogin);

            redirect(base_url('beranda'), 'refresh');
          }
        } else {
          // set session
          $sessionLogin = array(
            'username' => $dataAccount->account_username,
            'level' => $dataAccount->account_level,
            'identity' => $dataAccount->account_identity,
            'login' => TRUE
          );
          $this->session->set_userdata($sessionLogin);

          redirect(base_url('beranda'), 'refresh');
        }
      }

    }
  }

}
