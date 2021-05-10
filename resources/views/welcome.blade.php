@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <table class="table table-bordered data-table" id="blogsTable">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th width="100px">Action</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
          </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/blogList.js') }}" defer></script>
@endsection
