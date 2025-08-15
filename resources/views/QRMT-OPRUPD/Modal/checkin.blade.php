
<!-- Modal -->
<div class="modal fade" id="switchuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Switch User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="container-fluid">

      <center> 
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">

        <div class="pd-20 card-box mb-30">

<h3>Please scan the QRCODE</h3>
       <img src="{{ asset('img/qrcode.gif') }}" style="padding-top:20px; height:350px; width:350px;">  


   <br><br><br>
       <input type="password"  class="form-control" style="text-align: center; width:300px;"  placeholder="QR Code" id="qrcodeoper" minlength="18" maxlength="18" name="qrcodeoper" autocomplete="off" required/> 
     


      
       <a class="btn btn-success" id="btnsave"  style="color:white; display:none;" role="button">
                    Submit
                </a>
             
                
        </div>

    

</div>
</div>
</center>

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>