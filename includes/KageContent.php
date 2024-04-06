<?php

class KageContent {

    public static function format_kage($input, $output, $ids) {
        $input = $ids or $input;
        $header = 'data:image/svg+xml;utf8,';
        $output = preg_replace('/\\n/', "", $output);
        $output = preg_replace('/"/', "&quot;", $output);
        $output = "<span class=\"kage\" style=\"background-image: url('$header$output');\">$input</span>";
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
