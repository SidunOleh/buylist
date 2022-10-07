<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/MY_Controller.php';

class Category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('category_model', 'model');
    }

    public function index()
    {        
        $categories = $this->model->index();
        $title      = 'Categories';

        return $this->load->view('categories/index', compact('categories', 'title'));
    }
}
