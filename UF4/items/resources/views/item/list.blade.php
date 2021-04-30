@extends('layout')
 
@section('content')
<h3>List items</h3>
@if(isset($data['msg']))
    <div><p class="alert alert-warning">{{$data['msg']}}</p></div>
@endif
@if(empty($data['items']))
    <p>There are no items!</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Content</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data['items'] as $item)
        <tr>
            <td><a href="/items/{{$item->id}}">{{$item->id}}</a></td>
            <td>{{$item->title}}</td>
            <td>{{$item->content}}</td>
            <td>
                <label for="notes">Notes:</label>
                <ul>
                    @foreach($item->notes as $note)
                        <li>{{$note->content}}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <form action="/items/{{$item->id}}/delete" method="post">
                {{csrf_field()}}
                    <button class="btn btn-danger" type="submit" onclick="return confirmDialog()">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    <button onclick="location.href = '/itemform';" class="btn btn-primary" >Add new</button>
</table>

@endif
 
@endsection

<script>
function confirmDialog() {
    return window.confirm("Are you sure?");
}

</script>