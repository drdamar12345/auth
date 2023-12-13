@extends('layouts.sidebar')
@section('content')
<div class="wrapper">
  <!-- Main content -->
  <section class="produk belum lunas">
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
            <th>Order_id</th>
            <th>Name_Customer</th>
            <th>Total_Produk</th>
            <th>Total</th>
            <th>Tanggal_Pemesanan</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            @php $i=1 @endphp
            @foreach ($products as $product)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{$product->id}}</td>
              <td>{{$product->name_customer}}</td>
              <td>{{$product->qty}}</td>
              <td>Rp.{{ number_format($product->total, 0, ',', '.') }}</td>
              <td>{{$product->date}}</td>
              <td class="actions" data-th="">

                <a  href="{{ route('pesananlunas', $product->id) }}"> <button class="btn btn-success"  id="orderButton" >LUNAS</button> </a>
                <a> <button class="btn btn-danger remove-from-pesanan"row-id='{{$product->id}}'> BATAL</button> </a>                                                
              </td>
              <td class="actions" data-th="">
                <p class="small"><a href="{{ url('bayars/'). '/'  .$product->id}}" class="text-muted">Cestak Struk</a></p>
              </td>
            </tr>
            {{-- <p class="small"><a href="{{ url('bayars/'). '/'  .$item->order_id}}" class="text-muted">Cestak Struk</a></p> --}}
            {{-- <p class="btn-holder"><a href="{{ route('pesananlunas', $item->order_id) }}" class="btn btn-info btn-block text-center" role="button">Lunas</a> </p>  --}}
            
                
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buyModalLabel">Pesanan Sudah Lunas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</div>
<script>
  // Animasi untuk memunculkan modal dengan efek fadeIn
  $('#orderButton').click(function() {
    $('#buyModal').modal('show');
    $('#buyModal .modal-dialog').attr('class', 'modal-dialog  fadeIn  animated'); // Animasi fadeIn
  });

  function confirmPurchase() {
    // Di sini Anda dapat menambahkan logika pembelian
    // Misalnya, panggil fungsi atau kirim request ke backend untuk melakukan pembelian

    // Contoh sederhana: menampilkan alert
    alert('Pembelian berhasil!');
    $('#buyModal').modal('hide'); // Sembunyikan modal setelah pembelian
  }
</script>
<script type="text/javascript">
  $(".remove-from-pesanan").click(function (e) {
  let rowid = $(this).attr('row-id');
    e.preventDefault();



    var ele = $(this);



    if(confirm("Apakah Yakin Ingin Di Remove?")) {

        $.ajax({

            url: '{{ url('remove-from-pesanan') }}' + '/' + rowid,


            method: "post",

            data: {

                _token: '{{ csrf_token() }}', 

                id: rowid
                

            },

            success: function (response) {

                window.location.reload();

            }

        });

    }

});
</script>
@endsection