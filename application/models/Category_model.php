<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public $name;

    public function index()
    {
        $result = $this->db->get('categories');
        
        return $result->custom_result_object('Category_model');
    }

    public function show($id) {
        $result = $this->db->where('id', $id)->get('categories');

        return $result->custom_result_object('Category_model')[0];
    }

    public function store($data)
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');

        if (! $this->form_validation->run()) {
            throw new Validation_Exception($this->form_validation->error_array());
        }

        $this->name = $data['name'];

        $this->db->insert('categories', $this);

        $new_cat = $this->show($this->db->insert_id());

        return $new_cat;
    }

    public function delete($id)
    {
        $this->db->trans_start();
        $this->db->delete('buys', array('category_id' => $id,));
        $this->db->delete('categories', array('id' => $id,));
        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}
