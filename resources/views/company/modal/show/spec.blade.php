<div><h4>التخصصات</h4></div>
<div class="contpost">
    @if (count($company_spec)== 0)
        <span class="texts">هل تملك مهارات مثل استخدام برنامج محرر النصوص او خبرة في تصفح أدخال البيانات أو غيرها من المهارات ، يمكنك كتابتها هنا .</span>
        <br><br>
    @endif

    @foreach($company_spec as $row)
            <span class="btn btn-default" style="cursor: context-menu;" > {{ $row->spec_name }}</span>
        <img src="{{asset('images/remove.png')}}"/><input type="button" class=" btn-link delete-cv" onclick="return  deleteItemCompany('{{ $user }}','specialty','#specialty',{{ $row->spec_company_id }})" value="حذف" />


    @endforeach
        <br><br>
    <a onclick="ShowEditModalRESTfulCompany('specialty','{{ $user }}');">+أضافة</a>
    <br><br>
</div>