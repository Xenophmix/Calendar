<?php
// 新格式 JSON（假設從 API 或文件讀取）
$new_json = file_get_contents('./DL-schedule.json') ;

// 解析 JSON
$data = json_decode($new_json, true);

// print_r($data);
// 轉換為舊格式
$old_json = [];


foreach ($data as $item) {
    $date = $item["西元日期"];

    // echo '<pre>';
    // print_r($item);
    // echo '我是new';
    // echo '</pre>';

    $old_json[$date] = [
        "day" => $item["星期"],
        "is_holiday" => (int)$item["是否放假"], // 轉為數字
        "desc" => $item["備註"]
    ];

    // echo '<pre>';
    // print_r($old_json);
    // echo '我是old';
    // echo '</pre>';

}

// print_r($old_json);

// 輸出 JSON
header('Content-Type: application/json');
echo json_encode($old_json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
