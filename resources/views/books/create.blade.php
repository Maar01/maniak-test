@extends('layouts.base')
@section('content')
    @if(count($errors) > 0)
        <div class="panel panel-danger">
            <div class="panel-heading">Errors!</div>
            <div class="panel-body">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    @endif
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add a Book</h4>
        </div>
        <div class="modal-body">
            <form class="js-create-book" autocomplete="on" action="{{route('books.store')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Book name</label>
                    <input type="input" class="form-control" id="book_name" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="input" class="form-control" id="book_author" name="author" placeholder="">
                </div>
                <div class="form-group">
                    <label for="published_date">Published date</label>
                    <input type="input" class="form-control" id="published_date" name="published_date" placeholder="">
                </div>
                <div class="form-group">
                    <label for="category">Book category</label>
                    <select class="form-control" id="category" name="category_id">
                        @foreach(App\Category::all() as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="user_id" value="0">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection