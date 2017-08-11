<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminattendance extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('adminattendancemodel');
			$this->load->model('class_manage');
		  $this->load->helper('url');
			$this->load->library('encryption');
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
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
				 		$datas['res']=$this->adminattendancemodel->get_all_class();
					  $this->load->view('header');
					  $this->load->view('attendance/viewattendance',$datas);
					  $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		public function monthclass(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
						$datas['res']=$this->adminattendancemodel->get_all_class();
						$this->load->view('header');
						$this->load->view('attendance/monthclass',$datas);
						$this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}



		public function month_view_class($class_id){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
						$datas['result']=$this->adminattendancemodel->get_month_class($class_id);
						$datas['result_month']=$this->adminattendancemodel->get_year_class($class_id);
						$datas['get_name_class']=$this->class_manage->edit_cs($class_id);
						$datas['class_id']=$class_id;
						$this->load->view('header');
						$this->load->view('attendance/month_for_class',$datas);
						$this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}



				public function get_month_class(){
						$datas=$this->session->userdata();
						$user_id=$this->session->userdata('user_id');
						$user_type=$this->session->userdata('user_type');
					 if($user_type==1){
							 $class_master_id=$this->input->post('class_master_id');
							 $month_id=$this->input->post('month_id');
							 $year_class=$this->input->post('year_class');
							 $query_date = $year_class.'-'.$month_id.'-'.'01';
				       $first= date('Y-m-01', strtotime($query_date));
						   $last= date('Y-m-t', strtotime($query_date));
							 $datas['month']=$month_id;
							 $datas['year']=$year_class;
						 	 $datas['res']=$this->adminattendancemodel->get_monthview_class($first,$last,$class_master_id);
							 	 $datas['res_total']=$this->adminattendancemodel->get_total_working_days($first,$last,$class_master_id);
								 print_r($datas['res_total']);exit;
							 $datas['get_name_class']=$this->class_manage->edit_cs($class_master_id);
								$this->load->view('header');
								$this->load->view('attendance/month_view_for_class',$datas);
								$this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
				}


				public function view_dates_id(){
					$datas=$this->session->userdata();
					$user_id=$this->session->userdata('user_id');
					$user_type=$this->session->userdata('user_type');
				 if($user_type==1){
					 $month_id=$this->input->post('month_id');
					 $year_id=$this->input->post('year_id');
					 $student_id=$this->input->post('student_id');
					 $datas['result']=$this->adminattendancemodel->get_leave_dates($student_id,$month_id,$year_id);
					 echo json_encode($datas['result']);
				 }
				 else{
						redirect('/');
				 }
				}


		public function daywise($class_id){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
				$datas['get_name_class']=$this->class_manage->edit_cs($class_id);
			 	$datas['result']=$this->adminattendancemodel->get_class_list($class_id);
				$this->load->view('header');
				$this->load->view('attendance/classattendance',$datas);
				$this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}



		public function view_all($at_id,$class_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
				$datas['result']=$this->adminattendancemodel->get_list_record($at_id,$class_id);
				$datas['get_name_class']=$this->class_manage->edit_cs($class_id);
				$this->load->view('header');
				$this->load->view('attendance/class_view_attendance',$datas);
				$this->load->view('footer');
			 }else{

			 }
		}


























}
