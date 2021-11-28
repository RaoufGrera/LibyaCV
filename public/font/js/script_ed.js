jQuery(function($) {
	var val_holder;
	$("form input[name='insert_edd']").click(function() { // triggred click 
		
		/************** قيم الفورم الذي سنقوم بتحقق من بياناته **************/
		val_holder 		= 0;
		var ed_name 		= jQuery.trim($("form select[name='ed_name']").val());
		var dom_name 		= jQuery.trim($("form select[name='dom_name']").val());
		var univ 			= jQuery.trim($("form [name='univ']").val());
		var specialty 		= jQuery.trim($("form select[name='specialty']").val())
		var avg_num 		= jQuery.trim($("form input[name='avg_num']").val());
		var start_date 		= jQuery.trim($("form select[name='start_date']").val());
		var end_date 		= jQuery.trim($("form select[name='end_date']").val());
		var arrayavg 		= jQuery.trim($("form select[name='arrayavg']").val());

		
        if ((start_date == "من")|| (end_date =="الي")){
			$(".startend_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب أختيار سنة البدء والأنتهاء .</p></div>");
                val_holder =1;
                $("#start_date").focus();
			}else{
			$(".startend_val").html("");}
			
			if(start_date >= end_date){
		$(".startend_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب أن يكون تاريخ الأنتهاء أقل من تاريخ البدء .</p></div>");	 
                
			val_holder = 1;
                $("#start_date").focus();
			}
			else{
			$(".startend_val").html("");}
        /* */
        if(univ=="") {
			$(".univ_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب كتابة اسم الجامعة او اخيتار اي اسم موجود في القائمة. </p></div>");
			val_holder = 1;
             $("#univ_val").focus();
           
			}
			else{
			$(".univ_val").html("");}
        
        
        /**/
         if(dom_name == '0') {
			$(".dom_name_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب تعبئة الحقل .</p></div>");
			val_holder = 1;
             $("#dom_name").focus();
           
			}
			else{
			$(".dom_name_val").html("");
                
			}
	
		 /**/
		if(ed_name == '0') {
			$(".ed_name_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب أختيار مؤهل علمي.</p></div>");
            			val_holder = 1;
$("#ed_name").focus();

			}
			else{
			$(".ed_name_val").html("");
			}

	
		if(val_holder == 1) {
			return false;
		}  
 	}); // click end
}); // jquery end
