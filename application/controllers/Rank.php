<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends CI_Controller
{


	function __construct()
	 {
		  parent::__construct();
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('rankmodel');
    }
         
	public function home()
	{
 		$datas=$this->session->userdata();
 		$user_id=$this->session->userdata('user_id');
 		$user_type=$this->session->userdata('user_type');

 		$datas['exam_view'] = $this->rankmodel->get_exam_details_view();
		//echo'<pre>';print_r($datas['exam_view']);exit;
		 if($user_type==1)
		 {
			 $this->load->view('header');
			 $this->load->view('rank/exam_name_list',$datas);
			 $this->load->view('footer');
 		 }
 		 else{
 				redirect('/');
 		 }
	}

	public  function class_name_list($exam_id)
	{
		$datas=$this->session->userdata();
 		$user_id=$this->session->userdata('user_id');
 		$user_type=$this->session->userdata('user_type');
       $datas['examid'] =$exam_id;
 		$datas['cls_view'] = $this->rankmodel->get_cls_details_view();
		
		 if($user_type==1)
		 {
			 $this->load->view('header');
			 $this->load->view('rank/class_list',$datas);
			 $this->load->view('footer');
 		 }
 		 else{
 				redirect('/');
 		 }
	}

	public function get_all_rank($cls_id,$examid)
	{
      $datas=$this->session->userdata();
 		$user_id=$this->session->userdata('user_id');
 		$user_type=$this->session->userdata('user_type');
 		//echo $cls_id;exit;
 		$datas['cls_rank'] = $this->rankmodel->get_rank_details_view($cls_id,$examid);
 		echo'<pre>';print_r($datas['cls_rank']);exit;
	}


}
?>