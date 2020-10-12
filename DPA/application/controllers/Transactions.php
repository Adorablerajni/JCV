<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
        $this->load->library('html2pdf');
       //$this->load->library('lib_log');
       $this->load->model('Masters_model');
       $this->load->model('Party_model');
       $this->load->model('Product_model');
       $this->load->model('Purchase_model');
        $this->load->model('Transaction_model');
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
	public function transactions_list()
	{
		$data['transaction_list']=$this->Transaction_model->get_transactions_list();
		$this->load->view('transactions_list',$data);
	}
	
	public function add_transaction()
	{
	   // $city = "INDORE";
	   
	  $this->form_validation->set_rules('city','city','required');
	  $this->form_validation->set_rules('party', 'party', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $city =$this->input->post('city');
		    $party =$this->input->post('party');
		    $payment =$this->input->post('payment');
		    $freight_option =$this->input->post('freight_option');
		    $freight =$this->input->post('freight');
		    $address =$this->input->post('address');
		    $email =$this->input->post('email');
		    $contact_p =$this->input->post('contact_p');
		    $wa_no =$this->input->post('wa_no');
		    $ll_no =$this->input->post('ll_no');
		    $taxable_amount =$this->input->post('taxable_amount');
		    $total_gst =$this->input->post('total_gst');
		    $final_amnt =$this->input->post('final_amnt');
		    $freight_extra =$this->input->post('freight_extra');
		    $addi_cost =$this->input->post('addi_cost');
		    $total_due =$this->input->post('total_due');
		    $payment_method =$this->input->post('payment_method');
		    $remark =$this->input->post('remark');
		    $invoice_date =date('Y-m-d');
		    
		    $data['party_list_byid'] = $this->Party_model->get_details_by_party($party);
		    
			$transactions_list=array(
			                 'city'=>$city,
							 'party_id'=>$party,
							 'party_name'=>$data['party_list_byid']['party_list_byid']['0']['name'],
							 'payment_terms'=>$payment,
							 'frieght_type'=>$freight_option,
							 'frieght_charges'=>$freight,
							 'party_address'=>$address,
							 'contact_person'=>$contact_p,
							 'whatsapp_no'=>$wa_no,
							 'email'=>$email,
							 'landline_no'=>$ll_no,
							 'taxable_amount'=>$taxable_amount,
							 'total_gst'=>$total_gst,
							 'final_amount'=>$final_amnt,
							 'freight_any'=>$freight_extra,
							 'additional_cost'=>$addi_cost,
							 'total_amount'=>$total_due,
							 'payment_method'=>$payment_method,
							 'remark'=>$remark,
							 'invoice_date'=>$invoice_date,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('transactions_list',$transactions_list);
            
            $last_id=$this->db->insert_id();
            
            $k=0; 
	 $module_id = $this->input->post('product');
         if(isset($module_id)!='')
         {
         foreach($module_id as $value) 
	 {
	     $data['product_byid'] = $this->Masters_model->get_product_byid($this->input->post('product')[$k]);
	     	// echo "<pre>";
	     	// print_r($data['product_byid'] );
	     	// echo "</pre>";die;
            $product = $this->input->post('product')[$k];
            $company = $this->input->post('company')[$k];
            $packing = $this->input->post('packing')[$k];
            $mrp = $this->input->post('mrp')[$k];
            $quantity = $this->input->post('quantity')[$k];
            $rate = $this->input->post('rate')[$k];
            $price = $this->input->post('price')[$k];
            $tax = $this->input->post('tax')[$k];
            $amount = $this->input->post('amount')[$k];
            
            
            if (isset($product))
            {
               
            $transactions_productsData = array(
                'product_name'=> $data['product_byid']['product_byid'][0]['name'],
                'product_id'=>$product,
                'company'=>$company,
                'packing'=>$packing,
                'mrp'=>$mrp,
                'quantity'=>$quantity,
                'rate'=>$rate,
                'price'=>$price,
                'tax'=>$tax,
                'amount'=>$amount,
                'transaction_id'=>$last_id,
                'user_id'=>$_SESSION['MM_User_Id'],
                );

                $this->db->insert('transactions_products',$transactions_productsData);              
            }
 
            $k++;
         }  
         }
  
  
            
			redirect('Transactions/add_transaction');
		 }
		 $this->load->view('add_transaction');
	}
	
	// -------------------- party details by party ----------------------
//public function get_details_by_party($party_id)
 //{
  //  $this->Party_model->get_details_by_party($party_id);
 //}	

public function get_details_by_party()
 {
  if($this->input->post('party_id'))
  {
     $data['party_list_byid'] = $this->Party_model->get_details_by_party($this->input->post('party_id'));
    //return($data['party_list_byid']);
    echo $data_json = json_encode($data['party_list_byid']);
    
  }
 }	

public function get_products_by_id()
 {
  if($this->input->post('product_id'))
  {
     $data['product_byid'] = $this->Party_model->get_product_byid($this->input->post('product_id'));
    //return($data['packing']);
    echo $data_json = json_encode($data['product_byid']);
    
  }
 }
 
// =======================================================================================================================
	public function product_list()
	{
		$data['productcode']=$this->Masters_model->get_product_code();
		 // print_r($data['partylist']);
		//  die();
		$this->load->view('add_transaction',$data);
	}
	
	public function add_product()
	{
	   
	  $this->form_validation->set_rules('company','company','required');
	  $this->form_validation->set_rules('name', 'name', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $com_id =$this->input->post('company');
		    $product_name =$this->input->post('name');
		    
			
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
							 'prod_code'=>$prod_code,
							 'prod_name'=>$product_name,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('
            	product_tbl',$product_list);
			redirect('Masters/product_list');
		 }
		 $this->load->view('add_product');
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
	
	public function transport_list()
	{
		$data['transport_list']=$this->Masters_model->get_transport_list();
		 // print_r($data['partylist']);
		 // die();
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

	public function manage_discounts()
	{
	//	$data['manage_discounts']=$this->Masters_model->get_transport_list();
		 // print_r($data['partylist']);
		 // die();
		 $party =  $this->input->post('party');
		
		 $city =  $this->input->post('city');
		
		 $freight =  $this->input->post('freight');
		
		 $quantity =  $this->input->post('quantity');
		
		 $product =  $this->input->post('product');
		
		 $payment =  $this->input->post('payment');
		 
		  $rate =  $this->input->post('rate');
		
		$condition="0"; 
	
    	if($party != '')  
    	{
        	$data['party_list_byid'] = $this->Party_model->get_details_by_party($party);
        	 $count_party="0";
        	//echo "-";
    	}
    	else
    	{
    	    $count_party ="0";  
    	}
    	
    	if($city != '')  
    	{
    	    
        	$data['cityslab_byid'] = $this->Masters_model->get_cityslab_by_id($product, $city);
        	
        	if($data['cityslab_byid']['flag']!=0){
        	    //print_r($data['cityslab_byid']);
        	$discount = $data['cityslab_byid']['cityslab_byid']['0']['discount'];
        	 $count_city = $rate*($discount)/100;
        	}
        	else
    	{
    	    $count_city ="0";  
    	}
        	//$count_city ="2";
        	//echo "-";
    	}
    	
    	
    	if($freight != '')  
    	{
    	     $count_freight =$freight;
    	    //echo "-";
    	}
    	else
    	{
    	    $count_freight ="0";  
    	}
    	
    	if($quantity != '')  
    	{
    	    
        	$data['quantity_byid'] = $this->Masters_model->get_quantity_by_id($product, $quantity);
        	//print_r($data['quantity_byid']);
        	if($data['quantity_byid']['flag']!=0){
        	$quantity_discount = $data['quantity_byid']['quantity_byid']['0']['discount'];
        	
        	    $count_quantity = $rate*$quantity_discount/100;
        	}
        	else 
        	{
        	    $count_quantity="0";
        	}
        	 
        	//echo "-";
    	}
    	
    	if($product != '')
    	{
        	$data['marginslab_byid'] = $this->Masters_model->get_productspecification_by_id($product);
        	if($data['marginslab_byid']['flag']!=0){
        	$brand_margin = $data['marginslab_byid']['marginslab_byid']['0']['brand_margin'];
        	 $count_margin = $rate*$brand_margin/100;
        	}
        	else
    	{
    	    $count_margin ="0";  
    	}
        	//echo "-";
    	}
    	
    	
    	if($payment != '')  
    	{
        	$data['credit_byid'] = $this->Masters_model->get_credit_by_id($payment);
        	if($data['credit_byid']['flag']!=0){
        	$credit_margin = $data['credit_byid']['credit_byid']['0']['credit_percentage'];
        	//$credit_plus_minus = $data['credit_byid']['plus_minus'];
             $count_credit = $rate*($credit_margin)/100;
        	}
        	else
    	{
    	    $count_credit ="0";  
    	}
        	//echo "-";
    	}
    	
    	
    //	$total_discount= if($count_party>0){echo $count_party;}
    	    
    	   //echo  !empty($count_party);
    	   //echo !empty($count_freight);
    	   //echo !empty($count_city);
    	   //echo !empty($count_quantity);
    	  // echo !empty($count_margin);
    	  // echo !empty($count_credit);
    	   
    	    echo $final_amount = $rate+ $count_party+$count_freight+$count_city+$count_quantity+$count_margin+$count_credit;
    		$this->load->view('manage_discounts');
    	}
    	
    
        //===================================================================================================
        
        public function invoice($t_id)
	{
		$data['transactions_list_byid']=$this->Transaction_model->transactions_list_byid($t_id);
		//print_r($data['transaction_list']);
		$this->load->view('view_invoice',$data);
	}
	
	    //========================================EMAIL PHP Mailer2======================================================
	    
	   public function send_pdf(){
    
	    //Load the library
	    $this->load->library('html2pdf');
	    
	    //Set folder to save PDF to
	    $this->html2pdf->folder('./assets/pdfs/');
	    
	    //Set the filename to save/download as
	    $this->html2pdf->filename('test.pdf');
	    
	    //Set the paper defaults
	    $this->html2pdf->paper('a4', 'portrait');
	    
	    $data = array(
	    	'title' => 'PDF Created',
	    	'message' => 'Hello World!'
	    );
	    
	    //Load html view
	    $this->html2pdf->html($this->load->view('pdf', $data, true));
	    
	    if($this->html2pdf->create('save')) {
	    	//PDF was successfully saved or downloaded
	    	 
	    	echo 'PDF saved';
	    }
	    
	   
    } 
    
	public function mail_pdf($t_id)
    {
		//Load the library
	    $this->load->library('html2pdf');
	    
	    $this->html2pdf->folder('./assets/pdfs/');
	    $this->html2pdf->filename('Invoice.pdf');
	    $this->html2pdf->paper('a4', 'portrait');
	    
	    $data = array(
	    	'title' => 'PDF Created',
	    	'message' => 'Hello World!'
	    );
	    //Load html view
	    //$this->html2pdf->html($this->load->view('invoice', $data, true));
	    	$data['transactions_list_byid']=$this->Transaction_model->transactions_list_byid($t_id);
		//print_r($data['transaction_list']);
		$party_email =$data['transactions_list_byid']['transactions_list_byid'][0]['email'];
		$this->html2pdf->html($this->load->view('invoice_pdf',$data, true));
	    
	    
	    //Check that the PDF was created before we send it
	    if($path = $this->html2pdf->create('save')) {
	    	
			$this->load->library('email');

			$this->email->from('rahulgenius999@gmail.com', 'Mercure Pharmaceuticals Pvt. Ltd.');
			$this->email->to($party_email); 
			
			$this->email->subject('Mercure Invoice');
			$this->email->message('Please find attached invoice with this mail. Thanks');	

			$this->email->attach($path);

			$this->email->send();
			
			$this->email->print_debugger();
			
			$this->session->set_flashdata('message', 'Mail Sent Successfully!');
			redirect('Transactions/transactions_list');
	    }
	    
    }
	    
}


?>