<?php

use MediaWiki\MediaWikiServices;
use MediaWiki\Linker\LinkRenderer;
use MediaWiki\Linker\LinkTarget;
use MediaWiki\User\UserIdentity;
use MediaWiki\Revision\RevisionRecord;
use MediaWiki\Storage\EditResult;

require_once('KageApi.php');
require_once('ComposeApi.php');
require_once('KageContent.php');

class KageHooks {

    public static function onParserFirstCallInit( Parser $parser ) {
        $parser->setHook('kage', [self::class, 'kageTag']);
        $parser->setHook('compose', [self::class, 'composeTag']);

        $parser->setFunctionHook('compose', [self::class, 'composeFunction']);
    }

    public static function kageTag( $input, array $args, Parser $parser, PPFrame $frame ) {
        $output = KageApi::render($input);
        $ids = $input;
        if(isset($args['ids'])) $ids = $args['ids'];
        return KageContent::format_kage($input, $output, $ids);
    }

    public static function composeTag( $input, array $args, Parser $parser, PPFrame $frame ) {
        $output = ComposeApi::render($input);
        return KageContent::format_compose($input, $output);
    }

    public static function composeFunction( Parser $parser, $input = '' ) {
        $output = ComposeApi::render($input);
        $output = KageContent::format_compose($input, $output);
        return [ $output, 'noparse' => true, 'isHTML' => true ];
    }

    public static function onBeforePageDisplay( OutputPage $outputPage, Skin $skin ) {
        $outputPage->addModuleStyles('ext.KAGE');
    }

    public static function onPageSaveComplete( WikiPage $wikiPage, UserIdentity $user, string $summary, int $flags, RevisionRecord $revisionRecord, EditResult $editResult ) {
        $namespace = $wikiPage->getNamespace();
        $title = $wikiPage->getTitle()->getText();
        if($namespace == 3000) {
            KageApi::callWebhook($title);
        }
    }

}

?>
