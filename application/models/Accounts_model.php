<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model
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
    function Updates($tb,$data,$cond) {
		$this->db->where($cond);
	 	if($this->db->update($tb,$data)) {
	 		return true;
	 	}
	 	return false;
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
    // By Ajay Kumar
    public function Delete($table, $w = 0)
    {
        if ($w != 0) {
            $this->db->where($w);
        }
        $query = $this->db->delete($table);
        if ($query) {
            return true;
        } else {
            return false;
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
    public function getDataIDresult($tb,$id)
    {
     
        $query = $this->db
        ->select('*')
        ->from($tb)       
        ->where(['is_deleted' => 'NOT_DELETED','id'=>$id,'status'=>'1'])
        ->get();
        return $query->result();
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


public function get_fee_type_master($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('fee_type_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);      
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
public function get_fee_head_master($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.name as feetypename')
    ->from('fee_head_master t1')
    ->join('fee_type_master t2','t2.id=t1.feetype','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);      
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.name',$_POST['search']);
        $this->db->or_like('t2.name',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();
}

public function academic_year_master($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('academic_year_master t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);      
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
public function fee_scheme_master($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.name as academic')
    ->from('fee_scheme_master t1')
    ->join('academic_year_master t2','t2.id=t1.academic_year','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);      
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.fee_installment',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();
}
public function get_scheme($id){
    $this->db
    ->select('t1.*,t2.name as academic')
    ->from('fee_scheme_master t1')
    ->join('academic_year_master t2','t2.id=t1.academic_year','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.id'=>$id]);
    return $this->db->get()->result();
}



public function view_fee_structure($search)
{
   
    $this->db
    ->select('t1.*')
    ->from('fee_structure t1')
    ->distinct('t1.feeInstallmentId')
    ->where(['t1.is_deleted'=>'NOT_DELETED'])->group_by('t1.feeInstallmentId'); 
    return $this->db->get()->result();
}
public function get_rss($head,$id,$id2)
{
   
    $this->db
    ->select('t1.*')
    ->from('fee_structure t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.feeHead'=>$head,'t1.feeInstallment'=>$id,'t1.feeInstallmentId'=>$id2]); 
    return $this->db->get()->row();
}
public function view_months_scheme($id){
    $this->db
    ->select('t1.*,t2.name as academic')
    ->from('fee_scheme_master t1')
    ->join('academic_year_master t2','t2.id=t1.academic_year','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.id'=>$id]);
    return $this->db->get()->row();
}
public function getstudent($id){
    $this->db
    ->select('t1.*')
    ->from('v_sec_student t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.id'=>$id,'t1.IsLeft'=>'0' ,'regstatus'=>'1','type'=>'REGISTERED'])
    ->or_where('t1.enrollment',$id)
    ->or_where('t1.stu_id',$id);
    return $this->db->get()->row();
}
// public function get_fee($class_id,$sec_id,$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12,$scheme){
//     $this->db
//     ->select('*')
//     ->from('fee_structure t1')
//     ->join('fee_head_master t2','t2.id=t1.feeHead','left')
//     ->where(['t1.is_deleted'=>'NOT_DELETED','t1.standard'=>$class_id,'t1.section'=>$sec_id,'t1.academic_year'=>'2023-24','t1.feeInstallmentId'=>$scheme])
//     ->where_in('t1.feeInstallment',[$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12])
//     ->where_not_in('t1.amount','0');
   
//     return $this->db->get()->result();
// }
public function get_fee($class_id,$sec_id,$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12,$scheme){
  $sql2 = "SELECT * FROM `fee_structure` A INNER JOIN `fee_head_master` B ON A.`feeHead`=B.id WHERE A.standard='".$class_id."' AND A.section='".$sec_id."' AND A.feeInstallment IN ($month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12) AND A.amount!='0' AND A.academic_year='2023-24' AND A.feeInstallmentId='".$scheme."' ";
  $query = $this->db->query($sql2);
  //echo $this->db->last_query();die();
  return $query->result();
}
public function get_year(){
    $this->db
    ->select('t1.*,t2.name as academic')
    ->from('fee_scheme_master t1')
    ->join('academic_year_master t2','t2.id=t1.academic_year','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t2.name'=>'2023-24']);
    return $this->db->get()->result();
}
public function get_receipt_student($receipt){
    $this->db
    ->select('t1.*,t2.father,t2.mother,t2.father_no')
    ->from('fee_submitted t1')
    ->join('v_sec_student t2','t2.id=t1.student_id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.receiptno'=>$receipt]);
    return $this->db->get()->result();
}
public function getFee(){
    $this->db
    ->select('t1.*')
    ->from('fee_submitted t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);
    if (@$_POST['start_date']) {
        $start_date = $_POST['start_date'] .' 00:00:00';    
        $this->db->where('t1.added >=',$start_date);
    }else
    {
        $this->db->where('t1.added >=',date('Y-m-d')); 
    }

    if (@$_POST['end_date']) {
        $end_date = $_POST['end_date'] . ' 23:59:59';
        $this->db->where('t1.added <=',$end_date);
    }
    else
    {
        $this->db->where('t1.added >=',date('Y-m-d')); 
    }
    return $this->db->get()->result();
}
public function getFeeMonth(){
    $this->db
    ->select('t1.*')
    ->from('fee_submitted t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);
    if (@$_POST['start_month']) {
        $start_month = $_POST['start_month'];    
        $this->db->where('t1.submitted_month =',$start_month);
    }else
    {
        $this->db->where('t1.submitted_month >=',date('m')); 
    }
    return $this->db->get()->result();
}

public function search_data($searchTerm) {
    if($searchTerm !='')
    {
     $this->db->select('t1.*')
    ->from('v_sec_student t1')
    ->join('v_sst_map t2','t1.sec_id=t2.section_id')
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
public function get_student_fee($id){
    $this->db
    ->select('t1.*')
    ->from('fee_submitted t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.student_id'=>$id]);
    return $this->db->get()->result();
}
public function getdefaulterlist($section,$search,$limit=null,$start=null){
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('v_sec_student t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.regstatus'=>'1','type'=>'REGISTERED','t1.sec_id'=>$section]);
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();
}
public function getfeestatus($id){
    $this->db
    ->select('t1.*')
    ->from('fee_submitted t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.student_id'=>$id]);
    return $this->db->get()->result();
}

public function getFeesection(){
    $this->db
    ->select('t1.*')
    ->from('fee_submitted t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);
    if (@$_POST['start_date']) {
        $start_date = $_POST['start_date'] .' 00:00:00';    
        $this->db->where('t1.added >=',$start_date);
    }else
    {
        $this->db->where('t1.added >=',date('Y-m-d')); 
    }

    if (@$_POST['end_date']) {
        $end_date = $_POST['end_date'] . ' 23:59:59';
        $this->db->where('t1.added <=',$end_date);
    }
    else
    {
        $this->db->where('t1.added >=',date('Y-m-d')); 
    }
    if (@$_POST['section']) {
        $section = $_POST['section'];
        $this->db->where('t1.section_id',$section);
    }
    else
    {
        $this->db->where('t1.section_id',''); 
    }
    return $this->db->get()->result();
}

public function get_month_fee(){
    $this->db
    ->select('t1.*')
    ->from('fee_submitted t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.submitted_month'=>date('m'),'t1.IsActive'=>'0']);
    return $this->db->get()->result();
}
public function get_today_fee(){
    $this->db
    ->select('t1.*')
    ->from('fee_submitted t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.submitted_date'=>date('Y-m-d'),'t1.IsActive'=>'0']);
    return $this->db->get()->result();
}
public function this_month_paid_student(){
    $this->db
    ->select('t1.*,t2.*')
    ->from('fee_submitted t1')
    ->join('fee_submitted_month t2','t2.submitted_id=t1.id','left')
    ->where(['t1.is_deleted'=>'NOT_DELETED']);
    return $this->db->get()->result();
}
public function this_month_paid_student1($data=[]){
    $this->db
    ->select('t1.*,t2.*')
    ->from('fee_submitted t1')
    ->join('fee_submitted_month t2','t2.submitted_id=t1.id','left')
    ->where($data);
    return $this->db->get()->result();
}
public function get_total_student(){
    $this->db
    ->select('t1.*')
    ->from('v_sec_student t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.regstatus'=>'1','t1.type'=>'REGISTERED','t1.IsLeft'=>'0']);
    return $this->db->get()->result();
}
public function this_month_unpaid_student1($data=[]){
    $this->db
    ->select('t1.*')
    ->from('v_sec_student t1')
    ->where($data);
    return $this->db->get()->result();
}

}
?>