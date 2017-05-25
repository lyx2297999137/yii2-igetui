<?php

namespace sugao2013\getui;

use sugao2013\getui\igetui\IGtSingleMessage;
use sugao2013\getui\igetui\IGtTarget;
use sugao2013\getui\igetui\IGtListMessage;
use sugao2013\getui\igetui\IGtAppMessage;
use sugao2013\getui\igetui\utils\AppConditions;
use yii\base\Component;

/**
  信息：
  2017年5月18日16:34:06
  个推 psr4规范，适合于yii
  文档：http://docs.getui.com/server/php/start/
  skd和文档下载：http://docs.getui.com/
  转换方法规范：
  1，每个文件都是一个类，文件名和类名一直
  2，加上命名空间namespace sugao2013/getui 如果有文件名abc就变成 namespace sugao2013/getui/abc
  3，凡是有用到的类，加上use xxx，因为文件都是自动include的，所以可以直接use 参见sugao2013/getui/Loader
  4，凡是有用到instanceof ,new  ::的就进行命名空间的处理
 */

/**
  配置：
  'components' => [
  'getui'=>[
  'class'=>'sugao2013\getui\Push',
  'appId' => 'Utt9VAqlZw9LrrDUfNGPc3', //你的APPID
  'appKey' => 'f1m9HzIL6D9gTXAkHsvuw2', //你的APPKEY  //   Lw2ycZlZtU9tLKzmafi1I6
  'masterSecret' => 'UZJ3xFDr4l7FtkMfeQKiP8', //你的masterSecret
  'host' => 'http://sdk.open.api.igexin.com/apiex.htm',
  ],
  对单个用户推送消息：pushMessageToSingle()
  对指定列表用户推送消息pushMessageToList()
  批量单推功能pushMessageToSingleBatch()
  对指定应用群推消息&&应用群推条件交并补功能pushMessageToApp()
  对指定用户设置tag属性setTag()
  获取指定用户的tag属性getUserTags()
 */
class Push extends Component {

    /**
     * @var string 个推后台应用的AppKey
     */
    public $appKey = '';

    /**
     * @var string 个推后台应用的AppID
     */
    public $appId = '';

    /**
     * @var string 个推后台应用的MasterSecret
     */
    public $masterSecret = '';

    /**
     * @var string host地址
     */
    public $host = '';
    public $template_obj; //Template类变量
    public $template_var; //Template类变量
    public $config = [];

    /**
     * 
     * @param type $config
      1.点击通知打开应用模板  ====>IGtNotificationTemplateDemo()
      $config=[
      'title'=>'title',
      'text'=>'text',
      'template_type'=>1
      ];
      2.点击通知打开网页模板  ====>IGtLinkTemplateDemo()
      $config=[
      'title'=>'title',
      'text'=>'text',
      'url'=>'http://www.baidu.com',
      'template_type'=>2
      ];
      3.点击通知弹窗下载模板  ====>IGtNotyPopLoadTemplateDemo()
      $config=[
      'notyTitle'=>'notyTitle',
      'notyContent'=>'notyContent',
      'popTitle'=>'popTitle',
      'popContent'=>'popContent',
      'template_type'=>3
      ];
      4.透传消息模版    =====>IGtTransmissionTemplateDemo()
      $config=[
      'content'=>'我传的内容哦',
      'template_type'=>4
      ];
     * @return $this
     */
    public function config($config = []) {
        if (!$this->template_obj) {
            $this->template_obj = new Template($this->appId, $this->appKey);
        }
        $template = ($this->template_obj->template_type()[$config['template_type']]);
        $this->template_var = $this->template_obj->$template($config);
        return $this;
    }

    /**
     * 
     * 对单个用户推送消息
      文档：http://docs.getui.com/server/php/push/#1
     * @param type $cid  用户设备的cid号(装个推app会提供) 比如     $cid="f0d2b92075a0f86e09d049b0d096322b"
      用法示例：
      $config=[
      'title'=>'title',
      'text'=>'text',
      'url'=>'http://www.baidu.com',
      'template_type'=>2
      ];
      $cid="f0d2b92075a0f86e09d049b0d096322b";
      Yii::$app->getui->config($config)->pushMessageToSingle($cid);
     */
    function pushMessageToSingle($cid) {
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        //消息模版：
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板
//        $template = $this->template->IGtNotyPopLoadTemplateDemo();
        $template = $this->template_var;
        //定义"SingleMessage"
        $message = new IGtSingleMessage();
        $message->set_isOffline(true); //是否离线
        $message->set_offlineExpireTime(3600 * 12 * 1000); //离线时间
        $message->set_data($template); //设置推送消息类型
        //$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，2为4G/3G/2G，1为wifi推送，0为不限制推送
        //接收方
        $target = new IGtTarget();
        $target->set_appId($this->appId);
        $target->set_clientId($cid);   //warn
//    $target->set_alias(Alias);
        try {
            $rep = $igt->pushMessageToSingle($message, $target);
            d($rep);
        } catch (RequestException $e) {
            $requstId = e . getRequestId();
            //失败时重发
            $rep = $igt->pushMessageToSingle($message, $target, $requstId);
            d($rep);
        }
    }

