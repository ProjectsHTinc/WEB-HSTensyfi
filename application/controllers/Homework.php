<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homework extends CI_Controller
 {


	function __construct()
	{
		 parent::__construct();
		  $this->load->model('homeworkmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('class_manage');
		  $this->load->model('subjectmodel');
		
        }
         
       
	public function home()
	 {
	 		 $datas=$this->session->userdata();
  	 		 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas=$this->homeworkmodel->get_teacher_id($user_id);
			 $datas['result']=$this->homeworkmodel->getall_details($user_id);
			 $datas['ayear']=$this->homeworkmodel->get_acdaemicyear();
			 //echo'<pre>';
	         //print_r($datas['result']);exit;
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/homework/add',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}
		
		public function add_mark($hw_id)
		{
			  
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['result'] = $this->homeworkmodel->get_stu_details($hw_id);
				//print_r($datas['result']);exit;
			    if($user_type==2)
			      {
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/homework/add_test',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				  }
	 		   else{
	 				redirect('/');
	 		 }
			
		} 
		
	  public function marks()
		{
			
			$enroll=$this->input->post('enroll');
			$hwid=$this->input->post('hwid');
			$marks=$this->input->post('marks');
			//print_r($enroll);exit;
			$remarks=$this->input->post('remarks');
			$datas = $this->homeworkmodel->enter_marks($enroll,$hwid,$marks,$remarks);
			  if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('homework/home',$datas);  
			  }else{
			   $this->session->set_flashdata('msg','Falid To Added');
                redirect('homework/home',$datas);	  
			  }
			
			
			
		}
	 public function create()
		{ 
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			//echo $user_id;exit;
			$test_type=$this->input->post('test_type');
			
			//echo $test_type;
			//exit;
			
			$year_id=$this->input->post('year_id');
			
			$class_id=$this->input->post('class_id');
			$title=$this->input->post('title');
			$subject_name=$this->input->post('subject_name');
			//echo $subject_name;exit;
			$tet_date=$this->input->post('tet_date');
			
			$dateTime = new DateTime($tet_date);
			$formatted_date=date_format($dateTime,'Y-m-d' );
             
             
            $submission_date=$this->input->post('sub_date');
			$dateTime = new DateTime($submission_date);
			$format_date=date_format($dateTime,'Y-m-d' );
			

			$details=$this->db->escape_str($this->input->post('details'));
		    $datas=$this->homeworkmodel->create_test($year_id,$class_id,$user_id,$test_type,$title,$subject_name,$formatted_date,$format_date,$details); 
		    
		    
		
			// echo'<pre>';
			// print_r($datas["res"]);
			// echo'</pre>'; 
			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('homework/home',$datas);
			   //redirect('add_test');		
			}else{
				$this->session->set_flashdata('msg','Falid To Added');
                redirect('homework/home',$datas);
			}
	 		 
	 	} 
		
		public function checker()
		{
			$classid=$this->input->post('id');
		    $data=$this->class_manage->get_subject($classid);
			echo json_encode($data);
		}
		
		
		public function edit_mark($hw_id)
		{
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['result']=$this->homeworkmodel->edit_details($hw_id);
				$datas['resubject'] = $this->subjectmodel->getsubject();
			    if($user_type==2)
			      {
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/homework/edit_marks',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				  }
	 		   else{
	 				redirect('/');
	 		 }
		}
	
       public function update()
	   {
		    $enroll=$this->input->post('enroll');
			$hwid=$this->input->post('hwid');
			$marks=$this->input->post('marks');
			//print_r($enroll);exit;
			$remarks=$this->input->post('remarks');
			$datas = $this->homeworkmodel->update_marks($enroll,$hwid,$marks,$remarks);
			  if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Update Successfully');
                redirect('homework/home',$datas);  
			  }else{
			   $this->session->set_flashdata('msg','Falid To Update');
                redirect('homework/home',$datas);	  
			  }
			
		   
	   }
	   
	   public function edit_test($hw_id)
	   {
		        $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['result']=$this->homeworkmodel->edit_test_details($hw_id);
				
				//print_r($datas['status']);exit;
				
			    if($user_type==2)
			      {
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/homework/edit_test',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				  }
	 		   else{
	 				redirect('/');
	 		 }
	   }
	   
	   public function update_test()
	   {
		    $test_details=$this->db->escape_str($this->input->post('test_details'));
		    $id=$this->input->post('id');
		    $hw_type=$this->input->post('hw_type');
			$title=$this->input->post('title');
			$test_date=$this->input->post('test_date');
			
			$dateTime = new DateTime($test_date);
			$formatted_date=date_format($dateTime,'Y-m-d' );
			$status=$this->input->post('status');
			
			$datas= $this->homeworkmodel->update_test_details($id,$hw_type,$title,$formatted_date,$test_details,$status);
			  if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Update Successfully');
                redirect('homework/home',$datas);  
			  }else{
			   $this->session->set_flashdata('msg','Falid To Update');
                redirect('homework/home',$datas);	  
			  }
	   }
	
	
	
	
	
	
	
	
	
	
	
 }