@extends('layouts.app')


@section('content')

<div class="container">

    <form method="POST" action="/saveObjava" class="form" enctype="multipart/form-data">
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
        <input type="file" name="image" class="form-control" >

        <br/>
        <br/>

        <select id="tipObjave" name="tipObjave">
            <option value="0">Privat</option>
            <option value="1">Public</option>
        </select>

        <br/>
        <br/>
        <br/>

        <input type="submit" name="submit" class="btn btn-primary">
    </form>
</div>



@endsection