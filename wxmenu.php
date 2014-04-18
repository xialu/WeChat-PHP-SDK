<?php 
define("APPID","wx**********");
define("APPSECRET","********************");
class Wxmenu {
	public function access_token(){
		$ch = curl_init("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
		$output = curl_exec($ch);
		$wxarray = json_decode($output,true);
		return $wxarray["access_token"];
	}
	
	public function create_menu(){
		$key = $this->access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$key;
		$menu = '{
			"button":[{
				"name":"生活助手",
				"sub_button":[{
					"type":"click",
					"name":"天气查询",
					"key":"tianqi"
				},{
					"type":"click",
					"name":"快递查询",
					"key":"kuaidi"
				},{
					"type":"click",
					"name":"单词翻译",
					"key":"fanyi"
				}]
			},{
				"name":"找点乐子",
				"sub_button":[{
					"type":"click",
					"name":"随机听歌",
					"key":"tingge"
				},{
					"type":"click",
					"name":"搜索听歌",
					"key":"souge"
				},{
					"type":"click",
					"name":"微信笑话",
					"key":"xiaohua"
				}]
			},{
				"name":"精品推荐",
				"sub_button":[{
					"type":"view",
					"name":"作者",
					"url":"http://find.aliapp.com/Resume/"
				},{
					"type":"view",
					"name":"糗事百科",
					"url":"http://m.qiushibaike.com/"
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
$wxmenu = new Wxmenu();
$wxmenu->create_menu();
