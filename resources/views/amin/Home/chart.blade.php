@extends('amin.Home')
@section('tile', 'Quản lý menu')
@section('main')
    @parent
    @php
        $i = array(1,2,3,4,5,6,7,8,9,10,11,12);

    @endphp
    @foreach ($data as $dt)
        <input type="text" id="m-{{$dt->m}}" value="{{$dt->sum_}}" hidden>
        @php
            $i[$dt->m] = 0;
        @endphp

    @endforeach
    @foreach ($i as $j)
        @if ($j !=0)
            <input type="text" id="m-{{$j}}" value="0" hidden>

        @endif

    @endforeach
    <div class="container-fluid">
        <div id="chart-area">

        </div>

    </div>

<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current',{packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart(){
        var m1 = $('#m-1').val()- null;
        var m2 = $('#m-2').val()- null;
        var m3 = $('#m-3').val()- null;
        var m4 = $('#m-4').val() - null;
        var m5 = $('#m-5').val() - null;
        var m6 = $('#m-6').val()- null;
        var m7 = $('#m-7').val()- null;
        var m8 = $('#m-8').val()- null;
        var m9 = $('#m-9').val()- null;
        var m10 = $('#m-10').val()- null;
        var m11 = $('#m-11').val()- null;
        var m12 = $('#m-12').val()- null;
        console.log(m4);
    var data = google.visualization.arrayToDataTable([
    ['Month', 'value'],
    [1,m1],[2,m2],[3,m3],[4,m4],[5,m5],[6,m6],
    [7,m7],[8,m8],[9,m9],[10,m10],[11,m11],[12,m12]
    ]);
    // Set Options
    var options = {
    title: 'Doanh thu theo tháng năm 2022',
    hAxis: {title: 'Tháng'},
    vAxis: {title: 'VND'},
    legend: 'none'
    };
    // Draw Chart
    var chart = new google.visualization.LineChart(document.getElementById('chart-area'));
    chart.draw(data, options);
        }
</script>
@endsection
