<?php
namespace sugao2013\getui\igetui;
use sugao2013\getui\protobuf\type\PBEnum;
class ServerNotify_NotifyType extends PBEnum
{
  const normal  = 0;
  const serverListChanged  = 1;
  const exception  = 2;
}

