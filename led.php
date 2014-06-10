<?php
//disable all caching since this GET is NOT idempotent(it changes stuff and shouldn't be cached)
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "php_serial.class.php";
$serial = new phpSerial;
$serial->deviceSet("/dev/ttyUSB0");
$serial->confBaudRate(1000000);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->deviceOpen();
$serial->sendMessage("gabe".str_pad(base64_decode($_GET["a"]),300,"\0"));
$serial->deviceClose();
?>
