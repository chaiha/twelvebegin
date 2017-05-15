@extends('admin.layouts.master')
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
<div class="container-fluid">
	<div class="row">
		<div class="form-group">
		<h1>สร้าง Lead ร้านค้าใหม่</h1>
		<h3>ข้อมูลได้ถูกจัดเก็บเป็นที่เรียบร้อยแล้ว</h3>
		
		<br />
		<a class="btn btn-success" href="{{url('/admin/record/list_records')}}" role="button" id="back">ย้อนกลับไปหน้าแรก</a>
		</div>
	</div>
</div>

@endsection