function botonLogin() {	
	
	autenticar();
	
}

function recuperarPass(){

	$("#pwdModal").modal({backdrop: "static"});
	$('#pwdModal').modal('show');
	
}	

function recoverPass(){
	var email = $('#mailRecuperar').val();
	//alert(email);
	 $.post( "recuperar_pass.php", { email: email }, function(result) {
                var respuesta = result.split('<JS>'); 
                
        }).done(function(result) { 
        		//console.log("result lau"+result);
                var respuesta = result.split('<JS>'); 
               //	console.log("split"+respuesta);      
                var JSONstring = respuesta[1].trim();
                
              //  console.log("trim"+JSONstring);  
                //console.log("trim2"+JSONstring2);   

                var JSONCrumb = JSON.parse(JSONstring);               
                 
                //console.log(JSONCrumb.mensaje);
                $( "#respuestaRecuperar" ).html( JSONCrumb.mensaje);
                $('#pwdModal').modal('hide');
                 $('#smallRespuesta').modal('show');

                 
                //alert(JSONstring);
                //imprimirCrumb(JSONCrumb);
                //applyTooltipster('queriasTooltipMain', 'left');
                //NProgress.inc(0.10);
        }).fail(function(){
                return false;
        }).always(function(){
                $(document).scrollTop(0);
                //desBloquearDivs();
                //resetPnotifys();
        });
}

	
function validarLogin(e) {
	tecla = (document.all) ? e.keyCode : e.which;
			
	if (tecla==13) {
		botonLogin();
	} else if (tecla==59||tecla==60||tecla==61||tecla==62||tecla==63||tecla==33||tecla==34||tecla==35||tecla==38||tecla==39) {
		return false;
	} else {
		return true;
	}
	
	
	autenticar();

}

decodeBase64 = function(s) {
    var e={},i,b=0,c,x,l=0,a,r='',w=String.fromCharCode,L=s.length;
    var A="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    for(i=0;i<64;i++){e[A.charAt(i)]=i;}
    for(x=0;x<L;x++){
        c=e[s.charAt(x)];b=(b<<6)+c;l+=6;
        while(l>=8){((a=(b>>>(l-=8))&0xff)||(x<(L-2)))&&(r+=w(a));}
    }
    return r;
};

function autenticar() {
	
	mostrarWait();


	
	var usuario = document.getElementById("login_usuario");
	var password = document.getElementById("login_password");
	
	timestamp = new Date().getTime(); 
	
	var md5 = CryptoJS.MD5(password.value); 
	
	var ajax = nuevoAjax();
	ajax.open("POST", "validar_usuario.php", true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			var respuesta = ajax.responseText;
			
		//	console.log(respuesta);
			
			var decodedString = Base64.decode(respuesta);
			
			//console.log('antes de  --');
			
			//var decrypted = JSON.parse(CryptoJS.AES.decrypt(decodedString, "ts"+timestamp, {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8));
			try {
				var decrypted = JSON.parse(CryptoJS.AES.decrypt(decodedString, "ts"+timestamp, {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8));	
			} catch(err) {
				console.log(decrypted);	
			}
			//AK 27/02/2018: Correción para compatibilidad con IExplorer
			
		//	console.log(decrypted);
			
			var acceso = obtenerTag(decrypted, "acceso");
			var usr_id = obtenerTag(decrypted, "usr_id");
			var usr_nombre = obtenerTag(decrypted, "usr_nombre");
			var usr_nombre_real = obtenerTag(decrypted, "usr_nombre_real");
			var usr_perfil = obtenerTag(decrypted, "usr_perfil");
			var usr_foto = obtenerTag(decrypted, "usr_foto");
			var timestamp2 = obtenerTag(decrypted, "timestamp");
			var permisos = obtenerTag(decrypted, "permisos");
			
			//ocultarWait();
			
			if (acceso == 1 && timestamp==timestamp2) {
				sessionStorage.clear();
				sessionStorage.setItem('id', usr_id);
				sessionStorage.setItem('nombre', usr_nombre);
				sessionStorage.setItem('nombre_real', usr_nombre_real);
				sessionStorage.setItem('perfil', usr_perfil);
				sessionStorage.setItem('foto', usr_foto);
				sessionStorage.setItem('timestamp', timestamp);
				sessionStorage.setItem('permisos', permisos);
				
				window.location.href = "marco.php?tk="+respuesta+"&ts="+timestamp; 
			} else {
			
				logeoErroneo();
				
			}

			
		}
	};
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send('login_usuario=' + usuario.value + '&login_password=' + md5 + '&timestamp=' + timestamp);

}


function logeoErroneo(){
	ocultarWait();
	$("#respuestaLogin").html('<br><br>Usuario y/o contraseña incorrectos<br><br>');
}





/*
function logearse(id, nombre, perfil){
		//alert(nombre);
				
		sessionStorage.clear();
		sessionStorage.setItem('id', id);
		sessionStorage.setItem('nombre', nombre);
		sessionStorage.setItem('perfil', perfil);
		
		window.location = ("marco.php"); 
		
		console.log(sessionStorage.getItem('nombre'));
		
		/*soloLectura = typeof soloLectura !== 'undefined' ? soloLectura : 0; //Para los usuarios de RRHH que son solo lectura
		
		$("#respuestaLogin").html('Usuario y contraseña correctos.');
	
		$('body').css('background-repeat', 'repeat');
		$('body').css('background-size', '');
		$('body').css('background', '');
		
		sessionStorage.clear();
		sessionStorage.setItem('Usuario', usuario);
		sessionStorage.setItem('Consultor', consultor);
		sessionStorage.setItem('Legajo', legajo);
		sessionStorage.setItem('Tipo', tipoU);
		sessionStorage.setItem('Solicitante', solicitante);
		sessionStorage.setItem('Ejecutor', ejecutor);
		sessionStorage.setItem('ResTec', rt);
		sessionStorage.setItem('ViajTerc', vt);
		sessionStorage.setItem('aus', aus);
		sessionStorage.setItem('austipo', austipo);
		sessionStorage.setItem('reportes', reportes);
		sessionStorage.setItem('rep_aus', rep_aus);
		sessionStorage.setItem('rep_austipo', rep_austipo);
		sessionStorage.setItem('soloLectura', soloLectura);
				
		if (sessionStorage.getItem('Tipo')=='RRHH') {
			if(sessionStorage.getItem('panelIzquierdo')===null||sessionStorage.getItem('panelIzquierdo')=='')
				sessionStorage.setItem('panelIzquierdo', 4);
			
			fijar(sessionStorage.getItem('panelIzquierdo'));
		}
	
}		*/
