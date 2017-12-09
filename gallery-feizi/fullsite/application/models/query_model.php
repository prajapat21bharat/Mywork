<?php

/*
 * Unit_model
 * An easier way to construct your unit testing
 * and pass it to a really nice looking page.
 *
 * @author sjlu
 */

class Query_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->library('session');
    }

    public function INSERTDATA($tablename, $feild = '') {

        if (!empty($tablename) && !empty($feild)):
            $this->db->set($feild);
            $insert = $this->db->insert($tablename);
            if ($insert):
                return $this->db->insert_id();
            endif;
        else: return "Invalid Input Provided";
        endif;
    }

//New Insert function for data 31 july
    function insertDataFromUser($tablename, $data) {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }

    public function UPDATEDATA($tablename, $where = '', $feild = '') {

        if (!empty($tablename) && !empty($feild)):

            $this->db->where($where);

            $this->db->update($tablename, $feild);

        else: return "Invalid Input Provided";

        endif;
    }

    public function DELETEDATA($tablename = '', $where = '') {

        if (!empty($tablename) && !empty($where)):

            $this->db->where($where);

            $this->db->delete($tablename);

        else: return "Invalid Input Provided";

        endif;
    }

    public function get_joins($table = '', $where = '', $joins = '', $columns = '', $like = '', $group_by = '', $order_by = '', $limit = '', $start = '') {

        if (!empty($columns))
            $this->db->select($columns);

        if (empty($columns))
            $this->db->select();

        if (is_array($joins) && count($joins) > 0) {

            foreach ($joins as $k => $v) {

                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }

        if (!empty($group_by))
            $this->db->group_by($group_by);

        if (!empty($like))
            $this->db->like($like);

        if (!empty($limit))
            $this->db->limit($limit, $start);

        if (!empty($where))
            $this->db->where($where);

        if (!empty($order_by))
            $this->db->order_by($order_by);

        $this->db->from($table);
        return $this->db->get()->result();
    }

    public function get_sql_select_data($tablename, $where = '', $feild = '', $limit = '', $order_by = '', $like = '') {

        if (!empty($feild))
            $this->db->select($feild);

        if (empty($feild))
            $this->db->select();

        if (!empty($where))
            $this->db->where($where);

        if (!empty($limit))
            $this->db->limit($limit);

        if (!empty($like))
            $this->db->like($like);

        if (!empty($order_by))
            $this->db->order_by($order_by);

        $this->db->from($tablename);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_sql_select_data_ajax($tablename, $where = '', $feild = '', $limit = '', $order_by = '') {

        if (!empty($feild))
            $this->db->select($feild);

        if (empty($feild))
            $this->db->select();

        if (!empty($where))
            $this->db->where($where);

        if (!empty($limit))
            $this->db->limit($limit);

        if (!empty($order_by))
            $this->db->order_by($order_by);

        $this->db->from($tablename);

        $query = $this->db->get();

        return $query->result();
    }

    public function user_info($where = '', $limit = '', $feild = '') {

        if (empty($feild))
            $this->db->select('*');

        if (!empty($feild))
            $this->db->select($feild);

        $this->db->from('user');

        $this->db->join('user_profile', 'user.user_id = user_profile.user_id');

        if (!empty($where))
            $this->db->where($where);

        if (!empty($limit))
            $this->db->limit($limit);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_joinss($table = '', $where = '', $columns = '', $joins = '', $group_by = '') {

        $this->db->select($columns)->from($table);

        if (is_array($joins) && count($joins) > 0) {

            foreach ($joins as $k => $v) {

                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }

        if (!empty($where))
            $this->db->where($where);

        if (!empty($group_by))
            $this->db->group_by($group_by);

        return $this->db->get()->result();
    }

    public function get_joins_ajax($table, $where, $columns, $joins, $group = '', $order_by = '', $like = '') {

        $this->db->select($columns)->from($table);

        if (is_array($joins) && count($joins) > 0) {
            foreach ($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }

        $this->db->where($where);

        if (!empty($like))
            $this->db->like($like);

        if (!empty($group))
            $this->db->group_by($group);

        if (!empty($order_by))
            $this->db->order_by($order_by);

        return $this->db->get()->result();
    }

    public function user_view($limit = '', $start = '', $order_by = '') {

        $this->db->from('user_profile');
        $this->db->where('user_id !=', '1');
        if (!empty($limit))
            $this->db->limit($limit, $start);
        if (!empty($order_by))
            $this->db->order_by($order_by);

        $query = $this->db->get();
        return $query->result();
    }

    /*     * ** Get Image By Past Select Image****** */

    public function GetImagesByUid($id) {
        $this->db->select('image');
        $this->db->from('exhibitions_image');
        $this->db->where('exhibitions_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    /*     * ** Get Image By For Artist Press****** */

    public function GetArtistImageId($id) {
        $this->db->select('image');
        $this->db->from('press_image');
        $this->db->where('press_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function search($keyword) {

        /* 	$query = "(SELECT content, title, 'msg' as type FROM messages WHERE content LIKE '%" . 
          $keyword . "%' OR title LIKE '%" . $keyword ."%')
          UNION
          (SELECT content, title, 'topic' as type FROM topics WHERE content LIKE '%" .
          $keyword . "%' OR title LIKE '%" . $keyword ."%')
          UNION
          (SELECT content, title, 'comment' as type FROM comments WHERE content LIKE '%" .
          $keyword . "%' OR title LIKE '%" . $keyword ."%')";

         */
        $query = "(SELECT f.title as title,f.start_date,f.end_date,f.description,u.image, f.description as palais,'exhibitions' as tableName FROM exhibitions AS f INNER JOIN exhibitions_image AS u ON f.user_id = u.user_id WHERE f.title LIKE '%$keyword%')

            UNION 

			(SELECT n.title1,n.start_date,n.end_date,n.description,ni.image,n.palais as palais, 'news' as tableName FROM news AS n INNER JOIN news_image AS ni ON n.id = ni.news_id WHERE n.title1 LIKE '%$keyword%')";




        $query = $this->db->query($query);


        return $query->result();
    }
    
    
    
    
    
    public function url($id){
        
        $where = array('ID'=>$id);
        $next= array_shift($this->get_sql_select_data('user_profile',$where));

        $zname_clean = strtolower($next->first_name);
        return $next = str_replace(' ','-',$zname_clean);

    }

 public function GetArtistCatname($id) {
        $this->db->select('cat_name');
        $this->db->from('category');
        $this->db->where('cat_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
 public function GetArtistIdById($id) {
        $this->db->select('cat_id');
        $this->db->from('works');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
}
