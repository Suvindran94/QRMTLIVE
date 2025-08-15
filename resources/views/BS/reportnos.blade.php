<html>
	<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<h1>Report</h1>
		
		<table style="width:80%">
			@foreach($date as $date)
			<tr>
				<td>Printed By</td>
				<td>:</td>
				<td>{{auth()->user()->name}}</td>
					<td>Date Printed</td>
				<td>:</td>
				<td><?php
		date_default_timezone_set("Asia/Kuala_Lumpur");
		echo date('d-m-Y H:i:s');
		?></td>
			</tr>
		
			<tr>
				<td>Date From</td>
				<td>:</td>
				<td>
					<?php
					$newStart = date("d-m-Y", strtotime($date->dt_from)); 
					echo $newStart;
					?>
				</td>
				<td>To</td>
				<td>:</td>
				<td>
					<?php
					$newEnd = date("d-m-Y", strtotime($date->dt_to)); 
					echo $newEnd;
					?>
				</td>
			</tr>
			
			@endforeach
		</table>
		<br>
	<table class="table table-sm table-striped">
  <thead>
    <tr>
	  <th scope="col">No</th>
      <th scope="col">Sonum</th>
      <th scope="col">Stockcode</th>
      <th scope="col">Date</th>
	  <th scope="col">Operator</th>
	  <th scope="col">Location</th>
	  <th scope="col">Qty</th>
    </tr>
  </thead>
	
  <tbody>
	  <?php  $i = 1;?>
	   <?php $locations = DB::table('tempsearch')->select('location','searchby')->where('searchby','=', auth()->user()->id)->groupBy('location','searchby')->orderBy('location', 'asc')->get(); ?>
	  @foreach($locations as $locations)
	  <?php  $reservation1 = DB::table('tempsearch')->select('sonum','stockcode','asgnto','searchby','dt_opscancomplete','location')->where('searchby','=', auth()->user()->id)->where('location','=', $locations->location)->groupBy('sonum','stockcode','asgnto','searchby','dt_opscancomplete','location')->orderBy('dt_opscancomplete', 'asc')->get();?>
	  @foreach($reservation1 as $reservations)
	 
	  <tr>
		  <td style="font-size:13px">{{$i++}}</td>
		  <td style="font-size:13px">{{$reservations->sonum}}</td>
		  <td style="font-size:13px">{{$reservations->stockcode}}</td>
		  <td style="font-size:13px">
		   <?php 
			  $newEnd = date("d-m-Y", strtotime($reservations->dt_opscancomplete));
			  echo $newEnd;
	  		?>
		  </td>
		   <td style="font-size:13px">
		   <?php $user = DB::table('users')->where("StaffID","=", $reservations->asgnto)->get(); ?>
      @foreach ($user as $user)
      {{$user->name}}
      @endforeach
		  </td>
		    <td style="font-size:13px">
		   <?php $location = DB::table('moresolist')->where("sonum","=", $reservations->sonum)->where("stockcode","=", $reservations->stockcode)->get(); ?>
      @foreach ($location as $location)
      {{$location->location}}
      @endforeach
		  </td>
		  <td style="font-size:13px">
		  <?php 
	   $ttl = DB::table('tempsearch')->where('sonum','=', $reservations->sonum)->where('stockcode','=', $reservations->stockcode)->where('asgnto','=', $reservations->asgnto)->where('dt_opscancomplete','=', $reservations->dt_opscancomplete)->where('searchby','=', auth()->user()->id)->get();
			   $sum = 0;
    foreach ($ttl as $ttl){
        $sum+= $ttl->quantity;
    }
    echo $sum.' NOS';
	  ?>
		  </td>
	  </tr>
	  @endforeach
	 @endforeach
  </tbody>
		
	
</table>
		<hr>
		<table style="width:26%" align="right">
		
		 <tr>
      <th style="font-size:13px" >Plant P</th>
      <th  style="text-align:right; font-size:13px">
		  <?php 
	  $ttl3 = DB::table('tempsearch')->where('searchby','=', auth()->user()->id)->where('location','=', 'Plant P')->get();
			   $sum3 = 0;
    foreach ($ttl3 as $ttl3){
        $sum3+= $ttl3->quantity;
    }
    echo $sum3.' NOS';
	  ?>
		</th>
    </tr>
		  <tr>
			  <th style="font-size:13px" >Plant Z</th>
      <th  style="text-align:right; font-size:13px">
		  <?php 
	  $ttl4 = DB::table('tempsearch')->where('searchby','=', auth()->user()->id)->where('location','=', 'Plant Z')->get();
			   $sum4 = 0;
    foreach ($ttl4 as $ttl4){
        $sum4+= $ttl4->quantity;
    }
    echo $sum4.' NOS';
	  ?>
		</th>
    </tr>
		  <tr>
      <th style="font-size:13px" >Plant M</th>
      <th  style="text-align:right; font-size:13px">
		  <?php 
	  $ttl5 = DB::table('tempsearch')->where('searchby','=', auth()->user()->id)->where('location','=', 'Plant M')->get();
			   $sum5 = 0;
    foreach ($ttl5 as $ttl5){
        $sum5+= $ttl5->quantity;
    }
    echo $sum5.' NOS';
	  ?>
		</th>
    </tr>
			 <tr>
      <th style="font-size:13px" colspan="2"><hr></th>
      
    </tr>
    <tr>
      <th style="font-size:13px" >Total</th>
      <th  style="text-align:right; font-size:13px">
		  <?php 
	  $ttl2 = DB::table('tempsearch')->where('searchby','=', auth()->user()->id)->get();
			   $sum = 0;
    foreach ($ttl2 as $ttl2){
        $sum+= $ttl2->quantity;
    }
    echo $sum.' NOS';
	  ?>
		</th>
    </tr>
 	 <tr>
      <th style="font-size:13px" colspan="2"><hr></th>
      
    </tr>
		</table>
	</body>
</html>