@extends('layout')
 
@section('content')
<h3>Add new item</h3>
@if(isset($data['msg']))
    <p>{{$data['msg']}}</p>
@endif
<form action="/additem" method="post">
{{csrf_field()}}
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" value="" required/>
    </div>
    <div>
        <label for="content">Content:</label>
        <input type="text" name="content" value="" required/>
    </div>
    <button class="btn btn-success" type="submit">Add</button>
</form>

@endsection