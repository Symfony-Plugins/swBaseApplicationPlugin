<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <link rel="shortcut icon" href="/favicon.ico" />
    
  <?php include_http_metas() ?>
  <?php include_metas() ?>

  <?php include_title() ?>
</head>

<body>
  <div id="wrapper">
    <?php echo sw_get_user_notice()?>
      
    <?php echo $sf_content ?>
  </div>

  <?php if(sfConfig::get('mg_i18n_enabled', false)): ?>
    <?php include_component('mgI18nAdmin', 'displayTranslationBox') ?>
  <?php endif;?>

</body>
</html>
