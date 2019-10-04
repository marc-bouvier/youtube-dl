<?php
include_once("../CONFIG.php");
function navigation_links(){
  return array
  (
    array("Nunurs","https://nunurs.eu")
  );
}

function format_navigation_link($navigation_link){
  ?>
    <li><a href="<?=$navigation_link[1]?>"><?=$navigation_link[01]?></a></li>
  <?php
}

function format_navigation_links($navigation_links){
  foreach ($navigation_links as $navigation_link) {
    format_navigation_link($navigation_link);
  }
}

function format_all_navigation_links(){
  ?>
  <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
    <?php format_navigation_links(navigation_links()); ?>        
    </ul>
  </div>
  <?php
}

?>
