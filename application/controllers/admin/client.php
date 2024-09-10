<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_ThemeController {
	
    public $TempImagePath;
	public $permission = array();
	function __construct(){
		
		parent::__construct();
		
		
		/* 	Set Private Method	*/
		$this->privateMethod = array(
			'index',
			'viewclient',
			'addclient',
			'saveedituser',
			'saveeditclient',
			'saveaddclient',
			'listuserdata',
			'deleteheadline',
			'addheadline',
			'changeorder',
			'headline',
			'approveclient',
		);
		
		/* Permission Admin Check */
		//$this->permission = $this->PermissionAdmin();
		$this->tempAdmin();
		$this->load->model('MMember','MMember');
		
		$this->TempImagePath='client/Temp/';
		
	}
	
	public function index(){
		
		$this->load->view('admin/client/list_client');		
		
	}
	
	public function uploadimage(){
		
		$this->output->unset_template();
        $key = $this->input->post('uploadkey');		
        $typeupload = $this->input->post('uploadtype');	
		
		if(!empty($key)){
		
			
			$strImagePath = 'client/Temp/'.$key.'/';
			
			if($typeupload=="contentimage") $strImagePath = 'user/'.$this->userData['UserInitial'].'/upload/';
			
			
			$arrResult = $this->imageloader->UploadImage($strImagePath,"fileimg",$key.$_FILES['fileimg']['name']);

			//Check Upload
			if (!$arrResult['Valid']){
				$arrData=array(
					'valid'=>false,
					'message'=>$arrResult["Message"]
				);
				echo json_encode($arrData);
			}else{  
				$arrData=array(
					'valid'=>true,
					'filename'=>$arrResult['FileName'],
					'path'=>base_url().$arrResult['FilePath'].$arrResult['FileName'],
					'shortpath'=>$arrResult['FilePath'].$arrResult['FileName']
				);
				echo json_encode($arrData);
			}
		}else{
			
			$arrData=array(
					'valid'=>false,
					'message'=>'Upload Gagal'
				);
				echo json_encode($arrData);
		}
		
		
	}
	
	public function addClient(){
		
		$arrData['hdnkey']= 'tambahclient';
		$arrData['viewstate']= 'add';
		
		$arrData['dropkey'] = $this->ffunction->generateRandomString(10);
		$this->load->view('admin/client/add_client',$arrData);
		
		
	}
	
	public function viewClient(){
		$client_id = $this->ffunction->decode( urlencode($this->input->get('client')) );
		$objBerita = $this->MMember->getListMember(array(),array('memberid'=>(int)$client_id));
		
		if(count($objBerita)==1){
			$arrData['hdnkey']= $objBerita[0]->memberid; 
			$arrData['client'] = $objBerita[0];
			$arrData['dropkey'] = $this->ffunction->generateRandomString(10);
			$this->load->view('admin/client/add_client',$arrData);	
		}
		
	}
	
	public function saveaddclient(){
		
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		$valid 	= true;
		
		if($key=='' || $key!='tambahclient' ) $valid = false;
		$this->_saveclient($valid);
		
	}
	
	public function saveeditclient(){
		
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		$valid 	= true;
		
		if($key=='' || $key=='tambahclient' ) $valid = false;
		$this->_saveclient($valid);
		
	}
	
	function _saveclient($valid=false){
		
		$this->output->unset_template();
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		if($key!= '' && $valid){
			
			$nama 		= $this->ffunction->cleanString($this->input->post('txtNama'));
			$email 		= $this->ffunction->cleanString($this->input->post('txtEmail'));
			$password 		= $this->ffunction->cleanString($this->input->post('txtPassword'));
			$notlp		= $this->ffunction->cleanString($this->input->post('txtNoTlp'));
			$content		= $this->input->post('clientcontent');
            $alamat		= $this->input->post('txtAlamat');
            
			
			
			$dropKey 			= $this->input->post('dropkey');
			$strImageHeader 	=  $this->input->post('imageheader');
			
			$this->form_validation->set_rules('txtNama', 'Name', 'required');
            $this->form_validation->set_rules('txtEmail', 'Email', 'required');
            $this->form_validation->set_rules('txtPassword', 'Password', 'required');
            $this->form_validation->set_rules('txtNoTlp', 'No TLp', 'required');
			$this->form_validation->set_rules('clientcontent', 'Content', 'required');
		

			if ($this->form_validation->run() == FALSE)
			{
				
				$arrRes = array(
					'valid'=>false, 
					'message'=>"Maaf Terjadi Kesalahan, Silahkan Periksa Kembali Inputan Anda", 
				);
				echo json_encode($arrRes);
				
			}else{
				
				$arrData = array(
					'namadepan'=>$nama,
					'email'=>$email,
					'password'=>md5($password), 
					'nohandphone'=>$notlp, 
					'deskripsi'=>$content,
                    'alamat' => $alamat,
				);		
				
				
				
				if($strImageHeader!==''){
					$arrData['member_images']=str_replace($dropKey,'',$strImageHeader);
				}
				
				if($key=='tambahclient'){
					
					//cekberitaURl = 
					$objBerita =$this->MMember->getListMember(array(),array('namadepan'=>$nama));
					if(count($objBerita)==0){
					
						$userd = $this->userData['UserId'].'-'.$this->userData['UserInitial'];
                        
						$this->MMember->addMember($arrData);

						$objBerita =$this->MMember->getListMember(array(),array('namadepan'=>$nama));
						if(count($objBerita)==1){

							$client_id = $objBerita[0]->memberid;
							$bolvalid =true;
							$Message  ="Client Baru Berhasil di Tambah " ; 

						}else{

							$bolvalid =false;
							$Message ="Maaf Terjadi Kesalahan Saat Menambah Client Baru.. ";
						}
						
					}else{
						
						$bolvalid = false ; 
						$Message = "Maaf Client Url Sudah Pernah Di Gunakan ";
						
					}
					
				}else{
					
					$client_id  = (int)$key ; 
					$objBerita =$this->MMember->getListMember(array(),array('memberid'=>$client_id));
					if(count($objBerita)==1){
						
						//unset($arrData['berita_title']);
                        
                        //echo '<pre>';print_r($arrData);echo '</pre>';die();
						
						$this->MMember->editMember($arrData,array('memberid'=>$client_id));
						$bolvalid = true; 
						$Message  = "Client Berhasil di Update";
						
					}else{
						
						$bolvalid = false ; 
						$Message  = "Maaf Client Tidak Valid, Silahkan Muat Ulang Halamana Anda ";
						
					}
					
				}
				
				if($bolvalid){
					
					$arrPhoto=array();
					$strImagePath = 'client/'.$client_id.'/';
					
					$arrkey = array(); 
					$arrReplace = array();
					
					//Image Berita
					$strTempImagePath = $this->TempImagePath.$dropKey.'/';
					$strFilePath = 'media/images/'.$strImagePath;
					$strFilePathGalery = 'media/images/'.$strImagePath.'/galery/';
					
					//create Directory 
					if(!is_dir('./'.$strFilePath)){
						mkdir('./'.$strFilePath, 0777, true); 
					}
					
					
					//Move Photo Utama
					if( $strImageHeader != '' ){
						if(file_exists('./media/images/'.$strTempImagePath.$strImageHeader)){
							rename('./media/images/'.$strTempImagePath.$strImageHeader, "./".$strFilePath.str_replace($dropKey,'',$strImageHeader));
							
						}
					}
					
					
					//Save Edit Berita
					$arrDataEdit['deskripsi'] 	  = $content;
					/*if($this->permission['GroupLevel'] > 2 ){
						$arrDataEdit['berita_status'] = 0;
					}*/
					
					$arrWhereEdit = array('memberid' => $client_id);
					
					$this->MMember->editMember($arrDataEdit, $arrWhereEdit);
					
				}
				
				$arrRes = array(
					'valid'=>$bolvalid, 
					'message'=>$Message, 
				);
				
				if($bolvalid) $arrRes['redirect'] = base_url().'admin/client/viewClient.html?client='.$this->ffunction->encode($client_id); 
				echo json_encode($arrRes);die();
			}

		}else{
				
			$arrRes = array(
					'valid'=>false, 
					'message'=>"Maaf Terjadi Kesalahan, Permintaan Tidak Valid . Silahkan Muat Ulang Halaman ini", 
			);
			echo json_encode($arrRes);
		}
	}	
	
	public function listclientdata($param = ''){
		$arrWhere = array();
		
			
        $arrField = array("namadepan","member_image", "email","password","nohandphone");

		//Search
        if($this->input->post('namadepan')!='') $arrWhere['{_like_} namadepan'] = '%'.$this->input->post('namadepan').'%';

		//Order
		$strField = $arrField[(int)$this->input->post('iSortCol_0')];
		$arrOrder[$strField] = $this->input->post('sSortDir_0');

		//Limit & offset
		$intLimit  =$_POST['iDisplayLength'];
		$intOffset =$_POST['iDisplayStart'];
		
		//Get Data From database
        $arrData = $this->MMember->getListMember($arrOrder, $arrWhere, $intLimit, $intOffset);
        $intRows = $this->MMember->getRowsMember($arrOrder, $arrWhere);
		$iTotal  = $this->MMember->getRowsMember();
        
        //echo '<pre>';print_r($arrData);echo '</pre>';die();
        
		$arrValue = array();
		$arrAll   = array();
        
		$iFilteredTotal = $intRows;
		$i=0;
		foreach($arrData as $objBerita){
			$arrValue = array();
			$arrData  = $this->converter->objectToArray($objBerita);
            $i++;
            foreach($arrField as $strValue){
				switch ($strValue) {
					case"member_image":
						array_push($arrValue, '<center><img height="40px" src="'.$this->imageloader->fimageclient($objBerita,2).'" /></center>');
					break;
					default : array_push($arrValue, $arrData[$strValue]);
				}
			}
			

            array_push($arrValue, 
					   "<center>
                       <a href=\"".base_url()."admin/client/viewclient.html?client=".$this->ffunction->encode($objBerita->memberid)."\" title=\"Edit\"><img src=\"".base_url()."style/admin/images/edit.png\" /></a> &nbsp;
                       <a href=\"".base_url()."admin/client/deleteclient.html?client=".$this->ffunction->encode($objBerita->memberid)."\" title=\"Delete\"><img src=\"".base_url()."style/admin/images/delete.png\" onclick=\"return confirm('Anda ingin menghapus data tersebut?')\" /></a>
                       </center>");

			array_push($arrAll, $arrValue);
			
		}

		//Create Json For DataTables
		$output = array(
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => $arrAll
		);

		echo json_encode($output);
		die();
		
	}
	
	
	
	public function deleteClient(){
		
		$client_id=urlencode(($this->input->get('client'))) ;
		$client_id  = $this->ffunction->decode($client_id);
		if(!empty($client_id)){
			$objBerita = $this->MMember->getListMember(array(),array('memberid'=>(int)$client_id));
			if(count($objBerita)==1){
				$this->MMember->deleteMember(array('memberid'=>$client_id));
				echo '<script>alert("Client Berhasil di Hapus");window.location.href = "'.base_url().'admin/client/index.html";</script>';
			}else{
				echo '<script>alert("Maaf Client Tidak di Temukan");window.location.href = "'.base_url().'admin/client/index.html";</script>';

			}
		}
		
	}
	
	public function dropzone($strType = ""){
		if ($strType == "upload"){
			$strDropKey = $this->input->post('dropkey');

			if ($strDropKey != ""){

				$type = $_FILES['file']['type'];   

				// Generate Pathing untuk Picture
				$strTempImagePath = $this->TempImagePath;
				$strTempFilePath = $strTempImagePath.$strDropKey.'/drop/';

				if(!is_dir('./style/images/'.$strTempFilePath)){
					mkdir('./style/images/'.$strTempFilePath, 0777, true); 
				}

				//Count Image
				$intCount = 1;
				if(is_dir('./style/images/'.$strTempFilePath)){
					
					$files = scandir('./style/images/'.$strTempFilePath);                 
					if ( false!==$files ) {
						foreach ( $files as $file ) {
							if ( '.'!=$file && '..'!=$file) {       
								if (strrpos($file, $strDropKey) !== false){
									$intCount++;
								}
							}
						}
					}
					
				}
				
				//Upload Image
				$arrResult = $this->imageloader->UploadImage($strTempFilePath, "file" );
				
				//Check Upload
				if (!$arrResult['Valid']){
					echo "error on upload";
				}else{
					
					$strFileImageName = $arrResult['FilePath'].$arrResult['FileName'];

					//Resize Image Original
					//$this->imageloader->resize_image($strFileImageName, './'.$strTempFilePath, 800, 800);
					
					echo  $strFileImageName;
					
				}

			}
		}
		elseif ($this->input->post('type') == "delete"){

			$strRootPath = $_SERVER{'DOCUMENT_ROOT'};
			$strpath = $this->input->post('path');
			$strItemId = $this->input->post('serverId');

			if ($strItemId != "" && $strpath!=''){
				$strpath = './'.str_replace(base_url(),'',$strpath);
				$arrWhere = array('image_id' => $strItemId);
			}			
		}
		else{

			$result       = array();
			$strImage 	  = "";
			$strImagePath = "";
			$strRootPath = $_SERVER{'DOCUMENT_ROOT'};
			$strBeritaId = $this->ffunction->decode($this->input->post('serverkey'));
		
			header('Content-type: text/json');              
			header('Content-type: application/json');
			echo json_encode($result);
		}
		die();
	}
	
	public function imagemanager($key='', $client_id=''){
		$this->output->unset_template();
		$arrData['dropkey'] = $key;
		$imgupload = array();
		$imgdb	   = array();
		
		
		if(is_dir('./media/images/user/'.$this->userData['UserInitial'].'/upload/')){
			$files = scandir('./media/images/user/'.$this->userData['UserInitial'].'/upload/');                 
			if (false!==$files){
				foreach ( $files as $file ){
					if ( '.'!=$file && '..'!=$file) {       
						if (strrpos($file, $key) !== false){
							
							$imgName =  str_replace($key,'',$file);	
							if( strlen($imgName) > 20 ){
								$t = strlen($imgName)-20;
								$imgName =  substr($imgName,0,strlen($imgName)-10-$t).'..'.substr($imgName,-8);
							}
							$imgupload[] = array(
										'path'=>'media/images/user/'.$this->userData['UserInitial'].'/upload/'.$file,
										'fullpath'=>base_url().'media/images/user/'.$this->userData['UserInitial'].'/upload/'.$file,
										'name'=>$imgName
									 );
						}
					}
				}
			}
		}
		
		$arrData['imgdb'] = $imgdb;
		$arrData['imgupload'] = $imgupload;
				
		
		$this->load->view('web/include/imagemanager', $arrData);
		//echo "<img width='200px' src='http://www.yessport.com/sites/default/files/styles/media_gallery_thumbnail/public/Flexfit%20Garment%20Washed%20Twill%20Cap%206997,%20Stone,%20United%20Tagit%202.jpg?itok=jGOK7Mt9'/>"; 
	}
	
	

	public function removphotoconten(){
			$this->output->unset_template();
		$imgPath = $this->input->post('path');
		if(file_exists('./'.$imgPath)){
			unlink('./'.$imgPath);
			$res = array(
				'valid'=>true
			);
			echo json_encode($res);
		}else{
			$res = array(
				'valid'=>false,
				'message'=>'Maaf Image Tidak Valid '
			);
			echo json_encode($res);
		}

	}
	
}