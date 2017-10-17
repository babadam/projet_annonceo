<?php
function userConnecte(){
    if(isset($_SESSION['membre'])){
        return TRUE;
    }
    else{
        return FALSE;
    }
}
