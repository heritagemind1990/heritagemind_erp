<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inst extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function inst_login($type)
	{
		if ($this->input->server('REQUEST_METHOD')=='POST') {
			if (!$_POST['email'] or !$_POST['password']) {
				$return['res'] = 'error';
				$return['msg'] = 'Please Enter Username & Password !';
				echo json_encode($return); die();
			}
			$username =$this->input->post('email');
			$password = $this->input->post('password');

			 $count = $this->student_model->Counter('institute', array('email' => $username, 'password' => $password ,'status' =>'1'  ));
			if ($count == 1) {
				$rs = $this->erp_model->get_user($username,$password);
			  $u_typ=$_POST['type'];
				foreach ($rs as $r) {
					$Name = $r->name;
					$Email = $r->email;
                    $Inst_code = $r->inst_code;
                    $Phone = $r->contact;
					$UserId = $r->id;
				}
				$Sessions = array(
					'MUserId' => $UserId,
					'MEmail' => $Email,
					'MName' => $Name,
					'MContact' => $Phone,
                    'MInstCode' => $Inst_code,
					'type' => $u_typ,
					'MLogin' => true);
				$this->session->set_userdata($Sessions);
                $return['res'] = 'success';
                $return['msg'] = 'Login Successful Please Wait Redirecting...';
                $return['redirect_url'] = base_url('inst-dashboard');
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
 
     public function inst_logout()
     {
        unset($this->session->MLogin);
		session_destroy();
		redirect(base_url());
     }
 
    
    public function inst_dashboard()
	{
       $id = $_SESSION['MUserId'];
        $data['title'] = 'School ERP';
        $data['dashboard'] = $this->erp_model->get_row_data('institute',$id);
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/inst/header',$data);
        $this->load->view('erp/inst/index',$data);
        $this->load->view('erp/inst/footer');
	}
    public function inst_profile()
	{
        $user_id = $_SESSION['user_id'];
        $data['title'] = 'Admin Profile';
        $data['admin_data'] = $this->erp_model->view_data('institute',$user_id);
        $this->load->view('erp/inst/header');
        $this->load->view('erp/inst/admin_profile',$data);
        $this->load->view('erp/inst/footer');
	}

    public function edit_inst_profile()
	{
        

        $data = array(
            'name'     => $this->input->post('name'),
            'contact'     => $this->input->post('contact'),
            'email'     => $this->input->post('email'),
        );
       
        if ($this->admin_modal->edit_admin_profile($data,$id)) {
          
            $return['res'] = 'error';
            $return['msg'] = 'Confirm password not match!';
        } else {
            redirect($this->agent->referrer());
        }
    
    }
    public function inst_change_password()
	{
        $data['title'] = 'Change Password';
        $page = 'admin/admin_change_password';
        $this->header_and_footer($page, $data);
	}
    public function update_inst_password()
	{
        $password = $this->input->post('new_password');
        $data = array(
            'password'     => md5($this->input->post('new_password')),
        );
        $old_pass = md5($this->input->post('old_password'));
        $result = $this->admin_modal->check_old_password($old_pass);

        if($result)
        {
            if ($this->admin_modal->edit_data('institute','1',$data)) {
                $this->session->set_flashdata('success','Password Changed Successfully..');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error','Password Not Changed!!');
                redirect($this->agent->referrer());
            }
        }
        else
        {
            $this->session->set_flashdata('error','Old Password Does not match!!');
			redirect($this->agent->referrer());
        }
	}

    public function inst_profile_img()
    {
         $id = $_SESSION['user_id'];
         $return['res'] = 'error';
         $return['msg'] = 'Not Saved!';
         if ($this->input->server('REQUEST_METHOD')=='POST') {
            //echo $id;die();
		// for admin and admin_users
                 if (@$_FILES['photo']['name']) {
                     if($file = upload_file('users','photo')){
                         $_POST['photo'] = $file;
                     }
                 }
                 if (@$_POST) {
                     if($this->admin_modal->Update('institute',$_POST,['id'=>$id])){
                         $return['res'] = 'success';
                         $return['msg'] = 'Saved.';
                     }	
                 }
             
         }
         echo json_encode($return);
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
    public function teacher_info($action=null,$p1=null,$p2=null,$p3=null)
    {
              
        switch ($action) {
                
            case null:
                $data['menu_id'] = $this->uri->segment(2);
                $data['title']          = 'Teachers Basic Information';
                $data['new_url']         = base_url().'teacher-info/teacher_create';
                $data['tb_url']         = base_url().'teacher-info/Teacher_tb';
                $data['delete_url']         = base_url().'teacher-info/delete/';
                $data['doc_url']         = base_url().'teacher-info/document/';
                $data['update_url']         = base_url().'teacher-info/teacher_create/';
                $data['rs']         = $this->erp_model->teacher_data();
                $this->load->view('erp/inst/header',$data);
                $this->load->view('erp/inst/teacher_info',$data);
                $this->load->view('erp/inst/footer');
                break;

                case 'teacher_create':
                    $data['action_url']         = base_url().'teacher-info/save';
                    $data['total_data']=0;
                    $page                       = 'erp/inst/teacher_create';
                    if ($p1!=null) {
                        $data['update_url']     = base_url().'teacher-info/save/'.$p1;
                        $data['teacher']         = $this->erp_model->teacher_data_view($p1);
                        $data['total_data']         = $this->erp_model->teacher_row_count($p1);
                        $page                   = 'erp/inst/teacher_create';
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
                 $data['action_url']         = base_url().'teacher-info/save_document/'.$p1;
                 $page                   = 'erp/inst/teacher_document';
                 $data['form_id']            = uniqid();
                 $this->load->view($page, $data);
                break;    
                case 'save_document':
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
	public function getSection($selected_id = null, $return = false, $value = 'id')
	{
		$rows = $this->erp_model->getsectionData('section_master');
		$content = optionStatus('', '-- Select --', 1);
		foreach ($rows as $row) {
			$selected = '';
			if ($row->id == $selected_id) {
				$selected = 'selected';
			}
			$content .= optionStatus($row->$value, $row->section_name, 1, $selected);
		}
		if (!$return) {
			echo $content;
		} else {
			return $content;
		}
	}
	public function getStudents($id = null, $selected_id = null, $return = false)
	{
		$content = optionStatus('', '-- Select --', 1);
		if ($id != null) {
			$rows = $this->erp_model->getstudentData('v_sec_student', $id);
			foreach ($rows as $row) {
				$selected = '';
				if ($row->id == $selected_id) {
					$selected = 'selected';
				}
				$content .= optionStatus($row->id, $row->fname.''.$row->lname.'&nbsp;&nbsp;&nbsp;( '.$row->stu_id.' )' , 1, $selected);
			}
		}
		if (!$return) {
			echo $content;
		} else {
			return $content;
		}
	}

    public function getBooks($id = null, $selected_id = null, $return = false)
	{
        $content ='';
		if ($id != null) {
            $content.= "<div class='col-12 mt-5'>
            <div class='content'> 
                <div class='row'>";
                $rows = $this->erp_model->getbookData('books_master', $id);
			    foreach ($rows as $row) {
                 $content .= "<div class='col-2 card mt-2 mr-1 pt-3 pb-3 pr-3 pl-3 '>";
                    $content.="<img src='".IMGS_URL.$row->img."' height='100px' width='100%'>";
                    $content.="<h6><b>".$row->name."</b></h6>";
                    $content.="<p><b>Rs.".$row->price."</b></p>";
                    $content .="<b>Select</b><input type='checkbox' name='books[]' onclick='validateCheckbox(".$row->id.")' value='".$row->id."' style='height:30px;width:30px'>";
                  $content .=" </div>";
                };
               $content .="</div>
            </div>
           </div>";
			}
		
		if (!$return) {
			echo $content;
		} else {
			return $content;
		}
	}
    public function getTeachers($selected_id = null, $return = false, $value = 'id')
	{
		$rows = $this->erp_model->getData('teacher_master');
		$content = optionStatus('', '-- Select --', 1);
		foreach ($rows as $row) {
			$selected = '';
			if ($row->id == $selected_id) {
				$selected = 'selected';
			}
			$content .= optionStatus($row->$value, $row->name, 1, $selected);
		}
		if (!$return) {
			echo $content;
		} else {
			return $content;
		}
	}



}
