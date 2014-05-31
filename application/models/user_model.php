<?php

class User_model extends CI_Model
{
	protected $_table = 'user';
	protected $_frnd_table = 'user_friend_relation';

	//add new user
	public function create($param){

		$this->db->set($param);
		$this->db->insert( $this->_table );

		$id = $this->db->insert_id();
		if($id)
			return $id;
		else 
			return false;
	}

	public function update($id, $data){

    	$this->db->set($data);
		$this->db->where('id',$id);
		$this->db->update($this->_table);
		$row_cnt = $this->db->affected_rows();

		// echo $this->db->last_query();

		if($row_cnt == 1)
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

	public function login($u_data) {
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->where($u_data);
		$query = $this->db->get();

		// echo $this->db->last_query();

		if( $query->num_rows() > 0 )
			return array_shift($query->result());
		else 
			return false;
	}

	public function get_by_id( $uid ) {
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->where('id', $uid);
		$query = $this->db->get();

		if( $query->num_rows() > 0 )
			return array_shift($query->result());
		else 
			return false;
	}

	// search by username
	public function search_user($query)
	{

		$this->db->select('*');
		$this->db->from('user');
		//$this->db->join('user_details','user_details.user_id = users.id');
		$this->db->like('firstname', $query);
		$this->db->or_like('lastname',$query);
		$this->db->or_like('display_name',$query);
        //$this->db->limit(5,0);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function addfriend($param) {
		$this->db->set($param);
		$this->db->insert( $this->_frnd_table );

		$id = $this->db->insert_id();
		if($id)
			return $id;
		else 
			return false;
	}

	public function removefriend($param) {
		$this->db->where($param);
		$this->db->delete( $this->_frnd_table );

		$row_count = $this->db->affected_rows();

		echo $this->db->last_query();

		if($row_count == 1)
			return true;
		else 
			return false;
	}

	public function is_friend($uid, $fid) {
		$param = array(
			'user_id'	=> $uid,
			'friend_id'	=> $fid
		);

		$this->db->select('id');
		$this->db->from($this->_frnd_table);
		$this->db->where($param);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}

	public function get_friends($uid) {
		$sql  = " SELECT * FROM ".$this->_table;
		$sql .= " WHERE id IN ( ";
			$sql .= " SELECT friend_id FROM ".$this->_frnd_table;
			$sql .= " WHERE user_id = ".$uid;
		$sql .= " )";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
}
