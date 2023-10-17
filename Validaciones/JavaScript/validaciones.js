window.onload=inicio;

function inicio(){
    document.formulario.boton.onclick=comenzar;
}

function comenzar(){

    Vstmensaje="";
    Vstcadena=document.formulario.dni.value;
    VstcadenaCif=document.formulario.cif.value;
    opcion=esNif(Vstcadena);
    opcion2=esCif(VstcadenaCif);
    
    switch(opcion){
        case 1:
            Vstmensaje="NIF correcto"
            break;
        case 2:
            Vstmensaje="NIF NO correcto"
            break;
        case 3:
            Vstmensaje="6 a 8 digitos"
            break;
        case 4:
            Vstmensaje="Dato no correcto"
            break;
    }

    switch(opcion2){
        case 1:
            document.formulario.mensajeCif.value="Cif Correcto";
            break;
        case 2:
            document.formulario.mensajeCif.value="Se ha introducido un cif erróneo. El carácter de control es erróneo.";
            break;
        case 0:
            document.formulario.mensajeCif.value="Se ha introducido un dato no válido. No es CIF.";
            break;
    }

document.formulario.mensaje.value=Vstmensaje;
}
function esNif(cadena) {
    Varfinal = 'TRWAGMYFPDXBNJZSQVHLCKE';
    Varprimera = 'XYZLKME';
    cadena = cadena.replace(/\s/g, '').toUpperCase();

    if (cadena.length >= 6 && cadena.length <= 8 && /^\d+$/.test(cadena) && parseInt(cadena) >= 100000) {
        return 3;
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
            console.log(Vchletrault);
            let Vstcalculo = cadena.substring(0, 8);
            let Vitresultado = parseInt(Vstcalculo) % 23;
            console.log(Vitresultado);
            if (Varfinal[Vitresultado] == Vchletrault) {
                return 1;
            } else {
                return 2;
            }
        }return 4;
    }

    function esCif(cadena){
        cif
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

        //Longitud cadena 9
        if(vsitLongitud!=9){
            return 0;
        }
        
        //Que empieza por letra y acabe en número
        if(cadena.includes(letraNum) && !cadena.includes(nums)){
            return 2;
        }

        //Que empieza por letra y acabe en letra
        if(cadena.includes(letraLetra) && !cadena.includes(letraUltima)){
            return 2;
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
        console.log(sumImpar);
        //suma posiciones pares
        for(i=1;i<digitos.length;i=i+2){
            sumPar=sumPar+parseInt(digitos[i],10);
        }
        //calculamos el caracter de control
        sumTotal = sumImpar+sumPar;
        resto=sumTotal%10;
        numCaracter=10-resto;
        if(numCaracter==10){
            numCaracter=0;
        }
        //preguntamos la letra
        if(vsitUlt=="A"){
            numUltimo=1;
        }
        if(vsitUlt=="B"){
            numUltimo=2;
        }
        if(vsitUlt=="C"){
            numUltimo=3;
        }
        if(vsitUlt=="D"){
            numUltimo=4;
        }
        if(vsitUlt=="E"){
            numUltimo=5;
        }
        if(vsitUlt=="F"){
            numUltimo=6;
        }
        if(vsitUlt=="G"){
            numUltimo=7;
        }
        if(vsitUlt=="H"){
            numUltimo=8;
        }
        if(vsitUlt=="I"){
            numUltimo=9;
        }
        if(vsitUlt=="J"){
            numUltimo=0;
        }

        if(numUltimo==numCaracter){
            return 1;
        }
    }

    


