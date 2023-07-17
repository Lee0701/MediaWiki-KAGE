<?php

class KageContent {

    public static function format_kage($input, $output) {
        return $output;
    }

    public static function format_compose($input, $output) {
        $output = substr($output, strpos($output, '<svg'));
        $output = preg_replace('/\\n/', '', $output);
        $output = preg_replace('/style="[^"]+"/', 'viewBox="0 0 200 200"', $output, 1);
        $output = str_replace('<svg', '<svg class="compose"', $output);
        return $output;
    }

}

?>
