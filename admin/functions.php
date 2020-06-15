<?php

function delete($table,$field,$value){
    global $data;
    $stmt = $data->prepare("DELETE FROM $table WHERE $field = $value");
    if($stmt->execute()){
        return true;
    }
    else return false;
}