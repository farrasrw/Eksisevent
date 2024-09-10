<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTransaksi extends MY_Models {

	public function __construct(){
		parent::__construct();
	}

    public function beginTrans(){
        $this->db->trans_begin();
    }

    public function comitTrans(){
        $valid=true;
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $valid=false;
        }
        else
        {
            $this->db->trans_commit();
        }
        return $valid;
    }
	
	public function rollbackTrans(){
		$this->db->trans_rollback();
    }

    //////////////////////////////////// Trans Header////////////////////////////////////////////////

    public function getFieldTransHeader(){
		return $this->getFieldTable($this->db, "transheader");
	}

	public function getListTransHeader($arrOrder = array(), $arrWhere = array()){
		return $this->getAllRecord($this->db, "transheader", $arrOrder, $arrWhere);
	}

	public function addTransHeader($arrData){
		$this->addData($this->db, "transheader", $arrData);
	}

	public function editTransHeader($arrData, $arrWhere = array()){
		$this->editData($this->db, "transheader", $arrData, $arrWhere);
	}

	public function deleteTransHeader($arrWhere = array()){
		$this->deleteData($this->db, "transheader", $arrWhere);
	}

    public function getLimitTransHeader ($arrOrder=array(), $arrWhere= array(), $limit=10, $offset=0){
        return $this->getLimitRecord($this->db,"transheader", $arrOrder, $arrWhere, $limit, $offset);
    }


	public function getRowsTransHeader(){
		return $this->db->count_all_results('transheader');
	}

    public function getLimitTransHeaderRow($arrOrder= array(), $arrWhere= array(), $limit=10, $offset=0){
        $this->paramCriteria($this->db,$arrOrder,$arrWhere);
		return $this->db->count_all_results("transheader");
    }
    //////////////////////////////////////// End Trans Header /////////////////////////////////////////////////////////////

}