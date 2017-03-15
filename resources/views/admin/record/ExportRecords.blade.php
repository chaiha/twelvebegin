<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Export</title>
</head>
<body>
	<table>
		<tr>
			<td>Name</td>
			<td>Last name</td>
			<td>Email</td>
			<td>Tel</td>
		</tr>
		@foreach ($result as $result_each)
		<tr>
			<td>{{$result_each->id}}</td>
			<td>{{$result_each->name_th}}</td>
			<td>{{$result_each->branch}}</td>
			<td>{{$result_each->contact_tel}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>