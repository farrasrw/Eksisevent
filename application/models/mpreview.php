<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPreview extends MY_Models {
		
	public function __construct(){
		parent::__construct();
	}	
    
    public function getFieldPreview(){
		return $this->getFieldTable($this->db, "preview");
	}
	
	public function getListPreview($arrOrder = array(), $arrWhere = array()){
		return $this->getAllRecord($this->db, "preview", $arrOrder, $arrWhere);
	}
	
	public function addPreview($arrData){
		$this->addData($this->db, "preview", $arrData);
	}
    
	public function editPreview($arrData, $arrWhere = array()){
		$this->editData($this->db, "preview", $arrData, $arrWhere);
	}
	
	public function deletePreview($arrWhere = array()){
		$this->deleteData($this->db, "preview", $arrWhere);
	}

    
    ////////////////////////////////////////Menggunakan Data Tabel Ajax/////////////////////////////////////////////////////////////
    
    public function getLimitPreview ($arrOrder=array(), $arrWhere= array(), $limit=10, $offset=0){
        return $this->getLimitRecord($this->db,"preview", $arrOrder, $arrWhere, $limit, $offset);
    }
    
    
	public function getRowsPreview(){
		return $this->db->count_all_results('preview');
	}
    
    public function getLimitPreviewRow($arrOrder= array(), $arrWhere= array(), $limit=10, $offset=0){
        $this->paramCriteria($this->db,$arrOrder,$arrWhere);
		return $this->db->count_all_results("preview");        
    }
}
