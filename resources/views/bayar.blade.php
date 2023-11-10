@extends('layouts.sidebar')

@section('content')
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
                From
                <address>
                  <strong>Bit Wallet</strong><br>
                  JL.LETJEND S.PARMAN X NO:84<br>
                  Jember, Jawa Timur, 68124<br>
                  Phone: 085270092112<br>
                  Email: info@almasaeedstudio.com
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
                <b>Order ID:</b> {{$bayar->order_id}}<br>
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
  
                      <td data-th="Harga">Rp{{ $item->harga }}</td>
  
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
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>{{$bayar->total}}</td>
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
