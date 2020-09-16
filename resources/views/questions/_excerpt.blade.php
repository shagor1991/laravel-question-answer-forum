<div class="media post">
    <div class="d-flex flex-column counters">
        <div class="vote">
            <strong> {{$question->votes_count}} </strong> {{str_plural('vote',$question->votes_count)}}
        </div>
        <div class="status {{$question->status}}">
            <strong> {{$question->answers_count}} </strong> {{str_plural('answer',$question->answers_count)}}
        </div>
        <div class="view">
            {{$question->views}}  {{str_plural('vote',$question->views)}}
        </div>
    </div>
    <div class="media-body">
        <div class="d-flex align-item-center">
            <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
            <div class="ml-auto">
                @auth
                @if(Auth::user()->can('update',$question))
                <a href="{{route('question.edit',$question->id)}}" class="btn btn-sm btn-outline-info">Edit</a>
                @endif

                @if(Auth::user()->can('delete',$question))
                <form style="display:inline" action="{{route('question.destroy',$question->id)}}" method="POST">
                    @method('delete')
                    @csrf 

                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure to delete this?');"> Delete</button>
                </form>
                @endif
                @endauth
            </div>
        </div>
        
        <p class="lead">
            Asked by <a href="#">{{$question->user->name}}</a>
            <small class="text-muted">{{$question->created_date}}</small>
        </p>
        {!! str_limit($question->body_html,400) !!}
    </div>
</div>