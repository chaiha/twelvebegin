@extends('sale.layouts.master')

@section('content')
@section('styles')
<style type="text/css">
.hide
{
	display:none;
}
.show
{
	display:block;
}
.add-margin-20
{
	margin:20px;
}
</style>
@stop
@section('js_files')

<script>

  $(document).ready(function(){

    $(function(){
       $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });

    $("#confirm_btn").click(function(){
		if(confirm("กรุณายืนยัน"))
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
<div class="container-fluid add-margin-20">
	<div class="row">
		<div class="form-group">
		<h1>{{$select_record['name_th']}} <?php if($select_record['name_en']!=""){ echo "/ ".$select_record['name_en'];}	?> / โทรครั้งที่ {{$select_record_info->call_amount}}</h1>
		<h3>ข้อมูลเบื้องต้นของ {{$select_record['name_th']}} / {{$select_record['name_en']}} / ติดต่อ {{$select_record['contact_person']}} / โทร {{$select_record['contact_tel']}} </h3>
		{{Form::open(array('action' => 'CallController@submit_edit_record_info','id'=>'submit_form'))}}
			{{csrf_field()}}
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลสำหรับ Record</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record_info->record_id}}" />
				<input type="hidden" id="call_amount" name="call_amount" value="{{$select_record_info->record->call_amount}}" />
				<table class="table table-bordered table-striped">
					<tr>
						<th>No.</th>
						<th>Code.</th>
						<th>Status</th>
						<th>แหล่งที่มา</th>
						<th>dtac type</th>
						<th>Categories<span class="red">*</span></th>
						<th>ประเภทร้าน<span class="red">*</span></th>
                        <th>ประเภทร้านพิเศษ</th>
					</tr>
					<tr>
						<td>{{$select_record_info->record->no}}</td>
						<td>{{$select_record_info->record->code}}</td>
						<td>
							<?php
								if($select_record_info->record->status=="Available")
								{
									echo "Available";
								}
								elseif ($select_record_info->record->status=="Not_available") 
								{
									echo "Not Available";
								}
							?>
						</td>
						<td>
						<?php 
						if($select_record_info->sources=="online_search")
						{
							echo "Online Search";
						}
						elseif($select_record_info->sources=="dtac_recommend")
						{
							echo "dtac Recommend";
						}
						elseif($select_record_info->sources=="walking")
						{
							echo "Walking";
						}
						?>
						</td>
						<td>
						<?php
							if($select_record_info->dtac_type=="ร้านกทม./นนทบุรี/สมุทรปราการ")
							{
								echo "ร้าน กทม./นนทบุรี/สมุทรปราการ";
							}
							elseif($select_record_info->dtac_type=="ร้านต่างจังหวัด")
							{
								echo "ร้าน ต่างจังหวัด";
							}
							elseif($select_record_info->dtac_type=="ร้านdtacแนะนำ")
							{
								echo "ร้าน dtac แนะนำ";
							}
							elseif($select_record_info->dtac_type=="ร้านonline")
							{
								echo "ร้าน online";
							}
							elseif($select_record_info->dtac_type=="ร้านต่ออายุ")
							{
								echo "ร้านต่ออายุ";
							}
							elseif($select_record_info->dtac_type=="ร้านดีลอย่างเดียว")
							{
								echo "ร้านดีลอย่างเดียว";
							}
							elseif($select_record_info->dtac_type=="ร้านเฉพาะอาร์ทเวิร์ค")
							{
								echo "ร้านเฉพาะอาร์ทเวิร์ค";
							}
						?>
						</td>
						<td>
						<?php
						if($select_record['categories']=="dinning_and_beverage")
						{
							echo "Dining & Beverage";
						}
						elseif($select_record['categories']=="shopping_and_lifestyle")
						{
							echo "Shopping & Lifestyle";
						}
						elseif($select_record['categories']=="beauty_and_healthy")
						{
							echo "Beauty & Healthy";
						}
						elseif($select_record['categories']=="hotel_and_travel")
						{
							echo "Hotel & Travel";
						}
						elseif($select_record['categories']=="online")
						{
							echo "Online";
						}
						?>
						</td>
						<td>
						{{$select_record['shop_type']}}
						</td>
                        <td>
                            {{$select_record_info->special_type}}
                        </td>
					</tr>
				</table>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลของร้าน</label>
				<table class="table table-bordered table-striped">
					<tr>
						<th>ชื่อภาษาไทย<span class="red">*</span></th>
						<th>ชื่อภาษาอังกฤษ<span class="red">*</span></th>
						<th>สาขา<span class="red">*</span></th>
                        <th>จำนวนสาขา<span class="red">*</span></th>
					</tr>
					<tr>
						<td>{{$select_record['name_th']}}</td>
						<td>{{$select_record['name_en']}}</td>
						<td>{{$select_record['branch']}}</td>
                        <td>
                        {{$select_record['branch_amount']}}
                        </td>
					</tr>
				</table>
				<table class="table table-bordered table-striped">
					<tr>
						<th>ที่อยู่<span class="red">*</span></th>
						<th>จังหวัด<span class="red">*</span></th>
						<th>ละติจูด<span class="red">*</span></th>
						<th>ลองติจูด<span class="red">*</span></th>
					</tr>
					<tr>
						<td>
							{{$select_record['address']}}
						</td>
						<td>{{$select_record['province']}}
						</td>
						<td>{{$select_record['latitude']}}</td>
						<td>{{$select_record['longtitude']}}</td>
					</tr>
				</table>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12">
			<label>ข้อมูลสำหรับติดต่อ</label>
			<table class="table table-bordered table-striped">
					<tr>
						<th>ชื่อผู้ติดต่อ<span class="red">*</span></th>
						<th>เบอร์โทรติดต่อ<span class="red">*</span></th>
						<th>อีเมลที่ติดต่อ</th>
                        <th>ที่อยู่ให้จัดส่ง<span class="red">*</span></th>
					</tr>
					<tr>
						<td>
							{{$select_record['contact_person']}}
						</td>
						<td>{{$select_record['contact_tel']}}</td>
						<td>{{$select_record['contact_email']}}</td>
						<td>
                            {{$select_record['sending_address']}}
                        </td>
					</tr>
				</table>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12">
			<label>ข้อมูลอื่นๆ</label>
			<table class="table table-bordered table-striped">
					<tr>
						<th>Links</th>
						<th>หมายเหตุ</th>
					</tr>
					<tr>
						<td>
							{{ Html::link($select_record['links']) }}
						</td>
						<td>
							{{$select_record['remarks']}}
						</td>
					</tr>
				</table>
			</div>
			</div>
            <br />
            <div class="row">
                <div class="col-xs-12">
                <label>หมายเหตุ</label>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>หมายเหตุ</th>
                        </tr>
                        <tr>
                            <td>
                                {{$select_record['note']}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
		</div>
		<hr>
	<div class="row">
		<div class="col-xs-12">
			<a href="#" class="btn btn-primary" id="confirm_btn" onClick="">ยืนยัน</a> <a href="{{url('/sale/edit_record/record/edit_record_info/'.$select_record_info->record_id)}}" class="btn btn-warning">แก้ไข</a> <a href="{{url('/sale/edit_record/record/cancel_edit_record')}}" class="btn btn-danger">ยกเลิก</a>
		</div>
	</div>
{{Form::close()}}
</div>
</div>

@endsection