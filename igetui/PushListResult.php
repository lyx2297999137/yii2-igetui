<?php
namespace sugao2013\getui\igetui;
use sugao2013\getui\protobuf\PBMessage;
class PushListResult extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "\\sugao2013\\getui\\igetui\\PushResult";
    $this->values["1"] = array();
  }
  function results($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_results()
  {
    return $this->_add_arr_value("1");
  }
  function set_results($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_results()
  {
    $this->_remove_last_arr_value("1");
  }
  function results_size()
  {
    return $this->_get_arr_size("1");
  }
}
