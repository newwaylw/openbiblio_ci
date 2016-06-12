<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  session_cache_limiter(null);

  #****************************************************************************
  #*  Checking for post vars.  Go back to form if none found.
  #****************************************************************************
  if (count($_POST) == 0) {
    header("Location: ../catalog/index.php");
    exit();
  }

  #****************************************************************************
  #*  Checking for tab name to show OPAC look and feel if searching from OPAC
  #****************************************************************************
  $tab = "cataloging";
  $helpPage = "biblioSearch";
  $lookup = "N";
  if (isset($_POST["tab"])) {
    $tab = $_POST["tab"];
  }
  if (isset($_POST["lookup"])) {
    $lookup = $_POST["lookup"];
    if ($lookup == 'Y') {
      $helpPage = "opacLookup";
    }
  }

  $nav = "search";
  if ($tab != "opac") {
    require_once("../shared/logincheck.php");
  }
  require_once("../classes/BiblioSearch.php");
  require_once("../classes/BiblioSearchQuery.php");
  require_once("../functions/searchFuncs.php");
  require_once("../classes/DmQuery.php");

  #****************************************************************************
  #*  Function declaration only used on this page.
  #****************************************************************************
  function printResultPages_bak(&$loc, $currPage, $pageCount, $sort) {
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
      echo "<a href=\"javascript:changePage(".($currPage+1).",'".$sort."')\">".$loc->getText("biblioSearchNext")."&raquo;</a> $currPage , $pageCount";
    }
  }

