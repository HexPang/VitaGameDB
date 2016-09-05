<?php
 $db = new PDO('sqlite:db.vita.game.sqlite3');

 $db->exec('CREATE TABLE IF NOT EXISTS games (
                     id TEXT PRIMARY KEY,
                     name TEXT,
                     game_type TEXT,
                     short_name TEXT,
                     image_key TEXT,
                     source_region TEXT,
                     provider_name TEXT,
                     release_date TEXT)');

    $insert = 'INSERT INTO games (id, name, game_type,short_name,image_key,source_region,provider_name,release_date)
                VALUES (:id, :name, :game_type,:short_name,:image_key,:source_region,:provider_name,:release_date)';

    //Change folder here
    $regions = include 'regions.php';
    foreach ($regions as $region => $url) {
        $file_dir = $region.'/';
        $handler = opendir($file_dir);
        $columns = ['id', 'name', 'short_name', 'provider_name', 'release_date'];
        while (($filename = readdir($handler)) !== false) {
            if ($filename != '.' && $filename != '..') {
                $json = file_get_contents($file_dir.$filename);
                $json = json_decode($json, true);
                $id = $json['id'];
                $tmp = explode('/', $json['images'][0]['url']);
                $image_key = explode('.', end($tmp))[0];
                $stmt = $db->prepare('select * from games where id = :id');
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                if (!$stmt->fetchColumn()) {
                    $stmt = $db->prepare($insert);
                    foreach ($columns as $column) {
                        $stmt->bindParam(':'.$column, $json[$column]);
                    }
                    $stmt->bindParam(':game_type', $json['metadata']['game_genre']['values'][0]);
                    $stmt->bindParam(':image_key', $image_key);
                    $stmt->bindParam(':source_region', $region);
                    echo "{$json['id']}\r\n";
                    $stmt->execute();
                } else {
                    echo "Exists {$id}\r\n";
                }
            }
        }
        closedir($handler);
    }
