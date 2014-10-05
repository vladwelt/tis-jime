$("form").validate({
    rules: {
        //CONTROL REGISTRO GRUPO EMPRESAS 
        nombre_usuario: {
            required: true, login: true,minlength: 5, maxlength: 20, remote: "../Controlador/ControladorVerificador.php?x=1"
        },
        contraseña_usuario1: {
            required: true, minlength: 5, maxlength: 20
        },
        contraseña_usuario2: {
            required: true, minlength: 5, maxlength: 20, equalTo: "#contraseña_usuario1"
        },
        nombre_largo_ge: {
            required: true, literal:true, minlength: 5, maxlength: 45, remote: "../Controlador/ControladorVerificador.php?x=2"
        },
        nombre_corto_ge: {
            required: true, literal:true, minlength: 4, maxlength: 15, remote: "../Controlador/ControladorVerificador.php?x=3"
        },
        correo_ge: {
            required: true, email: true, maxlength: 70, remote: "../Controlador/ControladorVerificador.php?x=4"
        },
        direccion_ge: {
            required: true, minlength: 5, maxlength: 50
        },
        telefono_ge: {
            required: true, number: true, remote: "../Controlador/ControladorVerificador.php?x=5"
        },
        //CONTROL REGISTRO CONSULTORES
        usuario_consultor: {
            required: true, login:true, minlength: 5, maxlength: 20, remote: "../Controlador/ControladorVerificador.php?x=6"
        },
        contraseña_consultor1: {
            required: true, minlength: 5, maxlength: 20
        },
        contraseña_consultor2: {
            required: true, minlength: 5, maxlength: 20, equalTo: "#contraseña_consultor1"
        },
        nombreCompleto_consultor: {
            required: true, literal:true, minlength: 5, maxlength: 45
        },
        correo_consultor: {
            required: true, email: true, maxlength: 70, remote: "../Controlador/ControladorVerificador.php?x=7"
        },
        telefono_consultor: {
            required: true, number: true, remote: "../Controlador/ControladorVerificador.php?x=8"
        },
        // CONTROL REGISTRO SOCIOS 
        nombre_socio: {
            required: true, literal: true
        },
        apellidos_socio: {
            required: true, literal: true
        },
         correo_socio: {
            required: true,email: true 
         },
         direccion_socio: {
             required: true
         },
         profesion_socio:{
             required: true
         }
         
    },
    messages: {
        //MENSAJES REGISTRO GRUPO EMPRESAS
        nombre_usuario: {
            required: "Introduzca el Nombre de Usuario.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
            remote: "nombre de usuario ya registrado",
            login: "el nombre de usuario solo puede contener una palabra."
        },
        contraseña_usuario1: {
            required: "Introduzca su Contraseña.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres."
        },
        contraseña_usuario2: {
            required: "Repita la Contraseña.",
            equalTo: "Las contraseñas no coinciden.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres."
        },
        nombre_largo_ge: {
            required: "Introduzca el Nombre de su Empresa.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
            literal:"Ingrese solo palabras y máximo tres palabras.",
            remote: "nombre no disponible, intente uno distinto."
        },
        nombre_corto_ge: {
            required: "Introduzca el Nombre Corto de su Empresa.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
            literal:"Ingrese solo palabras y máximo tres palabras.",
            remote: "nombre no disponible, intente uno distinto."
        },
        correo_ge: {
            required: "Introduzca su correo electrónico.",
            email: "Introduzca un correo electrónico válido",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
            remote: "correo electrónico yá registrado."
        },
        direccion_ge: {
            required: "Introduzca su dirección.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres."
        },
        telefono_ge: {
            required: "Introduzca su teléfono.",
            number: "Introduzca un número válido.",
            remote: "Teléfono ya registrado."
        },
        //MENSAJES REGISTRO CONSULTORES
        usuario_consultor: {
            required: "Introduzca el Nombre de Usuario.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
            login:"el nombre de usuario solo puede contener una palabra.",
            remote: "nombre de usuario ya registrado"
        },
        contraseña_consultor1: {
            required: "Introduzca su Contraseña.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres."
        },
        contraseña_consultor2: {
            required: "Repita la Contraseña.",
            equalTo: "Las contraseñas no coinciden.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres."
        },
        nombreCompleto_consultor: {
            required: "Introduzca el Nombre Completo.",
            minlength: "Mínimo {0} Caracteres.",
            literal:"Ingrese solo palabras y máximo tres palabras.",
            maxlength: "Máximo {0} Caracteres."
        },
        correo_consultor: {
            required: "Introduzca su correo electrónico.",
            email: "Introduzca un correo electrónico válido",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
            remote: "correo electrónico yá registrado."
        },
        telefono_consultor: {
            required: "Introduzca su teléfono.",
            number: "Introduzca un número válido.",
            remote: "Teléfono ya registrado."
        },
        //MENSAJES REGISTRO SOCIOS  
        nombre_socio: {
            required: "Ingrese el nombre del Socio.",
            literal : "Ingrese solo palabras y máximo tres palabras."
        },
         apellidos_socio:{
            required: "Ingrese el nombre del Socio.",
            literal : "Ingrese solo palabras y máximo tres palabras."
         },
         correo_socio: {
            required: "Ingrese un correo electrónico.", 
            email: "Introduzca un correo electrónico válido" 
         },
         direccion_socio: {
             required: "Ingrese una direccion."
         },
         profesion_socio:{
            required: "Ingrese una profesión."
         }
    },
    errorElement: 'small',
    errorPlacement: function(error, element) {
        error.html(error.text()).insertAfter(element).hide().fadeIn();
    },
    submitHandler: function(form) {
        form.submit();
    }
});