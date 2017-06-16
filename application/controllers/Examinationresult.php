<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examinationresult extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('examinationresultmodel');
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
			if($user_type==2)
			{
			$datas['result']=$this->examinationresultmodel->get_teacher_id($user_id);
			$this->load->view('adminteacher/teacher_header');
			$this->load->view('adminteacher/examination_result/add',$datas);
			$this->load->view('adminteacher/teacher_footer');
			}else{
			redirect('/');
			}
	 }
		
		/* public function internal_external_marks()
		{
			
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			    if($user_type==2)
				 {
					 $datas['result']=$this->examinationresultmodel->get_teacher_id($user_id);
					 //echo '<pre>';print_r($datas['result']);exit;
					 //$datas['result'] = $this->examinationresultmodel->getall_details();
					 //print_r($datas);
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/examination_result/exam_name',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				 }else{
						redirect('/');
				 }
				 
		} */
		
		public function class_section()
		{
			    $exam_id=$this->input->get('var');
			    $exam_year=$this->input->post('$exam_year');
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			    if($user_type==2)
			    {
			     $datas=$this->examinationresultmodel->getall_cls_sec($user_id);
				 $datas['result']=$this->examinationresultmodel->getall_exam_details($exam_id);
				 //echo '<pre>'; print_r($datas['cls_id']);echo '</pre>'; exit;
			     $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/cls_sec',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				 }
				 else{
						redirect('/');
				 }
		}
		
		public function exam_mark_details()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  $cls_masid=$this->input->get('var1');
			  $exam_id=$this->input->get('var2');
			  //echo $cls_masid;echo $exam_id;exit;

			 //$datas['sub']=$this->examinationresultmodel->getall_subname($user_id,$cls_masid,$exam_id);
			  $datas['cla_tea_id']=$this->examinationresultmodel->get_cls_teacher_id($user_id);
			  $datas['stu']=$this->examinationresultmodel->getall_stuname($user_id,$cls_masid,$exam_id);
			  $datas['result']=$this->examinationresultmodel->getall_exam_details($exam_id);
			  $datas['res']=$this->examinationresultmodel->getall_cls_sec_stu($user_id,$cls_masid,$exam_id);
			  $datas['mark']=$this->examinationresultmodel->getall_marks($user_id,$cls_masid,$exam_id);
			  //echo '<pre>';print_r($datas['result']); exit;
			  //echo '<pre>';print_r($datas['stu']); exit;
			
			 if($user_type==2)
			    { 
				 $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/marks',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				}else{
					 redirect('/');
				}

		}
		
		public function exam_mark_details_cls_teacher()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');

			  $cls_masid=$this->input->get('var1');
			  $exam_id=$this->input->get('var2');
			  //echo $cls_masid;echo $exam_id;exit;
			  
			  $datas=$this->examinationresultmodel->getall_subname($user_id,$cls_masid,$exam_id);
			  $datas['stu']=$this->examinationresultmodel->getall_stuname($user_id,$cls_masid,$exam_id);
			  $datas['result']=$this->examinationresultmodel->getall_exam_details($exam_id);
			  $datas['marks1']=$this->examinationresultmodel->getall_marks_details1($user_id,$cls_masid);
			  $datas['smark']=$this->examinationresultmodel->marks_status_details($cls_masid,$exam_id);
			  //print_r($datas['smark']);exit;
			  //echo '<pre>';print_r($datas);
			  //echo '<pre>';print_r($datas['stu']); exit;
			
			 if($user_type==2)
			    { 
				 $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/class_marks',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				}else{
					 redirect('/');
				}

		}
		
		
		public function checker()
		{
			$classid=$this->input->post('id');
		    $data=$this->class_manage->get_subject($classid);
			echo json_encode($data);
		}
		
		public function marks_details()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  
			  $exam_id=$this->input->post('examid');
			  $clsmastid=$this->input->post('clsmastid');
			  $subid=$this->input->post('subjectid');
			  $sutid=$this->input->post('sutid');
			  $teaid=$this->input->post('teaid');
			  $internal_marks=$this->input->post('internal_marks');
			  $external_marks=$this->input->post('external_marks');
			  
			 /*echo $exam_id;echo'</br>';
			  print_r($internal_marks);echo'</br>';
			  print_r($external_marks);echo'</br>';//exit;
			  echo $teaid;echo'</br>';
			  print_r($sutid);echo'</br>';
			  exit;*/
			
		    $datas=$this->examinationresultmodel->exam_marks_details($exam_id,$subid,$sutid,$clsmastid,$teaid,$internal_marks,$external_marks,$user_id);
		   //print_r($datas);exit;
			 if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('examinationresult/view_exam_name_marks',$datas);
			   //redirect('add_test');		
			  }else{
				$this->session->set_flashdata('msg','Falid To Added');
                redirect('examinationresult/view_exam_name_marks',$datas);
			}
		}
		
		public function ajaxmarkinsert()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  
			  $exam_id=$this->input->post('examid');
			  $clsmastid=$this->input->post('clsid');
			  $subid=$this->input->post('suid');
			  $sutid=$this->input->post('stuid');
			  $teaid=$this->input->post('teid');
			  $marks=$this->input->post('mark');
			  
			/* echo $exam_id;echo'</br>';
			  echo $subid;echo'</br>';
			  echo $teaid;echo'</br>';
			  echo $sutid;echo'</br>';
			  echo $marks;echo'</br>'; */
			 // exit; 
			 $datas=$this->examinationresultmodel->add_marks_detail_ajax($exam_id,$subid,$sutid,$clsmastid,$teaid,$marks);
			 //print_r($datas);
			 if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('examinationresult/exam_mark_details',$datas);
			   //redirect('add_test');		
			  }else{
				$this->session->set_flashdata('msg','Falid To Added');
                redirect('examinationresult/exam_mark_details',$datas);
			}  
		}
		
		public function view_exam_name_marks()
		{
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			    if($user_type==2)
				 {
					 $datas['result']=$this->examinationresultmodel->get_teacher_id($user_id);
					 //echo '<pre>';print_r($datas['result']);exit;
					 //$datas['result'] = $this->examinationresultmodel->getall_details();
					 //print_r($datas);
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/examination_result/view_exam_marks',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				 }else{
						redirect('/');
				 }
		}
		
		
		public function marks_details_view()
		{
			$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			$exam_id=$this->input->get('var');
			//echo $exam_id;exit;
			$datas['marks']=$this->examinationresultmodel->getall_marks_details($user_id,$exam_id);
			//echo '<pre>';print_r($datas['marks']);
			if($user_type==2)
			    { 
				 $this->load->view('adminteacher/teacher_header');
			     $this->load->view('adminteacher/examination_result/view',$datas);
	 		     $this->load->view('adminteacher/teacher_footer');
				}else{
					 redirect('/');
				}
			
		}
		
		public function exam_mark_edit_details()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
				
			  $subid=$this->input->get('var1');
			  $clsmasid=$this->input->get('var2');
			  $exam_id=$this->input->get('var3');
			  
			  //echo $subid;echo $clsmasid;
			  $datas['edit']=$this->examinationresultmodel->edit_marks_details($user_id,$subid,$clsmasid,$exam_id);
			  $datas['mark']=$this->examinationresultmodel->marks_status_details($clsmasid,$exam_id);
			  //echo '<pre>';print_r($datas['mark']);exit;
			if($user_type==2)
			    { 
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/examination_result/edit_mark',$datas);
					 $this->load->view('adminteacher/teacher_footer');
		       }else{
					 redirect('/');
		            }
		}
		
		public function update_marks_details()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  
			  $exam_id=$this->input->post('examid');
			  $clsmastid=$this->input->post('clsmastid');
			  $subid=$this->input->post('subid');
			  $sutid=$this->input->post('sutid');
			 // print_r($sutid);exit;
			  $teaid=$this->input->post('teaid');
			  $internal_marks=$this->input->post('internal_marks');
			  $external_marks=$this->input->post('external_marks');
			  //echo $exam_id;echo $subid;print_r($sutid);echo $teaid;print_r($marks);exit;
			  $datas=$this->examinationresultmodel->update_marks_details($teaid,$clsmastid,$exam_id,$subid,$internal_marks,$external_marks,$sutid,$user_id);
			 // print_r($datas);exit;
			  if($datas['status']="success")
			  {
				$this->session->set_flashdata('msg','Updated Successfully');
                redirect('examinationresult/view_exam_name_marks',$datas);
			   //redirect('add_test');		
			  }else{
				$this->session->set_flashdata('msg','Falid To Updated');
                redirect('examinationresult/view_exam_name_marks',$datas);
			}
		}
		
		public function marks_status()
		{
			  $datas=$this->session->userdata();
  	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  
			  $exam_id=$this->input->post('examid');
			  $clsmastid=$this->input->post('clsmastid');
			  //echo $exam_id;echo $clsmastid;//exit;
			  $datas=$this->examinationresultmodel->marks_status_update($exam_id,$clsmastid,$user_id);
			 
			   if($datas['status']=="success")
			   { 
		        $a=$datas['var1']; $b=$datas['var2'];//exit;
				$this->session->set_flashdata('msg','Approved Successfully');
                redirect('examinationresult/exam_mark_details_cls_teacher?var1='.$b.'&var2='.$a.'',$datas);
			   //redirect('add_test');		
			   }elseif($datas['status']=="Already Added Exam Marks")
		        { 
				  $a=$datas['var1']; $b=$datas['var2'];
				  $this->session->set_flashdata('msg','Already Added Exam Marks');
				  redirect('examinationresult/exam_mark_details_cls_teacher?var1='.$b.'&var2='.$a.'',$datas);  
			   }else{$a=$datas['var1']; $b=$datas['var2'];
				$this->session->set_flashdata('msg','Falid To Approve');
                redirect('examinationresult/exam_mark_details_cls_teacher?var1='.$b.'&var2='.$a.'',$datas);
			}
			  
		}
		
		public function exam_duty()
		{
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
		  $user_type=$this->session->userdata('user_type');
		  $datas['duty']=$this->examinationresultmodel->exam_duty_details($user_id);
		 // print_r($datas);exit;
		  if($user_type==2)
			{ 
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/examination_result/exam_duty',$datas);
				 $this->load->view('adminteacher/teacher_footer');
			}else{
				 redirect('/');
				}
		
		}
		
 }