<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masters extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('Masters_model');
       $this->load->model('Party_model');
       $this->load->model('Purchase_model');
       $this->load->model('State_city_model');
       $this->load->model('Transport_model');
}
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
	public function company_list()
	{
		$data['companycode']=$this->Masters_model->get_company_code();
		 // print_r($data['partylist']);
		 // die();
		$this->load->view('company_list',$data);
	}
	
	public function add_company()
	{
	   // $city = "INDORE";
	   
	  $this->form_validation->set_rules('name','name','required');
	  //$this->form_validation->set_rules('code', 'code', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $company_name =$this->input->post('name');
		    $company_code = substr($company_name, 0, 3);
		    
			$company_list=array(
			                 'com_name'=>$company_name,
							 'com_code'=>$company_code,
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('company_tbl',$company_list);
			redirect('Masters/company_list');
		 }
		 $this->load->view('add_company');
	}
	
	public function delete_company($company_id='')
{
	      
           $this->db->delete('company_tbl', array('id'=>$company_id));
		   redirect ('Masters/company_list');

}
	
	public function product_list()
	{
		$data['productcode']=$this->Masters_model->get_product_code();
		 // print_r($data['partylist']);
		//  die();
		$this->load->view('product_list',$data);
	}
	
	public function add_product_specification()
	{
	   
	  $this->form_validation->set_rules('company','company','required');
	  $this->form_validation->set_rules('name', 'name', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
	         
	         /*-------------------------IMAGES TBL--------------------------------*/
//	echo $file =$this->input->post('file');
	
//	print_r($_FILES['file']);
	//echo $_FILES['file']['name'];
	        // die();
	if (!empty($_FILES['file']['name'])){    
        
         $imagename=date("d-m-Y")."-".time();
        //$fileinfo = pathinfo($_FILES['file']['name']);
        //$extension = $fileinfo['extension'];

        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if($ext ==='gif' || $ext ==='jpg' || $ext ==='png' || $ext ==='jpeg')
        {
            //echo $this->upload->display_errors() ;
            //die("file");
            $config = array(
            'upload_path'   => 'upload/Product_images/',
            'allowed_types' => 'jpg|png|jpeg',
            'max_size' => "2048", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'file_name'     =>$imagename //"post_images!".$imagename
             );        

            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('file'))
            {
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors() ;
            die("file");
            }
            else
            {
            $imageDetailArray = $this->upload->data();
            $fileName = "upload/Product_images/".$imagename. '.' .$ext; // $imageDetailArray['file_name'];
            }
        }
        }
        else 
        {
        $file='';
        }
        
		    $com_id =$this->input->post('company');
		    $product_name =$this->input->post('name');
		    $comp_id =$this->input->post('composition');
			  $packing =$this->input->post('packing');
			  $division =$this->input->post('division');
			  
			  $MRP =$this->input->post('MRP');
			  $GST =$this->input->post('GST');
			  $shipper =$this->input->post('shipper');
			  $hsn_code =$this->input->post('hsn_code');
			
			$composition_byid =$this->Masters_model->get_composition_byid($comp_id);
			$compo_short = $composition_byid['composition_byid']['0']['compo_short'];
			$company_byid =$this->Masters_model->get_company_byid($com_id);
			//print_r($state_byid);
			  $company_code = $company_byid['company_byid']['0']['com_code'];
			
			$data['comp_code'] = $this->Masters_model->get_comp_code($com_id);
	   $aj_no1 = $data['comp_code']['comp_code']['0']['maximum'];
	 
	   $six_digit = str_pad($aj_no1, 5, '0', STR_PAD_LEFT);
	 
	  $prod_code = $company_code." - ".$six_digit;
	  //die();
	// die();
	
         
			$product_list=array(
			                 'com_id'=>$com_id,
			                 //'product_id'=>$product_id,
							 'code'=>$prod_code,
							 'name'=>$product_name,
							 'packing'=>$packing,
							 'division'=>$division,
							 'composition_id'=>$comp_id,
							 'composition'=>$compo_short,
							 'MRP'=>$MRP,
							 'gst'=>$GST,
							 'shipper'=>$shipper,
							 'hsn_code'=>$hsn_code,
							 'product_image'=>$fileName,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			
			//print_r($product_list);
			//die();
			
            $this->db->insert('product_specification_tbl',$product_list);
            $last_id=$this->db->insert_id();
            
			redirect('Masters/product_specification_list');
		 }
		 $this->load->view('add_product_specification');
	}
	

	public function composition_list()
	{
		$data['composition_list']=$this->Masters_model->get_composition_list();
		 // print_r($data['partylist']);
		 // die();
		$this->load->view('composition_list',$data);
	}
	
	
	public function add_composition()
	{
	   
	  $this->form_validation->set_rules('short','short','required');
	  $this->form_validation->set_rules('dosage', 'dosage', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $short =$this->input->post('short');
		    $dosage =$this->input->post('dosage');
		    $indication =$this->input->post('indication');
		    $schedule =$this->input->post('schedule');
		    $narcotics =$this->input->post('narcotics');
		    $details =$this->input->post('details');
		    
			
			//$company_byid =$this->Masters_model->get_company_byid($com_id);
			//print_r($state_byid);
			 // $company_code = $company_byid['company_byid']['0']['com_code'];
			
			$data['composition_code'] = $this->Masters_model->get_composition_code();
	  $aj_no1 = $data['composition_code']['composition_code']['0']['maximum'];
	 
	  $six_digit = str_pad($aj_no1, 5, '0', STR_PAD_LEFT);
	 
	  $prod_code = "COMP"." - ".$six_digit;
	// die();
			$composition_list=array(
			                 'compo_code'=>$prod_code,
							 'compo_short'=>$short,
							 'compo_detail'=>$details,
							 'compo_dosage'=>$dosage,
							 'compo_indications'=>$indication,
							 'compo_schedule'=>$schedule,
							 'compo_narcotics'=>$narcotics,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('composition_tbl',$composition_list);
			redirect('Masters/composition_list');
		 }
		 $this->load->view('add_composition');
	}
	
	public function delete_composition($composition_id='')
{
	      
           $this->db->delete('composition_tbl', array('id'=>$composition_id));
		   redirect ('Masters/composition_list');

}
	
	public function transport_list()
	{
		$data['transport_list']=$this->Masters_model->get_transporter_list();
		 
		$this->load->view('transport_list',$data);
	}
	
	public function add_transport()
	{
	  $this->form_validation->set_rules('party_name','party_name','required');
	  //$this->form_validation->set_rules('code', 'code', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $party_id =$this->input->post('party_name');
		    $party_city =$this->input->post('city');
		    $transport_pre =$this->input->post('transport_pre');
		    $door_godown =$this->input->post('door_godown');
		    $remark =$this->input->post('remark');
		    
		    
			$transport_list=array(
			                 'party_id'=>$party_id,
							 'party_city'=>$party_city,
							 'transport_pre'=>$transport_pre,
							 'door_godown'=>$door_godown,
							 'remark'=>$remark,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('transport_tbl',$transport_list);
			redirect('Masters/transport_list');
		 }
		 $this->load->view('add_transport');
	}
	
	/*======================================================================================================*/
	
	public function composition_csvupload()
{
	//$data['businessData'] = $this->Registation_model->business_name();
	//print_r($data['businessData']);
	//die();
     $this->load->view('composition_csvupload');
}
	public function composition_csv_import()
{		
	//	$this->form_validation->set_rules('user_business', 'user_business', 'required');
          
         //if($this->form_validation->run() == true){
         
               // $user_business = $this->input->post('user_business');
				
     if(isset($_POST["import"]))
    {
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
				
            $file = fopen($filename, "r");
			fgetcsv($file);
            while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
             {
		
if (empty($importdata[0])
|| empty($importdata[1])
|| empty($importdata[2])

) {
$empty_value_found = true;
echo "empty field please check";
die();// stop our while-loop
}

 //$unique_id = $importdata[0].'_'.mt_rand(1000,9999);
 // $unique_id_date = $unique_id.date("Ymdhis");
 
 $data['composition_code'] = $this->Masters_model->get_composition_code();
	  $aj_no1 = $data['composition_code']['composition_code']['0']['maximum'];
	 
	  $six_digit = str_pad($aj_no1, 5, '0', STR_PAD_LEFT);
	 
	  $prod_code = "COMP"." - ".$six_digit;
	  
                    $data = array(
					
                       'compo_code' => $prod_code,
                        'compo_short' =>$importdata[0],                     
                        'compo_detail' =>$importdata[1],
                        'compo_dosage' =>$importdata[2],
                        'compo_indications' =>$importdata[3],
                        'compo_schedule'=>$importdata[4],
                        'compo_narcotics' =>$importdata[5],
                        'user_id' =>$_SESSION['MM_User_Id'], 
                        );
				
             $this->db->insert('composition_tbl',$data);
			 
			
			
           }                   
            fclose($file);
			$this->session->set_flashdata('message', 'Data\'s are imported successfully..');
				redirect('Masters/composition_list');
          }
		  
		  else{
			$this->session->set_flashdata('message', 'Something went wrong..');
			redirect('Masters/composition_csvupload');
		}
    
				}
				else
				{
					$this->session->set_flashdata('message', 'Something went wrong2..');
			redirect('Masters/composition_csvupload');
				}
}


	/*======================================================================================================*/
	
	public function parties_csvupload()
{
	//$data['businessData'] = $this->Registation_model->business_name();
	//print_r($data['businessData']);
	//die();
     $this->load->view('parties_csvupload');
}
	public function parties_csv_import()
{		
	//	$this->form_validation->set_rules('user_business', 'user_business', 'required');
          
         //if($this->form_validation->run() == true){
         
               // $user_business = $this->input->post('user_business');
				
     if(isset($_POST["import"]))
    {
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
				
            $file = fopen($filename, "r");
			fgetcsv($file);
            while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
             {
		
if (empty($importdata[0])
|| empty($importdata[1])
|| empty($importdata[2])

) {
$empty_value_found = true;
echo "empty field please check";
die();// stop our while-loop
}

 //$unique_id = $importdata[0].'_'.mt_rand(1000,9999);
 // $unique_id_date = $unique_id.date("Ymdhis");
 
 //$data['composition_code'] = $this->Masters_model->get_composition_code();
	 // $aj_no1 = $data['composition_code']['composition_code']['0']['maximum'];
	 
	 // $six_digit = str_pad($aj_no1, 5, '0', STR_PAD_LEFT);
	 
	  //$prod_code = "COMP"." - ".$six_digit;
	  
                    $data = array(
                        
                             'name'=>$importdata[1],
							 'category'=>$importdata[2],
							 'code'=>$importdata[0],
							 'whatsapp_no'=>$importdata[3],
							 'other_no'=>$importdata[9],
							 'mobile'=>$importdata[4],
							 'landline_no'=>$importdata[10],
							 'email'=>$importdata[5],
							 'address'=>$importdata[6],
							 'state'=>$importdata[8],
							 'city'=>$importdata[7],
							 'gstno'=>$importdata[12],
							 'transport'=>$importdata[11],
							 'dl_no'=>$importdata[13],
							 'user_id'=>$_SESSION['MM_User_Id'], 
                        );
				
             $this->db->insert('parties_list',$data);
			 
			
			
           }                   
            fclose($file);
			$this->session->set_flashdata('message', 'Data\'s are imported successfully..');
				redirect('Party_list/party_list');
          }
		  
		  else{
			$this->session->set_flashdata('message', 'Something went wrong..');
			redirect('Masters/parties_csvupload');
		}
    
				}
				else
				{
					$this->session->set_flashdata('message', 'Something went wrong2..');
			redirect('Masters/parties_csvupload');
				}
}

	public function product_specification_list()
	{
		$data['product_specification']=$this->Masters_model->get_data_product_list();
		 // print_r($data['productlist']);
		// die();
		$this->load->view('product_specification_list',$data);
	}
	public function product_specification_old_list()
	{
		$data['product_specification']=$this->Masters_model->get_product_specification_list();
		 // print_r($data['productlist']);
		// die();
		$this->load->view('old_product_specification_list',$data);
	}
	
	public function edit_product_specification($p_id='')
	{
	    if(!empty($p_id))
	    {
	       // die();
    		$data['edit_purchase_rate'] = $this->Purchase_model->edit_purchase_rate($p_id);
    		//print_r($data['edit_product_specification']);
    		$this->load->view('edit_product_specification', $data);
	    }
	    else
	    {
	        //die();
	        redirect ('Masters/edit_product_specification');
	    }
	}
	
	public function update_product_specification()
	{
		//$this->form_validation->set_rules('id','id','required');
	    $this->form_validation->set_rules('composition', 'composition', 'required');
		$this->form_validation->set_rules('MRP', 'MRP', 'required');
		$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
		if($this->form_validation->run() == true)
	    {
			  //$id =$this->input->post('id');
			  $comp_id =$this->input->post('composition');
			  
			 // $product_byid =$this->Masters_model->get_product_byid($id);
			//print_r($product_byid);
			 // $com_id = $product_byid['product_byid']['0']['com_id'];
			  //$product_name = $product_byid['product_byid']['0']['prod_name'];
			  //$product_code = $product_byid['product_byid'][0]['prod_code'];
			  
			  $composition_byid =$this->Masters_model->get_composition_byid($comp_id);
			//print_r($composition_byid);
			  $compo_short = $composition_byid['composition_byid']['0']['compo_short'];
			  //$product_code = $product_byid['product_byid'][0]['prod_code'];
			  
			  //$product_code =$this->input->post('product_code');
			  $packing =$this->input->post('packing');
			  $division =$this->input->post('division');
			  $composition =$this->input->post('composition');
			  $MRP =$this->input->post('MRP');
			  $GST =$this->input->post('GST');
			  $shipper =$this->input->post('shipper');
			  $hsn_code =$this->input->post('hsn_code');
			  $hdnid = $this->input->post('hdnid');
			  
			 
	
	if (!empty($_FILES['file']['name'])){    
        
        $imagename=date("d-m-Y")."-".time();
        //$fileinfo = pathinfo($_FILES['file']['name']);
        //$extension = $fileinfo['extension'];

        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if($ext ==='gif' || $ext ==='jpg' || $ext ==='png' || $ext ==='jpeg')
        {
            $config = array(
            'upload_path'   => './upload/Product_images/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size' => "2048", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'file_name'     =>$imagename //"post_images!".$imagename
             );        

            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('file'))
            {
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors() ;
            die("file");
            }
            else
            {
            $imageDetailArray = $this->upload->data();
            $fileName = "upload/Product_images/".$imagename. '.' ."png"; // $imageDetailArray['file_name'];
            }
        }
        }
        else 
        {
        $file='';
        }
			  $product_specification_data=array(
			                 //'com_id'=>$com_id,
			                 //'product_id'=>$id,
			                 //'name'=>$product_name,
							 //'code'=>$product_code,
							 'packing'=>$packing,
							 'division'=>$division,
							 'composition_id'=>$comp_id,
							 'composition'=>$compo_short,
							 'MRP'=>$MRP,
							 'gst'=>$GST,
							 'shipper'=>$shipper,
							 'hsn_code'=>$hsn_code,
							 'product_image'=>$fileName,
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
           $this->db->update('product_specification_tbl',$product_specification_data,array('id'=>$hdnid));
			redirect('Masters/product_specification_list');
		}
		$this->load->view('Masters/product_specification_list');
	}

