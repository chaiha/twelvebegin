<?php
use App\Record;
use App\SelectRecord;
use App\User;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Export</title>
</head>
<body>
<table class="table">
		  <thead class="thead-inverse">
		  	<tr>
		  		<th>Sale id</th>
		  		<th>ชื่อร้านภาษาไทย</th>
		  		<th>ชื่อร้านภาษาภาษาอังกฤษ</th>
		  		<th>Privilege Start</th>
		  		<th>dtac type</th>
		  		<th>categories</th>
		  	</tr>
		  	</thead>
		  	@foreach($result as $result_each)
		  	<tr>
		  		<td>{{$result_each->sale_id}}</td>
		  		<td>{{$result_each->name_th}}</td>
		  		<td>{{$result_each->name_en}}</td>
		  		<?php
		  			$record = new Record;
		  			$start_date = $record->convert_date_formate($result_each->yes_privilege_start)
		  		?>
		  		<td>{{$start_date}}</td>
		  		<td>{{$result_each->dtac_type}}</td>
		  		<td>{{$result_each->categories}}</td>
		  	</tr>
		  	@endforeach
		</table>
</body>
</html>