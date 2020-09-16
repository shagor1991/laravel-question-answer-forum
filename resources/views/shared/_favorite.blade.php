<a title="Click to mark as favorite {{$$name}} (Click again to undo)" class="favorite mt-2 {{Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '')}}"
onclick="event.preventDefault(); document.getElementById('{{$$name}}-favorite-{{$model->id}}').submit();"
>
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{$model->favorites_count}}</span>
</a>
<form action="/{{$$name}}/{{$model->id}}/favorites" method="POST" id="{{$$name}}-favorite-{{$model->id}}">
    @csrf
    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>