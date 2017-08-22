<?php

Class Mailmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }
  
  function send_mail_for_teacher_substitution($tname,$sub_teacher,$sub_tname,$leave_date,$cls_id,$period_id)
  {
	 
	$sql="SELECT teacher_id,name,email FROM edu_teachers WHERE teacher_id='$sub_teacher'";
	$resultset=$this->db->query($sql);
	$res=$resultset->result();
	foreach($res as $cell){}
	$email_id=$cell->email;
	
	$sql1="SELECT cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE cm.class_sec_id='$cls_id' AND cm.class=c.class_id AND cm.section=s.sec_id ";
	$resultset1=$this->db->query($sql1);
	$res1=$resultset1->result();
	foreach($res1 as $cls){}
	$cname=$cls->class_name;
	$sename=$cls->sec_name;
	
	$textmessage='This is to inform you that as '.$tname.' is on leave,'.$sub_tname.' will be the substitute teacher to fill in for '.$cname.'-'.$sename.',period ('.$period_id.') on '.$leave_date.' ';
	
		 $to=$email_id;
		 $subject="SUBSTITUTION";
		 $cnotes=$textmessage;
		 $htmlContent = '
			 <html>
			 <head><title></title>
			 </head>
			 <body>
			<p style="margin-left:50px;">'.$cnotes.'</p>
			 </body>
			 </html>';
	 $headers = "MIME-Version: 1.0" . "\r\n";
	 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	 // Additional headers
	 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
	 $sent= mail($to,$subject,$htmlContent,$headers);

  }

  function send_circular_via_mail($title,$notes,$cdate,$tusers_id,$stusers_id,$pusers_id,$users_id)
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
					 $to=$mail_to;

					 $subject=$title;
					 $cnotes=$notes.$cdate;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						<p style="margin-left:50px;">'.$cnotes.'</p>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);
              //exit;
            break;

			 case '3':

					$ssql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,a.admission_id,a.name,a.mobile,a.email FROM edu_users AS u,edu_admission AS a  WHERE u.user_type='$user_type' AND u.user_master_id=a.admission_id AND u.name=a.name AND u.status='Active'";
					$res2=$this->db->query($ssql);
					$result2=$res2->result();
					foreach($result2 as $rows1)
					{ $smail[]=$rows1->email;}

					 $smail_to=implode(',',$smail);
					 $to = $smail_to;
					 $subject=$title;
					  $cnotes=$notes.$cdate;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						 <p style="margin-left:50px;">'.$cnotes.'</p>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);

              //exit;
            break;

			case '4':

					$psql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,p.id,p.mobile,p.email FROM edu_users AS u,edu_parents AS p WHERE u.user_type='$users_id' AND u.user_master_id=p.id AND u.status='Active'";
					$pres2=$this->db->query($psql);
					$presult2=$pres2->result();
					foreach($presult2 as $prows1)
					{ $pmail[]=$prows1->email; }
					 $pmail_to=implode(',',$pmail);
					 $to = $pmail_to;
					 $subject=$title;
					 $cnotes=$notes.$cdate;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						 <p style="margin-left:50px;">'.$cnotes.'</p>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);
             // exit;
            break;

			default:
            echo "No result found";
            break;

		 }//Switch	close

	   }//admin close

	  //-----------------------------Teacher----------------------

			 if(!empty($tusers_id))
			 {
			     $countid=count($tusers_id);
			     //echo $countid;
				 for ($i=0;$i<$countid;$i++)
				 {
					$userid=$tusers_id[$i];

					$tesql="SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone,t.email FROM edu_users AS u,edu_teachers AS t WHERE u.user_id='$userid' AND u.user_type='2' AND u.user_master_id=t.teacher_id";
					$tmail=$this->db->query($tesql);
					$tres=$tmail->result();
					foreach($tres as $trow)
					{}
					 $temail=$trow->email;
                     $to=$temail;
					 $subject=$title;
					  $cnotes=$notes.$cdate;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						 <p style="margin-left:50px;">'.$cnotes.'</p>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);

                }

             }//teacher close


			  //-----------------------------Students----------------------

			  if(!empty($stusers_id))
			 {
			     $scountid=count($stusers_id);
			      //echo $scountid; exit;
				 for ($i=0;$i<$scountid;$i++)
				 {
				  $clsid=$stusers_id[$i];

				 $sql1="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.name,a.mobile,a.email FROM edu_enrollment AS e,edu_admission AS a WHERE e.class_id='$clsid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no ";
					$scell=$this->db->query($sql1);
					$res1=$scell->result();
					foreach($res1 as $row1)
					{
       				 $semail=$row1->email;
                     $to=$semail;
					 $subject=$title;
					 $cnotes=$notes.$cdate;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						 <p style="margin-left:50px;">'.$cnotes.'</p>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);
				}
              }

             }//Students close

	  //-----------------------------Parents----------------------

			 if(!empty($pusers_id))
		     {
			   $pcountid=count($pusers_id);
			  //echo $pcountid;exit;
			  for ($i=0;$i<$pcountid;$i++)
			  {
				 $classid=$pusers_id[$i];

				 $pgid="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id FROM edu_enrollment AS e WHERE e.class_id='$classid'";
					 $pcell=$this->db->query($pgid);
				     $res2=$pcell->result();
				     foreach($res2 as $row2)
				     {
					  $stuid=$row2->admission_id;
					  $class="SELECT p.id,p.admission_id,p.email,p.primary_flag FROM edu_parents AS p WHERE FIND_IN_SET('$stuid',admission_id) AND p.primary_flag='Yes'";
					  $pcell1=$this->db->query($class);
					  $res3=$pcell1->result();
					  foreach($res3 as $row3)
					   {
       				 $pmail=$row3->email;
                     $to=$pmail;
					 $subject=$title;
					 $cnotes=$notes.$cdate;
					 $htmlContent = '
						 <html>
						 <head><title></title>
						 </head>
						 <body>
						 <p style="margin-left:50px;">'.$cnotes.'</p>
						 </body>
						 </html>';
				 $headers = "MIME-Version: 1.0" . "\r\n";
				 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				 // Additional headers
				 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
				 $sent= mail($to,$subject,$htmlContent,$headers);
				}
              }
			  }
             }//Parents close

  }//function close

    // Group Mail
    function send_mail($group_id,$notes,$user_id){
       $sql1="SELECT egm.group_member_id,ep.email,ep.mobile FROM edu_grouping_members AS egm
      LEFT JOIN edu_users AS eu ON eu.user_id=egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id=eu.user_master_id
      LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id, ep.admission_id)
      WHERE  egm.group_title_id='$group_id'";
       $scell=$this->db->query($sql1);
       $res1=$scell->result();
       foreach($res1 as $row1)
       {
        $semail=$row1->email;
        $to=$semail;
        $subject="From KalaiMagal";

         $htmlContent = '
          <html>
          <head><title></title>
          </head>
          <body>
          <p style="margin-left:50px;">'.$notes.'</p>
          </body>
          </html>';
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // Additional headers
      $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
     $send= mail($to,$subject,$htmlContent,$headers);
     }
    }




}//end class
  ?>
