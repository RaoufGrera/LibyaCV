@extends('layouts.header')
@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        $('#send').click(function(e){
            e.preventDefault();
            $.ajax({
                url: 'news/add',
                type: 'POST',
                cache: false,
                data: $('form#add').serialize(),
                dataType: 'json',
                processData: false,
                beforeSend: function(){
                    $('#title').val('');
                },
                success: function(data){
                    $("#result").append('<p>'+data+'</p>');
                },
                error: function(xhr, textStatus, thrownError){
                    $("#result").append(xhr.responseText);
                    
                }
            });
        });
    });
</script>
        <div class="container">
            <div class="row">
                <div class="col-md-3 ">  
                    <div class="cont">
                    
                    </div>
                </div>
                <div class="col-md-9">
                    lola
                    <div class="cont">
                        
                    {!! Form::open(array('route'=>'news.store','id'=>'add')) !!}
                    {!! Form::text('title','',array('class'=>'form-control','id'=>'title')) !!}
                    {!! Form::button('Send',array('class'=>'btn btn-success','id'=>'send')) !!}
                    {!! Form::close() !!}
                     <p id="result"></p>
                        
                    </div>
                </div>
            </div>
        </div>
 
@stop