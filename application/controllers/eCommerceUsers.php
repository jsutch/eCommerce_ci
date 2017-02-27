<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class eCommerceUsers extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        // $this->load->library('encryption');
        $this->load->model('eCommerceUser_model');
        $this->load->model('eCommerceItem_model');
        // $this->output->enable_profiler();
    }
    
    public function index()
    {
        // echo '<h1>I am a default controller</h1>';
        $test_confirm = $this->eCommerceItem_model->get_all_items();
        $this->load->view('eCommerce_login', $test_confirm);
    }
    public function test()
    {
        $test_confirm = $this->ecomItem->get_all_items();
    }
    
    public function register()
    {
        // add a new user
        $user = $this->input->post(); // get post data
        // There's a bug here:" Message: Undefined property: eCommerceUsers::$eCommerceUser"
        // $user_confirm = $this->eCommerceUser->confirm_user($user); // check if user exists in db
        // $user_confirm = $this->myUser->confirm_myuser($user); // check if user exists in db
        $user_confirm = $this->eCommerceUser_model->confirm_user($user);
        // see if user exists
        if ($user_confirm)
        {
            $this->session->set_flashdata('form_errors','<p>User already exists</p>');
            redirect('/eCommerceUsers');
        }
        //Form Validation Rules
        $this->form_validation->set_rules('first_name','First Name', 'trim|required');
        $this->form_validation->set_rules('last_name','Last Name', 'trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[3]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password','Confirm Password', 'trim|required|');
        if($this->form_validation->run()) //Was the form completed successfully?
        {
            // Create user
            $this->session->set_flashdata('form_success','You Have Successfully Registered!');
            $this->eCommerceUser_model->add_user($user);
        } 
        else 
        {
            //form issues
            $this->session->set_flashdata('form_errors',validation_errors());
        }
        redirect('/eCommerceUsers');
    }
    public function register_with_hash()
    {
        // Signup Secret
        $secret = 'judicandus';
        // add a new user
        $user = $this->input->post(); // get post data
        // There's a bug here:" Message: Undefined property: eCommerceUsers::$eCommerceUser"
        // $user_confirm = $this->eCommerceUser->confirm_user($user); // check if user exists in db
        // $user_confirm = $this->myUser->confirm_myuser($user); // check if user exists in db
        $user_confirm = $this->eCommerceUser_model->confirm_user($user);
        // see if user exists
        if ($user_confirm)
        {
            $this->session->set_flashdata('registration_errors','<p>User already exists</p>');
            redirect('/eCommerceUsers');
        }
        //Form Validation Rules
        $this->form_validation->set_rules('first_name','First Name', 'trim|required');
        $this->form_validation->set_rules('last_name','Last Name', 'trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
        $this->form_validation->set_rules('confirm_password','Confirm Password', 'trim|required|matches[confirm_password]');
        $this->form_validation->set_rules('secret','Secret','trim|required|min_length[1]');
       // hash the password with bcrypt
        $password = $user['password'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        // $this->session->set_flashdata('registration_errors',$hashed_password);
        if($this->form_validation->run()) //Was the form completed successfully?
        {
            if($user['secret'] == $secret)
            {
                // Create user
                $this->eCommerceUser_model->add_user_with_hash($user, $hashed_password, $secret);
                // update user flash
                $this->session->set_flashdata('form_success','You Have Successfully Registered!');
            }
        } 
        else 
        {
            //form issues
            $this->session->set_flashdata('registration_errors',validation_errors());
        }
        redirect('/eCommerceUsers');
    }
    public function login()
    {
        // log the user in
        $user = $this->input->post();
        $user_confirm = $this->eCommerceUser_model->confirm_user($user);
        if($user_confirm)
        {
            $this->eCommerceUser_model->add_visit($user_confirm); //track visits
            $this->session->set_userdata('first_name',$user_confirm['first_name']);
            $this->session->set_userdata('last_name', $user_confirm['last_name']);
            $this->session->set_userdata('email', $user_confirm['email']);
            $this->session->set_userdata('logged_in', 'true');
            if($user_confirm['is_admin'])
            {

                redirect('/eCommerceUsers/admin');
            }
            else
            {
                redirect('/eCommerceItems');
            }
        }
        else
        {
            $this->session->set_flashdata('registration_errors', "User does not exist!");
            redirect('/eCommerceUsers');
        }
    }

    public function login_with_secret()
    {
        // adding in password validation, a per user secret and password hashing.
        // log the user in
        $user = $this->input->post();
        $user_confirm = $this->eCommerceUser_model->confirm_user($user);
        // Validate Form and Confirm User
        //Form Validation Rules
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
        $this->form_validation->set_rules('secret','Secret','trim|required|min_length[1]');
        // Validate or redirect
        if(!$this->form_validation->run()) 
        {
            $this->session->set_flashdata('login_errors',validation_errors());
            redirect('/eCommerceUsers');
        } 
        if (!$user_confirm)
        {
            $this->session->set_flashdata('login_errors','User does not exist');
            redirect('/eCommerceUsers');
        }
        // Validate Hashed Password and Secret before logging in
        $password = $user['password'];
        $hashed_password = $user_confirm['password'];
        $verify = password_verify($password, $hashed_password);
        // Plus Secret
        if( ($verify) && ($user_confirm['secret'] == $user['secret']))
        // if( ($user_confirm['password'] == $user['password']) && ($user_confirm['secret'] == $user['secret']) )
        // if($user_confirm['password'] == $user['password'])
        {
            $this->eCommerceUser_model->add_visit($user_confirm); //track visits
            $this->session->set_userdata('first_name',$user_confirm['first_name']);
            $this->session->set_userdata('last_name', $user_confirm['last_name']);
            $this->session->set_userdata('email', $user_confirm['email']);
            $this->session->set_userdata('logged_in', 'true');
            if($user_confirm['is_admin'])
            {

                redirect('/eCommerceUsers/admin');
            }
            else
            {
                redirect('/eCommerceItems');
            }
        }
        else
        {
            $this->session->set_flashdata('errors', "There were errors with your login. Please check your credentials or contact the admin");
            redirect('/eCommerceUsers');
        }
    }
    public function admin()
    {
        // redirect to the admin page
        $get_data['items'] = $this->eCommerceItem_model->get_all_items();
        $this->load->view('eCommerce_admin', $get_data);
    }
    public function logout()
    {
        // foreach(array_keys($this->session->userdata) as $key)
        // {
        //     $this->session->unset_userdata($key);
        // }
        $this->session->sess_destroy();
        // redirect(base_url());
        // redirect('/eCommerceUsers');
        $this->load->view('eCommerce_login');
    }
}
?>