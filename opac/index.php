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
  $nav = "home";
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


<h1> Chinese Language and Culture Resource Centre (LCRC) </h1>
<h1>  &#35874;&#33778;&#23572;&#24503;&#22823;&#23398;&#23380;&#23376;&#23398;&#38498;&#20013;&#22269;&#35821;&#35328;&#25991;&#21270;&#36164;&#26009;&#20013;&#24515;</h1>
  <p>&nbsp;</p>
<p> Welcome to our Online Public Access Catalogue (OPAC). Search our 
catalogue to view bibliographic information on holdings we have in the 
Chinese Language and Cultural Resource Centre (LCRC). Items can be 
consulted in our reading room or can be taken out on loan (see terms and 
conditions at left).</p>
<p>Location: Confucius Institute at the University of Sheffield, 5 Shearwood Road, Sheffield S10 2TN </p>
<p>Opening times: Monday - Friday, 2-5pm  </p>
  <p>&nbsp;</p>
<h1> Search </h1>
<p> This database of the collection is still under construction. Please do 
check regularly for availability of more titles or contact us for more 
information.</p>
<form name="phrasesearch" method="POST" action="../shared/biblio_search.php">
<table class="primary">
  <tr>
    <th valign="top" nowrap="yes" align="left">
      <?php echo $loc->getText("opac_SearchTitle");?>
    </td>
  </tr>
  <tr>
    <td nowrap="true" class="primary">
      <select name="searchType">
        <option value="keyword"><?php echo $loc->getText("opac_Keyword");?>
        <option value="title" selected><?php echo $loc->getText("opac_Title");?>
        <option value="author"><?php echo $loc->getText("opac_Author");?>
      </select>
      <input type="text" name="searchText" size="30" maxlength="256">
      <input type="hidden" name="sortBy" value="default">
      <input type="hidden" name="tab" value="<?php echo H($tab); ?>">
      <input type="hidden" name="lookup" value="<?php echo H($lookup); ?>">
      <input type="submit" value="<?php echo $loc->getText("opac_Search");?>" class="button">

    </td>
  </tr>
      <!--- edit by w.liu newway.liu@gmail.com -->
    <tr><td>&nbsp;</td></tr>
  <tr>
    <th colspan="2" valign="top" nowrap="yes" align="left">
      Refine Search Results:
    </th>
  </tr>

  <tr>
    <td align="right" class="primary"><strong>Media Type:</strong></td>
    <td class="primary">
      <!-- w. liu test  -->
      <?php 
        printSelectWithAll("materialCd","material_type_dm",$postVars);
      ?>
  </tr>

  <tr>
    <td align="right" class="primary"><strong>Collection:</strong></td>
    <td class="primary">
       <?php 
         printSelectWithAll("collectionCd","collection_dm",$postVars); 
       ?>
    </td>
  </tr>
  </table>
</form>

 <?php include("../shared/footer.php"); ?>
