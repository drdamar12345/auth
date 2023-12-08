@extends('layouts.sidebar')

@section('content')
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <div>
              <h6 class="float_right">
                <form action="{{ route('generatelogkasmasuk') }}" method="post">
                  @csrf
                  <label for="start_date">Tanggal Awal:</label>
                  <input type="date" name="start_date" required>

                  <label for="end_date">Tanggal Akhir:</label>
                  <input type="date" name="end_date" required>

                  <button class="btn btn-success text-center" type="submit">Cari</button>
                </form>
              </h6>
            </div>    
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <!-- /.row -->
  
      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
        
            th, td {
                border: 1px solid black; /* Mengatur garis untuk sel dan header */
                padding: 8px; /* Padding untuk sel */
                text-align: left; /* Penataan teks di dalam sel */
            }
        </style>
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal_pemasukan</th>
              <th>Descripsi</th>
              <th>Nama_Customer</th>
              <th>qty</th>
              <th>Order_id</th>
              <th>Nominal</th>
              <th>Subtotal</th>
              <th>Detail</th>
              <th>Edit</th>
            </tr>
            </thead>
            <tbody>
              @php $i=1 @endphp
              @foreach ($products as $product)
              <tr data-id="{{$product->id}}">
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{$product->tanggal_pemasukan}}</td>
                <td>{{$product->note}}</td>
                <td>{{$product->name_customer}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->order_id}}</td>
                <td>Rp.{{ number_format($product->nominal, 0, ',', '.') }}</td>
                <td>Rp.{{ number_format($product->nominal, 0, ',', '.') }}</td>
                <td class="actions" data-th="">
                  <p class="small"><a href="{{ url('previews/'). '/'  .$product->order_id}}" class="text-muted">Detail</a></p>
                </td>
                <td>    
                  <p class="small"><a href="{{ url('incomes/'). '/'  .$product->id}}" class="text-muted">EDIT</a></p>
                </td>
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
                <th>Total:</th>
                <td>Rp.{{ number_format($total, 0, ',', '.') }}<td>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection