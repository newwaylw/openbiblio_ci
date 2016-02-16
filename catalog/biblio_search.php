<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  require_once("../shared/global_constants.php");
  session_cache_limiter(null);
#   session_cache_limiter('private');
  #****************************************************************************
  #*  Checking for post vars.  Go back to form if none found.
  #****************************************************************************
  if (count($_GET) == 0) {
    header("Location: ../catalog/index.php");
    exit();
  }
   
  #### print env vars.####
#  foreach($_GET as $key=>$value){
#    print "$key : $value<br>";
#}



  #****************************************************************************
  #*  Checking for tab name to show OPAC look and feel if searching from OPAC
  #****************************************************************************
  $tab = "cataloging";
  $helpPage = "biblioSearch";
  $lookup = "N";
  if (isset($_GET["tab"])) {
    $tab = $_GET["tab"];
  }
  if (isset($_GET["lookup"])) {
    $lookup = $_GET["lookup"];
    if ($lookup == 'Y') {
      $helpPage = "opacLookup";
    }
  }
  
  $nav = "search";
  if ($tab != "opac") {
    require_once("../shared/logincheck.php");
  }
  require_once("../classes/BiblioSearch.php");
  require_once("../classes/BiblioQuery.php");
  require_once("../classes/BiblioSearchQuery.php");
  require_once("../functions/searchFuncs.php");
  require_once("../classes/DmQuery.php");

  #****************************************************************************
  #*  Function declaration only used on this page.
  #****************************************************************************
  function printResultPages(&$loc, $currPage, $pageCount, $sort) {
    if ($pageCount <= 1) {
      return false;
    }
    echo $loc->getText("biblioSearchResultPages").": ";
    $maxPg = OBIB_SEARCH_MAXPAGES + 1;
    if ($currPage > 1) {
      echo "<a href=\"javascript:changePage(".H(addslashes($currPage-1)).",'".H(addslashes($sort))."')\">&laquo;".$loc->getText("biblioSearchPrev")."</a> ";
    }
    for ($i = 1; $i <= $pageCount; $i++) {
      if ($i < $maxPg) {
        if ($i == $currPage) {
          echo "<b>".H($i)."</b> ";
        } else {
          echo "<a href=\"javascript:changePage(".H(addslashes($i)).",'".H(addslashes($sort))."')\">".H($i)."</a> ";
        }
      } elseif ($i == $maxPg) {
        echo "... ";
      }
    }
    if ($currPage < $pageCount) {
      echo "<a href=\"javascript:changePage(".($currPage+1).",'".$sort."')\">".$loc->getText("biblioSearchNext")."&raquo;</a> ";
    }
  }

  #****************************************************************************
  #*  Loading a few domain tables into associative arrays
  #****************************************************************************
  $dmQ = new DmQuery();
  $dmQ->connect();
  $collectionDm = $dmQ->getAssoc("collection_dm");
  $materialTypeDm = $dmQ->getAssoc("material_type_dm");
  $materialImageFiles = $dmQ->getAssoc("material_type_dm", "image_file");
  $biblioStatusDm = $dmQ->getAssoc("biblio_status_dm");
  $dmQ->close();

  #****************************************************************************
  #*  Retrieving post vars and scrubbing the data
  #****************************************************************************
  if (isset($_GET["page"])) {
    $currentPageNmbr = $_GET["page"];
  } else {
    $currentPageNmbr = 1;
  }
  $searchType = $_GET["searchType"];
  $sortBy = $_GET["sortBy"];
  if ($sortBy == "default") {
    if ($searchType == "author") {
      $sortBy = "author";
    } else {
      $sortBy = "title";
    }
  }
  $searchText = trim($_GET["searchText"]);
  # remove redundant whitespace
  $searchText = eregi_replace("[[:space:]]+", " ", $searchText);
  if ($searchType == "barcodeNmbr") {
    $sType = OBIB_SEARCH_BARCODE;
    $words[] = $searchText;
  } else {
    $words = explodeQuoted($searchText);
    if ($searchType == "author") {
      $sType = OBIB_SEARCH_AUTHOR;
    } elseif ($searchType == "subject") {
      $sType = OBIB_SEARCH_SUBJECT;
    } else {
      $sType = OBIB_SEARCH_TITLE;
    }
}
  if(isset($_GET['materialCd'])){
  $materialCd = $_GET['materialCd'];
  }else{
  $materialCd = 'all';
  }

    if(isset($_GET['collectionCd'])){
      $collectionCd = $_GET['collectionCd'];
  }else{
       $collectionCd = 'all';
  }


#  print "collectionCd = $collectionCd <br>";
#  print "materialCd = $materialCd <br>";
  #****************************************************************************
  #*  Search database
  #****************************************************************************
  $biblioSearchQ = new BiblioSearchQuery();
