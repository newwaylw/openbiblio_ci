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
  $nav = "multimediaroom";
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



  <h1> SCI Multimedia Room</h1>


  <h1> &#23380;&#23376;&#23398;&#38498;&#22810;&#23186;&#20307;&#25945;&#23460;</h1>
   <p>&nbsp;</p>
  <p>The SCI Multimedia Room is quipped with computers and interactive whiteboard, and can be accessed by the independent users for accessing AV materials and electronic resources.</p>
  <p>&nbsp;</p>
<h1> Confucius Institute Multimedia Room Regulations</h1>  
    
 
    <ul>
      <li> The Confucius Institute Multimedia Room may be used by SEAS Chinese studies students and Confucius Institute students for study or Chinese-English language exchange purposes.  </li>
    </ul>
    <ul>
      <li> The Multimedia Room facilities are available within office hours only (Mon-Fri 9-12:30am and 13:30-5pm).  </li>
    </ul>
    <ul>
      <li> All users of the Multimedia Room must sign in at the Confucius Institute reception upon arrival, and sign out when leaving.  </li>
    </ul>
    <ul>
      <li> The computers in the Multimedia Room are equipped with Chinese language learning software, and are to be used for Chinese language study and related coursework only. The master computer and interactive whiteboard may only be used by SCI staff members. All computers are managed by LCRC and all software must get permission for downloading.  </li>
    </ul>
    <ul>
      <li> The Multimedia Room is situated immediately next to SCI staff offices and is therefore a quiet working area &ndash; please do keep this in mind while using it. </li>
    </ul>
       <ul>
      <li>  All furniture and equipment in the Multimedia Room has to be used with due care. No food or drink may be consumed in the room.</li>
    </ul>
<p>&nbsp; </p>
<div align="center"><img src="../images/Multimedia-room.jpg" alt="SCI Multimedia Room">
</div>
<p>&nbsp; </p>
<div align="center"><img src="../images/Multimedia-room2.jpg" alt="SCI Multinedia Room">
<p>&nbsp; </p>
      <?php include("../shared/footer.php"); ?>
</div>
</p>