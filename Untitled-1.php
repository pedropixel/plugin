<?php
$server="localhost";
$user="root";
$pass="";
$db="dev";

$con = mysqli_connect($server,$user,$pass,$db) or die ("error de conexion");

$mensaje = null;
if(isset($_POST['estado_id']) && !empty($_POST['estado_id'])){
    echo 1;
}
if(isset($_POST['cedula']) && !empty($_POST['cedula']) && ($_POST['fecha']!='') && ($_POST['hora']!='')){
    $cedula=$_POST['cedula'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $query= "SELECT id_subs FROM chap_subscribers WHERE identification='".$cedula."'";
    if ($query){
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row==0){
            echo 'cedula';
        }else{
            $id_user = $row['id_subs'];
            $comprobar= "SELECT estado_id, assistance_date FROM chap_checking_assistance WHERE id_subscriber='".$id_user."'";
            $result=mysqli_query($con, $comprobar);
            $retorno = [];
            $i = 0;
            while($fila = $result->fetch_assoc()){
            $retorno[$i] = $fila;
            $i++;
            }
            if(getestado_id($retorno)==3){
                echo "bloqueado";
            }else{
                if(obtenerFecha($retorno)==1){
                    echo "repetido";
                }else{
                    if(getAforo($fecha,$con,$hora)<50){
                        insertar($id_user);
                    }else{
                        echo "nodisponible";
                    }
                }
            }

            
        }
    }
}else{
    echo "datos";
}
function insertar($id_user){
    $server="localhost";
    $user="root";
    $pass="";
    $db="dev";
    $con = mysqli_connect($server,$user,$pass,$db) or die ("error de conexion");
    $estado_id=1;
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $sql = "INSERT INTO chap_checking_assistance (estado_id, assistance_date, assistance_time, id_subscriber)
            VALUES ('$estado_id', '$fecha', '$hora', '$id_user')";
            $insertado=mysqli_query($con, $sql);
            if ($insertado) {
                    echo 1;
            } 
}
function getestado_id($retorno){ 
    foreach($retorno as $dato){
        $date = $dato['estado_id'];
        for($i=0; $i<1000; ++$i ){
            if($date==3){
                return $date;
            }
        }
    }
}
function obtenerFecha($retorno){
    foreach($retorno as $dato){
    $date = $dato['assistance_date'];
        for($i=0; $i<1000; ++$i ){
            if($date==$_POST['fecha']){
                return 1;
            }
        }
    }
}
function getAforo($fecha,$con,$hora){
    $sql = "SELECT count(id) as 'count'
    FROM chap_checking_assistance 
    WHERE assistance_date='".$fecha."' 
    AND assistance_time='".$hora."' 
    GROUP BY assistance_time";
    $result=mysqli_query($con, $sql)or die("error 1");
    $row = mysqli_fetch_array($result);
    $count = $row['count'];
    return $count;
}
?>