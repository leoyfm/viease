<?php

/**
 * helpers.php
 *
 * 工具函数
 *
 * @author overtrue <i@overtrue.me>
 */

function admin_url($uri)
{
    return url('admin/'. $uri);
}

/**
 * 下划线转驼峰
 *
 * @param  string $source 字符串
 *
 * @return string
 */
function hump($source)
{
    return preg_replace_callback("/( :^|_)([a-z])/", function($str){
        foreach ($str as $v) {
           return ltrim(strtoupper($v),'_');
        }
    }, $source);
}