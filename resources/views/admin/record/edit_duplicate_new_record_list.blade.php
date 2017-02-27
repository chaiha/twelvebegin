@extends('admin.layouts.master')
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function()
    {
    	var error = 0;
    
		    		if($("#sources_edit").val()=="empty")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน sources');
		    			error = error+1;
						
		    		}
		    		if($("#categories_edit").val()=="empty")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน categories');
		    			error = error+1;
						
		    		}
					if($("#dtac_type_edit").val()=="empty")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน dtac type');
						error = error+1;
						
					}
					if($("#shop_type_edit").val()=="empty")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน shop_type');
		    			error = error+1;
						
		    		}
		    		if($("#name_th_edit").val()=="")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน name th');
		    			error = error+1;
						
		    		}
		    		if($("#name_en_edit").val()=="")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน name_en');
		    			error = error+1;
						
		    		}
		    		if($("#branch_edit").val()=="")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน branch');
		    			error = error+1;
						
		    		}
		    		if($("#address_edit").val()=="")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน address');
		    			error = error+1;
						
		    		}
		    		if($("#province_edit").val()=="empty")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน province');
						error = error+1;
						
					}
					if($("#latitude_edit").val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน latitude');
						error = error+1;
						
					}
					if($("#longtitude_edit").val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน longtitude');
						error = error+1;
						
					}
					if($("#contact_person_edit").val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact person');
						error = error+1;
						
					}
					if($("#contact_tel_edit").val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact tel');
						error = error+1;
						
					}
					if($("#contact_email_edit").val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact email');
						error = error+1;
						
					}
					if($("#links_edit").val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน links');
						error = error+1;
						
					}
					if($("#remarks_edit").val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน remarks');
						error = error+1;
						
					}	
				
		//check error before submit
		if(error==0)
		{
			if(confirm('กรุณายืนยัน'))
			{
				$("#submit_form").submit();
			}
		}
	

  });
 });
        //$("#submit_form").submit();




</script>
@stop
@section('styles')
<style type="text/css">
.add_padding_15
{
	padding:15px;
}
.table-striped>tbody>tr:nth-child(odd)>td,
.table-striped>tbody>tr:nth-child(odd)>th {
   background-color: #E6E6E6; // Choose your own color here
 }
