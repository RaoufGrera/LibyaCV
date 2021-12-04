@extends('layouts.header-modal')
@section('content')
<div>
	<div class="alert-face" >تعديل المهارة </div>
	<button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

		<div class="modal-face">
            
            {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
			<div class="mymodal">
  				<table class="iteminli" >
					<tr>
						<td>
							<label for="skills_name">
								المهارة
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<input id="skills_name" name="skills_name" value="{{ $seeker_skills->skills_name }}" type="text"  maxlength="200" required  placeholder="اسم المهارة"  />

						</td>
 								<td><div  class="tooltip skills_name_val validation">

									</div>
							</td>
					</tr>
				
					<tr>
						<td width="100">
							<label for="level_id">
								المستوي
								<span  class="req">*</span>
							</label>
						</td>
						<td>
							<select id="level_id" name="level_id" required>

        @foreach($level as $levels)
									@if($levels->level_id == $seeker_skills->level_id)
										<option value="{{$levels->level_id}}"  selected="selected" >{{$levels->level_name}}</option>
										@continue
									@endif
          <option value="{{$levels->level_id}}">{{$levels->level_name}}</option>
        @endforeach
      </select>	
						</td>

						<td><div  class="tooltip level_id_val validation">

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
	var id =  <?php echo $seeker_skills->skills_id; ?>;
	$('#myForm').submit(function(e){
		e.preventDefault();
		var dataObject =  $("#myForm").serialize();
		editSaveRest('skills/'+id ,'#skills','#skills',dataObject);
	});
</script>
@stop