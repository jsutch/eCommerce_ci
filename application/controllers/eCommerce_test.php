<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counter extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('myUser_model'); // WTF?
        // $this->load->model('eCommerceItem_model');
        $this->load->model('ecomItem_model');
        $this->load->library('form_validation');
        //$this->output->enable_profiler();
    }
    public function index()
        {
            echo '<h1>I am a default controller</h1>';
        }

}
?>
