<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/MY_Controller.php';

class Buy extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('buy_model', 'model');
    }

    public function index()
    {
        $buys = $this->model->index();
        
        $this->load->model('category_model', 'category');
        $categories = $this->category->index();

        $title = 'List';

        $this->load->view('buys/index', compact('buys', 'categories', 'title'));
    }

    public function buy($id)
    {
        $response['status'] = $this->model->buy($id);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function cat_exist($cat_id)
    {
        $result = $this->db->where('id', $cat_id)->get('categories');

        if (! $result->result()) {
            $this->form_validation->set_message('cat_exist', 'The category doesn\'t exist.');
            
            return false;
        }

        return true;
    }
}
