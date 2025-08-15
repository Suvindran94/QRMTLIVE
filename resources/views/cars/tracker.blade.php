<!DOCTYPE html>
<html lang="en" >


@extends('navigation.navbarcar')


<head>




<style>
#content {
    width: 400px;
    margin: 0 auto;

}
</style>
  <meta charset="UTF-8">
  <title>Responsive Checkout Progress Bar</title>
  <link rel="stylesheet" href="css/style4.css">
</head>
<div class="container"> 
<div style="width: 1000px; margin: 140px 12px 0 auto;"class="row justify-content-center">
<div class="col-md-12">
         
            <div class="form-horizontal ">
            <div class="form-group">
            <b><label for="inputOrderTrackingID" class="col-sm-8 control-label">CAR Reference Number</label></b>
            </div>
                <div class="form-group">
                    <label for="inputOrderTrackingID" class="col-sm-3 control-label"></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputOrderTrackingID" value="" placeholder="# put reference no here">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    <center> <button type="button" id="shopGetOrderStatusID" class="btn btn-success">Get status</button></center>
            <h4>CAR status:</h4>

            <ul class="list-group">
                <li class="list-group-item">
                    <span class="prefix">Date created:</span>
                    <b><span class="label label-success">12.07.2019</span></b>
                </li>
                <li class="list-group-item">
                    <span class="prefix">Last update:</span>
                    <b><span class="label label-success">22.07.2019</span></b>
                </li>
                <li class="list-group-item">
                    <span class="prefix">CAR type:</span>
                    <b><span class="label label-success">Internal Audit</span></b>
                </li>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </body>
                <body>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
                <meta name="viewport" content="width=device-width"><link rel="stylesheet" href="css/style5.css">
<!-- partial:index.partial.html -->
  <!-- STEPS -->
  <section id="Steps" class="steps-section">

    <h2 class="steps-header">
      CAR Status
    </h2>

    <div class="steps-timeline">

      <div class="steps-one">
        <img class="steps-img" src="img/icon1.png" alt="" />
        <h3 class="steps-name">
          Internal Auditor
        </h3>
        <p class="steps-description">
          CAR has been created
        </p>
      </div>

      <div class="steps-two">
      <img class="steps-img" src="img/icon2.png" alt="" />
        <h3 class="steps-name">
          QA Officer
        </h3>
        <p class="steps-description">
           CAR has been Validated
        </p>
      </div>

      <div class="steps-three">
      <img class="steps-img" src="img/icon3.png" alt="" />
        <h3 class="steps-name">
         Car Owner
        </h3>
        <p class="steps-description">
           Waiting for CAR owner to Submit Form.
        </p>
      </div>

    </div><!-- /.steps-timeline -->

  </section>
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<br>
<br>
</body>
<style>
 
 .footer {
  
     position: bottom;
  
     bottom: 0;
  
     width: 100%;
  
     height: 55px;
  
     background-color:#404040;
  
 }
  
 </style>
  
<footer class="footer">
 
 <div class="container">

 <p>&copy; Polyware Sdn Bhd | Privacy Policy | Terms of Service</p>

 </div>

</footer>
</html>