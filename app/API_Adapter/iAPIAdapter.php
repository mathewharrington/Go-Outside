<?php
/*
* Interface for api adapters, all I need right now is a simple get.
*
* @author Mathew Harrington
*/
namespace App\API_Adapter;

interface iAPIAdapter {
   public function get();
}

?>
