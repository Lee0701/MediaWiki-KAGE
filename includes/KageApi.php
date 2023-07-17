<?php

use MediaWiki\MediaWikiServices;

class KageApi {
    
    public static function render($text) {
        $config = MediaWikiServices::getInstance()->getConfigFactory()->makeConfig( 'kage' );
        $apiUrl = $config->get('KageApiUrl');
        $outputFormat = $config->get('KageOutputFormat');

        $postdata = json_encode(
            array(
                'content' => $text,
                'format' => $outputFormat
            )
        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($apiUrl, false, $context);
        return $result;
    }

    public static function callWebhook($title) {
        $config = MediaWikiServices::getInstance()->getConfigFactory()->makeConfig( 'kage' );
        $webhookUrl = $config->get('KageWebhookUrl');
        $title = urlencode($title);
        $url = "$webhookUrl?char=$title";
        $result = file_get_contents($url);
    }

}