<?php

return array(
// 后台的 URI ⼊⼝
    'uri' => 'admin',
// 后台专属域名，没有的话可以留空
    'domain' => '',
// 应⽤名称，在⻚⾯标题和左上⻆站点名称处显⽰
    'title' => env('APP_NAME', 'Laravel'),
// 模型配置信息⽂件存放⽬录
    'model_config_path' => config_path('administrator'),
// 配置信息⽂件存放⽬录
    'settings_config_path' => config_path('administrator/settings'),
    /*
    * 后台菜单数组，多维数组渲染结果为多级嵌套菜单。
    *
    * 数组⾥的值有三种类型：
    * 1. 字符串 —— ⼦菜单的⼊⼝，不可访问；
    * 2. 模型配置⽂件 —— 访问 `model_config_path` ⽬录下的模型⽂件，如 `users` 访问的是 `users.php` 模型配置⽂件；
    * 3. 配置信息 —— 必须使⽤前缀 `settings.`，对应 `settings_config_path` ⽬录下的⽂件，如：默认设置下，
    * `settings.site` 访问的是 `administrator/settings/site.php` ⽂件
    * 4. ⻚⾯⽂件 —— 必须使⽤前缀 `page.`，如：`page.pages.analytics` 对应 `administrator/pages/analytics.php`
    * 或者是 `administrator/pages/analytics.blade.php` ，两种后缀名皆可
    *
    * ⽰例：
    * [
    * 'users',
    * 'E-Commerce' => ['collections', 'products', 'product_images', 'orders'],
    * 'Settings' => ['settings.site', 'settings.ecommerce', 'settings.social'],
    * 'Analytics' => ['E-Commerce' => 'page.pages.analytics'],
    * ]
    */
    'menu' => [
        '⽤⼾与权限' => [
            'users',
            'roles',
            'permissions',
        ],
    ],
    /*
    * 权限控制的回调函数。
    *
    * 此回调函数需要返回 true 或 false ，⽤来检测当前⽤⼾是否有权限访问后台。
    * `true` 为通过，`false` 会将⻚⾯重定向到 `login_path` 选项定义的 URL 中。
    */
    'permission' => function () {
// 只要是能管理内容的⽤⼾，就允许访问后台
        return Auth::check() && Auth::user()->can('manage_contents');
    },
    /*
    * 使⽤布尔值来设定是否使⽤后台主⻚⾯。
    *
    * 如值为 `true`，将使⽤ `dashboard_view` 定义的视图⽂件渲染⻚⾯；
    * 如值为 `false`，将使⽤ `home_page` 定义的菜单条⽬来作为后台主⻚。
    */
    'use_dashboard' => false,
// 设置后台主⻚视图⽂件，由 `use_dashboard` 选项决定
    'dashboard_view' => '',
// ⽤来作为后台主⻚的菜单条⽬，由 `use_dashboard` 选项决定，菜单指的是 `menu` 选项
    'home_page' => 'users',
// 右上⻆『返回主站』按钮的链接
    'back_to_site_path' => '/',
// 当选项 `permission` 权限检测不通过时，会重定向⽤⼾到此处设置的路径
    'login_path' => 'login',
// 允许在登录成功后使⽤ Session::get('redirect') 将⽤⼾重定向到原本想要访问的后台⻚⾯
    'login_redirect_key' => 'redirect',
// 控制模型数据列表⻚默认的显⽰条⽬
    'global_rows_per_page' => 20,
// 可选的语⾔，如果不为空，将会在⻚⾯顶部显⽰『选择语⾔』按钮
    'locales' => [],
);
