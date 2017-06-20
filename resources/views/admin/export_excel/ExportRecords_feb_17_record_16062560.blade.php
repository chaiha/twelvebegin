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
              <th>No.</th>
              <th>Date</th>
		      <th>Lot#</th>
		      <th>Result</th>
		      <th>Type</th>
		      <th>ประเภทร้านพิเศษ</th>
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
		      <th>Logo</th>
		      <th>C/FLogo</th>
		      <th>A.product</th>
		      <th>Product</th>
		      <th>Shop</th>
		      <th>Remark</th>
		      <th>เหตุผลที่ปฏิเสธ</th>
		      <th>หมายเหตุที่ปฏิเสธ</th>
		      <th>สาเหตุที่ไม่สามารถติดต่อได้</th>
		      <th>นัดให้ติดต่อครั้งต่อไป</th>
		      <th>เหตุผลที่ขอพิจารณา</th>
		      <th>นัดขอพิจารณาครั้งถัดไป</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($list_lot_no_1 as $each_record_1)
		    <tr>
		      <td>{{$each_record_1->id}}</td>
              <td><?php echo $record->find_record_no($each_record_1->id); ?></td>
		      <td>
		      <?php
		      echo $record->convert_date_format_dash($each_record_1->lot_date);
		      ?></td>
		      <td>{{$each_record_1->lot_no}}</td>
		      <td>
		      {{$each_record_1->result}}
		      </td>
		      <td>
		      <?php
				if($each_record_1->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
				{
					echo "กทม./นนทบุรี/สมุทรปราการ";
				}
				elseif($each_record_1->dtac_type=="ต่างจังหวัด")
				{
					echo "ต่างจังหวัด";
				}
				elseif($each_record_1->dtac_type=="dtacแนะนำ")
				{
					echo "dtac แนะนำ";
				}
				elseif($each_record_1->dtac_type=="online")
				{
					echo "online";
				}
				elseif($each_record_1->dtac_type=="ต่ออายุ")
				{
					echo "ต่ออายุ";
				}
				elseif($each_record_1->dtac_type=="ดีลอย่างเดียว")
				{
					echo "ดีลอย่างเดียว";
				}
				elseif($each_record_1->dtac_type=="เฉพาะอาร์ทเวิร์ค")
				{
					echo "เฉพาะอาร์ทเวิร์ค";
				}

				?>
		      </td>
		      <td>
		      {{$each_record_1->special_type}}
		      </td>
		      <td></td>
		      <td>
		      <?php
				if($each_record_1->categories=="dinning_and_beverage")
				{
					echo "Dining and Beverage";
				}
				elseif ($each_record_1->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping and Lifestyle";
				}
				elseif ($each_record_1->categories=="beauty_and_healthy") 
				{
					echo "Beauty and Healthy";
				}
				elseif ($each_record_1->categories=="hotel_and_travel") 
				{
					echo "Hotel and Travel";
				}
				elseif ($each_record_1->categories=="online") 
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
		      <td>{{$each_record_1->name_th}}</td>
		      <td>{{$each_record_1->name_en}}</td>
		      <td>{{$each_record_1->yes_feedback}}</td>
		      <td></td>
		      <td></td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_1->yes_privilege_start);
		      ?>
		      </td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_1->yes_privilege_end);
		      ?>
		      </td>
		      <td></td>
		      <td>{{$each_record_1->yes_condition}}</td>
		      <td>{{$each_record_1->branch}}</td>
		      <td>{{$each_record_1->address}}</td>
		      <td>{{$each_record_1->contact_tel}}</td>
		      <td>{{$each_record_1->latitude}}</td>
		      <td>{{$each_record_1->longtitude}}</td>
		      <td>{{$each_record_1->shop_type}}</td>
		      <td>{{$each_record_1->branch_amount}}</td>
		      <td>{{$each_record_1->contact_person}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record_1->sending_address}}</td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_1->has_reply_doc=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_1->has_confirm_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_1->has_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_1->has_confirm_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_1->has_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_1->has_shop_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td>{{$each_record_1->remarks}}</td>
		      <td>{{$each_record_1->no_reason}}</td>
		      <td>{{$each_record_1->no_note}}</td>
		      <td>{{$each_record_1->cannot_contact_reason}}</td>
		      <td>{{$each_record_1->cannot_contact_appointment}}</td>
		      <td>{{$each_record_1->consider_reason}}</td>
		      <td>{{$each_record_1->consider_appointment_feedback}}</td>
		      
		    </tr>
		   @endforeach
		   @foreach ($list_lot_no_2 as $each_record_2)
		    <tr>
		      <td>{{$each_record_2->id}}</td>
              <td><?php echo $record->find_record_no($each_record_2->id); ?></td>
		      <td>
		      <?php
		      echo $record->convert_date_format_dash($each_record_2->lot_date);
		      ?></td>
		      <td>{{$each_record_2->lot_no}}</td>
		      <td>
		      {{$each_record_2->result}}
		      </td>
		      <td>
		      <?php
				if($each_record_2->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
				{
					echo "กทม./นนทบุรี/สมุทรปราการ";
				}
				elseif($each_record_2->dtac_type=="ต่างจังหวัด")
				{
					echo "ต่างจังหวัด";
				}
				elseif($each_record_2->dtac_type=="dtacแนะนำ")
				{
					echo "dtac แนะนำ";
				}
				elseif($each_record_2->dtac_type=="online")
				{
					echo "online";
				}
				elseif($each_record_2->dtac_type=="ต่ออายุ")
				{
					echo "ต่ออายุ";
				}
				elseif($each_record_2->dtac_type=="ดีลอย่างเดียว")
				{
					echo "ดีลอย่างเดียว";
				}
				elseif($each_record_2->dtac_type=="เฉพาะอาร์ทเวิร์ค")
				{
					echo "เฉพาะอาร์ทเวิร์ค";
				}

				?>
		      </td>
		      <td>
		      {{$each_record_2->special_type}}
		      </td>
		      <td></td>
		      <td>
		      <?php
				if($each_record_2->categories=="dinning_and_beverage")
				{
					echo "Dining and Beverage";
				}
				elseif ($each_record_2->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping and Lifestyle";
				}
				elseif ($each_record_2->categories=="beauty_and_healthy") 
				{
					echo "Beauty and Healthy";
				}
				elseif ($each_record_2->categories=="hotel_and_travel") 
				{
					echo "Hotel and Travel";
				}
				elseif ($each_record_2->categories=="online") 
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
		      <td>{{$each_record_2->name_th}}</td>
		      <td>{{$each_record_2->name_en}}</td>
		      <td>{{$each_record_2->yes_feedback}}</td>
		      <td></td>
		      <td></td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_2->yes_privilege_start);
		      ?>
		      </td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_2->yes_privilege_end);
		      ?>
		      </td>
		      <td></td>
		      <td>{{$each_record_2->yes_condition}}</td>
		      <td>{{$each_record_2->branch}}</td>
		      <td>{{$each_record_2->address}}</td>
		      <td>{{$each_record_2->contact_tel}}</td>
		      <td>{{$each_record_2->latitude}}</td>
		      <td>{{$each_record_2->longtitude}}</td>
		      <td>{{$each_record_2->shop_type}}</td>
		      <td>{{$each_record_2->branch_amount}}</td>
		      <td>{{$each_record_2->contact_person}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record_2->sending_address}}</td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_2->has_reply_doc=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_2->has_confirm_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_2->has_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_2->has_confirm_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_2->has_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_2->has_shop_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td>{{$each_record_2->remarks}}</td>
		      <td>{{$each_record_2->no_reason}}</td>
		      <td>{{$each_record_2->no_note}}</td>
		      <td>{{$each_record_2->cannot_contact_reason}}</td>
		      <td>{{$each_record_2->cannot_contact_appointment}}</td>
		      <td>{{$each_record_2->consider_reason}}</td>
		      <td>{{$each_record_2->consider_appointment_feedback}}</td>
		      
		    </tr>
		   @endforeach
		   @foreach ($list_lot_no_3 as $each_record_3)
		    <tr>
		      <td>{{$each_record_3->id}}</td>
              <td><?php echo $record->find_record_no($each_record_3->id); ?></td>
		      <td>
		      <?php
		      echo $record->convert_date_format_dash($each_record_3->lot_date);
		      ?></td>
		      <td>{{$each_record_3->lot_no}}</td>
		      <td>
		      {{$each_record_3->result}}
		      </td>
		      <td>
		      <?php
				if($each_record_3->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
				{
					echo "กทม./นนทบุรี/สมุทรปราการ";
				}
				elseif($each_record_3->dtac_type=="ต่างจังหวัด")
				{
					echo "ต่างจังหวัด";
				}
				elseif($each_record_3->dtac_type=="dtacแนะนำ")
				{
					echo "dtac แนะนำ";
				}
				elseif($each_record_3->dtac_type=="online")
				{
					echo "online";
				}
				elseif($each_record_3->dtac_type=="ต่ออายุ")
				{
					echo "ต่ออายุ";
				}
				elseif($each_record_3->dtac_type=="ดีลอย่างเดียว")
				{
					echo "ดีลอย่างเดียว";
				}
				elseif($each_record_3->dtac_type=="เฉพาะอาร์ทเวิร์ค")
				{
					echo "เฉพาะอาร์ทเวิร์ค";
				}

				?>
		      </td>
		      <td>
		      {{$each_record_3->special_type}}
		      </td>
		      <td></td>
		      <td>
		      <?php
				if($each_record_3->categories=="dinning_and_beverage")
				{
					echo "Dining and Beverage";
				}
				elseif ($each_record_3->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping and Lifestyle";
				}
				elseif ($each_record_3->categories=="beauty_and_healthy") 
				{
					echo "Beauty and Healthy";
				}
				elseif ($each_record_3->categories=="hotel_and_travel") 
				{
					echo "Hotel and Travel";
				}
				elseif ($each_record_3->categories=="online") 
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
		      <td>{{$each_record_3->name_th}}</td>
		      <td>{{$each_record_3->name_en}}</td>
		      <td>{{$each_record_3->yes_feedback}}</td>
		      <td></td>
		      <td></td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_3->yes_privilege_start);
		      ?>
		      </td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_3->yes_privilege_end);
		      ?>
		      </td>
		      <td></td>
		      <td>{{$each_record_3->yes_condition}}</td>
		      <td>{{$each_record_3->branch}}</td>
		      <td>{{$each_record_3->address}}</td>
		      <td>{{$each_record_3->contact_tel}}</td>
		      <td>{{$each_record_3->latitude}}</td>
		      <td>{{$each_record_3->longtitude}}</td>
		      <td>{{$each_record_3->shop_type}}</td>
		      <td>{{$each_record_3->branch_amount}}</td>
		      <td>{{$each_record_3->contact_person}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record_3->sending_address}}</td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_3->has_reply_doc=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_3->has_confirm_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_3->has_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_3->has_confirm_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_3->has_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_3->has_shop_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td>{{$each_record_3->remarks}}</td>
		      <td>{{$each_record_3->no_reason}}</td>
		      <td>{{$each_record_3->no_note}}</td>
		      <td>{{$each_record_3->cannot_contact_reason}}</td>
		      <td>{{$each_record_3->cannot_contact_appointment}}</td>
		      <td>{{$each_record_3->consider_reason}}</td>
		      <td>{{$each_record_3->consider_appointment_feedback}}</td>
		      
		    </tr>
		   @endforeach
		   @foreach ($list_lot_no_4 as $each_record_4)
		    <tr>
		      <td>{{$each_record_4->id}}</td>
              <td><?php echo $record->find_record_no($each_record_4->id); ?></td>
		      <td>
		      <?php
		      echo $record->convert_date_format_dash($each_record_4->lot_date);
		      ?></td>
		      <td>{{$each_record_4->lot_no}}</td>
		      <td>
		      {{$each_record_4->result}}
		      </td>
		      <td>
		      <?php
				if($each_record_4->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
				{
					echo "กทม./นนทบุรี/สมุทรปราการ";
				}
				elseif($each_record_4->dtac_type=="ต่างจังหวัด")
				{
					echo "ต่างจังหวัด";
				}
				elseif($each_record_4->dtac_type=="dtacแนะนำ")
				{
					echo "dtac แนะนำ";
				}
				elseif($each_record_4->dtac_type=="online")
				{
					echo "online";
				}
				elseif($each_record_4->dtac_type=="ต่ออายุ")
				{
					echo "ต่ออายุ";
				}
				elseif($each_record_4->dtac_type=="ดีลอย่างเดียว")
				{
					echo "ดีลอย่างเดียว";
				}
				elseif($each_record_4->dtac_type=="เฉพาะอาร์ทเวิร์ค")
				{
					echo "เฉพาะอาร์ทเวิร์ค";
				}

				?>
		      </td>
		      <td>
		      {{$each_record_4->special_type}}
		      </td>
		      <td></td>
		      <td>
		      <?php
				if($each_record_4->categories=="dinning_and_beverage")
				{
					echo "Dining and Beverage";
				}
				elseif ($each_record_4->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping and Lifestyle";
				}
				elseif ($each_record_4->categories=="beauty_and_healthy") 
				{
					echo "Beauty and Healthy";
				}
				elseif ($each_record_4->categories=="hotel_and_travel") 
				{
					echo "Hotel and Travel";
				}
				elseif ($each_record_4->categories=="online") 
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
		      <td>{{$each_record_4->name_th}}</td>
		      <td>{{$each_record_4->name_en}}</td>
		      <td>{{$each_record_4->yes_feedback}}</td>
		      <td></td>
		      <td></td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_4->yes_privilege_start);
		      ?>
		      </td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_4->yes_privilege_end);
		      ?>
		      </td>
		      <td></td>
		      <td>{{$each_record_4->yes_condition}}</td>
		      <td>{{$each_record_4->branch}}</td>
		      <td>{{$each_record_4->address}}</td>
		      <td>{{$each_record_4->contact_tel}}</td>
		      <td>{{$each_record_4->latitude}}</td>
		      <td>{{$each_record_4->longtitude}}</td>
		      <td>{{$each_record_4->shop_type}}</td>
		      <td>{{$each_record_4->branch_amount}}</td>
		      <td>{{$each_record_4->contact_person}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record_4->sending_address}}</td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_4->has_reply_doc=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_4->has_confirm_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_4->has_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_4->has_confirm_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_4->has_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_4->has_shop_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td>{{$each_record_4->remarks}}</td>
		      <td>{{$each_record_4->no_reason}}</td>
		      <td>{{$each_record_4->no_note}}</td>
		      <td>{{$each_record_4->cannot_contact_reason}}</td>
		      <td>{{$each_record_4->cannot_contact_appointment}}</td>
		      <td>{{$each_record_4->consider_reason}}</td>
		      <td>{{$each_record_4->consider_appointment_feedback}}</td>
		      
		    </tr>
		   @endforeach
		   @foreach ($list_lot_no_5 as $each_record_5)
		    <tr>
		      <td>{{$each_record_5->id}}</td>
              <td><?php echo $record->find_record_no($each_record_5->id); ?></td>
		      <td>
		      <?php
		      echo $record->convert_date_format_dash($each_record_5->lot_date);
		      ?></td>
		      <td>{{$each_record_5->lot_no}}</td>
		      <td>
		      {{$each_record_5->result}}
		      </td>
		      <td>
		      <?php
				if($each_record_5->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
				{
					echo "กทม./นนทบุรี/สมุทรปราการ";
				}
				elseif($each_record_5->dtac_type=="ต่างจังหวัด")
				{
					echo "ต่างจังหวัด";
				}
				elseif($each_record_5->dtac_type=="dtacแนะนำ")
				{
					echo "dtac แนะนำ";
				}
				elseif($each_record_5->dtac_type=="online")
				{
					echo "online";
				}
				elseif($each_record_5->dtac_type=="ต่ออายุ")
				{
					echo "ต่ออายุ";
				}
				elseif($each_record_5->dtac_type=="ดีลอย่างเดียว")
				{
					echo "ดีลอย่างเดียว";
				}
				elseif($each_record_5->dtac_type=="เฉพาะอาร์ทเวิร์ค")
				{
					echo "เฉพาะอาร์ทเวิร์ค";
				}

				?>
		      </td>
		      <td>
		      {{$each_record_5->special_type}}
		      </td>
		      <td></td>
		      <td>
		      <?php
				if($each_record_5->categories=="dinning_and_beverage")
				{
					echo "Dining and Beverage";
				}
				elseif ($each_record_5->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping and Lifestyle";
				}
				elseif ($each_record_5->categories=="beauty_and_healthy") 
				{
					echo "Beauty and Healthy";
				}
				elseif ($each_record_5->categories=="hotel_and_travel") 
				{
					echo "Hotel and Travel";
				}
				elseif ($each_record_5->categories=="online") 
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
		      <td>{{$each_record_5->name_th}}</td>
		      <td>{{$each_record_5->name_en}}</td>
		      <td>{{$each_record_5->yes_feedback}}</td>
		      <td></td>
		      <td></td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_5->yes_privilege_start);
		      ?>
		      </td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_5->yes_privilege_end);
		      ?>
		      </td>
		      <td></td>
		      <td>{{$each_record_5->yes_condition}}</td>
		      <td>{{$each_record_5->branch}}</td>
		      <td>{{$each_record_5->address}}</td>
		      <td>{{$each_record_5->contact_tel}}</td>
		      <td>{{$each_record_5->latitude}}</td>
		      <td>{{$each_record_5->longtitude}}</td>
		      <td>{{$each_record_5->shop_type}}</td>
		      <td>{{$each_record_5->branch_amount}}</td>
		      <td>{{$each_record_5->contact_person}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record_5->sending_address}}</td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_5->has_reply_doc=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_5->has_confirm_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_5->has_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_5->has_confirm_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_5->has_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_5->has_shop_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td>{{$each_record_5->remarks}}</td>
		      <td>{{$each_record_5->no_reason}}</td>
		      <td>{{$each_record_5->no_note}}</td>
		      <td>{{$each_record_5->cannot_contact_reason}}</td>
		      <td>{{$each_record_5->cannot_contact_appointment}}</td>
		      <td>{{$each_record_5->consider_reason}}</td>
		      <td>{{$each_record_5->consider_appointment_feedback}}</td>
		      
		    </tr>
		   @endforeach
		   @foreach ($list_lot_no_6 as $each_record_6)
		    <tr>
		      <td>{{$each_record_6->id}}</td>
              <td><?php echo $record->find_record_no($each_record_6->id); ?></td>
		      <td>
		      <?php
		      echo $record->convert_date_format_dash($each_record_6->lot_date);
		      ?></td>
		      <td>{{$each_record_6->lot_no}}</td>
		      <td>
		      {{$each_record_6->result}}
		      </td>
		      <td>
		      <?php
				if($each_record_6->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
				{
					echo "กทม./นนทบุรี/สมุทรปราการ";
				}
				elseif($each_record_6->dtac_type=="ต่างจังหวัด")
				{
					echo "ต่างจังหวัด";
				}
				elseif($each_record_6->dtac_type=="dtacแนะนำ")
				{
					echo "dtac แนะนำ";
				}
				elseif($each_record_6->dtac_type=="online")
				{
					echo "online";
				}
				elseif($each_record_6->dtac_type=="ต่ออายุ")
				{
					echo "ต่ออายุ";
				}
				elseif($each_record_6->dtac_type=="ดีลอย่างเดียว")
				{
					echo "ดีลอย่างเดียว";
				}
				elseif($each_record_6->dtac_type=="เฉพาะอาร์ทเวิร์ค")
				{
					echo "เฉพาะอาร์ทเวิร์ค";
				}

				?>
		      </td>
		      <td>
		      {{$each_record_6->special_type}}
		      </td>
		      <td></td>
		      <td>
		      <?php
				if($each_record_6->categories=="dinning_and_beverage")
				{
					echo "Dining and Beverage";
				}
				elseif ($each_record_6->categories=="shopping_and_lifestyle") 
				{
					echo "Shopping and Lifestyle";
				}
				elseif ($each_record_6->categories=="beauty_and_healthy") 
				{
					echo "Beauty and Healthy";
				}
				elseif ($each_record_6->categories=="hotel_and_travel") 
				{
					echo "Hotel and Travel";
				}
				elseif ($each_record_6->categories=="online") 
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
		      <td>{{$each_record_6->name_th}}</td>
		      <td>{{$each_record_6->name_en}}</td>
		      <td>{{$each_record_6->yes_feedback}}</td>
		      <td></td>
		      <td></td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_6->yes_privilege_start);
		      ?>
		      </td>
		      <td>
		      <?php
		      	echo $record->convert_date_format_dash($each_record_6->yes_privilege_end);
		      ?>
		      </td>
		      <td></td>
		      <td>{{$each_record_6->yes_condition}}</td>
		      <td>{{$each_record_6->branch}}</td>
		      <td>{{$each_record_6->address}}</td>
		      <td>{{$each_record_6->contact_tel}}</td>
		      <td>{{$each_record_6->latitude}}</td>
		      <td>{{$each_record_6->longtitude}}</td>
		      <td>{{$each_record_6->shop_type}}</td>
		      <td>{{$each_record_6->branch_amount}}</td>
		      <td>{{$each_record_6->contact_person}}</td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>{{$each_record_6->sending_address}}</td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_6->has_reply_doc=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_6->has_confirm_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_6->has_logo_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_6->has_confirm_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_6->has_product_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td class="text-center">
		      	<?php
		      	if($each_record_6->has_shop_img=="1")
		      	{
		      		echo "X";
		      	}
		      	?>
		      </td>
		      <td>{{$each_record_6->remarks}}</td>
		      <td>{{$each_record_6->no_reason}}</td>
		      <td>{{$each_record_6->no_note}}</td>
		      <td>{{$each_record_6->cannot_contact_reason}}</td>
		      <td>{{$each_record_6->cannot_contact_appointment}}</td>
		      <td>{{$each_record_6->consider_reason}}</td>
		      <td>{{$each_record_6->consider_appointment_feedback}}</td>
		      
		    </tr>
		   @endforeach
		  </tbody>
		
		</table>
</body>
</html>