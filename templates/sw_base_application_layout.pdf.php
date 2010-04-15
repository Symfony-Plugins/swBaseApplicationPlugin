<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <?php include_javascripts() ?>
  <?php include_stylesheets() ?>
  <?php include_title() ?>
</head>

<body>
  <div id="wrapper">
    <h1 class="logo"><span><?php echo link_to('homepage', '@homepage') ?></span></h1>
      
    <div id="sw-base-container-column">
      <?php echo $sf_content ?>
    </div>
  </div>
</body>
</html>

