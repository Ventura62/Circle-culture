"use client";

import React from "react";

interface PayOutOptionProps {
  icon: React.ElementType;
  title: string;
  details: string[];
  onPress: () => void;
  isSelected: boolean;
}

const PayOutOption: React.FC<PayOutOptionProps> = ({
  icon: Icon,
  title,
  details,
  onPress,
  isSelected,
}) => {
  return (
    <div
      className="text-white p-6 rounded-lg max-w-4xl mx-auto flex justify-between items-center"
      onClick={onPress}
    >
      <div className="flex items-start gap-4">
        <Icon size={24} className="text-white" />
        <div>
          <h3 className="text-xl font-semibold">{title}</h3>
          <ul className="list-disc pl-5 mt-4">
            {details.map((detail, index) => (
              <li key={index} className="text-gray-400">
                {detail}
              </li>
            ))}
          </ul>
        </div>
      </div>
      {/* Radio button */}
      <input
        type="radio"
        name="paymentOption"
        checked={isSelected}
        onChange={() => {}}
        className="w-6 h-6 appearance-none border-2 border-secondary rounded-full bg-transparent checked:bg-transparent checked:border-secondary flex items-center justify-center before:content-empty before:absolute before:hidden checked:before:block before:h-3 before:w-3 before:rounded-full before:bg-secondary"
      />
    </div>
  );
};

export default PayOutOption;
