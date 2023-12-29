<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport_model extends CI_Model
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
  public function view_data_id($tb,$id)
    {
     
        $query = $this->db
        ->select('*')
        ->from($tb)       
        ->where(['is_deleted' => 'NOT_DELETED','id'=>$id])
        ->get();
        return $query->row();
    }
    public function getstudent($tb)
    {
         $this->db->select("*");
         $this->db->from($tb);
         $this->db->where(['is_deleted'=>'NOT_DELETED','regstatus'=>'1','type'=>'REGISTERED','IsLeft'=>'0']);
         $this->db->order_by('id','ASC');
         return $this->db->get()->result();
    } 
    
    public function driver_master($search,$limit=null,$start=null)
    {
        if ($limit!=null) {
            $this->db->limit($limit, $start);
        }
        $this->db
        ->select('t1.*')
        ->from('transport_drivers t1')
        ->where(['t1.is_deleted'=>'NOT_DELETED']) ;             
        if (@$_POST['search']) {
            $data['search'] = $_POST['search'];
            $this->db->group_start();
            $this->db->like('t1.name',$_POST['search']);
            $this->db->or_like('t1.mobile',$_POST['search']);
            $this->db->or_like('t1.aadhaar',$_POST['search']);
            $this->db->group_end();
        }
        if($limit!=null)
            return $this->db->get()->result();
        else
        return $this->db->get()->result();
    
    } 
    public function check_teacher_doc_row($tb,$id)
    {
     $this->db->select('*')
     ->from($tb)
     ->where(['is_deleted'=>'NOT_DELETED' ,'id'=>$id]);
    
     return $this->db->get()->result();
}
public function conductors_masters($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('transport_conductors t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) ;             
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.name',$_POST['search']);
        $this->db->or_like('t1.mobile',$_POST['search']);
        $this->db->or_like('t1.aadhaar',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

} 

public function vehicle_masters($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('transport_vehicle t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) ;             
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.owner_name',$_POST['search']);
        $this->db->or_like('t1.vehicle_no',$_POST['search']);
        $this->db->or_like('t1.vehicle_name',$_POST['search']);
        $this->db->or_like('t1.vehicle_reg_no',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

} 

public function route_master($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*')
    ->from('transport_route t1')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) ;             
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.start_route',$_POST['search']);
        $this->db->or_like('t1.end_route',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

} 
public function transport_sub_route($search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }
    $this->db
    ->select('t1.*,t2.id,t2.start_route,t2.end_route')
    ->from('transport_sub_route t1')
    ->join('transport_route t2','t2.id=t1.route_id')
    ->where(['t1.is_deleted'=>'NOT_DELETED']) ;             
    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.pick_up',$_POST['search']);
        $this->db->or_like('t1.drop_off',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}

public function view_sub_route($route_id)
{
      $this->db->select('t1.*,t2.id,t2.start_route,t2.end_route')
     ->from('transport_sub_route t1')
     ->join('transport_route t2','t2.id=t1.route_id','left')
     ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t2.id'=>$route_id]) 
     ->order_by('t1.added','ASC');
     
    return $this->db->get()->result();
}

public function transport_student($route_id,$search,$limit=null,$start=null)
{
    if ($limit!=null) {
        $this->db->limit($limit, $start);
    }

    $this->db
    ->select('t1.*,t2.id,t2.start_route,t2.end_route,t3.pick_up,t3.drop_off,t4.fname,t4.lname,t4.section_name,t4.address,t4.stu_id')
    ->from('transport_student t1')
    ->join('transport_route t2','t2.id=t1.route_id','left')
    ->join('transport_sub_route t3','t3.id=t1.sub_route_id','left')
    ->join('v_sec_student t4','t4.id=t1.student_id','left')
    ->distinct('t3.route_id')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.route_id'=>$route_id]) ; 

    if (@$_POST['search']) {
        $data['search'] = $_POST['search'];
        $this->db->group_start();
        $this->db->like('t1.stu_id',$_POST['search']);
        $this->db->or_like('t1.route_id',$_POST['search']);
        $this->db->group_end();
    }
    if($limit!=null)
        return $this->db->get()->result();
    else
    return $this->db->get()->result();

}
public function fetch_route($bid)
{
    $data = $this->db->get_where('transport_sub_route',['route_id' => $bid , 'is_deleted' => 'NOT_DELETED'])->result();
    echo "<option value=''>Select Sub Route</option>";
    foreach($data as $val)
    {
        echo "<option value='". $val->id ."'>".$val->pick_up." - ".$val->drop_off."</option>";
    }
}
public function get_sub_route($sub_route_id)
{
      $this->db->select('t1.*')
     ->from('transport_sub_route t1')
     ->where(['t1.is_deleted'=>'NOT_DELETED','t1.status'=>'1','t1.id'=>$sub_route_id]) ;
     
    return $this->db->get()->row();
}
public function view_student_route($route_id)
{
      $this->db
      ->select('t1.*,t2.id,t2.start_route,t2.end_route,t3.pick_up,t3.drop_off,t4.fname,t4.lname,t4.section_name,t4.address,t4.stu_id')
    ->from('transport_student t1')
    ->join('transport_route t2','t2.id=t1.route_id','left')
    ->join('transport_sub_route t3','t3.id=t1.sub_route_id','left')
    ->join('v_sec_student t4','t4.id=t1.student_id','left')
    ->distinct('t3.route_id')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t1.route_id'=>$route_id]) ;
     
    return $this->db->get()->result();
}
public function get_deriver_route($route_id)
{
      $this->db
      ->select('t1.*,t1.id as assign_id,t2.*')
    ->from('assgin_tr_route_driver t1')
    ->join('transport_drivers t2','t2.id=t1.driver_id','left')
    ->distinct('t1.route_id')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t2.status'=>'1','t2.is_deleted'=>'NOT_DELETED','t1.route_id'=>$route_id]) ;
     
    return $this->db->get()->result();
}
public function get_conductor_route($route_id)
{
      $this->db
      ->select('t1.*,t1.id as assign_id,t2.*')
    ->from('assgin_tr_route_conductor t1')
    ->join('transport_conductors t2','t2.id=t1.conductor_id','left')
    ->distinct('t1.route_id')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t2.status'=>'1','t2.is_deleted'=>'NOT_DELETED','t1.route_id'=>$route_id]) ;
     
    return $this->db->get()->result();
}

public function get_vehicle_route($route_id)
{
      $this->db
      ->select('t1.*,t1.id as assign_id,t2.*')
    ->from('assgin_tr_route_vehicle t1')
    ->join('transport_vehicle t2','t2.id=t1.vehicle_id','left')
    ->distinct('t1.route_id')
    ->where(['t1.is_deleted'=>'NOT_DELETED','t2.status'=>'1','t2.is_deleted'=>'NOT_DELETED','t1.route_id'=>$route_id]) ;
     
    return $this->db->get()->result();
}


}
?>