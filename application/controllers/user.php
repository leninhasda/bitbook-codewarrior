<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require 'faker/src/autoload.php';

class User extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('image_model');
		$this->faker = Faker\Factory::create();
	}

	public function is_friend($uid, $fid) {
		
		$is_frnd = $obj->user_model->is_friend($uid, $fid);
		if($is_friend)
			return true;
		else
			return false;
	}

	/**
	 * *	for TESTING ONLY
	 */
	public function index()
	{
     	// $param = array(
     	// 	'username'
     	// );
	}

	/**
	 * *	for TESTING ONLY
	 */
	public function insert()
	{
		$faker = Faker\Factory::create();
		$this->load->model('user_model');

		$gen = array('femail', 'male');

		for ($i=0; $i <10 ; $i++) { 
			$param= array(
				'username' => $faker->username(),
				'email' => $faker->email(),
				'password' => "passowrd",
				'firstname' => $faker->firstNameMale(),
				'lastname' => $faker->lastName,
				'display_name' => $faker->name(),
				'verified' => $faker->randomNumber(0, 1),
				'gender' => $faker->randomElement($gen),
				'date_of_birth' => $faker->date(),
				'about' => $faker->paragraph()
				);

			$this->user_model->create($param);
		}

		echo 'done';
	}

	/**
	 * *	for TESTING ONLY
	 */
	public function update(){
		for ($i=31; $i <44 ; $i++) { 
			$data = array(
				'password' => 'password',
				);
			$is_update = $this->user_model->update($i, $data);
			if($is_update)
				echo 'done';
			else
				echo 'erro';
		}
	}

	/**
	 * *	for TESTING ONLY
	 */
	public function delete() {
		$this->load->model('user_model');
		$id = 2;
		$x = $this->user_model->delete($id);
		if($x) 
			echo 'done';
		else 
			echo 'error';
	}

	// login function
	public function authenticate() {

		$login_submit = $this->input->post('login_submit');
		$reg_submit = $this->input->post('reg_submit');
		
		if(isset($login_submit) && !empty($login_submit)) {
			$userlogin = $this->input->post('user');
			$userpass = $this->input->post('pass');
			if( strstr($userlogin, '@') === FALSE) {
				$user_data = array(
						'username' => $userlogin,
						'password' => $userpass,
					);
			} else {
				$user_data = array(
						'email' => $userlogin,
						'password' => $userpass,
					);
			}

			$user = $this->user_model->login($user_data);

			if($user === FALSE) {
				// error
				$data['error'][] = 'Invalid username or password';
				$data['is_error'] = true;
			} else {
				// done
				// var_dump($is_logged);
				$session_data = array(
					'user_id' 	=> $user->id,
                   	'username'  => $user->username,
                   	'email'     => $user->email,
                   	'logged_in' => TRUE
               	);

				$this->session->set_userdata($session_data);

				redirect('profile/edit');

				echo 'h';
				die();
			}
			// die();
		} else if(isset($reg_submit) && !empty($reg_submit)) {
			$this->register();
			die();
		}

		$data['template'] = 'login';
		$data['site_title'] = 'Bitbook';
		$this->load->view('layout', $data);
	}

	// 
	public function register() {
		$param = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'display_name' => $this->input->post('firstname').' '.$this->input->post('lastname'),
			'verified' => 1,
			'gender' => $this->input->post('gender'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'about' => ''
		);

		$id = $this->user_model->create($param);

		if( $id ) {
			// login user
			$user = $this->user_model->get_by_id($id);

			$session_data = array(
				'user_id' 	=> $user->id,
               	'username'  => $user->username,
               	'email'     => $user->email,
               	'logged_in' => TRUE
           	);

			$this->session->set_userdata($session_data);

			redirect('profile');

			// redirec to profile page
		} else {
			// error

			// show error message
			return false;
		}
	}

	public function save_account() {
		$id = $this->input->post('user_id');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		// $ajax = $this->input->post('ajax');
		$ajax = true;
		if($ajax) {
			$param = array(
				'email' => $email
			);
			if(!empty($password)) {
				$param['password'] = $password;
			}

			$is_update = $this->user_model->update($id, $param);

			if($is_update) {
				$msg = array(
					'save' => 1,
					'txt' => 'Account information updated!'
				);
			} else {
				$msg = array(
					'save' => 0,
					'txt' => 'Error saving data!'
				);
			}
			echo json_encode($msg);
			die();
		}
	}

	public function save_basic() {
		$id = $this->input->post('user_id');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$display_name = $this->input->post('display_name');
		$about = $this->input->post('about');
		$date_of_birth = $this->input->post('date_of_birth');
		$place = $this->input->post('place');
		// $ajax = $this->input->post('ajax');
		$ajax = true;
		if($ajax) {
			$param = array(
				'firstname'		=> $firstname,
				'lastname'		=> $lastname,
				'display_name'	=> $display_name,
				'about' 		=> $about,
				'date_of_birth' => $date_of_birth,
				'place' 		=> $place
			);

			$is_update = $this->user_model->update($id, $param);

			if($is_update) {
				$msg = array(
					'save' => 1,
					'txt' => 'Basic information updated!'
				);
			} else {
				$msg = array(
					'save' => 0,
					'txt' => 'Error saving data!'
				);
			}
			echo json_encode($msg);
			die();
		}
	}

	public function search() {
		$query = $this->input->get('query');

		$curr_user_id = $this->session->userdata('user_id');
		$data['current_user'] = $this->user_model->get_by_id( $curr_user_id );

		$users = $this->user_model->search_user($query);

		$alluser = array();
		foreach ($users as $user) {
			$img = $this->image_model->get_by_id($user->pro_pic);

			$alluser[] = array(
				'id' 			=> $user->id,
				'display_name' 	=> $user->display_name,
				'place' 		=> $user->place,
				'filename' 		=> isset($img->filename)?$img->filename:null
			);
		}


		$data['users'] = $alluser;
		$data['template'] = 'search';
		$data['site_title'] = 'Bitbook';
		$this->load->view('layout', $data);
	}

	public function addfriend() {
		$friend_id = $this->uri->segment(3);
		$curr_user_id = $this->session->userdata('user_id');

		$param = array(
			'user_id'	=> $curr_user_id,
			'friend_id'	=> $friend_id
		);

		$is_done = $this->user_model->addfriend($param);

		if($is_done) {
			redirect('profile/view/'.$friend_id);
		}
	}

	public function removefriend() {
		$friend_id = $this->uri->segment(3);
		$curr_user_id = $this->session->userdata('user_id');

		$param = array(
			'user_id'	=> $curr_user_id,
			'friend_id'	=> $friend_id
		);

		$is_done = $this->user_model->removefriend($param);

		if($is_done) {
			redirect('profile/view/'.$friend_id);
		}
	}
}