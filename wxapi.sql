--历史消息表
CREATE TABLE  `app_xialu`.`wx_history` (
`Id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT  '主键',
`ToUserName` VARCHAR( 32 ) NOT NULL COMMENT  '公众账号',
`FromUserName` VARCHAR( 32 ) NOT NULL COMMENT  '用户OPENID',
`CreateTime` INT( 10 ) NOT NULL COMMENT  '时间',
`MsgType` VARCHAR( 16 ) NOT NULL COMMENT  '消息类型',
`MsgId` varchar( 64 ) NOT NULL COMMENT  '消息ID',
`Content` VARCHAR( 255 ) COMMENT  '文本消息内容',
`PicUrl` VARCHAR( 255 ) COMMENT  '图片消息地址',
`Location_X` VARCHAR( 32 ) COMMENT  '经度',
`Location_Y` VARCHAR( 32 ) COMMENT  '纬度',
`Scale` tinyint( 3 ) COMMENT  '缩放比例',
`Label` VARCHAR( 255 ) COMMENT  '地址信息',
`Title` VARCHAR( 255 ) COMMENT  '标题',
`Description` VARCHAR( 255 ) COMMENT  '描述',
`Url` VARCHAR( 255 ) COMMENT  '网址',
`Event` VARCHAR( 255 ) COMMENT  '事件',
`EventKey` VARCHAR( 255 ) COMMENT  'key',
`Ticket` VARCHAR( 255 ) COMMENT  '凭证',
`Latitude` VARCHAR( 32 ) COMMENT  '纬度',
`Longitude` VARCHAR( 32 ) COMMENT  '经度',
`Precision` VARCHAR( 255 ) COMMENT  '精确地点',
`Format` VARCHAR( 16 ) COMMENT  '语音识别格式',
`Recognition` VARCHAR( 255 ) COMMENT  '识别内容',
`MediaId` VARCHAR( 64 ) COMMENT  '媒体ID',
`ThumbMediaId` VARCHAR( 64 ) COMMENT  '缩略图ID',
`Flag` TINYINT( 1 ) NOT NULL default 0 COMMENT  '标志'
) ENGINE = MYISAM ;
