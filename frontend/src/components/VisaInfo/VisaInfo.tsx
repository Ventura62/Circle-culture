"use client";

import VisaLogo from "@/assets/images/VisaLogo";
import React from "react";

const VisaInfo = ({
  cardNumber,
  expirationDate,
  onVisaClick,
  onEditPress,
}: {
  cardNumber: string;
  expirationDate: string;
  onVisaClick?: () => void;
  onEditPress?: () => void;
}) => {
  return (
    <div
      className={`flex flex-row justify-between items-center ${
        onVisaClick ? "cursor-pointer hover:bg-gray-700" : ""
      }`}
      onClick={() => {
        if (onVisaClick) {
          onVisaClick();
        }
      }}
    >
      <div className="flex items-center justify-between gap-4 ">
        <VisaLogo />
        <div>
          <p className="text-lg font-semibold">{`VISA******${cardNumber.slice(
            -4
          )}`}</p>
          <p className="text-sm text-gray-400">{`Expiration ${expirationDate}`}</p>
        </div>
      </div>

      {onEditPress && (
        <button
          onClick={(e) => {
            e.stopPropagation();
            onEditPress();
          }}
          className="text-white py-2 px-6 mr-4 rounded-lg border border-white font-semibold hover:bg-white hover:text-black transition-all duration-200"
        >
          Edit
        </button>
      )}
    </div>
  );
};

export default VisaInfo;
