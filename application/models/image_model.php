<?php
class Image_model extends CI_Model {

	protected $_table = 'images';

	// constructor
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->dbutil();
	}

	public function add($img_data) {
		// add img to database
		$param = array(
			'user_id' => $this->session->userdata('user_id'),
			'filename' => $img_data['file_name'],
			'title' => $img_data['raw_name'],
			'path' => $img_data['file_path'],
			'detail' => json_encode($img_data),
			'date' => time()
		);
		$this->db->set($param);
		$this->db->insert($this->_table);

		$id = $this->db->insert_id();

		if($id) {
			return $id;
		} else {
			return false;
		}
	}

	public function get_by_id($id) {
		$this->db->select("*");
		$this->db->from($this->_table);
		$this->db->where('id', $id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return array_shift($query->result());
		else
			return false;
	}

	public function get_by_user($uid, $args=array()) {
		$this->db->select("*");
		$this->db->from($this->_table);
		$this->db->where('user_id', $uid);
		if(isset($args) && isset($args['limit']))
			$this->db->limit($args['limit'], $args['offset']);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
}