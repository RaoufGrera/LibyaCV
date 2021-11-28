@extends('layouts.header-modal')
@section('content')
    <div>
        <style>
            #map-canvasModal{
                width:100%;
                height:250px;
            }
        </style>
        <div class="alert-face" >تعديل خدمات الشركة</div>
        <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

        <div class="modal-face">
            {!! Form::open(["class"=>"form-style-2","id"=>"myForm","method"=>"PATCH"]) !!}

            <div class="mymodal">
                <table class="iteminli" >
                    <tr>
                        <td colspan="2">
                            <label  for="ed_name"> الخريطة<span  class="req">*</span></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="map-canvasModal"></div>
                            <input id="lat" name="lat" value="{{ $company->lat }}" class="form-control" type="hidden"  />
                            <input id="lng" name="lng" value="{{ $company->lng }}" class="form-control" type="hidden"  />
                        </td>
                    </tr>
                </table>
            </div>
            <div class ="modal-footer">
                <input type="button" class="btn btn-info" id="create" value="حفظ" />

                <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default ">إلغاء</a>

            </div>


            {!! Form::close() !!}
            <?php
            $lat = ($company->lat != '' ? $company->lat : 32.882);
            $lng = ($company->lng != '' ? $company->lng : 13.1708);
            ?>

            <script language="javascript">

                var lat = {{ $lat }};
                var lng = {{ $lng }};
                var mapModal = new google.maps.Map(document.getElementById('map-canvasModal'), {
                    center: {
                        lat: lat,
                        lng: lng
                    },
                    zoom: 15
                });

                var marker = new google.maps.Marker({
                    position:{
                        lat: lat,
                        lng: lng
                    },
                    map: mapModal,
                    draggable:true
                });

                google.maps.event.addListener(marker,'position_changed',function(){
                    var lat = marker.getPosition().lat();
                    var lng = marker.getPosition().lng();

                    $('#lat').val(lat);
                    $('#lng').val(lng);

                });
            </script>
        </div>

    </div>
    <script type="text/javascript">
        $('#create').click(function(){
            var name = '<?php echo $user; ?>';
            var dataObject =  $("#myForm").serialize();
            editSaveRestCompany(name,'map','#maps',dataObject);
        });
    </script>


@stop