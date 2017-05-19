<?php
namespace sugao2013\getui\igetui;
use sugao2013\getui\protobuf\PBMessage;
class StartOSBatchTask extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "\\sugao2013\\getui\\igetui\\OSMessage";
    $this->values["1"] = "";
    $this->fields["2"] = "\\sugao2013\\getui\\protobuf\\type\\PBInt";
    $this->values["2"] = "";
  }
  function message()
  {
    return $this->_get_value("1");
  }
  function set_message($value)
  {
    return $this->_set_value("1", $value);
  }
  function expire()
  {
    return $this->_get_value("2");
  }
  function set_expire($value)
  {
    return $this->_set_value("2", $value);
  }
}

