<?php
//自己的辅助函数
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

//分类的actived
function category_nav_active($category_id)
{

    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}

//生成文章摘要
function make_excerpt($value, $lenght=50)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', '', strip_tags($value)));

    return mb_substr($excerpt,'0', $lenght).'...';
}