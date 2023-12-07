@extends('layouts.sidebar')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Data</h3>
    </div>
    <form action="{{route('actionincome')}}" method="GET">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$detail->id}}">
      <div class="card-form">
        <div class="form-group">
          <label for="nominal">Nominal</label>
          <input name="nominal" type="number" class="form-control"  placeholder="input nominal disini">
        </div>
      </div>
      <div class="card-form">
        <div class="form-group">
          <label for="qty">Quantity</label>
          <input name="qty" type="number" class="form-control"  placeholder="input jumlah branag disini">
        </div>
      </div>
      <div class="card-form">
        <div class="form-group">
          <label for="name_customer">Nama customer</label>
          <input name="name_customer" type="text" class="form-control"  placeholder="input nama customer disini">
        </div>
      </div>
      <div class="card-form">
        <div class="form-group">
          <label for="tanggal_pemasukan">Tanggal Pemesanan</label>
          <input name="tanggal_pemasukan" type="datetime-local" class="form-control"  placeholder="input di store">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
    </form>
</div>
@endsection