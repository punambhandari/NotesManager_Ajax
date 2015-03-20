<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
		$this->load->model('Note');
	}

	public function index()
	{
		$this->load->view('index');
	}


	public function get_all_json()
	{
		$result['notes']=$this->Note->get_all();
		echo json_encode($result);
	}

	public function create()
	{
		$post=$this->input->post(null,true);
		$this->Note->create($post);
		//crate json and send again
		$result['notes']=$this->Note->get_all();
		echo json_encode($result);
	}

	public function destroy($id)
	{
	
		$this->Note->destroy($id);
		//crate json and send again
		$result['notes']=$this->Note->get_all();
		echo json_encode($result);
	}

	public function show($id)
	{	$result['notes']=$this->Note->get($id);
		echo json_encode($result);

		//$this->load->view('partials/notes',array('notes'=>$result));
	}

	public function update()
	{	
		$post=$this->input->post(null,true);
		$this->Note->update($post);
		$result['notes']=$this->Note->get_all();
		echo json_encode($result);
		
	}


}

//end of main CI_Controller