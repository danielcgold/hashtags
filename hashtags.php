

<?php
  include('hashtag-list.php');

  $hashtags = array();
  foreach($hashtaglist as $item) {
    array_push($hashtags, array($item, search_between('<meta content="', ' Posts', hashtag($item))));
  }

  // $hashtags = array(
  //   array("55zeiss18", search_between('<meta content="', ' Posts', hashtag('55zeiss18'))),
  //   array("55zeiss", search_between('<meta content="', ' Posts', hashtag('55zeiss'))),

  // $array_ = Array();
  //
  // foreach ($querryresult as $row){
  //     array_push($array_,
  //         array(
  //             $row['id'],
  //             $row['title']
  //         )
  //     );
  // }

  function hashtag($hashtag) {
    $insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$hashtag);
    return $insta_source;
  }

  function search_between($var1="",$var2="",$pool){
    $temp1 = strpos($pool,$var1)+strlen($var1);
    $result = substr($pool,$temp1,strlen($pool));
    $dd=strpos($result,$var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result,0,$dd);
  }

  file_put_contents('hashtags', json_encode($hashtags));
?>
