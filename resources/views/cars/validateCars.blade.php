
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Elegant Table Design</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
    body {
        color: #566787;

		background: #f5f5f5;
		font-family: 'Arial';
        font-size: 14px;
        padding-top:110px;
	}
	.table-wrapper {
		background: #f0f3f7;
        padding: 20px 25px;
        margin: 30px auto;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-wrapper .btn {
		float: right;
		color: #333;
    	background-color: #fff;
		border-radius: 3px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title {
		padding-bottom: 15px;
		background: #299be4;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn {
		color: #566787;
		float: right;
		font-size: 13px;
		background: #fff;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}

	
	.table-title .btn:hover, .table-title .btn:focus {
        color: #566787;
		background: #f2f2f2;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.settings {
        color: #2196F3;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
	.status {
		font-size: 30px;
		margin: 2px 2px 0 0;
		display: inline-block;
		vertical-align: middle;
		line-height: 10px;
	}
    .text-success {
        color: #10c469;
    }
    .text-info {
        color: #62c9e8;
    }
    .text-warning {
        color: #FFC107;
    }
    .text-danger {
        color: #ff5b5b;
    }
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
	.show-entries select.form-control {        
        width: 60px;
		margin: 0 5px;
	}
	.table-filter .filter-group {
        float: right;
		margin-left: 15px;
    }
	.table-filter input, .table-filter select {
		height: 34px;
		border-radius: 3px;
		border-color: #ddd;
        box-shadow: none;
	}
	.table-filter {
		padding: 5px 0 15px;
		border-bottom: 1px solid #e9e9e9;
		margin-bottom: 5px;
	}
	.table-filter .btn {
		height: 34px;
	}
	.table-filter label {
		font-weight: normal;
		margin-left: 10px;
	}
	.table-filter select, .table-filter input {
		display: inline-block;
		margin-left: 5px;
	}
	.table-filter input {
		width: 200px;
		display: inline-block;
	}
	.filter-group select.form-control {
		width: 110px;
	}
	.filter-icon {
		float: right;
		margin-top: 7px;
	}
	.filter-icon i {
		font-size: 18px;
		opacity: 0.7;
	}	
	.show-entries select.form-control {        
        width: 70px;
		margin: 0 5px;
	}
	.table-wrapper .btn.btn-primary22 {
		color: #fff;
		background: #03A9F4;
	}
	.table-wrapper .btn.btn-primary:hover {
		background: #03a3e7;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

   
    <script src="script.js"></script>

@include('navigation.navbarcar')
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="validateForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Validate Car</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin:0 auto; 
width:580px;">
       <div class="form-group">
            {!! Form::label('Department', 'Car Owner: Department', ['class' => 'col-lg-3 control-label']) !!}
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
                <!-- Investigation -->
                <div class="form-group">
            {!! Form::label('textarea', 'Immediate Action / Correction', ['class' => 'col-lg-5 control-label'] ) !!}
            <div class="col-lg-10">
            {!! Form::textarea('textarea', $value = null, ['class' => 'form-control', 'rows' => 10, 'maxlength' => 300]) !!}
            </div>
            <script type="text/javascript">
        $('textarea').maxlength({
              alwaysShow: true,
              placement: 'top-left'
        });
    </script>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Validate</button>
      </div>
    </div>
  </div>
</div>
<body>
<div class="container" >
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<h2>Validate<b> Cars</b></h2>
					</div>
					<div class="col-sm-8">						
						<a href="#" class="btn btn-primary"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
					</div>
                </div>
            </div>
			<div class="table-filter">
				<div class="row">
                    <div class="col-sm-3">
						<div class="show-entries">
							<span>Show</span>
							<select class="form-control">
								<option>5</option>
								<option>10</option>
								<option>15</option>
								<option>20</option>
							</select>
							<span>entries</span>
						</div>
					</div>
                    <div class="col-sm-9">
						<button type="button" class="btn btn-primary22"><i class="fa fa-search"></i></button>
						<div class="filter-group">
							<label>Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="filter-group">
							<label>CAR Type</label>
							<select class="form-control">
								<option>All</option>
								<option>Internal Audit</option>
								<option>Internal Customer</option>
								<option>Let's Improve</option>
								<option>External Customer</option>
								<option>External Provider</option>								
							</select>
						</div>
					
						<span class="filter-icon"><i class="fa fa-filter"></i></span>
                    </div>
                </div>
			</div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Issued by</th>
						<th>CAR Type</th>
						<th>Issued Date</th>						
                        <th>Status</th>	
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
					<td>1</td>
                        <td><a href="#"><img src="/img/face1.png" style="height:30px;width:30px;" class="avatar" alt="Avatar"> Michael Holz</a></td>
						<td>Internal Customer</td>
                        <td>Jun 15, 2019</td>                        
                        <td><span class="status text-success">&bull;</span> Validated</td>
						<td>
							<a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xe417;</i></a>
                            <a href="#" class="Validate" title="Validate"  data-toggle="modal" data-target="#validateForm"><i class="material-icons">&#10004;</i></a>
						
						</td>
                    </tr>
					<tr>
					<td>2</td>
                        <td><a href="#"><img src="/img/face2.png" style="height:30px;width:30px;" class="avatar" alt="Avatar"> Paula Wilson</a></td>
                        <td>External Provider</td>                       
						<td>Jun 21, 2019</td>
                        <td><span class="status text-success">&bull;</span> Validated</td>
						<td>
						<a href="{{ url('externalProvPDF') }}" target="_blank" class="view " title="View" data-toggle="tooltip"><i class="material-icons">&#xe417;</i></a>
                        <a href="#" class="Validate" title="Validate"  data-toggle="modal" data-target="#validateForm"><i class="material-icons">&#10004;</i></a>
						</td>
                    </tr>
					<tr>
					<td>3</td>
                        <td><a href="#"><img src="/img/face3.png" style="height:30px;width:30px;"  class="avatar" alt="Avatar"> Antonio Moreno</a></td>
						<td>External Customer</td>
                        <td>Jul 04, 2019</td>
                        <td><span class="status text-danger">&bull;</span> Not Validated</td>
						<td>
						<a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xe417;</i></a>
                        <a href="#" class="Validate" title="Validate"  data-toggle="modal" data-target="#validateForm"><i class="material-icons">&#10004;</i></a>
						</td>                        
                    </tr>
					<tr>
					<td>4</td>
                        <td><a href="#"><img src="/img/face4.png" style="height:30px;width:30px;"  class="avatar" alt="Avatar"> Mary Saveley</a></td>
						<td>Internal Customer</td>
                        <td>Jul 16, 2019</td>						
                        <td><span class="status text-danger">&bull;</span> Not Validated</td>
						<td>
						<a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xe417;</i></a>
                        <a href="#" class="Validate" title="Validate"  data-toggle="modal" data-target="#validateForm"><i class="material-icons">&#10004;</i></a>
						</td>
                    </tr>
					<tr>
					<td>5</td>
                        <td><a href="#"><img src="/img/face5.png" style="height:30px;width:30px;" class="avatar" alt="Avatar"> Martin Sommer</a></td>
						<td>Internal Audit</td>
                        <td>Aug 04, 2019</td>
                        <td><span class="status text-success">&bull;</span> Validated</td>
						<td>
						<a href="{{ url('internalAuditPDF') }}" target="_blank" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xe417;</i></a>
							<a href="#" class="Validate" title="Validate"  data-toggle="modal" data-target="#validateForm"><i class="material-icons">&#10004;</i></a>
						</td>
                    </tr>
                </tbody>
            </table>
			<div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>     
</body>
</html>                                		                            
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
   
</body>
</html>                                		                            