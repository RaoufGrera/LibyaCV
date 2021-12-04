@extends('layouts.header-modal')
@section('content')
<div>
	<div class="alert-face" >تعديل الهواية</div>
	<button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

		<div class="modal-face">
            
            {!! Form::open(["method"=>"PATCH","class"=>"form-style-2","id"=>"myForm"]) !!}
			<div class="mymodal">
  				<table class="iteminli" >
					<tr>
						<td WIDTH="100">
							<label for="hobby_name">
								الهواية
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<div class="input-group">
							<input id="hobby_name"  autocomplete="off" class="form-control"  name="hobby_name" type="text" value="{{ $seeker_hobby->hobby_name }}"  maxlength="200" required  placeholder="مثل: الشطرنج، القراءة..." />
							<ul id="hobbyResults" class="lists">

							</ul>
							</div>
						</td>

					</tr>

				</table>
			</div>
 				<div class="modal-footer">
					<input type="submit" class="btn btn-info" id="create" value="حفظ" />

					<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default ">إلغاء</a>
 				</div>
		
		
			   {!! Form::close() !!}
			
					</div>
  
    </div>
<script type="text/javascript">
	var id =  <?php echo $seeker_hobby->job_hobby_id; ?>;
	$('#myForm').submit(function(e){
		e.preventDefault();
		var dataObject =  $("#myForm").serialize();
		editSaveRest('hobby/'+id ,'#hobbyChange','#hobby',dataObject);
	});
	$("#hobby_name").delayKeyup(function() {searchAjax("#hobby_name","hobby","#hobbyResults");},700);$("#hobby_name").blur(function(){$("#hobbyResults").fadeOut(500);}).focus(function() {$("#hobbyResult").show();});

</script>
@stop