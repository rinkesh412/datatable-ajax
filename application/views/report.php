<html>
<head>
<title>Call Log</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->

<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/ju-1.11.4/jqc-1.11.3,dt-1.10.8/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/r/ju-1.11.4/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

<script src="https://getbootstrap.com/docs/3.3/dist/js/bootstrap.min.js"></script>
<!-- <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->

 <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script> 

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 

<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script> 
 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<style type="text/css">
	fieldset {
    padding: 5px !important;
    border: 1px solid !important;
}
legend {
    display: block;
    width: 68% !important;
    padding: 0;
    margin-bottom: 0px !important;
    font-size: 16px !important;
    line-height: inherit;
    color: #59aed8;
    border: 0 !important;
}
body,label,.dataTables_wrapper .dataTables_paginate .fg-button,div#reportTable_info{
	color: #22a6d8 !important;
}
.dt-buttons button {
    background-color: #5bc0de !important;
    background-image: none !important;
    color: #fff !important;
    border-color: #5bc0de !important;
}
.dt-buttons button:hover {
    color: #000 !important;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #22a6d8;
    opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: #22a6d8;
}

::-ms-input-placeholder { /* Microsoft Edge */
    color: #22a6d8;
}

.dataTables_wrapper .dataTables_processing {
    position: absolute;
    top: 5%;
    left: 50%;
    width: 100%;
    height: 90%;
    margin-left: -50%;
    /* margin-top: -25px; */
    padding-top: 145px;
    text-align: center;
    font-size: 3.2em;
    background-color: rgba(72, 66, 66, 0.18);
    /* background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255,255,255,0)), color-stop(25%, rgba(255,255,255,0.9)), color-stop(75%, rgba(255,255,255,0.9)), color-stop(100%, rgba(255,255,255,0))); */
    /* background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%); */
    background: -moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
    background: -ms-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
    background: -o-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
    /* background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%); */
}
</style>
</head>
<body>

<div class="container-fluid"> 
	<div class="row"> 
		<div class="col-md-12" role="main">

			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">Agfeo Es Call list</h3>
			  </div>
			  <div class="panel-body">
			    	<label>Total Calls: <span id="totalCalls">0</span></label> | 
			    	<label>Sum Duration: <span id="totalDuration">0</span> h:mm</label> | 
			    	<label>Per call: <span id="perCall">0</span> mm:ss</label>
			    	<div class="row"> 
			    	<div class="col-md-6">
			    		<input type="text" name="daterange" class="form-control" value="" placeholder="Filter by date">
			    	</div>

			    	<div class="col-md-2">
			    		<!--Radio group-->
						<div class="">
						    <input class="form-check-input" name="direction" value="both" type="radio" id="both" checked="">
						    <label class="form-check-label" for="both">Both</label>
						</div>

						<div class="">
						    <input class="form-check-input" value="in" name="direction" type="radio" id="in">
						    <label class="form-check-label"  for="in">1- in</label>
						</div>

						<div class="">
						    <input class="form-check-input" value="out" name="direction" type="radio" id="out">
						    <label class="form-check-label" for="out">2- out</label>
						</div>
						<!--Radio group--> 
			    	</div>

			    	<div class="col-md-2">
			    		<fieldset>
			    			<legend>Additional Filter</legend>
						<div class="">
						    <input class="form-check-input" name="answeredfilter" value="yes" type="checkbox" id="answeredfilter" >
						    <label class="form-check-label" for="answeredfilter">Only Answered</label>
						</div>

						<div class="">
						    <input class="form-check-input" name="durationfilter" value="yes" type="checkbox" id="durationfilter">
						    <label class="form-check-label" for="durationfilter">Duration > 0</label>
						</div>
						</fieldset>
			    	</div>

			    	<div class="col-md-3">
			    		<button id="reset" class="btn btn-info" type="button">Reset all filters to default</button>
			    	</div>

			    	</div>
			    	<br>
			   <div class="table-responsive"> 	
			  	<table id="reportTable" class="display" style="width:auto;">
			        <thead>
			            <tr>
			                <th>Date</th>
			                <th>Time</th>
			                <th>Duration</th>
			                <th>Direction</th>
			                <th>int. Number</th>
			                <th>int. Name</th>
			                <th>ext. Number</th>
			                <th>ext. Name</th>
			                <th>Transfer from</th>
			                <th>Answered</th>
			                <th>Transfer to</th>
			                <th>Number Called</th>
			                <th>Pickuped by</th>
			            </tr>
			        </thead>
			         <tfoot>
		            <tr>
		                <th>Date</th>
		                <th>Time</th>
		                <th>Duration</th>
		                <th>Direction</th>
		                <th>int. Number</th>
		                <th>int. Name</th>
		                <th>ext. Number</th>
		                <th>ext. Name</th>
		                <th>Transfer from</th>
		                <th>Answered</th>
		                <th>Transfer to</th>
		                <th>Number Called</th>
		                <th>Pickuped by</th>
		            </tr>
		        </tfoot> 
			    </table>
			    </div>	
			    <br>
			    	

			  </div>
			</div>

		</div>
	</div>
