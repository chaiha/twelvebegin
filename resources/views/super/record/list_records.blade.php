@extends('super.layouts.master')

@section('content')
<?php
use App\Record;
use App\User;
?>
<!-- Services Section -->
<div class="content add-margin-left-right">
	<div class="row">
		<h1>List Records</h1>
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <th>#</th>
		      <th>no</th>
		      <th>code</th>
		      <th>source</th>
		      <th>status</th>
		      <th>categories</th>
		      <th>sub-categories</th>
		      <th>name_th</th>
		      <th>name_en</th>
		      <th>province</th>
		      <th>contact_person</th>
		      <th>contact_tel</th>
		      <th>contact_date</th>
		      <th>created_by</th>
		      <th>created_at</th>
		      <th>updated_by</th>
		      <th>updated_at</th>
		      <th>edit</th>
		      <th>delete</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($records as $each_record)
		    <tr>
		      <th scope="row">{{$each_record->id}}</th>
		      <td>{{$each_record->no}}</td>
		      <td>{{$each_record->code}}</td>
		      <td>{{$each_record->source}}</td>
		      <td>{{$each_record->status}}</td>
		      <td>{{$each_record->categories}}</td>
		      <td>{{$each_record->sub_categories}}</td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->province}}</td>
		      <td>{{$each_record->contact_person}}</td>
		      <td>{{$each_record->contact_tel}}</td>
		      <td>{{$each_record->contact_date}}</td>
		      <td><?php echo $user = User::get_first_name_by_id($each_record->created_by); ?></td>
		      <td>{{$each_record->created_at}}</td>
		      <td><?php echo $user = User::get_first_name_by_id($each_record->updated_by); ?></td>
		      <td>{{$each_record->updated_at}}</td>
		      <td><a href="{{ url('super/record/edit_record/'.$each_record->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
		      <td><a href="{{ url('super/record/delete_record/'.$each_record->id) }}"><span class="glyphicon glyphicon-trash"></span></a></td>
		    </tr>
		   @endforeach
		  </tbody>
		</table>
		{{$records->links()}}
	</div>
</div>

@endsection