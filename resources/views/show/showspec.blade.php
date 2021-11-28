<div>
	<div class="alert-face" >المصادقين</div>
	<button type="button" href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();' class="close"
			data-dismiss="modal">&times;</button>
		<div class="modal-face">
			<div class="mymodal">
		@if(count($myfirends) != 0)
			<span> العدد  {{ count($myfirends) }}</span>
					<ul class="lists-spec" >
						@foreach($myfirends as $f)
						<li class="list-search ">
							<a href="/user/{{ $f->user_name }}"><img src= @if($f->image !="") {{asset('images/seeker/40px_'.$f->code_image .'_'.$f->image )}}  @else @if($f->gender  =='m') {{asset('images/simple/40px_male.png')}} @else {{asset('images/simple/40px_female.png')}}  @endif @endif />
								{{ $f->fname }} {{ $f->lname }}</a>
						</li>

						@endforeach
					</ul>

		@endif
			<br>
			</div>
			<div class="modal-footer">

				<a href='javascript:void(0);' onclick='jQuery("#facebox_overlay").click();'
				   class="btn btn-default ">إلغاء</a>
			</div>
		</div>
  
    </div>
