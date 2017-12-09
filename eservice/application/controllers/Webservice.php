<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Webservice extends REST_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	

	function addProduct_get()
	{
		$productname=$this->get('productname');
		$description=$this->get('description');
		$category=$this->get('category');
		$sub_category=$this->get('sub_category');
		$brand=$this->get('brand');
		$unit=$this->get('unit');
		$productsize=$this->get('productsize');
		$stock=$this->get('stock');
		$price=$this->get('price');
		$this->form_validation->set_data(array('productname'=>$productname,
											'description'=>$description,
											'category'=>$category,
											'unit'=>$unit,
											'productsize'=>$productsize,
											'stock'=>$stock,
											'price'=>$price,
								));
		if($this->form_validation->run('addProduct_get')!==false)
		{
		
			$insertdata=array(
							'catg_id'=>$category,
							'child_id'=>$sub_category,
							'prod_detail'=>$productname,'description'=>$description,
							'size'=>$productsize,'unit'=>$unit,'mrp'=>$price,
							'is_product'=>$is_product,
							);
			$product=$this->user_model->INSERTDATA('products',$insertdata);
			if($product)
			{
				$this->response(array('status'=>'true','message'=>'Product Added Successfully'));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'Registration Failed'));
			}
			
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	function addOffer_get()
	{
		$seller_id=$this->get('seller_id');
		$product_id=$this->get('product_id');
		$coupon_code=$this->get('coupon_code');		//
		$offer_type=$this->get('offer_type');		//
		$offer_from=$this->get('offer_from');		
		$offer_upto=$this->get('offer_upto');		//
		$disc_type=$this->get('disc_type');			
		$disc_perc_amt=$this->get('disc_perc_amt');		
		$Times_used_peruser=$this->get('Times_used_peruser');		//
		$Time_used_total=$this->get('Time_used_total');		
		
		$this->form_validation->set_data(array('seller_id'=>$seller_id,
									'coupon_code'=>$coupon_code,
									'offer_type'=>$offer_type,
									'product_id'=>$product_id,
									'offer_upto'=>$offer_upto,
						));
		if($this->form_validation->run('addOffer_get')!==false)
		{
			$chk_offer=array(
								'seller_id'=>$seller_id,
								'coupon_code'=>$coupon_code,
								'offer_type'=>$offer_type,
								'product_id'=>$product_id,
								'offer_upto'=>$offer_upto,
								'Active'=>1
								);
			$is_exists=$this->user_model->get_joins('product_offer',$chk_offer);
			if(!empty($is_exists))
			{
				$this->response(array('status'=>'false','message'=>'User Already Exists'),REST_Controller::HTTP_BAD_REQUEST);
			}
			else
			{
				$insertdata=array(
								'seller_id'=>$seller_id,
								'coupon_code'=>$coupon_code,
								'offer_type'=>$offer_type,
								'product_id'=>$product_id,
								'offer_upto'=>$offer_upto,
								'Active'=>1,
								'entry_date'=>date('Y-m-d H:i:s'),
								);
				$offer=$this->user_model->INSERTDATA('product_offer',$insertdata);
				if($offer)
				{
					$this->response(array('status'=>'true','message'=>'Offer Added Successfully'));
				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Offer Not Added'));
				}
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
		
	function getSlider_get()
	{
		$slider=array();
		$is_exists=$this->user_model->get_joins('frontpage_image',
				array('image_for'=>'SLIDER','status'=>'ACTIVE', 'from_date <='=>date('Y-m-d') ,'to_date<='=>date('Y-m-d'))); 
		if(!empty($is_exists))
		{
			$i=0;
			foreach($is_exists as $data)
			{
				$slider[$i]['img_id']=$data['img_id'];
				//$slider[$i]['img_name']=base_url('index.php/assets/images/'.$data['img_name']);
				$slider[$i]['img_name']='http://aadhaghanta.com/frontpage_image/'.$data['img_name'];
				$i++;
			}
			$this->response(array('status'=>'true','message'=>$slider));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->db->last_query()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
		
	function getAdvtSlider_get()
	{
		$slider=array();
		$is_exists=$this->user_model->get_joins('frontpage_image',
				array('image_for'=>'ADVERTISEMENT','status'=>'ACTIVE', 'from_date <='=>date('Y-m-d') ,'to_date<='=>date('Y-m-d'))); 
		if(!empty($is_exists))
		{
			$i=0;
			foreach($is_exists as $data)
			{
				$slider[$i]['img_id']=$data['img_id'];
				//$slider[$i]['img_name']=base_url('index.php/assets/images/'.$data['img_name']);
				$slider[$i]['img_name']='http://aadhaghanta.com/frontpage_image/'.$data['img_name'];
				$i++;
			}
			$this->response(array('status'=>'true','message'=>$slider));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->db->last_query()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function allCategory_get()
	{
		$all_cate=$this->user_model->get_joins('category',array('status'=>'ACTIVE','parent_id'=>0),'',array('catg_id','category'));
		//print_r($is_exists);exit('u');
		if(!empty($all_cate))
		{
			$this->response(array('status'=>'true','message'=>$all_cate));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function allSubCategory_get()
	{
		$parentid=$this->get('parentid');
		$this->form_validation->set_data(array('parentid'=>$parentid));
		if($this->form_validation->run('subcategory_get')!==false)
		{
				
			$all_cate=$this->user_model->get_joins('category',array('status'=>'ACTIVE','parent_id'=>$parentid),'',array('category','catg_id'));
			//print_r($is_exists);exit('u');
			if(!empty($all_cate))
			{
				$this->response(array('status'=>'true','message'=>$all_cate));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function city_special_get()
	{
		$fields=array('seller_detail.seller_id','seller_detail.company_name');
		$city_special=array();
		$join=array(
						array('table'=>'seller_detail','condition'=>'seller_detail.seller_id = city_special.seller_id', 'jointype'=>'inner'),
						);
		$is_exists=$this->user_model->get_joins('city_special','',$join,$fields);
		if(!empty($is_exists))
		{
			$this->response(array('status'=>'true','message'=>$is_exists));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No City Special Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}
	
	/*Working*/
	function city_special_details_get()
	{
		$seller_id=$this->get('seller_id');
		$this->form_validation->set_data(array('seller_id'=>$seller_id));
		if($this->form_validation->run('city_special_details_get')!==false)
		{
			$fields=array('product_mast.product_id','product_mast.catg_id','product_mast.brand_id','product_mast.product_name','product_mast.product_description','product_mast.product_image','product_mast.mrp','product_price.sale_price','product_mast.seller_id');
			$city_special=array();
			$join=array(
							array('table'=>'seller_detail','condition'=>'seller_detail.seller_id = product_mast.seller_id', 'jointype'=>'inner'),
							array('table'=>'product_price','condition'=>'product_price.product_id = product_mast.product_id', 'jointype'=>'inner'),
							//array('table'=>'city_special','condition'=>'product_mast.seller_id = city_special.seller_id', 'jointype'=>'inner'),
						);
			$is_exists=$this->user_model->get_joins('product_mast',array('product_mast.seller_id'=>$seller_id),$join,$fields);
			if(!empty($is_exists))
			{
				$this->response(array('status'=>'true','message'=>$is_exists));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Product Found For This Seller'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	function citySpecial_desc_get()
	{
		$product_id=$this->get('product_id');
		$this->form_validation->set_data(array('product_id'=>$product_id));
		if($this->form_validation->run('productById_get')!==false)
		{
			$join=array(
				array('table'=>'product_price','condition'=>'product_price.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'product_image','condition'=>'product_image.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'seller_detail','condition'=>'seller_detail.seller_id = product_mast.seller_id', 'jointype'=>'inner'),
				array('table'=>'user_review','condition'=>'user_review.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'city_special','condition'=>'city_special.seller_id = product_mast.seller_id', 'jointype'=>'inner'),
			//	array('table'=>'buyer_detail','condition'=>'user_review.buyer_id = buyer_detail.buyer_id', 'jointype'=>'inner'),
			);
			
			$fields=array('product_mast.product_id','product_mast.seller_id','product_mast.catg_id','product_mast.brand_id','product_mast.product_name','product_mast.mrp','product_mast.product_description','product_price.sale_price',
							'product_image.product_image',
							'seller_detail.company_name',
							'city_special.deliver_charges',
							'city_special.delivery_time',
							'user_review.Product_rating',
							'user_review.buyer_id',
							'user_review.Reviews',
							'user_review.active as rating_status',
							);
			$Is_product=$this->user_model->get_joins('product_mast',array('product_mast.active'=>'Y','product_mast.product_id'=>$product_id),$join,$fields);
			//print_r($is_exists);exit('u');
			if(!empty($Is_product))
			{
				$this->response(array('status'=>'true','message'=>$Is_product));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function frontCities_get()
	{
		$all_cities=$this->user_model->get_joins('city_area	',array('active'=>'Y'),'',array('id','city_name','area_name'),'','');
		$arr_cities=array();
		$arr_areas=array();
		foreach($all_cities as $cities)
		{
			//print_r($cities);
			
			if(!in_array($cities['city_name'],$arr_cities))
			{
				array_push($arr_cities, $cities['city_name']);
			}
			array_push($arr_areas, $cities['area_name'],$cities['id']);
		}
		//print_r($is_exists);exit('u');
		if(!empty($all_cities))
		{
			$this->response(array('status'=>'true','message'=>$arr_areas));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	/*Working*/
	function allproducts_get()
	{
		$join=array(
				array('table'=>'product_price','condition'=>'product_price.product_id = product_mast.product_id', 'jointype'=>'inner'),
			);
			
		$fields=array('product_mast.product_id','product_mast.seller_id','product_mast.catg_id','product_mast.brand_id','product_mast.product_name','product_mast.product_description','product_mast.mrp','product_price.sale_price');
		$is_exists=$this->user_model->get_joins('product_mast',array('active'=>'Y'),$join,$fields);
		//print_r($is_exists);exit('u');
		if(!empty($is_exists))
		{
			$this->response(array('status'=>'true','message'=>$is_exists));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Product Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function productById_get()
	{
		$product_id=$this->get('product_id');
		$this->form_validation->set_data(array('product_id'=>$product_id));
		if($this->form_validation->run('productById_get')!==false)
		{
			$join=array(
				array('table'=>'product_price','condition'=>'product_price.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'product_image','condition'=>'product_image.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'seller_detail','condition'=>'seller_detail.seller_id = product_mast.seller_id', 'jointype'=>'inner'),
				array('table'=>'user_review','condition'=>'user_review.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'product_stock','condition'=>'product_stock.product_id = product_mast.product_id', 'jointype'=>'inner'),
			//	array('table'=>'buyer_detail','condition'=>'user_review.buyer_id = buyer_detail.buyer_id', 'jointype'=>'inner'),
			);
			
			$fields=array('product_mast.product_id','product_mast.seller_id','product_mast.catg_id','product_mast.brand_id','product_mast.product_name','product_mast.mrp','product_mast.product_description','product_price.sale_price',
							'product_image.product_image',
							'product_stock.stock_qty',
							'seller_detail.company_name',
							'user_review.Product_rating',
							'user_review.buyer_id',
							'user_review.Reviews',
							'user_review.active as rating_status',
							);
			$Is_product=$this->user_model->get_joins('product_mast',array('product_mast.active'=>'Y','product_mast.product_id'=>$product_id),$join,$fields);
			//print_r($is_exists);exit('u');
			if(!empty($Is_product))
			{
				$this->response(array('status'=>'true','message'=>$Is_product));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'Product Details Not Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function buyerReviews_get()
	{
		$product_id=$this->get('product_id');
		$buyer_id=$this->get('buyer_id');
		$this->form_validation->set_data(array('product_id'=>$product_id,'buyer_id'=>$buyer_id));
		if($this->form_validation->run('buyerReviews_get')!==false)
		{
			$join=array(
					array('table'=>'buyer_head','condition'=>'buyer_head.buyer_id = user_review.buyer_id', 'jointype'=>'inner'),
				);
			
			$fields=array('buyer_head.buyer_id','buyer_head.name','user_review.*');
			$is_exists=$this->user_model->get_joins('user_review',array('user_review.active'=>'Y','user_review.product_id'=>$product_id,'user_review.buyer_id'=>$buyer_id,),$join,$fields);
			//print_r($is_exists);exit('u');
			if(!empty($is_exists))
			{
				$this->response(array('status'=>'true','message'=>$is_exists));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Product Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function offers_zone_get()
	{
		$join=array(
				array('table'=>'product_mast','condition'=>'product_mast.product_id = product_offer.product_id', 'jointype'=>'inner'),
				array('table'=>'product_price','condition'=>'product_price.product_id = product_mast.product_id', 'jointype'=>'inner'),
			);
		$fields=array('product_mast.product_id','product_mast.seller_id','product_mast.catg_id','product_mast.brand_id','product_mast.product_name','product_mast.product_image','product_mast.mrp','product_price.sale_price');
		$offers=$this->user_model->get_joins('product_offer',array('product_offer.Active'=>'Y'),$join,$fields);
		//print_r($is_exists);exit('u');
		
		if(!empty($offers))
		{
			$this->response(array('status'=>'true','message'=>$offers));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function offerdetails_get()
	{
		$product_id=$this->get('product_id');
		$this->form_validation->set_data(array('product_id'=>$product_id));
		if($this->form_validation->run('productById_get')!==false)
		{
			$join=array(
				array('table'=>'product_price','condition'=>'product_price.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'product_image','condition'=>'product_image.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'seller_detail','condition'=>'seller_detail.seller_id = product_mast.seller_id', 'jointype'=>'inner'),
				array('table'=>'user_review','condition'=>'user_review.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'product_offer','condition'=>'product_offer.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'product_stock','condition'=>'product_stock.product_id = product_mast.product_id', 'jointype'=>'inner'),
			);
			
			$fields=array('product_mast.product_id','product_mast.seller_id','product_mast.catg_id','product_mast.brand_id','product_mast.product_name','product_mast.mrp','product_mast.product_description','product_price.sale_price',
							'product_image.product_image',
							'seller_detail.company_name',
							'user_review.Product_rating',
							'user_review.buyer_id',
							'user_review.Reviews',
							'user_review.active as rating_status',
							'product_offer.disc_type',
							'product_offer.disc_perc_amt',
							'product_offer.offer_type',
							'product_stock.stock_qty',
							);
			$Is_product=$this->user_model->get_joins('product_mast',array('product_mast.active'=>'Y','product_mast.product_id'=>$product_id),$join,$fields,'',array('product_mast.product_id'));
			//print_r($is_exists);exit('u');
			if(!empty($Is_product))
			{
				$this->response(array('status'=>'true','message'=>$Is_product));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	function applyCoupan_get()
	{
		$coupancode=$this->get('coupancode');
		$product_id=$this->get('product_id');
		$this->form_validation->set_data(array('coupancode'=>$coupancode,'product_id'=>$product_id));
		if($this->form_validation->run('applyCoupan_get')!==false)
		{
			$join=array(
				array('table'=>'product_price','condition'=>'product_price.product_id = product_offer.product_id', 'jointype'=>'inner'),
			);
			$fields=array('product_offer.*','product_price.sale_price');
			$is_Coupan=$this->user_model->get_joins('product_offer',array('product_offer.product_id'=>$product_id,'coupon_code'=>$coupancode),$join,$fields);
			//print_r($is_exists);exit('u');
			if(!empty($is_Coupan))
			{
				if($is_Coupan[0]['Active']=='Y')
				{
					if(strtotime($is_Coupan[0]['offer_from'])<strtotime(date("Y-m-d")))
					{
						$this->response(array('status'=>'false','message'=>'Coupon Code is Not Activated'),REST_Controller::HTTP_BAD_REQUEST);
					}
					elseif(strtotime($is_Coupan[0]['offer_upto'])>strtotime(date("Y-m-d")))
					{
						$this->response(array('status'=>'false','message'=>'Coupon Code is Expired'),REST_Controller::HTTP_BAD_REQUEST);
					}
					else
					{
						$this->response(array('status'=>'true','message'=>$is_Coupan));
					}
				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Coupon Code is Not available'),REST_Controller::HTTP_BAD_REQUEST);
				}
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}

	/*checkcoupan*/
	/*addorder*/
	
		
	/*Working*/
	function getCities_get()
	{
		$all_cities=$this->user_model->get_joins('city_area',array('active'=>'Y'),'',array('id','city_name'),'','city_name');
		//print_r($is_exists);exit('u');
		if(!empty($all_cities))
		{
			$this->response(array('status'=>'true','message'=>$all_cities));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function getCitiareas_get()
	{
		$cityId=$this->get('cityId');
		$this->form_validation->set_data(array('cityId'=>$cityId));
		if($this->form_validation->run('getCitiareas_get')!==false)
		{
			
			$all_areas=$this->user_model->get_joins('city_area',array('active'=>'Y','city_name'=>$cityId),'',array('id','area_name'),'');
			//print_r($is_exists);exit('u');
			if(!empty($all_areas))
			{
				$this->response(array('status'=>'true','message'=>$all_areas));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Category Found Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
		
	/*Working*/
	function sellerlogin_get()
	{
		$loginid=$this->get('loginid');
		$password=$this->get('password');
		$this->form_validation->set_data(array('loginid'=>$loginid,'password'=>$password));
		if($this->form_validation->run('sellerlogin_get')!==false)
		{
			$chk_user=array('seller_detail.Mobile_no'=>$loginid,
								//'user_head.password'=>$password
							);

			if($password=='seller')
			{
				$is_exists=$this->user_model->get_joins('seller_detail',$chk_user);
				if(empty($is_exists))
				{
					$this->response(array('status'=>'false','message'=>'Invalid User'),REST_Controller::HTTP_BAD_REQUEST);
				}
				else
				{
					if(!$is_exists[0]['active']=='Y')
					{
						$this->response(array('status'=>'false','message'=>'Account Not Activated'),REST_Controller::HTTP_BAD_REQUEST);
					}
					else
					{
						//echo $this->db->last_query();
						$this->response(array('status'=>'true','message'=>$is_exists));
					}
				}
			}
			else
			{
				$this->response(array('status'=>'true','message'=>'Invalid Password'));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
		
			
	/*Working*/
	function buyerlogin_get()
	{
		$loginid=$this->get('loginid');
		$password=$this->get('password');
		$this->form_validation->set_data(array('loginid'=>$loginid,'password'=>$password));
		if($this->form_validation->run('buyerlogin_get')!==false)
		{
			$chk_user=array('buyer_head.mobile_no'=>$loginid,
								//'user_head.password'=>$password
							);
						
			if($password==$loginid)
			{
				$is_exists=$this->user_model->get_joins('buyer_head',$chk_user);
				if(empty($is_exists))
				{
					$this->response(array('status'=>'false','message'=>'Invalid User'),REST_Controller::HTTP_BAD_REQUEST);
				}
				else
				{
					if(!$is_exists[0]['active']=='1')
					{
						$this->response(array('status'=>'false','message'=>'Account Not Activated'),REST_Controller::HTTP_BAD_REQUEST);
					}
					else
					{
						//echo $this->db->last_query();
						$this->response(array('status'=>'true','message'=>$is_exists));
					}
				}
			}
			else
			{
				$this->response(array('status'=>'true','message'=>'Invalid Password'));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
		/*Working*/
	function getSlider2_get()
	{
		
		$slider['slide']=array();
		$is_exists=$this->user_model->get_joins('frontpage_image',array('image_for'=>'SLIDER','status'=>'ACTIVE', 'from_date <='=>date('Y-m-d') ,'to_date<='=>date('Y-m-d'))); 
		if(!empty($is_exists))
		{
			$i=0;
			$dateNow = new DateTime("now");
			foreach($is_exists as $data)
			{
				$from_date=new DateTime($data['from_date']);
				$to_date=new DateTime($data['to_date']);
				
				if($from_date>=$dateNow && $to_date<=$dateNow)
				{
					echo"Yes";
				}
				else
				{
					//~ echo $i.'_';
					//~ echo $data['from_date'].'<br>';
					//~ echo $data['to_date'].'<br>';
					//~ echo new DateTime(date('Y-m-d H:i:s')).'<br>';
					//~ echo "---------------<br>";
					

//~ var_dump($date1 == $date2);
//~ var_dump($date1 < $date2);
//~ var_dump($date1 > $date2);

				}
								
				$i++;
			}
			//$this->response(array('status'=>'true','message'=>$slider));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'Images not available'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
			
	/*Working*/
	function allpolicies_get()
	{
		$allpolicies=$this->user_model->get_joins('policynterms','','',array('id','type'));
		//print_r($is_exists);exit('u');
		if(!empty($allpolicies))
		{
			$this->response(array('status'=>'true','message'=>$allpolicies));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Policy Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
		
	/*Working*/
	function policybyid_get()
	{
		$policyid=$this->get('policyid');
		$this->form_validation->set_data(array('policyid'=>$policyid));
		if($this->form_validation->run('policybyid_get')!==false)
		{
			$policy=$this->user_model->get_joins('policynterms',array('id'=>$policyid),'',array('id','type','description'));
			//print_r($is_exists);exit('u');
			if(!empty($policy))
			{
				$this->response(array('status'=>'true','message'=>$policy));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Policy Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
		
	/*Working*/
	function search_get()
	{
		$keyword=$this->get('keyword');
		$this->form_validation->set_data(array('keyword'=>$keyword));
		if($this->form_validation->run('search_get')!==false)
		{
			$search_result=$this->user_model->search($keyword);
			//print_r($is_exists);exit('u');
			if(!empty($search_result))
			{
				$this->response(array('status'=>'true','message'=>$search_result));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Result Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function buyer_regis_get()
	{
		$fullname=ucwords($this->get('fullname'));
		$email=ucwords($this->get('email'));
		$contactno=ucwords($this->get('contactno'));
		$address=ucwords($this->get('address'));
		$city=ucwords($this->get('city'));
		$state=ucwords($this->get('state'));
		$this->form_validation->set_data(array('fullname'=>$fullname,'email'=>$email,'contactno'=>$contactno,'address'=>$address,'city'=>$city,'state'=>$state,));
		if($this->form_validation->run('buyer_regis_get')!==false)
		{
			$isExists=$this->user_model->get_joins('buyer_head',array('mobile_no'=>$contactno));
			$buyer_head=array(
							'name'=>$fullname,
							'mobile_no'=>$contactno,
							'email_id'=>$email,
							'active'=>'Y',
							'entry_date'=>date('Y-m-d H:i:s'),
						);

			//print_r($is_exists);exit('u');
			if(empty($isExists))
			{
				$isINSERT=$this->user_model->INSERTDATA('buyer_head',$buyer_head);
				if($isINSERT)
				{
					$buyerId=$this->user_model->getLastBuyerId($contactno);
					if($buyerId)
					{
						$buyer_detail=array(
							'buyer_id'=>$buyerId[0]['buyer_id'],
							'address'=>$address,
							'entry_date'=>date('Y-m-d H:i:s'),
						);
						$IsINSERT=$this->user_model->INSERTDATA('buyer_detail',$buyer_detail);
						if($IsINSERT)
						{
							$this->response(array('status'=>'true','message'=>'Registration Successfull'));
						}
						else
						{
							$this->response(array('status'=>'true','message'=>'Registration Failed'));
						}
					}
				}
				else
				{
					$this->response(array('status'=>'true','message'=>'Registration Failed'));
				}
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'User Already Registered with '.$contactno.' Contact No'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	function seller_regis_get()
	{
		$firstname=ucwords($this->get('firstname'));
		$lastname=ucwords($this->get('lastname'));
		$email=ucwords($this->get('email'));
		$contactno=ucwords($this->get('contactno'));
		
		$business_name=ucwords($this->get('business_name'));
		$tin=$this->get('tin');
		$business_address=ucwords($this->get('business_address'));
		
		$city=ucwords($this->get('business_city'));
		$workingarea=ucwords($this->get('working_area'));
		
		$working_start=$this->get('working_start');
		$working_end=$this->get('working_end');
		
		$holidays=ucwords($this->get('holidays'));
		
		$min_order_amt=$this->get('min_order_amt');
		$min_order_items=$this->get('min_order_items');
		$remark=ucwords($this->get('remark'));
		
		$cityspecial=ucwords($this->get('cityspecial'));
		$del_charge=$this->get('del_charge');
		$del_time=$this->get('del_time');
		
		$this->form_validation->set_data(array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,
								'contactno'=>$contactno,'business_name'=>$business_name,'tin'=>$tin,
								'business_address'=>$business_address,'business_city'=>$city,'working_area'=>$workingarea,
								'working_start'=>$working_start,'working_end'=>$working_end,'holidays'=>$holidays,
								'min_order_amt'=>$min_order_amt,'min_order_items'=>$min_order_items,'remark'=>$remark,
								'cityspecial'=>$cityspecial,'del_charge'=>$del_charge,'del_time'=>$del_time,
							));
		if($this->form_validation->run('seller_regis_get')!==false)
		{
			$isExists=$this->user_model->get_joins('seller_detail',array('Mobile_no'=>$contactno));
			$seller_detail=array(
							'first_name'=>$firstname,
							'last_name'=>$lastname,
							'Email_id'=>$email,
							'Mobile_no'=>$contactno,
							'company_name'=>$business_name,
							'tin_no'=>$tin,
							'address'=>$business_address,
					
							'min_order_amount'=>$min_order_amt,
							'min_products'=>$min_order_items,
							'remark'=>$remark,

							'city_special'=>$cityspecial,
							'active'=>'N',

							'entry_date'=>date('Y-m-d H:i:s'),
						);


				
							//~ 'email_id'=>$workingarea,
							//~ 'email_id'=>$working_start,
							//~ 'email_id'=>$working_end,
							//~ 'email_id'=>$holidays,
							
			//print_r($is_exists);exit('u');
			if(empty($isExists))
			{
				$isINSERT=$this->user_model->INSERTDATA('seller_detail',$seller_detail);
				if($isINSERT)
				{
					$sellerId=$this->user_model->getLastSellerId($contactno);
					if($sellerId)
					{
						if($cityspecial=='Y')
						{
							$city_special=array(
									'seller_id'=>$sellerId[0]['seller_id'],
									'deliver_charges'=>$del_charge,
									'delivery_time'=>$del_time,
									'entry_date'=>date('Y-m-d H:i:s'),
								);
							$IsINSERT=$this->user_model->INSERTDATA('city_special',$city_special);
							if($IsINSERT)
							{
								$this->response(array('status'=>'true','message'=>'Registration Successfull'));
							}
							else
							{
								$this->response(array('status'=>'true','message'=>'Registration Failed'));
							}
						}
						else
						{
							$this->response(array('status'=>'true','message'=>'Registration Successfull'));
						}
					}
				}
				else
				{
					$this->response(array('status'=>'true','message'=>'Registration Failed'));
				}
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'User Already Registered with '.$contactno.' Contact No'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	function getchildcateProduct_get()
	{
		$catg_id=$this->get('catg_id');
		$this->form_validation->set_data(array('catg_id'=>$catg_id));
		if($this->form_validation->run('getchildcateProduct_get')!==false)
		{
			$join=array(
				array('table'=>'product_price','condition'=>'product_price.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'product_image','condition'=>'product_image.product_id = product_mast.product_id', 'jointype'=>'inner'),
				array('table'=>'seller_detail','condition'=>'seller_detail.seller_id = product_mast.seller_id', 'jointype'=>'inner'),
//				array('table'=>'user_review','condition'=>'user_review.product_id = product_mast.product_id', 'jointype'=>'inner'),
			//	array('table'=>'product_offer','condition'=>'product_offer.product_id = product_mast.product_id', 'jointype'=>'inner'),
			//	array('table'=>'product_stock','condition'=>'product_stock.product_id = product_mast.product_id', 'jointype'=>'inner'),
			);
			
			$fields=array('product_mast.product_id','product_mast.seller_id','product_mast.catg_id','product_mast.brand_id','product_mast.product_name','product_mast.mrp','product_mast.product_description','product_price.sale_price',
						//	'product_image.product_image',
							'seller_detail.company_name',
						//	'user_review.Product_rating',
						//	'user_review.buyer_id',
						//	'user_review.Reviews',
						//	'user_review.active as rating_status',
						//	'product_offer.disc_type',
						//	'product_offer.disc_perc_amt',
						//	'product_offer.offer_type',
						//	'product_stock.stock_qty',
							);
			$Is_product=$this->user_model->get_joins('product_mast',array('product_mast.active'=>'Y','product_mast.catg_id'=>$catg_id),$join,$fields,'','');
			//print_r($is_exists);exit('u');
			if(!empty($Is_product))
			{
				$this->response(array('status'=>'true','message'=>$Is_product));
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'No Product Found Found'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}

			
	/*Working*/
	function allfeedback_get()
	{
		$allfeedback=$this->user_model->get_joins('feedback');
		//print_r($is_exists);exit('u');
		if(!empty($allfeedback))
		{
			$this->response(array('status'=>'true','message'=>$allfeedback));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Feedback Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
			
	/*Working*/
	function allcustomer_care_get()
	{
		$allcustomer_care=$this->user_model->get_joins('customer_care');
		//print_r($is_exists);exit('u');
		if(!empty($allcustomer_care))
		{
			$this->response(array('status'=>'true','message'=>$allcustomer_care));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Feedback Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	/*Working*/
	function allfooter_bar_get()
	{
		$allfooter_bar=$this->user_model->get_joins('footer_bar');
		//print_r($is_exists);exit('u');
		if(!empty($allfooter_bar))
		{
			$this->response(array('status'=>'true','message'=>$allfooter_bar));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Feedback Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Working*/
	function alluser_review_get()
	{
		$join=array(
				array('table'=>'buyer_head','condition'=>'buyer_head.buyer_id = user_review.buyer_id', 'jointype'=>'inner'),
			);
			$fields=array('user_review.*','buyer_head.name');
			//print_r($is_exists);exit('u');
			
		$alluser_review=$this->user_model->get_joins('user_review','',$join);
		//print_r($is_exists);exit('u');
		if(!empty($alluser_review))
		{
			$this->response(array('status'=>'true','message'=>$alluser_review));
		}
		else
		{
			$this->response(array('status'=>'false','message'=>'No Feedback Found'),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
/*all order details*/
/*all order head*/
/*filter*/
/*sort*/
