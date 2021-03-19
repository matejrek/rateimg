@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Samo public objave</h1>
    <div class="row">
        @foreach($publicObjave as $item)
            <div class="col-md-4">  
                <img src="images/{{$item->imgPath}}" class="img-fluid"/>
                <br/>
                Likes:{{$item->ratings_like_count + $item->public_ratings_like_count}} , Dislikes: {{$item->ratings_dislike_count + $item->public_ratings_dislike_count}}
                <br/>
                @auth
                @if($item->user_id != Auth::user()->id )
                <a href="/like/{{$item->id}}">Like</a> / <a href="/dislike/{{$item->id}}">Dislike</a>
                @endif
                @endauth

                @guest
                    <a href="/like/{{$item->id}}">Like</a> / <a href="/dislike/{{$item->id}}">Dislike</a>
                @endguest
            </div>
        @endforeach
    </div>
</div>

@endsection