<style>
body {margin:0;}
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: white;
}

ul.topnav li {
	/*float: left;*/
	}

li a, .dropbtn {
    display: inline-block;
    color: grey;
    text-align: center;
    padding: 9px 9px;
    text-decoration: none;
}

td a:hover
{
	color : white;
}
li a:hover, .dropdown:hover .dropbtn {
    background-color: #024a82;
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 5px 10px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #024a82;}

.dropdown:hover .dropdown-content {
    display: block;
}

.show {display:block;}

ul.topnav li a:hover {background-color: #024a82;color:white;}

ul.topnav li.icon {display: none;}

@media screen and (max-width:600px) {
  ul.topnav li {display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
}

@media screen and (max-width:600px) {
  ul.topnav.responsive {position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: center;
  }
}
</style>
<?php include("connection.php");?>
<table style="margin:0px; width:100%; background-color:white;">
<tr><td align="left" style="width:33%; border:none;"><span id="idload" style="visibility:hidden;text-align:left; margin:0px;"><img src="img/ajax-loader.gif" alt="loading"></span></td>
<td align="center" style="width:33%; border:none; text-align:center;" ><img src="img/logo.png" alt="SNCF" style="background-color:white;width: 80%;max-width: 220px;" /></td>
<td align="right" style="text-align:right;vertical-align: top; border:none;color:grey;padding-right: 0px;">
 Bienvenue <?php echo $_SESSION['auteur']; ?> - <a href="logout.php" style="text-decoration:underline; background-color: silver;border-radius: 9px 0 0 9px;padding: 4px;"><i>Déconnexion</i></a>
</td></tr></table>
<ul class="topnav" id="myTopnav" >

<li class="dropdown"><a class="dropbtn" onclick="dropdowner('dd1');">Résultats<br />
<img src="img/wall-clock.png" style="vertical-align:middle;margin-top: 5px;"  /></a>
<div id="dd1" class="dropdown-content">
<a href="index.php?id=4"><img src="img/nuages_de_mots.png" style="vertical-align:middle; width:30px;" /> Nuages de mots</a>
<a href="index.php?id=3"><img src="img/search-32.png" style="vertical-align:middle; width:30px;" /> Vague </a>

<a href="index.php?id=12"><img src="img/arrow.png" style="vertical-align:middle; width:30px;" /> Evolution</a>

</div>
</li>

<li><a href="index.php?id=15">Dynamique<br /><img src="img/scroll.png" style="vertical-align:middle;margin-top: 5px; width:32px;" /></a></li>
<li><a href="index.php?id=6">Contact<br /><img src="img/at-sign.png" style="vertical-align:middle;margin-top: 5px; width:32px;" /></a></li>
<li><a href="fichiers/guide.pdf" title="Télécharger le Guide">Guide<br /><img src="img/travel-guide.png" style="vertical-align:middle;margin-top: 5px; width:32px;" /></a></li>

<li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="topnaviguer()">☰</a>
</li>
</ul>
<hr style="margin: 0px; padding: 0px;" />
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function dropdowner(dd) {
    document.getElementById(dd).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var d = 0; d < dropdowns.length; d++) {
      var openDropdown = dropdowns[d];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function topnaviguer() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>