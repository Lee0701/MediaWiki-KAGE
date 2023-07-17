<?php

use MediaWiki\MediaWikiServices;

class ComposeApi {
    
    public static function render($text) {
        $config = MediaWikiServices::getInstance()->getConfigFactory()->makeConfig( 'compose' );
        $apiUrl = $config->get('ComposeApiUrl');
        $outputFormat = $config->get('ComposeOutputFormat');

        $reqUrl = "$apiUrl/$text.$outputFormat";
        $handle = fopen($reqUrl, 'rb');

        $result = stream_get_contents($handle);
        fclose($handle);

        return $result;
    }
}