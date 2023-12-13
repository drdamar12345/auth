@extends('layouts.sidebar')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Restock Barang</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('restockaction')}}" method="POST">
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-select">
            <label><i class=""></i> Name Product</label>
            <select class="selectpicker" name="nama">
                @foreach ($product as $item)
                <option type="radio" value="{{$item->id}}" title="">{{$item->nama_product}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
            <input name="tanggal_pemesanan" type="date" class="form-control"  placeholder="tanggal pemesanan">
          </div>
          <div class="col-sm-12">
            <div class="table-responsive">
                <table id="itemTable" class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">Size</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="tableBody">
                        <tr class="row1">
                            <th><input style="min-width: 150px;" required name="size[]" class="form-control" type="number" placeholder="Masukan Size Item"></th>
                            <th><input style="min-width: 150px;" required name="price[]" class="form-control" type="number" placeholder="Masukan Harga Item"></th>
                            <td><input style="min-width: 150px;" required name="qty[]" class="form-control qty isNumber" type="number" placeholder="Masukan Jumlah Item"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button id="restockButton" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="buyModalLabel">Anda Berhasil Melakukan restock, silahkan melakukan validasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Animasi untuk memunculkan modal dengan efek fadeIn
    $('#restockButton').click(function() {
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
  <script>

{{-- <script>
    let sizeIndex = 1;
    $(document).ready(function() {
        var addButton = $("#addButton");
        var elementContainer = $("#tableBody");
        var count = 2;

        addButton.on("click", function() {
            var newElement = $("<tr>")
                .addClass(`row${count}`)
                .html(`
                    <th><input style="min-width: 150px;" required name="size[${sizeIndex}][]" class="form-control" type="number" placeholder="Masukan Size Item"></th>
                    <th><input style="min-width: 150px;" required name="price[${sizeIndex}][]" class="form-control" type="text" placeholder="Masukan Harga Item"></th>
                    <td><input style="min-width: 150px;" required  name="qty[${sizeIndex}][]" class="form-control qty isNumber" type="number" placeholder="Masukan Jumlah Item"></td>
                    `);
            elementContainer.append(newElement);

            count++;
        });
    });
</script> --}}

@endsection;