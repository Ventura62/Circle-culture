"use client";
import { ChevronLeft } from "lucide-react";
import { useRouter } from "next/router";
import React from "react";

interface AccountSubHeaderProps {
  title: string;
  subtitle?: string;
  enableBackPress?: boolean;
  onBackPress?: () => void;
  step?: string;
}

const AccountSubHeader = ({
  title,
  subtitle,
  enableBackPress,
  step,
  onBackPress,
}: AccountSubHeaderProps) => {
  const router = useRouter();
  const handleBack = () => {
    if (onBackPress) {
      onBackPress();
      return;
    }
    router.back();
  };
  return (
    <div className="w-full flex items-center px:4 md:px-0 pb-10 justify-between">
      <div
        className={`flex ${subtitle ? "items-start" : "items-center"} gap-4`}
      >
        {enableBackPress && (
          <button
            onClick={handleBack}
            className="text-white ps-4 hover:bg-white/10 h-full rounded-md transition-all duration-200"
          >
            <ChevronLeft size={24} />
          </button>
        )}
        <div className="flex flex-col items-start">
          <h2 className="text-2xl md:text-[32px] font-semibold">{title}</h2>
          {subtitle && <p className="text-white/50">{subtitle}</p>}
        </div>
      </div>
      {step && (
        <div className="text-lg mr-6 font-medium text-white ">{step}</div>
      )}
    </div>
  );
};

export default AccountSubHeader;
