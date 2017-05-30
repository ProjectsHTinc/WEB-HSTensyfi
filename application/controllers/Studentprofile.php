<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentprofile extends CI_Controller {


	function __construct() {
		 parent::__construct();
		  $this->load->model('studentprofilemodel');
		  $this->load->model('yearsmodel');
		  $this->load->model('classmodel');
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


	 	public function home(){}

		public function profile_update()
		{

			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 //echo $user_id;exit;
			 $datas['res'] = $this->studentprofilemodel->getuser($user_id);
			  $datas['class'] = $this->classmodel->getclass();
			 
			   //print_r($datas['res']);exit;
				if($user_type==3){
				$this->load->view('adminstudent/student_header');
				$this->load->view('adminstudent/profile_update',$datas);
				$this->load->view('adminstudent/student_footer');
				}
				else{
					 redirect('/');
				}
		}

		public function update_stu_details()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==3)
			 {
			 $admission_id=$this->input->post('admission_id');
			 $admission_year=$this->input->post('admission_year');
			 $admission_no=$this->input->post('admission_no');
			 $admission_date=$this->input->post('admission_date');
			 $name=$this->input->post('name');
			 $email=$this->input->post('email');
		     $sex=$this->input->post('sex');
			 $dob=$this->input->post('dob');
			 $age=$this->input->post('age');
		     $nationality=$this->input->post('nationality');
			 $religion=$this->input->post('religion');
			 $community_class=$this->input->post('community_class');
		     $community=$this->input->post('community');
			 $mother_tongue=$this->input->post('mother_tongue');
			 $mobile=$this->input->post('mobile');
			 $lang=$this->input->post('lang');
			 $sec_mobile=$this->input->post('sec_mobile');
			 $sec_email=$this->input->post('sec_email');
			 
			 $status=$this->input->post('status');
			 $last_sch=$this->input->post('sch_name');
			 $last_studied=$this->input->post('class_name');
			 $qual=$this->input->post('qual');
			 //echo $last_sch;exit;			 
				$tran_cert=$this->input->post('trn_cert');
				$recod_sheet=$this->input->post('rec_sheet');
				$emsi_num=$this->input->post('emsi_num');
			 $user_pic_old=$this->input->post('user_pic_old');
			 $student_pic = $_FILES["user_pic"]["name"];
			 $userFileName =$student_pic;

				$uploaddir = 'assets/students/profile/';
				$profilepic = $uploaddir.$userFileName;
				move_uploaded_file($_FILES['user_pic']['tmp_name'], $profilepic);
				if(empty($student_pic)){
						$userFileName=$user_pic_old;
				}
				
				$datas=$this->studentprofilemodel->update_details($admission_year,$admission_no,$emsi_num,$admission_date,$name,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$lang,$mobile,$sec_mobile,$email,$sec_email,$userFileName,$last_sch,$last_studied,$qual,$tran_cert,$recod_sheet,$admission_id);
			//	print_r($datas['status']);exit;
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('studentprofile/profile_update');
				}else if($datas['status']=="Email Already Exist"){
					$this->session->set_flashdata('msg', 'Email Already Exist');
					redirect('studentprofile/profile_update');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('studentprofile/profile_update');
				}
			 }
			 else{
					redirect('/');
			 }
		}

		public function pwd_reset()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			//echo $user_id;exit;
			 $datas['result'] = $this->studentprofilemodel->change_pwd($user_id);
			 $user_type=$this->session->userdata('user_type');
				// echo $user_type;exit;
				 if($user_type==3){
					$this->load->view('adminstudent/student_header');
					$this->load->view('adminstudent/resetpassword',$datas);
					$this->load->view('adminstudent/student_footer');
					}
					else{
						 redirect('/');
					}
		}

		public function changepwd()
		{
			    $datas=$this->session->userdata();
				$user_name=$this->session->userdata('user_name');
				$user_type=$this->session->userdata('user_type');
				if($user_type==3)
				{
						$user_id=$this->input->post('user_id');
						//echo $user_id;exit;

						$name=$this->input->post('name');
						$oldpassword=md5($this->input->post('oldpassword'));
						$newpassword=md5($this->input->post('newpassword'));

					    $user_password_old=$this->input->post('user_password_old');

						$res=$this->studentprofilemodel->updatepwd($user_id,$oldpassword,$newpassword);

						if($res['status']=="success"){
							  $this->session->set_flashdata('msg', 'Update Successfully');
							  redirect('studentprofile/pwd_reset');
						  }else{
								$this->session->set_flashdata('msg', 'Failed to update');
								redirect('studentprofile/pwd_reset');
							  }
			 }else{
					redirect('/');
			 }
		}



		}
