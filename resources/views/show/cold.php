@if(session('error'))
<div class="alert alert-warning">
    <a href="javascript:void(0);" class="close" data-dismiss="alert"
       aria-label="close">&times;</a>

    <strong>تنبيه!</strong> {{  session('error') }}
</div>
@endif

<div class="list">
    <div class="div-imgseeker">
        <img class="imgseeker"
             src= @if($company->image !=""){{asset('images/company/300px_'.$company->code_image .'_'.$company->image)}} @else {{asset('images/test.jpg')}} @endif />
        <br>

    </div>

    <table style="float: right">
        <tr>

            <td colspan="2">
                <span  ><a id="cvname" href="/company/{{ $company->comp_user_name }}">{{$company->comp_name}}</a></span><br>
                <span class="texts">{{ $company->about }}</span>
            </td>
        </tr>

        <tr>
            <td>

                <label>العنوان:</label></td>
            <td>
 <span> {{$company->city_name}}
     @if($company->address != "")
         - {{$company->address}}
     @endif
                        </span>
            </td>
        </tr>


        @if($company->email != "")


        <tr>
            <td>
                <label>البريد:</label>
            </td>
            <td>
                <span> {{$company->email}}</span>
            </td>
        </tr>
        <tr>
            <td>
                <label>قطاع الشركة:</label>
            </td>
            <td>
                <span>{{$company->compt_name}}</span>
            </td>
        </tr>
        <tr>
            <td>
                <label>مجال الشركة:</label>
            </td>
            <td>
                <span>{{$company->domain_name}}</span>
            </td>
        </tr>
        @endif
    </table>

</div>
<br>

<div>

    <h4>عن الشركة</h4>
    <p>
        {{ $company->comp_desc }}
    </p>
    <br>
    <h4> عنوان الشركة</h4>
    <div id="map-canvas"></div>

</div>
