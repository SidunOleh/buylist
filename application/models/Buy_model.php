<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy_model extends CI_Model
{
    public $name;
    public $status;
    public $category_id;
    public $created_at;

    public function index()
    {
        $result = $this->db
            ->select('b.*, c.name as category_name')
            ->from('buys as b')
            ->join('categories as c', 'c.id = b.category_id')
            ->order_by('created_at', 'DESC')
            ->get();

        return $result->custom_result_object('Buy_model');
    }

    public function show($id)
    {
        $result = $this->db
            ->select('b.*, c.name as category_name')
            ->from('buys as b')
            ->join('categories as c', 'c.id = b.category_id')
            ->where('b.id', $id)
            ->get();

        return $result->custom_result_object('Buy_model')[0];
    }

    public function store($data)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');
        $this->form_validation->set_rules('category_id', 'Category', 'required|integer|callback_cat_exist');
        
        if (! $this->form_validation->run()) {
            throw new Validation_Exception($this->form_validation->error_array());
        }

        $this->name        = $data['name'];
        $this->status      = 'not bought';
        $this->category_id = $data['category_id'];
        $this->created_at  = date('Y-m-d h:i:s');

        $this->db->insert('buys', $this);

        $new_buy = $this->show($this->db->insert_id());

        return $new_buy;
    }

    public function buy($id)
    {
        $this->db->set('status', 'bought')->where('id', $id);
        
        return $this->db->update('buys');
    }

    public function delete($id)
    {
        return $this->db->delete('buys', array('id' => $id,));
    }
}
