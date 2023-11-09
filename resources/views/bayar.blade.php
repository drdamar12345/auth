@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Invoice</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Invoice</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    @dd($bayar);
    {{-- @foreach ($bayar as $item)           --}}
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
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
                  <i class="fas fa-globe"></i> AdminLTE.
                  <small class="float-right">Date: </small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>Admin, Inc.</strong><br>
                  795 Folsom Ave, Suite 600<br>
                  San Francisco, CA 94107<br>
                  Phone: (804) 123-5432<br>
                  Email: info@almasaeedstudio.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong></strong><br>
                  {{-- Alamat : {{$bayar->alamat}}<br> --}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice #007612</b><br>
                <br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2014<br>
                <b>Account:</b> 968-34567
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
                    <tr data-id="">
  
                      <td data-th="Product">
  
                          <div class="row">
  
                              <div class="col-sm-3 hidden-xs"><img src="{{asset('/gambar/').'/'  . $bayar->gambar}}" width="100" height="50" class="img-responsive"/></div>
  
                              <div class="col-sm-9">
  
                                  <h4 class="nomargin">{{ $bayar->nama_product }}</h4>

                                  <input type="hidden" name="product_id[]" value="{{$bayar->id_product}}">
                                  <input type="hidden" name="id[]" value="{{$bayar->id}}">


                              </div>
  
                          </div>
  
                      </td>
  
                      <td data-th="Price">Rp{{ $bayar->harga }}</td>
  
                        <input data-th="Subtotal" name="price[]" type="hidden" class="text-center" value="{{ intval($bayar->harga) * intval($bayar->qty) }}">{{ intval($details->harga) * intval($details->qty) }}</td>
  
                      <td class="actions" data-th="">
                        
                          <button type="button" class="btn btn-danger btn-sm remove-from-keranjang"row-id='{{$bayar->id}}'>BATAL</button>
                        
                      </td>
                      <td class="actions" data-th="">

                        {{-- <a  href="{{ route('addtobatal', $details->id) }}" class="btn btn-success"> BATAL </a>                         --}}
                      </td>
  
                  </tr>
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
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>$250.30</td>
                    </tr>
                    <tr>
                      <th>Tax (9.3%)</th>
                      <td>$10.34</td>
                    </tr>
                    <tr>
                      <th>Shipping:</th>
                      <td>$5.80</td>
                    </tr>
                    <tr>
                      <th>Total:</th>
                      <td>$265.24</td>
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
                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                  Payment
                </button>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                  <i class="fas fa-download"></i> Generate PDF
                </button>
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
@endsection
