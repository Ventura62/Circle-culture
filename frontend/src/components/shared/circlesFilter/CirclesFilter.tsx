import React, { useState } from "react";
import { BiSearch } from "react-icons/bi";
import { motion } from "motion/react";
import {
  Drawer,
  DrawerClose,
  DrawerContent,
  DrawerDescription,
  DrawerFooter,
  DrawerHeader,
  DrawerTitle,
  DrawerTrigger,
} from "@/components/ui/drawer";
import { Button } from "@/components/ui/button";
import { LocationPicker } from "./LocationPicker/LocationPicker";
import { useRouter } from "next/router";

const CirclesFilter = () => {
  const route = useRouter();
  const location = typeof route.query.location === "string" ? route.query.location : "";
  const [value, setValue] = React.useState(location.toLowerCase());
  const [searchLocation, setSearchLocation] = React.useState(location.toLowerCase());

  React.useEffect(() => {
    if (searchLocation !== location) {
      route.push(`/home?location=${searchLocation}`);
    }
  }, [searchLocation]);
  return (
    <Drawer>
      <DrawerTrigger>
        <motion.div
          initial={{ width: 0, opacity: 0 }}
          animate={{ width: 344, opacity: 1 }}
          transition={{
            duration: 0.75,
            ease: [0.43, 0.13, 0.23, 0.96],
          }}
          className="relative   md:absolute md:translate-x-[-50%] md:top-16 
     grid grid-cols-[auto,1fr] py-2 px-3 bg-primary border-px
      border-bright-gray rounded-full overflow-hidden" // Add overflow-hidden to prevent content from spilling out
        >
          <button className="flex items-center justify-center h-8 w-8 rounded-full text-white">
            <BiSearch size={18} strokeWidth={1} />
          </button>
          <div className="flex items-center divide-x-2 divide-white divide-opacity-30">Anywhere</div>
        </motion.div>
      </DrawerTrigger>
      <DrawerContent className="h-[100svh]  bg-background">
        <DrawerHeader>
          <DrawerTitle className="text-white"> Pick your location</DrawerTitle>
        </DrawerHeader>
        <div>
          <LocationPicker currentLocation={value} setCurrentLocation={setValue} />
        </div>
        <DrawerFooter>
          <div className="flex  justify-between">
            <DrawerClose>
              <Button variant="outline" className="text-white bg-primary w-[150px]">
                Cancel
              </Button>
            </DrawerClose>
            <DrawerClose>
              <Button
                onClick={() => {
                  setSearchLocation(value);
                }}
                className="w-[150px]  bg-secondary"
              >
                <BiSearch size={18} strokeWidth={1} />
                Search
              </Button>
            </DrawerClose>
          </div>
        </DrawerFooter>
      </DrawerContent>
    </Drawer>
  );
};

export default CirclesFilter;
