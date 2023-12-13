<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Inst.php');
class Hrm extends Inst {

    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {
         $id=$_SESSION['MUserId'];
        $data['title']='Hrm Dashboard';
        $data['total_student']=$this->admission_model->count_row_student('v_section_alloted');
        $data['total_class']=$this->admission_model->count_row('class_master');
        $data['total_left']=$this->admission_model->left_count_row('v_sec_student');
        $data['total_role']=$this->admission_model->count_row('role_master');
        $data['total_teacher']=$this->hrm_model->count_row('teacher_master');
        $data['total_room']=$this->hrm_model->count_row('room_master');
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/hrm/header',$data);
        $this->load->view('erp/hrm/index',$data);
        $this->load->view('erp/hrm/footer');
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
        $this->load->view('erp/hrm/header',$data);
        $this->load->view('erp/hrm/my_profile',$data);
        $this->load->view('erp/hrm/footer');
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
      public function teacher_info($action=null,$p1=null,$p2=null,$p3=null)
    {
         $id=$_SESSION['MUserId'];
        switch ($action) {
            case null:
                $data['menu_id'] = $this->uri->segment(2);
                $data['title']          = 'Teachers  Information';
                $data['new_url']         = base_url().'teacher-information/teacher_create';
                $data['tb_url']            = current_url().'/tb';
                $data['search']            = $this->input->post('search');
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/hrm/header',$data);
                $this->load->view('erp/hrm/teacher_info',$data);
                $this->load->view('erp/hrm/footer');
                break;
         case 'tb':
         $data['search'] = '';
         $search='null';
        
         if($p1!=null)
                 {
         $data['search'] = $p1;
         $search = $p1;
                 }
                 //end of section
         if (@$_POST['search']) {
         $data['search'] = $_POST['search'];
         $search=$_POST['search'];
                
                 }
         $this->load->library('pagination');
         $config = array();
         $config["base_url"]    = base_url()."teacher-information/tb";
         $config["total_rows"]      = count($this->hrm_model->teacher_data1($search));
         $data['total_rows']        = $config["total_rows"];
         $config["per_page"]        = 10;
         $config["uri_segment"]     = 2;
         $config['attributes']      = array('class' => 'pag-link ');
         $this->pagination->initialize($config);
         $data['links']             = $this->pagination->create_links();
         $data['page']              = $page = ($p1!=null) ? $p1 : 0;
         $data['search']            = $this->input->post('search');
         $data['update_url']        =base_url().'teacher-information/teacher_create/';
         $data['upload_doc_url']        =base_url().'teacher-information/document/';
         $data['delete_url']        =base_url().'teacher-information/delete/';  
         $data['rows']              = $this->hrm_model->teacher_data1($search,$config["per_page"],$page);
         $page                      = 'erp/hrm/tb_teacher';
         $this->load->view($page, $data); 
         break;

                case 'teacher_create':
                    $data['action_url']         = base_url().'teacher-information/save';
                    $data['total_data']=0;
                    $page                       = 'erp/hrm/teacher_create';
                    if ($p1!=null) {
                        $data['update_url']     = base_url().'teacher-information/save/'.$p1;
                        $data['teacher']         = $this->erp_model->teacher_data_view($p1);
                        $data['total_data']         = $this->erp_model->teacher_row_count($p1);
                        $page                   = 'erp/hrm/teacher_create';
                    }
                    $data['form_id']            = uniqid();
                    $this->load->view($page, $data);
                    break;
              case 'save':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';

                if ($this->input->server('REQUEST_METHOD')=='POST') { 
                  
                     if ($id!=null) {
                        $data = array(
                            'name'     => $this->input->post('name'),
                            'father_name'  => $this->input->post('fname'),
                            'phone'   => $this->input->post('number'),
                            'username'      => $this->input->post('email'),
                            'email'      => $this->input->post('email'),
                            'address'        => $this->input->post('address'),
                            'pan'       => $this->input->post('pannumber'),
                            'adhaar'        => $this->input->post('aadhaar'),
                            'joindate'        => $this->input->post('joindata'),
                            'teaching_qualification' => $this->input->post('teacherqualification'),
                            'status'        =>1,
                        );
                            
                        if($this->erp_model->UpdateData('teacher_master',$data,$id)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                        }
                    }
                    else{ 
                        $data = array(
                            'name'     => $this->input->post('name'),
                            'father_name'  => $this->input->post('fname'),
                            'phone'   => $this->input->post('number'),
                            'email'      => $this->input->post('email'),
                            'username'      => $this->input->post('email'),
                            'address'        => $this->input->post('address'),
                            'pan'       => $this->input->post('pannumber'),
                            'adhaar'        => $this->input->post('aadhaar'),
                            'joindate'        => $this->input->post('joindata'),
                            'teaching_qualification' => $this->input->post('teacherqualification'),
                            'status'        =>1,
                            );
                        if ($this->erp_model->Insert('teacher_master',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                            
                        }
                    }
                }
                echo json_encode($return);
                //$this->load->view('');
                break;
                case 'document':
                 $data['action_url']         = base_url().'teacher-information/save_document/'.$p1;
                 $data['count']           = $this->hrm_model->check_teacher_doc_row('teacher_master',$p1);
                 $page                   = 'erp/hrm/teacher_document';
                 $data['form_id']            = uniqid();
                 $this->load->view($page, $data);
                break;    
                case 'save_document':
                    $id = $p1;
                    $return['res'] = 'error';
                    $return['msg'] = 'Not Saved!';
    
                    if ($this->input->server('REQUEST_METHOD')=='POST') { 
                     
                         if ($id!=null) {
                            $config['file_name'] = rand(10000, 10000000000);    
                            $config['upload_path'] = UPLOAD_PATH.'teacher/';
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                     
                            if (!empty($_FILES['pic']['name'])) {
                     
                              //upload doc
                              $_FILES['pics']['name'] = $_FILES['pic']['name'];
                              $_FILES['pics']['type'] = $_FILES['pic']['type'];
                              $_FILES['pics']['tmp_name'] = $_FILES['pic']['tmp_name'];
                              $_FILES['pics']['size'] = $_FILES['pic']['size'];
                              $_FILES['pics']['error'] = $_FILES['pic']['error'];
                     
                              if ($this->upload->do_upload('pics')) {
                                  $image_data = $this->upload->data();
                               
                                  $fileName = "teacher/" . $image_data['file_name'];
                              }
                             $pic=$data['pic'] = $fileName;
                              } else {
                             $pic = $data['pic'] = "";
                             }
                             if (!empty($_FILES['doc']['name'])) {
                     
                                //upload doc
                                $_FILES['docs']['name'] = $_FILES['doc']['name'];
                                $_FILES['docs']['type'] = $_FILES['doc']['type'];
                                $_FILES['docs']['tmp_name'] = $_FILES['doc']['tmp_name'];
                                $_FILES['docs']['size'] = $_FILES['doc']['size'];
                                $_FILES['docs']['error'] = $_FILES['doc']['error'];
                       
                                if ($this->upload->do_upload('docs')) {
                                    $image_data = $this->upload->data();
                                 
                                    $fileName = "teacher/" . $image_data['file_name'];
                                }
                               $doc=$data['doc'] = $fileName;
                                } else {
                               $doc = $data['doc'] = "";
                               }
                               if (!empty($_FILES['doc1']['name'])) {
                     
                                //upload doc
                                $_FILES['doc1s']['name'] = $_FILES['doc1']['name'];
                                $_FILES['doc1s']['type'] = $_FILES['doc1']['type'];
                                $_FILES['doc1s']['tmp_name'] = $_FILES['doc1']['tmp_name'];
                                $_FILES['doc1s']['size'] = $_FILES['doc1']['size'];
                                $_FILES['doc1s']['error'] = $_FILES['doc1']['error'];
                       
                                if ($this->upload->do_upload('doc1s')) {
                                    $image_data = $this->upload->data();
                                 
                                    $fileName = "teacher/" . $image_data['file_name'];
                                }
                               $doc1=$data['doc1'] = $fileName;
                                } else {
                               $doc1 = $data['doc1'] = "";
                               }
                               if (!empty($_FILES['doc2']['name'])) {
                     
                                //upload doc
                                $_FILES['doc2s']['name'] = $_FILES['doc2']['name'];
                                $_FILES['doc2s']['type'] = $_FILES['doc2']['type'];
                                $_FILES['doc2s']['tmp_name'] = $_FILES['doc2']['tmp_name'];
                                $_FILES['doc2s']['size'] = $_FILES['doc2']['size'];
                                $_FILES['doc2s']['error'] = $_FILES['doc2']['error'];
                       
                                if ($this->upload->do_upload('doc2s')) {
                                    $image_data = $this->upload->data();
                                 
                                    $fileName = "teacher/" . $image_data['file_name'];
                                }
                               $doc2=$data['doc2'] = $fileName;
                                } else {
                               $doc2 = $data['doc2'] = "";
                               }
                            if($pic !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc'      => $this->input->post('ifsccode'),
                                    'self_pic'      => $pic,
                                    'doc_type'      =>'1',
                                );
                            }elseif($doc !=''){
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc'      => $this->input->post('ifsccode'),
                                    'adharfile'       => $doc,
                                    'doc_type'      =>'1',
                                );
                            }elseif($doc1 !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc'      => $this->input->post('ifsccode'),
                                    'panfile'        => $doc1,
                                    'doc_type'      =>'1',
                                ); 
                            }elseif($doc2 !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc'      => $this->input->post('ifsccode'),
                                    'bank_passbook'        => $doc2,
                                    'doc_type'      =>'1',
                                );  
                            }else{   
                            $data = array(
                                'account_holder_name'     => $this->input->post('name'),
                                'bank'  => $this->input->post('bankname'),
                                'account_number'   => $this->input->post('accountnumber'),
                                'ifsc'      => $this->input->post('ifsccode'),
                                'self_pic'      => $pic,
                                'panfile'        => $doc1,
                                'adharfile'       => $doc,
                                'bank_passbook'        => $doc2,
                                'doc_type'      =>'1',
                            );
                        }  
                            if($this->hrm_model->UpdateData('teacher_master',$data,$id)){
                                $return['res'] = 'success';
                                $return['msg'] = 'Updated.';
                            }
                        }
                        else
                        {
                            $return['res'] = 'error';
                            $return['msg'] = 'Failed.';
                        }
                    }
                    echo json_encode($return);
                    //$this->load->view('');
                    break;
                case 'delete':
                    $return['res'] = 'error';
                    $return['msg'] = 'Not Deleted!';
                    if ($p1!=null) {
                    if($this->erp_model->_delete('teacher_master',['id'=>$p1])){
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

    public function room_remote($type,$id=null,$column='name')
    {
        if ($type=='room') {
            $tb = 'room_master';
        }
        else{

        }
        $this->db->where($column,$_GET[$column]);
        if($id!=NULL){
            $this->db->where('id != ',$id);
        }
        $count=$this->db->count_all_results($tb);
        if($count>0)
        {
            echo "false";
        }
        else
        {
            echo "true";
        }        
    }
    public function room_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
         $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Room Master';
        $data['new_url']         = base_url().'room-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/hrm/header',$data);
        $this->load->view('erp/hrm/room_master',$data);
        $this->load->view('erp/hrm/footer');
        break;
        case 'tb':
            $data['search'] = '';
            $search='null';
           
            if($p1!=null)
                    {
            $data['search'] = $p1;
            $search = $p1;
                    }
                    //end of section
            if (@$_POST['search']) {
            $data['search'] = $_POST['search'];
            $search=$_POST['search'];
                   
                    }
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."room-master/tb";
            $config["total_rows"]   = count($this->hrm_model->room_master($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'room-master/delete/';
            $data['update_url']       =base_url().'room-master/create/';
            $data['rows']           = $this->hrm_model->room_master($search,$config["per_page"],$page);
            $page                       = 'erp/hrm/tb_room';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'room_remote/room/';
        $data['action_url']         = base_url().'room-master/save';
        $data['total_data']=0;
        $page               = 'erp/hrm/room_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'room-master/save/'.$p1;
        $data['room']         = $this->hrm_model->view_data_id('room_master',$p1);
        $data['total_data']         = $this->hrm_model->count_row_id('room_master',$p1);
        $page           = 'erp/hrm/room_create';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
   	 //doc upload code
     if($p1!=null){
     
         $data = array(
         'name'     => $this->input->post('name'),
          );
         if ($this->erp_model->UpdateData('room_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
         $id=$_SESSION['MUserId'];
        $data = array(
            'name'     => $this->input->post('name'),
            'status'        =>1,
            'created_by'      =>$id,
         );
        if ($this->erp_model->Save('room_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/hrm/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('room_master',['id'=>$p1])){
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
  

    public function role_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
         $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Role Master';
        $data['new_url']         = base_url().'role-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/hrm/header',$data);
        $this->load->view('erp/hrm/role_master',$data);
        $this->load->view('erp/hrm/footer');
        break;
        case 'tb':
            $data['search'] = '';
            $search='null';
           
            if($p1!=null)
                    {
            $data['search'] = $p1;
            $search = $p1;
                    }
                    //end of section
            if (@$_POST['search']) {
            $data['search'] = $_POST['search'];
            $search=$_POST['search'];
                   
                    }
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."role-master/tb";
            $config["total_rows"]   = count($this->hrm_model->role_master($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'role-master/delete/';
            $data['update_url']       =base_url().'role-master/create/';
            $data['rows']           = $this->hrm_model->role_master($search,$config["per_page"],$page);
            $page                       = 'erp/hrm/tb_role';
            $this->load->view($page, $data); 
            break;
        case 'create':
        if ($p1!=null) {
        $data['action_url']         = base_url().'role-master/save/'.$p1;
        $data['role']         = $this->hrm_model->view_data_id('role_master',$p1);
        $page           = 'erp/hrm/role_create';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
   	 //doc upload code
     if($p1!=null){
     
         $data = array(
         'role_name'     => $this->input->post('name'),
          );
         if ($this->erp_model->UpdateData('role_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }
        }
        
        echo json_encode($return);
        //$this->load->view('erp/hrm/create_notice');
        break;
            default:
        # code...
        break;
        }
    }  
    public function role_assign_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
         $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Role Assign Master';
        $data['new_url']         = base_url().'role-assign-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/hrm/header',$data);
        $this->load->view('erp/hrm/role_assign',$data);
        $this->load->view('erp/hrm/footer');
        break;
        case 'tb':
            $data['search'] = '';
            $search='null';
           
            if($p1!=null)
                    {
            $data['search'] = $p1;
            $search = $p1;
                    }
                    //end of section
            if (@$_POST['search']) {
            $data['search'] = $_POST['search'];
            $search=$_POST['search'];
                   
                    }
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."role-assign-master/tb";
            $config["total_rows"]   = count($this->hrm_model->role_assign_master($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'role-assign-master/delete/';
            $data['update_url']       =base_url().'role-assign-master/create/';
            $data['rows']           = $this->hrm_model->role_assign_master($search,$config["per_page"],$page);
            $page                       = 'erp/hrm/tb_role_assign';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['action_url']         = base_url().'role-assign-master/save';
        $data['role']         = $this->hrm_model->view_data('role_master');
        $data['teacher']         = $this->hrm_model->view_data('teacher_master');
        $data['total_data']=0;
        $page               = 'erp/hrm/role_assign_create';
        if ($p1!=null) {
            $data['role']         = $this->hrm_model->view_data('role_master');
            $data['teacher']         = $this->hrm_model->view_data('teacher_master');
        $data['action_url']         = base_url().'role-assign-master/save/'.$p1;
        $data['roles']         = $this->hrm_model->view_data_id('role_assign_master',$p1);
        $data['total_data']         = $this->hrm_model->count_row_id('role_assign_master',$p1);
        $page           = 'erp/hrm/role_assign_create';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
   	 //doc upload code
     if($p1!=null){
     
         $data = array(
         'user_id'     => $this->input->post('user'),
         'role_id'     => $this->input->post('role'),
          );
          $count = $this->erp_model->Counter('role_assign_master', array('user_id'=>$this->input->post('user'),'role_id'=>$this->input->post('role'),'is_deleted'=>'NOT_DELETED'));
          if($count ==0)
          {
         if ($this->erp_model->UpdateData('role_assign_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
          }
        }else{
            $return['res'] = 'error';
            $return['msg'] = 'Duplicate Entery Not Allowed.';
        }
     }else
     {
         $id=$_SESSION['MUserId'];
        $data = array(
            'user_id'     => $this->input->post('user'),
            'role_id'     => $this->input->post('role'),
            'status'        =>1,
         );
         $count = $this->erp_model->Counter('role_assign_master', array('user_id'=>$this->input->post('user'),'role_id'=>$this->input->post('role'),'is_deleted'=>'NOT_DELETED'));
         if($count ==0)
         {
        if ($this->erp_model->Save('role_assign_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
        }else{
            $return['res'] = 'error';
            $return['msg'] = 'Duplicate Entery Not Allowed.';
        }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/hrm/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('role_assign_master',['id'=>$p1])){
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

  public function working_hour_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
         $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Set Working Hours Master';
        $data['new_url']         = base_url().'working-hour-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/hrm/header',$data);
        $this->load->view('erp/hrm/working_hour_master',$data);
        $this->load->view('erp/hrm/footer');
        break;
        case 'tb':
            $data['search'] = '';
            $search='null';
           
            if($p1!=null)
                    {
            $data['search'] = $p1;
            $search = $p1;
                    }
                    //end of section
            if (@$_POST['search']) {
            $data['search'] = $_POST['search'];
            $search=$_POST['search'];
                   
                    }
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."working-hour-master/tb";
            $config["total_rows"]   = count($this->hrm_model->attendance_master($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'working-hour-master/delete/';
            $data['update_url']       =base_url().'working-hour-master/create/';
            $data['rows']           = $this->hrm_model->attendance_master($search,$config["per_page"],$page);
            $page                       = 'erp/hrm/tb_working_hours';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['action_url']         = base_url().'working-hour-master/save';
        $data['school']             = $this->hrm_model->getData('institute');
        $data['role']         = $this->hrm_model->view_data('role_master');
        $data['total_data']=0;
        $page               = 'erp/hrm/working_hour_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'working-hour-master/save/'.$p1;
        $data['att']         = $this->hrm_model->view_data_id('attendance_master',$p1);
        $data['total_data']         = $this->hrm_model->count_row_id('attendance_master',$p1);
        $data['school']             = $this->hrm_model->getData('institute');
        $data['role']         = $this->hrm_model->view_data('role_master');
        $page           = 'erp/hrm/working_hour_create';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
     //doc upload code
     if($p1!=null){
     
         $data = array(
            'school_id'     => $this->input->post('school'),
            'role_id'     => $this->input->post('role'),
            'start_time'     => $this->input->post('start_time'),
            'end_time'     => $this->input->post('end_time'),
          );
         if ($this->erp_model->UpdateData('attendance_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
         $id=$_SESSION['MUserId'];
        $data = array(
            'school_id'     => $this->input->post('school'),
            'role_id'     => $this->input->post('role'),
            'start_time'     => $this->input->post('start_time'),
            'end_time'     => $this->input->post('end_time'),
            'status'        =>1,
            'created_by'      =>$id,
         );
        if ($this->erp_model->Save('attendance_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
      


        }
        
        echo json_encode($return);
        //$this->load->view('erp/hrm/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('attendance_master',['id'=>$p1])){
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







}   