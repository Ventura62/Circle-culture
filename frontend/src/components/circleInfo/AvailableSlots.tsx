import React from "react";
import { Button } from "../ui/button";
import SlotsModal from "./SlotsModal";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import { useRouter } from "next/router";
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

//Nada Check Page3
interface AvailableSlotsProps {
  timeSlots: { id?: string; datetime?: string }[];
  circleId: string;
}

const AvailableSlot = ({ timeSlots, circleId }: AvailableSlotsProps) => {
  const { isLoggedIn } = useLocalUserContext();
  const router = useRouter();
  return (
    <div className="flex-col gap-4 pr-2 pb-2   h-[300px] xl:flex hidden">
      {timeSlots.map((slot) => (
        <div
          key={slot.id}
          className="flex justify-between border-b-2 border-gray-400 pb-4"
        >
          <p>
            <span className="font-bold text-sm">
              {new Date(slot?.datetime).toLocaleDateString("en-US", {
                weekday: "short",
                month: "short",
                day: "numeric",
              })}
            </span>
            <br />
            {new Date(slot?.datetime).toLocaleTimeString("en-US", {
              hour: "2-digit",
              minute: "2-digit",
            })}
          </p>

          <Button
            onClick={() => {
              if (!isLoggedIn) {
                router.push({
                  pathname: "/auth",
                  query: { circleId, slotId: slot.id },
                });
              } else {
                router.push(`${circleId}/${slot.id}/payment`);
              }
            }}
            className="px-4 py-1 rounded-3xl bg-secondary border-1.5 border-secondary hover:text-[#466A97]"
          >
            Reserve
          </Button>
        </div>
      ))}
    </div>
  );
};

const AvailableSlots = ({ timeSlots, circleId }: AvailableSlotsProps) => {
  return (
    <div
      className="bg-[#1a1a1a] xl:rounded-lg   rounded-b-none 
    xl:w-[400px] xl:block flex justify-end xl:border-2 xl:border-x-2  shadow-md    border-x-0 !border-textDark
 xl:px-6 px-8 py-2"
    >
      <div className=" flex  md:block justify-between items-center  w-[100%]">
        <p className="font-bold  text-[14px] xl:block ">$75</p>
        <AvailableSlot timeSlots={timeSlots} circleId={circleId} />
        <Drawer>
          <DrawerTrigger>
            <Button className="px-8 py-4 xl:w-full rounded-3xl bg-secondary border-1.5 border-secondary hover:text-[#466A97]">
              Reserve
            </Button>
          </DrawerTrigger>
          <DrawerContent className="bg-black px-4">
            <DrawerHeader>
              <DrawerTitle className="text-white">All Dates</DrawerTitle>
            </DrawerHeader>
            <SlotsModal circleId={circleId} timeSlots={timeSlots}></SlotsModal>
            <DrawerFooter>
              <DrawerClose>
                <Button className="  bg-primary w-[100%]" variant="outline">
                  Cancel
                </Button>
              </DrawerClose>
            </DrawerFooter>
          </DrawerContent>
        </Drawer>
      </div>
    </div>
  );
};

export { AvailableSlots, AvailableSlot };
