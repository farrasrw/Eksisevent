<?php
class MY_ThemeController extends CI_Controller {
    
    public $arrTagRoute;
    
	function __construct()
    {        
        parent::__construct();
    }
    
    function tempAdmin(){
		if ($this->session->userdata('isLogin') && $this->session->userdata('isLogin') ){
			
            $strAdminId = $this->session->userdata('UserId');
			
            //cek vlid amin 
            $this->load->model('madmin', 'MAdmin');
            $objAdmin= $this->MAdmin->getListAdmin(array(),array('AdminId'=> $strAdminId, 'AdminSts' => 1));
            if(count($objAdmin)>0){
                
                $arrData = array(
                    'header' => $this->session->userdata('Email'),
                    'nama' => $this->session->userdata('AdminName'),
                    'groupid' => $this->session->userdata('AdminGroupId'),
                    'data' =>array(
                        'UserId'	   => $this->session->userdata('UserId'),
                        'UserInitial'  =>$this->session->userdata('AdminName'),
                        'UserFullName' =>$this->session->userdata('AdminName'),
                        'Email'		   =>$this->session->userdata('Email'),
                        'AdminGroupId' =>$this->session->userdata('AdminGroupId'),
                        'GroupLevel'   =>$this->session->userdata('AdminGroupId'),
                    )
                );

                $this->userData =  $arrData['data'];
                //echo var_dump($this->userData );die();
                $this->output->set_template('admin', $arrData);  
            }else{
                redirect('dashboard');
            }   
		}
        else{
			redirect('dashboard');
		}
	}
    
    
    function tempHome(){
        
        $this->load->library('loginvalidation');
        
        $this->load->model('Mproject','MProject');
        
        $arrData = array();
        $arrData['MemberLogin'] = $this->loginvalidation->isMemberLogin();
		$arrData['isGuestOrder'] = (int)$this->session->userdata('isGuestOrder');
        $arrData['isReferralCode']= $this->session->userdata('isReferralCode');
        $arrData['isReferralBy']= $this->session->userdata('isReferralBy');
        
        $objproject = $this->MProject->getListproject(array(),array());
        
        $arrData['package']=$objproject;
                
        $this->output->set_template('temp_eksisevent',$arrData);
    }
    
    function tempCeffira(){
        $this->output->set_template('tempceffira');
    }
	
}