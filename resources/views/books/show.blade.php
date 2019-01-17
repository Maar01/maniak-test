@extends('layouts.base')
@section('content')
    @if(session('message') )
        <div class="panel panel-success">
            <div class="panel-heading">Attention</div>
            <div class="panel-body">
                <h3>{{session('message')}}</h3>

            </div>
        </div>
    @endif
        <div>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modify a Book</h4>
            </div>
            <div class="modal-body">
                <form class="js-create-book" action="{{route('books.update', [$book->id])}}" method="post">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label for="name">Book name</label>
                        <input type="input" class="form-control" id="book_name" name="name" value="{{$book->name}}">
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="input" class="form-control" id="book_author" name="author" value="{{$book->author}}">
                    </div>
                    <div class="form-group">
                        <label for="published_date">Published date</label>
                        <input type="input" class="form-control" id="published_date" name="published_date" value="{{$book->published_date}}">
                    </div>
                    <div class="form-group">
                        <label for="category">Book category</label>
                        <select class="form-control" id="category" name="category_id">
                            @foreach(App\Category::all() as $category)
                                @if($book->category_id == $category->id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @if($book->user_id !== 0)
                            <span class="label label-danger">Not available</span>
                        @else
                            <span class="label label-success">Available</span>
                        @endif
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#statusModal">
                                Change status
                            </button>
                    </div>
                    <div class="row" >
                        <div class="col-sm-6 ">
                            <a href="{{route('books.index')}}" type="button" class="btn btn-default pull-left" >Back</a>
                        </div>
                        <div class="col-md-6 ">
                            <button type="submit" class="btn btn-warning pull-right">Edit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change status</h4>
                </div>
                <div class="modal-body">
                    @if($book->user_id !== 0)
                        <form>
                            <div class="form-group">
                                <label for="user_name">Current user:</label>
                                <input type="text" class="form-control" id="user_id" value="{{\App\User::where('id', $book->user_id)->first()['name']}}" disabled>
                            </div>
                        </form>
                    @else
                        <div class="form-group">
                            <label for="user_name">Borrow to:</label>
                            <input type="text" class="form-control js-completedName" name="user_name" id="user_name" value="">
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    @if($book->user_id !== 0)
                        {{--<form>
                            <button class="btn btn-warning js-delivered" data-idBook="{{$book->id}}">Delivered</button>
                        </form>--}}
                        <form method="post" action="{{route('books.status')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id_book" value="{{$book->id}}">
                            <button type="submit" class="btn btn-warning">Delivered</button>
                        </form>
                    @else
                        <form method="post" id="change_status" action="{{route('books.status')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id_book" value="{{$book->id}}">
                            <input type="hidden" id="form_user_id" name="user_id" value="">
                            <select id="user_options" name="user_id">

                            </select>
                            <button type="submit" class="btn btn-warning js-borrow">Borrow</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let searchString = "";
            let options = [];
            $('.js-completedName').keyup( function (event) {
                searchString = $(this).val();
                if ( searchString.length > 3 ) {
                    $.get('{{route('users.coincidence')}}/' + searchString, function (data, status) {
                        options = [];
                        $.each(data, function(key, object) {
                            options.push('<option value="'+ object.id +'">'+ object.name +'</option>');
                        });

                        $('#user_options').html(options.join(''));
                    });
                }

            });
        });
    </script>
@endsection