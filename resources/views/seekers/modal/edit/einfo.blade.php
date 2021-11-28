@extends('layouts.header-modal')
@section('content')
<div>
	<div class="alert-face" >أضافة معلومة جديدة</div>
	<button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

		<div class="modal-face">
            
            {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
			<div class="mymodal">
  				<table class="iteminli" >
					<tr>
						<td>
							<label for="info_name">
								المعلومة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input class="form-control" id="info_name" name="info_name" type="text" value="{{ $seeker_info->info_name }}" maxlength="60" required  placeholder="اسم المعلومة"  />
							</td>
						<td><div  class="tooltip cert_name_val validation">

							</div></td>
					</tr>
					<tr>
						<td>
							<label for="info_text">التفاصيل</label>
						</td>
						<td>
							<textarea  maxlength="3000" style="max-height:250px;width:225px ; max-width:300px;height:200px; min-height:150px;" rows="80" name="info_text" id="info_text">{{  $seeker_info->info_text }}</textarea>
						</td>
					</tr>
					<tr>
						<td width="100">
							<label for="info_date">
								سنة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="info_date" name="info_date" required>
								<option value="" selected="selected" >
									السنة
								</option>
								<?php
								$y = date("Y");
								for($i=$y;$i>=1960;$i--){
									echo "<option ";
									if($i == $seeker_info->info_date)
										echo " selected='selected' ";
									echo "value=\"$i\">$i</option>\n";
								}
								?>
							</select>
						</td>
						<td><div  class="tooltip info_date_val validation">

							</div></td>
					</tr>

				</table>
			</div>
 				<div class ="modal-footer">
				<input  type="submit" value="حفظ" class="btn btn-info" />
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default ">إلغاء</a>
 				</div>
		
		
			   {!! Form::close() !!}
			
					</div>
  
    </div>
<script type="text/javascript">
	var id =  <?php echo $seeker_info->info_id; ?>;
	$('#myForm').submit(function(e){
		e.preventDefault();
		var dataObject =  $("#myForm").serialize();
		editSaveRest('info/'+id ,'#info','#info',dataObject);
	});
</script>
@stop