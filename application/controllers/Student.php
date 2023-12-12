<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Inst.php');
class Student extends Inst {

    public function __construct()
    {
        parent::__construct();
    }
	public function student_login($type)
	{
		if ($this->input->server('REQUEST_METHOD')=='POST') {
			if (!$_POST['username'] or !$_POST['password']) {
				$return['res'] = 'error';
				$return['msg'] = 'Please Enter Username & Password !';
				echo json_encode($return); die();
			}
			$username =$this->input->post('username');
			$password = $this->input->post('password');

			 $count = $this->student_model->Counter('student_master', array('mobile' => $username, 'pass' => $password ,'regstatus' =>'1' , 'type' =>'REGISTERED','IsLeft'=>'0' ));
			 $count2 = $this->student_model->Counter('student_master', array('father_no' => $username, 'pass' => $password ,'regstatus' =>'1' , 'type' =>'REGISTERED' ,'IsLeft'=>'0'));

			 $count3 = $this->student_model->Counter('student_master', array('enrollment' => $username, 'pass' => $password ,'regstatus' =>'1' , 'type' =>'REGISTERED' ,'IsLeft'=>'0' ));
			
			if ($count == 1 || $count2 == 1  || $count3 == 1) {
				$rs = $this->student_model->get_user($username,$password);
			  $u_typ=$_POST['type'];
				foreach ($rs as $r) {
					$Fname = $r->fname;
					$Lname = $r->lname;
                    $enrollment = $r->enrollment;
					$mobile = $r->mobile;
					$father_no = $r->father_no;
					$stu_id = $r->stu_id;
					$UserId = $r->id;
				}
				$Sessions = array(
					'MUserId' => $UserId,
					'Menrollment' => $enrollment,
					'MName' => $Fname.' '.$Lname,
					'MContact' => $mobile,
					'MFcontact' => $father_no,
					'MStuID' => $stu_id,
					'type' => $u_typ,
					'MLogin' => true);
				$this->session->set_userdata($Sessions);
						$return['res'] = 'success';
						$return['msg'] = 'Login Successful Please Wait Redirecting...';
						$return['redirect_url'] = base_url('student-dashboard');
			} else {
				$return['res'] = 'error';
                $return['msg'] = 'Incorrect Password';
			}
			echo json_encode($return);
    }
	else{
		$data['title'] 	= 'Login';
		$data['type']	=	$type;
		
		load_view('inst',$data);
	}
	
}

public function Logout()
{

		unset($this->session->MLogin);
		session_destroy();
		redirect(base_url());
	}
    public function Student_dashboard()
    {
		$id = $_SESSION['MUserId'];
        $data['title']='Student Dashboard';
        $data['total_notice']=$this->student_model->count_row_notice('notice_master');
        $data['total_home_work']=$this->student_model->count_row_hw($id);
        $data['total_student']=$this->student_model->count_row('student_master');
        $data['total_room']=$this->student_model->count_row_notes($id);
        $data['total_gate_pass']=$this->student_model->count_row_gatepass($id);
        $this->load->view('erp/student/header',$data);
        $this->load->view('erp/student/index',$data);
        $this->load->view('erp/student/footer');
   }

