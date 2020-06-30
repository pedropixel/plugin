<?php
function assistanceForm() {
    $min=date("Y-m-d");
    $formulario = '<div class="assistance-form"><div class="mensaje">Enviaremos a tu correo la fecha y hora agendada </div>
    <form action="" method="post"  id="request">
        <input type="text" name="cedula" id="cedula" placeholder="RUC, Cédula o Pasaporte">
        <input type="date" name="fecha" id="fecha" min="'.$min.'" >
        <p>Seleccione el horario para asistir</p>
      <div class="form-check col-sm-12">
        
        <label class="form-check-label" for="exampleRadios1">05:30
        <input class="form-check-input" type="radio" name="hora[]" id="hora" value="05:30"></label>
        <label class="form-check-label" for="exampleRadios1">07:30
        <input class="form-check-input" type="radio" name="hora[]" id="hora" value="07:30"></label>
        <label class="form-check-label" for="exampleRadios1">09:30
        <input class="form-check-input" type="radio" name="hora[]" id="hora" value="09:30"></label>
        <label class="form-check-label" for="exampleRadios1">11:30
        <input class="form-check-input" type="radio" name="hora[]" id="hora" value="11:30"></label>
        <label class="form-check-label" for="exampleRadios1">13:30
        <input class="form-check-input" type="radio" name="hora[]" id="hora" value="13:30"></label>
        <label class="form-check-label" for="exampleRadios1">15:30
        <input class="form-check-input" type="radio" name="hora[]" id="hora" value="15:30"></label>
        <label class="form-check-label" for="exampleRadios1">17:30
        <input class="form-check-input" type="radio" name="hora[]" id="hora" value="17:30"></label>
        <label class="form-check-label" for="exampleRadios1">19:30
        <input class="form-check-input" type="radio" name="hora[]" id="hora" value="19:30"></label>
      </div>
        <input type="submit" value="enviar" class="button-black" onclick="javacript:(0)">
    </form></div>';
  echo $formulario;
  }