const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	usuario: /^\d{8,10}$/, 
	nombre: /^[a-zA-ZÀ-ÿ\s]{4,30}$/,
    telefono: /^.{10,12}$/,
	password: /^.{8}$/, 
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
	
}

const campos = {
	usuario: false,
	nombre: false,
	password: false,
	correo: false,
	telefono: false
	
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "usuario":
			validarCampo(expresiones.usuario, e.target, 'usuario');
		break;
		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
        case "telefono":
			validarCampo(expresiones.telefono, e.target, 'telefono');
		break;
        case "correo":
			validarCampo(expresiones.correo, e.target, 'correo');
		break;
		case "password":
			validarCampo(expresiones.password, e.target, 'password');
			validarPassword2();
		break;
		case "password2":
			validarPassword2();
		break;
		
		// case "telefono":
		// 	validarCampo(expresiones.telefono, e.target, 'telefono');
		// break;
		
	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

const validarPassword2 = () => {
	const inputPassword1 = document.getElementById('password');
	const inputPassword2 = document.getElementById('password2');

	if(inputPassword1.value !== inputPassword2.value){
		document.getElementById(`grupo__password2`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__password2 i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__password2 i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__password2 .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['password'] = false;
	} else {
		document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__password2`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__password2 i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__password2 i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__password2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['password'] = true;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
		var doc = document.getElementById('usuario').value;
		var nom = document.getElementById('nombre').value;
        var tel = document.getElementById('telefono').value;
        var email = document.getElementById('correo').value;
		var pas = document.getElementById('password').value;
        var depor = document.getElementById('id_deporte').value;

	const terminos = document.getElementById('terminos');
	if(campos.usuario && campos.nombre && campos.password && campos.telefono && campos.correo && terminos.checked ){
		formulario.reset();
		console.log(doc);console.log(nom);console.log(pas);console.log(tel);console.log(email);console.log(depor);;
		$.post ("registro.php?cod=datos",{doc: doc, nom: nom, pas: pas, telefono:tel, email: email, depor: depor}, function(document){$("#mensaje").html(document);
		
		}),
		
		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});
	} 
});



