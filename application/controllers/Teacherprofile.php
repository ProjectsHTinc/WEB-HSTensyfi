<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacherprofile extends CI_Controller {


	function __construct() {
		 parent::__construct();
		 $this->load->model('teacherprofilemodel');
		 $this->load->model('subjectmodel');
		 $this->load->model('class_manage');
		 $this->load->helper('url');
		 $this->load->library('session');


 }
	public function home()
	{

    }

	public function profilepic()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 $datas['result'] = $this->teacherprofilemodel->getuser($user_id);
           //print_r($datas['result']);exit;
		 $datas['resubject'] = $this->subjectmodel->getsubject();
		 $datas['getall_class']=$this->class_manage->getall_class();
		 $datas['groups']=$this->teacherprofilemodel->get_all_groups_details();
		 $datas['activities']=$this->teacherprofilemodel->get_all_activities_details();
		if($user_type==2){
		$this->load->view('adminteacher/teacher_header',$datas);
		$this->load->view('adminteacher/profile_update',$datas);
		$this->load->view('adminteacher/teacher_footer');
		}
		else{
			 redirect('/');
		}
}

	public function profileupdate(){
			$datas=$this->session->userdata();
			$user_name=$this->session->userdata('user_name');
			$user_type=$this->session->userdata('user_type');
		 	if($user_type==2)
			{
				        $user_id=$this->input->post('user_id');
			          	//echo $user_id;exit;
						$teachername=$this->input->post('name');
						$user_pic_old=$this->input->post('user_pic_old');

					  $sex=$this->input->post('sex');
			          $dob=$this->input->post('dob');
			          $age=$this->input->post('age');
		              $nationality=$this->input->post('nationality');
			          $religion=$this->input->post('religion');
                      $mobile=$this->input->post('mobile');

					  $sec_email=$this->input->post('sec_email');
					  $sec_phone=$this->input->post('sec_phone');

					  $community_class=$this->input->post('community_class');
		              $community=$this->input->post('community');
			          $address=$this->input->post('address');
					  $email=$this->input->post('email');

				       $student_pic = $_FILES["user_pic"]["name"];
				       $userFileName =time().$student_pic;
				       $uploaddir = 'assets/teachers/profile/';
					   $profilepic = $uploaddir.$userFileName;
					   move_uploaded_file($_FILES['user_pic']['tmp_name'], $profilepic);
					   if(empty($student_pic))
					   {
					    $userFileName=$user_pic_old;
				       }


						$res=$this->teacherprofilemodel->teacherprofileupdate($user_id,$teachername,$email,$sec_email,$sex,$dob,$age,$nationality,$religion,$mobile,$sec_phone,$community_class,$community,$address,$userFileName);

						if($res['status']=="success"){
					 $this->session->set_flashdata('msg', 'Update Successfully');
					 redirect('teacherprofile/profilepic');
				    }else{
					 $this->session->set_flashdata('msg', 'Failed to update');
					  redirect('teacherprofile/profilepic');
				  }
		 }
	}


	public function profile()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $datas['result'] = $this->teacherprofilemodel->get_teacheruser($user_id);
		 $user_type=$this->session->userdata('user_type');
			// echo $user_type;exit;
			 if($user_type==2){
				$this->load->view('adminteacher/teacher_header');
		        $this->load->view('adminteacher/resetpassword',$datas);
		        $this->load->view('adminteacher/teacher_footer');
				}
				else{
					 redirect('/');
				}
        }

				

  public function updateprofile()
  {
	    $datas=$this->session->userdata();
		$user_name=$this->session->userdata('user_name');
		$user_type=$this->session->userdata('user_type');
	 	if($user_type==2)
		{
		 		$user_id=$this->input->post('user_id');
				//echo $user_id;exit;

						$name=$this->input->post('name');
						$oldpassword=md5($this->input->post('oldpassword'));
						$newpassword=md5($this->input->post('newpassword'));

						 $user_password_old=$this->input->post('user_password_old');

						$res=$this->teacherprofilemodel->updateprofile($user_id,$oldpassword,$newpassword);

						if($res['status']=="success"){
						 $this->session->set_flashdata('msg', 'Update Successfully');
						  redirect('teacherprofile/profile');

					      }else{
					 	        $this->session->set_flashdata('msg', 'Failed to update');
								 redirect('teacherprofile/profile');
					          }

	 }
	 else{
			redirect('/');
	 }
  }

	public function logout(){
		$datas=$this->session->userdata();
		$this->session->unset_userdata($datas);
		$this->session->sess_destroy();
		redirect('/');
	}






}
