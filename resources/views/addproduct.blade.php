@extends('layouts.sidebar')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Product Baru</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('addnewproduct')}}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_product">Name Product</label>
                    <input name="nama_product" type="text" class="form-control"  placeholder="name product">
                  </div>
                  <div class="form-group">
                    <label for="merk">Merk</label>
                    <input name="merk" type="text" class="form-control"  placeholder="merk product">
                  </div>
                  <div class="form-group">
                    <label for="warna">Color Product</label>
                    <input name="warna" type="text" class="form-control"  placeholder="warna product">
                  </div>
                  <div class="form-group">
                    <label for="name" class="col- col-form-label text-md-right">Gambar</label>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="gambar" required>
                    </div>
                </div>
                <div class="col-sm-12">
                  <button class="btn btn-primary mb-2" id="addButton" type="button">Tambah</button>
                  <div class="table-responsive">
                      <table id="itemTable" class="table table-light">
                          <thead>
                              <tr>
                                  <th scope="col">Size</th>
                                  <th scope="col">Harga</th>
                                  <th scope="col">Stok</th>
                              </tr>
                          </thead>
                          <tbody class="table-group-divider" id="tableBody">
                              <tr class="row1">
                                  <th><input style="min-width: 150px;" required name="size[]" class="form-control" type="number" placeholder="Masukan Size Item"></th>
                                  <th><input style="min-width: 150px;" required name="price[]" class="form-control" type="text" placeholder="Masukan Harga Item"></th>
                                  <td><input style="min-width: 150px;" required name="stok[]" class="form-control qty isNumber" type="number" placeholder="Masukan Jumlah Item"></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
                  
                  
                      
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button id="addproductButton" type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="buyModalLabel">Anda Berhasil Menambahkan Produk Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <script>
      // Animasi untuk memunculkan modal dengan efek fadeIn
      $('#addproductButton').click(function() {
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
      $(document).ready(function() {
          var addButton = $("#addButton");
          var elementContainer = $("#tableBody");
          var count = 2;
          addButton.on("click", function() {
              var newElement = $("<tr>")
                  .addClass(`row${count}`)
                  .html(`
                  <th><input style="min-width: 150px;" required name="size[]" class="form-control" type="number" placeholder="Masukan Size Item"></th>
                              <th><input style="min-width: 150px;" required name="price[]" class="form-control" type="text" placeholder="Masukan Harga Item"></th>
                              <td><input style="min-width: 150px;" required name="stok[]" class="form-control qty isNumber" type="number" placeholder="Masukan Jumlah Item"></td>
                              <td><button type="button" onclick="deleteElement(${count})" class="btn-delete btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td>
                      `);
              elementContainer.append(newElement);
              count++;
          });
      });
  </script>
    <!-- /.content -->
@endsection
