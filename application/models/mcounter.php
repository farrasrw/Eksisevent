<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCounter extends MY_Models {

	public function __construct(){
		parent::__construct();
	}
	
	public function getCounterCode($strKeyCode){
		$strReturnCode = "";
		
		$arrWhere = array("keycode" => $strKeyCode);
		$arrData = $this->getAllRecord($this->db, "dbcounter", array(), $arrWhere);
		
		if (count($arrData) > 0){
			$strGen = substr((date('Y') * date('m') * (date('d') + 1))."000000000", 0, 6);
			$strKey = substr("0000000000".$arrData[0]->keynum, -5);
			$strReturnCode = $strKeyCode.substr($strGen, 0, 2).substr($strKey, 0, 3).substr($strGen, 2, 2).substr($strKey, 3, 2).substr($strGen, 4, 2);
		
			$arrData = array("keynum" => $arrData[0]->keynum + 1);
			$arrWhere = array("keycode" => $strKeyCode);
			$this->editData($this->db, "dbcounter", $arrData, $arrWhere);
		}
		
		return $strReturnCode;
	}
	
	public function getRunningCode($strKeyCode){
		$strReturnCode = "";
		
		$arrWhere = array("keycode" => $strKeyCode);
		$arrData = $this->getAllRecord($this->db, "dbcounter", array(), $arrWhere);
		if (count($arrData) > 0){
			$strKey = substr("0000000000".$arrData[0]->keynum, -11);
			$strReturnCode = $strKeyCode.$strKey;
		
			$arrData = array("keynum" => $arrData[0]->keynum + 1);
			$arrWhere = array("keycode" => $strKeyCode);
			$this->editData($this->db, "dbcounter", $arrData, $arrWhere);
		}
		
		return $strReturnCode;
	}
}