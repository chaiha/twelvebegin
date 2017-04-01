@extends('admin.layouts.master')

@section('content')
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="container-fluid">
	<div class="row">
		<h1>List Records</h1>
		<table class="table table-bordered">
		  <thead class="thead-inverse">
		    <tr>
		      <th>#</th>
		      <th>no</th>
		      <th>code</th>
		      <th>source</th>
		      <th>status</th>
		      <th>categories</th>
		      <th>ประเภทร้านค้าพิเศษ</th>
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
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($records as $each_record)
		    <tr>
		      <th scope="row">{{$each_record->id}}</th>
		      <td>{{$each_record->no}}</td>
		      <td>{{$each_record->code}}</td>
		      <td>{{$each_record->sources}}</td>
		      <td>{{$each_record->status}}</td>
		      <td>{{$each_record->categories}}</td>
		      <td>{{$each_record->special_type}}</td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->province}}</td>
		      <td>{{$each_record->contact_person}}</td>
		      <td>{{$each_record->contact_tel}}</td>
		      <td>{{$each_record->contact_date}}</td>
		      <td>{{$each_record->created_by}}</td>
		      <td>{{$each_record->created_at}}</td>
		      <td>{{$each_record->updated_by}}</td>
		      <td>{{$each_record->updated_at}}</td>
		      <td><a href="{{ url('admin/record/edit_record/'.$each_record->id) }}">Edit</a></td>
		    </tr>
		   @endforeach
		  </tbody>
		</table>
		{{$records->links()}}
	</div>
</div>

@endsection