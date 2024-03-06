window.onload = inicio;

function inicio() {
  document.formulario.boton.onclick = comenzar;
}

function comenzar() {
  
  
  
  let codBanco, numSucursal, numCuenta;
  
  //Control de entrada para guardar informacion en le variable codBanco, numSUcursal, numCuenta
  if(validacionNums(document.formulario.cod_banco.value) == true && document.formulario.cod_banco.value.length == 4){
    codBanco = document.formulario.cod_banco.value;
  }
  if(validacionNums(document.formulario.numOfi.value) == true && document.formulario.numOfi.value.length == 4){
    numSucursal = document.formulario.numOfi.value;
  }
  if(validacionNums(document.formulario.numCuenta.value) == true && document.formulario.numCuenta.value.length == 10){
    numCuenta = document.formulario.numCuenta.value;
  }

  //Control de entrada para la funcion de calcular IBAN
  if(codBanco || numSucursal || numCuenta != undefined){
    //Calcula el codigo de control segun los datos introducidos
    codCodigoCont = CodigosControl(codBanco, numSucursal, numCuenta);
    document.formulario.codControl.value = codCodigoCont;
    //Calcular el IBAN segun los datos introducidos
    iban =(codBanco.toString() + numSucursal.toString() + codCodigoCont.toString() + numCuenta.toString()) + "142800";
    codCalculoIBAN=calculoIBANEspanya(iban);
    document.formulario.ibanCompleto.value = codCalculoIBAN;
  }
  //Control de entrada para la funcion de validar IBAN
  if(document.formulario.iban.value.length < 35){
    cadenaiban = document.formulario.iban.value;
    let opcion;
    let mensaje;
    opcion = comprobarIBAN(cadenaiban);
 
    if(opcion == true){
      mensaje = "IBAN Correcto";
    }else{
      mensaje = "IBAN Incorrecto";
    }
    document.formulario.comprobarIban.value = mensaje;
  } 

  
}
function esNif(cadena) {
  Varfinal = "TRWAGMYFPDXBNJZSQVHLCKE";
  Varprimera = "XYZLKME";
  cadena = cadena.replace(/\s/g, "").toUpperCase();

  if (
    cadena.length >= 6 &&
    cadena.length <= 8 &&
    /^\d+$/.test(cadena) &&
    parseInt(cadena) >= 100000
  ) {
    return "N3";
  }

  if (cadena.length == 9) {
    let Vchletrauno = cadena.charAt(0);
    let Vchletrault = cadena.charAt(8);

    if (Varprimera.includes(Vchletrauno)) {
      if (Vchletrauno == "Y") {
        Vchletrauno = "1";
      } else if (Vchletrauno == "Z") {
        Vchletrauno = "2";
      } else {
        Vchletrauno = "0";
      }
    }
    let Vstcalculo = cadena.substring(0, 8);
    let Vitresultado = parseInt(Vstcalculo) % 23;
    console.log(Vitresultado);
    if (Varfinal[Vitresultado] == Vchletrault) {
      return "N1";
    } else {
      return "N2";
    }
  }
  return "0";
}

