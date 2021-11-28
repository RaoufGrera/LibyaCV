<div>
	<div class="alert  "><strong>أضافة خبرة جديدة</strong></div>

		<div class="modal-body">
			<form  name="form2"  accept-charset="UTF-8"  action="insert_exp.php" method="POST" >
				<table class="iteminli" >				
					<tr>
						<td>
							<label class="control-label" for="exp_comp">
							الشركة
							<span  class="req">*</span>
							
							</label>
						</td>
						<td>
							<input id="exp_comp" name="exp_comp" type="text"  value="" maxlength="150"  placeholder="الشركة"  />
						</td>
						<td>
							<div class="tooltip">
								<span>?</span>
								<div class='content'>
									<b></b>
									<p> كتابة اسم الشركة أو المؤسسة</p>
								</div>
							</div>
						</td>
						<td>
							<span class="exp_comp_val validation"></span>
						</td>		
					</tr>
				
					<tr>
						<td>
							<label class="control-label" for="exp_name">
								المسمي الوظيفي
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input id="exp_name" name="exp_name" type="text"  maxlength="150"  placeholder="المسمي الوظيفي" />
						</td>
					<td></td>
						<td>
					<span class="exp_name_val validation"></span>
						</td>
					</tr>
						
					
					<tr>
						<td>
							<label class="control-label" for="dom_id">
								القطاع
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="dom_id" name="dom_id"  > 
							<option value="0" selected="selected">
							القطاع
							</option>
						
							</select>
						</td>
						<td></td>
						<td>
						<span class="dom_id_val validation"></span>
						</td>
					</tr>
					
				<tr>
						<td><label class="control-label" for="exp_desc">
							الأنجازات 
							
							
						</label>
						</td><td>
								<textarea  maxlength="1200" style="max-height:150px; height:100px; min-height:100px;" rows="80" name="exp_desc" id="exp_desc" ></textarea>
					</td><td>
							<div class="tooltip">
									<span>?</span>
									<div class='content'>
										<b></b>
										<p> كتابة أهم الأنجازات التي قمت بها خلال العمل بهذه الوظيفة ، أذا لم يكن لديك أنجازات معينة يفضل ترك هذا الحقل فارغاً .</p>
									</div>
								</div>
								</td>
								<td>
								<span class="job_desc_val validation"></span>
								</td>
						</tr>
					<tr>
						<td>
							<label class="control-label" for="start_date_m">
								المدة من
								<span  class="req">*</span>
							</label>
						</td>
						
						<td class="day">
				
					<select name="start_date_m"   > 
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
							$i = date("Y");
							for($i;$i>=1950;$i--){
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</td>
						<td>
						</td>
						<td>
						
						</td>
						</tr>
							
<tr>
						<td>
							<label class="control-label" for="end_date_m">
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
							السنة
							</option>
							<option value="1" >لحد الأن</option>
							<?php
							$i = date("Y");
							for($i;$i>=1950;$i--){
							echo "<option ";
							echo "value=\"$i\">$i</option>\n";
							}
							?>
							</select>
						</td>
						<td>
						</td>
						<td>
						<span class="start_date_val validation"></span>
						</td>
						</tr>							
				</table>

				<div class ="btninsert">
				<input name="insert_exp" type="submit" value="حفظ" class="btn btn-info" tabindex="11"/> 
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-danger ">إلغاء</a>
				</div>
		
		
				 </form>
			
					</div><br/>
  
    </div>

