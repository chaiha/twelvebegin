@extends('super.layouts.master')

@section('content')
<?php
use App\Record;
use App\User;
?>
<!-- Services Section -->
<div class="content add-margin-left-right">
	<div class="row">
		<h1>List Setting</h1>
		<table class="table">
		  <thead class="thead-inverse">
		    <tr>
		      <th>#</th>
		      <th>Name</th>
		      <th>value int</th>
		      <th>value char</th>
		      <th>created_by</th>
		      <th>created_at</th>
		      <th>updated_by</th>
		      <th>updated_at</th>
		      <th>edit</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($setting as $each_setting)
		    <tr>
		      <th scope="row">{{$each_setting->id}}</th>
		      <td>{{$each_setting->name}}</td>
		      <td>{{$each_setting->value_int}}</td>
		      <td>{{$each_setting->value_char}}</td>
		      <td><?php echo $user = User::get_first_name_by_id($each_setting->created_by); ?></td>
		      <td>{{$each_setting->created_at}}</td>
		      <td><?php echo $user = User::get_first_name_by_id($each_setting->updated_by); ?></td>
		      <td>{{$each_setting->updated_at}}</td>
		      <td><a href="{{ url('super/setting/edit_setting/'.$each_setting->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
		    </tr>
		   @endforeach
		  </tbody>
		</table>
	</div>
</div>

@endsection