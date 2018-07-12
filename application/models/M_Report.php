<?php
/**
* 
*/
class M_Report extends CI_Model
{
	
	public function load_data($data){

		//print_r($_POST);
		$draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
	   $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
	   $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
	   $orderType = $_POST['order'][0]['dir']; // ASC or DESC
	   $start  = $_POST["start"];//Paging first record indicator.
	   $length = $_POST['length'];//Number of records that the table can display in the current draw
	   $limit ='';
	   if($length!= '-1'){
	   	 $limit = "LIMIT ".$start .','.$length;
	   }

	   $search = $_POST['search']['value'];


	   $columns = array(
	   	'date', 
	   	'time',
	   	'call_duration',
	   	'call_direction',
	   	'internal_number',
	   	'internal_name',
	   	'external_number',
	   	'external_name',
	   	'call_transferred_from',
	   	'call_answered',
	   	'call_transferred_to',
	   	'number_called',
	   	'call_pickuped_by'
	   );

	   $searchColumns = array(
	   "DATE_FORMAT(call_datetime, '%d.%m.%Y')", 
	   	'TIME(call_datetime)',
	   	'call_duration',
	   	'call_direction',
	   	'internal_number',
	   	'internal_name',
	   	'external_number',
	   	'external_name',
	   	'call_transferred_from',
	   	'call_answered',
	   	'call_transferred_to',
	   	'number_called',
	   	'call_pickuped_by'
	   );
	   
	   $where = '';
	   $wherekey = '';
	   $filter = 'no';

	   /*************Start Global search**********/
	   if(isset($search) && $search!=''){
	   	$filter = 'yes';
	   	$search = "%$search%";
	   	$where .= "AND (";
	   	foreach ($searchColumns as $skey=> $sValue) {
	   		$or ='';
	   		if($skey!='12'){
	   			$or = "OR";
	   		}
	   	 	$where .= " $searchColumns[$skey] LIKE '$search' $or ";
	   	}
	   	$where .= ")";
	   }
	   /*************End Global search**********/

	   /*************Start specific Column search**********/

	   	for($i=0; $i < count($searchColumns); $i++){
		   		$filter = 'yes';
		   		$svalue = $_POST['columns'][$i]['search']['value'];
		   		if(isset($svalue) && $svalue!=''){
		   			$svalue = "%$svalue%";
		   			$where .= "AND $searchColumns[$i] LIKE '$svalue' ";
		   		}
	   	}
	   /*************End specific Column search**********/

	   /*************Start direction search**********/
	  	$direction = '';
	   if( $_GET['startDate']!='' && $_GET['endDate']!='' ){
	   	$filter = 'yes';
		   	$from     = $_GET['startDate'];
		   	$to       = $_GET['endDate'];
	
	        $where .=  "AND DATE(call_datetime) >= '$from' AND DATE(call_datetime) <= '$to' ";
	   }

	   if($_GET['direction']!='' ){
	   	$filter = 'yes';
		   	   switch ($_GET['direction']) {
		   	   	case 'in':
		   	   		$direction = "AND call_direction LIKE '1 - eingehend' ";
		   	   		break;
		   	   	case 'out':
		   	   		$direction = "AND call_direction LIKE '2 - ausgehend' ";
		   	   		break;
		   	   	default:
		   	   		$direction = '';
		   	   		break;
	   	    }
		    $where .=  	$direction;
	    }
	     /*************End direction search**********/


	      /*************Start Additional Filter search**********/
	    $answeredfilter = '';
	    $durationfilter = '';
	    if($_GET['answeredfilter']=='yes'){
	    	$where .= "AND call_answered='1'";
	    }
	    if($_GET['durationfilter']=='yes'){
	    	$where .= "AND call_duration > '00:00:00'";
	    }
	    /*************End Additional Filter search**********/


	   $totalCondition = ' WHERE 1 '.$where;

	   if($orderBy =='0' || $orderBy =='1'){
	   	 $totalOrderBy = 'call_datetime';
	   }else{
	   	$totalOrderBy = $columns[$orderBy];
	   }

	   $sql = "SELECT DATE_FORMAT(call_datetime, '%d.%m.%Y') AS date, TIME(call_datetime) AS time , 
	    call_duration,
	   	call_direction,
	   	internal_number,
	   	internal_name,
	   	external_number,
	   	external_name,
	   	call_transferred_from,
	   	call_answered,
	   	call_transferred_to,
	   	number_called,
	   	call_pickuped_by 
	   	 FROM view_anrufe_all $totalCondition ORDER BY $totalOrderBy $orderType $limit";
	   	// echo $sql;
	   	//exit;
	   $records = $this->db->query($sql);
	   //$totalFilters = $records->num_rows();

	   //echo $this->db->last_query(); 
	    //print_r($records->result());
	   $info = array();
	   $duration = array();
	   foreach ($records->result() as $value) {
	   	$time = explode(':',$value->time);

	   	if (strpos($value->call_direction, 'eingehend') !== false) {
		   $direction = str_replace('eingehend', 'in', $value->call_direction);
		}
	   	if (strpos($value->call_direction, 'ausgehend') !== false) {
		  $direction = str_replace('ausgehend', 'out', $value->call_direction);
		}
	   	if($value->call_answered=='1'){
	   		$icon = '<i class="fa fa-check" style="color:#12d812;"></i>';
	   	}else{
	   		$icon = '<i class="fa fa-times" style="color:#ff0000;"></i>';
	   	}
	   		$rec = array(
	   			$value->date,
	   			$time[0].':'.$time[1],
	   			$value->call_duration,
	   			$direction,
	   			$value->internal_number,
	   			$value->internal_name,
	   			$value->external_number,
	   			$value->external_name,
	   			$value->call_transferred_from,
	   			$icon,
	   			$value->call_transferred_to,
	   			$value->number_called,
	   			$value->call_pickuped_by,
	   		);
	   		array_push($info, $rec);
	   		if(!is_null($value->call_duration)){
	   			$duration[] = $value->call_duration;
	   		}
	   		
	   }
	   $totalDuration =  $this->sum_the_time($duration); 
	   
	    $totalDurationSec  = $totalDuration[0]*60*60 + $totalDuration[1]*60;
	    $totalDurationSec = $totalDurationSec/$length;

	      $hours = floor($totalDurationSec/3600);
		  $totalDurationSec -= $hours*3600;
		  $totalDurationminutes  = floor($totalDurationSec/60);
		  $totalDurationSec -= $totalDurationminutes*60;


	   $totalResult = $this->db->query("SELECT * FROM view_anrufe_all");
	   $totalResultCount = $totalResult->num_rows();
	  
	  	if($filter = 'yes'){
	  		$totalFilters = $this->db->query("SELECT * FROM view_anrufe_all $totalCondition"); 
	   	$totalFiltersResult = $totalFilters->num_rows();
	   }else{
	   	$totalFiltersResult = $totalResultCount;
	   }
	   return array(
	   	'recordsTotal'    => $totalResultCount,
	   	'recordsFiltered' => $totalFiltersResult,
	   	'data'            => $info,
	   	'totalDuration'   => sprintf('%02d:%02d', $totalDuration[0], $totalDuration[1]),
	   	'percall'         => sprintf('%02d:%02d', $totalDurationminutes, $totalDurationSec),
	   	"draw"            => $_POST['draw'],
	   	);

	}
	function sum_the_time($times) {
	 // $times = array($time1, $time2);
	  $seconds = 0;
	  foreach ($times as $time)
	  {
	    list($hour,$minute,$second) = explode(':', $time);
	    $seconds += $hour*3600;
	    $seconds += $minute*60;
	    $seconds += $second;
	  }
	  $hours = floor($seconds/3600);
	  $seconds -= $hours*3600;
	  $minutes  = floor($seconds/60);
	  $seconds -= $minutes*60;
	   return array($hours,$minutes);// "{$hours}:{$minutes}";
	 // return sprintf('%02d:%02d', $hours, $minutes); // Thanks to Patrick
	}
}