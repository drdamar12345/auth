<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <section class="content">
    {{-- @dd($bayar); --}}
    {{-- @foreach ($bayar as $item)           --}}
    <div class="container-fluid">
      <div class="row">
        <div class="col-9">
          <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            Harap Segera Melakukan pembayaran ,dalam 1 jam jika tidak terdapat pembayarn maka pesanan dianggap membatalkan pesanan
          </div>


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> Bit Wallet.
                  <small class="float-right">Date:{{ $bayar->created_at }}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From : {{$nameadmin->name}}
                <address>
                  <strong>Name Store: {{$store->name_store}}</strong><br>
                  JL.LETJEND S.PARMAN X NO:84<br>
                  Jember, Jawa Timur, 68124<br>
                  Phone: 085270092112<br>
                  Email: {{$nameadmin->email}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong></strong><br>
                  Kepada : yth/{{$bayar->name_customer}}<br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Order ID:</b> {{$bayar->id}}<br>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Harga</th>
                    <th>Ukuran Sepatu</th>
                    <th>qty</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($detail as $item)
                        
                    <tr data-id="">
  
                      <td>{{ $item->nama_product }}</td>
  
                      <td data-th="Harga">Rp{{ number_format($item->harga, 2, ',', '.') }}</td>
  
                        <input  name="price[]" type="hidden" class="text-center" value="{{ intval($item->harga) * intval($item->qty) }}"></td>
  

                      <td>{{$item->size}}</td>
                        
                      <td>{{$item->qty}}</td>

                      
                      
  
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <!-- /.col -->
              <div class="col-6">

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>Rp.{{ number_format($bayar->total, 2, ',', '.') }}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> --}}
                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                  Payment
                </button>
                <a href="/belumlunas"  type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                  <i class="fas fa-download"></i> BACK
                </a>
              </div>
            </div>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    {{-- @endforeach --}}
  </section>
  <!-- /.content -->
</div>

