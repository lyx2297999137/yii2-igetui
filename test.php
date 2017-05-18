<?php
namespace sugao2013\getui;
//define('BASEDIR', dirname(dirname(__DIR__)));
//require_once(dirname(__FILE__) . '/' . 'IGt.Push.php');
//require_once(dirname(__FILE__) . '/vendor/' . 'autoload.php');
//use sugao2013\getui\IGeTui;
class Test{
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
     * @var string HOST地址
     */
    public $host = '';
public function test(){
//    require  __DIR__.'/Loader.php';
//    spl_autoload_register('\\sugao2013\\getui\\Loader::autoload');
//    spl_autoload_register('Loader::autoload');
    echo '111';
//    die;
}
function getPushMessageResultDemo(){
    $igt = new IGeTui($this->host, $this->appKey, $this->masterSecret);
    $ret = $igt->queryAppPushDataByDate($this->appId,"20140807");
    d($ret);
}
}

