@extends('layout')
 
@section('content')
 
@if(empty($item))
    <p>No item found!</p>
@else
<form>
    <div>
        <label for="id">Id:</label>
        <input type="text" name="id" value="{{$item->id}}"/>
    </div>
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{$item->title}}"/>
    </div>
    <div>
        <label for="content">Title:</label>
        <input type="text" name="content" value="{{$item->content}}"/>
    </div>
</form>    
@endif
 
@endsection