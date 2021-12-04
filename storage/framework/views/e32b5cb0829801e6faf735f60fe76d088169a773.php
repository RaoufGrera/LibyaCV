<?php $__env->startSection('content'); ?>
<div>
	<div class="alert-face">أضافة خبرة جديدة</div>
	<button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

		<div class="modal-face">
            
            <?php echo Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]); ?>

			<div class="mymodal">
  				<table>

					<tr>
						<td>
							<label for="exp_comp">الشركة<span  class="req">*</span></label>
						</td>
						<td>
							<div class="input-group">
							<input id="exp_comp" name="exp_comp" type="text" class="form-control" autocomplete="off"  value="" maxlength="120" placeholder="الشركة"/>
							<ul id="expResults" class="lists">

							</ul>
								</div>
						</td>
 								<td><div  class="tooltip exp_comp_val validation"></div>
							</td>
					</tr>
				
					<tr>
						<td>
							<label for="exp_name">المسمي الوظيفي<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input class="form-control" id="exp_name" name="exp_name" type="text"  maxlength="150"  placeholder="المسمي الوظيفي" />
						</td>
 						<td><div  class="tooltip exp_name_val validation"></div>
						</td>
					</tr>
						
					
					<tr>
						<td>
							<label for="dom_id">
								القطاع
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="dom_id" name="dom_id"   >
								<option value="0" selected="selected">
									القطاع
								</option>
								<?php $__currentLoopData = $domain_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($domain->domain_id); ?>"><?php echo e($domain->domain_name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</td>
						<td><div  class="tooltip dom_id_val validation">

							</div>
						</td>
					</tr>
					
				
                    <tr>
							<td>
								<label for="exp_desc">
								الأنجازات
								
								</label>
							</td>
							<td>
								<textarea  maxlength="1200" style="max-height:150px; max-width:230px; height:100px; min-height:100px;" rows="80" name="exp_desc" id="exp_desc" ></textarea>
							</td>
	 				
						</tr>

						<tr>
							<td>
								<label  for="start_date">
									المدة من
									<span  class="req">*</span>
								</label>
							</td>
							
							
							<td class="day">

								<select name="start_date_m">
									<option value="0" selected="selected">
										الشهر
									</option>
									<?php

									for($i=12;$i>=1;$i--){
										echo "<option ";
										echo "value=\"$i\">$i</option>\n";
									}
									?>
								</select>
								-
								<select name="start_date_y"  >
									<option value="0" selected="selected">
										السنة
									</option>
								<?php
								$y = date("Y");
								for($i=$y;$i>=1970;$i--){
								echo "<option ";
								echo "value=\"$i\">$i</option>\n";
								}
								?>
								</select>
								</td>
							</tr>
							<tr>
								<td>
									<label  for="end_date_m">
										الي
										<span  class="req">*</span>
									</label>
								</td>
								<td class="day">
									<select name="end_date_m"   >
										<option value="0" selected="selected">
											الشهر
										</option>
										<?php

										for($i=12 ;$i>=1;$i--){
											echo "<option ";
											echo "value=\"$i\">$i</option>\n";
										}
										?>
									</select>
									-
									<select name="end_date_y"  >
								<option value="0" selected="selected">
								إلي
								</option>
								<option value="1" >لحد الأن</option>
								<?php
								$y = date("Y");
								for($i=$y;$i>=1970;$i--){
								echo "<option ";
								echo "value=\"$i\">$i</option>\n";
								}
								?>
								</select>
							</td>
							<td><div class="tooltip start_date_val validation">
										 
										</div>
									 </td>
								</tr>
				</table>
			</div>
			<div class="modal-footer">
				<input name="insert_exp" type="submit" value="حفظ" class="btn btn-info" />
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default">إلغاء</a>
				</div>
		
		
			   <?php echo Form::close(); ?>

			
					</div>
  
    </div>
<script type="text/javascript" src="<?php echo e(asset('js/script_exp.js')); ?>" ></script>
<script type="text/javascript">
	$('#myForm').submit(function(e){
		e.preventDefault();
		var dataObject =  $("#myForm").serialize();
		editSaveRest('experience','#experience','#experience',dataObject);
	});
	$("#exp_comp").delayKeyup(function() {searchAjax("#exp_comp","exp","#expResults");},700);$("#exp_comp").blur(function(){$("#expResults").fadeOut(500);}).focus(function() {$("#expResults").show();});
</script>
<script   type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\libyacv\resources\views/seekers/modal/add/aexp.blade.php ENDPATH**/ ?>