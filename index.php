<?php
if (isset($_POST['ip'])) {
  $ip = $_POST['ip'];

  if(filter_var($ip, FILTER_VALIDATE_IP)) {

    $url = 'http://ip-api.com/json/'.$ip.'?fields=16953';
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    $status = $data['status'];
    $country = $data['country'];
    $region = $data['regionName'];
    $city = $data['city'];
    $zip = $data['zip'];
    $isp = $data['isp'];
  } else {
    $status = "invalidip";
  }
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'http://ip-api.com/json/'.$ip.'?fields=16953';
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    $status = $data['status'];
    $country = $data['country'];
    $region = $data['regionName'];
    $city = $data['city'];
    $zip = $data['zip'];
    $isp = $data['isp'];

    if ($country == "United States") {
      $rn = "State: ";
    } elseif($country == "Canada") {
      $rn = "Province: ";
    } else {
      $rn = "Region: ";
    }
  }


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="main.css">
    <meta charset="utf-8">
    <title>geoip</title>
  </head>
  <body>
    <div class="wrap-out">
      <div clas="wrap-in">
        <?php
          if ($status == "success") {
            echo '<p class="title">'.$ip.'</p>';
            echo '<p class="info">Country: '.$country.'</p>';
            echo '<p class="info">Region: '.$region.'</p>';
            echo '<p class="info">City: '.$city.'</p>';
            echo '<p class="info">ZIP: '.$zip.'</p>';
            echo '<p class="info">ISP: '.$isp.'</p>';
          } elseif($status == "invalidip"){
              echo '<p class="title">Invalid IP</p>';
          } else {
              echo '<p class="title">Invalid Response</p>';
          }
         ?>
        <form action="" method="post">
          <input class="textbox unselectable" type="text" name="ip" placeholder="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
          <button class="button unselectable" type="submit" name="submit">Search</button>
        </form>
      </div>
    </div>
  </body>
</html>
