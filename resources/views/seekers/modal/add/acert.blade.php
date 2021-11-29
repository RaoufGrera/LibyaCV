@extends('layouts.header-modal')
@section('content')
<div>
	<div class="alert-face" >أضافة شهادة جديدة</div>
	<button type="button" href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close"
			data-dismiss="modal">&times;</button>
	<div class="modal-face">
            {!! Form::open(["id"=>"myForm","method"=>"POST","class"=>"form-style-2"]) !!}
        <div class="mymodal">
        <table class="iteminli" >
					<tr>
						<td>
							<label for="cert_name">
								الشهادة
								<span  class="req">*</span>
							</label>
						</td>

						<td>
							<div class="input-group">
								<input class="form-control" autocomplete="off" id="cert_name" name="cert_name" type="text" required   value="" maxlength="120" placeholder="اسم الشهادة"   />
								<ul id="certResults" class="lists">

								</ul>
							</div>
							</td>
						<td><div  class="tooltip cert_name_val validation">

							</div></td>
					</tr>
				
					<tr>
						<td width="100">
							<label for="cert_date">
								سنة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="cert_date" name="cert_date" required>
								<option value="" selected="selected" >
									السنة
								</option>
								<?php
								$y = date("Y");
								for($i=$y;$i>=1960;$i--){
									echo "<option ";
									echo "value=\"$i\">$i</option>\n";
								}
								?>
							</select>
						</td>
						<td><div  class="tooltip cert_date_val validation">

							</div></td>
					</tr>

				</table>
			<br>
        </div>
            <div class="modal-footer">
                <input type="submit" value="حفظ" class="btn btn-info"/>
                <a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
                   class="btn btn-default ">إلغاء</a>
            </div>

        </div>
			   {!! Form::close() !!}
    </div>
<script type="text/javascript">

	$('#myForm').submit(function(e){
		e.preventDefault();
		var dataObject =  $("#myForm").serialize();
		editSaveRest('certificate','#certificate','#certificate',dataObject);
	});
	$("#cert_name").delayKeyup(function() {searchAjax("#cert_name","cert","#certResults");},700);$("#cert_name").blur(function(){$("#certResults").fadeOut(500);}).focus(function() {$("#certResults").show();});

</script>
@stop

