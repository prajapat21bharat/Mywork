<?php

if (!defined('BASEPATH'))
    die();

class Home extends Admin_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();

        $this->load->model('query_model');
        $this->load->library('pagination');
        $this->load->library('table');
        $this->load->library('upload');
        $this->load->helper('ckeditor');
        if ($this->session->userdata('group') != '1')
            $this->redirect();
        $this->data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'content',
            'path' => 'ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => array(//Setting a custom toolbar
                    array('Bold', 'Italic'),
                    array('Underline', 'FontSize', 'TextColor'),
                    array('Smiley'),
                ), //Using the Full toolbar
                'width' => "", //Setting a custom width
                'height' => '200px', //Setting a custom height
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
    }

    public function index() {
        $this->user_profile();
    }

    ###-------User_profile  ---#####

    public function user_profile() {
        //$city = $this->uri->segment(4);
        $config['base_url'] = site_url() . 'admin/home/user_profile/';
        $config['total_rows'] = count($this->query_model->user_view());
        $config['per_page'] = 20;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $order_by = 'user_id DESC';
        $data = array('records' => $this->query_model->user_view($config["per_page"], $page, $order_by),
            'links' => $this->pagination->create_links(),
            'city_id' => $this->uri->segment(4),
            'base_url' => $config['base_url'],
            'per_page' => $config['per_page']);

        $this->layout->view('admin/user_profile_list', $data);
    }

    public function delete_user() {

        if (!$this->input->is_ajax_request())
            $this->cms_redirect();

        $where = array('ID' => $this->query_model->input->Get('user_id'));

        $del = array('user_id' => $this->query_model->input->Get('user_id'));




        $image1 = array('userfile');
        $img1 = $this->query_model->get_sql_select_data_ajax('user_profile', $where, $image1);
        if ($img1) {
            $path1 = './uploads/' . $img1[0]->userfile;

            unlink($path1);
        }

        $image = array('image');
        $img = $this->query_model->get_sql_select_data('works_image', $del, $image);

        if ($img) {
            foreach ($img as $imgs) {
                echo $path = '././uploads/' . $imgs->image;

                unlink($path);
            }
        }


        $img2 = $this->query_model->get_sql_select_data('exhibitions_image', $del, $image);

        if ($img2) {
            foreach ($img2 as $imgs) {
                echo $path2 = '././uploads/' . $imgs->image;

                unlink($path2);
            }
        }
        $this->query_model->DELETEDATA('user_profile', $where);
        $this->query_model->DELETEDATA('works', $del);
        $this->query_model->DELETEDATA('works_image', $del);
        $this->query_model->DELETEDATA('exhibitions', $del);
        $this->query_model->DELETEDATA('exhibitions_image', $del);
        $this->query_model->DELETEDATA('bid', $del);
        $this->query_model->DELETEDATA('news', $del);
        $this->query_model->DELETEDATA('press', $del);
        $this->query_model->DELETEDATA('publications', $del);

        // redirect(site_url()."admin/home/user_profile_view/")
    }

    public function user_profile_view() {
        $where1 = array('ID' => $this->uri->segment(4));
        $user_data['user_info'] = $this->query_model->get_sql_select_data_ajax('user_profile', $where1);
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        //	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');			
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        //$this->form_validation->set_rules('user_phone', 'Contact Number', 'trim|required|numeric');
        $this->form_validation->set_rules('userimg', 'User File', 'trim|required');
        $this->form_validation->set_rules('order_type', 'Sort images', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('admin/user_profile_edit', $user_data);
        } else {
            $user_id = $this->input->post('ID');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $gender = $this->input->post('gender');
			$typeOfRep  = $this->input->post('typeOfRep');
            $user_phone = $this->input->post('user_phone');
            $userimg = $this->input->post('userimg');
            $order_type = $this->input->post('order_type');

            $where = array('ID' => $user_id);
            $data = array('first_name' => $first_name,
                'last_name' => $last_name,
                'gender' => $gender,
				'typeOfRep'=>$typeOfRep,
                'user_phone' => $user_phone,
                'userfile' => $userimg,
                'order_type' => $order_type
            );

            $this->query_model->updatedata('user_profile', $where, $data);

            $config['upload_path'] = './uploadimages/user/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->upload->initialize($config);
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $user_data['error'] = $this->upload->display_errors();
                    $this->layout->view('admin/user_profile_edit', $user_data);
                } else {
                    $uploads = array($this->upload->data());
                    foreach ($uploads as $key => $value) {
                        $randomcode = random_string('alnum', 16);
                        $newimagename = $randomcode . $value['file_ext'];
                        rename($value['full_path'], $uploads[0]['file_path'] . $newimagename);
                    }
                    $data['userfile'] = $newimagename;

                    $this->query_model->updatedata('user_profile', $where, $data);
                    redirect(site_url() . "admin/home/user_profile_view/" . $user_id);
                }
            }
            $this->session->set_flashdata('message', 'Profile successfully updated.');
            redirect(site_url() . "admin/home/user_profile_view/" . $user_id);
        }
    }

    public function upload_photo_vedio() {

        if ($this->input->is_ajax_request()) {
            $video_extension_array = array('swf', 'wmv', 'mp4', 'ogg');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->upload->initialize($config);
            $files_header = $_FILES;
            $cpt_header = count($_FILES['myfile']['name']);

            for ($i = 0; $i < $cpt_header; $i++) {

                $_FILES['myfile']['name'] = $files_header['myfile']['name'][$i];
                $_FILES['myfile']['type'] = $files_header['myfile']['type'][$i];
                $_FILES['myfile']['tmp_name'] = $files_header['myfile']['tmp_name'][$i];
                $_FILES['myfile']['error'] = $files_header['myfile']['error'][$i];
                $_FILES['myfile']['size'] = $files_header['myfile']['size'][$i];
                $dirpath = './uploads/';
                $this->upload->initialize($this->set_upload_options_header($dirpath));
                if ($this->upload->do_upload('myfile')) {
                    $data = $this->upload->data('myfile');
                    $name = rand() . time();
                    rename($data['file_path'] . $data['file_name'], $data['file_path'] . $name . $data['file_ext']);
                    echo $name . $data['file_ext'];
                }
            }
        }
    }

    private function set_upload_options_header($dp) {
        $config = array();
        $path = $config['upload_path'] = $dp;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|video/mp4';
        $config['overwrite'] = FALSE;
        return $config;
    }

    public function user_active_inactive() {
        if (!$this->input->is_ajax_request())
            $this->redirect();
        $where = array('ID' => $this->input->Get('user_id'));
        $feild = array('status' => $this->input->Get('active'));
        $this->query_model->UPDATEDATA('user_profile', $where, $feild);
        print_r($this->input->Get('active'));
    }

    public function home_slider() {

        $data['home_slider'] = $this->query_model->get_sql_select_data('home_slider', NULL);
        //var_dump($data['home_slider']); 
        if (!isset($_POST['submit'])) {
            $this->layout->view('admin/homeslide_view', $data);
        } else {

            $page_cont = $this->input->post('slide_image');

            /* --file upload---- */
            $config['upload_path'] = './uploads/profile/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('slide_image')) {

                $uploads = array($this->upload->data('slide_image'));

                foreach ($uploads as $key => $value) {
                    $randomcode = random_string('alnum', 16);
                    $newimagename = $randomcode . $value['file_ext'];
                    rename($value['full_path'], $uploads[0]['file_path'] . $newimagename);

                    $page_cont['slide_image'] = $newimagename;

                    $this->query_model->INSERTDATA('home_slider', $page_cont);
                }
            }
            redirect(site_url() . 'admin/home/home_slider');
        }
    }

    public function homeslide_delete() {
        if ($this->input->is_ajax_request()) {
            $where_delete = array('slide_id' => $this->input->post('slide_id'));
            $this->query_model->DELETEDATA('home_slider', $where_delete);
            echo '1';
        }
    }
    
    function hometext(){
        $data['hometext'] = array_shift($this->query_model->get_sql_select_data('home_text'));         
        $data['msg']='';
        
        if($this->form_validation->run('hometext')==FALSE){
          $this->layout->view('admin/home_text_view', $data);
        }else{
            
            $feild=$this->input->post();
             $feild['c_date']=$feild['c_start_date'].' > '. $feild['c_end_date'];
             $feild['u_date']=$feild['u_start_date'].' > '. $feild['u_end_date'];
             
            unset($feild['c_start_date']);
            unset($feild['c_end_date']);                   
            unset($feild['u_start_date']);
            unset($feild['u_end_date']);            
            $this->query_model->updatedata('home_text', array('ht_id'=>'1'), $feild);
            
            
            $data['msg']='Data Successfully Submitted';
            $data['hometext'] = array_shift($this->query_model->get_sql_select_data('home_text'));
           $this->layout->view('admin/home_text_view', $data); 
            
        }
        
    }

}

