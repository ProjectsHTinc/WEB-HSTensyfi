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


		//
		public function month_view_class($class_id){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
						$datas['res']=$this->adminattendancemodel->get_month_class($class_id);
						echo $datas['class_id']=$class_id;
						exit;
						$this->load->view('header');
						$this->load->view('attendance/monthclass',$datas);
						$this->load->view('footer');
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