</style>
@stop
@section('content')
<?php
use App\Record;
?>
<!-- Services Section -->

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		<h1>Edit duplicate new record</h1>
		{{Form::open(array('action' => 'AdminController@submit_edit_duplicate_new_record_list','id'=>'submit_form'))}}
			{{csrf_field()}}
			<table class="table table-bordered table-striped table-hover">
				<thead>
				<tr>
					<th class="add_padding_15">No.</th>
					<th class="add_padding_15">Sources</th>
					<th class="add_padding_15">Categories</th>
					<th class="add_padding_15">Dtac Type</th>
					<th class="add_padding_15">ประเภทร้าน</th>
					<th class="add_padding_15">ชื่อไทย</th>
					<th class="add_padding_15">ชื่อภาษาอังกฤษ</th>
					<th class="add_padding_15">สาขา</th>
					<th class="add_padding_15">ที่อยู่</th>
					<th class="add_padding_15">จังหวัด</th>
					<th class="add_padding_15">ละติจูด</th>
					<th class="add_padding_15">ลองติจูด</th>
					<th class="add_padding_15">contact person</th>
					<th class="add_padding_15">contact telephone</th>
					<th class="add_padding_15">contact e-mail</th>
					<th class="add_padding_15">Link</th>
					<th class="add_padding_15">Remark</th>
				</tr>
				</thead>
				<?php 
					$i=0; 
					$j=0;
				?>
				<?php foreach($search_result as $preview_new_record_list_each){ 
					$i++;
					?>
				<tr>
					<td class="add_padding_15">{{$i}}</td>
					<td class="add_padding_15">
						<?php 
						if($preview_new_record_list_each['sources']=="online_search")
						{
							echo "Online Search";
						}
						elseif($preview_new_record_list_each['sources']=="dtac_recommend")
						{
							echo "Dtac Recommend";
						}
						elseif($preview_new_record_list_each['sources']=="walking")
						{
							echo "Walking";
						}
						?>
					</td>
					<td class="add_padding_15">
					<?php 
						if($preview_new_record_list_each['categories']=="dinning_and_beverage")
						{
							echo "Dining & Beverage";
						}
						elseif($preview_new_record_list_each['categories']=="shopping_and_lifestyle")
						{
							echo "Shopping & Lifestyle";
						}
						elseif($preview_new_record_list_each['categories']=="beauty_and_healthy")
						{
							echo "Beauty & Healthy";
						}
						elseif($preview_new_record_list_each['categories']=="hotel_and_travel")
						{
							echo "Hotel & Travel";
						}
						elseif($preview_new_record_list_each['categories']=="online")
						{
							echo "Online";
						}
						?>
					</td>
					<td class="add_padding_15">
					<?php 
						if($preview_new_record_list_each['dtac_type']=="ร้านกทม")
						{
							echo "ร้าน กทม";
						}
						elseif($preview_new_record_list_each['dtac_type']=="ร้านตจว")
						{
							echo "ร้าน ตจว";
						}
						elseif($preview_new_record_list_each['dtac_type']=="ร้านonline")
						{
							echo "ร้าน online";
						}
						elseif($preview_new_record_list_each['dtac_type']=="ร้านต่ออายุ")
						{
							echo "ร้านต่ออายุ";
						}
						elseif($preview_new_record_list_each['dtac_type']=="ร้านดีลอย่างเดียว")
						{
							echo "ร้านดีลอย่างเดียว";
						}
						elseif($preview_new_record_list_each['dtac_type']=="ร้านเฉพาะอาร์ทเวิร์ค")
						{
							echo "ร้านเฉพาะอาร์ทเวิร์ค";
						}
						?>
						
					</td>
					<td class="add_padding_15">
					<?php 
						if($preview_new_record_list_each['shop_type']=="ร้านเบ็ดเตล็ด")
						{
							echo "ร้าน เบ็ดเตล็ด";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านอาหาร")
						{
							echo "ร้าน อาหาร";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านอาหารนานาชาติ")
						{
							echo "ร้าน อาหารนานาชาติ";
						}
						
						?>
											</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['name_th']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['name_en']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['branch']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['address']}}</td>
					<td class="add_padding_15">
						{{$preview_new_record_list_each['province']}}
					</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['latitude']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['longtitude']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['contact_person']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['contact_tel']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['contact_email']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['links']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['remarks']}}</td>
				</tr>
				<?php 
						$j++;
						} 
					?>
			</table>
			<table class="table table-bordered table-striped table-hover">
				<thead>
				<tr>
					<th class="add_padding_15">Sources</th>
					<th class="add_padding_15">Categories</th>
					<th class="add_padding_15">Dtac Type</th>
					<th class="add_padding_15">ประเภทร้าน</th>
					<th class="add_padding_15">ชื่อไทย</th>
					<th class="add_padding_15">ชื่อภาษาอังกฤษ</th>
					<th class="add_padding_15">สาขา</th>
					<th class="add_padding_15">ที่อยู่</th>
					<th class="add_padding_15">จังหวัด</th>
					<th class="add_padding_15">ละติจูด</th>
					<th class="add_padding_15">ลองติจูด</th>
					<th class="add_padding_15">contact person</th>
					<th class="add_padding_15">contact telephone</th>
					<th class="add_padding_15">contact e-mail</th>
					<th class="add_padding_15">Link</th>
					<th class="add_padding_15">Remark</th>
				</tr>
				</thead>
			<tr>
					<td class="add_padding_15">
						<input type="hidden" name="id_array" id="id_array" value="{{$id_array}}"/>
						<select name="sources_edit"  class="selectpicker sources" id="sources_edit">
							<option value="empty">กรุณาเลือก</option>
							<option value="online_search" <?php if($edit_duplicate_record['sources']=="online_search"){echo "selected";}?>>Online Search</option>
							<option value="dtac_recommend" <?php if($edit_duplicate_record['sources']=="dtac_recommend"){echo "selected";}?>>DTAC Recommend</option>
							<option value="walking" <?php if($edit_duplicate_record['sources']=="walking"){echo "selected";}?>>Walking</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="categories_edit"  class="selectpicker categories" id="categories_edit">
							<option value="empty">กรุณาเลือก</option>
							<option value="dinning_and_beverage" <?php if($edit_duplicate_record['categories']=="dinning_and_beverage"){echo "selected";}?>>Dining & Beverage</option>
							<option value="shopping_and_lifestyle" <?php if($edit_duplicate_record['categories']=="shopping_and_lifestyle"){echo "selected";}?>>Shopping & Lifestyle</option>
							<option value="beauty_and_healthy" <?php if($edit_duplicate_record['categories']=="beauty_and_healthy"){echo "selected";}?>>Beauty & Healthy</option>
							<option value="hotel_and_travel" <?php if($edit_duplicate_record['categories']=="hotel_and_travel"){echo "selected";}?>>Hotel & Travel</option>
							<option value="online" <?php if($edit_duplicate_record['categories']=="online"){echo "selected";}?>>Online</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="dtac_type_edit"  class="selectpicker dtac_type" id="dtac_type_edit">
							<option value="empty">กรุณาเลือก</option>
							<option value="ร้านกทม" <?php if($edit_duplicate_record['dtac_type']=="ร้านกทม"){echo "selected";}?>>ร้าน กทม</option>
							<option value="ร้านตจว" <?php if($edit_duplicate_record['dtac_type']=="ร้านตจว"){echo "selected";}?>>ร้าน ตจว</option>
							<option value="ร้านonline" <?php if($edit_duplicate_record['dtac_type']=="ร้านonline"){echo "selected";}?>>ร้าน online</option>
							<option value="ร้านต่ออายุ" <?php if($edit_duplicate_record['dtac_type']=="ร้านต่ออายุ"){echo "selected";}?>>ร้านต่ออายุ</option>
							<option value="ร้านดีลอย่างเดียว" <?php if($edit_duplicate_record['dtac_type']=="ร้านดีลอย่างเดียว"){echo "selected";}?>>ร้านดีลอย่างเดียว</option>
							<option value="ร้านเฉพาะอาร์ทเวิร์ค" <?php if($edit_duplicate_record['dtac_type']=="ร้านเฉพาะอาร์ทเวิร์ค"){echo "selected";}?>>ร้านเฉพาะอาร์ทเวิร์ค</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="shop_type_edit"  class="selectpicker shop_type" id="shop_type_edit">
							<option value="empty">กรุณาเลือก</option>
							<option value="ร้านเบ็ดเตล็ด" <?php if($edit_duplicate_record['shop_type']=="ร้านเบ็ดเตล็ด"){echo "selected";}?>>ร้าน เบ็ดเตล็ด</option>
							<option value="ร้านอาหาร" <?php if($edit_duplicate_record['shop_type']=="ร้านอาหาร"){echo "selected";}?>>ร้าน อาหาร</option>
							<option value="ร้านอาหารนานาชาติ" <?php if($edit_duplicate_record['shop_type']=="ร้านอาหารนานาชาติ"){echo "selected";}?>>ร้าน อาหารนานาชาติ</option>
						</select>
					</td>
					<td class="add_padding_15"><input type="text" name="name_th_edit" id="name_th_edit" value="{{$edit_duplicate_record['name_th']}}" /></td>
					<td class="add_padding_15"><input type="text" name="name_en_edit" id="name_en_edit" value="{{$edit_duplicate_record['name_en']}}" /></td>
					<td class="add_padding_15"><input type="text" name="branch_edit" id="branch_edit" value="{{$edit_duplicate_record['branch']}}" /></td>
					<td class="add_padding_15"><input type="text" name="address_edit" id="address_edit" value="{{$edit_duplicate_record['address']}}" size="50"/></td>
					<td class="add_padding_15">
						<select name="province_edit" id="province_edit" class="selectpicker">
							<option value="empty">กรุณาเลือกจังหวัด</option>
							<?php
								$province_list = Record::province_list();
								foreach($province_list as $province_list_each)
								{
									if($province_list_each==$edit_duplicate_record['province'])
									{
										echo "<option value='".$province_list_each."' selected>".$province_list_each."</option>";
									}
									else
									{
										echo "<option value='".$province_list_each."'>".$province_list_each."</option>";
									}
								}
							?>
						</select>
					</td>
					<td class="add_padding_15"><input type="text" name="latitude_edit" id="latitude_edit" value="{{$edit_duplicate_record['latitude']}}" /></td>
					<td class="add_padding_15"><input type="text" name="longtitude_edit" id="longtitude_edit" value="{{$edit_duplicate_record['longtitude']}}" /></td>
					<td class="add_padding_15"><input type="text" name="contact_person_edit" id="contact_person_edit" value="{{$edit_duplicate_record['contact_person']}}" /></td>
					<td class="add_padding_15"><input type="text" name="contact_tel_edit" id="contact_tel_edit" value="{{$edit_duplicate_record['contact_tel']}}" /></td>
					<td class="add_padding_15"><input type="text" name="contact_email_edit" id="contact_email_edit" value="{{$edit_duplicate_record['contact_email']}}" /></td>
					<td class="add_padding_15"><input type="text" name="links_edit" id="links_edit" value="{{$edit_duplicate_record['links']}}" /></td>
					<td class="add_padding_15"><input type="text" name="remarks_edit" id="remarks_edit" value="{{$edit_duplicate_record['remarks']}}" /></td>
				</tr>
			</table>
			{{ Form::close() }}
			<br />
			<br /><br />
		<a class="btn btn-primary" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-danger" href="{{url('/admin/record/show_preview_new_record_list')}}" role="button" id="cancel">Cancel</a>
		</div>
	</div>
</div>
@endsection
