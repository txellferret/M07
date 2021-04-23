@extends('layout')
 
@section('content')
 
@if(empty($note))
    <p>No note found!</p>
@else
<hr/>
<h3>Edit a note</h3>
<form method="post" action="/notes/{{$note->id}}">
   {{method->field('patch')}}
    <div class="form-group">
        <textarea name="content" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update note</button>
    </div>
</form>
 
@endif
 
@endsection