<!doctype html>
<html lang="en">

<?php
// 政府的放假資料(日期)
$json_str = file_get_contents('./source/schedule.json');
$gov_schedules = json_decode($json_str);

// 節慶
$json_str2 = file_get_contents('./source/schedule1.json');
$default_schedules = json_decode($json_str2);

// 文字
$json_poetry = file_get_contents('./source/poetry.json');
$poetry = json_decode($json_poetry);

// 一週幾天
$days_of_week = 7;


// 現在的日期(Y=年，m=月)
$Time_now = date('Y-m');


$date = isset($_GET["date"]) ? $_GET["date"] : $Time_now;

$first_day = date('w', strtotime($date . "-1"));
// 今年
$year = date('Y', strtotime($date . "-1"));
// 這個月
$month = date('n', strtotime($date . "-1"));
// 今天
$today = date('Ymd');
// 選擇的這個月幾天
$total_day_of_this_month = date('t', strtotime($date . "-1"));

// 一個月幾個禮拜
$weeks_of_a_month = ceil(($total_day_of_this_month + $first_day) / 7);
// 下個月
$next_month = date('Y-m', strtotime("+1 month", strtotime($date . "-1")));
// 上個月
$prev_month = date('Y-m', strtotime("-1 month", strtotime($date . "-1")));
// 明年
$next_year = date('Y-m', strtotime("+1 year", strtotime($date . "-1")));
// 前一年
$prev_year = date('Y-m', strtotime("-1 year", strtotime($date . "-1")));


switch ($month) {
  case 1:
  case 2:
  case 3:
    $season = 'spring';
    $alleffect = 'sakura';
    break;
  case 4:
  case 5:
  case 6:
    $season = 'summer';
    $alleffect = 'rainy';
    break;
  case 7:
  case 8:
  case 9:
    $season = 'autumn';
    $alleffect = 'maple';
    break;
  case 10:
  case 11:
  case 12:
    $season = 'winter';
    $alleffect = 'snow';
    break;
}



?>

<head>
  <title>萬年曆第二版</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- 預設的css樣式，版面控制 -->
  <link rel="stylesheet" href="./css/index.css">
  <!-- 根據月份改變讀取的css，放後面優先級別高 -->
  <link rel="stylesheet" href="./css/<?php echo $season ?>.css">

  <!-- 字體 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">

  <!-- script -->
  <script src="./js/Time.js"></script>



</head>



