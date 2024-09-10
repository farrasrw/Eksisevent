<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MMember extends MY_Models {

	public function __construct(){
		parent::__construct();
	}

	//================================== Table Member ==================================//
    public function getFieldMember(){
		return $this->getFieldTable($this->db, "member");
	}

	public function getListMember($arrOrder = array(), $arrWhere = array()){
		return $this->getAllRecord($this->db, "member", $arrOrder, $arrWhere);
	}


	public function addMember($arrData){
		$this->addData($this->db, "member", $arrData);
	}

	public function editMember($arrData, $arrWhere = array()){
		$this->editData($this->db, "member", $arrData, $arrWhere);
	}

	public function deleteMember($arrWhere = array()){
		$this->deleteData($this->db, "member", $arrWhere);
	}


    //================================== Table Member Address ==================================//
    public function getListMemberAddress($arrOrder = array(), $arrWhere = array()){
		return $this->getAllRecord($this->db, "memberaddress", $arrOrder, $arrWhere);
	}
    public function addMemberAddress($arrData){
		$this->addData($this->db, "memberaddress", $arrData);
	}
    public function editMemberAddress($arrData, $arrWhere = array()){
				$this->editData($this->db, "memberaddress", $arrData, $arrWhere);
	  }

	public function deleteMemberAddress($arrWhere = array()){
		$this->deleteData($this->db, "memberaddress", $arrWhere);
	}

	//================================== Table Member External ==================================//
    public function getListMemberExternal($arrOrder = array(), $arrWhere = array()){
		return $this->getAllRecord($this->db, "memberexternal", $arrOrder, $arrWhere);
	}
    public function addMemberExternal($arrData){
		$this->addData($this->db, "memberexternal", $arrData);
	}
    public function editMemberExternal($arrData, $arrWhere = array()){
		$this->editData($this->db, "memberexternal", $arrData, $arrWhere);
	}

	public function deleteMemberExternal($arrWhere = array()){
		$this->deleteData($this->db, "memberexternal", $arrWhere);
	}


    ////////////////////////////////////////Menggunakan Data Tabel Ajax/////////////////////////////////////////////////////////////

    public function getLimitMember ($arrOrder=array(), $arrWhere= array(), $limit=10, $offset=0){
        return $this->getLimitRecord($this->db,"member", $arrOrder, $arrWhere, $limit, $offset);
    }

	public function getRowsMember(){
		return $this->db->count_all_results('member');
	}

    public function getLimitMemberRow($arrOrder= array(), $arrWhere= array(), $limit=10, $offset=0){
        $this->paramCriteria($this->db,$arrOrder,$arrWhere);
		return $this->db->count_all_results("member");
    }

	public function getListMemberReferalSeting($arrOrder = array(), $arrWhere = array()){
		$this->db->select('Member.*,  ReferralSetting.RefSettingId,ReferralSetting.ReferalVipReward,ReferralSetting.ReferalReward,ReferralSetting.MemberReward,ReferralSetting.MemberGift, ReferralSetting.TransMin, ReferralSetting.TransPeriode, ReferralSetting.FromTo');
		$this->db->join('JagapatiTrans.ReferralSetting ReferralSetting', 'ReferralSetting.RefSettingId=Member.ReferralSettingId', 'LEFT');
		return $this->getAllRecord($this->db, "Member", $arrOrder, $arrWhere);
	}

    /*-------------------------------------Member Balance----------------------------*/
    public function getListMemberBalance($arrOrder = array(), $arrWhere = array()){
		return $this->getAllRecord($this->db, "jagapatitrans.memberbalance", $arrOrder, $arrWhere);
	}

	public function addMemberBalance($arrData){
		$this->addData($this->db, "jagapatitrans.memberbalance", $arrData);
	}

	public function editMemberBalance($arrData, $arrWhere = array()){
		$this->editData($this->db, "jagapatitrans.memberbalance", $arrData, $arrWhere);
	}

	public function deleteMemberBalance($arrWhere = array()){
		$this->deleteData($this->db, "MemberBalance", $arrWhere);
	}

    public function saldoMemberBalance($strMemberId){
        $strQuery = "SELECT SUM(
								case when TypeSaldo IN (0,3) then
									TransAmount else
									-1 * TransAmount end
							) AS TotalSaldo
					FROM jagapatitrans.MemberBalance
					WHERE MemberId='".$strMemberId."'";
        $objMemberBalance=$this->db->query($strQuery);

        return $objMemberBalance->result();
    }

    public function getLimitMemberBalance ($arrOrder=array(), $arrWhere= array(), $limit=10, $offset=0){
        return $this->getLimitRecord($this->db,"jagapatitrans.MemberBalance", $arrOrder, $arrWhere, $limit, $offset);
    }

    public function saldoPendingBalance($strMemberId){
        $strQuery = "SELECT SUM(MemberValueBalance) AS SaldoPending
						FROM jagapatitrans.ReferralBalance
						WHERE MemberId='".$strMemberId."' AND ClosingId =''";
        $objReferralBalance= $this->db->query($strQuery);

        return $objReferralBalance->result();
    }

    public function refStatus(){
        $strQuery= "select * FROM dbview.fref()";
        $objReferralBalance= $this->db->query($strQuery);
        return $objReferralBalance->result();
    }

    public function getTransRef($strMemberId){
        $strQuery = "SELECT date_trunc('month', createdate) as membermonth,string_agg(DISTINCT transheader.namapenerima, ', ') as membername, sum(grandtotal) as totalmonth
FROM jagapatitrans.transheader
LEFT JOIN jagapatitrans.transdetail ON transdetail.transid=transheader.transid
WHERE transdetail.referralby='".$strMemberId."' and transheader.transstatus in('2','3','4') and transdetail.transstatus in('2','3')
GROUP BY membermonth ORDER BY membermonth LIMIT 10
";
        $objRefTrans= $this->db->query($strQuery);

        return $objRefTrans->result();
    }

    public function expGreenCode($strMemberId){
        $strQuery= "SELECT jagapatitrans.transheader.createdate + INTERVAL '6 month' as member_exp
FROM jagapatitrans.transheader
WHERE transheader.memberid='".$strMemberId."' AND jagapatitrans.transheader.transstatus > 1 AND jagapatitrans.transheader.transstatus < 5
ORDER BY transheader.createdate DESC LIMIT 1";
        $objExpRef= $this->db->query($strQuery);
        return $objExpRef->result();
    }
    
    
    public function addKomplain($arrData){
		$this->addData($this->db, "jagapatitrans.transcomplain", $arrData);
	}
    
    public function totalPoint($strMemberId){
        $strQuery= "select sum(totalpoint) as totalpoint from jagapatitrans.transdetail
left join jagapatitrans.transheader on transdetail.transid=transheader.transid
where transheader.memberid='".$strMemberId."' and transheader.transstatus in('2','3','4') and transdetail.transstatus in('2','3')";
        $objExpRef= $this->db->query($strQuery);
        return $objExpRef->result();
    }
}