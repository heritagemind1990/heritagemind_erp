<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Inst.php');
class Academic extends Inst {

    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {
        $id=$_SESSION['MUserId'];
       
        $data['title']='Academic Dashboard';
        $data['total_notice']=$this->academic_model->total_notice();
        $data['total_class']=$this->academic_model->total_class();
        $data['total_student']=$this->academic_model->count_row_student('v_section_alloted');
        $data['total_section']=$this->academic_model->count_row('section_master');
        $data['total_holiday']=$this->academic_model->count_row('holiday_master');
        $data['total_category']=$this->academic_model->count_row('category_master');
        $data['total_exam']=$this->academic_model->count_row('exam_master');
        $data['total_topic']=$this->academic_model->count_row('subject_topic_master');
        $data['total_subject']=$this->academic_model->count_row('subject_master');
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/index',$data);
        $this->load->view('erp/academic/footer');
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
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/my_profile',$data);
        $this->load->view('erp/academic/footer');
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
    public function academic_notice($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
         $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);        
        $data['menu_id'] = $this->uri->segment(2);
       
        $data['title']          = 'Notice Master';
        $data['new_url']         = base_url().'academic-notice/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/notice_master',$data);
        $this->load->view('erp/academic/footer');
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
        $config["base_url"]     = base_url()."academic-notice/tb";
        $config["total_rows"]   = count($this->academic_model->notice_data($search));
        $data['total_rows']     = $config["total_rows"];
        $config["per_page"]     = 10;
        $config["uri_segment"]  = 2;
        $config['attributes']   = array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']          = $this->pagination->create_links();
        $data['page']           = $page = ($p1!=null) ? $p1 : 0;
        $data['search']         = $this->input->post('search');
        $data['update_url']        =base_url().'academic-notice/create/';
        $data['delete_url']        =base_url().'academic-notice/delete/';  
        $data['rows']           = $this->academic_model->notice_data($search,$config["per_page"],$page);
        $page                       = 'erp/academic/tb_notice';
        $this->load->view($page, $data); 
        break;


