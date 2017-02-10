<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends READY_Controller
{

  public $page = 'Issue';

  public function __construct()
  {
    parent::__construct();

    if (empty($this->session->userdata('login'))): redirect(base_url('masuk')); endif;

    $this->load->model('CrudModel');
    $this->load->library('dswitch');
    $this->load->library('counttime');
  }

  public function index() {
    switch ($this->session->userdata('level')) {
      case 1:
      case 2:
      case 3:
        redirect(base_url('issue/listbaru'), 'refresh');
        break;

      case 4:
        redirect(base_url('issue/liststore'), 'refresh');

      default:
        show_404();
        break;
    }
  }

  public function tambah() {
    if ($this->session->userdata('level') == 4) {
      $username = $this->session->userdata('username');

      $data['genId'] = $this->CrudModel->genId('issue_id', 'issue', 'CB-ISU-', '7');
      $data['listStore'] = $this->db->query("
        SELECT 
        *
        FROM store A
        WHERE A.store_id IN (SELECT store_id FROM account_store WHERE account_username = '$username')
      ")->result();

      $this->form_validation->set_rules('issue_id', 'id', 'required|is_unique[issue.issue_id]');
      $this->form_validation->set_rules('issue_title', 'judul', 'min_length[5]|required');
      $this->form_validation->set_rules('issue_customer', 'pelanggan', 'trim|min_length[3]');
      $this->form_validation->set_rules('issue_notepelapor', 'keterangan', 'trim|min_length[5]|required');
      $this->form_validation->set_rules('store_id', 'store', 'required');

      if ($this->form_validation->run() == FALSE) {
        $this->content = 'issue/AddView';

        $this->layout(
          (! empty($data)) ? $data : null,
          $addCss = array(
            'assets/css/jquery-ui.custom.min.css',
            'assets/css/ace.min.css',
            'assets/css/ace-skins.min.css',
            'assets/css/ace-rtl.min.css',
          ),
          $addJs = array(
            'assets/js/callJsMobile.js',
            'assets/js/bootstrap.min.js',
            'assets/js/jquery-ui.custom.min.js',
            'assets/js/jquery.ui.touch-punch.min.js',
            'assets/js/markdown.min.js',
            'assets/js/bootstrap-markdown.min.js',
            'assets/js/jquery.hotkeys.index.min.js',
            'assets/js/bootstrap-wysiwyg.min.js',
            'assets/js/bootbox.js',
            'assets/js/ace-elements.min.js',
            'assets/js/ace.min.js',
            'assets/js/custome/Issue.js'
          )
        );
      } else {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 0;
        $config['overwrite']     = TRUE;
        $config['remove_space']  = FALSE;

        $this->load->library('upload', $config);

        $x = count($_FILES['pic_name']['name']);

        for ($i=0; $i<$x; $i++) {
          $_FILES['userfile']['name']     = str_replace(' ', '_', $_FILES['pic_name']['name'])[$i];
          $_FILES['userfile']['type']     = $_FILES['pic_name']['type'][$i];
          $_FILES['userfile']['tmp_name'] = $_FILES['pic_name']['tmp_name'][$i];
          $_FILES['userfile']['error']    = $_FILES['pic_name']['error'][$i];
          $_FILES['userfile']['size']     = $_FILES['pic_name']['size'][$i];

          if (! $this->upload->do_upload()) {
            $errors = $this->upload->display_errors();

            echo "<script>alert('".$this->upload->display_errors()."');history.go(-1);</script>";
          } else {
            $dataPic = array(
              'pic_name' => $_FILES['userfile']['name'],
              'pic_fromlevelaccount' => 4,
              'issue_id' => $this->input->post('issue_id')
            );

            $this->CrudModel->saveData("issue_pic", $dataPic);
          }          
        }

        if (empty($errors)) {
          $dataPost = array(
            'issue_id'          => $this->input->post('issue_id'),
            'issue_title'       => $this->input->post('issue_title'),
            'issue_customer'    => $this->input->post('issue_customer'),
            'issue_notepelapor' => $this->input->post('issue_notepelapor'),
            'issue_start'       => date("Y/m/d H:i:s"),
            'issue_pelapor'     => $this->session->userdata('username'),
            'store_id'          => $this->input->post('store_id'),
          );
          $this->CrudModel->saveData('issue', $dataPost);

          redirect(base_url('issue/lihat/' . $this->input->post('issue_id')), 'refresh');
        }

      }
    } else {
      show_404();
    }
  }

  public function lihat($id = FALSE) {
      $data['row'] = $this->db->query("
        SELECT 
          A.*, 
          B.store_name,
          C.account_identity
        FROM issue A 
        LEFT JOIN store B ON A.store_id = B.store_id 
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_id = '$id'
      ")->row();

      $data['listPicPelapor'] = $this->db->query("SELECT * FROM issue_pic WHERE issue_id = '$id' AND pic_fromlevelaccount = '4'")->result();

      $data['listPicCCTV'] = $this->db->query("SELECT * FROM issue_pic WHERE issue_id = '$id' AND pic_fromlevelaccount = '3'")->result();

      try {
        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'issue/DataView';

          $this->layout(
            (! empty($data)) ? $data : null,
            $addCss = array(
              'assets/css/jquery-ui.min.css',
              'assets/css/ace.min.css',
              'assets/css/ace-skins.min.css',
              'assets/css/ace-rtl.min.css',
            ),
            $addJs = array(
              'assets/js/callJsMobile.js',
              'assets/js/bootstrap.min.js',
              'assets/js/jquery-ui.min.js',
              'assets/js/jquery.ui.touch-punch.min.js',
              'assets/js/ace-elements.min.js',
              'assets/js/ace.min.js'
            )
          );
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
  }

  public function liststore() {
    if ($this->session->userdata('level') == 4) {
      $username = $this->session->userdata('username');

      $data['listIssue'] = $this->db->query("
        SELECT 
          A.*,
          B.store_name,
          C.account_identity
        FROM issue A 
        LEFT JOIN store B ON A.store_id = B.store_id 
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.store_id IN (SELECT store_id FROM account_store WHERE account_username = '$username')
      ")->result();

      try {
        if (! isset($data['listIssue'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'issue/IndexStoreView';

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
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function listbaru() {
    if ($this->session->userdata('level') != 4) {
      $data['listIssue'] = $this->db->query("
        SELECT 
          A.*,
          B.store_name,
          C.account_identity
        FROM issue A
        LEFT JOIN store B ON A.store_id = B.store_id
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_status = '0'
      ")->result();

      try {
        if (! isset($data['listIssue'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'issue/IndexNewView';

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
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function listkonfirmasi() {
    if ($this->session->userdata('level') != 4) {
      $data['listIssue'] = $this->db->query("
        SELECT 
          A.*,
          B.store_name,
          C.account_identity
        FROM issue A
        LEFT JOIN store B ON A.store_id = B.store_id
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_status = '1'
      ")->result();

      try {
        if (! isset($data['listIssue'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'issue/IndexKonfirmasiView';

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
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function listproses() {
    if ($this->session->userdata('level') != 4) {
      $data['listIssue'] = $this->db->query("
        SELECT 
          A.*,
          B.store_name,
          C.account_identity
        FROM issue A
        LEFT JOIN store B ON A.store_id = B.store_id
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_status = '2'
      ")->result();

      try {
        if (! isset($data['listIssue'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'issue/IndexProsesView';

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
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function listselesai() {
    if ($this->session->userdata('level') != 4) {
      $data['listIssue'] = $this->db->query("
        SELECT 
          A.*,
          B.store_name,
          C.account_identity
        FROM issue A
        LEFT JOIN store B ON A.store_id = B.store_id
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_status = '3' OR A.issue_status = '4'
      ")->result();

      try {
        if (! isset($data['listIssue'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'issue/IndexSelesaiView';

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
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function listditolak()
  {
    if ($this->session->userdata('level') != 4) {
      $data['listIssue'] = $this->db->query("
        SELECT 
          A.*,
          B.store_name,
          C.account_identity
        FROM issue A
        LEFT JOIN store B ON A.store_id = B.store_id
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_status = '4'
      ")->result();

      try {
        if (! isset($data['listIssue'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->content = 'issue/IndexDitolakView';

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
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function konfirmasi($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      $data['row'] = $this->db->query("
        SELECT 
          A.*, 
          B.store_name,
          C.account_identity
        FROM issue A 
        LEFT JOIN store B ON A.store_id = B.store_id 
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_id = '$id' AND A.issue_status = 0
      ")->row();

      try {
        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->form_validation->set_rules('issue_priority', 'prioritas', 'required');
          $this->form_validation->set_rules('issue_notecctv', 'keterangan', 'min_length[5]|required');

          if ($this->form_validation->run() == FALSE) {
            $this->content = 'issue/EditView';

            $this->layout(
              (! empty($data)) ? $data : null,
              $addCss = array(
                'assets/css/jquery-ui.custom.min.css',
                'assets/css/ace.min.css',
                'assets/css/ace-skins.min.css',
                'assets/css/ace-rtl.min.css',
              ),
              $addJs = array(
                'assets/js/callJsMobile.js',
                'assets/js/bootstrap.min.js',
                'assets/js/jquery-ui.custom.min.js',
                'assets/js/jquery.ui.touch-punch.min.js',
                'assets/js/markdown.min.js',
                'assets/js/bootstrap-markdown.min.js',
                'assets/js/jquery.hotkeys.index.min.js',
                'assets/js/bootstrap-wysiwyg.min.js',
                'assets/js/bootbox.js',
                'assets/js/ace-elements.min.js',
                'assets/js/ace.min.js',
                'assets/js/custome/Issue.js'
              )
            );
          } else {
            $dataPost = array(
                'issue_status' => 1,
                'issue_priority' => $this->input->post('issue_priority'),
                'issue_notecctv' => $this->input->post('issue_notecctv'),
                'issue_cctv' => $this->session->userdata('username')
              );
              $this->CrudModel->updateData('issue_id', $this->input->post('issue_id'), 'issue', $dataPost);

              redirect(base_url('issue/lihat/' . $this->input->post('issue_id')), 'refresh');
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function tanggapi($id = FALSE) {
    if ($this->session->userdata('level') == 2) {
      $data['row'] = $this->db->query("
        SELECT 
          A.*, 
          B.store_name,
          C.account_identity
        FROM issue A 
        LEFT JOIN store B ON A.store_id = B.store_id 
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_id = '$id' AND A.issue_status = 1
      ")->row();

      try {
        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->form_validation->set_rules('issue_confirmstatus', 'tanggapi', 'required');
          $this->form_validation->set_rules('issue_notemanagement', 'keterangan', 'min_length[5]|required');

          if ($this->form_validation->run() == FALSE) {
            $this->content = 'issue/EditTanggapiView';

            $this->layout(
              (! empty($data)) ? $data : null,
              $addCss = array(
                'assets/css/jquery-ui.custom.min.css',
                'assets/css/ace.min.css',
                'assets/css/ace-skins.min.css',
                'assets/css/ace-rtl.min.css',
              ),
              $addJs = array(
                'assets/js/callJsMobile.js',
                'assets/js/bootstrap.min.js',
                'assets/js/jquery-ui.custom.min.js',
                'assets/js/jquery.ui.touch-punch.min.js',
                'assets/js/markdown.min.js',
                'assets/js/bootstrap-markdown.min.js',
                'assets/js/jquery.hotkeys.index.min.js',
                'assets/js/bootstrap-wysiwyg.min.js',
                'assets/js/bootbox.js',
                'assets/js/ace-elements.min.js',
                'assets/js/ace.min.js',
                'assets/js/custome/Issue.js'
              )
            );
          } else {
            if ($this->input->post('issue_confirmstatus') == 1) {
              $dataPost = array(
                'issue_status' => 2,
                'issue_confirmstatus' => $this->input->post('issue_confirmstatus'),
                'issue_notemanagement' => $this->input->post('issue_notemanagement'),
                'issue_management' => $this->session->userdata('username')
              );
            } else {
              $dataPost = array(
                'issue_finish' => date("Y/m/d H:i:s"),
                'issue_status' => 4,
                'issue_confirmstatus' => $this->input->post('issue_confirmstatus'),
                'issue_notemanagement' => $this->input->post('issue_notemanagement'),
                'issue_management' => $this->session->userdata('username')
              );
            }
            
            $this->CrudModel->updateData('issue_id', $this->input->post('issue_id'), 'issue', $dataPost);           

            redirect(base_url('issue/lihat/' . $this->input->post('issue_id')), 'refresh');
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

  public function laporan($id = FALSE) {
    if ($this->session->userdata('level') == 3) {
      $data['row'] = $this->db->query("
        SELECT 
          A.*, 
          B.store_name,
          C.account_identity
        FROM issue A 
        LEFT JOIN store B ON A.store_id = B.store_id 
        LEFT JOIN account C ON A.issue_pelapor = C.account_username
        WHERE A.issue_id = '$id' AND A.issue_status = 2
      ")->row();

      try {
        if (! isset($data['row'])) {
          throw new Exception("Error Processing Request", 1);
          return false;
        } else {
          $this->form_validation->set_rules('issue_notelaporan', 'keterangan laporan', 'min_length[5]|required');

          if ($this->form_validation->run() == FALSE) {
            $this->content = 'issue/EditLaporanView';

            $this->layout(
              (! empty($data)) ? $data : null,
              $addCss = array(
                'assets/css/jquery-ui.custom.min.css',
                'assets/css/ace.min.css',
                'assets/css/ace-skins.min.css',
                'assets/css/ace-rtl.min.css',
              ),
              $addJs = array(
                'assets/js/callJsMobile.js',
                'assets/js/bootstrap.min.js',
                'assets/js/jquery-ui.custom.min.js',
                'assets/js/jquery.ui.touch-punch.min.js',
                'assets/js/markdown.min.js',
                'assets/js/bootstrap-markdown.min.js',
                'assets/js/jquery.hotkeys.index.min.js',
                'assets/js/bootstrap-wysiwyg.min.js',
                'assets/js/bootbox.js',
                'assets/js/ace-elements.min.js',
                'assets/js/ace.min.js',
                'assets/js/custome/Issue.js'
              )
            );
          } else {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 0;
            $config['overwrite']     = TRUE;
            $config['remove_space']  = FALSE;

            $this->load->library('upload', $config);

            $x = count($_FILES['pic_name']['name']);

            for ($i=0; $i<$x; $i++) {
              $_FILES['userfile']['name']     = str_replace(' ', '_', $_FILES['pic_name']['name'])[$i];
              $_FILES['userfile']['type']     = $_FILES['pic_name']['type'][$i];
              $_FILES['userfile']['tmp_name'] = $_FILES['pic_name']['tmp_name'][$i];
              $_FILES['userfile']['error']    = $_FILES['pic_name']['error'][$i];
              $_FILES['userfile']['size']     = $_FILES['pic_name']['size'][$i];

              if (! $this->upload->do_upload()) {
                $errors = $this->upload->display_errors();

                echo "<script>alert('".$this->upload->display_errors()."');history.go(-1);</script>";
              } else {
                $dataPic = array(
                  'pic_name' => $_FILES['userfile']['name'],
                  'pic_fromlevelaccount' => 3,
                  'issue_id' => $this->input->post('issue_id')
                );

                $this->CrudModel->saveData("issue_pic", $dataPic);
              }          
            }

            if (empty($errors)) {
              $dataPost = array(
                'issue_status' => 3,
                'issue_notelaporan' => $this->input->post('issue_notelaporan'),
                'issue_finish' => date("Y/m/d H:i:s")
              );
              $this->CrudModel->updateData('issue_id', $this->input->post('issue_id'), 'issue', $dataPost);

              redirect(base_url('issue/lihat/' . $this->input->post('issue_id')), 'refresh');
            }

            // $dataPost = array(
            //   'issue_status' => 3,
            //   'issue_notelaporan' => $this->input->post('issue_notelaporan'),
            //   'issue_finish' => date("Y/m/d H:i:s")
            // );
            // $this->CrudModel->updateData('issue_id', $this->input->post('issue_id'), 'issue', $dataPost);

            // redirect(base_url('issue/lihat/' . $this->input->post('issue_id')), 'refresh');
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      show_404();
    }
  }

}
