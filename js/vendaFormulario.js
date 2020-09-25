
$("#formVenda").validate({
       rules:{
           cliente:{
               required:true,
			         minlength: 3			   
           }, 		   
           cpf:{
               required:true,
               minlength: 11  
           }, 
           datavenda:{
               required:true   
           }, 
           total:{
               required:true
           }	   
       }, 
       messages:{
           cliente:{
               required:"Este Campo é Obrigatório!",
               minlength: "Mínimo de 3 Caracteres"        
           },        
           cpf:{
               required:"Este Campo é Obrigatório!",
               minlength: "Mínimo de 11 Caracteres"  
           }, 
           datavenda:{
               required:"Este Campo é Obrigatório!"   
           }, 
           total:{
               required:"Este Campo é Obrigatório!"
           }		   
       }
});


