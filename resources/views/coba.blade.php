@extends('layouts.sidebar')
@section('content')


<canvas id="myChart" height="100px"></canvas>


@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js"></script>

<script type="text/javascript">



  var label =  {{ Js::from($label) }};

  var value =  {{ Js::from($value) }};

  console.log(label, value);



  const value = {

    label: label,

    valuesets: [{

      label: 'My First valueset',

      backgroundColor: 'rgb(255, 99, 132)',

      borderColor: 'rgb(255, 99, 132)',

      value: value,

    }]

  };



  const config = {

    type: 'line',

    value: $value,

    options: {}

  };



  const myChart = new Chart(

    document.getElementById('myChart'),

    config

  );


</script> 
@endsection
