@if($model instanceof App\question)
    @php 
        $name='question';
    @endphp
@elseif($model instanceof App\Answer)
    @php 
        $name='answer';
    @endphp
@endif
    <div class="d-fex flex-column vote-controls">
        <a title="This {{$name}} is useful" class="vote-up {{Auth::guest() ? 'off' : ''}}"
        onclick="event.preventDefault(); document.getElementById('up-vote-{{$name}}-{{$model->id}}').submit();"
        >
            <i class="fas fa-caret-up fa-2x"></i>
        </a>
        <form action="/{{$name}}/{{$model->id}}/vote" method="POST" id="up-vote-{{$name}}-{{$model->id}}">
            @csrf
            <input type="hidden" name="vote" value="1">
        </form>
        <span class="votes-count">{{$model->votes_count}}</span>
        <a title="This {{$name}} is not useful" class="vote-down {{Auth::guest() ? 'off' : ''}}"
        onclick="event.preventDefault(); document.getElementById('down-vote-{{$name}}-{{$model->id}}').submit();"
        >
            <i class="fas fa-caret-down fa-2x"></i>
        </a>
        <form action="/{{$name}}/{{$model->id}}/vote" method="POST" id="down-vote-{{$name}}-{{$model->id}}">
            @csrf
            <input type="hidden" name="vote" value="-1">
        </form>

        @if($model instanceof App\Question)
            @include('shared._favorite',[
                'model' => $model
            ])
        @elseif($model instanceof App\Answer)
            @include('shared._accept',[
                'model' => $model
            ])
        @endif
    </div>