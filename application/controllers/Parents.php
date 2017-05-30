<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parents extends CI_Controller {


	function __construct() {
		 parent::__construct();
		  $this->load->model('parentsmodel');
		  $this->load->model('admissionmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
 }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 // Class section
	 	public function home($admission_id){
	 		 $datas=$this->session->userdata();
	 		 $user_id=$this->session->userdata('user_id');
	 		//$datas['result'] = $this->classmodel->getclass();
			  $user_type=$this->session->userdata('user_type');
			  $datas['result']=$admission_id;
			 // $datas['admission_id']; $this->admissionmodel->get_ad_id();
			 if($user_type==1)
			 {
	 		 $this->load->view('header');
	 		 $this->load->view('parents/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function create()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
		 	if($user_type==1)
			{
				    $admission_id=$this->input->post('admission_no');
					//echo $admission_id;
					//exit;
					$father_name=$this->input->post('father_name');
					
					$mother_name=$this->input->post('mother_name');
					
					$guardn_name=$this->input->post('guardn_name');
					
					$occupation=$this->input->post('occupation');
					$income=$this->input->post('income');
					$address=$this->input->post('address');
					$email=$this->input->post('email');
					$email1=$this->input->post('email1');
					$home_phone=$this->input->post('home_phone');
				    $office_phone=$this->input->post('office_phone');
					$mobile=$this->input->post('mobile');
					$mobile1=$this->input->post('mobile1');
					$status=$this->input->post('status');
				  
					$father_pic = $_FILES["father_pic"]["name"];
				    $userFileName =$father_pic;
				    $uploaddir = 'assets/parents/';
				    $profilepic = $uploaddir.$userFileName;
				    move_uploaded_file($_FILES['father_pic']['tmp_name'], $profilepic);
				
					$mother_pic = $_FILES["mother_pic"]["name"];
					$userFileName1 =$mother_pic;
					$uploaddir1 = 'assets/parents/';
					$profilepic1 = $uploaddir1.$userFileName1;
					move_uploaded_file($_FILES['mother_pic']['tmp_name'], $profilepic1);
					
					$guardn_pic = $_FILES["guardn_pic"]["name"];
					$userFileName2 =$guardn_pic;
					$uploaddir2 = 'assets/parents/';
					$profilepic2 = $uploaddir2.$userFileName2;
					move_uploaded_file($_FILES['guardn_pic']['tmp_name'], $profilepic2);
					
					
														
	$datas=$this->parentsmodel->ad_parents($admission_id,$father_name,$mother_name,$guardn_name,$occupation,$income,$address,$email,$email1,$home_phone,$office_phone,$mobile,$mobile1,$userFileName,$userFileName1,$userFileName2,$status);
					
				
			//	print_r($datas['status']);exit;
				if($datas['status']=="success")
				{
					$this->session->set_flashdata('msg','Added Successfully');
					redirect('parents/view');
				}
				else 
					if($datas['status']=="Email Already Exist")
				      {
							$this->session->set_flashdata('msg', 'Email Already Exist');
							redirect('parents/view');
				      }
					   else
					   {
							$this->session->set_flashdata('msg', 'Failed to Add');
							redirect('parents/view');
				       }
			   }
			 else
			 {
					redirect('/');
			 }
		}
// GET ALL ADMISSION DETAILS

			public function view()
					{
						$datas=$this->session->userdata();
						$user_id=$this->session->userdata('user_id');
						$datas['result'] = $this->parentsmodel->get_all_parents_details();
						//echo "<pre>";print_r(	$datas['result']);exit;
						$user_type=$this->session->userdata('user_type');
						if($user_type==1){
					 $this->load->view('header');
					 $this->load->view('parents/view',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
					}
		
			public function edit_parents($parent_id)
				{
					 $datas=$this->session->userdata();
					 $user_id=$this->session->userdata('user_id');
					 $datas['res']=$this->parentsmodel->edit_parents($parent_id);
					 //echo "<pre>";print_r(	$datas['res']);exit;
					 $user_type=$this->session->userdata('user_type');
					if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('parents/edit',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
					}
					
			public function edit_parent($parnt_guardn_id)
				{
					 $datas=$this->session->userdata();
					 $user_id=$this->session->userdata('user_id');
					 $datas['res']=$this->parentsmodel->edit_parent($parnt_guardn_id);
					 //echo "<pre>";print_r(	$datas['res']);exit;
					 $user_type=$this->session->userdata('user_type');
					if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('parents/edit',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
					}

		    public function update_parents()
			{
				 $datas=$this->session->userdata();
				 $user_id=$this->session->userdata('user_id');
				 $user_type=$this->session->userdata('user_type');
				 if($user_type==1)
				 {
					$parent_id=$this->input->post('parent_id');
					$single=$this->input->post('single');
					//echo $single;exit;
					$admission_id=$this->input->post('admission_no');
				    $father_name=$this->input->post('father_name');
					$mother_name=$this->input->post('mother_name');
					
					$guardn_name=$this->input->post('guardn_name');
					  
					$occupation=$this->input->post('occupation');
					$income=$this->input->post('income');
					$address=$this->input->post('address');
					$email=$this->input->post('email');
					$email1=$this->input->post('email1');
					$home_phone=$this->input->post('home_phone');
				    $office_phone=$this->input->post('office_phone');
					$mobile=$this->input->post('mobile');
					$mobile1=$this->input->post('mobile1');
					
					$status=$this->input->post('status');
					
					$father_pic_old=$this->input->post('old_father_pic');
					$mother_pic_old=$this->input->post('old_mother_pic');
					$guardian_pic_old=$this->input->post('old_guardian_pic');
				  
					$father_pic = $_FILES["father_pic"]["name"];
				    $userFileName =$admission_id.'-'.$father_pic;
				    $uploaddir = 'assets/parents/';
				    $profilepic = $uploaddir.$userFileName;
				    move_uploaded_file($_FILES['father_pic']['tmp_name'], $profilepic);
				
					$mother_pic = $_FILES["mother_pic"]["name"];
					$userFileName1 =$admission_id.'-'.$mother_pic;
					$uploaddir1 = 'assets/parents/';
					$profilepic1 = $uploaddir1.$userFileName1;
					move_uploaded_file($_FILES['mother_pic']['tmp_name'], $profilepic1);
					
					$guardn_pic = $_FILES["guardn_pic"]["name"];
					$userFileName2 =$admission_id.'-'.$guardn_pic;
					$uploaddir2 = 'assets/parents/';
					$profilepic2 = $uploaddir2.$userFileName2;
					move_uploaded_file($_FILES['guardn_pic']['tmp_name'], $profilepic2);
					
				if(empty($father_pic))
				{
						$userFileName=$father_pic_old;
				}
				if(empty($mother_pic))
				{
						$userFileName1=$mother_pic_old;
				}
				if(empty($guardn_pic))
{
						$userFileName2=$guardian_pic_old;
				}
				
				$datas=$this->parentsmodel->update_parents($parent_id,$single,$admission_id,$father_name,$mother_name,$guardn_name,$occupation,$income,$address,$email,$email1,$home_phone,$office_phone,$mobile,$mobile1,$userFileName,$userFileName1,$userFileName2,$status);
				
				//	print_r($datas['status']);exit;
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('parents/view');
				}else if($datas['status']=="Email Already Exist"){
					$this->session->set_flashdata('msg', 'Email Already Exist');
					redirect('parents/view');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('parents/view');
				}
			 }
			 else{
					redirect('/');
			 }
		}
		
		public function search()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				$cell=$this->input->post('cell');
				$admission_id=$this->input->post('admission_no');
				$datas['res']=$this->admissionmodel->get_ad_id($admission_id);
				$datas['res1']=$this->parentsmodel->search_parent($cell);
                $user_type=$this->session->userdata('user_type');
					if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('parents/add_exist',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
			 }
			
		}
		
		   					   
			   public function checker() 
                {
					$email = $this->input->post('email');
					$numrows = $this->parentsmodel->getData($email);
					if ($numrows>0) 
				     {
						echo "Email Id already Exit";
					 } 
					else 
					 {
						echo "Email Id Available";
					 }
                }
  
              public function cellchecker()
			  {
				    $cell = $this->input->post('cell');
					$numrows1 = $this->parentsmodel->checkcellnum($cell);
					if ($numrows1!='') 
				     {
						echo "Mobile Number Available";
					 } 
					else 
					 {
						echo "Mobile Number Not Found";
					 }
			  }
	
	
		       



}
