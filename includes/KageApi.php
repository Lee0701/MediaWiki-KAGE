<?php

use MediaWiki\MediaWikiServices;

class KageApi {
    
    public static function render($text) {
        $config = MediaWikiServices::getInstance()->getConfigFactory()->makeConfig( 'kage' );
        $apiUrl = $config->get('KageApiUrl');

        $postdata = json_encode(
            array(
                'content' => $text
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

}