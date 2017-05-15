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
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน sources');
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
		    				alert('กรุษรกรอกขข้อมูลให้ครบถ้วน sources');
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
			if(confirm('กรุณายืนยันเพื่อทำการเพิ่ม Lead เข้าสู่ระบบ'))
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
		<h1>สร้าง Lead ร้านค้าใหม่</h1>
		{{Form::open(array('action' => 'AdminController@submit_new_record_list','id'=>'submit_form'))}}
			{{csrf_field()}}
			<table class="table table-bordered table-striped table-hover">
				<thead>
				<tr>
					<th class="add_padding_15">ซ้ำ</th>
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
				<?php 
					$i=0; 
					$j=0;
				?>
				<?php foreach($preview_new_record_list as $preview_new_record_list_each){ 
					$i++;
					?>
				<tr>
					<td class="add_padding_15">
					<?php
						$result = Record::check_duplicate_record($preview_new_record_list_each['name_th'],$preview_new_record_list_each['name_en'],$preview_new_record_list_each['province']);
						if($result=="1")
						{
							?>
							<a href="{{url('/admin/record/edit_duplicate_new_record_list/'.$j)}}"><i class="glyphicon glyphicon-remove" style="color:red;""></i></a>
						<?php
						}
					?>
					</td>
					<td class="add_padding_15">{{$i}}</td>
					<td class="add_padding_15">
						<?php 
						if($preview_new_record_list_each['sources']=="online_search")
						{
							echo "ค้นหาจากเว็บไซต์";
						}
						elseif($preview_new_record_list_each['sources']=="dtac_recommend")
						{
							echo "ร้านแนะนำจาก dtac";
						}
						elseif($preview_new_record_list_each['sources']=="walking")
						{
							echo "Walk in";
						}
						?>
					</td>
					<td class="add_padding_15">
					<?php 
						if($preview_new_record_list_each['categories']=="dinning_and_beverage")
						{
							echo "Dining and Beverage";
						}
						elseif($preview_new_record_list_each['categories']=="shopping_and_lifestyle")
						{
							echo "Shopping and Lifestyle";
						}
						elseif($preview_new_record_list_each['categories']=="beauty_and_healthy")
						{
							echo "Beauty and Healthy";
						}
						elseif($preview_new_record_list_each['categories']=="hotel_and_travel")
						{
							echo "Hotel and Travel";
						}
						elseif($preview_new_record_list_each['categories']=="online")
						{
							echo "Online";
						}
						?>
					</td>
					<td class="add_padding_15">
					<?php 
						if($preview_new_record_list_each['dtac_type']=="กทม./นนทบุรี/สมุทรปราการ")
						{
							echo "กทม./นนทบุรี/สมุทรปราการ";
						}
						elseif($preview_new_record_list_each['dtac_type']=="ต่างจังหวัด")
						{
							echo "ต่างจังหวัด";
						}
						elseif($preview_new_record_list_each['dtac_type']=="dtacแนะนำ")
						{
							echo "dtac แนะนำ";
						}
						elseif($preview_new_record_list_each['dtac_type']=="online")
						{
							echo "online";
						}
						elseif($preview_new_record_list_each['dtac_type']=="ต่ออายุ")
						{
							echo "ต่ออายุ";
						}
						elseif($preview_new_record_list_each['dtac_type']=="ดีลอย่างเดียว")
						{
							echo "ดีลอย่างเดียว";
						}
						elseif($preview_new_record_list_each['dtac_type']=="เฉพาะอาร์ทเวิร์ค")
						{
							echo "เฉพาะอาร์ทเวิร์ค";
						}
						?>
						
					</td>
					<td class="add_padding_15">
					<?php 
						if($preview_new_record_list_each['shop_type']=="ร้านอาหาร")
						{
							echo "ร้านอาหาร";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเครื่องดื่ม")
						{
							echo "ร้านเครื่องดื่ม";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านกาแฟ")
						{
							echo "ร้านกาแฟ";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเบเกอรี่")
						{
							echo "ร้านเบเกอรี่";
						}
						elseif($preview_new_record_list_each['shop_type']=="ผับ (ร้านอาหารและเครื่องดื่ม)")
						{
							echo "ผับ (ร้านอาหารและเครื่องดื่ม)";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านขนมหวาน")
						{
							echo "ร้านขนมหวาน";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเครื่องดื่มและเบเกอรี่")
						{
							echo "ร้านเครื่องดื่มและเบเกอรี่";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านอาหารและเบเกอรี่")
						{
							echo "ร้านอาหารและเบเกอรี่";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านไอศครีม")
						{
							echo "ร้านไอศครีม";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเพื่อสุขภาพ")
						{
							echo "ร้านเพื่อสุขภาพ";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านบุฟเฟ่ต์")
						{
							echo "ร้านบุฟเฟ่ต์";
						}
						elseif($preview_new_record_list_each['shop_type']=="โต๊ะจีน")
						{
							echo "โต๊ะจีน";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านสปา")
						{
							echo "ร้านสปา";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านนวด")
						{
							echo "ร้านนวด";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเสริมสวย")
						{
							echo "ร้านเสริมสวย";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านทำเล็บ")
						{
							echo "ร้านทำเล็บ";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านความงาม")
						{
							echo "ร้านความงาม";
						}
						elseif($preview_new_record_list_each['shop_type']=="ฟิสเนส")
						{
							echo "ฟิสเนส";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านนวดและสปา")
						{
							echo "ร้านนวดและสปา";
						}
						elseif($preview_new_record_list_each['shop_type']=="โรงแรม")
						{
							echo "โรงแรม";
						}
						elseif($preview_new_record_list_each['shop_type']=="รีสอร์ท")
						{
							echo "รีสอร์ท";
						}
						elseif($preview_new_record_list_each['shop_type']=="โฮมสเตย์")
						{
							echo "โฮมสเตย์";
						}
						elseif($preview_new_record_list_each['shop_type']=="เรือนำเที่ยว")
						{
							echo "เรือนำเที่ยว";
						}
						elseif($preview_new_record_list_each['shop_type']=="สถานที่ท่องเที่ยว")
						{
							echo "สถานที่ท่องเที่ยว";
						}
						elseif($preview_new_record_list_each['shop_type']=="อพาร์ทเม้นท์")
						{
							echo "อพาร์ทเม้นท์";
						}
						elseif($preview_new_record_list_each['shop_type']=="ทัวร์")
						{
							echo "ทัวร์";
						}
						elseif($preview_new_record_list_each['shop_type']=="ฟาร์ม")
						{
							echo "ฟาร์ม";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเบ็ดเตล็ด")
						{
							echo "ร้านเบ็ดเตล็ด";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านของฝาก")
						{
							echo "ร้านของฝาก";
						}
						elseif($preview_new_record_list_each['shop_type']=="โรงเรียน")
						{
							echo "โรงเรียน";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเสื้อผ้า")
						{
							echo "ร้านเสื้อผ้า";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเวดดิ้ง")
						{
							echo "ร้านเวดดิ้ง";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านสัตว์เลี้ยง")
						{
							echo "ร้านสัตว์เลี้ยง";
						}
						elseif($preview_new_record_list_each['shop_type']=="คาร์แคร์")
						{
							echo "คาร์แคร์";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านรองเท้า")
						{
							echo "ร้านรองเท้า";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านกระเป๋า")
						{
							echo "ร้านกระเป๋า";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเครื่องเขียน")
						{
							echo "ร้านเครื่องเขียน";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านหนังสือ")
						{
							echo "ร้านหนังสือ";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านอิเล็กทรอนิคส์")
						{
							echo "ร้านอิเล็กทรอนิคส์";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านอุปกรณ์ไอที")
						{
							echo "ร้านอุปกรณ์ไอที";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านอุปกรณ์เบเกอรี่")
						{
							echo "ร้านอุปกรณ์เบเกอรี่";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเครื่องดนตรี")
						{
							echo "ร้านเครื่องดนตรี";
						}
						elseif($preview_new_record_list_each['shop_type']=="โรงภาพยนต์")
						{
							echo "โรงภาพยนต์";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเครื่องประดับ")
						{
							echo "ร้านเครื่องประดับ";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านเฟอร์นิเจอร์")
						{
							echo "ร้านเฟอร์นิเจอร์";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านสินค้าเด็ก")
						{
							echo "ร้านสินค้าเด็ก";
						}
						elseif($preview_new_record_list_each['shop_type']=="ร้านผลิตภัณฑ์ความงาม")
						{
							echo "ร้านผลิตภัณฑ์ความงาม";
						}
						
						?>
					</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['special_type']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['name_th']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['name_en']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['branch']}}</td>
					<td class="add_padding_15">
						{{$preview_new_record_list_each['province']}}
					</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['contact_tel']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['links']}}</td>
					<td class="add_padding_15">{{$preview_new_record_list_each['remarks']}}</td>
				</tr>
				<?php 
						$j++;
						} 
					?>
			</table>
			{{ Form::close() }}
			<br />
			<br /><br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">ยืนยัน</a>
		<a class="btn btn-primary" href="{{url('/admin/record/edit_new_record_list')}}" role="button" id="edit_btn">แก้ไข</a>
		<a class="btn btn-danger" href="{{url('/admin/record/list_records')}}" role="button" id="cancel">ยกเลิก</a>
		</div>
	</div>
</div>
@endsection
