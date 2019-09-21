<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;
use Illuminate\Support\Facades\DB;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $topic;
    public function __construct(Topic $topic)
    {
        //队列任务构造器中接收了Eloquent模型，将会只系列化模型的ID
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //请求百度API接口进行翻译
        $slug  = app(SlugTranslateHandler::class)->translate($this->topic->title);
        DB::table('topics')->where('id', $this->topic->id)->update(['slug' => $slug]);
    }
}
