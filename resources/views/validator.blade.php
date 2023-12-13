@extends('layouts.sidebar')

@section('content')
<table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>

            <th style="width:25%">Name Product</th>

            <th style="width:25%">Total Product</th>

            <th style="width:25%">Tanggal Pesanan</th>

            <th style="width:25%">Harga Pesanan</th>


            <th style="width:10%"></th>

        </tr>

    </thead>
    <tbody>
        @foreach ($pesanan  as $item)
        <tr data-id="{{$item->id}}">
            <input type="hidden" name="id" value="{{$item->id}}">
            <td>{{$item->nama_product}}</td>
            <td>{{$item->qty}}</td>
            <td>{{$item->tanggal_pemesanan}}</td>
            <td>Rp.{{ number_format($item->harga, 0, ',', '.') }}</td>
            <td class="actions" data-th="">
                <a  href="{{ route('validatoraccept', $item->id) }}"> <button id="validatorButton" class="btn btn-success btn-sm">accept</button> </a>                        
            </td>
            <td class="actions" data-th="">
                        
                <button type="button" class="btn btn-danger btn-sm remove-from-validator"row-id='{{$item->id}}'>cancel</button>
              
            </td>
        <tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="buyModalLabel">Anda Berhasil Melakukan validasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Animasi untuk memunculkan modal dengan efek fadeIn
    $('#validatorButton').click(function() {
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
    $(".remove-from-validator").click(function (e) {
    let rowid = $(this).attr('row-id');
      e.preventDefault();



      var ele = $(this);



      if(confirm("Are you sure want to remove?")) {

          $.ajax({

              url: '{{ url('remove-from-validator') }}' + '/' + rowid,


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
@endsection;