<!DOCTYPE html>
<html>
 <?php echo $this->element('creatheader')?>
  <body class='contrast-red '>
    <?php echo $this->element('creattop')?>
    <div id='wrapper'>
      <div id='main-nav-bg'></div>
      <?php echo $this->element('sidebarnew')?>
      <section id='content'>
        <div class='container'>
          <?php echo $content_for_layout; ?>
          <?php echo $this->element('creatfooter')?>
  </body>
</html>
