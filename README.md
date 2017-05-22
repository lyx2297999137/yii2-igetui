yii2-igetui
===
yii2个推
---
**配置：**

    'components' => [
    'getui'=>[
    'class'=>'sugao2013\getui\Push',
    'appId' => 'Utt9VAqlZw9LrrDUfNGPc3', //你的APPID
    'appKey' => 'f1m9HzIL6D9gTXAkHsvuw2', //你的APPKEY  //   Lw2ycZlZtU9tLKzmafi1I6
    'masterSecret' => 'UZJ3xFDr4l7FtkMfeQKiP8', //你的masterSecret
    'host' => 'http://sdk.open.api.igexin.com/apiex.htm',
    ],

**使用时配置参数template_type说明：**
    
    所有推送接口均支持四个消息模板，依次为通知弹框下载模板，通知链接模板，通知透传模板，透传模板
    注：IOS离线推送需通过APN进行转发，需填写pushInfo字段，目前仅不支持通知弹框下载功能
    1.点击通知打开应用模板  ====>IGtNotificationTemplateDemo()
    2.点击通知打开网页模板  ====>IGtLinkTemplateDemo()
    3.点击通知弹窗下载模板  ====>IGtNotyPopLoadTemplateDemo()
    4.透传消息模版    =====>IGtTransmissionTemplateDemo()

### 1. 对单个用户推送消息：pushMessageToSingle()

    $config=[
      'title'=>'title',
      'text'=>'text',
      'url'=>'http://www.baidu.com',
      'template_type'=>2
      ]; 
      $cid='f0d2b92075a0f86e09d049b0d096322b'; 
      Yii::$app->getui->config($config)->pushMessageToSingle($cid);

### 2. 对指定列表用户推送消息pushMessageToList()
       
    $config=[
       'title'=>'title',
       'text'=>'text',
       'url'=>'http://www.baidu.com',
       'template_type'=>2
       ];
    $cids=['f0d2b92075a0f86e09d049b0d096322b','f0d2b92075a0f86e09d049b0d096322b'];
    Yii::$app->getui->config($config)->pushMessageToSingle($cids);

### 3. 对指定应用群推消息&&应用群推条件交并补功能pushMessageToApp()

      手机类型 "phoneType"=>array('ANDROID')
      地区   "region"=>array('浙江')
      自定义tag "tag"=>array('haha')
      'age'=>array("0000", "0010")
      上面情况一个以及一个以上就可以了。
      用法示例：
      $config=[
      'title'=>'title',
      'text'=>'text',
      'url'=>'http://www.baidu.com',
      'template_type'=>2
      ];
      $conditions=[
      ['name'=>'phoneType','value'=>array('ANDROID'),'opt'=>'or'],
      ['name'=>'region','value'=>array('浙江','福建'),'opt'=>'and'],
      ['name'=>'tag','value'=>array('haha'),'opt'=>'not']
      ];
      Yii::$app->getui->config($config)->pushMessageToApp($conditions);

### 4. 批量单推功能pushMessageToSingleBatch()

    $configs[0]=[
       'title'=>'title',
       'text'=>'text',
       'url'=>'http://www.baidu.com',
       'template_type'=>2,
       'cid'=>'f0d2b92075a0f86e09d049b0d096322b'>
       ];
       $configs[1]=[
       'notyTitle'=>'notyTitle',
       'notyContent'=>'notyContent',
       'popTitle'=>'popTitle',
       'popContent'=>'popContent',
       'template_type'=>3,
       'cid'=>'f0d2b92075a0f86e09d049b0d096322b'
       ];
       用法
    Yii::$app->getui->pushMessageToSingleBatch($configs);

