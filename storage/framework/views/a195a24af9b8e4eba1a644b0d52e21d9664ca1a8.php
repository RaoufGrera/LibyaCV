 <?php $dataLoad = app('App\Helpers\CompanyConstant'); ?>
<?php  $notes = $dataLoad->getNote();
//$titleCity=trans("page.cv-search") . " في ليبيا";
$titleCity=" في ليبيا"; //trans("page.job-search") .
$thejob="باحثين عن عمل ";
if((isset($_GET['city'])) )
    if(($_GET['city']!=""))
        $titleCity= "في ".  $_GET['city'];
$titleDomain = "";
if((isset($_GET['domain'])) ){
    if(($_GET['domain']!="")){
        $titleCity= $thejob. "".  $_GET['domain']."" ." ".$titleCity;}
    }else{$titleCity = $thejob." ".$titleCity;}
?>


 <?php $__env->startSection('title',$titleCity.$titleDomain); ?>
  <?php $__env->startSection('keywords',"قانوني , موظفين, موظف, موظفين ليبيا, مهندسين, اطباء،, ليبين، سيرة ذاتية، مترجم". $titleCity.",".$titleDomain); ?>
 <?php $__env->startSection('image',asset('images/logo/logofb.jpg')); ?>
 <?php $__env->startSection('url',Request::url()); ?>
 <?php $__env->startSection('description',"قاعدة بيانات باحثين عن عمل في ليبيا، اطلع علي كل السير الذاتية في ليبيا"); ?>
 <?php $__env->startSection('curl',Request::url()); ?>

 <?php $__env->startSection('content'); ?>
     <script data-ad-client="ca-pub-9929016091047307" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

     <img id="loading" src="<?php echo e(asset('images/loading.gif')); ?>" style="display: none" />
<style>
    .icv{ width: 20px; margin-top: -2px;}

