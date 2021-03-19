@extends('layouts.app')


@section('content')

<div class="container">

    <form method="POST" action="/saveEdit/{{$objava->id}}" class="form" enctype="multipart/form-data">
        {{ csrf_field() }}

        @if(count($errors) >0)
            <div class="alert alert-danger">
                <ul>
                @foreach( $errors->all() as $error) 
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <label>Naložite sliko</label>
        <br/>
        <input type="text" name="name" class="form-control" value="{{$objava->name}}">

        <br/>
        <br/>

        <select id="tipObjave" name="tipObjave">
            <option value="0" {{ $objava->type == 0 ? 'selected' : '' }}>Privat</option>
            <option value="1" {{ $objava->type == 1 ? 'selected' : '' }}>Public</option>
        </select>

        <br/>
        <br/>
        <br/>

        <input type="submit" name="submit" class="btn btn-primary">
    </form>
</div>



@endsection