#  $biblioQ = new BiblioQuery();
  $biblioSearchQ->setItemsPerPage(OBIB_ITEMS_PER_PAGE);
  $biblioSearchQ->connect();
  if ($biblioSearchQ->errorOccurred()) {
    $biblioSearchQ->close();
    displayErrorPage($biblioSearchQ);
  }
  # checking to see if we are in the opac search or logged in
  if ($tab == "opac") {
    $opacFlg = true;
  } else {
    $opacFlg = false;
  }
  if (!$biblioSearchQ->search2($sType,$materialCd, $collectionCd, $words,$currentPageNmbr,$sortBy,$opacFlg)) {
    $biblioSearchQ->close();
    displayErrorPage($biblioSearchQ);
  }
  
  #****************************************************************************
  #*  Search database for more details
  #****************************************************************************
  #$biblioQ = new BiblioQuery();
  #$biblioQ->connect();
  #if ($biblioQ->errorOccurred()) {
  #  $biblioQ->close();
  #  displayErrorPage($biblioQ);
  #}
  #if (!$biblio = $biblioQ->doQuery($bibid)) {
  #  $biblioQ->close();
  #  displayErrorPage($biblioQ);
  #}
  #$biblioFlds = $biblio->getBiblioFields();



  #**************************************************************************
  #*  Show search results
  #**************************************************************************
  if ($tab == "opac") {
    require_once("../shared/header_opac.php");
  } else {
    require_once("../shared/header.php");
  }
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,"shared");

  # Display no results message if no results returned from search.
  if ($biblioSearchQ->getRowCount() == 0) {
    $biblioSearchQ->close();
    echo $loc->getText("biblioSearchNoResults");
    require_once("../shared/footer.php");
    exit();
  }
?>

<!--**************************************************************************
    *  Javascript to post back to this page
    ************************************************************************** -->
<script language="JavaScript" type="text/javascript">
<!--
function changePage(page,sort)
{
  document.changePageForm.page.value = page;
  document.changePageForm.sortBy.value = sort;
  document.changePageForm.submit();
}
-->
</script>


<!--**************************************************************************
    *  Form used by javascript to post back to this page
    ************************************************************************** -->
<form name="changePageForm" method="POST" action="../shared/biblio_search.php">
  <input type="hidden" name="searchType" value="<?php echo H($_GET["searchType"]);?>">
  <input type="hidden" name="searchText" value="<?php echo H($_GET["searchText"]);?>">
  <input type="hidden" name="materialCd" value="<?php echo H($_GET["materialCd"]);?>">
  <input type="hidden" name="collectionCd" value="<?php echo H($_GET["collectionCd"]);?>">
  <input type="hidden" name="sortBy" value="<?php echo H($_GET["sortBy"]);?>">
  <input type="hidden" name="lookup" value="<?php echo H($lookup);?>">
  <input type="hidden" name="page" value="1">
  <input type="hidden" name="tab" value="<?php echo H($tab);?>">
</form>

<!--**************************************************************************
    *  Printing result stats and page nav
    ************************************************************************** -->
<?php 
  echo $loc->getText("biblioSearchResultTxt",array("items"=>$biblioSearchQ->getRowCount()));
  if ($biblioSearchQ->getRowCount() > 1) {
    echo $loc->getText("biblioSearch".$sortBy);
    if ($sortBy == "author") {
      echo "(<a href=\"javascript:changePage(".$currentPageNmbr.",'title')\">".$loc->getText("biblioSearchSortByTitle")."</a>).";
    } else {
      echo "(<a href=\"javascript:changePage(".$currentPageNmbr.",'author')\">".$loc->getText("biblioSearchSortByAuthor")."</a>).";
    }
  }
?>
<br />
<?php printResultPages($loc, $currentPageNmbr, $biblioSearchQ->getPageCount(), $sortBy); ?><br>
<br>

<!--**************************************************************************
    *  Printing result table
    ************************************************************************** -->
