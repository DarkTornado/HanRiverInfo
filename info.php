<?php
header('Content-Type: application/json; charset=utf-8');

$key = "안알랴줌";
$url = "http://openapi.seoul.go.kr:8088/".$key."/json/WPOSInformationTime/1/5/";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$data = $data['WPOSInformationTime']['row'];

$index = -1;
for ($n = 0; $n < count($data); $n++) {
    if ($data[$n]['SITE_ID'] == "노량진") {
        $index = $n;
        break;
    }
}

if ($index==-1) {
    $data = $data[0];
} else {
    $data = $data[$index];
}

echo '{';
echo '"loc":"'.$data['SITE_ID'].'",';
echo '"date":"'.$data['MSR_DATE'].'",';
echo '"time":"'.$data['MSR_TIME'].'",';
echo '"temp":"'.$data['W_TEMP'].'℃",';
echo '"ph":"pH'.$data['W_PH'].'",';
echo '"o2":"'.$data['W_DO'].'"';
echo '}';

?>