function esCif(cadena) {
        vsitLongitud = cadena.length;
        vsitPrimer=cadena.charAt(0);
        vsitUlt=cadena.charAt(8);
        nums=['0123456789'];
        letraNum = ['ABCDEFGHJUV'];
        letraLetra = ['PQRSW'];
        letraUltima = ['JABCDEFGHI'];
        sumPar =0;
        sumImpar=0;
        sumTotal=0;
        numUltimo=0;
        longCompro = 0;
        letraCompro = 0;

        //Longitud cadena 9
        if(vsitLongitud!=9){
            return "0";
        }else{
            longCompro = 1;
        }
        
        //Que empieza por letra y acabe en número
        if(cadena.includes(letraNum) && !cadena.includes(nums)){
            return "C2";
        }else{
            letraCompro = 1;
        }

        //Que empieza por letra y acabe en letra
        if(cadena.includes(letraLetra) && !cadena.includes(letraUltima)){
            return "C2";
        }else{
            letraCompro = 1;
        }

        digitos = cadena.charAt(1)+ cadena.charAt(2)+cadena.charAt(3)+cadena.charAt(4)+cadena.charAt(5)+cadena.charAt(6)+cadena.charAt(7);
        //suma posiciones impares
        for(i=0;i<digitos.length;i=i+2){
            num = digitos[i]*2;
            st=num.toString();
            if (num>9){
                sumImpar = sumImpar + parseInt(st.charAt(0),10)+parseInt(st.charAt(1),10);
            }else{
                sumImpar=sumImpar+num;
            }
        }
        //suma posiciones pares
        for(i=1;i<digitos.length;i=i+2){
            sumPar=sumPar+parseInt(digitos[i],10);
        }
        //calculamos el caracter de control
        numUlt=cadena.charAt(8);
        sumTotal = sumImpar+sumPar;
        resto=sumTotal%10;
        numCaracter=10-resto;
        if(numCaracter==10){
            numCaracter=0;
        }
        //preguntamos la letra
        if((vsitUlt=="A" || numUlt == 1) ){
            numUltimo=1;
        }
        if(vsitUlt=="B" || numUlt == 2){
            numUltimo=2;
        }
        if(vsitUlt=="C" || numUlt == 3){
            numUltimo=3;
        }
        if(vsitUlt=="D" || numUlt == 4){
            numUltimo=4;
        }
        if(vsitUlt=="E" || numUlt == 5){
            numUltimo=5;
        }
        if(vsitUlt=="F" || numUlt == 6){
            numUltimo=6;
        }
        if(vsitUlt=="G" || numUlt == 7){
            numUltimo=7;
        }
        if(vsitUlt=="H" || numUlt == 8){
            numUltimo=8;
        }
        if(vsitUlt=="I" || numUlt == 9){
            numUltimo=9;
        }
        if(vsitUlt=="J" || numUlt == 0){
            numUltimo=0;
        }

        if(numUltimo==numCaracter){
            letraCompro =  1;
        }else{
            return "C2";
        }

        if(letraCompro == 1 && longCompro == 1){
            return "C1";
        }
}

function esNifesCif(cadena) {
  const Varprimnif = 'XYZLKME';
  const Varfinnif = 'TRWAGMYFPDXBNJZSQVHLCKE';
  const NumultCif = '0123456789';
  const letPrinCif1 = 'ABCDEFGHJUV';
  const letPrinCif2 = 'PQRSW';
  const letUltCif = 'JABCDEFGHI';
  
  const vstPosPrinif = cadena.charAt(0);
  const vstPosFinnif = cadena.charAt(8);
  
  let doc = null;
  //control para saber que funcion tiene que llamar, o esNif o esCif
  if (Varfinnif.includes(vstPosFinnif) || (Varprimnif.includes(vstPosPrinif) && Varfinnif.includes(vstPosFinnif))) {
      doc = esNif(cadena);
  }
  
  if ((letPrinCif1.includes(vstPosPrinif) && NumultCif.includes(vstPosFinnif)) || (letPrinCif2.includes(vstPosPrinif) && letUltCif.includes(vstPosFinnif))) {
      doc = esCif(cadena);
  }
  //Segun lo que retorno doc, se ejecuta una cosa u otra
  switch (doc) {
      case "N1":
          Vstmensaje = "NIF correcto";
          break;
      case "N2":
          Vstmensaje = "NIF erróneo, carácter de control erróneo";
          break;
      case "N3":
          Vstmensaje = "Se ha introducido un Dni, 6 a 8 dígitos";
          break;
      case "0":
          Vstmensaje = "Dato no correcto";
          break;
      case "C1":
          Vstmensaje = "Cif Correcto";
          break;
      case "C2":
          Vstmensaje = "Se ha introducido un CIF erróneo. El carácter de control es erróneo.";
          break;
  }
    document.formulario.mensaje.value = Vstmensaje;
}