public function delete_party($party_id='')
{
	      
           $this->db->delete('parties_list', array('party_id'=>$party_id));
		   redirect ('Party_list/party_list');

}

public function edit_party($party='')
{
	
	 $this->form_validation->set_rules('party_code', 'party_code', 'required');
        
     if($this->form_validation->run() == true)
	 {
		$party_name =$this->input->post('party_name');
			  $party_category =$this->input->post('party_category');
			  $party_code =$this->input->post('party_code');
			  $whatsapp_number =$this->input->post('whatsapp_number');
			  $alternate_number =$this->input->post('other_number');
			  $mobile_number =$this->input->post('mobile_number');
			  $landline_number =$this->input->post('landline_number');
			  $email_id =$this->input->post('email_id');
			  $address =$this->input->post('address');
			  $state =$this->input->post('state');
			  $city =$this->input->post('city');
			  $Gst_number =$this->input->post('Gst_number');
			  $transport =$this->input->post('transport');
			  $dl_no =$this->input->post('dl_no');
			  $hdnid = $this->input->post('hdnid');
			  
			  
			  $party_data=array(
			                 'name'=>$party_name,
							 'category'=>$party_category,
							 'code'=>$party_code,
							 'whatsapp_no'=>$whatsapp_number,
							 'other_no'=>$alternate_number,
							 'mobile'=>$mobile_number,
							 'landline_no'=>$landline_number,
							 'email'=>$email_id,
							 'address'=>$address,
							 'state'=>$state,
							 'city'=>$city,
							 'gstno'=>$Gst_number,
							 'transport'=>$transport,
							 'dl_no'=>$dl_no,
			);
				  //print_r($hdnid);
				 // die();
	
	 $this->db->update('parties_list',$party_data,array('party_id'=>$hdnid ));

     redirect ('Party_list/party_list');
	 }
	 
	 $data['party_list_byid'] = $this->Party_model->get_details_by_party($party);
	 //print_r($data['edit_party']);
	 //die();
      $this->load->view('edit_party',$data);
}
 //---------------------------------------------------------------------------------------------------    
        public function edit_composition($comp_id='')
{
	
	$this->form_validation->set_rules('short','short','required');
	  $this->form_validation->set_rules('dosage', 'dosage', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $short =$this->input->post('short');
		    $dosage =$this->input->post('dosage');
		    $indication =$this->input->post('indication');
		    $schedule =$this->input->post('schedule');
		    $narcotics =$this->input->post('narcotics');
		    $details =$this->input->post('details');
		    $hdnid = $this->input->post('hdnid');
		    
			$composition_list=array(
							 'compo_short'=>$short,
							 'compo_detail'=>$details,
							 'compo_dosage'=>$dosage,
							 'compo_indications'=>$indication,
							 'compo_schedule'=>$schedule,
							 'compo_narcotics'=>$narcotics,
			);
	
	 $this->db->update('composition_tbl',$composition_list,array('id'=>$hdnid ));

     redirect ('Masters/composition_list');
	 }
	 
	 $data['composition_byid'] = $this->Masters_model->get_composition_byid($comp_id);
      $this->load->view('edit_composition',$data);
}

