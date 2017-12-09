<?php 

class Start extends CI_Controller   //	(Main Class) Define in config/routes => $route['default_controller'] = "start";
{
	
	public function index()	
	{
		$this->load->view('start_view');
	}
	
	public function search()
	{
		if(isset($_POST["search"]))
		{
			$searchdata=$this->input->post('searchbar');
			
			$this->db->select('registration.firstname,registration.lastname,registration.image,registration.user_type,registration.active_state,registration.profile_complete,skills.id,skills.skill,workexperience.id, workexperience.company_name, workexperience.description, workexperience.jobtitle');
			$this->db->from('registration');
			$where=array('registration.active_state'=>1,'registration.user_type'=>'Mentor','registration.profile_complete'=>'100');
			$this->db->where($where);
			$this->db->like('registration.firstname', $searchdata);
			$this->db->or_like('registration.lastname', $searchdata);
			$this->db->or_like('skills.skill', $searchdata);
			$this->db->or_like('workexperience.company_name', $searchdata);
			$this->db->or_like('workexperience.jobtitle', $searchdata);
			$this->db->or_like('workexperience.description', $searchdata);		
			$joins=$this->db->join('skills', 'skills.uid = registration.id', 'innerjoin');
			$joins=$this->db->join('workexperience', 'workexperience.uid = registration.id', 'innerjoin');
			$query = $this->db->get();
			if($data['data'] = $query->result())
			{
				$this->load->view('search_view',$data);
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Sorry No Data Found</b>');
				redirect(site_url().'/start/search');
			}
			//echo"<pre>";print_r($data);exit;	
			
		}
		else
		{
			$query="";
			$this->load->view('search_view',$query);
		}
	}
	
}
