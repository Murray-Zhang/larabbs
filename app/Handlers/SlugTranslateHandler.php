<?php
//生成seo友好的url, 利用百度翻译api
namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text)
    {
        //实例化配置信息
        $http = new Client;
        //初始化配置信息
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('services.baidu_translate.appid');
        $key = config('services.baidu_translate.key');

        $salt = time();

        //如果没有配置百度翻译， 使用拼音方案
        if(empty($appid) || empty($key)){
            return $this->pinyin($text);
        }

        //根据文档，生成sign
        $sign = md5($appid . $text . $salt . $key);
        //构建请求参数
        $query = http_build_query([
            'q' => $text,
            'from' => 'zh',
            'to' => 'en',
            'appid' => $appid,
            'salt' => $salt,
            'sign' => $sign,
        ]);
        //发送http get 请求
        $response = $http->get($api . $query);

        $result = json_decode($response->getBody(), true);

        //尝试获取翻译结果
        if(isset($result['trans_result'][0]['dst'])){
            return str_slug($result['trans_result'][0]['dst']);
        } else {
            //百度翻译没有结果使用拼音作为后备计划
            return $this->pinyin($text);
        }


    }

    public function pinyin($text)
    {
        return str_slug((new Pinyin())->permalink($text));
    }
}