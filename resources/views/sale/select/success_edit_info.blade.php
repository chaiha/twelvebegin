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

</script>
@stop
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="container-fluid add-margin-20">
	<div class="row">
		<div class="form-group">
		<h1>ได้ทำการแก้ไขข้อมูล {{$select_record->record->code}} / {{$select_record->name_th}} <?php if($select_record->name_en!=""){ echo "/ ".$select_record->name_en;}	?> เสร็จสิ้น</h1>
		<h3>ข้อมูลเบื้องต้นของ {{$select_record->record->name_th}} </h3>
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลสำหรับ Record</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record->record_id}}" />
				<input type="hidden" id="call_amount" name="call_amount" value="{{$select_record->call_amount}}" />
				<table class="table table-bordered table-striped">
					<tr>
						<th>Status</th>
						<th>Sources</th>
						<th>dtac Type</th>
						<th>Categories</th>
						<th>ประเภทร้าน</th>
						<th>ประเภทร้านพิเศษ</th>
					</tr>
					<tr>
						<td>
							<?php
								if($select_record->record->status=="Available")
								{
									echo "Available";
								}
								elseif ($select_record->record->status=="Not_available") 
								{
									echo "Not Available";
								}
							?>
						</td>
						<td>
							<?php
								if($select_record->record->sources=="online_search")
								{
									echo "ค้นหาจากเว็บไซต์";
								}
								elseif ($select_record->record->sources=="dtac_recommend") 
								{
									echo "ร้านแนะนำจาก dtac";
								}
								elseif ($select_record->record->sources=="walking") 
								{
									echo "Walk in";
								}
								?>
						</td>
						<td>
							<?php
								if($select_record->record->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
								{
									echo "กทม./นนทบุรี/สมุทรปราการ";
								}
								elseif ($select_record->record->dtac_type=="ต่างจังหวัด") 
								{
									echo "ต่างจังหวัด";
								}
								elseif ($select_record->record->dtac_type=="dtacแนะนำ") 
								{
									echo "dtac แนะนำ";
								}
								elseif ($select_record->record->dtac_type=="online") 
								{
									echo "online";
								}
								elseif ($select_record->record->dtac_type=="ต่ออายุ") 
								{
									echo "ต่ออายุ";
								}
								elseif ($select_record->record->dtac_type=="ดีลอย่างเดียว") 
								{
									echo "ดีลอย่างเดียว";
								}
								elseif ($select_record->record->dtac_type=="เฉพาะอาร์ทเวิร์ค") 
								{
									echo "เฉพาะอาร์ทเวิร์ค";
								}
								?>
						</td>
						<td>
							<?php
								if($select_record->categories=="dinning_and_beverage")
								{
									echo "Dining and Beverage";
								}
								elseif($select_record->categories=="shopping_and_lifestyle")
								{
									echo "Shopping and Lifestyle";
								}
								elseif($select_record->categories=="beauty_and_healthy")
								{
									echo "Beauty and Healthy";
								}
								elseif($select_record->categories=="hotel_and_travel")
								{
									echo "Hotel and Travel";
								}
								elseif($select_record->categories=="online")
								{
									echo "Online";
								}
								?>
						</td>
						<td>
							{{$select_record->shop_type}}
						</td>
						<td>
							{{$select_record->record->special_type}}
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
						<th>ชื่อไทย</th>
						<th>ชื่ออังกฤษ</th>
						<th>สาขา</th>
						<th>จำนวนสาขา</th>
					</tr>
					<tr>
						<td>{{$select_record->name_th}}</td>
						<td>{{$select_record->name_en}}</td>
						<td>{{$select_record->branch}}</td>
						<td>{{$select_record->branch_amount}}</td>
					</tr>
				</table>
				<table class="table table-bordered table-striped">
					<tr>
						<th>ที่อยู่  </th>
						<th>จังหวัด</th>
						<th>ละติจูด</th>
						<th>ลองติจูด</th>
					</tr>
					<tr>
						<td>
						{{$select_record->address}}
						</td>
						<td>{{$select_record->province}}</td>
						<td>{{$select_record->latitude}}</td>
						<td>{{$select_record->longtitude}}</td>
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
						<th>ชื่อผู้ติดต่อ</th>
						<th>เบอร์โทรติดต่อ</th>
						<th>อีเมลที่ติดต่อ</th>
						<th>วันที่ให้ติดต่อ [ วัน / เดือน / ปี ]</th>
						<th>ที่อยู่ให้จัดส่ง</th>
					</tr>
					<tr>
						<td>
								{{$select_record->contact_person}}
						</td>
						<td>{{$select_record->contact_tel}}</td>
						<td>{{$select_record->contact_email}}</td>
						<td>
							<?php
								$contact_date = explode("-",$select_record->record->contact_date);
								$contact_day = $contact_date[1];
								$contact_month = $contact_date[2];
								$contact_year = $contact_date[0];
							?>
							{{$contact_day}} / {{$contact_month}} / {{$contact_year}}
						</td>
						<td>
							{{$select_record->sending_address}}
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
							@if($select_record->links!=NULL)
								{{ Html::link($select_record->links,null,array('target'=>'_blank')) }}
							@else
								-
							@endif
						</td>
						<td>
							<?php
								if($select_record->remarks!=NULL)
								{
									echo $select_record->remarks;
								}
								else
								{
									echo "-";
								}
								
							?>
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
							<?php
								if($select_record->note!=NULL)
								{
									echo($select_record->note);
								}
								else
								{
									echo "-";
								}
								?>
						</td>
					</tr>
				</table>
			</div>
			</div>
		</div>
		<hr>
		<br />
		<a class="btn btn-success" href="{{url('sale/show_selected_record_list')}}" role="button" id="confirm_btn">กลับไปหน้าเลือก Lead</a>
		</div>
	</div>
</div>
</div>

@endsection