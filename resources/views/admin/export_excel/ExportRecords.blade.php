<?php
use App\Record;
use App\SelectRecord;
use App\User;
$record = new Record;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Export</title>
</head>
<body>
	<table class="table table-bordered">
		  <thead class="thead-inverse">
		    <tr>
              <th>ID</th>
              <th>Date</th>
		      <th>Lot#</th>
		      <th>Month</th>
		      <th>Sales</th>
		      <th>Type</th>
		      <th>ประเภทร้านพิเศษ</th>
		      <th>No</th>
		      <th>All</th>
		      <th>ประเภทธุรกิจ</th>
		      <th>USSD No.</th>
		      <th>Xtra</th>
		      <th>Prefix1</th>
		      <th>Prefix2</th>
		      <th>Prefix3</th>
		      <th>ชื่อภาษาไทย</th>
		      <th>ชื่อภาษาอังกฤษ</th>
		      <th>Privilege</th>
		      <th>Eligibility(Per)</th>
		      <th>Quota</th>
		      <th>Period-Start</th>
		      <th>Period-End</th>
		      <th>Terms&Condition</th>
		      <th>เงื่อนไขเพิ่มเติม</th>
		      <th>สาขา</th>
		      <th>ที่อยู่</th>
		      <th>เบอร์โทรติดต่อ</th>
		      <th>ละติดจูด</th>
		      <th>ลองจิจูด</th>
		      <th>ประเภทร้าน</th>
		      <th>จำนวนสาขา</th>
		      <th>ขื่อเจ้าของร้าน/ผู้ประสานงาน</th>
		      <th>Standee</th>
		      <th>TentCard-A4</th>
		      <th>TentCard-A5</th>
		      <th>ที่อยู่จัดส่ง</th>
		      <th>C/FDoc</th>
		      <th>A.logo</th>
		      <th>Logo</th>
		      <th>A.product</th>
		      <th>Product</th>
		      <th>Shop</th>
		      <th>Remark</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($list_lot_no as $each_record)
		    <tr>
		      <td>{{$each_record->id}}</td>
		      <td>
		      <?php
		      echo $record->convert_date_format_dash($each_record->lot_date);
		      ?></td>
		      <td>{{$each_record->lot_no}}</td>
		      <td>
		      <?php
		      echo $record->excel_month($each_record->lot_date);
		      ?>
		      </td>
		      <td>
		      <?php
		      $user = new User;
		      echo $user->get_first_name_by_id($each_record->sale);
		      ?>
		      </td>
		      <td>
		      <?php
				if($each_record->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
				{
					echo "กทม./นนทบุรี/สมุทรปราการ";
				}
				elseif($each_record->dtac_type=="ต่างจังหวัด")
				{
					echo "ต่างจังหวัด";
				}
				elseif($each_record->dtac_type=="dtacแนะนำ")
				{
					echo "dtac แนะนำ";
				}
				elseif($each_record->dtac_type=="online")
				{
					echo "online";
				}
				elseif($each_record->dtac_type=="ต่ออายุ")
				{
					echo "ต่ออายุ";
				}
				elseif($each_record->dtac_type=="ดีลอย่างเดียว")
				{
					echo "ดีลอย่างเดียว";
				}
				elseif($each_record->dtac_type=="เฉพาะอาร์ทเวิร์ค")
				{
					echo "เฉพาะอาร์ทเวิร์ค";
				}

				?>
		      </td>
		      <td>
		      {{$each_record->special_type}}
		      </td>
		      <td></td>
		      <td></td>
		      <td>
		      <?php
				if($each_record->categories=="dinning_and_beverage")
				{
					echo "Dining and Beverage";
				}
				elseif ($each_record->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping and Lifestyle";
				}
				elseif ($each_record->categories=="beauty_and_healthy") 
				{
					echo "Beauty and Healthy";
				}
				elseif ($each_record->categories=="hotel_and_travel") 
				{
					echo "Hotel and Travel";
				}
				elseif ($each_record->categories=="online") 
				{
					echo "Online";
				}
				?>
		      </td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record->name_th}}</td>
		      <td>{{$each_record->name_en}}</td>
		      <td>{{$each_record->yes_feedback}}</td>
		      <td></td>
		      <td></td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record->yes_privilege_start);
		      ?>
		      </td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record->yes_privilege_end);
		      ?>
		      </td>
		      <td></td>
		      <td>{{$each_record->yes_condition}}</td>
		      <td>{{$each_record->branch}}</td>
		      <td>{{$each_record->address}}</td>
		      <td>{{$each_record->contact_tel}}</td>
		      <td>{{$each_record->latitude}}</td>
		      <td>{{$each_record->longtitude}}</td>
		      <td>{{$each_record->shop_type}}</td>
		      <td>{{$each_record->branch_amount}}</td>
		      <td>{{$each_record->contact_person}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record->sending_address}}</td>
		      <td class="text-center">
		      	<?php
		      	if($each_record->has_reply_doc=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record->has_confirm_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record->has_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record->has_confirm_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record->has_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record->has_shop_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td>{{$each_record->remarks}}</td>
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>
</body>
</html>