<?php

Class Mailmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct(); 

  }

  function send_circular_via_mail($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id)
  {
	   
	   $user_type=$users_id;
	   
	  //-----------Admin------------------------
	  if(!empty($user_type))
	   {  
        // echo $user_type; echo $title; echo $notes;exit;
		 switch($user_type)
		 {
			 
			case '2': 
			       
				      $tsql="SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone,t.email FROM edu_users AS u,edu_teachers AS t  WHERE u.user_type='$user_type' AND u.user_master_id=t.teacher_id AND u.status='Active'";
					$res=$this->db->query($tsql);
					$result1=$res->result();
					foreach($result1 as $rows)
					{ $tmail[]=$rows->email;}
					
				     $mail_to=implode(',',$tmail);
					echo $to=$mail_to;
					 
					 $subject=$title;
					 $cnotes=$notes;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						 <center><p>'.$cnotes.'</p></center>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);

              exit;
            break;

			 case '3': 
			        
					$ssql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,a.admission_id,a.name,a.mobile,a.email FROM edu_users AS u,edu_admission AS a  WHERE u.user_type='$user_type' AND u.user_master_id=a.admission_id AND u.name=a.name AND u.status='Active'";
					$res2=$this->db->query($ssql);
					$result2=$res2->result();
					foreach($result2 as $rows1)
					{}
					 $smail=$rows1->email;
					  $to = $smail;
					 $subject=$title;
					 $cnotes=$notes;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						 <center><p>'.$cnotes.'</p></center>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);
				  if($sent){
					 echo "Send";
				 }else{
				   echo "Somthing Went Wrong";
				 } 
              //exit;
            break;
			
			case '4': 
			        
					$psql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,p.parent_id,p.mobile,p.email FROM edu_users AS u,edu_parents AS p WHERE u.user_type='$users_id' AND u.user_master_id=p.parent_id AND u.status='Active'";
					$pres2=$this->db->query($psql);
					$presult2=$pres2->result();
					foreach($presult2 as $prows1)
					{}
					 $pmail=$prows1->email;
					  $to = $pmail;
					 $subject=$title;
					 $cnotes=$notes;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						 <center><p>'.$cnotes.'</p></center>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);
				  if($sent){
					 echo "Send";
				 }else{
				   echo "Somthing Went Wrong";
				 } 
             // exit;
            break;
			default:
            echo "No result found";
            break;
				
		 }//Switch	close		
		   
	   }//admin close
	  
  }//function close
  
  
  
  
  
  
  
}//end class
  ?>