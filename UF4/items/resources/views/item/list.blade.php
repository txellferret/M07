@extends('layout')
 
@section('content')
 
@if(empty($items))
    <p>There are no items!</p>
@else
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Content</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->content}}</td>
            <td><a href="/items/{{$item->id}}">{{ $item->title }}</a></td>
        </tr>
    @endforeach
    </tbody>
<button class="btn btn-primary"></button>
</table>

@endif
 
@endsection