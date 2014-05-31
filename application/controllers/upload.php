<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	protected $upload_path;
	public function __construct() {
		parent::__construct();

		$this->load->model('image_model');
		$this->load->model('user_model');
		$this->load->model('post_model');
		$this->upload_path = realpath(APPPATH. '../uploads');
		$this->load->library('upload');
		$this->load->library('image_lib');
	}

	public function index() {

		// echo $this->upload_path;
		// die();
		
		$config['upload_path'] = $this->upload_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = '5000';
		$config['max_width'] = '2400';
		$config['max_height'] = '2200';

		$this->upload->initialize($config);

		if(!$this->upload->do_upload()) {
			echo $this->upload->display_errors().' 1';
		} else {
			$image_data = $this->upload->data();

			// add image to db
			$img_id = $this->image_model->add($image_data);

			$pro_pic = $this->input->post('pro_pic');
			$cover_pic = $this->input->post('cover_pic');
			$post = $this->input->post('post');
			$user_id = $this->input->post('user_id');

			// add as profie pic
			if($img_id) {
				if($pro_pic && $user_id){
					$param = array(
						'pro_pic' => $img_id
					);
					$is_done = $this->user_model->update($user_id, $param);
					if(!$is_done) {
						echo 'Error adding pro pic';
						die();
					}
				}

				if($cover_pic && $user_id){
					$param = array(
						'cover_pic' => $img_id
					);
					$is_done = $this->user_model->update($user_id, $param);
					if(!$is_done) {
						echo 'Error adding cover pic';
						die();
					}
				}

				if(!empty($post) && $user_id) {
					$param = array(
						'user_id'	=> $user_id,
						'post' 		=> $post,
						'post_image'=> $img_id,
						'date' 		=> time()
					);

					$is_create = $this->post_model->create( $param );

					if(!$is_create) {
						echo 'error';
						die();
					}
				}
			}

			//resize 930 x310
			$config = array(
				'source_image' => $image_data['full_path'],
				'maintain_ratio' => true,
				'new_image' => realpath($this->upload_path.'/930x310'),
				'width' => 930
			);
			$this->image_lib->initialize($config);
			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors().' 2';
				die();
			}

			//resize 300 x220
			$config = array(
				'source_image' => $image_data['full_path'],
				'maintain_ratio' => true,
				'new_image' => realpath($this->upload_path.'/300x220'),
				'width' => 300,
				'height' => 220
			);
			$this->image_lib->initialize($config);
			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors().' 2';
				die();
			}

			// resize 150x150
			$config = array(
				'source_image' => $image_data['full_path'],
				'maintain_ratio' => true,
				'new_image' => realpath($this->upload_path.'/150x150'),
				'width' => 150,
				'height' => 150
			);
			$this->image_lib->initialize($config);
			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors().' 3';
				die();
			}

			// resize 50x50
			$config = array(
				'source_image' => $image_data['full_path'],
				'maintain_ratio' => true,
				'new_image' => realpath($this->upload_path.'/50x50'),
				'width' => 50,
				'height' => 50
			);
			$this->image_lib->initialize($config);
			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors().' 4';
				die();
			}

			if(!empty($post)) {
				redirect('profile/');
			} else {
				redirect('profile/edit');
			}
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */