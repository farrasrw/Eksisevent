<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MDaftarjasa extends MY_Models {
		
	public function __construct(){
		parent::__construct();
	}	
    
    public function getFieldDaftarJasa(){
		return $this->getFieldTable($this->db, "daftarjasa");
	}
	
	public function getListDaftarJasa($arrOrder = array(), $arrWhere = array()){
		return $this->getAllRecord($this->db, "daftarjasa", $arrOrder, $arrWhere);
	}
	
	public function addDaftarJasa($arrData){
		$this->addData($this->db, "daftarjasa", $arrData);
	}
    
	public function editDaftarJasa($arrData, $arrWhere = array()){
		$this->editData($this->db, "daftarjasa", $arrData, $arrWhere);
	}
	
	public function deleteDaftarJasa($arrWhere = array()){
		$this->deleteData($this->db, "daftarjasa", $arrWhere);
	}

    
    ////////////////////////////////////////Menggunakan Data Tabel Ajax/////////////////////////////////////////////////////////////
    
    public function getLimitDaftarJasa ($arrOrder=array(), $arrWhere= array(), $limit=10, $offset=0){
        return $this->getLimitRecord($this->db,"daftarjasa", $arrOrder, $arrWhere, $limit, $offset);
    }
    
    
	public function getRowsDaftarJasa(){
		return $this->db->count_all_results('daftarjasa');
	}
    
    public function getLimitDaftarJasaRow($arrOrder= array(), $arrWhere= array(), $limit=10, $offset=0){
        $this->paramCriteria($this->db,$arrOrder,$arrWhere);
		return $this->db->count_all_results("daftarjasa");        
    }
	
	
	
	
}
