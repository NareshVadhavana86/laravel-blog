@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Blog</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="addBlogForm" enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" rows="5" cols="80" id="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select class="form-control" id="tags">
                              @foreach ($tags as $tag)
                                  <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                              @endforeach
                            </select>
                        </div>



                        <div class="">
                            <button type="button" name="button" class="btn btn-primary" id="saveBtn">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
  <script src="{{ asset('js/blog.js') }}" defer></script>
@endsection
