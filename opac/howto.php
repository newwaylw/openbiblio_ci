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
  $nav = "howto";
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



  <h1> How to borrow at Language &amp; Cultural Resource Centre (LCRC) </h1>
   <h1> &#22914;&#20309;&#20511;&#38405; </h1>
  <p>&nbsp;</p>
  <h1> Register at LCRC </h1>

<p>To be eligible to use the Loans Service , all users must register with the LCRC. </p>
<p>Any registered students of the University or member of University staff in possession of a currently valid U-card will use their U-card as their LCRC card. </p>
<p>Other users will be issued with a separate card validated for use in the LCRC only.</p>
<p> Every user must present a valid U-card or LCRC card when borrowing at LCRC. </p>
<p>&nbsp;</p>
<h1>User details</h1>
<P> The user is responsible for correct information and informing any changes of the details registered with the LCRC. </P>
<P>The LCRC may inform the user by sending an email or giving the user a phone call about overdue or reservation. If contacting the user fails because of incorrect contacting details, the user is responsible for any charges results from it. </P>
<p>  <?php include("../shared/footer.php"); ?>
</p>
