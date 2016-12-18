@extends('layouts.master')

@section('content')

<!-- Services Section -->
<div class="content">
	<div class="row">
		<div class="form-group">
		<h1>Edit record No. {{$record->no}}</h1>
		<form action="" method="">
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
			<div class="col-xs-2">
				<label>Status.</label>
				<select name="status"  class="selectpicker">
					<option value="1" <?php if($record->status == "1"){echo "selected";} ?>>1</option>
					<option value="2" <?php if($record->status == "2"){echo "selected";} ?>>2</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Category.</label>
				<select name="categories"  class="selectpicker">
					<option value="category" <?php if($record->categories == "category"){echo "selected";} ?>>category</option>
					<option value="2" <?php if($record->categories == "2"){echo "selected";} ?>>2</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label>Sub-Category.</label>
				<select name="sub_categories"  class="selectpicker">
					<option value="sub-cat" <?php if($record->sub_categories == "sub-cat"){echo "selected";} ?>>sub-cat</option>
					<option value="2" <?php if($record->sub_categories == "2"){echo "selected";} ?>>2</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Name Thai.</label>
				<input class="form-control" type="text" id="name_th" name="name_th" value="{{$record->name_th}}"/>
			</div>
			<div class="col-xs-6">
				<label>Name English.</label>
				<input class="form-control" type="text" id="name_en" name="name_en" value="{{$record->name_en}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Province.</label>
				<input class="form-control" type="text" id="province" name="province" value="{{$record->province}}"/>
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
				<label>Contact Date.</label>
				<input class="form-control" type="date" id="contact_date" name="contact_date" value="{{$record->contact_date}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Sale Id.</label>
				<input class="form-control" type="text" id="sale_id" name="sale_id" value="{{$record->sale_id}}" />
			</div>
			<div class="col-xs-6">
				<label>Result.</label>
				<select name="result">
					<option value="1" <?php if($record->result == "1"){echo "selected";} ?>>1</option>
					<option value="2" <?php if($record->result == "2"){echo "selected";} ?>>2</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Yes Lot No.</label>
				<input class="form-control" type="text" id="yes_lot_no" name="yes_lot_no" value="{{$record->yes_lot_no}}" />
			</div>
			<div class="col-xs-6">
				<label>Yes Sale Name.</label>
				<input class="form-control" type="text" id="yes_sale_name" name="yes_sale_name" value="{{$record->yes_sale_name}}" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Yes Privilege Start.</label>
				<input class="form-control" type="date" id="yes_privilege_start" name="yes_privilege_start" value="{{$record->yes_privilege_start}}" />
			</div>
			<div class="col-xs-6">
				<label>Yes Privilege End.</label>
				<input class="form-control" type="date" id="yes_privilege_end" name="yes_privilege_end" value="{{$record->yes_privilege_end}}" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Yes Feedback.</label>
				<textarea class="form-control" name="yes_feedback">{{$record->yes_feedback}}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>No Reason.</label>
				<textarea class="form-control" name="no_reason">{{$record->no_reason}}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>No Note.</label>
				<textarea class="form-control" name="no_note">{{$record->no_note}}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Cannot contact amount call.</label>
				<input class="form-control" type="number" id="cannot_contact_amount_call" name="cannot_contact_amount_call" value="{{$record->cannot_contact_amount_call}}" placeholder="0" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Cannot contact reason.</label>
				<input class="form-control" type="text" id="cannot_contact_reason" name="cannot_contact_reason" value="{{$record->cannot_contact_reason}}" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Cannot contact appointment.</label>
				<input class="form-control" type="date" id="cannot_contact_appointment" name="cannot_contact_appointment" value="{{$record->cannot_contact_appointment}}" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Consider reason.</label>
				<textarea class="form-control" name="consider_reason">{{$record->consider_reason}}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Consider appointment feedback.</label>
				<input class="form-control" type="date" name="consider_appointment_feedback" value="{{$record->consider_appointment_feedback}}"/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Wrong number New telephone number.</label>
				<input class="form-control" type="text" id="wrong_number_new_tel_number" name="wrong_number_new_tel_number" value="{{$record->wrong_number_new_tel_number}}" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<label>Close</label>
				<input type="checkbox" name="close" <?php if($record->close=="1"){echo "checked";}?> />
			</div>
		</div>
		<a class="btn btn-primary" href="#" role="button">Submit</a>
		</form>
		</div>
	</div>
</div>

@endsection