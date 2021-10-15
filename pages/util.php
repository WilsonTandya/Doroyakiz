<?php
function preprocess($str) {
    return str_replace(' ', '%20', $str);
}

function formatPrice($price) {
    return number_format($price,0,',','.');
}
?>