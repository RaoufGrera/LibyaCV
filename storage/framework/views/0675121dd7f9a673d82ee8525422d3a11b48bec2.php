<?php $__env->startSection('content'); ?>
<div>
    <div class="alert-face" >تعديل المعلومات الشخصية</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

    <div class="modal-face">
        <?php echo Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]); ?>

        <div class="mymodal">
         <table class="iteminli" >
             <tr>
                 <td><label for="fname">الأسم  <span class="req">*</span></label></td>
                 <td><input id="fname" class="form-control" value="<?php echo e($info->fname); ?>" name="fname" type="text" required /></td>
             </tr>


             <tr>
                 <td><label for="about">عنوان مختصر</label></td>
                 <td><input id="about" class="form-control" value="<?php echo e($info->about); ?>"  maxlength="60" name="about" type="text" /></td>
             </tr>
             <tr>
                 <td>
                     <label class="control-label" for="fdate">
                         تاريخ الميلاد
                         <span  class="req">*</span>
                     </label>
                 </td>


                 <td class="day">
                     <?php $time = strtotime($info->birth_day);?>
                     <select id="fdate" name="fdate"  tabindex="3" >

                         <?php

                         for($i=1;$i<=31;$i++){
                             echo "<option ";
                             if(date('d',$time) == $i){
                                 echo " selected " ;
                             }
                             echo "value=\"$i\">$i</option>\n";
                         }
                         ?>
                     </select>
                     -
                     <select  name="fdate1"  >

                         <?php

                         for($i=1;$i<=12;$i++){
                             echo "<option ";
                             if(date('m',$time) == $i){
                                 echo " selected " ;
                             }

                             echo "value=\"$i\">$i</option>\n";
                         }
                         ?>
                     </select>
                     -
                     <select name="fdate2"   >

                         <?php

                         for($i=1955;$i<=2010;$i++){
                             echo "<option ";
                             if(date("Y",$time) == $i){
                                 echo " selected " ;
                             }
                             echo "value=\"$i\">$i</option>\n";
                         }
                         ?>
                     </select>
                 </td>

             </tr>
             <tr>
                 <td>
                     <label for="edt">المؤهل
                         <span class="req">*</span>
                     </label>
                 </td>
                 <td>
                     <select id="edt" name="edt">

                         <?php $__currentLoopData = $edt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php if($item->edt_id == $info->edt_id): ?>
                                 <option value="<?php echo e($item->edt_id); ?>"
                                         selected="selected"><?php echo e($item->edt_name); ?></option>
                                 <?php continue; ?>
                             <?php endif; ?>
                             <option value="<?php echo e($item->edt_id); ?>"><?php echo e($item->edt_name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                 </td>
             </tr>
             <tr>
                 <td>
                     <label for="domain">المجال
                         <span class="req">*</span>
                     </label>
                 </td>
                 <td>
                     <select id="domain" name="domain">

                         <?php $__currentLoopData = $domain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php if($item->domain_id == $info->domain_id): ?>
                                 <option value="<?php echo e($item->domain_id); ?>"
                                         selected="selected"><?php echo e($item->domain_name); ?></option>
                                 <?php continue; ?>
                             <?php endif; ?>
                             <option value="<?php echo e($item->domain_id); ?>"><?php echo e($item->domain_name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                 </td>
             </tr>

             <tr>
                 <td>
                     <label for="city">المدينة
                         <span class="req">*</span>
                     </label>
                 </td>
                 <td>
                     <select id="city" name="city">

                         <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $citys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php if($citys->city_id == $info->city_id): ?>
                                 <option value="<?php echo e($citys->city_id); ?>"
                                         selected="selected"><?php echo e($citys->city_name); ?></option>
                                 <?php continue; ?>
                             <?php endif; ?>
                             <option value="<?php echo e($citys->city_id); ?>"><?php echo e($citys->city_name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                 </td>
             </tr>
             <tr>
                 <td><label for="address">العنوان  </label></td>
                 <td><input id="address" class="form-control" value="<?php echo e($info->address); ?>" name="address" type="text"  /></td>
             </tr>
             <tr>
                 <td><label for="address">البريد الإلكتروني  </label></td>
                 <td><input id="address" class="form-control" value="<?php echo e($info->email1); ?>" name="email" type="text"  /></td>
             </tr>
             <tr>
                 <td><label for="phone">الهاتف  </label>  </td>
                 <td><input id="phone" class="form-control" pattern="[0-9]{10}" title="رقم الهاتف." value="<?php echo e($info->phone); ?>" name="phone" type="text"  <?php  /*if(!$info->phoned_date) echo "disabled"; */ ?> />
                     <span style="font-size: 80%;">********09
                     </span></td>

             </tr>


             <tr>
                 <td>
                     <label for="sex">الجنس
                         <span class="req">*</span>
                     </label>
                 </td>
                 <td>
                     <select id="sex" name="sex">

                         <option value="m"
                             <?php if($info->gender =="m"): ?>
                                         selected="selected"
                             <?php endif; ?>
                         >ذكر</option>
                         <option value="f"
                                 <?php if($info->gender =="f"): ?>
                                 selected="selected"
                                 <?php endif; ?>
                         >أنثي</option>
                     </select>
                 </td>
             </tr>
        </table>
</div>
        <div class ="modal-footer">
            <?php echo Form::submit("حفظ",["class"=>"btn btn-info"]); ?>

            <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default ">إلغاء</a>

        </div>


        <?php echo Form::close(); ?>


    </div>

</div>

<script type="text/javascript">

    $('#myForm').submit(function(e){
        e.preventDefault();
        var dataObject =  $("#myForm").serialize();
        editSave('edit-info','#personal-information','#personal-information',dataObject);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/edit/einfoseeker.blade.php ENDPATH**/ ?>