<?php

function inputFields($placeholder, $nome, $value, $type){
    $ele="
    <div class=\"form-group my-4\">
    <input type='$type' name='$nome' placeholder='$placeholder' class=\"form-control\" value='$value' autocomplete=\"off\">
   </div>
   ";
   echo $ele;

}


?>