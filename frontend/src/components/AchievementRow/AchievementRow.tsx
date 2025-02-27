import React from "react";
import { Lock } from "lucide-react";

interface AchievementRowProps {
  icon: string;
  title: string;
  description: string;
  isLocked: boolean;
}

const AchievementRow = ({
  icon,
  title,
  description,
  isLocked,
}: AchievementRowProps) => {
  return (
    <div className="flex flex-col sm:flex-row w-full rounded-lg p-1 gap-0 md:gap-6">
      <div className="flex flex-col md:flex-row items-center gap-3 border border-gray-600 px-4 py-4 sm:w-[10%] w-full">
        <span className="text-2xl">{icon}</span>
        <span className="text-lg font-semibold">{title}</span>
      </div>

      <div className="flex flex-row sm:flex-row justify-between text-gray-300 text-md border border-gray-600 px-4 py-4 flex-grow">
        {description}
        {isLocked && <Lock size={20} className="text-gray-400 ml-4" />}
      </div>
    </div>
  );
};

export default AchievementRow;
