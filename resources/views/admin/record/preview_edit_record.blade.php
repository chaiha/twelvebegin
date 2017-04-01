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
	<div class="col-md-12">
		<div class="form-group">
		<h1>Edit record</h1>
		<h3>กรุณาตรวจทานข้อมูลก่อนยืนยัน</h3>
		{{Form::open(array('action' => 'AdminController@submit_edit_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				{{$record['no']}}
				<input class="form-control" type="hidden" id="record_id" name="record_id" value="{{$record['id']}}"/>
				<input class="form-control" type="hidden" id="no" name="no" value="{{$record['no']}}"/>
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				{{$record['code']}}
				<input class="form-control" type="hidden" id="code" name="code" value="{{$record['code']}}"/>
			</div>
			<div class="col-xs-3">
				<label>Status.</label>
				{{$record['status']}}
				<input class="form-control" type="hidden" id="status" name="status" value="{{$record['status']}}"/>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-2">
				<label>Sources.</label>
				{{$record['sources']}}
				<input class="form-control" type="hidden" id="sources" name="sources" value="{{$record['sources']}}"/>
			</div>
			<div class="col-xs-2">
				<label>Categories.</label>
				{{$record['categories']}}
				<input class="form-control" type="hidden" id="categories" name="categories" value="{{$record['categories']}}"/>
			</div>
			<div class="col-xs-2">
				<label>Dtac Type.</label>
				{{$record['dtac_type']}}
				<input class="form-control" type="hidden" id="dtac_type" name="dtac_type" value="{{$record['dtac_type']}}"/>
			</div>
			<div class="col-xs-2">
				<label>ประเภทร้าน.</label>
				{{$record['shop_type']}}
				<input class="form-control" type="hidden" id="shop_type" name="shop_type" value="{{$record['shop_type']}}"/>
			</div>
			<div class="col-xs-4">
				<label>ประเภทร้านพิเศษ</label>
				{{$record['shop_type']}}
				<input class="form-control" type="hidden" id="special_type" name="special_type" value="{{$record['special_type']}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Name Thai.</label>
				{{$record['name_th']}}
				<input class="form-control" type="hidden" id="name_th" name="name_th" value="{{$record['name_th']}}"/>
			</div>
			<div class="col-xs-4">
				<label>Name English.</label>
				{{$record['name_en']}}
				<input class="form-control" type="hidden" id="name_en" name="name_en" value="{{$record['name_en']}}"/>
			</div>
			<div class="col-xs-4">
				<label>สาขา.</label>
				{{$record['branch']}}
				<input class="form-control" type="hidden" id="branch" name="branch" value="{{$record['branch']}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ที่อยู่.</label>
				{{$record['address']}}
				<input class="form-control" type="hidden" id="address" name="address" value="{{$record['address']}}"/>
			</div>
			<div class="col-xs-6">
				<label>จังหวัด.</label>
				{{$record['province']}}
				<input class="form-control" type="hidden" id="province" name="province" value="{{$record['province']}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ละติจูด.</label>
				{{$record['latitude']}}
				<input class="form-control" type="hidden" id="latitude" name="latitude" value="{{$record['latitude']}}"/>
			</div>
			<div class="col-xs-6">
				<label>ลองติจูด.</label>
				{{$record['longtitude']}}
				<input class="form-control" type="hidden" id="longtitude" name="longtitude" value="{{$record['longtitude']}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Contact Person.</label>
				{{$record['contact_person']}}
				<input class="form-control" type="hidden" id="contact_person" name="contact_person" value="{{$record['contact_person']}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Telephone number.</label>
				{{$record['contact_tel']}}
				<input class="form-control" type="hidden" id="contact_tel" name="contact_tel" value="{{$record['contact_tel']}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Email.</label>
				{{$record['contact_email']}}
				<input class="form-control" type="hidden" id="contact_email" name="contact_email" value="{{$record['contact_email']}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Date [ วัน / เดือน / ปี ]</label>
				<div class="row">
					<div class="col-xs-4">
						<div class="input-group">
							<b>วัน</b>
							{{$record['contact_day']}}
							<input class="form-control" type="hidden" id="contact_day" name="contact_day" value="{{$record['contact_day']}}"/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<b>เดือน</b>
							{{$record['contact_month']}}
							<input class="form-control" type="hidden" id="contact_month" name="contact_month" value="{{$record['contact_month']}}"/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<b>ปี</b>
							{{$record['contact_year']}}
							<input class="form-control" type="hidden" id="contact_year" name="contact_year" value="{{$record['contact_year']}}" />
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Link.</label>
				{{$record['links']}}
				<input class="form-control" type="hidden" id="links" name="links" value="{{$record['links']}}"/>
			</div>
			<div class="col-xs-6">
				<label>Remarks.</label>
				{{$record['remarks']}}
				<input class="form-control" type="hidden" id="remarks" name="remarks" value="{{$record['remarks']}}"/>
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-primary" href="{{ url('admin/record/edit_record/'.$record['id']) }}" role="button" id="edit_btn">Edit</a>
		<a class="btn btn-danger" href="{{ url('admin/record/list_records') }}" role="button" id="cancel_btn">Cancel</a>
		{{ Form::close() }}
		</div>
	</div>
	</div>
</div>

@endsection