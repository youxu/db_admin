function ajax_fun(a_url,a_data,a_type,a_datatype,s_message,e_message){
	$.ajax({
	  type: a_type,
	  url: a_url,
	  data:a_data,
	  success: function(data){
	  		 $.each(data, function(i,n){
		  		 	alert(n);
	  		 }
	  		 );
	  },
	  dataType: a_datatype
	});
}