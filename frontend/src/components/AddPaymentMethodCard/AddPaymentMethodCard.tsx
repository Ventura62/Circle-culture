"use client";

import BankIcon from "@/assets/images/BankIcon";
import FastPayIcon from "@/assets/images/FastPay";
import PayPalIcon from "@/assets/images/PayPalIcon";

import React from "react";
import PayOutOption from "../PayOutOption/PayOutOption";
import Dropdown from "../shared/Dropdown/Dropdown";

interface AddPaymentMethodCardProps {
  billingCountry: string;
  setBillingCountry: (bc: string) => void;
  cardType: string;
  setCardType: (ct: string) => void;
}

const paymentDetails = [
  {
    icon: FastPayIcon,
    title: "Fast pay",
    details: ["Visa or Mastercard debit required", "30 minutes or less", "1.5% fee (maximum $15)"],
  },
  {
    icon: BankIcon,
    title: "Bank account",
    details: ["3-5 business days", "No fees"],
  },
  {
    icon: PayPalIcon,
    title: "Paypal",
    details: ["1 business day", "Paypal fees may apply"],
  },
];
const billingCountries = ["LA", "Cairo", "Egypt"];

const AddPaymentMethodCard = ({ billingCountry, setBillingCountry, cardType, setCardType }: AddPaymentMethodCardProps) => {
  return (
    <div className="bg-primary text-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto ">
      <div>
        <h3 className="text-2xl font-semibold mb-4 text-center">Add a payout method</h3>

        <div className="pb-4">
          <h3 className="text-2xl font-semibold ">Lets add a payout method</h3>
          <h3 className="text-md  ">To start, let us know where you’d like us to send your money.</h3>
        </div>

        <div className="mb-10">
          <h1 className="font-medium text-lg pb-4">Billing country/region</h1>
          <Dropdown
            placeholder
            title="Billing Country"
            content={billingCountries}
            value={billingCountry}
            setValue={(data) => {
              setBillingCountry(data.toString());
            }}
          />
        </div>
        <div className="pb-4">
          <h3 className="text-2xl font-semibold ">How would you like to get paid</h3>
          <h3 className="text-md  ">Payouts will be send in USD</h3>
        </div>
        <div className="text-white mb-4 rounded-lg mt-5 max-w-4xl mx-auto border border-[#FFFFFF4D]">
          {paymentDetails.map((item, index) => (
            <div key={index} className="group cursor-pointer transition-all">
              <PayOutOption
                icon={item.icon}
                title={item.title}
                details={item.details}
                isSelected={cardType === item.title}
                onPress={() => setCardType(item.title)}
              />
              {index < paymentDetails.length - 1 && <div className="border-t border-[#FFFFFF4D] mt-4"></div>}
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default AddPaymentMethodCard;
