# 轉換新的Json格式 使用Python
import re
import json

with open("DL-schedule.json", "r", encoding="utf-8") as file:
    content = file.read()

js = json.loads(content)


new_data = {
    item["西元日期"]: {
        "day": item["星期"],
        "is_holiday": int(item["是否放假"]),  # 轉換為整數
        "desc": item["備註"] if item["備註"] else ""  # 空字串改為 None
    }
    for item in js
}

# 輸出 JSON 格式
print(json.dumps(new_data, indent=4, ensure_ascii=False))
with open("123.json", "w", encoding="utf-8") as file:
    json.dump(new_data, file, indent=4, ensure_ascii=False)