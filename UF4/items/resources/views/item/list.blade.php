@extends('layout')
 
@section('content')
 
@if(empty($items))
    <p>There are no items!</p>
@else
<ul>
    @foreach($items as $item)
        <li>{{ $item }}</li>
    @endforeach
    </ul>    
@endif
 
@endsection