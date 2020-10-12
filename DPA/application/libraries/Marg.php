<?php 
/*

1. https://wservices.margcompusoft.com/api/eOnlineData/InsertOrderDetail
{ "OrderID":"", "OrderNo" => "", "CustomerID" => "", "MargID" => "", "Type" => "", "Sid" => "", "ProductCode" => "", "Quantity" => "", "Free" => "", "Lat" => "", "Lng" => "", "Address" => "", "GpsID" => "", "UserType" => "", "Points" => "", "Discounts" => "", "Transport" => "", "Delivery" => "", "Bankname" => "", "BankAdd1" => "", "BankAdd2" => "", "shipname" => "", "shipAdd1" => "", "shipAdd2" => "", "shipAdd3" => "", "paymentmode" => "", "paymentmodeAmount" => "", "payment_remarks" => "", "order_remarks" => "", "CustMobile" => "", "CompanyCode" => "", "OrderFrom" => "" }

2. https://wservices.margcompusoft.com/api/eOnlineData/InventoryVoucherGet2017
{ "CompanyCode" => "", "MargID" => "", "Type" => "", "FrmDatetime" => "", "ToDatetime" => "", "index" => "" }

3. https://wservices.margcompusoft.com/api/eOnlineData/MargMstBillsLive2017\
{ "CompanyCode" => "", "MargID" => "", "Datetime" => "", "index" => "" } 
*/


	function decrypt($key,$encrypted)
	{
		$mcrypt_cipher = @MCRYPT_RIJNDAEL_128;
		$mcrypt_mode = @MCRYPT_MODE_CBC;
		$iv=$key . "\0\0\0\0";
		$key=$key . "\0\0\0\0";
					
		$encrypted = base64_decode($encrypted);		
		$decrypted = rtrim(@mcrypt_decrypt($mcrypt_cipher, $key, $encrypted, $mcrypt_mode, $iv), "\0");
		if($decrypted != '')
		{
			$dec_s2 = strlen($decrypted);
			$padding = ord($decrypted[$dec_s2-1]);
			$decrypted = substr($decrypted, 0, -$padding);
		}
		return $decrypted;
	}
//$key = 'EGNUI4A3U1AK';
$key = 'JPLIQH6UMTP1';

//$ch = curl_init( "https://wservices.margcompusoft.com/api/eOnlineData/MargMST2017");
//$payload = json_encode( array("CompanyCode" => "MEDLV","MargID" => 10416,"Datetime" => "", "index" => 0));

//$ch = curl_init( "https://wservices.margcompusoft.com/api/eOnlineData/LiveOrderDispatchStatus2017");
//$payload = json_encode( array("CompanyCode" => "MEDLV",	"MargID" => 10416, "SalesmanID" => "A", "Type" => "S", "Datetime" => "", "index" => 0));

$ch = curl_init( "https://wservices.margcompusoft.com/api/eOnlineData/InsertOrderDetail" );
$payload = json_encode( array( "OrderID" => "12345679", "OrderNo" => "0", "CustomerID" => "60296906", "MargID" => "10416", "Type" => "S", "Sid" => "51780", "ProductCode" => "1176793", "Quantity" => "5", "Free" => "1", "Lat" => "17.4398539", "Lng" => "78.3898997", "Address" => "Madhapur Police Station", "GpsID" => "0", "UserType" => "1", "Points" => "0.00", "Discounts" => "0.00", "Transport" => "", "Delivery" => "Amazon", "Bankname" => "HDFC Bank", "BankAdd1" => "HDFC Bank, Madhapur", "BankAdd2" => "", "shipname" => "Blue Dart", "shipAdd1" => "Madhapur", "shipAdd2" => "", "shipAdd3" => "", "paymentmode" => "PayTM", "paymentmodeAmount" => "1000", "payment_remarks" => "", "order_remarks" => "", "CustMobile" => "", "CompanyCode" => "MEDLV", "OrderFrom" => "MEDLV" ));


curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo "Curl Response ";   
  //echo '<br>';
  //print_r($response);
  //echo $response;
  //echo '<br><br>';
  //exit;
}
//echo "Decrypted Data ";   
//echo '<br>';
$result = decrypt($key,$response);

//echo $result;echo '<br>';echo '<br>';//exit;
$data =  gzinflate(base64_decode($result));
 if ($data === false) 
    echo 'error'; 
  else 
    	//echo "Decompressed Data ";   
	//echo '<br>';
	echo $data."\n";
//echo '<br>';
?>