<div>
	<div class="alert-face" >تعديل معلومات الأتصال</div>
    <button type="button"  href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close" data-dismiss="modal">&times;</button>

	<div class="modal-face">

            {!! Form::open(["id"=>"myForm","method"=>"PATCH","class"=>"form-style-2"]) !!}
			<div class="mymodal">
  				<table class="iteminli" >
					<tr>
						<td><label for="website">website</label></td>
						<td>
							<div style="direction: ltr;" class="input-group">
							<div  class="input-group-addon">https://www.</div>
							<input class="form-control" id="website" name="website" type="text" value="{{ $contact->website }}" maxlength="200"  />
							</div>
						</td>
					</tr>
					<tr>
						<td><label for="facebook">Facebook</label></td>
						<td>
							<div style="direction: ltr;" class="input-group">
								<div class="input-group-addon">https://fb.com/</div>
							<input class="form-control" id="facebook" name="facebook" type="text" value="{{ $contact->facebook }}" maxlength="100"  />
							</div>
						</td>
					</tr>
					<tr>
						<td><label for="twitter">Twitter</label></td>

						<td>
							<div style="direction: ltr;" class="input-group">
								<div class="input-group-addon">@</div>
							<input class="form-control" id="twitter" name="twitter" type="text" value="{{ $contact->twitter }}" maxlength="100"  />
						</div>
						</td>
					</tr>
					<tr>
						<td><label for="linkedin">Linkedin</label></td>
						<td>
							<div style="direction: ltr;" class="input-group">
								<div class="input-group-addon">@</div>
							<input class="form-control" id="linkedin" name="linkedin" type="text" value="{{ $contact->linkedin }}" maxlength="100"  />
							</div>
						</td>
					</tr>
					<tr>
						<td><label for="instagram">Instagram</label></td>
						<td>
							<div style="direction: ltr;" class="input-group">
								<div class="input-group-addon">@</div>
							<input class="form-control" id="instagram" name="instagram" type="text" value="{{ $contact->instagram }}" maxlength="100"  />
							</div>
						</td>
					</tr>
					<tr>
						<td><label for="goodreads">GoodReads</label></td>
						<td>
							<div style="direction: ltr;" class="input-group">
								<div class="input-group-addon">@</div>
							<input class="form-control" id="goodreads" name="goodreads" type="text" value="{{ $contact->goodreads }}" maxlength="100"  />
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class ="modal-footer">
				<input  type="submit" id="create" value="حفظ" class="btn btn-info" />
				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="btn btn-default ">إلغاء</a>
 				</div>
		
		
			   {!! Form::close() !!}
			
					</div>
  
    </div>
<script type="text/javascript">

	$('#myForm').submit(function(e){
		e.preventDefault();
		var dataObject =  $("#myForm").serialize();
		editSave('edit-contact','#contact','#contact',dataObject);
	});
</script>
