@extends('super.layouts.master')
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
        if(confirm('กรุณายืนยันก่รแก้ไข'))
        {
        	$("#submit_form").submit();
        }
    });

  });

</script>
@stop
@section('content')
<?php
use App\Record;
use App\User;
?>
<!-- Services Section -->
<div class="container add-margin-left-right">
	<div class="row">
		<h1>Edit Setting</h1>
		{{Form::open(array('action' => 'SuperController@submit_edit_setting','id'=>'submit_form'))}}
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
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <th scope="row">{{$result->id}}</th>
		      <td>{{$result->name}}<input type="hidden" name="id" value="{{$result->id}}" /></td>
		      <td><input type="text" name="value_int" value="{{$result->value_int}}" /></td>
		      <td><input type="text" name="value_char" value="{{$result->value_char}}"</td>
		      <td><?php echo $user = User::get_first_name_by_id($result->created_by); ?></td>
		      <td>{{$result->created_at}}</td>
		      <td><?php echo $user = User::get_first_name_by_id($result->updated_by); ?></td>
		      <td>{{$result->updated_at}}</td>
		    </tr>
		  </tbody>
		</table>
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-danger" href="{{ url('super/setting/index') }}" role="button" id="cancel_btn">Cancel</a>
		{{ Form::close() }}
	</div>
</div>

@endsection