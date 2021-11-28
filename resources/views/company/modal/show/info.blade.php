

<table  style="float: right;width: inherit;">

    <tr>
        <td>
            <span class="icon-address-card-o"></span>
        </td>
        <td>
            <span> {{$company->comp_name}}</span>
        </td>
    </tr>
    <tr>
        <td>

            <span class="icon-location"></span></td>
        <td>
 <span> {{$company->city_name}}
     @if($company->address != "")
         - {{$company->address}}
     @endif
                        </span>
        </td>
    </tr>
    <tr>
        <td>
            <span class="icon-th"></span>
        </td>
        <td>
            <span> {{$company->domain_name}}</span>
        </td>
    </tr>
    <tr>
        <td>
            <span class="icon-mail"></span>
        </td>
        <td>
            <span> {{$company->email}}</span>
        </td>
    </tr>
    <tr>
        <td>
            <span class=" icon-mobile"></span>
        </td>
        <td>
            <span>{{$company->phone}}</span>
        </td>
    </tr>
    <tr>
        <td>
            <span class="icon-globe"></span>
        </td>
        <td>
            <a style="color: #333" href="{{$company->url}}"> {{$company->url}}</a>
        </td>
    </tr>
    <tr>
        <td>
            <span class="icon-facebook-official"></span>
        </td>
        <td>
            <a style="color: #333" href="{{$company->facebook}}"> {{$company->facebook}}</a>
        </td>
    </tr>

    <tr>
        <td colspan="2">

            <a class="btn btn-primary " onclick="ShowEditModalCompany('edit-info','{{ $user }}')"> تعديل</a>

            <br>
        </td>
    </tr>
</table>
