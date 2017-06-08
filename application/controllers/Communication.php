<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Communication extends CI_Controller
{
      function __construct()
      {
      parent::__construct();
      $this->load->model('communicationmodel');
      $this->load->model('subjectmodel');
      $this->load->model('class_manage');
      $this->load->helper('url');
      $this->load->library('session');
      }
      public function add_communication()
      {
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('user_id');
      $datas['teacher']=$this->communicationmodel->get_teachers();
      $datas['getall_class']=$this->class_manage->getall_class();
      $user_type=$this->session->userdata('user_type');
      if($user_type==1)
      {
      $this->load->view('header');
      $this->load->view('communication/add',$datas);
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
      $teacher_name=$this->input->post('teacher');
      //$teacher = implode(',',$teacher_name);
      $clas=$this->input->post('class_name');
     // $class_name = implode(',',$clas);
     
      if($teacher_name=='')
		{
			 $teacher ="null";
		}else{
			$teacher = implode(',',$teacher_name);
		}
		if($clas=='')
		{
			 $class_name ="null";
		}else{
			 $class_name = implode(',',$clas);
		}
     
      $title=$this->input->post('title');
      $date=$this->input->post('date');
      $dateTime = new DateTime($date);
      $formatted_date=date_format($dateTime,'Y-m-d' );
      $notes=$this->input->post('notes');
      $datas=$this->communicationmodel->communication_create($title,$notes,$formatted_date,$teacher,$class_name);
      if($datas['status']=="success")
      {
      $this->session->set_flashdata('msg', 'Added Successfully');
      redirect('communication/view');
      }
      else{
      $this->session->set_flashdata('msg', 'Failed to Add');
      redirect('communication/view');
      }
      }
      }
          public function view()
          {
          $datas=$this->session->userdata();
          $user_id=$this->session->userdata('user_id');
          $datas['result']=$this->communicationmodel->view();
          $class_id=$this->communicationmodel->get_class_id($user_id);
          //echo $class_id;
          // exit;
          $cls_id['result']=$this->communicationmodel->get_class_name($class_id);
          // print_r($cls_id['result']);
          // exit;
          $user_type=$this->session->userdata('user_type');
          if($user_type==1)
          {
          $this->load->view('header');
          $this->load->view('communication/view',$datas);
          $this->load->view('footer');
          }
          else{
          redirect('/');
          }
          }
          public function edit_commu($commu_id)
          {
			  $datas=$this->session->userdata();
			  $user_id=$this->session->userdata('user_id');
			  $datas['teacher']=$this->communicationmodel->get_teachers();
			  $datas['getall_class']=$this->class_manage->getall_class();
			  $datas['res']=$this->communicationmodel->edit_data($commu_id);
			  $user_type=$this->session->userdata('user_type');
			  if($user_type==1)
			  {
			  $this->load->view('header');
			  $this->load->view('communication/edit',$datas);
			  $this->load->view('footer');
			  }
			  else{
			  redirect('/');
			  }
          }
          public function update()
          {
			  $datas=$this->session->userdata();
			  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  if($user_type==1)
			  {
			  $id=$this->input->post('comid');
			 // $teacher_name=$this->input->post('teacher');
			  //$teacher = implode(',',$teacher_name);
			 // $clas=$this->input->post('class_name');
			  //$class_name = implode(',',$clas);
			   $teacher_name=$this->input->post('teacher');
		      //$teacher = implode(',',$teacher_name);
		      $clas=$this->input->post('class_name');
		     // $class_name = implode(',',$clas);
		 
		  if($teacher_name=='')
			{
				 $teacher ="null";
			}else{
				$teacher = implode(',',$teacher_name);
			}
			if($clas=='')
			{
				 $class_name ="null";
			}else{
				 $class_name = implode(',',$clas);
			}
		 
			  $title=$this->input->post('title');

			  $date=$this->input->post('date');
			  $dateTime = new DateTime($date);
			  $formatted_date=date_format($dateTime,'Y-m-d' );

			  $notes=$this->input->post('notes');
			  $datas=$this->communicationmodel->communication_update($id,$title,$notes,$formatted_date,$teacher,$class_name);
			  if($datas['status']=="success")
			  {
			  $this->session->set_flashdata('msg','Updated Successfully');
			  redirect('communication/view');
			  }
			  else{
			  $this->session->set_flashdata('msg','Failed To Updated');
			  redirect('communication/view');
			  }
			  }
          }
		  public function view_user_leaves()
		  {
			  $datas=$this->session->userdata();
              $user_id=$this->session->userdata('user_id');
			  $datas['result']=$this->communicationmodel->user_leaves();
			  $user_type=$this->session->userdata('user_type');
			 //print_r($datas['result']);exit;
			  if($user_type==1)
                {
				  $this->load->view('header');
				  $this->load->view('communication/users_leave',$datas);
				  $this->load->view('footer');
				 }else{
				  redirect('/');
				  }
			   
		  }
		  public function user_leave_approval($leave_id)
		   {
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['res']=$this->communicationmodel->edit_leave($leave_id);
			//print_r($datas['res']);exit;
			 if($user_type==1){
	 		 $this->load->view('header');
			 $this->load->view('communication/user_leave_approval',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
			
		 }
		
		public function update_status()
		{
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			//$leave_type=$this->input->post('leave_type');
			//$leave_date=$this->input->post('leave_date');
			//$frm_time=$this->input->post('frm_time');
			//$to_time=$this->input->post('to_time');
			//$leave_description=$this->input->post('leave_description');
			 $leave_id=$this->input->post('leave_id');
			 $status=$this->input->post('status');

			 //$dateTime = new DateTime($leave_date);
             //$formatted_date=date_format($dateTime,'Y-m-d' );
			 
			 $datas=$this->communicationmodel->update_leave($leave_id,$status);
			 $datas['result']=$this->communicationmodel->user_leaves();
			 //print_r($datas);exit;
			
			 if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Updated Successfully');
                $this->load->view('header');
				$this->load->view('communication/users_leave',$datas);
				$this->load->view('footer');
			  }else{
			    $this->session->set_flashdata('msg','Falid To Updated');
                $this->load->view('header');
				$this->load->view('communication/users_leave',$datas);
				$this->load->view('footer');	  
			  }
			
		}


		public function add_substitution($leave_id)
		{
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		
			$datas=$this->communicationmodel->get_all_class_list($leave_id);
			$datas['teachers']=$this->communicationmodel->get_all_teachers_list();
			$datas['view']=$this->communicationmodel->get_all_view_list($leave_id);
			//print_r($datas['view']);exit;
		    //print_r($datas['res']);exit;
			 if($user_type==1){
	 		 $this->load->view('header');
			 $this->load->view('communication/add_substitution',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
		}
		
		public function create_substition()
		{
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			$cls_id=$this->input->post('sub_cls');
			$teacher_id=$this->input->post('teacher_id');
			$ldate=$this->input->post('leave_date');
			$leave_id=$this->input->post('leave_id');
			
			$dateTime = new DateTime($ldate);
            $leave_date=date_format($dateTime,'Y-m-d' );
	  
			$sub_teacher=$this->input->post('sub_teacher');
			$period_id=$this->input->post('period_id');
			$status=$this->input->post('status');
			//echo $sub_teacher;
			$datas=$this->communicationmodel->add_substitution_list($cls_id,$teacher_id,$leave_date,$sub_teacher,$period_id,$leave_id,$status);
			$datas=$this->communicationmodel->get_all_class_list($leave_id);
			$datas['teachers']=$this->communicationmodel->get_all_teachers_list();
			$datas['view']=$this->communicationmodel->get_all_view_list($leave_id);
			
			if($datas['status']=="success")
			{
				 $this->session->set_flashdata('msg','Added Successfully');
				 $this->load->view('header');
				 $this->load->view('communication/add_substitution',$datas);
				 $this->load->view('footer');
			  }else{
			    $this->session->set_flashdata('msg','Falid To Add');
				$this->load->view('header');
			    $this->load->view('communication/add_substitution',$datas);
	 		    $this->load->view('footer');
			  }
		}
		
		public function sub_edit()
		{
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			$id=$this->input->get('var');
			$teacher_id=$this->input->get('var1');
			//echo $teacher_id;exit;
			$datas=$this->communicationmodel->get_all_class_list1($teacher_id);
			$datas['result']=$this->communicationmodel->edit_substitution_list($id);
			//$datas['view']=$this->communicationmodel->get_all_view_list1($teacher_id);
			//print_r($datas['result']);exit;
			$this->load->view('header');
			$this->load->view('communication/edit_substitution',$datas);
	 		$this->load->view('footer');
			
			
		}
		public function update_substition()
		{
			
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			$cls_id=$this->input->post('sub_cls');
			$teacher_id=$this->input->post('teacher_id');
			$ldate=$this->input->post('leave_date');
			$id=$this->input->post('id');
			$leave_id=$this->input->post('lid');
			
			$dateTime = new DateTime($ldate);
            $leave_date=date_format($dateTime,'Y-m-d' );
	  
			$sub_teacher=$this->input->post('sub_teacher');
			$period_id=$this->input->post('period_id');
			$status=$this->input->post('status');
			//echo $sub_teacher;
			$datas=$this->communicationmodel->update_substitution_list($cls_id,$teacher_id,$leave_date,$sub_teacher,$period_id,$id,$status);
			//print_r($datas);exit;
			$datas=$this->communicationmodel->get_all_class_list($leave_id);
			$datas['teachers']=$this->communicationmodel->get_all_teachers_list();
			$datas['view']=$this->communicationmodel->get_all_view_list($leave_id);
			
			if($datas['status']=="success")
			{
				 $this->session->set_flashdata('msg','Updated Successfully');
				 $this->load->view('header');
				 $this->load->view('communication/add_substitution',$datas);
				 $this->load->view('footer');
			  }else{
			    $this->session->set_flashdata('msg','Falid To Update');
				$this->load->view('header');
			    $this->load->view('communication/add_substitution',$datas);
	 		    $this->load->view('footer');
			  }
			
		}
		
}
