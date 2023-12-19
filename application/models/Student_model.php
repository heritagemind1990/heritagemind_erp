<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model
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
     ->where(['is_deleted'=>'NOT_DELETED' ,'id'=>$id,'status'=>'1']);
  
     return $this->db->get()->num_rows();
    } 
    public function view_data($tb)
    {
         $this->db->select("*");
         $this->db->from($tb);
         $this->db->where(['is_deleted'=>'NOT_DELETED','status'=>'1']);
         $this->db->order_by('id','ASC');
         return $this->db->get()->result();
    } 
  public function view_data_id($tb,$id)
    {
     
        $query = $this->db
        ->select('*')
        ->from($tb)       
        ->where(['is_deleted' => 'NOT_DELETED','id'=>$id,'status'=>'1'])
        ->get();
        return $query->row();
    }


public function teacher_data1($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('teacher_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) ;             
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.name',$_POST['search']);
        $this->db->or_like('t1.phone',$_POST['search']);
        $this->db->or_like('t1.adhaar',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}  
 function Updates($tb,$data,$cond) {
        $this->db->where($cond);
        if($this->db->update($tb,$data)) {
            return true;
        }
        return false;
    }
public function get_user($username,$password)
{
   
    $sql="Select * from student_master where mobile =$username  or enrollment =$username or father_no =$username and  is_deleted='NOT_DELETED' and pass = $password and regstatus ='1' and  type ='REGISTERED' and IsLeft='0'";    
    $query = $this->db->query($sql);
    return $query->result();

}  


public function my_totice($limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('notice_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.notice_type'=>'Student','t1.status'=>'1','t1.to_date >='=>date('Y-m-d')]) ;             
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
  public function count_row_notes($id)
    {
     $this->db->select('t1.*')
     ->from('tb_notes t1')
     ->join('v_sec_student t5','t1.sec_id=t5.sec_id','left')
     ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.date'=>date('Y-m-d'),'t5.id'=>$id]);
  
     return $this->db->get()->num_rows();
    } 
     public function count_row_hw($id)
    {
     $this->db->select('t1.*')
     ->from('t_student_hw t1')
     ->join('v_sec_student t5','t1.sec_id=t5.sec_id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.hw_date'=>date('Y-m-d'),'t5.id'=>$id]);
  
     return $this->db->get()->num_rows();
    } 
    
  public function count_row_notice($tb)
    {
     $this->db->select('*')
     ->from($tb)
     ->where(['is_deleted'=>'NOT_DELETED','status'=>'1','notice_type'=>'Student','to_date >='=>date('Y-m-d')]);
  
     return $this->db->get()->num_rows();
    } 
  public function view_notes($id,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.section_name,t4.name as sub_name')
    ->from('tb_notes t1')
    ->join('section_master t2','t1.sec_id=t2.id','left')
    ->join('teacher_master t3','t1.tea_id=t3.id','left')
    ->join('subject_master t4','t1.sub_id=t4.id','left')
    ->join('v_sec_student t5','t1.sec_id=t5.sec_id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.date'=>date('Y-m-d'),'t5.id'=>$id]);             
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t2.section_name',$_POST['search']);
        $this->db->or_like('t4.name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();
}  
public function count_row_gatepass($id)
{
 $this->db->select('t1.*')
 ->from('student_gate_pass t1')
->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.date'=>date('Y-m-d'),'t1.stu_id'=>$id]);

 return $this->db->get()->num_rows();
} 
  public function view_home_work($id,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.section_name,t4.name as sub_name,t6.teacher_check,t5.fname,t5.lname,t5.stu_id,t7.tea_name,t6.parent_status')
    ->from('t_student_hw t1')
    ->join('section_master t2','t1.sec_id=t2.id','left')
    ->join('subject_master t4','t1.sub_id=t4.id','left')
    ->join('v_sec_student t5','t1.sec_id=t5.sec_id','left')
    ->join('stu_hw_submit t6','t1.id=t6.hw_id','left')
    ->join('v_sst_map t7','t1.sst_id=t7.SSTID','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.hw_date'=>date('Y-m-d'),'t5.id'=>$id]);             
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t2.section_name',$_POST['search']);
        $this->db->or_like('t4.name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();
}  
   public function get_home_work($id)
    {
     $this->db->select('t1.*')
     ->from('t_student_hw t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.hw_date'=>date('Y-m-d'),'id'=>$id]);
  
     return $this->db->get()->row();
 }
 public function get_student_row($id)
{
    $this->db->select('t1.*')
    ->from('v_sec_student t1')
   ->where(['t1.is_deleted'=>'NOT_DELETED','t1.regstatus'=>'1','t1.IsLeft'=>'0','t1.id'=>$id]);

 return $this->db->get()->row();
}  
public function get_pass($id)
{
    $this->db
    ->select('t1.*,t2.fname,t2.lname,t2.stu_id,t2.address')
    ->from('student_gate_pass t1')
    ->join('v_sec_student t2','t1.stu_id=t2.id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t2.is_deleted'=>'NOT_DELETED','t2.regstatus'=>'1','t1.stu_id'=>$id,'t1.date'=>date('Y-m-d')]); 
    return $this->db->get()->result();
} 
public function view_attendance($id,$month)
{
    $this->db->select('t2.*,t2.added as date');
     $this->db->from('v_sec_student t2');
    $this->db->where(['t2.type'=>'REGISTERED','t2.regstatus'=>'1','t2.id'=>$id,'t2.IsLeft'=>'0']);
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
public function view_att_date($month)
{
    $this->db->select('t2.*');
    $this->db->from('student_attendance t2');
   $this->db->where(['t2.is_deleted'=>'NOT_DELETED','t2.status'=>'1','t2.month'=>$month]);
   $query = $this->db->get(); 
   return $query->row();
}
public function find_section($id)
{
    $this->db->select('t1.*');
    $this->db->from('v_sec_student t1');
    $this->db->where(['t1.is_deleted'=>'NOT_DELETED','t1.regstatus'=>'1','t1.id'=>$id]);
    $query = $this->db->get(); 
    return $query->row(); 
}
public function view_period_data($tb)
{
    if(!empty($_POST['section']))
    {
        $section = $_POST['section'];
    }
    else
    {
        $section='1';
    }
     $this->db->select("*");
     $this->db->from($tb);
     $this->db->where(['is_deleted'=>'NOT_DELETED','status'=>'1','section_id'=>$section]);
     return $this->db->get()->result();
}
public function view_time_table($day,$section,$period_id)
{
     $this->db->select("t1.*,t2.name as sub_name,t3.name as teacher_name,t4.name as room_name");
     $this->db->from('student_time_table t1');
     $this->db->join('subject_master t2','t1.sub_id=t2.id','left');
     $this->db->join('teacher_master t3','t1.tea_id=t3.id','left');
     $this->db->join('room_master t4','t1.room_no=t4.id','left');
     $this->db->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.day_no'=>$day,'t1.section'=>$section,'period_id'=>$period_id]);
    
     return $this->db->get()->row();
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
public function getTotalExam()
{
     $this->db->select("t1.*");
     $this->db->from('student_marks t1');
     $this->db->where(['t1.is_deleted'=>'NOT_DELETED']);
     $this->db->group_by('t1.exam_id');
     return $this->db->get()->num_rows();
}


}
?>