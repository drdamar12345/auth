@extends('layouts.sidebar')

@section('content')

<div class="container ">
  <div class="row" flex-direction="row">
      @foreach ($product as $item)
      <form action="{{route('proseschart')}}" method="POST" >
        {{ csrf_field() }}
        <div class="container py-2">
          <div class="collumn" >
            <div class="col-md-12 col-lg-16 mb-4 mb-lg-0">
              <div class="card">
                <div class="d-flex justify-content-between p-3">
                  <p class="lead mb-0">Daftar Sepatu</p>
                </div>
                <img src="{{asset('/gambar/').'/'  . $item['gambar']}}" alt="image" height="300" width="355 "
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
                  <button type="submit" button class="btn btn-info btn-block text-center" >Add To Cart</button>
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


<script type="text/javascript">
      $(".remove-from-keranjang").click(function (e) {
      let rowid = $(this).attr('row-id');
        e.preventDefault();

  

        var ele = $(this);

  

        if(confirm("Are you sure want to remove?")) {

            $.ajax({

                url: '{{ url('remove-from-keranjang') }}' + '/' + rowid,


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