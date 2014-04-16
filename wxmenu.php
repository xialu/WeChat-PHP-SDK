<?php 
//定义微信接口凭证appid,appsecret，请到公众平台获取
define("APPID","wx**********");
define("APPSECRET","************************");
class Wxmenu {
	//根据凭证获取access_token
	public function access_token(){
		$ch = curl_init("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
		$output = curl_exec($ch);
		$wxarray = json_decode($output,true);
		return $wxarray["access_token"];
	}
	
	//认证之后创建菜单
	public function create_menu(){
		$key = $this->access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$key;
		/*
		$menu是一个json文件
		菜单最多支持三个顶级和每个五个二级
		菜单有两种：跳转菜单、按钮菜单。
		*/
		$menu = '{
			"button":[{
				"type":"click",
				"name":"结伴游",
				"key":"jiebanyou"
			},{
				"name":"游攻略",
				"sub_button":[{
					"type":"view",
					"name":"游玩线路",
					"url":"http://find.aliapp.com/Resume/"
				},{
					"type":"click",
					"name":"旅途分享",
					"key":"fenxiang"
				},{
					"type":"click",
					"name":"订酒店",
					"key":"jiudian"
				},{
					"type":"click",
					"name":"订交通",
					"key":"jiaotong"
				},{
					"type":"click",
					"name":"订门票",
					"key":"menpiao"
				}]
			},{
				"name":"精品推荐",
				"sub_button":[{
					"type":"view",
					"name":"游玩线路",
					"url":"http://find.aliapp.com/Resume/"
				},{
					"type":"view",
					"name":"游玩分享",
					"url":"http://find.aliapp.com/Resume/"
				}]
			}]
		}';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $menu);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

		$info = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Errno'.curl_error($ch);
		}

		curl_close($ch);

		var_dump($info);
	}
}
//调用并执行
$wxmenu = new Wxmenu();
$wxmenu->create_menu();
