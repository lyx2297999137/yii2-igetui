<?php
namespace sugao2013\getui\igetui;
use sugao2013\getui\protobuf\PBMessage;
class AppStartUp extends PBMessage
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
  }
  function android()
  {
    return $this->_get_value("1");
  }
  function set_android($value)
  {
    return $this->_set_value("1", $value);
  }
  function symbia()
  {
    return $this->_get_value("2");
  }
  function set_symbia($value)
  {
    return $this->_set_value("2", $value);
  }
  function ios()
  {
    return $this->_get_value("3");
  }
  function set_ios($value)
  {
    return $this->_set_value("3", $value);
  }
}

