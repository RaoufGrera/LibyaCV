@inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
@section('title', trans("page.job-application"))

@section('content')


    <script>
        var token = '{!! Session::token() !!}';



        var token = '<?php echo Session::token(); ?>';

        function requestAccept(a,b) {
             var myButton = $('#req-'+a).prop('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'PATCH',
                url: '/company-profile/{{$user}}/job-application/{{$jobid}}/'+a+'/'+b,
                data: {_token: token, _method: 'PATCH'},
                success: function (data) {
                        if (data.check) {
                            myButton.prop('value', 'تم القبول').removeClass('btn-success').addClass("btn-default").addClass("disabled");
                         }
                },

                error: function(){
                        $('<div class="alert alert-danger"><strong>تنبيه! </strong>حدث خطاء الرجاء المحاولة مرة أخري.</div>').insertAfter('#request').delay(3000).fadeOut();
                }

            });

        }
        function requestDelete(a,b) {
            var myButton = $('#rq-'+a).prop('disabled', true);
            if (confirm("هل أنت متأكد من حذف هذا الطلب؟")) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'DELETE',
                    url: '/company-profile/{{$user}}/job-application/{{$jobid}}/' + a + '/'+b+'/delete',
                    data: {_token: token, _method: 'PATCH'},
                    success: function (data) {

                        if (data.check) {
                            $('<div class="alert alert-success fixed"><span>تنبيه! </span>قد تم حذف طلب التوظيف بنجاح.</div>').insertAfter('#rq-'+a).delay(2000).fadeOut();

                            myButton.remove();
                        }
                    }
                });
                return true;
            }else{
            return false;
            }


        }
    </script>

    <div class="container">
        <div class="row">
            @include('layouts.company')


            <div class="col-lg-9 ">

                <br>
                <h5 class="title-page"> طلبات التوظيف</h5>
                <br>
                @if(session('error'))
                    <div class="alert alert-warning">


                        <strong>تنبيه!</strong> {{  session('error') }}
                    </div>
                @endif
                <div>


                    <div id="SeekerResults">
                        @foreach($seekersArray as $seekerArray)
                            <div class="cv-div" id="rq-{{ $seekerArray['req_id'] }}">
                                 <div class="cv-body">
                                     @if($role)
                                          <?php
                                         if ($seekerArray['req_event'] !=1) {
                                             $status_name = 'قبول';
                                             $btn_style = "btn btn-success ";
                                             $onClick="onclick=requestAccept(".$seekerArray['req_id'].",".$seekerArray['seeker_id'].")";

                                         } else {
                                             $status_name = 'تم القبول';
                                             $btn_style = "btn btn-default disabled ";

                                             $onClick="";

                                         }
                                         ?>

                                         <input type="button" {{ $onClick }}  id="req-{{ $seekerArray['req_id'] }}" value="{{ $status_name }}"
                                                class=" {{ $btn_style }}"/>
                                             <input type="button" class="btn btn-danger" onClick="requestDelete({{ $seekerArray['req_id'] }},{{ $seekerArray['seeker_id']}})" value="رفض وحذف" id="request" >
                                          @endif
                                    <a  href="javascript:void(0)" class="icon-block t b" onclick="ShowModal('cv','{{$seekerArray['user_name']}}');"></a>
                                    <div class="devimgseeker">
                                        <a href="/user/{{ $seekerArray['user_name'] }}?request={{ $seekerArray['req_id'] }}"><img class="imgseeker-view"
                                                                                             src= @if($seekerArray["image"] != ""){{asset('images/seeker/140px_'.$seekerArray["code_image"] .'_'.$seekerArray["image"] )}} @else @if($seekerArray['gender'] =='m') {{asset('images/simple/140px_male.png')}} @else {{asset('images/simple/140px_female.png')}}  @endif @endif /></a>
                                        <span  @if($seekerArray['hide_cv'] == 0) class="icon-eye a" @else class="icon-eye-off a" @endif> {{ $seekerArray['seeker_count'] }}</span></div>
                                    <table><tr> <td colspan="2" height="30"><span ><a id="cvname"
                                                                                      href="/user/{{ $seekerArray['user_name'] }}?request={{ $seekerArray['req_id'] }}">{{ $seekerArray['fname'] }} {{ $seekerArray['lname'] }}  </a></span><br>
                                                <span class="texts">{{ $seekerArray['about']  }} &nbsp;</span><hr></td></tr><tr>
                                            <td><label class="icon-th f14"></label></td><td><span> {{ $seekerArray['domain_name'] }}</span></td>  </tr><tr><td><label class="icon-graduation-cap"></label></td><td><span> {{ $seekerArray['edt_name'] }}</span></td></tr><tr>
                                            <td><label class="icon-location"></label></td>
                                            <td>
                                                <span> {{ $seekerArray['city_name'] }}  </span>
                                                @if($seekerArray['address'] != "")
                                                    <span>  - {{ $seekerArray['address'] }}  </span>
                                                @endif

                                            </td>
                                        </tr>
                                        <tr><td><label class="icon-retweet"></label></td><td><span> {{ $seekerArray['updated_at'] }}</span></td></tr>

                                    </table>

                                    <div class="skills">
                                        <span>التخصصات: </span>

                                        @foreach($seekerArray['spec'] as $index => $code )
                                            <?php
                                            $code_id = substr($code, stripos($code, "-")+1, strlen($code));
                                            $code_count = substr($code,0,stripos($code, "-"));

                                            ?>
                                            <div><a  onclick="ShowSpecs('{{ $seekerArray['user_name'] }}','{{ $code_id }}');" class="bs bc">{{ $code_count }}</a><span class="bsv bf"> {{ $index  }} </span></div>
                                        @endforeach
                                    </div></div></div>
                        @endforeach
                    </div>

                    <hr>
                    <div class="center">
                        @if(count($seekersArray) >=19)
                        <button id="more" class="btn btn-lg btn-default center"  onclick="showMore()"><span>مشاهدة المزيد  </span><img id="moreImg" style="display: none" src="{{asset('images/loading.gif')}}"/></button>
                        @else
                            <button id="more" class="btn btn-lg btn-default disabled" "><span>إنتهت نتائج البحث  </span></button>

                        @endif
                    </div>
                    <br>
                    <?php
                    $href= "";

                    if ($href == ""){
                        $href = '?';
                    }

                    ?>
                    <script type="text/javascript">
                        var pageNumber = 1;
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        function showMore () {
                            pageNumber++;
                            $("#more").prop("disabled", true);
                            $("#moreImg").show();
                            $.ajax({
                                type:'GET',
                                url: '/company-profile/{{ $user }}/job-appilication/{{ $jobid }}<?php echo $href.'page='; ?>'+pageNumber+'',
                                data: {_token: CSRF_TOKEN},

                                success:function(data){
                                    var a=0;
                                    if(Object.keys(data).length > 0 ){
                                        ($.each(data.users, function () {

                                        var ss ="";
                                        var u = this.user_name;
                                        var s ='<div class="cv-div"><div class="cv-body"><a href="javascript:void(0)" class="icon-block t b" onclick="ShowModal(\'cv\',\''+this.user_name+'\');"></a>'+
                                            '<div class="devimgseeker"><a href="/user/'+ this.user_name +'"><img class="imgseeker-view" src="'+ this.image+'" /></a><span class="'+this.hide_cv +'">'+this.seeker_count+'</span></div> <table><tr> <td colspan="2" height="30"><span ><a id="cvname" href="/user/'+this.user_name+'">'+this.fname+' '+ this.lname+'</a></span><br><span class="texts">'+this.about+' &nbsp;</span><hr></td></tr><tr>'+
                                            '<td><label class="icon-th f14"></label></td><td><span>'+this.domain_name+'</span></a></td></tr><tr><td><label class="icon-graduation-cap"></label></td><td><span>'+this.edt_name+'</span></td></tr> <tr> <td> <label class="icon-location"></label></td> <td><span>'+this.city_name+'</span><span>'+this.address+'</span></td> </tr><tr><td><label class="icon-retweet"></label></td><td><span>'+this.updated_at+'</span></td></tr> </table><div class="skills"> <span>التخصصات: </span>';
                                        $.each(this.spec, function(k, v) {
                                            //display the key and value pair
                                            var i =v.substr(v.indexOf("-")+1, v.strlen);
                                            var c = v.substr(0,v.indexOf("-"));
                                            ss = ss+' <div><a onclick="ShowSpecs(\''+u+'\',\''+ i +'\');" class="bs bc">'+c+'</a><span class="bsv bf">'+k+'</span></div>'
                                        });
                                        ss = s+ss;
                                        $("#SeekerResults").append(ss+"</div></div></div>");


                                            a++;
                                        }));
                                        if(a > 5){
                                            $("#more").prop("disabled", false);
                                            $('#more span').text('مشاهدة المزيد');
                                        }else{
                                            $('#more span').text('إنتهت نتائج البحث');
                                        }
                                    } else
                                    {
                                        //   $("#IdResults").append("<br><span>خطاء لايمكن تحميل المزيد من النتائج </span>");
                                        $('#more span').text('إنتهت نتائج البحث');
                                    }
                                    $("#moreImg").hide();

                                }
                            });

                        }
                    </script>

                    <a class="facebox" style="display: none"></a>
                </div>

            </div>
        </div>
    </div>
    <script language="javascript">
        function deleteItem() {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@stop
