<?php
echo "site";

$opts = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n" .
            "Cookie: foo=bar\r\n"
    )
);

$context = stream_context_create($opts);
$url = 'http://nginx:81/';

var_dump($url);

// Открываем файл с помощью установленных выше HTTP-заголовков
$file = file_get_contents($url, false, $context);

var_dump($file);