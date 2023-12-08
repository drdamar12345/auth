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
                <form action="{{ route('generatelogkaskeluar') }}" method="post">
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
              <th>Nama_Product</th>
              <th>tanggal_pengeluaran</th>
              <th>Deskripsi</th>
              <th>Nama_Admin</th>
              <th>qty</th>
              <th>size</th>
              <th>Nominal</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              @php $i=1 @endphp
              @foreach ($products as $product)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{$product->name_product}}</td>
                <td>{{$product->tanggal_pengeluaran}}</td>
                <td>{{$product->note}}</td>
                <td>{{$product->nama_admin}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->size}}</td>
                <td>Rp.{{ number_format($product->nominal, 0, ',', '.') }}</td>
                <td>Rp.{{ number_format($product->total, 0, ',', '.') }}</td>
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
                <td>Rp.{{ number_format($total, 0, ',', '.') }}<td>
              </tr>
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