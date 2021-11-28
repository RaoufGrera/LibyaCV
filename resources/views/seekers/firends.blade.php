 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
 @section('title',trans("page.friends"))

 @section('content')
    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            visible = (objReq.style.display != "none")
            if (visible) {
                objReq.style.display = "none";
            } else {
                objReq.style.display = "block";
            }
        }
    </script>
    <div class="container">
        <div class="row">
            @include('layouts.seeker')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> الأصدقاء</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif
                    <br>
                        <h4>تتابعهم</h4>
                        <hr>
                    @if(count($firends) > 0 )

                        <div class="row">

                            @foreach($firends as $firend)
                                <div class="col-md-2 center">

                                                <a href="/user/{{ $firend->user_name  }}"><img class="imgseeker"
                                                                                               src= @if($firend->image != ""){{asset('images/seeker/40px_'.$firend->code_image .'_'.$firend->image )}} @else @if($firend->gender  =='m') {{asset('images/simple/40px_male.png')}} @else {{asset('images/simple/40px_female.png')}}  @endif @endif /></a>
                                    <br>


                                    <a href="/user/{{ $firend->user_name  }}"> <span>{{ $firend->fname }} {{ $firend->lname }}</span></a>



                                    <br> <br>

                                </div>

                            @endforeach


                        </div>
                    @else
                            <div class="alert alert-info" style="position: relative">
                        <span>ليس لديك احد تتابعه. </span>
                                </div>
                    @endif

                        <br>
                        <h4>يتابعونك</h4>
                        <hr>
                        @if(count($reqf) > 0 )

                            <div class="row">

                                @foreach($reqf as $reqfs)
                                    <div class="col-md-2 center">

                                        <a href="/user/{{ $reqfs->user_name  }}"><img class="imgseeker"
                                                                                      src= @if($reqfs->image != ""){{asset('images/seeker/40px_'.$reqfs->code_image .'_'.$reqfs->image )}} @else @if($reqfs->gender  =='m') {{asset('images/simple/40px_male.png')}} @else {{asset('images/simple/40px_female.png')}}  @endif @endif /></a>
                                        <br>


                                        <a href="/user/{{ $reqfs->user_name  }}"> <span>{{ $reqfs->fname }} {{ $reqfs->lname }}</span></a>
<br>

                                    </div>

                                @endforeach


                            </div>
                        @else
                            <div class="alert alert-info" style="position: relative">
                                <span>لا احد يتابعك. </span>
                            </div>
                        @endif


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