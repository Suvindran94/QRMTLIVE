
<style>
#page td {
    padding: 0;
    margin: 0;

}
@page {
    margin: 0px;
}
</style>
@foreach ($prints as $prints)
<table>
<tr>
<td>
<center>
<?php $png = QrCode::format('png')->generate($prints->qrcode);
        $png = base64_encode($png);
        echo "<img style='margin-top:0px; width:180px; height:180px'src='data:image/png;base64," . $png . "'>";
        ?>
        </center>
        </td>
        </tr>
        <tr>
        <td>
        <center>
        {{$prints->StaffID}}
        </center>
        </td>
        </tr>
        </table>
        @endforeach