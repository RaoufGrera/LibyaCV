<!DOCTYPE html>
<html>
    <head>
        <title>libyacv</title>


        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-arabic.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('css/script.css')}}">
             <link rel="stylesheet" type="text/css" href="{{asset('facebox.css')}}">


<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />

        <link rel="icon" type="image/png" href="{{asset('images/logos.png')}}">
        <script    type="text/javascript" src="{{asset('js/facebox/jquery.js')}}"></script>

        <script   type="text/javascript" src="{{asset('js/facebox/facebox.js')}}"></script>

        <img src="{{asset('images/ajax-loader.gif')}}" style="display:none;" />

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('a[class*=facebox]').facebox({
                    loadingImage : "{{asset('images/ajax-loader.gif')}}",
                    closeImage   : ''

                })
            });
        </script>



<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
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

                    <a class="navbar-brand" href="#"><img style="width: 110px;" src="{{asset('images/logo44.png')}}"/></a>
                   <!-- <a href="#"><img class="logo" src="http://localhost/libyacv/public/images/logocv2.png"></a>-->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->


            </div><!-- /.container-fluid -->
        </nav>

 @yield('content')
  <footer class="contaner">
        <div style="text-align:center"><p>footerrr</p></div>

        </footer>

        <script  type="text/javascript" src="{{asset('js/index.js')}}"></script>

 </body>
</html>