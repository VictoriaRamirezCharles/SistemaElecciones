  
$(document).ready(function(){

    $(".btn-delete").on("click",function(){
     debugger
     let id = $(this).data("id");
     let name =$(this).data("name");
     
     swal({
        title: "Esta seguro de eleminar este "+name+"?",
        text: "Una vez eliminado no podra recuperarlo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(id !== null && id !== undefined && id !== "" ){
                 
        if (willDelete) {
          swal("Este "+name+" ha sido eliminado", {
            icon: "success",
          }).then(response=>{
            window.location.href = "delete.php?id=" + id;   
          });
          
        } else {
          swal("Cancelado");
        }
         
    }
      });
    //  if(confirm("Esta seguro que desea eliminar a este estudiante?")){
 
    //      if(id !== null && id !== undefined && id !== "" ){
    //          window.location.href = "estudiantes/delete.php?id=" + id;            
    //      }        
 
    //  }
     
    });
     
    $("#finalizar").on("click",function(){
      debugger
      let id = $(this).data("id");
      let name =$(this).data("name");
      
      swal({
         title: "Esta seguro de finalizar esta "+name+"?",
         text: "Una vez finalizada no podra recuperarla",
         icon: "warning",
         buttons: true,
         dangerMode: true,
       })
       .then((willDelete) => {
         if(id !== null && id !== undefined && id !== "" ){
                  
         if (willDelete) {
           swal("Esta "+name+" ha sido finalizada", {
             icon: "success",
           }).then(response=>{
             window.location.href = "finalizarEleccion.php?id=" + id;   
           });
           
         } else {
           swal("Cancelado");
         }
          
     }
       });
     //  if(confirm("Esta seguro que desea eliminar a este estudiante?")){
  
     //      if(id !== null && id !== undefined && id !== "" ){
     //          window.location.href = "estudiantes/delete.php?id=" + id;            
     //      }        
  
     //  }
      
     });
    
 
 })