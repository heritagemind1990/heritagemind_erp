<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Inst.php');
class Admission extends Inst {

    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {
        $id=$_SESSION['MUserId'];
        
        $data['title']='Admission Dashboard';
        $data['total_student']=$this->admission_model->count_row_student('v_section_alloted');
        $data['total_class']=$this->admission_model->count_row('class_master');
        $data['total_left']=$this->admission_model->left_count_row('v_sec_student');
        $data['total_sec_not_allot']=$this->admission_model->count_row('v_section_not_allot');
        $data['total_concession']=$this->admission_model->count_row('concession_master');
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/index',$data);
        $this->load->view('erp/admission/footer');
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
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/my_profile',$data);
        $this->load->view('erp/admission/footer');
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

    public function admission_system($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Admission System';
        $data['new_url']         = base_url().'admission-system/add_enquiry ';
        $data['tb_url']         = base_url().'admission-system/tb';
        $data['delete_url']         = base_url().'admission-system/delete/';
        $data['update_url']       =base_url().'admission-system/create/';
        $data['import_excel']       =base_url().'admission-system/view-excel/';
        $data['enquiry']         = $this->admission_model->total_enquiry();
        $data['register']         = $this->admission_model->total_register();
        $data['visit']         = $this->admission_model->total_visit();
        $data['hold']         = $this->admission_model->total_hold();
        $data['reject']         = $this->admission_model->total_reject();
        $data['left']         = $this->admission_model->total_left();
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/admission_system',$data);
        $this->load->view('erp/admission/footer');
        break;

        case 'add_enquiry':
        $data['action_url']         = base_url().'admission-system/save';
        $page               = 'erp/admission/add_enquiry';
        $data['class']          =$this->admission_model->view_data('class_master');
        $data['category']          =$this->admission_model->view_data('category_master');
        $data['concession']          =$this->admission_model->view_data('concession_master');
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
        $id=$_SESSION['MUserId'];
        $date = $this->input->post('dob');
        $date_time = $date;
        $date_time_plus_one = strtotime($date_time . ' +1 day');
        $str_date = strtotime(date('Y-m-d', $date_time_plus_one));
        $excel_date = intval(25569 + $str_date / 86400);
        if($this->input->post('concession'))
        {
            $consecession =$this->input->post('concession');
        }
        else
        {
            $consecession = 0;
        }
        $data = array(
        'brother_id'        =>$this->input->post('stu_id'),
        'fname'             => $this->input->post('fname'),
        'lname'             => $this->input->post('lname'),
        'father'            => $this->input->post('father'),
        'mother'            => $this->input->post('mother'),
        'class'             =>$this->input->post('class_id'),
        'mobile'            =>$this->input->post('mobile'),
        'gender'            =>$this->input->post('gender'),
        'dob'               =>$excel_date,
        'address'           =>$this->input->post('address'),
        'category_id'       =>$this->input->post('category'),
        'father_no'         =>$this->input->post('fmobile'),
        'concession_id'         =>$consecession,
        'status'            =>0,
        'type'              =>'ENQUIRY', 
        'Year'              =>'2023',
        'created_by'        =>$id 
         );
        if ($this->erp_model->Save('student_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
        }

        }
        echo json_encode($return);
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
       case 'view-excel':
        $data['action_url']         = base_url().'admission-system/import-excel';
        $page               = 'erp/admission/modal/import_excel';
        $data['class']          =$this->admission_model->view_data('class_master');
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;
       case 'import-excel':     
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';
        $id=$_SESSION['MUserId'];
        if ($this->input->server('REQUEST_METHOD')=='POST') { 
          
            $upload_status = $this->uploadDoc();
			if ($upload_status != false) {
				$inputFileName = 'documents/Excel/' . $upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet = $spreadsheet->getSheet(0);
				$count_Rows = 0;
				//print_r($sheet->getRowIterator());
				//die;
				$counter = 0;
				foreach ($sheet->getRowIterator() as $row) {
					if ($counter++ == 0) continue;
                      $rs=$this->admission_model->check_stu_id();
                        foreach($rs as $r)
                        { 
                         $MaxId =  $r->totalstu;
                        }
                        $STUID='0001'.date('y').$MaxId+1;
					$enrollment   = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex());
					$roll_no              = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex());
					$student_name           = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex());
					$dob                   = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex());
					$father                   = $spreadsheet->getActiveSheet()->getCell('E' . $row->getRowIndex());
					$mother                 = $spreadsheet->getActiveSheet()->getCell('F' . $row->getRowIndex());
                    $father_no                 = $spreadsheet->getActiveSheet()->getCell('G' . $row->getRowIndex());
                    $aadhaar                 = $spreadsheet->getActiveSheet()->getCell('H' . $row->getRowIndex());
                    $address                 = $spreadsheet->getActiveSheet()->getCell('I' . $row->getRowIndex());
					$data = array(
                                'stu_id'   => $STUID,
                                'enrollment'    => $enrollment,
                                'roll_no'  => $roll_no,
                                'fname'  => $student_name,
                                'dob'   => $dob,
                                'father'   => $father,
                                'mother'   => $mother,
                                'father_no'   => $father_no,
                                'adhaar'   => $aadhaar,
                                'address'   => $address,
                                'class'   =>$this->input->post('class'),
                                'type'   => 'REGISTERED',
                                'regstatus'   => '1',
                                'Year'   => '2023',
                                'created_by'   => $id,
								'excel_id'               => $_SESSION['lastid'] ? $_SESSION['lastid'] : '',
					);

					$this->erp_model->Save('student_master',$data);
					$count_Rows++;
				}
				$return['res'] = 'success';
                $return['msg'] = 'Data Imported Successfully !!.';
			} else {
                $return['res'] = 'error';
                $return['msg'] = 'Failed.';
			}
    //   end
                 
        }
        echo json_encode($return);
        break;


       break;
            default:
        # code...
        break;
        }
    }   

    function uploadDoc()
	{

		////excel file upload
		$uploadPath = 'documents/Excel/';
		if (!is_dir($uploadPath)) {
			mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
		}

		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = 'csv|xlsx|xls';
		$config['max_size'] = 1000000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('file')) {
			$fileData = $this->upload->data();
			$data['file_name'] = $fileData['file_name'];
			 $this->db->insert('student_excel_file', $data);
			  $insert_id = $this->db->insert_id();
			$_SESSION['lastid'] = $insert_id;

			return $fileData['file_name'];
		} else {
			return false;
		}
	}
   public function total_enquiry()
   {
    $data['menu_id'] = $this->uri->segment(2);
    $id=$_SESSION['MUserId'];
    $data['roles'] = $this->erp_model->view_role($id);
    
    $data['title']          = 'Enquiry System';
    $data['enquiry']         = $this->admission_model->class_wise_enquiry();
    $this->load->view('erp/admission/header',$data);
    $this->load->view('erp/admission/total_enquiry',$data);
    $this->load->view('erp/admission/footer');
   } 
    
    public function enquiry_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case 'enquiry':
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Enquiry System';
        $data['new_url']         = base_url().'admission-system/add_enquiry ';
        $data['tb_url']         = base_url().'admission-system/tb';
        $data['delete_url']         = base_url().'admission-system/delete/';
        $data['update_url']       =base_url().'admission-system/create/';
        $data['classdata']         = $this->admission_model->classdata($p1);
        $data['class_id']       =$p1;
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/enquiry_system',$data);
        $this->load->view('erp/admission/footer');
        break;

        case 'add_enquiry':
        $data['action_url']         = base_url().'admission-system/save';
        $page               = 'erp/admission/add_enquiry';
        $data['class']          =$this->admission_model->view_data('class_master');
        $data['category']          =$this->admission_model->view_data('category_master');
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
        $id=$_SESSION['MUserId'];
        $data = array(
        'fname'             => $this->input->post('fname'),
        'lname'             => $this->input->post('lname'),
        'father'            => $this->input->post('father'),
        'mother'            => $this->input->post('mother'),
        'class'             =>$this->input->post('class_id'),
        'mobile'            =>$this->input->post('mobile'),
        'gender'            =>$this->input->post('gender'),
        'dob'               =>$this->input->post('dob'),
        'address'           =>$this->input->post('address'),
        'category_id'       =>$this->input->post('category'),
        'father_no'         =>$this->input->post('fmobile'),
        'status'            =>0,
        'type'              =>'ENQUIRY', 
        'Year'              =>'2023',
        'created_by'        =>$id 
         );
        if ($this->erp_model->Save('student_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
        }

        }
        echo json_encode($return);
        break;
        case 'student-approve':
            $details = $this->admission_model->get_astudent_details($this->input->post());
            echo json_encode($details);
            
        break; 
        
        case 'student_approve':
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $stu_id = $this->input->post('student_id');    
         
            $rs=$this->admission_model->check_stu_id();
            foreach($rs as $r)
            { 
             $MaxId =  $r->totalstu+1;
            }
            $STUID='0001'.date('y').$MaxId+1;
            if(!empty($_FILES['doc']['name']) || $this->input->post('roll') != '' || $this->input->post('aadhaar')!='')
            {
            $config['file_name'] = rand(10000, 10000000000);    
            $config['upload_path'] = UPLOAD_PATH.'stu_pic/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
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
               
                  $fileName = "stu_pic/" . $image_data['file_name'];
              }
             $doc=$data['doc'] = $fileName;
              } else {
             $doc = $data['doc'] = "";
             }
            $data = array(
            'stu_id'          =>$STUID,
            'email'             => $this->input->post('email'),
            'enrollment'             => $this->input->post('enroll'),
            'roll_no'            => $this->input->post('roll'),
            'self_img'            => $doc,
            'parents_aadhaar'             =>$this->input->post('paadhaar'),
            'adhaar'            =>$this->input->post('aadhaar'),
            'regstatus'            =>'1',
            'type'              =>'REGISTERED', 
             );
            if ($this->erp_model->UpdateData('student_master',$data,$stu_id)) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
            }
        }else{
            $return['res'] = 'error';
             $return['msg'] = 'Please Fill  Required Feilds.';
        }
            }
            echo json_encode($return);
            break;
         
            case 'student_status':
                
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $stu_id = $this->input->post('student_id');    
           if($this->input->post('status')=='ONHOLD')
           {
            $data = array(
            'regstatus'            =>'2',
            'type'              =>'ONHOLD', 
            'remark'            =>$this->input->post('remark'),
             );
            if ($this->erp_model->UpdateData('student_master',$data,$stu_id)) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
            }
        }else
        {
            $data = array(
                'regstatus'            =>'3',
                'type'              =>'REJECTED', 
                'remark'            =>$this->input->post('remark'),
                 );
                if ($this->erp_model->UpdateData('student_master',$data,$stu_id)) {
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
    
    public function rejected_student($action=null,$p1=null)
    {
     switch ($action) {
     case null:
     $data['menu_id'] = $this->uri->segment(2);
     $id=$_SESSION['MUserId'];
     $data['roles'] = $this->erp_model->view_role($id);
     
     $data['title']          = 'Rejected Student';
     $data['tb_url']	  		= current_url().'/tb';
     $data['search']	 		= $this->input->post('search');
     $this->load->view('erp/admission/header',$data);
     $this->load->view('erp/admission/rejected_student',$data);
     $this->load->view('erp/admission/footer');
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
         $config["base_url"] 	= base_url()."rejected-student/tb";
         $config["total_rows"]  	= count($this->admission_model->rejected_data($search));
         $data['total_rows']    	= $config["total_rows"];
         $config["per_page"]    	= 10;
         $config["uri_segment"] 	= 2;
         $config['attributes']  	= array('class' => 'pag-link ');
         $this->pagination->initialize($config);
         $data['links']   		= $this->pagination->create_links();
         $data['page']    		= $page = ($p1!=null) ? $p1 : 0;
         $data['search']	 		= $this->input->post('search');
         $data['rows']    		= $this->admission_model->rejected_data($search,$config["per_page"],$page);
         $page                       = 'erp/admission/tb_rejected';
         $this->load->view($page, $data); 
         break;
    }  
     
 }
 
    
   


   public function hold_student($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'On Hold  Student';
        $data['tb_url']	  		= current_url().'/tb';
        $data['search']	 		= $this->input->post('search');
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/hold_student',$data);
        $this->load->view('erp/admission/footer');
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
            $config["base_url"] 	= base_url()."hold-student/tb";
            $config["total_rows"]  	= count($this->admission_model->hold_data($search));
            $data['total_rows']    	= $config["total_rows"];
            $config["per_page"]    	= 10;
            $config["uri_segment"] 	= 2;
            $config['attributes']  	= array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']   		= $this->pagination->create_links();
            $data['page']    		= $page = ($p1!=null) ? $p1 : 0;
            $data['search']	 		= $this->input->post('search');
            $data['rows']    		= $this->admission_model->hold_data($search,$config["per_page"],$page);
            $page                       = 'erp/admission/tb_onhold';
            $this->load->view($page, $data); 
            break;
        case 'student-approve':
            $details = $this->admission_model->get_astudent_details($this->input->post());
            echo json_encode($details);
            
        break; 
        
       
            case 'student_status':
                
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $stu_id = $this->input->post('student_id');    
           if($this->input->post('status')=='ONHOLD')
           {
            $data = array(
            'regstatus'            =>'2',
            'type'              =>'ONHOLD', 
            'remark'            =>$this->input->post('remark'),
             );
            if ($this->erp_model->UpdateData('student_master',$data,$stu_id)) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
            }
        }else
        {
            $data = array(
                'regstatus'            =>'3',
                'type'              =>'REJECTED', 
                'remark'            =>$this->input->post('remark'),
                 );
                if ($this->erp_model->UpdateData('student_master',$data,$stu_id)) {
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

    public function registered_student($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Registered Student';
        $data['classdata']         = $this->admission_model->hold_data1();
        $data['sec_allot']         = $this->admission_model->sec_allot();
        $data['sec_not_allot']         = $this->admission_model->sec_not_allot();
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/registered_student',$data);
        $this->load->view('erp/admission/footer');
        break;

        
            default:
        # code...
        break;
        }
    }  


    public function admission_section_allot($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case null:
           
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Student  Section Allot';
        $data['action_url']     = base_url().'admission-section-allot/sec-alot';
        
         
        if(!empty($_POST['class_id'])){
         $class_id =   $data['class_id'] = $_POST['class_id'] ;
          
        }else{
            $class_id =  $data['class_id'] = '' ;
        }
         $data['stu']   = $this->admission_model->get_student($class_id);
         $data['class']         = $this->admission_model->class_data();
         $data['section']         = $this->admission_model->section_data($class_id);
       // print_r($data['stu']);die();
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/student_section_allot',$data);
        $this->load->view('erp/admission/footer');
        break;

         
        case 'sec-alot':
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $id=$_SESSION['MUserId'];
              $section =  $this->input->post('section');
              $stu_id  =  $this->input->post('stu_id');
              $i=0;
              foreach($stu_id as $s){
                              $s = strtoupper($s);
                   $count = $this->erp_model->Counter('section_student_mapping', array('sec_id' => $section  ,'stud_id' => $s  ));
    
                if ($count == 0) {
                    $data = array(
                        'sec_id' => $section,
                        'stud_id' => $s,
                        'created_by'=>$id,
                        'status' =>1,
                        );
                
                        if ($this->erp_model->Save('section_student_mapping',$data)) {
                            $return['res'] = 'success';
                             $return['msg'] = 'Saved.';
                            }
                  
              }
              $i++ ;
              }
               }
            echo json_encode($return); 
         break;   
        
            default:
        # code...
        break;
        }
    } 
   
 //class_wise_registered
 public function class_wise_registered($action=null,$p1=null,$p2=null,$p3=null)
 {
     switch ($action) {
     case null:
     $data['menu_id'] = $this->uri->segment(2);
     $id=$_SESSION['MUserId'];
     $data['roles'] = $this->erp_model->view_role($id);
     
     $data['title']          = 'Class wise Registered Student';
     $data['registered']         = $this->admission_model->class_wise_register();
     $this->load->view('erp/admission/header',$data);
     $this->load->view('erp/admission/class_wise_registered',$data);
     $this->load->view('erp/admission/footer');
     break;

     
         default:
     # code...
     break;
     }
 }
 
 public function view_register_student($action=null,$p1=null,$p2=null,$p3=null)
 {
     switch ($action) {
     case 'register':
     $data['menu_id'] = $this->uri->segment(2);
     $id=$_SESSION['MUserId'];
      $data['roles'] = $this->erp_model->view_role($id);
     
     $data['title']          = 'Section Alloted  Student';
     $data['classdata']         = $this->admission_model->registerstudent($p1);
     $data['class_id']       =$p1;
     $this->load->view('erp/admission/header',$data);
     $this->load->view('erp/admission/view_register_student',$data);
     $this->load->view('erp/admission/footer');
     break;
     case 'view-more':
        $details = $this->admission_model->student_view_more($this->input->post());
        echo json_encode($details);
     break;


         default:
     # code...
     break;
     }
 }  


  //section_not_allot_student
  public function section_not_allot_student($action=null,$p1=null,$p2=null,$p3=null)
  {
      switch ($action) {
      case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
      $data['roles'] = $this->erp_model->view_role($id);
      
      $data['title']          = 'Class wise Registered Student';
      $data['registered']         = $this->admission_model->class_wise_reg_sec_not_allot();
      $this->load->view('erp/admission/header',$data);
      $this->load->view('erp/admission/section_not_allot_student',$data);
      $this->load->view('erp/admission/footer');
      break;
 
      
          default:
      # code...
      break;
      }
  }
 
  public function view_section_not_allot_student($action=null,$p1=null,$p2=null,$p3=null)
  {
      switch ($action) {
      case 'register':
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
       $data['roles'] = $this->erp_model->view_role($id);
      
      $data['title']          = 'Section Not Alloted  Student';
      $data['classdata']         = $this->admission_model->reg_sec_not_allot_student($p1);
      $data['class_id']       =$p1;
      $this->load->view('erp/admission/header',$data);
      $this->load->view('erp/admission/view_section_not_allot_student',$data);
      $this->load->view('erp/admission/footer');
      break;
 
      case 'view-more':
        $details = $this->admission_model->student_view_more_sec_not_allot($this->input->post());
        echo json_encode($details);
     break;

     case 'sec_allot':
        $data['stu_id']=$p1;
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Section Allot';
        $data['action_url']     = base_url().'view-section-not-allot-student/sec-alot/'.$p1;
        $data['section']         = $this->admission_model->get_section($p1);
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/stu_sec_allot',$data);
        $this->load->view('erp/admission/footer');
     break;

     case 'sec-alot':
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $id=$_SESSION['MUserId'];
          $section =  $this->input->post('section');
          $stu_id  =  $this->input->post('stu_id');
               $count = $this->erp_model->Counter('section_student_mapping', array('sec_id' => $section  ,'stud_id' => $stu_id  ));

            if ($count == 0) {
                $data = array(
                    'sec_id' => $section,
                    'stud_id' => $stu_id,
                    'created_by'=>$id,
                    'status' =>1,
                    );
            
                    if ($this->erp_model->Save('section_student_mapping',$data)) {
                        $return['res'] = 'success';
                        $return['msg'] = 'Saved.';
                        }
        
          }
           }
        echo json_encode($return); 
     break;  
          default:
      # code...
      break;
      }
  } 

  public function concession_master($action=null,$p1=null,$p2=null,$p3=null)
  {
      switch ($action) {
      case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
      $data['roles'] = $this->erp_model->view_role($id);
      
      $data['title']          = 'Student Concession';
      $data['tb_url']	  		= current_url().'/tb';
      $data['search']	 		= $this->input->post('search');
      $data['new_url']        =base_url().'concession-master/create';  
      $this->load->view('erp/admission/header',$data);
      $this->load->view('erp/admission/concession_master',$data);
      $this->load->view('erp/admission/footer');
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
        $config["base_url"] 	= base_url()."concession-master/tb";
        $config["total_rows"]  	= count($this->admission_model->conscession_data($search));
        $data['total_rows']    	= $config["total_rows"];
        $config["per_page"]    	= 10;
        $config["uri_segment"] 	= 2;
        $config['attributes']  	= array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']   		= $this->pagination->create_links();
        $data['page']    		= $page = ($p1!=null) ? $p1 : 0;
        $data['search']	 		= $this->input->post('search');
        $data['update_url']        =base_url().'concession-master/create/';
        $data['delete_url']        =base_url().'concession-master/delete/';  
        $data['rows']    		= $this->admission_model->conscession_data($search,$config["per_page"],$page);
        $page                       = 'erp/admission/tb_concession';
        $this->load->view($page, $data); 
        break;

      case 'create':
        $data['remote']     = base_url().'concession_remote/title/';
        $data['action_url']         = base_url().'concession-master/save';
        $data['total_data']=0;
        $page               = 'erp/admission/create_concession';
        if ($p1!=null) {
        $data['action_url']         = base_url().'concession-master/save/'.$p1;
        $data['fee']         = $this->academic_model->view_data_id('concession_master',$p1);
        $data['total_data']         = $this->academic_model->count_row_id('concession_master',$p1);
        $page           = 'erp/admission/create_concession';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;


        case 'save':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
       $id=$_SESSION['MUserId'];  //user id
       if($p1!=null){
        $data = array(
        'title'     => $this->input->post('title'),
        'fee_relax'  => $this->input->post('fee'),
         );
        if ($this->erp_model->UpdateData('concession_master',$data,$p1)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
     }
     else
     {
        $data = array(
            'title'     => $this->input->post('title'),
            'fee_relax'  => $this->input->post('fee'),
            'status'        =>1,
            'created_by'  =>$id,
             );
            if ($this->erp_model->Save('concession_master',$data)) {
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
            if($this->erp_model->_delete('concession_master',['id'=>$p1])){
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
  
  public function concession_remote($type,$id=null,$column='title')
  {
      if ($type=='title') {
          $tb = 'concession_master';
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
  public function student_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case null:
        $data['menu_id'] = $this->uri->segment(2);
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'Section Wise Total No. of Student';
        $data['student']         = $this->admission_model->class_wise_student();
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/student_master',$data);
        $this->load->view('erp/admission/footer');
        break;
        
        case 'section':
          $id=$_SESSION['MUserId'];
          $data['roles'] = $this->erp_model->view_role($id);
          
          $data['title']          = 'Section Wise Total No. of Student';
          $data['student']         = $this->admission_model->section_student($p1);
          $this->load->view('erp/admission/header',$data);
          $this->load->view('erp/admission/student_list',$data);
          $this->load->view('erp/admission/footer');
        break;  
        
            default:
        # code...
        break;
        }
    } 


  public function student_document_master($action=null,$p1=null,$p2=null,$p3=null)
  {
      switch ($action) {
      case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
      $data['roles'] = $this->erp_model->view_role($id);
      
      $data['title']          = 'Search Any Student And View & Upload Document';
      $data['tb_url']	  		= current_url().'/tb';
      $data['search']	 		= $this->input->post('search');
      $this->load->view('erp/admission/header',$data);
      $this->load->view('erp/admission/student_document_master',$data);
      $this->load->view('erp/admission/footer');
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
        $config["base_url"] 	= base_url()."student-document-master/tb";
        $config["total_rows"]  	= count($this->admission_model->student_document($search));
        $data['total_rows']    	= $config["total_rows"];
        $config["per_page"]    	= 10;
        $config["uri_segment"] 	= 2;
        $config['attributes']  	= array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']   		= $this->pagination->create_links();
        $data['page']    		= $page = ($p1!=null) ? $p1 : 0;
        $data['search']	 		= $this->input->post('search');
        $data['update_url']        =base_url().'student-document-master/create/';
        $data['delete_url']        =base_url().'student-document-master/delete/';  
        $data['rows']    		= $this->admission_model->student_document($search,$config["per_page"],$page);
        $page                       = 'erp/admission/tb_student_document';
        $this->load->view($page, $data); 
        break;
      case 'upload':
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Student Upload Document';
        $data['add_photo']        = base_url().'student-document-master/add_photo/'.$p1;
        $data['student_aadhaar']        = base_url().'student-document-master/add_stu_aadhaar/'.$p1;
        $data['birth_certificate']        = base_url().'student-document-master/add_birth/'.$p1;
        $data['tc_url']        = base_url().'student-document-master/add_tc/'.$p1;
        $data['report_card']        = base_url().'student-document-master/add_report_card/'.$p1;
        $data['parent_aadhaar']        = base_url().'student-document-master/add_parent_aadhaar/'.$p1;
        $data['student']         = $this->admission_model->view_data_id('v_section_alloted',$p1);
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/student_document',$data);
        $this->load->view('erp/admission/footer');
      break;  
      case 'add_photo':
        $data['action_url']         = base_url().'student-document-master/save_photo';
        $page               = 'erp/admission/modal/upload_photo';
        if ($p1!=null) {
        $data['action_url']         = base_url().'student-document-master/save_photo/'.$p1;
        $page           = 'erp/admission//modal/upload_photo';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;

        case 'save_photo':
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $config['file_name'] = rand(10000, 10000000000);    
                $config['upload_path'] = UPLOAD_PATH.'stu_pic/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
         
                if (!empty($_FILES['photo']['name'])) {
         
                  //upload doc
                  $_FILES['photos']['name'] = $_FILES['photo']['name'];
                  $_FILES['photos']['type'] = $_FILES['photo']['type'];
                  $_FILES['photos']['tmp_name'] = $_FILES['photo']['tmp_name'];
                  $_FILES['photos']['size'] = $_FILES['photo']['size'];
                  $_FILES['photos']['error'] = $_FILES['photo']['error'];
         
                  if ($this->upload->do_upload('photos')) {
                      $image_data = $this->upload->data();
                   
                      $fileName = "stu_pic/" . $image_data['file_name'];
                  }
                 $photo=$data['photo'] = $fileName;
                  } else {
                 $photo = $data['photo'] = "";
                 }
            $data = array(
            'self_img'             => $photo,
            );
            if($p1!=null)
            {
               // echo "id";
                if ($this->erp_model->UpdateData('student_master',$data,$p1)) {
                    $return['res'] = 'success';
                     $return['msg'] = 'Saved.';
                    }
            }else{
                //echo "not";
            if ($this->erp_model->Save('student_master',$data)) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
            }
        }
    
            }
            echo json_encode($return);
      break;
      case 'add_stu_aadhaar':
        $data['action_url']         = base_url().'student-document-master/save_stu_aadhaar';
        $page               = 'erp/admission/modal/upload_student_aadhaar';
        if ($p1!=null) {
        $data['action_url']         = base_url().'student-document-master/save_stu_aadhaar/'.$p1;
        $page           = 'erp/admission//modal/upload_student_aadhaar';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;

        case 'save_stu_aadhaar':
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $config['file_name'] = rand(10000, 10000000000);    
                $config['upload_path'] = UPLOAD_PATH.'student/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
         
                if (!empty($_FILES['photo']['name'])) {
         
                  //upload doc
                  $_FILES['photos']['name'] = $_FILES['photo']['name'];
                  $_FILES['photos']['type'] = $_FILES['photo']['type'];
                  $_FILES['photos']['tmp_name'] = $_FILES['photo']['tmp_name'];
                  $_FILES['photos']['size'] = $_FILES['photo']['size'];
                  $_FILES['photos']['error'] = $_FILES['photo']['error'];
         
                  if ($this->upload->do_upload('photos')) {
                      $image_data = $this->upload->data();
                   
                      $fileName = "student/" . $image_data['file_name'];
                  }
                 $photo=$data['photo'] = $fileName;
                  } else {
                 $photo = $data['photo'] = "";
                 }
            $data = array(
            'doc_id'             => $photo,
            );
            if($p1!=null)
            {
               // echo "id";
                if ($this->erp_model->UpdateData('student_master',$data,$p1)) {
                    $return['res'] = 'success';
                     $return['msg'] = 'Saved.';
                    }
            }else{
                //echo "not";
            if ($this->erp_model->Save('student_master',$data)) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
            }
        }
    
            }
            echo json_encode($return);
    break;

    case 'add_birth':
        $data['action_url']         = base_url().'student-document-master/save_stu_birth';
        $page               = 'erp/admission/modal/upload_birth';
        if ($p1!=null) {
        $data['action_url']         = base_url().'student-document-master/save_stu_birth/'.$p1;
        $page           = 'erp/admission//modal/upload_birth';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;

        case 'save_stu_birth':
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $config['file_name'] = rand(10000, 10000000000);    
                $config['upload_path'] = UPLOAD_PATH.'student/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
         
                if (!empty($_FILES['photo']['name'])) {
         
                  //upload doc
                  $_FILES['photos']['name'] = $_FILES['photo']['name'];
                  $_FILES['photos']['type'] = $_FILES['photo']['type'];
                  $_FILES['photos']['tmp_name'] = $_FILES['photo']['tmp_name'];
                  $_FILES['photos']['size'] = $_FILES['photo']['size'];
                  $_FILES['photos']['error'] = $_FILES['photo']['error'];
         
                  if ($this->upload->do_upload('photos')) {
                      $image_data = $this->upload->data();
                   
                      $fileName = "student/" . $image_data['file_name'];
                  }
                 $photo=$data['photo'] = $fileName;
                  } else {
                 $photo = $data['photo'] = "";
                 }
            $data = array(
            'birth_certificate'             => $photo,
            );
            if($p1!=null)
            {
               // echo "id";
                if ($this->erp_model->UpdateData('student_master',$data,$p1)) {
                    $return['res'] = 'success';
                     $return['msg'] = 'Saved.';
                    }
            }else{
                //echo "not";
            if ($this->erp_model->Save('student_master',$data)) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
            }
        }
    
            }
            echo json_encode($return);
    break;

    case 'add_tc':
        $data['action_url']         = base_url().'student-document-master/save_tc';
        $page               = 'erp/admission/modal/upload_tc';
        if ($p1!=null) {
        $data['action_url']         = base_url().'student-document-master/save_tc/'.$p1;
        $page           = 'erp/admission//modal/upload_tc';
            }
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;

        case 'save_tc':
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $config['file_name'] = rand(10000, 10000000000);    
                $config['upload_path'] = UPLOAD_PATH.'student/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
         
                if (!empty($_FILES['photo']['name'])) {
         
                  //upload doc
                  $_FILES['photos']['name'] = $_FILES['photo']['name'];
                  $_FILES['photos']['type'] = $_FILES['photo']['type'];
                  $_FILES['photos']['tmp_name'] = $_FILES['photo']['tmp_name'];
                  $_FILES['photos']['size'] = $_FILES['photo']['size'];
                  $_FILES['photos']['error'] = $_FILES['photo']['error'];
         
                  if ($this->upload->do_upload('photos')) {
                      $image_data = $this->upload->data();
                   
                      $fileName = "student/" . $image_data['file_name'];
                  }
                 $photo=$data['photo'] = $fileName;
                  } else {
                 $photo = $data['photo'] = "";
                 }
            $data = array(
            'tc'             => $photo,
            );
            if($p1!=null)
            {
               // echo "id";
                if ($this->erp_model->UpdateData('student_master',$data,$p1)) {
                    $return['res'] = 'success';
                     $return['msg'] = 'Saved.';
                    }
            }else{
                //echo "not";
            if ($this->erp_model->Save('student_master',$data)) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
            }
        }
    
            }
            echo json_encode($return);
 break;

 case 'add_report_card':
    $data['action_url']         = base_url().'student-document-master/save_report_card';
    $page               = 'erp/admission/modal/upload_report_card';
    if ($p1!=null) {
    $data['action_url']         = base_url().'student-document-master/save_report_card/'.$p1;
    $page           = 'erp/admission//modal/upload_report_card';
        }
    $data['form_id']            = uniqid();
    
    $this->load->view($page, $data);
    break;

    case 'save_report_card':
        $id = $p1;
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $config['file_name'] = rand(10000, 10000000000);    
            $config['upload_path'] = UPLOAD_PATH.'student/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
     
            if (!empty($_FILES['photo']['name'])) {
     
              //upload doc
              $_FILES['photos']['name'] = $_FILES['photo']['name'];
              $_FILES['photos']['type'] = $_FILES['photo']['type'];
              $_FILES['photos']['tmp_name'] = $_FILES['photo']['tmp_name'];
              $_FILES['photos']['size'] = $_FILES['photo']['size'];
              $_FILES['photos']['error'] = $_FILES['photo']['error'];
     
              if ($this->upload->do_upload('photos')) {
                  $image_data = $this->upload->data();
               
                  $fileName = "student/" . $image_data['file_name'];
              }
             $photo=$data['photo'] = $fileName;
              } else {
             $photo = $data['photo'] = "";
             }
        $data = array(
        'report_card'             => $photo,
        );
        if($p1!=null)
        {
           // echo "id";
            if ($this->erp_model->UpdateData('student_master',$data,$p1)) {
                $return['res'] = 'success';
                 $return['msg'] = 'Saved.';
                }
        }else{
            //echo "not";
        if ($this->erp_model->Save('student_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
        }
    }

        }
        echo json_encode($return);
        break;


        // parent aadhaar
        case 'add_parent_aadhaar':
            $data['action_url']         = base_url().'student-document-master/save_parent_aadhaar';
            $page               = 'erp/admission/modal/upload_parents_aadhaar';
            if ($p1!=null) {
            $data['action_url']         = base_url().'student-document-master/save_parent_aadhaar/'.$p1;
            $page           = 'erp/admission//modal/upload_parents_aadhaar';
                }
            $data['form_id']            = uniqid();
            
            $this->load->view($page, $data);
            break;
    
            case 'save_parent_aadhaar':
                $id = $p1;
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';
        
                if ($this->input->server('REQUEST_METHOD')=='POST') { 
                    $config['file_name'] = rand(10000, 10000000000);    
                    $config['upload_path'] = UPLOAD_PATH.'student/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
             
                    if (!empty($_FILES['photo']['name'])) {
             
                      //upload doc
                      $_FILES['photos']['name'] = $_FILES['photo']['name'];
                      $_FILES['photos']['type'] = $_FILES['photo']['type'];
                      $_FILES['photos']['tmp_name'] = $_FILES['photo']['tmp_name'];
                      $_FILES['photos']['size'] = $_FILES['photo']['size'];
                      $_FILES['photos']['error'] = $_FILES['photo']['error'];
             
                      if ($this->upload->do_upload('photos')) {
                          $image_data = $this->upload->data();
                       
                          $fileName = "student/" . $image_data['file_name'];
                      }
                     $photo=$data['photo'] = $fileName;
                      } else {
                     $photo = $data['photo'] = "";
                     }
                $data = array(
                'parent_aadhaar_file'             => $photo,
                );
                if($p1!=null)
                {
                   // echo "id";
                    if ($this->erp_model->UpdateData('student_master',$data,$p1)) {
                        $return['res'] = 'success';
                         $return['msg'] = 'Saved.';
                        }
                }else{
                    //echo "not";
                if ($this->erp_model->Save('student_master',$data)) {
                $return['res'] = 'success';
                 $return['msg'] = 'Saved.';
                }
            }
        
                }
                echo json_encode($return);
     break;
          default:
      # code...
      break;
      }
  } 
 

  //////Student Update
  
  public function student_update_details($action=null,$p1=null,$p2=null,$p3=null)
  {
      switch ($action) {
      case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
      $data['roles'] = $this->erp_model->view_role($id);
      
      $data['title']          = 'Search Any Student And Update Details';
      $data['tb_url']	  		= current_url().'/tb';
      $data['search']	 		= $this->input->post('search');
      $this->load->view('erp/admission/header',$data);
      $this->load->view('erp/admission/student_update',$data);
      $this->load->view('erp/admission/footer');
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
        $config["base_url"] 	= base_url()."student-update-master/tb";
        $config["total_rows"]  	= count($this->admission_model->student_document($search));
        $data['total_rows']    	= $config["total_rows"];
        $config["per_page"]    	= 10;
        $config["uri_segment"] 	= 2;
        $config['attributes']  	= array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']   		= $this->pagination->create_links();
        $data['page']    		= $page = ($p1!=null) ? $p1 : 0;
        $data['search']	 		= $this->input->post('search');
        $data['update_url']        =base_url().'student-update-master/create/';
        $data['delete_url']        =base_url().'student-update-master/delete/';  
        $data['rows']    		= $this->admission_model->student_document($search,$config["per_page"],$page);
        $page                       = 'erp/admission/tb_student_update';
        $this->load->view($page, $data); 
        break;
      case 'update':
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Update Details This Student';
        $data['add_photo']        = base_url().'student-document-master/add_photo/'.$p1;
        $data['student']         = $this->admission_model->view_data_id('v_sec_student',$p1);
        $data['rs']         = $this->admission_model->search_student();
        $data['class']          =$this->admission_model->view_data('class_master');
        $data['category']          =$this->admission_model->view_data('category_master');
        $data['concession']          =$this->admission_model->view_data('concession_master');
        $data['new_url']        = base_url().'student-update-master/create/'.$p1;
        $this->load->view('erp/admission/header',$data);
        $this->load->view('erp/admission/update_student',$data);
        $this->load->view('erp/admission/footer');
      break; 
       
      case 'create':
        $data['action_url']         = base_url().'student-update-master/save/'.$p1;
        $data['student']         = $this->admission_model->view_data_id('v_sec_student',$p1);
        $data['rs']         = $this->admission_model->search_student();
        $data['class']          =$this->admission_model->view_data('class_master');
        $data['concession']          =$this->admission_model->view_data('concession_master');
        $data['category']          =$this->admission_model->view_data('category_master');
        $page           = 'erp/admission//modal/update_student';
        $data['form_id']            = uniqid();
        
        $this->load->view($page, $data);
        break;

        case 'save':
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
    
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
                $date = $this->input->post('dob');
        $date_time = $date;
        $date_time_plus_one = strtotime($date_time . ' +1 day');
        $str_date = strtotime(date('Y-m-d', $date_time_plus_one));
        $excel_date = intval(25569 + $str_date / 86400);
            $data = array(
            'enrollment'             => $this->input->post('enrollment'),
            'roll_no'                => $this->input->post('roll'),
            'fname'                  => $this->input->post('fname'),
            'lname'                  => $this->input->post('lname'),
            'father'                 => $this->input->post('father'),
            'mother'                 => $this->input->post('mother'),
            'category_id'            => $this->input->post('category'),
            'mobile'                 => $this->input->post('mobile'),
            'father_no'              => $this->input->post('fmobile'),
            'gender'                 => $this->input->post('gender'),
            'dob'                    => $excel_date,
            'adhaar'                 => $this->input->post('aadhaar'),
            'parents_aadhaar'        => $this->input->post('paadhaar'),
            'email'                  => $this->input->post('email'),
            'address'                => $this->input->post('address'),
            'concession_id'          => $this->input->post('concession'),
            'brother_id'             => $this->input->post('stu_id'),
            'IsLeft'             => $this->input->post('left'),
            );
            if($p1!=null)
            {
               // echo "id";
                if ($this->erp_model->UpdateData('student_master',$data,$p1)) {
                    $return['res'] = 'success';
                     $return['msg'] = 'Saved.';
                    }
            }else{
                //echo "not";
            if ($this->erp_model->Save('student_master',$data)) {
            $return['res'] = 'success';
             $return['msg'] = 'Saved.';
            }
        }
    
            }
            echo json_encode($return);
      break;

          default:
      # code...
      break;
      }
  } 

  public function autocompleteData()
  {
      $search = $this->input->post('search');
      $returnData = array();
      $student = $this->admission_model->filter_data($search);
      //print_r($student);die();
      foreach($student as $pro)
      {
          $data['id'] = $pro['id'];
          $data['fname'] = $pro['fname'].' ' .$pro['lname'];
          array_push($returnData,$data);
      }
     echo   json_encode($returnData);
  }
  public function category_wise_student($action=null,$p1=null,$p2=null)
  {
      switch ($action) {
      case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
      $data['roles'] = $this->erp_model->view_role($id);
      
      $data['title']          = 'Category Wise All Student';
      $data['tb_url']	  		= current_url().'/tb';
      $data['search']	 		= $this->input->post('search');
      $data['category']          =$this->admission_model->view_data('category_master');
      $this->load->view('erp/admission/header',$data);
      $this->load->view('erp/admission/category_wise_student',$data);
      $this->load->view('erp/admission/footer');
      break;
      case 'tb':
        if(!empty($_POST['category'])){
            $category_id =   $data['category'] = $_POST['category'] ;
             
           }else{
               $category_id =  $data['category'] = '' ;
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
        $config["base_url"] 	= base_url()."category-wise-student/tb";
        $config["total_rows"]  	= count($this->admission_model->category_student($category_id));
        $data['total_rows']    	= $config["total_rows"];
        $config["per_page"]    	= 10;
        $config["uri_segment"] 	= 2;
        $config['attributes']  	= array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']   		= $this->pagination->create_links();
        $data['page']    		= $page = ($p1!=null) ? $p1 : 0;
        $data['search']	 		= $this->input->post('search');
        $data['update_url']        =base_url().'category-wise-student/create/';
        $data['delete_url']        =base_url().'category-wise-student/delete/';  
        $data['rows']    		= $this->admission_model->category_student($category_id,$config["per_page"],$page);
        $page                       = 'erp/admission/tb_student_category';
        $this->load->view($page, $data); 
        break;
      default:
      # code...
      break;
      }
  }
  
  public function left_student($action=null,$p1=null,$p2=null)
  {
      switch ($action) {
      case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
      $data['roles'] = $this->erp_model->view_role($id);
      
      $data['title']          = 'All Left Student';
      $data['tb_url']	  		= current_url().'/tb';
      $data['search']	 		= $this->input->post('search');
      $this->load->view('erp/admission/header',$data);
      $this->load->view('erp/admission/left_student',$data);
      $this->load->view('erp/admission/footer');
      break;
      case 'tb':
      
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] 	= base_url()."left-student/tb";
        $config["total_rows"]  	= count($this->admission_model->view_student_IsLeft());
        $data['total_rows']    	= $config["total_rows"];
        $config["per_page"]    	= 10;
        $config["uri_segment"] 	= 2;
        $config['attributes']  	= array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']   		= $this->pagination->create_links();
        $data['page']    		= $page = ($p1!=null) ? $p1 : 0;
        $data['search']	 		= $this->input->post('search'); 
        $data['rows']    		= $this->admission_model->view_student_IsLeft($config["per_page"],$page);
        $page                       = 'erp/admission/tb_student_left';
        $this->load->view($page, $data); 
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
      $data['sections']         = $this->admission_model->find_section();
      if(!empty($_POST['section'])){ 
          $data['section'] = $section = $_POST['section'];
          $data['Attmonth'] = $attDate = $_POST['Attmonth'];
              
              }
              else{ 
              $data['section'] = $section = '0';
          $data['Attmonth'] = $Attmonth = date('m');
              }
      $data['student']         = $this->admission_model->attendance_student($section);        
      $this->load->view('erp/admission/header',$data);
      $this->load->view('erp/admission/student_attendance_register',$data);
      $this->load->view('erp/admission/footer');
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
          $data['rows']           = $this->admission_model->view_attendance($section,$Attmonth);
          $page                       = 'erp/admission/tb_attendance';
          $this->load->view($page, $data); 
          break;
          default:
      # code...
      break;
      }
  } 

     
  

}   