//function to 
function printResultPages(&$loc, $currPage, $pageCount, $sort)
{   
  
  //other vars
  $prev = $currPage - 1;                  //previous page is page - 1
  $next = $currPage + 1;                  //next page is page + 1
  $lpm1 = $pageCount - 1;                //last page minus 1
  $adjacents = 1;
  /* 
    Now we apply our rules and draw the pagination object. 
    We're actually saving the code to a variable in case we want to draw it more than once.
  */
  $pagination = "";
  if($pageCount > 1)
  { 
    $pagination .= "<div class=\"pagination\"";
    if($margin || $padding)
    {
      $pagination .= " style=\"";
      if($margin)
        $pagination .= "margin: $margin;";
      if($padding)
        $pagination .= "padding: $padding;";
      $pagination .= "\"";
    }
    $pagination .= ">";

    //previous button
    if ($currPage > 1) 
      $pagination .= "<a href=\"javascript:changePage(".H(addslashes($prev)).",'".H(addslashes($sort))."')\">prev</a>";
    else
      $pagination .= "<span class=\"disabled\">prev</span>";  
    
    //pages 
    if ($pageCount < 10 + ($adjacents * 2)) //not enough pages to bother breaking it up
    { 
      for ($counter = 1; $counter <= $pageCount; $counter++)
      {
        if ($counter == $currPage)
          $pagination .= "<span class=\"current\"> $currPage </span>";
        else
          $pagination .="<a href=\"javascript:changePage(".H(addslashes($counter)).",'".H(addslashes($sort))."')\"> $counter </a>";         
      }
    }
    elseif($pageCount >= 10 + ($adjacents * 2)) //enough pages to hide some
    {
      //close to beginning; only hide later pages
      if($currPage < 1 + ($adjacents * 3))    
      {
        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
        {
          if ($counter == $currPage)
            $pagination .= "<span class=\"current\"> $counter </span>";
          else
            $pagination .= "<a href=\"javascript:changePage(".($counter).",'".$sort."')\"> $counter </a>";         
        }
        $pagination .= "<span class=\"elipses\">...</span>";
        $pagination .= "<a href=\"javascript:changePage(".($lpm1).",'".$sort."')\">$lpm1</a>";
        $pagination .= "<a href=\"javascript:changePage(".($pageCount).",'".$sort."')\"> $pageCount </a>";   
      }
      //in middle; hide some front and some back
      elseif($pageCount - ($adjacents * 2) > $currPage && $currPage > ($adjacents * 2))
      {
        $pagination .= "<a href=\"javascript:changePage(".(1).",'".$sort."')\"> 1 </a>";
        $pagination .= "<a href=\"javascript:changePage(".(2).",'".$sort."')\"> 2 </a>";
        $pagination .= "<span class=\"elipses\">...</span>";
        for ($counter = $currPage - $adjacents; $counter <= $currPage + $adjacents; $counter++)
        {
          if ($counter == $currPage)
            $pagination .= "<span class=\"current\"> $counter </span>";
          else
            $pagination .= "<a href=\"javascript:changePage(".($counter).",'".$sort."')\"> $counter </a>";         
        }
        $pagination .= "...";
        $pagination .= "<a href=\"javascript:changePage(".($lpm1).",'".$sort."')\">$lpm1</a>";
        $pagination .= "<a href=\"javascript:changePage(".($pageCount).",'".$sort."')\"> $pageCount </a>";   
      }
      //close to end; only hide early pages
      else
      {
        $pagination .= "<a href=\"javascript:changePage(".(1).",'".$sort."')\"> 1 </a>";
        $pagination .= "<a href=\"javascript:changePage(".(2).",'".$sort."')\"> 2 </a>";
        $pagination .= "<span class=\"elipses\">...</span>";
        for ($counter = $pageCount - (1 + ($adjacents * 3)); $counter <= $pageCount; $counter++)
        {
          if ($counter == $currPage)
            $pagination .= "<span class=\"current\"> $counter </span>";
          else
            $pagination .= "<a href=\"javascript:changePage(".($counter).",'".$sort."')\"> $counter </a>";         
        }
      }
    }
    
    //next button
    if ($currPage < $counter - 1) 
      $pagination .= "<a href=\"javascript:changePage(".($next).",'".$sort."')\">next </a>";
    else
      $pagination .= "<span class=\"disabled\">next </span>";
    $pagination .= "</div>\n";
  }
  
  echo "$pagination" ;

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
  if (isset($_POST["page"])) {
    $currentPageNmbr = intval($_POST["page"]);
  } else {
    $currentPageNmbr = 1;
  }
  $searchType = $_POST["searchType"];
  $sortBy = $_POST["sortBy"];
  if ($sortBy == "default") {
    if ($searchType == "author") {
      $sortBy = "author";
    } else {
      $sortBy = "title";
    }
  }
  $searchText = trim($_POST["searchText"]);
  #echo "$searchText";
  # remove redundant whitespace
  $searchText = preg_replace('/\s+/', " ", $searchText);
  if ($searchType == "barcodeNmbr") {
    $sType = OBIB_SEARCH_BARCODE;
    $words[] = $searchText;
  } else {
    $words = explodeQuoted($searchText);
    if ($searchType == "author") {
      $sType = OBIB_SEARCH_AUTHOR;
    } elseif ($searchType == "title") {
      $sType = OBIB_SEARCH_TITLE;
    } else {
      $sType = OBIB_SEARCH_KEYWORD;
    }
  }

  //Wei Liu newway edit
  if(isset($_POST['materialCd'])){
    $materialCd = $_POST['materialCd'];
  }else{
    $materialCd = 'all';
  }

  if(isset($_POST['collectionCd'])){
    $collectionCd = $_POST['collectionCd'];
  }else{
    $collectionCd = 'all';
  }
  #****************************************************************************
  #*  Search database
  #****************************************************************************
  $biblioQ = new BiblioSearchQuery();
  $biblioQ->setItemsPerPage(OBIB_ITEMS_PER_PAGE);
  $biblioQ->connect();
  if ($biblioQ->errorOccurred()) {
    $biblioQ->close();
    displayErrorPage($biblioQ);
  }
  # checking to see if we are in the opac search or logged in
  if ($tab == "opac") {
    $opacFlg = true;
  } else {
    $opacFlg = false;
  }
  if (!$biblioQ->search2($sType, $materialCd, $collectionCd, $words,$currentPageNmbr,$sortBy,$opacFlg)) {
    $biblioQ->close();
    displayErrorPage($biblioQ);
  }

  # Redirect to biblio_view if only one result
  if ($biblioQ->getRowCount() == 1 && $lookup !== 'Y') {
    $biblio = $biblioQ->fetchRow();
    header('Location: ../shared/biblio_view.php?bibid='.U($biblio->getBibid()).'&tab='.U($tab));
    exit();
  }
  
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
  if ($biblioQ->getRowCount() == 0) {
    $biblioQ->close();
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
  <input type="hidden" name="searchType" value="<?php echo H($_POST["searchType"]);?>">
  <input type="hidden" name="searchText" value="<?php echo H($_POST["searchText"]);?>">
  <input type="hidden" name="sortBy" value="<?php echo H($_POST["sortBy"]);?>">
  <input type="hidden" name="lookup" value="<?php echo H($lookup);?>">
  <input type="hidden" name="page" value="1">
  <input type="hidden" name="tab" value="<?php echo H($tab);?>">
</form>

<!--**************************************************************************
    *  Printing result stats and page nav
    ************************************************************************** -->
<?php 
  echo $loc->getText("biblioSearchResultTxt",array("items"=>$biblioQ->getRowCount()));
  if ($biblioQ->getRowCount() > 1) {
    echo $loc->getText("biblioSearch".$sortBy);
    if ($sortBy == "author") {
      echo "(<a href=\"javascript:changePage(".$currentPageNmbr.",'title')\">".$loc->getText("biblioSearchSortByTitle")."</a>).";
    } else {
      echo "(<a href=\"javascript:changePage(".$currentPageNmbr.",'author')\">".$loc->getText("biblioSearchSortByAuthor")."</a>).";
    }
  }
?>
<br />
<?php printResultPages($loc, $currentPageNmbr, $biblioQ->getPageCount(), $sortBy); ?><br>
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
    while ($biblio = $biblioQ->fetchRow()) {
      if ($biblio->getBibid() == $priorBibid) {
        if ($biblio->getBarcodeNmbr() != "") {
          #************************************
          #* print copy line only
          #************************************
          ?>
          <tr>
            <td nowrap="true" class="primary" valign="top" align="center"><font class="small">
              <?php echo H($biblioQ->getCurrentRowNmbr());?>.
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
      <?php echo H($biblioQ->getCurrentRowNmbr());?>.<br />
      <a href="../shared/biblio_view.php?bibid=<?php echo HURL($biblio->getBibid());?>&amp;tab=<?php echo HURL($tab);?>">
      <img src="../images/<?php echo HURL($materialImageFiles[$biblio->getMaterialCd()]);?>" width="20" height="20" border="0" align="bottom" alt="<?php echo H($materialTypeDm[$biblio->getMaterialCd()]);?>"></a>
    </td>

    <?php
        $img_path = UPLOAD_DIR . $biblio->getImageLocation();
        // Constraints
        $max_width = 130;
        $max_height = 130;

        #Wei Liu : if $img_path doesn't exist, show default image.
        #usually this means files are missing in the uploads folder, but was recorded by database. 
        if(!file_exists($img_path)){
          $img_path = UPLOAD_DIR . DEFAULT_IMAGE§;
        }
        list($width, $height) = getimagesize($img_path);
        $ratioh = $max_height/$height;
        $ratiow = $max_width/$width;
        $ratio = min($ratioh, $ratiow);
        // New dimensions
        $width = intval($ratio*$width);
        $height = intval($ratio*$height);
	?>
    <td style="vertical-align:middle" align="center">
    <?php $title =$biblio->getTitle(); echo "<img src=\"$img_path\" width=\"$width\" height=\"$height\" title=\" $title \" >"; ?>
    </td>

    <td class="primary" valign="top" colspan="2">
      <table class="primary" width="100%">
        <tr>
          <td class="noborder" width="1%" valign="top"><b><?php echo $loc->getText("biblioSearchTitle"); ?>:</b></td>
          <td class="noborder" colspan="3"><a href="../shared/biblio_view.php?bibid=<?php echo HURL($biblio->getBibid());?>&amp;tab=<?php echo HURL($tab);?>"><?php echo H($biblio->getTitle());?></a></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><b><?php echo $loc->getText("biblioSearchAuthor"); ?>:</b></td>
          <td class="noborder" colspan="3"><?php if ($biblio->getAuthor() != "") echo H($biblio->getAuthor());?></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchLanguage"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small"><?php echo H($biblio->getLanguage());?></font></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchMaterial"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small"><?php echo H($materialTypeDm[$biblio->getMaterialCd()]);?></font></td>
        </tr>
        <tr>
          <td class="noborder" valign="top"><font class="small"><b><?php echo $loc->getText("biblioSearchCollection"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small"><?php echo H($collectionDm[$biblio->getCollectionCd()]);?></font></td>
        </tr>
        <tr>
          <td class="noborder" valign="top" nowrap="yes"><font class="small"><b><?php echo $loc->getText("biblioSearchCall"); ?>:</b></font></td>
          <td class="noborder" colspan="3"><font class="small"><?php echo H($biblio->getCallNmbr1()." ".$biblio->getCallNmbr2()." ".$biblio->getCallNmbr3());?></font></td>
        </tr>
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
    $biblioQ->close();
  ?>
  </table><br>
<?php printResultPages($loc, $currentPageNmbr, $biblioQ->getPageCount(), $sortBy); ?><br>
<?php require_once("../shared/footer.php"); ?>
