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
        <label for="content">Content:</label>
        <input type="text" name="content" value="{{$item->content}}"/>
    </div>
    <ul>
        @foreach($item->notes as $note)
            <li>{{$note->content}}</li>
        @endforeach
    </ul>
</form>  
<hr/>
<h3>Add a new note</h3>
<form method="post" action="/items/{{$item->id}}/notes">
    {{csrf->field()}}
    <div class="form-group">
        <textarea name="content" class="form-control">{{old('content')}}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Add note</button>
    </div>
</form>
 
@if (count($errors))
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
 
@endif
 
@endsection