<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //编辑资料页面
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    //修改个人资料
    public function update(UserRequest $request, User $user)
    {

        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功');
    }
}
