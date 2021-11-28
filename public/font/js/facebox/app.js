var MIN_LENGTH = 3;
(function ($) {
	$.fn.delayKeyup = function(callback, ms){
		var timer = 0;
		$(this).keyup(function(){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		});
		return $(this);
	};
})(jQuery);


$(document).ready(function(){
	$('#create').submit(function () {
		$.post('/profile/edit-goal', $('#create').serialize(), function (data, textStatus) {
			$('#goal').append(data);
		});
		return false;
	});


});

function searchAjax(a,b,c){
	var keyword = $(a).val();
	if (keyword.length >= MIN_LENGTH) {
		$.post( "/api/"+b, { keyword: keyword } )
				.done(function( data ) {
					$(c).html('');
					if(data.data.length > 0){
						$.each(data.data, function(){
							$(c).append('<li class="list-search t">' + this.name + '<span>'+ this.nameCount + '</span></li>');
						})
					}
					$('.t').click(function() {
						$(this).children('span').remove();
						var text = $(this).html();
						$(a).val(text);
						$(c).html('');
					})

				});
	} else {
		$(c).html('');
	}

}

$( document ).ready(function() {
	$("#keyword").delayKeyup(function() {
		this.stringHide = $('#stringHide').val();
		var search = "cv";
		switch (this.stringHide){
			case "السير الذاتية":
				search = "cv";
				break;
			case "الوظائف":
				search ="job";
				break;
			case "الشركات":
				search = "company";
				break;
			default:
				search = "cv";
				break;
		}
		var keyword = $("#keyword").val();
		var stringHide = $("#stringHide").val();
		if (keyword.length >= MIN_LENGTH) {
			$('#s_l').removeClass('sh');
			$.post( "/", { keyword: keyword,stringHide: this.stringHide } )
					.done(function( data ) {
						$('#results').html('');
						if(data.users.length > 0){
						$.each(data.users, function(){
							$('#results').append('<li class="list-search"><a href="' + this.user_name + '"><img src="'+ this.image + '">' + this.name + '</a></li>');

						})
							if(data.users.length > 1){
								$('#results').append('<li class="list-search"><a href="/' + search + '/search?string=' + keyword + '">عرض كل النتائج</a></li>');
							}
						}else{
							$('#results').append('<li class="list-search">لاتوجد نتائج</li>');
						}
						$('.item').click(function() {
							var text = $(this).html();
							$('#keyword').val(text);
						})
						$('#s_l').addClass('sh');
					});
		} else {
			$('#results').html('');
		}
	}, 700);
	$("#keyword").blur(function(){
				$("#results").fadeOut(500);
			})
			.focus(function() {
				$("#results").show();
			});
});
