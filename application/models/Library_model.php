<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library_model extends CI_Model
{
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
    // Start Model





    // total row count by AJAY KUMAR
    public function count_row($tb)
    {
     $this->db->select('*')
     ->from($tb)
     ->where(['is_deleted'=>'NOT_DELETED','status'=>'1']);
  
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
    public function getData($tb)
    {
         $this->db->select("*");
         $this->db->from($tb);
         $this->db->where(['is_deleted'=>'NOT_DELETED','status'=>'1']);
         $this->db->order_by('id','ASC');
         return $this->db->get()->result();
    } 
    public function getDataID($tb,$id)
    {
     
        $query = $this->db
        ->select('*')
        ->from($tb)       
        ->where(['is_deleted' => 'NOT_DELETED','id'=>$id,'status'=>'1'])
        ->get();
        return $query->row();
    }
     public function get_data_by_id($tb,$id)
    {
     
        $query = $this->db
        ->select('*')
        ->from($tb)       
        ->where(['is_deleted' => 'NOT_DELETED','id'=>$id])
        ->get();
        return $query->row();
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



public function count_row_student($tb)
{
 $this->db->select('*')
 ->from($tb)
 ->where(['is_deleted'=>'NOT_DELETED','IsLeft'=>'0','type'=>'REGISTERED','regstatus'=>'1']);
 return $this->db->get()->num_rows();
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
public function get_author($school_id,$search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('author_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.school_id'=>$school_id]) 
    ->order_by('t1.name','ASC');           
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

} 
public function publishers_master($school_id,$search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('publishers_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.school_id'=>$school_id]) 
    ->order_by('t1.name','ASC');           
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

} 

public function book_category_master($school_id,$search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('book_category_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.school_id'=>$school_id]) 
    ->order_by('t1.name','ASC');           
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}
public function books_master($school_id,$search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.section_name,t3.name as author_name,t4.name as pub_name,t5.name as cat_name')
    ->from('books_master t1')
    ->join('section_master t2','t2.id=t1.section_id','left')
    ->join('author_master t3','t3.id=t1.author_id','left')
    ->join('publishers_master t4','t4.id=t1.publisher_id','left')
    ->join('book_category_master t5','t5.id=t1.category_id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.school_id'=>$school_id]) 
    ->order_by('t1.name','ASC');           
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.name',$_POST['search']);
        $this->db->or_like('t2.section_name',$_POST['search']);
        $this->db->or_like('t3.name',$_POST['search']);
        $this->db->or_like('t4.name',$_POST['search']);
        $this->db->or_like('t5.name',$_POST['search']);
        $this->db->or_like('t1.language',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}
 public function check_book_id()
 {
        
           $query = $this->db
           ->select('count("id") as totalbook')
           ->from('books_master')       
           ->where(['is_deleted' => 'NOT_DELETED' ,'status'=>'1'])
           ->get();
           return $query->result();
 }
   
 public function get_inventory_log($id)
 {
   $query = $this->db
  ->select('*')
  ->from('book_inventory_log')       
  ->where(['book_id'=>$id,'is_deleted'=>'NOT_DELETED'])
  ->get();
  return $query->result();
 }
 public function get_book_row($id)
 {
   $query = $this->db
  ->select('*')
  ->from('book_inventory_log')       
  ->where(['book_id'=>$id,'is_deleted'=>'NOT_DELETED'])
  ->get();
  return $query->num_rows();
 }
 public function delete_inventory($limit,$id)
 {
  
$this->db->where('book_id', $id);
$this->db->order_by('id', 'desc');
$this->db->limit($limit);
if($this->db->update('book_inventory_log',['is_deleted'=>'DELETED'])){
    return true;
}

 }
 public function get_inventory_book($id)
 {
   $query = $this->db
  ->select('*')
  ->from('book_inventory_log')       
  ->where(['book_id'=>$id,'is_deleted'=>'NOT_DELETED','student_given'=>'NO'])
  ->order_by('id', 'asc')
  ->limit('1')
  ->get();
  return $query->row();
 }
 public function update_inventory($stu_id,$id)
 {
$this->db->where(['book_id'=>$id,'student_given'=>'NO']);
$this->db->order_by('id', 'ASC');
$this->db->limit('1');
if($this->db->update('book_inventory_log',['student_given'=>'YES','student_id'=>$stu_id])){
    return true;
}
}
public function get_book_allot_qty($id)
{
  $query = $this->db
 ->select('*')
 ->from('book_inventory_log')       
 ->where(['book_id'=>$id,'is_deleted'=>'NOT_DELETED','student_given'=>'YES'])
 ->get();
 return $query->num_rows();
}
public function get_teacher_books($school_id,$search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.name as teacher_name,t3.section_name,t4.name as book_name')
    ->from('teacher_book_assign t1')
    ->join('teacher_master t2','t2.id=t1.teacher','left')
    ->join('section_master t3','t3.id=t1.section_id','left')
    ->join('books_master t4','t4.id=t1.book_id','left')
    ->where(['t2.is_deleted'=>'NOT_DELETED','t4.is_deleted'=>'NOT_DELETED','t1.teacher_given'=>'YES','t1.teacher_return'=>'NO']) ;       
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t2.name',$_POST['search']);
        $this->db->or_like('t3.section_name',$_POST['search']);
        $this->db->or_like('t4.name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

} 





}
?>