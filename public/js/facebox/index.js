$('.dropdown-toggle').click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.search-dropdown').toggleClass('open');
});
/*
$('#aa').click(function (e) {

});
*/
function showTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
function ShowEditModal(name){
    $.facebox({ ajax: '/profile/'+name });
}

function ShowModal(a,b){
    $.facebox({ ajax: '/block/'+a+'/'+b});
}
function ShowSpecs(a,b){
    $.facebox({ ajax: '/spec/'+a+'/'+b });
}

function ShowEditModalCompany(a,b){
    $.facebox({ ajax: '/company-profile/'+a+'/'+b });
}

function ShowEditModalRESTfulCompany(a,b,c){
    if (typeof(c)==='undefined') {
        $.facebox({ ajax: '/company-profile/'+a+'/'+b+'/create' });
    }else{
        $.facebox({ ajax: '/company-profile/'+a+'/'+b+'/'+c+'/edit' });
    }
}
function ShowEditModalRESTful(a,b){

    if (typeof(b)==='undefined') {
        $.facebox({ ajax: '/profile/'+a+'/create' });
    }else{
        $.facebox({ ajax: '/profile/'+a+'/'+b+'/edit' });
    }
}
function editSave(a,b,c,formObj){

    $.post('/profile/'+ a,(formObj))
        .done(function( data )  {
            $(b).html(data.body);
            window.location = c;
            $("#facebox_overlay").click();
            if(data.message != "")
                $('<div class="alert alert-success"><strong>تنبيه! </strong>' + data.message + '</div>').insertAfter(c).delay(2000).fadeOut();
        });
}


function deleteRest(a,b,c,data){
    var imageSource = document.getElementById("loading").src;
    $("#facebox_overlay").click();
    window.location = c;
    $(b +" .contpost").html(" <div class='loader'> <img src='" + imageSource + "'/><span>الرجاء الإنتظار...</span></div>");

    $.post('/profile/'+ a,(data))
        .done(function( data )  {
            $(b).html(data.body);
            window.location = c;
            if(data.message != "")
                $('<div class="alert alert-danger fixed"><span>تنبيه! </span>' + data.message + '</div>').insertAfter(c).delay(2000).fadeOut();
        });
}

function editSaveRest(a,b,c,formObj){
    var imageSource = document.getElementById("loading").src;
    $("#facebox_overlay").click();
    window.location = c;
    $(b +" .contpost").html(" <div class='loader'> <img src='" + imageSource + "'/><span>الرجاء الإنتظار...</span></div>");
    $.post('/profile/'+ a,(formObj))
        .done(function( data )  {
            $(b).html(data.body);
            window.location = c;
            if(data.message != "")
              $('<div class="alert alert-success"><strong>تنبيه! </strong>' + data.message + '</div>').insertAfter(c).delay(2000).fadeOut();

        });
}

function editSaveCompany(a,b,c,formObj){
    var imageSource = document.getElementById("loading").src;
    $("#facebox_overlay").click();

    $(c +" .contpost").html(" <div class='loader'> <img src='" + imageSource + "'/><span>الرجاء الإنتظار...</span></div>");
    $.ajax({
        url: '/company-profile/'+ b +'/'+ a,
        type: "POST",
        data: formObj,
        contentType: false,
        cache: false,
        processData:false,
        success: function(data) {
            $(c).html(data.body);
        }
    });

}


function deleteRestCompany(a,b,c,d,data){
    var imageSource = document.getElementById("loading").src;
    $("#facebox_overlay").click();
    window.location = c;
    $(c).find('.contpost').html(" <div class='loader'> <img src='" + imageSource + "'/><span>الرجاء الإنتظار...</span></div>");
   if(d == null) {
       $.post('/company-profile/' + b + '/' + a, (data))
           .done(function( data )  {
               $(c).html(data.body);
               window.location = c;
               if(data.message != "")
                   $('<div class="alert alert-danger fixed"><span>تنبيه! </span>' + data.message + '</div>').insertAfter(c).delay(2000).fadeOut();
           });
   }else{
        $.post('/company-profile/'+ b +'/'+ a+'/'+ d,(data))
        .done(function( data )  {
            $(c).html(data.body);
            window.location = c;
            if(data.message != "")
                $('<div class="alert alert-danger fixed"><span>تنبيه! </span>' + data.message + '</div>').insertAfter(c).delay(2000).fadeOut();
        });
   }
}

function editSaveRestCompany(a,b,c,formObj){
    var imageSource = document.getElementById("loading").src;
    $("#facebox_overlay").click();
    window.location = c;
    $(c +" .contpost").html(" <div class='loader'> <img src='" + imageSource + "'/><span>الرجاء الإنتظار...</span></div>");
    $.post('/company-profile/'+ b +'/'+ a,(formObj))
        .done(function( data )  {
            $(c).html(data.body);
            window.location = c;
            if(data.message != "")
                $('<div class="alert alert-danger"><strong>تنبيه! </strong>' + data.message + '</div>').insertAfter(c).delay(2000).fadeOut();

        });
}

