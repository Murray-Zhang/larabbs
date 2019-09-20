<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    public function update(User $user, Topic $topic)
    {
         return $topic->user_id == $user->id;
//        return true;
    }

    public function destroy(User $user, Topic $topic)
    {
//        dd($user->id, $topic->user_id);
        return $user->id === $topic->user_id;
//        return true;
    }
}
