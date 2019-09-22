@include('shared._eooro')
<div class="reply-box">
    <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="分享你的⻅解~" name="replycontent"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share mr-1"></i> 回复</button>
    </form>
</div>
<hr>