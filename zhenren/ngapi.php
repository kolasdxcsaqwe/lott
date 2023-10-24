<?php
header("content-type:text/html;charset=utf-8");
date_default_timezone_set('PRC');

/**
 * 转账钱包 PHP Demo
 * Class ngapi
 * @version (PHP 5 >= 5.3.0, PHP 7)
 */
class ngapi{
	protected  $sign_key = 'fd794b62b2355ae4df198fadc516e576';     // API帐号
	protected  $api_account = '4957dce0cef2b7f2e7b66566aebb970e';  // KEY密钥
	/**
	 * @var string
	 * 接口地址
	 */
	protected  $register_url = 'http://api.ng-api.com/v1/user/register';    // 创建会员账户
	protected  $login_live_url = 'http://api.ng-api.com/v1/user/login';     // 获取游戏登录地址
	protected  $trans_url = 'http://api.ng-api.com/v1/user/trans';          // 额度转换
	protected  $balance_url = 'http://api.ng-api.com/v1/user/balance';      // 会员游戏平台余额查询
	protected  $all_credit_url = 'http://api.ng-api.com/v1/user/all-credit';// 全部平台余额查询
	protected  $status_url = 'http://api.ng-api.com/v1/user/status';        // 额度转换状态查询
	protected  $collect_url = 'http://api.ng-api.com/v1/user/record';       // 获取游戏记录


	//游戏平台类型 小写
	protected  $plat_type = 'sunbet';

	protected  $game_type_live = '1';     // 真人娱乐
	protected  $game_type_slot = '2';     // 老虎机
	protected  $game_type_lottery = '3';  // 彩票
	protected  $game_type_sports = '4';   // 体育
	protected  $game_type_esports = '5';  // 电竞
	protected  $game_type_fishing = '6';  // 捕鱼
	protected  $game_type_poker = '7';    // 棋牌


	/**
	 * @param $username
	 * @return mixed
	 * 注册
	 */
	public function register($username){
		$code = md5($this->sign_key.$this->api_account.$this->plat_type.$username);
		$data = array(
			"username"=>$username,
			"plat_type"=>$this->plat_type,
			"sign_key"=>$this->sign_key,
			"code"=>$code
		);
		$res = $this->sendRequest($this->register_url, $data);
		return $res;
	}

	/**
	 * @param $username
	 * @param int $isMobileUrl
	 * @param string $gameCode
	 * @return mixed
	 * 获取游戏登录地址
	 */
	public function login($username,$isMobileUrl=0,$gameCode=""){
		$code = md5($this->sign_key.$this->api_account.$username.$this->plat_type.$isMobileUrl);
		$data = array(
			"username"=>$username,
			"plat_type"=>$this->plat_type,
			"game_type"=>$this->game_type_live,
			"game_code"=>$gameCode,
			"sign_key"=>$this->sign_key,
			"is_mobile_url"=>$isMobileUrl,
			"code"=>$code
		);
		//var_dump($data);
		$res = $this->sendRequest($this->login_live_url, $data);
		return $res;
	}

	/**
	 * @param $username
	 * @param $money
	 * @param $client_transfer_id
	 * @return mixed
	 * 额度转换
	 */
	public function trans($username,$money,$client_transfer_id){
		$code = md5($this->sign_key.$this->api_account.$username.$this->plat_type.$money.$client_transfer_id);
		$data = array(
			"username"=>$username,
			"plat_type"=>$this->plat_type,
			"money"=>$money,
			"client_transfer_id"=>$client_transfer_id,
			"sign_key"=>$this->sign_key,
			"code"=>$code
		);

		$res = $this->sendRequest($this->trans_url, $data);
		return $res;
	}



	/**
	 * @param $username
	 * @param $client_transfer_id
	 * @return mixed
	 * 查询转账状态
	 */
	public function status($username,$client_transfer_id){
		$code = md5($this->sign_key.$this->api_account.$username.$this->plat_type.$client_transfer_id);
		$data = array(
			"username"=>$username,
			"client_transfer_id"=>$client_transfer_id,
			"plat_type"=>$this->plat_type,
			"sign_key"=>$this->sign_key,
			"code"=>$code
		);
		$res = $this->sendRequest($this->status_url, $data);
		return $res;
	}

	/**
	 * @param $username
	 * @return mixed
	 * 获取用户余额
	 */
	public function balance($username){
		$code = md5($this->sign_key.$this->api_account.$username.$this->plat_type);
		$data = array(
			"username"=>$username,
			"plat_type"=>$this->plat_type,
			"sign_key"=>$this->sign_key,
			"code"=>$code
		);
		$res = $this->sendRequest($this->balance_url, $data);
		return $res;
	}

	/**
	 * @return mixed
	 * 获取全部平台额度
	 */
	public function credit(){
		$code = md5($this->sign_key.$this->api_account);
		$data = array(
			"sign_key"=>$this->sign_key,
			"code"=>$code
		);
		$res = $this->sendRequest($this->all_credit_url, $data);
		return $res;
	}

	/**
	 * @param $startTime
	 * @param $endTime
	 * @param int $page
	 * @param int $limit
	 * @return mixed
	 * 获取下注记录
	 */
	public function record($startTime,$endTime,$page=1,$limit=15){
		$code = md5($this->sign_key.$this->api_account.$this->plat_type.$startTime.$endTime);
		$data = array(
			"plat_type"=>$this->plat_type,
			"page"=>$page,
			"limit"=>$limit,
			"startTime"=>$startTime,
			"endTime"=>$endTime,
			"game_type"=>$this->game_type_slot,
			"sign_key"=>$this->sign_key,
			"code"=>$code
		);
		$res = $this->sendRequest($this->collect_url, $data);
		return $res;
	}

	private function sendRequest($url,$post_data=array()){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$contents = curl_exec($ch);
		curl_close($ch);
		return json_decode ($contents, TRUE);
	}

}
?>