<?php
$f = (isset($argv[1]) && file_exists($argv[1]))?$argv[1]:"stockman.json";
// chdir(dirname(__FILE__));
$d = file_get_contents($f);
$d = preg_replace_callback("/(\d+\.?\d*)\s*([\/+\-\*])\s*(\d+\.?\d*)/m",function($m){
    switch($m[2]){
        case "/":return floatval($m[1])/floatval($m[3]);
        case "+":return floatval($m[1])+floatval($m[3]);
        case "-":return floatval($m[1])-floatval($m[3]);
        case "*":return floatval($m[1])*floatval($m[3]);
    }
    return floatval($m[1]).$m[2].floatval($m[3]);
},$d);
file_put_contents($f,$d);
?>
