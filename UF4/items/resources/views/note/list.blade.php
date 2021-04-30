@extends('layout')
 
@section('content')
<h3>List notes</h3>
@if(isset($data['msg']))
    <div><p class="alert alert-warning">{{$data['msg']}}</p></div>
@endif
@if(empty($data['notes']))
    <p>There are no notes!</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Item id</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data['notes'] as $note)
        <tr>
            <td>{{$note->id}}</td>
            <td>{{$note->item_id}}</td>

            <td>{{$note->content}}</td>
            <td><button onclick="location.href = '/notes/{{$note->id}}';" class="btn btn-primary" >Edit</button></td>
            <td>
                <form action="/notes/{{$note->id}}/delete" method="post">
                {{csrf_field()}}
                    <button class="btn btn-danger" type="submit" onclick="return confirmDialog()">Delete</button>
                </form>
            </td>
            
            
        </tr>
    @endforeach
    </tbody>
</table>

@endif
 
@endsection

<script>
function confirmDialog() {
    return window.confirm("Are you sure?");
}

</script>