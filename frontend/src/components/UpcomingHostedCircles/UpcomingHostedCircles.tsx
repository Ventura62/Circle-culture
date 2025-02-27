import React from "react";
import YourCircleCard from "../YourCircleCard/YourCircleCard";
import LoadingSpinner from "../shared/LoadingSpinner";
import { useGetUpcomingHostedCircles } from "@/hooks/useHostedCircles";

const UpcomingHostedCircles = () => {
  const { circles, isLoading, error } = useGetUpcomingHostedCircles();

  if (isLoading) return <LoadingSpinner />;
  if (error) return <p className="text-red-500 text-center">Error: {error}</p>;

  return (
    <div className="flex flex-col gap-6">
      {circles?.map((circle) => (
        <YourCircleCard key={circle.id} circleData={circle} type="hosted" />
      ))}
    </div>
  );
};

export default UpcomingHostedCircles;
