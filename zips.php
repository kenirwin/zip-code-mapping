<?
header("Content-type: text/plain");
require ("GeoJsonCollect.class.php");
$coll = new GeoJsonCollect();

$zips = ['43215','45504','45406'];
$codes = array();
try{ 
foreach ($zips as $zip) {
  $code = GeocodeZip($zip);
  $code['name']=$zip;
  $temp = $coll->createPoint($code, 0,0);
  $coll->addFeature($temp);

  //var_dump($code);
}
print($coll->getJson());
} catch (Exception $e) {
  var_dump($e);
}



function GeocodeZip($zip) {
  $str = `egrep '^$zip,' geocodedZips.txt`;
  $str = chop($str);
  $arr = preg_split('/, */',$str);
  $lat = $arr[1];
  $lng = $arr[2];
  //$code = $lat.','.$lng;
  $code = array('lat'=>$lat,'long'=>$lng);
  return $code;
}

?>