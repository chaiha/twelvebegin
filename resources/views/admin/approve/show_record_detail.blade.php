@extends('admin.layouts.master')

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
        if(confirm('กรุณาตรวจสอบ และ ยืนยัน'))
            {
                $("#submit_form").submit(); 
            }
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
{{Form::open(array('action' => 'AdminController@submit_approve_record','id'=>'submit_form'))}}
    <div class="row">
        <div class="form-group">
        <h1><b <?php if($select_record->result=="yes"){echo "style='color:green'";}elseif($select_record->result=="no_reply"||$select_record->result=="waiting"){echo "style='color:#FF8000'";}elseif($select_record->result=="rejected"||$select_record->result=="closed"){echo "style='color:red'";} ?> >[{{$record->check_result_and_show($select_record->result)}}] </b>/ {{$select_record->record->code}}/{{$select_record->name_th}} <?php if($select_record->name_en!=""){ echo "/ ".$select_record->name_en;}  ?> 
        @if($select_record->result=="yes")
        <a href="{{url('/admin/approve_record_from_sale/edit_record/'.$select_record->record_id.'/'.$select_record->sale_id)}}" class="btn btn-warning">แก้ไขข้อมูล</a>
        @endif
        </h1> 
        <h3>ข้อมูลเบื้องต้นของ {{$select_record->name_th}} / {{$select_record->name_en}} / ติดต่อ {{$select_record->contact_person}} / โทร {{$select_record->contact_tel}}</h3>
            {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <label>ข้อมูลสำหรับ Record</label>
                <input type="hidden" id="record_id" name="record_id" value="{{$select_record->record->id}}" />
                <input type="hidden" id="call_amount" name="call_amount" value="{{$select_record->record->call_amount}}" />
                <table class="table table-bordered table-striped table-condensed">
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
                        <input type="hidden" name="record_id" id="record_id" value="{{$select_record->record_id}}" />
                            <input type="hidden" name="sale_id" id="sale_id" value="{{$select_record->sale_id}}" />
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
                                if($select_record->dtac_type=="กทม./นนทบุรี/สมุทรปราการ")
                                {
                                    echo "กทม./นนทบุรี/สมุทรปราการ";
                                }
                                elseif ($select_record->dtac_type=="dtacแนะนำ") 
                                {
                                    echo "dtac แนะนำ";
                                }
                                elseif ($select_record->dtac_type=="ต่างจังหวัด") 
                                {
                                    echo "ต่างจังหวัด";
                                }
                                elseif ($select_record->dtac_type=="online")    
                                {
                                    echo "online";
                                }
                                elseif ($select_record->dtac_type=="ต่ออายุ") 
                                {
                                    echo "ต่ออายุ";
                                }
                                elseif ($select_record->dtac_type=="ดีลอย่างเดียว") 
                                {
                                    echo "ดีลอย่างเดียว";
                                }
                                elseif ($select_record->dtac_type=="เฉพาะอาร์ทเวิร์ค") 
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
                            {{$select_record->special_type}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-xs-12">
                <label>ข้อมูลของร้าน</label>
                <table class="table table-bordered table-striped table-condensed">
                    <tr>
                        <th>ชื่อไทย</th>
                        <th>ชื่ออังกฤษ</th>
                        <th>สาขา</th>
                        <th>จำนวนสาขา</th>
                        <th>ที่อยู่</th>
                        <th>จังหวัด</th>
                        <th>ละติจูด</th>
                        <th>ลองติจูด</th>
                    </tr>
                    <tr>
                        <td>{{$select_record->name_th}}</td>
                        <td>{{$select_record->name_en}}</td>
                        <td>{{$select_record->branch}}</td>
                        <td>
                        {{$select_record->branch_amount}}
                        </td>
                        <td>
                        @if($select_record->edit_address!="none")
                            {{$select_record->edit_address}}
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
                        <th>Contact Person</th>
                        <th>Contact Telephone number</th>
                        <th>Contact Email</th>
                        <th>Contact Date [ วัน / เดือน / ปี ]</th>
                        <th>ที่อยู่ให้จัดส่ง</th>
                    </tr>
                    <tr>
                        <td>
                        @if($select_record->edit_contact_person!="none")
                            {{$select_record->edit_contact_person}}
                        @else
                            {{$select_record->contact_person}}
                        @endif
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
                        <td>{{$select_record->sending_address}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-xs-12">
            <label>ข้อมูลอื่นๆ</label>
            <table class="table table-bordered table-striped table-condensed">
                    <tr>
                        <th>Links</th>
                        <th>Remark</th>
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
                                {{$select_record->note}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <label>เบอร์โทรศัพท์: </label> <?php if($select_record->is_tel_correct=="1"){ echo "ถูกต้อง";} else { echo "เบอร์โทรศัพท์ไม่ถูกต้อง เบอร์ที่ถูกต้องคือ <b>".$select_record->wrong_number_new_tel_number."</b>"; } ?>
                
            </div>
            <div class="row">
        </div>
        <div class="row">
            <div class="col-xs-12"><b>ผลการโทร : </b>
            <input type="hidden" name="result" id="result" value="{{$select_record->result}}" /> 
                @if($select_record->result=="yes") 
                    <span>Yes</span><br />                  
                    <b>Privilege : </b> {{$select_record->yes_feedback}} <br />
                    <b>เงื่อนไข : </b> {{$select_record->yes_condition}} <br />
                    <b>Start Privilege Date [ วัน / เดือน / ปี ] : </b><?php $yes_privilege_start = explode('-', $select_record->yes_privilege_start); echo $yes_privilege_start[2]."/".$yes_privilege_start[1]."/".$yes_privilege_start[0] ?> <br />
                    <b>End Privilege Date [ วัน / เดือน / ปี ] : </b> <?php $yes_privilege_end = explode('-', $select_record->yes_privilege_end); echo $yes_privilege_end[2]."/".$yes_privilege_end[1]."/".$yes_privilege_end[0] ?> 
                    <div class="row add-margin-20">
                    <h3>ตรวจสอบ</h3>
                    <div class="col-xs-3">
                        <table class="table table-bordered table-striped table-condensed">
                            <tr>
                                <td>รายการตรวจสอบ</td>
                                <td>ผลจากsale</td>
                                <td>ตรวจสอบ ผ่าน</td>
                            </tr>
                            <tr>
                                <td>เอกสารตอบรับ</td>
                                <td>
                                <?php if($select_record->has_reply_doc=="1"){ echo "มี";}else{echo "ไม่มี";}?>
                                </td>
                                <td>
                                    <input type="checkbox" name="admin_has_reply_doc" id="admin_has_reply_doc" class="yes_form_check" value="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>ยืนยันรูปสินค้า</td>
                                <td>
                                <?php if($select_record->has_confirm_product_img=="1"){ echo "มี";}else{echo "ไม่มี";}?>
                                </td>
                                <td>
                                    <input type="checkbox" name="admin_has_confirm_product_img" id="admin_has_confirm_product_img" class="yes_form_check" value="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>ยืนยันรูปLogo</td>
                                <td>
                                <?php if($select_record->has_confirm_logo_img=="1"){ echo "มี";}else{echo "ไม่มี";}?>
                                </td>
                                <td>
                                    <input type="checkbox" name="admin_has_confirm_logo_img" id="admin_has_confirm_logo_img" class="yes_form_check" value="1" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xs-3">
                        <table class="table table-bordered table-striped table-condensed">
                            <tr>
                                <td>รายการตรวจสอบ</td>
                                <td>ผลจากsale</td>
                                <td>ตรวจสอบ ผ่าน</td>
                            </tr>
                            <tr>
                                <td>รูปหน้าร้าน</td>
                                <td><?php if($select_record->has_shop_img=="1"){ echo "มี";}else{echo "ไม่มี";}?></td>
                                <td>
                                    <input type="checkbox" name="admin_has_shop_img" id="admin_has_shop_img" class="yes_form_check" value="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>รูปสินค้า</td>
                                <td><?php if($select_record->has_product_img=="1"){ echo "มี";}else{echo "ไม่มี";}?></td>
                                <td>
                                    <input type="checkbox" name="admin_has_product_img" id="admin_has_product_img" class="yes_form_check" value="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>Logo ร้าน</td>
                                <td><?php if($select_record->has_logo_img=="1"){ echo "มี";}else{echo "ไม่มี"; }?></td>
                                <td>
                                    <input type="checkbox" name="admin_has_logo_img" id="admin_has_logo_img" class="yes_form_check" value="1" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @elseif($select_record->result=="no_reply")
                    <span>No Reply</span><br />
                    <b>เหตุผล : </b> {{$select_record->cannot_contact_reason}} <br />
                    <b>นัดโทรครั้งถัดไป [ วัน - เดือน - ปี ] : </b> <?php echo $record->convert_date_format_dash($select_record->cannot_contact_appointment); ?> <br />
                    
                @elseif($select_record->result=="rejected")
                    <span>Rejected</span><br />
                    <b>No Reason : </b> {{$select_record->no_reason}} <br />

                @elseif($select_record->result=="waiting")
                    <span>Waiting</span><br />
                    <b>เหตุผลที่ขอพิจารณาดูก่อน : </b> {{$select_record->consider_reason}} <br />
                    <b>วันที่นัดรับ Feedback [ วัน - เดือน - ปี ] </b> <?php echo $record->convert_date_format_dash($select_record->consider_appointment_feedback);?><br />

                @elseif($select_record->result=="closed")
                    <span>ร้านปิดไปแล้ว</span><br />
                @endif
                
            </div>
        </div>
        <br />
        <hr />
        <div class="radio">
          <label><input type="radio" name="is_approve" id="is_approve" value="approve" <?php if($select_record->sending_status=="approve"){ echo "checked='checked'";}?>> Approve</label>
        </div>
        <div class="radio">
          <label><input type="radio" name="is_approve" id="is_not_approve" value="not_approve" <?php if($select_record->sending_status=="not_approve"){ echo "checked='checked'";}?>> Not Approve</label>
        </div>
        <label>เหตุผลที่ไม่ Approve</label>
        <textarea name="admin_message" id="admin_message" class="form-control"><?php if(isset($select_record->admin_message)){ echo $select_record->admin_message;}?></textarea>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-xs-12">
            <a href="#" class="btn btn-primary" id="confirm_btn">submit</a>
            <a href="{{url('/admin/approve_record_from_sale/select_sale/'.$select_record->sale_id)}}" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
    {{Form::close() }}
</div>

@endsection