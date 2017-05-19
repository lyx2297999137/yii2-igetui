<?php
/**
 * 模板使用类
 */
namespace sugao2013\getui;
use sugao2013\getui\igetui\template\IGtNotyPopLoadTemplate;
use sugao2013\getui\igetui\template\IGtTransmissionTemplate;
use sugao2013\getui\igetui\template\IGtLinkTemplate;

use sugao2013\getui\igetui\IGtAPNPayload;
use sugao2013\getui\igetui\DictionaryAlertMsg;
class Template{
        /**
     * @var string 个推后台应用的AppID
     */
     public $appId = '';

    /**
     * @var string 个推后台应用的MasterSecret
     */
    public $appKey = '';
    public function __construct($appId,$appKey){
        $this->appId=$appId;
        $this->appKey=$appKey;
    }
    public function test(){
        d($this->appId);
    }
        //所有推送接口均支持四个消息模板，依次为通知弹框下载模板，通知链接模板，通知透传模板，透传模板
//注：IOS离线推送需通过APN进行转发，需填写pushInfo字段，目前仅不支持通知弹框下载功能
    public  function IGtNotyPopLoadTemplateDemo() {
        $template = new IGtNotyPopLoadTemplate();
//        $template->set_appId($this->appId);                      //应用appid
//        $template->set_appkey($this->appKey);                    //应用appkey
        $template->set_appId($this->appId);                      //应用appid
        $template->set_appkey($this->appKey);                    //应用appkey
        //通知栏
        $template->set_notyTitle("个推");                 //通知栏标题
        $template->set_notyContent("个推最新版点击下载"); //通知栏内容
        $template->set_notyIcon("");                      //通知栏logo
        $template->set_isBelled(true);                    //是否响铃
        $template->set_isVibrationed(true);               //是否震动
        $template->set_isCleared(true);                   //通知栏是否可清除
        //弹框
        $template->set_popTitle("弹框标题");              //弹框标题
        $template->set_popContent("弹框内容");            //弹框内容
        $template->set_popImage("");                      //弹框图片
        $template->set_popButton1("下载");                //左键
        $template->set_popButton2("取消");                //右键
        //下载
        $template->set_loadIcon("");                      //弹框图片
        $template->set_loadTitle("地震速报下载");
        $template->set_loadUrl("http://dizhensubao.igexin.com/dl/com.ceic.apk");
        $template->set_isAutoInstall(false);
        $template->set_isActived(true);

        //设置通知定时展示时间，结束时间与开始时间相差需大于6分钟，消息推送后，客户端将在指定时间差内展示消息（误差6分钟）
//        $begin = "2015-02-28 15:26:22";
//        $end = "2015-02-28 15:31:24";
//        $template->set_duration($begin, $end); //设置ANDROID客户端在此时间区间内展示消息
        return $template;
    }
    
    //多推
    function IGtLinkTemplateDemo(){
        $template =  new IGtLinkTemplate();
        $template ->set_appId($this->appId);                  //应用appid
        $template ->set_appkey($this->appKey);                //应用appkey
        $template ->set_title("请输入通知标题");       //通知栏标题
        $template ->set_text("请输入通知内容");        //通知栏内容
        $template->set_logo("");                       //通知栏logo
        $template->set_logoURL("");                    //通知栏logo链接
        $template ->set_isRing(true);                  //是否响铃
        $template ->set_isVibrate(true);               //是否震动
        $template ->set_isClearable(true);             //通知栏是否可清除
        $template ->set_url("http://www.igetui.com/"); //打开连接地址
        //设置通知定时展示时间，结束时间与开始时间相差需大于6分钟，消息推送后，客户端将在指定时间差内展示消息（误差6分钟）
//        $begin = "2015-02-28 15:26:22";
//        $end = "2015-02-28 15:31:24";
//        $template->set_duration($begin,$end);

        // iOS推送需要设置的pushInfo字段(老方法不再介意使用)
        //$template ->set_pushInfo($actionLocKey,$badge,$message,$sound,$payload,$locKey,$locArgs,$launchImage);
        //$template ->set_pushInfo("",2,"","","","","","");
         //iOS推送需要设置的pushInfo字段(推荐使用)
//        $apn = new IGtAPNPayload();
//        $apn->alertMsg = "alertMsg";
//        $apn->badge = 11;
//        $apn->actionLocKey = "启动";
//        $apn->category = "ACTIONABLE";
//        $apn->contentAvailable = 1;
//        $apn->locKey = "通知栏内容";
//        $apn->title = "通知栏标题";
//        $apn->titleLocArgs = array("titleLocArgs");
//        $apn->titleLocKey = "通知栏标题";
//        $apn->body = "body";
//        $apn->customMsg = array("payload"=>"payload");
//        $apn->launchImage = "launchImage";
//        $apn->locArgs = array("locArgs");
//
//        $apn->sound=("test1.wav");;
//        $template->set_apnInfo($apn);
        return $template;
}
    
    public  function IGtTransmissionTemplateDemo(){
    $template =  new IGtTransmissionTemplate();
    $template->set_appId($this->appId);//应用appid
    $template->set_appkey($this->appKey);//应用appkey
    $template->set_transmissionType(1);//透传消息类型
    $template->set_transmissionContent("测试离线ddd");//透传内容
    //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
    //APN简单推送
//        $template = new IGtAPNTemplate();
//        $apn = new IGtAPNPayload();
//        $alertmsg=new SimpleAlertMsg();
//        $alertmsg->alertMsg="";
//        $apn->alertMsg=$alertmsg;
////        $apn->badge=2;
////        $apn->sound="";
//        $apn->add_customMsg("payload","payload");
//        $apn->contentAvailable=1;
//        $apn->category="ACTIONABLE";
//        $template->set_apnInfo($apn);
//        $message = new IGtSingleMessage();

    //APN高级推送
    $apn = new IGtAPNPayload();
    $alertmsg=new DictionaryAlertMsg();
    $alertmsg->body="body";
    $alertmsg->actionLocKey="ActionLockey";
    $alertmsg->locKey="LocKey";
    $alertmsg->locArgs=array("locargs");
    $alertmsg->launchImage="launchimage";
//        IOS8.2 支持
    $alertmsg->title="Title";
    $alertmsg->titleLocKey="TitleLocKey";
    $alertmsg->titleLocArgs=array("TitleLocArg");

    $apn->alertMsg=$alertmsg;
    $apn->badge=7;
    $apn->sound="";
    $apn->add_customMsg("payload","payload");
    $apn->contentAvailable=1;
    $apn->category="ACTIONABLE";
    $template->set_apnInfo($apn);

    return $template;
}
}