function exportPdf(a){
    var imageSource = document.getElementById("loading").src;
    $("myForm").html(" <div class='loader'> <img src='" + imageSource + "'/><span>الرجاء الإنتظار...</span></div>");
    $.get('/pdf/Abdr')
        .done(function( data )  {
           // $(b).html(data.body);

        });
}

function sendBlock(a,b,formObj){
    var imageSource = document.getElementById("loading").src;
    $('#myForm').html(" <div class='loader'> <img src='" + imageSource + "'/><span>الرجاء الإنتظار...</span></div>");

    $.post('/block/'+ a +'/'+ b,(formObj))
        .done(function( data )  {
            if(data.message != "")
                $('#myForm').html('<div class="alert alert-warning"><strong>تنبيه! </strong>' + data.message + '</div>');
            setTimeout(
                function() {
                    $("#facebox_overlay").click();
                },
                6000);
        });
}
/*
function sendBlock(a,b,c,formObj){
    var imageSource = document.getElementById("loading").src;
    $("#facebox_overlay").click();
    window.location = c;
    $(b +" .contpost").html(" <div class='loader'> <img src='" + imageSource + "'/><span>الرجاء الإنتظار...</span></div>");
    $.post('/report/'+ a,(formObj))
        .done(function( data )  {
            $(b).html(data.body);
            window.location = c;
            if(data.message != "")
                $('<div class="alert alert-danger"><strong>تنبيه! </strong>' + data.message + '</div>').insertAfter(c).delay(2000).fadeOut();

        });
}
*/

$('.close').click(function() {

    $('.alert').hide();

})
/* When the user clicks on the button,
 toggle between hiding and showing the dropdown content */
function myFunction(item) {

    item = document.getElementById(item);

    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var d = 0; d < dropdowns.length; d++) {
        var openDropdown = dropdowns[d];
        if (openDropdown.classList.contains('show') && !item.classList.contains('show') ) {
            openDropdown.classList.remove('show');
        }
    }
    if (!item.classList.contains('show')){
        item.classList.toggle("show");
    }else {
        item.classList.remove("show");

    }

}

// Close the dropdown if the user clicks outside of it


jQuery('#searchPage .dropdown-menu > li > a').click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).data('clicked', true);
    var clicked = $(this);
   // clicked.closest('.dropdown-menu').find('.menu-active').removeClass('menu-active');
  //  clicked.parent('li').addClass('menu-active');
    clicked.closest('.search-dropdown').find('.toggle-active').html(clicked.html());
    switch (clicked.html()) {
        case "الوظائف":
            $("#keyword").attr("placeholder", "أبحث عن وظائف ...");
            break;

        case "السير الذاتية":
            $("#keyword").attr("placeholder", "أبحث عن اسم الباحث ...");
            break;

        case "الدورات":
            $("#keyword").attr("placeholder", "أبحث عن دورة ...");
            break;

        case "الشركات":
            $("#keyword").attr("placeholder", "أبحث عن اسم الشركة ...");
            break;
    }
    $("#keyword").val("");
    $('.search-dropdown.open').removeClass('open');
    $("#stringHide").val(clicked.html());
});

$('#dropdown-profile').click(function (e) {
    e.preventDefault();
    e.stopPropagation();

});


$('#keyword').click(function (e) {
    e.preventDefault();
    e.stopPropagation();
});

$('.btn.btn-default.dropbtn').click(function (e) {
    e.preventDefault();
    e.stopPropagation();
});

$(document).click(function () {

    $('.search-dropdown.open').removeClass('open');
    var item = document.getElementById('myDropdown');
    item.classList.remove('show');
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var d = 0; d < dropdowns.length; d++) {
        var openDropdown = dropdowns[d];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
    }

    $("nav .selected div div").slideUp(200);
    $("nav .selected").removeClass("selected");
    //alert("NO HERE");
    if ($(this).next(".subs").length) {
        $(this).parent().addClass("selected");
        $(this).next(".subs").children().slideDown(200);

        $('.navbar-collapse').addClass("collapse");
    }
});


$('.navbar-toggle').click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    var item = document.getElementById('bs-example-navbar-collapse-1');
    if (item.classList.contains('collapse')) {
        $('.collapse.navbar-collapse').removeClass('collapse');
    } else {

        item.classList.toggle('collapse');
    }
});


$('select.select-min-age').click(function () {
    var select = $('select.select-min-age');
    select.change(function () {
        $('#min-age').val(this.value);
    });
});

$('select.select-max-age').click(function () {
    var select = $('select.select-max-age');
    select.change(function () {
        $('#max-age').val(this.value);
    });
});


$('select.select-min-exp').click(function () {
    var select = $('select.select-min-exp');
    select.change(function () {
        $('#min-exp').val(this.value);
    });
});

$('select.select-max-exp').click(function () {
    var select = $('select.select-max-exp');
    select.change(function () {
        $('#max-exp').val(this.value);
    });
});
