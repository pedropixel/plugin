<?php
function scheduled($email,$name, $fecha,$hora){
    $content ='<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"> <tr bgcolor="#d1dd34"> <td></td> <td width="600" align="center" height="auto"> <table > <tr> <td> <img src="https://evolutionfitness.ec/reservas/images/banner-02.png" alt="Evolution Functional Fitness" width="100%" height="auto" align="center"> </td> </tr> </table> </td> <td></td> </tr> <tr bgcolor="#f6f6f6"> <td></td> <td width="600" > <table width="100%" cellpadding="50" valign="top" > <tr> <td valign="top"> <h2>Hola '.$name.'.</h2> <p>Hemos recibido tu solicitud</p> <p>Tu clase ha sido agendada para la fecha <b>'.$fecha.'</b> a las: <b>'.$hora.'</b> </p> <p style="color: #bf2e1f;"><b>Importante:</b></p> <p>En caso de <b>no poder asistir</b> a la hora pautada, debes notificar con al menos 8 horas de anticipación vía email.</p> <p>Conoce lo que debes saber para asistir al gimnasio con la nueva normalidad <a href="https://evolutionfitness.ec/nueva-normalidad">aquí</a></p> </td> </tr> </table> </td> <td></td> </tr> <tr bgcolor="#d1dd34" border="0" color="#ffffff" > <td></td> <td width="600" height="20" > <table width="100%" cellpadding="10" valign="top" > <tr> <td valign="top"> <p align="center" style="color:#262626; font-size: 12px">Evolution Functional Fitness | Todos los derechos reservados 2020</p> </td> </tr> </table> </td> <td></td> </tr> </table>';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail( $email, 'Clase agendada', $content , $headers  );
    return 1;
}
function locked($email){
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail( $email, 'No puedes agendar', "<h1>Bloqueado</h1>", $headers  );
}
function lockfed($email,$fecha,$hora){
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail( $email, 'Con email', "<h1>Bloqueado</h1><table> $fecha a las $hora </table>", $headers  );
}
