$(document).ready(function(){

    $("#guardar-votos").on("click",function(){
     debugger
     let id = $(this).data("id");
     let eleccion = $(this).data("eleccion");

     swal({
        title: "Esta seguro de realizar esta eleccion?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(id !== null && id !== undefined && id !== "" )
        {         
        if (willDelete) {
          swal("Voto realizado exitosamente! Favor verificar voto en su correo eléctronico.", {
            icon: "success",
          }).then(response=>{
            window.location.href = "addVoto.php?Id=" + id+"&eleccionId="+eleccion;   
          });
          
        } else {
          swal("Cancelado");
        }
         
    }
    
      });
  

     
    });
 
 })