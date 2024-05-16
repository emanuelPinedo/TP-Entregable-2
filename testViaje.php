<?php

include_once 'Pasajeros.php';
include_once 'PasajeroVIP.php';
include_once 'PasajerosNecesidadesEspeciales.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';

$objPasajero1 = new Pasajeros('Mema', 9, 12);
$objPasajero2 = new Pasajeros('Cardo', 18, 24);
$objPasajero3 = new Pasajeros('Marian', 424, 3444);
$objPasajero4 = new Pasajeros('Nahue', 243, 235);
$objPasajero5 = new Pasajeros('Tame', 19, 12);
$objPasajero6 = new PasajeroVIP('Pope', 34, 43, 432, 73);
$objPasajero7 = new PasajeroVIP('Mati', 23, 7, 24, 343);
$objPasajero8 = new PasajeroVIP('Pato', 42, 43, 77, 201);
$objPasajero9 = new PasajerosNecesidadesEspeciales('Lauti', 29, 23423, true, true, true);
$objPasajero10 = new PasajerosNecesidadesEspeciales('Ian', 67, 7324, false, true, false);

//$objColeccionPasajero = [];

$objColeccionPasajero = [$objPasajero1, $objPasajero2, $objPasajero3, $objPasajero4, $objPasajero5, $objPasajero6, $objPasajero7, $objPasajero8, $objPasajero9, $objPasajero10];

$objResponsable = new ResponsableV('2325', '402', 'Tito', 'Calderon');

//$objResponsable = null

$viaje = new Viaje('777','Italia','20',$objColeccionPasajero,$objResponsable,1000,0);

function datosPasajero (){
    $dato = trim(fgets(STDIN));
    return $dato;
}

function pedidosPasajeroEspecial (){
    $pedido = trim(fgets(STDIN));
    $res = false;
    if ($pedido === "si") {
       $res = true;
    }
    return $res;
}

$salir = true;

