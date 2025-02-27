import * as React from "react";
import { format, parseISO } from "date-fns";

import { cn } from "@/lib/utils";
import { Button } from "@/components/ui/button";
import { Calendar } from "@/components/ui/calendar";
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import { ScrollArea, ScrollBar } from "@/components/ui/scroll-area";
import { IoIosArrowDown } from "react-icons/io";
import { CalendarIcon } from "lucide-react";

interface DateTimePickerProps {
  className?: string;
  value: string;
  onChange: (date: string) => void;
}

export const DateTimePicker: React.FC<DateTimePickerProps> = ({ className, value, onChange }) => {
  const [isOpen, setIsOpen] = React.useState(false);
  const date = value ? parseISO(value): undefined;
  const dateHours = date && date.getHours() % 12 || 12;
  const dateMinutes = date && parseInt(date.getMinutes().toString().padStart(2, "0"));
  const isPM = date && date.getHours() >= 12;

  const hours = Array.from({ length: 12 }, (_, i) => i + 1);

  const handleDateSelect = (selectedDate: Date | undefined) => {
    if (selectedDate) {
      const newDate = new Date(selectedDate);
      newDate.setHours(date?.getHours() ?? 12);
      newDate.setMinutes(date?.getMinutes() ?? 0);
      onChange(newDate.toISOString());
    }
  };

  const handleTimeChange = (type: "hour" | "minute" | "ampm", value: string) => {
    if (date) {
      const newDate = new Date(date);
      if (type === "hour") {
        newDate.setHours((parseInt(value) % 12) + (newDate.getHours() >= 12 ? 12 : 0));
      } else if (type === "minute") {
        newDate.setMinutes(parseInt(value));
      } else if (type === "ampm") {
        const currentHours = newDate.getHours();
        newDate.setHours(value === "PM" ? currentHours + 12 : currentHours - 12);
      }
      onChange(newDate.toISOString());
    }
  };

  return (
    <Popover open={isOpen} onOpenChange={setIsOpen}>
      <PopoverTrigger asChild>
        <Button
          variant="none"
          className={cn(
            className,
            "w-full justify-between text-left rounded-lg border-1.5 hover:bg-[#393C3D] border-white/30 !py-6",
            !value && "text-muted-foreground"
          )}
        >
          <div className="flex justify-start items-center text-lg">
            <CalendarIcon className="mr-2 h-4 w-4" />
            {value ? format(parseISO(value), "EEE, MMM do 'at' h:mm a") : <span>MM/DD/YYYY hh:mm aa</span>}
          </div>
          <IoIosArrowDown size={24} color="white" className={`${isOpen && "rotate-180"} transition-all duration-200`} />
        </Button>
      </PopoverTrigger>

      <PopoverContent
        side="bottom"
        align="start"
        collisionPadding={-100} // Prevents clipping near edges
        className="w-auto p-0 !bg-primary"
      >
        <div className="sm:flex">
          <Calendar mode="single" selected={date} onSelect={handleDateSelect} initialFocus />
          <div className="flex flex-col sm:flex-row sm:h-[300px] divide-y sm:divide-y-0 sm:divide-x">
            {/* Hours */}
            <ScrollArea className="w-64 sm:w-auto">
              <div className="flex sm:flex-col p-2">
                {hours.reverse().map((hour) => (
                  <Button
                    key={hour}
                    size="icon"
                    variant={date && date.getHours() % 12 === hour % 12 ? "default" : "ghost"}
                    className={`${ hour === dateHours ? "bg-white text-black": "" } hover:!bg-white/10 hover:!text-white sm:w-full shrink-0 aspect-square`}
                    onClick={() => handleTimeChange("hour", hour.toString())}
                  >
                    {hour}
                  </Button>
                ))}
              </div>
              <ScrollBar orientation="horizontal" className="sm:hidden" />
            </ScrollArea>

            {/* Minutes */}
            <ScrollArea className="w-64 sm:w-auto">
              <div className="flex sm:flex-col p-2">
                {Array.from({ length: 12 }, (_, i) => i * 5).map((minute) => (
                  <Button
                    key={minute}
                    size="icon"
                    variant={date && date.getMinutes() === minute ? "default" : "ghost"}
                    className={`${ minute === dateMinutes ? "bg-white text-black": "" } hover:!bg-white/10 hover:!text-white sm:w-full shrink-0 aspect-square`}
                    onClick={() => handleTimeChange("minute", minute.toString())}
                  >
                    {minute}
                  </Button>
                ))}
              </div>
              <ScrollBar orientation="horizontal" className="sm:hidden" />
            </ScrollArea>

            {/* AM/PM */}
            <ScrollArea>
              <div className="flex sm:flex-col p-2">
                {["AM", "PM"].map((ampm) => (
                  <Button
                    key={ampm}
                    size="icon"
                    variant={date && ((ampm === "AM" && date.getHours() < 12) || (ampm === "PM" && date.getHours() >= 12)) ? "default" : "ghost"}
                    className={`${ isPM === (ampm === "PM") ? "bg-white text-black": "" } hover:!bg-white/10 hover:!text-white sm:w-full shrink-0 aspect-square`}
                    onClick={() => handleTimeChange("ampm", ampm)}
                  >
                    {ampm}
                  </Button>
                ))}
              </div>
            </ScrollArea>
          </div>
        </div>
      </PopoverContent>
    </Popover>
  );
};
