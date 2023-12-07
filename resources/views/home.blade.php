@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @foreach ($cash as $item)
              <div class="card-header">Patty Cash : Rp.{{ number_format($item->patty_cash, 0, ',', '.') }}</div>
              @endforeach
                <form action="{{route('addpettycash')}}" method="POST">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="patty_cash">Cash Today</label>
                      <input name="patty_cash" type="number" class="form-control"  placeholder="cash hari ini">
                    </div>
                  </div>
                  <input type="hidden" name="store_id" value="{{ Auth::user()->store_id }}">
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- <section class="invoice">
    <!-- title row -->
    <!-- info row -->
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama_Product</th>
            <th>Tanggal_pemasukan</th>
            <th>Descripsi</th>
            <th>Nama_Customer</th>
            <th>qty</th>
            <th>Nominal</th>
          </tr>
          </thead>
          <tbody>
            @php $i=1 @endphp
            @foreach ($products as $product)
            <tr class="expandable-row">
              <td>{{ $i++ }}</td>
              <td>{{$product->name_product}}</td>
              <td>{{$product->tanggal_pemasukan}}</td>
              <td>{{$product->note}}</td>
              <td>{{$product->name_customer}}</td>
              <td>{{$product->qty}}</td>
              <td>Rp.{{ number_format($product->nominal, 2, ',', '.') }}</td>
            </tr>
            
                
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-6">

        <div class="table-responsive">
          <table class="table">
            <tr>
              
              <th>Total:</th>
              <td>Rp.{{ number_format($total, 2, ',', '.') }}<td>
            </tr>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</section> --}}
@endsection