<body>
  <!-- sakura櫻花 -->
  <!-- rainy下雨 -->
  <!-- maple落葉 -->
  <!-- fall下雪 -->
  <div id="<?php echo $alleffect ?>"></div>


  <header>
    <nav class="navbar navbar-expand-sm bg-warning p-0 navbar-dark">
      <div class="container-fluid justify-content-center now-time">
        <div>現在時間&nbsp;:&nbsp;</div>
        <div id="clock"></div>
      </div>
    </nav>
  </header>
  <section class="container-fluid mt-5 d-flex px-0 text-light h-100">
    <content style="width: 75%;" class="d-flex text-center mx-auto">


      <aside class="d-flex flex-nowrap w-50 h-75">
        <div style="height: calc(100%)" class="d-flex border w-50  justify-content-center align-items-center left-img">
          <nav class="w-100 h-100 d-flex flex-wrap align-content-around">

            <div class="w-100 h-25 d-flex justify-content-center align-items-end">
              <div class="d-flex flex-nowarp">
                <a href="?date=<?php echo $prev_year ?>" class="arrowL mt-3"><i class="fa-solid fa-angles-left"></i></a>

                <?php echo "<div class='left-font-top'>&nbsp;&nbsp;$year" . "&nbsp;年&nbsp;&nbsp;</div>" ?>

                <a href="?date=<?php echo $next_year ?>" class="arrowR mt-3"><i class="fa-solid fa-angles-right"></i></a>
              </div>
            </div>

            <div class="w-100 h-25 d-flex justify-content-center align-items-start flex-wrap">

              <a href="?date=<?php echo $prev_month ?>" class="w-25 arrowL mt-3"><i class="fa-sharp fa-solid fa-left-long"></i></a>
              <?php echo  "<div class='left-font-bottom mt-1'>&nbsp;&nbsp;$month" . "&nbsp;月&nbsp;&nbsp;</div>" ?>
              <a href="?date=<?php echo $next_month ?>" class="w-25 arrowR mt-3"><i class="fa-sharp fa-solid fa-right-long"></i></a>
              <a href="?date=<?php echo $Time_now ?>" class="circle w-25"><i class="fa-sharp fa-solid fa-rotate"></i></a>

            </div>

          </nav>
        </div>
        <div class="w-50 h-100 ">
          <!-- 未來做個點擊後翻譯成中文的效果 -->
          <div style="height:calc(100% / 3);" class="border ms-1 w-100 poetry d-flex">
            <?php echo $poetry->{$month} ?>
          </div>
          <div style="height:calc(100% / 3) ;" class="border ms-1 w-100">
            <img style="object-fit:cover;" class="w-100 h-100" src="./img/Gif/<?php echo $season ?>.gif" alt="四季變化">
          </div>
          <div style="height:calc(100% / 3);" class="border ms-1 w-100"><iframe width="100%-1px" height="100%-10px" src="https://embed.windy.com/embed2.html?lat=24.939&lon=121.542&detailLat=24.939&detailLon=121.542&width=650&height=450&zoom=5&level=surface&overlay=wind&product=ecmwf&menu=&message=&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=default&metricTemp=default&radarRange=-1" frameborder="0"></iframe></div>
        </div>
      </aside>
      <main class="main w-50 ms-2 h-75">
        <div class="d-flex h-100 align-items-center glow">

          <table class='calendar h-100'>
            <thead>
              <tr>
                <th>日</th>
                <th>一</th>
                <th>二</th>
                <th>三</th>
                <th>四</th>
                <th>五</th>
                <th>六</th>
              </tr>
            </thead>
            <!-- 萬年曆程式碼 -->
            <tbody>
              <?php
              for ($week = 0; $week < $weeks_of_a_month; $week++) {
                // 判斷每一週的起始天數為多少, 從0開始
                $start_date_of_this_week = ($week * $days_of_week) - ($first_day);

                echo "<tr class='week'>";

                for ($day = 1; $day <= $days_of_week; $day++) {
                  //日期，從1開始
                  $date_of_this_month = $start_date_of_this_week + $day;

                  if ($date_of_this_month < 1 || $date_of_this_month > $total_day_of_this_month) {
                    echo "<td class='date other-month'></td>";
                    continue;
                  }
                  // 所需CSS樣式
                  $classes = [];
                  // 是否為節日的敘述。
                  $desc = '';
                  // 是否放假
                  $is_holiday = false;
                  // 完整的日期（年月日）
                  $full_date = date('Ymd', strtotime($date . '-' . $date_of_this_month));
                  // 當前計算的月日
                  $month_and_day = date('md', strtotime($date . '-' . $date_of_this_month));
                  // 判斷當前日期，是否有政府的資料
                  if (isset($gov_schedules->{$full_date})) {
                    // 取出資料
                    $schedule = $gov_schedules->{$full_date};
                    // 判斷是否有放假的資料
                    if (isset($schedule->{'is_holiday'})) {
                      // 0 為沒放假, 2 為放假。資料來源來自於政府
                      $is_holiday = $schedule->{'is_holiday'} == 2;
                    }
                    // 判斷是否有節日的資料
                    if (isset($schedule->{'desc'})) {
                      // 獲取節日的敘述
                      $desc = $schedule->{'desc'};
                    }
                  }
                  // 判斷是否沒有政府的敘述 且 當前日期有預設的節日，則獲取預設的節日
                  if (empty($desc) && isset($default_schedules->{$month_and_day})) {
                    $schedule = $default_schedules->{$month_and_day};
                    if (isset($schedule->{'desc'})) {
                      $desc = join(", ", $schedule->{'desc'});
                    }
                  }
                  // 以下為判斷是否為假日以及是否為今天
                  // 如果成立，則加入此陣列中，以便之後的樣式輸出
                  if ($is_holiday) {
                    array_push($classes, 'holiday');
                  }
                  if ($today === $full_date) {
                    array_push($classes, 'today');
                  }

                  echo "<td class='date " . join(' ', $classes) . "'>";
                  echo "  <div class='divdate'>";
                  echo "  <span class='circular'>$date_of_this_month</span>";
                  echo "  <div class='desc'>";
                  echo "      $desc";
                  echo "  </div>";
                  echo "  </div>";
                  echo "</td>";
                }

                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </main>
      <footer>
        <!-- place footer here -->
      </footer>
    </content>
  </section>

  <!-- 故意移到後面 讓網頁讀完後再跑效果 -->
  <script src="./js/<?php echo $season ?>.js"></script>
</body>

</html>