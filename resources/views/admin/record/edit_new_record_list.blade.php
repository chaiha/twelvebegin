@extends('admin.layouts.master')
@section('js_files')

<script>

  $(document).ready(function(){

    $("#confirm_btn").click(function(){
    	var error = 0;
    	for(i=1;i<=20;i++)
    	{
    			if(i==1)
    			{
		    		if($("#sources-"+i).val()=="empty")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน แหล่งที่มา');
		    			error = error+1;
						break;
		    		}
		    		if($("#categories-"+i).val()=="empty")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน categories');
		    			error = error+1;
						break;
		    		}
					if($("#dtac_type-"+i).val()=="empty")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน dtac type');
						error = error+1;
						break;
					}
					if($("#shop_type-"+i).val()=="empty")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน shop_type');
		    			error = error+1;
						break;
		    		}
		    		if($("#name_th-"+i).val()=="")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน name th');
		    			error = error+1;
						break;
		    		}
		    		if($("#name_en-"+i).val()=="")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน name_en');
		    			error = error+1;
						break;
		    		}
		    		if($("#province-"+i).val()=="empty")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน province');
						error = error+1;
						break;
					}
					if($("#contact_tel-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact tel');
						error = error+1;
						break;
					}
					if($("#links-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน links');
						error = error+1;
						break;
					}	
				}
				else
				{
					if($("#sources-"+i).val()=="empty"&&$("#categories-"+i).val()=="empty")
		    		{
		    			//it means there are no more row.
						break;
		    		}
		    		else
		    		{
		    				if($("#sources-"+i).val()=="empty")
		    			{
		    				alert('กรุษรกรอกขข้อมูลให้ครบถ้วน แหล่งที่มา');
		    				error = error+1;
							break;
		    			}
		    			if($("#categories-"+i).val()=="empty")
		    			{
		    				alert('กรุษรกรอกขข้อมูลให้ครบถ้วน categories');
		    				error = error+1;
							break;
		    			}
						if($("#dtac_type-"+i).val()=="empty")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน dtac type');
							error = error+1;
							break;
						}
						if($("#shop_type-"+i).val()=="empty")
		    			{
		    				alert('กรุษรกรอกขข้อมูลให้ครบถ้วน shop_type');
		    				error = error+1;
							break;
		    			}
		    			if($("#name_th-"+i).val()=="")
		    			{
			    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน name th');
			    			error = error+1;
							break;
		    			}
		    			if($("#name_en-"+i).val()=="")
		    			{
			    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน name_en');
			    			error = error+1;
							break;
		    			}
			    		if($("#province-"+i).val()=="empty")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน province');
							error = error+1;
							break;
						}
						if($("#contact_tel-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน เบอร์โทรติดต่อ');
							error = error+1;
							break;
						}
						if($("#links-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน links');
							error = error+1;
							break;
						}
		    		}
				}	    										
		}
		//check error before submit
		if(error==0)
		{
			$("#submit_form").submit();
		}


		});
  });
	function delete_record(id_array)
	{

		var url_address = "{{url('/admin/record/delete_edit_new_record_list/')}}"+"/"+id_array;
		if(confirm('กรุณาทำการยืนยันที่จะลบข้อมูลออกจาก List'))
		{
			window.location = url_address;
		}
	}
        
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
		<h1>แก้ไข Lead ใหม่</h1>
		{{Form::open(array('action' => 'AdminController@submit_edit_new_record_list','id'=>'submit_form'))}}
			{{csrf_field()}}
			<table class="table table-bordered table-striped table-hover">
				<thead>
				<tr>
					<th class="add_padding_15">Delete</th>
					<th class="add_padding_15">No.</th>
					<th class="add_padding_15">แหล่งที่มา</th>
					<th class="add_padding_15">Categories</th>
					<th class="add_padding_15">Dtac Type</th>
					<th class="add_padding_15">ประเภทร้าน</th>
					<th class="add_padding_15">ประเภทร้านค้าพิเศษ</th>
					<th class="add_padding_15">ชื่อไทย</th>
					<th class="add_padding_15">ชื่ออังกฤษ</th>
					<th class="add_padding_15">สาขา</th>
					<th class="add_padding_15">จังหวัด</th>
					<th class="add_padding_15">เบอร์โทรติดต่อ</th>
					<th class="add_padding_15">Link</th>
					<th class="add_padding_15">Remark</th>
				</tr>
				</thead>
			<?php $size_array = sizeof($edit_new_record_list); ?>
			<input type="hidden" name="size_array" id="size_array" value="{{$size_array}}" />
			<?php $i=0; $j=0; ?>
			@foreach($edit_new_record_list as $edit_new_record_list_each)
			<?php $i++; ?>
			<tr>	
					<td class="add_padding_15"><a href="#" id="delete-{{$j}}" class="delete_btn" onClick="delete_record({{$j}})">Delete</a></td>
					<td class="add_padding_15">{{$i}}</td>
					<td class="add_padding_15">
						<select name="sources-{{$i}}"  class="selectpicker sources" id="sources-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<option value="online_search" <?php if($edit_new_record_list_each['sources']=="online_search"){echo "selected";}?>>ค้นหาจากเว็บไซต์</option>
							<option value="dtac_recommend" <?php if($edit_new_record_list_each['sources']=="dtac_recommend"){echo "selected";}?>>ร้านแนะนำจาก dtac</option>
							<option value="walking" <?php if($edit_new_record_list_each['sources']=="walking"){echo "selected";}?>>Walk in</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="categories-{{$i}}"  class="selectpicker categories" id="categories-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<option value="dinning_and_beverage" <?php if($edit_new_record_list_each['categories']=="dinning_and_beverage"){echo "selected";}?>>Dining and Beverage</option>
							<option value="shopping_and_lifestyle" <?php if($edit_new_record_list_each['categories']=="shopping_and_lifestyle"){echo "selected";}?>>Shopping and Lifestyle</option>
							<option value="beauty_and_healthy" <?php if($edit_new_record_list_each['categories']=="beauty_and_healthy"){echo "selected";}?>>Beauty and Healthy</option>
							<option value="hotel_and_travel" <?php if($edit_new_record_list_each['categories']=="hotel_and_travel"){echo "selected";}?>>Hotel and Travel</option>
							<option value="online" <?php if($edit_new_record_list_each['categories']=="online"){echo "selected";}?>>Online</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="dtac_type-{{$i}}"  class="selectpicker dtac_type" id="dtac_type-{{$i}}">
							<option value="ต่างจังหวัด" <?php if($edit_new_record_list_each['dtac_type']=="ต่างจังหวัด"){echo "selected";}?>>ต่างจังหวัด</option>
							<option value="กทม./นนทบุรี/สมุทรปราการ" <?php if($edit_new_record_list_each['dtac_type']=="กทม./นนทบุรี/สมุทรปราการ"){echo "selected";}?>>กทม./นนทบุรี/สมุทรปราการ</option>
							<option value="dtacแนะนำ" <?php if($edit_new_record_list_each['dtac_type']=="dtacแนะนำ"){echo "selected";}?>>dtac แนะนำ</option>
							<option value="ต่ออายุ" <?php if($edit_new_record_list_each['dtac_type']=="ต่ออายุ"){echo "selected";}?>>ต่ออายุ</option>
							<option value="online" <?php if($edit_new_record_list_each['dtac_type']=="online"){echo "selected";}?>>online</option>
							<option value="ดีลอย่างเดียว" <?php if($edit_new_record_list_each['dtac_type']=="ดีลอย่างเดียว"){echo "selected";}?>>ดีลอย่างเดียว</option>
							<option value="เฉพาะอาร์ทเวิร์ค" <?php if($edit_new_record_list_each['dtac_type']=="เฉพาะอาร์ทเวิร์ค"){echo "selected";}?>>เฉพาะอาร์ทเวิร์ค</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="shop_type-{{$i}}"  class="selectpicker shop_type" id="shop_type-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<optgroup label="Dining">
							<option value="ร้านอาหาร" <?php if($edit_new_record_list_each['shop_type']=="ร้านอาหาร"){echo "selected";}?>>ร้านอาหาร</option>
							<option value="ร้านเครื่องดื่ม" <?php if($edit_new_record_list_each['shop_type']=="ร้านเครื่องดื่ม"){echo "selected";}?>>ร้านเครื่องดื่ม</option>
							<option value="ร้านกาแฟ" <?php if($edit_new_record_list_each['shop_type']=="ร้านกาแฟ"){echo "selected";}?>>ร้านกาแฟ</option>
							<option value="ร้านเบเกอรี่" <?php if($edit_new_record_list_each['shop_type']=="ร้านเบเกอรี่"){echo "selected";}?>>ร้านเบเกอรี่</option>
							<option value="ผับ (ร้านอาหารและเครื่องดื่ม)" <?php if($edit_new_record_list_each['shop_type']=="ผับ (ร้านอาหารและเครื่องดื่ม)"){echo "selected";}?>>ผับ (ร้านอาหารและเครื่องดื่ม)</option>
							<option value="ร้านขนมหวาน" <?php if($edit_new_record_list_each['shop_type']=="ร้านขนมหวาน"){echo "selected";}?>>ร้านขนมหวาน</option>
							<option value="ร้านเครื่องดื่มและเบเกอรี่" <?php if($edit_new_record_list_each['shop_type']=="ร้านเครื่องดื่มและเบเกอรี่"){echo "selected";}?>>ร้านเครื่องดื่มและเบเกอรี่</option>
							<option value="ร้านอาหารและเบเกอรี่" <?php if($edit_new_record_list_each['shop_type']=="ร้านอาหารและเบเกอรี่"){echo "selected";}?>>ร้านอาหารและเบเกอรี่</option>
							<option value="ร้านไอศครีม" <?php if($edit_new_record_list_each['shop_type']=="ร้านไอศครีม"){echo "selected";}?>>ร้านไอศครีม</option>
							<option value="ร้านเพื่อสุขภาพ" <?php if($edit_new_record_list_each['shop_type']=="ร้านเพื่อสุขภาพ"){echo "selected";}?>>ร้านเพื่อสุขภาพ</option>
							<option value="ร้านบุฟเฟ่ต์" <?php if($edit_new_record_list_each['shop_type']=="ร้านบุฟเฟ่ต์"){echo "selected";}?>>ร้านบุฟเฟ่ต์</option>
							<option value="โต๊ะจีน" <?php if($edit_new_record_list_each['shop_type']=="โต๊ะจีน"){echo "selected";}?>>โต๊ะจีน</option>
							<optgroup label="Beauty & Healty">
							<option value="ร้านสปา" <?php if($edit_new_record_list_each['shop_type']=="ร้านสปา"){echo "selected";}?>>ร้านสปา</option>
							<option value="ร้านนวด" <?php if($edit_new_record_list_each['shop_type']=="ร้านนวด"){echo "selected";}?>>ร้านนวด</option>
							<option value="ร้านเสริมสวย" <?php if($edit_new_record_list_each['shop_type']=="ร้านเสริมสวย"){echo "selected";}?>>ร้านเสริมสวย</option>
							<option value="ร้านทำเล็บ" <?php if($edit_new_record_list_each['shop_type']=="ร้านทำเล็บ"){echo "selected";}?>>ร้านทำเล็บ	</option>
							<option value="ร้านความงาม" <?php if($edit_new_record_list_each['shop_type']=="ร้านความงาม"){echo "selected";}?>>ร้านความงาม</option>
							<option value="ฟิสเนส" <?php if($edit_new_record_list_each['shop_type']=="ฟิสเนส"){echo "selected";}?>>ฟิสเนส</option>
							<option value="ร้านนวดและสปา" <?php if($edit_new_record_list_each['shop_type']=="ร้านนวดและสปา"){echo "selected";}?>>ร้านนวดและสปา</option>
							<optgroup label="Hotel & Travel">
							<option value="โรงแรม" <?php if($edit_new_record_list_each['shop_type']=="โรงแรม"){echo "selected";}?>>โรงแรม</option>
							<option value="รีสอร์ท" <?php if($edit_new_record_list_each['shop_type']=="รีสอร์ท"){echo "selected";}?>>รีสอร์ท</option>
							<option value="โฮมสเตย์" <?php if($edit_new_record_list_each['shop_type']=="โฮมสเตย์"){echo "selected";}?>>โฮมสเตย์</option>
							<option value="เรือนำเที่ยว" <?php if($edit_new_record_list_each['shop_type']=="เรือนำเที่ยว"){echo "selected";}?>>เรือนำเที่ยว</option>
							<option value="สถานที่ท่องเที่ยว" <?php if($edit_new_record_list_each['shop_type']=="สถานที่ท่องเที่ยว"){echo "selected";}?>>สถานที่ท่องเที่ยว</option>
							<option value="อพาร์ทเม้นท์" <?php if($edit_new_record_list_each['shop_type']=="อพาร์ทเม้นท์"){echo "selected";}?>>อพาร์ทเม้นท์</option>
							<option value="ทัวร์" <?php if($edit_new_record_list_each['shop_type']=="ทัวร์"){echo "selected";}?>>ทัวร์</option>
							<option value="ฟาร์ม" <?php if($edit_new_record_list_each['shop_type']=="ฟาร์ม"){echo "selected";}?>>ฟาร์ม</option>
							<optgroup label="Shopping & Lifestyle">
							<option value="ร้านเบ็ดเตล็ด" <?php if($edit_new_record_list_each['shop_type']=="ร้านเบ็ดเตล็ด"){echo "selected";}?>>ร้านเบ็ดเตล็ด</option>
							<option value="ร้านของฝาก" <?php if($edit_new_record_list_each['shop_type']=="ร้านของฝาก"){echo "selected";}?>>ร้านของฝาก</option>
							<option value="โรงเรียน" <?php if($edit_new_record_list_each['shop_type']=="โรงเรียน"){echo "selected";}?>>โรงเรียน</option>
							<option value="ร้านเสื้อผ้า" <?php if($edit_new_record_list_each['shop_type']=="ร้านเสื้อผ้า"){echo "selected";}?>>ร้านเสื้อผ้า</option>
							<option value="ร้านเวดดิ้ง" <?php if($edit_new_record_list_each['shop_type']=="ร้านเวดดิ้ง"){echo "selected";}?>>ร้านเวดดิ้ง</option>
							<option value="ร้านสัตว์เลี้ยง" <?php if($edit_new_record_list_each['shop_type']=="ร้านสัตว์เลี้ยง"){echo "selected";}?>>ร้านสัตว์เลี้ยง</option>
							<option value="คาร์แคร์" <?php if($edit_new_record_list_each['shop_type']=="คาร์แคร์"){echo "selected";}?>>คาร์แคร์</option>
							<option value="ร้านรองเท้า" <?php if($edit_new_record_list_each['shop_type']=="ร้านรองเท้า"){echo "selected";}?>>ร้านรองเท้า</option>
							<option value="ร้านกระเป๋า" <?php if($edit_new_record_list_each['shop_type']=="ร้านกระเป๋า"){echo "selected";}?>>ร้านกระเป๋า</option>
							<option value="ร้านเครื่องเขียน" <?php if($edit_new_record_list_each['shop_type']=="ร้านเครื่องเขียน"){echo "selected";}?>>ร้านเครื่องเขียน</option>
							<option value="ร้านหนังสือ" <?php if($edit_new_record_list_each['shop_type']=="ร้านหนังสือ"){echo "selected";}?>>ร้านหนังสือ</option>
							<option value="ร้านอิเล็กทรอนิคส์" <?php if($edit_new_record_list_each['shop_type']=="ร้านอิเล็กทรอนิคส์"){echo "selected";}?>>ร้านอิเล็กทรอนิคส์</option>
							<option value="ร้านอุปกรณ์ไอที" <?php if($edit_new_record_list_each['shop_type']=="ร้านอุปกรณ์ไอที"){echo "selected";}?>>ร้านอุปกรณ์ไอที</option>
							<option value="ร้านอุปกรณ์เบเกอรี่" <?php if($edit_new_record_list_each['shop_type']=="ร้านอุปกรณ์เบเกอรี่"){echo "selected";}?>>ร้านอุปกรณ์เบเกอรี่</option>
							<option value="ร้านเครื่องดนตรี" <?php if($edit_new_record_list_each['shop_type']=="ร้านเครื่องดนตรี"){echo "selected";}?>>ร้านเครื่องดนตรี</option>
							<option value="โรงภาพยนต์" <?php if($edit_new_record_list_each['shop_type']=="โรงภาพยนต์"){echo "selected";}?>>โรงภาพยนต์</option>
							<option value="ร้านเครื่องประดับ" <?php if($edit_new_record_list_each['shop_type']=="ร้านเครื่องประดับ"){echo "selected";}?>>ร้านเครื่องประดับ</option>
							<option value="ร้านเฟอร์นิเจอร์" <?php if($edit_new_record_list_each['shop_type']=="ร้านเฟอร์นิเจอร์"){echo "selected";}?>>ร้านเฟอร์นิเจอร์</option>
							<option value="ร้านสินค้าเด็ก" <?php if($edit_new_record_list_each['shop_type']=="ร้านสินค้าเด็ก"){echo "selected";}?>>ร้านสินค้าเด็ก</option>
							<option value="ร้านผลิตภัณฑ์ความงาม" <?php if($edit_new_record_list_each['shop_type']=="ร้านผลิตภัณฑ์ความงาม"){echo "selected";}?>>ร้านผลิตภัณฑ์ความงาม</option>
						</select>
					</td>
					<td class="add_padding_15"><input type="text" name="special_type-{{$i}}" id="special_type-{{$i}}" value="{{$edit_new_record_list_each['special_type']}}" /></td>
					<td class="add_padding_15"><input type="text" name="name_th-{{$i}}" id="name_th-{{$i}}" value="{{$edit_new_record_list_each['name_th']}}" /></td>
					<td class="add_padding_15"><input type="text" name="name_en-{{$i}}" id="name_en-{{$i}}" value="{{$edit_new_record_list_each['name_en']}}" /></td>
					<td class="add_padding_15">
					<textarea name="branch-{{$i}}" id="branch-{{$i}}" cols="50">{{$edit_new_record_list_each['branch']}}</textarea>
					</td>
					<td class="add_padding_15">
						<select name="province-{{$i}}" id="province-{{$i}}" class="selectpicker">
							<option value="empty">กรุณาเลือกจังหวัด</option>
							<?php
								$province_list = Record::province_list();
								foreach($province_list as $province_list_each)
								{
									if($province_list_each==$edit_new_record_list_each['province'])
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
					<td class="add_padding_15">
					<textarea name="contact_tel-{{$i}}" id="contact_tel-{{$i}}" cols="30">{{$edit_new_record_list_each['contact_tel']}}</textarea>
					</td>
					<td class="add_padding_15"><input type="text" name="links-{{$i}}" id="links-{{$i}}" value="{{$edit_new_record_list_each['links']}}" /></td>
					<td class="add_padding_15"><input type="text" name="remarks-{{$i}}" id="remarks-{{$i}}" value="{{$edit_new_record_list_each['remarks']}}" /></td>
				</tr>
				<?php $j++; ?>
				@endforeach
			</table>
			{{ Form::close() }}
			<br />
			*หากไม่มีข้อมูลกรุณาใส่ "-" ในช่อง
			<br /><br />
		<a class="btn btn-primary" href="#" role="button" id="confirm_btn">ยืนยันการแก้ไข</a>
		<a class="btn btn-danger" href="{{url('/admin/record/list_records')}}" role="button" id="cancel">ยกเลิก</a>
		</div>
	</div>
</div>
@endsection
