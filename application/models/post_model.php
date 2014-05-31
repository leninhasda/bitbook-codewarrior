<?php
/**
* 
*/
class Post_model extends CI_Model
{
	protected $_post;
	protected $_table = 'post';

	// constructor
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->dbutil();
	}

	// create
	public function create( $p_data ) {

		foreach( $p_data as $index => $data ) {
			$this->_post[$index] = $data;
			// $this->_post[$index] = $this->db->escape( $data );
		}

		$this->db->set( $this->_post );
		$this->db->insert( $this->_table );

		// echo $this->db->last_query();

		$id = $this->db->insert_id();
		if( $id )
			return $id;
		else
			return false;
	}

	public function update($id, $p_data) {
		foreach( $p_data as $index => $data ) {
			$this->_post[$index] = $data;
			// $this->_post[$index] = $this->db->escape( $data );
		}

		$this->db->set( $this->_post );
		$this->db->where( 'id' , $id );
		$this->db->update( $this->_table );

		// echo $this->db->last_query();

		$row_count = $this->db->affected_rows();
		if( $row_count == 1 )
			return true;
		else
			return false;
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete( $this->_table );

		$row_count = $this->db->affected_rows();
		if( $row_count == 1 )
			return true;
		else
			return false;
	}

	public function get_by_id($id) {
		$this->db->select('*');
		$this->db->from( $this->_table );
		$this->db->where('id', $id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function get_by_user( $id, $args=array() ) {
		$this->db->select('*');
		$this->db->from( $this->_table );
		$this->db->where('user_id', $id);
		$this->db->order_by('date', 'DESC');
		if (isset($args) && isset($args['limit'])) {
			$this->db->limit($args['limit'], $args['offset']);
		} else {
			$this->db->limit(10, 0);
		}
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;	
	}
}