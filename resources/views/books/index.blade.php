@extends('layouts.base')
@section('content')
    <table class="table books" >
        <thead>
        <tr>
            <th>Name</th>
            <th>Author</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{$book->name}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->user_id === 0 ? 'available' : 'Not available'}}</td>
                <td>
                    <form method="post" action="{{route('books.destroy',[$book->id])}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                    </form>
                    <a href="{{route('books.show', [$book->id])}}" class="btn btn-info btn-xs">Details</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready( function () {
        $('.books').DataTable();
    } );
</script>
@endsection