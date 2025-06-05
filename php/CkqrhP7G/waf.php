<?php
function waf($input) {
    $bad = ['and', 'union','--', '/*', '*/', 'sleep', 'benchmark'];
    $input = strtolower($input);
    foreach ($bad as $b) {
        if (strpos($input, $b) !== false) {
            die("Blocked by WAF");
        }
    }
    return $input;
}
?>

