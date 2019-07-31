<?php
// Inialize session
session_start();

include('connection.php');

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'inconnu';
    $platform = 'inconnu';
    $version= "";

    //First get the platform?
    if (preg_match('/android/i', $u_agent)) {
        $platform = 'android';
    }
	elseif (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
	
	// Pour identifier IE 11
	if(strpos($u_agent, 'rv:11.0'))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
		$version= "11";
    }
   elseif(strpos($u_agent, 'Edge/12'))
    {
        $bname = 'Edge';
        $ub = "EDGE";
		$version= "12";
    }
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

$req = $bdd->prepare('SELECT * FROM t_user WHERE username = ? AND motdepasse = ?');
$req->execute(array($_POST['username'], $_POST['password'])); 
//$SQL = 'SELECT * FROM t_user WHERE username = '.$_POST['username'].' AND motdepasse = '.$_POST['password'];
$nb = $req->rowCount();

//echo "<p>NB=".$nb."</p>";
if ($nb == 1) 
{
while ($liste = $req->fetch())
    {
		$type = $liste['type'];
		$mail = $liste['mail'];
		$auteur = $liste['auteur'];
		$identite = $liste['identite'];
		$pass = $liste['password'];
	}
// Set username session variable
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $pass;
$_SESSION['mail'] = $mail;
$_SESSION['type'] = $type;
$_SESSION['auteur'] = $auteur;
$_SESSION['identite'] = $identite;

$today = date("Y-m-d");
$heure = date("H:i:s");

//Recupération du User Agent
$ua=getBrowser();
$navigateur = $ua['name'];
$version = $ua['version'];
$os = $ua['platform'];
$user_agent = $ua['userAgent'];
$adr_ip = $_SERVER['REMOTE_ADDR'];
$auteur = str_replace("'", "''", $auteur);

$insert ="INSERT INTO`t_journal` ( `auteur`, `username`, `type`, `identite`, `date`, `heure`, `navigateur`, `version`, `os`, `useragent`, `adr_ip`) VALUES ( '".$auteur."', '".$_POST['username']."', '".$type."', '".$identite."', '".$today."', '".$heure."', '".$navigateur."', '".$version."', '".$os."', '".$user_agent."', '".$adr_ip."');";

$ajout = $bdd->exec($insert) or die(print_r($bdd->errorInfo()));
if(!$ajout==1)
{
	echo "probleme technique : cliquez <a href='index.php?id=1'>ici</a> pour etre redirig&eacute;.";
}

}


// Jump to secured page
if (isset($_SESSION['username']))
{
header('Location: index.php?user='.$_SESSION['username']);
}
else {
// Jump to login page
header('Location: login.php?mdp='.$SQL.'&nb='.$nb);
}

?>