<?php

namespace App\Handlers;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageUploadHandler
{
    //只允许已下后缀名的图片文件上传
    protected $allowed_all_ext = ['png','jpg','gif','jpeg'];

    /*
     * $file 文件实列
     * $folder 文件夹名称
     * $file_prefix 文件名前缀，
     * */
    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        //构建存储的文件夹规则，例如 uploads/images/avatars/201709/21
        $folder_name = "uploads/images/{$folder}/" . date("Ym/d", time());

        //文件具体的存储物理路径， public_path() 获取的文件夹的物理路径
        $upload_path = public_path().'/'.$folder_name;

        //获取文件的后缀名， 因图⽚从剪贴板⾥黏贴时后缀名为空，所以此处确保后缀⼀直存在
        $extension = strtolower($file->getClientOriginalExtension()) ? : 'png';

        //拼接文件名，加前缀为了增加辨析度
        $filename = $file_prefix.'_'.time().'_'.str::random(10).'.'.$extension;

        if(!in_array($extension, $this->allowed_all_ext)){
            return false;
        }
        //将图片移动到我们的存储路径中
        $file->move($upload_path, $filename);

        //如果限制了大小
        if($max_width && $extension != 'gif'){
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }
        return [
            'path' => config('app.url') . "/$folder_name/$filename",
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        //先进行实例化
        $image = Image::make($file_path);

        //大小调整
        $image->resize($max_width, null, function ($constraint) {
           //设定狂赌为$max_width, 等比例缩放
            $constraint->aspectRatio();
            //防止图片变大
            $constraint->upsize();
        });
        //对图片修改后进行保存
        $image->save();
    }
}