</style>
    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            visible = (objReq.style.maxHeight != "100%");
            if (visible) {
                objReq.style.maxHeight = "100%";
            } else {
                objReq.style.maxHeight = "150px";
            }
        }
         function ToggleShow(item,lnk){

             objItem = document.getElementById(item);
             myStyle = (objItem.style.display != "block");
             if(myStyle){
                 objItem.style.display = "block";
                 lnk.getElementsByTagName("span")[1].innerHTML  = "-";
             }else{
                 lnk.getElementsByTagName("span")[1].innerHTML = "+";
                 objItem.style.display = "none";
             }
         }
    </script>
    <?php

    $stringClearHref = '';
    $cityClearHref = '';
    $univClearHref = '';
    $facultyClearHref = '';
    $specEdClearHref = '';
    $domainClearHref = '';
    $specClearHref = '';
    $educationClearHref = '';
    $companyClearHref = '';
    $genderClearHref = '';
    $natClearHref = '';
    $expClearHref = '';
    $ageClearHref = '';
    $domainHref = '';
    $domainHref = '';
    $allHref = '';

    foreach($urls as $key => $value){
        if(empty($value) || $key =='page')
            continue;


        if($allHref == ''){
            //  $value = str_replace(" ", "-", $value);
            $allHref = '?'.$key.'='.$value;

            continue ;
        }
        //$value = str_replace(" ", "-", $value);
        $allHref = $allHref.'&'.$key.'='.$value;


    }

    ?>

    <div class="container">
        <div class="row">

            <div class="col-lg-3">
                <div class="nav-list">
                    <div id="search-value">
                        <div class="search-head">
                            <span class="menus ">حصر النتائج</span>

                        </div>

                        <div class="search-body">
                            <?php if(!empty($urls['string'])): ?>
                                <?php

                                foreach($urls as $key => $value){
                                    if(empty($value)  || $key =='string'|| $key== 'page')
                                        continue;

                                    if($stringClearHref == ''){
                                        $stringClearHref = '?'.$key.'='.$value;
                                        continue ;
                                    }
                                    $stringClearHref = $stringClearHref.'&'.$key.'='.$value;

                                }
                                ?>
                                <span>البحث</span><br>
                                <span class="find-value"> <?php echo e($urls['string']); ?></span>  <a
                                        href="/cv/search/<?php echo e($stringClearHref); ?>">إزالة</a><br>
                            <?php endif; ?>

                                <?php if(!empty($urls['city'])): ?>
                                    <?php

                                    foreach($urls as $key => $value){
                                        if(empty($value)  || $key =='city'|| $key== 'page')
                                            continue;

                                        if($cityClearHref == ''){
                                            $cityClearHref = '?'.$key.'='.$value;
                                            continue ;
                                        }
                                        $cityClearHref = $cityClearHref.'&'.$key.'='.$value;

                                    }
                                    ?>
                                    <span>المدينة</span><br>
                                    <span class="find-value"> <?php echo e($urls['city']); ?></span>  <a
                                            href="/cv/search<?php echo e($cityClearHref); ?>">إزالة</a><br>
                                <?php endif; ?>

                                <?php if(!empty($urls['domain'])): ?>
                                    <?php

                                    foreach($urls as $key => $value){
                                        if(empty($value)  || $key =='domain'|| $key== 'page')
                                            continue;

                                        if($domainClearHref == ''){
                                            $domainClearHref = '?'.$key.'='.$value;
                                            continue ;
                                        }
                                        $domainClearHref = $domainClearHref.'&'.$key.'='.$value;

                                    }
                                    ?>
                                    <span>المجال</span><br>
                                    <span class="find-value"> <?php echo e($urls['domain']); ?></span>  <a
                                            href="/cv/search<?php echo e($domainClearHref); ?>">إزالة</a><br>
                                <?php endif; ?>

                            <?php if(!empty($urls['education'])): ?>
                                <?php
                                    foreach($urls as $key => $value){
                                        if(empty($value)  || $key =='education'|| $key== 'page')
                                            continue;

                                        if($educationClearHref == ''){
                                            $educationClearHref = '?'.$key.'='.$value;
                                            continue ;
                                        }
                                        $educationClearHref = $educationClearHref.'&'.$key.'='.$value;

                                    }
                                    ?>

                                <span>المؤهل العلمي</span><br>
                                <span class="find-value"> <?php echo e($urls['education']); ?></span>  <a
                                        href="/cv/search<?php echo e($educationClearHref); ?>">إزالة</a><br>
                            <?php endif; ?>



                        </div>
                    </div>



                    <div>
                        <a href="/cv/search" class="btn btn-danger btn-block">إزالة معايير البحث</a>
                    </div><br>
                    <div class="titel-search icon-location" onclick="javascript:ToggleShow('city',this);"><span>المدينة</span><span class="showing">+</span></div>


                    <div id="city" class="select_search" style="display: none;">
                        <?php if((!isset($_GET['city'])) || ($_GET['city']=="")): ?>

                            <?php  ?>
                            <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $cityHref='';
                                $cityName = $item->city_name ;
                                foreach($urls as $key => $value){
                                if((empty($value) && $key !='city') ||  $key== 'page')
                                continue;


                                if($key == 'city'){
                                if($cityHref == ''){
                                $cityHref = '?'.$key.'='.$cityName;
                                continue ;
                                }
                                $cityHref = $cityHref.'&'.$key.'='.$cityName;
                                continue ;

                                }
                                if($cityHref == ''){
                                $cityHref = '?'.$key.'='.$value;

                                continue ;
                                }
                                $cityHref = $cityHref.'&'.$key.'='.$value;


                                }

                                ?>
                                <a class="searcha"
                                   href="search<?php echo e($cityHref); ?>"><?php echo e($item->city_name); ?> <span style="float: left">[ <?php echo e($item->city_count); ?> ]</span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php else: ?>
                            <?php
                            $cityClearHref='';

                            foreach($urls as $key => $value){
                            if(empty($value)  || $key =='city'|| $key== 'page')
                            continue;

                            if($cityClearHref == ''){
                            $cityClearHref = '?'.$key.'='.$value;
                            continue ;
                            }
                            $cityClearHref = $cityClearHref.'&'.$key.'='.$value;

                            }
                            ?>
                            <?php echo e($_GET['city']); ?>   ( <a
                                    href="/cv/search<?php echo e($cityClearHref); ?>">إزالة</a>
                            )
                        <?php endif; ?>
                    </div>
                    <div class="titel-search icon-th"  onclick="javascript:ToggleShow('domain',this);"><span>المجال</span><span class="showing">+</span></div>
                    <div id="domain" class="select_search" style="display: none;">

                        <?php if((!isset($_GET['domain'])) || ($_GET['domain']=="")): ?>

                            <?php $__currentLoopData = $domain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $domainName = str_replace(" ", "-", $item->domain_name);

                                $domainHref='';


                                foreach($urls as $key => $value){
                                if((empty($value) && $key !='domain') ||  $key== 'page')
                                continue;


                                if($key == 'domain'){
                                if($domainHref == ''){
                                $domainHref = '?'.$key.'='.$domainName;
                                continue ;
                                }
                                $domainHref = $domainHref.'&'.$key.'='.$domainName;
                                continue ;

                                }
                                if($domainHref == ''){
                                $domainHref = '?'.$key.'='.$value;

                                continue ;
                                }
                                $domainHref = $domainHref.'&'.$key.'='.$value;


                                }

                                ?>

                                <a class="searcha"
                                   href="search<?php echo e($domainHref); ?>"><?php echo e($item->domain_name); ?> <span style="float: left">[ <?php echo e($item->domain_count); ?> ]</span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <?php echo e($urls['domain']); ?>   ( <a
                                    href="search<?php echo e($domainClearHref); ?>">إزالة</a>
                            )
                        <?php endif; ?>
                    </div>



                    <div onclick="javascript:ToggleShow('education',this);" class="titel-search icon-graduation-cap">&nbsp;<span>المؤهل العلمي</span><span class="showing">+</span></div>
                    <div id="education" class="select_search" style="display: none;">

                        <?php if((!isset($_GET['education'])) || ($_GET['education']=="")): ?>


                            <?php $__currentLoopData = $education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php



                                $educationHref = '';


                                foreach($urls as $key => $value){
                                if((empty($value) && $key !='education') ||  $key== 'page')
                                continue;


                                if($key == 'education'){
                                if($educationHref == ''){
                                $educationHref = '?'.$key.'='.$item->edt_name;
                                continue ;
                                }
                                $educationHref = $educationHref.'&'.$key.'='.$item->edt_name;
                                continue ;

                                }
                                if($educationHref == ''){
                                $educationHref = '?'.$key.'='.$value;

                                continue ;
                                }
                                $educationHref = $educationHref.'&'.$key.'='.$value;


                                }

                                ?>
                                <a class="searcha"
                                   href="/cv/search<?php echo e($educationHref); ?>"><?php echo e($item->edt_name); ?> <span style="float: left">[ <?php echo e($item->edt_count); ?> ]</span></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php else: ?>
                            <span class="searchRemove"><?php echo e($urls['education']); ?> ( <a
                                        href="/cv/search<?php echo e($educationClearHref); ?>">إزالة</a>
                            )</span>
                        <?php endif; ?>


                    </div>