     public function my_notice($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['title']             = 'My Notice';
        $data['tb_url']            = current_url().'/tb';
        $data['search']            = $this->input->post('search');
        $this->load->view('erp/student/header',$data);
        $this->load->view('erp/student/my_notice',$data);
        $this->load->view('erp/student/footer');
        break;
        case 'tb':
          
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."my-notice/tb";
            $config["total_rows"]   = count($this->student_model->my_totice());
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['rows']           = $this->student_model->my_totice($config["per_page"],$page);
            $page                       = 'erp/student/tb_notice';
            $this->load->view($page, $data); 
            break;
     
            default:
        # code...
        break;
        }
    }  
  


  public function student_subject_notes($action=null,$p1=null)
    {
        switch ($action) {
            case null:        
        $data['title']             = 'All Uploaded Notes';
        $data['tb_url']            = current_url().'/tb';
        $data['search']            = $this->input->post('search');
        $this->load->view('erp/student/header',$data);
        $this->load->view('erp/student/view_notes',$data);
        $this->load->view('erp/student/footer');
        break;
        case 'tb':
           $id=$_SESSION['MUserId'];
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."student-subject-notes/tb";
            $config["total_rows"]   = count($this->student_model->view_notes($id));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['rows']           = $this->student_model->view_notes($id,$config["per_page"],$page);
            $page                       = 'erp/student/tb_view_notes';
            $this->load->view($page, $data); 
            break;
          
            default:
        # code...
        break;
        }
    }  
  


  public function student_home_work($action=null,$p1=null)
    {
        switch ($action) {
            case null:        
        $data['title']             = 'My Home Work';
        $data['tb_url']            = current_url().'/tb';
        $data['search']            = $this->input->post('search');
        $this->load->view('erp/student/header',$data);
        $this->load->view('erp/student/view_hw',$data);
        $this->load->view('erp/student/footer');
        break;
        case 'tb':
           $id=$_SESSION['MUserId'];
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."student-home-work/tb";
            $config["total_rows"]   = count($this->student_model->view_home_work($id));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['submit_url']         = base_url().'student-home-work/create/';
            $data['rows']           = $this->student_model->view_home_work($id,$config["per_page"],$page);
            $page                       = 'erp/student/tb_view_hw';
            $this->load->view($page, $data); 
            break;
            case 'create':
	        $data['action_url']         = base_url().'student-home-work/save/'.$p1;
	        $page           = 'erp/student/submit_hw';
	        $data['hw']     = $this->student_model->get_home_work($p1);
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
            'hw_id'     => $p1,
            'sec_id'     => $this->input->post('sec_id'),
            'student_id'     => $this->input->post('student_id'),
            'hw_remark'     => $this->input->post('hw'),
            'status'     =>1,
            'created_by' =>$id,
            'hw_file'       =>$file,
            'hw_submit_date' =>date('Y-m-d'),
         );
         $count = $this->student_model->Counter('stu_hw_submit', array('hw_id'=>$this->input->post('student_id'),'sec_id'=>$this->input->post('sec_id'),'hw_submit_date'=>date('Y-m-d'),'is_deleted'=>'NOT_DELETED','status'=>'1'));
        if($count==0){
         if ($this->erp_model->Save('stu_hw_submit',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
         }
        }else
        {
            $return['res'] = 'error';
            $return['msg'] = 'Today this Subject Home Work Already Submitted.';
        }
       }
       echo json_encode($return);
        break;
        case 'parent-check':
                 $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';
        
                if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $data = array(
                    'parent_status'     => $this->input->post('check'),
                 );
                 if ($this->student_model->Updates('stu_hw_submit',$data,['hw_submit_date'=>$this->input->post('hw_date'),'student_id'=>$this->input->post('student_id')])) {
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
        $data['roles']          = $this->erp_model->view_role($id);
        $data['title']          = 'Student Gate Pass';
        $data['student']        = $this->student_model->get_student_row($id);
        $data['rows']           = $this->student_model->get_pass($id);
        $data['action_url']     = base_url().'student-gate-pass/save/'.$id;
        $data['delete_url']     = base_url().'student-gate-pass/delete/';
        $this->load->view('erp/student/header',$data);
        $this->load->view('erp/student/gate_pass',$data);
        $this->load->view('erp/student/footer');
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
            'type'       =>'student',
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

  public function student_attendance_register($action=null,$p1=null,$p2=null,$p3=null)
   {
       switch ($action) {
       case null:
       $data['menu_id'] = $this->uri->segment(2);
       $id=$_SESSION['MUserId'];
       $data['roles'] = $this->erp_model->view_role($id);
       $data['title']          = 'My Attendance Register';
       $data['tb_url']            = current_url().'/tb';
       $data['search']           = $this->input->post('search');
       if(!empty($_POST['section'])){ 
           $data['section'] = $section = $_POST['section'];
           $data['Attmonth'] = $attDate = $_POST['Attmonth'];
               
               }
               else{ 
               $data['section'] = $section = '0';
           $data['Attmonth'] = $Attmonth = '';
               }       
       $this->load->view('erp/student/header',$data);
       $this->load->view('erp/student/student_attendance_register',$data);
       $this->load->view('erp/student/footer');
       break;
         case 'tb':
       //  echo $_POST['Attmonth'];die();
          if(!empty($_POST['Attmonth'])){ 
           $data['Attmonth'] = $Attmonth = $_POST['Attmonth'];
          }
          else{ 
           $data['Attmonth'] = $Attmonth = '';
               }
           $id=$_SESSION['MUserId'];
           $rs=$this->student_model->view_att_date($Attmonth);
            if(!empty($rs->date))
            {
                $fdats = $rs->date;
            }else
            {
              $fdats = date('Y-m-d');
            }
            $yrdata= strtotime($fdats);
            $data['Years'] =  date('Y', $yrdata);
           $data['rows']           = $this->student_model->view_attendance($id,$Attmonth);
           $page                       = 'erp/student/tb_attendance';
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
       $this->load->view('erp/student/header',$data);
       $this->load->view('erp/student/timetable_master',$data);
       $this->load->view('erp/student/footer');
       break;
       case 'tb':
           $id=$_SESSION['MUserId'];
           $rs= $this->student_model->find_section($id);
           $data['section']=$rs->sec_id;
           $data['section_name']   = $this->student_model->view_data_id('section_master',$rs->sec_id);
           $data['period']         = $this->student_model->view_period_data('section_periods');
           $page                       = 'erp/student/tb_timetable';
           $this->load->view($page, $data); 
           break;
      
           default:
       # code...
       break;
       }
   }




}   