@inject('company','App\Helpers\CompanyConstant')
<?php
 $notes = $company->getNote();
?>
@extends('layouts.header')
@section('title',trans("page.profile"))

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


                <h5 class="title-page"> السيرة الذاتية</h5>

                <div class="cont contpost">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close"  data-dismiss="alert"    aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif
                        @if(session('ok'))
                            <div  class="alert alert-success">
                                <a href="javascript:void(0);" class="close" data-dismiss="alert"
                                   aria-label="close">&times;</a>

                                <strong>تنبيه!</strong> {{  session('ok') }}
                            </div>
                        @endif


                         <hr>

                     <div class="list">
                        <img id="loading" src="{{asset('images/loading.gif')}}" style="display: none" />
<div class="div-imgseeker">
    <div id="image">
    @include('seekers.modal.show.image')
</div>

                        <a class="btn btn-default btn-sm" onclick="ShowEditModal('image');" > تعديل</a>

                          <input type="button" class="btn btn-danger btn-sm" onclick="return  deleteItem('image','#image','#image')" value="حذف" />

    <br>

</div>
                        <div id="personal-information">

                     @include('seekers.modal.show.infoseeker')

                    </div>
                    </div>


                    <div>




                        <div id="golas" class="post icon-award"> الهدف الوظيفي<span><a class="btn btn-default btn-sm" onclick="ShowEditModal('edit-goal');" >  تعديــل</a>
</span></div>
<div id="goal" class="contpost">
@include('seekers.modal.show.goal')
</div>

<div id="education">
@include('seekers.modal.show.ed')
</div>

<div id="experience">

@include('seekers.modal.show.exp')
</div>

<div id="language">
@include('seekers.modal.show.lang')
</div>
<div id="specialtys">
@include('seekers.modal.show.spec')
</div>
<div id="skills">
@include('seekers.modal.show.skills')
</div>
<div id="certificate">
    @include('seekers.modal.show.cert')
</div>
<div id="training">
    @include('seekers.modal.show.train')
</div>
<div id="hobby">
@include('seekers.modal.show.hobby')
</div>

<div id="info">
   @include('seekers.modal.show.info')
</div>
                        <div id="contact">
                            @include('seekers.modal.show.contact')
                        </div>
                </div>
                    </div>
            </div>
        </div>
        <nav id="bottom" class="bottom t">
            <span class="clicker   icon-up-open"></span>

        </nav>
    </div>
    </div>

    <script language="javascript">
        function deleteItem(a,b,c) {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                var token = '{{ Session::token() }}';
                var data = {
                    '_token' : token,
                    '_method' : 'delete',
                };
                deleteRest(a,b,c,data);
                return true;
            } else {
                return false;
            }
        }

    </script>

@stop




