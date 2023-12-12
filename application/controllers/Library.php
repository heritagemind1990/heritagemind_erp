<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Inst.php');
class Library extends Inst {

    public function __construct()
    {
        parent::__construct();
    }
 
    public function dashboard()
    {
       $id=$_SESSION['MUserId'];
        
        $data['title']='Library Dashboard';
        $data['total_student']=$this->principal_model->count_row_student('v_section_alloted');
        $data['total_author']=$this->library_model->count_row('author_master');
        $data['total_publishers']=$this->library_model->count_row('publishers_master');
        $data['total_category']=$this->library_model->count_row('book_category_master');
        $data['total_book']=$this->library_model->count_row('books_master');
        $data['total_teacher']=$this->library_model->count_row('teacher_master');
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/library/header',$data);
        $this->load->view('erp/library/index',$data);
        $this->load->view('erp/library/footer');
    }
   
  public function student_master($action=null,$p1=null,$p2=null,$p3=null)
  {
      switch ($action) {
      case null:
      $data['menu_id'] = $this->uri->segment(2);
      $id=$_SESSION['MUserId'];
      $data['roles'] = $this->erp_model->view_role($id);
      $data['title']          = 'Section Wise Total No. of Student';
      $data['student']         = $this->library_model->class_wise_student();
      $this->load->view('erp/library/header',$data);
      $this->load->view('erp/library/student_master',$data);
      $this->load->view('erp/library/footer');
      break;
      
      case 'section':
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        
        $data['title']          = 'Section Wise Total No. of Student';
        $data['student']         = $this->library_model->section_student($p1);
        $this->load->view('erp/library/header',$data);
        $this->load->view('erp/library/student_list',$data);
        $this->load->view('erp/library/footer');
      break;  
      
          default:
      # code...
      break;
      }
  } 
   public function library_remote($type,$id=null,$column='name')
    {
        if ($type=='author') {
            $tb = 'author_master';
        }elseif($type=='publishers')
        {
          $tb = 'publishers_master';
        }elseif($type=='category')
        {
          $tb = 'book_category_master';
        }elseif($type=='book')
        {
            $tb='books_master';
        }
        else{

        }
        $this->db->where($column,$_GET[$column]);
        if($id!=NULL){
            $this->db->where('id != ',$id);
        }
        $count=$this->db->count_all_results($tb);
        if($count>0)
        {
            echo "false";
        }
        else
        {
            echo "true";
        }        
    }

