"use client";
import React from "react";

interface StatItemProps {
  item: string;
  number: number | string;
}

const StatItem: React.FC<StatItemProps> = ({ item, number }) => {
  return (
    <div className="border-[0.5px] border-gray-500 rounded-lg text-center">
      {" "}
      <h3 className="text-lg font-semibold text-white px-10 py-3">
        {item}: {number}
      </h3>
    </div>
  );
};

export default StatItem;