//---------------------------------------------------------------------------------------------------    
        public function edit_company($com_id='')
{
	
	$this->form_validation->set_rules('name','name','required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $name =$this->input->post('name');
		    $code =$this->input->post('code');
		    
		    $hdnid = $this->input->post('hdnid');
		    
			$company_edit=array(
							 'com_name'=>$name,
							 'com_code'=>$code,
			);
	
	 $this->db->update('company_tbl',$company_edit,array('id'=>$hdnid ));

     redirect ('Masters/company_list');
	 }
	 
	 $data['company_byid'] = $this->Masters_model->get_company_byid($com_id);
	 //print_r($data['company_byid']);
	 //die();
      $this->load->view('edit_company',$data);
}


public function delete_product($product_id='')
{
	      
           $this->db->delete('product_specification_tbl', array('id'=>$product_id));
		   redirect ('Masters/product_specification_list');

}

	/*======================================================================================================*/
	
	public function products_csvupload()
{
	//$data['businessData'] = $this->Registation_model->business_name();
	//print_r($data['businessData']);
	//die();
     $this->load->view('products_csvupload');
}
	public function products_csv_import()
{		
	//	$this->form_validation->set_rules('user_business', 'user_business', 'required');
          
         //if($this->form_validation->run() == true){
         
               // $user_business = $this->input->post('user_business');
				
     if(isset($_POST["import"]))
    {
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
				
            $file = fopen($filename, "r");
			fgetcsv($file);
            while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
             {
		
if (empty($importdata[0])
|| empty($importdata[1])
|| empty($importdata[2])

) {
$empty_value_found = true;
echo "empty field please check";
die();// stop our while-loop
}

            $composition_byid =$this->Masters_model->get_composition_byid($importdata[1]);
			$compo_short = $composition_byid['composition_byid']['0']['compo_short'];
			$compo_id = $composition_byid['composition_byid']['0']['id'];
			$company_byid =$this->Masters_model->get_company_byid($importdata[0]);
			//print_r($state_byid);
			  $company_code = $company_byid['company_byid']['0']['com_code'];
			 $com_id= $company_byid['company_byid']['0']['id'];
			$data['comp_code'] = $this->Masters_model->get_comp_code($importdata[0]);
	   $aj_no1 = $data['comp_code']['comp_code']['0']['maximum'];
	 
	   $six_digit = str_pad($aj_no1, 5, '0', STR_PAD_LEFT);
	 
	  $prod_code = $company_code." - ".$six_digit;
	  //die();
	// die();
	
         
			$product_list=array(
			                 'com_id'=>$com_id,
			                 //'product_id'=>$product_id,
							 'code'=>$prod_code,
							 'name'=>$importdata[2],
							 'packing'=>$importdata[3],
							 'division'=>$importdata[4],
							 'composition_id'=>$compo_id,
							 'composition'=>$compo_short,
							 'MRP'=>$importdata[5],
							 'gst'=>$importdata[6],
							 'shipper'=>$importdata[7],
							 'hsn_code'=>$importdata[8],
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
				
             $this->db->insert('product_specification_tbl',$product_list);
			 
			
			
           }                   
            fclose($file);
			$this->session->set_flashdata('message', 'Data imported successfully..');
				redirect('Masters/product_specification_list');
          }
		  
		  else{
			$this->session->set_flashdata('message', 'Something went wrong..');
			redirect('Masters/products_csvupload');
		}
    
				}
				else
				{
					$this->session->set_flashdata('message', 'Something went wrong2..');
			redirect('Masters/products_csvupload');
				}
}

