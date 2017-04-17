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
				}		    										
		}
		//check error before submit
		if(error==0)
		{
			$("#submit_form").submit();
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
		<h1>Create new record</h1>
		{{Form::open(array('action' => 'AdminController@preview_new_record_list','id'=>'submit_form'))}}
			{{csrf_field()}}
			<table class="table table-bordered table-striped table-hover">
				<thead>
				<tr>
					<th class="add_padding_15">No.</th>
					<th class="add_padding_15">แหล่งที่มา<span class="red">*</span></th>
					<th class="add_padding_15">Categories<span class="red">*</span></th>
					<th class="add_padding_15">dtac type<span class="red">*</span></th>
					<th class="add_padding_15">ประเภทร้าน<span class="red">*</span></th>
					<th class="add_padding_15">ประเภทร้านค้าพิเศษ</th>
					<th class="add_padding_15">ชื่อไทย<span class="red">**</span></th>
					<th class="add_padding_15">ชื่อภาษาอังกฤษ<span class="red">**</span></th>
					<th class="add_padding_15">สาขา</th>
					<th class="add_padding_15">จังหวัด<span class="red">*</span></th>
					<th class="add_padding_15">เบอร์โทรติดต่อ<span class="red">*</span></th>
					<th class="add_padding_15">Link<span class="red">*</span></th>
					<th class="add_padding_15">Remark</th>
				</tr>
				</thead>
				<?php for($i=1;$i<=20;$i++){ ?>
				<tr>
					<td class="add_padding_15">{{$i}}</td>
					<td class="add_padding_15">
						<select name="sources-{{$i}}"  class="selectpicker sources" id="sources-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<option value="online_search" >Online Search</option>
							<option value="dtac_recommend" >dtac Recommend</option>
							<option value="walking" >Walking</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="categories-{{$i}}"  class="selectpicker categories" id="categories-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<option value="dinning_and_beverage" >Dining & Beverage</option>
							<option value="shopping_and_lifestyle" >Shopping & Lifestyle</option>
							<option value="beauty_and_healthy" >Beauty & Healthy</option>
							<option value="hotel_and_travel" >Hotel & Travel</option>
							<option value="online" >Online</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="dtac_type-{{$i}}"  class="selectpicker dtac_type" id="dtac_type-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<option value="ร้านต่างจังหวัด" >ร้าน ต่างจังหวัด</option>
							<option value="ร้านกทม./นนทบุรี/สมุทรปราการ" >ร้าน กทม./นนทบุรี/สมุทรปราการ</option>
							<option value="ร้านdtacแนะนำ" >ร้าน dtac แนะนำ</option>
							<option value="ร้านต่ออายุ" >ร้านต่ออายุ</option>
							<option value="ร้านonline" >ร้าน online</option>
							<option value="ร้านดีลอย่างเดียว" >ร้านดีลอย่างเดียว</option>
							<option value="ร้านเฉพาะอาร์ทเวิร์ค" >ร้านเฉพาะอาร์ทเวิร์ค</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="shop_type-{{$i}}"  class="selectpicker shop_type" id="shop_type-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<optgroup label="Dining">
							<option value="ร้านอาหาร">ร้านอาหาร</option>
							<option value="ร้านเครื่องดื่ม">ร้านเครื่องดื่ม</option>
							<option value="ร้านกาแฟ">ร้านกาแฟ</option>
							<option value="ร้านเบเกอรี่">ร้านเบเกอรี่</option>
							<option value="ผับ (ร้านอาหารและเครื่องดื่ม)">ผับ (ร้านอาหารและเครื่องดื่ม)</option>
							<option value="ร้านขนมหวาน">ร้านขนมหวาน</option>
							<option value="ร้านเครื่องดื่มและเบเกอรี่">ร้านเครื่องดื่มและเบเกอรี่</option>
							<option value="ร้านอาหารและเบเกอรี่">ร้านอาหารและเบเกอรี่</option>
							<option value="ร้านไอศครีม">ร้านไอศครีม</option>
							<option value="ร้านเพื่อสุขภาพ">ร้านเพื่อสุขภาพ</option>
							<option value="ร้านบุฟเฟ่ต์">ร้านบุฟเฟ่ต์</option>
							<option value="โต๊ะจีน">โต๊ะจีน</option>
							<optgroup label="Beauty & Healty">
							<option value="ร้านสปา">ร้านสปา</option>
							<option value="ร้านนวด">ร้านนวด</option>
							<option value="ร้านเสริมสวย">ร้านเสริมสวย</option>
							<option value="ร้านทำเล็บ">ร้านทำเล็บ	</option>
							<option value="ร้านความงาม">ร้านความงาม</option>
							<option value="ฟิสเนส">ฟิสเนส</option>
							<option value="ร้านนวดและสปา">ร้านนวดและสปา</option>
							<optgroup label="Beauty & Healty">
							<option value="โรงแรม">โรงแรม</option>
							<option value="รีสอร์ท">รีสอร์ท</option>
							<option value="โฮมสเตย์">โฮมสเตย์</option>
							<option value="เรือนำเที่ยว">เรือนำเที่ยว</option>
							<option value="สถานที่ท่องเที่ยว">สถานที่ท่องเที่ยว</option>
							<option value="อพาร์ทเม้นท์">อพาร์ทเม้นท์</option>
							<option value="ทัวร์">ทัวร์</option>
							<option value="ฟาร์ม">ฟาร์ม</option>
							<optgroup label="Beauty & Healty">
							<option value="ร้านเบ็ดเตล็ด">ร้านเบ็ดเตล็ด</option>
							<option value="ร้านของฝาก">ร้านของฝาก</option>
							<option value="โรงเรียน">โรงเรียน</option>
							<option value="ร้านเสื้อผ้า">ร้านเสื้อผ้า</option>
							<option value="ร้านเวดดิ้ง">ร้านเวดดิ้ง</option>
							<option value="ร้านสัตว์เลี้ยง">ร้านสัตว์เลี้ยง</option>
							<option value="คาร์แคร์">คาร์แคร์</option>
							<option value="ร้านรองเท้า">ร้านรองเท้า</option>
							<option value="ร้านกระเป๋า">ร้านกระเป๋า</option>
							<option value="ร้านเครื่องเขียน">ร้านเครื่องเขียน</option>
							<option value="ร้านหนังสือ">ร้านหนังสือ</option>
							<option value="ร้านอิเล็กทรอนิคส์">ร้านอิเล็กทรอนิคส์</option>
							<option value="ร้านอุปกรณ์ไอที">ร้านอุปกรณ์ไอที</option>
							<option value="ร้านอุปกรณ์เบเกอรี่">ร้านอุปกรณ์เบเกอรี่</option>
							<option value="ร้านเครื่องดนตรี">ร้านเครื่องดนตรี</option>
							<option value="โรงภาพยนต์">โรงภาพยนต์</option>
							<option value="ร้านเครื่องประดับ">ร้านเครื่องประดับ</option>
							<option value="ร้านเฟอร์นิเจอร์">ร้านเฟอร์นิเจอร์</option>
							<option value="ร้านสินค้าเด็ก">ร้านสินค้าเด็ก</option>
							<option value="ร้านผลิตภัณฑ์ความงาม">ร้านผลิตภัณฑ์ความงาม</option>
						</select>
					</td>
					<th class="add_padding_15"><input type="text" name="special_type-{{$i}}" id="special_type" value=""></th>
					<td class="add_padding_15"><input type="text" name="name_th-{{$i}}" id="name_th-{{$i}}" value="" /></td>
					<td class="add_padding_15"><input type="text" name="name_en-{{$i}}" id="name_en-{{$i}}" value="" /></td>
					<td class="add_padding_15">
						<textarea name="branch-{{$i}}" id="branch-{{$i}}" cols="50" /></textarea>
					</td>
					<td class="add_padding_15">
						<select name="province-{{$i}}" id="province-{{$i}}" class="selectpicker">
							<option value="empty">กรุณาเลือกจังหวัด</option>
							<?php
								$province_list = Record::province_list();
								foreach($province_list as $province_list_each)
								{
									echo "<option value='".$province_list_each."'>".$province_list_each."</option>";
								}
							?>
						</select>
					</td>
					<td class="add_padding_15">
					<textarea name="contact_tel-{{$i}}" id="contact_tel-{{$i}}"></textarea>
					</td>
					<td class="add_padding_15"><input type="text" name="links-{{$i}}" id="links-{{$i}}" value="" /></td>
					<td class="add_padding_15"><input type="text" name="remarks-{{$i}}" id="remarks-{{$i}}" value="" /></td>
				</tr>
				<?php } ?>
			</table>
			{{ Form::close() }}
			<br />
			*หากไม่มีข้อมูลกรุณาใส่ "-" ในช่อง
			<br /><br />
		<a class="btn btn-primary" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-danger" href="{{url('/admin/record/list_records')}}" role="button" id="cancel">Cancel</a>
		</div>
	</div>
</div>
@endsection
