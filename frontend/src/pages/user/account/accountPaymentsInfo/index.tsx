import AccountPayments from "@/components/AccountPayments/AccountPayments";
import AccountPayouts from "@/components/AccountPayouts/AccountPayouts";
import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import { useRouter } from "next/navigation";
import React, { useState } from "react";
const AccountPaymentsInfo = () => {
  const [activeTab, setActiveTab] = useState("payments");
  const router = useRouter();
  const handleBack = () => {
    router.back();
  };
  const handleTabChange = (tab: string) => {
    setActiveTab(tab);
  };
  return (
    <div className="md:px-14  lg:px-24 pb-14">
      <AccountSubHeader title="Payments & payouts" enableBackPress />
      <div className="min-w-full  p-6  ms-5 max-878:ms-0 mr-[8px]">
        <div className="space-y-8 w-full max-w-[800px] min-w-[100px] pb-10 ">
          <div className="flex border-b border-gray-500  xs:mr-[12px]">
            <div
              className={`cursor-pointer text-xl font-semibold py-2 px-4 ${
                activeTab === "payments"
                  ? "text-white border-b-2 border-white"
                  : "text-gray-400"
              }`}
              onClick={() => handleTabChange("payments")}
            >
              Payments
            </div>
            <div
              className={`cursor-pointer text-xl font-semibold py-2 px-4 ${
                activeTab === "payouts"
                  ? "text-white border-b-2 border-white"
                  : "text-gray-400"
              }`}
              onClick={() => handleTabChange("payouts")}
            >
              Payouts
            </div>
          </div>
          {activeTab === "payments" && <AccountPayments />}
          {activeTab === "payouts" && <AccountPayouts />}
        </div>
      </div>
    </div>
  );
};

export default AccountPaymentsInfo;
