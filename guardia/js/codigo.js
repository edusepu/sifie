$('#formLogin').submit(function(e){
   e.preventDefault();
   var usuario = $.trim($("#usuario").val());    
   var password =$.trim($("#password").val());
   var idurl =$.trim($("#id").val());
   //alert('primer '+usuario+password);
    if(usuario.length == "" || password == ""){
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un usuario y/o password',
      });
      return false; 
    }else{
        $.ajax({
           url:"bd/loginViejo.php",
           type:"POST",
           datatype: "json",
           data: {usuario:usuario, password:password},
           success:function(data){               
               if(data == "null"){
                   Swal.fire({
                       type:'error',
                       title:'Usuario y/o password incorrecta',
                   });
               }else{
                   Swal.fire({
                       type:'success',
                       title:'¡Conexión exitosa!',
                       confirmButtonColor:'#3085d6',
                       confirmButtonText:'Ingresar'
                   }).then((result) => {
                       if(result.value){
                               console.log(data);
                               console.log("///");
                               console.log(data["usuario"]);
                               window.location.href = "redirect.php";
                       }
                   })
                   
               }
           }    
        });
    }     
});