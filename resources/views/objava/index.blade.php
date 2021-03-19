@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Vse objave (public in private)</h1>
    <div class="row eq-height">
        @foreach($objave as $item)
            <div class="col-md-4">  
                <img src="images/{{$item->imgPath}}" class="img-fluid"/>
                <br/>
                Likes:{{$item->ratings_like_count + $item->public_ratings_like_count}} , Dislikes: {{$item->ratings_dislike_count + $item->public_ratings_dislike_count}}
                <br/>
                @if($item->user_id != Auth::user()->id )
                    <a href="/like/{{$item->id}}">Like</a> / <a href="/dislike/{{$item->id}}">Dislike</a>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection