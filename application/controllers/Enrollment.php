<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('admissionmodel');
			$this->load->model('yearsmodel');
			$this->load->model('classmodel');
			$this->load->model('sectionmodel');
			$this->load->model('class_manage');
			$this->load->model('enrollmentmodel');
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


	 	public function home(){
	 		$datas=$this->session->userdata();
	 		 $user_id=$this->session->userdata('user_id');
			 $datas['result'] = $this->yearsmodel->getall_years();

			$datas['admisn'] = $this->admissionmodel->get_all_admission();
	 		$datas['clas'] = $this->classmodel->getclass();
			$datas['sec'] = $this->sectionmodel->getsection();
			$datas['getall_class']=$this->class_manage->getall_class();
			$datas['admisno']=$this->admissionmodel->get_enrollment_admisno();
			$datas['years']=$this->enrollmentmodel->get_current_years();
			//print_r($datas['years']);exit;
			
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('enrollment/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		public function add_enrollment($admisn_no)
		{
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['years'] = $this->yearsmodel->getall_years();

	 		$datas['clas'] = $this->classmodel->getclass();
			$datas['sec'] = $this->sectionmodel->getsection();
			$datas['getall_class']=$this->class_manage->getall_class();
            $datas['years']=$this->enrollmentmodel->get_current_years();
		    $datas['res']=$this->enrollmentmodel->add_enrollment($admisn_no);
            //print_r($datas['res']);exit;
			if($user_type==1)
			 {
	 		 $this->load->view('header');
	 		 $this->load->view('enrollment/add_enroll',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		public function create(){
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 //$datas['result'] = $this->classmodel->getclass();
			$user_type=$this->session->userdata('user_type');
		 if($user_type==1){
			 $admit_year=$this->input->post('year_id');

			 $admit_date=$this->input->post('admit_date');
	         $dateTime = new DateTime($admit_date);
			 $formatted_date=date_format($dateTime,'Y-m-d' );
			 
			 $admisn_no=$this->input->post('admisn_no');
			 $name=$this->input->post('name');
			 $class=$this->input->post('class_section');
			 $admission_id=$this->input->post('admission_id');
			 $status=$this->input->post('status');
			// $class_name = implode(',',$class);
			// $section=$this->input->post('section');
			 $datas=$this->enrollmentmodel->ad_enrollment($admission_id,$admit_year,$formatted_date,$admisn_no,$name,$class,$status);
			 if($datas['status']=="success"){
				 $this->session->set_flashdata('msg', 'Added Successfully');
				 redirect('enrollment/view');
			 }else if($datas['status']=="Admission Already Exist"){
				 $this->session->set_flashdata('msg', 'Admission Already Exist');
				 redirect('enrollment/home');
			 }else{
				 $this->session->set_flashdata('msg', 'Failed to Add');
				 redirect('enrollment/home');
			 }
			 }
			 else{
					redirect('/');
			 }
		}



// GET ALL ADMISSION DETAILS

		public function view(){
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $datas['result'] = $this->enrollmentmodel->get_all_enrollment();
		 $datas['year'] = $this->yearsmodel->admisn_year();
			//echo "<pre>";print_r(	$datas['result']);exit;
			$user_type=$this->session->userdata('user_type');
 		 if($user_type==1){
		 $this->load->view('header');
		 $this->load->view('enrollment/view',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
		}



		public function edit_enroll($admisn_no){
			//$datas['clas'] = $this->classmodel->getclass();
			//$datas['sec'] = $this->sectionmodel->getsection();
			$datas['res']=$this->enrollmentmodel->get_enrollmentid($admisn_no);
			//print_r($datas['res']);exit;
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			$this->load->view('header');
 		 	$this->load->view('enrollment/edit',$datas);
 		 	$this->load->view('footer');
		}else{
				redirect('/');
		}
	}


		public function save(){
			$datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			//$datas['result'] = $this->classmodel->getclass();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			 $admit_year=$this->input->post('admit_year');
			  $admit_date=$this->input->post('admit_date');
			  $dateTime = new DateTime($admit_date);
			  $formatted_date=date_format($dateTime,'Y-m-d' );
			 $enroll_id=$this->input->post('enroll_id');
			 $admission_id=$this->input->post('admission_id');
			 $admisn_no=$this->input->post('admisn_no');
			 $name=$this->input->post('name');
			 $class=$this->input->post('class_name');
			 //$section=$this->input->post('section');
			 $status=$this->input->post('status');
			 $datas=$this->enrollmentmodel->save_enrollment($admit_year,$formatted_date,$name,$class,$status,$enroll_id,$admisn_no,$admission_id);
			 if($datas['status']=="success"){
				 $this->session->set_flashdata('msg', 'Update Successfully');
				 redirect('enrollment/view');
			 }else{
				 $this->session->set_flashdata('msg', 'Failed to Update');
				 redirect('enrollment/view');
			 }
			 }
			 else{
					redirect('/');
			 }
		}

		public function de_enroll($enroll_id){
			$res=$this->enrollmentmodel->de_enroll($enroll_id);
			if($res['status']=="success"){
			 $this->session->set_flashdata('msg', 'Deleted Successfully');
			 redirect('enrollment/view');
		 }else{
			 $this->session->set_flashdata('msg', 'Failed to Deleted');
			 redirect('enrollment/view');
		 }
		}

		 public function checker()
		 {
			 $admisno = $this->input->post('admisno');
			 $resultset = $this->enrollmentmodel->getData($admisno);
			//print_r($datas['status']);
			 if($resultset!='')
			{
				echo $resultset;
			}
			else{
				echo "Admission Number Not Found";
			}

		 }

          public function checker1()
		   {
			 $admisno = $this->input->post('admisno');
			 $resultset = $this->enrollmentmodel->getData1($admisno);
			//print_r($datas['status']);
			if ($resultset > 0)
				     {
						echo "Already Enrollment Added";
					 }
					else
					 {
						echo "Add Enrollment";
					 }
		  }


}
