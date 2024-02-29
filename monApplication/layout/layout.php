<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<link rel="stylesheet" href="https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/css/form.css">
    <title>
     Ton appli !
    </title>
    
   <span id="bandeau">  <?php echo $view?>    </span>

 
  </head>
<?php //$message=$context->notification;?>
  <body>
    <h2>CERI CAR </h2>
    <div class="notification">
        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
    <?php if($context->getSessionAttribute('user_id')): ?>
	<?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
	
     <?php endif; ?>
     

    <div id="page">
      <?php if($context->error): ?>
      	<div id="flash_error" class="error">
        	<?php echo " $context->error !!!!!" ?>
      	</div>
      <?php endif; ?>
      <div id="page_maincontent">	
      	<?php include($template_view); ?>
      	
      </div>
    </div>
<script src='https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/js/javassciprt.js'>

    </script>

  </body>

</html>
