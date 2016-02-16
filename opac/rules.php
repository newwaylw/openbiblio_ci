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
  $nav = "rules";
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



  <h1>Terms &amp; Conditions of  Language and Culture Resource Centre (LCRC)</h1>

   <h1>  &#12298; &#20013;&#24515; &#12299;&#35268;&#21017;</h1>
   <p>&nbsp;</p>

  <p>1. All the resources can be accessed by the University staff, students and the wider community, including schools and individuals.</p>
  <p>&nbsp;</p>
  <h1>Users of the LCRC Loans Service </h1>
  <p>2. The Loans Service manages the availability of the materials in the LCRC : acquisition, cataloguing, shelving, online service, issue, renewal, return, reservations, recalls, handling of circulation related enquiries, and administration of appropriate penalties for defaulting users . </p>
  <p>3. To be eligible to use the Loans Service , all users must register with the LCRC. Any registered students of the University or member of University staff in possession of a currently valid U-card will use their U-card as their LCRC card. Other users will be issued with a separate card validated for use in the LCRC only. </p>
  <p>4. Every user must present a valid U-card or LCRC card when borrowing. </p>
  <p>&nbsp;</p>
  <h1> Loan Limits, Loan Periods, Renewals, Fines and Lost Charges</h1>
  <p> 5. Users must comply with the rules as to loan entitlements and loan periods, return dates, recalls and renewal conditions listed below. </p>
  <p>&nbsp;</p>

  <h1> Table 1: Loan periods, number of renewals, fines and lost charges</h1>
  <table border="1" cellpadding="2" cellspacing="2">
    <tr >
      <th width="32%" valign="top"> Type of items </th>
      <th width="16%" valign="top"> Loan period, days </th>
	  <th width="13%" valign="top"> Checkout Limit </th>
      <th width="13%" valign="top"> Number of renewal </th>
      <th width="9%" valign="top"> Daily late fee </th>
      <th width="30%" valign="top"> Lost Charge: 3 times of cost price or below, whichever is higher </th>
    </tr>
    <tr>
      <th width="32%" valign="top">For Members of Public and Student </th>
      <td width="16%" valign="top">&nbsp;</td>
	  <td width="16%" valign="top">&nbsp;</td>
      <td width="13%" valign="top">&nbsp;</td>
      <td width="9%" valign="top"><p>&nbsp; </p></td>
      <td width="30%" valign="top"><p>&nbsp; </p></td>
    </tr>
    <tr>
      <td width="32%" valign="top"><p> Book</p></td>
      <td width="16%" valign="top"><p> 21 </p></td>
	  <td width="16%" valign="top">5</td>
      <td width="13%" valign="top"><p> 1 </p></td>
      <td width="9%" valign="top"><p> 5p </p></td>
      <td width="30%" valign="top"><p> &pound;10</p></td>
    </tr>
	    <tr>
      <td width="32%" valign="top"><p> Book + CD / CDROM / DVD</p></td>
      <td width="16%" valign="top"><p> 21 </p></td>
	  <td width="16%" valign="top">5</td>
      <td width="13%" valign="top"><p> 1 </p></td>
      <td width="9%" valign="top"><p> 5p </p></td>
      <td width="30%" valign="top"><p> &pound;10 </p>
        </td>
    </tr>
    <tr>
      <td width="32%" valign="top"><p> Audio and Visual, tape /CD /VCD /DVD /CDROM </p></td>
      <td width="16%" valign="top"><p> 7 </p></td>
	  <td width="16%" valign="top">5</td>
      <td width="13%" valign="top"><p> 1 </p></td>
      <td width="9%" valign="top"><p> 10p </p></td>
      <td width="30%" valign="top"><p> &pound;10 </p></td>
    </tr>
    <tr>
      <td width="32%" valign="top"><p> Magazine &amp; Newspaper </p></td>
      <td width="16%" valign="top"><p> 7 </p></td>
	  <td width="16%" valign="top">5</td>
      <td width="13%" valign="top"><p> 1 </p></td>
      <td width="9%" valign="top"><p> 5p </p></td>
      <td width="30%" valign="top"><p> &pound;5 </p></td>
    </tr>
	    <tr>
      <td width="32%" valign="top"><p> Poster &amp; Card </p></td>
      <td width="16%" valign="top"><p> 7 </p></td>
	  <td width="16%" valign="top">5</td>
      <td width="13%" valign="top"><p> 1 </p></td>
      <td width="9%" valign="top"><p>5p </p></td>
      <td width="30%" valign="top"><p>&pound;5 </p></td>
    </tr>

   
    <tr>
      <td width="32%" valign="top"><p> Dictionary &amp; Reference </p></td>
      <td width="16%" valign="top"><p> - (not for loan) </p></td>
	  <td width="16%" valign="top">0</td>
      <td width="13%" valign="top"><p> - (not for loan) </p></td>
      <td width="9%" valign="top"><p>&nbsp; </p></td>
      <td width="30%" valign="top"><p>&nbsp; </p></td>
    </tr>
    <tr>
      <td width="32%" valign="top"><p>Teaching Resources in use at SCI </p></td>
      <td width="16%" valign="top"><p> - (not for loan) </p></td>
	  <td width="16%" valign="top">0</td>
      <td width="13%" valign="top"><p> - (not for loan) </p></td>
      <td width="9%" valign="top"><p>&nbsp; </p></td>
      <td width="30%" valign="top"><p>&nbsp; </p></td>
    </tr>
	<tr>
      <th width="32%" valign="top">For Member of Staff/Teacher </th>
      <td width="16%" valign="top">&nbsp;</td>
	  <td width="16%" valign="top">&nbsp;</td>
      <td width="13%" valign="top">&nbsp;</td>
      <td width="9%" valign="top"><p>&nbsp; </p></td>
      <td width="30%" valign="top"><p>&nbsp; </p></td>
    </tr>
    <tr>
      <td width="32%" valign="top"><p> Book</p></td>
      <td width="16%" valign="top"><p> 21 </p></td>
	  <td width="16%" valign="top">10</td>
      <td width="13%" valign="top"><p> 3 </p></td>
      <td width="9%" valign="top"><p> 5p </p></td>
      <td width="30%" valign="top"><p> &pound;10</p></td>
    </tr>
	    <tr>
      <td width="32%" valign="top"><p> Book + CD / CDROM / DVD</p></td>
      <td width="16%" valign="top"><p> 21 </p></td>
	  <td width="16%" valign="top">10</td>
      <td width="13%" valign="top"><p> 3 </p></td>
      <td width="9%" valign="top"><p> 5p </p></td>
      <td width="30%" valign="top"><p> &pound;10 </p>
        </td>
    </tr>
    <tr>
      <td width="32%" valign="top"><p> Audio and Visual, tape /CD /VCD /DVD /CDROM </p></td>
      <td width="16%" valign="top"><p> 7 </p></td>
	  <td width="16%" valign="top">5</td>
      <td width="13%" valign="top"><p> 3 </p></td>
      <td width="9%" valign="top"><p> 10p </p></td>
      <td width="30%" valign="top"><p> &pound;10 </p></td>
    </tr>
    <tr>
      <td width="32%" valign="top"><p> Magazine &amp; Newspaper </p></td>
      <td width="16%" valign="top"><p> 7 </p></td>
	  <td width="16%" valign="top">5</td>
      <td width="13%" valign="top"><p> 3 </p></td>
      <td width="9%" valign="top"><p> 5p </p></td>
      <td width="30%" valign="top"><p> &pound;5 </p></td>
    </tr>
	    <tr>
      <td width="32%" valign="top"><p> Poster &amp; Card </p></td>
      <td width="16%" valign="top"><p> 7 </p></td>
	  <td width="16%" valign="top">5</td>
      <td width="13%" valign="top"><p> 3 </p></td>
      <td width="9%" valign="top"><p>5p </p></td>
      <td width="30%" valign="top"><p>&pound;5 </p></td>
    </tr>

   
    <tr>
      <td width="32%" valign="top"><p> Dictionary &amp; Reference </p></td>
      <td valign="top"><p> 7 </p></td>
	  <td width="16%" valign="top">5</td>
      <td valign="top"><p> 3 </p></td>
      <td width="9%" valign="top"><p>10p  </p></td>
      <td width="30%" valign="top"><p> &pound;10</p></td>
    </tr>
    <tr>
      <td width="32%" valign="top"><p>Teaching Resources in use at SCI </p></td>
      <td valign="top"><p> 90 </p></td>
	  <td width="16%" valign="top">10</td>
      <td valign="top"><p> 3 </p></td>
      <td width="9%" valign="top"><p>10p  </p></td>
      <td width="30%" valign="top"><p> &pound;10 </p></td>
    </tr>
  </table>
   <p>&nbsp;</p>
  <h1>Table 2: Maximum Fines </h1>
  <table border="1" cellpadding="2" cellspacing="2">
    <tr >
      <th valign="top">Member classifications </th>
      <th valign="top">Max. Fines /each item</th>
    </tr>
    <tr>
      <td valign="top"><p>Public </p></td>
      <td valign="top"><p>&pound;10</p></td>
    </tr>
    <tr>
      <td valign="top"><p>Staff / Teacher </p></td>
      <td valign="top"><p>&pound;5</p></td>
    </tr>
    <tr>
      <td valign="top"><p>Student </p></td>
      <td valign="top"><p>&pound;3</p></td>
    </tr>
  </table>
 <p>&nbsp;</p>
  <p> 6. Resources are available on loan to registered users, except current issues of magazines and newspapers, Dictionaries &amp; References and Teaching Textbooks currently in use at SCI.<strong></strong></p>
  <p> 7. No resources may be removed from the Centre without its loan being recorded. The borrower of an item as shown in the current loan record is responsible for the safe return of that item, and liable for any loss or damage to it. </p>
  <p> 8. Users must comply with all relevant legal requirements, including those relating to copyright, data protection and computer misuse. </p>
  <p> 9. The loan can be renewed either in person at the LCRC or other contacts. A loan may not be renewed, if: </p>
  <p> - it is required by the LCRC for SCI teaching and learning activities. </p>
  <p> - the maximum number of renewals allowed is reached. </p>
  <p> - someone has already reserved the item.</p>
  <p>  10. Items on loan must be returned to the LCRC so that the loan can be correctly discharged. </p>
  <p> 11. No items may be taken outside the UK. </p>
  <p> 12. Fines are charged on all overdue items. Fines must be paid promptly, otherwise borrowing will be suspended. </p>
  <p>&nbsp;</p>
  <h1> Alteration of user details</h1>
  <p> 13. The user is responsible for informing any changes of the details registered with the LCRC. </p>
  <p> 14. The LCRC may inform the user by sending an email or giving the user a phone call about overdue or reservation. If contacting the user fails because of incorrect contacting details, the user is responsible for any charges results from it. </p>
  <p>&nbsp; </p>
  <h1> Use the facilities at the Resource Centre </h1>
  15. The LCRC has a Reading Room and a Multimedia Room, which are equipped with integrated television/VCD/DVD set, CCTV-4 Programme, CD/Cassette player, and computers, and can be accessed by the independent users for accessing AV materials and electronic resources.
  <p>
      <?php include("../shared/footer.php"); ?>
</p>
