<?php
Class Smsmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }

  function send_sms_for_teacher_leave($number,$leave_type)
  {
	// http://173.45.76.227/send.aspx?username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS&numbers=12345&message=WELCOME
     //Thank you for the information. This is to inform you that your leave has been approved.

	 $textmessage='Thank you for the information This is to inform you that your '.$leave_type.' has been approved';

	 $textmsg =urlencode($textmessage);

	$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

	$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';

    $api_params = $api_element.'&numbers='.$number.'&message='.$textmsg;

	$smsgatewaydata = $smsGatewayUrl.$api_params;

	$url = $smsgatewaydata;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);
	curl_close($ch);

	if(!$output)
	{
      $output =  file_get_contents($smsgatewaydata);
    }

   /* if($return == '1')
   {
    return $output;
   }else{ echo "send"; } */

 }

 function send_sms_for_teacher_substitution($tname,$sub_teacher,$sub_tname,$leave_date)
{
	$sql="SELECT teacher_id,name,phone FROM edu_teachers WHERE teacher_id='$sub_teacher'";
	$resultset=$this->db->query($sql);
	$res=$resultset->result();
	foreach($res as $cell){}
	$num=$cell->phone;

	$textmessage='This is to inform you that as '.$tname.' is on leave, '.$sub_tname.' will be the substitute teacher to fill in for '.$leave_date.' day/s.';

	 $textmsg =urlencode($textmessage);

	$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

	$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';

    $api_params = $api_element.'&numbers='.$num.'&message='.$textmsg;

	$smsgatewaydata = $smsGatewayUrl.$api_params;

	$url = $smsgatewaydata;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);
	curl_close($ch);

	if(!$output)
	{
      $output =  file_get_contents($smsgatewaydata);
    }

   /* if($return == '1')
   {
    return $output;
   }else{ echo "send"; } */

}

  function send_circular_via_sms($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id)
  {
	 //-----------------------------Teacher----------------------
		   //echo'hi'; print_r($tusers_id);
			 if($tusers_id!='')
			 {
			     $countid=count($tusers_id);
			     //echo $countid;
				 for ($i=0;$i<$countid;$i++)
				 {
					$userid=$tusers_id[$i];
					$cnotes=$notes;
					$ctitle=$title;

					$sql="SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone FROM edu_users AS u,edu_teachers AS t WHERE u.user_id='$userid' AND u.user_type='2' AND u.user_master_id=t.teacher_id";
					$tcell=$this->db->query($sql);
					$res=$tcell->result();
					foreach($res as $row)
					{ } $number=$row->phone;

						$textmessage=$ctitle.$cnotes;

						$textmsg =urlencode($textmessage);

						$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

						$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';

						$api_params = $api_element.'&numbers='.$number.'&message='.$textmsg;

						$smsgatewaydata = $smsGatewayUrl.$api_params;

						$url = $smsgatewaydata;

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_POST, false);
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$output = curl_exec($ch);
						curl_close($ch);
                }
				/* if(!$output)
				{
				  $output =  file_get_contents($smsgatewaydata);
				} */
             }



			 //-----------------------------Students----------------------
		     //print_r($stusers_id);
			 if($stusers_id!='')
			 {
			     $scountid=count($stusers_id);
			      //echo $scountid; exit;
				 for ($i=0;$i<$scountid;$i++)
				 {
					$clsid=$stusers_id[$i];
					$cnotes=$notes;
					$ctitle=$title;

					 $sql1="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.name,a.mobile FROM edu_enrollment AS e,edu_admission AS a WHERE e.class_id='$clsid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no ";
					$scell=$this->db->query($sql1);
					$res1=$scell->result();
					foreach($res1 as $row1)
					{
       					$snumber=$row1->mobile;
					   //echo $snumber;exit;
						$textmessage=$ctitle.$cnotes;

						$textmsg =urlencode($textmessage);

						$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

						$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';

						$api_params = $api_element.'&numbers='.$snumber.'&message='.$textmsg;

						$smsgatewaydata = $smsGatewayUrl.$api_params;

						$url = $smsgatewaydata;

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_POST, false);
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$output = curl_exec($ch);
						curl_close($ch);
                  }
				 /*  if(!$output)
						{
						  $output =  file_get_contents($smsgatewaydata);
						} */
				}

             }

	 //-----------------------------Parents----------------------
		  //print_r($pusers_id);
		  if($pusers_id!='')
		  {
			 $pcountid=count($pusers_id);
			 //echo $pcountid;exit;
			 for ($i=0;$i<$pcountid;$i++)
			 {
				$classid=$pusers_id[$i];
				$cnotes=$notes;
				$ctitle=$title;

				 $class="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.parnt_guardn_id,u.user_id,u.user_type,u.user_master_id,u.parent_id,u.status,p.parent_id,p.mobile FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u,edu_parents AS p WHERE e.class_id='$classid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=4 AND a.parnt_guardn_id=u.user_master_id AND a.parnt_guardn_id=u.parent_id AND p.parent_id=a.parnt_guardn_id AND u.status='Active' GROUP  BY u.user_id";
				$pcell=$this->db->query($class);
				$res2=$pcell->result();
					foreach($res2 as $row2)
					{
       					$pnumber=$row2->mobile;
					   //echo $pnumber;exit;
						$textmessage=$ctitle.$cnotes;

						$textmsg =urlencode($textmessage);

						$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

						$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';

						$api_params = $api_element.'&numbers='.$pnumber.'&message='.$textmsg;

						$smsgatewaydata = $smsGatewayUrl.$api_params;

						$url = $smsgatewaydata;

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_POST, false);
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$output = curl_exec($ch);
						curl_close($ch);
                  }
				 /*  if(!$output)
						{
						  $output =  file_get_contents($smsgatewaydata);
						} */
				}
		  }


		  //------------------------------Admin-----------------------
			if($users_id!='')
			{
				//------------------------Teacher----------------------
				if($users_id==2)
				{
				 //echo $users_id;
				    $cnotes=$notes;
					$ctitle=$title;
					$tsql="SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone FROM edu_users AS u,edu_teachers AS t  WHERE u.user_type='$users_id' AND u.user_master_id=t.teacher_id AND u.status='Active'";
					$res=$this->db->query($tsql);
					$result1=$res->result();
					foreach($result1 as $rows)
					{
					   $tcell=$rows->phone;

					   //echo $tcell;exit;
						$textmessage=$ctitle.$cnotes;

						$textmsg =urlencode($textmessage);

						$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

						$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';

						$api_params = $api_element.'&numbers='.$tcell.'&message='.$textmsg;

						$smsgatewaydata = $smsGatewayUrl.$api_params;

						$url = $smsgatewaydata;

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_POST, false);
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$output = curl_exec($ch);
						curl_close($ch);
				  }
				}

				//---------------------------Students----------------------
				if($users_id==3)
				{
				   //echo $users_id;
				    $cnotes=$notes;
					$ctitle=$title;
					$ssql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,a.admission_id,a.name,a.mobile FROM edu_users AS u,edu_admission AS a  WHERE u.user_type='$users_id' AND u.user_master_id=a.admission_id AND u.name=a.name AND u.status='Active'";
					$res2=$this->db->query($ssql);
					$result2=$res2->result();
					foreach($result2 as $rows1)
					{
					   $scell=$rows1->mobile;

					   //echo $tcell;exit;
						$textmessage=$ctitle.$cnotes;

						$textmsg =urlencode($textmessage);

						$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

						$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';

						$api_params = $api_element.'&numbers='.$scell.'&message='.$textmsg;

						$smsgatewaydata = $smsGatewayUrl.$api_params;

						$url = $smsgatewaydata;

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_POST, false);
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$output = curl_exec($ch);
						curl_close($ch);

				}
				}

					//---------------------------Parents--------------------------------------------
				if($users_id==4)
				{
				   //echo $users_id;
				    $cnotes=$notes;
					$ctitle=$title;
					$psql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,p.parent_id,p.mobile FROM edu_users AS u,edu_parents AS p WHERE u.user_type='$users_id' AND u.user_master_id=p.parent_id AND u.status='Active'";
					$pres2=$this->db->query($psql);
					$presult2=$pres2->result();
					foreach($presult2 as $prows1)
					{
					   $pcell=$prows1->mobile;

					   //echo $tcell;exit;
						$textmessage=$ctitle.$cnotes;

						$textmsg =urlencode($textmessage);

						$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

						$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';

						$api_params = $api_element.'&numbers='.$pcell.'&message='.$textmsg;

						$smsgatewaydata = $smsGatewayUrl.$api_params;

						$url = $smsgatewaydata;

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_POST, false);
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$output = curl_exec($ch);
						curl_close($ch);

				}
				}

			}


		}

         //DOB Wisher for users_dob_wishes

         function student_dob_wishes($cur_date){
           $query="SELECT ee.name,ea.dob,ea.mobile FROM edu_enrollment AS ee LEFT JOIN edu_admission AS ea ON ee.admission_id=ea.admission_id WHERE ee.status='Active' AND CONCAT(YEAR(CURDATE()),DATE_FORMAT(ea.dob,'-%m-%d')) = '$cur_date' AND ee.status='Active'";
           $result=$this->db->query($query);
           $res=$result->result();
           foreach($res as $rows){
             $name=$rows->name;
             $number=$rows->mobile;
             $textmessage='Wishing you a Birthday filled with joy and a year filled with happiness and good health Happy Birthday '.$name.'';
           	 $textmsg =urlencode($textmessage);
           	 $smsGatewayUrl = 'http://173.45.76.227/send.aspx?';
             $api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
             $api_params = $api_element.'&numbers='.$number.'&message='.$textmsg;
           	 $smsgatewaydata = $smsGatewayUrl.$api_params;
           	 $url = $smsgatewaydata;

           	$ch = curl_init();
           	curl_setopt($ch, CURLOPT_POST, false);
           	curl_setopt($ch, CURLOPT_URL, $url);
           	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           	$output = curl_exec($ch);
           	curl_close($ch);

           	if(!$output)
           	{
                 $output =  file_get_contents($smsgatewaydata);
               }


           }
         }

         //  Teacher DOB WIshes
         function teacher_dob_wishes($cur_date){
          $query1="SELECT name,phone FROM edu_teachers WHERE CONCAT(YEAR(CURDATE()),DATE_FORMAT(dob,'-%m-%d')) = '$cur_date' AND status='Active'";
          $result1=$this->db->query($query1);
          $res=$result1->result();
          foreach($res as $rows){
            $name=$rows->name;
            $number=$rows->phone;
            $textmessage='Wishing you a Birthday filled with joy and a year filled with happiness and good health Happy Birthday '.$name.'';
            $textmsg =urlencode($textmessage);
            $smsGatewayUrl = 'http://173.45.76.227/send.aspx?';
            $api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
            $api_params = $api_element.'&numbers='.$number.'&message='.$textmsg;
            $smsgatewaydata = $smsGatewayUrl.$api_params;
            $url = $smsgatewaydata;

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_POST, false);
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           $output = curl_exec($ch);
           curl_close($ch);

           if(!$output)
           {
                $output =  file_get_contents($smsgatewaydata);
              }


          }

         }




}
	  ?>
