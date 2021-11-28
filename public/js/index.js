function searchAjax(e, t, a) {
    var s = $(e).val();
    s.length >= MIN_LENGTH ? $.post("/apr/" + t, {keyword: s}).done(function (t) {
        $(a).html(""), t.data.length > 0 && $.each(t.data, function () {
            $(a).append('<li class="list-search t">' + this.name + "</li>")
        }), $(".t").click(function () {
            $(this).children("span").remove();
            var t = $(this).html();
            $(e).val(t), $(a).html("")
        })
    }) : $(a).html("")
}
$.ajaxSetup({headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")}});
var MIN_LENGTH = 3;

function showTab(e, t) {
    var a, s, n;
    for (s = document.getElementsByClassName("tabcontent"), a = 0; a < s.length; a++) s[a].style.display = "none";
    for (n = document.getElementsByClassName("tablinks"), a = 0; a < n.length; a++) n[a].className = n[a].className.replace(" active", "");
    document.getElementById(t).style.display = "block", e.currentTarget.className += " active"
}

function ShowEditModal(e) {
    $.facebox({ajax: "/profile/" + e})
}

function ShowModal(e, t) {
    $.facebox({ajax: "/block/" + e + "/" + t})
}

function ShowModalSend(e, t) {
    $.facebox({ajax: "/send/" + e + "/" + t})
}

function ShowSpecs(e, t) {
    $.facebox({ajax: "/spec/" + e + "/" + t})
}

function ShowEditModalCompany(e, t) {
    $.facebox({ajax: "/company-profile/" + e + "/" + t})
}

function ShowEditModalRESTfulCompany(e, t, a) {
    void 0 === a ? $.facebox({ajax: "/company-profile/" + e + "/" + t + "/create"}) : $.facebox({ajax: "/company-profile/" + e + "/" + t + "/" + a + "/edit"})
}

function ShowEditModalRESTful(e, t) {
    void 0 === t ? $.facebox({ajax: "/profile/" + e + "/create"}) : $.facebox({ajax: "/profile/" + e + "/" + t + "/edit"})
}

function ShowStoreModal(e) {
    $.facebox({ajax: "/profile/store/" + e})
}

function editSave(e, t, a, s) {
    $.post("/profile/" + e, s).done(function (e) {
        $(t).html(e.body), window.location = a, $("#facebox_overlay").click(), "" != e.message && $('<div class="alert alert-success" style="position: relative"><strong>تنبيه! </strong>' + e.message + "</div>").insertAfter(a).delay(2e3).fadeOut()
    })
}

function deleteRest(e, t, a, s) {
    var n = document.getElementById("loading").src;
    $("#facebox_overlay").click(), window.location = a, $(t + " .contpost").html(" <div class='loader'> <img src='" + n + "'/><span>الرجاء الإنتظار...</span></div>"), $.post("/profile/" + e, s).done(function (e) {
        $(t).html(e.body), window.location = a, "" != e.message && $('<div class="alert alert-danger fixed"><span>تنبيه! </span>' + e.message + "</div>").insertAfter(a).delay(2e3).fadeOut()
    })
}

function editSaveRest(e, t, a, s) {
    var n = document.getElementById("loading").src;
    $("#facebox_overlay").click(), window.location = a, $(t + " .contpost").html(" <div class='loader'> <img src='" + n + "'/><span>الرجاء الإنتظار...</span></div>"), $.post("/profile/" + e, s).done(function (e) {
        $(t).html(e.body), window.location = a, "" != e.message && $('<div class="alert alert-success" style="position: relative"><strong>تنبيه! </strong>' + e.message + "</div>").insertAfter(a).delay(2e3).fadeOut()
    })
}




function editSaveCompany(e, t, a, s) {
    var n = document.getElementById("loading").src;
    $("#facebox_overlay").click(), $(a + " .contpost").html(" <div class='loader'> <img src='" + n + "'/><span>الرجاء الإنتظار...</span></div>"), $.ajax({
        url: "/company-profile/" + t + "/" + e,
        type: "POST",
        data: s,
        contentType: !1,
        cache: !1,
        processData: !1,
        success: function (e) {
            $(a).html(e.body)
        }
    })
}

function editSaveImage(e, t, a, s) {
    var n = document.getElementById("loading").src;
    $("#facebox_overlay").click(), $(a + " .contpost").html(" <div class='loader'> <img src='" + n + "'/><span>الرجاء الإنتظار...</span></div>"), $.ajax({
        url: "/profile/" + e,
        type: "POST",
        data: s,
        contentType: !1,
        cache: !1,
        processData: !1,
        success: function (e) {
            $(a).html(e.body)
        }
    })
}

function deleteRestCompany(e, t, a, s, n) {
    var o = document.getElementById("loading").src;
    $("#facebox_overlay").click(), window.location = a, $(a).find(".contpost").html(" <div class='loader'> <img src='" + o + "'/><span>الرجاء الإنتظار...</span></div>"), null == s ? $.post("/company-profile/" + t + "/" + e, n).done(function (e) {
        $(a).html(e.body), window.location = a, "" != e.message && $('<div class="alert alert-danger fixed"><span>تنبيه! </span>' + e.message + "</div>").insertAfter(a).delay(2e3).fadeOut()
    }) : $.post("/company-profile/" + t + "/" + e + "/" + s, n).done(function (e) {
        $(a).html(e.body), window.location = a, "" != e.message && $('<div class="alert alert-danger fixed"><span>تنبيه! </span>' + e.message + "</div>").insertAfter(a).delay(2e3).fadeOut()
    })
}

function editSaveRestCompany(e, t, a, s) {
    var n = document.getElementById("loading").src;
    $("#facebox_overlay").click(), window.location = a, $(a + " .contpost").html(" <div class='loader'> <img src='" + n + "'/><span>الرجاء الإنتظار...</span></div>"), $.post("/company-profile/" + t + "/" + e, s).done(function (e) {
        $(a).html(e.body), window.location = a, "" != e.message && $('<div class="alert alert-danger"><strong>تنبيه! </strong>' + e.message + "</div>").insertAfter(a).delay(2e3).fadeOut()
    })
}

function exportPdf(e) {
    var t = document.getElementById("loading").src;
    $("myForm").html(" <div class='loader'> <img src='" + t + "'/><span>الرجاء الإنتظار...</span></div>"), $.get("/pdf/Abdr").done(function (e) {
    })
}

function sendBlock(e, t, a) {
    var s = document.getElementById("loading").src;
    $("#myForm").html(" <div class='loader'> <img src='" + s + "'/><span>الرجاء الإنتظار...</span></div>"), $.post("/block/" + e + "/" + t, a).done(function (e) {
        "" != e.message && $("#myForm").html('<div class="alert alert-warning" style="position: relative"><strong>تنبيه! </strong>' + e.message + "</div>"), setTimeout(function () {
            $("#facebox_overlay").click()
        }, 6e3)
    })
}

function confirmPay(e, t) {
    var a = document.getElementById("loading").src;
    $("#myForm").html(" <div class='loader'> <img src='" + a + "'/><span>الرجاء الإنتظار...</span></div>"), $.post("/profile/store/" + e, t).done(function (e) {
        "" != e.message && $("#myForm").html('<br><div class="alert alert-success" style="position: relative"><strong>تنبيه! </strong>' + e.message + "</div>"), setTimeout(function () {
            $("#facebox_overlay").click()
        }, 6e3)
    })
}


!function (e) {
    e.fn.delayKeyup = function (t, a) {
        var s = 0;
        return e(this).keyup(function () {
            clearTimeout(s), s = setTimeout(t, a)
        }), e(this)
    }
}(jQuery), $(document).ready(function () {
    $("#create").submit(function () {
        return $.post("/profile/edit-goal", $("#create").serialize(), function (e, t) {
            $("#goal").append(e)
        }), !1
    })
}), $(document).ready(function () {
    $("#keyword").delayKeyup(function () {
        this.stringHide = $("#stringHide").val();
        var e = "cv";
        switch (this.stringHide) {
            case"السير الذاتية":
                e = "cv";
                break;
            case"الوظائف":
                e = "job";
                break;
            case"الشركات":
                e = "company";
                break;
            default:
                e = "cv"
        }
        var t = $("#keyword").val();
        $("#stringHide").val(), t.length >= MIN_LENGTH ? ($("#s_l").removeClass("sh"), $.post("/", {
            keyword: t,
            stringHide: this.stringHide
        }).done(function (a) {
            $("#results").html(""), a.users.length > 0 ? ($.each(a.users, function () {
                $("#results").append('<li class="list-search"><a href="' + this.user_name + '"><img src="' + this.image + '">' + this.name + "</a></li>")
            }), a.users.length > 1 && $("#results").append('<li class="list-search"><a href="/' + e + "/search?string=" + t + '">عرض كل النتائج</a></li>')) : $("#results").append('<li class="list-search">لاتوجد نتائج</li>'), $(".item").click(function () {
                var e = $(this).html();
                $("#keyword").val(e)
            }), $("#s_l").addClass("sh")
        })) : $("#results").html("")
    }, 700), $("#keyword").blur(function () {
        $("#results").fadeOut(500)
    }).focus(function () {
        $("#results").show()
    })
});


function myFunction(e) {
    e = document.getElementById(e);
    for (var t = document.getElementsByClassName("dropdown-content"), a = 0; a < t.length; a++) {
        var o = t[a];
        o.classList.contains("show") && !e.classList.contains("show") && o.classList.remove("show")
    }
    e.classList.contains("show") ? e.classList.remove("show") : e.classList.toggle("show")
}

$('#myForm12').submit(function (e) {
    e.preventDefault();




    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#email').val();
    var password = $('#password').val();
    $.ajax({
        type: 'POST',
        url: '/register/main',
        data: {_token: CSRF_TOKEN, _method: 'POST', fname: fname, lname: lname, email: email, password: password},
        success: function (data) {
            if (data.check) {
                $('<div class="alert alert-success"><strong>تنبيه! </strong>' + data.message + '</div>').insertAfter('#password').delay(3000).fadeOut();
            } else {
                $('<div class="alert alert-danger"><strong>تنبيه! </strong>' + data.message + '</div>').insertAfter('#password').delay(3000).fadeOut();

            }
        },

        error: function () {
            $('<div class="alert alert-danger"><strong>تنبيه! </strong>حدث خطاء الرجاء المحاولة مرة أخري.</div>').insertAfter('#password').delay(3000).fadeOut();
        }

    });
});

$(".dropdown-toggle").click(function (e) {
    e.preventDefault(), e.stopPropagation(), $(this).closest(".search-dropdown").toggleClass("open")
}), $(".close").click(function () {
    $(".alert").hide()
}), jQuery("#searchPage .dropdown-menu > li > a").click(function (e) {
    e.preventDefault(), e.stopPropagation(), $(this).data("clicked", !0);
    var t = $(this);
    switch (t.closest(".search-dropdown").find(".toggle-active").html(t.html()), t.html()) {
        case"الوظائف":
            $("#keyword").attr("placeholder", "أبحث عن وظائف ...");
            break;
        case"السير الذاتية":
            $("#keyword").attr("placeholder", "أبحث عن اسم الباحث ...");
            break;
        case"الدورات":
            $("#keyword").attr("placeholder", "أبحث عن دورة ...");
            break;
        case"الشركات":
            $("#keyword").attr("placeholder", "أبحث عن اسم الشركة ...")
    }
    $("#keyword").val(""), $(".search-dropdown.open").removeClass("open"), $("#stringHide").val(t.html())
}), $("#dropdown-profile").click(function (e) {
    e.preventDefault(), e.stopPropagation()
}), $("#dropdown-lang").click(function (e) {
    e.preventDefault(), e.stopPropagation()
}), $("#dropdown-notification").click(function (e) {
    if (e.preventDefault(), e.stopPropagation(), 1 == $("#peta").text()) return $("#count").html(0), !1;
    50 != $("#count").text() && (setTimeout(function () {
        $("#count").html(0), $(".unread").each(function () {
            $(this).removeClass("unread")
        })
    }, 3e3), $.get("/profile/MarkAllSeen").done(function (e) {
        $("#myNotification").html(""), $("#peta").html(1), Object.keys(e).length > 0 && $.each(e.users, function () {
            var e = "<span><a class='cu'>" + this.data + "</a></span>";
            $("#myNotification").append(e)
        }), $("#myNotification").append("<span><a class='dani' href='/profile/notification'>مشاهدة كل الإشعارات</a></span>")
    }))
}), $("#keyword").click(function (e) {
    e.preventDefault(), e.stopPropagation()
}), $(".btn.btn-default.dropbtn").click(function (e) {
    e.preventDefault(), e.stopPropagation()

}), $(".navbar-toggle").click(function (e) {
    e.preventDefault(), e.stopPropagation();
    var t = document.getElementById("bs-example-navbar-collapse-1");
    t.classList.contains("collapse") ? $(".collapse.navbar-collapse").removeClass("collapse") : t.classList.toggle("collapse")
});
$("#bottom").click(function() {
    $('html,body').animate({
        scrollTop:0
    },600)
});

