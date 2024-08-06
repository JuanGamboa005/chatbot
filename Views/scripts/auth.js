


function init(){

    $("#crearUsuario").on("click", function(e){

        e.preventDefault();
        const nombre = $('#register-nombre').val();
        const email = document.getElementById('register-email').value;
        const password = document.getElementById('register-password').value;

        
        const formData= new FormData($("#crearUsuarioForm")[0]);

        $.ajax({
            url: "../Controller/auth.php?op=crearUsuario",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
           
            success: function(datos){
                console.log(datos);
                datos= JSON.parse(datos);
                
                if(datos[0]==1){
                    alert(`Atención! ${datos[1]}`);
                    // alert(`<p style='color:green'><b>Atención!</b></p> <p >${datos[1]}</p>`);
                    limpiarCrearUsuario();
                    const loginTab = new bootstrap.Tab(document.querySelector('#login-tab'));
                    loginTab.show();

                }else 
                if(datos[0]==""){
                    alert(`Error! ${datos[1]}</p>` );
                    // alert(`<p style='color:red'><b>Error!</b></p> <p style='color:red'>${datos[1]}</p>` );
                }	

            }
        }); 
     
    })

    $("#iniciarSesion").on("click", function(e){

        e.preventDefault();
        const loginEmail = $('#login-email').val();
        const loginPassword = $('#login-password').val();
        
        const formData= new FormData($("#inicioSesionForm")[0]);

        $.ajax({
            url: "../Controller/auth.php?op=iniciarSesion",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
           
            success: function(datos){
                console.log(datos);
                datos= JSON.parse(datos);
                
                if(datos[0]==1){
                    // alert(`Atención! ${datos[1]}`);
                    // alert(`<p style='color:green'><b>Atención!</b></p> <p >${datos[1]}</p>`);
                    limpiarInicioSesion();
                    // window.location.href = '../Views/app/app.html';

                    const {nickName, email}= datos[2];
                    console.log(nickName, email);

                    localStorage.setItem('nickName', nickName);
                    localStorage.setItem('email', email);
                    window.location.href = '../Views/app/app.html';
                     

                }else 
                if(datos[0]==""){
                    alert(`Error! ${datos[1]}</p>` );
                    // alert(`<p style='color:red'><b>Error!</b></p> <p style='color:red'>${datos[1]}</p>` );
                }	

            }
        }); 
     
    })

}


function limpiarCrearUsuario(){
    $("#crearUsuarioForm .text").val("");
   
}

function limpiarInicioSesion(){
    $("#inicioSesionForm .text").val("");
   
}




init();





// document.getElementById('inicioSesionForm').addEventListener('submit', function(event) {
//     event.preventDefault();
//     const email = document.getElementById('login-email').value;
//     const password = document.getElementById('login-password').value;

//     const user = JSON.parse(localStorage.getItem('user'));



//     if (user && user.email === email && user.password === password) {
//         alert('Inicio de sesión exitoso.');
//         window.location.href = '../app/app.html';
//     } else {
//         alert('Credenciales incorrectas.');
//     }
// });

// document.getElementById('crearUsuarioForm').addEventListener('submit', function(event) {
//     event.preventDefault();
//     const nombre = document.getElementById('nombre').value;
//     const email = document.getElementById('register-email').value;
//     const password = document.getElementById('register-password').value;

//     localStorage.setItem('user', JSON.stringify({ nombre, email, password }));

//     alert('Usuario creado exitosamente. Ahora puede iniciar sesión.');
//     const loginTab = new bootstrap.Tab(document.querySelector('#login-tab'));
//     loginTab.show();
// });