<?php

namespace sugao2013\getui;

use sugao2013\getui\igetui\IGtSingleMessage;
use sugao2013\getui\igetui\IGtTarget;
use sugao2013\getui\igetui\IGtListMessage;
use yii\base\Component;

/**
  信息：
  2017年5月18日16:34:06
 */
/**
  配置：
  //'components' => [
  'getui'=>[
  'class'=>'sugao2013\getui\Test',
  'appId' => 'Utt9VAqlZw9LrrDUfNGPc3', //你的APPID
  'appKey' => 'f1m9HzIL6D9gTXAkHsvuw2', //你的APPKEY  //   Lw2ycZlZtU9tLKzmafi1I6
  'masterSecret' => 'UZJ3xFDr4l7FtkMfeQKiP8', //你的masterSecret
  'host' => 'http://sdk.open.api.igexin.com/apiex.htm',
  ],
 */
/**

  使用例子： Yii::$app->getui->pushMessageToSingle();
  单推接口案例：pushMessageToSingle()
 */

/**
  个推 psr4规范，适合于yii
  文档：http://docs.getui.com/server/php/start/
  skd和文档下载：http://docs.getui.com/
  转换方法规范：
  1，每个文件都是一个类，文件名和类名一直
  2，加上命名空间namespace sugao2013/getui 如果有文件名abc就变成 namespace sugao2013/getui/abc
  3，凡是有用到的类，加上use xxx，因为文件都是自动include的，所以可以直接use 参见sugao2013/getui/Loader
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
    public $template_var; //Template类变量

    public function init() {
        
    }

    public function test() {
//        if($this->template){
//            $this->template->test();
//        }
    }

    public function getTemplate() {
        if (!$this->template_var) {
            $this->template_var = new Template($this->appId, $this->appKey);
        }
        return $this->template_var;
    }

    //单推接口案例
    //文档：http://docs.getui.com/server/php/push/#1
    function pushMessageToSingle() {
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        //消息模版：
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板
        $template = $this->template->IGtNotyPopLoadTemplateDemo();
        //定义"SingleMessage"
        $message = new IGtSingleMessage();
        $message->set_isOffline(true); //是否离线
        $message->set_offlineExpireTime(3600 * 12 * 1000); //离线时间
        $message->set_data($template); //设置推送消息类型
        //$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，2为4G/3G/2G，1为wifi推送，0为不限制推送
        //接收方
        $target = new IGtTarget();
        $target->set_appId($this->appId);
        $target->set_clientId('f0d2b92075a0f86e09d049b0d096322b');   //warn
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

    //多推接口案例
    function pushMessageToList() {
        putenv("gexin_pushList_needDetails=true");
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        //$igt = new IGeTui('',APPKEY,MASTERSECRET);//此方式可通过获取服务端地址列表判断最快域名后进行消息推送，每10分钟检查一次最快域名
        //消息模版：
        // LinkTemplate:通知打开链接功能模板
        $template = $this->template->IGtLinkTemplateDemo();

        //定义"ListMessage"信息体
        $message = new IGtListMessage();
        $message->set_isOffline(true); //是否离线
        $message->set_offlineExpireTime(3600 * 12 * 1000); //离线时间
        $message->set_data($template); //设置推送消息类型
        $message->set_PushNetWorkType(1); //设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
        $contentId = $igt->getContentId($message);
        //接收方1  
        $target1 = new IGtTarget();
        $target1->set_appId($this->appId);
        $target1->set_clientId('f0d2b92075a0f86e09d049b0d096322b');
        //$target1->set_alias(Alias1);
        //接收方2
//        $target2 = new IGtTarget();
//        $target2->set_appId(APPID);
//        $target2->set_clientId(CID2);
        //$target2->set_alias(Alias2);


        $targetList[0] = $target1;
//        $targetList[1] = $target2;

        $rep = $igt->pushMessageToList($contentId, $targetList);
        d($rep);
    }

    //多推接口案例
    function pushMessageToList1111111111() {
        putenv("gexin_pushList_needDetails=true");
        putenv("gexin_pushList_needAsync=true");

        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        //消息模版：
        // 1.TransmissionTemplate:透传功能模板
        // 2.LinkTemplate:通知打开链接功能模板
        // 3.NotificationTemplate：通知透传功能模板
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板
        //$template = IGtNotyPopLoadTemplateDemo();
        //$template = IGtLinkTemplateDemo();
        //$template = IGtNotificationTemplateDemo();
        $template = $this->template->IGtTransmissionTemplateDemo();
        //个推信息体
        $message = new IGtListMessage();
        $message->set_isOffline(true); //是否离线
        $message->set_offlineExpireTime(3600 * 12 * 1000); //离线时间
        $message->set_data($template); //设置推送消息类型
//    $message->set_PushNetWorkType(1);	//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
//    $contentId = $igt->getContentId($message);
        $contentId = $igt->getContentId($message, "toList任务别名功能"); //根据TaskId设置组名，支持下划线，中文，英文，数字
        //接收方1
        $target1 = new IGtTarget();
        $target1->set_appId($this->appId);
        $target1->set_clientId('f0d2b92075a0f86e09d049b0d096322b');
//    $target1->set_alias(Alias);

        $targetList[] = $target1;

        $rep = $igt->pushMessageToList($contentId, $targetList);

        d($rep);
    }

    function getPushMessageResultDemo() {
        $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
        $ret = $igt->queryAppPushDataByDate($this->appId, "20170518");
        d($ret);
    }

}
