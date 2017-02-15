@extends('super.layouts.master')

@section('content')
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
    	if(confirm("กรุณายืนยันการลบข้อมูล"))
    	{
        	$("#submit_form").submit();
    	}

    });

  });

</script>
@stop
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="content add-margin-left-right">
	<div class="row">
		<div class="form-group">
		<h1>Delete record</h1>
		<h3>กรุณาตรวจทานข้อมูลก่อนยืนยัน</h3>
		{{Form::open(array('action' => 'SuperController@submit_delete_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-2">
				<label>No.</label>
				<input type="hidden" id="id" name="id" value="{{$record->id}}" />
				{{$record->no}}
			</div>
			<div class="col-xs-2">
				<label>Code.</label>
				{{$record->code}}
			</div>
			<div class="col-xs-3">
				<label>Status.</label>
				{{$record->status}}
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-3">
				<label>Sources.</label>
					<?php if($record->sources=="online_search"){echo "Online Search";}?>
					<?php if($record->sources=="dtac_recommend"){echo "DTAC Recommend";}?>
					<?php if($record->sources=="walking"){echo "Walking";}?>
			</div>
			<div class="col-xs-3">
				<label>Categories.</label>
					<?php if($record->categories=="dinning_and_beverage"){echo "Dining & Beverage";}?>
					<?php if($record->categories=="shopping_and_lifestyle"){echo "Shopping & Lifestyle";}?>
					<?php if($record->categories=="beauty_and_healthy"){echo "Beauty & Healthy";}?>
					<?php if($record->categories=="hotel_and_travel"){echo "Hotel & Travel";}?>
					<?php if($record->categories=="online"){echo "Online";}?>
				
			</div>
			<div class="col-xs-3">
				<label>Dtac Type.</label>
					<?php if($record->dtac_type=="ร้านกทม"){echo "ร้าน กทม";}?>
					<?php if($record->dtac_type=="ร้านตจว"){echo "ร้าน ตจว";}?>
					<?php if($record->dtac_type=="ร้านonline"){echo "ร้าน online";}?>
					<?php if($record->dtac_type=="ร้านต่ออายุ"){echo "ร้านต่ออายุ";}?>
					<?php if($record->dtac_type=="ร้านดีลอย่างเดียว"){echo "ร้านดีลอย่างเดียว";}?>
					<?php if($record->dtac_type=="ร้านเฉพาะอาร์ทเวิร์ค"){echo "ร้านเฉพาะอาร์ทเวิร์ค";}?>
				
			</div>
			<div class="col-xs-3">
				<label>ประเภทร้าน.</label>
					<?php if($record->shop_type=="ร้านเบ็ดเตล็ด"){echo "ร้าน เบ็ดเตล็ด";}?>
					<?php if($record->shop_type=="ร้านอาหาร"){echo "ร้าน อาหาร";}?>
					<?php if($record->shop_type=="ร้านอาหารนานาชาติ"){echo "ร้าน อาหารนานาชาติ";}?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Name Thai.</label>
				{{$record->name_th}}
			</div>
			<div class="col-xs-4">
				<label>Name English.</label>
				{{$record->name_en}}
			</div>
			<div class="col-xs-4">
				<label>สาขา.</label>
				{{$record->branch}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ที่อยู่.</label>
				{{$record->address}}
			</div>
			<div class="col-xs-6">
				<label>จังหวัด.</label>
				{{$record->province}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>ละติจูด.</label>
				{{$record->latitude}}
			</div>
			<div class="col-xs-6">
				<label>ลองติจูด.</label>
				{{$record->longitude}}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<label>Contact Person.</label>
				{{$record->contact_person}}
			</div>
			<div class="col-xs-4">
				<label>Contact Telephone number.</label>
				{{$record->contact_tel}}
			</div>
			<div class="col-xs-4">
				<label>Contact Email.</label>
				{{$record->contact_email}}
			</div>
			<div class="col-xs-4">
				<label>Contact Date [ วัน / เดือน / ปี ]</label>
				<?php
					$contact_date = explode("-",$record->contact_date);
					$contact_day = $contact_date[1];
					$contact_month = $contact_date[2];
					$contact_year = $contact_date[0];
				?>
				{{$contact_date[1]}} / {{$contact_date[2]}} / {{$contact_date[0]}}

			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<label>Link.</label>
				{{$record->links}}
			</div>
			<div class="col-xs-6">
				<label>Remarks.</label>
				{{$record->remarks}}
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">Delete</a>
		<a class="btn btn-danger" href="{{ url('super/record/list_records') }}" role="button" id="cancel_btn">Cancel</a>
		{{ Form::close() }}
		</div>
	</div>
</div>

@endsection