    /**
     * 
      对指定列表用户推送消息
      文档：http://docs.getui.com/server/php/push/#2
     * @param type $cids cid的数组   $cids=['f0d2b92075a0f86e09d049b0d096322b','f0d2b92075a0f86e09d049b0d096322b'];
      用法示例：
      $config=[
      'title'=>'title',
      'text'=>'text',
      'url'=>'http://www.baidu.com',
      'template_type'=>2
      ];
      $cids=['f0d2b92075a0f86e09d049b0d096322b','f0d2b92075a0f86e09d049b0d096322b'];
      Yii::$app->getui->config($config)->pushMessageToSingle($cids);
     */
    function pushMessageToList($cids) {
        putenv("gexin_pushList_needDetails=true");
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        $template = $this->template_var;
        //定义"ListMessage"信息体
        $message = new IGtListMessage();
        $message->set_isOffline(true); //是否离线
        $message->set_offlineExpireTime(3600 * 12 * 1000); //离线时间
        $message->set_data($template); //设置推送消息类型
        $message->set_PushNetWorkType(1); //设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
        $contentId = $igt->getContentId($message);
        $targetList = [];
        foreach ($cids as $cid) {
//            $target = $this->setIGtTarget($cid);
            $target = new IGtTarget();
            $target->set_appId($this->appId);
            $target->set_clientId($cid);
            $targetList[] = $target;
        }
        $rep = $igt->pushMessageToList($contentId, $targetList);
        d($rep);
    }

    /**
     * 对指定应用群推消息&&应用群推条件交并补功能
     * @param type $conditions
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
     */
    function pushMessageToApp($conditions) {
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        $template = $this->template_var; //IGtLinkTemplateDemo();
        //个推信息体
        //基于应用消息体
        $message = new IGtAppMessage();
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(10 * 60 * 1000); //离线时间单位为毫秒，例，两个小时离线为3600*1000*2
        $message->set_data($template);

        $appIdList = array($this->appId);
//        $phoneTypeList = array('ANDROID');
//        $provinceList = array('浙江');
//        $tagList = array('haha');
//        $age = array("0000", "0010");


        $cdt = new AppConditions();
        $optType = [
            'or' => 0,
            'and' => 1,
            'not' => 2,
        ];
        foreach ($conditions as $condition) {
            $cdt->addCondition($condition['name'], $condition['value'], $optType[$condition['opt']]);
        }
//         $cdt->addCondition(AppConditions::PHONE_TYPE, $phoneTypeList, OptType::_OR_);
//        $cdt->addCondition(AppConditions::PHONE_TYPE, $phoneTypeList);
//        $cdt->addCondition(AppConditions::REGION, $provinceList);
//        $cdt->addCondition(AppConditions::TAG, $tagList);
//        $cdt->addCondition("age", $age);

        $message->set_appIdList($appIdList);
//        $message->set_conditions($cdt);

        $rep = $igt->pushMessageToApp($message);
        d($rep);
    }

    /**
     * 批量单推功能
     * 文档：http://docs.getui.com/server/php/push/#6
     * @param type $configs
      $configs[0]=[
      'title'=>'title',
      'text'=>'text',
      'url'=>'http://www.baidu.com',
      'template_type'=>2,
      'cid'=>'f0d2b92075a0f86e09d049b0d096322b'
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
     */
    function pushMessageToSingleBatch($configs) {
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        $batch = new IGtBatch($this->appKey, $igt);
        $batch->setApiUrl($this->host);

        foreach ($configs as $config) {
            //个推信息体
            $this->config($config);
            $templateNoti = $this->template_var;
            $messageNoti = new IGtSingleMessage();
            $messageNoti->set_isOffline(true); //是否离线
            $messageNoti->set_offlineExpireTime(12 * 1000 * 3600); //离线时间
            $messageNoti->set_data($templateNoti); //设置推送消息类型
            //$messageNoti->set_PushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
            $targetNoti = new IGtTarget();
            $targetNoti->set_appId($this->appId);
            $targetNoti->set_clientId($config['cid']);
            $batch->add($messageNoti, $targetNoti);
//            $batch->add($this->messageNoti($config), $this->targetNoti($config['cid']));
        }

        //$igt->connect();
        try {
            $rep = $batch->submit();
            d($rep);
        } catch (Exception $e) {
            $rep = $batch->retry();
            d($rep);
        }
    }

    /**
     * 对指定用户设置tag属性
     * @param type $cid
     * @param type $tagList
      用法
      Yii::$app->getui->setTag('f0d2b92075a0f86e09d049b0d096322b’,array('', '中文', 'English'));
     */
    function setTag($cid = '', $tagList = []) {
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        //$tagList = array('', '中文', 'English');
        $rep = $igt->setClientTag($this->appId, $cid, $tagList);
        d($rep);
    }

    /**
     * 获取指定用户的tag属性
     * @param type $cid
      用法：
      Yii::$app->getui->getUserTags('f0d2b92075a0f86e09d049b0d096322b');
     */
    function getUserTags($cid = '') {
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        $rep = $igt->getUserTags($this->appId, $cid);
        //$rep.connect();
        d($rep);
    }

}
