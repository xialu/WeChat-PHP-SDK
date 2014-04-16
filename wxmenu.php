<?php 
//定义接口凭证，需要到微信公众平台获取
define("APPID","**********");
define("APPSECRET","*********");
class Wxmenu {
  //获取操作的token
	public function access_token(){
		$ch = curl_init("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
		$output = curl_exec($ch);
		$wxarray = json_decode($output,true);
		return $wxarray["access_token"];
	}
	
	//创建菜单
	public function create_menu(){
		$key = $this->access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$key;
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
					"type":"view",
					"name":"旅途分享",
					"url":"http://v.qq.com/"
				},{
					"type":"click",
					"name":"订酒店",
					"key":"V1001_GOOD"
				},{
					"type":"click",
					"name":"订交通",
					"key":"V1001_GOOD"
				},{
					"type":"click",
					"name":"订门票",
					"key":"V1001_GOOD"
				}]
			},{
				"name":"精品推荐",
				"sub_button":[{
					"type":"view",
					"name":"游玩线路",
					"url":"http://www.soso.com/"
				},{
					"type":"view",
					"name":"游玩分享",
					"url":"http://v.qq.com/"
				},{
					"type":"click",
					"name":"订酒店",
					"key":"V1001_GOOD"
				},{
					"type":"click",
					"name":"订交通",
					"key":"V1001_GOOD"
				},{
					"type":"click",
					"name":"订门票",
					"key":"V1001_GOOD"
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
//调用执行
$wxmenu = new Wxmenu();
$wxmenu->create_menu();
