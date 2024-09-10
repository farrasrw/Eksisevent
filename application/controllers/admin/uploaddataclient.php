<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Uploaddataclient extends MY_ThemeController {

	function __construct(){
		parent::__construct();
		
        $this->load->model('mtransaksi', 'MTrans');
        $this->load->model('mmember','MMember');
        
		$this->tempAdmin();
	}
    
    public function index(){
        $this->load->view('admin/dataclient/vdataclientlist');
    }
    
    function addDataCLient(){
        
        $arrData['Key']= 'Upload';
        
        $objDataClient=$this->MMember->getListMember(array(),array());
        
        $arrData['client']=$objDataClient;
        
        $this->load->view('admin/dataclient/vadddataclient',$arrData);
    }
    
    
    function editDataCLient($strNoKontrak){
        
        $arrWhere = array('transid' =>$strNoKontrak);
		$arrKontrak= $this->MTrans->getListTransHeader(array(), $arrWhere);
        
        //echo var_dump($arrKontrak);die();
        
		if (count($arrKontrak) > 0){
            
            $objDataClient=$this->MMember->getListMember(array(),array('memberid'=> $arrKontrak[0]->memberid));
        
            $arrData['client']=$objDataClient;
			//Set Data for view
			$arrData = $this->converter->objectToArray($arrKontrak[0]);
			$arrData["Kontrak"] = $arrKontrak[0];
			$arrData["DropKey"] = $this->imageloader->generateRandomString();
			$arrData["Key"] = $strNoKontrak;
            $arrData['client']=$objDataClient;
            
            //echo var_dump($arrData);die();
            
			$this->load->view('admin/dataclient/vadddataclient',$arrData);
		}
	}
    
    public function getTransId()
    {
        $this->load->model('mtransaksi', 'MTrans');
        $objTrans = $this->MTrans->getLimitTransHeader(array('transid' => 'desc'), array(), 1, 0);

        if (count($objTrans) > 0) {
            $ItemId = $objTrans[0]->transid;
            $ItemId = (int) substr($ItemId, -5);
            ++$ItemId;
            $ItemId = str_pad($ItemId, 5, '0', STR_PAD_LEFT);
        } else {
            $ItemId = 1;
            $ItemId = str_pad($ItemId, 5, '0', STR_PAD_LEFT);
        }

        $prefix = 'TR'.date('Ym');
        $ItemId = $prefix.$ItemId;

        $this->load->model('mcounter', 'MCounter');
        $strKey = $this->MCounter->getCounterCode('TR');

        return $strKey;
    }
    
    public function saveOrder()
    {

        $this->load->library('user_agent');

        $bolValid = true;
        $errMessage = '';
        $arrResult = array();
        $arrData = array();

        $strKey = $this->encrypt->decode($this->input->post('hdnKey'));
        
        $TransId = $this->getTransId();

        //cek login
        $strMemberId = $this->input->post('txtClientId');
        $strJudul= $this->input->post('txtJudul');
        $strPesan= $this->input->post('txtPesan');
        
        
        $arrData=array(
            'transid' =>$TransId,
            'memberid' =>$strMemberId,
            'judul' => $strJudul,
            'pesan' => $strPesan
            
        );
        
        if($strKey == "Upload"){
			$bolValid = true;
            
		}else{
			$arrWhere = array('transid' => $strKey);
			$arrKontrak = $this->MTrans->getListTransHeader(array(), $arrWhere);
            
			if (count($arrKontrak) > 0){	
				$bolValid = true;
				$strNoKontrak = $strKey;			
			}
		}
        
        if ($bolValid){
        
        //Saving Data
        //if($strKey == "Upload"){

            if(!is_dir('./style/file/pdf/')){
                mkdir('./style/file/pdf/', 0777, true); 
                }
            
            if (!empty($_FILES['objFile']['name'])) {
                $strFileName = $_FILES['objFile']['name'];
            }else{
                $strFileName='';
            }

            
            //echo $strFileName;die();
            $strDate=$TransId.'-'.date('Y-m-d');

            $config2 = array(
                'file_name'   => $strDate,
                'allowed_types' => 'pdf',
                'overwrite'     => TRUE,
                'upload_path' => './style/file/pdf/'
                );

            $this->load->library('upload', $config2);
            $this->upload->initialize($config2);
            
            

            //Saving Kontrak
            $arrWhere=array('transid'=> $TransId);
            $objTrans=$this->MTrans->getListTransHeader(array(), $arrWhere);
            
            if(count($objTrans)>0){
                $arrResult = array(
                    'valid' => false,
                    'message' => 'Data sudah ada',
                );
            }else{
                
                if($strKey == "Upload"){

                    if($strFileName !=""){
                        if (!$this->upload->do_upload('objFile')){

                            $arrResult = array(
                                'valid' => false,
                                'message' => 'Jenis File Yang Di Upload Harus .pdf'
                            );

                        }else{
                            $params = array(0 => './style/file/pdf/'.$strFileName);
                            $arrData['fileupload'] =$strDate.'.pdf';

                            //echo '<pre>';print_r($arrData);echo '</pre>';die();

                            $this->MTrans->addTransHeader($arrData);

                            $arrResult = array(
                                'valid' => true,
                                'message' => 'Data berhasil disimpan',
                                'redirect' => base_url().'admin/uploaddataclient'
                            );
                        }
                    }else{
                        //echo "<script>alert('gagal')</script>";
                        $this->MTrans->addTransHeader($arrData);

                        $arrResult = array(
                            'valid' => true,
                            'message' => 'Data berhasil disimpan',
                            'redirect' => base_url().'admin/uploaddataclient'
                        );

                    }
                }else{
                    
                    if($strFileName !=""){
                        $strFileName = $_FILES['objFile']['name'];
                        $strDate=date('Y-m-d');

                        $config2 = array(
                            'file_name'   => $strDate,
                            'allowed_types' => 'pdf',
                            'overwrite'     => TRUE,
                            'upload_path' => './style/file/pdf/'
                            );

                        $this->load->library('upload', $config2);
                        $this->upload->initialize($config2);
                        if (!$this->upload->do_upload('objFile')) {
                            echo "Error : ".$this->upload->display_errors()."<hr>";
                            echo "<script>alert('Jenis File yang Di Upload Harus .pdf')</script>";
                            echo '<script>location = "'.site_url('admin/kontrak').'";</script>'; 
                            die();
                        } else {
                            $strDate=date('Y-m-d');
                            $arrWhere = array('transid' => $strNoKontrak);
                            $data['FileName']=$strDate.'.pdf';
                            $data['transid']=$strNoKontrak;
                            $this->MTrans->editTransHeader($data, $arrWhere);
                            
                            $arrResult = array(
                                'valid' => true,
                                'message' => 'Data berhasil diedit',
                                'redirect' => base_url().'admin/uploaddataclient'
                            );
                        }
                    }else{
                        $data['transid']=$$strNoKontrak;
                        $this->MTrans->editTransHeader($data, $arrWhere);
                        
                        $arrResult = array(
                            'valid' => true,
                            'message' => 'Data berhasil diedit',
                            'redirect' => base_url().'admin/uploaddataclient'
                        );
                    }
                }
            }
            
        }else{
            $arrResult = array(
                'valid' => false,
                'message' => 'Silahkan ulangi kembali',
                'redirect' => base_url().'admin/uploaddataclient'
            );
        }

        echo json_encode($arrResult);
        die();
        
    }
    
    public function listDataClient(){
		$arrWhere = array();
		$arrLike = array();
		$arrField = array("createdate","transid","judul","fileupload");

		//search
        if($this->input->post('judul')!='') $arrWhere['judul'] ='%'.$this->input->post('judul');
		
		//Order
		$strField = $arrField[(int)$this->input->post('iSortCol_0')];
		$arrOrder[$strField] = $this->input->post('sSortDir_0');

		//Limit & offset
		$intLimit = $_POST['iDisplayLength'];
		$intOffset = $_POST['iDisplayStart'];
		
		//Get Data From database
        $arrOrder['transid'] = "DESC";
		$arrData = $this->MTrans->getLimitTransHeader($arrOrder, $arrWhere,$intLimit, $intOffset, $arrLike);
		$intRows = $this->MTrans->getLimitTransHeaderRow($arrOrder, $arrWhere, $arrLike);
		$iTotal = $this->MTrans->getRowsTransHeader();
                
		$arrValue = array();
		$arrAll = array();
        
		$iFilteredTotal = $intRows;
		foreach($arrData as $objAdmin){
			$arrValue = array();
			$arrAdmin = $this->converter->objectToArray($objAdmin);
            
            foreach($arrField as $strValue){
				switch ($strValue) {
                    
                    case "fileupload";
                    
                            if(!empty($arrAdmin[$strValue])){
                                array_push($arrValue, "<a href='".base_url()."style/file/pdf/".$objAdmin->transid."-".date('Y-m-d').".pdf' download>
                                <img src='".base_url()."style/admin/images/icon-pdf.png' width='30'>
                                </a>");
                            }else{
                                array_push($arrValue, "");
                            }
                    
                            
                    break;
                    
                
                                                            
                    
					default : array_push($arrValue, $arrAdmin[$strValue]);
				}
			}
            
			array_push($arrValue, 
					   "<center>
                       <a href=\"".base_url()."admin/uploaddataclient/editDataCLient/".$objAdmin->transid."\" title=\"Edit\"><img src=\"".base_url()."style/admin/images/edit.png\" /></a> &nbsp;
                      

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
}