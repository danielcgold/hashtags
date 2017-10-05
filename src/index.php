<html>
<head>
  <title>Hashtag counts</title>

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    .hidden {
      display: none;
    }

    .content-wrapper {
      display: flex;
    }

    .table-wrapper {
      height: 100vh;
      width: 50%;
      overflow-y: scroll;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table thead th,
    .table tbody tr:nth-child(even) td {
      background: #f3f3f3;
      text-align: left;
    }

    .table-td {
      padding: 10px 15px;
    }

    .table-row {
      cursor: pointer;
    }

    .table-row:hover td:nth-child(2) {
      color: #0072ff;
      text-decoration: underline;
    }

    .hashtag-wrapper {
      width: 50%;
      padding: 20px;
    }

    .hashtag-wrapper-title {
      margin: 0;
      padding: 0;
    }

    .selected-word {
      color: rgba(0, 0, 0, .5);
      pointer-events: none;
    }

    .active-hashtags,
    .no-selection {
      margin: 16px 0;
    }

    .active-hashtags {
      font-family: monospace;
      background: #f3f3f3;
      padding: 15px;
      border: 1px solid #eee;
      width: 100%;
    }

    .counted-wrapper {
      background: #000;
      padding: 5px;
      color: #fff;
      font-family: monospace;
      top: 0;
      right: 0;
      position: absolute;
    }

    .counted {
      padding: 0;
      margin: 0;
      display: inline-block;
    }
  </style>
</head>
<body>
  <?php
    $hashtags = json_decode(file_get_contents("src/hashtags"));

    function custom_math($number) {
      if (strpos($number, 'k') !== false) {
        $number = str_replace('k', '', $number);
        $number = $number * 1000;
      } else if (strpos($number, ',') !== false) {
        $number = $number = str_replace(',', '', $number);
      } else if (strpos($number, 'm') !== false) {
        $number = str_replace('m', '', $number);
        $number = $number * 1000000;
      } else if (strpos($number, 'b') !== false) {
        $number = str_replace('b', '', $number);
        $number = $number * 1000000000;
      }

      return number_format($number);
    }
  ?>

  <div class="content-wrapper">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th class="table-td">ID</th>
            <th class="table-td">Hashtag</th>
            <th class="table-td">Count</th>
          </tr>
        </thead>

        <tbody>
          <?php
          for ($row = 0; $row < count($hashtags); $row++) {
            echo "<tr class='countable table-row'>";
            echo "<td class='table-td'>$row</td>";
            for ($col = 0; $col < 2; $col++) {
              if($col == 0) {
                echo "<td class='table-hashtag table-td'>#" . $hashtags[$row][$col] . "</td>";
              } else if($col == 1) {
                echo "<td class='table-td'>" . custom_math($hashtags[$row][$col]) . "</td>";
              } else {
                echo "<td class='table-td'>" . $hashtags[$row][$col] . "</td>";
              }

            }
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="hashtag-wrapper">
      <h2 class="hashtag-wrapper-title">Selected Hashtags</h2>
      <p class="no-selection">There aren't any hashtags selected.</p>
      <textarea class="active-hashtags hidden"></textarea>
      <button data-clipboard-target=".active-hashtags" class="click-to-copy hidden">Click to copy</button>
      <div class="counted-wrapper hidden"><p class="counted"></p> of 30</div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>

  <script>
    $(function(){
      function countWords(str) {
        return str.split(" ").length - 1;
      }

      function updateWordCounter(str) {
        $('.counted').html(countWords(str));
      }

      new Clipboard('.click-to-copy');

      $('.countable').on('click', function(){
        $('.hidden').removeClass('hidden');
        $('.no-selection').remove();
        $('.active-hashtags').append($(this).find('.table-hashtag').html() + ' ');
        $(this).addClass('selected-word');
        var currentWords = $('.active-hashtags').html();
        countWords(currentWords);
        updateWordCounter(currentWords);
      });
    });
  </script>
</body>
</html>
