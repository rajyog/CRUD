<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
        parent::__construct();
        		$this->load->model('user_model');
    }


	public function index()
	{
		$this->load->view('home');
	}

	public function add_user_view()
	{
		$this->load->view('add_user_view');
	}

	public function add_user(){

		$firstname =$this->input->post('firstname');
		$lastname =$this->input->post('lastname');
		$gender =$this->input->post('gender');
		$dob =$this->input->post('dob');
		$range =$this->input->post('range');
		$address =$this->input->post('address');
		$age =$this->input->post('age');
		$email =$this->input->post('email');
		$mobile =$this->input->post('mobile');
		$password =$this->input->post('password');
		$quation =$this->input->post('quation');
		$vehicle =$this->input->post('vehicle');


		$data =array('user_firstname'=>$firstname,'user_lastname'=>$lastname,'user_gender'=>$gender,'user_dob'=>$dob,'user_address'=>$address,'user_range'=>$range,'user_age'=>$age,'user_mobile'=>$mobile,'user_email'=>$email,'user_password'=>$password,'user_queastion'=>$quation,'user_vehical'=>$vehicle);	
		$insert = $this->user_model->insert_data($data);
        if ($insert == true) {
            echo 0;
        } else {
            echo 1;
        }
	}

	public function list_user() {
        $limit = 10;
        $page = $this->input->post('pagee');
        $firstname = $this->input->post('firstname');
        
        $sort_type = $this->input->post('sort_type');
        $sort_field = $this->input->post('sort_field');

        $total_records = count($this->user_model->get_user_list($firstname));
        $total_pages = ceil($total_records / $limit);
        if (($page != 0) || $page != '') {
            $page = $page;
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $limit;
        $data['user_list'] = $this->user_model->get_user($firstname, $sort_type, $sort_field, $limit, $start_from);
        $data['total_pages'] = $total_pages;
        echo json_encode($data);
    }
}
