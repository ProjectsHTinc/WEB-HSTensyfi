<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('promotionmodel');
			$this->load->model('teachermodel');
			$this->load->model('groupingmodel');

			$this->load->model('class_manage');
		  $this->load->helper('url');
		  $this->load->library('session');
			$this->load->library('encrypt');


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
			
			$datas['res_class']=$this->groupingmodel->get_all_classes_for_year();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('promotion/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}



		public function create_group(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$group_title=$this->input->post('group_title');
				$group_lead=$this->input->post('group_lead');
				$status=$this->input->post('status');
				$data=$this->groupingmodel->create_group($group_title,$group_lead,$status,$user_id);
				if($data['status']=="success"){
					echo "success";
				}else if($data['status']=="Already"){
					echo "Already Exist";
				}else{
					echo "Something Went Wrong";
				}
			}else{
					redirect('/');
			}
		}










}
