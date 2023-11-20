  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <i class="fas fa-globe"></i> Bit wallet.
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
                <td>Rp.{{ number_format($product->nominal, 2, ',', '.') }}</td>
                <td>{{ number_format($product->total, 2, ',', '.') }}</td>
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
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>