<table class="primary">
  <tr>
    <th valign="top" nowrap="yes" align="left" colspan="3">
      <?php echo $loc->getText("biblioSearchResults"); ?>:
    </th>
  </tr>
  <?php
    $priorBibid = 0;
    while ($biblio = $biblioSearchQ->fetchRow()) {
      if ($biblio->getBibid() == $priorBibid) {
        if ($biblio->getBarcodeNmbr() != "") {
          #************************************
          #* print copy line only
          #************************************
          ?>
          <tr>
            <td nowrap="true" class="primary" valign="top" align="center"><font class="small">
              <?php echo H($biblioSearchQ->getCurrentRowNmbr());?>.
            </font></td>
            <td class="primary" ><font class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: <?php echo H($biblio->getBarcodeNmbr());?>
              <?php if ($lookup == 'Y') { ?>
                <a href="javascript:returnLookup('barcodesearch','barcodeNmbr','<?php echo H(addslashes($biblio->getBarcodeNmbr()));?>')"><?php echo $loc->getText("biblioSearchOutIn"); ?></a> | <a href="javascript:returnLookup('holdForm','holdBarcodeNmbr','<?php echo H(addslashes($biblio->getBarcodeNmbr()));?>')"><?php echo $loc->getText("biblioSearchHold"); ?></a>
              <?php } ?>
            </font></td>
            <td class="primary" ><font class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: <?php echo H($biblioStatusDm[$biblio->getStatusCd()]);?></font></td>
          </tr>
          <?php 
        }
      } else {
        $priorBibid = $biblio->getBibid();

  ?>

  <tr>
    <td nowrap="true" class="primary" valign="top" align="center" rowspan="2">
      <?php echo H($biblioSearchQ->getCurrentRowNmbr());?>.<br />
      <a href="../shared/biblio_view.php?bibid=<?php echo HURL($biblio->getBibid());?>&amp;tab=<?php echo HURL($tab);?>">
      <img src="../images/<?php echo HURL($materialImageFiles[$biblio->getMaterialCd()]);?>" width="20" height="20" border="0" align="bottom" alt="<?php echo H($materialTypeDm[$biblio->getMaterialCd()]);?>"></a>
    </td>

    <td>
    <img src="<?php echo UPLOAD_DIR . $biblio->getImageLocation() ; ?>" width="75" height="120"/>
    </td>

    <td class="primary" valign="top" colspan="2">
      <table class="primary" width="100%">
        <tr>
          <td class="noborder" width="1%" valign="top"><b><?php echo $loc->getText("biblioSearchTitle"); ?>:</b></td>
          <td class="noborder" colspan="3"><a href="../shared/biblio_view.php?bibid=<?php echo HURL($biblio->getBibid());?>&amp;tab=<?php echo HURL($tab);?>"><?php echo H($biblio->getTitle());?></a></td>
        </tr>
        <tr>
        <td class="noborder" valign="top"><b><?php echo $loc->getText(""); ?></b></td>
        <td class="noborder" colspan="3"><?php if ($biblio->getTitleRemainder() != "") echo H($biblio->getTitleRemainder());?></td>

        </tr>  
          
        <tr>
          <td class="noborder" valign="top"><b><?php echo $loc->getText("biblioSearchAuthor"); ?>:</b></td>
          <td class="noborder" colspan="3"><?php if ($biblio->getAuthor() != "") echo H($biblio->getAuthor());?></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchMaterial"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small"><?php echo H($materialTypeDm[$biblio->getMaterialCd()]);?></font></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchCollection"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small"><?php echo H($collectionDm[$biblio->getCollectionCd()]);?></font></td>
        </tr>
        <!--
        <tr>
          <td class="noborder" valign="top" nowrap="yes"><font class="small"><b><?php echo $loc->getText("biblioSearchCall"); ?>:</b></font></td>
         <td class="noborder" colspan="3"><font class="small"><?php echo H($biblio->getCallNmbr1()." ".$biblio->getCallNmbr2()." ".$biblio->getCallNmbr3());?></font></td> 
        </tr>
   w.liu edited -->
      </table>
    </td>
  </tr>
  <?php
    if ($biblio->getBarcodeNmbr() != "") {
      ?>
      <tr>
        <td class="primary" ><font class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: <?php echo H($biblio->getBarcodeNmbr());?>
          <?php if ($lookup == 'Y') { ?>
            <a href="javascript:returnLookup('barcodesearch','barcodeNmbr','<?php echo H(addslashes($biblio->getBarcodeNmbr()));?>')"><?php echo $loc->getText("biblioSearchOutIn"); ?></a> | <a href="javascript:returnLookup('holdForm','holdBarcodeNmbr','<?php echo H(addslashes($biblio->getBarcodeNmbr()));?>')"><?php echo $loc->getText("biblioSearchHold"); ?></a>
          <?php } ?>
        </font></td>
        <td class="primary" ><font class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: <?php echo H($biblioStatusDm[$biblio->getStatusCd()]);?></font></td>
      </tr>
    <?php } else { ?>
      <tr>
         <td class="primary" colspan="2" ><font class="small"><?php echo $loc->getText("biblioSearchNoCopies"); ?></font></td>
      </tr>
    <?php 
    }
      }
    }
    $biblioSearchQ->close();
  ?>
  </table><br>
<?php printResultPages($loc, $currentPageNmbr, $biblioSearchQ->getPageCount(), $sortBy); ?><br>
<?php require_once("../shared/footer.php"); ?>
