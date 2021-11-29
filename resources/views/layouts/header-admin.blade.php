<!DOCTYPE html>
<html>
    <head>
        <title>libyacv</title>

<meta id="X-CSRF-TOKEN" content="{{ csrf_token() }}">
<meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-arabic.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('css/script.css')}}">
             <link rel="stylesheet" type="text/css" href="{{asset('facebox.css')}}">


<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />

        <link rel="icon" type="image/png" href="{{asset('images/simple/newlogo1.png')}}">

        <img src="{{asset('images/ajax-loader.gif')}}" style="display:none;" />
 
     </head>
    <body>


        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="https://www.libyacv.com"><img style="width: 90px;" src="{{asset('images/logo/lcv2.png')}}"/></a>
                   <!-- <a href="#"><img class="logo" src="http://localhost/libyacv/public/images/logocv2.png"></a>-->
                </div>
            </div>
                <!-- Collect the nav links, forms, and other content for toggling -->





        </nav>

 @yield('content')


        <script    type="text/javascript" src="{{asset('js/facebox/jquery.js')}}" ></script>

        <script   type="text/javascript" src="{{asset('js/app.js')}}"></script>
        <script   type="text/javascript" src="{{asset('js/jquery.circliful.min.js')}}"></script>

   <script    type="text/javascript" src="{{asset('js/facebox/facebox.js')}}"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('a[class*=facebox]').facebox({
                    loadingImage : "{{asset('images/ajax-loader.gif')}}",
                    closeImage   : ''

                })
            });


        </script>
        <script type="text/javascript">
            $(function(){
                $('.circlestat').circliful();
            });
        </script>
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->

    </body>
</html>