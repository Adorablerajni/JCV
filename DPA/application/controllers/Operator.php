<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('memory_limit','128M');
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller 
{
   public function index()
   {
       try {
           $this->load->library('myoperator');
           $this->load->helper('date');  
           $key = 'IW0GRBDSS6GU';
           $response = $this->myoperator->run();
            if ($response)
           {
                $result = $this->decrypt($key, $response);
                
                $data = gzinflate(base64_decode($result));
                
                if ($data === false)      
                {     
                    echo "Data Error";    
                }     
                else
                {
                    $data1= json_decode(trim($data,'﻿'));   
                    $Details =  $data1->Details;
                    echo count($Details->Dis);
                    if (count($Details->Dis) >= 1) {
                        $this->db->insert_batch('data_dis',$Details->Dis);
                    }
                    // echo "<pre>";
                    // print_r($Details);
                    // print_r($Details->MDis);
                    // print_r(count($Details->MDis) .'   MDis');
                    // print_r($Details->Dis);
                    // print_r(count($Details->Dis) .'      Dis');
                    // print_r($Details->AcBal);
                    // print_r(count($Details->AcBal) .'    AcBal');
                    // print_r($Details->Account);
                    // print_r(count($Details->Account) .'   Account');
                    // print_r($Details->ACGroup);
                    // print_r(count($Details->ACGroup) .'    ACGroup');
                    // print_r($Details->Masters);
                    /*print_r(count($Details->Masters) .'Masters');
                    print_r($Details->MComp);
                    print_r(count($Details->MComp) .'MComp');
                    print_r($Details->Outstanding);
                    print_r(count($Details->Outstanding) .'Outstanding');
                    print_r($Details->Party);
                    print_r(count($Details->Party) .'Party');
                    print_r($Details->PBal);
                    print_r(count($Details->PBal) .'PBal');
                    print_r($Details->Product);
                    print_r(count($Details->Product) .'Product');
                    print_r($Details->SaleType);
                    print_r(count($Details->SaleType) .'SaleType');
                    print_r($Details->Stock);
                    print_r(count($Details->Stock) .'Stock');*/
                    echo "</pre>";
                    // print_r($Details->Dis);
                    // print_r($Details->Masters);
                    // print_r($Details->MComp);
                    // print_r($Details->MDis);
                    // print_r($Details->PBal);
                    // print_r($Details->Product);
                    // print_r($Details->SaleType);
                    // print_r($Details->Stock);
                    
                   //  $myfile = fopen("data.json", "w") or die("Unable to open file!");                    
                   //  fputcsv($myfile, $Details);
                   // fclose($myfile);
                    // $this->db->insert_batch('data_mdis',$Details->MDis);
                    // $this->db->insert_batch('data_dis',$Details->Dis);
                    // $this->db->insert_batch('data_acbal',$Details->AcBal);
                    // $this->db->insert_batch('data_account',$Details->Account);
                    // $this->db->insert_batch('data_acgroup',$Details->ACGroup);
                    //$this->db->insert_batch('data_masters',$Details->Masters);
                    //$this->db->insert_batch('data_mcomp',$Details->MComp);
                    // $this->db->insert_batch('data_outstanding',$Details->Outstanding);
                    // $this->db->insert_batch('data_party',$Details->Party);
                    // $this->db->insert_batch('data_pbal',$Details->PBal);
                    // $this->db->insert_batch('data_product',$Details->Product);
                    // $this->db->insert_batch('data_saletype',$Details->SaleType);
                    // $this->db->insert_batch('data_stock',$Details->Stock);
               
                  
                } 
           }

       } catch (Exception $e) {
           var_dump($e->getMessage());
       }
   }
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
  
   
   
  
}

?>