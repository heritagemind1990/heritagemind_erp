<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function teacher_login($type)
	{
		if ($this->input->server('REQUEST_METHOD')=='POST') {
			if (!$_POST['email'] or !$_POST['password']) {
				$return['res'] = 'error';
				$return['msg'] = 'Please Enter Username & Password !';
				echo json_encode($return); die();
			}
			$username =$this->input->post('email');
			$password = $this->input->post('password');

			 $count = $this->student_model->Counter('teacher_master', array('email' => $username, 'password' => $password ,'status' =>'1'  ));
			if ($count == 1) {
				$rs = $this->teacher_model->get_user($username,$password);
			  $u_typ=$_POST['type'];
				foreach ($rs as $r) {
					$Name = $r->name;
					$Email = $r->email;
                    $Username = $r->username;
                    $Phone = $r->phone;
					$UserId = $r->id;
				}
				$Sessions = array(
					'MUserId' => $UserId,
					'MEmail' => $Email,
					'MName' => $Name,
					'MContact' => $Phone,
                    'MUsername' => $Username,
					'type' => $u_typ,
					'MLogin' => true);
				$this->session->set_userdata($Sessions);
                $return['res'] = 'success';
                $return['msg'] = 'Login Successful Please Wait Redirecting...';
                $return['redirect_url'] = base_url('common-dashboard');
			} else {
				$return['res'] = 'error';
                $return['msg'] = 'Incorrect Password';
			}
			echo json_encode($return);
    }
}
 
    public function index()
    {
        $this->load->view('erp/login');
    }
 
     public function logout()
     {
        unset($this->session->MLogin);
		session_destroy();
		redirect(base_url());
     }
    public function dashboard()
	{
        $id=$_SESSION['MUserId'];
        $data['title'] = 'School ERP';
        $data['dashboard'] = $this->erp_model->get_row_data('teacher_master',$id);
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/includes/header',$data);
        $this->load->view('erp/includes/dashboard',$data);
        $this->load->view('erp/includes/footer');
	}
    public function teacher_dash()
    {
        $id=$_SESSION['MUserId'];
        $data['title']='Teacher Dashboard';
        $data['total_notice']=$this->teacher_model->count_row_notice('notice_master');
        $data['total_gate_pass']=$this->teacher_model->count_row_gatepass();
        $data['total_student']=$this->teacher_model->count_row_student($id);
        $data['total_notes']=$this->teacher_model->count_row_notes('tb_notes');
        $data['total_home_work']=$this->teacher_model->count_row_hw();
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/index',$data);
        $this->load->view('erp/teacher/footer');
    }


    public function my_notice($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);  
        $data['title']             = 'Notice Board';
        $data['tb_url']            = current_url().'/tb';
        $data['search']            = $this->input->post('search');
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/my_notice',$data);
        $this->load->view('erp/teacher/footer');
        break;
        case 'tb':
          
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."teacher-notice/tb";
            $config["total_rows"]   = count($this->teacher_model->my_totice());
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['rows']           = $this->teacher_model->my_totice($config["per_page"],$page);
            $page                       = 'erp/teacher/tb_notice';
            $this->load->view($page, $data); 
            break;
     
            default:
        # code...
        break;
        }
    }  

    public function upload_notes($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'Upload Notes';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/upload_notes',$data);
        $this->load->view('erp/teacher/footer');
        break;
        case 'tb':
           $tea_id=$id=$_SESSION['MUserId'];
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."upload-notes/tb";
            $config["total_rows"]   = count($this->teacher_model->upload_notes($tea_id));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'upload-notes/delete/';
            $data['update_url']       =base_url().'upload-notes/update/';
            $data['new_url']         = base_url().'upload-notes/create/';
            $data['rows']           = $this->teacher_model->upload_notes($tea_id,$config["per_page"],$page);
            $page                       = 'erp/teacher/tb_upload_notes';
            $this->load->view($page, $data); 
            break;
        case 'create':
        
        $data['action_url']         = base_url().'upload-notes/save/'.$p1;
        $page           = 'erp/teacher/create_upload_notes';
        $data['map']    =$this->teacher_model->SST_MAP($p1);
        $data['form_id']            = uniqid();
        $this->load->view($page, $data);
        break;


        case 'save':
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
        $id=$_SESSION['MUserId'];
        $config['file_name'] = rand(10000, 10000000000);    
        $config['upload_path'] = UPLOAD_PATH.'notes/';
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
           
              $fileName = "notes/" . $image_data['file_name'];
          }
         $file=$data['file'] = $fileName;
          } else {
         $file = $data['file'] = "";
         }
        $data = array(
            'sst_id'     => $this->input->post('sst_id'),
            'sec_id'     => $this->input->post('sec_id'),
            'sub_id'     => $this->input->post('sub_id'),
            'tea_id'     => $this->input->post('tea_id'),
            'sub_name'     => $this->input->post('sub_name'),
            'status'     =>1,
            'created_by' =>$id,
            'file'       =>$file,
            'date' =>date('Y-m-d'),
         );
         $count = $this->erp_model->Counter('tb_notes', array('sst_id'=>$this->input->post('sst_id'),'sec_id'=>$this->input->post('sec_id'),'sub_id'=>$this->input->post('sub_id'),'tea_id'=>$this->input->post('tea_id'),'date'=>date('Y-m-d'),'is_deleted'=>'NOT_DELETED'));
        if($count==0){
         if ($this->erp_model->Save('tb_notes',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
         }
        }else
        {
            $return['res'] = 'error';
            $return['msg'] = 'Today this subject notes already uploaded.';
        }
       }
       echo json_encode($return);
        break;
            default:
        # code...
        break;
        }
    }   
  
	public function change_status()
	{
		if ($this->input->is_ajax_request()) {
			$data = explode(',',$_POST['data']);
			$id 	= $data[0];
			$tb 	= $data[1];
			$id_column  = $data[2];
			$val_column  = $data[3];
			$update = array($val_column => $_POST['value'] );
			$cond = [$id_column => $id];
			$column = "column='$id_column'";
			
			$this->erp_model->Update($tb,$update,$cond);
			$status = $this->erp_model->getRow($tb,$cond)->$val_column;

			if ($status==1) {
				echo "<span class='changeStatus'  data-toggle='change-status' value='0' data='".$_POST['data']."' title='Click for chenage status' ><i class='fa-regular fa-circle-check' style='color:green'></i></span>";
			} 
			else{
				echo "<span class='changeStatus' data-toggle='change-status' value='1' data='".$_POST['data']."'  title='Click for chenage status'><i class='fa-solid fa-circle-xmark' style='color:red'></i></span>";
			}	
		}
	}
    public function view_notes($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);         
        $data['title']             = 'All Uploaded Notes';
        $data['tb_url']            = current_url().'/tb';
        $data['search']            = $this->input->post('search');
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/view_notes',$data);
        $this->load->view('erp/teacher/footer');
        break;
        case 'tb':
          $tea_id = $id=$_SESSION['MUserId'];
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."teacher-view-notes/tb";
            $config["total_rows"]   = count($this->teacher_model->view_notes($tea_id));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'teacher-view-notes/delete/';
            $data['update_url']       =base_url().'teacher-view-notes/create/';
            $data['rows']           = $this->teacher_model->view_notes($tea_id,$config["per_page"],$page);
            $page                       = 'erp/teacher/tb_view_notes';
            $this->load->view($page, $data); 
            break;
            case 'delete':
                $return['res'] = 'error';
                $return['msg'] = 'Not Deleted!';
                if ($p1!=null) {
                if($this->erp_model->_delete('tb_notes',['id'=>$p1])){
                        $saved = 1;
                        $return['res'] = 'success';
                        $return['msg'] = 'Successfully deleted.';
                    }
                }
                echo json_encode($return);
            break;
            case 'create':
        
                $data['action_url']         = base_url().'teacher-view-notes/save/'.$p1;
                $page           = 'erp/teacher/update_notes';
                $data['form_id']            = uniqid();
                $this->load->view($page, $data);
            break;
            case 'save':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';
        
                if ($this->input->server('REQUEST_METHOD')=='POST') { 
                    $config['file_name'] = rand(10000, 10000000000);    
                    $config['upload_path'] = UPLOAD_PATH.'notes/';
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
                       
                          $fileName = "notes/" . $image_data['file_name'];
                      }
                     $file=$data['file'] = $fileName;
                      } else {
                     $file = $data['file'] = "";
                     }
                 $data = array(
                 'file'     => $file,
                  );
                 if ($this->erp_model->UpdateData('tb_notes',$data,$p1)) {
                 $return['res'] = 'success';
                  $return['msg'] = 'Saved.';
                             
                  
             }
                }
                
                echo json_encode($return);
                break;
            default:
        # code...
        break;
        }
    }   
    public function upload_hw($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'Upload Home Work';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/upload_hw',$data);
        $this->load->view('erp/teacher/footer');
        break;
        case 'tb':
           $tea_id=$id=$_SESSION['MUserId'];
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."upload-hw/tb";
            $config["total_rows"]   = count($this->teacher_model->upload_notes($tea_id));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'upload-hw/delete/';
            $data['update_url']       =base_url().'upload-hw/update/';
            $data['new_url']         = base_url().'upload-hw/create/';
            $data['rows']           = $this->teacher_model->upload_notes($tea_id,$config["per_page"],$page);
            $page                       = 'erp/teacher/tb_hw';
            $this->load->view($page, $data); 
            break;
        case 'create':
        
        $data['action_url']         = base_url().'upload-hw/save/'.$p1;
        $page           = 'erp/teacher/create_hw';
        $data['map']    =$this->teacher_model->SST_MAP($p1);
        $data['topic']    =$this->teacher_model->view_data('subject_topic_master');
        $data['form_id']            = uniqid();
        $this->load->view($page, $data);
        break;


        case 'save':
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
        $id=$_SESSION['MUserId'];
        $config['file_name'] = rand(10000, 10000000000);    
        $config['upload_path'] = UPLOAD_PATH.'home_work/';
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
           
              $fileName = "home_work/" . $image_data['file_name'];
          }
         $file=$data['file'] = $fileName;
          } else {
         $file = $data['file'] = "";
         }
        $data = array(
            'sst_id'     => $this->input->post('sst_id'),
            'sec_id'     => $this->input->post('sec_id'),
            'sub_id'     => $this->input->post('sub_id'),
            'sub_name'     => $this->input->post('sub_name'),
            'topic_id'     => $this->input->post('topic'),
            'home_work'     => $this->input->post('hw'),
            'status'     =>1,
            'created_by' =>$id,
            'hw_file'       =>$file,
            'hw_date' =>$this->input->post('date'),
         );
         $count = $this->erp_model->Counter('t_student_hw', array('sst_id'=>$this->input->post('sst_id'),'sec_id'=>$this->input->post('sec_id'),'sub_id'=>$this->input->post('sub_id'),'hw_date'=>date('Y-m-d'),'is_deleted'=>'NOT_DELETED','status'=>'1'));
        if($count==0){
         if ($this->erp_model->Save('t_student_hw',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
         }
        }else
        {
            $return['res'] = 'error';
            $return['msg'] = 'Today this subject home work already uploaded.';
        }
       }
       echo json_encode($return);
        break;
        case 'view_hw':
            $data['menu_id'] = $this->uri->segment(2);
            $id=$_SESSION['MUserId'];
             $data['roles'] = $this->erp_model->view_role($id);
            $data['title']          = 'View Home Work';
            $data['rows']    =$this->teacher_model->view_hw($p1);
            $this->load->view('erp/teacher/header',$data);
            $this->load->view('erp/teacher/view_hw',$data);
            $this->load->view('erp/teacher/footer');
        break; 
        case 'submit-check':
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';
        
                if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $data = array(
                    'teacher_status'     => $this->input->post('check'),
                    'teacher_check'     => $this->input->post('remark'),
                 );
                 if ($this->teacher_model->Updates('stu_hw_submit',$data,['hw_submit_date'=>$this->input->post('hw_date'),'student_id'=>$this->input->post('stu_id')])) {
                $return['res'] = 'success';
                 $return['msg'] = 'Checked.';
                 }
               }
               echo json_encode($return);
                
        break;    
            default:
        # code...
        break;
        }
    }   

    public function student_gatepass($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case null:
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'Student Gate Pass';
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/stu_gate_pass',$data);
        $this->load->view('erp/teacher/footer');
        break;
        case 'search_data':
        $id=$_SESSION['MUserId'];
        $searchTerm = $this->input->post('searchTerm');
        $data = $this->teacher_model->search_data($id,$searchTerm);
        echo json_encode($data);
        break;  
        
        case 'createpass':
        $id=$_SESSION['MUserId'];
        $data['roles']          = $this->erp_model->view_role($id);
        $data['title']          = 'Student Gate Pass';
        $data['student']        = $this->teacher_model->get_student_row($p1);
        $data['rows']           = $this->teacher_model->get_pass($p1);
        $data['action_url']     = base_url().'teacher-student-gate-pass/save/'.$p1;
        $data['delete_url']     = base_url().'teacher-student-gate-pass/delete/';
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/gate_pass',$data);
        $this->load->view('erp/teacher/footer');
        break;   
       
        case 'save':
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';
        if ($this->input->server('REQUEST_METHOD')=='POST') { 
        $id=$_SESSION['MUserId'];
        $data = array(
            'stu_id'     => $this->input->post('stu_id'),
            'reason'     => $this->input->post('reason'),
            'status'     =>1,
            'created_by' =>$id,
            'type'       =>'teacher',
            'teacher_check'=>'1',
            'date' =>$this->input->post('date'),
         );
         $count = $this->erp_model->Counter('student_gate_pass', array('stu_id'=>$this->input->post('stu_id'),'date'=>$this->input->post('date'),'is_deleted'=>'NOT_DELETED','status'=>'1'));
        if($count==0){
         if ($this->erp_model->Save('student_gate_pass',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Successfully created.';
         }
        }else
        {
            $return['res'] = 'error';
            $return['msg'] = 'Today this student gate pass already created.';
        }
       }
       echo json_encode($return);
     break;
     case 'delete':
        $return['res'] = 'error';
        $return['msg'] = 'Not Deleted!';
        if ($p1!=null) {
        if($this->erp_model->_delete('student_gate_pass',['id'=>$p1])){
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
        $data['student']         = $this->teacher_model->class_wise_student($id);
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/student_master',$data);
        $this->load->view('erp/teacher/footer');
        break;
        
        case 'section':
          $id=$_SESSION['MUserId'];
          $data['roles'] = $this->erp_model->view_role($id);
          $data['title']          = 'Section Wise Total No. of Student';
          $data['student']         = $this->teacher_model->section_student($p1);
          $this->load->view('erp/teacher/header',$data);
          $this->load->view('erp/teacher/student_list',$data);
          $this->load->view('erp/teacher/footer');
        break;  
        
            default:
        # code...
        break;
        }
    } 

    public function student_attendance($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'Student Attendance';
        $data['sections']         = $this->teacher_model->find_section($id);
        if(!empty($_POST['section']) && !empty($_POST['attDate'])){ 
            $data['section'] = $section = $_POST['section'];
            $data['date'] = $date = $_POST['attDate'];
                
                }
                else{ 
                        $data['section'] = $section = '0';
            $data['date'] = $date = date('Y-m-d');
                }
        $data['student']         = $this->teacher_model->attendance_student($section);        
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/student_attendance',$data);
        $this->load->view('erp/teacher/footer');
        break;

        case 'studentPresent':
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
            $date = $_POST['date'] ;
            $section = $_POST['section'] ;
           if(!empty($section)){
	       $stuList = $this->teacher_model->attendance_student($section);
	       foreach($stuList as $stu){
           $count = $this->erp_model->Counter('student_attendance', array('date' => $date, 'student_id' => $stu->id, 'section' => $section));
	      if ($count == 0) {
       $month =  date('m', strtotime($date));     
       $year = date('Y', strtotime($date)); 
		$data = array(
        'date' => $date , 
        'student_id' => $stu->id,  
        'student_fname' => $stu->fname ,
        'student_lname' => $stu->lname ,
        'month'         =>$month,
        'year'         =>$year,
        'attendance' => 1,   
    	'created_by' => $_SESSION['MUserId'] ,
    	'section' => $section ,
        'status' =>'1',
		);
	   $this->teacher_model->Insert('student_attendance', $data);
			}
        
		}
        $return['res'] = 'success';
        $return['msg'] = 'Attendance Saved.';	
           }else{
              
            $return['res'] = 'error';
            $return['msg'] = '';
           }
        echo json_encode($return); 
         break; 
         
         case 'studentAbsent':
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
            $date = $_POST['date'] ;
            $section = $_POST['section'] ;
            $stu_id = $_POST['stu_id'] ;
           if(!empty($section)){
    
      $count = $this->erp_model->Counter('student_attendance', array('date' => $date, 'student_id' => $stu_id, 'section' => $section));
      if ($count == 1) {
        
     $attStatus = $this->teacher_model->Select('student_attendance', '*', array('date' => $date, 'student_id' => $stu_id, 'section' => $section));
    
   $attSta = $attStatus[0]->attendance ;
        if($attSta == 1){
    $f = array('attendance' => 0 , );
    $this->teacher_model->Updates('student_attendance', $f, array('date' => $date, 'student_id' => $stu_id, 'section' => $section));

        }elseif($attSta == 0){
    $f = array('attendance' => 1, );
    $this->teacher_model->Updates('student_attendance', $f, array('date' => $date, 'student_id' => $stu_id, 'section' => $section));

        }  
        $return['res'] = 'success';
        $return['msg'] = 'Attendance  Saved.';	

        }else{
              
            
            $return['res'] = 'success';
            $return['msg'] = 'Attendance Not Saved.';
       }	   
           }else{
              
            
            $return['res'] = 'error';
            $return['msg'] = 'Attendance Not Saved.';
           }
        echo json_encode($return);  
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
        $data['sections']         = $this->teacher_model->find_section($id);
        if(!empty($_POST['section'])){ 
            $data['section'] = $section = $_POST['section'];
            $data['Attmonth'] = $attDate = $_POST['Attmonth'];
                
                }
                else{ 
                $data['section'] = $section = '0';
            $data['Attmonth'] = $Attmonth = '';
                }
        $data['student']         = $this->teacher_model->attendance_student($section);        
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/student_attendance_register',$data);
        $this->load->view('erp/teacher/footer');
        break;
          case 'tb':
           if(!empty($_POST['section'])){ 
            $data['section'] = $section = $_POST['section'];
            $data['Attmonth'] = $Attmonth = $_POST['Attmonth'];
           }
           else{ 
             $data['section'] = $section = '0';
            $data['Attmonth'] = $Attmonth = '';
                }
            $tea_id=$id=$_SESSION['MUserId'];
            $data['rows']           = $this->teacher_model->view_attendance($section,$Attmonth);
            $page                       = 'erp/teacher/tb_attendance';
            $this->load->view($page, $data); 
            break;
            default:
        # code...
        break;
        }
    } 


    public function time_table($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'My Time Table';
        $data['tb_url']            = current_url().'/tb';
        $data['new_url']            = current_url().'/create';
        $data['search']           = $this->input->post('search');
        $data['section']         = $this->teacher_model->find_section($id);
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/timetable_master',$data);
        $this->load->view('erp/teacher/footer');
        break;
        case 'tb':
            $tea_id=$id=$_SESSION['MUserId'];
            if(!empty($_POST['section']))
            {
               $section =  $data['section'] = $_POST['section'];
            }
            else
            {
               $section =  $data['section']= '';
            }
            $data['section_name']   = $this->teacher_model->view_data_id('section_master',$section);
            $data['period']         = $this->teacher_model->view_period_data('section_periods');
            $page                       = 'erp/teacher/tb_timetable';
            $this->load->view($page, $data); 
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
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/student_marks_upload',$data);
        $this->load->view('erp/teacher/footer');
        break;
        case 'tb':
            $userid=$id=$_SESSION['MUserId'];
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."teacher-student-marks-upload/tb";
            $config["total_rows"]   = count($this->teacher_model->upload_marks_tb($userid));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['update_url']       =base_url().'teacher-student-marks-upload/update/';
            $data['new_url']         = base_url().'teacher-student-marks-upload/create/';
            $data['rows']           = $this->teacher_model->upload_marks_tb($userid,$config["per_page"],$page);
            $page                       = 'erp/teacher/tb_uoload_marks';
            $this->load->view($page, $data); 
            break;
    
            case 'marks_upload':
                 $data['menu_id'] = $this->uri->segment(2);
                 $id=$_SESSION['MUserId'];
                 $data['roles'] = $this->erp_model->view_role($id);
                $data['title']          = 'Student Marks Upload';
                $data['action_url']         = base_url().'teacher-student-marks-upload/save/'.$p1;
                $data['map']    =$this->teacher_model->SST_MAP($p1);
                $data['form_id']            = uniqid();
                $data['exam']         = $this->teacher_model->getData('exam_master');
                if(!empty($_POST['exam']))
                {
                    $data['exam_id'] =  $_POST['exam'];
                }else
                {
                    $data['exam_id'] = '';
                }
               
                 $this->load->view('erp/teacher/header',$data);
                $this->load->view('erp/teacher/marks_upload',$data);
                $this->load->view('erp/teacher/footer');
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
               $data['action_url']         = base_url().'teacher-student-marks-upload/save/'.$p1;
               $data['map']    =$this->teacher_model->SST_MAP($p1);
               $data['form_id']            = uniqid();
               $data['exam']         = $this->teacher_model->getData('exam_master');
               if(!empty($_POST['exam']))
                {
                    $data['exam_id'] =  $_POST['exam'];
                }else
                {
                    $data['exam_id'] = '';
                }
               
               $this->load->view('erp/teacher/header',$data);
               $this->load->view('erp/teacher/view_marks',$data);
               $this->load->view('erp/teacher/footer');
        break;  
            default:
        # code...
        break;
        }
    } 


    public function teacher_attendance($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'My Attendance';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/teacher/header',$data);
        $this->load->view('erp/teacher/teacher_attendance',$data);
        $this->load->view('erp/teacher/footer');
        break;
        case 'submit_attendance':


        break;    
        case 'tb':
            $userid=$id=$_SESSION['MUserId'];
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."teacher-student-marks-upload/tb";
            $config["total_rows"]   = count($this->teacher_model->upload_marks_tb($userid));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['update_url']       =base_url().'teacher-student-marks-upload/update/';
            $data['new_url']         = base_url().'teacher-student-marks-upload/create/';
            $data['rows']           = $this->teacher_model->upload_marks_tb($userid,$config["per_page"],$page);
            $page                       = 'erp/teacher/tb_uoload_marks';
            $this->load->view($page, $data); 
            break;
    
            case 'marks_upload':
                 $data['menu_id'] = $this->uri->segment(2);
                 $id=$_SESSION['MUserId'];
                 $data['roles'] = $this->erp_model->view_role($id);
                $data['title']          = 'Student Marks Upload';
                $data['action_url']         = base_url().'teacher-student-marks-upload/save/'.$p1;
                $data['map']    =$this->teacher_model->SST_MAP($p1);
                $data['form_id']            = uniqid();
                $data['exam']         = $this->teacher_model->getData('exam_master');
                if(!empty($_POST['exam']))
                {
                    $data['exam_id'] =  $_POST['exam'];
                }else
                {
                    $data['exam_id'] = '';
                }
               
                 $this->load->view('erp/teacher/header',$data);
                $this->load->view('erp/teacher/marks_upload',$data);
                $this->load->view('erp/teacher/footer');
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
               $data['action_url']         = base_url().'teacher-student-marks-upload/save/'.$p1;
               $data['map']    =$this->teacher_model->SST_MAP($p1);
               $data['form_id']            = uniqid();
               $data['exam']         = $this->teacher_model->getData('exam_master');
               if(!empty($_POST['exam']))
                {
                    $data['exam_id'] =  $_POST['exam'];
                }else
                {
                    $data['exam_id'] = '';
                }
               
               $this->load->view('erp/teacher/header',$data);
               $this->load->view('erp/teacher/view_marks',$data);
               $this->load->view('erp/teacher/footer');
        break;  
            default:
        # code...
        break;
        }
    } 
    

    public function submit_attendance() {
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');

        // Sample target location (latitude, longitude) for demonstration purposes
        $target_location = array('latitude' => 26.47784973920826, 'longitude' => 80.2913623093044);

        // Maximum allowed distance for attendance (in meters)
        $max_distance = 1000;
        // Calculate distance to the target location
        $distance_to_target = $this->calculate_distance($latitude, $longitude, $target_location['latitude'], $target_location['longitude']);

        // Check if the user is within the allowed distance
        if ($distance_to_target <= $max_distance) {
            if($_POST['att_id'] ==''){
            $attdata['tea_id'] = $tea_id = $_SESSION['MUserId'];
            $attdata['punch_in'] =$punch_in =date('H:i:s'); 
            $attdata['punch_date'] =$punch_date = date('Y-m-d');
            $attdata['att_status'] = '1';
            $attdata['created_by'] = $tea_id = $_SESSION['MUserId'];
            if ($this->erp_model->Save('staff_attendance',$attdata)) {
                echo json_encode(array('status' => 'success', 'message' => 'Attendance punch in successfully!'));
                 }else
                 {
                    echo json_encode(array('status' => 'error', 'message' => 'Attendance not marked!'));
                 }
          }else
          {
            $attdata1['punch_out'] =$punch_out =date('H:i:s'); 
            $attdata1['final'] ='1'; 
            if ($this->erp_model->Update('staff_attendance',$attdata1,['tea_id'=>$_SESSION['MUserId']])) {
                echo json_encode(array('status' => 'success', 'message' => 'Attendance punch out successfully!'));
                 }else
                 {
                    echo json_encode(array('status' => 'error', 'message' => 'Attendance not marked!'));
                 } 
          }     
           
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'You are not within the attendance range.'));
        }
    }

    private function calculate_distance($lat1, $lon1, $lat2, $lon2) {
        $R = 6371000.0; // Radius of the Earth in meters

        $lat1_rad = deg2rad($lat1);
        $lon1_rad = deg2rad($lon1);
        $lat2_rad = deg2rad($lat2);
        $lon2_rad = deg2rad($lon2);

        $dlat = $lat2_rad - $lat1_rad;
        $dlon = $lon2_rad - $lon1_rad;

        $a = sin($dlat / 2) ** 2 + cos($lat1_rad) * cos($lat2_rad) * sin($dlon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $R * $c;

        return $distance;
    }



}
