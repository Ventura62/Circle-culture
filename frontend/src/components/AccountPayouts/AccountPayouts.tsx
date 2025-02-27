import React from "react";
import VisaInfo from "../VisaInfo/VisaInfo";
import { useRouter } from "next/navigation";

const AccountPayouts = () => {
  const router = useRouter();
  const onEditCardPress = () => {
    /* //TODO Edit Card Functionality */
  };
  return (
    <div className="text-white  rounded-lg shadow-lg  space-y-1  flex flex-col">
      <h2 className="text-2xl font-semibold pb-5">How You get Paid</h2>
      <div className="space-y-4 pb-10">
        {/* //TODO Loop over visa infos of user to display (pass on click law 3ozna) */}

        <VisaInfo cardNumber="9918" expirationDate="05/2027" onEditPress={onEditCardPress} />
        <VisaInfo cardNumber="9918" expirationDate="05/2027" />
      </div>

      <button
        type="button"
        onClick={() => {
          router.push("/addPaymentMethod");
        }}
        className="py-2.5 px-12 bg-secondary rounded-full border-2 border-secondary hover:bg-primary hover:!text-[#466A97] transition-all duration-200"
      >
        Add payout method
      </button>
    </div>
  );
};

export default AccountPayouts;
