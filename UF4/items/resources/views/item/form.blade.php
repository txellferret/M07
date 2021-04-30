@extends('layout')
 
@section('content')
 
@if(empty($item))
    <p>No item found!</p>
@else
<h3>Details for item with id {{$item->id}} </h3>
<form method="post" action="/items/{{$item->id}}/update">
{{ csrf_field() }}
    <div>
        <label for="id">Id:</label>
        <input type="text" name="id" value="{{$item->id}}" readonly/>
    </div>
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{$item->title}}" required/>
    </div>
    <div>
        <label for="content">Content:</label>
        <input type="text" name="content" value="{{$item->content}}" required/>
    </div>
    <button type="submit" class="btn btn-success">Update item</button>
    <br/>
    <br/>
    <div>
    <label for="notes">Notes attached:</label>
        <ul>
            @foreach($item->notes as $note)
                <li>{{$note->content}}</li>
            @endforeach
        </ul>
    </div>
    
</form>  
<hr/>
<h6>Add a new note</h6>
<form method="post" action="/items/{{$item->id}}/notes">
{{ csrf_field() }}
    <div class="form-group">
        <textarea name="content" class="form-control" required></textarea>
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