<br>

                </div>
                <br>


                <a href="/free-cv-template">
                    <div class="divblog">
                        <img width="100%" src="<?php echo e(asset('images/blog/blog201922.png')); ?>">
                        <span class="spanblog"><h2 class="titleblog">نماذج سيرة ذاتية احترافية</h2> </span>
                    </div>
                </a>
                <br>
                <a href="/free-cv-template">
                    <div class="divblog">
                        <img width="100%" src="<?php echo e(asset('images/blog/blogg22.png')); ?>">
                        <span class="spanblog"><h2 class="titleblog">نماذج سيرة ذاتية باللغة العربية</h2> </span>
                    </div>
                </a>



                <br>
            </div>
<style>

    h1{ margin: 0;}
</style>
            <div class="col-lg-6">
<br>
                <h1 style="margin-top: 15px;margin-bottom: 15px" class="title-page"><?php echo e($titleCity); ?> <?php echo e($titleDomain); ?></h1>


                <div>

                    <div id="SeekerResults">
                        <?php $counter = 0; ?>
                        <?php $__currentLoopData = $seekersArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seekerArray): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $counter ++;
                            if($counter == 6 || $counter == 12){
                                ?>

                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- Main -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-9929016091047307"
                                     data-ad-slot="4050134570"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            <?php
                                } ?>
                                <div class="cv-div">


                                <div class="cv-body">
                                    
                                    <div class="devimgseeker">
                                        <a title="<?php echo e($seekerArray['fname']); ?> <?php echo e($seekerArray['lname']); ?>" href="/user/<?php echo e($seekerArray['user_name']); ?>"><img class="imgseeker-view"
                                                                                             src= <?php if($seekerArray["image"] != ""): ?><?php echo e(asset('images/seeker/140px_'.$seekerArray["code_image"] .'_'.$seekerArray["image"] )); ?> <?php else: ?> <?php if($seekerArray['gender'] =='m'): ?> <?php echo e(asset('images/simple/140px_male.png')); ?> <?php else: ?> <?php echo e(asset('images/simple/140px_female.png')); ?>  <?php endif; ?> <?php endif; ?> /></a>
                                         </div>
                                    <table><tr> <td height="30"><h2 ><a title="<?php echo e($seekerArray['fname']); ?> <?php echo e($seekerArray['lname']); ?>" id="cvname"
                                                                                      href="/user/<?php echo e($seekerArray['user_name']); ?>"><?php if($seekerArray['hide_cv'] == 0): ?> <?php echo e($seekerArray['fname']); ?> <?php echo e($seekerArray['lname']); ?> <?php else: ?> السيرة الذاتية مخفية <?php endif; ?> </a></h2>
                                                <span class="texts"><?php echo e($seekerArray['about']); ?> &nbsp;</span><hr></td></tr><tr>
                                            <td><span class="icon-heart" ><?php echo e($seekerArray['see_it']); ?> </span> <span class="r"><span><a href="?domain=<?php echo e($seekerArray['domain_name']); ?>" class="icon-th "><?php echo e($seekerArray['domain_name']); ?></a></span> <span ><a href="?education=<?php echo e($seekerArray['edt_name']); ?>" class="icon-graduation-cap"> <?php echo e($seekerArray['edt_name']); ?></a></span>


                                                <span ><a class="icon-location" href="?city=<?php echo e($seekerArray['city_name']); ?>"><?php echo e($seekerArray['city_name']); ?>  </a>   <?php if($seekerArray['address'] != "" && $seekerArray['address'] != " " ): ?>
                                                    <span>  - <?php echo e($seekerArray['address']); ?>  </span>
                                                <?php endif; ?>
                                                </span>
                                                    <?php if($seekerArray['services_count'] !=0): ?> <span><img src="<?php echo e(Asset('images/home/ser.png')); ?>" class="icv"> <?php echo e($seekerArray['services_count']); ?> </span> <?php endif; ?>
                                                </span>
                                            </td>

                                        </tr>

                                    </table>
