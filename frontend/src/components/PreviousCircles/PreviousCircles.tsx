import { useGetPreviousCircleHangouts } from "@/hooks/useGetPreviousHangouts";
import React from "react";
import YourCircleCard from "../YourCircleCard/YourCircleCard";
import LoadingSpinner from "../shared/LoadingSpinner";

const PreviousCircles = () => {
    const { previousCircles, isLoading, error } =
        useGetPreviousCircleHangouts();

    if (isLoading) return <LoadingSpinner />;
    if (error)
        return <p className="text-red-500 text-center">Error: {error}</p>;
    return (
        <div className="grid max-592:grid-cols-2 grid-cols-1 max-592:gap-2 gap-6">
            {previousCircles.map((circle) => (
                <YourCircleCard
                    key={circle.id}
                    circleData={circle}
                    type="member"
                />
            ))}
        </div>
    );
};

export default PreviousCircles;
