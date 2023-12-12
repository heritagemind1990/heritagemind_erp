<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[AllowDynamicProperties]
class Admission_model extends CI_Model
{
    function __construct(){
		$this->tbl1 = 'student_master';
		$this->load->database();
	} 
	function index(){
		echo 'This is model index function';
	}
    /*
     *  Select Records From Table
     */
    public function Select($Table, $Fields = '*', $Where = 1)
    {
        /*
         *  Select Fields
         */
        if ($Fields != '*') {
            $this->db->select($Fields);
        }
        /*
         *  IF Found Any Condition
         */
        if ($Where != 1) {
            $this->db->where($Where);
        }
        /*
         * Select Table
         */
        $query = $this->db->get($Table);

        /*
         * Fetch Records
         */

        return $query->result();
    }
	  /*
     * Count No Rows in Table
     */
    public function Counter($tb, $Where = 1)
    {
        $rows = $this->Select($tb, '*', $Where);

        return count($rows);
    }
      /*
     * Insert Multiple Records
     */
    public function Insert($tb, $data)
    {
        $query = $this->db->insert($tb, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
       /*
     *  UPDATE
     */
    function UpdateData($tb,$data,$cond) {
		$this->db->where('id',$cond);
	 	if($this->db->update($tb,$data)) {
	 		return true;
	 	}
	 	return false;
	}

    public function Update($tb, $data, $w = 0)
    {
        if ($w != 0) {
            $this->db->where($w);
        }
        $query = $this->db->update($tb, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function Save($tb,$data){
		if($this->db->insert($tb,$data)){
			return $this->db->insert_id();
		}
		return false; 
	}
    public function Save_Excel($tb,$data){
		if($this->db->insert_batch($tb,$data)){
			return $this->db->insert_id();
		}
		return false; 
	}
    function getRow($tb,$data=0) {
		if ($data==0) {
			if($data=$this->db->get($tb)->row()){
				return $data;
			}
			else {
				return false;
			}
		}
		elseif(is_array($data)) {
			if($data=$this->db->get_where($tb, $data)){
				return $data->row();
			}
			else {
				return false;
			}
		}
		else {
			if($data=$this->db->get_where($tb,array('id'=>$data))){
				return $data->row();
			}
			else {
				return false;
			}
		}
	}



    // total row count by AJAY KUMAR
    public function count_row($tb)
    {
     $this->db->select('*')
     ->from($tb)
     ->where(['is_deleted'=>'NOT_DELETED']);
     return $this->db->get()->num_rows();
    } 
    public function left_count_row($tb)
    {
     $this->db->select('*')
     ->from($tb)
     ->where(['is_deleted'=>'NOT_DELETED','IsLeft'=>'1']);
     return $this->db->get()->num_rows();
    } 
    public function count_row_student($tb)
    {
     $this->db->select('*')
     ->from($tb)
     ->where(['is_deleted'=>'NOT_DELETED','IsLeft'=>'0','type'=>'REGISTERED','regstatus'=>'1']);
     return $this->db->get()->num_rows();
    } 

    public function count_row_id($tb,$id)
    {
     $this->db->select('*')
     ->from($tb)
     ->where(['is_deleted'=>'NOT_DELETED' ,'id'=>$id]);
  
     return $this->db->get()->num_rows();
    } 

    public function view_data($tb)
    {
         $this->db->select("*");
         $this->db->from($tb);
         $this->db->where(['is_deleted'=>'NOT_DELETED']);
         $this->db->order_by('id','ASC');
         return $this->db->get()->result();
    }
    
  public function view_data_id($tb,$id)
 {
     
        $query = $this->db
        ->select('*')
        ->from($tb)       
        ->where(['is_deleted' => 'NOT_DELETED','id'=>$id])
        ->get();
        return $query->row();
    }

    
    public function total_enquiry()
    {
     $this->db->select('*')
     ->from('student_master')
     ->where(['is_deleted'=>'NOT_DELETED' , 'type'=>'ENQUIRY','regstatus'=>'0']);
  
     return $this->db->get()->num_rows();
    } 
    public function total_register()
    {
     $this->db->select('*')
     ->from('student_master')
     ->where(['is_deleted'=>'NOT_DELETED' , 'type'=>'REGISTERED','regstatus'=>'1']);
  
     return $this->db->get()->num_rows();
    } 

    public function total_hold()
    {
     $this->db->select('*')
     ->from('student_master')
     ->where(['is_deleted'=>'NOT_DELETED' , 'type'=>'ONHOLD','regstatus'=>'2']);
  
     return $this->db->get()->num_rows();
    } 

    public function total_reject()
    {
     $this->db->select('*')
     ->from('student_master')
     ->where(['is_deleted'=>'NOT_DELETED' , 'type'=>'REJECTED','regstatus'=>'3']);
  
     return $this->db->get()->num_rows();
    } 
    public function total_left()
    {
     $this->db->select('*')
     ->from('student_master')
     ->where(['is_deleted'=>'NOT_DELETED' , 'type'=>'REGISTERED','regstatus'=>'1','IsLeft'=>'1']);
  
     return $this->db->get()->num_rows();
    } 
    public function class_wise_enquiry(){  
        $this->db->select('t1.class,count("t1.id") as totalenquiry');
        $this->db->from('student_master t1');
        $this->db->where('t1.type','ENQUIRY','t1.regstatus','0');
        $this->db->group_by('t1.class'); 
        $query = $this->db->get(); 
        return $query->result();
    }
    public function classdata($id)
    {
        $this->db->select('t1.*');
        $this->db->from('student_master t1'); //
        $this->db->where('t1.type','ENQUIRY');
        $this->db->where('t1.regstatus','0');
        $this->db->where('t1.class' , $id);
        $query = $this->db->get(); 
        return $query->result();
    }
   
    	/**
	 * check Student id exist
	 *
	 * @param Int $id
	 * @return boolean
	 **/
	public function check_student_id_exist($id)
	{
		 return $this->db
					->from($this->tbl1)
					->where('id', $id)
					->get()
					->num_rows()
					== 1;
	}


	/**
	 * get Student details
	 *
	 * @param Array $request
	 * @return Array
	 **/
		/**
	 * check Student details exist
	 *
	 * @param Int $stu_id
	 * @return boolean
	 **/
	public function check_student_details_exist($id)
	{
		 return $this->db
					->from('student_master')
					->where('id', $id)
					->get()
					->num_rows()
					== 1;
	}



    public function get_astudent_details($request)
	{
		
		if(empty($request['id']) || $this->check_student_id_exist($request['id']) == false) {
			return [
				'status' => false,
				'message' => 'Unable to get Student',
				'data' => []
			];
		}
		if($this->check_student_details_exist($request['id']) == false) {
			return [
				'status' => false,
				'message' => 'Unable to get Student details',
				'data' => []
			];
		}
		
		$details= $this->db
					   ->from('student_master c')
					   ->select('c.*,b.class_name,cat.name as category_name')
                       ->join('class_master b', 'b.id = c.class')
                       ->join('category_master cat', 'cat.id = c.category_id')
					   ->where('c.id', $request['id'])
					   ->get()
					  ->row();	
                      //echo $this->db->last_query();die()	;   
		$details_html = $this->load->view('erp/admission/modal/student_approve',['student'=> $details], true);
		return [
			'status' => true,
			'message' => 'get Student details successfully',
			'data' => $details_html
		];			   
	}
    public function student_view_more($request)
	{
		
		if(empty($request['id']) || $this->check_student_id_exist($request['id']) == false) {
			return [
				'status' => false,
				'message' => 'Unable to get Student',
				'data' => []
			];
		}
		if($this->check_student_details_exist($request['id']) == false) {
			return [
				'status' => false,
				'message' => 'Unable to get Student details',
				'data' => []
			];
		}
		
		$details= $this->db
					   ->from('v_section_alloted c')
					   ->select('c.*,t1.class_name,t2.section_name')
                       ->join('class_master t1','t1.id=c.class')
                       ->join('section_master t2' , 't2.class_id=t1.id')
					   ->where('c.id', $request['id'])
					   ->get()
					  ->row();		   
		$details_html = $this->load->view('erp/admission/modal/view_more',['student'=> $details], true);
		return [
			'status' => true,
			'message' => 'get Student details successfully',
			'data' => $details_html
		];			   
	}
    public function student_view_more_sec_not_allot($request)
	{
		
		if(empty($request['id']) || $this->check_student_id_exist($request['id']) == false) {
			return [
				'status' => false,
				'message' => 'Unable to get Student',
				'data' => []
			];
		}
		if($this->check_student_details_exist($request['id']) == false) {
			return [
				'status' => false,
				'message' => 'Unable to get Student details',
				'data' => []
			];
		}
		
		$details= $this->db
					   ->from('v_section_not_allot c')
					   ->select('c.*,t1.class_name,')
                       ->join('class_master t1','t1.id=c.class')
					   ->where('c.id', $request['id'])
					   ->get()
					  ->row();		   
		$details_html = $this->load->view('erp/admission/modal/view_more_sec_not_allot',['student'=> $details], true);
		return [
			'status' => true,
			'message' => 'get Student details successfully',
			'data' => $details_html
		];			   
	}
    public function check_stu_id()
    {
        
           $query = $this->db
           ->select('count("id") as totalstu')
           ->from('student_master')       
           ->where(['is_deleted' => 'NOT_DELETED' ,'type'=>'REGISTERED' , 'regstatus'=>'1'])
           ->get();
           return $query->result();
       }
public function total_visit()
{
        $this->db->select('*')
        ->from('student_master')
        ->where(['is_deleted'=>'NOT_DELETED']);
     
        return $this->db->get()->num_rows();
       }     
       public function rejected_data($search,$limit=null,$start=null)
       {
           if ($limit!=null) {
               $this->db->limit($limit, $start);
           }
           $this->db
           ->select('t1.*,t2.class_name')
           ->from('student_master t1')
           ->join('class_master t2' , 't2.id = t1.class')
           ->where(['t1.type'=>'REJECTED','t1.regstatus'=>'3']) 
           ->order_by('t1.id','asc');	
           //echo $this->db->last_query();die();				
           if (@$_POST['search']) {
               $data['search'] = $_POST['search'];
               $this->db->group_start();
               $this->db->like('t1.fname',$_POST['search']);
               $this->db->or_like('t1.lname',$_POST['search']);
               $this->db->or_like('t1.father_no',$_POST['search']);
               $this->db->group_end();
           }
           if($limit!=null)
               return $this->db->get()->result();
           else
           return $this->db->get()->result();
   
       }
       public function hold_data($search,$limit=null,$start=null)
       {
           if ($limit!=null) {
               $this->db->limit($limit, $start);
           }
           $this->db
           ->select('t1.*,t2.class_name')
           ->from('student_master t1')
           ->join('class_master t2' , 't2.id = t1.class')
           ->where(['t1.type'=>'ONHOLD','t1.regstatus'=>'2']) 
           ->order_by('t1.id','asc');	
           //echo $this->db->last_query();die();				
           if (@$_POST['search']) {
               $data['search'] = $_POST['search'];
               $this->db->group_start();
               $this->db->like('t1.fname',$_POST['search']);
               $this->db->or_like('t1.lname',$_POST['search']);
               $this->db->or_like('t1.father_no',$_POST['search']);
               $this->db->group_end();
           }
           if($limit!=null)
               return $this->db->get()->result();
           else
           return $this->db->get()->result();
   
       }
       public function hold_data1()
       {  
       $this->db->select('t1.* , t2.class_name');
       $this->db->from('student_master t1');
       $this->db->join('class_master t2' , 't2.id = t1.class');
       $this->db->where('t1.type','ONHOLD','t1.regstatus','2');
       $query = $this->db->get(); 
       return $query->result();
        } 
  public function section_data($class)
 {  
 $this->db->select('t1.*');
 $this->db->from('section_master t1');
 $this->db->where(['t1.status'=>'1','t1.is_deleted'=>'NOT_DELETED','class_id'=>$class]);
 $query = $this->db->get(); 
 return $query->result();
} 
public function class_data()
{  
$this->db->select('t1.*');
$this->db->from('class_master t1');
$this->db->where(['t1.status'=>'1','t1.is_deleted'=>'NOT_DELETED']);
$query = $this->db->get(); 
return $query->result();
}   
public function get_student($class)
{  
    $query = $this->db->select('*')
             ->from('student_master')
             ->where(['class'=> $class , 'type'=>'REGISTERED' , 'regstatus'=>'1'])
             ->where('`id` NOT IN (SELECT `stud_id` FROM `section_student_mapping` where student_master.id = section_student_mapping.stud_id )', NULL, FALSE);
$query = $this->db->get(); 
return $query->result();
}  
    
public function sec_allot()
{
  $this->db->select('a.*')
  ->from('v_section_alloted a')
  ->where(['a.type'=>'REGISTERED','a.regstatus'=>'1','a.IsLeft'=>'0']);
   return $this->db->get()->num_rows();
 } 
 public function sec_not_allot()
{
  $this->db->select('a.*')
  ->from('v_section_not_allot a')
  ->where(['a.type'=>'REGISTERED','a.regstatus'=>'1','a.IsLeft'=>'0']);
   return $this->db->get()->num_rows();
 } 
 public function class_wise_register(){  
    $this->db->select('t1.class,count("t1.id") as totalregister');
    $this->db->from('v_section_alloted t1');
    $this->db->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','t1.IsLeft'=>'0']);
    $this->db->group_by('t1.class'); 
    $query = $this->db->get(); 
    return $query->result();
}
public function registerstudent($id)
{
    $this->db->select('t1.*');
    $this->db->from('v_section_alloted t1'); //
    $this->db->where('t1.type','REGISTERED');
    $this->db->where('t1.regstatus','1');
    $this->db->where('t1.class' , $id);
    $this->db->where('t1.IsLeft' , '0');
    $query = $this->db->get(); 
    return $query->result();
}
public function class_wise_reg_sec_not_allot(){  
    $this->db->select('t1.class,count("t1.id") as totalregister');
    $this->db->from('v_section_not_allot t1');
    $this->db->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','t1.IsLeft'=>'0']);
    $this->db->group_by('t1.class'); 
    $query = $this->db->get(); 
    return $query->result();
}
public function reg_sec_not_allot_student($id)
{
    $this->db->select('t1.*');
    $this->db->from('v_section_not_allot t1'); //
    $this->db->where('t1.type','REGISTERED');
    $this->db->where('t1.regstatus','1');
    $this->db->where('t1.class' , $id);
    $this->db->where('t1.IsLeft' ,'0');
    $query = $this->db->get(); 
    return $query->result();
}
public function get_section($id)
{
   
    $this->db->select('t2.*,t1.id as stu_id,t1.stu_id as STUDENTID,t3.class_name,t1.fname,t1.lname');
    $this->db->from('v_section_not_allot t1');
    $this->db->join('section_master t2' , 't1.class=t2.class_id','left');
    $this->db->join('class_master t3' , 't3.id=t2.class_id' ,'left');
    $this->db->where('t1.type','REGISTERED');
    $this->db->where('t1.regstatus','1');
    $this->db->where('t1.id' , $id);
    $query = $this->db->get(); 
    return $query->result();
}
public function class_wise_student(){  
    $this->db->select('t1.class,count("t1.id") as totalregister,t3.section_name,t3.id as sec_id,t5.name as class_teacher_name,t7.name as section_head_name');
    $this->db->from('v_section_alloted t1');
    $this->db->join('section_student_mapping t2' , 't2.stud_id=t1.id','left');
    $this->db->join('section_master t3' , 't3.id=t2.sec_id','left');
    $this->db->join('class_teacher_mapping t4' , 't4.section_id=t2.sec_id','left');
    $this->db->join('teacher_master t5' , 't5.id=t4.tea_id','left');
    $this->db->join('section_head_mapping t6' , 't6.section_id=t2.sec_id','left');
    $this->db->join('teacher_master t7' , 't7.id=t6.tea_id','left');
    $this->db->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','t1.IsLeft'=>'0']);
    $this->db->group_by('t3.id'); 
    $query = $this->db->get(); 
    return $query->result();
}
public function section_student($id)
{
    $this->db->select('t1.*,t3.section_name,t3.id as sec_id');
    $this->db->from('v_section_alloted t1');
    $this->db->join('section_student_mapping t2' , 't2.stud_id=t1.id');
    $this->db->join('section_master t3' , 't3.id=t2.sec_id');
    $this->db->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','t3.id'=>$id,'IsLeft'=>'0']);
    $query = $this->db->get(); 
    return $query->result();
}
public function search_student()
{
    $this->db->select('t1.*,t3.section_name,t3.id as sec_id');
    $this->db->from('v_section_alloted t1');
    $this->db->join('section_student_mapping t2' , 't2.stud_id=t1.id');
    $this->db->join('section_master t3' , 't3.id=t2.sec_id');
    $this->db->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','IsLeft'=>'0']);
    $this->db->order_by('t1.stu_id','ASC');
    $query = $this->db->get(); 
    return $query->result();
}

    
public function filter_data($search)
{
    $this->db
    ->select('t1.*,t3.section_name,t3.id as sec_id')
    ->from('v_section_alloted t1')
    ->join('section_student_mapping t2' , 't2.stud_id=t1.id')
    ->join('section_master t3' , 't3.id=t2.sec_id')
    ->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','IsLeft'=>'0']);    
    $this->db->group_start();
    $this->db->like('t1.stu_id' ,$search)
    ->or_like('t1.fname' ,$search)
    ->or_like('t1.enrollment' ,$search);
    $this->db->group_end();

    return $this->db->get()->result_array();
}

public function filter_student($search)
{
    $this->db
    ->select('t1.*')
    ->from('v_sec_student t1')
    ->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','IsLeft'=>'0']);    
    $this->db->group_start();
    $this->db->like('t1.stu_id' ,$search)
    ->or_like('t1.fname' ,$search)
    ->or_like('t1.enrollment' ,$search);
    $this->db->group_end();

    return $this->db->get()->result_array();
}
public function view_student_details()
{
    $this->db->select('t1.*');
    $this->db->from('v_sec_student t1');
    $this->db->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','IsLeft'=>'0']);
    $this->db->order_by('t1.fname','ASC');
    $query = $this->db->get(); 
    return $query->result();
}

public function conscession_data($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('concession_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) ;				
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.title',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}
public function student_document($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('v_sec_student t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.IsLeft'=>'0']) ;				
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.fname',$_POST['search']);
        $this->db->or_like('t1.lname',$_POST['search']);
        $this->db->or_like('t1.enrollment',$_POST['search']);
        $this->db->or_like('t1.father_no',$_POST['search']);
        $this->db->or_like('t1.stu_id',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}

public function category_student($category,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
  
        $this->db
    ->select('t1.*,t2.name as category_name')
    ->from('v_sec_student t1')
    ->join('category_master t2' , 't2.id=t1.category_id')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) ;  
    		
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.fname',$_POST['search']);
        $this->db->or_like('t1.lname',$_POST['search']);
        $this->db->or_like('t1.enrollment',$_POST['search']);
        $this->db->or_like('t1.father_no',$_POST['search']);
        $this->db->or_like('t1.stu_id',$_POST['search']);
        $this->db->group_end();
    }
    if (@$_POST['category']) {
        $this->db->where('t2.id',$_POST['category']);
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}

public function view_student_IsLeft($limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('v_sec_student t1')
    ->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','IsLeft'=>'1']) 
    ->order_by('t1.stu_id','ASC');				
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.fname',$_POST['search']);
        $this->db->or_like('t1.lname',$_POST['search']);
        $this->db->or_like('t1.enrollment',$_POST['search']);
        $this->db->or_like('t1.father_no',$_POST['search']);
        $this->db->or_like('t1.stu_id',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}
public function find_section()
{
    $this->db->select('t1.*');
    $this->db->from('section_master t1');
    $this->db->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1']);
    $this->db->order_by('t1.section_name','ASC');
    $query = $this->db->get(); 
    return $query->result(); 
}
public function attendance_student($section)
{
    $this->db->select('t1.*');
    $this->db->from('v_sec_student t1');
    $this->db->where(['t1.type'=>'REGISTERED','t1.regstatus'=>'1','t1.sec_id'=>$section,'IsLeft'=>'0']);
    $query = $this->db->get(); 
    return $query->result();
}

public function view_attendance($section,$month)
{
    $this->db->select('t2.*,t2.added as date');
     $this->db->from('v_sec_student t2');
    $this->db->where(['t2.type'=>'REGISTERED','t2.regstatus'=>'1','t2.sec_id'=>$section,'t2.IsLeft'=>'0']);
    $query = $this->db->get(); 
    return $query->result();
}
public function get_att($id,$date,$section)
{
    $this->db->select('t2.*');
    $this->db->from('student_attendance t2');
   $this->db->where(['t2.is_deleted'=>'NOT_DELETED','t2.status'=>'1','t2.student_id'=>$id,'t2.date'=>$date,'t2.section'=>$section]);
   $query = $this->db->get(); 
   return $query->result();
}



}
?>