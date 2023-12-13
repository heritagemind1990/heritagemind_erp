<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('Inst.php');
class Accounts extends Inst 
{

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        $id = $_SESSION['MUserId'];

        $data['title'] = 'Account Dashboard';
        $data['total_academic_year'] = $this->accounts_model->count_row('academic_year_master');
        $data['total_fee_type'] = $this->accounts_model->count_row('fee_type_master');
        $data['total_fee_head'] = $this->accounts_model->count_row('fee_head_master');
        $data['total_fee_scheme'] = $this->accounts_model->count_row('fee_scheme_master');
        $data['monthfee']          = $this->accounts_model->get_month_fee();
        $data['todayfee']          = $this->accounts_model->get_today_fee();
        $data['this_month_paid_student']          = $this->accounts_model->this_month_paid_student();
        $data['get_total_student']          = $this->accounts_model->get_total_student();
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/accounts/header', $data);
        $this->load->view('erp/accounts/index', $data);
        $this->load->view('erp/accounts/footer');
    }
    public function profile($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);  
        $data['title']             = 'My Profile';
        $data['tb_url']            = current_url().'/tb';
        $data['search']            = $this->input->post('search');
        $this->load->view('erp/accounts/header',$data);
        $this->load->view('erp/accounts/my_profile',$data);
        $this->load->view('erp/accounts/footer');
        break;
        case 'edit-image':
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $id=$_SESSION['MUserId'];
            $config['file_name'] = rand(10000, 10000000000);    
            $config['upload_path'] = UPLOAD_PATH.'teacher/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
     
            if (!empty($_FILES['file']['name'])) {
     
              //upload doc
              $_FILES['files']['name'] = $_FILES['file']['name'];
              $_FILES['files']['type'] = $_FILES['file']['type'];
              $_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'];
              $_FILES['files']['size'] = $_FILES['file']['size'];
              $_FILES['files']['error'] = $_FILES['file']['error'];
     
              if ($this->upload->do_upload('files')) {
                  $image_data = $this->upload->data();
               
                  $fileName = "teacher/" . $image_data['file_name'];
              }
             $file=$data['file'] = $fileName;
              } else {
             $file = $data['file'] = "";
             }
            $data = array(
                'self_pic'       =>$file,
             );
             if ($this->teacher_model->Update('teacher_master',$data,['id'=>$p1])) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
             }
           }
           echo json_encode($return);
            break;
        case 'edit-details':
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $id=$_SESSION['MUserId'];
            $rs = $this->teacher_model->getDataID('teacher_master',$_SESSION['MUserId']);
            $config['file_name'] = rand(10000, 10000000000);    
            $config['upload_path'] = UPLOAD_PATH.'teacher/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
           
            if (!empty($_FILES['adharfile']['name'])) {
              $_FILES['adharfiles']['name'] = $_FILES['adharfile']['name'];
              $_FILES['adharfiles']['type'] = $_FILES['adharfile']['type'];
              $_FILES['adharfiles']['tmp_name'] = $_FILES['adharfile']['tmp_name'];
              $_FILES['adharfiles']['size'] = $_FILES['adharfile']['size'];
              $_FILES['adharfiles']['error'] = $_FILES['adharfile']['error'];
     
              if ($this->upload->do_upload('adharfiles')) {
                  $image_data = $this->upload->data();
               
                  $fileName = "teacher/" . $image_data['file_name'];
              }
             $aadhaar_file_front=$data['adharfile'] = $fileName;
              } else {
             $aadhaar_file_front = $rs->adharfile;
             }

             if (!empty($_FILES['adhaarfile_back']['name'])) {
                $_FILES['adhaarfile_backs']['name'] = $_FILES['adhaarfile_back']['name'];
                $_FILES['adhaarfile_backs']['type'] = $_FILES['adhaarfile_back']['type'];
                $_FILES['adhaarfile_backs']['tmp_name'] = $_FILES['adhaarfile_back']['tmp_name'];
                $_FILES['adhaarfile_backs']['size'] = $_FILES['adhaarfile_back']['size'];
                $_FILES['adhaarfile_backs']['error'] = $_FILES['adhaarfile_back']['error'];
       
                if ($this->upload->do_upload('adhaarfile_backs')) {
                    $image_data = $this->upload->data();
                 
                    $fileName = "teacher/" . $image_data['file_name'];
                }
               $aadhaar_file_back=$data['adhaarfile_back'] = $fileName;
                } else {
               $aadhaar_file_back = $rs->adhaarfile_back;
               }

               if (!empty($_FILES['panfile']['name'])) {
                $_FILES['panfiles']['name'] = $_FILES['panfile']['name'];
                $_FILES['panfiles']['type'] = $_FILES['panfile']['type'];
                $_FILES['panfiles']['tmp_name'] = $_FILES['panfile']['tmp_name'];
                $_FILES['panfiles']['size'] = $_FILES['panfile']['size'];
                $_FILES['panfiles']['error'] = $_FILES['panfile']['error'];
       
                if ($this->upload->do_upload('panfiles')) {
                    $image_data = $this->upload->data();
                 
                    $fileName = "teacher/" . $image_data['file_name'];
                }
               $pan_file=$data['panfile'] = $fileName;
                } else {
               $pan_file = $rs->panfile;
               }

               if (!empty($_FILES['bank_passbook']['name'])) {
                $_FILES['bank_passbooks']['name'] = $_FILES['bank_passbook']['name'];
                $_FILES['bank_passbooks']['type'] = $_FILES['bank_passbook']['type'];
                $_FILES['bank_passbooks']['tmp_name'] = $_FILES['bank_passbook']['tmp_name'];
                $_FILES['bank_passbooks']['size'] = $_FILES['bank_passbook']['size'];
                $_FILES['bank_passbooks']['error'] = $_FILES['bank_passbook']['error'];
       
                if ($this->upload->do_upload('bank_passbooks')) {
                    $image_data = $this->upload->data();
                 
                    $fileName = "teacher/" . $image_data['file_name'];
                }
               $bank_file=$data['bank_passbook'] = $fileName;
                } else {
               $bank_file =$rs->bank_passbook;
               }

            $data = array(
                'username'     => $this->input->post('username'),
                'email'     => $this->input->post('email'),
                'name'     => $this->input->post('name'),
                'father_name'     => $this->input->post('father_name'),
                'phone'     => $this->input->post('phone'),
                'joindate'     =>$this->input->post('joindate'),
                'teaching_qualification' =>$this->input->post('teaching_qualification'),
                'address'       =>$this->input->post('address'),
                'adhaar'       =>$this->input->post('adhaar'),
                'pan'       =>$this->input->post('pan'),
                'account_holder_name'       =>$this->input->post('account_holder_name'),
                'account_number'       =>$this->input->post('account_number'),
                'bank'       =>$this->input->post('bank'),
                'ifsc'       =>$this->input->post('ifsc'),
                'adharfile'       =>$aadhaar_file_front,
                'adhaarfile_back'       =>$aadhaar_file_back,
                'panfile'       =>$pan_file,
                'bank_passbook'       =>$bank_file,
             );
             if ($this->teacher_model->Update('teacher_master',$data,['id'=>$p1])) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
             }
           }
           echo json_encode($return);
        break; 
        case 'change-password':
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $id=$_SESSION['MUserId'];
         
            if($this->input->post('password')==$this->input->post('cpassword')){
                $data = array(
                    'password'     => $this->input->post('password'),
                 );
             if ($this->teacher_model->Update('teacher_master',$data,['id'=>$p1])) {
            $return['res'] = 'success';
             $return['msg'] = 'Update.';
             }
            }else
            {
                $return['res'] = 'error';
                $return['msg'] = 'Sorry! Password & Confirm Password does not match.';
            }
           }
           echo json_encode($return);
        break;    
     
            default:
        # code...
        break;
        }
    }
    public function academic_year_master($action = null, $p1 = null, $p2 = null, $p3 = null)
    {
        switch ($action) {
            case null:

                $data['menu_id'] = $this->uri->segment(2);

                $data['title']          = 'Academic Year Master';
                $data['new_url']         = base_url() . 'academic-year-master/create ';
                $data['tb_url']            = current_url() . '/tb';
                $data['search']           = $this->input->post('search');
                $id = $_SESSION['MUserId'];
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/accounts/header', $data);
                $this->load->view('erp/accounts/academic_year_master', $data);
                $this->load->view('erp/accounts/footer');
                break;
            case 'tb':
                $data['search'] = '';
                $search = 'null';

                if ($p1 != null) {
                    $data['search'] = $p1;
                    $search = $p1;
                }
                //end of section
                if (@$_POST['search']) {
                    $data['search'] = $_POST['search'];
                    $search = $_POST['search'];
                }
                $this->load->library('pagination');
                $config = array();
                $config["base_url"]     = base_url() . "academic-year-master/tb";
                $config["total_rows"]   = count($this->accounts_model->academic_year_master($search));
                $data['total_rows']     = $config["total_rows"];
                $config["per_page"]     = 10;
                $config["uri_segment"]  = 2;
                $config['attributes']   = array('class' => 'pag-link ');
                $this->pagination->initialize($config);
                $data['links']          = $this->pagination->create_links();
                $data['page']           = $page = ($p1 != null) ? $p1 : 0;
                $data['search']         = $this->input->post('search');
                $data['delete_url']         = base_url() . 'academic-year-master/delete/';
                $data['update_url']       = base_url() . 'academic-year-master/create/';
                $data['rows']           = $this->accounts_model->academic_year_master($search, $config["per_page"], $page);
                $page                       = 'erp/accounts/tb_academicyear';
                $this->load->view($page, $data);
                break;
            case 'create':
                $data['remote']     = base_url() . 'fee_type_remote/academic/';
                $data['action_url']         = base_url() . 'academic-year-master/save';
                $data['total_data'] = 0;
                $page               = 'erp/accounts/create_academic_year';
                if ($p1 != null) {
                    $data['action_url']         = base_url() . 'academic-year-master/save/' . $p1;
                    $data['year']         = $this->accounts_model->view_data_id('academic_year_master',$p1);
                    $data['total_data']         = $this->accounts_model->count_row_id('academic_year_master',$p1);
                    $page           = 'erp/accounts/create_academic_year';
                }
                $data['form_id']            = uniqid();

                $this->load->view($page, $data);
                break;


            case 'save':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';

                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    //doc upload code
                    if ($p1 != null) {

                        $data = array(
                            'name'     => $this->input->post('name'),
                        );
                        if ($this->accounts_model->UpdateData('academic_year_master', $data, $p1)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    } else {
                        $id = $_SESSION['MUserId'];
                        $data = array(
                            'name'     => $this->input->post('name'),
                            'status'        => 1,
                            'created_by'      => $id,
                        );
                        if ($this->accounts_model->Save('academic_year_master', $data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    }
                }

                echo json_encode($return);
                break;

            case 'delete':
                $return['res'] = 'error';
                $return['msg'] = 'Not Deleted!';
                if ($p1 != null) {
                    if ($this->erp_model->_delete('academic_year_master', ['id' => $p1])) {
                        $saved = 1;
                        $return['res'] = 'success';
                        $return['msg'] = 'Successfully deleted.';
                    }
                }
                echo json_encode($return);
                break;
            default:
                # code...
                break;
        }
    }
    public function fee_type_master($action = null, $p1 = null, $p2 = null, $p3 = null)
    {
        switch ($action) {
            case null:

                $data['menu_id'] = $this->uri->segment(2);

                $data['title']          = 'Fee Type Master';
                $data['new_url']         = base_url() . 'fee-type-master/create ';
                $data['tb_url']            = current_url() . '/tb';
                $data['search']           = $this->input->post('search');
                $id = $_SESSION['MUserId'];
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/accounts/header', $data);
                $this->load->view('erp/accounts/fee_type_master', $data);
                $this->load->view('erp/accounts/footer');
                break;
            case 'tb':
                $data['search'] = '';
                $search = 'null';

                if ($p1 != null) {
                    $data['search'] = $p1;
                    $search = $p1;
                }
                //end of section
                if (@$_POST['search']) {
                    $data['search'] = $_POST['search'];
                    $search = $_POST['search'];
                }
                $this->load->library('pagination');
                $config = array();
                $config["base_url"]     = base_url() . "fee-type-master/tb";
                $config["total_rows"]   = count($this->accounts_model->get_fee_type_master($search));
                $data['total_rows']     = $config["total_rows"];
                $config["per_page"]     = 10;
                $config["uri_segment"]  = 2;
                $config['attributes']   = array('class' => 'pag-link ');
                $this->pagination->initialize($config);
                $data['links']          = $this->pagination->create_links();
                $data['page']           = $page = ($p1 != null) ? $p1 : 0;
                $data['search']         = $this->input->post('search');
                $data['delete_url']         = base_url() . 'fee-type-master/delete/';
                $data['update_url']       = base_url() . 'fee-type-master/create/';
                $data['rows']           = $this->accounts_model->get_fee_type_master($search, $config["per_page"], $page);
                $page                       = 'erp/accounts/tb_feetypemaster';
                $this->load->view($page, $data);
                break;
            case 'create':
                $data['remote']     = base_url() . 'fee_type_remote/fee_type/';
                $data['action_url']         = base_url() . 'fee-type-master/save';
                $data['total_data'] = 0;
                $page               = 'erp/accounts/create_fee_type';
                if ($p1 != null) {
                    $data['action_url']         = base_url() . 'fee-type-master/save/' . $p1;
                    $data['feetype']         = $this->accounts_model->view_data_id('fee_type_master',$p1);
                    $data['total_data']         = $this->accounts_model->count_row_id('fee_type_master',$p1);
                    $page           = 'erp/accounts/create_fee_type';
                }
                $data['form_id']            = uniqid();

                $this->load->view($page, $data);
                break;


            case 'save':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';

                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    //doc upload code
                    if ($p1 != null) {

                        $data = array(
                            'name'     => $this->input->post('name'),
                        );
                        if ($this->accounts_model->UpdateData('fee_type_master', $data, $p1)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    } else {
                        $id = $_SESSION['MUserId'];
                        $data = array(
                            'name'     => $this->input->post('name'),
                            'status'        => 1,
                            'created_by'      => $id,
                        );
                        if ($this->accounts_model->Save('fee_type_master', $data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    }
                }

                echo json_encode($return);
                break;

            case 'delete':
                $return['res'] = 'error';
                $return['msg'] = 'Not Deleted!';
                if ($p1 != null) {
                    if ($this->erp_model->_delete('fee_type_master', ['id' => $p1])) {
                        $saved = 1;
                        $return['res'] = 'success';
                        $return['msg'] = 'Successfully deleted.';
                    }
                }
                echo json_encode($return);
                break;
            default:
                # code...
                break;
        }
    }
    public function fee_type_remote($type, $id = null, $column = 'name')
    {
        if ($type == 'fee_type') {
            $tb = 'fee_type_master';
        } elseif($type=='fee_head') {
            $tb = 'fee_head_master';
        }elseif($type == 'academic')
        {
            $tb = 'academic_year_master';
        }else
        {

        }
        $this->db->where($column, $_GET[$column]);
        if ($id != NULL) {
            $this->db->where('id != ', $id);
        }
        $count = $this->db->count_all_results($tb);
        if ($count > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }
    public function fee_head_master($action = null, $p1 = null, $p2 = null, $p3 = null)
    {
        switch ($action) {
            case null:

                $data['menu_id'] = $this->uri->segment(2);

                $data['title']          = 'Fee Head Master';
                $data['new_url']         = base_url() . 'fee-head-master/create ';
                $data['tb_url']            = current_url() . '/tb';
                $data['search']           = $this->input->post('search');
                $id = $_SESSION['MUserId'];
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/accounts/header', $data);
                $this->load->view('erp/accounts/fee_head_master', $data);
                $this->load->view('erp/accounts/footer');
                break;
            case 'tb':
                $data['search'] = '';
                $search = 'null';

                if ($p1 != null) {
                    $data['search'] = $p1;
                    $search = $p1;
                }
                //end of section
                if (@$_POST['search']) {
                    $data['search'] = $_POST['search'];
                    $search = $_POST['search'];
                }
                $this->load->library('pagination');
                $config = array();
                $config["base_url"]     = base_url() . "fee-head-master/tb";
                $config["total_rows"]   = count($this->accounts_model->get_fee_head_master($search));
                $data['total_rows']     = $config["total_rows"];
                $config["per_page"]     = 10;
                $config["uri_segment"]  = 2;
                $config['attributes']   = array('class' => 'pag-link ');
                $this->pagination->initialize($config);
                $data['links']          = $this->pagination->create_links();
                $data['page']           = $page = ($p1 != null) ? $p1 : 0;
                $data['search']         = $this->input->post('search');
                $data['delete_url']         = base_url() . 'fee-head-master/delete/';
                $data['update_url']       = base_url() . 'fee-head-master/create/';
                $data['rows']           = $this->accounts_model->get_fee_head_master($search, $config["per_page"], $page);
                $page                       = 'erp/accounts/tb_feeheadmaster';
                $this->load->view($page, $data);
                break;
            case 'create':
                $data['remote']     = base_url() . 'fee_type_remote/fee_head/';
                $data['action_url']         = base_url() . 'fee-head-master/save';
                $data['feetype']      = $this->accounts_model->getData('fee_type_master');
                $data['total_data'] = 0;
                $page               = 'erp/accounts/create_fee_head';
                if ($p1 != null) {
                    $data['action_url']         = base_url() . 'fee-head-master/save/' . $p1;
                    $data['feehead']         = $this->accounts_model->view_data_id('fee_head_master',$p1);
                    $data['feetype']      = $this->accounts_model->getData('fee_type_master');
                    $data['total_data']         = $this->accounts_model->count_row_id('fee_head_master',$p1);
                    $page           = 'erp/accounts/create_fee_head';
                }
                $data['form_id']            = uniqid();

                $this->load->view($page, $data);
                break;


            case 'save':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';

                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    //doc upload code
                    if ($p1 != null) {

                        $data = array(
                            'name'     => $this->input->post('name'),
                            'feetype'  => $this->input->post('feetype'),
                        );
                        if ($this->accounts_model->UpdateData('fee_head_master', $data, $p1)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    } else {
                        $id = $_SESSION['MUserId'];
                        $data = array(
                            'name'     => $this->input->post('name'),
                            'feetype'  => $this->input->post('feetype'),
                            'status'        => 1,
                            'created_by'      => $id,
                        );
                        if ($this->accounts_model->Save('fee_head_master', $data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    }
                }

                echo json_encode($return);
                break;

            case 'delete':
                $return['res'] = 'error';
                $return['msg'] = 'Not Deleted!';
                if ($p1 != null) {
                    if ($this->erp_model->_delete('fee_head_master', ['id' => $p1])) {
                        $saved = 1;
                        $return['res'] = 'success';
                        $return['msg'] = 'Successfully deleted.';
                    }
                }
                echo json_encode($return);
                break;
            default:
                # code...
                break;
        }
    }
    public function scheme($action = null, $p1 = null, $p2 = null, $p3 = null)
    {
        switch ($action) {
            case null:

                $data['menu_id'] = $this->uri->segment(2);

                $data['title']          = 'Fee Scheme Master';
                $data['new_url']         = base_url() . 'fee-scheme-master/create ';
                $data['tb_url']            = current_url() . '/tb';
                $data['search']           = $this->input->post('search');
                $id = $_SESSION['MUserId'];
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/accounts/header', $data);
                $this->load->view('erp/accounts/fee_scheme_master', $data);
                $this->load->view('erp/accounts/footer');
                break;
            case 'tb':
                $data['search'] = '';
                $search = 'null';

                if ($p1 != null) {
                    $data['search'] = $p1;
                    $search = $p1;
                }
                //end of section
                if (@$_POST['search']) {
                    $data['search'] = $_POST['search'];
                    $search = $_POST['search'];
                }
                $this->load->library('pagination');
                $config = array();
                $config["base_url"]     = base_url() . "fee-scheme-master/tb";
                $config["total_rows"]   = count($this->accounts_model->fee_scheme_master($search));
                $data['total_rows']     = $config["total_rows"];
                $config["per_page"]     = 10;
                $config["uri_segment"]  = 2;
                $config['attributes']   = array('class' => 'pag-link ');
                $this->pagination->initialize($config);
                $data['links']          = $this->pagination->create_links();
                $data['page']           = $page = ($p1 != null) ? $p1 : 0;
                $data['search']         = $this->input->post('search');
                $data['delete_url']         = base_url() . 'fee-scheme-master/delete/';
                $data['update_url']       = base_url() . 'fee-scheme-master/create/';
                $data['rows']           = $this->accounts_model->fee_scheme_master($search, $config["per_page"], $page);
                $page                       = 'erp/accounts/tb_feescheme';
                $this->load->view($page, $data);
                break;
            case 'create':
                $data['remote']     = base_url() . 'fee_type_remote/academic/';
                $data['action_url']         = base_url() . 'fee-scheme-master/save';
                $data['year']      = $this->accounts_model->getData('academic_year_master');
                $data['total_data'] = 0;
                $data['curmonth'] = date('m');
                $page               = 'erp/accounts/create_feescheme';
                if ($p1 != null) {
                    $data['action_url']         = base_url() . 'fee-scheme-master/save/' . $p1;
                    $data['scheme']         = $this->accounts_model->view_data_id('fee_scheme_master',$p1);
                    $data['total_data']         = $this->accounts_model->count_row_id('fee_scheme_master',$p1);
                    $data['year']      = $this->accounts_model->getData('academic_year_master');
                    $page           = 'erp/accounts/create_feescheme';
                }
                $data['form_id']            = uniqid();

                $this->load->view($page, $data);
                break;


            case 'save':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';

                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    //doc upload code
                    if ($p1 != null) {

                        $data = array(
                            'name'              => $this->input->post('name'),
                            'academic_year'     => $this->input->post('academic'),
                            'fee_start_month'   => $this->input->post('start_month'),
                            'fee_end_month'     => $this->input->post('end_month'),
                            'fine_per_day'      => $this->input->post('per_fine'),
                            'max_fine'          => $this->input->post('max_fine'),
                        );
                        if ($this->accounts_model->UpdateData('fee_scheme_master', $data, $p1)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    } else {
                        $id = $_SESSION['MUserId'];
                        $data = array(
                            'name'              => $this->input->post('name'),
                            'academic_year'     => $this->input->post('academic'),
                            'fee_start_month'   => $this->input->post('start_month'),
                            'fee_end_month'     => $this->input->post('end_month'),
                            'fine_per_day'      => $this->input->post('per_fine'),
                            'max_fine'          => $this->input->post('max_fine'),
                            'status'        => 1,
                            'created_by'      => $id,
                        );
                        if ($this->accounts_model->Save('fee_scheme_master', $data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    }
                }

                echo json_encode($return);
                break;

            case 'delete':
                $return['res'] = 'error';
                $return['msg'] = 'Not Deleted!';
                if ($p1 != null) {
                    if ($this->erp_model->_delete('fee_scheme_master', ['id' => $p1])) {
                        $saved = 1;
                        $return['res'] = 'success';
                        $return['msg'] = 'Successfully deleted.';
                    }
                }
                echo json_encode($return);
                break;
            default:
                # code...
                break;
        }
    }


    
    public function structure($action = null, $p1 = null, $p2 = null, $p3 = null)
    {
        switch ($action) {
            case null:

                $data['menu_id'] = $this->uri->segment(2);

                $data['title']          = 'Fee Structure';
                $data['new_url']         = base_url() . 'fee-structure/create ';
                $data['tb_url']            = current_url() . '/tb';
                $data['search']           = $this->input->post('search');
                $id = $_SESSION['MUserId'];
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/accounts/header', $data);
                $this->load->view('erp/accounts/fee_structure', $data);
                $this->load->view('erp/accounts/footer');
                break;
            case 'tb':
                $data['search'] = '';
                $search = 'null';

                if ($p1 != null) {
                    $data['search'] = $p1;
                    $search = $p1;
                }
                //end of section
                if (@$_POST['search']) {
                    $data['search'] = $_POST['search'];
                    $search = $_POST['search'];
                }
                $data['Feeinstid'] = $this->input->post('Feeinst');
		        $data['Standard'] = $this->input->post('Standard');
                $this->load->library('pagination');
                $config = array();
                $config["base_url"]     = base_url() . "fee-structure/tb";
                $config["total_rows"]   = count($this->accounts_model->fee_scheme_master($search));
                $data['total_rows']     = $config["total_rows"];
                $config["per_page"]     = 10;
                $config["uri_segment"]  = 2;
                $config['attributes']   = array('class' => 'pag-link ');
                $this->pagination->initialize($config);
                $data['links']          = $this->pagination->create_links();
                $data['page']           = $page = ($p1 != null) ? $p1 : 0;
                $data['search']         = $this->input->post('search');
                $data['action_url']     = base_url() . "fee-structure/save";
                $data['fees_scheme']    = $this->accounts_model->getData('fee_scheme_master');
                $data['class']          = $this->accounts_model->getData('class_master');
                $data['fee_head']       = $this->accounts_model->getData('fee_head_master');
                $data['fees']           = $this->accounts_model->getDataIDresult('fee_scheme_master',$data['Feeinstid']);
                $data['rows']           = $this->accounts_model->fee_scheme_master($search, $config["per_page"], $page);
                $page                       = 'erp/accounts/tb_fee_structure';
                $this->load->view($page, $data);
                break;
                case 'section_list':
                    $sec = $this->input->post('C');
                    $data['rs'] = $this->db->query("select section_name as section, id from section_master where class_id=? AND status=1",array($sec))->result();
                    
                    $this->load->view('erp/accounts/section_list',$data);
                break; 
                case 'school_list':
                    $Feeinstid = $this->input->post('F');
                    $data['fee_head']  = $this->accounts_model->Select('fee_head_master', 'id,name', array());
                    $data['fee_scheme'] = $this->accounts_model->Select('fee_scheme_master', '*', array('id' => $Feeinstid));
                    $this->load->view('erp/accounts/school_list',$data);
                break;  
                 
               
                case 'save':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';

                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $Standard = $this->input->post('Standard');
                    $data['Feeinstid'] = $this->input->post('Feeinst');
                    $rs2 = $this->accounts_model->get_scheme($data['Feeinstid']);
                    $rs = $this->accounts_model->Select('fee_head_master', 'id,name', array());
        
                    $i = 0;
                    while (isset($_POST['Section'][$i])) {
                        $Section = $_POST['Section'][$i];
        
        
                        foreach ($rs2 as $r2) {
                            $feeInstallment = $r2->name;
                            $l = 0;
                            for ($j = 1; $j <= $feeInstallment; $j++) {
        
                                $FeeStartDate = $_POST['FeeStartDate'][$l];
                                $FeeEndDate = $_POST['FeeEndDate'][$l];
                                $Months = $_POST['Months'][$l];
                                $k = 1;
                                $l++;
        
                                foreach ($rs as $r) {
                  
                  $amount = $_POST["FIA" . $r->id . $j . $k];
                  $this->accounts_model->Delete('fee_structure', array('`standard`' => $Standard, '`section`' => $Section, '`feeHead`' => $r->id, '`feeInstallment`' => $j, 'status' => 1,'feeInstallmentId'=>$feeInstallment));
                      $data = array(
                      '`standard`' => $Standard,
                      '`section`' => $Section,
                      '`feeHead`' => $r->id,
                      '`feeInstallment`' => $j,
                      '`amount`' => $amount,
                      '`feeSubmissionStartDate`' => $FeeStartDate,
                      '`feeSubmissionEndDate`' => $FeeEndDate,
                      '`created_by`' => $_SESSION['MUserId'],
                      '`academic_year`' => $r2->academic,
                      '`monthname`' => $Months, 
                      'status' => 1,
                      '`feeInstallmentId`' =>  $this->input->post('Feeinst'), 
                  );
        
                  $this->accounts_model->Save('fee_structure', $data);
                  $k++;
                  $return['res'] = 'success';
                  $return['msg'] = 'Saved!';
                                }
        
        
                            }
                        }
        
        
                        $i++;
                    }
                }

                echo json_encode($return);
                break;
            default:
                # code...
                break;
        }
    }

    public function view_fee_structure($action = null, $p1 = null, $p2 = null, $p3 = null)
    {
        switch ($action) {
            case null:

                $data['menu_id'] = $this->uri->segment(2);

                $data['title']          = 'View Fee Structure';
                $data['tb_url']            = current_url() . '/tb';
                $data['search']           = $this->input->post('search');
                $id = $_SESSION['MUserId'];
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/accounts/header', $data);
                $this->load->view('erp/accounts/view_fee_structure', $data);
                $this->load->view('erp/accounts/footer');
                break;
                case 'tb':
                $data['search'] = '';
                $search = 'null';

                if ($p1 != null) {
                    $data['search'] = $p1;
                    $search = $p1;
                }
                //end of section
                if (@$_POST['search']) {
                    $data['search'] = $_POST['search'];
                    $search = $_POST['search'];
                }
               
                $data['rows']           = $this->accounts_model->view_fee_structure($search);
                $data['Feeinstid'] = $this->input->post('Feeinst');
		        $data['Standard'] = $this->input->post('Standard');
                $data['fees_scheme']    = $this->accounts_model->getData('fee_scheme_master');
                $data['class']          = $this->accounts_model->getData('class_master');
                $data['fee_head']       = $this->accounts_model->getData('fee_head_master');
                $data['delete_url']     =   base_url() . 'view-fee-structure/delete/';
                $page                       = 'erp/accounts/tb_view_fee_structre';
                $this->load->view($page, $data);
                break;
                case 'delete':
                    $return['res'] = 'error';
                    $return['msg'] = 'Not Deleted!';
                    if ($p1 != null) {
                        if ($this->erp_model->_delete('fee_structure', ['feeInstallmentId' => $p1])) {
                            $saved = 1;
                            $return['res'] = 'success';
                            $return['msg'] = 'Successfully deleted.';
                        }
                    }
                    echo json_encode($return);
                    break;
                default:
                # code...
                break;
        }
    }
    public function changeIndexing()
	{
		if ($this->input->is_ajax_request()) {
			$data = explode(',',$_POST['data']);
			$id 	= $data[0];
			$tb 	= $data[1];
			$id_column  = $data[2];
			$val_column  = $data[3];
			$update = array($val_column => $_POST['value'],'is_locked'=>'LOCKED' );
			$cond = [$id_column => $id ];
			$this->accounts_model->Updates($tb,$update,$cond);	
		}
	}



    public function fee_collection($action = null, $p1 = null, $p2 = null, $p3 = null)
    {
        switch ($action) {
            case null:

                $data['menu_id'] = $this->uri->segment(2);

                $data['title']          = 'Fee Collection';
                $data['tb_url']            = current_url() . '/tb';
                $data['search']           = $this->input->post('search');
                $id = $_SESSION['MUserId'];
                $data['roles'] = $this->erp_model->view_role($id);
                $data['scheme']        = $this->accounts_model->view_data('fee_scheme_master');
                $this->load->view('erp/accounts/header', $data);
                $this->load->view('erp/accounts/fee_collection', $data);
                $this->load->view('erp/accounts/footer');
                break;
                case 'tb':
                    $data['enrollment'] = $this->input->post('enrollment');
                    $data['scheme'] = $this->input->post('scheme');
                    $data['month1'] = $this->input->post('month1');
                    $data['month2'] = $this->input->post('month2');
                    $data['month3'] = $this->input->post('month3');
                    $data['month4'] = $this->input->post('month4');
                    $data['month5'] = $this->input->post('month5');
                    $data['month6'] = $this->input->post('month6');
                    $data['month7'] = $this->input->post('month7');
                    $data['month8'] = $this->input->post('month8');
                    $data['month9'] = $this->input->post('month9');
                    $data['month10'] = $this->input->post('month10');
                    $data['month11'] = $this->input->post('month11');
                    $data['month12'] = $this->input->post('month12');
                $data['student']       = $this->accounts_model->getstudent($data['enrollment']);
                $page                       = 'erp/accounts/tb_fee_collection';
                $this->load->view($page, $data);
                break;
                 
                default:
                # code...
                break;
        }
    }


    public function PayonlineProcess()
	{
        
			$srno = $this->input->post('srno');
            $stu_id = $this->input->post('student_id');
            $enrollment = $this->input->post('stu_id');
			$Name = $this->input->post('name');
			$ClassName = $this->input->post('class_name');
            $class_id = $this->input->post('class_id');
			$SectionName = $this->input->post('section_name');
            $section_id = $this->input->post('sec_id');
			$Quarter = $this->input->post('Quarter');
			$TotalFee = $this->input->post('TotalFee');
			$tfine = $this->input->post('tfine');
			$remarkfine = $this->input->post('remarkfine');
			$QMonthname = $this->input->post('tmonth');
            $payment = $this->input->post('paytype');
            $installment = $this->input->post('installment');
            $month1 = $this->input->post('month1');
            $month2 = $this->input->post('month2');
            $month3 = $this->input->post('month3');
            $month4 = $this->input->post('month4');
            $month5 = $this->input->post('month5');
            $month6 = $this->input->post('month6');
            $month7 = $this->input->post('month7');
            $month8 = $this->input->post('month8');
            $month9 = $this->input->post('month9');
            $month10 = $this->input->post('month10');
            $month11 = $this->input->post('month11');
            $month12 = $this->input->post('month12');
            if(!empty($month1))
            {
                $one = $month1;
            }else
            {
                $one = '';
            }
            if(!empty($month2))
            {
                $two = $month2;
            }else
            {
                $two = '';
            }
            if(!empty($month3))
            {
                $three = $month3;
            }else
            {
                $three = '';
            }
            if(!empty($month4))
            {
                $four = $month4;
            }else
            {
                $four = '';
            }
            if(!empty($month5))
            {
                $five = $month5;
            }else
            {
                $five = '';
            }
            if(!empty($month6))
            {
                $six = $month6;
            }else
            {
                $six = '';
            }
            if(!empty($month7))
            {
                $seven = $month7;
            }else
            {
                $seven = '';
            }
            if(!empty($month8))
            {
                $eight = $month8;
            }else
            {
                $eight = '';
            }
            if(!empty($month9))
            {
                $nine = $month9;
            }else
            {
                $nine = '';
            }
            if(!empty($month10))
            {
                $ten = $month10;
            }else
            {
                $ten = '';
            }
            if(!empty($month11))
            {
                $eleven = $month11;
            }else
            {
                $eleven = '';
            }
            if(!empty($month12))
            {
                $twelve = $month12;
            }else
            {
                $twelve = '';
            }
			
	 	$sqlexist = "SELECT count(*) as feeno FROM fee_submitted WHERE srno='$srno' AND qmonthname LIKE '%$QMonthname%' AND academic_year='2023-24' ";
        $query = $this->db->query($sqlexist);
        $feeexist =  $query->result();
            foreach($feeexist as $fe)
            {
                $feenoex=$fe->feeno;
            }
            if($feenoex==0)
            {
                
		    $count = $this->accounts_model->Counter('fee_submitted', array('academic_year'=>'2023-24'));
	        $RCount=$count+1;
	        $RNo=str_pad($RCount, 5, '0', STR_PAD_LEFT);
		    $Receiptno="RABC23".$RNo;
				$f = array(
					'`srno`' => $srno,
                    '`enrollment`' => $enrollment,
                    '`student_id`' => $stu_id,
					'`student_name`' => $Name,
					'`class_name`' => $ClassName,
                    '`class_id`' => $class_id,
					'`section_name`' => $SectionName,
                    '`section_id`' => $section_id,
					'`quarter`' => $Quarter,
					'`qmonthname`' => $QMonthname,
					'`discription`' => '',
					'`submitted_fee`' => $TotalFee,
					'`fine`' => $tfine,
					'`RemarkFine`' => $remarkfine,
					'`submitted_date`' => date('Y-m-d'),
                    '`submitted_month`' => date('m'),
					'`Receiptno`' => $Receiptno,
					'`academic_year`' =>'2023-24',
                    '`payment_mode`' =>$payment,
                    '`installment`' =>$installment,
				);

				if($saveid = $this->accounts_model->Save('fee_submitted', $f))
                {
                    $f2 = array(
                        '`submitted_id`' => $saveid,
                        '`student_id`' => $stu_id,
                        '`month1`' => $one,
                        '`month2`' => $two,
                        '`month3`' => $three,
                        '`month4`' => $four,
                        '`month5`' => $five,
                        '`month6`' => $six,
                        '`month7`' => $seven,
                        '`month8`' => $eight,
                        '`month9`' => $nine,
                        '`month10`' => $ten,
                        '`month11`' => $eleven,
                        '`month12`' => $twelve,
                    );
                    $this->accounts_model->Save('fee_submitted_month', $f2);
                }
				$Msg = array('Msg' => 'Payment Successfully Paid.', 'Type' => 'success');
                $this->session->set_flashdata($Msg);
            } else {
                $Msg = array('Msg' => 'Already Paid Fees', 'Type' => 'danger');
                $this->session->set_flashdata($Msg);
                redirect(base_url('fee-collection'));
           
            }	
				$this->session->set_flashdata($Msg);
				redirect(base_url('fee-PrintReceipt/'.$Receiptno));
		

		}
	
        public function PrintReceipt($Receiptno=0)
        {
            $data['Receiptno'] = $Receiptno;
            $data['rs']        = $this->accounts_model->get_receipt_student($Receiptno);
            $data['menu_id'] = $this->uri->segment(2);
            $data['title']          = 'Fee Payment Receipt';
            $id = $_SESSION['MUserId'];
            $data['roles'] = $this->erp_model->view_role($id);
            $data['scheme']        = $this->accounts_model->view_data('fee_scheme_master');
            $this->load->view('erp/accounts/header', $data);
            $this->load->view('erp/accounts/PrintReceipt', $data);
            $this->load->view('erp/accounts/footer');
        }

        public function fee_collection_report($action = null, $p1 = null, $p2 = null, $p3 = null)
        {
            switch ($action) {
                case null:
    
                    $data['menu_id'] = $this->uri->segment(2);
    
                    $data['title']          = 'Fee Collection Report';
                    $data['tb_url']            = current_url() . '/tb';
                    $data['search']           = $this->input->post('search');
                    $id = $_SESSION['MUserId'];
                    $data['roles'] = $this->erp_model->view_role($id);
                    $this->load->view('erp/accounts/header', $data);
                    $this->load->view('erp/accounts/fee_collection_report', $data);
                    $this->load->view('erp/accounts/footer');
                    break;
                    case 'tb':
                    if(!empty($_POST['start_date']) && !empty($_POST['end_date']))
                    {
                       $start_date =   $data['start_date'] = $_POST['start_date'];
                       $end_date =  $data['end_date'] = $_POST['end_date'];
                    }else
                    {
                       $start_date =  $data['start_date'] = date('Y-m-d');
                       $end_date =  $data['end_date'] = date('Y-m-d');
                    } 
                    $data['rows']               = $this->accounts_model->getFee(); 
                    $data['tb_url']            = base_url() . 'fee-collection-report/tb';  
                    $page                       = 'erp/accounts/tb_fee_collection_report';
                    $this->load->view($page,$data);
                    break;
                     
                    default:
                    # code...
                    break;
            }
        }
public function student_fee_collection_report($action = null, $p1 = null, $p2 = null, $p3 = null)
  {
  switch ($action) {
  case null:
  $data['menu_id'] = $this->uri->segment(2);
  $data['title']          = 'Student Fee Collection Report';
  $data['tb_url']            = current_url() . '/tb';
  $data['search']           = $this->input->post('search');
  $id = $_SESSION['MUserId'];
  $data['roles'] = $this->erp_model->view_role($id);
  $this->load->view('erp/accounts/header', $data);
  $this->load->view('erp/accounts/student_fee_collection_report', $data);
  $this->load->view('erp/accounts/footer');
  break;
  case 'search_data':
    $id=$_SESSION['MUserId'];
    $searchTerm = $this->input->post('searchTerm');
    $data = $this->accounts_model->search_data($searchTerm);
    echo json_encode($data);
    break;  
    
    case 'view_fee':
    $id=$_SESSION['MUserId'];
    $data['roles']          = $this->erp_model->view_role($id);
    $data['title']          = 'Fee Collection Report';
    $data['rows']           = $this->accounts_model->get_student_fee($p1);
    $this->load->view('erp/accounts/header',$data);
    $this->load->view('erp/accounts/view_student_fee',$data);
    $this->load->view('erp/accounts/footer');
    break; 
  default:
    # code...
   break;
  }
}


public function student_fee_defaulter_list($action = null, $p1 = null, $p2 = null, $p3 = null)
{
    switch ($action) {
        case null:

            $data['menu_id'] = $this->uri->segment(2);

            $data['title']          = 'Student Fee Defaulter List';
            $data['tb_url']            = current_url() . '/tb';
            $data['search']           = $this->input->post('search');
            $data['section']          = $this->accounts_model->getData('section_master');
            $id = $_SESSION['MUserId'];
            $data['curmonth'] = date('m');
            $data['roles'] = $this->erp_model->view_role($id);
            $this->load->view('erp/accounts/header', $data);
            $this->load->view('erp/accounts/fee_defaulter_list', $data);
            $this->load->view('erp/accounts/footer');
            break;
        case 'tb':
            $data['search'] = '';
            $search = 'null';

            if ($p1 != null) {
                $data['search'] = $p1;
                $search = $p1;
            }
            //end of section
            if (@$_POST['search']) {
                $data['search'] = $_POST['search'];
                $search = $_POST['search'];
            }
            if(!empty($_POST['section']))
            {
                $data['section'] = $section = $_POST['section'];
            }else
            {
                $data['section'] = $section =''; 
            }
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url() . "student-fee-defaulter-list/tb";
            $config["total_rows"]   = count($this->accounts_model->getdefaulterlist($section,$search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 100;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1 != null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['rows']           = $this->accounts_model->getdefaulterlist($section,$search, $config["per_page"], $page);
            $page                       = 'erp/accounts/tb_feedefaulter';
            $this->load->view($page, $data);
            break;
            default:
            # code...
           break;
          }
        }
        public function section_wise_fee_collection_report($action = null, $p1 = null, $p2 = null, $p3 = null)
        {
            switch ($action) {
                case null:
    
                    $data['menu_id'] = $this->uri->segment(2);
    
                    $data['title']          = 'Section Wise Fee Collection Report';
                    $data['tb_url']            = current_url() . '/tb';
                    $data['search']           = $this->input->post('search');
                    $id = $_SESSION['MUserId'];
                    $data['roles'] = $this->erp_model->view_role($id);
                    $this->load->view('erp/accounts/header', $data);
                    $this->load->view('erp/accounts/section_fee_collection_report', $data);
                    $this->load->view('erp/accounts/footer');
                    break;
                    case 'tb':
                    if(!empty($_POST['start_date']) && !empty($_POST['end_date']) && !empty($_POST['section']))
                    {
                       $start_date =   $data['start_date'] = $_POST['start_date'];
                       $end_date =  $data['end_date'] = $_POST['end_date'];
                       $section1 =  $data['section1'] = $_POST['section'];
                    }else
                    {
                       $start_date =  $data['start_date'] = date('Y-m-d');
                       $end_date =  $data['end_date'] = date('Y-m-d');
                       $section1 =  $data['section1'] ='';
                    } 
                    $data['section']          = $this->accounts_model->getData('section_master');
                    $data['rows']               = $this->accounts_model->getFeesection(); 
                    $data['tb_url']            = base_url() . 'section-wise-fee-collection-report/tb';  
                    $page                       = 'erp/accounts/tb_section_fee_collection_report';
                    $this->load->view($page,$data);
                    break;
                     
                    default:
                    # code...
                    break;
            }
        }        
        public function fee_collection_this_month_report($action = null, $p1 = null, $p2 = null, $p3 = null)
        {
            switch ($action) {
                case null:
    
                    $data['menu_id'] = $this->uri->segment(2);
    
                    $data['title']          = 'Fee Collection This Month Report';
                    $data['tb_url']            = current_url() . '/tb';
                    $data['search']           = $this->input->post('search');
                    $id = $_SESSION['MUserId'];
                    $data['roles'] = $this->erp_model->view_role($id);
                    $this->load->view('erp/accounts/header', $data);
                    $this->load->view('erp/accounts/fee_collection_month_report', $data);
                    $this->load->view('erp/accounts/footer');
                    break;
                    case 'tb':
                    if(!empty($_POST['start_month']))
                    {
                       $curmonth =   $data['curmonth'] = $_POST['start_month'];
                    }else
                    {
                       $curmonth =  $data['curmonth'] = date('m');
                    } 
                    $data['rows']               = $this->accounts_model->getFeeMonth(); 
                    $data['tb_url']            = base_url() . 'fee-collection-this-month-report/tb';  
                    $page                       = 'erp/accounts/tb_fee_collection_month_report';
                    $this->load->view($page,$data);
                    break;
                     
                    default:
                    # code...
                    break;
            }
        }
        

public function this_month_paid_fee_student($action = null, $p1 = null, $p2 = null, $p3 = null)
{
    switch ($action) {
        case null:

            $data['menu_id'] = $this->uri->segment(2);

            $data['title']          = 'This Month Fee Paid Student';
            $data['tb_url']            = current_url() . '/tb';
            $data['search']           = $this->input->post('search');
            $id = $_SESSION['MUserId'];
            $data['roles'] = $this->erp_model->view_role($id);
            $this->load->view('erp/accounts/header', $data);
            $this->load->view('erp/accounts/this_month_paid_fee_student', $data);
            $this->load->view('erp/accounts/footer');
            break;
            case 'tb':
          if(date('m')==1)
          {
            $data1=['t2.month10'=>'1','t1.is_deleted'=>'NOT_DELETED'];
          }elseif(date('m')==2)
          {
            $data1=['t2.month11'=>'2','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==3)
          {
            $data1=['t2.month12'=>'3','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==4)
          {
            $data1=['t2.month1'=>'4','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==5)
          {
            $data1=['t2.month2'=>'5','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==6)
          {
            $data1=['t2.month3'=>'6','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==7)
          {
            $data1=['t2.month4'=>'7','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==8)
          {
            $data1=['t2.month5'=>'8','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==9)
          {
            $data1=['t2.month6'=>'9','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==10)
          {
            $data1=['t2.month7'=>'10','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==11)
          {
            $data1=['t2.month8'=>'11','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==12)
          {
            $data1=['t2.month9'=>'12','t1.is_deleted'=>'NOT_DELETED'];
          }
            $data['rows']               = $this->accounts_model->this_month_paid_student1($data1); 
            $data['tb_url']            = base_url() . 'this-month-paid-fee-student/tb';  
            $page                       = 'erp/accounts/tb_this_month_paid_fee_student';
            $this->load->view($page,$data);
            break;
             
            default:
            # code...
            break;
    }
}


public function this_month_unpaid_fee_student($action = null, $p1 = null, $p2 = null, $p3 = null)
{
    switch ($action) {
        case null:

            $data['menu_id'] = $this->uri->segment(2);

            $data['title']          = 'This Month Fee Unpaid Student';
            $data['tb_url']            = current_url() . '/tb';
            $data['search']           = $this->input->post('search');
            $id = $_SESSION['MUserId'];
            $data['roles'] = $this->erp_model->view_role($id);
            $this->load->view('erp/accounts/header', $data);
            $this->load->view('erp/accounts/this_month_unpaid_fee_student', $data);
            $this->load->view('erp/accounts/footer');
            break;
            case 'tb':
          if(date('m')==1)
          {
            $data1=['t2.month10'=>'1','t1.is_deleted'=>'NOT_DELETED'];
          }elseif(date('m')==2)
          {
            $data1=['t2.month11'=>'2','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==3)
          {
            $data1=['t2.month12'=>'3','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==4)
          {
            $data1=['t2.month1'=>'4','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==5)
          {
            $data1=['t2.month2'=>'5','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==6)
          {
            $data1=['t2.month3'=>'6','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==7)
          {
            $data1=['t2.month4'=>'7','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==8)
          {
            $data1=['t2.month5'=>'8','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==9)
          {
            $data1=['t2.month6'=>'9','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==10)
          {
            $data1=['t2.month7'=>'10','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==11)
          {
            $data1=['t2.month8'=>'11','t1.is_deleted'=>'NOT_DELETED'];
          }
          elseif(date('m')==12)
          {
            $data1=['t2.month9'=>'12','t1.is_deleted'=>'NOT_DELETED'];
          }
            $data['student']               = $this->accounts_model->this_month_paid_student1($data1); 
             $i=0;foreach($data['student']  as $stu)
            {    
                
                $data2 = ['t1.id !='=>$stu->student_id,'t1.regstatus'=>'1','t1.IsLeft'=>'0','t1.is_deleted'=>'NOT_DELETED'];
                $data['rows']               = $this->accounts_model->this_month_unpaid_student1($data2); 
           $i++; }
           
            
            $data['tb_url']            = base_url() . 'this-month-unpaid-fee-student/tb';  
            $page                       = 'erp/accounts/tb_this_month_unpaid_fee_student';
            $this->load->view($page,$data);
            break;
             
            default:
            # code...
            break;
    }
}




}
