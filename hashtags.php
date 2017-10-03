<?php
  include('hashtag-list.php');

  $hashtags = array();
  $hashtag_count = count($hashtaglist);
  echo('Added ' . $hashtag_count . ' hashtags');

  $keep_track = 1;
  foreach($hashtaglist as $item) {
    array_push($hashtags, array($item, search_between('<meta content="', ' Posts', hashtag($item))));
  }

  function hashtag($hashtag) {
    $insta_source = file_get_contents_curl('https://www.instagram.com/explore/tags/' . $hashtag);
    return $insta_source;
  }

  function search_between($var1="", $var2="", $pool){
    $temp1 = strpos($pool, $var1)+strlen($var1);
    $result = substr($pool, $temp1,strlen($pool));
    $dd=strpos($result, $var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result, 0, $dd);
  }

  function file_get_contents_curl($url) {
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

      $data = curl_exec($ch);
      curl_close($ch);

      return $data;
  }

  file_put_contents('hashtags', json_encode($hashtags));
?>
