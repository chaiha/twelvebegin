@extends('super.layouts.master')
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
        $("#submit_form").submit();

    });

  });

</script>
@stop
@section('content')
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="content add-margin-left-right">
	<div class="row">
		<div class="form-group">
		<h1>Delete record</h1>
		<h3>ข้อมูลได้ถูกลบออกจากระบบเป็นที่เรียบร้อยแล้ว</h3>
		
		<br />
		<a class="btn btn-success" href="{{url('/super/record/list_records')}}" role="button" id="confirm_btn">ย้อนกลับไปหน้าแรก</a>
		</div>
	</div>
</div>

@endsection