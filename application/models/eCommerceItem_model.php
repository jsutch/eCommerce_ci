<?php

    class eCommerceItem_model extends CI_Model
    {
        // public $user;

        // function __construct()
        // {
        //     parent::__construct();
        // }

		public function get_all_items()
		 {
		 	$query = 'SELECT * from products ORDER BY created_at DESC';
		 	return $this->db->query($query)->result_array();
		 }
		public function get_quantity($item_id)
		{
			//get the quantity of a particular product
			$query = 'SELECT quantity FROM products WHERE id = ?';
			$values = $item_id;
			return $this->db->query($query, $values);
		}
		public function add_product($data)
		{
			// add a new product
			$query = 'INSERT into products (name, description, price, quantity, created_at, updated_at) VALUES (?,?,?,?,NOW(),NOW())';
			$values = array($data['name'], $data['description'], $data['price'], $data['quantity']);
			return $this->db->query($query,$values);
		}
		public function delete_product($id)
		{
			// delete product
			$query = "DELETE from products where id = {$id}";
			return $this->db->query($query);
		}

		public function add_order()
		{
			// create an order 
			$query = 'INSERT into products_orders (name, description, price, quantity, created_at, updated_at) VALUES (?,?,?,?,NOW(),NOW())';
			$values = array($data['name'], $data['description'], $data['price'], $data['quantity']);
			return $this->db->query($query,$values);
		}
		public function add_to_order()
		{
			// add products to an order
		}
		public function remove_from_order()
		{
			// remove products from an order
		}
		public function delete_order()
		{
			// delete an order
		}

		// Testing tools
		public function inject_qty()
		{
			$string = "22222";
			$query = 'UPDATE users SET credit_card = ? WHERE id = ?';
			$values = array($string, '2');
			return $this->db->query($query, $values);
		}

    }