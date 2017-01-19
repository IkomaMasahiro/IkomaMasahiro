<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2017/01/18
 * Time: 12:03
 */

function e($str, $charset = 'UTF-8'){
    return htmlspecialchars($str, ENT_QUOTES, $charset);
};