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
		<h1>Create new record</h1>
		{{Form::open(array('action' => 'AdminController@submit_new_record_list','id'=>'submit_form'))}}
			{{csrf_field()}}
			<table class="table table-bordered table-striped table-hover">
				<thead>
				<tr>
					<th class="add_padding_15">ซ้ำ</th>
					<th class="add_padding_15">No.</th>
					<th class="add_padding_15">Sources</th>
					<th class="add_padding_15">Categories</th>
					<th class="add_padding_15">Dtac Type</th>
					<th class="add_padding_15">ประเภทร้าน</th>
					<th class="add_padding_15">ประเภทร้านค้าพิเศษ</th>
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
					<td class="add_padding_15">{{$preview_new_record_list_each['special_type']}}</td>
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
			{{ Form::close() }}
			<br />
			<br /><br />
		<a class="btn btn-success" href="#" role="button" id="confirm_btn">Submit</a>
		<a class="btn btn-primary" href="{{url('/admin/record/edit_new_record_list')}}" role="button" id="edit_btn">Edit</a>
		<a class="btn btn-danger" href="{{url('/admin/record/list_records')}}" role="button" id="cancel">Cancel</a>
		</div>
	</div>
</div>
@endsection
