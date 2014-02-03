/* 
   - file_validation.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - File validation setup 	
   -->> --------------------------- */
   
jQuery(function($) { 

	// --->> 1 - File validation setup --------------	
	jQuery(".formClass").validationEngine({promptPosition : "centerRight",  autoPositionUpdate:true});
	
});

function checkHELLO(field, rules, i, options){
	if (field.val() != "HELLO") {
		// this allows to use i18 for the error msgs
		return options.allrules.validate2fields.alertText;
	}
}