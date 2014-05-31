<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();		
		$this->load->model('user_model');		
		$this->load->model('post_model');		
		$this->load->model('image_model');		
	}

	public function is_friend($uid, $fid) {
		
		$is_frnd = $obj->user_model->is_friend($uid, $fid);
		if($is_friend)
			return true;
		else
			return false;
	}

	public function index()
	{
		$is_logged = $this->session->userdata('logged_in');
		// $all = $this->session->all_userdata();

		// var_dump($all);

		if( !isset($is_logged) || $is_logged == false ) {
			// echo 'need to logged int';
			// echo anchor('user/authenticate', 'login');

			redirect('user/authenticate');
		}
		else {

			$user_id = $this->session->userdata('user_id');
			$data['user'] = $this->user_model->get_by_id( $user_id );
			$data['pro_image'] = $this->image_model->get_by_id($data['user']->pro_pic);
			$data['cover_image'] = $this->image_model->get_by_id($data['user']->cover_pic);
			$param = array('limit'=>6, 'offset'=>0);
			$data['images'] = $this->image_model->get_by_user($data['user']->id, $param);
			$friends = $this->user_model->get_friends($user_id);
			$allfriends = array();
			if(count($friends) && $friends) {
				foreach ($friends as $friend) {
					$img = $this->image_model->get_by_id($friend->pro_pic);
					$allfriends[] = array(
						'friend_id' => $friend->id,
						'filename' => isset($img->filename) ? $img->filename:null,
					);
				}
			} else {
				$friends = null;
			}
			$data['friends'] = $allfriends;
			$data['current_user'] = $data['user'];
			$data['posts'] = $this->post_model->get_by_user( $user_id );
			$data['template'] = 'profile';
			$data['site_title'] = 'Bitbook';
			$this->load->view('layout', $data);
		}
	}

	public function logout() {
		// destroy sessiont
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');

		// redirect to login page
		redirect('user/authenticate');
	}

	public function edit() {
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->user_model->get_by_id( $user_id );

		$curr_user_id = $this->session->userdata('user_id');
		$data['current_user'] = $this->user_model->get_by_id( $curr_user_id );

		$data['pro_image'] = $this->image_model->get_by_id($data['user']->pro_pic);
		$data['cover_image'] = $this->image_model->get_by_id($data['user']->cover_pic);
		$data['template'] = 'edit-profile';
		$data['site_title'] = 'Bitbook';
		$this->load->view('layout', $data);
	}

	public function feed() {
		$curr_user_id = $this->session->userdata('user_id');
		$data['current_user'] = $this->user_model->get_by_id( $curr_user_id );

		$friends = $this->user_model->get_friends($curr_user_id);
		$feeds = array();
		foreach ($friends as $friend) {
			$param = array(
				'limit' => 2,
				'offset' => 0
			);
			$user_posts = $this->post_model->get_by_user($friend->id, $param);
			$pro_pic = $this->image_model->get_by_id($friend->pro_pic);
			foreach($user_posts as $post) {
				if($post->post_image){
					$post_img = $this->image_model->get_by_id($post->post_image);
					$post_img = isset($post_img->filename)?$post_img->filename:null;
				}
				else
					$post_img = null;
				$feeds[] = array(
					'user_id' => $friend->id,
					'pro_pic' => isset($pro_pic->filename) ? $pro_pic->filename: null,
					'display_name' => $friend->display_name,
					'post_id' => $post->id,
					'post' => $post->post,
					'post_image' => $post_img,
					'like' => json_decode($post->like),
					'date' => $post->date
				);
			}
		}
		shuffle($feeds);
		// echo '<pre>';
		// var_dump($feeds);
		// echo '<pre>';
		// die();

		$data['feeds'] = $feeds;
		$data['template'] = 'news-feed';
		$data['site_title'] = 'Bitbook';
		$this->load->view('layout', $data);
	}

	public function view() {
		$curr_user_id = $this->session->userdata('user_id');
		$data['current_user'] = $this->user_model->get_by_id( $curr_user_id );

		$user_id = $this->uri->segment(3);

		$data['user'] = $this->user_model->get_by_id( $user_id );

		$data['pro_image'] = $this->image_model->get_by_id($data['user']->pro_pic);
		$data['cover_image'] = $this->image_model->get_by_id($data['user']->cover_pic);
		$param = array('limit'=>6, 'offset'=>0);
		$data['images'] = $this->image_model->get_by_user($data['user']->id, $param);

		$data['posts'] = $this->post_model->get_by_user( $user_id );
		$data['template'] = 'profile';
		$data['site_title'] = 'Bitbook';
		$this->load->view('layout', $data);

	}


	public function photo() {
		$is_logged = $this->session->userdata('logged_in');
		// $all = $this->session->all_userdata();

		// var_dump($all);

		if( !isset($is_logged) || $is_logged == false ) {
			echo 'need to logged int';
			echo anchor('user/authenticate', 'login');
		}
		else {
			// echo 'show user profile';
			// echo anchor('profile/logout', 'logout');

			$curr_user_id = $this->session->userdata('user_id');
			$user_id = $this->uri->segment(3);
			if(!$user_id)
				$user_id = $curr_user_id;

			$data['current_user'] = $this->user_model->get_by_id( $curr_user_id );
			$data['user'] = $this->user_model->get_by_id( $user_id );

			$data['pro_image'] = $this->image_model->get_by_id($data['user']->pro_pic);
			$data['cover_image'] = $this->image_model->get_by_id($data['user']->cover_pic);

			$data['photos'] = $this->image_model->get_by_user($user_id);
			
			$data['posts'] = $this->post_model->get_by_user( $user_id );
			$data['template'] = 'photo';
			$data['site_title'] = 'Bitbook';
			$this->load->view('layout', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
