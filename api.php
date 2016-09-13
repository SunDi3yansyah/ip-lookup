<?php

$db = new mysqli('localhost', 'root', 'sundi3yansyah', 'ip');

if ($db->connect_error)
{
    die('Connection failed to database: '. $db->connect_error .'');
    exit;
}

$ip = !empty($_POST['ip'])?$_POST['ip']:'';

if ($ip)
{
	if (preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $ip)) {
		$sql = "SELECT * FROM ips WHERE query = '$ip'";
		$result = $db->query($sql);
		if ($result->num_rows >= 1)
		{
	        while ($row = $result->fetch_assoc())
	        	$data[] = $row;
		}
		else
		{
			$API = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
			if ($API && $API['status'] == 'success')
			{
				$network     = $API['as'];
				$city        = $API['city'];
				$country     = $API['country'];
				$countryCode = $API['countryCode'];
				$isp         = $API['isp'];
				$lat         = $API['lat'];
				$lon         = $API['lon'];
				$org         = $API['org'];
				$query       = $API['query'];
				$region      = $API['region'];
				$regionName  = $API['regionName'];
				$status      = $API['status'];
				$timezone    = $API['timezone'];
				$zip         = $API['zip'];

				$sql = "INSERT INTO ips (network, city, country, countryCode, isp, lat, lon, org, query, region, regionName, status, timezone, zip) VALUES ('$network', '$city', '$country', '$countryCode', '$isp', '$lat', '$lon', '$org', '$query', '$region', '$regionName', '$status', '$timezone', '$zip')";
				if ($db->query($sql) != TRUE) {
				    $message = "Error: " . $sql . "<br>" . $conn->error;
				} else {
					$from_API = TRUE;
				}
			}
			else
			{
				$message = "Sorry, the IP you are looking for could not be found.";
			}
		}
	} else {
		$message = "Sorry, the IP you are looking for could not be valid.";
	}
}
$db->close();
?>
<!--
                                     _   _                          
 _ __    ___   _ __     ___    ___  (_) | |_    ___    _ __   _   _ 
| '__|  / _ \ | '_ \   / _ \  / __| | | | __|  / _ \  | '__| | | | |
| |    |  __/ | |_) | | (_) | \__ \ | | | |_  | (_) | | |    | |_| |
|_|     \___| | .__/   \___/  |___/ |_|  \__|  \___/  |_|     \__, |
              |_|                                             |___/ 
https://git.io/vi2RV
 -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IP Geolocation find that you want</title>
    <link rel="stylesheet" href="/dist/style.css">
</head>
<body>
    <div class="info">
        <p>IP Geolocation find that you want below</p>
    </div>
    <div class="result">
<?php if (!empty($message)): ?>
	<?php echo $message; ?>
<?php endif ?>

<?php if (!empty($data)): ?>
	<?php foreach ($data as $d): ?>
<span class="attr">network</span>     : <?php echo $d['network'] ?><br>
<span class="attr">city</span>        : <?php echo $d['city'] ?><br>
<span class="attr">country</span>     : <?php echo $d['country'] ?> (<?php echo $d['countryCode'] ?>)<br>
<span class="attr">isp</span>         : <?php echo $d['isp'] ?><br>
<span class="attr">lat</span>         : <?php echo $d['lat'] ?><br>
<span class="attr">lon</span>         : <?php echo $d['lon'] ?><br>
<span class="attr">org</span>         : <?php echo $d['org'] ?><br>
<span class="attr">query</span>       : <?php echo $d['query'] ?><br>
<span class="attr">region</span>      : <?php echo $d['regionName'] ?> (<?php echo $d['region'] ?>)<br>
<span class="attr">timezone</span>    : <?php echo $d['timezone'] ?><br>
<span class="attr">zip</span>         : <?php echo $d['zip'] ?><br>
	<?php endforeach ?>
<?php endif ?>

<?php if (!empty($from_API)): ?>
<span class="attr">network</span>     : <?php echo $network ?><br>
<span class="attr">city</span>        : <?php echo $city ?><br>
<span class="attr">country</span>     : <?php echo $country ?> (<?php echo $countryCode ?>)<br>
<span class="attr">isp</span>         : <?php echo $isp ?><br>
<span class="attr">lat</span>         : <?php echo $lat ?><br>
<span class="attr">lon</span>         : <?php echo $lon ?><br>
<span class="attr">org</span>         : <?php echo $org ?><br>
<span class="attr">query</span>       : <?php echo $query ?><br>
<span class="attr">region</span>      : <?php echo $regionName ?> (<?php echo $region ?>)<br>
<span class="attr">timezone</span>    : <?php echo $timezone ?><br>
<span class="attr">zip</span>         : <?php echo $zip ?><br>
<?php endif ?>
    </div>
    <form method="POST">
        <input type="text" class="ip" name="ip" required autocomplete="off" placeholder="127.0.0.1">
        <input type="submit" class="button" name="submit" value="Discover">
    </form>
    <div class="credit">
        <a href="https://sundi3yansyah.com" target="_blank">SunDi3yansyah</a> |
        tebe4rt
    </div>
</body>
</html>