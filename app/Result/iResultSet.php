<?php
/*
* Interface for result sets obtained via REST web services for use in Go Outside
*
* @author Mathew Harrington
*/

namespace App\Result;

interface iResultSet {
   public function parse();
}

 ?>
