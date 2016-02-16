<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  #require_once("../classes/DmQuery.php");
  #require_once("../functions/errorFuncs.php");
  #require_once("../functions/inputFuncs.php");
  #require_once("../catalog/inputFuncs.php");

  session_cache_limiter(null);

  $tab = "opac";
  $nav = "contactus";
  $helpPage = "opac";
  #$focus_form_name = "phrasesearch";
  #$focus_form_field = "searchText";
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);

  $lookup = "N";
  if (isset($_GET["lookup"])) {
    $lookup = "Y";
    $helpPage = "opacLookup";
  }
  require_once("../shared/header_opac.php");
?>

<h1> Contact Language and Culture Resource Centre (LCRC)</h1>
<h1>&#32852;&#31995;&#25105;&#20204;</h1>
 

<div class="centered">
    <div class="compactcolumns">
      <h1>Address:</h1>
        <P> Language &amp; Cultural Resource Centre <BR>
        Confucius Institute at the University of Sheffield<BR>
        5 Shearwood Road<BR>
        Sheffield<BR>
        S10 2TD<BR>
        UK <BR>
        </P>
        
        <p>Telephone:+44 (0) 114 22 28447 </p>
        <p>Fax:+44 (0) 114 22 28334 </p>
        <p>Email: <a href="mailto:library@chineseresource.org.uk">admin@chineseresource.org.uk</a></p>

        <h1>Find us on map:</h1>
        <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="240" height="300" 
        src="https://maps.google.com/maps?hl=en&q=S10 2TD&ie=UTF8&t=roadmap&z=16&iwloc=B&output=embed">
          <div>
            <small>
              <a href="http://embedgooglemaps.com">embedgooglemaps.com</a>
            </small>
          </div>
          <div>
            <small>
              <a href="https://www.googlemapsgenerator.com/">generate Google Maps</a>
            </small>
          </div>
        </iframe>
        
    </div>


</div>

<div class="columns">
    <div align="center"><img src="../images/SCI-members.jpg" alt="SCI members"></div>
</div>

<p>
   <?php include("../shared/footer.php"); ?>
</p>
