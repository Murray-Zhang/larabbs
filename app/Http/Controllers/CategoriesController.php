<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic)
    {
        //读取该分类下相关的话题，分页
        $topics = $topic->withOrder($request->order)->where('category_id', $category->id)->paginate(20);
        return view('topics.index', compact('topics', 'category'));
    }
}
