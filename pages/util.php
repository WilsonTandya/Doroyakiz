<?php
function preprocess($str) {
    return str_replace(' ', '%20', $str);
}
?>