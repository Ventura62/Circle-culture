import React from "react";
import TabGroup from "@/components/shared/TabGroup/TabGroup";
import Link from "next/link";
import UpcomingCircles from "@/components/UpcomingCircles/UpcomingCircles";
import PreviousCircles from "@/components/PreviousCircles/PreviousCircles";
//No hardcoded
const HangoutsDashboard = () => {
    const tabs = ["Upcoming", "Previous"];

    return (
        <div className="text-white mx-auto max-w-[68rem] max-1100:mx-10 max-940:mx-0">
            <div className="flex items-center justify-between max-592:mx-4">
                <h1 className="text-2xl md:text-3xl">Your Circles</h1>
            </div>

            <TabGroup tabs={tabs}>
                <div className="flex flex-col gap-4">
                    <UpcomingCircles />
                </div>
                <div className="flex flex-col gap-4">
                    <PreviousCircles />
                </div>
            </TabGroup>
        </div>
    );
};

export default HangoutsDashboard;
