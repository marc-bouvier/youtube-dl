<!-- Fixed navbar -->
<?php include_once("../CONFIG.php"); include_once("nav_links.php");?>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./../">CrunchyRIP</a>
        </div>
        <?php format_all_navigation_links(); ?>
      </div>
    </div>