function CodigosControl(codBanco,numSucursal,numCuenta){
  
//Hacemos la asigancion de numero1 y numero2 con sus correspondientes calculos
  numero1 = (codBanco.charAt(0)*4)+(codBanco.charAt(1)*8)+(codBanco.charAt(2)*5)+(codBanco.charAt(3)*10);
  numero2 = (numSucursal.charAt(0)*9)+(numSucursal.charAt(1)*7)+(numSucursal.charAt(2)*3)+(numSucursal.charAt(3)*6);
  //obtenemos el primer caracter de control
  control1 = (11 - ((numero1+numero2) % 11));
  if(control1==10){
    control1=1;
  }else if(control1==11){
    control1=0;
  }
//Hacemos la asignacion de numero3 con los correspondientes calculos
  numero3 = (numCuenta.charAt(0)*1)+(numCuenta.charAt(1)*2)+(numCuenta.charAt(2)*4)+(numCuenta.charAt(3)*8)+(numCuenta.charAt(4)*5)+(numCuenta.charAt(5)*10)+(numCuenta.charAt(6)*9)+(numCuenta.charAt(7)*7)+(numCuenta.charAt(8)*3)+(numCuenta.charAt(9)*6);
//Obtenemos el segundo caracter de control
  control2=(11- (numero3 % 11));
  if(control2==10){
    control2=1;
  }else if(control2==11){
    control2=0;
  }
//Realizamos la concatenación de los dos caracteres de control
  caracterControl = (control1*10+control2);
  return caracterControl;
}
function calculoIBANEspanya(codCuenta) {
  //Separamos por tramos y Calculamos el resto y lo restamos a 98
  cacho1 = codCuenta.substring(0, 9);
  cacho2 = codCuenta.substring(9, 18);
  cacho3 = codCuenta.substring(18);

  resto1 = parseInt(cacho1) % 97;
  resto2 = (parseInt(resto1.toString() + cacho2) % 97);
  resto3 = (parseInt(resto2.toString() + cacho3) % 97);
  codControl = 98 - resto3;

  // Si codControl tiene una longitud menor a 2 dígitos, añadimos un 0 delante
  if (codControl < 10) {
    codControl = "0" + codControl;
  }

  codCuenta = codCuenta.slice(0,-6);
  // Construimos el IBAN con los dígitos originales
  codIBAN = "ES" + codControl.toString() + codCuenta;

  return codIBAN;
}


function comprobarIBAN(codIbanOr){
  let letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  let codIBAN = codIbanOr;
  //Guardamos las dos letras del principio de la cadena
  let controletra = codIBAN.substr(0,2);
  //Guardamos los dos caracter de control.
  let controlNumero = codIBAN.substr(2,2);
  let posi;
  //borramos los cuatro caracteres del principio
  codIBAN = codIBAN.slice(4);
  codIBAN=codIBAN + controletra;
  //Miramos por posicion si es una letra, si es una letra la comparamos con el string de letras y la remplazamos.
  //Según la posicion que corresponda en el array de letras le sumamos 10 y es el valor que tiene esa letra.
  for(i=0;i<codIBAN.length;i++){
    if(letras.includes(codIBAN[i])){
      posi = 10 + letras.indexOf(codIBAN[i]);
      codIBAN = codIBAN.replace(codIBAN[i],posi);
    }
  }
//Añadimos el caracter control del iban al final de la linea
  codIBAN = codIBAN + controlNumero;

  //Seperamos el String de la cadena en tres tramos para hacer los calculos
  cacho1 = codIBAN.substring(0, 9);
  cacho2 = codIBAN.substring(9, 18);
  cacho3 = codIBAN.substring(18);
  //Calculamos el resto1 y el resultado lo concatenamos a 2 y asi sucesivamente
  resto1 = parseInt(cacho1) % 97;
  resto2 = (parseInt(resto1.toString() + cacho2) % 97);
  resto3 = (parseInt(resto2.toString() + cacho3) % 97);
  console.log(resto3);
  //Si el resto es 1 lo lanzamos con true si es !=1 lo lanzamos con false
  if(resto3!=1){
    return false;
  }else{
    return true;
  }
}

function validacionNums(cadenaOr){
//Funcion que valida si en la cadena introducida solo son números
  let cadena = cadenaOr;
  let numeros = '0123456789';
  for(i = 0;i<cadena.length;i++){
    if(!(numeros.includes(cadena[i]))){
      return false;
    }
  }
    return true;
}

