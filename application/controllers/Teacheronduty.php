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
		
		$reason=$this->input->post('reason');
		$notes=$this->input->post('notes');
		
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
		
		$reason=$this->input->post('reason');
		$notes=$this->input->post('notes');
		
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
 }
	?>