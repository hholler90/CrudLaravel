@extends('templates.template')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<div class="container">
    <canvas id="myChart"></canvas>
    <canvas id="myChart2"></canvas>
</div>
{!!
   "<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx,$opcoes );

  const ctx2 = document.getElementById('myChart2');

  new Chart(ctx2,$opcoes2);
</script>"
!!}



@endsection