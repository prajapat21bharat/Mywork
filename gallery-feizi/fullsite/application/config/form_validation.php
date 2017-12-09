<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------
  | USER AGENT TYPES
  | -------------------------------------------------------------------
  | This file contains four arrays of user agent data.  It is used by the
  | User Agent Class to help identify browser, platform, robot, and
  | mobile device data.  The array keys are used to identify the device
  | and the array values are used to set the actual name of the item.
  |
 */

$config = array(
    'add_restaurant_admin' => array(
        array(
            'field' => 'restaurant_name',
            'label' => 'Restaurant Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'owner_id',
            'label' => 'Owner Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'zip_code',
            'label' => 'Zip Code',
            'rules' => 'required'
        ),
        array(
            'field' => 'restaurant_type',
            'label' => 'Resturant Type',
            'rules' => 'required'
        ),
        array(
            'field' => 'city_id',
            'label' => 'City',
            'rules' => 'required'
        ),
        array(
            'field' => 'state_id',
            'label' => 'State',
            'rules' => 'required'
        ),
        array(
            'field' => 'restaurant_address',
            'label' => 'Address',
            'rules' => 'required'
        ),
        array(
            'field' => 'restaurant_cuisines',
            'label' => 'Cuisines Type',
            'rules' => 'required'
        ),
        array(
            'field' => 'restaurant_phone',
            'label' => 'Contact No.',
            'rules' => 'required'
        )
    ),
    'edit_owner_restaurant' => array(
        array(
            'field' => 'restaurant_name',
            'label' => 'Restaurant Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'zip_code',
            'label' => 'Zip Code',
            'rules' => 'required'
        ),
        array(
            'field' => 'city_id',
            'label' => 'City',
            'rules' => 'required'
        ),
        array(
            'field' => 'state_id',
            'label' => 'State',
            'rules' => 'required'
        ),
        array(
            'field' => 'restaurant_address',
            'label' => 'Address',
            'rules' => 'required'
        ),
        array(
            'field' => 'restaurant_cuisines',
            'label' => 'Cuisines Type',
            'rules' => 'required'
        ),
        array(
            'field' => 'restaurant_phone',
            'label' => 'Contact No.',
            'rules' => 'required'
        )
    ),
    'menu_item' => array(
        array(
            'field' => 'menu_id',
            'label' => 'Menu type',
            'rules' => 'required'
        ),
        array(
            'field' => 'menu_categories_id',
            'label' => 'Menu',
            'rules' => 'required'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
        //'field' => 'menu_item_price',
        // 'label' => 'Price',
        //'rules' => 'required|numeric'
        ),
        array(
            'field' => 'menu_item_discription',
            'label' => 'Description',
            'rules' => 'required'
        )
    ),
    'event' => array(
        array(
            'field' => 'restaurant_id',
            'label' => 'Restaurant',
            'rules' => 'required'
        ),
        array(
            'field' => 'event_title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'event_vanue',
            'label' => 'Vanue',
            'rules' => 'required'
        ),
        array(
            'field' => 'start_time',
            'label' => 'Start Time',
            'rules' => 'required'
        ),
        array(
            'field' => 'end_time',
            'label' => 'End Time',
            'rules' => 'required'
        ),
        array(
            'field' => 'start_date',
            'label' => 'Start Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'end_date',
            'label' => 'End Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'event_description',
            'label' => 'Description',
            'rules' => 'required'
        )
    ),
    'offers' => array(
        array(
            'field' => 'restaurant_id',
            'label' => 'Restaurant',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_website',
            'label' => 'Web site',
            'rules' => 'required'
        ),
        array(
            'field' => 'start_time',
            'label' => 'Start Time',
            'rules' => 'required'
        ),
        array(
            'field' => 'end_time',
            'label' => 'End Time',
            'rules' => 'required'
        ),
        array(
            'field' => 'start_date',
            'label' => 'Start Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'end_date',
            'label' => 'End Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_description',
            'label' => 'Description',
            'rules' => 'required'
        )
    ),
    'city_offers' => array(
        array(
            'field' => 'state_type',
            'label' => 'State',
            'rules' => 'required'
        ),
        array('field' => 'input_city',
            'label' => 'City',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_website',
            'label' => 'Web site',
            'rules' => 'required'
        ),
        array(
            'field' => 'start_date',
            'label' => 'Start Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'end_date',
            'label' => 'End Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_description',
            'label' => 'Description',
            'rules' => 'required'
        )
    ),
    'city_offers_update' => array(
        array(
            'field' => 'state_code',
            'label' => 'State',
            'rules' => 'required'
        ),
        array('field' => 'city_code',
            'label' => 'City',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_website',
            'label' => 'Web site',
            'rules' => 'required'
        ),
        array(
            'field' => 'start_date',
            'label' => 'Start Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'end_date',
            'label' => 'End Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'offer_description',
            'label' => 'Description',
            'rules' => 'required'
        )
    ),
    'edit_restaurant_menu' => array(
        array(
            'field' => 'select_menu',
            'label' => 'Menu',
            'rules' => 'required'
        )
    ),
    'cluster' => array(
        array(
            'field' => 'cluster_name',
            'label' => 'cluster name',
            'rules' => 'required'
        ),
        array(
            'field' => 'input_ststes',
            'label' => 'State ',
            'rules' => 'required'
        ),
        array(
            'field' => 'input_city',
            'label' => 'City',
            'rules' => 'required'
        )
    ),
    'change_pass' => array(
        array(
            'field' => 'user_name',
            'label' => 'User Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'old_password',
            'label' => 'Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'new_password',
            'label' => 'New Password',
            'rules' => 'trim|required|alpha_numeric|min_length[6]'
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Password',
            'rules' => 'trim|required|matches[new_password]'
        )
    ),
    'works_validation' => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'dimension',
            'label' => 'Dimension',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'edition',
            'label' => 'Edition',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'market_price',
            'label' => 'Market Price',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'remark',
            'label' => 'Remark',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'start_date',
            'label' => 'Date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'category_type',
            'label' => 'Category Type',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'workdes',
            'label' => 'Work Description',
            'rules' => 'trim|required'
        ),
    ),
    'hometext' => array(
        array(
            'field' => 'c_title',
            'label' => 'Top Title',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'u_title',
            'label' => 'Bootom Title',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'c_exhibition',
            'label' => 'Top Heading',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'u_exhibition',
            'label' => 'Bootom Heading',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'c_start_date',
            'label' => 'Top start date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'c_end_date',
            'label' => 'Top End date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'u_start_date',
            'label' => 'Bootom start date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'u_end_date',
            'label' => 'Bootom End date',
            'rules' => 'trim|required'
        ),
        
    ),
);