/*======================================================================================================*/
	
	public function citystate_csvupload()
{
	//$data['businessData'] = $this->Registation_model->business_name();
	//print_r($data['businessData']);
	//die();
     $this->load->view('citystate_csvupload');
}
	public function citystate_csv_import()
{		
	//	$this->form_validation->set_rules('user_business', 'user_business', 'required');
          
         //if($this->form_validation->run() == true){
         
               // $user_business = $this->input->post('user_business');
				
     if(isset($_POST["import"]))
    {
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
				
            $file = fopen($filename, "r");
			fgetcsv($file);
            while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
             {
		
if (empty($importdata[0])
|| empty($importdata[1])
|| empty($importdata[2])

) {
$empty_value_found = true;
echo "empty field please check";
die();// stop our while-loop
}

 $state_bycode =$this->Masters_model->get_state_bystatecode($importdata[2]);
			//print_r($state_byid);
			  $state = $state_bycode['state_bycode']['0']['state'];
			  $state_code = $state_bycode['state_bycode'][0]['state_code'];
			 //die();
			$state_city=array(
			                 'city'=>$importdata[0],
							 'state'=>$state,
							 'tier_cat'=>$importdata[1],
							 'state_code'=>$state_code,
			);
 
                    
             $this->db->insert('state_city_list',$state_city);
			 
			//print_r($state_city);
			//die();
			
           }                   
            fclose($file);
			$this->session->set_flashdata('message', 'Data imported successfully..');
				redirect('State_list/state_city_list');
          }
		  
		  else{
			$this->session->set_flashdata('message', 'Something went wrong..');
			redirect('Masters/citystate_csvupload');
		}
    
				}
				else
				{
					$this->session->set_flashdata('message', 'Something went wrong2..');
			redirect('Masters/citystate_csvupload');
				}
}



		// /////
		public function get_city(){
			if (isset($_POST['get_city'])) {
				$state_code = $this->input->post('state_code');
				$data = array();
				$data = $this->State_city_model->get_city_as_per_state($state_code);
				echo json_encode($data);
				
			}else{
				$data['flag'] = 0;
				$data['message'] ="ERROR";
				echo json_encode($data);
			}

		}
		public function get_state(){
			if (isset($_POST['get_state'])) {
				$data = array();
				$data = $this->State_city_model->get_state();
				// print_r($data);die;
				echo json_encode($data);
				
			}else{
				$data['flag'] = 0;
				$data['message'] ="ERROR";
				echo json_encode($data);
			}

		}
		public function add_transports(){
			
			// $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('Name','Name','required','Please enter the name');
			//$this->form_validation->set_rules('state[]','State','required','Please Select the State');
			//$this->form_validation->set_rules('transport_city[]','City','required','Please Select a State which have a city');


			if ($this->form_validation->run() == FALSE)
            {
                    $this->load->view('add_transport');
            }
            else
            {
                   $data = $this->input->post();
		 			$result = $this->Transport_model->set_transport_charges($data);
		 			if ($result) {
		 				$this->session->set_flashdata('message', 'Added Transport successfully!');
		 				redirect('Masters/transport_list');
		 			}else{
		 				$this->session->set_flashdata('message', 'Sorry Could Not Added trasport!');
		 				$this->load->view('add_transport');
		 			}
		 			
            }
 			
		}
		
		
