import { useState } from "react";
import dayjs from "dayjs";
import "./wheel-picker/styles.css";

import { WheelPicker } from "./wheel-picker/WheelPicker";

const hourItems = Array.from({ length: 12 }, (_, index) => ({
  value: index + 1,
  label: index + 1
}));

const minuteItems = Array.from({ length: 12 }, (_, index) => ({
  value: `${(index * 5).toString().padStart(2, "0")}`,
  label: `${(index * 5).toString().padStart(2, "0")}`
}));

const ampmItems = [
  { value: "AM", label: "AM" },
  { value: "PM", label: "PM" }
];

const currentDaysInMonth = dayjs().daysInMonth();
const dateItems = Array.from({ length: currentDaysInMonth * 2 }, (_, i) => {
  const date = dayjs().add(-currentDaysInMonth, "days").add(i, "days");
  return {
    value: date.startOf("day").format("YYYY-MM-DD"),
    label: currentDaysInMonth === i ? "Today" : date.format("ddd DD MMM")
  };
});

export default function DateTimePicker() {
  const [date, setDate] = useState(dateItems[currentDaysInMonth].value);
  const [hour, setHour] = useState(hourItems[5].value);
  const [minute, setMinute] = useState(minuteItems[2].value);
  const [ampm, setAmpm] = useState(ampmItems[0].value);

  return (
    <div className="App">
      <span style={{ textAlign: "center", width: "100%" }}>
        {date} {hour}:{minute} {ampm}
      </span>
      <div style={{ width: "100%", display: "flex", justifyContent: "center" }}>
        <WheelPicker
          dateItems={dateItems}
          dateValue={date}
          onDateChange={setDate}
          hourItems={hourItems}
          hourValue={hour}
          onHourChange={setHour}
          minuteItems={minuteItems}
          minuteValue={minute}
          onMinuteChange={setMinute}
          ampmItems={ampmItems}
          ampmValue={ampm}
          onAmpmChange={setAmpm}
        />
      </div>
    </div>
  );
}