</div>	

<script>
var table;
var filter ='';
var direction ='',startDate='',endDate='',answeredfilter='',durationfilter='';
var serachableCols = [4,5,6,7];
	$(document).ready(function() {
		var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip incon from call answered column to make it yes,no
                    if(column === 9){
                    	data = data.replace( '<i class="fa fa-check" style="color:#12d812;"></i>', 'yes' );
                    	data = data.replace( '<i class="fa fa-times" style="color:#ff0000;"></i>', 'no' );
                    }
                    return data;
                } 
            }
        }
    };


		$('#reportTable tfoot th').each( function (idx) {
			//console.log($.inArray(idx,serachableCols));
			if($.inArray(idx,serachableCols)!= '-1'){
				var title = $(this).text();
	          $(this).prepend( '<input style="width:100px;" class="searchCols" type="text"  placeholder="Search" />' );
			}else{
				//$(this).html(''); 
			}
	        
	    } );
		

	  table =   $('#reportTable').DataTable({
	    	responsive: true,
	        "processing": true,
	        "serverSide": true,
	      	dom: 'Bfrtip',
	      	"order": [[ 0, "desc" ]],
	      	lengthMenu: [
		        [ 10, 25, 50, 100, -1 ],
		        [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
		    ],
	        buttons: [
	        	$.extend( true, {}, buttonCommon, {
		                extend: 'excel',text: 'Download Result as .xlsx'
		         } ),

	        	'pageLength'
			],
		    "language": {
		        "sSearch": "Search all columns:",
		         "processing": "Hang on. Waiting for response..." //add a loading image,simply putting <img src="loader.gif" /> tag.
		    },
	        "pagingType": "full_numbers",

	        "ajax": {
		        "url" : "<?php echo site_url('report/getRecords') ?>?&startDate="+''+"&endDate="+''+"&direction="+''+"&answeredfilter="+''+"&durationfilter="+'',
		        "type": "POST",
		    },
		    
		    "drawCallback": function( settings ) {
		        var api = this.api();
		        $("#totalCalls").text(api.rows( {page:'current'} ).data().length);
		        //console.log( api.rows( {page:'current'} ).data() );
		    }
	    }).on('xhr.dt', function ( e, settings, json, xhr ) {
        	//console.log( json.data.length);
        	$("#totalDuration").text(json.totalDuration);
        	$("#perCall").text(json.percall);
   		 });


	   table.columns().every( function () {
		        var that = this;
		 
		        $( 'input', this.footer() ).on( 'keyup change', function () {
		            if ( that.search() !== this.value ) {
		                that
		                    .search( this.value )
		                    .draw();
		            }
		        } );
		} );





	  $('input[name="daterange"]').daterangepicker({
	    opens: 'left',
	    autoApply: true,
	    showDropdowns: true,
	    locale: {
	      format: 'DD.MM.YYYY'
	    },
	  }, function(start, end, label) {
	    //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
	    startDate =  start.format('YYYY-MM-DD');
	    endDate =    end.format('YYYY-MM-DD');
	    loadTable();
	  });
	  $('input[name="daterange"]').val('');
	  /*$('input[name="daterange"]').on('hide.daterangepicker', function(ev, picker) {
		  //do something, like clearing an input
		  $('input[name="daterange"]').val('');
	  });*/


	   $('input[name="direction"]').click(function(){
	      direction = $('input[name="direction"]:checked').val();
	      loadTable();
	   });

	   $("#answeredfilter , #durationfilter").on('click',function(){
	   		//console.log($("#answeredfilter:checked").val());
	   		//console.log($("#durationfilter:checked").val());
	   		if($("#answeredfilter:checked").val()){
	   			answeredfilter= $("#answeredfilter:checked").val();
	   		}else{
	   			answeredfilter='';
	   		}
	   		if($("#durationfilter:checked").val()){
	   			durationfilter= $("#durationfilter:checked").val();
	   			
	   		}else{
	   			durationfilter='';
	   		}
		    loadTable();
	   });
	    
	//reset
	$("#reset").on('click',function(){
		 $('input[name="daterange"]').val('');

		 $("#both").prop('checked','true');

		  $("#answeredfilter").prop('checked',false);

		   $("#durationfilter").prop('checked',false);

		 $('input[type="search"]').val('');

		 direction ='';
		 startDate='';
		 endDate='';
		 answeredfilter='';
		 durationfilter='';
		 
		 $('.searchCols').each( function () {  $(this).val('');  });

		 table.search( '' ).columns().search( '' );


		 loadTable();
	});

});

function loadTable(){
	
	filter = "&startDate="+startDate+"&endDate="+endDate+"&direction="+direction+"&answeredfilter="+answeredfilter+''+"&durationfilter="+durationfilter;
	console.log(filter);
	table.ajax.url( "<?php echo site_url('report/getRecords') ?>?"+filter ).load();
}

	
</script>


</body>
</html>