public function edit_transport($transport_id='')
{
	
	 $this->form_validation->set_rules('Name', 'Name', 'required');
        
     if($this->form_validation->run() == true)
	 {
		
     	  $Name =$this->input->post('Name');
		  $city_name =$this->input->post('city_name');
		  $address =$this->input->post('address');
		  $whatsapp_number =$this->input->post('Whats_app');
		  $contact_person =$this->input->post('contact_person');
		  $contact_number =$this->input->post('contact_number');
		  $landline_one =$this->input->post('landline_one');
		  $landline_two =$this->input->post('landline_two');
		  $landline_three =$this->input->post('landline_three');
		  $city_of_head_office =$this->input->post('head_city_name');
		 
			  
			  
			$transporter_data=array(
			                 'Name'=>$Name,
							 'city'=>$city_name,
							 'address'=>$address,
							 'contact_person'=>$contact_person,
							 'whatsapp_number'=>$whatsapp_number,
							 'contact_number'=>$contact_number,
							 'landline_one'=>$landline_one,
							 'landline_two'=>$landline_two,
							 'landline_three'=>$landline_three,
							 'city_of_head_office'=>$city_of_head_office,
							
			);
				 //  print_r($transport_id);
				 // die();
	
		 $this->db->update('transports_tbl',$transporter_data,array('id'=>$transport_id ));

	     redirect ('Masters/transport_list');
	 }
	 
	 //data['transport_charges'] = $ths->Transport_model->get_transport_charges_by_id($transport_id);
	 $data['transport_list'] = $this->Transport_model->get_transport_by_id($transport_id);
	 // print_r($data['transport_charges']['transport_charge']);
	 // die();
      $this->load->view('edit_transport',$data);
}

