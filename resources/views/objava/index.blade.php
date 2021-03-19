@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Index</h1>
    <div class="row">
        @foreach($objave as $item)
            <div class="col-md-4">  
                <img src="images/{{$item->imgPath}}" class="img-fluid"/>
                <br/>

                Like / Dislike
            </div>
        @endforeach
    </div>
</div>

@endsection