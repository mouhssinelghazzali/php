<script type="text/javascript" src="fusioncharts/fusioncharts.js"></script>

<style>
.liste li 
{
	display:block;
	}
fieldset{display: inline-block;}
p
{
	color : white;
}
</style>
<h1><?php if(isset($_GET['page'])){echo $_GET['page'];	}else{echo "Accueil";}?></h1>
<div>
<p><?php if(isset($_GET['module'])){echo $_GET['module'];	}else{echo "Bienvenue sur la page d'accueil TER Normandie";}?></p>
<img src="img/loading-animations-preloader-gifs-ui-ux-effects-18.gif" alt="En Construction" style="width:350px;border-radius: 15px;" />
<p>prototype en construction... Essayez une autre page</p>
</div>