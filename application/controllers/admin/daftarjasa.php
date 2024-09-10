<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarjasa extends MY_ThemeController {

	function __construct()	{
		parent::__construct();
		
		
		/* 	Set Private Method	*/
		$this->privateMethod = array(
			'index',
			'saveadddaftarjasa',
			'saveeditdaftarjasa',
			'deletedaftarjasa',
		);
		
		/* Permission Admin Check */
		//$this->PermissionAdmin();
		$this->tempAdmin();
		$this->load->model('MdaftarJasa','MDaftarJasa');
	}
	
	
	
	public function index(){
		//echo $userd = $this->userData['UserId'].'-'.$this->userData['UserInitial'];;die();
		$arrData['hdnkey']= date('Y-m-d').'-tambahdaftarjasa'; 
		$arrData['viewstate']='add';
		$this->load->view('admin/daftarjasa/add_daftarjasa',$arrData);
		
	}
    
    public function viewDaftarJasa(){
		//$objKategori = $this->MKategori->getListKategori(array(), array());
		//$objTag = $this->MTag->getListTag(array(),array());
		//$arrTag = json_decode(json_encode($objTag),true);
		
        $daftarjasaId = $this->ffunction->decode( urlencode($this->input->get('daftarjasa')) );
        
        $objdaftarjasa = $this->MDaftarJasa->getListDaftarJasa(array(),array('idjasa'=>(int)$daftarjasaId));
        		
		if(count($objdaftarjasa)==1){
			//$arrData['kategori'] = $objKategori; 
			$arrData['hdnkey']= $objdaftarjasa[0]->idjasa; 
			$arrData['daftarjasa'] = $objdaftarjasa[0];
			//$arrData['taglist'] = $this->underscore->map($arrTag, function($num) { return $num['tag_name']; });
            
            //echo '<pre>';print_r($arrData['daftarjasa']);echo '</pre>';
                
            
			$arrData['dropkey'] = $this->ffunction->generateRandomString(10);
            
			$this->load->view('admin/daftarjasa/add_daftarjasa',$arrData);	
		}
		
	}
	
	public function saveadddaftarjasa(){
		
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		$valid 	= true;
		
		if($key=='' || $key!=date('Y-m-d').'-tambahdaftarjasa' ) $valid = false;
		$this->_savedaftarjasa($valid);
		
	}
	
	public function saveeditdaftarjasa(){
		
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		$valid 	= true;
		
		if($key=='' || $key==date('Y-m-d').'-tambahdaftarjasa' ) $valid = false;
		$this->_savedaftarjasa($valid);
		
	}
	
	public function deletedaftarjasa(){
		
		$daftarjasaId=urlencode(($this->input->get('daftarjasa')));
		$daftarjasaId  = $this->ffunction->decode($daftarjasaId);
		if(!empty($daftarjasaId)){
			$objdaftarjasa = $this->MDaftarJasa->getListDaftarJasa(array(),array('idjasa'=>(int)$daftarjasaId));
			if(count($objdaftarjasa)==1){
				$this->MDaftarJasa->deleteDaftarJasa(array('idjasa'=>$daftarjasaId));
				echo '<script>alert(" daftarjasa Berhasil di Hapus");window.location.href = "'.base_url().'admin/daftarjasa/index.html";</script>';
			}else{
				echo '<script>alert("Maaf daftarjasa Tidak di Temukan");window.location.href = "'.base_url().'admin/daftarjasa/index.html";</script>';

			}
		}
		
	}
	
	function _savedaftarjasa($valid=false){
		
		$this->output->unset_template();
		$key 	= $this->ffunction->decode($this->input->post('hdnkey'));
		if($key!= '' && $valid){
			
			$daftarjasaName 	= $this->input->post('daftarjasacontent');
			$daftarjasaUrl 	= $this->ffunction->fUrlEncoder((!empty($daftarjasaUrl )?$daftarjasaUrl:$daftarjasaName));

			$this->form_validation->set_rules('daftarjasacontent', 'Nama daftarjasa', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
				$arrRes = array(
					'valid'=>false, 
					'message'=>"Inputan Belum Benar, Silahkan Periksa Kembali Inputan Anda", 
				);
				echo json_encode($arrRes);
				
			}else{
				
				$arrData = array(
					'deskripsijasa'=>$daftarjasaName,
				);

				if($key==date('Y-m-d').'-tambahdaftarjasa'){
					
					
					$userd = $this->userData['UserId'].'-'.$this->userData['UserInitial'];
					$this->MDaftarJasa->adddaftarjasa($arrData);
					$objdaftarjasa = $this->MDaftarJasa->getListDaftarJasa(array(),array('daftarjasa.deskripsijasa'=>$daftarjasaName, 'daftarjasa.createby'=>$userd));
                    
                    //echo var_dump($objdaftarjasa);die();
                    
					if(count($objdaftarjasa)==1){

						$daftarjasaId = $objdaftarjasa[0]->idjasa;
						$bolvalid 	 = true;
						$Message  	 = "daftarjasa Baru Berhasil di Tambah " ; 
						
					}else{

						$bolvalid =false;
						$Message ="Maaf Terjadi Kesalahan Saat Menambah daftarjasa Baru.. ";
						
					}
					
					
				}else{
					
					$daftarjasaId  = (int)$key ; 
					$objdaftarjasa = $this->MDaftarJasa->getListDaftarJasa(array(),array('idjasa'=>$daftarjasaId));
					if(count($objdaftarjasa)==1){
						
						$this->MDaftarJasa->editDaftarJasa($arrData,array('idjasa'=>$daftarjasaId));
						$bolvalid = true; 
						$Message  = "daftarjasa Berhasil di Update";
						
					}else{
						
						$bolvalid = false ; 
						$Message  = "Maaf daftarjasa Tidak Valid, Silahkan Muat Ulang Halamana Anda ";
					}
					
				}
				
				$arrRes = array(
					'valid'=>$bolvalid, 
					'message'=>$Message, 
                    'redirect' => base_url().'admin/daftarjasa/index.html',
				);
				
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
	
	public function listdaftarjasadata(){
		
		$arrWhere =array();
		$arrField = array("idjasa","namejasa");
		
		//search
        if($this->input->post('LabelName')!='') $arrhere['LabelName'] = '%'.$this->input->post('LabelName');
		
		//Order
		$strField = $arrField[(int)$this->input->post('iSortCol_0')];
		$arrOrder[$strField] = $this->input->post('sSortDir_0');
		
		//Limit & offset
		$intLimit  = $_POST['iDisplayLength'];
		$intOffset = $_POST['iDisplayStart'];
		
		//Get Data From database
        $arrData = $this->MDaftarJasa->getListDaftarJasa($arrOrder, $arrWhere, $intLimit, $intOffset);
        //echo var_dump($arrData);die();
        $intRows = $this->MDaftarJasa->getRowDaftarJasa($arrOrder, $arrWhere);
		$iTotal  = $this->MDaftarJasa->getRowDaftarJasa();
        
		$arrValue = array();
		$arrAll   = array();
        
		$iFilteredTotal = $intRows;
		foreach($arrData as $objdaftarjasa){
			$arrValue = array();
			$arrData  = $this->converter->objectToArray($objdaftarjasa);
            
            foreach($arrField as $strValue){
				switch ($strValue) {
					
					default : array_push($arrValue, $arrData[$strValue]);
				}
			}
			
			/*array_push($arrValue, 
					   "<center>
                       <a href=\"#\" onclick=\"editdaftarjasa('".$this->ffunction->encode($objdaftarjasa->idjasa)."','".$objdaftarjasa->deskripsijasa."')\" title=\"Edit\"><img src=\"".base_url()."style/admin/images/edit.png\" /></a> &nbsp;
                       <a href=\"".base_url()."admin/daftarjasa/deletedaftarjasa.html?daftarjasa=".$this->ffunction->encode($objdaftarjasa->idjasa)."\" title=\"Delete\"><img src=\"".base_url()."style/admin/images/delete.png\" onclick=\"return confirm('Anda ingin menghapus data tersebut?')\" /></a>
                       </center>");*/
            
            array_push($arrValue, 
					   "<center>
                       <a href=\"".base_url()."admin/daftarjasa/viewDaftarJasa.html?daftarjasa=".$this->ffunction->encode($objdaftarjasa->idjasa)."\" title=\"Edit\"><img src=\"".base_url()."style/admin/images/edit.png\" /></a> &nbsp;
                       <a href=\"".base_url()."admin/daftarjasa/deletedaftarjasa.html?daftarjasa=".$this->ffunction->encode($objdaftarjasa->idjasa)."\" title=\"Delete\"><img src=\"".base_url()."style/admin/images/delete.png\" onclick=\"return confirm('Anda ingin menghapus data tersebut?')\" /></a>
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