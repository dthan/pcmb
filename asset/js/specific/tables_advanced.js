/* 
   - table_advanced.html specific script calls
   
   -->> --------------------------
	Table of Contents:
	1 - Datatable setup
	2 - Button styling setup
	3 - Column resize setup
	4 - Table sorting setup		
   -->> --------------------------- */
   
jQuery(function($) { 

	/* --->> 1 - Datatable setup --------------*/
	oTable = $('#example').dataTable({		
		"sPaginationType": "full_numbers"
	});
	
	/* --->> 2 - Button styling setup --------------*/
	$(".dataTables_length select").uniform();

	/* --->> 3 - Column resize setup --------------*/
	$("#resizableTable").colResizable();

	/* --->> 4 - Table sorting setup --------------*/
	$("#sortableTable").tablesorter(); 

});
