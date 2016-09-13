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

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IP Geolocation find that you want</title>
    <link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' type='text/css'>
    <style>
    ::-webkit-input-placeholder {
        color: #eee;
    }
    :-moz-placeholder {
       color: #eee;
       opacity: 1;
    }
    ::-moz-placeholder {
       color: #eee;
       opacity: 1;
    }
    :-ms-input-placeholder {
       color: #eee;
    }

    body {
        background-color: #151515;
        color: #eee;
        font-family: 'Share Tech Mono', monospace;
        min-height: 95vh;
        margin: 0;
        padding: 0;
    }
    .info {
    	text-align: right;
    }
    .info p {
        margin-right: 3vh;
    }
    .result {
        position: absolute;
        top: 10vh;
        margin-left: 1vw;
    }
    .attr {
        width: 8vw;
        display: inline-block;
        text-transform: capitalize;
    }
    .ip {
        background-color: #111;
        border: solid 1px #888;
        padding: 8px 25px;
        font-size: 26px;
        letter-spacing: 2px;
        color: #eee;
        font-family: 'Share Tech Mono', monospace;
        position: absolute;
        top: 65vh;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .button {
        background-color: #111;
        border: solid 1px #888;
        padding: 8px 25px;
        font-size: 26px;
        letter-spacing: 2px;
        color: #eee;
        font-family: 'Share Tech Mono', monospace;
        position: absolute;
        top: 80vh;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .credit {
        position: absolute;
        bottom: 1%;
        right: 3vw;
        color: #117711;
        text-decoration: none;
    }
    .credit a {
        color: #117711;
        text-decoration: none;
    }
    </style>
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