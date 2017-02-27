@extends('admin.layouts.master')

@section('content')
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="container">
	<div class="row">
		<div class="form-group">
		<h1>Create new record</h1>
		<form action="" method="">
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				<input type="hidden" id="id" name="id" value="" />
				<input class="form-control" type="text" id="no" name="no" value=""/>
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				<input class="form-control" type="text" id="code" name="code" value=""/>
			</div>
			<div class="col-xs-3">
				<label>Status.</label>
				<select name="validity"  class="selectpicker">
					<option value="1" >Available</option>
					<option value="2" >Not Available</option>
				</select>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-3">
				<label>Sources.</label>
				<select name="sources"  class="selectpicker">
					<option value="online_search" >Online Search</option>
					<option value="dtac_recommend" >DTAC Recommend</option>
					<option value="walking" >Walking</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Categories.</label>
				<select name="categories"  class="selectpicker">
					<option value="dinning_and_beverage" >Dining & Beverage</option>
					<option value="shopping_and_lifestyle" >Shopping & Lifestyle</option>
					<option value="beauty_and_healthy" >Beauty & Healthy</option>
					<option value="hotel_and_travel" >Hotel & Travel</option>
					<option value="6" >Online</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Dtac Type.</label>
				<select name="dtac_type"  class="selectpicker">
					<option value="ร้านกทม" >ร้าน กทม</option>
					<option value="ร้านตจว" >ร้าน ตจว</option>
					<option value="ร้านonline" >ร้าน online</option>
					<option value="ร้านต่ออายุ" >ร้านต่ออายุ</option>
					<option value="ร้านดีลอย่างเดียว" >ร้านดีลอย่างเดียว</option>
					<option value="ร้านเฉพาะอาร์ทเวิร์ค" >ร้านเฉพาะอาร์ทเวิร์ค</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>ประเภทร้าน.</label>
				<select name="shop_type"  class="selectpicker">
					<option value="ร้านเบ็ดเตล็ด" >ร้าน เบ็ดเตล็ด</option>
					<option value="ร้านอาหาร" >ร้าน อาหาร</option>
					<option value="ร้านอาหารนานาชาติ" >ร้าน อาหารนานาชาติ</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Name Thai.</label>
				<input class="form-control" type="text" id="name_th" name="name_th" value=""/>
			</div>
			<div class="col-xs-4">
				<label>Name English.</label>
				<input class="form-control" type="text" id="name_en" name="name_en" value=""/>
			</div>
			<div class="col-xs-4">
				<label>สาขา.</label>
				<input class="form-control" type="text" id="branch" name="branch" value=""/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ที่อยู่.</label>
				<input class="form-control" type="text" id="address" name="address" value=""/>
			</div>
			<div class="col-xs-6">
				<label>จังหวัด.</label>
				<input class="form-control" type="text" id="province" name="province" value=""/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Contact Person.</label>
				<input class="form-control" type="text" id="contact_person" name="contact_person" value=""/>
			</div>
			<div class="col-xs-4">
				<label>Contact Telephone number.</label>
				<input class="form-control" type="text" id="contact_tel" name="contact_tel" value=""/>
			</div>
			<div class="col-xs-4">
				<label>Contact Email.</label>
				<input class="form-control" type="text" id="contact_email" name="contact_email" value=""/>
			</div>
			<div class="col-xs-4">
				<label>Contact Date [ วัน / เดือน / ปี ]</label>
				<div class="row">
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">วัน</span>
							<input class="form-control" type="text" id="contact_day" name="contact_day" value=""/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">เดือน</span>
							<input class="form-control" type="text" id="contact_month" name="contact_month" value=""/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">ปี</span>
							<input class="form-control" type="text" id="contact_year" name="contact_year" value=""
							/>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Sale Id.</label>
				<input class="form-control" type="text" id="sale_id" name="sale_id" value="" />
			</div>
			<div class="col-xs-6">
				<label>Result.</label>
				<select name="result">
					<option value="1" >Yes</option>
					<option value="2" >No</option>
					<option value="3" >Waiting</option>
					<option value="4" >No Authorize</option>
					<option value="5" >No Reply</option>
					<option value="6" >Wrong Number</option>
					<option value="7" >Closed</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Yes Lot No.</label>
				<input class="form-control" type="text" id="yes_lot_no" name="yes_lot_no" value="" />
			</div>
			<div class="col-xs-6">
				<label>Yes Sale Name.</label>
				<input class="form-control" type="text" id="yes_sale_name" name="yes_sale_name" value="" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Yes Privilege Start [ วัน / เดือน / ปี ]</label>
				<div class="row">
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">วัน</span>
							<input class="form-control" type="text" id="yes_privilege_start_day" name="yes_privilege_start_day" value="" />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">เดือน</span>
							<input class="form-control" type="text" id="yes_privilege_start_month" name="yes_privilege_start_month" value="" />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">ปี</span>
							<input class="form-control form-inline" type="text" id="yes_privilege_start_year" name="yes_privilege_start_year" value="" />
						</div>
					</div>
				</div>

			</div>
			<div class="col-xs-6">
				<label>Yes Privilege End [ วัน / เดือน / ปี ]</label>
				<div class="row">
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">วัน</span>
							<input class="form-control" type="text" id="yes_privilege_end_day" name="yes_privilege_end_day" value="" />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">เดือน</span>
							<input class="form-control" type="text" id="yes_privilege_end_month" name="yes_privilege_end_month" value="" />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">ปี</span>
							<input class="form-control form-inline" type="text" id="yes_privilege_end_year" name="yes_privilege_end_year" value="" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Yes Feedback.</label>
				<textarea class="form-control" name="yes_feedback"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>No Reason.</label>
				<textarea class="form-control" name="no_reason"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>No Note.</label>
				<textarea class="form-control" name="no_note"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Cannot contact amount call.</label>
				<input class="form-control" type="number" id="cannot_contact_amount_call" name="cannot_contact_amount_call" value="" placeholder="0" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Cannot contact reason.</label>
				<input class="form-control" type="text" id="cannot_contact_reason" name="cannot_contact_reason" value="" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Cannot contact appointment [ วัน / เดือน / ปี ]</label>
				<div class="row  input-group">
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">วัน</span>
							<input class="form-control" type="text" id="cannot_contact_appointment_day" name="cannot_contact_appointment_day" value="" />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">เดือน</span>
							<input class="form-control" type="text" id="cannot_contact_appointment_month" name="cannot_contact_appointment_month" value="" />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">ปี</span>
							<input class="form-control form-inline" type="text" id="cannot_contact_appointment_year" name="cannot_contact_appointment_year" value="" />
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Consider reason.</label>
				<textarea class="form-control" name="consider_reason"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Consider appointment feedback.</label>
				<div class="row  input-group">
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">วัน</span>
							<input class="form-control" type="text" id="consider_appointment_feedback_day" name="consider_appointment_feedback_day" value="" />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">เดือน</span>
							<input class="form-control" type="text" id="consider_appointment_feedback_month" name="consider_appointment_feedback_month" value="" />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">ปี</span>
							<input class="form-control form-inline" type="text" id="consider_appointment_feedback_year" name="consider_appointment_feedback_year" value="" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Wrong number New telephone number.</label>
				<input class="form-control" type="text" id="wrong_number_new_tel_number" name="wrong_number_new_tel_number" value="" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Close</label>
				<input type="checkbox" name="close"/>
			</div>
		</div>
		<a class="btn btn-primary" href="#" role="button">Submit</a>
		</form>
		</div>
	</div>
</div>

@endsection