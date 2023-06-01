<?php

use MediaWiki\MediaWikiServices;
use MediaWiki\Linker\LinkRenderer;
use MediaWiki\Linker\LinkTarget;

require_once('KageApi.php');
require_once('KageContent.php');

class KageHooks {

    public static function onParserFirstCallInit( Parser $parser ) {
        $parser->setHook('kage', [self::class, 'kageTag']);
    }

    public static function kageTag( $input, array $args, Parser $parser, PPFrame $frame ) {
        $output = KageApi::render($input);
        return KageContent::format($input, $output);
    }
    
    public static function onBeforePageDisplay( OutputPage $outputPage, Skin $skin ) {
        $outputPage->addModuleStyles('ext.KAGE.svg');
    }

}

?>
