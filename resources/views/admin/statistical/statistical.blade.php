@extends('admin.layouts.master')

@section('content')
<style type="text/css">
	.number{
		font-size: 26px;
	}
	.bg{
		background-color: #fff; padding: 20px
	}
	.container {
  width: 80%;
  margin: 20px auto;
}

.p {
  text-align: center;
  font-size: 14px;
  padding-top: 140px;
}
</style>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <h1>@if($id ==0)
 All Genre
 @else
 <?php $genre = \App\Genre::where('id',$id)->first()->name ;?>
 {{$genre}}
 @endif
 </h1>
<div class="row">
	<div class="col-sm-4 bg" >
		<p>All View </p>
		<p class="text-right number" > <b> {{$total}} </b></p>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-4 bg">
		<p>Today View </p>
		<p class="text-right number" ><b> {{$ondayView}} </b></p>
	</div>
	
</div>
<br>
<div class="row">
	<div class="col-sm-4 bg" >
		<p>All click </p>
		<p class="text-right number" > <b> {{$totalClick}} </b></p>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-4 bg">
		<p>Today click </p>
		<p class="text-right number" ><b> {{$onday}} </b></p>
	</div>
	
</div>
<br>
<div class="row">
	<div class="col-sm-4 bg" >
		<p>Left</p>
		<p class="text-right number" > <b> {{$left}} %</b></p>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-4 bg">
		<p>Right </p>
		<p class="text-right number" ><b> {{$right}} %  </b></p>
	</div>
</div>
<br>
<div id="exTab1" class="container">	
<ul  class="nav nav-pills">
			<li class="active">
        <a  href="#1a" data-toggle="tab">This month</a>
			</li>
			
		</ul>

			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="1a">
         
				<div class="row">
					<div class="col-sm-12" style="background-color: #fff">
					  <div>
					    <canvas id="canvas"></canvas>
					  </div>
					</div>
				</div>
				</div>
				<div class="tab-pane" id="2a">
         			
				</div>
        
			</div>
  </div>
<br>
<div id="exTab1" class="container">	
<ul  class="nav nav-pills">
			<li class="active">
        <a  href="#1a" data-toggle="tab">This year</a>
			</li>
			
		</ul>

			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="1a">
         
				<div class="row">
					<div class="col-sm-12" style="background-color: #fff">
					  <div>
					    <canvas id="canvas1"></canvas>
					  </div>
					</div>
				</div>
				</div>
				<div class="tab-pane" id="2a">
         			
				</div>
        
			</div>
  </div>
<div style="clear: both;"></div>
<div class="row">
	<div class="col-sm-4 bg" >
		<p>How long</p>
		<p class="text-right number" > <b> {{$timeAvg}} minute </b></p>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-4 bg">
		<p>Percent click</p>
		<p class="text-right number" > <b>{{$percentClick}} % </b></p>
	</div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
<script type="text/javascript">
	var arrName = <?php echo json_encode($date)?>;

	var aaa = <?php echo json_encode($aaa)?>;

var lineChartData = {
    labels: [aaa[1], aaa[2], aaa[3], aaa[4], aaa[5], aaa[6], aaa[7],aaa[8], aaa[9], aaa[10], aaa[11], aaa[12], aaa[13], aaa[14], aaa[15],aaa[16], aaa[17], aaa[18], aaa[19], aaa[20], aaa[21], aaa[22],aaa[23], aaa[24], aaa[25], aaa[26], aaa[27], aaa[28], aaa[29], aaa[30]],
    datasets: [{
        fillColor: "rgba(220,220,220,0)",
        strokeColor: "rgba(220,180,0,1)",
        pointColor: "rgba(220,180,0,1)",
        data: arrName
    }]

}

Chart.defaults.global.animationSteps = 50;
Chart.defaults.global.tooltipYPadding = 16;
Chart.defaults.global.tooltipCornerRadius = 0;
Chart.defaults.global.tooltipTitleFontStyle = "normal";
Chart.defaults.global.tooltipFillColor = "rgba(0,160,0,0.8)";
Chart.defaults.global.animationEasing = "easeOutBounce";
Chart.defaults.global.responsive = true;
Chart.defaults.global.scaleLineColor = "black";
Chart.defaults.global.scaleFontSize = 16;

var ctx = document.getElementById("canvas").getContext("2d");

var LineChartDemo = new Chart(ctx).Line(lineChartData, {
    pointDotRadius: 10,
    bezierCurve: false,
    scaleShowVerticalLines: false,
    scaleGridLineColor: "black"
});


var months = <?php echo json_encode($months)?>;

var lineChartData1 = {
    labels: ["1","2","3","4","5","6","7","8","9","10","11","12"],
    datasets: [{
        fillColor: "rgba(220,220,220,0)",
        strokeColor: "rgba(220,180,0,1)",
        pointColor: "rgba(220,180,0,1)",
        data: months
    }]

}
var ctx1 = document.getElementById("canvas1").getContext("2d");

var LineChartDemo = new Chart(ctx1).Line(lineChartData1, {
    pointDotRadius: 10,
    bezierCurve: false,
    scaleShowVerticalLines: false,
    scaleGridLineColor: "black"
});
</script>
@endsection