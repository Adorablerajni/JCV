<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispatch extends CI_Controller {

function __construct(){  
   parent::__construct();
		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Master_model');
		$this->load->model('Purchase_model');
		$this->load->model('Dispatch_model');
     
       }
	   
	public function index()
	{
		$this->load->view('login');
	}
	
/*-----------------------------------------------------------------------------ADD REQUIREMENT-------------------------------------------------------------------------*/

	public function delivery_challan($Dis_id="")
	{
	    //$user_id = $_SESSION['user_id'];
		
		$data['DispatchReportData'] = $this->Dispatch_model->get_dispatch_report($Dis_id);
		//print_r($data['DispatchReportData']);
		//echo $project_id= $data['DispatchReportData'][0]['del_project'];
	//	die();
		//$data['ProjectNameData'] = $this->Dispatch_model->get_project_name();
		//print_r($data['DispatchReportData']);
		//die();
		$this->load->view('delivery_challan',$data);
	}

	public function add_requirement()
	{
	    $user_id = $_SESSION['user_id'];
		$data['ProductNameData'] = $this->Master_model->get_product_name();
		$data['RequirementData'] = $this->Dispatch_model->get_requirement_data($user_id);
		$this->load->view('add_requirement', $data);
	}
	
	public function requirement_add()
	{

    	$this->form_validation->set_rules('city', 'city', 'required');
    	$this->form_validation->set_rules('project_name', 'project_name', 'required');
    	$this->form_validation->set_rules('product_name', 'product_name', 'required');
    	$this->form_validation->set_rules('packets', 'packets', 'required');
    	$this->form_validation->set_rules('quantity', 'quantity', 'required');
    	$this->form_validation->set_rules('di_order_no', 'di_order_no', 'required');
    	$this->form_validation->set_rules('di_order_date', 'di_order_date', 'required');
        
		if ($this->form_validation->run() == true){	
		    
	    $user_id = $_SESSION['user_id'];
		$city = $this->input->post('city');
        $project_name = $this->input->post('project_name');
        $product_name = $this->input->post('product_name');
        $packets = $this->input->post('packets');
        $quantity = $this->input->post('quantity');
        $di_order_no = $this->input->post('di_order_no');
        $di_order_date = $this->input->post('di_order_date');
		
            $RequirementData = array(
                
			      'city'=>$city,
			      'project_name'=>$project_name,
			      'product_id'=>$product_name,
			      'packets'=>$packets,
			      'quantity'=>$quantity,
			      'di_order_no'=>$di_order_no,
			      'di_order_date'=>$di_order_date,
			      'user_id'=>$user_id
				 
			 );
             
            $this->db->insert('requirement_tbl',$RequirementData);

			$this->session->set_flashdata('message', 'Requirement Added Successfully.');
			redirect ('Dispatch/add_requirement');
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Requirement Not Added. Please Try Again');
				redirect ('Dispatch/add_requirement');
		}
	}
	
/*-----------------------------------------------------------------------------ADD PRODUCTION-------------------------------------------------------------------------*/

	public function add_production()
	{
	    $user_id = $_SESSION['user_id'];
	    $district_name = $this->input->post('Course_id');
		$data['ProductNameData'] = $this->Master_model->get_product_name();
		$data['ProductionData'] = $this->Dispatch_model->get_production_data($user_id);
		$data['DistrictData'] = $this->Dispatch_model->district_tbl();
		$this->load->view('add_production', $data);
	}
	
	
	
	
	public function production_add()
	{

    	$this->form_validation->set_rules('p_city', 'p_city', 'required');
    	$this->form_validation->set_rules('p_project_name', 'p_project_name', 'required');
    	$this->form_validation->set_rules('chalan_no', 'chalan_no', 'required');
    	$this->form_validation->set_rules('chalan_date', 'chalan_date', 'required');
    	$this->form_validation->set_rules('vehicle', 'vehicle', 'required');
    	$this->form_validation->set_rules('bilty', 'bilty', 'required');

		if ($this->form_validation->run() == true){	
		    
	    $user_id = $_SESSION['user_id'];
		$p_city = $this->input->post('p_city');
        $p_project_name = $this->input->post('p_project_name');
        $chalan_no = $this->input->post('chalan_no');
        $chalan_date = $this->input->post('chalan_date');
        $vehicle = $this->input->post('vehicle');
        $bilty = $this->input->post('bilty');
		
            $ProductionData = array(
                
			      'p_city'=>$p_city,
			      'p_project_name'=>$p_project_name,
			      'chalan_no'=>$chalan_no,
			      'chalan_date'=>$chalan_date,
			      'vehicle'=>$vehicle,
			      'bilty'=>$bilty,
			      'user_id'=>$user_id
				 
			 );
             
            $this->db->insert('production_tbl',$ProductionData);
            
            $production_id =$this->db->insert_id();	
            
            $m =0;
            $module_id = $this->input->post('counts');
            foreach($module_id as $val)
            {

                $product_name = $this->input->post('product_name')[$m];
                $counts = $this->input->post('counts')[$m];
                $type = $this->input->post('type')[$m];
                $product_id = $this->input->post('product_id')[$m];
				
                $ProductionListData = array(
                    
    			      'type'=>$type,
    			      'counts'=>$counts,
    			      'product_id'=>$product_id,
    			      'production_id'=>$production_id,
    			      'user_id'=>$user_id
    			 );
    			 
                $this->db->insert('production_details_list',$ProductionListData);
			    $m++;
            }

			$this->session->set_flashdata('message', 'Production Added Successfully.');
			redirect ('Dispatch/add_production');
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Production Not Added. Please Try Again');
				redirect ('Dispatch/add_production');
		}
	}
	
	
/*-----------------------------------------------------------------------------DISPATCH REPORT-------------------------------------------------------------------------*/

	public function dispatch_report()
	{
	    
    	$this->form_validation->set_rules('date1', 'date1', 'required');
    	$this->form_validation->set_rules('date2', 'date2', 'required');

		if ($this->form_validation->run() == true){	
		    
            $date1 = $this->input->post('date1');
            $date2 = $this->input->post('date2');
	    
    	    $user_id = $_SESSION['user_id'];
    	    
    		$data['ProductNameData'] = $this->Master_model->get_product_name();
    		$data['DispatchReportData'] = $this->Dispatch_model->get_dispatch_report_data($user_id, $date1, $date2);
    		
    		$this->load->view('dispatch_report',$data);
		
        }
		else 
		{
    		$this->load->view('dispatch_report');
		}
	}
	
/*-----------------------------------------------------------------------------ADD DAILY PRODUCTION-------------------------------------------------------------------------*/

	public function add_daily_production()
	{
	    $user_id = $_SESSION['user_id'];
		$data['ProductNameData'] = $this->Master_model->get_product_name();
		$data['ProductionData'] = $this->Dispatch_model->get_production_data($user_id);
		$this->load->view('add_daily_production', $data);
	}
	
	public function daily_production_add()
	{

    	$this->form_validation->set_rules('production_date', 'production_date', 'required');
    	$this->form_validation->set_rules('production_shift', 'production_shift', 'required');

		if ($this->form_validation->run() == true){	
		    
	    $user_id = $_SESSION['user_id'];
        $production_date = $this->input->post('production_date');
        $production_shift = $this->input->post('production_shift');
        $production_remark = $this->input->post('production_remark');
		
            $ProductionData = array(
			      'production_date'=>$production_date,
			      'production_shift'=>$production_shift,
			      'production_remark'=>$production_remark,
			      'user_id'=>$user_id
				 
			 );
             
            $this->db->insert('daily_production',$ProductionData);
            
            $production_id =$this->db->insert_id();	
            
                $prod_date = $this->input->post('production_date');
                $prod_abl = $this->input->post('abl');
                $prod_halwa = $this->input->post('halwa');
                $prod_balahaar = $this->input->post('balahaar');
                $prod_barfi750 = $this->input->post('barfi750');
                $prod_barfi900 = $this->input->post('barfi900');
                $prod_khichdi625 = $this->input->post('khichdi625');
                $prod_khichdi750 = $this->input->post('khichdi750');
                $prod_khichdi900 = $this->input->post('khichdi900');
				
                $ProductionListData = array(
                    
                       'prod_date'=>$prod_date,
                       'prod_id'=>$production_id,
    			      'prod_abl'=>$prod_abl,
    			      'prod_halwa'=>$prod_halwa,
    			      'prod_balahaar'=>$prod_balahaar,
    			      'prod_barfi750'=>$prod_barfi750,
    			      'prod_barfi900'=>$prod_barfi900,
    			      'prod_khichdi625'=>$prod_khichdi625,
    			      'prod_khichdi750'=>$prod_khichdi750,
    			      'prod_khichdi900'=>$prod_khichdi900,
    			      'user_id'=>$user_id
    			 );
    			 
                $this->db->insert('daily_production_list',$ProductionListData);
			    

			$this->session->set_flashdata('message', 'Production Added Successfully.');
			redirect ('Dispatch/add_daily_production');
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Production Not Added. Please Try Again');
				redirect ('Dispatch/add_daily_production');
		}
	}
	
/*-----------------------------------------------------------------------------DAILY PRODUCTION LIST-------------------------------------------------------------------------*/

	public function daily_production_list()
	{
	    $user_id = $_SESSION['user_id'];
		//$data['ProductNameData'] = $this->Master_model->get_product_name();
		$data['DailyProductionData'] = $this->Dispatch_model->get_daily_production_data($user_id);
		$this->load->view('daily_production_list',$data);
	}
	
/*-----------------------------------------------------------------------------EDIT PRODUCTION LIST-------------------------------------------------------------------------*/
	
public function edit_daily_production($prod_id="")
	{
	    $txt_production_date = $this->input->post('txt_production_date');
	    if(empty($txt_production_date)){
	        $data['EditProductionData'] = $this->Dispatch_model->edit_daily_production_data($prod_id);
	        //print_r($data['EditProductionData']);
	        //die();
	        $this->load->view('edit_daily_production',$data);
	    }
	    else {
	$this->form_validation->set_rules('txt_production_date', 'txt_production_date', 'required');
	$this->form_validation->set_rules('txt_production_shift', 'txt_production_shift', 'required');
	$this->form_validation->set_rules('txt_production_remark', 'txt_production_remark', 'required');
	$this->form_validation->set_rules('txt_abl', 'txt_abl', 'required');
	$this->form_validation->set_rules('txt_halwa', 'txt_halwa', 'required');
	$this->form_validation->set_rules('txt_balahaar', 'txt_balahaar', 'required');
	$this->form_validation->set_rules('txt_barfi750', 'txt_barfi750', 'required');
	$this->form_validation->set_rules('txt_barfi900', 'txt_barfi900', 'required');
	$this->form_validation->set_rules('txt_khichdi625', 'txt_khichdi625', 'required');
	$this->form_validation->set_rules('txt_khichdi750', 'txt_khichdi750', 'required');
	$this->form_validation->set_rules('txt_khichdi900', 'txt_khichdi900', 'required');
        
		if ($this->form_validation->run() == true){	
	    
		$txt_production_date = $this->input->post('txt_production_date');
        $txt_production_shift = $this->input->post('txt_production_shift');
        $txt_production_remark = $this->input->post('txt_production_remark');
        $txt_abl = $this->input->post('txt_abl');
        $txt_halwa = $this->input->post('txt_halwa');
        $txt_balahaar = $this->input->post('txt_balahaar');
        $txt_barfi750 = $this->input->post('txt_barfi750');
        $txt_barfi900 = $this->input->post('txt_barfi900');
        $txt_khichdi625 = $this->input->post('txt_khichdi625');
        $txt_khichdi750 = $this->input->post('txt_khichdi750');
        $txt_khichdi900 = $this->input->post('txt_khichdi900');
		
		
		$UpdateProductionData = array(
			      'production_date'=>$txt_production_date,
			      'production_shift'=>$txt_production_shift,
			      'production_remark'=>$txt_production_remark
			 );
             
            $this->db->update('daily_production',$UpdateProductionData,array('id'=>$prod_id));
            
            $UpdateProductionListData = array(
			      'prod_date'=>$txt_production_date,
			      'prod_abl'=>$txt_abl,
			      'prod_halwa'=>$txt_halwa,
			      'prod_balahaar'=>$txt_balahaar,
			      'prod_barfi750'=>$txt_barfi750,
			      'prod_barfi900'=>$txt_barfi900,
			      'prod_khichdi625'=>$txt_khichdi625,
			      'prod_khichdi750'=>$txt_khichdi750,
			      'prod_khichdi900'=>$txt_khichdi900
			 );
             
            $this->db->update('daily_production_list',$UpdateProductionListData,array('prod_id'=>$prod_id));

			$this->session->set_flashdata('message', 'Updated Successfully.');
			redirect ('Dispatch/daily_production_list');
			
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Not Updated. Please Try Again');
				redirect ('Dispatch/edit_daily_production');
		}
		
	    }
	}

public function get_project_by_city()
	{
	    if($this->input->post('City_id'))
  {
       echo $this->Dispatch_model->get_project_by_city($this->input->post('City_id'));
	
  }
		
	}
	/*-----------------------------------------------------------------------------DAILY PRODUCTION LIST-------------------------------------------------------------------------*/

	public function dispatch_list()
	{
	    $user_id = $_SESSION['user_id'];
		//$data['ProductNameData'] = $this->Master_model->get_product_name();
		$data['DispatchData'] = $this->Dispatch_model->get_dispatch_data($user_id);
		$this->load->view('dispatch_list',$data);
	}
	
	public function dispatch_add()
	{
        $this->form_validation->set_rules('project_type', 'project_type', 'required');
    	$this->form_validation->set_rules('p_city', 'p_city', 'required');
    	$this->form_validation->set_rules('p_project_name', 'p_project_name', 'required');
    	$this->form_validation->set_rules('chalan_no', 'chalan_no', 'required');
    	$this->form_validation->set_rules('chalan_date', 'chalan_date', 'required');
    	$this->form_validation->set_rules('vehicle_no', 'vehicle_no', 'required');
    	$this->form_validation->set_rules('transporter', 'transporter', 'required');
        
		if ($this->form_validation->run() == true){	
		    
	    $user_id = $_SESSION['user_id'];
		$city = $this->input->post('p_city');
		$project_type = $this->input->post('project_type');
        $project_name = $this->input->post('p_project_name');
        $chalan_no = $this->input->post('chalan_no');
        $chalan_date = $this->input->post('chalan_date');
        $vehicle_no = $this->input->post('vehicle_no');
        $wcd_order_no = $this->input->post('wcd_order_no');
        $wcd_order_date = $this->input->post('wcd_order_date');
        $agro_order_no = $this->input->post('agro_order_no');
        $agro_order_date = $this->input->post('agro_order_date');
        $lr_no = $this->input->post('lr_no');
        $lr_date = $this->input->post('lr_date');
        $driver_mobile_no = $this->input->post('driver_mobile_no');
        $destination = $this->input->post('destination');
        $transporter = $this->input->post('transporter');
        $soya_code = $this->input->post('soya_code');
        $soya_batch = $this->input->post('soya_batch');
        $soya_bags = $this->input->post('soya_bags');
        $soya_packets = $this->input->post('soya_packets');
        $soya_quantity = $this->input->post('soya_quantity');
        $abl_code = $this->input->post('abl_code');
        $abl_batch = $this->input->post('abl_batch');
        $abl_bags = $this->input->post('abl_bags');
        $abl_packets = $this->input->post('abl_packets');
        $abl_quantity = $this->input->post('abl_quantity');
        $khi750_code = $this->input->post('khi750_code');
        $khi750_batch = $this->input->post('khi750_batch');
        $khi750_bags = $this->input->post('khi750_bags');
        $khi750_packets = $this->input->post('khi750_packets');
        $khi750_quantity = $this->input->post('khi750_quantity');
        $halwa_code = $this->input->post('halwa_code');
        $halwa_batch = $this->input->post('halwa_batch');
        $halwa_bags = $this->input->post('halwa_bags');
        $halwa_packets = $this->input->post('halwa_packets');
        $halwa_quantity = $this->input->post('halwa_quantity');
        $balahar_code = $this->input->post('balahar_code');
        $balahar_batch = $this->input->post('balahar_batch');
        $balahar_bags = $this->input->post('balahar_bags');
        $balahar_packets = $this->input->post('balahar_packets');
        $balahar_quantity = $this->input->post('balahar_quantity');
        $khi625_code = $this->input->post('khi625_code');
        $khi625_batch = $this->input->post('khi625_batch');
        $khi625_bags = $this->input->post('khi625_bags');
        $khi625_packets = $this->input->post('khi625_packets');
        $khi625_quantity = $this->input->post('khi625_quantity');
        $khi900_code = $this->input->post('khi900_code');
        $khi900_batch = $this->input->post('khi900_batch');
        $khi900_bags = $this->input->post('khi900_bags');
        $khi900_packets = $this->input->post('khi900_packets');
        $khi900_quantity = $this->input->post('khi900_quantity');
        $barfi900_code = $this->input->post('barfi900_code');
        $barfi900_batch = $this->input->post('barfi900_batch');
        $barfi900_bags = $this->input->post('barfi900_bags');
        $barfi900_packets = $this->input->post('barfi900_packets');
        $barfi900_quantity = $this->input->post('barfi900_quantity');
        $mobile_no = $this->input->post('mobile_no');
        $fax_no = $this->input->post('fax_no');
		
            $DispatchData = array(
                
			      'del_city'=>$city,
			      'del_project_type'=>$project_type,
			      'del_project'=>$project_name,
			      'del_challan_no'=>$chalan_no,
			      'del_challan_date'=>$chalan_date,
			      'del_vehicle_no'=>$vehicle_no,
			      'del_wcd_no'=>$wcd_order_no,
			      'del_wcd_date'=>$wcd_order_date,
			      'del_agro_no'=>$agro_order_no,
			      'del_agro_date'=>$agro_order_date,
			      'del_lr_no'=>$lr_no,
			      'del_lr_date'=>$lr_date,
			      'del_driver_no'=>$driver_mobile_no,
			      'del_destination'=>$destination,
			      'del_transporter'=>$transporter,
			      'del_soya_code'=>$soya_code,
			      'del_soya_batch'=>$soya_batch,
			      'del_soya_bags'=>$soya_bags,
			      'del_soya_packets'=>$soya_packets,
			      'del_soya_quantity'=>$soya_quantity,
			      'del_abl_code'=>$abl_code,
			      'del_abl_batch'=>$abl_batch,
			      'del_abl_bags'=>$abl_bags,
			      'del_abl_packets'=>$abl_packets,
			      'del_abl_quantity'=>$abl_quantity,
			      'del_khi750_code'=>$khi750_code,
			      'del_khi750_batch'=>$khi750_batch,
			      'del_khi750_bags'=>$khi750_bags,
			      'del_khi750_packets'=>$khi750_packets,
			      'del_khi750_quantity'=>$khi750_quantity,
			      'del_halwa_code'=>$halwa_code,
			      'del_halwa_batch'=>$halwa_batch,
			      'del_halwa_bags'=>$halwa_bags,
			      'del_halwa_packets'=>$halwa_packets,
			      'del_halwa_quantity'=>$halwa_quantity,
			      'del_balahar_code'=>$balahar_code,
			      'del_balahar_batch'=>$balahar_batch,
			      'del_balahar_bags'=>$balahar_bags,
			      'del_balahar_packets'=>$balahar_packets,
			      'del_balahar_quantity'=>$balahar_quantity,
			      'del_khi625_code'=>$khi625_code,
			      'del_khi625_batch'=>$khi625_batch,
			      'del_khi625_bags'=>$khi625_bags,
			      'del_khi625_packets'=>$khi625_packets,
			      'del_khi625_quantity'=>$khi625_quantity,
			      'del_brf900_code'=>$barfi900_code,
			      'del_brf900_batch'=>$barfi900_batch,
			      'del_brf900_bags'=>$barfi900_bags,
			      'del_brf900_packets'=>$barfi900_packets,
			      'del_brf900_quantity'=>$barfi900_quantity,
			      'del_khi900_code'=>$khi900_code,
			      'del_khi900_batch'=>$khi900_batch,
			      'del_khi900_bags'=>$khi900_bags,
			      'del_khi900_packets'=>$khi900_packets,
			      'del_khi900_quantity'=>$khi900_quantity,
			      'del_mobile_no'=>$mobile_no,
			      'del_fax'=>$fax_no,
			      'del_user_id'=>$user_id
				 
			 );
             //print_r($DispatchData);
             //die();
            $this->db->insert('dispatch_details',$DispatchData);

			$this->session->set_flashdata('message', 'Dispatch Data Added Successfully.');
			redirect ('Dispatch/add_production');
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Dispatch Data Not Added. Please Try Again');
				redirect ('Dispatch/add_production');
		}
	}

	//----------------------------------------- Approve Dispatch Letter ---------------------------------------------------- 
	public function approve_dispatch_letter()
	{
	$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
        
		if ($this->form_validation->run() == true){	
        $hdnid = $this->input->post('hdnid');
		//$approved_time = $this-> date("Y-m-d h:i:s");
		$user_id = $this->input->post('user_id');
		$approved_name = $this->input->post('user_name');
		
            $UpdateOrderData = array(
			      'del_status'=>"Approved",
			      'del_approve_id'=>$user_id,
			      'del_approve_datetime'=>date('Y-m-d h:i:s'),
			      'del_approve_name'=>$approved_name,
			 );
             //print_r($UpdateOrderData);
             //die();
             
            $this->db->update('dispatch_details',$UpdateOrderData,array('id'=>$hdnid));

			$this->session->set_flashdata('message', 'Dispatch letter approved.');
			redirect ('Dispatch/dispatch_list');
			
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Dispatch Letter Not Updated. Please Try Again');
				redirect ('Dispatch/dispatch_list');
		}
	}

/*-----------------------------------------------------------------------------PRODUCTION REPORT-------------------------------------------------------------------------*/

	public function production_report()
	{
	    
    	$this->form_validation->set_rules('date1', 'date1', 'required');
    	$this->form_validation->set_rules('date2', 'date2', 'required');

		if ($this->form_validation->run() == true){	
		    
            $date1 = $this->input->post('date1');
            $date2 = $this->input->post('date2');
	    
    	    $user_id = $_SESSION['user_id'];
    	    
    		$data['ProductNameData'] = $this->Master_model->get_product_name();
    		$data['ProductionReportData'] = $this->Dispatch_model->get_production_report_data($user_id, $date1, $date2);
    		
    		$this->load->view('production_report',$data);
		
        }
		else 
		{
    		$this->load->view('production_report');
		}
	}

	
}
