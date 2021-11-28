
<?php
/**
 * Created by PhpStorm.
 * User: Lenovo1
 * Date: 6/25/2016
 * Time: 6:01 AM
 */?>
<div class="contpost">
    @if (count($services)== 0)
        <span class="texts">اذا لديك خدمات تستطيع تقديمها يمكنك اضافتها هنا، كإعداد مشاريع التخرج، تصميم مواقع، حلاقة،...الخ </span>
        <br><br>
    @endif

    @foreach($services as $row)
            <div class="cv-div">

                <div class="cv-body">
                    <div class="devimgseeker">
                        <a href="/services/{{ $row->services_id }}"><img class="imgseeker-view"
                                                                             src= @if($row->image != ""){{asset('images/seeker/140px_'.$row->code_image .'_'.$row->image )}} @else @if($row->gender =='m') {{asset('images/simple/140px_male.png')}} @else {{asset('images/simple/140px_female.png')}}  @endif @endif /></a>
                    </div>
                    <table><tr> <td height="30"><span ><a id="cvname"
                                                          href="/services/{{ $row->services_id }}"> {{ $row->title}} </a></span><br>
                                <span class="texts">{{ $row->body  }} &nbsp;</span><hr></td></tr><tr>
                            <td>
                                 <span ><a class="icon-user" href="/user/{{ $row->user_name  }}">{{ $row->fname  }}  </a>
                                                </span>
                                <span class="r"><span><a href="?domain={{$row->domain_name}}" class="icon-th ">{{$row->domain_name   }}</a></span>


                                                <span ><a class="icon-location" href="?city={{ $row->city_name  }}">{{ $row->city_name  }}  </a>
                                                </span>

                                                </span>
                            </td>

                        </tr>

                    </table>

                </div></div>
            <br>
            <a class="btn btn-default" onclick="ShowEditModalRESTful('services',{{ $row->services_id}});"> تعديل</a>
            <input type="button" class=" btn btn-danger" onclick="return  deleteItem('services/{{ $row->services_id }}','#services','#services')" value="حذف" />
            <br><br>
    @endforeach
    <a class="btn btn-info" onclick="ShowEditModalRESTful('services');">+أضافة</a>
    <br><br>
</div>
