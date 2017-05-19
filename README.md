# yii2-igetui
yii2个推

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
