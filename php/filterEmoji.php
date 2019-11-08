<?php

/*
 * 微信 emoji 过滤
 * */
function filter_Emoji($string){
    $string = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $string);
    $string = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $string);
    $string = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $string);
    $string = preg_replace('/[\x{2600}-\x{26FF}]/u', '', $string);
    $string = preg_replace('/[\x{2700}-\x{27BF}]/u', '', $string);
    $string = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $string);
    $string = str_replace(array('"','\''), '', $string);
    return addslashes(trim($string));
}