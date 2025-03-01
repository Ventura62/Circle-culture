import { useEffect, useRef, useState } from "react";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Button } from "@/components/ui/button";
import { ScrollArea } from "@/components/ui/scroll-area";
import { Separator } from "@/components/ui/separator";
import { IoIosArrowDown } from "react-icons/io";

type Props = {
  className?: string;
  title: string;
  placeholder?: boolean;
  value: string | number;
  setValue?: (value: string | number) => void;
  content: (string | number)[];
};

const Dropdown = (props: Props) => {
  const [open, setOpen] = useState<boolean>(false);
  const scrollAreaRef = useRef<HTMLDivElement>(null);
  const selectedLocationRef = useRef<HTMLDivElement>(null);
  const triggerRef = useRef<HTMLButtonElement>(null);
  const [width, setWidth] = useState("auto");

  useEffect(() => {
    if (open) {
      setTimeout(() => {
        if (selectedLocationRef.current && scrollAreaRef.current) {
          selectedLocationRef.current.scrollIntoView({ block: "center" });
        }
      }, 0);
    }

    if (triggerRef.current) {
      setWidth(`${triggerRef.current.offsetWidth}px`);
    }
  }, [open]);

  const handleClick = (item: string | number) => {
    props.setValue?.(item);
    setOpen(false);
  }

  return (
    <DropdownMenu modal={false} onOpenChange={setOpen} open={open}>
      <DropdownMenuTrigger asChild ref={triggerRef}>
        <Button
          type="button"
          variant="none"
          className={`${props.className} flex items-center justify-between h-full w-full min-h-[3.75rem] !ring-offset-0 border-1.5 bg-transparent !border-white/30 hover:!bg-[#393C3D] transition-all duration-200`}
        >
          <div className="flex flex-col items-start justify-between w-full">
            {props.placeholder && <span>{props.title}</span>}
            <span className="opacity-30 text-lg">
              {props.value || `Select a ${props.title.toLowerCase()}`}
            </span>
          </div>
          <IoIosArrowDown
            size={24}
            color="white"
            className={`${open && "rotate-180"} transition-all duration-200`}
          />
        </Button>
      </DropdownMenuTrigger>
      <DropdownMenuContent
        style={{ width }}
        align="start"
        className="!bg-primary border-1.5 border-white/10 top-3.5 min-w-[var(--radix-popover-trigger-width)]"
      >
        <ScrollArea
          style={{
            height: `${props.content.length <= 4 ? "fit-content" : `14rem`}`,
          }}
          className="rounded-md"
          ref={scrollAreaRef}
        >
          <div className="p-4">
            {props.content.map((item, index) => (
              <div
                key={item}
                ref={props.value === item ? selectedLocationRef : undefined}
              >
                <Button
                  type="button"
                  variant="none"
                  onClick={() => handleClick(item)}
                  className={`${
                    props.value === item && "bg-white/10"
                  } text-sm hover:bg-white/10 w-full !flex !justify-start rounded`}
                >
                  <span>{item}</span>
                </Button>
                {index !== props.content.length - 1 && (
                  <Separator className="my-2 opacity-30" />
                )}
              </div>
            ))}
          </div>
        </ScrollArea>
      </DropdownMenuContent>
    </DropdownMenu>
  );
};

export default Dropdown;