function cumpleCondicionesRazonSocial(cadena){

  let primerCaracter = cadena[0];
  let ultimoCaracter = cadena[cadena.length - 1];
  let caracteresPermitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZªº.-";
  
  if (caracteresPermitidos.includes(primerCaracter) && (/[a-zA-Z0-9.]/.test(ultimoCaracter) || ultimoCaracter === '-')) {
    return true;
  } else {
    return false;
  }
}

function cumpleCondicionesCodEmpresa(codigo) {
  const codigoSinEspacios = codigo.replace(/\s/g, ''); // Eliminar espacios en blanco
  const caracteresPermitidos = /^[a-zA-Z0-9]+$/;

  if (caracteresPermitidos.test(codigoSinEspacios) && codigoSinEspacios.length >= 5 && codigoSinEspacios.length <= 10
  ) {
    return true;
  } else {
    return false;
  }
}

function cumpleCondicionesDireccion(direccion) {
  const direccionSinEspacios = direccion.replace(/\s/g, ''); // Eliminar espacios en blanco
  const caracteresPermitidos = /^[a-zA-Zªº\-\/.0-9]+$/;

  if (caracteresPermitidos.test(direccionSinEspacios) && direccionSinEspacios.length > 0 && (/[a-zA-Z0-9]$/.test(direccionSinEspacios))) {
    return true;
  } else {
    return false;
  }
}

function cumpleCondicionesLocalidad(localidad) {
  const localidadSinEspacios = localidad.trim(); // Eliminar espacios en blanco al principio y al final
  const caracteresPermitidos = /^[a-zA-Z ]+$/; // Letras y espacios

  if (caracteresPermitidos.test(localidadSinEspacios) && localidadSinEspacios.length > 0) {
    return true;
  } else {
    return false;
  }
}

// Función para validar el código postal
function validarCodigoPostal(codigoPostal) {
  const codigoPostalNumero = parseInt(codigoPostal, 10);
  return codigoPostalNumero >= 1000 && codigoPostalNumero <= 52999;
}

//Validar provincia
function validarProvincia(codigoPostal){
  let control = parseInt(codigoPostal.substr(0,2));
  const provincias = [
    "Álava", "Albacete", "Alicante", "Almería", "Asturias", "Ávila", "Badajoz", "Barcelona", "Burgos", "Cáceres",
    "Cádiz", "Cantabria", "Castellón", "Ciudad Real", "Córdoba", "Cuenca", "Gerona (Girona)", "Granada", "Guadalajara",
    "Guipúzcoa", "Huelva", "Huesca", "Islas Balears (Baleares)", "Jaén", "La Coruña", "La Rioja", "Las Palmas",
    "León", "Lleida (Lérida)", "Lugo", "Madrid", "Málaga", "Murcia", "Navarra", "Orense", "Palencia", "Pontevedra",
    "Salamanca", "Santa Cruz de Tenerife", "Segovia", "Sevilla", "Soria", "Tarragona", "Teruel", "Toledo", "Valencia",
    "Valladolid", "Vizcaya", "Zamora", "Zaragoza", "Ceuta", "Melilla"
  ];
  return provincias[control];  
}

function cumpleCondicionesTelefono(telefono) {
  const telefonoNumerico = parseInt(telefono); // Convertir a número
  if (!isNaN(telefonoNumerico) && telefonoNumerico >= 600000000 && telefonoNumerico <= 799999999 && telefono.length === 9) {
    return true;
  } else {
    return false;
  }
}

function cumpleCondicionesFax(fax) {
  if (/^9\d{8}$/.test(fax)) {
    return true;
  } else {
    return false;
  }
}

function validarFecha(fecha) {
  // Expresión regular para validar la fecha
  const regex = /^(0?[1-9]|[12]\d|3[01])[-./](0?[1-9]|1[0-2])[-./](\d{2}|\d{4})$/;

  // Verificar si la fecha coincide con la expresión regular
  if (regex.test(fecha)) {
    // La fecha es válida
    return true;
  } else {
    // La fecha no es válida
    return false;
  }
}

