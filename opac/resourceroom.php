<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
#  require_once("../classes/DmQuery.php");
#  require_once("../functions/errorFuncs.php");
#  require_once("../functions/inputFuncs.php");
#  require_once("../catalog/inputFuncs.php");

  session_cache_limiter(null);

  $tab = "opac";
  $nav = "resourceroom";
  $helpPage = "opac";
#  $focus_form_name = "phrasesearch";
#  $focus_form_field = "searchText";
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);

  $lookup = "N";
  if (isset($_GET["lookup"])) {
    $lookup = "Y";
    $helpPage = "opacLookup";
  }
  require_once("../shared/header_opac.php");
?>



  <h1> SCI Resource Room</h1>

   <h1>  &#23380;&#23376;&#23398;&#38498;&#22810;&#23186;&#20307;&#36164;&#26009;&#23460;</h1>
   <p>&nbsp;</p>

  <p> Collections of Audio Visual materials, Multimedia learning resources and textbooks in use at SCI are located in the Resource Room.</p>
  <p> The Resource Room is also the place for loan service, i.e. issuing and returning the biblography at LCRC. </p>
  <p>All books borrowed and returned must  take to the Resource Room.</p>
  <p>&nbsp;</p>
  <p align="center"><img src="../images/Resource-room.jpg" alt="SCI Resource Room" width="500" height="360"></p>
  <p>&nbsp;</p>
  <p>      
      <?php include("../shared/footer.php"); ?>
</p>
