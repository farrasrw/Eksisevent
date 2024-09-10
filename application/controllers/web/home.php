<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); 
class Home extends MY_ThemeController {
	
	function __construct(){
		parent::__construct();
		$this->load->library('underscore');
        $this->load->model('MBanner','MBanner');
        $this->load->model('MAbout','MAbout');
        
        $this->load->model('MdaftarJasa','MDaftarJasa');
        $this->load->model('MMember','MMember');
        
        $this->rand = random_string('numeric', 4);
        
        $this->tempHome();        
    }
    
    
    function index(){
        
        //Banner Home
		$arrOrder = array("banner_id" => "ASC");
		$arrWhere = array("banner_status" => 0, "banner_schedule <=" => date("Y-m-d H:i:s"),"banner_scheduleoff >" => date("Y-m-d H:i:s"));
		$objDataBanner = $this->MBanner->getListBanner($arrOrder, $arrWhere);
        
		$arrData['banner'] = array_values(array_filter($objDataBanner, function($v) { return $v->banner_pos == 'home-banner-atas'; }));
        $arrData['bannercontent'] = array_values(array_filter($objDataBanner, function($v) { return $v->banner_pos == 'home-banner-bawah'; }));
        
        
        $daftarjasaId=2;
        $objdaftarjasa = $this->MDaftarJasa->getListDaftarJasa(array(),array('idjasa'=>(int)$daftarjasaId));
        
        $arrData['daftarjasa'] =(count($objdaftarjasa)>0?$objdaftarjasa[0]:array());
        
        // Captcha configuration
        $config = array(
            'word'   => $this->rand,
            'img_path'      => 'captcha/',
            'img_url'       => base_url().'captcha/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 24
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        
        $objClient=$this->MMember->getListMember(array(),array());
        
        $arrData['client']=$objClient;

        // Pass captcha image to view
        $arrData['captchaImg'] = $captcha['image'];
        
        //echo '<pre>';print_r($arrData);echo '</pre>';die();
                
        $this->load->view('web/home', $arrData);
    }
    
    function sendMessage(){
        
        $this->load->model('Mmessage', 'MMessage');
				
		$nama = $this->input->post('txtNama');
		$email = $this->input->post('txtEmail');
		$pesan = $this->input->post('txtPesan');
        
		$key   = $this->fcommerce->decode($this->input->post('keyemail'));
		$this->form_validation->set_rules('txtNama', 'Nama', 'required');
		$this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('txtPesan', 'Pesan', 'required');

		if ($this->form_validation->run() == FALSE){
			
			$arrRes = array(
					'valid'=>false,
					'message'=>'Maaf silahkan cek form inputan anda'
				);
			echo json_encode($arrRes);die();
			
		}else{
            
            if ($this->input->post('secutity_code') == $this->session->userdata('captchaCode')) {
			
                // add Member
                $arrData=array('nama' => $nama,'email' => $email, 'pesan' => $pesan); 
                $this->MMessage->addMessage($arrData);


                $arrRes = array(
                    'valid'=>true,
                    'message'=>'Terimakasih, pesan anda berhasil di simpan',
                    'redirect'=>base_url()
                );
                echo json_encode($arrRes);die();
            }else{
                $arrRes = array(
                        'valid'=>false,
                        'message'=>' Maaf captcha salah, silahkan cek captcha yang anda inputkan'
                    );
                echo json_encode($arrRes);die();
            }
				
		}    
        
    }
    
    public function jobs(){
        
        $objAbout=$this->MAbout->getListAbout(array('about_type' => 'DESC'),array('about_type' => 0),1,0);
        
        if(count($objAbout)>0){
            
            $arrData['data']=$objAbout;
            $this->load->view('web/jobs', $arrData);
        }else{
            redirect(base_url());
        }
	}
    
    public function workwithus(){
        
        $objAbout=$this->MAbout->getListAbout(array('about_type' => 'DESC'),array('about_type' => 1),1,0);
        
        if(count($objAbout)>0){
            
            $arrData['data']=$objAbout;
            $this->load->view('web/workwithus', $arrData);
        }else{
            redirect(base_url());
        }
	}
    
    public function ceffira(){
        $this->tempCeffira();
        
        $this->load->view('web/ceffira/home');
    }
    
    public function ceffiraDetail(){
        $this->tempCeffira();
        
        $this->load->view('web/ceffira/detail');
    }
    
        
    public function directory(){
        
        $objAbout=$this->MAbout->getListAbout(array('about_type' => 'DESC'),array('about_type' => 3),1,0);
        
        if(count($objAbout)>0){
            
            $arrData['data']=$objAbout;
            $this->load->view('web/jobs', $arrData);
        }else{
            redirect(base_url());
        }
	}
    
    public function refresh_captcha(){
        // Captcha configuration
        $config = array(
            'word'   => $this->rand,
            'img_path'      => 'captcha/',
            'img_url'       => base_url().'captcha/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 24
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
        die();
    }
    
//    public function aboutus(){
//        
//        $objAbout=$this->MAbout->getListAbout(array('about_type' => 'DESC'),array('about_type' => 0),1,0);
//        
//        if(count($objAbout)>0){
//            
//            $arrData['data']=$objAbout;
//            $this->load->view('web/jobs', $arrData);
//        }else{
//            redirect(base_url());
//        }
//	}
//    
//    public function contactus(){
//        
//        $objAbout=$this->MAbout->getListAbout(array('about_type' => 'DESC'),array('about_type' => 1),1,0);
//        
//        if(count($objAbout)>0){
//            
//            $arrData['data']=$objAbout;
//            $this->load->view('web/jobs', $arrData);
//        }else{
//            redirect(base_url());
//        }
//	}
    
    public function contactus(){
        $this->load->view('web/hubungi-kami');
    }
    
    public function aboutus(){
        $this->load->view('web/tentang-kami');
    }
    
    public function portfolio(){
        $this->load->view('web/portfolio');
    }
}