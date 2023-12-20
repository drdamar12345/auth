@extends('layouts.sidebar')
@section('content')


{{-- <canvas id="myChart" height="100px"></canvas> --}}
<canvas id="myChart"></canvas>


@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js"></script>

<script>
  var label =  {{ Js::from($label) }};

var value1 =  {{ Js::from($value) }};

console.log(label, value1);

  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: label,
      datasets: [{
        label: '# of Votes',
        data: value1,
        borderWidth: 10
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

{{-- <script type="text/javascript">



  var label =  {{ Js::from($label) }};

  var value1 =  {{ Js::from($value) }};

  console.log(label, value1);



  const value = {

    label: label,

    valuesets: [{

      label: 'My First valueset',

      backgroundColor: 'rgb(255, 99, 132)',

      borderColor: 'rgb(255, 99, 132)',

      value: value1,

    }]

  };



  const config = {

    type: 'line',

    value: value1,

    options: {}

  };



  const myChart = new Chart(

    document.getElementById('myChart'),

    config

  );
  new Chart(myChart, {
    type: 'line',
    data: {
      labels: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


</script>  --}}
@endpush
