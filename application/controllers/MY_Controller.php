<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Validation_Exception.php';

abstract class MY_Controller extends CI_Controller
{   
    public function store()
    {        
        try {
            $new = $this->model->store($this->input->post());

            $response = array('status' => true, 'new' => $new,);
        } catch (Validation_Exception $e) {
            $response = array('status' => false, 'errors' => $e->errors(),);
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete($id)
    {
        $response['status'] = $this->model->delete($id);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
