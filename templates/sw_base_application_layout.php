<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <link rel="shortcut icon" href="/favicon.ico" />
  
  <!-- CSS -->
  <!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="/swExtraPlugin/themes/default/css/ie6.css" /><![endif]-->
  <!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="/swExtraPlugin/themes/default/css/ie7.css" /><![endif]-->
  
  <?php include_http_metas() ?>
  <?php include_metas() ?>

  <?php include_title() ?>
</head>

<body>
  <div id="wrapper">
    <h1 class="logo"><span><?php echo link_to('homepage', '@homepage') ?></span></h1>
    <ul id="mainNav">
      <?php include_component('swExtraMenu', 'renderMenu', array(
        'name' => 'main',
        'level' => 0
      )); ?>
      <li class="logout"><?php echo link_to(__('signout', null, 'messages'), '@sf_guard_signout') ?></li>
    </ul>
      
    <?php echo sw_get_user_notice()?>
      
    <div id="containerHolder">
      <div id="container">
        <div id="sidebar">
          <ul class="sideNav">
            <?php include_component('swExtraMenu', 'renderMenu', array(
              'name' => 'sidebar',
              'level' => 0
            )); ?>
          </ul>
        </div>
        <div id="sw-base-container-column">
          <?php echo $sf_content ?>
        </div>
        <div class="clear"></div>
      </div>
    </div>  
    <p id="footer"><a href="http://www.soleoweb.com">(c) Soleoweb SARL.</a></p>
  </div>

  <?php if(sfConfig::get('mg_i18n_enabled', false)): ?>
    <?php include_component('mgI18nAdmin', 'displayTranslationBox') ?>
  <?php endif;?>

</body>
</html>

