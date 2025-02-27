import React from "react";
import VisaInfo from "../VisaInfo/VisaInfo";
import { Elements } from "@stripe/react-stripe-js";
import { useRouter } from "next/router";
const AccountPayments = () => {
  const router = useRouter();
  const handleManagePayments = () => {
    //TODO handle managings users payments
    router.push("/user/account/stripeAdd");
  };
  return (
    <div className="text-white  rounded-lg shadow-lg  space-y-8">
      <div>
        <h2 className="text-2xl font-semibold">Your payments</h2>
        <p className="text-white mb-4 text-md">
          Keep track of all your payments and refunds.
        </p>
        <button
          className="text-white py-3 px-6 mt-4 rounded-lg border-[0.5px] border-white font-semibold hover:bg-white hover:text-black transition duration-200"
          onClick={handleManagePayments}
        >
          Manage payments
        </button>
      </div>

      <div className="pt-[30px]">
        <h2 className="text-2xl font-semibold">Payment methods</h2>
        <p className="text-white mb-4 text-md">
          Add and manage your payment methods using our secure payment system.
        </p>
        <div className="space-y-8 w-full max-w-[800px] min-w-[100px] ">
          <div className="flex border-b border-gray-500 mt-10 mb-5  xs:mr-[12px]"></div>
        </div>

        {/* //TODO Loop over visa infos of user to display (pass on click law 3ozna) */}
        <VisaInfo cardNumber="9918" expirationDate="05/2027" />
      </div>
    </div>
  );
};

export default AccountPayments;
