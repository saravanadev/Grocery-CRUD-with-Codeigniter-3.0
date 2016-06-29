<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public  function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');

	}
	public function category()
	{
		try{
			$crud = new grocery_CRUD();

			
			$crud->set_table('category');
			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function theme()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');			
			$crud->set_table('category');
			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	function relation()
	{
		try{


			$crud = new grocery_CRUD();
			$crud->set_table('artist');
			$crud->set_relation('categoryid','category','categoryname');
			$crud->display_as('categoryid','Category Name');
			$crud->display_as('name','Artist Name');
			$crud->set_field_upload('image','assets/uploads/files');
			$output = $crud->render();
			$this->_example_output($output);


		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
		function validation()
	{
		try{


			$crud = new grocery_CRUD();
			$crud->set_table('artist');
			$crud->set_relation('categoryid','category','categoryname');
			$crud->display_as('categoryid','Category Name');
			$crud->display_as('name','Artist Name');
			$crud->set_rules('name','Artist Name','required');
			$crud->set_field_upload('image','assets/uploads/files');
			$crud->set_rules('name','Artist Name','required|alpha');
			$crud->set_rules('image','Artist Image','required');
			$crud->set_rules('categoryid','Category Name','required');
			$output = $crud->render();
			$this->_example_output($output);


		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function _example_output($output = null)
	{
		$this->load->view('demo',$output);
	}
}
