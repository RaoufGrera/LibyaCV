/*
	author: istockphp.com
*/

jQuery(function($) {
	var val_holder;
	$("form input[name='insert_exp']").click(function() { // triggred click 
		var val_holder=0;
		/************** قيم الفورم الذي سنقوم بتحقق من بياناته **************/
		var exp_comp 		= jQuery.trim($("form input[name='exp_comp']").val()); // first name field
		var dom_id 		= jQuery.trim($("form select[name='dom_id']").val()); // last name field
		var exp_name 			= jQuery.trim($("form input[name='exp_name']").val()); // first name field
		var start_date_y		= jQuery.trim($("form select[name='start_date_y']").val()); // first name 
		var end_date_y 		= jQuery.trim($("form select[name='end_date_y']").val()); // first name field
		var start_date_m		= jQuery.trim($("form select[name='start_date_m']").val()); // first name 
		var end_date_m 		= jQuery.trim($("form select[name='end_date_m']").val()); // first name field

        var startDate =  new Date("'"+start_date_y+"'/'"+start_date_m+"'/1'");
        var endDate =  new Date("'"+end_date_y+"'/'"+end_date_m+"'/1'");


         if ((start_date_m == "0")|| (end_date_m =="0") || (end_date_y =="0") || (start_date_y =="0")){
			$(".start_date_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب أختيار سنة البدء والأنتهاء .</p></div>");
			val_holder = 1;
                $("#start_date").focus();
			}else if((start_date_y > end_date_y) && (end_date_y != "1") ){
            $(".start_date_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب ان يكون تاريخ الانتهاء اكبر من تاريخ البدء .</p></div>");
			val_holder = 1;
                $("#start_date").focus();
			/*}else if(startDate > endDate ){
			$(".start_date_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب ان يكون تاريخ الانتهاء اكبر من تاريخ البدء .</p></div>");
			val_holder = 1;
                $("#start_date").focus();*/
			}
			else{
			$(".start_date_val").html("");
			}

        
        if(exp_name == "") {
			$(".exp_name_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب تعبئة الحقل .</p></div>");
			val_holder = 1;
             $("#exp_name").focus();
			}
			else{
			$(".exp_name_val").html("");}
			
        if(dom_id == '0') {
			$(".dom_id_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب تعبئة الحقل .</p></div>");
			val_holder = 1;
             $("#dom_id").focus();
			}
			else{
			$(".dom_id_val").html("");
			}
        
		if(exp_comp == "") {
			$(".exp_comp_val").html("<span>!</span><div class='contenttool'><b></b><p>يجب تعبئة الحقل .</p></div>");
			val_holder = 1;
             $("#exp_comp").focus();
           
			}
			else{
			$(".exp_comp_val").html("");
            }
        
	
		if(val_holder == 1) {
			return false;
		}  
		/************** end: email exist function and etc. **************/
	}); // click end
}); // jquery end