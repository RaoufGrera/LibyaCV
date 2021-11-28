var orderCache = '';
var profileTemplatesObj = {};
var autoOptions = {};
var completenessScore = 0;
var firstRun = 1;
(function ($) {
    $.dimensions = {version: '@VERSION'};
    $.each(['Height', 'Width'], function (i, name) {
        $.fn['inner' + name] = function () {
            if (!this[0])return;
            var torl = name == 'Height' ? 'Top' : 'Left', borr = name == 'Height' ? 'Bottom' : 'Right';
            return this[name.toLowerCase()]() + num(this, 'padding' + torl) + num(this, 'padding' + borr);
        };
        $.fn['outer' + name] = function (options) {
            if (!this[0])return;
            var torl = name == 'Height' ? 'Top' : 'Left', borr = name == 'Height' ? 'Bottom' : 'Right';
            options = $.extend({margin: false}, options || {});
            return this[name.toLowerCase()]()
                + num(this, 'border' + torl + 'Width') + num(this, 'border' + borr + 'Width')
                + num(this, 'padding' + torl) + num(this, 'padding' + borr)
                + (options.margin ? (num(this, 'margin' + torl) + num(this, 'margin' + borr)) : 0);
        };
    });
    $.each(['Left', 'Top'], function (i, name) {
        $.fn['scroll' + name] = function (val) {
            if (!this[0])return;
            return val != undefined ? this.each(function () {
                this == window || this == document ? window.scrollTo(name == 'Left' ? val : $(window)['scrollLeft'](), name == 'Top' ? val : $(window)['scrollTop']()) : this['scroll' + name] = val;
            }) : this[0] == window || this[0] == document ? self[(name == 'Left' ? 'pageXOffset' : 'pageYOffset')] || $.boxModel && document.documentElement['scroll' + name] || document.body['scroll' + name] : this[0]['scroll' + name];
        };
    });
    $.fn.extend({
        position: function () {
            var left = 0, top = 0, elem = this[0], offset, parentOffset, offsetParent, results;
            if (elem) {
                offsetParent = this.offsetParent();
                offset = this.offset();
                parentOffset = offsetParent.offset();
                offset.top -= num(elem, 'marginTop');
                offset.left -= num(elem, 'marginLeft');
                parentOffset.top += num(offsetParent, 'borderTopWidth');
                parentOffset.left += num(offsetParent, 'borderLeftWidth');
                results = {top: offset.top - parentOffset.top, left: offset.left - parentOffset.left};
            }
            return results;
        }, offsetParent: function () {
            var offsetParent = this[0].offsetParent;
            while (offsetParent && (!/^body|html$/i.test(offsetParent.tagName) && $.css(offsetParent, 'position') == 'static'))
                offsetParent = offsetParent.offsetParent;
            return $(offsetParent);
        }
    });
    var num = function (el, prop) {
        return parseInt($.css(el.jquery ? el[0] : el, prop)) || 0;
    };
})(jQuery);
var spcNewJoinTemplate, spcStreamRecordsTemplate, spcStreamTemplate, peopleFollowRecordsTemplate, spcFollowListTemplate, customizeSpcFollowListTemplate, customizeSpcFollowRecordsTemplate, peopleFollowRecordsTemplate, questionsFollowRecordsTemplate, questionsFollowListTemplate, peopleFollowListTemplate, spcTopRankedSpecialistsTemplate, spcOtherSpecialistsTemplate, spcOtherSpecialistsRecordsTemplate;
var overlay = {
    hide: function () {
        $('#overlay, #overlayLoad').hide();
    }, show: function (parentID) {
        if (parentID == '' || typeof(parentID) == 'undefined') {
            return false;
        }
        var profileLeft = $('.profile-wrapper').offset().left;
        var profileWidth = $('.profile-wrapper').width();
        var parent = $('#' + String(parentID).replace('#', ''));
        $('#overlay').css({
            'top': parent.offset().top + 'px',
            'left': profileLeft + 'px',
            'width': profileWidth + 'px',
            'height': parent.height() + 'px'
        }).show();
        $('#overlayLoad').css({
            'top': parent.offset().top + 'px',
            'left': profileLeft + 'px',
            'width': profileWidth + 'px',
            'height': parent.height() + 'px'
        }).show().find('div').css('top', (parent.height() - 100) / 2 + 'px');
    }
};
function printCv(cvViewUrl) {
    mywindow = window.open(cvViewUrl, 'name', 'height=1100,width=850');
    mywindow.addEventListener("load", mywindow.print);
}
function downloadCvAsPdf(cvId, icode) {
    window.onbeforeunload = null;
    location.href = "/app/control/byt_emp_manager?byt_emp_stage=29&export_to=2&order_from=&cv_id_list=" + cvId + "&icode=" + icode;
}
function copy_cv_modal(cv_id, user_id, cv_name_value) {
    var copy_body_modal = '<div id="cv-copy-off" class="clear c"> \
  <h3>' + cvBuilderMessages.cvFormName + '</h3> \
  <p><input type="text" name="' + cv_name_value + '" value="' + cv_name_value + '" maxlength="100" id="cv-copy-name" class="req" style="width:50%;"></p> \
  </div>';
    baytModal.setModal("Copy CV", copy_body_modal, true, closeModal(), "");
    $("#modalpopup").css({"width": "450px"});
    $("#globalMWButtons").css({"width": "100%", "text-align": "center"});
    DrawModalInMiddle('#modalpopup');
    baytModal.postData("/app/control/byt_cv_manager.tcl", function () {
        var cv_file_name = $("input[id=cv-copy-name]").val();
        return {byt_cv_stage: 24, cv_id: cv_id, user_id: user_id, cv_file_name: cv_file_name};
    }, function (url) {
        window.location.href = url;
    });
}
function update_photo_modal() {
    baytModal.setModal(cvBuilderMessages.uploadFormTitle, "", true, closeModal(), "");
    $("#globalMWOk").hide();
    $("#globalMWCancel").hide();
    if (typeof uploadFormContentHtml == "undefined") {
        uploadFormContentHtml = $("#uploadForm").html();
        $("#uploadForm").remove();
    }
    $("#globalMW").append(uploadFormContentHtml);
    $("#modalpopup").css({"width": "860px"});
    DrawModalInMiddle('#modalpopup');
    $("#upload_file").change(function () {
        change_photo();
    });
}
function change_photo() {
    var upload_value = $("#upload_file").val();
    if ($.trim(upload_value) == "") {
        alert(useBrowseButton);
    } else {
        upload_origin_photo();
    }
    $("#upload_file").change(function () {
        change_photo();
    });
    return false;
}
function checkCoords() {
    if (document.getElementById("cropbox") != null) {
        $("#upload").css({"padding": "100px 0"});
        return true;
    }
    alert(cvBuilderMessages.cropRegionText);
    return false;
}
function showPreview(c) {
    $("#x_cord").val(c.x);
    $("#y_cord").val(c.y);
    $("#width").val(c.w);
    $("#height").val(c.h);
    var rx = 240 / c.w;
    var ry = 240 / c.h;
    var img_height = $("#cropbox").height();
    var img_width = $("#cropbox").width();
    $('#preview').css({
        width: Math.round(rx * img_width) + 'px',
        height: Math.round(ry * img_height) + 'px',
        marginLeft: '-' + Math.round(rx * c.x) + 'px',
        marginTop: '-' + Math.round(ry * c.y) + 'px'
    });
};function deletePhoto() {
    if (ConfirmDelete(cvBuilderMessages.deleteWarning)) {
        document.location.href = cvBuilderObj.deleteMangerUrl;
    }
}
function hidePreview() {
    $preview.stop().fadeOut('fast');
};function upload_origin_photo() {
    var hidden_fields = '<input type="hidden" name="byt_cv_stage" value="32" /><input type="hidden" name="cv_id" value=' + cvBuilderObj.cvId + ' />';
    $.ajaxFileUpload({
        url: '/app/control/byt_cv_manager.tcl',
        secureuri: false,
        fileElementId: 'upload_file',
        dataType: 'JSON',
        hidden_fields: hidden_fields,
        success: function (json_response, status) {
            var json_obj = eval(json_response);
            var json_obj = json_obj[0];
            if (json_obj.img_valid == 0) {
                $("#server_error_msg").html("<p id='server_msg_paragraph' class='alert'>" + json_obj.text + "</p>");
                $("#server_error_msg").show();
            } else {
                $("#server_error_msg").hide();
                var originalImgHeight = json_obj.height;
                var originalImgWidth = json_obj.width;
                var editImgWidth = json_obj.edit_width;
                var editImgHeight = json_obj.edit_height;
                var originalImgSize = json_obj.img_size;
                var originalImgExt = json_obj.file_ext;
                var originalImgtype = json_obj.file_type;
                if (originalImgSize > 3145728) {
                    alert(cvBuilderMessages.photoSizeLargeText);
                } else if (!(originalImgExt == "jpeg" || originalImgExt == "jpg" || originalImgExt == "gif")) {
                    alert(cvBuilderMessages.fileExtensionText);
                } else if (!(originalImgtype == "image/jpeg" || originalImgtype == "image/gif")) {
                    alert(cvBuilderMessages.invalidTypeText);
                } else {
                    if (originalImgHeight >= 400) {
                        var edit_height = "400";
                        var add_shift_p = 0;
                    } else if (originalImgHeight < 240) {
                        var edit_height = "240";
                        var add_shift_p = 1;
                    } else {
                        var edit_height = originalImgHeight;
                        var add_shift_p = 1;
                    }
                    var shift_top = (400 - edit_height) / 2;
                    if (originalImgWidth < 240) {
                        var edit_width = "240";
                        var y_coor = 0;
                        var x_coor = (Math.abs(edit_width - edit_height) / 2);
                    } else if (originalImgWidth > 500) {
                        var edit_width = 500;
                        var x_coor = (Math.abs(edit_width - edit_height) / 2);
                        var y_coor = 0;
                    } else {
                        var edit_width = originalImgWidth;
                        var x_coor = (Math.abs(edit_width - edit_height) / 2);
                        var y_coor = 0;
                    }
                    var oImg = document.createElement("img");
                    oImg.setAttribute('id', 'cropbox');
                    oImg.setAttribute('src', json_obj.img_src);
                    oImg.setAttribute('height', edit_height + 'px');
                    oImg.setAttribute('width', edit_width + 'px');
                    oImg.setAttribute('style', {"max-width": "100%"});
                    oImg.setAttribute('style', {"margin": "0 auto"});
                    $("#image_div").html(oImg);
                    $("#orginal_image_preview").addClass("l").css({"background": "#000"});
                    $("#image_div").css({"background": "#000", "margin": "0 auto"});
                    $("#image_preview").css({"background": "#000"}).show();
                    var image_scr = $("#cropbox").attr("src");
                    $("#original_image").val(image_scr);
                    $("#preview").attr("src", image_scr);
                    $("#cropbox").Jcrop({
                        onSelect: showPreview,
                        onChange: showPreview,
                        onRelease: hidePreview,
                        bgColor: 'black',
                        bgOpacity: 0.5,
                        aspectRatio: 1,
                        setSelect: [x_coor, y_coor, edit_width, edit_height],
                        minSize: [240, 240],
                        maxSize: [400, 400],
                        boxWidth: edit_width,
                        boxHeight: edit_height
                    });
                    $("body").append("<style>.jcrop-holder{top:" + shift_top + "px;} .jcrop-holder{margin:0px auto;} .jcrop-tracker{margin:0px auto;} #cropbox{width:edit_width}</style>");
                }
            }
        },
        error: function (data, status, e) {
            $("#server_error_msg").html(data);
            $("#server_error_msg").show();
        }
    });
}
function switch_tabs(activeTab) {
    if (activeTab == "upload") {
        $(".upload_tab_content").show();
        $(".guide_tab_content").hide();
    } else {
        $(".upload_tab_content").hide();
        $(".guide_tab_content").show();
    }
}
function drawCanvas(element, fontColor, stroke, strokeFill, radius, fontSize) {
    var canvasSupported = !!document.createElement("canvas").getContext;
    if (canvasSupported == false) {
        $('#noCanvas').show();
        return false;
    }
    var $canvas = $('#' + element);
    if (devProjects('new_jquery_upgrade') == 1) {
        var arcLen = $canvas[0].getAttribute("value");
    } else {
        var arcLen = $canvas.attr("value");
    }
    var percentage = arcLen;
    if (arcLen == 100) {
        percentage = 99.99;
    }
    var context2 = $canvas[0].getContext('2d');
    var context = $canvas[0].getContext('2d');
    var centerX = $canvas[0].width / 2;
    var centerY = $canvas[0].height / 2;
    var radius = radius;
    context2.beginPath();
    context2.arc(centerX, centerY, radius, 1.5 * Math.PI, (1.5 - ((arcLen == 0) ? 0.001 : (100 - percentage)) / 50) * Math.PI, false);
    context2.lineWidth = 5;
    context2.strokeStyle = stroke;
    context2.stroke();
    context.beginPath();
    context.arc(centerX, centerY, radius, 1.5 * Math.PI, (1.5 - (100 - percentage) / 50) * Math.PI, true);
    context.lineWidth = 5;
    context.strokeStyle = strokeFill;
    context.stroke();
    var context3 = $canvas[0].getContext('2d');
    var x = $canvas[0].width / 2;
    if ((typeof(navigator.msPointerEnabled) != 'undefined' || $.browser.msie) && $('body').attr('id') == 'ar')
        x = $canvas[0].width;
    var y = $canvas[0].height / 2;
    context3.font = 'normal normal bold ' + fontSize + 'px arial';
    context3.textAlign = 'center';
    context3.textBaseline = 'middle';
    context3.fillStyle = stroke;
    context3.fillText(arcLen + "%", x, y);
}
function getProfileBuilderSideBar(profileStrength, form) {
    newCompletenessScore = 0;
    $.baytPost('/app/control/byt_cv_manager.tcl', 'byt_cv_stage=39&cv_id=' + cvBuilderSidebarMessages.cvId + '&lang=' + cvBuilderSidebarMessages.language, function (response) {
        if (response != "" && !isWhitespace(response)) {
            $.each(response.recommendedSections, function (k, v) {
                text = response.recommendedSections[k].text.split(" %");
                response.recommendedSections[k].text = text[0];
                response.recommendedSections[k].textScore = text[1];
                response.recommendedSections[k].javascript = response.recommendedSections[k].javascript.replace("#tip_", "#");
                if (response.recommendedSections[k].section_name == "body") {
                    response.recommendedSections[k].javascript = "javascript:jQuery('#attachmentSection').click(); $('#tab-home').click();";
                }
                if (response.recommendedSections[k].section_name == "rec") {
                    response.recommendedSections[k].javascript = "javascript:getRecCheckProfile(cvBuilderSidebarMessages.language,cvBuilderSidebarMessages.close,cvBuilderSidebarMessages.askForRecommendationErrorMsg,cvBuilderSidebarMessages.askForRecommendation);; $('#tab-home').click();";
                }
            });
            if (devProjects('new_jquery_upgrade') == 1) {
                completenessScore = $('#profileStrength').attr("value");
            } else {
                completenessScore = $('#profileStrength').attr("value");
            }
            profileTemplatesObj.sidebar = TrimPath.parseDOMCommentTemplate("sidebarJST");
            var html = profileTemplatesObj.sidebar.process(response).toString();
            $("#sideBarValues").html(html);
            $("#sidebarJST").removeClass("hide");
            $("#fakeSideBar").remove();
            if ((cvBuilderObj.expVariation == 1 || cvBuilderObj.expVariation == 0) && lang == 'en') {
                if (response.completenessScore >= 50) {
                    setTimeout(function () {
                        drawCanvas('profileStrength', '#42c384', '#42c384', '#DADADA', 54, 26);
                    }, 200);
                }
                else {
                    setTimeout(function () {
                        drawCanvas('profileStrength', 'red', 'red', '#DADADA', 54, 26);
                    }, 200);
                }
                if (profileStrength !== undefined && form !== undefined) {
                    if (profileStrength < 50 && response.completenessScore >= 50) {
                        getGoogleAnalyticsEventTracker("profileBuilder", '50_completed');
                    }
                }
            }
            else {
                setTimeout(function () {
                    drawCanvas('profileStrength', '#42c384', '#42c384', '#DADADA', 54, 26);
                }, 200);
            }
            newCompletenessScore = response.completenessScore;
            if (completenessScore < 60 && newCompletenessScore >= 60 && !firstRun) {
                showCvEvaluationModal();
            }
            firstRun = 0;
        }
    }, function () {
    }, "json");
}
function editCVContent(delete_me, cvSection, xid, previewMode_p, delete_me, delete_me, completeness_p, delete_me, delete_me, delete_me, order_p, validate_p, section_cv_id) {
    if (completeness_p != 1) {
        var completeness_p = '0';
    }
    if (!xid) {
        var xid = '';
    }
    if (typeof page_body == "undefined" || page_body != "public_profile") {
        public_profile_p = 0;
    } else {
        public_profile_p = 1;
    }
    section = $('#' + cvSection).parents('.section_wrapper');
    $("#submit-alert-message").remove();
    overlay.show(String(section.attr('id')));
    section_id = "";
    if (cvSection.split("_").length > 1) {
        section_id = cvSection.split("_")[1];
        cvSection = "extra";
    }
    todo = ["replace_html"];
    if (validate_p) {
        todo.push("validate");
    }
    trigger_data = {cvSection: cvSection, section_id: section_id, todo: todo};
    $.baytMW("/app/sections/work/jseeker/cv/sections_builder", {
        cv_sections: cvSection,
        x_id: xid,
        preview_mode_p: previewMode_p,
        completeness_p: completeness_p,
        lang: document.body.id,
        order_p: order_p,
        public_profile_p: public_profile_p,
        section_id: section_id,
        section_cv_id: section_cv_id
    }, function (html) {
        trigger_data.html = html;
        overlay.hide(section.attr('id'));
        section.find('.acs-stage').html(html).fadeIn(300);
        section.find('.static-stage').hide();
    });
}
function refreshLastUpdateCV(cvId) {
    $.post("/app/control/byt_cv_manager.tcl", {byt_cv_stage: "10", cv_id: cvId}, function (html) {
        $("#refresh-cv-" + cvId).html(html);
        $("#refresh-cv-" + cvId).highlight("#FBC33E", 700, 400);
    });
}
function getRecCheckProfile(lang, close_button, error_msg, rec_text) {
    $('#globalMWOk').show();
    baytModal.setModal("", "", 0, closeModal(), "");
    var getRecUrl = "/" + lang + "/import-contacts/";
    baytModal.postData("/app/control/byt_people_profiles_manager.tcl", {byt_profile_stage: 9}, function (data, status) {
        var firstObj = data[0];
        switch (firstObj.status) {
            case"0":
                window.location = getRecUrl;
                break;
            case"2":
                baytModal.setModal("", firstObj.html_content, true, closeModal(), "");
                $('#globalMWCancel').text(close_button);
                $('#globalMWOk').hide();
                break;
            default:
                baytModal.setModal(rec_text, firstObj.html_content, true, closeModal(), "");
                $('#globalMWOk').text(firstObj.button_text);
                baytModal.postData("/app/control/byt_people_profiles_manager.tcl", function () {
                    var prof_nm = $("#modalpopup form input[name=modal_profile_name]").val();
                    var contact_me_var = 0;
                    if (devProjects('new_jquery_upgrade') == 1) {
                        if ($("#modalpopup form input[name=contact_me]:visible").prop('checked')) {
                            contact_me_var = 1;
                        }
                    } else {
                        if ($("#modalpopup form input[name=contact_me]:visible").attr('checked')) {
                            contact_me_var = 1;
                        }
                    }
                    return {byt_profile_stage: "6", opt_ckbox: "1", profile_name: prof_nm, contact_me: contact_me_var};
                }, function (resArr) {
                    var resObj = resArr[0];
                    if (resObj.status == 1) {
                        window.open(resObj.data, "", "Width=" + screen.width + ",Height=" + screen.height + ",scrollbars=yes", 0);
                        window.location = getRecUrl;
                    } else {
                        baytModal.setModal(rec_text, "<p id=\"server_msg_paragraph\" class=\"alert\">" + resObj.data + "</p>" + firstObj.html_content, true, closeModal(), "");
                        $('#globalMWOk').text(firstObj.button_text);
                    }
                }, function () {
                });
                break;
        }
    }, function () {
        $('#globalMWCancel').text(close_button);
        $('#globalMWOk').hide();
    });
}
function validate_video_link(video_url, video_description) {
    var exp = /^((http(s)?:\/\/youtube.com\/watch\?v=)[\w\-]{4,})|^((www.youtube.com\/watch\?v=)[\w\-]{4,})|^((http(s)?:\/\/www.youtube.com\/watch\?v=)[\w\-]{4,})/i;
    if (exp.test(video_url)) {
        if (video_description != "") {
            document.getElementById('errmssg_url').className = "hide";
            document.getElementById('errmssg_desc').className = "hide";
            return true;
        } else {
            document.getElementById('errmssg_desc').className = "";
            document.getElementById('errmssg_url').className = "hide";
            return false;
        }
    } else {
        document.getElementById('errmssg_url').className = "";
        document.getElementById('errmssg_desc').className = "hide";
        return false;
    }
}
function get_form_data(cvSection) {
    var form_data = $('#' + cvSection + '_form').serializeArray();
    $("#" + cvSection + "_form [disabled=disabled],#" + cvSection + "_form [disabled]").each(function () {
        form_data.push({name: $(this).attr("name"), value: $(this).val()});
    });
    if (typeof page_body != "undefined" && page_body == "public_profile") {
        form_data.push({name: "public_profile_p", value: 1});
    }
    return form_data;
}
function save_cv_section(cvSection) {
    var lang = document.body.id;
    if (formValidator(eval('document.' + cvSection + '_form'))) {
        if (cvSection == "per") {
            if ($("[name=mandatory_name_lang]").length) {
                if (lang == 'ar') {
                    var firstName = $("[name=first_name_ar]").val();
                    var lastName = $("[name=last_name_ar]").val();
                    if (firstName == '') {
                        var firstName = $("[name=first_name_la]").val();
                    }
                    if (lastName == '') {
                        var lastName = $("[name=last_name_la]").val();
                    }
                } else {
                    var firstName = $("[name=first_name_la]").val();
                    var lastName = $("[name=last_name_la]").val();
                    if (firstName == '') {
                        var firstName = $("[name=first_name_ar]").val();
                    }
                    if (lastName == '') {
                        var lastName = $("[name=last_name_ar]").val();
                    }
                }
                var fullName = firstName + " " + lastName;
            } else {
                var fullName = $("#first_name_input").val() + " " + $("#last_name_input").val();
            }
        }
        $("#cv-title-info h1").text(fullName);
        var form_data = get_form_data(cvSection);
        form_data.push({name: "section_cv_id", value: cvBuilderObj.cvId});
        $.ajax({
            type: "post",
            url: "/app/control/byt_new_cv_manager.tcl",
            data: form_data,
            timeout: 10000,
            error: function (xhr) {
                var showAlertBox = true;
                if (xhr.status == "400") {
                    if (typeof xhr.responseText === "string" && xhr.responseText.length > 0) {
                        baytModal.setModal('', xhr.responseText, true);
                        $("#globalMWOk").hide();
                        $("#globalMWCancel").click(function () {
                            window.location.reload();
                        }).text($("#globalMWOk").text());
                        showAlertBox = false;
                    }
                }
                if (showAlertBox) {
                    alert("An error occurred. Please try again later.");
                    location.reload();
                }
            },
            success: function (output) {
                html = output[0].html;
                todo = output[0].todo.split(" ");
                section_id = "";
                if (cvSection.split("_").length > 1) {
                    section_id = cvSection.split("_")[1];
                    cvSection = "extra";
                }
                trigger_data = {cvSection: cvSection, section_id: section_id, todo: todo, html: html};
                trigger_data.html = html;
                overlay.hide(section.attr('id'));
                section.find('.acs-stage').html(html).fadeIn(300);
                section.find('.static-stage > .cv-section-body').html(html);
                section.find('.static-stage .content-box').html(html);
                var cv_section = $('#cv-' + cvSection + '-section');
                var items = cv_section.find('.static-stage .section_item');
                if (items.length < 1) {
                    cv_section.find('.message-hint').removeClass('hide');
                } else {
                    if (!cv_section.find('.message-hint').hasClass('hide')) {
                        cv_section.find('.message-hint').addClass('hide');
                    }
                }
                getProfileBuilderSideBar();
            }
        });
        return true;
    } else {
        trigger_data = {cvSection: cvSection, section_id: section_id, todo: ["validate"]};
        $("body").trigger("cv/section-html", trigger_data);
        return false;
    }
}
function deleteCVContent(cvSection, xid, cvSectionFullName, msgBody, question_ids, el, container) {
    baytModal.setDeleteModal();
    if (typeof msgBody == "undefined") {
        msgBody = '';
    }
    if (msgBody != '') {
        $("#globalMWContent").html("<p class='alert'>" + msgBody + "</p>");
    }
    section_id = "";
    actual_cvSection = cvSection;
    if (actual_cvSection.split("_").length > 1) {
        section_id = actual_cvSection.split("_")[1];
        actual_cvSection = "extra";
    }
    $("#globalMWOk, #globalMWTitle").show();
    $("#globalMWOk").focus();
    var section_cv_id = cvBuilderObj.cvId;
    baytModal.postData("/app/control/byt_new_cv_manager.tcl", {
        section: actual_cvSection,
        x_id: xid,
        delete_p: "1",
        cv_section: cvSection,
        section_id: section_id,
        question_ids: question_ids,
        section_cv_id: section_cv_id
    }, function (output) {
        todo = output[0].todo;
        todo = todo.split(" ");
        trigger_data = {
            cvSection: cvSection,
            section_id: section_id,
            todo: todo,
            xid: xid,
            html: output[0].html,
            total_exp_html: output[0].total_exp_html
        };
        if (el.parents('.acs-stage').length > 0) {
            var elID = el.parents('.section_item').attr('id');
            el.parents('.row.section_item').remove();
            $('.static-stage').find('#' + elID).remove();
        } else {
            el.parents('.row.section_item').remove();
        }
        var itemCount = container.find('.section_item').length;
        if (itemCount < 1) {
            container.find('.message-hint').removeClass('hide');
            container.find('.acs-stage').hide();
            container.find('.static-stage').fadeIn(200);
        }
        $('#cv-completeness-score').load('/app/control/byt_cv_manager.tcl?byt_cv_stage=2');
    });
}
function deleteOriginalCVFile(cv_id, att_id, owner_id, file_name, attach_p, token) {
    if (ConfirmDelete()) {
        baytModal.setModal("", "", false);
        baytModal.postData("/app/control/byt_new_cv_manager", {
            section: 'att',
            action: 'delete',
            cv_id: cv_id,
            att_id: att_id,
            section_cv_id: cv_id,
            owner_id: owner_id,
            file_name: file_name,
            attach_p: attach_p,
            token: token
        }, function (data) {
            if (data == 1) {
                window.onbeforeunload = null;
                location.reload();
            }
        });
    }
}
function showReplaceModal() {
    baytModal.setModal(cvBuilderMessages.replaceCV, "<div id=\"replaceMsg\">" + cvBuilderMessages.replaceMsg + "</div>", true, closeModal(), '');
    $("#globalMWOk").text(cvBuilderMessages.uploadBttn);
    $("#modalpopup").css("width", "650");
    $("#globalMWButtons").css("width", "70%");
    $('#globalMWOk').addClass("prmt");
    $('#globalMWOk').addClass("replaceOk");
    $('#globalMWCancel').addClass("replaceCancel");
    $('#globalMWOk').click(function () {
        getAttachModal('not-used', '0', '', '');
        return false;
    });
}
function getAttachModal(obj, file_name, modaltitle, token) {
    var cv_id = cvBuilderObj.cvId;
    var att_id = 0;
    var owner_id = cvBuilderObj.userId;
    $.baytPost('/app/control/byt_cv_manager.tcl', 'byt_cv_stage=37&cv_id=' + cv_id + '&att_id=' + att_id + '&user_id=' + owner_id + '&file_name=' + file_name + '&modaltitle=' + modaltitle + '&lang=' + lang + '&add_js_delay=1', function (response) {
        if (response != "" && !isWhitespace(response)) {
            $.modal.close(true);
            baytModal.setModal("", "", false, function () {
                $.modal.close(true);
            });
            baytModal.setModal(modaltitle, response, true);
            baytModal.postData('/app/control/byt_new_cv_manager', function () {
                var cvBodyText = $.trim($("textarea[name=copy_paste_free_text]").val());
                return {
                    section: 'att',
                    action: 'update',
                    x_id: att_id,
                    cv_id: cv_id,
                    cv_body_text: cvBodyText,
                    att_id: att_id,
                    section_cv_id: cv_id,
                    owner_id: owner_id,
                    token: token,
                    file_name: file_name
                };
            }, function (data) {
                if (data == "1") {
                    window.onbeforeunload = null;
                    location.reload();
                }
            });
        }
    }, function () {
    }, "html");
    return false;
}
function checkHasWorkExperience(work_exp_flag) {
    if (work_exp_flag.value == 1) {
        $('#work_exp_details').removeClass("hide");
    } else {
        $('#work_exp_details').addClass("hide");
    }
}
function cv_experience_scripts() {
    $.getScript("/scripts/jquery.autocomplete.min.js", function () {
        if (typeof force_company_name_list != "undefined" && force_company_name_list.length > 0) {
            $("[name = 'company_name']").autocomplete(force_company_name_list, {
                autoFill: false,
                selectFirst: false,
                matchContains: true,
                minChars: 2,
                delay: 10,
                width: 320,
            });
        } else {
            $("[name=company_name]").autocomplete("/autocomp/quick-autocomplete.adp", {
                dataType: "json", extraParams: {
                    country: function () {
                        return $('#id-company_country').val();
                    }, lang: language, searchType: "companies:10", source: 'cv_expr'
                }, parse: function (data) {
                    data = data[0];
                    var searchObj = data.data;
                    if (searchObj == null)
                        searchObj = [];
                    isEntered = 0;
                    var rows = new Array();
                    for (var i = 0; i < searchObj.length; i++) {
                        rows[i] = {data: searchObj[i], value: searchObj[i].image, result: searchObj[i].text};
                    }
                    return rows;
                }, formatItem: function (row, i, n) {
                    var htmlElemet = '<span class="suggestion-image"><img src="' + row.image + '" alt="" /></span>';
                    htmlElemet += '<span class="suggestion-data">';
                    htmlElemet += '<span class="suggestion-title">' + row.text + '</span>';
                    htmlElemet += '<span>' + row.extra + '</span></span>';
                    return htmlElemet;
                }, selectFirst: true, minChars: 0, matchContains: true, width: 355, max: 10, cacheLength: 1
            }).result(function (event, item) {
                var companyName = item.text;
                $("#exp_form_company_id").val(item.classes);
                $(this).val(companyName);
                companyIsExist($(this));
            }).keypress(function (e) {
                if (e.keyCode == 13) {
                    if (isEntered != 1) {
                        companyIsExist($(this));
                    }
                    isEntered = 0;
                    return false;
                }
            });
            $("[name = 'company_name']").focusout(function () {
                var currentNode = $(this);
                var time = setTimeout(function () {
                    companyIsExist(currentNode);
                }, 500);
                currentNode.data("timeout", time);
            });
        }
    });
    if ($("select[name=end_month] option:selected").val() == "Present" || $("select[name=end_year] option:selected").val() == new Date().getFullYear()) {
        $("[id=share_salary_id]").show();
    } else {
        $("[id=share_salary_id]").hide();
    }
    checkPresent('end');
    $("select[name=end_month]").change(function () {
        if ($("select[name=end_month] option:selected").val() == "Present") {
            checkPresent('end');
            $("[id=share_salary_id]").show();
            $("select[name=end_year]").attr('class', 'hide');
            $("#uaeglp-present").hide();
        } else {
            $("select[name=end_year]").attr('class', 'req date');
            if ($("select[name=end_year] option:selected").val() == new Date().getFullYear()) {
                $("[id=share_salary_id]").show();
            } else {
                $("[id=share_salary_id]").hide();
            }
            $("select[name=end_year]").show();
            $("#uaeglp-present").show();
        }
    });
    $("select[name=end_year]").change(function () {
        if ($("select[name=end_year] option:selected").val() == new Date().getFullYear()) {
            $("[id=share_salary_id]").show();
        } else {
            $("[id=share_salary_id]").hide();
        }
    });
}
function isValidCompanyName(theString) {
    var emailFilter = /[0-9a-zA-Z!#$%&*+/=?^_`{|}~-]+([.][0-9a-zA-Z!#$%&*+/=?^_`{|}~-]+)*[]?@[]?((((([a-zA-Z0-9]{1}[a-zA-Z0-9-]{0,62}[a-zA-Z0-9]{1})|[a-zA-Z])[.])+[a-zA-Z]{2,6})|(\d{1,3}[.]){3}\d{1,3}(:\d{1,5})?)/g;
    var urlFilter = /(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/g;
    var phoneFilter = /(\+\d)*\s*(\(\d{2,4}\)\s*)*\d{2,4}(-{0,1}|\s{0,1})\d{2,4}(-{0,1}|\s{0,1})\d{2,4}(-{0,1}|\s{0,1})\d{2,4}/g;
    if (theString != "" && (emailFilter.test(theString) || urlFilter.test(theString) || phoneFilter.test(theString))) {
        return false
    }
    return true;
}
function companyIsExist(elem) {
    companyName = $(elem).val();
    companyName = $.trim(removeHtmlTags(companyName));
    companyName = companyName.replace(/[^\u0600-\u06ff \u00E0-\u00FC \w\s#@&.+-]/g, '');
    $("#experienceForm_company_em_").html("");
    if (!isValidCompanyName(companyName)) {
        var lang = document.body.id;
        switch (lang) {
            case"ar":
                var errMessage = "لا يجب أن يحتوي إسم الشركة على أي معلومة اتصال";
                break;
            case"fr":
                var errMessage = "Le Nom de la Société ne doit contenir aucune information de contact";
                break;
            default:
                var errMessage = "Company name must not contain contact information";
        }
        $("#experienceForm_company_em_").html(errMessage);
    } else if (!isWhitespace(companyName)) {
        $.baytMW("/app/control/byt_company_manager.tcl", {action: 5, company_name: companyName}, function (results) {
            if (results != 1) {
                var modalBody = $("#add-company-modal [name=body]").html().replace(/%COMPANY/g, companyName);
                var modalTitle = $("#add-company-modal [name=title]").html().replace(/%COMPANY/g, companyName);
                var modalButtonText = $("#add-company-modal #company-sumbit-text").text();
                baytModal.setModal(modalTitle, modalBody, true, closeModal(), null);
                $('#globalMWOk').text(modalButtonText);
                baytModal.postData('/app/control/byt_company_manager.tcl', function () {
                    var formDom = $("[name=baytModalForm]");
                    var companyIndustry = $(formDom).find("[name='companyIndInPopUp']").val();
                    var companyLocation = formDom.find("[name='countryInPopUp']").val();
                    return {
                        action: 6,
                        company_name: companyName,
                        company_industry: companyIndustry,
                        company_location: companyLocation
                    };
                }, function (data) {
                    baytModal.setModal(modalTitle, modalBody, true, closeModal());
                    if (data.status == true) {
                        $("[name=baytModalForm]").remove();
                        $("#globalMWTitle").after(data.msg);
                        modalShowClose();
                        $("#exp_form_company_id").val(data.companyId);
                    } else {
                        $("#globalMWMessage").html(data.msg);
                        $('#globalMWOk').text(modalButtonText);
                    }
                }, function (data) {
                    var message = '<p class="alert"><strong>Error:</strong> Sorry, an error occurred.</p>';
                    baytModal.setModal("Error", message, true, closeModal());
                    modalShowClose();
                }, "", 0);
            }
        });
    }
}
function saveMarket() {
    var lang = document.body.id;
    if (formValidator(document.exp_market_form, lang, 'professional-experience')) {
        multiToggle('preview_total_exp', 'detail_total_exp');
        var expYears = parseInt($("select[name=detail_exp_years]").val()), expMonths = parseInt($("select[name=detail_exp_months]").val()), total_months = 12 * expYears + expMonths;
        $.baytMW("/app/control/byt_new_cv_manager.tcl", {
            section: "additional_experience",
            section_cv_id: cvBuilderObj.cvId,
            total_months: total_months
        }, function (html) {
            $("#preview_exp_years").text(expYears);
            $("#preview_exp_months").text(expMonths);
            if (expYears == 0 && expMonths == 0) {
                $("#preview_exp_years").parent().hide();
                $("#no_additional_exp").show();
            } else {
                $("#preview_exp_years").parent().show();
                $("#no_additional_exp").hide();
            }
            $("#header_total_exp").text(html)
        });
        return true;
    } else {
        $("#submit-alert-message").remove();
        return false;
    }
}
function show_cert_modal() {
    baytModal.setModal("", $("#test_cert_modal").html(), true, closeModal(), "");
    $("#globalMWCancel, #globalMWOk, #globalMWTitle").hide();
    $("#modalpopup").css("width", "730");
    $('.modalcloseimg').click(function () {
        location.href = window.location.pathname;
    });
}
function show_cert_item(certObj) {
    var html = viewCertModalTemplate.process({
        exam_test_name: certObj.exam_test_name,
        score: certObj.score,
        date_completed: certObj.date_completed,
        answer_id: certObj.answer_id,
        shareUrl: certObj.shareUrl,
    });
    baytModal.setModal("", html, true, closeModal(), "");
    $("#globalMWCancel, #globalMWOk, #globalMWTitle").hide();
    $('.modalClose').show();
}
function download_pdf_cert(ansr_id) {
    window.open("/app/control/online_exams_manager.tcl?exam_stage=download_pdf_cert&cert_answer_id=" + ansr_id, '_blank');
    location.href = window.location.pathname;
}
function show_course_cert_item(courseCertObj) {
    var html = viewCourseCertModalTemplate.process({
        course_id: courseCertObj.course_id,
        full_name: courseCertObj.full_name,
        course_name: courseCertObj.course_name,
        company_logo: courseCertObj.company_logo,
        company_name: courseCertObj.company_name,
    });
    baytModal.setModal("", html, true, closeModal(), "");
    $("#globalMWCancel, #globalMWOk, #globalMWTitle").hide();
    $('.modalClose').show();
}
function download_course_pdf_cert(course_id) {
    window.open("/app/control/online_exams_manager.tcl?exam_stage=download_course_pdf_cert&crt_course_id=" + course_id, '_blank');
    location.href = window.location.pathname;
}
function toggle_bayt_test_publish(action, ansr_id, test_id) {
    $("#publish_btn_" + ansr_id).append("<img  src='/images/icons/loading.gif' alt='Loading' class='legend-box hide' style='display: inline;'>");
    $.baytPost("/app/control/online_exams_manager.tcl", {
        exam_stage: action,
        answer_id: ansr_id,
        byt_exam_id: test_id
    }, function (result) {
        var status = result.status;
        if (status == "done") {
            location.href = window.location.pathname + "/?cert_answer_id=" + ansr_id;
        } else if (status == "redirect") {
            location.href = result.url;
        } else {
            alert("An error acquired!");
        }
    });
}
function initProfileBuilderSidebar() {
    var sideBar = $('#newSidebar');
    var footer = $('#footer-wrapper');
    $(window).on('scroll', function () {
        var sideWrapper = $('#sidebarWrapper');
        var box = sideWrapper.height() + 50;
        if ($(window).scrollTop() >= sideBar.offset().top) {
            if ((($(window).scrollTop() + box)) >= (footer.offset().top)) {
                return false;
            }
            sideWrapper.css({'position': 'absolute'});
        } else {
            sideWrapper.css('position', 'static');
        }
        sideWrapper.css({'top': ($(window).scrollTop() - (sideBar.offset().top - 20)) + 'px'});
    });
    drawCanvas('fakeProfileStrength', '#42c384', '#42c384', '#DADADA', 54, 26);
    getProfileBuilderSideBar();
    $('.section-title').on('click', 'a.add_link', function (e) {
        e.preventDefault();
        e.stopPropagation();
        action = "add";
        var $action = $(this);
        cvSection = $action.attr('id');
        editCVContent('', cvSection, '', '0', 1, '', '', 0, 0, 0, 0, 1, cvBuilderObj.cvId);
    });
    $('.static-stage').on('click', '.add_link', function (e) {
        e.preventDefault();
        e.stopPropagation();
        action = "add";
        var $action = $(this);
        cvSection = $action.data('id');
        editCVContent('', cvSection, '', '0', 1, '', '', 0, 0, 0, 0, 1, cvBuilderObj.cvId);
    });
    $('.section-title').on('click', 'a.edit_link', function (e) {
        e.preventDefault();
        e.stopPropagation();
        action = "edit";
        var $action = $(this);
        cvSection = $action.attr('id');
        editCVContent('', cvSection, '', '0', 1, '', '', 0, 0, 0, 0, 1, cvBuilderObj.cvId);
    });
    $(".section-content").on("click", '.inner_edit_link', function (e) {
        e.preventDefault();
        e.stopPropagation();
        action = "edit";
        var $el = $(this);
        cvSection = $el.data('section');
        xid = $el.data('id');
        $('body,html').stop().animate({scrollTop: $el.parents('.section_wrapper').offset().top}, 200);
        editCVContent('', cvSection, xid, '0', 1, '', '', 0, 0, 0, 0, 1, cvBuilderObj.cvId);
    });
    $(".section-content").on("click", '.inner_delete_link', function (e) {
        e.preventDefault();
        e.stopPropagation();
        action = "delete";
        action = "delete";
        var $el = $(this);
        cvSection = $el.data('section');
        xid = $el.data('id');
        question_ids = [];
        var container = $el.parents('.section-content');
        $el.parents(".section_item").find(".ques").each(function () {
            question_ids.push($(this).attr("id").split("-")[1]);
        });
        deleteCVContent(cvSection, xid, "", "", question_ids.join(","), $el, container);
    });
    $(".section-content").on("click", ".save_button", function (e) {
        e.preventDefault();
        e.stopPropagation();
        action = "save";
        var $el = $(this);
        var container = $el.parents('.section-content');
        var cvSection = $(this).parents('.section_wrapper').attr('id').split("-")[1];
        if (navigator.appName == "Microsoft Internet Explorer") {
            window.onbeforeunload = null;
        }
        var continue_flag_p = 1;
        if (cvSection == "per") {
            visaValidation();
            if ($("[name=default_f_name]").length && $("[name=default_l_name]").length) {
                clearText($("[name=first_name_la]"), 'mute', $("[name=default_f_name]").val());
                clearText($("[name=first_name_ar]"), 'mute', $("[name=default_f_name]").val());
                clearText($("[name=last_name_ar]"), 'mute', $("[name=default_l_name]").val());
                clearText($("[name=last_name_la]"), 'mute', $("[name=default_l_name]").val());
            }
        }
        if (cvSection == "con") {
            var prev_email = $("[name=prev_email]").val();
            var current_email = $("[name=e_mail]").val();
            if (prev_email != current_email && !isWhitespace($("[name=msg_text]").val())) {
                var continue_flag_p = 0;
                baytModal.setModal($("[name=title_text]").val(), $("[name=msg_text]").val(), true, closeModal(), "");
                if (devProjects('new_jquery_upgrade') == 1) {
                    $(document).on("click", '#globalMWOk', function () {
                        var success = save_cv_section(cvSection, 1);
                    });
                } else {
                    $('#globalMWOk').live("click", function () {
                        var success = save_cv_section(cvSection, 1);
                    });
                }
            } else {
                var continue_flag_p = 1;
            }
        }
        var itemCount = container.find('.section_item').length;
        if (continue_flag_p == 1) {
            save_cv_section(cvSection, 1);
        }
    });
    $('.acs-stage').on('click', '.cancel_button', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var cancelBtn = $(this);
        var wrapper = cancelBtn.parents('.section_wrapper');
        wrapper.find('.acs-stage').hide();
        wrapper.find('.static-stage').fadeIn(300);
    });
    $('#attachmentSection').on('click', function (e) {
        e.preventDefault();
        var $a = $(this);
        getAttachModal($a, '0', '');
    });
    $('body').on('mouseover', '#jsMyCvsDropDownList', function (e) {
        $('#jsCvsLiList').show();
    }).on('mouseleave', '#jsMyCvsDropDownList', function () {
        $('#jsCvsLiList').hide();
    });
    $(".order_link").on('click', function (e) {
        e.preventDefault();
        console.log("1");
        var a = $(this);
        if ($('#cv-skl-section .acs-stage .section_item').length > 0) {
            var newData = $('.acs-stage .section-content').html();
            $('#cv-skl-section .acs-stage').html('');
            $('#cv-skl-section .static-stage').show().find('#profileSkills .content-box').html(newData).show();
        }
        if ($('#profileSkills .ui-sortable').length < 1) {
            orderCache = $('#profileSkills').html();
            console.log("2");
        }
        cv_section_id = "#cv-" + a.data('id') + "-section";
        $(cv_section_id + " .sort").addClass("sortable");
        $(cv_section_id + " .order").show();
        $(cv_section_id + " .sortable").sortable({
            cursor: "crosshair",
            containment: 'parent',
            tolerance: 'pointer',
            scroll: false
        });
        console.log("3");
        $(cv_section_id + " .sort .section_item").addClass("order_dots_large bottom_border");
        $(cv_section_id + " .sort .i_16_wrapper").hide();
    });
    $('#profileSkills').on('click', '.cancel-order', function (e) {
        e.preventDefault();
        $('#profileSkills').html(orderCache);
    });
    $('#profileSkills').on("click", "#save_order_button", function (e) {
        e.preventDefault();
        action = "reorder";
        var el = $(this);
        var i = 0;
        var cv_section = 'skl';
        var ordered_ids = new Array();
        var cv_section_id = "#cv-" + cv_section + "-section";
        $(cv_section_id + " .sort .section_item").each(function () {
            ordered_ids[i] = $(this).attr("id").split("-")[2];
            i++;
        });
        var question_ids = [];
        $(cv_section_id + " .skill").each(function () {
            q_id = $(this).attr("id").split("-")[1];
            question_ids.push(q_id);
        });
        cvSection = 'cv';
        section_id = "";
        ordered_ids = ordered_ids.join(" ");
        question_ids = question_ids.join(" ")
        data = {
            section: cv_section + "-",
            section_id: '',
            action: "reorder",
            ordered_ids: ordered_ids,
            question_ids: question_ids,
            section_cv_id: cvBuilderObj.cvId
        }
        $.post("/app/control/byt_new_cv_manager.tcl", data, function (output) {
            $.modal.impl.close(true);
            trigger_data = {
                cvSection: cvSection,
                section_id: section_id,
                html: output[0].html,
                todo: output[0].todo.split(" ")
            }
            $('#profileSkills').find('.order').hide();
        });
        return 0;
    });
    $('body').on('change', '#experienceForm_endMonth', function () {
        checkPresentNew();
    });
    $('body').on('change', '#trainingForm_certEndMonth', function () {
        checkOpenCert();
    });
    $('body').on('change', 'input:radio[name="trainingForm[isCertificate]"]:checked', function () {
        showHideTrnCert();
    }).on('change', '#EducationForm_educationCountry', function () {
        var iso = $("#EducationForm_educationCountry").val();
        if (iso != undefined && iso) {
            getCitiesNew(iso, "EducationForm_educationCity", "educationCountryLoading", "showHideEduCityField");
        } else if (iso == undefined) {
            iso = "";
            getCitiesNew("");
        }
    }).on('click', '.profile-tabs li a', function (e) {
        var a = $(this);
        if (a.attr('id') == 'profileTab') {
            $('#profileWrapper').removeClass('hide');
            $('#tabsWrapper').addClass('hide');
        } else {
            $('#profileWrapper').addClass('hide');
            $('#tabsWrapper').removeClass('hide');
        }
        $('.profile-tabs li a').removeClass('active');
        a.addClass('active');
    });
    if (cvBuilderObj.showCvEvaluationModal == 1) {
        showCvEvaluationModal();
    }
    spcNewJoinTemplate = TrimPath.parseDOMCommentTemplate("spc_newjoin_template");
    spcStreamRecordsTemplate = TrimPath.parseDOMCommentTemplate("spc_stream_records_template");
    spcStreamTemplate = TrimPath.parseDOMCommentTemplate("spc_stream_template");
    spcFollowListTemplate = TrimPath.parseDOMCommentTemplate("spc_follow_listing_template");
    customizeSpcFollowListTemplate = TrimPath.parseDOMCommentTemplate("customize_spc_follow_list_template");
    customizeSpcFollowRecordsTemplate = TrimPath.parseDOMCommentTemplate("customize_spc_follow_records_template");
    peopleFollowRecordsTemplate = TrimPath.parseDOMCommentTemplate("people_follow_records_template");
    questionsFollowRecordsTemplate = TrimPath.parseDOMCommentTemplate("questions_follow_records_template");
    questionsFollowListTemplate = TrimPath.parseDOMCommentTemplate("questions_follow_listing_template");
    peopleFollowListTemplate = TrimPath.parseDOMCommentTemplate("people_follow_listing_template");
    spcTopRankedSpecialistsTemplate = TrimPath.parseDOMCommentTemplate("spc_top_ranked_specialists");
    spcOtherSpecialistsTemplate = TrimPath.parseDOMCommentTemplate("spc_other_specialists");
    spcOtherSpecialistsRecordsTemplate = TrimPath.parseDOMCommentTemplate("spc_other_specialists_records");
}
function showEditFormMode(formName, itemId, obj) {
    var parent = '';
    if (typeof obj === "object") {
        parent = $(obj).parents('.section_wrapper').attr('id');
        overlay.show(parent);
    } else {
        parent = $('#' + formName).parents('.section_wrapper').attr('id');
        overlay.show(parent);
    }
    if (formName != "") {
        if (typeof itemId == "undefined" || itemId == '') {
            var data = {formName: formName, cv_id: cvBuilderObj.cvId, lang: lang};
        } else {
            var data = {formName: formName, cv_id: cvBuilderObj.cvId, itemId: itemId, lang: lang};
        }
        $.ajax({
            method: "get",
            url: cvBuilderObj.ajaxGetEditFormsUrl,
            data: data,
            cache: false,
            crossDomain: false,
            dataType: "json",
            beforeSend: function () {
            }
        }).done(function (response) {
            if (response.action == 'reload')
                window.location.reload(); else {
                $("#" + formName).find('.acs-stage').html(response.data);
                $("#" + formName).find('.acs-stage').show();
                $("#" + formName).find('.static-stage').hide();
                if (formName == "experience") {
                    checkCompanyName();
                    showHideExpOptions(response.hasExperience);
                    $("#experienceForm_startYear").after(dateFieldToolTip);
                    $("#experienceForm_company").after(compNameFieldToolTip);
                    $("#experienceForm_companyInd").after(compIndFieldToolTip);
                    $("#experienceForm_jobRole").after(jobRoleFieldToolTip);
                    $("#experienceForm_jobTitle").after(jobTitleFieldToolTip);
                    $("#experienceForm_workDesc").after(workDescFieldToolTip);
                }
                if (formName == "training") {
                    showHideTrnCert();
                    checkOpenCert();
                }
            }
            overlay.hide();
        }).error(function () {
            alert('error occured !');
            overlay.hide();
        });
    }
    return false;
}
function showMobileNumberConfirmationModal() {
    $.ajax({
        method: "post",
        url: cvBuilderObj.ajaxGetMobileConfirmationUrl,
        data: {lang: cvBuilderObj.lang},
        cache: false,
        crossDomain: false,
        dataType: "json",
        beforeSend: function () {
        }
    }).done(function (response) {
        baytModal.setModal('', response.data, true, closeModal());
        $("#modalpopup").css({"width": "645px"});
        $('#globalMWOk').hide();
        $('#globalMWCancel').hide();
        $(".modalcloseimg").show();
    }).error(function () {
        return false;
    });
    return false;
}
function resendConfirmationNumber() {
    $.ajax({
        method: "post",
        url: cvBuilderObj.ajaxSendConfirmationMobileNumber,
        data: {lang: cvBuilderObj.lang},
        cache: false,
        crossDomain: false,
        dataType: "json",
        beforeSend: function () {
        }
    }).done(function (response) {
        if (response.sent == 0) {
            $(".exceededLimit").removeClass('success').addClass('alert').html("<strong>" + response.errorMessage + "</strong>");
        } else {
            $(".resend-code").html(resendConfirmationMsg);
            $(".exceededLimit").removeClass('alert').addClass('success').html("<strong>Confirmation code has been sent to your mobile number!</strong>");
        }
    }).error(function () {
        return false;
    });
}
function afterValidateMobileConfirm(form, data, hasError) {
    switch (lang) {
        case"ar":
            var btnSaveText = "Confirm";
            var btnSavingText = "Confirming...";
            break;
        case"fr":
            var btnSaveText = "Confirm";
            var btnSavingText = "Confirming...";
            break;
        default:
            var btnSaveText = "Confirm";
            var btnSavingText = "Confirming...";
    }
    if (!hasError) {
        $(form).find('button[type=submit]').addClass('aux');
        $(form).find('button[type=submit]').text(btnSavingText);
        var resObjData = $(form).serialize() + "&submit=submit";
        var formName = $(form).attr('name');
        $.baytPost($(form).attr('action'), resObjData, function (response) {
            if (response.hasErrors) {
                baytModal.setModal('', response.data, true, closeModal());
                $("#modalpopup").css({"width": "645px"});
                $('#globalMWOk').hide();
                $('#globalMWCancel').hide();
                $(".modalcloseimg").show();
                $(form).find('button[type=submit]').removeAttr('disabled');
                $(form).find('button[type=submit]').removeClass('aux');
                $(form).find('button[type=submit]').text(btnSaveText);
                var errSummary = $('div.errorSummary');
                if (errSummary.is(":visible")) {
                    errSummary.prepend('<span class="icon"></span>').addClass('alertbox').addClass('alert');
                    $('div.errorSummary > p').html(errorSummaryMessage);
                    $('div.errorSummary > ul').remove();
                }
            } else {
                location.href = window.location.pathname;
            }
        }, function () {
            baytModal.setModal('Error', 'error', true, closeModal());
        });
        return false;
    } else {
        $(form).find('button[type=submit]').removeAttr('disabled');
        $(form).find('button[type=submit]').removeClass('aux');
        $(form).find('button[type=submit]').text(btnSaveText);
        var errSummary = $('div.errorSummary');
        if (errSummary.is(":visible")) {
            errSummary.prepend('<span class="icon"></span>').addClass('alertbox').addClass('alert');
            $('div.errorSummary > p').html(errorSummaryMessage);
            $('div.errorSummary > ul').remove();
            form.scrollTo(2000);
        }
    }
}
function checkCompanyName() {
    $("[name='experienceForm[company]']").autocomplete("/autocomp/quick-autocomplete.adp", {
        dataType: "json", extraParams: {
            country: function () {
                return $('#id-expHaCountryCode').val();
            }, lang: language, searchType: "companies:10", source: 'cv_expr'
        }, parse: function (data) {
            data = data[0];
            var searchObj = data.data;
            if (searchObj == null)
                searchObj = [];
            isEntered = 0;
            var rows = new Array();
            for (var i = 0; i < searchObj.length; i++) {
                rows[i] = {data: searchObj[i], value: searchObj[i].image, result: searchObj[i].text};
            }
            return rows;
        }, formatItem: function (row, i, n) {
            var htmlElemet = '<span class="suggestion-image"><img src="' + row.image + '" alt="" /></span>';
            htmlElemet += '<span class="suggestion-data">';
            htmlElemet += '<span class="suggestion-title">' + row.text + '</span>';
            htmlElemet += '<span>' + row.extra + '</span></span>';
            return htmlElemet;
        }, selectFirst: true, minChars: 0, matchContains: true, width: 355, max: 10, cacheLength: 1
    }).result(function (event, item) {
        var companyName = item.text;
        $("#exp_form_company_id").val(item.classes);
        $(this).val(companyName);
        companyIsExist($(this));
    }).keypress(function (e) {
        if (e.keyCode == 13) {
            if (isEntered != 1) {
                companyIsExist($(this));
            }
            isEntered = 0;
            return false;
        }
    });
    $("[name='experienceForm[company]']").focusout(function () {
        var currentNode = $(this);
        var time = setTimeout(function () {
            companyIsExist(currentNode);
        }, 500);
        currentNode.data("timeout", time);
    });
}
function showHideExpOptions(expStatus) {
    if (expStatus == 0) {
        if (devProjects('new_jquery_upgrade') == 1) {
            $('#experienceForm_hasExperience_0').prop('checked', true);
        } else {
            $('#experienceForm_hasExperience_0').attr('checked', true);
        }
        $("#show_exp_flag").removeClass("hide");
    }
    else
        $("#show_exp_flag").addClass("hide");
    if ($("select[name='experienceForm[endMonth]'] option:selected").val() == "9999" && $("#targetJob div.info-value.l").last().html().length > 0) {
        $("[id=work_exp_details] .inline-checkbox").show();
    } else {
        $("[id=work_exp_details] .inline-checkbox").hide();
    }
    checkPresentNew();
    showHideCityField();
}
function cancleEditFormMode(formName) {
    if (formName != "") {
        $("#" + formName).find('.static-stage').show();
        $("#" + formName).find('.acs-stage').empty();
    }
    return false;
}
function afterValidate(form, data, hasError) {
    switch (lang) {
        case"ar":
            var btnSaveText = "احفظ";
            var btnSavingText = "جاري الحفظ...";
            break;
        case"fr":
            var btnSaveText = "Enregistrer";
            var btnSavingText = "Enregistrement...";
            break;
        default:
            var btnSaveText = "Save";
            var btnSavingText = "Saving...";
    }
    if (!hasError) {
        $(form).find('button[type=submit]').addClass('aux');
        $(form).find('button[type=submit]').text(btnSavingText);
        var resObjData = $(form).serialize() + "&submit=submit";
        var formName = $(form).attr('name');
        parent = $('#' + formName).parents('.section_wrapper').attr('id');
        if (typeof parent === "string")
            overlay.show(parent);
        $("#overlay").css(({"display": "block"}));
        $("#overlay").css(({"height": "100%"}));
        $("#overlayLoad").css(({"display": "block"}));
        $.baytPost($(form).attr('action'), resObjData, function (response) {
            if (response.hasErrors) {
                overlay.show(parent);
                $("#" + formName).find('.acs-stage').html(response.data).show();
                if (formName == "languagesProfile") {
                    $("#languagesProfileForm_languages").parent().toggleClass("errorMessage");
                }
            } else {
                $("#" + formName).find('.static-stage').html(response.data).show();
                $("#" + formName).find('.acs-stage').empty();
                if (formName == "video") {
                    $("#vid_add").hide();
                    $("#vid_edit").show();
                    $("#vid_edit").attr("onclick", "showEditFormMode('video','" + response.videoId + "');");
                }
                $("#busniessCardInfo").html("<div class=\"row\">" + response.busniessCard + "</div>");
            }
            if (devProjects('new_jquery_upgrade') == 1) {
                getProfileBuilderSideBar($('#profileStrength').attr("value"), form);
            } else {
                getProfileBuilderSideBar($('#profileStrength').attr("value"), form);
            }
            overlay.hide();
        }, function () {
            baytModal.setModal('Error', 'error', true, closeModal());
            overlay.hide();
        });
        return false;
    } else {
        $(form).find('button[type=submit]').removeAttr('disabled');
        $(form).find('button[type=submit]').removeClass('aux');
        $(form).find('button[type=submit]').text(btnSaveText);
        var errSummary = $('div.errorSummary');
        if (errSummary.is(":visible")) {
            errSummary.prepend('<span class="icon"></span>').addClass('alertbox').addClass('alert');
            $('div.errorSummary > p').html(errorSummaryMessage);
            $('div.errorSummary > ul').remove();
            form.scrollTo(2000);
        }
    }
}
function deleteValuesSection(formName, itemId) {
    baytModal.setDeleteModal();
    var data = {formName: formName, cv_id: cvBuilderObj.cvId, itemId: itemId, lang: lang};
    baytModal.postData(cvBuilderObj.ajaxGetDeleteUrl, data, function (response) {
        if (response.action == 'reload') {
            window.location.reload();
        } else {
            $("#" + formName).find('.static-stage').html(response.data).show();
            $("#" + formName).find('.acs-stage').empty();
            if (formName == "video") {
                $("#vid_add").show();
                $("#vid_edit").hide();
            }
            getProfileBuilderSideBar();
            $("#busniessCardInfo").html("<div class=\"row\">" + response.busniessCard + "</div>");
        }
    });
}
function SaveSkillDisplayOrder(skillIdsAsBeOrder) {
    $.baytPost("/app/control/byt_new_cv_manager.tcl", {
        section: 'skl',
        action: 'reorder',
        ordered_ids: skillIdsAsBeOrder,
        section_cv_id: cvBuilderObj.cvId,
    }, function (result) {
    });
}
function checkPresentNew() {
    if ($("#experienceForm_endMonth option:selected").val() == "9999") {
        $(".onOff").addClass("hide");
        var currentYear = new Date().getFullYear();
        $("#experienceForm_endYear").val(currentYear);
    }
    else {
        $(".onOff").removeClass("hide");
    }
}
function showHideTrnCert() {
    if ($('input:radio[name="trainingForm[isCertificate]"]:checked').val() == 0) {
        if ($("#trainingForm_certName").val() == "")
            $("#trainingForm_certName").val("-CERTIFICATE-");
        if ($("#trainingForm_trnTitle").val() == "-TRAINING-" || $("#trainingForm_institute").val() == "-INSTITUTE-") {
            $("#trainingForm_trnTitle").val("");
            $("#trainingForm_institute").val("");
        }
        $("#cert_details").addClass("hide");
        $("#trn_details").removeClass("hide");
    }
    else {
        if ($("#trainingForm_trnTitle").val() == "" || $("#trainingForm_institute").val() == "") {
            $("#trainingForm_trnTitle").val("-TRAINING-");
            $("#trainingForm_institute").val("-INSTITUTE-");
        }
        if ($("#trainingForm_certName").val() == "-CERTIFICATE-")
            $("#trainingForm_certName").val("");
        $("#trn_details").addClass("hide");
        $("#cert_details").removeClass("hide");
    }
}
function checkOpenCert() {
    if ($("#trainingForm_certEndMonth option:selected").val() == "9999") {
        $("#trainingForm_certEndYear").addClass("hide");
    }
    else {
        $("#trainingForm_certEndYear").removeClass("hide");
    }
}
function getCitiesNew(countryIso, fillElement, loadingElement, callAfter) {
    var url = window.location.href;
    var arr = url.split("/");
    var result = arr[0] + "//" + arr[2];
    $.ajax({
        url: result + "/ajax/site/GetCountryCities/?country=" + countryIso + '&lang=' + lang,
        beforeSend: function () {
            $('#' + loadingElement).show();
        }
    }).done(function (json) {
        options = '';
        if (json.length > 0) {
            options = '';
            options += '<option value="" selected="selected">- ' + selectOneTxt + ' -</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].cityIso + '">' + json[i].cityName + '</option>';
            }
        }
        $("#" + fillElement).html(options);
        $('#' + loadingElement).hide();
        if (callAfter != "") {
            var func = window[callAfter];
            func();
        }
    }).error(function () {
        alert('error occured !');
    });
}
function showCourseFromCv(id, obj, cvId) {
    $(obj).next().show()
    $(obj).hide();
    $(".published_text_" + id).show();
    $(".hidden_text_" + id).hide();
    $.bayt("/app/control/byt_speciality_ajax_manager.tcl", {action: "42", training_id: id, cv_id: cvId});
}
function hideCourseFromCv(id, obj, cvId) {
    $(obj).prev().show();
    $(obj).hide();
    $(".published_text_" + id).hide();
    $(".hidden_text_" + id).show();
    $.bayt("/app/control/byt_speciality_ajax_manager.tcl", {action: "41", training_id: id, cv_id: cvId});
}
function showHideEduCityField() {
    if ($('#EducationForm_educationCity option').length > 0 && $('#EducationForm_educationCity').val() !== $("#EducationForm_educationCity").val() + ',0,0') {
        $('#EducationForm_educationCityText').addClass('hide');
        $('#EducationForm_educationCity').removeClass('hide');
        $('.city-text-box').removeClass('no-border').addClass('other-city');
    } else {
        if ($('#EducationForm_educationCity').val() !== $("#EducationForm_educationCity").val() + ',0,0') {
            $('#EducationForm_educationCity').addClass('hide');
            $('#EducationForm_educationCityText').removeClass('hide');
            $('.city-text-box').removeClass('other-city').addClass('no-border');
        }
    }
    $('#eduCityRow').show();
}
function cv_name_modal(cv_id, cv_name_value, formName, btnSave) {
    cv_name_value_cleaned = cv_name_value.replace(/\[^a-zA-Z0-9\]/g, '');
    var rename_body_modal = '<div id="cv-name-off" class="clear c"><p><input type="text" name="' + cv_name_value_cleaned + '" value="' + cv_name_value + '" maxlength="100" id="cv-name-value" class="req" style="width:290px; height:26px; margin:16px 0;" /></p></div>';
    baytModal.setModal(formName, rename_body_modal, true, closeModal(), "");
    $("#modalpopup").css({"width": "646px"});
    $("#globalMWButtons").css({"width": "100%", "text-align": "center"});
    $("#globalMWOk").text(btnSave);
    $("#globalMWOk").addClass("prmt");
    $("#globalMWOk").addClass("renameProfBtn");
    $("#globalMWCancel").addClass("renameProfBtn");
    DrawModalInMiddle('#modalpopup');
    baytModal.postData("/app/control/byt_cv_manager.tcl", function () {
        var defCvName = $("[id=cv-name-value]").val();
        cleanUpHtmlReg = RegExp("(<\/?p)(?:\s\[^>\]*)?(>)|<\[^>\]*>", "gi");
        cvName = (defCvName.length > 20) ? defCvName.substr(0, 19) : defCvName;
        cvName = cvName.replace(cleanUpHtmlReg, "");
        return {byt_cv_stage: 11, cv_id: cv_id, cv_name: cvName};
    }, function (data) {
        if (data == 1) {
            $("#cv_tab_" + cv_id + " a").text(cvName);
            $("#cvName").text(cvName);
        }
    });
}
function showCvEvaluationModal() {
    modalBody = $('#cv-evalution').html();
    baytModal.setModal('', modalBody, true, closeModal());
    try {
        getGoogleAnalyticsEventTracker('profileBuilder', 'cv_evaluation_poped_up');
    } catch (e) {
    }
    $("#modalpopup").css({"width": "645px"});
    $('#globalMWOk').hide();
    $('#globalMWCancel').hide();
    $(".modalcloseimg").show();
    $('body').on('click', '#eva-cv-bttn', function (e) {
        e.preventDefault();
        $.ajax({
            url: cvBuilderObj.ajaxEvaluationLink, beforeSend: function () {
                modalBody = $('#cv-evalution-m2').html();
                $('#globalMWContent').html(modalBody);
            }, success: function (data) {
                $('#eva-cv-bttn').hide();
                try {
                    getGoogleAnalyticsEventTracker('profileBuilder', 'cv_evaluation_requested');
                } catch (e) {
                }
            }
        });
    });
}
function reorderSkills() {
    var cv_section = 'skl';
    var ordered_ids = new Array();
    var cv_section_id = "#cv-" + cv_section + "-section";
    var i = 0;
    $(cv_section_id + " .sort .section_item").each(function () {
        ordered_ids[i] = $(this).attr("id").split("-")[2];
        i++;
    });
    ordered_ids = ordered_ids.join(" ");
    var data = {cv_id: cvBuilderObj.cvId, orderedIds: ordered_ids};
    cvSection = 'cv';
    section_id = '';
    $.ajax({
        method: "POST",
        url: cvBuilderObj.ajaxSkillsOrderUrl,
        data: data,
        cache: false,
        crossDomain: false,
        dataType: "json",
        beforeSend: function () {
        }
    }).done(function (response) {
        if (response.action == 'reload')
            window.location.reload(); else
            $('#profileSkills').find('.order').hide();
    }).error(function () {
        alert('error occured !');
    });
}
function saveSpecialtiesForm() {
    if (beforeValidate()) {
        $(".saveSpecialties").attr('disabled', 'disabled');
        return true;
    }
    return false;
}
function beforeValidate() {
    var arrayInputText = $('input.s_text');
    if (!validateSpecialties()) {
        $('input.s_text').attr("disabled", "disabled");
        return false;
    }
    if (typeof validateProfileUrl == 'function') {
        if (!validateProfileUrl())
            return false;
    }
    return true;
}
function deleteRecommendation(itemId, recType) {
    baytModal.setDeleteModal();
    var data = {cv_id: cvBuilderObj.cvId, itemId: itemId, recType: recType, lang: lang};
    baytModal.postData(cvBuilderObj.ajaxDeleteRecommendationUrl, data, function (response) {
        if (response.action == 'reload') {
            window.location.reload();
        } else {
            $("#recommendations").find('.static-stage').html(response.data).show();
            $("#recommendations").find('.acs-stage').empty();
            getProfileBuilderSideBar(lang);
        }
    });
}
function unpublishRecommendation(itemId, recType) {
    baytModal.setUnpublishModal();
    var data = {cv_id: cvBuilderObj.cvId, itemId: itemId, recType: recType, lang: lang};
    baytModal.postData(cvBuilderObj.ajaxUnpublishRecommendationUrl, data, function (response) {
        if (response.action == 'reload') {
            window.location.reload();
        } else {
            $("#recommendations").find('.static-stage').html(response.data).show();
            $("#recommendations").find('.acs-stage').empty();
            getProfileBuilderSideBar(lang);
        }
    });
}
function showCompaniesFollowModal() {
    return;
    var lang = document.body.id;
    switch (lang) {
        case"ar":
            var modalTitle = "تتبع الشركات التي تطمح بالعمل لديها";
            break;
        case"fr":
            var modalTitle = "Suivez les sociétés dans lesquelles vous désirez travailler";
            break;
        default:
            var modalTitle = "Follow companies you aspire to work for";
    }
    data = {lang: lang};
    $.ajax({
        method: "POST",
        url: cvBuilderObj.ajaxShowCompaniesFollowModalLink,
        data: data,
        cache: false,
        crossDomain: false,
        dataType: "html",
        beforeSend: function () {
        }
    }).done(function (response) {
        modalBody = response;
        if (modalBody != "" && !isWhitespace(modalBody)) {
            baytModal.setModal(modalTitle, modalBody, true, closeModal());
            $("#modalpopup").css({"width": "645px"});
            $('#globalMWOk').hide();
            $('#globalMWCancel').hide();
            $(".modalcloseimg").show();
        }
    }).error(function () {
        alert('error occured !');
    });
}
function followCompany(companyId, buttonObj) {
    $.ajax({cache: false, url: "/ajax/company/FollowCompany/?companyId=" + companyId}).done(function (json) {
        switch (json.status) {
            case 1:
                $(buttonObj).next().removeClass("hide-i");
                $(buttonObj).addClass("hide");
                break;
            case 2:
                baytModal.setModal('<span>&nbsp;</span>', '<p style=\'font-size:15px;\'>' + json.errMsg + '</p>', true, closeModal());
                $("#modalpopup").css("width", "400px");
                DrawModalInMiddle('#modalpopup');
                modalShowClose();
                break;
        }
    }).error(function (error) {
    });
}
function changeCardData(divId, id) {
    if (divId != 'experience' && divId != 'education') {
        if (id > 0) {
            showEditFormMode(divId, id);
        } else {
            showEditFormMode(divId);
        }
        $("#" + divId).scrollTo();
    } else {
        $("#" + divId).scrollTo();
    }
}
if (devProjects('new_autocomplete_api') == 1) {
    $("#experienceForm_jobTitle").addClass('mute');
    var jobsAC = $.extend(true, {}, bayt.search);
    jobsAC.removeClassAll = true;
    jobsAC.jobsAutocom = true;
    jobsAC.currentSearch = "jobs";
    jobsAC.input_keyword = $("#experienceForm_jobTitle");
    jobsAC.loadholder = "experienceForm_jobTitle";
    jobsAC.getTemplates = function () {
        this.item = $("#jobtitle").html();
    }
    jobsAC.setSearchType = function () {
        input_keyword = $("#experienceForm_jobTitle");
        if (input_keyword.hasClass('mute') || input_keyword.val() == '') {
            input_keyword.val(" ");
        }
    };
    jobsAC.getTypes = function () {
        jobsAC.input = $("#experienceForm_jobTitle");
        $('#listing').addClass('jobtitle-Suggestion');
        return "jobs";
    };
    jobsAC.processTemplate = function (data) {
        var srch = jobsAC;
        var LST = jobsAC.resultsContainer;
        LST.html("");
        var input_val = jobsAC.input.val().replace('-', '');
        LST.append('<div id="jobsAcCont"></div>');
        $.each(data, function (key, value) {
            var items = "";
            if (value.category != null && value.category.length > 1 && value.category != "exact") {
                if (LST.hasClass('active-list') != true) {
                    LST.addClass('active-list')
                }
                var input_val = $("#experienceForm_jobTitle").val();
                if (value.title != null && value.title != "") {
                    value.title = value.title.replace(new RegExp("(" + input_val.split(' ').join('|') + ")", "gi"), "<span class=higlightsearch>$1</span>");
                    value.industry = value.industry.replace(new RegExp("(" + encodeURIComponent($.trim(input_val)) + ")", "gi"), "<span class=higlightsearch>$1</span>");
                    var tempContainer = $("#jobsAcCont");
                    $.template("itemTemplate", srch.item);
                    $.tmpl("itemTemplate", value).appendTo(tempContainer);
                }
            }
        });
        if ($(".jobsAutoco").length < 1) {
            LST.removeClass('active-list');
        }
    };
}
if (devProjects('new_autocomplete_api') == 1) {
    var companyAC = $.extend(true, {}, bayt.search);
    companyAC.removeClassAll = true;
    companyAC.serchforcompany = true;
    companyAC.currentSearch = "companies";
    companyAC.input_keyword = $("#experienceForm_company");
    companyAC.loadholder = "experienceForm_company";
    companyAC.getTemplates = function () {
        this.item = $("#companiesAC").html();
    }
    companyAC.setSearchType = function () {
        input_keyword = $("#experienceForm_company");
        if (input_keyword.hasClass('mute') || input_keyword.val() == '') {
            input_keyword.val(" ");
        }
    }
    companyAC.getTypes = function () {
        companyAC.input = $("#experienceForm_company");
        $('#listing').removeClass("jobtitle-Suggestion").addClass('companies-Suggestion');
        return "companies";
    };
    companyAC.processTemplate = function (data) {
        var srch = companyAC;
        var LST = companyAC.resultsContainer;
        LST.html("");
        var input_val = companyAC.input.val().replace('-', '');
        LST.append('<div id="companyAutoCo"></div>');
        $.each(data, function (key, value) {
            var items = "";
            var input_val = $("#experienceForm_company").val();
            value.titleTxtOnly = value.title;
            value.title = value.title.replace(new RegExp("(" + input_val.split(' ').join('|') + ")", "gi"), "<span class=higlightsearch>$1</span>");
            if (value.category != null && value.category.length > 1 && value.category != "exact") {
                if (LST.hasClass('active-list') != true) {
                    LST.addClass('active-list')
                }
                var tempContainer = $("#companyAutoCo");
                $.template("itemTemplate", srch.item);
                $.tmpl("itemTemplate", value).appendTo(tempContainer);
            }
        });
        if ($(".CompanyAutoComplete").length < 1) {
            LST.removeClass('active-list');
        }
    };
}
$(document).ready(function () {
    $("body").on('mouseover', '.edit-mode', function () {
        $(this).find(".editTool").removeClass("hide");
    });
    $("body").on('mouseleave', '.edit-mode', function () {
        $(this).find(".editTool").addClass("hide");
    });
    if (pageCached == '1') {
        try {
            var prefLocale = $.cookie("user-prefs").split(" ")[1];
        } catch (err) {
            var prefLocale = "ae";
        }
        $.baytMW("/app/control/byt_job_ajax_manager.tcl", {
            action: "15",
            page_channel: "People Profile",
            page_role: pageRole,
            page_body: body,
            pref_locale_g: prefLocale,
            pref_lang_g: lang,
            rp_width: rp_width,
            country_iso: country_iso,
            rp_unit_range: rp_unit_range,
            rp_shift: rp_shift,
            rp_grid_start: rp_grid_start,
            bcc_codename: bccCodeName,
            bcc_site_languages: bccSiteLanguages
        }, function (data) {
            if (typeof(getTopBar) == 'function')
                getTopBar(data.topbar);
            if (pageCached == '1' && typeof(updateNavtabs) == 'function' && pageRole != "blog")
                updateNavtabs(data.navtabs);
        });
    }
});