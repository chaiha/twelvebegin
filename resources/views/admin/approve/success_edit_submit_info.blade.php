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

    $(function(){
       $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });

    $("#confirm_btn").click(function(){
        if(confirm("กรุณายืนยัน"))
            {
                $("#submit_form").submit();
            }
    });
}); 
</script>
@stop
<?php
use App\Record;
?>
<!-- Services Section -->
<div class="container-fluid add-margin-20">
    <div class="row">
        <div class="form-group">
        <h1>{{$select_record->record->code}} / {{$select_record->name_th}} <?php if($select_record->name_en!=""){ echo "/ ".$select_record->name_en;}    ?> / โทรครั้งที่ {{$select_record->call_amount}}</h1>
        <h3>ข้อมูลเบื้องต้นของ {{$select_record->name_th}} / {{$select_record->name_en}} / ติดต่อ {{$select_record->contact_person}} / โทร {{$select_record->contact_tel}} </h3>
        {{Form::open(array('action' => 'CallController@submit_edit_record_info','id'=>'submit_form'))}}
            {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <label>ข้อมูลสำหรับ Record</label>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Status</th>
                        <th>แหล่งที่มา</th>
                        <th>dtac type</th>
                        <th>Categories<span class="red">*</span></th>
                        <th>ประเภทร้าน<span class="red">*</span></th>
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
                        if($select_record->sources=="online_search")
                        {
                            echo "ค้นหาจากเว็บไซต์";
                        }
                        elseif($select_record->sources=="dtac_recommend")
                        {
                            echo "ร้านแนะนำจาก dtac";
                        }
                        elseif($select_record->sources=="walking")
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
                            elseif($select_record->dtac_type=="ต่างจังหวัด")
                            {
                                echo "ต่างจังหวัด";
                            }
                            elseif($select_record->dtac_type=="dtacแนะนำ")
                            {
                                echo "dtac แนะนำ";
                            }
                            elseif($select_record->dtac_type=="online")
                            {
                                echo "online";
                            }
                            elseif($select_record->dtac_type=="ต่ออายุ")
                            {
                                echo "ต่ออายุ";
                            }
                            elseif($select_record->dtac_type=="ดีลอย่างเดียว")
                            {
                                echo "ดีลอย่างเดียว";
                            }
                            elseif($select_record->dtac_type=="เฉพาะอาร์ทเวิร์ค")
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
                        elseif($select_record->categories=="shopping_and_lifestyle")
                        {
                            echo "Shopping and Lifestyle";
                        }
                        elseif($select_record->categories=="beauty_and_healthy")
                        {
                            echo "Beauty and Healthy";
                        }
                        elseif($select_record->categories=="hotel_and_travel")
                        {
                            echo "Hotel and Travel";
                        }
                        elseif($select_record->categories=="online")
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
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ชื่อไทย<span class="red">*</span></th>
                        <th>ชื่ออังกฤษ<span class="red">*</span></th>
                        <th>สาขา<span class="red">*</span></th>
                        <th>จำนวนสาขา<span class="red">*</span></th>
                    </tr>
                    <tr>
                        <td>{{$select_record->name_th}}</td>
                        <td>{{$select_record->name_en}}</td>
                        <td>{{$select_record->branch}}</td>
                        <td>
                        {{$select_record->branch_amount}}
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ที่อยู่<span class="red">*</span></th>
                        <th>จังหวัด<span class="red">*</span></th>
                        <th>ละติจูด<span class="red">*</span></th>
                        <th>ลองติจูด<span class="red">*</span></th>
                    </tr>
                    <tr>
                        <td>
                            {{$select_record->address}}
                        </td>
                        <td>{{$select_record->province}}
                        </td>
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
                        <th>ชื่อผู้ติดต่อ<span class="red">*</span></th>
                        <th>เบอร์โทรติดต่อ<span class="red">*</span></th>
                        <th>อีเมลที่ติดต่อ</th>
                        <th>ที่อยู่ให้จัดส่ง<span class="red">*</span></th>
                    </tr>
                    <tr>
                        <td>
                            {{$select_record->contact_person}}
                        </td>
                        <td>{{$select_record->contact_tel}}</td>
                        <td>{{$select_record->contact_email}}</td>
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
                            {{ Html::link($select_record->links,null,array('target'=>'_blank')) }}
                        </td>
                        <td>
                            {{$select_record->remarks}}
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
    <div class="row" id="yes_form">
            <div class="col-xs-12">
                <div class="row add-margin-20">
                    <div class="col-xs-12">
                        <label>Feedback: </label><br />
                            {{$select_record->yes_feedback}}
                    </div>
                </div>
                <div class="row add-margin-20">
                    <div class="col-xs-12">
                        <label>เงื่อนไขเพิ่มเติม: </label><br />
                            {{$select_record->yes_condition}}
                    </div>
                </div>
                <div class="row add-margin-20">
                    <div class="col-xs-12">
                        <label>Start Privilege Date [ วัน / เดือน / ปี ]</label>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="input-group">
                                {{$select_record->yes_privilege_start}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row add-margin-20">
                    <div class="col-xs-12">
                        <label>End Privilege Date [ วัน / เดือน / ปี ]</label>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="input-group">
                                        {{$select_record->yes_privilege_end}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <div class="row">
        <div class="col-xs-12">
            <a href="{{url('/admin/approve_record_from_sale/select_sale/'.$select_record->sale_id)}}" class="btn btn-primary">กลับไปหน้า Approve Leads</a>
        </div>
    </div>
{{Form::close()}}
</div>
</div>

@endsection