do {
    echo "\n1. Agregar pasajero\n";
    echo "2. Agregar pasajero vip\n";
    echo "3. Agregar pasajero especial\n";
    echo "4. Ver viaje\n";
    echo "5. Cambiar pasajero\n";
    echo "6. Cambiar pasajero vip\n";
    echo "7. Cambiar pasajero especial\n";
    echo "8. ingresar Responsable del viaje\n";
    echo "9. Cambiar Responsable del viaje\n";
    echo "10. Salir\n";
    echo "Ingrese una opcion: ";
    $opcion = datosPasajero();
switch ($opcion) {
        case 1:
           $verificarLugar = $viaje->hayPasajesDisponible();
            if ($verificarLugar) {
                echo "Ingrese el nombre del pasajero: ";
                $nombre = datosPasajero();
                echo "Ingrese el numero de asiento del pasajero: ";
                $numAsiento = datosPasajero();
                echo "Ingrese el numero de ticket del pasajero: ";
                $numTicket = datosPasajero();
                $objColeccionPasajero = new Pasajeros ($nombre,$numAsiento,$numTicket);
                $resultadoCambiarPasajero = $viaje->agregarPasajero($objColeccionPasajero);
                if ($resultadoCambiarPasajero) {
                    echo "El usuario ha sigo cargado";
                } else{
                    echo "El usuario esta repetido";
                }
            } else {
                echo "El avion ya esta lleno";
            }
        break;

        case 2:
            $verificarLugar = $viaje->hayPasajesDisponible();
            if ($verificarLugar) {
                echo "Ingrese el nombre del pasajero vip: ";
                $nombre = datosPasajero();
                echo "Ingrese el numero de asiento del pasajero vip: ";
                $numAsiento = datosPasajero();
                echo "Ingrese el numero de ticket del pasajero vip: ";
                $numTicket = datosPasajero();
                echo "Ingrese el numero de viajero frecuente del pasajero vip: ";
                $numViajeroFrecuente = datosPasajero();
                echo "Ingrese la cantidad de millas que ha echo pasajero vip: ";
                $cantMillasPasajero = datosPasajero();
                $objColeccionPasajero = new PasajeroVip ($nombre,$numAsiento,$numTicket,$numViajeroFrecuente,$cantMillasPasajero);
                $resultadoCambiarPasajero = $viaje->agregarPasajero($objColeccionPasajero);
                if ($resultadoCambiarPasajero) {
                    echo "El usuario ha sigo cargado";
                } else{
                    echo "El usuario esta repetido";
                }
            } else {
                echo "El avion ya esta lleno";
            }
        break;

        case 3:
            $verificarLugar = $viaje->hayPasajesDisponible();
            if ($verificarLugar) {
                echo "Ingrese el nombre del pasajero especial: ";
                $nombre = datosPasajero();
                echo "Ingrese el numero de asiento del pasajero especial: ";
                $numAsiento = datosPasajero();
                echo "Ingrese el numero de ticket del pasajero especial: ";
                $numTicket = datosPasajero();
                echo "el pasajero especial necesita un servicio especial? Responder con si o no: ";
                $servicioEspecial = pedidosPasajeroEspecial();
                echo "el pasajero especial necesita un asistencia? Responder con si o no: ";
                $asistencia = pedidosPasajeroEspecial();
                echo "el pasajero especial tiene alguna restriccion alimentaria? Responder con si o no: ";
                $restriccionAlimentaria = pedidosPasajeroEspecial();
                $objColeccionPasajero = new PasajerosNecesidadesEspeciales ($nombre,$numAsiento,$numTicket,$servicioEspecial,$asistencia,$restriccionAlimentaria);
                $resultadoCambiarPasajero = $viaje->agregarPasajero($objColeccionPasajero);
                if ($resultadoCambiarPasajero) {
                    echo "El usuario ha sigo cargado";
                } else{
                    echo "El usuario esta repetido";
                }
            } else {
                echo "El avion ya esta lleno";
            }
        break;

        case 4:
            echo $viaje;
        break;
        
        case 5;
        if ($objColeccionPasajero = []) {
           echo "Todavia no hay ningun pasajero cargado.\n";
        } else {
            echo "Ingrese el ticket del pasajero que quiere modificar: ";
            $numTicket = datosPasajero();
            echo "Ingrese el nuevo nombre del pasajero: ";
            $nombre = datosPasajero();
            echo "Ingrese su nuevo numero de asiento de pasajero: ";
            $numAsiento = datosPasajero();
            $objColeccionPasajero = new Pasajeros($nombre, $numAsiento,$numTicket);
            $cambiarPersona = $viaje->modificarPasajero($objColeccionPasajero);
            if ($cambiarPersona) {
                echo "Se ha cambiado correctamente\n";
            } else {
                echo "El pasajero no existe\n";
            }
        }
        break;

        case 6;
        if ($objColeccionPasajero = []) {
           echo "Todavia no hay ningun pasajero cargado.\n";
        } else {
            echo "Ingrese el numero de ticket del pasajero vip: ";
            $numTicket = datosPasajero();
            echo "Ingrese su nuevo nombre de pasajero vip: ";
            $nombre = datosPasajero();
            echo "Ingrese su nuevo numero de asiento de pasajero vip: ";
            $numAsiento = datosPasajero();
            echo "Ingrese el numero de viajero frecuente del pasajero vip: ";
            $numViajeroFrecuente = datosPasajero();
            echo "Ingrese la cantidad de millas que ha echo pasajero vip: ";
            $cantMillasPasajero = datosPasajero();
            $objColeccionPasajero = new PasajeroVIP($nombre, $numAsiento,$numTicket,$numViajeroFrecuente,$cantMillasPasajero);
            $cambiarPersona = $viaje->modificarPasajero($objColeccionPasajero);
            if ($cambiarPersona) {
                echo "Se ha cambiado correctamente\n";
            } else {
                echo "El pasajero no existe\n";
            }
        }
        break;

        case 7;
        if ($objColeccionPasajero = []) {
           echo "Todavia no hay ningun pasajero cargado.\n";
        } else {
            echo "Ingrese el numero de ticket del pasajero especial: ";
            $numTicket = datosPasajero();
            echo "Ingrese su nuevo nombre de pasajero especial: ";
            $nombre = datosPasajero();
            echo "Ingrese su nuevo numero de asiento de pasajero especial: ";
            $numAsiento = datosPasajero();
            echo "el pasajero especial necesita un servicio especial? Responder con si o no: ";
            $servicioEspecial = pedidosPasajeroEspecial();
            echo "el pasajero especial necesita un asistencia? Responder con si o no: ";
            $asistencia = pedidosPasajeroEspecial();
            echo "el pasajero especial tiene alguna restriccion alimentaria? Responder con si o no: ";
            $restriccionAlimentaria = pedidosPasajeroEspecial();
            $objColeccionPasajero = new PasajerosNecesidadesEspeciales($nombre, $numAsiento,$numTicket,$servicioEspecial,$asistencia,$restriccionAlimentaria);
            $cambiarPersona = $viaje->modificarPasajero($objColeccionPasajero);
            if ($cambiarPersona) {
                echo "Se ha cambiado correctamente\n";
            } else {
                echo "El pasajero no existe\n";
            }
        }
        break;

        case 8:
            if ($objResponsable === null) {
               echo "Ingrese el numero de licencia:\n";
               $licencia = datosPasajero();
               echo "Ingrese el numero de empleado:\n";
               $numeroEmpleado = datosPasajero();
               echo "Ingrese el nombre del empleado:\n";
               $nombre = datosPasajero();
               echo "Ingrese el apellido del empleado:\n";
               $apellido = datosPasajero();
               $objResponsable = new ResponsableV ($numeroEmpleado,$licencia,$nombre,$apellido);
               $viaje->agregarCambiarResponsable($objResponsable);
            } else {
                echo "Ya existe un responsable del viaje.\n";
            }
        break;

        case 9:
            if ($objResponsable === null) {
                echo "Aun no hay ningun responsable del viaje.\n";
            } else {
            echo "Ingrese el numero de licencia del responsable del viaje que quiere modificar:\n";
            $licencia = datosPasajero();
            $licenciaResponsableActual =  $objResponsable->getNroLicencia();
             // Limpiar espacios en blanco
            $licenciaResponsableActual = trim($licenciaResponsableActual);
            if ($licencia === $licenciaResponsableActual) {
                echo "Ingrese el numero de empleado: ";
                $empleado = datosPasajero();
                echo "Ingrese el nombre del empleado: ";
                $nombre = datosPasajero();
                echo "Ingrese el apellido del empleado: ";
                $apellido = datosPasajero();
                $objResponsableViaje = new ResponsableV ($empleado,$licencia,$nombre,$apellido);
                $viaje->agregarCambiarResponsable($objResponsableViaje);
            } else {
                echo "El Numero es incorrecto\n";
            }
            } 
        break;

        case 10:
            $salir = false;
        break;
        
        default:
            echo "error, esa opcion no existe";
            break;
    }
} while ($salir);