<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config=array(
	'login_get'=>array(
			array('field'=>'loginid','label'=>'Loginid','rules'=>'required'),
			//array('field'=>'password','label'=>'Password','rules'=>'required'),
		),
	'policybyid_get'=>array(
			array('field'=>'policyid','label'=>'Policy id','rules'=>'required'),
		),
	'sellerlogin_get'=>array(
			array('field'=>'loginid','label'=>'Loginid','rules'=>'required'),
			array('field'=>'password','label'=>'Password','rules'=>'required'),
		),
	'buyerlogin_get'=>array(
			array('field'=>'loginid','label'=>'Loginid','rules'=>'required'),
			array('field'=>'password','label'=>'Password','rules'=>'required'),
		),
	'getCitiareas_get'=>array(
			array('field'=>'cityId','label'=>'City Id','rules'=>'required'),
			//array('field'=>'password','label'=>'Password','rules'=>'required'),
		),
	'subcategory_get'=>array(
			array('field'=>'parentid','label'=>'Parent Id','rules'=>'required'),
		),
	'getchildcateProduct_get'=>array(
			array('field'=>'catg_id','label'=>'Parent Id','rules'=>'required'),
		),
	'city_special_details_get'=>array(
			array('field'=>'seller_id','label'=>'Seller Id','rules'=>'required'),
		),
	'search_get'=>array(
			array('field'=>'keyword','label'=>'Search Keyword','rules'=>'required'),
		),
	'applyCoupan_get'=>array(
			array('field'=>'coupancode','label'=>'Coupan Code','rules'=>'required'),
			array('field'=>'product_id','label'=>'Product Id','rules'=>'required'),
		),
	'productById_get'=>array(
			array('field'=>'product_id','label'=>'Product Id','rules'=>'required'),
		),
	'buyerReviews_get'=>array(
			array('field'=>'product_id','label'=>'Product Id','rules'=>'required'),
			array('field'=>'buyer_id','label'=>'Buyer Id','rules'=>'required'),
		),
	'addOffer_get'=>array(
			array('field'=>'seller_id','label'=>'Sellerid','rules'=>'required'),
			array('field'=>'coupon_code','label'=>'Coupon Code','rules'=>'required'),
			array('field'=>'offer_type','label'=>'Offer Type','rules'=>'required'),
			array('field'=>'product_id','label'=>'Product Id','rules'=>'required'),
			array('field'=>'offer_upto','label'=>'Offer Upto','rules'=>'required'),
		),
	'addProduct_get'=>array(
			array('field'=>'productname','label'=>'Product Name','rules'=>'required'),
			array('field'=>'description','label'=>'Description','rules'=>'required'),
			array('field'=>'category','label'=>'Category','rules'=>'required'),
		//	array('field'=>'brand','label'=>'Brand','rules'=>'required'),
			array('field'=>'unit','label'=>'Unit','rules'=>'required'),
			array('field'=>'productsize','label'=>'Product Size','rules'=>'required'),
		//	array('field'=>'stock','label'=>'Stock','rules'=>'required'),
			array('field'=>'price','label'=>'Price','rules'=>'required'),
		),
	'become_seller_get'=>array(
			array('field'=>'firstname','label'=>'First Name','rules'=>'required'),
			array('field'=>'lastname','label'=>'Last Name','rules'=>'required'),
			array('field'=>'email','label'=>'Email','rules'=>'required'),
			array('field'=>'contactno','label'=>'Phone No','rules'=>'required'),
			array('field'=>'business_name','label'=>'Business Name','rules'=>'required'),
			array('field'=>'tin','label'=>'TIN','rules'=>'required'),
			array('field'=>'business_address','label'=>'Business Address','rules'=>'required'),
			array('field'=>'business_city','label'=>'Business City','rules'=>'required'),
			array('field'=>'working_area','label'=>'Working Area','rules'=>'required'),
			array('field'=>'working_start','label'=>'Working Hours Start','rules'=>'required'),
			array('field'=>'working_end','label'=>'Working Hours End','rules'=>'required'),
			array('field'=>'holidays','label'=>'Holidays','rules'=>'required'),
			array('field'=>'min_order_amt','label'=>'Minimum order amount (in INR)','rules'=>'required'),
			array('field'=>'min_no_order_items','label'=>'Minimum number of items','rules'=>'required'),
			array('field'=>'delivery_charges','label'=>'Delivery Charges','rules'=>'required'),
			array('field'=>'delivery_time','label'=>'Time to deliver','rules'=>'required'),
			array('field'=>'remark','label'=>'Remark','rules'=>'required'),
			array('field'=>'city_special','label'=>'City Special','rules'=>'required'),
		),
);


?>
