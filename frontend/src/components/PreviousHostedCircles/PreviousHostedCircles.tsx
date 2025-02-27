import React from "react";
import YourCircleCard from "../YourCircleCard/YourCircleCard";
import LoadingSpinner from "../shared/LoadingSpinner";
import { usePreviousHostedCircles } from "@/hooks/useHostedCircles";

const PreviousHostedCircles = () => {
  const { circles, isLoading, error } = usePreviousHostedCircles();

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

export default PreviousHostedCircles;
