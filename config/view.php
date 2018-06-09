<?php
class View
{
   public function render($templateFile, array $vars = array())
   {
      ob_start();
      extract($vars);
      require($templateFile);

      return ob_get_clean();
   }
      

}

?>