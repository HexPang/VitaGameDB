<?php

require_once 'vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';

//US https://store.playstation.com/chihiro-api/viewfinder/US/en/999/STORE-MSF77008-PSVITAALLGAMES?platform=vita&game_content_type=games&size=30&gkb=1&geoCountry=RU&start={offset}
//HK https://store.playstation.com/chihiro-api/viewfinder/HK/ch/999/STORE-MSF86012-GAMESALL?game_content_type=games&platform=vita&size=30&gkb=1&geoCountry=RU&facets=release_date%3Acoming_soon%2Crelease_date%3Alast_7_days%2Crelease_date%3Alast_30_days%2Cgame_content_type%3Agames%2Cgame_content_type%3Abundles%2Cgame_content_type%3Aaddons%2Cgame_content_type%3Asubscriptions%2Cgame_content_type%3Aonline_passes%2Cgame_content_type%3Ademos%2Cgame_content_type%3Abetas%2Cgame_content_type%3Atimed_trials%2Cgame_content_type%3Aapps%2Cgame_content_type%3Athemes%2Cgame_content_type%3Aavatars%2Cgame_content_type%3Aother_extras%2Cgenre%2Cplatform%3Aps4%2Cplatform%3Aps3%2Cplatform%3Apsp%2Cplatform%3Avita%2Cgame_demo%2Cprice%3A0-0%2Cprice%3A*-199%2Cprice%3A200-499%2Cprice%3A500-999%2Cprice%3A1000-1999%2Cprice%3A2000-*%2Caccessories%3A3d%2Caccessories%3Adrum_kit%2Caccessories%3Aguitar%2Caccessories%3Amicrophone%2Caccessories%3Aplaystation_eye%2Caccessories%3Aplaystation_move%2Caccessories%3Aracing_wheel%2Cplay_type%3Aonline%2Cplay_type%3Asingle_player%2Cplay_type%3Avoice_chat_support%2Cplay_type%3Amultiplayer&start={offset}
//JP T_____T i Don't understand japanese!!!!!!

function loadSourceOfPage($page = 1)
{
    $offset = $page * 30 - 30;
    $PSSURL = 'https://store.playstation.com/chihiro-api/viewfinder/US/en/999/STORE-MSF77008-PSVITAALLGAMES?platform=vita&game_content_type=games&size=30&gkb=1&geoCountry=RU&start={offset}';
    $URL = str_replace('{offset}', $offset, $PSSURL);
    $json = file_get_contents($URL);

    return json_decode($json, true);
}
function LogInfo($msg)
{
    echo "[LOG] {$msg}\r\n";
}
//https://store.playstation.com/chihiro-api/viewfinder/HK/ch/999/STORE-MSF86012-GAMESALL?game_content_type=games&platform=vita&size=30&gkb=1&geoCountry=RU&facets=release_date%3Acoming_soon%2Crelease_date%3Alast_7_days%2Crelease_date%3Alast_30_days%2Cgame_content_type%3Agames%2Cgame_content_type%3Abundles%2Cgame_content_type%3Aaddons%2Cgame_content_type%3Asubscriptions%2Cgame_content_type%3Aonline_passes%2Cgame_content_type%3Ademos%2Cgame_content_type%3Abetas%2Cgame_content_type%3Atimed_trials%2Cgame_content_type%3Aapps%2Cgame_content_type%3Athemes%2Cgame_content_type%3Aavatars%2Cgame_content_type%3Aother_extras%2Cgenre%2Cplatform%3Aps4%2Cplatform%3Aps3%2Cplatform%3Apsp%2Cplatform%3Avita%2Cgame_demo%2Cprice%3A0-0%2Cprice%3A*-199%2Cprice%3A200-499%2Cprice%3A500-999%2Cprice%3A1000-1999%2Cprice%3A2000-*%2Caccessories%3A3d%2Caccessories%3Adrum_kit%2Caccessories%3Aguitar%2Caccessories%3Amicrophone%2Caccessories%3Aplaystation_eye%2Caccessories%3Aplaystation_move%2Caccessories%3Aracing_wheel%2Cplay_type%3Aonline%2Cplay_type%3Asingle_player%2Cplay_type%3Avoice_chat_support%2Cplay_type%3Amultiplayer&start=30
//curl 'https://store.playstation.com/chihiro-api/viewfinder/HK/ch/999/STORE-MSF86012-GAMESALL?game_content_type=games&platform=vita&size=30&gkb=1&geoCountry=RU' -H 'Cookie: MANIFESTUID=978ce87e-a032-44d6-abb2-f8a654c9ced8; AWSELB=37E9B7F1049373D4CCD502F0B8F712DF66BD8117F8972CC74E1957B91FF87D1BCFC2DBEC40C83BDBA0E8EB72E82512267855CF97F91168759F0065B2EC2C45BC45144660EE; JSESSIONID=F3FFE9F2125EC4161F07B67AD40B4F3F-n1; __utmt=1; __utma=228732126.1315797876.1462416216.1464842480.1473069113.5; __utmb=228732126.2.10.1473069113; __utmc=228732126; __utmz=228732126.1462416216.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)' -H 'Accept-Encoding: gzip, deflate, sdch, br' -H 'Accept-Language: zh-CN,zh;q=0.8,en;q=0.6,zh-TW;q=0.4,ja;q=0.2' -H 'X-Requested-By: Chihiro-PSStore' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36' -H 'Accept: application/json, text/javascript, */*; q=0.01' -H 'Referer: https://store.playstation.com/' -H 'X-Requested-With: XMLHttpRequest' -H 'Connection: keep-alive' --compressed
$db_dir = 'us/';
@mkdir($db_dir);
for ($i = 1;$i < 90;++$i) {
    LogInfo("Loading {$i}");
    $gameList = loadSourceOfPage($i);
    if (isset($gameList['links'])) {
        foreach ($gameList['links'] as $k => $v) {
            $id = $v['id'];
            $file_name = "{$db_dir}/{$id}.json";
            if (!file_exists($file_name)) {
                LogInfo($id);
                file_put_contents($file_name, json_encode($v));
            }
        }
    } else {
        exit("Nothing...\r\n");
    }
}
