<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminapi extends CI_Controller {

	function __construct() {
		 parent::__construct();

		 	$this->load->model('adminapimodel');
		  $this->load->helper('url');
		  $this->load->library('session');


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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
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

// GET ALL CLASS

public function get_all_classes()
{

	//$_POST = json_decode(file_get_contents("php://input"), TRUE);

	if(!$this->checkMethod())
	{
		return FALSE;
	}

	if($_POST == FALSE)
	{
		$res = array();
		$res["opn"] = "Class Name";
		$res["scode"] = 204;
		$res["message"] = "Input error";

		echo json_encode($res);
		return;
	}

	$data['result']=$this->adminapimodel->get_classes();
	$response = $data['result'];
	echo json_encode($response);
}


	// GET SECTION

	public function get_all_sections()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Section Name";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		  $class_id=$this->input->post('class_id');


		$data['result']=$this->adminapimodel->get_all_sections($class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

	// GET ALL STUDENTS IN CLASSES

	public function get_all_students_in_classes()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Section Name";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		  $class_id=$this->input->post('class_id');
			$section_id=$this->input->post('section_id');


		$data['result']=$this->adminapimodel->get_all_students_in_classes($class_id,$section_id);
		$response = $data['result'];
		echo json_encode($response);
	}



	// GET ALL STUDENTS DETAILS

	public function get_student_details()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Section Name";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		  $student_id=$this->input->post('student_id');



		$data['result']=$this->adminapimodel->get_student_details($student_id);
		$response = $data['result'];
		echo json_encode($response);
	}

}
