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
  $nav = "aboutus";
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



  <h1> About Language and Culture Resource Centre (LCRC)</h1>




  <h1> &#12298; &#20013;&#24515; &#12299;&#20171;&#32461;</h1>
  <p>&nbsp; </p>
 <p>The Chinese  Language and Culture Resource Centre within the Confucius Institute at the University of Sheffield provides cultural and language resources that can be accessed both by 
the University staff, students and the wider community, including schools and individuals.</p>
 <p>&nbsp; </p>
 <h1> Our Collections </h1>
 
 <p> Assisted with the Office of Chinese Language Council International (OCLCI, commonly known as Hanban), and Confucius Institute Headquarters, we set up the Centre and mastered substantial collections of books and AV (Audio-Visual) materials relating to China, Chinese culture and Chinese language in the following areas: </p>
 <img src="../images/Hanban-Gift-Books.jpg" alt="Hanban Gift Books" align="right">
 <p> - Study and research in contemporary China </p>
 <p> - Chinese novels and literature </p>
 <p> - Chinese films, TV series, documentaries, music and arts </p>
 <p> - Research in Chinese language teaching and learning </p>
 <p> - Chinese textbooks and multimedia, from primary learning, secondary learning to adults learning </p>
 <p>- Chinese dictionaries, references, posters and cards</p>
 <p>- Chinese magzines and newspapers  </p>
 <p>&nbsp;</p>
 <h1>More Acknowledgements</h1>
 <p> Some of our collections are also come from kind individual donations 
from prestigious authors and academics in the UK. We are indebted to 
their generosity and will always be thankful for their contributions 
towards Chinese literature and China-related studies in the UK:</p>
 <p> - Innes Herden (translator, writer and co-founder of the Society for 
Anglo-Chinese Understanding)</p>
 <p> - Elizabeth Scurfield (sinologist, co-founder of the Chinese Department at 
the University of Westminster, and author of the Teach Yourself Chinese 
series)</p>
<p> - Li Ruru (sinologist, expert in Beijing Opera, and senior lecturer at the University of Leeds) </p>
 
 <p>    
   <?php include("../shared/footer.php"); ?>
</p>
