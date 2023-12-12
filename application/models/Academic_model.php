<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Academic_model extends CI_Model
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
    public function notice_data_view($id)
    {
     
        $query = $this->db
        ->select('t1.*')
        ->from('notice_master t1')       
        ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])
        ->get();
        return $query->row();
    }
    public function notice_row_count($id)
    {
     $this->db->select("mtb.*")
     ->from('notice_master mtb')
     ->where(['mtb.is_deleted'=>'NOT_DELETED']);
     if ($id!=null) {
         $this->db->where('mtb.id',$id); 
     }
     return $this->db->get()->num_rows();
    } 
    public function total_notice()
    {
     $this->db->select("mtb.*")
     ->from('notice_master mtb')
     ->where(['mtb.is_deleted'=>'NOT_DELETED']);
  
     return $this->db->get()->num_rows();
    } 
     public function total_student()
    {
     $this->db->select("mtb.*")
     ->from('v_sec_student mtb')
     ->where(['mtb.is_deleted'=>'NOT_DELETED','mtb.regstatus'=>'1','mtb.type'=>'REGISTERED']);
  
     return $this->db->get()->num_rows();
    }  
    
    public function class_data_view($id)
    {
     
        $query = $this->db
        ->select('t1.*')
        ->from('class_master t1')       
        ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])
        ->get();
        return $query->row();
    }
    public function class_row_count($id)
    {
     $this->db->select("mtb.*")
     ->from('class_master mtb')
     ->where(['mtb.is_deleted'=>'NOT_DELETED']);
     if ($id!=null) {
         $this->db->where('mtb.id',$id); 
     }
     return $this->db->get()->num_rows();
    } 

    public function total_class()
    {
     $this->db->select("mtb.*")
     ->from('class_master mtb')
     ->where(['mtb.is_deleted'=>'NOT_DELETED']);
  
     return $this->db->get()->num_rows();
    } 




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








    public function section()
    {
         $this->db->select("*");
         $this->db->from('section_master a');
         $this->db->where(['a.is_deleted'=>'NOT_DELETED']);
         $this->db->order_by('a.section_name','ASC');
         return $this->db->get()->result();
    } 
public function notice_data($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('notice_master t1')
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

public function class_data1($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('class_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) 
    ->order_by('t1.class_name','ASC');           
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.class_name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}  

   
   public function class_data()
{
     $this->db->select("*");
     $this->db->from('class_master a');
     $this->db->where(['a.is_deleted'=>'NOT_DELETED']);
     $this->db->order_by('a.class_name','ASC');
     return $this->db->get()->result();
} 
public function holidays($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('holiday_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) 
    ->order_by('t1.added','DESC');           
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
public function categories($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('category_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) 
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
public function exams($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('exam_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) 
    ->order_by('t1.added','DESC');           
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
public function subject_master($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('subject_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) 
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
public function subject_topic_master($subject,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.name as sub_name')
    ->from('subject_topic_master t1')
    ->join('subject_master t2','t1.sub_id=t2.id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t2.is_deleted'=>'NOT_DELETED','t2.status'=>'1','t1.sub_id'=>$subject]) 
    ->order_by('t2.name','ASC');           
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.topic_name',$_POST['search']);
        $this->db->or_like('t2.sub_name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

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
public function view_period($tea_id,$search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.section_name')
    ->from('section_periods t1')
    ->join('section_master t2','t1.section_id=t2.id','left')
    ->distinct('t3.section_id')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);      
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t2.section_name',$_POST['search']);
        $this->db->or_like('t1.period',$_POST['search']);
        $this->db->group_end();
    }
    if (@$_POST['section']) {
        $this->db->where('t2.id',$_POST['section']);
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();
}

public function upload_marks_tb($limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.section_name,t4.name as sub_name,t3.name as teacher_name')
    ->from('section_subject_teacher_mapping t1')
    ->join('section_master t2','t1.section_id=t2.id','left')
    ->join('teacher_master t3','t1.tea_id=t3.id','left')
    ->join('subject_master t4','t1.sub_id=t4.id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t2.is_deleted'=>'NOT_DELETED','t2.status'=>'1','t3.is_deleted'=>'NOT_DELETED','t3.status'=>'1','t4.is_deleted'=>'NOT_DELETED','t4.status'=>'1'])
    ->order_by('t2.section_name');             
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
public function SST_MAP($id)
{
    $query = $this->db
    ->select('t1.*,t2.name as sub_name')
    ->from('section_subject_teacher_mapping t1') 
    ->join('subject_master t2','t2.id=t1.sub_id','left')       
    ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id,'t1.status'=>'1'])
    ->get();
    return $query->row();
}
public function get_student($id)
{
    $query = $this->db
    ->select('t1.*')   
    ->from('v_sec_student t1')    
    ->where(['t1.is_deleted' => 'NOT_DELETED','t1.sec_id'=>$id,'t1.regstatus'=>'1'])
    ->order_by('t1.fname')
    ->get();
    return $query->result();
}
public function getStudentMark($studentid,$examid,$sstid,$section,$subid)
{
    $query = $this->db
    ->select('t1.*')   
    ->from('student_marks t1')    
    ->where(['t1.is_deleted' => 'NOT_DELETED','t1.student_id'=>$studentid,'t1.sst_id'=>$sstid,'t1.section_id'=>$section,'t1.exam_id'=>$examid,'t1.sub_id'=>$subid,'t1.status'=>'1'])
    ->get();
    return $query->row();
}


}
?>