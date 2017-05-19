<?php
namespace sugao2013\getui\igetui;
use sugao2013\getui\protobuf\PBMessage;
class PushInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["9"] = "";
    $this->fields["10"] = "\\sugao2013\\getui\\protobuf\\type\\PBInt";
    $this->values["10"] = "";
    $this->fields["11"] = "\\sugao2013\\getui\\protobuf\\type\\PBBool";
    $this->values["11"] = "";
    $this->fields["12"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["12"] = "";
    $this->fields["13"] = "\\sugao2013\\getui\\protobuf\\type\\PBBool";
    $this->values["13"] = "";
    $this->fields["14"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["14"] = "";
  }
  function message()
  {
    return $this->_get_value("1");
  }
  function set_message($value)
  {
    return $this->_set_value("1", $value);
  }
  function actionKey()
  {
    return $this->_get_value("2");
  }
  function set_actionKey($value)
  {
    return $this->_set_value("2", $value);
  }
  function sound()
  {
    return $this->_get_value("3");
  }
  function set_sound($value)
  {
    return $this->_set_value("3", $value);
  }
  function badge()
  {
    return $this->_get_value("4");
  }
  function set_badge($value)
  {
    return $this->_set_value("4", $value);
  }
  function payload()
  {
    return $this->_get_value("5");
  }
  function set_payload($value)
  {
    return $this->_set_value("5", $value);
  }
  function locKey()
  {
    return $this->_get_value("6");
  }
  function set_locKey($value)
  {
    return $this->_set_value("6", $value);
  }
  function locArgs()
  {
    return $this->_get_value("7");
  }
  function set_locArgs($value)
  {
    return $this->_set_value("7", $value);
  }
  function actionLocKey()
  {
    return $this->_get_value("8");
  }
  function set_actionLocKey($value)
  {
    return $this->_set_value("8", $value);
  }
  function launchImage()
  {
    return $this->_get_value("9");
  }
  function set_launchImage($value)
  {
    return $this->_set_value("9", $value);
  }
  function contentAvailable()
  {
    return $this->_get_value("10");
  }
  function set_contentAvailable($value)
  {
    return $this->_set_value("10", $value);
  }
  function invalidAPN()
  {
    return $this->_get_value("11");
  }
  function set_invalidAPN($value)
  {
    return $this->_set_value("11", $value);
  }
  function apnJson()
  {
    return $this->_get_value("12");
  }
  function set_apnJson($value)
  {
    return $this->_set_value("12", $value);
  }
  function invalidMPN()
  {
    return $this->_get_value("13");
  }
  function set_invalidMPN($value)
  {
    return $this->_set_value("13", $value);
  }
  function mpnXml()
  {
    return $this->_get_value("14");
  }
  function set_mpnXml($value)
  {
    return $this->_set_value("14", $value);
  }
}
