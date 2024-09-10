<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preview extends MY_ThemeController {
	
    public $TempImagePath;
	public $permission = array();
	function __construct(){
		
		parent::__construct();
		
		
		/* 	Set Private Method	*/
		$this->privateMethod = array(
			'index',
			'viewpreview',
			'addpreview',
			'saveedituser',
			'saveeditpreview',
			'saveaddpreview',
			'listuserdata',
			'deleteheadline',
			'addheadline',
			'changeorder',
			'headline',
			'approvepreview',
		);
		
		/* Permission Admin Check */
		//$this->permission = $this->PermissionAdmin();
		$this->tempAdmin();
		$this->load->model('Mpreview','MPreview');
		$this->load->model('Mtag','MTag');
		$this->load->model('Mkategori','MKategori');
		
		$this->TempImagePath='preview/Temp/';
		
	}
	
	public function index(){
		
		$this->load->view('admin/preview/list_preview');		
		
	}
	
	public function uploadimage(){
		
		$this->output->unset_template();
        $key = $this->input->post('uploadkey');		
        $typeupload = $this->input->post('uploadtype');	
		
		if(!empty($key)){
		
			
			$strImagePath = 'preview/Temp/'.$key.'/';
			
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
	
	public function addPreview(){

		$arrData['hdnkey']= 'tambahpreview';
		$arrData['viewstate']= 'add';
		
		$arrData['dropkey'] = $this->ffunction->generateRandomString(10);
		$this->load->view('admin/preview/add_preview',$arrData);
		
		
		
		
	}
	
	public function viewPreview(){

		$previewid = $this->ffunction->decode( urlencode($this->input->get('preview')) );
		$objPreview = $this->MPreview->getListPreview(array(),array('preview_id'=>(int)$previewid));
		
		if(count($objPreview)==1){
			$arrData['hdnkey']= $objPreview[0]->preview_id; 
			$arrData['preview'] = $objPreview[0];
			$arrData['dropkey'] = $this->ffunction->generateRandomString(10);
			$this->load->view('admin/preview/add_preview',$arrData);	
		}
		
	}
	
	public function saveaddpreview(){
		
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		$valid 	= true;
		
		if($key=='' || $key!='tambahpreview' ) $valid = false;
		$this->_savepreview($valid);
		
	}
	
	public function saveeditpreview(){
		
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		$valid 	= true;
		
		if($key=='' || $key=='tambahpreview' ) $valid = false;
		$this->_savepreview($valid);
		
	}
	
	function _savepreview($valid=false){
		
		$this->output->unset_template();
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		if($key!= '' && $valid){
			
			$previewTitle 		= $this->ffunction->cleanString($this->input->post('previewtitle'));
			$previewContent		= $this->input->post('previewcontent');
			
			$dropKey 			= $this->input->post('dropkey');
			$strImageHeader 	=  $this->input->post('imageheader');
			
			$this->form_validation->set_rules('previewtitle', 'Title Berita', 'required');
			$this->form_validation->set_rules('previewcontent', 'Content Berita', 'required');
		

			if ($this->form_validation->run() == FALSE)
			{
				
				$arrRes = array(
					'valid'=>false, 
					'message'=>"Maaf Terjadi Kesalahan, Silahkan Periksa Kembali Inputan Anda", 
				);
				echo json_encode($arrRes);
				
			}else{
				
				$arrData = array(
					'preview_title'=>$previewTitle,
					'preview_content'=>$previewContent, 
				);
				
				if($key=='tambahpreview'){
					
					//cekberitaURl = 
					$objPreview =$this->MPreview->getListPreview(array(),array('preview_title'=>$previewTitle));
					if(count($objPreview)==0){
					
						$userd = $this->userData['UserId'].'-'.$this->userData['UserInitial'];

						$this->MPreview->addPreview($arrData);

						$objPreview =$this->MPreview->getListPreview(array(),array('preview_title'=>$previewTitle));
						if(count($objPreview)==1){

							$previewid = $objPreview[0]->preview_id;
							$bolvalid =true;
							$Message  ="Preview Baru Berhasil di Tambah " ; 

						}else{

							$bolvalid =false;
							$Message ="Maaf Terjadi Kesalahan Saat Menambah Preview Baru.. ";
						}
						
					}else{
						
						$bolvalid = false ; 
						$Message = "Maaf Preview Url Sudah Pernah Di Gunakan ";
						
					}
					
				}else{
					
					$previewid  = (int)$key ; 
					$objPreview =$this->MPreview->getListPreview(array(),array('preview_id'=>$previewid));
					if(count($objPreview)==1){
						
                        
						$this->MPreview->editPreview($arrData,array('preview_id'=>$previewid));
						$bolvalid = true; 
						$Message  = "Preview Berhasil di Update";
						
					}else{
						
						$bolvalid = false ; 
						$Message  = "Maaf Preview Tidak Valid, Silahkan Muat Ulang Halamana Anda ";
						
					}
					
				}
				
				if($bolvalid){
					
					$arrPhoto=array();
					$strImagePath = 'preview/'.$previewid.'/';
					
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
					
					
					//Move Image Content 
					$strTempFilePath = $strTempImagePath.$dropKey.'/content/';
					//$strTempFilePath = 'user/'.$this->userData['UserInitial'].'/upload/';
					$strPathImageContent = $strFilePath.'content/';

					if(is_dir('./media/images/'.$strTempFilePath)){
						$files = scandir('./media/images/'.$strTempFilePath);                 
						if (false!==$files){

							//create Directory 
							if(!is_dir('./'.$strPathImageContent)){
								mkdir('./'.$strPathImageContent, 0777, true); 
							}

							foreach ( $files as $file ){
								if ( '.'!=$file && '..'!=$file) {       
									if (strrpos($file, $dropKey) !== false){
										
										$strNewFile = str_replace($dropKey, "", $file);
										
										/* $arrTemp = explode(".", $strNewFile);

										if (count($arrTemp) > 0){
											$strNewFile = rand(1000,9999) .".".$arrTemp[1];
											
										} */

										//Save To array
										array_push($arrkey,$file);
										array_push($arrReplace,$strNewFile);
										
										$arrPhotos = array( 'image_name' => $strNewFile , 'image_type'=>2, 'preview_id'=>$previewid );
										array_push($arrPhoto, $arrPhotos);

										//Move Image
										rename('./media/images/'.$strTempFilePath.$file, "./".$strPathImageContent.$strNewFile);
									 
									}
								}
							}

							
						 
							//Replace Image Upload Content
							$conten  = $previewContent;
							$tmpPath= base_url().'media/images/'.$this->TempImagePath.$dropKey.'/content/';
							$conten = str_replace($arrkey,$arrReplace, $conten);                    
							$previewContent = str_replace($strTempFilePath,$strImagePath.'content/',$conten);
							
							
						}
					}

					//Save Edit Berita
                    //echo '<pre>';print_r($previewContent);echo '</pre>';die();
					$arrDataEdit['preview_content'] 	  = $previewContent;					
					
				}
				
				$arrRes = array(
					'valid'=>$bolvalid, 
					'message'=>$Message, 
				);
				
				if($bolvalid) $arrRes['redirect'] = base_url().'admin/preview/viewPreview.html?preview='.$this->ffunction->encode($previewid); 
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
	
	public function listpreviewdata($param = ''){
		$arrWhere = array();
		
			
        $arrField = array("preview_title");

		//Search
        if($this->input->post('previewtitle')!='') $arrWhere['{_like_} preview_title'] = '%'.$this->input->post('previewtitle').'%';

		//Order
		$strField = $arrField[(int)$this->input->post('iSortCol_0')];
		$arrOrder[$strField] = $this->input->post('sSortDir_0');

		//Limit & offset
		$intLimit  =$_POST['iDisplayLength'];
		$intOffset =$_POST['iDisplayStart'];
		
		//Get Data From database
        $arrData = $this->MPreview->getListPreview($arrOrder, $arrWhere, $intLimit, $intOffset);
        $intRows = $this->MPreview->getRowPreview($arrOrder, $arrWhere);
		$iTotal  = $this->MPreview->getRowPreview();
        
		$arrValue = array();
		$arrAll   = array();
        
		$iFilteredTotal = $intRows;
		$i=0;
		foreach($arrData as $objPreview){
			$arrValue = array();
			$arrData  = $this->converter->objectToArray($objPreview);
            $i++;
            foreach($arrField as $strValue){
				switch ($strValue) {
					default : array_push($arrValue, $arrData[$strValue]);
				}
			}
			

            array_push($arrValue, 
					   "<center>
                       <a href=\"".base_url()."admin/preview/viewPreview.html?preview=".$this->ffunction->encode($objPreview->preview_id)."\" title=\"Edit\"><img src=\"".base_url()."style/admin/images/edit.png\" /></a> &nbsp;
                       <a href=\"".base_url()."admin/preview/deleteberita.html?berita=".$this->ffunction->encode($objPreview->preview_id)."\" title=\"Delete\"><img src=\"".base_url()."style/admin/images/delete.png\" onclick=\"return confirm('Anda ingin menghapus data tersebut?')\" /></a>
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
	
	
	public function deletePreview(){
		
		$previewid=urlencode(($this->input->get('preview'))) ;
		$previewid  = $this->ffunction->decode($previewid);
		if(!empty($previewid)){
			$objPreview = $this->MPreview->getListPreview(array(),array('preview_id'=>(int)$previewid));
			if(count($objPreview)==1){
				$this->MPreview->deleteBerita(array('preview_id'=>$previewid));
				echo '<script>alert("Berita Berhasil di Hapus");window.location.href = "'.base_url().'admin/preview/index.html";</script>';
			}else{
				echo '<script>alert("Maaf Berita Tidak di Temukan");window.location.href = "'.base_url().'admin/preview/index.html";</script>';

			}
		}
		
	}
}