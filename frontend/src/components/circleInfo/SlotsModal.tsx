import React, { ReactNode } from "react";
import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import { useRouter } from "next/router";
const SlotsModal = ({
  circleId,
  timeSlots,
}: {
  circleId: string;
  timeSlots: { id?: string; datetime?: string }[];
}) => {
  const router = useRouter();
  const { isLoggedIn } = useLocalUserContext();

  return (
    <div className="flex h-[70vh] flex-col gap-4 overflow-y-auto">
      {timeSlots?.length > 0 ? (
        timeSlots.map((slot) => (
          <div
            key={slot.id}
            className="flex justify-between rounded-lg border-gray-400 bg-primary px-4 py-6"
          >
            <p className="text-textDark">
              <span className="text-sm font-bold text-white">
                {new Date(slot.datetime).toLocaleDateString("en-US", {
                  weekday: "short",
                  month: "short",
                  day: "numeric",
                })}
              </span>
              <br />
              {new Date(slot.datetime).toLocaleTimeString("en-US", {
                hour: "2-digit",
                minute: "2-digit",
              })}
            </p>
            <Button
              className="rounded-3xl border-1.5 border-secondary bg-secondary px-4 py-1 hover:text-[#466A97]"
              onClick={() => {
                if (!isLoggedIn) {
                  router.push({
                    pathname: "/auth",
                    query: { circleId, slotId: slot.id },
                  });
                } else {
                  router.push(`/${router.pathname}/${slot.id}/payment`);
                }
              }}
            >
              Reserve
            </Button>
          </div>
        ))
      ) : (
        <p className="text-center text-gray-400">No available time slots</p>
      )}
    </div>
  );
};

export default SlotsModal;
