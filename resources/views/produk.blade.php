@extends('layouts.sidebar')

@section('content')

<div class="container ">
  <div class="row" flex-direction="row">
      @foreach ($product as $item)
      <form action="{{route('proseschart')}}" method="POST" >
        {{ csrf_field() }}
        <div class="container py-2">
          <div class="collumn" >
            <div class="col-md-14 col-lg-16 mb-5 mb-lg-0">
              <div class="card">
                <div class="d-flex justify-content-between p-3">
                  <p class="lead mb-0">Daftar Sepatu</p>
                </div>
                <img src="{{asset('/gambar/').'/'  . $item['gambar']}}" alt="image" height="260" width="310 "
                  class="card-img-top" alt=""  />
                <div class="card-body">
                  {{-- <div class="d-flex justify-content-between">
                    <p class="small"><a href="{{ url('products/'). '/'  .$item->id}}" class="text-muted">FOOD</a></p>
                  </div> --}}
                  <input for="id_productName" type="hidden" class="text-dark mb-0" name="id" value="{{$item['id']}}">
                  <div class="form-select">
                    <label><i for="productSize" class=""></i> Ukuran</label>
                    <select class="selectpicker" name="ukuransepatu" id="productSize">
                      @foreach ($item['size'] as $size)
                      <option type="radio" value="{{$size->id}}">{{$size->size}}</option>
                      @endforeach
                    </select>              
                </div>
                  <div>
                      <h6>Total stock : {{$item['stock']}}</h6>
                  </div>
      
                  <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">{{$item['nama_product']}}</h5>
      
                    {{-- <input type="hidden" class="text-dark mb-0" name="harga" value="{{$item['harga']}}">Rp.<span id="priceDisplay"></span></h5> --}}
                  </div>
                  <button type="submit" id="buyButton" button class="btn btn-info btn-block text-center" >Add To Cart</button>
                  {{-- <p class="btn-holder"><a href="{{ route('add.to.cart', $item->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to Keranjang</a> </p> --}}
                  {{-- <p class="btn-holder"><a href="{{ route('add.to.favourite', $item->id) }}" class="btn btn-info btn-block text-center" role="button">Add to favourite</a> </p> --}}
      
      
                  <div class="d-flex justify-content-between mb-2">
                    <div class="ms-auto text-warning">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
    </form>
      @endforeach
  </div>
</div>
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buyModalLabel">Anda Berhasil Menambahkan Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</div>
<script>
  // Animasi untuk memunculkan modal dengan efek fadeIn
  $('#buyButton').click(function() {
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
      $('#productSize').change(function() {
          var id_productName = $('#id_productName').val();
          var productSize = $('#productSize').val();
          console.log(productSize) 
          var url = "{{ url('product-price') }}" + '/' + productSize;
          console.log(url)

          $.ajax({
              type: 'GET',
              url: "{{ url('product-price') }}" + '/' + productSize,
              data: {
                  '_token': '{{ csrf_token() }}',
                  'id': id_productName,
                  'ukuransepatu': productSize
              },
              success: function(response) {
                console.log(response)
                  $('#priceDisplay').text( + response.price.price);
              },
              error: function(response) {
                  $('#priceDisplay').text('Produk tidak ditemukan');
              }
          });
      });
  });
</script>
@endsection