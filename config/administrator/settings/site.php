<?php
return [
    'title' => '站点设置',
// 访问权限判断
    'permission'=> function()
    {
// 只允许站⻓管理站点配置
        return Auth::user()->hasRole('Founder');
    },
// 站点配置的表单
    'edit_fields' => [
        'site_name' => [
// 表单标题
            'title' => '站点名称',
// 表单条⽬类型
            'type' => 'text',
// 字数限制
            'limit' => 50,
        ],
        'contact_email' => [
            'title' => '联系⼈邮箱',
            'type' => 'text',
            'limit' => 50,
        ],
        'seo_description' => [
            'title' => 'SEO - Description',
            'type' => 'textarea',
            'limit' => 250,
        ],
        'seo_keyword' => [
            'title' => 'SEO - Keywords',
            'type' => 'textarea',
            'limit' => 250,
        ],
    ],
// 表单验证规则
    'rules' => [
        'site_name' => 'required|max:50',
        'contact_email' => 'email',
    ],
    'messages' => [
        'site_name.required' => '请填写站点名称。',
        'contact_email.email' => '请填写正确的联系⼈邮箱格式。',
    ],
// 数据即将保持的触发的钩⼦，可以对⽤⼾提交的数据做修改
    'before_save' => function(&$data)
    {
// 为⽹站名称加上后缀，加上判断是为了防⽌多次添加
        if (strpos($data['site_name'], 'Powered by LaraBBS') === false) {
            $data['site_name'] .= ' - Powered by LaraBBS';
        }
    },
// 你可以⾃定义多个动作，每⼀个动作为设置⻚⾯底部的『其他操作』区块
    'actions' => [
// 清空缓存
        'clear_cache' => [
            'title' => '更新系统缓存',
// 不同状态时⻚⾯的提醒
            'messages' => [
                'active' => '正在清空缓存...',
                'success' => '缓存已清空！',
                'error' => '清空缓存时出错！',
            ],
// 动作执⾏代码，注意你可以通过修改 $data 参数更改配置信息
            'action' => function(&$data)
            {
                \Artisan::call('cache:clear');
                return true;
            }
        ],
    ],
];