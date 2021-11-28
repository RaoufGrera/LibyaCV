@extends('layouts.header-map')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> الشركة</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close"  data-dismiss="alert"    aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoKvim5RDODhqjDQNQsYDxZXBFLw14P5w&callback=initMap"></script>
                            <style>
                                #map-canvas{
                                    width:300px;
                                    height:250px;
                                }
                            </style>
                            <div>

                                {!! Form::open(["url"=>"/company-profile/edit-map/$myCompany->comp_user_name","method"=>"PATCH","class"=>"form-style-2"]) !!}
                                <div>
                                    <table >


                                        <tr>
                                            <td colspan="2">
                                                <div id="map-canvas"></div>
<br>
                                             <input id="lat" name="lat" value="{{ $company->lat }}" class="form-control" type="hidden"  />




                                             <input id="lng" name="lng" value="{{ $company->lng }}" class="form-control" type="hidden"  />


</tr>
<tr>
    <td> <input  type="submit" value="حفظ" class="btn btn-info"/>  <a class="btn btn-link" href="/company/{{$company->comp_user_name}}">رجوع</a></td>
    <td></td>
</tr>
                                    </table>
                                </div>



                                {!! Form::close() !!}


                            </div>
                </div>
                <?php
                $lat = ($company->lat != '' ? $company->lat : 32.882);
                $lng = ($company->lng != '' ? $company->lng : 13.1708);
                ?>

                <script language="javascript">

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
                                position:{
                                    lat: lat,
                                    lng: lng
                                },
                                map: map,
                                draggable:true
                            });

                            /*  var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

                          google.maps.event.addlistener(searchBox,'places_changed',function(){

                                var places = searchBox.getPlaces();
                                var bounds = new google.maps.LatLngBounds();
                                var i, place;

                                for(i=0; place=places[i];i++) {
                                    bound.extend(place.geometry.location);
                                    marker.setPosition(place.geometry.location);
                                }

                                map.fitBounds(bounds);
                                map.setZoome(15);

                            });*/

                            google.maps.event.addListener(marker,'position_changed',function(){
                                var lat = marker.getPosition().lat();
                                var lng = marker.getPosition().lng();

                                $('#lat').val(lat);
                                $('#lng').val(lng);

                            });
                        </script>
                </div>


            </div>

        </div>



@stop
