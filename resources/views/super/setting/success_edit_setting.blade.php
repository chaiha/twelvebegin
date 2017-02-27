@extends('super.layouts.master')
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
        alert("sibmt");
        //$("#submit_form").submit();

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
		<h1>SuccessEdit Setting</h1>
		<h1>การแก้ไขค่า Setting เสร้จสิ้น</h1>
		<a class="btn btn-danger" href="{{ url('super/setting/index') }}" role="button" id="cancel_btn">ย้อนกลับไปหน้าแรก</a>
		{{ Form::close() }}
	</div>
</div>

@endsection