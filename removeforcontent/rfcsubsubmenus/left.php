
<div class="menu">
<img src="../../nsr_images/nsr_logo.gif"><br>
<div class="menuheader">NSR</div>
<div class="<? if ( $area2 == "main" ) { echo "menuitemOn"; } else { echo "menuitem"; } ?>"><a href="/index.php">main</a></div>
<div class="<? if ( $area2 == "pc" ) { echo "menuitemOn"; } else { echo "menuitem"; } ?>"><a href="/main.php?page=pc">pc</a></div>
<div class="<? if ( $area2 == "tech" ) { echo "menuitemOn"; } else { echo "menuitem"; } ?>"><a href="/main.php?page=tech">tech</a></div>
<div class="<? if ( $area2 == "linux" ) { echo "menuitemOn"; } else { echo "menuitem"; } ?>"><a href="/main.php?page=linux">linux</a></div>
<div class="<? if ( $area2 == "gamer" ) { echo "menuitemOn"; } else { echo "menuitem"; } ?>"><a href="/main.php?page=gamer">gamer</a></div>
<div class="<? if ( $area2 == "about" ) { echo "menuitemOn"; } else { echo "menuitem"; } ?>"><a href="/about.php?page=about">about</a></div>
<div class="menuitem"><a href="http://www.cafepress.com/thensr" target="_blank">merchandise</a></div>
<? if (!isset($_COOKIE["user"])) { ?>
<div id="login">
<input type="text" class="txtbox" onClick="value=''" value="user" size="12" id="user">
<input type="password" class="txtbox" onClick="value=''" size="12" id="pass">
<input type="button" value="login" size="4" onClick="validatelogin();" id="login" style="color: #FFFFFF; width: 40px; background-color: #7fb2df;">
</div>
<div id="loggedin" style="width: 150px;">
</div>
<? } else { ?>
<div id="loggedin" style="width: 150px;">
<p class="yellow">Welcome, <? echo $_COOKIE["user"]; ?></p>
<input type="button" value="logout" size="4" onClick="logout();" id="logout" style="color: #FFFFFF; width: 50px; background-color: #7fb2df;">
</div>
<? } ?>
<br>
<div class="menuitem"><a href="/general.php">General<br>Comments</a></div>
<p class="yellow">Your input is appreciated during this transition</p>
</div>