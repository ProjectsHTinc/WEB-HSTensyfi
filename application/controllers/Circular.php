<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Circular extends CI_Controller
{
      function __construct()
      {
      parent::__construct();
      $this->load->model('circularmodel');
      $this->load->model('subjectmodel');
      $this->load->model('class_manage');
      $this->load->helper('url');
      $this->load->library('session');
      }
	  //-------------------------------Create Circular Master--------------------------
	  
	     public function create_circular_master()
          {
			  $datas=$this->session->userdata();
			  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  $datas['years']=$this->circularmodel->get_current_years();
			  $datas['result']=$this->circularmodel->get_all_result();
			  //print_r($datas['result']);exit;
			  if($user_type==1)
			  {
			  $this->load->view('header');
			  $this->load->view('circular/create_circular_master',$datas);
			  $this->load->view('footer');
			  }
			  else{
			  redirect('/');
			  }
        }
		
		public function add_circular_master()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			$year_id=$this->input->post('year_id');
			$ctype=$this->input->post('ctype');
			$ctile=$this->input->post('ctitle');
			$cdescription=$this->input->post('cdescription');
	        $status=$this->input->post('status'); 
			
			  $datas=$this->circularmodel->create_circular_masters($year_id,$ctype,$ctile,$cdescription,$status,$user_id);
			  //print_r($datas);exit;
			  if($datas['status']=="success")
			  {
			  $this->session->set_flashdata('msg', 'Added Successfully');
			  redirect('circular/create_circular_master');
			  }
			  else{
			  $this->session->set_flashdata('msg', 'Failed to Add');
			  redirect('circular/create_circular_master');
			  }
		}
	  
	  public function edit_circular_master($id)
	  {
		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['result']=$this->circularmodel->edit_all_result($id);
			 //print_r($datas['result']);exit;
			  if($user_type==1)
			  {
			  $this->load->view('header');
			  $this->load->view('circular/edit_circular_master',$datas);
			  $this->load->view('footer');
			  }
			  else{
			  redirect('/');
			  }
	  }
	  
	  public function update_circular_master()
	  {
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$year_id=$this->input->post('year_id');
		$cid=$this->input->post('cid');
		$ctype=$this->input->post('ctype');
		$ctile=$this->input->post('ctitle');
		$cdescription=$this->input->post('cdescription');
		$status=$this->input->post('status'); 
		
		  $datas=$this->circularmodel->update_circular_masters($cid,$year_id,$ctype,$ctile,$cdescription,$status,$user_id);
		  //print_r($datas);exit;
		  if($datas['status']=="success")
		  {
		  $this->session->set_flashdata('msg', 'Updated Successfully');
		  redirect('circular/create_circular_master');
		  }
		  else{
		  $this->session->set_flashdata('msg', 'Failed to Update');
		  redirect('circular/create_circular_master');
		  }
	  }
	  
	  
	  //-------------------------------Create Circular --------------------------------
      public function add_circular()
      {
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
		  $datas['teacher']=$this->circularmodel->get_teachers();
		  $datas['getall_class']=$this->class_manage->getall_class();
		  $datas['parents']=$this->circularmodel->getall_parents();
		  $datas['role']=$this->circularmodel->getall_roles();
		  $datas['cmaster']=$this->circularmodel->cmaster_type();
		  //print_r( $datas['cmaster']);exit;
		  $user_type=$this->session->userdata('user_type');
		  if($user_type==1)
		  {
		  $this->load->view('header');
		  $this->load->view('circular/add',$datas);
		  $this->load->view('footer');
		  }
		  else{
		  redirect('/');
		  }
      }
	  public function view_circular()
      {
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
		  $user_type=$this->session->userdata('user_type');
		  $datas['all_circulars']=$this->circularmodel->get_all_circular();
		  //echo '<pre>'; print_r($datas['all_circulars']);exit;
		 $datas['parents']=$this->circularmodel->get_parents_circular();
		 $datas['students']=$this->circularmodel->get_students_circular();

		  if($user_type==1)
		  {
		  $this->load->view('header');
		  $this->load->view('circular/view',$datas);
		  $this->load->view('footer');
		  }
		  else{
		  redirect('/');
		  }
      }
	  
	  public  function get_circular_title_list()
	  {
		    $ctype=$this->input->post('ctype');
		   //echo $ctype;exit;
		   $data=$this->circularmodel->get_circular_title_lists($ctype);
		   echo json_encode($data);
	  }
	  
	  public function get_description_list()
	  {
		   $ctitle=$this->input->post('ctitle');
		   //echo $ctype;exit;
		   $data=$this->circularmodel->get_circular_description_lists($ctitle);
		   echo json_encode($data);
	  }
	  
	  public function get_stu_list()
	  {
		   $classid = $this->input->post('classid');
		   //echo $classid;exit;
		   $data=$this->circularmodel->get_stu_name($classid);
		   echo json_encode($data);
	  }
	  
	  public function get_parent_list()
	  {
		   $studentid = $this->input->post('studentid');
		   //echo $classid;exit;
		   $data=$this->circularmodel->get_parent_name($studentid);
		   echo json_encode($data);
	  }
	  
      public function create()
      {
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('user_id');
      $user_type=$this->session->userdata('user_type');
      if($user_type==1)
      {
      $users_id=$this->input->post('users');
	  $tusers_id=$this->input->post('tusers');
	  //print_r($tusers_id);
	  $pusers_id=$this->input->post('pusers');
      $stusers_id=$this->input->post('stusers');
    
      $ctitle=$this->input->post('ctitle'); 
	  $ctitle1=$this->input->post('title'); 
	  if($ctitle==''){
		  $title=$ctitle1;
	  }
	  else{
		   $title=$ctitle;
	  }
      //echo $title;exit;	  
      $date=$this->input->post('date');
      $dateTime = new DateTime($date);
      $circulardate=date_format($dateTime,'Y-m-d' );
      $notes=$this->input->post('notes');
	  
	   $citrcular_type=$this->input->post('citrcular_type');
	   $status=$this->input->post('status'); 
	   
      $datas=$this->circularmodel->circular_create($title,$notes,$circulardate,$users_id,$tusers_id,$pusers_id,$stusers_id,$citrcular_type,$status,$user_id);
      //print_r($datas);exit;
	  if($datas['status']=="success")
      {
      $this->session->set_flashdata('msg', 'Added Successfully');
      redirect('circular/add_circular');
      }
      else{
      $this->session->set_flashdata('msg', 'Failed to Add');
      redirect('circular/add_circular');
      }
      }
      }
   
		
}
