<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}


	function __construct()
    {
        parent::__construct();
		$this->load->model("apimodel");

    }

	public function checkMethod()
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$res = array();
			$res["scode"] = 203;
			$res["message"] = "Request Method not supported";

			echo json_encode($res);
			return FALSE;
		}
		return TRUE;
	}

//-----------------------------------------------//

	public function login()
	{
	    $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$username = '';
		$password = '';

		$username = $this->input->post("username");
		$password = $this->input->post("password");

		if($username == "" || $password == "")
		{
			$arr = array("opn" => "Login","scode" => 201,"message" => "Please Pass all the Required Fields.");
			echo json_encode($arr);
			return;
		}

		if($username == NULL || $username == '')
		{
			$arr = array("opn" => "Login","scode" => 201,"message" => "Required field missing (USER NAME).");
			echo json_encode($arr);
			return;
		}


		if($password == NULL || $password == '')
		{
			$arr = array("opn" => "Login","scode" => 201,"message" => "Required field missing (PASSWORD).");
			echo json_encode($arr);
			return;
		}

		$username= $this->input->post("username");
		$password = $this->input->post("password");

		$data['result']=$this->apimodel->mainLogin($username,$password);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	public function forgot_Password()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Forgot Password";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_name = '';
	 	$user_name = $this->input->post("user_name");


		$data['result']=$this->apimodel->forgotPassword($user_name);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	public function reset_Password()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Reset Password";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$password = '';
		
		$user_id = $this->input->post("user_id");
	 	$password = $this->input->post("password");

		$data['result']=$this->apimodel->resetPassword($user_id,$password);
		$response = $data['result'];
		echo json_encode($response);
	}


//-----------------------------------------------//

	public function change_Password()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Reset Password";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$old_password = '';
		$password = '';
		
		$user_id = $this->input->post("user_id");
		$old_password = $this->input->post("old_password");
	 	$password = $this->input->post("password");

		$data['result']=$this->apimodel->changePassword($user_id,$old_password,$password);
		$response = $data['result'];
		echo json_encode($response);
	}
	
//-----------------------------------------------//


	public function stud_timetable()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Timetable View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$class_id = $this->input->post("class_id");

		$data['result']=$this->apimodel->studTimetable($class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	public function disp_Exams()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exams View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$class_id = $this->input->post("class_id");

		$data['result']=$this->apimodel->dispExams($class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	public function disp_Examdetails()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam Details View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$exam_id= '';
		$class_id = $this->input->post("class_id");
	 	$exam_id = $this->input->post("exam_id");

		$data['result']=$this->apimodel->dispExamdetails($class_id,$exam_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function disp_Exammarks()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam Marks View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$stud_id= '';
		$exam_id= '';
		$stud_id = $this->input->post("stud_id");
		$exam_id = $this->input->post("exam_id");

		$data['result']=$this->apimodel->dispMarkdetails($stud_id,$exam_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function disp_Homework()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Homework View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$hw_type= '';
		
		$class_id = $this->input->post("class_id");
		$hw_type = $this->input->post("hw_type");

		$data['result']=$this->apimodel->dispHomework($class_id,$hw_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Ctestmarks()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Homework View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$hw_id= '';
		$entroll_id= '';
		$hw_id = $this->input->post("hw_id");
		$entroll_id = $this->input->post("entroll_id");

		$data['result']=$this->apimodel->dispCtestmarks($hw_id,$entroll_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Events()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Events View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
	 	$class_id = $this->input->post("class_id");


		$data['result']=$this->apimodel->dispEvents($class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function disp_subEvents()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Events View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id= '';
	 	$event_id = $this->input->post("event_id");


		$data['result']=$this->apimodel->dispsubEvents($event_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_ParentCommunication()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Events View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$class_id = $this->input->post("class_id");

		$data['result']=$this->apimodel->dispParentCommunication($class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Attendence()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Attendence View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$stud_id = '';
		$class_id = $this->input->post("class_id");
		$stud_id = $this->input->post("stud_id");

		$data['result']=$this->apimodel->dispAttendence($class_id,$stud_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//
}
