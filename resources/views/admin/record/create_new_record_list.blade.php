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
		    		if($("#branch-"+i).val()=="")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน branch');
		    			error = error+1;
						break;
		    		}
		    		if($("#address-"+i).val()=="")
		    		{
		    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน address');
		    			error = error+1;
						break;
		    		}
		    		if($("#province-"+i).val()=="empty")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน province');
						error = error+1;
						break;
					}
					if($("#latitude-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน latitude');
						error = error+1;
						break;
					}
					if($("#longtitude-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน longtitude');
						error = error+1;
						break;
					}
					if($("#contact_person-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact person');
						error = error+1;
						break;
					}
					if($("#contact_tel-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact tel');
						error = error+1;
						break;
					}
					if($("#contact_email-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact email');
						error = error+1;
						break;
					}
					if($("#links-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน links');
						error = error+1;
						break;
					}
					if($("#remarks-"+i).val()=="")
					{
						alert('กรุษรกรอกขข้อมูลให้ครบถ้วน remarks');
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
			    		if($("#branch-"+i).val()=="")
			    		{
			    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน branch');
		    				error = error+1;
							break;
		    			}
			    		if($("#address-"+i).val()=="")
			    		{
			    			alert('กรุษรกรอกขข้อมูลให้ครบถ้วน address');
		    				error = error+1;
							break;
		    			}
			    		if($("#province-"+i).val()=="empty")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน province');
							error = error+1;
							break;
						}
						if($("#latitude-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน latitude');
							error = error+1;
							break;
						}
						if($("#longtitude-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน longtitude');
							error = error+1;
							break;
						}
						if($("#contact_person-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact person');
							error = error+1;
							break;
						}
						if($("#contact_tel-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact tel');
							error = error+1;
							break;
						}
						if($("#contact_email-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน contact email');
							error = error+1;
							break;
						}
						if($("#links-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน links');
							error = error+1;
							break;
						}
						if($("#remarks-"+i).val()=="")
						{
							alert('กรุษรกรอกขข้อมูลให้ครบถ้วน remarks');
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
				<?php for($i=1;$i<=20;$i++){ ?>
				<tr>
					<td class="add_padding_15">{{$i}}</td>
					<td class="add_padding_15">
						<select name="sources-{{$i}}"  class="selectpicker sources" id="sources-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<option value="online_search" >Online Search</option>
							<option value="dtac_recommend" >DTAC Recommend</option>
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
							<option value="ร้านกทม" >ร้าน กทม</option>
							<option value="ร้านตจว" >ร้าน ตจว</option>
							<option value="ร้านonline" >ร้าน online</option>
							<option value="ร้านต่ออายุ" >ร้านต่ออายุ</option>
							<option value="ร้านดีลอย่างเดียว" >ร้านดีลอย่างเดียว</option>
							<option value="ร้านเฉพาะอาร์ทเวิร์ค" >ร้านเฉพาะอาร์ทเวิร์ค</option>
						</select>
					</td>
					<td class="add_padding_15">
						<select name="shop_type-{{$i}}"  class="selectpicker shop_type" id="shop_type-{{$i}}">
							<option value="empty">กรุณาเลือก</option>
							<option value="ร้านเบ็ดเตล็ด" >ร้าน เบ็ดเตล็ด</option>
							<option value="ร้านอาหาร" >ร้าน อาหาร</option>
							<option value="ร้านอาหารนานาชาติ" >ร้าน อาหารนานาชาติ</option>
						</select>
					</td>
					<td class="add_padding_15"><input type="text" name="name_th-{{$i}}" id="name_th-{{$i}}" value="" /></td>
					<td class="add_padding_15"><input type="text" name="name_en-{{$i}}" id="name_en-{{$i}}" value="" /></td>
					<td class="add_padding_15">
						<textarea name="branch-{{$i}}" id="branch-{{$i}}" cols="50" /></textarea>
					</td>
					<td class="add_padding_15">
						<textarea name="address-{{$i}}" id="address-{{$i}}" cols="50"></textarea>
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
						<textarea name="latitude-{{$i}}" id="latitude-{{$i}}" cols="30"></textarea>
					</td>
					<td class="add_padding_15">
						<textarea name="longtitude-{{$i}}" id="longtitude-{{$i}}" cols="30"></textarea>
					</td>
					<td class="add_padding_15"><input type="text" name="contact_person-{{$i}}" id="contact_person-{{$i}}" value="" /></td>
					<td class="add_padding_15">
					<textarea name="contact_tel-{{$i}}" id="contact_tel-{{$i}}">
					</textarea>
					</td>
					<td class="add_padding_15"><input type="text" name="contact_email-{{$i}}" id="contact_email-{{$i}}" value="" /></td>
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
