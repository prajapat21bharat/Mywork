<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Webservice extends REST_Controller
{
	
	function isuser_get()
	{
		$name=$this->get('name');
		$contactno=$this->get('contactno');
		$class=$this->get('class');
		$this->form_validation->set_data(array('class'=>$class));
		if($this->form_validation->run('isuser_get')!==false)
		{					
			$chk_user=array('name'=>$name,'contactno'=>$contactno,'class'=>$class);
			
			$is_exists=$this->user_model->get_joins('registration',$chk_user);
			if(empty($is_exists))
			{
				$insertdata=array('name'=>$name,'contactno'=>$contactno,'class'=>$class,'user_type'=>'User','reg_date'=>date('Y-m-d h:i:s'));
				$is_insert=$this->user_model->INSERTDATA('registration',$insertdata);
				if($is_insert)
				{
					//$this->response(array('status'=>'true','message'=>'Registration Successfull'));
					$fields=array('tbl_cards.id','title','title_img','description');
					$join=array(
						array('table'=>'subcategory','condition'=>'subcategory.id = tbl_cards.subcategory', 'jointype'=>'inner'),
					);
					$allcards=$this->user_model->get_joins('tbl_cards',array('subcategory.name'=>$class,'card_type'=>'pack'),$join,$fields);
					//echo $this->db->last_query();exit;
					if(empty($allcards))
					{
						$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
					}
					else
					{
						$this->response(array('status'=>'true','message'=>$allcards));
					}
				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Registration Failed'),REST_Controller::HTTP_BAD_REQUEST);
				}
			}
			else
			{
				$fields=array('tbl_cards.id','title','title_img','description');
				$join=array(
						array('table'=>'subcategory','condition'=>'subcategory.id = tbl_cards.subcategory', 'jointype'=>'inner'),
					);
				$allcards=$this->user_model->get_joins('tbl_cards',array('subcategory.name'=>$class,'card_type'=>'pack'),$join,$fields);
			//	echo $this->db->last_query();exit;
				if(empty($allcards))
				{
					$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('status'=>'true','message'=>$allcards));
				}
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}


	function packofcards_get()
	{
		$packid=$this->get('packid');
		$this->form_validation->set_data(array('packid'=>$packid));
		if($this->form_validation->run('packofcards_get')!==false)
		{
			//$this->response(array('status'=>'true','message'=>'sccss'));
			$fields=array('card_images.id', 'tbl_cards.title', 'card_images.card_id', 'card_images.card_image', 'tbl_cards.description');
			$join=array(
					array('table'=>'tbl_cards','condition'=>'card_images.card_id = tbl_cards.id', 'jointype'=>'inner'),
					);
			$packofcards=$this->user_model->get_joins('card_images',array('card_images.card_id'=>$packid),$join,$fields,'','','card_images.card_id');
			if(empty($packofcards))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$this->response(array('status'=>'true','message'=>$packofcards));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}

	function allcategories_get()
	{
		$allcategories=$this->user_model->get_joins('category');
		
		$count=count($allcategories);
		$array2[$count]=array('id'=>'0','categoryname'=>'All');
		
		array_unshift($allcategories,$array2[$count]);
		
     	if(empty($allcategories))
		{
			$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}
		else
		{
			$this->response(array('status'=>'true','message'=>$allcategories));
		}
	}
	
	
	function getsub_category_get()
	{
		$categoryid=$this->get('cate_id');
		$this->form_validation->set_data(array('cate_id'=>$categoryid));
		if($this->form_validation->run('getsub_category_get')!==false)
		{
			if($categoryid==0)
			{
				$fields=array('id','name');
				$all_sub_category=$this->user_model->get_joins('subcategory','','',$fields);
				if(empty($all_sub_category))
				{
					$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('status'=>'true','message'=>$all_sub_category));
				}
			}
			else
			{
				$fields=array('id','name');
				$all_sub_category=$this->user_model->get_joins('subcategory',array('category_id'=>$categoryid),'',$fields);
				if(empty($all_sub_category))
				{
					$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('status'=>'true','message'=>$all_sub_category));
				}
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	
	
	function child_category_get()
	{
		$subcate_id=$this->get('subcate_id');
		$this->form_validation->set_data(array('subcate_id'=>$subcate_id));
		if($this->form_validation->run('child_category_get')!==false)
		{
			$fields=array('id','child_name');
			$childcategories=$this->user_model->get_joins('child_sub_category',array('child_sub_category.sub_cate_id'=>$subcate_id,),'',$fields);
			if(empty($childcategories))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$this->response(array('status'=>'true','message'=>$childcategories));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}

	function getquestions_get()
	{
		$packid=$this->get('packid');
		$this->form_validation->set_data(array('packid'=>$packid));
		if($this->form_validation->run('getquestions_get')!==false)
		{
			$carddetails=$this->user_model->get_joins('tbl_cards',array('tbl_cards.id'=>$packid,));
			if(empty($carddetails))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$fields=array('card_images.id', 'tbl_cards.title', 'card_images.card_id', 'card_images.card_image', 'tbl_cards.description', 'tbl_cards.card_type');
				$join=array(
						array('table'=>'tbl_cards','condition'=>'card_images.card_id = tbl_cards.id', 'jointype'=>'inner'),
						);
				$packofcards=$this->user_model->get_joins('card_images',array('tbl_cards.card_type'=>'questions'),$join,$fields,array('tbl_cards.title'=>$carddetails[0]['title']),'','card_images.card_id');

				if(empty($packofcards))
				{
					$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('status'=>'true','message'=>$packofcards));
				}
			}
			
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	
	function getpackbychildcate_get()
	{
		$child_id=$this->get('child_id');
		$this->form_validation->set_data(array('child_id'=>$child_id));
		if($this->form_validation->run('getpackbychildcate_get')!==false)
		{
			$fields=array('id','title','title_img','description');
			$allcards=$this->user_model->get_joins('tbl_cards',array('child_cate_id'=>$child_id,'card_type'=>'pack'),'',$fields);
			if(empty($allcards))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$this->response(array('status'=>'true','message'=>$allcards));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}
	
	
	
	function getquestionsbychild_cate_get()
	{
		$child_id=$this->get('child_id');
		$this->form_validation->set_data(array('child_id'=>$child_id));
		if($this->form_validation->run('getquestionsbychild_cate_get')!==false)
		{
			$carddetails=$this->user_model->get_joins('tbl_cards',array('tbl_cards.child_cate_id'=>$child_id,));
			if(empty($carddetails))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$fields=array('card_images.id', 'tbl_cards.title', 'card_images.card_id', 'card_images.card_image', 'tbl_cards.description', 'tbl_cards.card_type');
				$join=array(
						array('table'=>'tbl_cards','condition'=>'card_images.card_id = tbl_cards.id', 'jointype'=>'inner'),
						);
				$packofcards=$this->user_model->get_joins('card_images',array('tbl_cards.card_type'=>'questions'),$join,$fields,array('tbl_cards.title'=>$carddetails[0]['title']),'','card_images.card_id');
				//print_r($carddetails[0]['title']);exit;
				//echo $this->db->last_query();exit;
				if(empty($packofcards))
				{
					$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('status'=>'true','message'=>$packofcards));
				}
			}
			
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	
	
	function getcardimagesbypackid_get()
	{
		$pack_id=$this->get('pack_id');
		$this->form_validation->set_data(array('pack_id'=>$pack_id));
		if($this->form_validation->run('getcardimagesbypackid_get')!==false)
		{
			$carddetails=$this->user_model->get_joins('tbl_cards',array('tbl_cards.id'=>$pack_id,));
			if(empty($carddetails))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$fields=array('card_images.id', 'tbl_cards.title', 'card_images.card_id', 'card_images.card_image', 'tbl_cards.description', 'tbl_cards.card_type');
				$join=array(
						array('table'=>'tbl_cards','condition'=>'card_images.card_id = tbl_cards.id', 'jointype'=>'inner'),
						);
				$packofcards=$this->user_model->get_joins('card_images',array('tbl_cards.id'=>$pack_id),$join,$fields,'','','card_images.card_id');
				//print_r($carddetails[0]['title']);exit;
				//echo $this->db->last_query();exit;
				if(empty($packofcards))
				{
					$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('status'=>'true','message'=>$packofcards));
				}
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	
	
	function store_get()
	{
		$fields=array('id','title','title_img','description');
		$allcards_ques=$this->user_model->get_joins('tbl_cards','','',$fields);
		if(empty($allcards_ques))
		{
			$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}
		else
		{
			$this->response(array('status'=>'true','message'=>$allcards_ques));
		}
	}
	
	
	
	
	
	function search_get()
	{
		$keyword=$this->get('keyword');
		$this->form_validation->set_data(array('keyword'=>$keyword));
		if($this->form_validation->run('search_get')!==false)
		{
				$fields=array( 'tbl_cards.id', 'tbl_cards.title_img', 'tbl_cards.title', 'tbl_cards.description', 'tbl_cards.card_type');
				$join=array(
						array('table'=>'category','condition'=>'category.id = tbl_cards.category', 'jointype'=>'inner'),
						array('table'=>'subcategory','condition'=>'subcategory.id = tbl_cards.subcategory', 'jointype'=>'inner'),
						array('table'=>'child_sub_category','condition'=>'child_sub_category.id = tbl_cards.child_cate_id', 'jointype'=>'inner'),
						);
				
				$keywords=explode(' ',$keyword);
				$packofcards='';
				$i=0;
				foreach($keywords as $keyword)
				{
					$like=array('tbl_cards.title'=>$keyword, 'tbl_cards.description'=>$keyword, 'category.categoryname'=>$keyword, 'subcategory.name'=>$keyword, 'child_sub_category.child_name'=>$keyword, );
					$packofcards[$i]=$this->user_model->get_joins('tbl_cards','',$join,$fields,$like,'tbl_cards.createdate','');
					//echo $this->db->last_query();
					$i++;
				}
				
				$serach_result=array_filter($packofcards);
//var_dump($serach_result);exit;
				if(empty($serach_result))
				{
					$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('status'=>'true','message'=>$serach_result));
				}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}
	
	function user_delete()
	{
		$id=$this->uri->segment(3);
		//$password=$this->uri->segment(4);
		$deleted=$this->login_model->delete($id);
		if(isset($deleted))
		{
			$this->response(array('status'=>'true','message'=>'User Deleted Successfully'),200);
		}
		else
		{
			//$this->response('Invalid id',404);
			$this->response(array('status'=>'false','message'=>'User Not Deleted'),REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
