<?php
//include wp-config or wp-load.php
$root = dirname(dirname(dirname(dirname(__FILE__))));
if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} else {
// Before 2.6
require_once($root.'/wp-config.php');
}
require_once('mailer.php');

testfunction();
function testfunction(){
    $mensaje = null;
    if(isset($_POST['cedula']) && !empty($_POST['cedula']) && ($_POST['fecha']!='') && ($_POST['hora']!='')){
    $cedula=$_POST['cedula'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
        global $wpdb; 

        $query= $wpdb->get_var("SELECT id_subs FROM chap_subscribers WHERE identification='".$cedula."'");

        if(!$query){

            echo "cedula";

        }else{

            $id_user = $query;
            $comprobar=$wpdb->get_results("SELECT estado_id, assistance_date FROM chap_checking_assistance WHERE id_subscriber='".$id_user."'", OBJECT);

                if(!$comprobar){

                    if(getAforo($fecha,$wpdb,$hora)<45){
                        insertar($id_user,$fecha,$wpdb,$hora);
                    }else{
                        echo "nodisponible";
                    }

                }else {
                    foreach ($comprobar as $post) {
                        setup_postdata($post);
                        $estado= $post->estado_id;
                        $date = $post->assistance_date;
                    }
                    if(getestado_id($comprobar)==3){
                        echo 3;
                    }else{
                        if(obtenerFecha($comprobar, $fecha)==$fecha){
                            echo 'repetido';
                        }else{
                            if(getAforo($fecha,$wpdb,$hora)<45){
                                if(insertar($id_user,$fecha,$wpdb,$hora)==1){
                                    echo 1;
                                }
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
} 
function getestado_id($comprobar){ 
    foreach($comprobar as $post){
        $date = $post->estado_id;
        for($i=0; $i<1000; ++$i ){
            if($date==3){
                return $date;
            }
        }
    }
}
function obtenerFecha($comprobar, $fecha){ 
    foreach($comprobar as $post){
        $date = $post->assistance_date;
        for($i=0; $i<1000; ++$i ){
            if($date==$fecha){
                return $date;
            }
        }
    }
}
function getAforo($fecha,$wpdb,$hora){
    $sql = $wpdb->get_var("SELECT count(id) as 'count'
    FROM chap_checking_assistance
    WHERE assistance_date ='".$fecha."' 
    AND assistance_time ='".$hora."'");
    print_r($sql);
    return $sql;
}
function insertar($id_user,$fecha,$wpdb,$hora){
    $estado_id=2;
    $sql = $wpdb->insert("chap_checking_assistance", 
    	array("estado_id"=>$estado_id, "assistance_date"=>$fecha, "assistance_time"=>$hora, "id_subscriber"=>$id_user), 
    		array( '%d','%s', '%s', '%d' ) );
            $wpdb->query($sql);
            if($sql){
                $email = getEmail($wpdb,$id_user);
				$name = getName($wpdb,$id_user);
                scheduled($email,$name, $fecha,$hora);            
            }
            echo 1;  
}
function getEmail($wpdb,$id_user){
    $query= $wpdb->get_var("SELECT email FROM chap_subscribers WHERE id_subs='".$id_user."'");
    $email = $query;
    return $email;
}
function getName($wpdb,$id_user){
    $query= $wpdb->get_var("SELECT first_name FROM chap_subscribers WHERE id_subs='".$id_user."'");
    $name = $query;
    return $name;
}
?>