@extends('layouts.admin')
@section('content')
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Toko</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('actionformstore')}}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="name_store">Nama Store</label>
                    <input name="name_store" type="text" class="form-control"  placeholder="nama toko">
                  </div>
                  <div class="form-group">
                      <label for="address">Alamat</label>
                      <input name="address" type="text" class="form-control"  placeholder="alamat toko">
                  </div>
                  <div class="form-group">
                    <label for="name_owner">Nama Owner</label>
                    <input name="name_owner" type="text" class="form-control"  placeholder="nama owner">
                  </div>
                  <div class="form-group">
                    <label for="product_store">Product Toko</label>
                    <input name="product_store" type="text" class="form-control"  placeholder="product toko secara garis besar">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
</div>

@endsection