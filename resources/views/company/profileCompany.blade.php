 @inject('dataLoad','App\Helpers\CompanyConstant')
<?php  $notes = $dataLoad->getNote();?>
@extends('layouts.header')
 @section('title',$company->comp_name)

 @section('content')
    <div class="container"  >
        <div class="row">
         {{--    <script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoKvim5RDODhqjDQNQsYDxZXBFLw14P5w"></script>

            <style>
                #map-canvas{
                    width:100%;
                    height:250px;
                }
            </style>--}}
            @include('layouts.seeker')

            <div class="col-lg-9 ">
                <br>
                <h5 class="title-page"> {{$company->comp_name}} <span class="texts">( <a href="/c/{{ $company->comp_user_name }}">{{ $company->comp_user_name }}</a> )</span></h5>

                <img id="loading" src="/images/loading.gif" style="display: none">

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif


                    <div class="list">
                        <div class="div-imgseeker" style="    padding-left: 4px;
       border-left: 2px solid #ffbf00;
    margin-left: 15px;    text-align: center;">
                            <div id="image">

                            @include('company.modal.show.image')
                        </div>
<hr style="margin: 10px 0;">

                            <a class="btn btn-primary  " onclick="ShowEditModalCompany('edit-image','{{ $user }}');">  تعديــل</a>
                           <input type="button" class="btn btn-danger  "
                                                                              onclick="return  deleteItemCompany('{{ $user }}','delete-image','#image',null)"
                                                                              value="حذف الصورة"/>

                            </div>
                        <div id="info">
                            @include('company.modal.show.info')
                    </div>
                    </div>







                        <div id="services">
                            @include('company.modal.show.services')
                        </div>
                   {{--     <div id="specialty">
                           @include('company.modal.show.spec')

                        </div>
                        <div id="info">
                            @include('company.modal.show.info')
                        </div>
                      {{--  <div id="description">
                            @include('company.modal.show.description')
                        </div>
                        <hr>

                        <hr>
                        <div id="maps">
                            @include('company.modal.show.map')

                        </div>--}}



                    </div>


                        <a class="facebox" style="display: none"></a>




            </div>
        </div>
    </div>
    </div>

    <?php
    $lat = ($company->lat != '' ? $company->lat : 32.882);
    $lng = ($company->lng != '' ? $company->lng : 13.1708);
    ?>

    <script language="javascript">

        function deleteItem() {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                return true;
            } else {
                return false;
            }
        }


        function deleteItemCompany(a, b, c, d) {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                var token = '{{ Session::token() }}';
                var data = {
                    '_token': token,
                    '_method': 'delete',
                };
                deleteRestCompany(a, b, c, d, data);
                return true;
            } else {
                return false;
            }
        }

    </script>
    <script language="javascript">



        function initialise() {
            google.maps.event.addDomListener(window, 'load', initialise);
            var lat = {{ $lat }};
            var lng = {{ $lng }};

            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {
                    lat: lat,
                    lng: lng
                },
                zoom: 15
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: lng
                },
                map: map,
                draggable: false
            });
        }

    </script>

@stop