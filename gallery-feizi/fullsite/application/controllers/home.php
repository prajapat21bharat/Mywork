<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Installation script for
 *
 * @author NTF Module Generator
 */
class Home extends MY_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('query_model');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->data['images'] = $this->query_model->get_sql_select_data('home_slider');
    }

    public function index() {
        $c = $current_date = date("Y-m-d");
        $where = array("start_date <=" => $c, "end_date >=" => $c);
        $count = $this->query_model->get_joins('exhibitions', $where);

        if (count($count) > 0) {
            $this->data['current'] = $this->join($where, 'start_date DESC');
            $this->data['next'] = $this->next($this->data['current'][0]->end_date);
        } else {
            $where1 = array("end_date <" => $c);
            $this->data['current'] = $this->join($where1, 'start_date DESC');
            $this->data['next'] = $this->next($this->data['current'][0]->end_date);
        }
        
        $this->data['hometext']=  array_shift($this->query_model->get_sql_select_data('home_text'));

        $this->layout->view('home', $this->data);
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
        return $this->query_model->get_joins('exhibitions', $where, $join, $column, NULL, 'exhibitions.id', $order_by, 1);
    }

    public function search() {

        $keyword = $this->input->post('search');
        $my['search_data'] = $this->query_model->search($keyword);


        $this->layout->view('search', $my);
    }

}
