<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'faker/src/autoload.php';

class Post extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('post_model');
		$this->load->model('user_model');
		$this->faker = Faker\Factory::create();
	}

	/**
	 * main method
	 * 
	 *	for TESTING ONLY
	 */
	public function index() {

		// for($i; $i<10; $i++) {

		$ids = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,6,19,8);

		$user_data = array(
				'id' => $this->faker->randomElements($ids),
				'displayname' => $this->faker->userName()
			);
		$image_data = array(1, 2, 2);
		$like_data = array(
				'count' => $this->faker->randomElements($ids),
				'user' => $user_data
			);
		$post = array(
				'user' => json_encode( $user_data ),
				'post' => $this->faker->sentence(),
				'post_image' => json_encode( $image_data ),
				'like' => json_encode( $like_data ),
				'date' => $this->faker->date()
			);
		
		$theID = $this->post_model->create( $post );
		if($theID) 
			echo 'done ';
		else
			echo 'error';
		// }
	}


	/**
	 * *	for TESTING ONLY
	 */
	public function update() {
		for($i=1; $i<305; $i++) {
		$ids = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,6,19,8);
		$x = time()- $this->faker->randomNumber(500,50000);
		$post = array(
				'user_id' => $this->faker->randomNumber(31,41)
				// 'post' => 'the actual post again! ;)',
			);
		// var_dump($post);
		// die();
		
		$is_udpate = $this->post_model->update($i, $post );
		if($is_udpate) 
			echo 'done<br>';
		else
			echo 'error<br>';
		}
	}

	/**
	 * *	for TESTING ONLY
	 */
	public function view() {
		$id = 100;
		$p_data = $this->post_model->get_by_id($id);

		var_dump($p_data);
	}

	/**
	 * *	for TESTING ONLY
	 */
	public function show() {
		$id = 5;
		$p_data = $this->post_model->get_by_user($id);

		echo '<pre>';
		var_dump($p_data);	
		echo '</pre>';
	}


	public function create() {
		$user_id = $this->input->post('user_id');
		$post = $this->input->post('post');
		$param = array(
			'user_id'	=> $user_id,
			'post' 		=> $post,
			'date' 		=> time()
		);

		$is_create = $this->post_model->create( $param );

		if($is_create) {
			redirect('profile/');
		} else {
			show_error();
		}

		// echo json_encode($msg);
		die();
	}

	public function remove() {
		$id = $this->uri->segment(3);
		$is_done = $this->post_model->delete($id);
		
		if($is_done) {
			redirect('profile/');
		}

		die();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */