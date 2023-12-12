<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal_model extends CI_Model
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
     ->where(['is_deleted'=>'NOT_DELETED']);
  
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
  public function view_data_id($tb,$id)
    {
     
        $query = $this->db
        ->select('*')
        ->from($tb)       
        ->where(['is_deleted' => 'NOT_DELETED','id'=>$id])
        ->get();
        return $query->row();
    }


public function sub_tea_mapping($search,$limit=null,$start=null)
{
    if(!empty($_POST['section'])){
        $section =  $_POST['section'] ;
         
       }else{
           $section =   '' ;
       }
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.section_name,t3.name as teacher_name,t4.name subject_name')
    ->from('section_subject_teacher_mapping t1')
    ->join('section_master t2','t1.section_id=t2.id','left')
    ->join('teacher_master t3','t1.tea_id=t3.id','left')
    ->join('subject_master t4','t1.sub_id=t4.id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.section_id'=>$section]) ;  
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}  

public function class_teacher_mapping($search,$limit=null,$start=null)
{
    if(!empty($_POST['section'])){
        $section =  $_POST['section'] ;
         
       }else{
           $section =   '' ;
       }
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.section_name,t3.name as teacher_name')
    ->from('class_teacher_mapping t1')
    ->join('section_master t2','t1.section_id=t2.id','left')
    ->join('teacher_master t3','t1.tea_id=t3.id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.section_id'=>$section]) ;     
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

} 

public function section_head_mapping($search,$limit=null,$start=null)
{
    if(!empty($_POST['section'])){
        $section =  $_POST['section'] ;
         
       }else{
           $section =   '' ;
       }
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.section_name,t3.name as teacher_name')
    ->from('section_head_mapping t1')
    ->join('section_master t2','t1.section_id=t2.id','left')
    ->join('teacher_master t3','t1.tea_id=t3.id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.section_id'=>$section]) ;  
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

} 
public function count_row_gatepass()
{
 $this->db->select('t1.*')
 ->from('student_gate_pass t1')
->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.date'=>date('Y-m-d')]);

 return $this->db->get()->num_rows();
} 
public function search_data($searchTerm) {
    if($searchTerm !='')
    {
     $this->db->select('t1.*')
    ->from('v_sec_student t1')
    ->distinct('t1.id')
   ->where(['t1.is_deleted'=>'NOT_DELETED','t1.regstatus'=>'1','t1.IsLeft'=>'0']);
   if (@$searchTerm) {
    $this->db->group_start();
    $this->db->like('t1.fname',$searchTerm);
    $this->db->or_like('t1.lname',$searchTerm);
    $this->db->or_like('t1.enrollment',$searchTerm);
    $this->db->or_like('t1.stu_id',$searchTerm);
    $this->db->or_like('t1.father_no',$searchTerm);
    $this->db->or_like('t1.father',$searchTerm);
    $this->db->or_like('t1.mother',$searchTerm);
    $this->db->or_like('t1.mobile',$searchTerm);
    $this->db->group_end();
}
    return $this->db->get()->result();
    }else
    {
        return [];
    }
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
public function get_sst_map()
{
     $this->db->select("t1.*,t2.section_name,t3.name as teacher_name,t4.name as sub_name");
     $this->db->from('section_subject_teacher_mapping t1');
     $this->db->join('section_master t2','t2.id=t1.section_id');
     $this->db->join('teacher_master t3','t3.id=t1.tea_id');
     $this->db->join('subject_master t4','t4.id=t1.sub_id');
     $this->db->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t2.is_deleted'=>'NOT_DELETED','t2.status'=>'1','t3.is_deleted'=>'NOT_DELETED','t3.status'=>'1','t4.is_deleted'=>'NOT_DELETED','t4.status'=>'1']); 
     $this->db->distinct('t1.section_id');
     return $this->db->get()->result();
} 
public function get_sst_map_id($id)
{
     $this->db->select("t1.*");
     $this->db->from('v_sst_map t1');
     $this->db->where(['t1.SSTID'=>$id]); 
     return $this->db->get()->row();
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
    //  if (@$_POST['section']) {
    //     $this->db->where('section_id',$_POST['section']);
    // }
     return $this->db->get()->result();
}
public function view_section($tb)
{
     $this->db->select("*");
     $this->db->from($tb);
     $this->db->where(['is_deleted'=>'NOT_DELETED','status'=>'1']);
     $this->db->order_by('section_name','ASC');
     
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

public function view_timetablesubmmit($timeid)
{
     $this->db->select("t1.*");
     $this->db->from('student_time_table t1');
     $this->db->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.id'=>$timeid]);
     return $this->db->get()->row();
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
public function get_exam($id)
{
    $query = $this->db
    ->select('t1.*')   
    ->from('exam_master t1')    
    ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])
    ->get();
    return $query->row();
}
public function sst_data($id)
{
    $query = $this->db
    ->select('t1.*,t2.name as sub_name')
    ->from('section_subject_teacher_mapping t1') 
    ->join('subject_master t2','t2.id=t1.sub_id','left')       
    ->where(['t1.is_deleted' => 'NOT_DELETED','t1.section_id'=>$id,'t1.status'=>'1'])
    ->order_by('t2.name')
    ->get();
    return $query->result();
}
public function get_total_exam($id)
{
    $query = $this->db
    ->select('t1.*')   
    ->from('exam_master t1')    
    ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id <='=>$id])
    ->get();
    return $query->result();
}
public function get_student_marks($stu_id,$section_id,$sst_id,$exam_id)
{
    $query = $this->db
    ->select('t1.*')   
    ->from('student_marks t1')    
    ->where(['t1.is_deleted' => 'NOT_DELETED','t1.sst_id'=>$sst_id,'t1.student_id'=>$stu_id,'t1.section_id'=>$section_id,'t1.exam_id'=>$exam_id])
    ->get();
    return $query->row();
}


}
?>