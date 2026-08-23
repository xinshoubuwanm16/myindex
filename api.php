<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$imgDir = __DIR__ . '/images/';
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/images/';
$exts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];

$images = [];
if (is_dir($imgDir)) {
    $files = scandir($imgDir);
    foreach ($files as $f) {
        if ($f == '.' || $f == '..') continue;
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        if (in_array($ext, $exts)) {
            $images[] = [
                'url' => $baseUrl . $f,
                'title' => pathinfo($f, PATHINFO_FILENAME)
            ];
        }
    }
}

shuffle($images);

echo json_encode([
    'code' => 200,
    'count' => count($images),
    'images' => $images
], JSON_UNESCAPED_UNICODE);
?>
