<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	function __construct(){
	  	parent::__construct();
        // $this->load->library('session');
       //$this->load->library('lib_log');
        $this->load->model('Dispatch_model');
          $this->load->model('Sales_model');
	 }
	public function invoice()
	{  
	    $Voucher =  urldecode($this->uri->segment(3));
	    $Date =  urldecode($this->uri->segment(4));
		$data['dis_data']=$this->Dispatch_model->get_details_by_voucher($Voucher,$Date);
		
		//print_r($data['transaction_list']);
		$this->load->view('dis_invoice',$data);
	}
	public function purchase_list(){
	 	$data['purchase_list'] = $this->Sales_model->get_purchase();
	 	// echo "<pre>";
	 	// print_r($data['purchase_list']);
	 	// echo "</pre>";die;

		$this->load->view('sales_invoice',$data);
	}
	public function sale_list(){
		$data['sale_list'] = $this->Sales_model->get_sale();
//     	echo "<pre>";
// 		print_r($data['sale_list']);
// 	 	echo "<pre>";die;
		$this->load->view('sales_invoice_g',$data);
	}
	public function purchase_bill_list(){
	 	$data['purchase_list_m'] = $this->Sales_model->get_purchase_m();
	 	// print_r($data['purchase_list']);
		$this->load->view('sales_m_invoice_p',$data);
	}
	public function sale_bill_list(){
		$data['sale_list_m'] = $this->Sales_model->get_sale_m();
	 	// print_r($data['purchase_list']);
		$this->load->view('sales_m_invoice_g',$data);
	}
	
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
    
	public function mail_pdf()
    {   
         $Voucher =  urldecode($this->uri->segment(3));
	    $Date =  urldecode($this->uri->segment(4));
		//Load the library
	    $this->load->library('html2pdf');
	    
	    $this->html2pdf->folder('./assets/pdfs/');
	    $this->html2pdf->filename('Invoice.pdf');
	    $this->html2pdf->paper('a4', 'portrait');
	    
	    $data = array(
	    	'title' => 'PDF Created',
	    	'message' => 'Hello World!'
	    );
	   $data['dis_data']=$this->Dispatch_model->get_details_by_voucher($Voucher,$Date);
	   $this->html2pdf->html($this->load->view('dis_invoice_pdf',$data, true));
	    
	    
	    $party_email =$data['dis_data']['dis_data'][0]['email'];
	  
	   // echo $message;
	    //Check that the PDF was created before we send it
	    if($path = $this->html2pdf->create('save')) {
	    	
			$this->load->library('email');

			$this->email->from('rahulgenius999@gmail.com', 'Mercure Pharmaceuticals Pvt. Ltd.');
			$this->email->to($party_email); 
			$this->email->set_mailtype('html'); 
			
			$this->email->subject('Mercure Invoice');
			$this->email->message('Please check attached Invoice');	

			$this->email->attach($path);

			$response = $this->email->send();
			if($response){
			     $this->session->set_flashdata('message', 'Mail Sent Successfully!');
			    redirect('Sales/sale_list');
			}else{
			     $this->session->set_flashdata('error_message', 'Mail Could Not Sent!');
			    redirect('Sales/sale_list');
			    
			}
		   
			
		
			
// 			$this->session->set_flashdata('message', 'Mail Sent Successfully!');
// 			//redirect('Transactions/transactions_list');
	    }
			
	
	    
    }

}
?>