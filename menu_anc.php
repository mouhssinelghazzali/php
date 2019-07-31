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

<li class="dropdown"><a class="dropbtn" onclick="dropdowner('dd1');">Résultats<br /><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYwIDYwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MCA2MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIzMnB4IiBoZWlnaHQ9IjMycHgiPgo8Zz4KCTxwYXRoIGQ9Ik01OC4yMzIsNTguMjlsLTUuOTY5LTYuMjQ0YzEuNzQ2LTEuOTE5LDIuODItNC40NTgsMi44Mi03LjI1QzU1LjA4MywzOC44NDMsNTAuMjQsMzQsNDQuMjg3LDM0ICAgcy0xMC43OTYsNC44NDMtMTAuNzk2LDEwLjc5NnM0Ljg0MywxMC43OTYsMTAuNzk2LDEwLjc5NmMyLjQ0MSwwLDQuNjg4LTAuODI0LDYuNDk5LTIuMTk2bDYuMDAxLDYuMjc3ICAgYzAuMTk2LDAuMjA1LDAuNDU5LDAuMzA5LDAuNzIzLDAuMzA5YzAuMjQ5LDAsMC40OTctMC4wOTIsMC42OTEtMC4yNzdDNTguNTk5LDU5LjMyMiw1OC42MTQsNTguNjg5LDU4LjIzMiw1OC4yOXogTTM1LjQ5MSw0NC43OTYgICBjMC00Ljg1LDMuOTQ2LTguNzk2LDguNzk2LTguNzk2czguNzk2LDMuOTQ2LDguNzk2LDguNzk2cy0zLjk0Niw4Ljc5Ni04Ljc5Niw4Ljc5NlMzNS40OTEsNDkuNjQ2LDM1LjQ5MSw0NC43OTZ6IiBmaWxsPSIjOTk5OTk5Ii8+Cgk8cGF0aCBkPSJNMTguNDkxLDIyaDIwVjEyaC0yMFYyMnogTTIxLjQ5MSwxNGgxNHYyaC0xNFYxNHogTTIxLjQ5MSwxOGgxNHYyaC0xNFYxOHoiIGZpbGw9IiM5OTk5OTkiLz4KCTxwYXRoIGQ9Ik0zMC40OTEsNDQuNzk2QzMwLjQ5MSwzNy4xODgsMzYuNjc5LDMxLDQ0LjI4NywzMWMxLjEwNSwwLDIuMTc0LDAuMTQ1LDMuMjA0LDAuMzkxVjBoLTM2aC0xMHY2MGgxMGgzNnYtMS43OTkgICBjLTEuMDMsMC4yNDYtMi4wOTksMC4zOTEtMy4yMDQsMC4zOTFDMzYuNjc5LDU4LjU5MiwzMC40OTEsNTIuNDAzLDMwLjQ5MSw0NC43OTZ6IE05LjQ5MSw1OGgtNlYyaDZWNTh6IE0xNi40OTEsMTBoMjR2MTRoLTI0VjEweiIgZmlsbD0iIzk5OTk5OSIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" style="vertical-align:middle;margin-top: 5px;"  /></a>
<div id="dd1" class="dropdown-content">
<a href="index.php?id=4"><img src="img/resultats.png" style="vertical-align:middle; width:30px;" /> Rapports</a>
<a href="index.php?id=3"><img src="img/avancement.png" style="vertical-align:middle; width:30px;" /> Score</a>
<a href="index.php?id=12"><img src="img/avancement.png" style="vertical-align:middle; width:30px;" /> Evolution</a>

<a href="index.php?id=10"><img src="img/user.png" style="vertical-align:middle; width:30px;" /> Utilisateurs</a>
</div>
</li>

<li><a href="index.php?id=6">Contact<br /><img src="img/contact.png" style="vertical-align:middle;margin-top: 5px; width:32px;" /></a></li>
<li><a href="fichiers/guide.pdf" title="Télécharger le Guide">Guide<br /><img src="img/book.png" style="vertical-align:middle;margin-top: 5px; width:32px;" /></a></li>

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