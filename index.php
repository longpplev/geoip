<?php


if (isset($_POST['ip'])) {
  $ip = $_POST['ip'];
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
    <title></title>
  </head>
  <body>
    <div class="wrap-out">
      <div clas="wrap-in">
        <?php
        if (isset($_POST['submit'])){
          if ($status == "success") {
            echo '<p class="title">'.$ip.'</p>';
            echo '<p class="info">Country: '.$country.'</p>';
            echo '<p class="info">Region: '.$region.'</p>';
            echo '<p class="info">City: '.$city.'</p>';
            echo '<p class="info">ZIP: '.$zip.'</p>';
            echo '<p class="info">ISP: '.$isp.'</p>';
          } else {
              echo '<p class="title">Invalid response</p>';
          }
        }
        else {
          if ($status == "success") {
            echo '<p class="title">'.$ip.'</p>';
            echo '<p class="info">Country: '.$country.'</p>';
            echo '<p class="info">'.$rn.''.$region.'</p>';
            echo '<p class="info">City: '.$city.'</p>';
            echo '<p class="info">ZIP: '.$zip.'</p>';
            echo '<p class="info">ISP: '.$isp.'</p>';
          } else {
              echo '<p class="title">Invalid response</p>';
          }
      }
         ?>
        <form action="" method="post">
          <input class="textbox" type="text" name="ip" placeholder="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
          <button class="button" type="submit" name="submit">Enter</button>
        </form>
      </div>
    </div>
  </body>
</html>
