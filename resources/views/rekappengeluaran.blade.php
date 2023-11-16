@extends('layouts.sidebar')
@section('content')
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <i class="fas fa-globe"></i> Bit wallet.
            <small class="float-right">Date: 2/10/2014</small>
            <div>
              <h6 class="float_right">
                <form action="{{ route('generateuangkeluar') }}" method="post">
                  @csrf
                  <label for="start_date">Tanggal Awal:</label>
                  <input type="date" name="start_date" required>

                  <label for="end_date">Tanggal Akhir:</label>
                  <input type="date" name="end_date" required>

                  <button class="btn btn-success text-center" type="submit">Generate Laporan</button>
                </form>
              </h6>
            </div>    
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Nama: {{$nameadmin->name}}
          <address>
            <strong>Bit Wallet.</strong><br>
            JL.LETJEND S.PARMAN X NO:84<br>
            Jember, Jawa Timur, 68124<br>
            Phone: 08527009211<br>
            Email: {{$nameadmin->email}}
          </address>
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <!-- /.col -->
      </div>
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
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              @php $i=1 @endphp
              @foreach ($products as $product)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{$product->nama_product}}</td>
                <td>{{$product->tanggal_pengeluaran}}</td>
                <td>{{$product->note}}</td>
                <td>{{$product->nama_admin}}</td>
                <td>{{$product->qty}}</td>
                <td>Rp.{{$product->nominal}}</td>
                <td>{{$product->total}}</td>
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
                <td>{{$total}}</td>
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
<script>
    // window.addEventListener("load", window.print());
  </script>
@endsection