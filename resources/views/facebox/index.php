<! DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="facebox.css">

</head>
<body>
                <script type="text/javascript" src="js/facebox/jquery.js"></script>

                <script type="text/javascript" src="js/facebox/email.js"></script>
                    <script type="text/javascript" src="js/facebox/facebox.js"></script>


        
<script type="text/javascript">
jQuery(document).ready(function($) {
$('a[class*=facebox]').facebox({
loadingImage : '../public/images/loading.gif',
closeImage   : '../public/images/closelabel.png'
})
});
    

jQuery(document).ready(function(){
    $("#added").click(function(){
        $("#edd").html("<div class='loader'></div>");
        
    })});
</script>
<a class="facebox" href="test/modal">facebox</a>
    <div id="edd"></div>
<button id="added"> +أضافة</button>

</body>
</html>