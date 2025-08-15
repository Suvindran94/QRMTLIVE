@include('navigation.navbarcar')
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.7.0/bootstrap-maxlength.min.js"></script>
   <body>
<div class="container" >
        <div style="width: 1000px; margin: 140px 12px 0 auto;"class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
        <b><div class="card-header">{{ __('Internal Audit') }}</div><b>
<div class="card-body">
 
    {!! Form::open(['url' => '/processform', 'class' => 'form-horizontal']) !!}
 
    <fieldset>
 
                 <!-- Investigation -->
                 <div class="form-group">
            {!! Form::label('text', "Reference No", ['class' => 'col-lg-5 control-label']) !!}
            <div class="col-lg-5">
                {!! Form::text('text', $value = null, ['class' => 'form-control', 'rows' => 1], ['readonly']) !!}
               
            </div>
        </div>
 
        <!-- Department -->
        <div class="form-group">
            {!! Form::label('Department', 'To: Department', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
            {!!  Form::select('Select Department', ['S' => 'BIS', 'L' => 'QA', 'XL' => 'PLANNER', '2XL' => 'MANUFACTURING', '3XL' => 'WAREHOUSE'],  'S', ['class' => 'form-control' ]) !!}
            </div>
        </div>

              <!-- Name -->
              <div class="form-group">
            {!! Form::label('Name', 'Name', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
            {!!  Form::select('Select Role', ['S' => 'Steven', 'L' => 'Garry', 'XL' => 'Thomas', '2XL' => 'Kevin', '3XL' => 'Stephen'],  'S', ['class' => 'form-control' ]) !!}
            </div>
        </div>

          <!-- Due date -->
              <div class="form-group">
            {!! Form::label('deadline', 'Duedate', ['class' => 'col-lg-2 control-label']) !!}
        </div>
      

           <!-- Due date -->
           <div class="form-group">
            {!! Form::label('deadline', 'Correction', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-5">
            {{ Form::date('Duedate', new \DateTime(), ['class' => 'form-control']) }}

            
            </div>
        </div>
        <script>$('#datetimepicker').datetimepicker({format: 'yyyy-mm-dd'});</script>

           <!-- Due date -->
           <div class="form-group">
            {!! Form::label('deadline', 'Investigation and Corrective Action Plan', ['class' => 'col-lg-10 control-label']) !!}
            <div class="col-lg-5">
            {{ Form::date('Duedate', new \DateTime(), ['class' => 'form-control']) }}

            
            </div>
        </div>
        <script>$('#datetimepicker').datetimepicker({format: 'yyyy-mm-dd'});</script>

        
 
        <!-- Investigation -->
        <div class="form-group" >
            {!! Form::label('textarea', 'Problem Description', ['class' => 'col-lg-5 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::textarea('textarea', $value = null, ['class' => 'form-control', 'rows' => 10, 'maxlength' => 300]) !!}
  
               
            </div>
            <script type="text/javascript">
        $('textarea').maxlength({
              alwaysShow: true,
              placement: 'bottom-right'
        });
    </script>
        </div>

  





        <!-- Investigation -->
        <div class="form-group">
            {!! Form::label('text', "ISO 9001 Clause/s", ['class' => 'col-lg-5 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('text', $value = null, ['class' => 'form-control', 'rows' => 1]) !!}
               
            </div>
        </div>

             <!-- Investigation -->
             <div class="form-group">
            {!! Form::label('text', "Doc No", ['class' => 'col-lg-5 control-label']) !!}
            <div class="col-lg-5">
                {!! Form::text('text', $value = null, ['class' => 'form-control', 'rows' => 1]) !!}
               
            </div>
        </div>

         <!-- Investigation -->
             <div class="form-group">
            {!! Form::label('text', "Rev No", ['class' => 'col-lg-5 control-label']) !!}
            <div class="col-lg-5">
                {!! Form::text('text', $value = null, ['class' => 'form-control', 'rows' => 1]) !!}
               
            </div>
        </div>

          <!-- Due date -->
          <div class="form-group">
            {!! Form::label('deadline', 'Effective Date', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
            {{ Form::date('Duedate', new \DateTime(), ['class' => 'form-control']) }}

            
            </div>
        </div>
        <script>$('#datetimepicker').datetimepicker({format: 'yyyy-mm-dd'});</script>

          <!-- Investigation -->
          <div class="form-group">
            {!! Form::label('text', "Title", ['class' => 'col-lg-5 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('text', $value = null, ['class' => 'form-control', 'rows' => 1]) !!}
               
            </div>
        </div>
          <!-- Investigation -->
          <div class="form-group">
            {!! Form::label('text', "Supporting Documents", ['class' => 'col-lg-5 control-label']) !!}
            <div class="col-lg-10">
            {{ Form::file('image') }}
               
            </div>
        </div>

 
         <!-- Submit Button -->
         <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary confirm', 'data-confirm' => 'Are you sure you want to submit?']) !!}
                {!! Form::submit('Save', ['class' => 'btn btn-primary'] ) !!}
                {!! Form::reset('Reset', ['class' => 'btn btn-primary'] ) !!}
            </div>
            <script>
                $('.confirm').on('click', function (e) {
        if (confirm($(this).data('confirm'))) {
            return true;
        }
        else {
            return false;
        }
    });

</script>
        </div>
 
    </fieldset>
    {!! Form::close()  !!}

    
   
</div>
</div>
</div>
</div>
</div>
</div>

</b>
<style>
 
.footer {
 
    position: bottom;
 
    bottom: 0;
 
    width: 100%;
 
    height: 55px;
 
    background-color:#404040;
 
}


 
</style>

<script>
 $(document).ready(function() {
    formmodified=0;
    $('form *').change(function(){
        formmodified=1;
    });
    window.onbeforeunload = confirmExit;
    function confirmExit() {
        if (formmodified == 1) {
            return "New information not saved. Do you wish to leave the page?";
        }
    }
    $("input[name='commit']").click(function() {
        formmodified = 0;
    });
});
</script>
 
    <footer class="footer">
 
      <div class="container">
 
      <p>&copy; Polyware Sdn Bhd | Privacy Policy | Terms of Service</p>
 
      </div>
 
    </footer>
