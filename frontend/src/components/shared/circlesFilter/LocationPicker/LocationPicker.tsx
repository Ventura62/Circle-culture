//@ts-nocheck
import * as React from "react";
import { Check, ChevronsUpDown, Router } from "lucide-react";
import { cn } from "@/lib/utils";
import { Button } from "@/components/ui/button";
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import { states } from "@/utils/Data";
import { Command, CommandEmpty, CommandGroup, CommandInput, CommandItem, CommandList } from "@/components/ui/command";

export function LocationPicker({ currentLocation, setCurrentLocation }: { currentLocation: string; setCurrentLocation: (data: string) => void }) {
  const [open, setOpen] = React.useState(false);

  return (
    <Popover open={open} onOpenChange={setOpen}>
      <PopoverTrigger asChild>
        <div className="flex justify-center">
          <Button
            variant="outline"
            role="combobox"
            aria-expanded={open}
            className=" w-[90%] rounded-lg  
           text-white bg-black justify-between"
          >
            {currentLocation ? states.find((state) => state.value === currentLocation)?.label : "Select state..."}
            <ChevronsUpDown className="ml-2 h-4 w-4 shrink-0 opacity-50" />
          </Button>
        </div>
      </PopoverTrigger>
      <PopoverContent className="w-[100%] p-0 ">
        <Command>
          <CommandInput placeholder="Search State..." />
          <CommandList>
            <CommandEmpty>No State found.</CommandEmpty>
            <CommandGroup>
              {states.map((state) => (
                <CommandItem
                  key={state.value}
                  value={state.value}
                  onSelect={(currentValue: string) => {
                    setCurrentLocation(currentValue === currentLocation ? "" : currentValue);
                    setOpen(false);
                  }}
                >
                  <Check className={cn("mr-2 h-4 w-4", currentLocation === state.value ? "opacity-100" : "opacity-0")} />
                  <p className=" text-black">{state.label}</p>
                </CommandItem>
              ))}
            </CommandGroup>
          </CommandList>
        </Command>
      </PopoverContent>
    </Popover>
  );
}