<?php if(count($seekerArray['spec']) !=0): ?>
                                    <div class="skills">


                                        <?php $__currentLoopData = $seekerArray['spec']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $code_id = substr($code, stripos($code, "-")+1, strlen($code));
                                            $code_count = substr($code,0,stripos($code, "-"));

                                            ?>
                                            <div><a  onclick="ShowSpecs('<?php echo e($seekerArray['user_name']); ?>','<?php echo e($code_id); ?>');" class="bs bc"><?php echo e($code_count); ?></a><span class="bsv bf"> <?php echo e($index); ?> </span></div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
    <?php endif; ?>
                                </div></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <hr>
                    <div class="center">
                        <?php if(count($seekersArray) > 19 ): ?>
                            <button id="more" class="btn btn-lg  btn-default center"  onclick="showMore()"><span>مشاهدة المزيد  </span><img id="moreImg" style="display: none" src="<?php echo e(asset('images/loading.gif')); ?>"/></button>
                        <?php else: ?>
                            <button id="more" class="btn btn-lg  btn-default center"  disabled ><span>إنتهت نتائج البحث  </span></button>

                        <?php endif; ?>
                    </div>
                    <br>

                    <?php

                     $href= $allHref;

                    if ($href == ""){
                    $href = '?';
                    }
                    else{
                    $href = $href . '&';
                    }
                        ?>
                    <script type="text/javascript">

                        var pageNumber = 1;


                        var CSRF_TOKEN = document.querySelector("meta[name='csrf-token']").getAttribute("content");
                        function showMore () {
                            pageNumber++;
                            $("#more").prop("disabled", true);
                        $("#moreImg").show();
                            $.ajax({
                                type:'GET',
                                url: '/cv/saerch<?php echo $href.'page='; ?>'+pageNumber+'',
                                data: {_token: CSRF_TOKEN},

                                 success:function(data){
                                     var a=0;
                                     if(Object.keys(data).length > 0 ){
                                         ($.each(data.users, function () {                                         var ss ="";
                                         var u = this.user_name;
                                         var l = (this.services_count != 0) ? '<span><img class="icv" src="https://www.libyacv.com/images/home/ser.png">'+ this.services_count +'</span>' : "";
                                         var s ='<div class="cv-div"><div class="cv-body">'+
                                             '<div class="devimgseeker"><a title="'+this.fname+' '+ this.lname+'" href="/user/'+ this.user_name +'"><img class="imgseeker-view" src="'+ this.image+'" /></a></div> <table><tr> <td height="30"><h2 ><a title="'+this.fname+' '+ this.lname+'" id="cvname" href="/user/'+this.user_name+'">'+this.fname+' '+ this.lname+'</a></h2><span class="texts">'+this.about+' &nbsp;</span><hr></td></tr><tr>'+
                                             '<td><span class="icon-heart" >'+ this.see_it+'</span><span class="r"><span><a  class="icon-th f14" href="?domain='+ this.domain_name +'">'+this.domain_name+'</a></span><span ><a class="icon-graduation-cap" href="?education='+this.edt_name+'">'+this.edt_name+'</a></span><span><a  class="icon-location" href="?city='+this.city_name+'">'+this.city_name+'</a></span><span>'+this.address+'</span>'+l+'</span></td> </tr></table>';
                                         if(Object.keys(this.spec).length !=0){
                                             ss=ss+'<div class="skills"> ';
                                             $.each(this.spec, function(k, v) {
                                                 //display the key and value pair
                                                 var i =v.substr(v.indexOf("-")+1, v.strlen);
                                                 var c = v.substr(0,v.indexOf("-"));
                                                  ss = ss+' <div><a onclick="ShowSpecs(\''+u+'\',\''+ i +'\');" class="bs bc">'+c+'</a><span class="bsv bf">'+k+'</span></div>'
                                             });
                                             ss=ss+'</div>';
                                         }
                                         ss = s+ss;
                                         $("#SeekerResults").append(ss+"</div></div>");

                                             a++;
                                         }));
                                         if(a > 19){
                                             $("#more").prop("disabled", false);
                                             $('#more span').text('مشاهدة المزيد');
                                         }else{
                                             $('#more span').text('ليس لديك صلاحية لرؤية نتائج اكثر');
                                         }
                                     } else
                                     {
                                         //   $("#IdResults").append("<br><span>خطاء لايمكن تحميل المزيد من النتائج </span>");
                                         $('#more span').text('ليس لديك صلاحية لرؤية نتائج اكثر');
                                     }
                                     $("#moreImg").hide();

                                 }
                            });

                        }
                    </script>

                    <a class="facebox" style="display: none"></a>
                </div>

            </div>
            <div class="col-lg-3" style="border-right: 1px solid #ccc">
                <br>
                <h2 class="center">نماذج سيرة ذاتية</h2>

                <div class="col-lg-12">

                    <a href="/free-cv-template/english-resume">
                        <div class="divblog">
                            <img width="100%" src="<?php echo e(asset('images/blog/cveng.png')); ?>">
                            <span class="spanblog"><h2 class="titleblog">Cool free english resume</h2> </span>
                        </div>
                    </a>
                    <br>
                    <a href="/files/template_arabic_cv/download">
                        <div class="divblog">
                            <img width="100%" src="<?php echo e(asset('images/blog/template_arabic.jpg')); ?>">
                            <span class="spanblog"><h2 class="titleblog">Download - تحميل</h2> </span>
                        </div>
                    </a>


                </div>
            </div>
            <nav id="bottom" class="bottom t">
                <span class="clicker   icon-up-open"></span>

            </nav>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/search/cvs.blade.php ENDPATH**/ ?>