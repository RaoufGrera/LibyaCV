<div><h4>خريطة الشركة</h4></div>
<div class="contpost">

    <div id="map-canvas"></div>
    <a onclick="ShowEditModalRESTfulCompany('map','{{ $user }}');">تعديل</a>
    <br><br>
    <?php
    $lat = ($company->lat != '' ? $company->lat : 32.89464910098208);
    $lng = ($company->lng != '' ? $company->lng : 13.171787052917466);
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
            position: {
                lat: lat,
                lng: lng
            },
            map: map
        });
    </script>
</div>