public function delete_transport($transport_id='')
{
	      
           $this->db->delete('transports_tbl', array('id'=>$transport_id));
           $this->db->delete('transport_charges', array('transport_id'=>$transport_id));
		   redirect ('Masters/transport_list');

}
public function edit_transport_charge($transport_charges_id='')
{
	
	 $this->form_validation->set_rules('transport_state', 'State', 'required');
        
     if($this->form_validation->run() == true)
	 {
			
			// print_r($this->input->post());die;
     	  $transport_state =$this->input->post('transport_state');
		  $transport_city =$this->input->post('transport_city');
		  $transport_term =$this->input->post('transport_term');
		  $rs_per_case =$this->input->post('rs_per_case');
		  $lr_charges =$this->input->post('lr_charges');
		  $add_charges =$this->input->post('add_charges');
		  $rs_upto_15 =$this->input->post('upto_15');
		  $rs_upto_30 =$this->input->post('upto_30');
		  
		 
			  
			  
			$transport_charges =array(
			                 'transport_state'=>$transport_state,
							 'transport_city'=>$transport_city,
							 'transport_term'=>$transport_term,
							 'rs_per_case'=>$rs_per_case,
							 'lr_charges'=>$lr_charges,
							 'add_charges'=>$add_charges,
							 'rs_upto_15'=>$rs_upto_15,
							 'rs_upto_30'=>$rs_upto_30,
							 
							
			);
				 //  print_r($transport_id);
				 // die();
	
		 $this->db->update('transport_charges',$transport_charges ,array('id'=>$transport_charges_id ));

	     redirect ('Masters/transport_list');
	 }
	 
	 $data['transport_charges'] = $this->Transport_model->get_transport_charges_by_id($transport_charges_id);
	 
	 // print_r($data['transport_charges']['transport_charge']);
	 // die();
      $this->load->view('edit_transport_charge',$data);
}
		

}


?>