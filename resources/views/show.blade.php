@extends('layouts.admin')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add ID Admin {{$detail->name}}</h3>
    </div>
    <form action="{{route('actionid')}}" method="GET">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$detail->id}}">
      <div class="card-body">
        <div class="form-group">
          <label for="store_id">ID ADMIN</label>
          <input name="store_id" type="number" class="form-control"  placeholder="input di store">
        </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
@endsection