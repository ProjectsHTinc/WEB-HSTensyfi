<?php

Class Mailmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

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

					$psql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,p.parent_id,p.mobile,p.email FROM edu_users AS u,edu_parents AS p WHERE u.user_type='$users_id' AND u.user_master_id=p.parent_id AND u.status='Active'";
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
				 $class="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.parnt_guardn_id,u.user_id,u.user_type,u.user_master_id,u.parent_id,u.status,p.parent_id,p.mobile,p.email FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u,edu_parents AS p WHERE e.class_id='$classid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=4 AND a.parnt_guardn_id=u.user_master_id AND a.parnt_guardn_id=u.parent_id AND p.parent_id=a.parnt_guardn_id AND u.status='Active' GROUP  BY u.user_id";
					$pemail=$this->db->query($class);
					$res2=$pemail->result();
					foreach($res2 as $row2)
					{
       				 $pmail=$row2->email;
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

             }//Parents close

  }//function close

    // Group Mail
    function send_mail($group_id,$notes,$user_id){
      $sql1="SELECT ee.admission_id,ep.parent_id,ep.mobile,ep.email,eu.user_id,en.gcm_key,egm.group_title_id FROM edu_enrollment AS ee LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ee.admission_id, ep.admission_id)
      LEFT JOIN edu_users AS eu ON eu.user_master_id=ep.parent_id AND eu.user_type='4' LEFT JOIN edu_notification AS en ON en.user_id=eu.user_id LEFT JOIN edu_grouping_members AS egm ON egm.group_member_id=ee.enroll_id
      WHERE   egm.group_title_id='$group_id'";
       $scell=$this->db->query($sql1);
       $res1=$scell->result();
       foreach($res1 as $row1)
       {
        $semail=$row1->email;
        $to=$semail;
        $subject="hii";

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
      mail($to,$subject,$htmlContent,$headers);
     }
    }




}//end class
  ?>
