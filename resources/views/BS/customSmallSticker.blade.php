<style>
@page {
    size: 50cm 17cm;
}

@page {
    margin: 0px;
}

body {
    margin: 0px;
    font-family: arial;
	font-weight:bolder;

}

#page {
    border-collapse: collapse;
}
/* And this to your table's `td` elements. */
#page td {
    padding: 0;
	  padding-left: 30px;
    margin: 0;
		font-size: 65px;

}
@font-face {
    font-family: arial;
    font-style: bold;


}
.page-break {
    page-break-after: always;
}
</style>



@foreach ($prints3 as $prints3)
@foreach ($prints2 as $print2)
<?php $sticker = DB::table('solist')->get(['shipmark','sonum'])->where('sonum','=', $prints3->sonum);?>
@foreach ($sticker as $sticker)
<?php $edit = DB::table('template')->where('shipmark', '=' ,$sticker->shipmark)->get();?>
@foreach ($edit as $edits)


                     
<table class="page-break" align="center"  style="margin-top: 5px; width:48cm"  id="page">
    <tr >
		<td style="padding-top: 10px; font-size:85px">NO. {{$prints3->number}}</td>
		<td rowspan="6" style="width:18cm;">
			<?php
				$png = QrCode::format('png')->generate($prints3->qrcode);
				$png = base64_encode($png);
				echo "<img style=' float:right; width:650px; height:650px; 'src='data:image/png;base64," . $png . "'>";
			?>
		</td>
	</tr>
	<tr>  
		<td>&nbsp;</td>	 
	</tr>
<tr>
	<?php $sticker = DB::table('solist')->get(['shipmark','sonum'])->where('sonum','=', $prints3->sonum)->first();?>
	<td>{{$sticker->shipmark}} - {{$sticker->sonum}}</td>	 
</tr>
<tr>
	<td>{{ $prints3->stockcode }}</td>
</tr>
<tr>
	<td>QC BY : {{ $prints3->asgnto }}</td>
</tr>
<tr>
	<?php
	$newDateFormat3 = \Carbon\Carbon::parse($prints3->dt_printseal)->format("d/m/Y");
	?>
	<td>DATE : {{ $newDateFormat3 }}</td>
	
	
</tr>
											
</table>

@endforeach
@endforeach
@endforeach
@endforeach

