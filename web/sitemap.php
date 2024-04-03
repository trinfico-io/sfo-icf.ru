<?php
    $baseUrl = $_SERVER['HTTP_HOST'];
    $baseUrl = @str_replace(array('www.'), '', $baseUrl);
    $sitemap = 'sitemap.'.$baseUrl.'.xml';
    $content = 'no data';
    if (file_exists($sitemap))
        $content = @file_get_contents($sitemap);
    @header('Content-type: application/xml');
    echo $content;
?>