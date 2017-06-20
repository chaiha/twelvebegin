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

    $("#confirm_btn").click(function(){
    	$("#submit_form").submit();	
    });
  });
</script>
@stop
<?php
use App\Record;
$record = new Record;
?>
<!-- Services Section -->
<div class="container-fluid add-margin-20">
	<div class="row">
		<div class="form-group">
		<h1>{{$select_record->record->code}} / {{$select_record->name_th}} <?php if($select_record->name_en!=""){ echo "/ ".$select_record->name_en;}	?> / โทรครั้งที่ {{$select_record->call_amount}}</h1>
		<h3>ข้อมูลเบื้องต้นของ {{$select_record->name_th}} / {{$select_record->name_en}} / ติดต่อ {{$select_record->contact_person}} / โทร {{$select_record->contact_tel}}</h3>
		{{Form::open(array('action' => 'CallController@submit_edit_submit_record','id'=>'submit_form'))}}
			{{csrf_field()}}
		 @if($select_record->record->yes_feedback!=NULL||$select_record->record->yes_feedback!="")
        <div class="row">
            <div class="col-xs-12">
            <label>ข้อมูล Privilege ก่อนหน้า</label>
            <table class="table table-bordered table-striped">
            <tr>
                <th>Privilege</th>
                <th>เงื่อนไขเพิ่มเติม</th>
                <th>Privilege-start</th>
                <th>Privilege-end</th>
            </tr>
            <tr>
                <td>{{$select_record->record->yes_feedback}}</td>
                <td>{{$select_record->record->yes_condition}}</td>
                <td><?php echo $record->convert_date_format_dash($select_record->record->yes_privilege_start); ?></td>
                <td><?php echo $record->convert_date_format_dash($select_record->record->yes_privilege_end); ?></td>
            </tr>
            </table>
            </div>
        </div>
        @endif
		<div class="row">
			<div class="col-xs-12">
				<label>ข้อมูลสำหรับ Record</label>
				<input type="hidden" id="record_id" name="record_id" value="{{$select_record->record_id}}" />
				<input type="hidden" id="call_amount" name="call_amount" value="{{$select_record->record->call_amount}}" />
				<table class="table table-bordered table-striped">
					<tr>
						<th>Status</th>
						<th>แหล่งที่มา</th>
						<th>Dtac Type</th>
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
								elseif ($select_record->categories=="shopping_and_lifestyle") 
								{
									echo "Shopping and Lifestyle";
								}
								elseif ($select_record->categories=="beauty_and_healthy") 
								{
									echo "Beauty and Healthy";
								}
								elseif ($select_record->categories=="hotel_and_travel") 
								{
									echo "Hotel and Travel";
								}
								elseif ($select_record->categories=="online") 
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
						<td>{{$sale_filled_edit['branch_amount']}}</td>
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
						<?php

						?>
						@if($edit_address!="")
							{{$edit_address}}
						@else
							{{$select_record->address}}
						@endif
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
						<th>เบอร์โทรที่ติดต่อ</th>
						<th>อีเมลที่ติดต่อ</th>
						<th>วันที่ให้ติดต่อ [ วัน / เดือน / ปี ]</th>
						<th>ที่อยู่ให้จัดส่ง</th>
					</tr>
					<tr>
						<td>
						@if($edit_contact_person!="")
							{{$edit_contact_person}}
						@else
							{{$select_record->contact_person}}
						@endif
						</td>
						<td>{{$select_record->contact_tel}}</td>
						<td>{{$select_record->contact_email}}</td>
						<td>
							<?php
								$contact_date = explode("-",$select_record->record->contact_date);
								$contact_day = $contact_date[2];
								$contact_month = $contact_date[1];
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
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-12"><b>ผลการโทร : </b>
				@if($call_result=="yes") 
					<span>Yes</span><br />					
					<b>Privilege : </b> {{$sale_filled_edit['feedback']}} <br />
					<b>เงื่อนไข : </b> {{$sale_filled_edit['condition']}} <br />
					<b>Start Privilege Date [ วัน / เดือน / ปี ] : </b> {{$sale_filled_edit['start_priviledge_date']}}  <br />
					<b>End Privilege Date [ วัน / เดือน / ปี ] : </b> {{$sale_filled_edit['end_priviledge_date']}} <br />
					<div class="col-xs-4">
					<table class="table table-bordered table-striped">
                			<tr>
                				<td>เอกสารตอบรับ</td>
                				<td>
                					@if($sale_filled_edit['has_reply_doc']=="1")
                						มี
                					@else
                						ไม่มี
                					@endif
                				</td>
                			</tr>
                			<tr>
                				<td>ยืนยันรูปสินค้า</td>
                				<td>
                					@if($sale_filled_edit['has_confirm_product_img']=="1")
                						มี
                					@else
                						ไม่มี
                					@endif
                				</td>
                			</tr>
                			<tr>
                				<td>ยืนยันรูปLogo</td>
                				<td>
                					@if($sale_filled_edit['has_confirm_logo_img']=="1")
                						มี
                					@else
                						ไม่มี
                					@endif
                				</td>
                			</tr>
                		</table>
                	</div>
                	<div class="col-xs-4">
                		<table class="table table-bordered table-striped">
                			<tr>
                				<td>รูปหน้าร้าน</td>
                				<td>
                					@if($sale_filled_edit['has_shop_img']=="1")
                						มี
                					@else
                						ไม่มี
                					@endif
                				</td>
                			</tr>
                			<tr>
                				<td>รูปสินค้า</td>
                				<td>
                					@if($sale_filled_edit['has_product_img']=="1")
                						มี
                					@else
                						ไม่มี
                					@endif
                				</td>
                			</tr>
                			<tr>
                				<td>Logo ร้าน</td>
                				<td>
                					@if($sale_filled_edit['has_logo_img']=="1")
                						มี
                					@else
                						ไม่มี
                					@endif
                				</td>
                			</tr>
                		</table>
                	</div>
				@elseif($call_result=="no_reply")
					<span>No Reply</span><br />
					<b>เหตุผล : </b> {{$sale_filled_edit['cannot_contact_reason']}} <br />
					<b>นัดโทรครั้งถัดไป [ วัน / เดือน / ปี ] : </b> {{$sale_filled_edit['cannot_contact_appointment_date']}} <br />
					
				@elseif($call_result=="rejected")
					<span>Rejected</span><br />
					<b>No Reason : </b> {{$sale_filled_edit['no_reason']}} <br />

				@elseif($call_result=="waiting")
					<span>Waiting</span><br />
					<b>เหตุผลที่ขอพิจารณาดูก่อน : </b> {{$sale_filled_edit['consider_reason']}} <br />
					<b>วันที่นัดรับ Feedback [ วัน / เดือน / ปี ] </b> {{$sale_filled_edit['consider_appointment_feedback_date']}} <br />

				@elseif($call_result=="closed")
					<span>ร้านปิดไปแล้ว</span><br />
				@endif
				
			</div>
		</div>
		<br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">ยืนยัน</a>
		<a class="btn btn-primary" href="{{url('/sale/select_record/edit_record/'.$select_record->record_id)}}" role="button" id="edit_btn">แก้ไข</a>
		<a class="btn btn-danger" href="{{ url('sale/select_record/cancel_edit_submit_record') }}" role="button" id="cancel_btn">ยกเลิก</a>
		{{Form::close() }}
		</div>
	</div>
</div>
</div>

@endsection