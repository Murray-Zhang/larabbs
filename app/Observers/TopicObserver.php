<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    //在保存数据是生成文章摘要
    public function saving(Topic $topic)
    {
        //入库前使用purifier 过滤防止xss攻击
        $topic->body = clean($topic->body, 'user_topic_body');
        //自定义的辅助方法
        $topic->excerpt = make_excerpt($topic->body);
    }
}