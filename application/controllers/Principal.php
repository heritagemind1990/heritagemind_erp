<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Inst.php');
class Principal extends Inst {

    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {
       $id=$_SESSION['MUserId'];
        
        $data['title']='Principal Dashboard';
        $data['total_student']=$this->principal_model->count_row_student('v_section_alloted');
        $data['total_gate_pass']=$this->principal_model->count_row_gatepass();
        $data['total_class']=$this->admission_model->count_row('class_master');
        $data['total_left']=$this->admission_model->left_count_row('v_sec_student');
        $data['total_role']=$this->admission_model->count_row('role_master');
        $data['total_teacher']=$this->hrm_model->count_row('teacher_master');
        $data['total_room']=$this->hrm_model->count_row('room_master');
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/principal/header',$data);
        $this->load->view('erp/principal/index',$data);
        $this->load->view('erp/principal/footer');
    }
    public function sub_tea_mapping($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
       $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Subject Teacher Mapping';
        $data['new_url']         = base_url().'subject-teacher-mapping/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $data['section']         = $this->principal_model->getData('section_master');
        $this->load->view('erp/principal/header',$data);
        $this->load->view('erp/principal/sub_tea_map',$data);
        $this->load->view('erp/principal/footer');
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
            $config["base_url"]     = base_url()."subject-teacher-mapping/tb";
            $config["total_rows"]   = count($this->principal_model->sub_tea_mapping($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'subject-teacher-mapping/delete/';
            $data['update_url']       =base_url().'subject-teacher-mapping/create/';
            $data['rows']           = $this->principal_model->sub_tea_mapping($search,$config["per_page"],$page);
            $page                       = 'erp/principal/tb_sub_tea_map';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['action_url']         = base_url().'subject-teacher-mapping/save';
        $data['section']         = $this->principal_model->getData('section_master');
        $data['teacher']         = $this->principal_model->getData('teacher_master');
        $data['subject']         = $this->principal_model->getData('subject_master');
        $data['total_data']=0;
        $page               = 'erp/principal/sub_tea_map_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'subject-teacher-mapping/save/'.$p1;
        $data['map']         = $this->principal_model->getDataID('section_subject_teacher_mapping',$p1);
        $data['total_data']         = $this->principal_model->count_row_id('section_subject_teacher_mapping',$p1);
        $data['section']         = $this->principal_model->getData('section_master');
        $data['teacher']         = $this->principal_model->getData('teacher_master');
        $data['subject']         = $this->principal_model->getData('subject_master');
        $page           = 'erp/principal/sub_tea_map_create';
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
         'tea_id'     => $this->input->post('teacher'),
         'sub_id'  => $this->input->post('subject'),
         'section_id'  => $this->input->post('section'),
          );
          $count = $this->erp_model->Counter('section_subject_teacher_mapping', array('tea_id'=>$this->input->post('teacher'),'sub_id'=>$this->input->post('subject'),'section_id'=>$this->input->post('section')));
         if($count==0){
         if ($this->erp_model->UpdateData('section_subject_teacher_mapping',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';     
          }
        }else{
            $return['res'] = 'error';
            $return['msg'] = 'Duplicate Mapping Not Allowed.';  
        }

     }else
     {
       $id=$_SESSION['MUserId'];
        $data = array(
            'tea_id'     => $this->input->post('teacher'),
            'sub_id'  => $this->input->post('subject'),
            'section_id'  => $this->input->post('section'),
            'status'        =>1,
            'created_by'      =>$id,
         );
         $count = $this->erp_model->Counter('section_subject_teacher_mapping', array('tea_id'=>$this->input->post('teacher'),'sub_id'=>$this->input->post('subject'),'section_id'=>$this->input->post('section')));
         if($count==0){
        if ($this->erp_model->Save('section_subject_teacher_mapping',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';       
         }
        }else{
            $return['res'] = 'error';
            $return['msg'] = 'Duplicate Mapping Not Allowed.';  
        }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/principal/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('section_subject_teacher_mapping',['id'=>$p1])){
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


    public function class_teacher_mapping($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
       $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Class Teacher Mapping';
        $data['new_url']         = base_url().'class-teacher-mapping/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $data['section']         = $this->principal_model->getData('section_master');
        $this->load->view('erp/principal/header',$data);
        $this->load->view('erp/principal/class_tea_map',$data);
        $this->load->view('erp/principal/footer');
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
            $config["base_url"]     = base_url()."class-teacher-mapping/tb";
            $config["total_rows"]   = count($this->principal_model->class_teacher_mapping($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'class-teacher-mapping/delete/';
            $data['update_url']       =base_url().'class-teacher-mapping/create/';
            $data['rows']           = $this->principal_model->class_teacher_mapping($search,$config["per_page"],$page);
            $page                       = 'erp/principal/tb_class_tea_map';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['action_url']         = base_url().'class-teacher-mapping/save';
        $data['section']         = $this->principal_model->getData('section_master');
        $data['teacher']         = $this->principal_model->getData('teacher_master');
        $data['total_data']=0;
        $page               = 'erp/principal/class_tea_map_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'class-teacher-mapping/save/'.$p1;
        $data['map']         = $this->principal_model->getDataID('class_teacher_mapping',$p1);
        $data['total_data']         = $this->principal_model->count_row_id('class_teacher_mapping',$p1);
        $data['section']         = $this->principal_model->getData('section_master');
        $data['teacher']         = $this->principal_model->getData('teacher_master');
        $page           = 'erp/principal/class_tea_map_create';
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
         'tea_id'     => $this->input->post('teacher'),
         'section_id'  => $this->input->post('section'),
          );
          $count = $this->erp_model->Counter('class_teacher_mapping', array('tea_id'=>$this->input->post('teacher'),'section_id'=>$this->input->post('section')));
          if($count==0){
         if ($this->erp_model->UpdateData('class_teacher_mapping',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';        
          }
        }else{
            $return['res'] = 'error';
            $return['msg'] = 'Duplicate Mapping Not Allowed.';  
        }
     }else
     {
       $id=$_SESSION['MUserId'];
        $data = array(
            'tea_id'     => $this->input->post('teacher'),
            'section_id'  => $this->input->post('section'),
            'status'        =>1,
            'created_by'      =>$id,
         );
         $count = $this->erp_model->Counter('class_teacher_mapping', array('tea_id'=>$this->input->post('teacher'),'section_id'=>$this->input->post('section')));
         if($count==0){
        if ($this->erp_model->Save('class_teacher_mapping',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';       
         }
        }else{
            $return['res'] = 'error';
            $return['msg'] = 'Duplicate Mapping Not Allowed.';  
        }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/principal/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('class_teacher_mapping',['id'=>$p1])){
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

    public function section_head_mapping($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
       $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Section Head Mapping';
        $data['new_url']         = base_url().'section-head-mapping/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $data['section']         = $this->principal_model->getData('section_master');
        $this->load->view('erp/principal/header',$data);
        $this->load->view('erp/principal/section_head_map',$data);
        $this->load->view('erp/principal/footer');
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
            $config["base_url"]     = base_url()."section-head-mapping/tb";
            $config["total_rows"]   = count($this->principal_model->section_head_mapping($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'section-head-mapping/delete/';
            $data['update_url']       =base_url().'section-head-mapping/create/';
            $data['rows']           = $this->principal_model->section_head_mapping($search,$config["per_page"],$page);
            $page                       = 'erp/principal/tb_section_head_map';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['action_url']         = base_url().'section-head-mapping/save';
        $data['section']         = $this->principal_model->getData('section_master');
        $data['teacher']         = $this->principal_model->getData('teacher_master');
        $data['total_data']=0;
        $page               = 'erp/principal/section_head_map_create';
        if ($p1!=null) {
        $data['action_url']         = base_url().'section-head-mapping/save/'.$p1;
        $data['map']         = $this->principal_model->getDataID('section_head_mapping',$p1);
        $data['total_data']         = $this->principal_model->count_row_id('section_head_mapping',$p1);
        $data['section']         = $this->principal_model->getData('section_master');
        $data['teacher']         = $this->principal_model->getData('teacher_master');
        $page           = 'erp/principal/section_head_map_create';
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
         'tea_id'     => $this->input->post('teacher'),
         'section_id'  => $this->input->post('section'),
          );
          $count = $this->erp_model->Counter('section_head_mapping', array('tea_id'=>$this->input->post('teacher'),'section_id'=>$this->input->post('section')));
          if($count==0){
         if ($this->erp_model->UpdateData('section_head_mapping',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';        
          }
        }else{
            $return['res'] = 'error';
            $return['msg'] = 'Duplicate Mapping Not Allowed.';  
        }
     }else
     {
       $id=$_SESSION['MUserId'];
        $data = array(
            'tea_id'     => $this->input->post('teacher'),
            'section_id'  => $this->input->post('section'),
            'status'        =>1,
            'created_by'      =>$id,
         );
         $count = $this->erp_model->Counter('section_head_mapping', array('tea_id'=>$this->input->post('teacher'),'section_id'=>$this->input->post('section')));
         if($count==0){
        if ($this->erp_model->Save('section_head_mapping',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';       
         }
        }else{
            $return['res'] = 'error';
            $return['msg'] = 'Duplicate Mapping Not Allowed.';  
        }
     }
	  


        }
        
        echo json_encode($return);
        //$this->load->view('erp/principal/create_notice');
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('section_head_mapping',['id'=>$p1])){
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
    public function role_assign_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
        $data['menu_id'] = $this->uri->segment(2);
       $id=$_SESSION['MUserId'];
         $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Role Assign Master';
        $data['new_url']         = base_url().'role-assign/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $this->load->view('erp/principal/header',$data);
        $this->load->view('erp/principal/role_assign',$data);
        $this->load->view('erp/principal/footer');
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
            $config["base_url"]     = base_url()."role-assign/tb";
            $config["total_rows"]   = count($this->hrm_model->role_assign_master($search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'role-assign/delete/';
            $data['update_url']       =base_url().'role-assign/create/';
            $data['rows']           = $this->hrm_model->role_assign_master($search,$config["per_page"],$page);
            $page                       = 'erp/principal/tb_role_assign';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['action_url']         = base_url().'role-assign/save';
        $data['role']         = $this->hrm_model->view_data('role_master');
        $data['teacher']         = $this->hrm_model->view_data('teacher_master');
        $data['total_data']=0;
        $page               = 'erp/principal/role_assign_create';
        if ($p1!=null) {
            $data['role']         = $this->hrm_model->view_data('role_master');
            $data['teacher']         = $this->hrm_model->view_data('teacher_master');
        $data['action_url']         = base_url().'role-assign/save/'.$p1;
        $data['roles']         = $this->hrm_model->view_data_id('role_assign_master',$p1);
        $data['total_data']         = $this->hrm_model->count_row_id('role_assign_master',$p1);
        $page           = 'erp/principal/role_assign_create';
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
          $count = $this->erp_model->Counter('role_assign_master', array('user_id'=>$this->input->post('user'),'role_id'=>$this->input->post('role')));
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
         $count = $this->erp_model->Counter('role_assign_master', array('user_id'=>$this->input->post('user'),'role_id'=>$this->input->post('role')));
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
    public function student_gatepass($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
        case null:
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $data['title']          = 'Student Gate Pass';
        $this->load->view('erp/principal/header',$data);
        $this->load->view('erp/principal/stu_gate_pass',$data);
        $this->load->view('erp/principal/footer');
        break;
        case 'search_data':
        $id=$_SESSION['MUserId'];
        $searchTerm = $this->input->post('searchTerm');
        $data = $this->principal_model->search_data($searchTerm);
        echo json_encode($data);
        break;  
        
        case 'createpass':
        $id=$_SESSION['MUserId'];
        $data['roles']          = $this->erp_model->view_role($id);
        $data['title']          = 'Student Gate Pass';
        $data['student']        = $this->principal_model->get_student_row($p1);
        $data['rows']           = $this->principal_model->get_pass($p1);
        $data['action_url']     = base_url().'principal-student-gate-pass/save/'.$p1;
        $data['delete_url']     = base_url().'principal-student-gate-pass/delete/';
        $this->load->view('erp/principal/header',$data);
        $this->load->view('erp/principal/gate_pass',$data);
        $this->load->view('erp/principal/footer');
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
            'principal_check'=>'1',
            'type'       =>'principal',
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
      $data['student']         = $this->principal_model->class_wise_student();
      $this->load->view('erp/principal/header',$data);
      $this->load->view('erp/principal/student_master',$data);
      $this->load->view('erp/principal/footer');
      break;
      
      case 'section':
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Section Wise Total No. of Student';
        $data['student']         = $this->principal_model->section_student($p1);
        $this->load->view('erp/principal/header',$data);
        $this->load->view('erp/principal/student_list',$data);
        $this->load->view('erp/principal/footer');
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
      $data['sections']         = $this->principal_model->find_section();
      if(!empty($_POST['section'])){ 
          $data['section'] = $section = $_POST['section'];
          $data['Attmonth'] = $attDate = $_POST['Attmonth'];
              
              }
              else{ 
              $data['section'] = $section = '0';
          $data['Attmonth'] = $Attmonth = '';
              }
      $data['student']         = $this->principal_model->attendance_student($section);        
      $this->load->view('erp/principal/header',$data);
      $this->load->view('erp/principal/student_attendance_register',$data);
      $this->load->view('erp/principal/footer');
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
          $data['rows']           = $this->principal_model->view_attendance($section,$Attmonth);
          $page                       = 'erp/principal/tb_attendance';
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
      $data['title']          = 'Set Time Table';
      $data['tb_url']            = current_url().'/tb';
      $data['new_url']            = current_url().'/create';
      $data['search']           = $this->input->post('search');
      $data['section']         = $this->section_head_model->view_section('section_master');
      $this->load->view('erp/principal/header',$data);
      $this->load->view('erp/principal/timetable_master',$data);
      $this->load->view('erp/principal/footer');
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
          $data['section_name']   = $this->principal_model->view_data_id('section_master',$section);
          $data['new_url']         = base_url().'principal-section-time-table/create/';
          $data['period']         = $this->principal_model->view_period_data('section_periods');
          $data['sst']         = $this->principal_model->get_sst_map();
          $data['rows']           = $this->section_head_model->upload_notes($tea_id);
          $data['room']         = $this->principal_model->view_data('room_master');
          $data['action_url']  = base_url().'principal-section-time-table/save';
          $data['update_url']  = base_url().'principal-section-time-table/update_time/';
          $page                       = 'erp/principal/tb_timetable';
          $this->load->view($page, $data); 
          break;
      case 'save':
      $return['res'] = 'error';
      $return['msg'] = 'Not Saved!';

      if ($this->input->server('REQUEST_METHOD')=='POST') { 
      $id=$_SESSION['MUserId'];
      // if($this->input->post('dayname') !='' || $this->input->post('day_no' !='' || $this->input->post('section') !='' || $this->input->post('sstid') !='' || $this->input->post('room') !='' || $this->input->post('stime') !='' || $this->input->post('etime') !='')){
      $rs = $this->section_head_model->get_sst_map_id($this->input->post('sstid'));
      $section = $rs->section_id;
      $sub_id = $rs->sub_id;
    $tea_id = $rs->tea_id;
      $data = array(
          'day'     => $this->input->post('dayname'),
          'day_no'     => $this->input->post('day_no'),
          'section'     => $this->input->post('section'),
          'sst_id'     => $this->input->post('sstid'),
          'tea_id'     => $tea_id,
          'room_no'     => $this->input->post('room'),
          'sub_id'     => $sub_id,
          'status'     =>1,
          'period_id'  => $this->input->post('period'),
          'date'       =>date('Y-m-d'),
          'start_time'       =>$this->input->post('stime'),
          'end_time'       =>$this->input->post('etime'),
          'created_by' =>$id,
       );
       if ($this->erp_model->Save('student_time_table',$data)) {
      $return['res'] = 'success';
       $return['msg'] = 'Saved.';
       }
      // }else
      // {
      //     $return['res'] = 'error';
      //     $return['msg'] = 'Sorry !! Please fill all fields.';  
      // }

     }
     echo json_encode($return);
      break; 
      case 'update_time':
        $data['data']=$this->section_head_model->view_timetablesubmmit($p1);
        $data['room']         = $this->section_head_model->view_data('room_master');
        $data['sst']         = $this->section_head_model->get_sst_map();
        $data['action_url']  = base_url().'principal-section-time-table/update';
        $page                       = 'erp/principal/update_timetable';
        $this->load->view($page, $data); 
       break; 
      case 'update':
        
        $return['res'] = 'error';
        $return['msg'] = 'Not Saved!';

        if ($this->input->server('REQUEST_METHOD')=='POST') { 
        $id=$_SESSION['MUserId'];
        $timeid = $this->input->post('timeid');
        $rs = $this->section_head_model->get_sst_map_id($this->input->post('sstid'));
        $section = $rs->section_id;
        $sub_id = $rs->sub_id;
        $tea_id = $rs->tea_id;
        $room =  $this->input->post('room');
        $data = array(
            'sst_id'     => $this->input->post('sstid'),
            'tea_id'     => $tea_id,
            'room_no'     => $this->input->post('room'),
            'sub_id'     => $sub_id,
            'start_time'       =>$this->input->post('start_time'),
            'end_time'       =>$this->input->post('end_time'),
            'created_by' =>$id,
         );
         if ($this->section_head_model->Updates('student_time_table',$data,['id'=>$timeid])) {
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
      $this->load->view('erp/principal/header',$data);
      $this->load->view('erp/principal/student_marks_upload',$data);
      $this->load->view('erp/principal/footer');
      break;
      case 'tb':
          $userid=$id=$_SESSION['MUserId'];
          $this->load->library('pagination');
          $config = array();
          $config["base_url"]     = base_url()."principal-student-marks-upload/tb";
          $config["total_rows"]   = count($this->principal_model->upload_marks_tb());
          $data['total_rows']     = $config["total_rows"];
          $config["per_page"]     = 10;
          $config["uri_segment"]  = 2;
          $config['attributes']   = array('class' => 'pag-link ');
          $this->pagination->initialize($config);
          $data['links']          = $this->pagination->create_links();
          $data['page']           = $page = ($p1!=null) ? $p1 : 0;
          $data['search']         = $this->input->post('search');
          $data['update_url']       =base_url().'principal-student-marks-upload/update/';
          $data['new_url']         = base_url().'principal-student-marks-upload/create/';
          $data['rows']           = $this->principal_model->upload_marks_tb($config["per_page"],$page);
          $page                       = 'erp/principal/tb_uoload_marks';
          $this->load->view($page, $data); 
          break;
  
          case 'marks_upload':
               $data['menu_id'] = $this->uri->segment(2);
               $id=$_SESSION['MUserId'];
               $data['roles'] = $this->erp_model->view_role($id);
              $data['title']          = 'Student Marks Upload';
              $data['action_url']         = base_url().'principal-student-marks-upload/save/'.$p1;
              $data['map']    =$this->principal_model->SST_MAP($p1);
              $data['form_id']            = uniqid();
              $data['exam']         = $this->principal_model->getData('exam_master');
              if(!empty($_POST['exam']))
              {
                  $data['exam_id'] =  $_POST['exam'];
              }else
              {
                  $data['exam_id'] = '';
              }
             
               $this->load->view('erp/principal/header',$data);
              $this->load->view('erp/principal/marks_upload',$data);
              $this->load->view('erp/principal/footer');
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
         
        $this->principal_model->Insert('student_marks', $data);
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
            $this->principal_model->Update('student_marks', $data, array('student_id' => $stu_id , 'sst_id'=> $SSTId ,'exam_id' => $exam_id,'sub_id'=>$sub_id,'section_id'=> $section ));
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
             $data['action_url']         = base_url().'principal-student-marks-upload/save/'.$p1;
             $data['map']    =$this->principal_model->SST_MAP($p1);
             $data['form_id']            = uniqid();
             $data['exam']         = $this->principal_model->getData('exam_master');
             if(!empty($_POST['exam']))
              {
                  $data['exam_id'] =  $_POST['exam'];
              }else
              {
                  $data['exam_id'] = '';
              }
             
             $this->load->view('erp/principal/header',$data);
             $this->load->view('erp/principal/view_marks',$data);
             $this->load->view('erp/principal/footer');
      break;  
          default:
      # code...
      break;
      }
  } 

  public function student_marksheet($action=null,$p1=null,$p2=null,$p3=null)
  {
      switch ($action) {
          case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
       $data['roles'] = $this->erp_model->view_role($id);
      $data['title']          = 'Student Marksheet';
      $data['exam']           = $this->principal_model->getData('exam_master');
      $data['section']           = $this->principal_model->getData('section_master');
      if(!empty($_POST['exam_id']) && !empty($_POST['section_id']) && !empty($_POST['date']))
      {
        $data['exam_id'] = $exam_id = $_POST['exam_id'];
        $data['section_id'] = $section_id = $_POST['section_id'];
        $data['date'] = $date = $_POST['date'];
      }else
      {
        $data['exam_id'] = $exam_id = '';
        $data['section_id'] = $section_id = '';
        $data['date'] = $date = date('Y-m-d');
      }
      $data['student'] = $this->principal_model->get_student($section_id);
      $data['exam_data'] = $this->principal_model->get_exam($exam_id);
      $data['sst_data'] = $this->principal_model->sst_data($section_id);
      $this->load->view('erp/principal/header',$data);
      $this->load->view('erp/principal/student_marksheet',$data);
      $this->load->view('erp/principal/footer');
      break;
      default:
      # code...
      break;
      }
  }

  public function student_marksheet_individual($action=null,$p1=null,$p2=null,$p3=null)
  {
      switch ($action) {
          case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
       $data['roles'] = $this->erp_model->view_role($id);
      $data['title']          = 'Student Individual Exam Marksheet';
      $data['exam']           = $this->principal_model->getData('exam_master');
      $data['section']           = $this->principal_model->getData('section_master');
      if(!empty($_POST['exam_id']) && !empty($_POST['section_id']) && !empty($_POST['date']))
      {
        $data['exam_id'] = $exam_id = $_POST['exam_id'];
        $data['section_id'] = $section_id = $_POST['section_id'];
        $data['date'] = $date = $_POST['date'];
      }else
      {
        $data['exam_id'] = $exam_id = '';
        $data['section_id'] = $section_id = '';
        $data['date'] = $date = date('Y-m-d');
      }
      $data['student'] = $this->principal_model->get_student($section_id);
      $data['exam_data'] = $this->principal_model->get_exam($exam_id);
      $data['sst_data'] = $this->principal_model->sst_data($section_id);
      $this->load->view('erp/principal/header',$data);
      $this->load->view('erp/principal/student_individual_marksheet',$data);
      $this->load->view('erp/principal/footer');
      break;
      default:
      # code...
      break;
      }
  }
  
  




}   