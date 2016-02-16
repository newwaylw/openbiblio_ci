<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  require_once("../classes/DmQuery.php");
  require_once("../functions/errorFuncs.php");
  require_once("../functions/inputFuncs.php");
  require_once("../catalog/inputFuncs.php");

  session_cache_limiter(null);

  $tab = "opac";
  $nav = "readingroom";
  $helpPage = "opac";
  $focus_form_name = "phrasesearch";
  $focus_form_field = "searchText";
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);

  $lookup = "N";
  if (isset($_GET["lookup"])) {
    $lookup = "Y";
    $helpPage = "opacLookup";
  }
  require_once("../shared/header_opac.php");
?>



  <h1> SCI Reading Room</h1>


   <h1>  &#23380;&#23376;&#23398;&#38498;&#38405;&#35272;&#23460;</h1>
   <p>&nbsp;</p>
  <p>The SCI Reading Room  is equipped with integrated television/VCD/DVD set, CCTV-4 Satellite Programme, and CD/Cassette player, and can be accessed by the independent users for accessing AV materials and electronic resources.</p>
  <p>&nbsp;</p>
   <h1> Confucius Institute Reading Room Booking Regulations</h1>
  <ul>
    <li> The Confucius Institute reading room may be booked by SEAS Chinese studies students and Confucius Institute students for study or Chinese-English language exchange purposes. </li>
</ul>
  <ul>
    <li> Bookings or booking cancellations need to be made in advance either in person at the SCI office, or by telephone/e-mail (0114 2228332, confucius@sheffield.ac.uk). </li>
</ul>
  <ul>
    <li> Bookings may be made in slots within office hours only (Mon-Fri 9-12:30am and 13:30-5pm). </li>
</ul>
  <ul>
    <li> All users of the Reading Room must sign in at the Confucius Institute reception upon arrival, and sign out when leaving. </li>
</ul>
  <ul>
    <li> CCTV 4 is available to Reading Room users. The use of Chinese TV is strictly limited to Chinese language study purposes. </li>
</ul>
  <ul>
    <li> Books on the Reading Room shelves may be consulted but are currently NOT for loan. Any reading materials used have to be put back where they were taken from. </li>
</ul>
  <ul>
    <li> All furniture and equipment in the Reading Room has to be used with due care. No food or drink may be consumed in the Reading Room. </li>
  </ul>
  <p>&nbsp;</p>
  <div align="center"><img src="../images/Reading-room.jpg" alt="SCI Reading Room">
   <p>&nbsp;</p>
    <img src="../images/Reading-room2.jpg" alt="SCI Reading Room">
	 <p>&nbsp;</p>
	<img src="../images/Reading-room4.jpg" alt="SCI Reading Room">
	
</div>
  <p>      
      <?php include("../shared/footer.php"); ?>
</p>
