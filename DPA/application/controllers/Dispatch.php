<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Dispatch extends CI_Controller {
	function __construct(){
	  	parent::__construct();
        $this->load->model('Dispatch_model');
        $this->load->model('State_city_model');
       
	 }
	public function search_transporter(){
	    
		$this->load->view('search_transporter');
	}
	public function get_transporter(){
		$city = $this->input->post('transport_city');
		$data = $this->Dispatch_model->get_transporter_as_per_city($city);
		// print_r($data);
		echo json_encode($data);
	}
	public function get_dispatch(){
		$Voucher = $this->input->post('Voucher');
		$Date = $this->input->post('Date');
		$Type = $this->input->post('Type');
		$data['transporter_details'] = $this->Dispatch_model->get_all_transporter();
		$data['dis_data'] = $this->Dispatch_model->get_dispatch_details($Voucher ,$Date);
		$data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type);
		$data['flag']=1;
		// print_r($data);
		echo json_encode($data);
	}
    public function freight_paid_register(){
        
        $data['sale_list'] = $this->Dispatch_model->get_freight_paid();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        $this->load->view('freight_paid_register',$data);
        
        
    }
    
    
	public function update_dispatch(){
		$Voucher = $this->input->post('Voucher');
		$Type = $this->input->post('Type');
		$frieght_amt = $this->input->post('frieght_amt');
		$date_of_dispatch = $this->input->post('date_of_dispatch');
		$transport = $this->input->post('transporter');
		if($frieght_amt == '' || empty($frieght_amt)){
		    $frieght_amt="PAID";
		}
// 		echo $transport;die;
		$due_date = $this->input->post('due_date');
		$Date = $this->input->post('Date');
		$freight_paid = $this->input->post('freight_paid');
		
		$check_data = $this->Dispatch_model->check_voucher_date($Voucher,$Date);
		if($check_data){
		    $update_dispatch = array(
    		        'date_of_dispatch'=> $date_of_dispatch,
    		        'due_date' =>  $due_date,
    		        'transporter' => $transport,
    		        'frieght_amt'=> $frieght_amt,
    		        'freight_paid'=>$freight_paid
    		    );
    		$result = $this->db->update('data_dis',$update_dispatch,array('Voucher'=> $Voucher,'Date'=>$Date));
    		$query = $this->db->last_query();
    // 		echo $query; die;
    		if($result){
    		    $this->mail_pdf($Voucher,$Date,$Type);
    		}
    		else{
    		    echo json_encode(array('flag'=>0 ,"message"=>"Could not updated data"));
    		}
		}
		else{
		     echo json_encode(array('flag'=>0 ,"message"=>"No Voucher Available!"));
		}
		
		
		
	}	
	public function update_lr(){
		$Voucher = $this->input->post('Voucher');
		$lr_charges = $this->input->post('lr_number');
		$Date = $this->input->post('Date');
		$Type = $this->input->post('Type');
		$check_data = $this->Dispatch_model->check_voucher_date($Voucher,$Date);
	
		if($check_data){
		    //$check_dispatch = $this->Dispatch_model->get_details_by_voucher($Voucher,$Date);
		    //echo $check_dispatch['dis_data'][0]['date_of_dispatch'],$check_dispatch['dis_data'][0]['due_date'],$check_dispatch['dis_data'][0]['transport_dis'],$check_dispatch['dis_data'][0]['frieght_amt'];die;
		    if (!empty($_FILES['file']['name'])){    
        
           $imagename=date("d-m-Y")."-".time();
	        //$fileinfo = pathinfo($_FILES['file']['name']);
	        //$extension = $fileinfo['extension'];

        	$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

	        if($ext ==='gif' || $ext ==='jpg' || $ext ==='png' || $ext ==='jpeg')
	        {
	            
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
	            	echo json_encode(array('flag'=>0 ,"message"=>"Image Could not update",'error'=>$error));
	           
	            }
	            else
	            {
		            $imageDetailArray = $this->upload->data();
		            $fileName = "upload/Product_images/".$imagename. '.' .$ext; // $imageDetailArray['file_name'];
		            $update_dispatch = array(
				        'lr_number'=> $lr_charges,
				        'lr_image_copy'=> $fileName
				  	);
				  
				  
		  	    	$result = $this->db->update('data_dis',$update_dispatch,array('Voucher'=> $Voucher,'Date'=>$Date));
					$query = $this->db->last_query();
					if($result){
					    $this->mail_pdf_lr($Voucher,$Date,$Type);
					    //echo json_encode(array('flag'=>1 ,"message"=>"Updated LR Data",'query'=>$query));
					    
					}
					else{
					    echo json_encode(array('flag'=>0 ,"message"=>"Could not update data"));
					}
				  	    
				  	
				
			    }
	        }
        }
            else{
        	$filename ='';
        	$update_dispatch = array(
		        'lr_number'=> $lr_charges,
		        'lr_image_copy'=> $fileName
		  	);
			$result = $this->db->update('data_dis',$update_dispatch,array('Voucher'=> $Voucher,'Date'=>$Date));
// 			$data['dis_data']=$this->Dispatch_model->get_details_by_voucher($Voucher,$Date);
			$query = $this->db->last_query();
			if($result){
			    $this->mail_pdf_lr($Voucher,$Date);
		    	
			}
			else{
			    echo json_encode(array('flag'=>0 ,"message"=>"Could not update data"));
			}
        } 
		}
	  	else{
		    echo json_encode(array('flag'=>0 ,"message"=>"No Voucher Available!"));
		}
	   
		
		
		
		
	}
	public function update_final(){
		$Voucher = $this->input->post('Voucher');
		$exp_del_date = $this->input->post('exp_del_date');
		$Date = $this->input->post('Date');
		$Type = $this->input->post('Type');
		$tr_number = $this->input->post('tr_number');
		$check_data = $this->Dispatch_model->check_voucher_date($Voucher,$Date);
	
		if($check_data){
		    $update_dispatch = array(
		        'transporter_contact'=> $tr_number,
		        'expected_del_date'=> $exp_del_date
		  	);
			$result = $this->db->update('data_dis',$update_dispatch,array('Voucher'=> $Voucher,'Date'=>$Date));
			if($result){
			     $this->mail_final_pdf($Voucher,$Date,$Type);
			    
			}
			else{
			     echo json_encode(array('flag'=>0 ,"message"=>"Could not update data"));
			}
		    
		}
		else{
		    echo json_encode(array('flag'=>0 ,"message"=>"No Voucher Available!"));
		}
	   
		
		
		
		
	}
 
   
    
	public function mail_pdf($Voucher,$Date,$Type)
    {
		//Load the library
	    $this->load->library('html2pdf');
	    
	    $this->html2pdf->folder('./assets/pdfs/');
	    $this->html2pdf->filename('Invoice.pdf');
	    $this->html2pdf->paper('a4', 'portrait');
	    $data['dis_data']=$this->Dispatch_model->get_details_by_voucher($Voucher,$Date);
	    $this->html2pdf->html($this->load->view('dis_invoice_pdf',$data, true));
	    
	    
	    $party_email =$data['dis_data']['dis_data'][0]['email'];
	    if($data['dis_data']['dis_data'][0]['frieght_amt'] == 'PAID'){
	        $freight = "PAID";
	    }else{
	        $freight ='Rs.'. $data['dis_data']['dis_data'][0]['frieght_amt'];
	    }
	    $message = $this->load->view('message', '', TRUE);
	    $message = str_replace('{{dispatch}}',$data['dis_data']['dis_data'][0]['date_of_dispatch'],$message);
	    $message = str_replace('{{duedate}}',$data['dis_data']['dis_data'][0]['due_date'],$message);
	    $message = str_replace('{{transport}}',$data['dis_data']['dis_data'][0]['transport_dis'],$message);
	    $message = str_replace('{{Rs.fright}}',$freight,$message);
	  //  $message = str_replace('{{exp_del_date}}',$data['dis_data']['dis_data'][0]['expected_del_date'],$message);
	    
	   // echo $message;
	    //Check that the PDF was created before we send it
	    if($path = $this->html2pdf->create('save')) {
	    	
			$this->load->library('email');

			$this->email->from('rahulgenius999@gmail.com', 'Mercure Pharmaceuticals Pvt. Ltd.');
			$this->email->to($party_email); 
			$this->email->set_mailtype('html'); 
			
			$this->email->subject('Mercure Invoice');
			$this->email->message($message);	

			$this->email->attach($path);

			$response = $this->email->send();
		    if($response){
		        $details_sent_mail_time = date('Y-m-d H:i:sa');
		        $check_type = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type);
		        
		        if($check_type['flag']==0){
		              $create_data= array(
		                'details_type'=>$Type,
		                'details_voucher'=>$Voucher,
		                'details_Date' => $Date,
		                'details_sent_mail_time'=>$details_sent_mail_time,
		                'details_sent_count'=>1,
		                'details_failed_count'=>0
		            );
		            $last_insert_id = $this->Dispatch_model->create_detail_type($create_data);
		            if($last_insert_id ){
		                $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		            $data['flag'] =1 ;
    		            echo json_encode($data);
		                
		            }else{
		                $data['flag']=0;
		                echo json_encode($data);
		            }
		            
		        }
		        else{
		            $details_sent_count = $check_type['details'][0]['details_sent_count'];
		            $details_failed_count = $check_type['details'][0]['details_failed_count'];
		            $details_sent_count++;
		            $update_data = array(
    		                'details_sent_mail_time'=>$details_sent_mail_time,
    		                'details_sent_count'=>$details_sent_count
    		            );
    		        $check_update = $this->db->update('Details_Update',$update_data,array('details_type'=>$Type,'details_voucher'=>$Voucher,'details_Date' => $Date));
    		        if($check_update){
    		             $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		              $data['flag'] =1 ;
    		             echo json_encode($data);
    		        }
		        }
		        
		    }
		    else{
		        //$details_sent_mail_time = date('Y-m-d H:i:sa');
		        $check_type = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type);
		        if($check_type['flag']==0){
		            $create_data= array(
		                'details_type'=>$Type,
		                'details_voucher'=>$Voucher,
		                'details_Date' => $Date,
		                'details_sent_mail_time'=>NULL,
		                'details_sent_count'=>0,
		                'details_failed_count'=>1
		            );
		            $last_insert_id = $this->Dispatch_model->create_detail_type($create_data);
		            if($last_insert_id ){
		                $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		            $data['flag'] =1 ;
    		            echo json_encode($data);
		                
		            }
		            else{
		                $data['flag']=0;
		                echo json_encode($data);
		            }
		        }
		        else{
		            //$details_sent_count = $check_type['details'][0]['details_sent_count'];
		            $details_failed_count = $check_type['details'][0]['details_failed_count'];
		            $details_failed_count++;
		           $update_data = array(
    		                
    		                'details_failed_count'=>$details_failed_count
    		            );
    		        $check_update = $this->db->update('Details_Update',$update_data,array('details_type'=>$Type,'details_voucher'=>$Voucher,'details_Date' => $Date));
    		        if($check_update){
    		             $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		              $data['flag'] =1 ;
    		             echo json_encode($data);
    		        }
		        }
		    }
			

	    }
			
	
	    
    }
    public function mail_pdf_lr($Voucher,$Date,$Type)
    {
		//Load the library
	    $this->load->library('html2pdf');
	    
	    $this->html2pdf->folder('./assets/pdfs/');
	    $this->html2pdf->filename('Invoice.pdf');
	    $this->html2pdf->paper('a4', 'portrait');
	    $data['dis_data']=$this->Dispatch_model->get_details_by_voucher($Voucher,$Date);
	    $this->html2pdf->html($this->load->view('dis_invoice_pdf',$data, true));
	    $party_email =$data['dis_data']['dis_data'][0]['email'];
	   
	    $message = $this->load->view('message_lr', '', TRUE);
	    $message = str_replace('{{lr_number}}',$data['dis_data']['dis_data'][0]['lr_number'],$message);
	  
	    
	   // echo $message;
	    //Check that the PDF was created before we send it
	    if($path = $this->html2pdf->create('save')) {
	        $lr_image_copy = $data['dis_data']['dis_data'][0]['lr_image_copy'];
	    	
			$this->load->library('email');

			$this->email->from('rahulgenius999@gmail.com', 'Mercure Pharmaceuticals Pvt. Ltd.');
			$this->email->to($party_email); 
			$this->email->set_mailtype('html'); 
			
			$this->email->subject('Mercure Invoice');
			$this->email->message($message);	

			$this->email->attach($path);
			$this->email->attach($lr_image_copy);

			$response = $this->email->send();
			if($response){
		        $details_sent_mail_time = date('Y-m-d H:i:sa');
		        $check_type = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type);
		        
		        if($check_type['flag']==0){
		              $create_data= array(
		                'details_type'=>$Type,
		                'details_voucher'=>$Voucher,
		                'details_Date' => $Date,
		                'details_sent_mail_time'=>$details_sent_mail_time,
		                'details_sent_count'=>1,
		                'details_failed_count'=>0
		            );
		            $last_insert_id = $this->Dispatch_model->create_detail_type($create_data);
		            if($last_insert_id ){
		                $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		            $data['flag'] =1 ;
    		            echo json_encode($data);
		                
		            }else{
		                $data['flag']=0;
		                echo json_encode($data);
		            }
		            
		        }
		        else{
		            $details_sent_count = $check_type['details'][0]['details_sent_count'];
		            $details_failed_count = $check_type['details'][0]['details_failed_count'];
		            $details_sent_count++;
		           $update_data = array(
    		                'details_sent_mail_time'=>$details_sent_mail_time,
    		                'details_sent_count'=>$details_sent_count
    		            );
    		        $check_update = $this->db->update('Details_Update',$update_data,array('details_type'=>$Type,'details_voucher'=>$Voucher,'details_Date' => $Date));
    		        if($check_update){
    		             $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		              $data['flag'] =1 ;
    		             echo json_encode($data);
    		        }
		        }
		        
		    }
		    else{
		        //$details_sent_mail_time = date('Y-m-d H:i:sa');
		        $check_type = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type);
		        if($check_type['flag']==0){
		            $create_data= array(
		                'details_type'=>$Type,
		                'details_voucher'=>$Voucher,
		                'details_Date' => $Date,
		                'details_sent_mail_time'=>NULL,
		                'details_sent_count'=>0,
		                'details_failed_count'=>1
		            );
		            $last_insert_id = $this->Dispatch_model->create_detail_type($create_data);
		            if($last_insert_id ){
		                $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		            $data['flag'] =1 ;
    		            echo json_encode($data);
		                
		            }
		            else{
		                $data['flag']=0;
		                echo json_encode($data);
		            }
		        }
		        else{
		            $details_sent_count = $check_type['details'][0]['details_sent_count'];
		            $details_failed_count = $check_type['details'][0]['details_failed_count'];
		            $details_failed_count++;
		           $update_data = array(
    		                'details_sent_mail_time'=>$details_sent_mail_time,
    		                'details_failed_count'=>$details_failed_count
    		            );
    		        $check_update = $this->db->update('Details_Update',$update_data,array('details_type'=>$Type,'details_voucher'=>$Voucher,'details_Date' => $Date));
    		        if($check_update){
    		             $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		              $data['flag'] =1 ;
    		             echo json_encode($data);
    		        }
		        }
		    }
			
	    }
			
	
	    
    }
    public function mail_final_pdf($Voucher,$Date,$Type)
    {
		//Load the library
	    $this->load->library('html2pdf');
	    
	    $this->html2pdf->folder('./assets/pdfs/');
	    $this->html2pdf->filename('Invoice.pdf');
	    $this->html2pdf->paper('a4', 'portrait');
	    
	   $data['dis_data']=$this->Dispatch_model->get_details_by_voucher($Voucher,$Date);
	   $this->html2pdf->html($this->load->view('dis_invoice_pdf',$data, true));
	    
	    
	    $party_email =$data['dis_data']['dis_data'][0]['email'];
	   
	    $message = $this->load->view('message_final', '', TRUE);
	    $message = str_replace('{{voucher}}',$data['dis_data']['dis_data'][0]['Voucher'],$message);
	    $message = str_replace('{{dispatchdate}}',$data['dis_data']['dis_data'][0]['date_of_dispatch'],$message);
	    $message = str_replace('{{lr}}',$data['dis_data']['dis_data'][0]['lr_number'],$message);
	    $message = str_replace('{{transporter}}',$data['dis_data']['dis_data'][0]['transport_dis'],$message);
	    $message = str_replace('{{transporter_no}}',$data['dis_data']['dis_data'][0]['transporter_contact'],$message);
	    $message = str_replace('{{exp_del_date}}',$data['dis_data']['dis_data'][0]['expected_del_date'],$message);
	    
	   // echo $message;
	    //Check that the PDF was created before we send it
	    if($path = $this->html2pdf->create('save')) {
	        
			$this->load->library('email');

			$this->email->from('rahulgenius999@gmail.com', 'Mercure Pharmaceuticals Pvt. Ltd.');
			$this->email->to($party_email); 
			$this->email->set_mailtype('html'); 
			
			$this->email->subject('Mercure Invoice');
			$this->email->message($message);	

			$this->email->attach($path);
		    $response = $this->email->send();
		    if($response){
		        $details_sent_mail_time = date('Y-m-d H:i:sa');
		        $check_type = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type);
		        
		        if($check_type['flag']==0){
		              $create_data= array(
		                'details_type'=>$Type,
		                'details_voucher'=>$Voucher,
		                'details_Date' => $Date,
		                'details_sent_mail_time'=>$details_sent_mail_time,
		                'details_sent_count'=>1,
		                'details_failed_count'=>0
		            );
		            $last_insert_id = $this->Dispatch_model->create_detail_type($create_data);
		            if($last_insert_id ){
		                $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		            $data['flag'] =1 ;
    		            echo json_encode($data);
		                
		            }else{
		                $data['flag']=0;
		                echo json_encode($data);
		            }
		            
		        }
		        else{
		            $details_sent_count = $check_type['details'][0]['details_sent_count'];
		            $details_failed_count = $check_type['details'][0]['details_failed_count'];
		            $details_sent_count++;
		           $update_data = array(
    		                'details_sent_mail_time'=>$details_sent_mail_time,
    		                'details_sent_count'=>$details_sent_count
    		            );
    		        $check_update = $this->db->update('Details_Update',$update_data,array('details_type'=>$Type,'details_voucher'=>$Voucher,'details_Date' => $Date));
    		        if($check_update){
    		             $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		              $data['flag'] =1 ;
    		             echo json_encode($data);
    		        }
		        }
		        
		    }
		    else{
		        //$details_sent_mail_time = date('Y-m-d H:i:sa');
		        $check_type = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type);
		        if($check_type['flag']==0){
		            $create_data= array(
		                'details_type'=>$Type,
		                'details_voucher'=>$Voucher,
		                'details_Date' => $Date,
		                'details_sent_mail_time'=>NULL,
		                'details_sent_count'=>0,
		                'details_failed_count'=>1
		            );
		            $last_insert_id = $this->Dispatch_model->create_detail_type($create_data);
		            if($last_insert_id ){
		                $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		            $data['flag'] =1 ;
    		            echo json_encode($data);
		                
		            }
		            else{
		                $data['flag']=0;
		                echo json_encode($data);
		            }
		        }
		        else{
		            $details_sent_count = $check_type['details'][0]['details_sent_count'];
		            $details_failed_count = $check_type['details'][0]['details_failed_count'];
		            $details_failed_count++;
		           $update_data = array(
    		                'details_sent_mail_time'=>$details_sent_mail_time,
    		                'details_failed_count'=>$details_failed_count
    		            );
    		        $check_update = $this->db->update('Details_Update',$update_data,array('details_type'=>$Type,'details_voucher'=>$Voucher,'details_Date' => $Date));
    		        if($check_update){
    		             $data['details'] = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, $Type); 
    		              $data['flag'] =1 ;
    		             echo json_encode($data);
    		        }
		        }
		    }
			
			
	    }
			
	
	    
    }

}
?>