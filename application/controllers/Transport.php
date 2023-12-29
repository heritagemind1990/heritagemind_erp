<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Inst.php');
class Transport extends Inst {

    public function __construct()
    {
        parent::__construct();
    }
 
    public function dashboard()
    {
       $id=$_SESSION['MUserId'];
        
        $data['title']='Transport Dashboard';
        $data['total_drivers']=$this->transport_model->count_row('transport_drivers');
        $data['total_conductors']=$this->transport_model->count_row('transport_conductors');
        $data['total_vehicle']=$this->transport_model->count_row('transport_vehicle');
        $data['total_route']=$this->transport_model->count_row('transport_route');
        $data['total_sub_route']=$this->transport_model->count_row('transport_sub_route');
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/transport/header',$data);
        $this->load->view('erp/transport/index',$data);
        $this->load->view('erp/transport/footer');
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
        $this->load->view('erp/transport/header',$data);
        $this->load->view('erp/transport/my_profile',$data);
        $this->load->view('erp/transport/footer');
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
    public function drivers_master($action=null,$p1=null,$p2=null,$p3=null)
    {
         $id=$_SESSION['MUserId'];
        switch ($action) {
            case null:
                $data['title']          = 'Drivers Master';
                $data['new_url']         = base_url().'drivers-master/driver_create';
                $data['tb_url']            = current_url().'/tb';
                $data['search']            = $this->input->post('search');
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/transport/header',$data);
                $this->load->view('erp/transport/drivers_master',$data);
                $this->load->view('erp/transport/footer');
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
         $config["base_url"]    = base_url()."drivers-master/tb";
         $config["total_rows"]      = count($this->transport_model->driver_master($search));
         $data['total_rows']        = $config["total_rows"];
         $config["per_page"]        = 10;
         $config["uri_segment"]     = 2;
         $config['attributes']      = array('class' => 'pag-link ');
         $this->pagination->initialize($config);
         $data['links']             = $this->pagination->create_links();
         $data['page']              = $page = ($p1!=null) ? $p1 : 0;
         $data['search']            = $this->input->post('search');
         $data['update_url']        =base_url().'drivers-master/driver_create/';
         $data['upload_doc_url']        =base_url().'drivers-master/document/';
         $data['delete_url']        =base_url().'drivers-master/delete/';  
         $data['rows']              = $this->transport_model->driver_master($search,$config["per_page"],$page);
         $page                      = 'erp/transport/tb_driver';
         $this->load->view($page, $data); 
         break;

                case 'driver_create':
                    $data['action_url']         = base_url().'drivers-master/save';
                    $data['total_data']=0;
                    $page                       = 'erp/transport/driver_create';
                    if ($p1!=null) {
                        $data['update_url']     = base_url().'drivers-master/save/'.$p1;
                        $data['driver']         = $this->transport_model->view_data_id('transport_drivers',$p1);
                        $data['total_data']         = $this->transport_model->count_row_id('transport_drivers',$p1);
                        $page                   = 'erp/transport/driver_create';
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
                            'mobile'   => $this->input->post('mobile'),
                            'email'      => $this->input->post('email'),
                            'address'      => $this->input->post('address'),
                            'dl'        => $this->input->post('dl_type'),
                            'dl_number'       => $this->input->post('dl_number'),
                            'aadhaar'        => $this->input->post('aadhaar'),
                            'pan_number'        => $this->input->post('pan_number'),
                            'qualification' => $this->input->post('qualification'),
                            'state' => $this->input->post('state'),
                            'city' => $this->input->post('city'),
                            'pincode' => $this->input->post('pincode'),
                            'created_by' => $_SESSION['MUserId'],
                            'joindate' => $this->input->post('joindate'),
                            'status'        =>1,
                        );
                            
                        if($this->erp_model->UpdateData('transport_drivers',$data,$id)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                        }
                    }
                    else{ 
                        $data = array(
                            'name'     => $this->input->post('name'),
                            'father_name'  => $this->input->post('fname'),
                            'mobile'   => $this->input->post('mobile'),
                            'email'      => $this->input->post('email'),
                            'address'      => $this->input->post('address'),
                            'dl'        => $this->input->post('dl_type'),
                            'dl_number'       => $this->input->post('dl_number'),
                            'aadhaar'        => $this->input->post('aadhaar'),
                            'pan_number'        => $this->input->post('pan_number'),
                            'qualification' => $this->input->post('qualification'),
                            'state' => $this->input->post('state'),
                            'city' => $this->input->post('city'),
                            'pincode' => $this->input->post('pincode'),
                            'created_by' => $_SESSION['MUserId'],
                            'joindate' => $this->input->post('joindate'),
                            'status'        =>1,
                            );
                        if ($this->erp_model->Insert('transport_drivers',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                            
                        }
                    }
                }
                echo json_encode($return);
                //$this->load->view('');
                break;
                case 'document':
                 $data['action_url']         = base_url().'drivers-master/save_document/'.$p1;
                 $data['count']           = $this->transport_model->check_teacher_doc_row('transport_drivers',$p1);
                 $page                   = 'erp/transport/driver_documents';
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
                            $config['upload_path'] = UPLOAD_PATH.'drivers/';
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
                               
                                  $fileName = "drivers/" . $image_data['file_name'];
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
                                 
                                    $fileName = "drivers/" . $image_data['file_name'];
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
                                 
                                    $fileName = "drivers/" . $image_data['file_name'];
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
                                 
                                    $fileName = "drivers/" . $image_data['file_name'];
                                }
                               $doc2=$data['doc2'] = $fileName;
                                } else {
                               $doc2 = $data['doc2'] = "";
                               }
                                 if (!empty($_FILES['doc3']['name'])) {
                     
                                //upload doc
                                $_FILES['doc3s']['name'] = $_FILES['doc3']['name'];
                                $_FILES['doc3s']['type'] = $_FILES['doc3']['type'];
                                $_FILES['doc3s']['tmp_name'] = $_FILES['doc3']['tmp_name'];
                                $_FILES['doc3s']['size'] = $_FILES['doc3']['size'];
                                $_FILES['doc3s']['error'] = $_FILES['doc3']['error'];
                       
                                if ($this->upload->do_upload('doc3s')) {
                                    $image_data = $this->upload->data();
                                 
                                    $fileName = "drivers/" . $image_data['file_name'];
                                }
                               $doc3=$data['doc3'] = $fileName;
                                } else {
                               $doc3 = $data['doc3'] = "";
                               }
                           if($pic !='' && $doc !='' && $doc1 !='' && $doc2 !='' && $doc3 !=''){
                                 $data = array(
                                'account_holder_name'     => $this->input->post('name'),
                                'bank_name'  => $this->input->post('bankname'),
                                'account_number'   => $this->input->post('accountnumber'),
                                'ifsc_code'      => $this->input->post('ifsccode'),
                                'branch_name'      => $this->input->post('branch_name'),
                                'photo'      => $pic,
                                'pan_photo'        => $doc1,
                                'aadhaar_file'       => $doc,
                                'bank_passbook'        => $doc2,
                                'dl_photo'        => $doc3,
                                'doc_type'      =>'1',
                            );
                           } elseif($pic !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'photo'      => $pic,
                                    'doc_type'      =>'1',
                                );
                            }elseif($doc !=''){
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'aadhaar_file'       => $doc,
                                    'doc_type'      =>'1',
                                );
                            }elseif($doc1 !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'pan_photo'        => $doc1,
                                    'doc_type'      =>'1',
                                ); 
                            }elseif($doc2 !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'bank_passbook'        => $doc2,
                                    'doc_type'      =>'1',
                                );  
                            }
                            elseif($doc3 !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'dl_photo'        => $doc3,
                                    'doc_type'      =>'1',
                                );  
                            }  
                            if($this->transport_model->UpdateData('transport_drivers',$data,$id)){
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
                    if($this->erp_model->_delete('transport_drivers',['id'=>$p1])){
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
    public function conductors_masters($action=null,$p1=null,$p2=null,$p3=null)
    {
         $id=$_SESSION['MUserId'];
        switch ($action) {
            case null:
                $data['title']          = 'Conductors Master';
                $data['new_url']         = base_url().'conductors-master/driver_create';
                $data['tb_url']            = current_url().'/tb';
                $data['search']            = $this->input->post('search');
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/transport/header',$data);
                $this->load->view('erp/transport/conductors_master',$data);
                $this->load->view('erp/transport/footer');
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
         $config["base_url"]    = base_url()."conductors-master/tb";
         $config["total_rows"]      = count($this->transport_model->conductors_masters($search));
         $data['total_rows']        = $config["total_rows"];
         $config["per_page"]        = 10;
         $config["uri_segment"]     = 2;
         $config['attributes']      = array('class' => 'pag-link ');
         $this->pagination->initialize($config);
         $data['links']             = $this->pagination->create_links();
         $data['page']              = $page = ($p1!=null) ? $p1 : 0;
         $data['search']            = $this->input->post('search');
         $data['update_url']        =base_url().'conductors-master/driver_create/';
         $data['upload_doc_url']        =base_url().'conductors-master/document/';
         $data['delete_url']        =base_url().'conductors-master/delete/';  
         $data['rows']              = $this->transport_model->conductors_masters($search,$config["per_page"],$page);
         $page                      = 'erp/transport/tb_conductor';
         $this->load->view($page, $data); 
         break;

                case 'driver_create':
                    $data['action_url']         = base_url().'conductors-master/save';
                    $data['total_data']=0;
                    $page                       = 'erp/transport/conductor_create';
                    if ($p1!=null) {
                        $data['update_url']     = base_url().'conductors-master/save/'.$p1;
                        $data['driver']         = $this->transport_model->view_data_id('transport_conductors',$p1);
                        $data['total_data']         = $this->transport_model->count_row_id('transport_conductors',$p1);
                        $page                   = 'erp/transport/conductor_create';
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
                            'mobile'   => $this->input->post('mobile'),
                            'email'      => $this->input->post('email'),
                            'address'      => $this->input->post('address'),
                            'dl'        => $this->input->post('dl_type'),
                            'dl_number'       => $this->input->post('dl_number'),
                            'aadhaar'        => $this->input->post('aadhaar'),
                            'pan_number'        => $this->input->post('pan_number'),
                            'qualification' => $this->input->post('qualification'),
                            'state' => $this->input->post('state'),
                            'city' => $this->input->post('city'),
                            'pincode' => $this->input->post('pincode'),
                            'created_by' => $_SESSION['MUserId'],
                            'joindate' => $this->input->post('joindate'),
                            'status'        =>1,
                        );
                            
                        if($this->erp_model->UpdateData('transport_conductors',$data,$id)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                        }
                    }
                    else{ 
                        $data = array(
                            'name'     => $this->input->post('name'),
                            'father_name'  => $this->input->post('fname'),
                            'mobile'   => $this->input->post('mobile'),
                            'email'      => $this->input->post('email'),
                            'address'      => $this->input->post('address'),
                            'dl'        => $this->input->post('dl_type'),
                            'dl_number'       => $this->input->post('dl_number'),
                            'aadhaar'        => $this->input->post('aadhaar'),
                            'pan_number'        => $this->input->post('pan_number'),
                            'qualification' => $this->input->post('qualification'),
                            'state' => $this->input->post('state'),
                            'city' => $this->input->post('city'),
                            'pincode' => $this->input->post('pincode'),
                            'created_by' => $_SESSION['MUserId'],
                            'joindate' => $this->input->post('joindate'),
                            'status'        =>1,
                            );
                        if ($this->erp_model->Insert('transport_conductors',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                            
                        }
                    }
                }
                echo json_encode($return);
                //$this->load->view('');
                break;
                case 'document':
                 $data['action_url']         = base_url().'conductors-master/save_document/'.$p1;
                 $data['count']           = $this->transport_model->check_teacher_doc_row('transport_conductors',$p1);
                 $page                   = 'erp/transport/conductor_documents';
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
                            $config['upload_path'] = UPLOAD_PATH.'conductors/';
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
                               
                                  $fileName = "conductors/" . $image_data['file_name'];
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
                                 
                                    $fileName = "conductors/" . $image_data['file_name'];
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
                                 
                                    $fileName = "conductors/" . $image_data['file_name'];
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
                                 
                                    $fileName = "conductors/" . $image_data['file_name'];
                                }
                               $doc2=$data['doc2'] = $fileName;
                                } else {
                               $doc2 = $data['doc2'] = "";
                               }
                                 if (!empty($_FILES['doc3']['name'])) {
                     
                                //upload doc
                                $_FILES['doc3s']['name'] = $_FILES['doc3']['name'];
                                $_FILES['doc3s']['type'] = $_FILES['doc3']['type'];
                                $_FILES['doc3s']['tmp_name'] = $_FILES['doc3']['tmp_name'];
                                $_FILES['doc3s']['size'] = $_FILES['doc3']['size'];
                                $_FILES['doc3s']['error'] = $_FILES['doc3']['error'];
                       
                                if ($this->upload->do_upload('doc3s')) {
                                    $image_data = $this->upload->data();
                                 
                                    $fileName = "conductors/" . $image_data['file_name'];
                                }
                               $doc3=$data['doc3'] = $fileName;
                                } else {
                               $doc3 = $data['doc3'] = "";
                               }
                           if($pic !='' && $doc !='' && $doc1 !='' && $doc2 !='' && $doc3 !=''){
                                 $data = array(
                                'account_holder_name'     => $this->input->post('name'),
                                'bank_name'  => $this->input->post('bankname'),
                                'account_number'   => $this->input->post('accountnumber'),
                                'ifsc_code'      => $this->input->post('ifsccode'),
                                'branch_name'      => $this->input->post('branch_name'),
                                'photo'      => $pic,
                                'pan_photo'        => $doc1,
                                'aadhaar_file'       => $doc,
                                'bank_passbook'        => $doc2,
                                'dl_photo'        => $doc3,
                                'doc_type'      =>'1',
                            );
                           } elseif($pic !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'photo'      => $pic,
                                    'doc_type'      =>'1',
                                );
                            }elseif($doc !=''){
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'aadhaar_file'       => $doc,
                                    'doc_type'      =>'1',
                                );
                            }elseif($doc1 !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'pan_photo'        => $doc1,
                                    'doc_type'      =>'1',
                                ); 
                            }elseif($doc2 !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'bank_passbook'        => $doc2,
                                    'doc_type'      =>'1',
                                );  
                            }
                            elseif($doc3 !='')
                            {
                                $data = array(
                                    'account_holder_name'     => $this->input->post('name'),
                                    'bank_name'  => $this->input->post('bankname'),
                                    'account_number'   => $this->input->post('accountnumber'),
                                    'ifsc_code'      => $this->input->post('ifsccode'),
                                    'branch_name'      => $this->input->post('branch_name'),
                                    'dl_photo'        => $doc3,
                                    'doc_type'      =>'1',
                                );  
                            }  
                            if($this->transport_model->UpdateData('transport_conductors',$data,$id)){
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
                    if($this->erp_model->_delete('transport_conductors',['id'=>$p1])){
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

    public function vehicle_master($action=null,$p1=null,$p2=null,$p3=null)
    {
         $id=$_SESSION['MUserId'];
        switch ($action) {
            case null:
                $data['title']          = 'Vehicle Master';
                $data['new_url']         = base_url().'vehicle-master/driver_create';
                $data['tb_url']            = current_url().'/tb';
                $data['search']            = $this->input->post('search');
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/transport/header',$data);
                $this->load->view('erp/transport/vehicle_master',$data);
                $this->load->view('erp/transport/footer');
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
         $config["base_url"]    = base_url()."vehicle-master/tb";
         $config["total_rows"]      = count($this->transport_model->vehicle_masters($search));
         $data['total_rows']        = $config["total_rows"];
         $config["per_page"]        = 10;
         $config["uri_segment"]     = 2;
         $config['attributes']      = array('class' => 'pag-link ');
         $this->pagination->initialize($config);
         $data['links']             = $this->pagination->create_links();
         $data['page']              = $page = ($p1!=null) ? $p1 : 0;
         $data['search']            = $this->input->post('search');
         $data['update_url']        =base_url().'vehicle-master/driver_create/';
         $data['upload_doc_url']        =base_url().'vehicle-master/document/';
         $data['delete_url']        =base_url().'vehicle-master/delete/';  
         $data['rows']              = $this->transport_model->vehicle_masters($search,$config["per_page"],$page);
         $page                      = 'erp/transport/tb_vehicle';
         $this->load->view($page, $data); 
         break;

                case 'driver_create':
                    $data['action_url']         = base_url().'vehicle-master/save';
                    $data['total_data']=0;
                    $page                       = 'erp/transport/vehicle_create';
                    if ($p1!=null) {
                        $data['update_url']     = base_url().'vehicle-master/save/'.$p1;
                        $data['vehicle']         = $this->transport_model->view_data_id('transport_vehicle',$p1);
                        $data['total_data']         = $this->transport_model->count_row_id('transport_vehicle',$p1);
                        $page                   = 'erp/transport/vehicle_create';
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
                        $config['file_name'] = rand(10000, 10000000000);    
                        $config['upload_path'] = UPLOAD_PATH.'vehicle/';
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
                           
                              $fileName = "vehicle/" . $image_data['file_name'];
                          }
                         $pic=$data['pic'] = $fileName;
                          } else {
                         $pic = $data['pic'] = "";
                         }
                        if($pic !='') {
                        $data = array(
                            'owner_email'     => $this->input->post('oemail'),
                            'owner_mobile_no'  => $this->input->post('omobile'),
                            'vehicle_name'   => $this->input->post('vname'),
                            'vehicle_reg_no'      => $this->input->post('reg_no'),
                            'vehicle_child_capacity'      => $this->input->post('capacity'),
                            'vehicle_no'        => $this->input->post('vnumber'),
                            'join_date'       => $this->input->post('joindate'),
                            'insurance_renew_date'        => $this->input->post('insurance_renew_date'),
                            'owner_name'        => $this->input->post('oname'),
                            'created_by' => $_SESSION['MUserId'],
                            'vehicle_photo'  =>$pic,
                            'status'        =>1,
                        );
                    }else
                    {
                        $data = array(
                            'owner_email'     => $this->input->post('oemail'),
                            'owner_mobile_no'  => $this->input->post('omobile'),
                            'vehicle_name'   => $this->input->post('vname'),
                            'vehicle_reg_no'      => $this->input->post('reg_no'),
                            'vehicle_child_capacity'      => $this->input->post('capacity'),
                            'vehicle_no'        => $this->input->post('vnumber'),
                            'join_date'       => $this->input->post('joindate'),
                            'insurance_renew_date'        => $this->input->post('insurance_renew_date'),
                            'owner_name'        => $this->input->post('oname'),
                            'created_by' => $_SESSION['MUserId'],
                            'status'        =>1,
                        );  
                    }
                            
                        if($this->erp_model->UpdateData('transport_vehicle',$data,$id)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                        }
                    }
                    else{ 
                        $config['file_name'] = rand(10000, 10000000000);    
                        $config['upload_path'] = UPLOAD_PATH.'vehicle/';
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
                           
                              $fileName = "vehicle/" . $image_data['file_name'];
                          }
                         $pic=$data['pic'] = $fileName;
                          } else {
                         $pic = $data['pic'] = "";
                         }
                         if($pic !='') {
                            $data = array(
                                'owner_email'     => $this->input->post('oemail'),
                                'owner_mobile_no'  => $this->input->post('omobile'),
                                'vehicle_name'   => $this->input->post('vname'),
                                'vehicle_reg_no'      => $this->input->post('reg_no'),
                                'vehicle_child_capacity'      => $this->input->post('capacity'),
                                'vehicle_no'        => $this->input->post('vnumber'),
                                'join_date'       => $this->input->post('joindate'),
                                'insurance_renew_date'        => $this->input->post('insurance_renew_date'),
                                'owner_name'        => $this->input->post('oname'),
                                'created_by' => $_SESSION['MUserId'],
                                'vehicle_photo'  =>$pic,
                                'status'        =>1,
                            );
                        }else
                        {
                            $data = array(
                                'owner_email'     => $this->input->post('oemail'),
                                'owner_mobile_no'  => $this->input->post('omobile'),
                                'vehicle_name'   => $this->input->post('vname'),
                                'vehicle_reg_no'      => $this->input->post('reg_no'),
                                'vehicle_child_capacity'      => $this->input->post('capacity'),
                                'vehicle_no'        => $this->input->post('vnumber'),
                                'join_date'       => $this->input->post('joindate'),
                                'insurance_renew_date'        => $this->input->post('insurance_renew_date'),
                                'owner_name'        => $this->input->post('oname'),
                                'created_by' => $_SESSION['MUserId'],
                                'status'        =>1,
                            );  
                        }
                        if ($this->erp_model->Insert('transport_vehicle',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                            
                        }
                    }
                }
                echo json_encode($return);
                //$this->load->view('');
                break;

                case 'delete':
                    $return['res'] = 'error';
                    $return['msg'] = 'Not Deleted!';
                    if ($p1!=null) {
                    if($this->erp_model->_delete('transport_conductors',['id'=>$p1])){
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
    public function route_allocation($action=null,$p1=null,$p2=null,$p3=null)
    {
         $id=$_SESSION['MUserId'];
        switch ($action) {
            case null:
                $data['title']          = 'Route Allocation';
                $data['new_url']         = base_url().'route-allocation/create';
                $data['tb_url']            = current_url().'/tb';
                $data['search']            = $this->input->post('search');
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/transport/header',$data);
                $this->load->view('erp/transport/route',$data);
                $this->load->view('erp/transport/footer');
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
         $config["base_url"]    = base_url()."route-allocation/tb";
         $config["total_rows"]      = count($this->transport_model->route_master($search));
         $data['total_rows']        = $config["total_rows"];
         $config["per_page"]        = 10;
         $config["uri_segment"]     = 2;
         $config['attributes']      = array('class' => 'pag-link ');
         $this->pagination->initialize($config);
         $data['links']             = $this->pagination->create_links();
         $data['page']              = $page = ($p1!=null) ? $p1 : 0;
         $data['search']            = $this->input->post('search');
         $data['update_url']        =base_url().'route-allocation/create/';
         $data['delete_url']        =base_url().'route-allocation/delete/'; 
         $data['view_sub_route']    =base_url().'route-allocation/view-sub-route/';
         $data['view_student_route']    =base_url().'route-allocation/view-student-route/';
         $data['assign_tr_route_driver']    =base_url().'route-allocation/assign-driver-route/';
         $data['assign_tr_route_conductor']    =base_url().'route-allocation/assign-conductor-route/';
         $data['assign_tr_route_vehicle']    =base_url().'route-allocation/assign-vehicle-route/';
         $data['rows']              = $this->transport_model->route_master($search,$config["per_page"],$page);
         $page                      = 'erp/transport/tb_route';
         $this->load->view($page, $data); 
         break;

                case 'create':
                    $data['action_url']         = base_url().'route-allocation/save';
                    $data['total_data']=0;
                    $page                       = 'erp/transport/route_create';
                    if ($p1!=null) {
                        $data['update_url']     = base_url().'route-allocation/save/'.$p1;
                        $data['route']         = $this->transport_model->view_data_id('transport_route',$p1);
                        $data['total_data']         = $this->transport_model->count_row_id('transport_route',$p1);
                        $page                   = 'erp/transport/route_create';
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
                            'start_route'     => $this->input->post('start'),
                            'end_route'  => $this->input->post('end'),
                            'created_by' => $_SESSION['MUserId'],
                            'status'        =>1,
                        );  
                        if($this->erp_model->UpdateData('transport_route',$data,$id)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                        }
                    }
                    else{ 
                       
                            $data = array(
                                'start_route'     => $this->input->post('start'),
                                'end_route'  => $this->input->post('end'),
                                'created_by' => $_SESSION['MUserId'],
                                'status'        =>1,
                            );  
                        
                        if ($this->erp_model->Insert('transport_route',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                            
                        }
                    }
                }
                echo json_encode($return);
                //$this->load->view('');
                break;

                case 'delete':
                    $return['res'] = 'error';
                    $return['msg'] = 'Not Deleted!';
                    if ($p1!=null) {
                    if($this->erp_model->_delete('transport_route',['id'=>$p1])){
                            $saved = 1;
                            $return['res'] = 'success';
                            $return['msg'] = 'Successfully deleted.';
                        }
                    }
             echo json_encode($return);
         break;
         case 'view-sub-route':
         $page                       = 'erp/transport/view_sub_route';
         $data['rows']               = $this->transport_model->view_sub_route($p1);
         $data['form_id']            = uniqid();
         $this->load->view($page, $data);
          break;
          case 'view-student-route':
            $page                       = 'erp/transport/view_student_route';
            $data['rows']               = $this->transport_model->view_student_route($p1);
            $data['form_id']            = uniqid();
            $this->load->view($page, $data);
         break;
         case 'assign-driver-route':
            $page                       = 'erp/transport/assign_driver_route';
            $data['route']               = $this->transport_model->view_data_id('transport_route',$p1);
            $data['data']             = $this->transport_model->get_deriver_route($p1);
            $data['driver']            =$this->transport_model->view_data('transport_drivers');
            $data['form_id']            = uniqid();
            $this->load->view($page, $data);
             break;
           case 'add_assig_driver_route':
            $return = 'Not Saved.';
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $edit_id =  $this->input->post('id');
                if ($edit_id!=null) {
                       $data = array(
                       'route_id'     => $this->input->post('route'),
                       'driver_id'  => $this->input->post('driver'),
                       'created_by' => $_SESSION['MUserId'],
                       'status'        =>1,
                   );  
                   if($this->erp_model->UpdateData('assgin_tr_route_driver',$data,$edit_id)){
                       $return = 'Updated.';
                   }
               }
               else{ 
                  
                       $data = array(
                        'route_id'     => $this->input->post('route'),
                        'driver_id'  => $this->input->post('driver'),
                           'created_by' => $_SESSION['MUserId'],
                           'status'        =>1,
                       );  
                $count = $this->erp_model->Counter('assgin_tr_route_driver', array('route_id' =>$this->input->post('route') ));
                if($count==0){
                   if ($this->erp_model->Insert('assgin_tr_route_driver',$data)) {
                       $return = 'Saved.';
                       
                   }
                }else
                {
                    $return = 'Already Mapped.';
                }
               }
           }
           echo $return;
           break; 
           case 'assign-conductor-route':
            $page                       = 'erp/transport/assign_donductor_route';
            $data['route']               = $this->transport_model->view_data_id('transport_route',$p1);
            $data['data']             = $this->transport_model->get_conductor_route($p1);
            $data['conductor']            =$this->transport_model->view_data('transport_conductors');
            $data['form_id']            = uniqid();
            $this->load->view($page, $data);
             break;
           case 'add_assig_conductor_route':
            $return = 'Not Saved.';
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $edit_id =  $this->input->post('id');
                if ($edit_id!=null) {
                       $data = array(
                       'route_id'     => $this->input->post('route'),
                       'conductor_id'  => $this->input->post('conductor'),
                       'created_by' => $_SESSION['MUserId'],
                       'status'        =>1,
                   );  
                   if($this->erp_model->UpdateData('assgin_tr_route_conductor',$data,$edit_id)){
                       $return = 'Updated.';
                   }
               }
               else{ 
                  
                       $data = array(
                        'route_id'     => $this->input->post('route'),
                        'conductor_id'  => $this->input->post('conductor'),
                           'created_by' => $_SESSION['MUserId'],
                           'status'        =>1,
                       );  
                $count = $this->erp_model->Counter('assgin_tr_route_conductor', array('route_id' =>$this->input->post('route') ));
                if($count==0){
                   if ($this->erp_model->Insert('assgin_tr_route_conductor',$data)) {
                       $return = 'Saved.';
                       
                   }
                }else
                {
                    $return = 'Already Mapped.';
                }
               }
           }
           echo $return;
           break; 
        //    assign vehicle
        case 'assign-vehicle-route':
            $page                       = 'erp/transport/assign_vehicle_route';
            $data['route']               = $this->transport_model->view_data_id('transport_route',$p1);
            $data['data']             = $this->transport_model->get_vehicle_route($p1);
            $data['vehicle']            =$this->transport_model->view_data('transport_vehicle');
            $data['form_id']            = uniqid();
            $this->load->view($page, $data);
             break;
           case 'add_assig_vehicle_route':
            $return = 'Not Saved.';
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $edit_id =  $this->input->post('id');
                if ($edit_id!=null) {
                       $data = array(
                       'route_id'     => $this->input->post('route'),
                       'vehicle_id'  => $this->input->post('vehicle'),
                       'created_by' => $_SESSION['MUserId'],
                       'status'        =>1,
                   );  
                   if($this->erp_model->UpdateData('assgin_tr_route_vehicle',$data,$edit_id)){
                       $return = 'Updated.';
                   }
               }
               else{ 
                  
                       $data = array(
                        'route_id'     => $this->input->post('route'),
                        'vehicle_id'  => $this->input->post('vehicle'),
                           'created_by' => $_SESSION['MUserId'],
                           'status'        =>1,
                       );  
                $count = $this->erp_model->Counter('assgin_tr_route_vehicle', array('route_id' =>$this->input->post('route') ));
                if($count==0){
                   if ($this->erp_model->Insert('assgin_tr_route_vehicle',$data)) {
                       $return = 'Saved.';
                       
                   }
                }else
                {
                    $return = 'Already Mapped.';
                }
               }
           }
           echo $return;
           break; 
            default:
                # code...
                break;
        }
    }
  


   public function sub_route($action=null,$p1=null,$p2=null,$p3=null)
    {
         $id=$_SESSION['MUserId'];
        switch ($action) {
            case null:
                $data['title']          = 'Sub Route Map';
                $data['new_url']         = base_url().'sub-route-map/create';
                $data['tb_url']            = current_url().'/tb';
                $data['search']            = $this->input->post('search');
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/transport/header',$data);
                $this->load->view('erp/transport/sub_route',$data);
                $this->load->view('erp/transport/footer');
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
         $config["base_url"]    = base_url()."sub-route-map/tb";
         $config["total_rows"]      = count($this->transport_model->transport_sub_route($search));
         $data['total_rows']        = $config["total_rows"];
         $config["per_page"]        = 10;
         $config["uri_segment"]     = 2;
         $config['attributes']      = array('class' => 'pag-link ');
         $this->pagination->initialize($config);
         $data['links']             = $this->pagination->create_links();
         $data['page']              = $page = ($p1!=null) ? $p1 : 0;
         $data['search']            = $this->input->post('search');
         $data['update_url']        =base_url().'sub-route-map/create/';
         $data['delete_url']        =base_url().'sub-route-map/delete/';  
         $data['rows']              = $this->transport_model->transport_sub_route($search,$config["per_page"],$page);
         $page                      = 'erp/transport/tb_sub_route';
         $this->load->view($page, $data); 
         break;

                case 'create':
                    $data['action_url']         = base_url().'sub-route-map/save';
                    $data['route']              = $this->transport_model->getData('transport_route');
                    $data['total_data']=0;
                    $page                       = 'erp/transport/sub_route_create';
                    if ($p1!=null) {
                        $data['update_url']     = base_url().'sub-route-map/save/'.$p1;
                        $data['sub_route']         = $this->transport_model->view_data_id('transport_sub_route',$p1);
                        $data['total_data']         = $this->transport_model->count_row_id('transport_sub_route',$p1);
                         $data['route']              = $this->transport_model->getData('transport_route');
                        $page                   = 'erp/transport/sub_route_create';
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
                            'route_id'     => $this->input->post('route_id'),
                            'pick_up'  => $this->input->post('pick_up'),
                            'drop_off'  => $this->input->post('drop_off'),
                            'pick_up_time'  => $this->input->post('pick_up_time'),
                            'stop_time'  => $this->input->post('stop_time'),
                            'fees'  => $this->input->post('fees'),
                            'created_by' => $_SESSION['MUserId'],
                            'status'        =>1,
                        );  
                        if($this->erp_model->UpdateData('transport_sub_route',$data,$id)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                        }
                    }
                    else{ 
                       
                            $data = array(
                            'route_id'     => $this->input->post('route_id'),
                            'pick_up'  => $this->input->post('pick_up'),
                            'drop_off'  => $this->input->post('drop_off'),
                            'pick_up_time'  => $this->input->post('pick_up_time'),
                            'stop_time'  => $this->input->post('stop_time'),
                            'fees'  => $this->input->post('fees'),
                            'created_by' => $_SESSION['MUserId'],
                            'status'        =>1,
                            );  
                        
                        if ($this->erp_model->Insert('transport_sub_route',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                            
                        }
                    }
                }
                echo json_encode($return);
                //$this->load->view('');
                break;

                case 'delete':
                    $return['res'] = 'error';
                    $return['msg'] = 'Not Deleted!';
                    if ($p1!=null) {
                    if($this->erp_model->_delete('transport_sub_route',['id'=>$p1])){
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
    public function student_route_mapping($action=null,$p1=null,$p2=null,$p3=null)
    {
         $id=$_SESSION['MUserId'];
        switch ($action) {
            case null:
                $data['title']          = 'Student Route Map';
                $data['new_url']         = base_url().'student-route-map/create';
                $data['tb_url']            = current_url().'/tb';
                $data['search']            = $this->input->post('search');
                $data['roles'] = $this->erp_model->view_role($id);
                $data['route']              = $this->transport_model->getData('transport_route');
                $this->load->view('erp/transport/header',$data);
                $this->load->view('erp/transport/student_route',$data);
                $this->load->view('erp/transport/footer');
                break;
         case 'tb':
           if(!empty($_POST['route_id'])){
            $route_id =   $data['route_id'] = $_POST['route_id'] ;
             
           }else{
               $route_id =  $data['route_id'] = '' ;
           }
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
         $config["base_url"]    = base_url()."student-route-map/tb";
         $config["total_rows"]      = count($this->transport_model->transport_student($route_id,$search));
         $data['total_rows']        = $config["total_rows"];
         $config["per_page"]        = 10;
         $config["uri_segment"]     = 2;
         $config['attributes']      = array('class' => 'pag-link ');
         $this->pagination->initialize($config);
         $data['links']             = $this->pagination->create_links();
         $data['page']              = $page = ($p1!=null) ? $p1 : 0;
         $data['search']            = $this->input->post('search');
         $data['update_url']        =base_url().'student-route-map/create/';
         $data['delete_url']        =base_url().'student-route-map/delete/';  
         $data['rows']              = $this->transport_model->transport_student($route_id,$search,$config["per_page"],$page);
         $page                      = 'erp/transport/tb_student_route';
         $this->load->view($page, $data); 
         break;

                case 'create':
                    $data['action_url']         = base_url().'student-route-map/save';
                    $data['route']              = $this->transport_model->getData('transport_route');
                    $data['student']              = $this->transport_model->getstudent('v_sec_student');
                    $data['total_data']=0;
                    $page                       = 'erp/transport/student_route_create';
                    if ($p1!=null) {
                        $data['update_url']     = base_url().'student-route-map/save/'.$p1;
                        $data['data']         = $this->transport_model->view_data_id('transport_student',$p1);
                        $data['total_data']         = $this->transport_model->count_row_id('transport_student',$p1);
                         $data['route']              = $this->transport_model->getData('transport_route');
                         $data['student']              = $this->transport_model->getstudent('v_sec_student');
                        $page                   = 'erp/transport/student_route_create';
                    }
                    $data['form_id']            = uniqid();
                    $this->load->view($page, $data);
                    break;
              case 'save':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';

                if ($this->input->server('REQUEST_METHOD')=='POST') { 
                    $count = $this->erp_model->Counter('transport_student', array('student_id' =>$this->input->post('stu_id'),'route_id' =>$this->input->post('route_id'),'sub_route_id' =>$this->input->post('sub_route_id') ));
                     if ($id!=null) { 
                            $data = array(
                                'route_id'     => $this->input->post('route_id'),
                                'sub_route_id'  => $this->input->post('sub_route_id'),
                                'student_id'  => $this->input->post('stu_id'),
                            'created_by' => $_SESSION['MUserId'],
                            'status'        =>1,
                        ); 
                        if($count==0)
                        { 
                        if($this->erp_model->UpdateData('transport_student',$data,$id)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                        }
                    }else
                    {
                        $return['res'] = 'error';
                            $return['msg'] = 'Duplicate Entery Not Allowed. Student Already Mapped'; 
                    }
                    }
                    else{ 
                       
                            $data = array(
                            'route_id'     => $this->input->post('route_id'),
                            'sub_route_id'  => $this->input->post('sub_route_id'),
                            'student_id'  => $this->input->post('stu_id'),
                            'created_by' => $_SESSION['MUserId'],
                            'status'        =>1,
                            );  
                        if($count==0)
                        { 
                        if ($this->erp_model->Insert('transport_student',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                            
                        }
                          }else
                    {
                        $return['res'] = 'error';
                            $return['msg'] = 'Duplicate Entery Not Allowed. Student Already Mapped'; 
                    }
                    }
                }
                echo json_encode($return);
                //$this->load->view('');
                break;

                case 'delete':
                    $return['res'] = 'error';
                    $return['msg'] = 'Not Deleted!';
                    if ($p1!=null) {
                    if($this->erp_model->_delete('transport_student',['id'=>$p1])){
                            $saved = 1;
                            $return['res'] = 'success';
                            $return['msg'] = 'Successfully deleted.';
                        }
                    }
                    echo json_encode($return);
          break;
          case 'fetch_sub_route':
            if($this->input->post('route_id'))
            {
                $bid= $this->input->post('route_id');
                $this->transport_model->fetch_route($bid);
            }
            break;
            default:
                # code...
                break;
        }
    }


 public function student_vehicle_attendance($action=null,$p1=null,$p2=null,$p3=null)
    {
         $id=$_SESSION['MUserId'];
        switch ($action) {
            case null:
                $data['title']          = 'Student Vehicle Attendance';
                $data['tb_url']            = current_url().'/tb';
                $data['roles'] = $this->erp_model->view_role($id);
                $this->load->view('erp/transport/header',$data);
                $this->load->view('erp/transport/student_vehicle_attendance',$data);
                $this->load->view('erp/transport/footer');
                break;
                default:
                # code...
                break;
        }
    }


}   