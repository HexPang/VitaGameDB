<?php

$regions = include 'regions.php';
function loadSourceOfPage($page = 1, $region = 'us')
{
    $regions = include 'regions.php';
    $offset = $page * 30 - 30;
    //Change url to your region.
    $PSSURL = $regions[$region];
    $URL = str_replace('{offset}', $offset, $PSSURL);
    $json = file_get_contents($URL);

    return json_decode($json, true);
}
function LogInfo($msg)
{
    echo "[LOG] {$msg}\r\n";
}

foreach ($regions as $region => $url) {
    $db_dir = $region.'/';
    @mkdir($db_dir);
    $i = 1;
    $done = false;
    while (!$done) {
        LogInfo("Loading {$region} {$i}");
        $gameList = loadSourceOfPage($i, $region);
        if (isset($gameList['links']) && count($gameList['links']) > 0) {
            foreach ($gameList['links'] as $k => $v) {
                $id = $v['id'];
                $file_name = "{$db_dir}/{$id}.json";
                if (!file_exists($file_name)) {
                    LogInfo($id);
                    file_put_contents($file_name, json_encode($v));
                }
            }
            ++$i;
        } else {
            $done = true;
        }
    }
}
