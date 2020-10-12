<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paytm extends CI_Controller {
function __construct(){
  parent::__construct();
  //$this->load->database();
  //$this->epfts = $this->load->database('konnectin', TRUE);
    // $this->load->model('Login_model');
     //$this->load->model('Admin_model');
     //$this->load->model('Survey_model');
      
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
	function paytm()
    {
      $this->load->view('TxnTest');
    }


    
    function paytmpost()
    {
        
        $reqd_responses =  $this->input->post('end_response');
		
		 $sur_id =  $this->input->post('s_id');
	   
            //$UpdateSurveyDetails = array(
               //     'sur_end_responses'=>$reqd_responses,
			   //   'sur_status'=>"Admin Approval Pending",
			  //    'sur_payment_status'=>"Paid",
			  //    'sur_contribution_type'=>"Monetary Contribution",
			// );
            //$this->db->update('survey_details',$UpdateSurveyDetails,array('sur_unique_id'=>$sur_id));
            
     header("Pragma: no-cache");
     header("Cache-Control: no-cache");
     header("Expires: 0");
    
     // following files need to be included
     require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
     require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");
    
     $checkSum = "";
     $paramList = array();
    
     $ORDER_ID = $_POST["ORDER_ID"];
     $CUST_ID = $_POST["CUST_ID"];
     $INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
     $CHANNEL_ID = $_POST["CHANNEL_ID"];
     $TXN_AMOUNT = $_POST["TXN_AMOUNT"];
     $CALLBACK_URL = $_POST["CALLBACK_URL"];
     $sur_id = $_POST["sur_id"];
        
        $txnData = array(
    		    
    		          'order_id'=>$ORDER_ID,
                      'customer_id'=>$CUST_ID,
                      'industry_type'=>$INDUSTRY_TYPE_ID,
                      'channel_id'=>$CHANNEL_ID,
                      'txn_amount'=>$TXN_AMOUNT,
                      'callback_url'=>$CALLBACK_URL,
                      'sur_id'=>$sur_id,
                      'user_id'=>$_SESSION['user_id'],
                      'business_id'=>$_SESSION['b_id'],
                      );
                    	
                    	//print_r($surveydata);
                    	//die();
                    	
        $this->db->insert('pre_transaction_details',$txnData);
        
    // Create an array having all required parameters for creating checksum.
     $paramList["MID"] = PAYTM_MERCHANT_MID;
     $paramList["ORDER_ID"] = $ORDER_ID;
     $paramList["CUST_ID"] = $CUST_ID;
     $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
     $paramList["CALLBACK_URL"] = $CALLBACK_URL;
     $paramList["CHANNEL_ID"] = $CHANNEL_ID;
     $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
     //$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
     //$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
     //$paramList["EMAIL"] = $EMAIL; //Email ID of customer
     //$paramList["VERIFIED_BY"] = "EMAIL"; //
     //$paramList["IS_USER_VERIFIED"] = "YES"; //
    
    
    //Here checksum string will return by getChecksumFromArray() function.
     $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
     echo "<html>
    <head>
    <title>Merchant Check Out Page</title>
    </head>
    <body>
        <center><h1>Please do not refresh this page...</h1></center>
            <form method='post' action='".PAYTM_TXN_URL."' name='f1'>
    <table border='1'>
     <tbody>";
    
     foreach($paramList as $name => $value) {
     echo '<input type="hidden" name="' . $name .'" value="' . $value .         '">';
     }
    
     echo "<input type='hidden' name='CHECKSUMHASH' value='". $checkSum . "'>
     </tbody>
    </table>
    <script type='text/javascript'>
     document.f1.submit();
    </script>
    </form>
    </body>
    </html>";
     } 
 
 
     function response()
    {
        header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");
    
    // following files need to be included
    require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
    require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");
    
    $paytmChecksum = "";
    $paramList = array();
    $isValidChecksum = "FALSE";
    
    $paramList = $_POST;
    $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
    
    //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
    $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
    
    
    if($isValidChecksum == "TRUE") {
    
    
    	
                
              	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
    	if ($_POST["STATUS"] == "TXN_SUCCESS") {
    	    
    	    if (isset($_POST) && count($_POST)>0 )
    	{ 
    		//foreach($_POST as $paramName => $paramValue) {
    
    		         $order_id = $_POST['ORDERID'];
    		         $merchant_id = $_POST['MID'];
    		         $transaction_id = $_POST['TXNID'];
    		         $transaction_amount = $_POST['TXNAMOUNT'];
    		         $currency = $_POST['CURRENCY'];
    		         $transaction_date = $_POST['TXNDATE'];
    		         $status = $_POST['STATUS'];
    		         $response_code = $_POST['RESPCODE'];
    		         $response_message = $_POST['RESPMSG'];
    		         $bank_transaction_id = $_POST['BANKTXNID'];
    		         $checksum = $_POST['CHECKSUMHASH'];
    				//echo "<br/>" . $paramName . " = " . $paramValue;
    		//}
    	}
    	
        $transactionData = array(
    			      
    	             'paytm_order_id'=>$order_id,
    	             'paytm_merchant_id'=>$merchant_id,
    	             'paytm_transaction_id'=>$transaction_id,
    	             'paytm_transaction_amount'=>$transaction_amount,
    	             'paytm_currency'=>$currency,
    	             'paytm_transaction_date'=>$transaction_date,
    	             'paytm_status'=>$status,
    	             'paytm_response_code'=>$response_code,
    	             'paytm_response_message'=>$response_message,
    	             'paytm_bank_transaction_id'=>$bank_transaction_id,
    	             'paytm_checksum'=>$checksum,
    	             'user_id'=>$_SESSION['user_id'],
    	             'business_id'=>$_SESSION['user_id']
    	             
    			 );
                 
                $this->db->insert('paytm_transactions',$transactionData);
                
                
    		//echo "<b>Transaction status is success</b>" . "<br/>";
    		//Process your transaction here as success transaction.
    		//Verify amount & order id received from Payment gateway with your application's order id and amount.
    		$data['response_order_Data']=$this->Survey_model->response_order_details($order_id);
        //print_r($data['SurveyDetailsData']);
        $sur_id = $data['response_order_Data']['response_order_Data'][0]['sur_id'];
        
        $UpdateSurveyList2 = array(
			      'sur_payment_status'=>"Paid",
			      'sur_status'=>"Admin Approval Pending",
			      'sur_contribution_type'=>"Monetary Contribution",
			 );
            $this->db->update('survey_details',$UpdateSurveyList2,array('sur_unique_id'=>$sur_id));
            
    		redirect('Survey/add_questionnaire/'.$sur_id);
    	}
    	else {
    	    
    	    if (isset($_POST) && count($_POST)>0 )
    	{ 
    		//foreach($_POST as $paramName => $paramValue) {
    
    		         $order_id = $_POST['ORDERID'];
    		         $merchant_id = $_POST['MID'];
    		         $transaction_id = $_POST['TXNID'];
    		         $transaction_amount = $_POST['TXNAMOUNT'];
    		         $currency = $_POST['CURRENCY'];
    		         $status = $_POST['STATUS'];
    		         $response_code = $_POST['RESPCODE'];
    		         $response_message = $_POST['RESPMSG'];
    		         $bank_transaction_id = $_POST['BANKTXNID'];
    		         $checksum = $_POST['CHECKSUMHASH'];
    				//echo "<br/>" . $paramName . " = " . $paramValue;
    		//}
    	}
    	
        $transactionData = array(
    			      
    	             'paytm_order_id'=>$order_id,
    	             'paytm_merchant_id'=>$merchant_id,
    	             'paytm_transaction_id'=>$transaction_id,
    	             'paytm_transaction_amount'=>$transaction_amount,
    	             'paytm_currency'=>$currency,
    	             'paytm_status'=>$status,
    	             'paytm_response_code'=>$response_code,
    	             'paytm_response_message'=>$response_message,
    	             'paytm_bank_transaction_id'=>$bank_transaction_id,
    	             'paytm_checksum'=>$checksum,
    	             'user_id'=>$_SESSION['user_id'],
    	             'business_id'=>$_SESSION['user_id']
    	             
    			 );
                 
                $this->db->insert('paytm_transactions',$transactionData);
    		//echo "<b>Transaction status is failure</b>" . "<br/>";
    		redirect('Survey/home');
    	}  
    }
    else {
    	echo "<b>Checksum mismatched.</b>";
    	//Process transaction as suspicious.
    }
      //$this->load->view('pgResponse');
    }
    
    

}
