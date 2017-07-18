<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacheronduty extends CI_Controller
 {

	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('teacherondutymodel');
		  $this->load->helper('url');
		  $this->load->library('session');
      }   
		
    public function home()
	 {
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['result'] = $this->teacherondutymodel->getall_details($user_id,$user_type);
			
			 if($user_type==2)
			 {
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/onduty/add_onduty',$datas);
				 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
	}
	
	
	public function apply_onduty()
	{
		$datas=$this->session->userdata();
  	    $user_id=$this->session->userdata('user_id');
	    $user_type=$this->session->userdata('user_type');
		
		$reason=$this->db->escape_str($this->input->post('reason'));
		$notes=$this->db->escape_str($this->input->post('notes'));
		
		$from_date=$this->input->post('fdate');
		 $dateTime = new DateTime($from_date);
         $fdate=date_format($dateTime,'Y-m-d' );
		 
		$to_date=$this->input->post('tdate');
		 $dateTime1=new DateTime($to_date);
         $tdate=date_format($dateTime1,'Y-m-d' );
		 
		//$status=$this->input->post('status');
		$datas=$this->teacherondutymodel->apply_onduty($user_type,$user_id,$reason,$fdate,$tdate,$notes);
		//print_r($datas);exit;
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Added Successfully');
			redirect('teacheronduty/home');
		}else if($datas['status']=="Date"){
			$this->session->set_flashdata('msg','From Date Should be Less Than To Date');
			redirect('teacheronduty/home');

		}else{
			$this->session->set_flashdata('msg','Faild To Add');
			redirect('teacheronduty/home');
		}
		
	}

	public function edit_onduty($id)
	{
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
        $datas['edit']=$this->teacherondutymodel->edit_onduty_form($id);
		//echo'<pre>';print_r($datas['edit']);exit;
        if($user_type==2)
			 {
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/onduty/edit_onduty',$datas);
				 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
	}

	public function update_onduty()
	{
		$datas=$this->session->userdata();
  	    $user_id=$this->session->userdata('user_id');
	    $user_type=$this->session->userdata('user_type');
		
		$reason=$this->db->escape_str($this->input->post('reason'));
		$notes=$this->db->escape_str($this->input->post('notes'));
		
		$from_date=$this->input->post('fdate');
		 $dateTime = new DateTime($from_date);
         $fdate=date_format($dateTime,'Y-m-d' );
		 
		$to_date=$this->input->post('tdate');
		 $dateTime1=new DateTime($to_date);
         $tdate=date_format($dateTime1,'Y-m-d' );
		 
		 $duty_id=$this->input->post('id');
		
		$datas=$this->teacherondutymodel->update($duty_id,$user_type,$user_id,$reason,$fdate,$tdate,$notes);
		//print_r($datas);exit;
		
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('teacheronduty/home');
		}else if($datas['status']=="Date"){
			$this->session->set_flashdata('msg','From Date Should be Less Than To Date');
			redirect('teacheronduty/home');

		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('teacheronduty/home');
		}
	}
	
	//------------------------------Special Class------------------------
	
	public function special_class_details()
	{
		$datas=$this->session->userdata();
  	    $user_id=$this->session->userdata('user_id');
	    $user_type=$this->session->userdata('user_type');
		$datas['view']=$this->teacherondutymodel->special_class_details($user_id,$user_type);
		//echo'<pre>';print_r($datas['view']);exit;
        if($user_type==2)
		 {
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/special_class/view_special_cls',$datas);
			 $this->load->view('adminteacher/teacher_footer');
		 }else{
			redirect('/');
		 }
	}
 
 
 //-----------------------------------Student Onduty Detaials-------------------
 
     public function view_class()
	 {
		$datas=$this->session->userdata();
  	    $user_id=$this->session->userdata('user_id');
	    $user_type=$this->session->userdata('user_type');
		
		$datas['cls_name']=$this->teacherondutymodel->view_class_teacher($user_id,$user_type);
		//echo'<pre>';print_r($datas['cls_name']);exit;
        if($user_type==2)
		 {
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/onduty/view_class',$datas);
			 $this->load->view('adminteacher/teacher_footer');
		 }else{
			redirect('/');
		 }
	 }
	 public function student_ondy_details($cls_id)
	 { //echo $cls_id;exit;
		$datas=$this->session->userdata();
  	    $user_id=$this->session->userdata('user_id');
	    $user_type=$this->session->userdata('user_type');
		
		$datas['stuonduty']=$this->teacherondutymodel->view_student_ondy($cls_id,$user_id,$user_type);
		//echo'<pre>';print_r($datas['stuonduty']);exit;
        if($user_type==2)
		 {
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/onduty/onduty_student',$datas);
			 $this->load->view('adminteacher/teacher_footer');
		 }else{
			redirect('/');
		 }
	 }
	 
	 
	//---------------------------------Substitution---------------------------

      public function view_substitution()
	  {
		$datas=$this->session->userdata();
  	    $user_id=$this->session->userdata('user_id');
	    $user_type=$this->session->userdata('user_type');
		$datas['substitution']=$this->teacherondutymodel->view_substitution_details($user_id,$user_type);
		//echo'<pre>';print_r($datas['substitution']);exit;
        if($user_type==2)
		 {
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/substitution/view_subsitution',$datas);
			 $this->load->view('adminteacher/teacher_footer');
		 }else{
			redirect('/');
		 }
	  }
	 
 }
	?>