<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Erp_model extends CI_Model
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
	public function get_row_data($table, $id)
	{
		$query = $this->db->get_where($table, ['is_deleted' => 'NOT_DELETED', 'id' => $id]);
		return $query->row();
	}
   public function teacher_data()
   {
        $this->db->select("*");
		$this->db->from('teacher_master a');
		$this->db->where(['a.is_deleted'=>'NOT_DELETED']);
		$this->db->order_by('a.name','ASC');
		return $this->db->get()->result();
   } 
   public function teacher_data_view($id)
   {
    
       $query = $this->db
       ->select('t1.*')
       ->from('teacher_master t1')       
       ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])
       ->get();
       return $query->row();
   }
   public function teacher_row_count($id)
   {
    $this->db->select("mtb.*")
    ->from('teacher_master mtb')
    ->where(['mtb.is_deleted'=>'NOT_DELETED']);
    if ($id!=null) {
        $this->db->where('mtb.id',$id); 
    }
    return $this->db->get()->num_rows();
   }
   function _delete($tb,$data) {
    if (is_array($data)){
        $this->db->where($data);
        if($this->db->update($tb,['is_deleted'=>'DELETED'])){
            return true;
        }
    }
    else{
        $this->db->where('id',$data);
        if($this->db->update($tb,['is_deleted'=>'DELETED'])){
            return true;
        }
    }
    return false;
}
public function changeStatusDispaly()
{
    if ($this->input->is_ajax_request()) {
        $data = explode(',',$_POST['data']);
        $id = $data[0];
        $tb = $data[1];
        $ex = '';
        $update = array('display' => $_POST['value'] );
        if (@$data[2]) :
            $cond = [ $data[2] => $id];
            $ex = ','.$data[2];
        else:
            $cond = ['id' => $id];
        endif;



        $this->model->Update($tb,$update,$cond);
        echo $this->db->last_query();
        echo $display = $this->model->getRow($tb,$cond)->display;

        if ((int)$display==1) {
            echo "string";
            echo "<span class='changeStatusDispaly' value='0' data='".$id.",".$tb.$ex."'><i class='la la-check-circle'></i></span>";


        } 
        else{
            echo "string22";
            echo "<span class='changeStatusDispaly' value='1' data='".$id.",".$tb.$ex." '><i class='icon-close'></i></span>";
        }	
    }
}

public function get_user($username,$password)
{
 $this->db->select('*')
 ->from('institute')
 ->where(['is_deleted'=>'NOT_DELETED','status'=>'1','email'=>$username,'password'=>$password]);

 return $this->db->get()->result();
} 
public function view_role($id)
{
    $this->db->select("*");
    $this->db->from('role_master a');
    $this->db->join('role_assign_master b','a.id = b.role_id','left');
    $this->db->where(['a.status'=>'1' ,'b.status'=>'1' , 'b.user_id'=>$id,'a.is_deleted'=>'NOT_DELETED','b.is_deleted'=>'NOT_DELETED']);
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
public function getsectionData($tb)
{
     $this->db->select("*");
     $this->db->from($tb);
     $this->db->where(['is_deleted'=>'NOT_DELETED','status'=>'1']);
     $this->db->order_by('section_name','ASC');
     return $this->db->get()->result();
} 
public function getstudentData($tb,$id)
{
     $this->db->select("*");
     $this->db->from($tb);
     $this->db->where(['is_deleted'=>'NOT_DELETED','regstatus'=>'1','type'=>'REGISTERED','IsLeft'=>'0','sec_id'=>$id]);
     $this->db->order_by('fname','ASC');
     return $this->db->get()->result();
}
public function getbookData($tb,$id)
{
     $this->db->select("*");
     $this->db->from($tb);
     $this->db->where(['is_deleted'=>'NOT_DELETED','status'=>'1','section_id'=>$id]);
     return $this->db->get()->result();
}

}
?>