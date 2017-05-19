<?php
namespace sugao2013\getui\igetui;
use sugao2013\getui\protobuf\PBMessage;
class SingleBatchRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "\\sugao2013\\getui\\protobuf\\type\\PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "\\sugao2013\\getui\\igetui\\SingleBatchItem";
    $this->values["2"] = array();
  }
  function batchId()
  {
    return $this->_get_value("1");
  }
  function set_batchId($value)
  {
    return $this->_set_value("1", $value);
  }
  function batchItem($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_batchItem()
  {
    return $this->_add_arr_value("2");
  }
  function set_batchItem($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_batchItem()
  {
    $this->_remove_last_arr_value("2");
  }
  function batchItem_size()
  {
    return $this->_get_arr_size("2");
  }
}