    public function add_author($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
                
        $data['menu_id'] = $this->uri->segment(2);
       
        $data['title']          = 'Authors Master';
        $data['new_url']         = base_url().'add-author/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/library/header',$data);
        $this->load->view('erp/library/author_master',$data);
        $this->load->view('erp/library/footer');
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
            $school_id = '230001';        
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."add-author/tb";
            $config["total_rows"]   = count($this->library_model->get_author($school_id,$search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'add-author/delete/';
            $data['update_url']       =base_url().'add-author/create/'; 
            $data['rows']           = $this->library_model->get_author($school_id,$search,$config["per_page"],$page);
            $page                       = 'erp/library/tb_author';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'library_remote/author/';
        $data['action_url']         = base_url().'add-author/save';
        $data['total_data']=0;
        $page               = 'erp/library/create_author';
        if ($p1!=null) {
        $data['action_url']         = base_url().'add-author/save/'.$p1;
        $data['author']         = $this->library_model->get_data_by_id('author_master',$p1);
        $data['total_data']         = $this->library_model->count_row_id('author_master',$p1);
        $page           = 'erp/library/create_author';
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
         'school_id'     =>'230001',
         'name'  => $this->input->post('name'),
         'bio'  => $this->input->post('bio'),
          );
         if ($this->library_model->UpdateData('author_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $data = array(
             'school_id'     =>'230001',
             'name'  => $this->input->post('name'),
             'bio'  => $this->input->post('bio'),
            'status'        =>1,
            'created_by'      =>$id,
         );
        if ($this->library_model->Save('author_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
       }
    

        }
        
        echo json_encode($return);
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('author_master',['id'=>$p1])){
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



    public function add_publishers($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
                
        $data['menu_id'] = $this->uri->segment(2);
       
        $data['title']          = 'Publishers Master';
        $data['new_url']         = base_url().'add-publishers/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/library/header',$data);
        $this->load->view('erp/library/publishers_master',$data);
        $this->load->view('erp/library/footer');
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
            $school_id = '230001';        
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."add-publishers/tb";
            $config["total_rows"]   = count($this->library_model->publishers_master($school_id,$search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'add-publishers/delete/';
            $data['update_url']       =base_url().'add-publishers/create/'; 
            $data['rows']           = $this->library_model->publishers_master($school_id,$search,$config["per_page"],$page);
            $page                       = 'erp/library/tb_publishers';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'library_remote/publishers/';
        $data['action_url']         = base_url().'add-publishers/save';
        $data['total_data']=0;
        $page               = 'erp/library/create_publishers';
        if ($p1!=null) {
        $data['action_url']         = base_url().'add-publishers/save/'.$p1;
        $data['publishers']         = $this->library_model->get_data_by_id('publishers_master',$p1);
        $data['total_data']         = $this->library_model->count_row_id('publishers_master',$p1);
        $page           = 'erp/library/create_publishers';
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
         'school_id'     =>'230001',
         'name'  => $this->input->post('name'),
         'mobile'  => $this->input->post('mobile'),
         'country'  => $this->input->post('country'),
         'state'  => $this->input->post('state'),
         'city'  => $this->input->post('city'),
         'pincode'  => $this->input->post('pincode'),
         'address'  => $this->input->post('address'),
          );
         if ($this->library_model->UpdateData('publishers_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $data = array(
             'school_id'     =>'230001',
             'name'  => $this->input->post('name'),
             'mobile'  => $this->input->post('mobile'),
             'country'  => $this->input->post('country'),
             'state'  => $this->input->post('state'),
             'city'  => $this->input->post('city'),
             'pincode'  => $this->input->post('pincode'),
             'address'  => $this->input->post('address'),
             'status'        =>1,
             'created_by'      =>$id,
         );
        if ($this->library_model->Save('publishers_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
       }
    

        }
        
        echo json_encode($return);
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('publishers_master',['id'=>$p1])){
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


    public function book_category_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
                
        $data['menu_id'] = $this->uri->segment(2);
       
        $data['title']          = 'Book Category  Master';
        $data['new_url']         = base_url().'book-category-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/library/header',$data);
        $this->load->view('erp/library/book_category_master',$data);
        $this->load->view('erp/library/footer');
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
            $school_id = '230001';        
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."book-category-master/tb";
            $config["total_rows"]   = count($this->library_model->book_category_master($school_id,$search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'book-category-master/delete/';
            $data['update_url']       =base_url().'book-category-master/create/'; 
            $data['rows']           = $this->library_model->book_category_master($school_id,$search,$config["per_page"],$page);
            $page                       = 'erp/library/tb_book_category';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'library_remote/category/';
        $data['action_url']         = base_url().'book-category-master/save';
        $data['total_data']=0;
        $page               = 'erp/library/create_book_category';
        if ($p1!=null) {
        $data['action_url']         = base_url().'book-category-master/save/'.$p1;
        $data['category']         = $this->library_model->get_data_by_id('book_category_master',$p1);
        $data['total_data']         = $this->library_model->count_row_id('book_category_master',$p1);
        $page           = 'erp/library/create_book_category';
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
         'school_id'     =>'230001',
         'name'  => $this->input->post('name'),
          );
         if ($this->library_model->UpdateData('book_category_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $data = array(
             'school_id'     =>'230001',
             'name'  => $this->input->post('name'),
             'status'        =>1,
             'created_by'      =>$id,
         );
        if ($this->library_model->Save('book_category_master',$data)) {
        $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
       }
    

        }
        
        echo json_encode($return);
        break;
   
        case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('book_category_master',['id'=>$p1])){
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

    public function books_master($action=null,$p1=null,$p2=null,$p3=null)
    {
        switch ($action) {
            case null:
                
        $data['menu_id'] = $this->uri->segment(2);
       
        $data['title']          = 'Books  Master';
        $data['new_url']         = base_url().'books-master/create ';
        $data['tb_url']            = current_url().'/tb';
        $data['search']           = $this->input->post('search');
        $id=$_SESSION['MUserId'];
        $data['roles'] = $this->erp_model->view_role($id);
        $this->load->view('erp/library/header',$data);
        $this->load->view('erp/library/books_master',$data);
        $this->load->view('erp/library/footer');
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
            $school_id = '230001';        
            $this->load->library('pagination');
            $config = array();
            $config["base_url"]     = base_url()."books-master/tb";
            $config["total_rows"]   = count($this->library_model->books_master($school_id,$search));
            $data['total_rows']     = $config["total_rows"];
            $config["per_page"]     = 10;
            $config["uri_segment"]  = 2;
            $config['attributes']   = array('class' => 'pag-link ');
            $this->pagination->initialize($config);
            $data['links']          = $this->pagination->create_links();
            $data['page']           = $page = ($p1!=null) ? $p1 : 0;
            $data['search']         = $this->input->post('search');
            $data['delete_url']         = base_url().'books-master/delete/';
            $data['update_url']       =base_url().'books-master/create/'; 
            $data['inventory_url']       =base_url().'books-master/new_inventory/'; 
            $data['image_url']         = base_url().'books-master/view_image/'.$p1;
            $data['isbn_url']         = base_url().'books-master/view_isbn/'.$p1;
            $data['rows']           = $this->library_model->books_master($school_id,$search,$config["per_page"],$page);
            $page                       = 'erp/library/tb_books';
            $this->load->view($page, $data); 
            break;
        case 'create':
        $data['remote']     = base_url().'library_remote/book/';
        $data['action_url']         = base_url().'books-master/save';
        $data['section']    =  $this->library_model->getData('section_master');
        $data['author']    =  $this->library_model->getData('author_master');   
        $data['publisher']    =  $this->library_model->getData('publishers_master');          
        $data['categpry']    =  $this->library_model->getData('book_category_master');   
        $data['total_data']=0;
        $page               = 'erp/library/create_books';
        if ($p1!=null) {
        $data['action_url']         = base_url().'books-master/save/'.$p1;
        $data['section']    =  $this->library_model->getData('section_master');
        $data['author']    =  $this->library_model->getData('author_master');   
        $data['publisher']    =  $this->library_model->getData('publishers_master');          
        $data['categpry']    =  $this->library_model->getData('book_category_master');  
        $data['book']         = $this->library_model->get_data_by_id('books_master',$p1);
        $data['total_data']         = $this->library_model->count_row_id('books_master',$p1);
        $page           = 'erp/library/create_books';
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
        $config['file_name'] = rand(10000, 10000000000);    
        $config['upload_path'] = UPLOAD_PATH.'books_img/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
 
        if (!empty($_FILES['img']['name'])) {
 
          //upload doc
          $_FILES['imgs']['name'] = $_FILES['img']['name'];
          $_FILES['imgs']['type'] = $_FILES['img']['type'];
          $_FILES['imgs']['tmp_name'] = $_FILES['img']['tmp_name'];
          $_FILES['imgs']['size'] = $_FILES['img']['size'];
          $_FILES['imgs']['error'] = $_FILES['img']['error'];
 
          if ($this->upload->do_upload('imgs')) {
              $image_data = $this->upload->data();
           
              $fileName = "books_img/" . $image_data['file_name'];
          }
         $img=$data['img'] = $fileName;
          } else {
         $img = $_POST['imgname'];
         }
         $data = array(
         'school_id'     =>'230001',
         'name'  => $this->input->post('name'),
         'section_id'  => $this->input->post('section'),
         'author_id'  => $this->input->post('author'),
         'publisher_id'  => $this->input->post('publisher'),
         'category_id'  => $this->input->post('category'),
         'isbn_no'  => $this->input->post('isbn_no'),
         'barcode_id'  => $this->input->post('barcode_id'),
         'language'  => $this->input->post('language'),
         'price'  => $this->input->post('price'),
         'qty'  => $this->input->post('qty'),
         'description'  => $this->input->post('desc'),
         'img'  => $img,
          );
         if ($this->library_model->UpdateData('books_master',$data,$p1)) {
         $return['res'] = 'success';
          $return['msg'] = 'Saved.';
                     
          }
     }else
     {
        $id=$_SESSION['MUserId'];
        $config['file_name'] = rand(10000, 10000000000);    
        $config['upload_path'] = UPLOAD_PATH.'books_img/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webp';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
 
        if (!empty($_FILES['img']['name'])) {
 
          //upload doc
          $_FILES['imgs']['name'] = $_FILES['img']['name'];
          $_FILES['imgs']['type'] = $_FILES['img']['type'];
          $_FILES['imgs']['tmp_name'] = $_FILES['img']['tmp_name'];
          $_FILES['imgs']['size'] = $_FILES['img']['size'];
          $_FILES['imgs']['error'] = $_FILES['img']['error'];
 
          if ($this->upload->do_upload('imgs')) {
              $image_data = $this->upload->data();
           
              $fileName = "books_img/" . $image_data['file_name'];
          }
         $img=$data['img'] = $fileName;
          } else {
         $img = $data['img'] = "";
         }
         $qty_units = $this->input->post('qty');
         $bookname =  $this->input->post('isbn_no');
         $barcode = $this->input->post('barcode_id');
        $data = array(
             'school_id'     =>'230001',
             'name'  => $this->input->post('name'),
             'section_id'  => $this->input->post('section'),
             'author_id'  => $this->input->post('author'),
             'publisher_id'  => $this->input->post('publisher'),
             'category_id'  => $this->input->post('category'),
             'isbn_no'  => $this->input->post('isbn_no'),
             'barcode_id'  => $this->input->post('barcode_id'),
             'language'  => $this->input->post('language'),
             'price'  => $this->input->post('price'),
             'qty'  => $this->input->post('qty'),
             'description'  => $this->input->post('desc'),
             'img'  => $img,
             'status'        =>1,
             'created_by'      =>$id,
         );
        if ($book_id = $this->library_model->Save('books_master',$data)) {
            $data2 =array(
                'book_id'  =>$book_id,
                'price'  => $this->input->post('price'),
                'qty'  => $this->input->post('qty'),
                'type'  => 'add',
                'status'        =>1,
                'created_by'      =>$id,
            );
            $this->library_model->Save('books_inventory',$data2);
            //   $rs4 = $this->library_model->check_book_id(); 
            //     foreach($rs4 as $r4)
            //     {
            //         $bookcount = 1;
            //     }
                $bookcount = 1;
              for ($i=0; $i < $qty_units; $i++) { 
                $bookuniqueid = $bookname.''.$bookcount+$i;
                $barcodeuniqueid = $barcode.''.date('Y').''.$bookcount+$i;
              $data3 =array(
                'book_id'  =>$book_id,
                'isbn_no'  =>$bookuniqueid,
                'barcode_id'  =>$barcodeuniqueid,
                  );
                if($this->library_model->Save('book_inventory_log',$data3)){
                $return['res'] = 'success';
                $return['msg'] = 'Saved.';
                }
              }
         $return['res'] = 'success';
         $return['msg'] = 'Saved.';
                    
         }
       }

        }
        
        echo json_encode($return);
        break;
       case 'new_inventory':
        $data['action_url']         = base_url().'books-master/inventory_save/'.$p1;
        $page           = 'erp/library/create_inventory';
        $data['book']         = $this->library_model->get_data_by_id('books_master',$p1);
        $data['form_id']            = uniqid();
        $this->load->view($page, $data);
        break;
        case 'inventory_save':
            $id = $p1;
            $return['res'] = 'error';
            $return['msg'] = 'Not Saved!';
            if ($this->input->server('REQUEST_METHOD')=='POST') { 
            $id=$_SESSION['MUserId'];
             $add = $this->input->post('add');
             $sub = $this->input->post('sub');
             if($add !='' || $sub =='')
             {
                $qty = $add;
                $type = 'add';
                $rs = $this->library_model->get_data_by_id('books_master',$p1);
                $finalqty = $rs->qty+$add;
                $data =array(
                    'book_id'  =>$rs->id,
                    'qty'  => $qty,
                    'type'  => $type,
                    'status'        =>1,
                    'created_by'      =>$id,
                );
                $books = $this->library_model->getDataID('books_master',$p1);
                $totalrow = $this->library_model->get_book_row($p1);
                $bookcount = $totalrow+1;
                for ($i=0; $i < $qty; $i++) { 
                  $bookuniqueid = $books->isbn_no.''.$bookcount+$i;
                  $barcodeuniqueid = $books->barcode_id.''.date('Y').''.$bookcount+$i;
                  $data3 =array(
                  'book_id'  =>$p1,
                  'isbn_no'  =>$bookuniqueid,
                  'barcode_id'  =>$barcodeuniqueid,
                    );
                  if($this->library_model->Save('book_inventory_log',$data3)){
                  $return['res'] = 'success';
                  $return['msg'] = 'Saved.';
                  }
                }
                if ($book_id = $this->library_model->Save('books_inventory',$data)) {
                   
                    $this->library_model->Update('books_master',['qty'=>$finalqty],['id'=>$p1]);
                    $return['res'] = 'success';
                    $return['msg'] = 'Inventory Saved.';
                   }
                
             }elseif($add =='' || $sub !='')
             {
                $qty = $sub;
                $type = 'subtract';
                $rs = $this->library_model->get_data_by_id('books_master',$p1);
                if($rs->qty > $sub){
                $finalqty = $rs->qty-$sub;
                $data =array(
                    'book_id'  =>$rs->id,
                    'qty'  => $qty,
                    'type'  => $type,
                    'status'        =>1,
                    'created_by'      =>$id,
                );
                  $totalrow = $this->library_model->get_book_row($p1);
                  //echo $totalrow;die();
                  $this->library_model->delete_inventory($sub,$p1);
                if ($book_id = $this->library_model->Save('books_inventory',$data)) {
                   
                    $this->library_model->Update('books_master',['qty'=>$finalqty],['id'=>$p1]);
                    $return['res'] = 'success';
                    $return['msg'] = 'Inventory Saved.';
                            
                 
                   }
                }else
                {
                $return['res'] = 'error';
                $return['msg'] = 'Sorry Please enter correct quantity.';
                
                }
             }
           
            
    
            }
            
            echo json_encode($return);
            break;
            case 'view_image':
			$data['book'] = $this->library_model->getDataID('books_master',$p1);
			$page           = 'erp/library/view_image';
    
            $this->load->view($page,$data);
            break;
            case 'view_isbn':
            $data['book_qty'] = $this->library_model->get_book_allot_qty($p1);    
            $data['book'] = $this->library_model->get_inventory_log($p1);
            $data['book_master'] = $this->library_model->getDataID('books_master',$p1);
            $page           = 'erp/library/view_isbn';
            $this->load->view($page,$data);
            break;
            
            case 'delete':
            $return['res'] = 'error';
            $return['msg'] = 'Not Deleted!';
            if ($p1!=null) {
            if($this->erp_model->_delete('books_master',['id'=>$p1])){
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





public function student_book_assign($action=null,$p1=null,$p2=null,$p3=null)
{
    switch ($action) {
        case null:
            
    $data['menu_id'] = $this->uri->segment(2);
   
    $data['title']          = 'Student Books Assign';
    $data['new_url']         = base_url().'student-book-assign/create ';
    $data['tb_url']            = current_url().'/tb';
    $data['search']           = $this->input->post('search');
    $data['sections']      = $this->getSection(null,'return');
    $data['action_url']         = base_url().'student-book-assign/save';
    $id=$_SESSION['MUserId'];
    $data['roles'] = $this->erp_model->view_role($id);
    $this->load->view('erp/library/header',$data);
    $this->load->view('erp/library/student_book_assign',$data);
    $this->load->view('erp/library/footer');
    break;
    case 'save':
    $return['res'] = 'error';
    $return['msg'] = 'Not Saved!';
    if ($this->input->server('REQUEST_METHOD')=='POST') { 
    $id=$_SESSION['MUserId'];
    $totalbooks =  $_POST['books'];
    $i=0; foreach($totalbooks as $b)
     {
     $books_id=  $b;
     $stu_id = $_POST['student'];
     $rs = $this->library_model->get_inventory_book($books_id);
     $count = $this->erp_model->Counter('student_book_assign', array( 'section_id'=>$_POST['section'],'student_id' =>$_POST['student'],'isbn_no'=>$rs->isbn_no,'barcode_id'=>$rs->barcode_id,'book_id'=>$b));
     if($count==0){
     $data = array(
        'student_id'     =>$_POST['student'],
        'section_id'  => $_POST['section'],
        'isbn_no'     =>$rs->isbn_no,
        'barcode_id'     =>$rs->barcode_id,
        'book_id'     =>$b,
    );
    $this->library_model->Save('student_book_assign',$data);
    $this->library_model->update_inventory($stu_id,$b);
    $saved =1;
}else
{
   $saved=0;  
}
    $i++;
 }
    if($saved==1)
    { 
     $return['res'] = 'success';
    $return['msg'] = 'Saved.';
    }else
    {
        $return['res'] = 'error';
        $return['msg'] = 'Already Assigned.'; 
    }
  
    }
    
    echo json_encode($return);
    break;
    default:
    # code...
    break;
    }
}

public function teacher_book_assign($action=null,$p1=null,$p2=null,$p3=null)
{
    switch ($action) {
        case null:
            
    $data['menu_id'] = $this->uri->segment(2);
    $data['title']          = 'Teacher  Books Assign';
    $data['new_url']         = base_url().'teacher-book-assign/create ';
    $data['tb_url']            = current_url().'/tb';
    $data['search']           = $this->input->post('search');
    $data['sections']      = $this->getSection(null,'return');
    $data['teachers']      = $this->getTeachers(null,'return');
    $data['action_url']         = base_url().'teacher-book-assign/save';
    $id=$_SESSION['MUserId'];
    $data['roles'] = $this->erp_model->view_role($id);
    $this->load->view('erp/library/header',$data);
    $this->load->view('erp/library/teacher_book_assign',$data);
    $this->load->view('erp/library/footer');
    break;
    case 'save':
    $return['res'] = 'error';
    $return['msg'] = 'Not Saved!';
    if ($this->input->server('REQUEST_METHOD')=='POST') { 
    $id=$_SESSION['MUserId'];
    $totalbooks =  $_POST['books'];
    $i=0; foreach($totalbooks as $b)
     {
     $books_id=  $b;
     $teacher = $_POST['teacher'];
     $rs = $this->library_model->get_inventory_book($books_id);
     $count = $this->erp_model->Counter('teacher_book_assign', array( 'section_id'=>$_POST['section'],'teacher' =>$_POST['teacher'],'book_id'=>$b,'days'=>$_POST['days']));
     if($count==0){
     $data = array(
        'teacher'     =>$_POST['teacher'],
        'section_id'  => $_POST['section'],
        'isbn_no'     =>$rs->isbn_no,
        'barcode_id'     =>$rs->barcode_id,
        'book_id'     =>$b,
        'days'        =>$_POST['days'],
        'teacher_given'=>'YES',
    );
    $this->library_model->Save('teacher_book_assign',$data);
    $saved =1;
}else
{
   $saved=0;  
}
    $i++;
 }
    if($saved==1)
    { 
     $return['res'] = 'success';
    $return['msg'] = 'Saved.';
    }else
    {
        $return['res'] = 'error';
        $return['msg'] = 'Already Assigned.'; 
    }
  
    }
    
    echo json_encode($return);
    break;
    default:
    # code...
    break;
    }
}
public function teacher_assigned_books($action=null,$p1=null,$p2=null,$p3=null)
{
    switch ($action) {
        case null:
            
    $data['menu_id'] = $this->uri->segment(2);
    $data['title']          = 'Teacher Assigned Books';
    $data['new_url']         = base_url().'teacher-assigned-books/create ';
    $data['tb_url']            = current_url().'/tb';
    $data['search']           = $this->input->post('search');
    $data['sections']      = $this->getSection(null,'return');
    $data['teachers']      = $this->getTeachers(null,'return');
    $data['action_url']         = base_url().'teacher-assigned-books/save';
    $id=$_SESSION['MUserId'];
    $data['roles'] = $this->erp_model->view_role($id);
    $this->load->view('erp/library/header',$data);
    $this->load->view('erp/library/teacher_assigned_books',$data);
    $this->load->view('erp/library/footer');
    break;
    case 'tb':
        if(!empty($_POST['id']))
        {
           $id =  $_POST['id'];
           $return = $_POST['teacher_return'];
           $data = array('teacher_return'=>$return,'teacher_given'=>'NO');
          $this->library_model->Update('teacher_book_assign',$data,['id'=>$id]);

        }
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
        $school_id = '230001';        
        $this->load->library('pagination');
        $config = array();
        $config["base_url"]     = base_url()."teacher-assigned-books/tb";
        $config["total_rows"]   = count($this->library_model->get_teacher_books($school_id,$search));
        $data['total_rows']     = $config["total_rows"];
        $config["per_page"]     = 10;
        $config["uri_segment"]  = 2;
        $config['attributes']   = array('class' => 'pag-link ');
        $this->pagination->initialize($config);
        $data['links']          = $this->pagination->create_links();
        $data['page']           = $page = ($p1!=null) ? $p1 : 0;
        $data['search']         = $this->input->post('search');
        $data['delete_url']         = base_url().'teacher-assigned-books/delete/';
        $data['update_url']       =base_url().'teacher-assigned-books/create/'; 
        $data['rows']           = $this->library_model->get_teacher_books($school_id,$search,$config["per_page"],$page);
        $page                       = 'erp/library/tb_teacher_assigned_books';
        $this->load->view($page, $data); 
        break;
    case 'save':
    $return['res'] = 'error';
    $return['msg'] = 'Not Saved!';
    if ($this->input->server('REQUEST_METHOD')=='POST') { 
    $id=$_SESSION['MUserId'];
    $totalbooks =  $_POST['books'];
    $i=0; foreach($totalbooks as $b)
     {
     $books_id=  $b;
     $teacher = $_POST['teacher'];
     $rs = $this->library_model->get_inventory_book($books_id);
     $count = $this->erp_model->Counter('teacher_book_assign', array( 'section_id'=>$_POST['section'],'teacher' =>$_POST['teacher'],'isbn_no'=>$rs->isbn_no,'barcode_id'=>$rs->barcode_id,'book_id'=>$b,'days'=>$_POST['days']));
     if($count==0){
     $data = array(
        'teacher'     =>$_POST['teacher'],
        'section_id'  => $_POST['section'],
        'isbn_no'     =>$rs->isbn_no,
        'barcode_id'     =>$rs->barcode_id,
        'book_id'     =>$b,
        'days'        =>$_POST['days'],
        'teacher_given'=>'YES',
    );
    $this->library_model->Save('teacher_book_assign',$data);
    $saved =1;
}else
{
   $saved=0;  
}
    $i++;
 }
    if($saved==1)
    { 
     $return['res'] = 'success';
    $return['msg'] = 'Saved.';
    }else
    {
        $return['res'] = 'error';
        $return['msg'] = 'Already Assigned.'; 
    }
  
    }
    
    echo json_encode($return);
    break;
    default:
    # code...
    break;
    }
}



}   