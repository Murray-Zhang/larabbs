<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id',  'excerpt', 'slug'];


    //获取话题的所属分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //获取帖子的用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //使用本地作用域排序
    public function scopeWithOrder($query, $order)
    {

        //不同的排序， 使用不同的数据读取逻辑
        switch($order){
            case "recent":
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }

        //防止N+1问题
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        //当问题有新回复，将编写更新话题模型的reply_count属性
        //此时会自动触发框架对数据模型的update_at时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        //按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }

    //帖子拥有的恢复
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
