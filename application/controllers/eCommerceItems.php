<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class eCommerceItems extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('eCommerceItem_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
        // $this->output->enable_profiler();
    }
    
    public function index()
    {
        // main eCommerceItems
        $get_data['items'] = $this->eCommerceItem_model->get_all_items();
        $this->load->view('eCommerce_main', $get_data);
    }
    // Cart management

    public function add_to_basket($item_id)
    {
        //Add an item to a cart
        $quantity = $this->session->userdata($item_id);
        $quantity += $this->input->post('qty');
        $this->session->set_userdata($item_id, $quantity);
        redirect('/eCommerceItems');
    }

    public function remove_from_basket($item_id)
    {
        // remove an item from a cart
        $quantity = $this->session->userdata($item_id);
        $quantity -= $this->input->post('qty');
        $this->session->set_userdata($item_id, $quantity);
        redirect('/eCommerceItems/basket');
    }
    public function get_quantity($item_id)
    {
        // The the quantity of a particular product
        $mymessage = $this->eCommerceItem_model->get_quantity($item_id);
        $this->session->set_flashdata('message', $mymessage);
        redirect('/eCommerceItems');
    }
    public function inject_qty()
    {
        $mymessage = $this->eCommerceItem_model->inject_qty();
        $this->session->set_flashdata('message', $mymessage);
        redirect('/eCommerceItems/basket');
    }

    public function basket()
    {
        // redirect from remove
        $get_data['items'] = $this->eCommerceItem_model->get_all_items();
        $this->load->view('eCommerce_basket', $get_data);
    }

    // Payment functions
    public function process()
    {
        // Successful Stripe Transaction
        $this->load->view('/eCommerce_success');
    }

    // Admin product management
    public function add_product()
    {
        // Add a new product
        $product_info = $this->input->post();
        $this->eCommerceItem_model->add_product($product_info);
        $this->session->set_flashdata('message', 'Product Successfully Added!');
        redirect('/eCommerceUsers/admin');
    }
     public function delete($id)
    {
        // delete product from database
        $this->eCommerceItem_model->delete_product($id);
        $this->session->set_flashdata('messages', 'Successfully Deleted Product');
        redirect('/eCommerceUsers/admin');
    }

    public function confirm_delete($id)
    {
        // set up the items for deletion
        $get_data['items'] = $this->eCommerceItem_model->get_all_items();
        $get_data['id'] = $id;
        $this->load->view('eCommerce_confirmdelete', $get_data);
    }


}
?>