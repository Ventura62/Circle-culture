import React from "react";

interface StatItem {
  title: string;
  value: string | number;
}

interface StatsCardProps {
  stats: StatItem[];
}

const DashboardStats = ({ stats }: StatsCardProps) => {
  return (
    <div className="grid md:grid-cols-1 md:grid-rows-4 gap-2 w-full md:max-w-sm h-full grid-cols-2 grid-rows-2">
      {stats.map((stat, index) => (
        <div
          key={index}
          className="bg-background text-white p-4 rounded-lg border border-gray-600 flex flex-col justify-center  flex-grow"
        >
          <p className="md:text-2xl text-base font-bold">{stat.value}</p>
          <p className="md:text-lg text-md">{stat.title}</p>
        </div>
      ))}
    </div>
  );
};

export default DashboardStats;
