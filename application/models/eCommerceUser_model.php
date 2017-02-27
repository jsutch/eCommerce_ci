<?php

    class eCommerceUser_model extends CI_Model
    {
		public function add_user($user)
		{
			$query = 'INSERT into users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,NOW(), NOW())';
			$values = array($user['first_name'], $user['last_name'], $user['email'], $user['password']);
			return $this->db->query($query,$values);
		}
		public function add_user_with_hash($user, $pass)
		{
			$query = 'INSERT into users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,NOW(), NOW())';
			$values = array($user['first_name'], $user['last_name'], $user['email'], $pass);
			return $this->db->query($query,$values);
		}
		public function get_user($user)
		{
			$query = 'SELECT * from users where email = ? and password = ?';
			$values = array(user['email'],user['password']);
			return $this->db->query($query,$values)->row_array();
		}
		public function get_user_with_secret($user)
		{
			$query = 'SELECT * from users where email = ? and password = ? and secret = ?';
			$values = array(user['email'],user['password'], user['secret']);
			return $this->db->query($query,$values)->row_array();
		}
		public function confirm_user($user)
		{
			$query = 'SELECT * FROM users WHERE email = ?';
			return $this->db->query($query,$user['email'])->row_array();
		}
		public function add_visit($user)
		{
			$visits = $user['visits'] + 1;
			$query = 'UPDATE users SET visits = ? WHERE id = ?';
			$values = array($visits, $user['id']);
			return $this->db->query($query, $values);
		}

    }