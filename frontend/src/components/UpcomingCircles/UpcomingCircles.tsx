import { useGetUpcomingCircleHangouts } from "@/hooks/useGetUpcomingCircleHangouts";
import React from "react";
import YourCircleCard from "../YourCircleCard/YourCircleCard";
import LoadingSpinner from "../shared/LoadingSpinner";

const UpcomingCircles = () => {
    const { upcomingCircles, isLoading, error } =
        useGetUpcomingCircleHangouts();

    if (isLoading) return <LoadingSpinner />;
    if (error)
        return <p className="text-red-500 text-center">Error: {error}</p>;

    return (
        <div className="grid max-592:grid-cols-2 grid-cols-1 max-592:gap-2 gap-6">
            {upcomingCircles.map((circle) => (
                <YourCircleCard
                    key={circle.id}
                    circleData={circle}
                    type="member"
                />
            ))}
        </div>
    );
};

export default UpcomingCircles;