        case 'create':
        $data['action_url']         = base_url().'academic-notice/save';
        $data['total_data']=0;
        $page               = 'erp/academic/create_notice';
        if ($p1!=null) {
        $data['action_url']         = base_url().'academic-notice/save/'.$p1;
        $data['notice']         = $this->academic_model->notice_data_view($p1);
        $data['total_data']         = $this->academic_model->notice_row_count($p1);
        $page           = 'erp/academic/create_notice';
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
        $config['file_name'] = rand(10000, 10000000000);    
        $config['upload_path'] = UPLOAD_PATH.'doc/';
        $config['allowed_types'] = 'pdf|PDF';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
 
        if (!empty($_FILES['doc']['name'])) {
 
          //upload doc
          $_FILES['docs']['name'] = $_FILES['doc']['name'];
          $_FILES['docs']['type'] = $_FILES['doc']['type'];
          $_FILES['docs']['tmp_name'] = $_FILES['doc']['tmp_name'];
          $_FILES['docs']['size'] = $_FILES['doc']['size'];
          $_FILES['docs']['error'] = $_FILES['doc']['error'];
 
          if ($this->upload->do_upload('docs')) {
              $image_data = $this->upload->data();
           
              $fileName = "doc/" . $image_data['file_name'];
          }
         $doc=$data['doc'] = $fileName;
          } else {
         $doc = $data['doc'] = "";
         }
         $data = array(
         'title'     => $this->input->post('title'),
         'from_date'  => $this->input->post('fromdate'),
         'to_date'   => $this->input->post('todate'),
         'notice_type'      => $this->input->post('noticetype'),
         'notice_doc' =>$doc,
         'status'        =>1,
          );
         if ($this->erp_model->UpdateData('notice_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $config['file_name'] = rand(10000, 10000000000);    
	   $config['upload_path'] = UPLOAD_PATH.'doc/';
	   $config['allowed_types'] = 'pdf|PDF';
	   $this->load->library('upload', $config);
	   $this->upload->initialize($config);

	   if (!empty($_FILES['doc']['name'])) {

		 //upload doc
		 $_FILES['docs']['name'] = $_FILES['doc']['name'];
		 $_FILES['docs']['type'] = $_FILES['doc']['type'];
		 $_FILES['docs']['tmp_name'] = $_FILES['doc']['tmp_name'];
		 $_FILES['docs']['size'] = $_FILES['doc']['size'];
		 $_FILES['docs']['error'] = $_FILES['doc']['error'];

		 if ($this->upload->do_upload('docs')) {
			 $image_data = $this->upload->data();
		  
			 $fileName = "doc/" . $image_data['file_name'];
		 }
		$doc=$data['doc'] = $fileName;
	     } else {
		$doc = $data['doc'] = "";
	    }
        $data = array(
        'title'     => $this->input->post('title'),
        'from_date'  => $this->input->post('fromdate'),
        'to_date'   => $this->input->post('todate'),
        'notice_type'      => $this->input->post('noticetype'),
        'notice_doc' =>$doc,
        'status'        =>1,
         );
        if ($this->erp_model->Save('notice_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/academic/create_notice');
        break;
 
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('notice_master',['id'=>$p1])){
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
    public function class_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
                
        $data['menu_id'] = $this->uri->segment(2);
       
        $data['title']          = 'Class Master';
        $data['new_url']         = base_url().'class-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/class_master',$data);
        $this->load->view('erp/academic/footer');
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
            $config["base_url"]     = base_url()."class-master/tb";
            $config["total_rows"]   = count($this->academic_model->class_data1($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'class-master/delete/';
            $data['update_url']       =base_url().'class-master/create/'; 
            $data['rows']           = $this->academic_model->class_data1($search,$config["per_page"],$page);
            $page                       = 'erp/academic/tb_class';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'class_remote/class/';
        $data['action_url']         = base_url().'class-master/save';
        $data['total_data']=0;
        $page               = 'erp/academic/create_class';
        if ($p1!=null) {
        $data['action_url']         = base_url().'class-master/save/'.$p1;
        $data['class']         = $this->academic_model->class_data_view($p1);
        $data['total_data']         = $this->academic_model->class_row_count($p1);
        $page           = 'erp/academic/create_class';
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
         'class_name'     => $this->input->post('class_name'),
         'no_of_seat'  => $this->input->post('noofseats'),
         'reserve_seats'=>$this->input->post('reserveseat'),
          );
         if ($this->erp_model->UpdateData('class_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $data = array(
            'class_name'     => $this->input->post('class_name'),
            'no_of_seat'  => $this->input->post('noofseats'),
            'status'        =>1,
            'reserve_seats'=>$this->input->post('reserveseat'),
           // 'created_ip'     =>$this->input->ip_address(),
            'created_by'      =>$id,
         );
        if ($this->erp_model->Save('class_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/academic/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('class_master',['id'=>$p1])){
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
    public function class_remote($type,$id=null,$column='class_name')
    {
        if ($type=='class') {
            $tb = 'class_master';
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
    
    public function section_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Section Master';
        $data['new_url']         = base_url().'section-master/create ';
        $data['tb_url']         = base_url().'section-master/tb';
        $data['delete_url']         = base_url().'section-master/delete/';
        $data['update_url']       =base_url().'section-master/create/';
        $data['rs']         = $this->academic_model->class_data();
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/section_master',$data);
        $this->load->view('erp/academic/footer');
        break;

        case 'create':
            
        $data['remote']     = base_url().'section_remote/class/';
        $data['action_url']         = base_url().'section-master/save';
        $data['class']             =$this->academic_model->class_data();   
        $data['total_data']=0;
        $page               = 'erp/academic/section_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'section-master/save/'.$p1;
        $data['classs']         = $this->academic_model->class_data_view($p1);
        $data['total_data']         = $this->academic_model->class_row_count($p1);
        $page           = 'erp/academic/section_create';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
   	
        $id=$_SESSION['MUserId'];
        $class_id = $this->input->post('class_id');
        $name_sec = $this->input->post('name_sec');
        $no_of_stu =$this->input->post('no_of_stu');
        $i=0;
        foreach($name_sec as $n){
        $n = strtoupper($n);
        $data = array(
            'class_id'     => $class_id,
            'section_name'  => $n,
             'no_of_stu'           =>$no_of_stu[$i],
            'status'        =>1,
            'created_by'      =>$id,
         );

        if ($this->erp_model->Save('section_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
         $i++ ;
        }
        }
        
        echo json_encode($return);
        //$this->load->view('erp/academic/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('section_master',['id'=>$p1])){
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




    public function section_allot_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Student Section Allot';
        $data['new_url']         = base_url().'section-allot-master/create ';
        $data['tb_url']         = base_url().'section-allot-master/tb';
        $data['delete_url']         = base_url().'section-allot-master/delete/';
        $data['update_url']       =base_url().'section-allot-master/create/';
        $data['rs']         = $this->academic_model->class_data();
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/section_allot_master',$data);
        $this->load->view('erp/academic/footer');
        break;

        case 'create':
        $data['remote']     = base_url().'section_remote/class/';
        $data['action_url']         = base_url().'section-allot-master/save';
        $data['section']             =$this->academic_model->section();   
        $data['total_data']=0;
        $page               = 'erp/academic/section_allot_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'section-allot-master/save/'.$p1;
        $data['class']         = $this->academic_model->class_data_view($p1);
        $data['total_data']         = $this->academic_model->class_row_count($p1);
        $page           = 'erp/academic/section_allot_create';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
   	
        $id=$_SESSION['MUserId'];
        $class_id = $this->input->post('class_id');
        $name_sec = $this->input->post('name_sec');
        $no_of_stu =$this->input->post('no_of_stu');
        $i=0;
        foreach($name_sec as $n){
        $n = strtoupper($n);
        $data = array(
            'class_id'     => $class_id,
            'section_name'  => $n,
             'no_of_stu'           =>$no_of_stu[$i],
            'status'        =>1,
            'created_by'      =>$id,
         );

        if ($this->erp_model->Save('section_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
         $i++ ;
        }
        }
        
        echo json_encode($return);
        //$this->load->view('erp/academic/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('section_master',['id'=>$p1])){
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


    public function holiday_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Holiday Events';
        $data['new_url']         = base_url().'holiday-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/holiday_master',$data);
        $this->load->view('erp/academic/footer');
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
            $config["base_url"]     = base_url()."holiday-master/tb";
            $config["total_rows"]   = count($this->academic_model->holidays($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'holiday-master/delete/';
            $data['update_url']       =base_url().'holiday-master/create/';
            $data['rows']           = $this->academic_model->holidays($search,$config["per_page"],$page);
            $page                       = 'erp/academic/tb_holiday';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['action_url']         = base_url().'holiday-master/save';
        $data['total_data']=0;
        $page               = 'erp/academic/holiday_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'holiday-master/save/'.$p1;
        $data['holiday']         = $this->academic_model->view_data_id('holiday_master',$p1);
        $data['total_data']         = $this->academic_model->count_row_id('holiday_master',$p1);
        $page           = 'erp/academic/holiday_create';
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
         'events_name'     => $this->input->post('events'),
         'from_date'  => $this->input->post('fromdate'),
         'to_date'=>$this->input->post('todate'),
          );
         if ($this->erp_model->UpdateData('holiday_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $data = array(
            'events_name'     => $this->input->post('events'),
             'from_date'  => $this->input->post('fromdate'),
             'to_date'=>$this->input->post('todate'),
            'status'        =>1,
            'created_by'      =>$id,
         );
        if ($this->erp_model->Save('holiday_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/academic/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('holiday_master',['id'=>$p1])){
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




    public function exam_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Exam Master';
        $data['new_url']         = base_url().'exam-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/exam_master',$data);
        $this->load->view('erp/academic/footer');
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
            $config["base_url"]     = base_url()."exam-master/tb";
            $config["total_rows"]   = count($this->academic_model->exams($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'exam-master/delete/';
            $data['update_url']       =base_url().'exam-master/create/';
            $data['rows']           = $this->academic_model->exams($search,$config["per_page"],$page);
            $page                       = 'erp/academic/tb_exam';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'exam_remote/title/';
        $data['action_url']         = base_url().'exam-master/save';
        $data['total_data']=0;
        $page               = 'erp/academic/exam_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'exam-master/save/'.$p1;
        $data['exam']         = $this->academic_model->view_data_id('exam_master',$p1);
        $data['total_data']         = $this->academic_model->count_row_id('exam_master',$p1);
        $page           = 'erp/academic/exam_create';
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
         'title'     => $this->input->post('title'),
         'max_marks'  => $this->input->post('marks'),
         'conduct_date'  => $this->input->post('date'),
          );
         if ($this->erp_model->UpdateData('exam_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $data = array(
            'title'     => $this->input->post('title'),
            'max_marks'  => $this->input->post('marks'),
            'conduct_date'  => $this->input->post('date'),
            'status'        =>1,
            'created_by'      =>$id,
         );
        if ($this->erp_model->Save('exam_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/academic/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('exam_master',['id'=>$p1])){
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
    public function exam_remote($type,$id=null,$column='title')
    {
        if ($type=='title') {
            $tb = 'exam_master';
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


    public function category_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Category Master';
        $data['new_url']         = base_url().'category-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/category_master',$data);
        $this->load->view('erp/academic/footer');
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
            $config["base_url"]     = base_url()."category-master/tb";
            $config["total_rows"]   = count($this->academic_model->categories($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'category-master/delete/';
            $data['update_url']       =base_url().'category-master/create/';
            $data['rows']           = $this->academic_model->categories($search,$config["per_page"],$page);
            $page                       = 'erp/academic/tb_category';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'category_remote/category/';
        $data['action_url']         = base_url().'category-master/save';
        $data['total_data']=0;
        $page               = 'erp/academic/category_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'category-master/save/'.$p1;
        $data['category']         = $this->academic_model->view_data_id('category_master',$p1);
        $data['total_data']         = $this->academic_model->count_row_id('category_master',$p1);
        $page           = 'erp/academic/category_create';
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
         'reserve_seat'  => $this->input->post('seat'),
         'fee_relax'  => $this->input->post('fee'),
          );
         if ($this->erp_model->UpdateData('category_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $data = array(
            'name'     => $this->input->post('name'),
             'reserve_seat'  => $this->input->post('seat'),
             'fee_relax'  => $this->input->post('fee'),
            'status'        =>1,
            'created_by'      =>$id,
         );
        if ($this->erp_model->Save('category_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/academic/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('category_master',['id'=>$p1])){
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
    public function category_remote($type,$id=null,$column='name')
    {
        if ($type=='category') {
            $tb = 'category_master';
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
    public function subject_remote($type,$id=null,$column='name')
    {
        if ($type=='subject') {
            $tb = 'subject_master';
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
    public function subject_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
       
        $data['title']          = 'Subject Master';
        $data['new_url']         = base_url().'subject-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/subject_master',$data);
        $this->load->view('erp/academic/footer');
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
            $config["base_url"]     = base_url()."subject-master/tb";
            $config["total_rows"]   = count($this->academic_model->subject_master($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'subject-master/delete/';
            $data['update_url']       =base_url().'subject-master/create/';
            $data['rows']           = $this->academic_model->subject_master($search,$config["per_page"],$page);
            $page                       = 'erp/academic/tb_subject';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'subject_remote/subject/';
        $data['action_url']         = base_url().'subject-master/save';
        $data['total_data']=0;
        $page               = 'erp/academic/subject_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'subject-master/save/'.$p1;
        $data['subject']         = $this->academic_model->view_data_id('subject_master',$p1);
        $data['total_data']         = $this->academic_model->count_row_id('subject_master',$p1);
        $page           = 'erp/academic/subject_create';
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
         if ($this->erp_model->UpdateData('subject_master',$data,$p1)) {
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
        if ($this->erp_model->Save('subject_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/academic/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('subject_master',['id'=>$p1])){
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
    public function subject_topic($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
         $data['subject']         = $this->academic_model->view_data('subject_master');
        $data['title']          = 'Subject Topic Master';
        $data['new_url']         = base_url().'subject-topic-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/subject_topic',$data);
        $this->load->view('erp/academic/footer');
        break;
        case 'tb':
            if(!empty($_POST['subject'])){
                $subject =   $data['subject'] = $_POST['subject'] ;
                 
               }else{
                   $subject =  $data['subject'] = '' ;
               }
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."subject-topic-master/tb";
            $config["total_rows"]   = count($this->academic_model->subject_topic_master($subject));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'subject-topic-master/delete/';
            $data['update_url']       =base_url().'subject-topic-master/create/';
            $data['rows']           = $this->academic_model->subject_topic_master($subject,$config["per_page"],$page);
            $page                       = 'erp/academic/tb_topic';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'subject_remote/subject/';
        $data['action_url']         = base_url().'subject-topic-master/save';
        $data['subject']         = $this->academic_model->view_data('subject_master');
        $data['total_data']=0;
        $page               = 'erp/academic/topic_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'subject-topic-master/save/'.$p1;
        $data['topic']         = $this->academic_model->view_data_id('subject_topic_master',$p1);
        $data['subject']         = $this->academic_model->view_data('subject_master');
        $data['total_data']         = $this->academic_model->count_row_id('subject_topic_master',$p1);
        $page           = 'erp/academic/topic_create';
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
            'sub_id'     => $this->input->post('sub'),
            'topic_name'     => $this->input->post('name'),
          );
         if ($this->erp_model->UpdateData('subject_topic_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $data = array(
            'sub_id'     => $this->input->post('sub'),
            'topic_name'     => $this->input->post('name'),
            'status'        =>1,
            'created_by'      =>$id,
         );
        if ($this->erp_model->Save('subject_topic_master',$data)) {
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
            if ($p1!=null) {
            if($this->erp_model->_delete('subject_topic_master',['id'=>$p1])){
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
    public function student_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'Section Wise Total No. of Student';
        $data['student']         = $this->academic_model->class_wise_student();
        $this->load->view('erp/academic/header',$data);
        $this->load->view('erp/academic/student_master',$data);
        $this->load->view('erp/academic/footer');
        break;
        
        case 'section':
          $id=$_SESSION['MUserId'];
          $data['roles'] = $this->erp_model->view_role($id);
          
          $data['title']          = 'Section Wise Total No. of Student';
          $data['student']         = $this->academic_model->section_student($p1);
          $this->load->view('erp/academic/header',$data);
          $this->load->view('erp/academic/student_list',$data);
          $this->load->view('erp/academic/footer');
        break;  
        
            default:
        # code...
        break;
        }
    } 
        
   public function student_attendance_register($action=null,$p1=null,$p2=null,$p3=null)
   {
       switch ($action) {
       case null:
       $data['menu_id'] = $this->uri->segment(2);
       $id=$_SESSION['MUserId'];
       $data['roles'] = $this->erp_model->view_role($id);
       $data['title']          = 'Student Attendance Register';
       $data['tb_url']            = current_url().'/tb';
       $data['search']           = $this->input->post('search');
       $data['sections']         = $this->academic_model->find_section();
       if(!empty($_POST['section'])){ 
           $data['section'] = $section = $_POST['section'];
           $data['Attmonth'] = $attDate = $_POST['Attmonth'];
               
               }
               else{ 
               $data['section'] = $section = '0';
           $data['Attmonth'] = $Attmonth = date('m');
               }
       $data['student']         = $this->academic_model->attendance_student($section);        
       $this->load->view('erp/academic/header',$data);
       $this->load->view('erp/academic/student_attendance_register',$data);
       $this->load->view('erp/academic/footer');
       break;
         case 'tb':
          if(!empty($_POST['section'])){ 
           $data['section'] = $section = $_POST['section'];
           $data['Attmonth'] = $Attmonth = $_POST['Attmonth'];
          }
          else{ 
            $data['section'] = $section = '0';
           $data['Attmonth'] = $Attmonth = date('m');
               }
           $tea_id=$id=$_SESSION['MUserId'];
           $data['rows']           = $this->academic_model->view_attendance($section,$Attmonth);
           $page                       = 'erp/academic/tb_attendance';
           $this->load->view($page, $data); 
           break;
           default:
       # code...
       break;
       }
   } 
// periods
public function periods($action=null,$p1=null,$p2=null,$p3=null)
{
    switch ($action) {
        case null:
            
    $data['menu_id'] = $this->uri->segment(2);
   
    $data['title']          = 'Class Peroids  Master';
    $data['new_url']         = base_url().'academic-section-wise-period-master/create ';
    $data['tb_url']            = current_url().'/tb';
    $data['search']           = $this->input->post('search');
    $data['section']              = $this->academic_model->view_data('section_master');
    $id=$_SESSION['MUserId'];
    $data['roles'] = $this->erp_model->view_role($id);
    $this->load->view('erp/academic/header',$data);
    $this->load->view('erp/academic/periods_master',$data);
    $this->load->view('erp/academic/footer');
    break;
    case 'tb':
         $id=$_SESSION['MUserId'];
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
        $config["base_url"]     = base_url()."academic-section-wise-period-master/tb";
        $config["total_rows"]   = count($this->academic_model->view_period($id,$search));
        $data['total_rows']     = $config["total_rows"];
        $config["per_page"]     = 10;
        $config["uri_segment"]  = 2;
        $config['attributes']   = array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']          = $this->pagination->create_links();
        $data['page']           = $page = ($p1!=null) ? $p1 : 0;
        $data['search']         = $this->input->post('search');
        $data['delete_url']         = base_url().'academic-section-wise-period-master/delete/';
        $data['update_url']       =base_url().'academic-section-wise-period-master/create/'; 
        $data['rows']           = $this->academic_model->view_period($id,$search,$config["per_page"],$page);
       
        $page                       = 'erp/academic/tb_periods';
        $this->load->view($page, $data); 
        break;
    case 'create':
    $data['action_url']         = base_url().'academic-section-wise-period-master/save';
    $data['section']              = $this->academic_model->view_data('section_master');
    $data['total_data']=0;
    $page               = 'erp/academic/create_period';
    if ($p1!=null) {
    $data['action_url']         = base_url().'academic-section-wise-period-master/save/'.$p1;
    $data['data']         = $this->academic_model->view_data_id('section_periods',$p1);
    $data['section']              = $this->academic_model->view_data('section_master');
    $data['total_data']         = $this->academic_model->count_row_id('section_periods',$p1);
    $page           = 'erp/academic/create_period';
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
     'section_id'     => $this->input->post('section'),
     'period'  => $this->input->post('period'),
      );
      $count = $this->erp_model->Counter('section_periods', array( 'section_id'=> $this->input->post('section'),'period' => $this->input->post('period'),'is_deleted'=>'NOT_DELETED','status'=>'1'));
      if($count==0)
      {
     if ($this->section_head_model->UpdateData('section_periods',$data,$p1)) {
     $return['res'] = 'success';
      $return['msg'] = 'Saved.';  
      }
    }else
    {
        $return['res'] = 'error';
        $return['msg'] = 'This section period already created.';  
    }
 }else
 {
    $id=$_SESSION['MUserId'];
    $data = array(
        'section_id'     => $this->input->post('section'),
        'period'  => $this->input->post('period'),
        'status'        =>1,
        'created_by'      =>$id,
     );
     $count = $this->erp_model->Counter('section_periods', array( 'section_id'=> $this->input->post('section'),'period' => $this->input->post('period'),'is_deleted'=>'NOT_DELETED','status'=>'1'));
     if($count==0)
     {
    if ($this->section_head_model->Save('section_periods',$data)) {
    $return['res'] = 'success';
     $return['msg'] = 'Saved.'; 
     }
    }else
    {
        $return['res'] = 'error';
        $return['msg'] = 'This section period already created.';  
    }
 }
    }
    
    echo json_encode($return);
    break;

    case 'delete':
        $return['res'] = 'error';
        $return['msg'] = 'Not Deleted!';
        if ($p1!=null) {
        if($this->erp_model->_delete('section_periods',['id'=>$p1])){
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

    
public function student_marks_upload($action=null,$p1=null,$p2=null,$p3=null)
{
    switch ($action) {
        case null:
    $data['menu_id'] = $this->uri->segment(2);
    $id=$_SESSION['MUserId'];
     $data['roles'] = $this->erp_model->view_role($id);
    $data['title']          = 'Student Marks Upload';
    $data['tb_url']            = current_url().'/tb';
    $data['search']           = $this->input->post('search');
    $this->load->view('erp/academic/header',$data);
    $this->load->view('erp/academic/student_marks_upload',$data);
    $this->load->view('erp/academic/footer');
    break;
    case 'tb':
       $tea_id=$id=$_SESSION['MUserId'];
        $this->load->library('pagination');
        $config = array();
        $config["base_url"]     = base_url()."student-marks-upload/tb";
        $config["total_rows"]   = count($this->academic_model->upload_marks_tb());
        $data['total_rows']     = $config["total_rows"];
        $config["per_page"]     = 10;
        $config["uri_segment"]  = 2;
        $config['attributes']   = array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']          = $this->pagination->create_links();
        $data['page']           = $page = ($p1!=null) ? $p1 : 0;
        $data['search']         = $this->input->post('search');
        $data['update_url']       =base_url().'student-marks-upload/update/';
        $data['new_url']         = base_url().'student-marks-upload/create/';
        $data['rows']           = $this->academic_model->upload_marks_tb($config["per_page"],$page);
        $page                       = 'erp/academic/tb_uoload_marks';
        $this->load->view($page, $data); 
        break;

        case 'marks_upload':
             $data['menu_id'] = $this->uri->segment(2);
             $id=$_SESSION['MUserId'];
             $data['roles'] = $this->erp_model->view_role($id);
            $data['title']          = 'Student Marks Upload';
            $data['action_url']         = base_url().'student-marks-upload/save/'.$p1;
            $data['map']    =$this->academic_model->SST_MAP($p1);
            $data['form_id']            = uniqid();
            $data['exam']         = $this->academic_model->getData('exam_master');
            if(!empty($_POST['exam']))
            {
                $data['exam_id'] =  $_POST['exam'];
            }else
            {
                $data['exam_id'] = '';
            }
           
             $this->load->view('erp/academic/header',$data);
            $this->load->view('erp/academic/marks_upload',$data);
            $this->load->view('erp/academic/footer');
        break;    
    case 'save':
    $return['res'] = 'error';
    $return['msg'] = 'Not Saved!';

    if ($this->input->server('REQUEST_METHOD')=='POST') { 
    $id=$_SESSION['MUserId'];
    $st = $this->input->post('stu_id');
    if( !empty($_POST['section']) && !empty($_POST['exam_id']) ){
    $i = 0;
    foreach($st as $s){
    $stu_id = $s ;
    $section = $this->input->post('section');
    $exam_id = $this->input->post('exam_id');
    $SSTId = $this->input->post('SSTId');
    $sub_id =$this->input->post('sub_id');
    $mark = $_POST['marks'][$i];
      $count = $this->erp_model->Counter('student_marks', array( 'section_id'=> $section,'student_id' => $stu_id,'sst_id'=>$SSTId,'exam_id'=>$exam_id,'sub_id'=>$sub_id,'is_deleted'=>'NOT_DELETED','status'=>'1'));
    if($count == 0)
    {
     $data= array(
          'student_id' => $stu_id,
          'section_id' => $section,
           'sst_id'=> $SSTId,
          'exam_id' => $exam_id,
          'sub_id' => $sub_id,
          'marks' => $mark,
          'created_by'=>$_SESSION['MUserId'],
        );
       
      $this->academic_model->Insert('student_marks', $data);
    }else
    {
         $data= array(
            'student_id' => $stu_id,
            'section_id' => $section,
             'sst_id'=> $SSTId,
            'exam_id' => $exam_id,
            'sub_id' => $sub_id,
            'marks' => $mark,
            'is_locked'=>'lock',
            'created_by'=>$_SESSION['MUserId'],
          );
          $this->academic_model->Update('student_marks', $data, array('student_id' => $stu_id , 'sst_id'=> $SSTId ,'exam_id' => $exam_id,'sub_id'=>$sub_id,'section_id'=> $section ));
    }

      $i++ ;
      }
    $return['res'] = 'success';
    $return['msg'] = 'Marks Added Successfully.';
    }
     else
     {
        $return['res'] = 'error';
        $return['msg'] = 'Sorry!! Please select exam.';
    }
   }
   echo json_encode($return);
    break; 
    case 'view_marks':
           $data['menu_id'] = $this->uri->segment(2);
           $id=$_SESSION['MUserId'];
           $data['roles'] = $this->erp_model->view_role($id);
           $data['title']          = 'Student Marks Upload';
           $data['action_url']         = base_url().'student-marks-upload/save/'.$p1;
           $data['map']    =$this->academic_model->SST_MAP($p1);
           $data['form_id']            = uniqid();
           $data['exam']         = $this->academic_model->getData('exam_master');
           if(!empty($_POST['exam']))
            {
                $data['exam_id'] =  $_POST['exam'];
            }else
            {
                $data['exam_id'] = '';
            }
           
           $this->load->view('erp/academic/header',$data);
           $this->load->view('erp/academic/view_marks',$data);
           $this->load->view('erp/academic/footer');
    break;  
        default:
    # code...
    break;
    }
} 
public function calendar($action=null,$p1=null,$p2=null,$p3=null)
{
    switch ($action) {
        case null:
    $data['menu_id'] = $this->uri->segment(2);
    $id=$_SESSION['MUserId'];
    $data['roles'] = $this->erp_model->view_role($id);
    $data['title']          = 'Academic Calendar';
    $data['tb_url']            = current_url().'/tb';
    $data['search']           = $this->input->post('search');
    $this->load->view('erp/academic/header',$data);
    $this->load->view('erp/academic/academic_calendar',$data);
    $this->load->view('erp/academic/footer');
    break;
    case 'tb':
         $data['data']               = 1;
         $page                       = 'erp/academic/tb_calendar';
         $this->load->view($page, $data); 
         break;
    default:
    # code...
    break;
    }
} 


}
