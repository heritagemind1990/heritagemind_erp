<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_modal extends CI_Model
{
	function index(){
		echo 'This is model index function';
	}

	public function admin_login($username,$password) { 
        //echo $password;die();
        $this->db->where('email',$username);
        $this->db->where('password', $password);
        $this->db->where('status', '1');
        $query = $this->db->get('institute');
        if($query->num_rows()==1){
            foreach ($query->result() as $row){
                $data = array(
                            'user_id'=> $row->id,
                            'name'=> $row->name,
                            'email'=> $row->email,
                            'inst_id'=> $row->id,
                            'inst_code'=> $row->inst_code,
                            'logged_in'=>TRUE,
                            'inst_logged_in'=>TRUE
                        );
            }
            $this->session->set_userdata($data);
            return TRUE;
        }
        else{
            return FALSE;
      }    
    }
        
    public function isLoggedIn(){
            $is_logged_in = $this->session->userdata('logged_in');
            if(!isset($is_logged_in) || $is_logged_in!==TRUE)
            {
                redirect('inst-dashboard');
                exit;
            }
    } 
	//is admin
    public function is_admin()
    {
        //check logged in
        if (!$this->isLoggedIn()) {
            echo "false";exit;
        }
        else
        {
            echo "true";exit;
        }
    }
    public function edit_admin_profile($data,$id)
    {
        //print_r($id);die();
        $config['file_name'] = rand(10000, 10000000000);
        $config['upload_path'] = UPLOAD_PATH.'users/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!empty($_FILES['photo']['name'])) {
            //upload images
            $_FILES['photos']['name'] = $_FILES['photo']['name'];
            $_FILES['photos']['type'] = $_FILES['photo']['type'];
            $_FILES['photos']['tmp_name'] = $_FILES['photo']['tmp_name'];
            $_FILES['photos']['size'] = $_FILES['photo']['size'];
            $_FILES['photos']['error'] = $_FILES['photo']['error'];

            if ($this->upload->do_upload('photos')) {
                $image_data = $this->upload->data();
                $fileName = "users/" . $image_data['file_name'];
            }

            if (!empty($fileName)) 
            {
                $data2 = $this->db->get_where('institute', ['id' =>$id])->row();
                $path = $data2->photo;
                if(is_file(DELETE_PATH.$path))
                {
                    unlink(DELETE_PATH.$path);
                }
                $data['photo'] = $fileName;
            } 
        }
        
         if($this->db->where('id', $id)->update('institute', $data))
         {
            return true;
         }else
         {
            false;
         }
    }
	public function admin_logout()
    {
       
        $this->session->unset_userdata(array('email','inst_logged_in','logged_in','inst_id'));
        $this->session->sess_destroy();
    }
    

	public function check_old_password($old_pass)
	{
		$query = $this->db->where(['id' => '1' ,'password' =>$old_pass])->get('institute');
		if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
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

}
?>