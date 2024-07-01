<?php

function is_rtl( $string ) {
    $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
    return preg_match($rtl_chars_pattern, $string);
}

// Arabic Or Persian
var_dump(is_rtl('نص عربي أو فارسي00'));

// Hebrew
var_dump(is_rtl('חופש למען פלסטין'));

// Latin
var_dump(is_rtl('Hello, World!'));