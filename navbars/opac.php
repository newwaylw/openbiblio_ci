<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../classes/Localize.php");
  $navLoc = new Localize(OBIB_LOCALE,"navbars");
?>


<?php if ($nav == "home") { ?>
 &raquo; <?php echo $navLoc->getText("catalogSearch1"); ?><br>
<?php } else { ?>
 <a href="../opac/index.php" class="alt1"><?php echo $navLoc->getText("catalogSearch1"); ?></a><br>
<?php } ?>

<?php if ($nav == "search") { ?>
 &raquo; <?php echo $navLoc->getText("catalogResults"); ?><br>
<?php } ?>

<?php if ($nav == "view") { ?>
 &raquo; <?php echo $navLoc->getText("catalogBibInfo"); ?><br>
<?php } ?>

<p>
<?php if ($nav == "howto") { ?>
 &raquo; <?php echo "How to borrow" ?><br>
<?php } else { ?>
 <a href="../opac/howto.php" class="alt1"><?php echo "How to borrow"; ?></a><br>
<?php } ?>
</p>

<p>
<?php if ($nav == "rules") { ?>
 &raquo; <?php echo "Rules" ?><br>
<?php } else { ?>
 <a href="../opac/rules.php" class="alt1"><?php echo "Rules"; ?></a><br>
<?php } ?>
</p>

<p>
<?php if ($nav == "readingroom") { ?>
 &raquo; <?php echo "Reading Room" ?><br>
<?php } else { ?>
 <a href="../opac/readingroom.php" class="alt1"><?php echo "Reading Room"; ?></a><br>
<?php } ?>
</p>

<p>
<?php if ($nav == "resourceroom") { ?>
 &raquo; <?php echo "Resource Room" ?><br>
<?php } else { ?>
 <a href="../opac/resourceroom.php" class="alt1"><?php echo "Resource Room"; ?></a><br>
<?php } ?>
</p>

<p>
<?php if ($nav == "multimediaroom") { ?>
 &raquo; <?php echo "Multimedia Room" ?><br>
<?php } else { ?>
 <a href="../opac/multimediaroom.php" class="alt1"><?php echo "Multimedia Room"; ?></a><br>
<?php } ?>
</p>

<p>
<?php if ($nav == "aboutus") { ?>
 &raquo; <?php echo "About Us" ?><br>
<?php } else { ?>
 <a href="../opac/about_us.php" class="alt1"><?php echo "About Us"; ?></a><br>
<?php } ?>
</p>

<p>
<?php if ($nav == "contactus") { ?>
 &raquo; <?php echo "Contact Us" ?><br>
<?php } else { ?>
 <a href="../opac/contact_us.php" class="alt1"><?php echo "Contact Us"; ?></a><br>
<?php } ?>
</p>


<a href="javascript:popSecondary('../shared/help.php<?php if (isset($helpPage)) echo "?page=".H(addslashes(U($helpPage))); ?>')"><?php echo $navLoc->getText("Help"); ?></a>
