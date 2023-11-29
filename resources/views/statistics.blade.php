@extends('layouts.admin')
@section('content')


<canvas id="myChart" height="100px"></canvas>


@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js"></script>

<script type="text/javascript">

  

  var labels =  {{ Js::from($labels) }};

  var users =  {{ Js::from($data) }};

  console.log(labels, users);



  const data = {

    labels: labels,

    datasets: [{

      label: 'My First dataset',

      backgroundColor: 'rgb(255, 99, 132)',

      borderColor: 'rgb(255, 99, 132)',

      data: users,

    }]

  };



  const config = {

    type: 'line',

    data: data,

    options: {}

  };



  const myChart = new Chart(

    document.getElementById('myChart'),

    config

  );



</script> 
@endsection
