@extends('admin.layouts.master')

@section('content')
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
        $("#submit_form").submit();

    });

  });

</script>
@stop
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="container-fluid">
	<div class="row">
		<div class="form-group">
		<h1>Edit record</h1>
		<h3>กรุณาตรวจทานข้อมูลก่อนยืนยัน</h3>
		{{Form::open(array('action' => 'AdminController@preview_edit_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				<input type="hidden" id="id" name="id" value="{{$record->id}}" />
				<input class="form-control" type="text" id="no" name="no" value="{{$record->no}}"/>
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				<input class="form-control" type="text" id="code" name="code" value="{{$record->code}}"/>
			</div>
			<div class="col-xs-3">
				<label>Status.</label>
				<select name="status"  class="selectpicker">
					<option value="Available" <?php if($record->status=="Available"){echo "selected";}?>>Available</option>
					<option value="Not_available" <?php if($record->status=="Not_available"){echo "selected";}?>>Not Available</option>
				</select>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-3">
				<label>Sources.</label>
				<select name="sources"  class="selectpicker">
					<option value="online_search" <?php if($record->sources=="online_search"){echo "selected";}?>>Online Search</option>
					<option value="dtac_recommend" <?php if($record->sources=="dtac_recommend"){echo "selected";}?>>DTAC Recommend</option>
					<option value="walking" <?php if($record->sources=="walking"){echo "selected";}?>>Walking</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Categories.</label>
				<select name="categories"  class="selectpicker">
					<option value="dinning_and_beverage" <?php if($record->categories=="dinning_and_beverage"){echo "selected";}?>>Dining & Beverage</option>
					<option value="shopping_and_lifestyle" <?php if($record->categories=="shopping_and_lifestyle"){echo "selected";}?>>Shopping & Lifestyle</option>
					<option value="beauty_and_healthy" <?php if($record->categories=="beauty_and_healthy"){echo "selected";}?>>Beauty & Healthy</option>
					<option value="hotel_and_travel" <?php if($record->categories=="hotel_and_travel"){echo "selected";}?>>Hotel & Travel</option>
					<option value="online" <?php if($record->categories=="dinning_and_beverage"){echo "selected";}?>>Online</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Dtac Type.</label>
				<select name="dtac_type"  class="selectpicker">
					<option value="ร้านกทม" <?php if($record->dtac_type=="ร้านกทม"){echo "selected";}?>>ร้าน กทม</option>
					<option value="ร้านตจว" <?php if($record->dtac_type=="ร้านตจว"){echo "selected";}?>>ร้าน ตจว</option>
					<option value="ร้านonline" <?php if($record->dtac_type=="ร้านonline"){echo "selected";}?>>ร้าน online</option>
					<option value="ร้านต่ออายุ" <?php if($record->dtac_type=="ร้านต่ออายุ"){echo "selected";}?>>ร้านต่ออายุ</option>
					<option value="ร้านดีลอย่างเดียว" <?php if($record->dtac_type=="ร้านดีลอย่างเดียว"){echo "selected";}?>>ร้านดีลอย่างเดียว</option>
					<option value="ร้านเฉพาะอาร์ทเวิร์ค" <?php if($record->dtac_type=="ร้านเฉพาะอาร์ทเวิร์ค"){echo "selected";}?>>ร้านเฉพาะอาร์ทเวิร์ค</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>ประเภทร้าน.</label>
				<select name="shop_type"  class="selectpicker">
					<option value="ร้านเบ็ดเตล็ด" <?php if($record->shop_type=="ร้านเบ็ดเตล็ด"){echo "selected";}?>>ร้าน เบ็ดเตล็ด</option>
					<option value="ร้านอาหาร" <?php if($record->shop_type=="ร้านอาหาร"){echo "selected";}?>>ร้าน อาหาร</option>
					<option value="ร้านอาหารนานาชาติ" <?php if($record->shop_type=="ร้านอาหารนานาชาติ"){echo "selected";}?>>ร้าน อาหารนานาชาติ</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Name Thai.</label>
				<input class="form-control" type="text" id="name_th" name="name_th" value="{{$record->name_th}}"/>
			</div>
			<div class="col-xs-4">
				<label>Name English.</label>
				<input class="form-control" type="text" id="name_en" name="name_en" value="{{$record->name_en}}"/>
			</div>
			<div class="col-xs-4">
				<label>สาขา.</label>
				<input class="form-control" type="text" id="branch" name="branch" value="{{$record->branch}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ที่อยู่.</label>
				<input class="form-control" type="text" id="address" name="address" value="{{$record->address}}"/>
			</div>
			<div class="col-xs-6">
				<label>จังหวัด.</label>
				<input class="form-control" type="text" id="province" name="province" value="{{$record->province}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ละติจูด.</label>
				<input class="form-control" type="text" id="latitude" name="latitude" value="{{$record->latitude}}"/>
			</div>
			<div class="col-xs-6">
				<label>ลองติจูด.</label>
				<input class="form-control" type="text" id="longitude" name="longitude" value="{{$record->longitude}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Contact Person.</label>
				<input class="form-control" type="text" id="contact_person" name="contact_person" value="{{$record->contact_person}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Telephone number.</label>
				<input class="form-control" type="text" id="contact_tel" name="contact_tel" value="{{$record->contact_tel}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Email.</label>
				<input class="form-control" type="text" id="contact_email" name="contact_email" value="{{$record->contact_email}}"/>
			</div>
			<div class="col-xs-4">
				<label>Contact Date [ วัน / เดือน / ปี ]</label>
				<?php
					$contact_date = explode("-",$record->contact_date);
					$contact_day = $contact_date[1];
					$contact_month = $contact_date[2];
					$contact_year = $contact_date[0];
				?>
				<div class="row">
					<div class="col-xs-4">
						<div class="input-group">
							<b>วัน</b>
							<input class="form-control" type="text" id="contact_day" name="contact_day" value="{{$contact_day}}"/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<b>เดือน</b>
							<input class="form-control" type="text" id="contact_month" name="contact_month" value="{{$contact_month}}"/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<b>ปี</b>
							<input class="form-control" type="text" id="contact_year" name="contact_year" value="{{$contact_year}}" />
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Link.</label>
				<input class="form-control" type="text" id="links" name="links" value="{{$record->links}}"/>
			</div>
			<div class="col-xs-6">
				<label>Remarks.</label>
				<input class="form-control" type="text" id="remarks" name="remarks" value="{{$record->remarks}}"/>
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-danger" href="{{ url('admin/record/list_records') }}" role="button" id="cancel_btn">Cancel</a>
		{{ Form::close() }}
		</div>
	</div>
</div>

@endsection