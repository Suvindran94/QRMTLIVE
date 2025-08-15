<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <style>
     @page { margin-top:280px; }
     #header { position: fixed; left: 0px; top: -280px; right: 0px; height: 150px; text-align: center; }
     #footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 150px; text-align:center; }
     #footer .page:after { content: counter(page, upper-roman); }
   </style>
  <body>
   <div id="header">
  @foreach($layer as $layers)
<?php $layer3 = DB::table('qrmaster')
                ->distinct()
                ->select(['pallet','sonum','seq','qrcode','stockcode','dt_spvscanrev','layer'])
                ->where('sonum','=', $layers->sonum)
                ->where('pallet','=', $layers->pallet)
                ->where('layer','=', "Layer 1")
                ->where('dt_opscancomplete','!=', NULL)
                ->get();
$layer5 = DB::table('qrmaster')
                ->distinct()
                ->select(['pallet','sonum','seq','qrcode','stockcode','dt_spvscanrev','layer'])
                ->where('sonum','=', $layers->sonum)
                ->where('pallet','=', $layers->pallet)
                ->where('layer','=', "Layer 2")
                ->where('dt_opscancomplete','!=', NULL)
                ->get();
$layer6 = DB::table('qrmaster')
                ->distinct()
                ->select(['pallet','sonum','seq','qrcode','stockcode','dt_spvscanrev','layer'])
                ->where('sonum','=', $layers->sonum)
                ->where('pallet','=', $layers->pallet)
                ->where('layer','=', "Layer 3")
                ->where('dt_opscancomplete','!=', NULL)
                ->get();
$layer7 = DB::table('qrmaster')
                ->distinct()
                ->select(['pallet','sonum','seq','qrcode','stockcode','dt_spvscanrev','layer'])
                ->where('sonum','=', $layers->sonum)
                ->where('pallet','=', $layers->pallet)
                ->where('layer','=', "Layer 4")
                ->where('dt_opscancomplete','!=', NULL)
                ->get();
$layer8 = DB::table('qrmaster')
                ->distinct()
                ->select(['pallet','sonum','seq','qrcode','stockcode','dt_spvscanrev','layer'])
                ->where('sonum','=', $layers->sonum)
                ->where('pallet','=', $layers->pallet)
                ->where('layer','=', "Layer 5")
                ->where('dt_opscancomplete','!=', NULL)
                ->get();
 $layer4 = DB::table('qrmaster')
                ->where('sonum','=', $layers->sonum)
                ->where('pallet','=', $layers->pallet)
                ->where('dt_opscancomplete','!=', NULL)
                ->first();?>
@endforeach

<table align="center" style="width: 85%">
<tr>
<td>
   
<span style="font-size:12px"> <img style="height: 60px; width:240px" src="./img/pdf/logo.png" />(408370-M)</span>
          </td>
          <td align="right">
         
          <img style="height: 160px; width:160px" src="./img/tracking/<?php echo $layer4->pallet ?>.png" />
       
          </td>
            
 
    </tr>
    </table>



           
          
<table style="border:1px black solid; width:85%;" align="center">
<tr >
<td style="border:1px black solid;">SALES ORDER NO</td>
<td style="border:1px black solid;">: &nbsp;<?php echo $layer4->sonum ?></td>
</tr>
<tr >
<td style="border:1px black solid;">SHIPPING MARK</td>
@foreach($pallet as $pallets)
<td style="border:1px black solid;">: &nbsp;{{$pallets->shipmark}}&nbsp;</td>
@endforeach
</tr>
<tr >
<td style="border:1px black solid;">PALLET NO</td>
<td style="border:1px black solid;">: &nbsp;<?php echo $layer4->pallet ?></td>
</tr>
<tr >
     <?php 
                        date_default_timezone_set("Asia/Kuala_Lumpur"); 
                        $date = date('d-m-Y H:i:s'); 
                       ?>
<td style="border:1px black solid;">DATE PRINT</td>
<td style="border:1px black solid;">: &nbsp;<?php echo $date ?></td>
</tr>
</table>
   </div>
   <br>
   <div id="footer">
     <p class="page">Page <?php $PAGE_NUM ?></p>
   </div>
   <div id="content">
   <p style="margin-left:60px; "><b>Layer 1<b></p>
                @foreach($layer3 as $layers3)
                
                  <center>
                <div class="container">
            
                    <table align="center" style="width: 85%">
                  
                   <tr>
                  
                   <td>{{$layers3->seq}}</td>
                   <td>{{$layers3->sonum}}</td>
                   <td>{{$layers3->stockcode}}</td>
                   <td >{{$layers3->dt_spvscanrev}}</td>
                   <td align="right"> 
        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(80)->generate($layers3->qrcode)) }} ">
        </td>
                   </tr>
                    </center>
                     @endforeach
                    </table>
                   
<br>

           

                   
                  
                   
                   
                 <p style="text-align:left;margin-left:60px"><b>Layer 2<b></p>
                @foreach($layer5 as $layers5)
                
                  <center>
                <div class="container">
            
                    <table align="center" style="width: 85%">
                  
                   <tr>
                  
                   <td>{{$layers5->seq}}</td>
                   <td>{{$layers5->sonum}}</td>
                   <td>{{$layers5->stockcode}}</td>
                   <td >{{$layers5->dt_spvscanrev}}</td>
                   <td align="right"> 
        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(80)->generate($layers5->qrcode)) }} ">
        </td>
                   </tr>
                    </center>
                     @endforeach
                    </table>
                    <br>
                           <p style="text-align:left;margin-left:60px"><b>Layer 3<b></p>
                @foreach($layer6 as $layers6)
                
                  <center>
                <div class="container">
            
                    <table align="center" style="width: 85%">
                  
                   <tr>
                  
                   <td>{{$layers6->seq}}</td>
                   <td>{{$layers6->sonum}}</td>
                   <td>{{$layers6->stockcode}}</td>
                   <td >{{$layers6->dt_spvscanrev}}</td>
                   <td align="right"> 
        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(80)->generate($layers6->qrcode)) }} ">
        </td>
                   </tr>
                    </center>
                     @endforeach
                    </table>
                    </div>
                               <p style="text-align:left;margin-left:60px"><b>Layer 4<b></p>
                @foreach($layer7 as $layers7)
                
                  <center>
                <div class="container">
            
                    <table align="center" style="width: 85%">
                  
                   <tr>
                  
                   <td>{{$layers7->seq}}</td>
                   <td>{{$layers7->sonum}}</td>
                   <td>{{$layers7->stockcode}}</td>
                   <td >{{$layers7->dt_spvscanrev}}</td>
                   <td align="right"> 
        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(80)->generate($layers7->qrcode)) }} ">
        </td>
                   </tr>
                    </center>
                     @endforeach
                    </table>
                    </div>
                               
   </div>
 </body>
 </html>
