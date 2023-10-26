@extends('layouts.sidebar')

@section('content')
<form  >
  @csrf
  <div class="container py-2">
    <div class="row" flex-direction="row">
      @foreach ($product as $item)
      <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
        <div class="card">
          <div class="d-flex justify-content-between p-3">
            <p class="lead mb-0">Daftar Sepetu</p>
          </div>
          <img src="{{asset('')  . $item->gambar}}" alt="image" height="300" width="355 "
            class="card-img-top" alt=""  />
          <div class="card-body">
            {{-- <div class="d-flex justify-content-between">
              <p class="small"><a href="{{ url('products/'). '/'  .$item->id}}" class="text-muted">FOOD</a></p>
            </div> --}}
            <div class="form-select">
              <label><i class="fa fa-venus-mars"></i> Ukuran</label>
              <select class="selectpicker" name="ukuransepatu">
                <option type="radio" name="ukuran" value="37" title="37">37</option>
                <option type="radio" name="ukuran" value="38" title="38">38</option>
                <option type="radio" name="ukuran" value="39" title="39">39</option>
                <option type="radio" name="ukuran" value="40" title="40">40</option>
                <option type="radio" name="ukuran" value="41" title="41">41</option>
                <option type="radio" name="ukuran" value="42" title="42">42</option>
                <option type="radio" name="ukuran" value="43" title="43">43</option>
                <option type="radio" name="ukuran" value="44" title="44">44</option>
              </select>              
          </div>

            <div class="d-flex justify-content-between mb-3">
              <h5 class="mb-0">{{$item->nama_product}}</h5>

              <input type="hidden" class="text-dark mb-0" name="harga[]" value="{{$item->harga}}">{{$item->harga}}</h5>
            </div>
            {{-- <button type="submit" button class="btn btn-info btn-block text-center" >Add To Keranjang</button> --}}
            <p class="btn-holder"><a href="{{ route('add.to.cart', $item->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to Keranjang</a> </p>
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
      @endforeach
    </div>
  </div> 
</form>
@endsection