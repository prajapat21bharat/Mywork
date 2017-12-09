<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Installation script for
 *
 * @author NTF Module Generator
 */
class Exhibitions extends MY_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('query_model');
    }

    public function ex() {

        $c = $current_date = date("Y-m-d");
        $where = array("start_date <=" => $c, "end_date >=" => $c);
        $count = $this->query_model->get_joins('exhibitions', $where);

        if (count($count) > 0) {
            $where1 = array("end_date <" => $c);
            $this->data['current'] = $this->join($where, 'start_date DESC');
            $this->data['next'] = $this->next($this->data['current'][0]->end_date);
            $this->data['past'] = $this->join($where1, 'start_date DESC');
        } else {
            $where1 = array("end_date <" => $c);
            $this->data['current'] = $this->join($where1, 'start_date DESC');
            $this->data['next'] = $this->next($this->data['current'][0]->end_date);
            $this->data['past'] = $this->join($where1, 'start_date DESC');
        }
        return $this->data;
    }

    public function next($end) {
        $where1 = array("start_date >" => $end);
        return $this->query_model->get_sql_select_data('exhibitions', $where1, '', '', 'start_date ASC');
    }

    public function join($where, $order_by) {
        $join = array(array('table' => 'exhibitions_image',
                'condition' => 'exhibitions.id=exhibitions_image.exhibitions_id',
                'jointype' => 'left'));

        $column = array('exhibitions.*', 'GROUP_CONCAT(image) as image');
        return $this->query_model->get_joins('exhibitions', $where, $join, $column, NULL, 'exhibitions.id', $order_by);
    }

    public function index() {
        $this->ex();
        $this->layout->view('exhibitions_view', $this->data);
    }

    public function upcoming() {
        $this->ex();
        $this->layout->view('exhibitions_upcoming', $this->data);
    }

    public function past() {
        $this->ex();
        $this->layout->view('exhibitions_past', $this->data);
    }

    public function press_release() {
        $this->layout->view('exhibitions_press_release', $this->data);
    }

    public function artist() {
        $this->layout->view('exhibitions_artist', $this->data);
    }

    public function pdf() {
        $this->data['pdf'] = $this->uri->segment(3);
        $this->layout->view('document', $this->data);
    }

    public function name($id) {
        $where = array('ID' => $id);
        $name = $this->query_model->get_sql_select_data('user_profile', $where, 'first_name');
        return $name[0]->first_name;
    }

    /*
      public function imgResizeThumb($imgName){

      $this->load->library('image_lib');
      $config['image_library'] = 'gd2';
      $config['source_image'] = './uploads/'.$imgName;
      $config['create_thumb'] = TRUE;
      $config['maintain_ratio'] = false;
      $config['height'] = 90;
      $config['width'] = 100;
      $config['new_image'] = './uploads/thumb_new/'.$imgName;
      $this->load->library('image_lib', $config);
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      } */
}
