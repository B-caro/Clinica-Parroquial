function validar(){

    var nombre      =   document.getElementById('name').value;
    var apellido    =   document.getElementById('lastname').value;
    var edad        =   document.getElementById('edad').value;
    var comentario  =   document.getElementById('comentario').value;

    if(nombre.length == 0){ 
        document.getElementById("name").style.boxShadow = '0 0 15px red'; 
        document.getElementById("name").placeholder = "Este campo es obligatorio";
        
        return false;
    }else{
        document.getElementById("name").style.boxShadow = '0 0 15px green';
    }

    if(nombre.length > 100){
        document.getElementById("name").style.boxShadow = '0 0 15px red';
        document.getElementById("name").value = '';
        document.getElementById("name").placeholder = "Este campo admite 100 caracteres";

        return false;
    }else{
        document.getElementById("name").style.boxShadow = '0 0 15px green';
    }    

    if(apellido.length == 0){ 
        document.getElementById("lastname").style.boxShadow = '0 0 15px red'; 
        document.getElementById("lastname").placeholder = "Este campo es obligatorio";
        
        return false;
    }else{
        document.getElementById("lastname").style.boxShadow = '0 0 15px green';
    }

    if(apellido.length > 100){
        document.getElementById("lastname").style.boxShadow = '0 0 15px red';
        document.getElementById("lastname").value = '';
        document.getElementById("lastname").placeholder = "Este campo admite 100 caracteres";

        return false;
    }else{
        document.getElementById("lastname").style.boxShadow = '0 0 15px green';
    }     

    if(isNaN(edad) || edad.length == 0){

        document.getElementById("edad").style.boxShadow = '0 0 15px red';
        document.getElementById("edad").placeholder = "Este campo es obligatorio";
        return false;
    }else{
        document.getElementById("edad").style.boxShadow = '0 0 15px green';

    }

    if(edad <= 0){
        document.getElementById("edad").style.boxShadow = '0 0 15px red';
        document.getElementById("edad").value = '';
        document.getElementById("edad").placeholder = "Cantidad minima: 1";
        return false;
    }else{
        document.getElementById("edad").style.boxShadow = '0 0 15px green';
    }

    if(edad > 99){
        document.getElementById("edad").style.boxShadow = '0 0 15px red';
        document.getElementById("edad").value = '';
        document.getElementById("edad").placeholder = "Cantidad maxima: 99";
        return false;
    }else{
        document.getElementById("edad").style.boxShadow = '0 0 15px green';
    }    

    if(comentario.length == 0){ 
        document.getElementById("comentario").style.boxShadow = '0 0 15px red'; 
        document.getElementById("comentario").placeholder = "Este campo es obligatorio";
        
        return false;
    }else{
        document.getElementById("comentario").style.boxShadow = '0 0 15px green';
    }

    if(comentario.length > 1000){
        document.getElementById("comentario").style.boxShadow = '0 0 15px red';
        document.getElementById("comentario").value = '';
        document.getElementById("comentario").placeholder = "Este campo admite 100 caracteres";

        return false;
    }else{
        document.getElementById("comentario").style.boxShadow = '0 0 15px green';
    }  

    return true;

}