<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LoginValidation
{
	var $CI;
	
	function __construct(){
		$this->CI =& get_instance();
		
		//Load Library
		$this->CI->load->library('fcommerce');
	}
	
	public function isMemberLogin(){
        
        $isMemberLogin = $this->CI->session->userdata('isMemberLogin');
        $strMemberId   = $this->CI->session->userdata('MemberId');
        $orderKey      = $this->CI->session->userdata('MemberId');
        
        if($isMemberLogin && !empty($strMemberId)){
            
            $arrData['valid']			= true;
            $arrData['MemberId']		= $strMemberId;
            $arrData['NamaDepan']		= $this->CI->session->userdata('MemberNamaDepan');
            $arrData['NamaBelakang']	= $this->CI->session->userdata('MemberNamaBelakang');
            $arrData['Email']	        = $this->CI->session->userdata('MemberEmail');
            $arrData['OrderKey']	    = $this->CI->session->userdata('OrderKey');
            
        }else{
            
            $arrData['valid']			= false;
            $arrData['MemberId']		= '0';
            $arrData['NamaDepan']		= '';
            $arrData['NamaBelakang']	= '';
            $arrData['Email']			= '';
            $arrData['OrderKey']        = 0 ;
            
        }
		
        return $arrData;
    }
}