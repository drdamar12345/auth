@extends('layouts.sidebar')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Status customer {{$detail->nama}}</h3>
    </div>
    <form action="{{route('actionstatus')}}" method="GET">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$detail->id}}">
      <div class="card-body">
        <div class="form-select">
            <label><i class="fa fa-venus-mars"></i> Status</label>
            <select class="selectpicker" name="status">
              <option type="radio" value="silver" title="silver">silver</option>
              <option type="radio" value="platinum" title="platinum">platinum</option>
              <option type="radio" value="gold" title="gold">gold</option>
            </select>  
        </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
@endsection