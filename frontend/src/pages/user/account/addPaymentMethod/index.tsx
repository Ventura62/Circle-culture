import AddPaymentMethodCard from "@/components/AddPaymentMethodCard/AddPaymentMethodCard";
import { Button } from "@/components/ui/button";
import React, { useState } from "react";

const AddPaymentMethod = () => {
  const [billingCountry, setBillingCountry] = useState("");
  const [cardType, setCardType] = useState("");
  console.log(cardType, billingCountry);
  const handleAddingNewMethod = () => {};
  return (
    <div className="px-[15px] py-6">
      <AddPaymentMethodCard billingCountry={billingCountry} setBillingCountry={setBillingCountry} cardType={cardType} setCardType={setCardType} />
      <div className="flex flex-col items-center justify-center pt-10">
        <Button onClick={handleAddingNewMethod} className="w-[250px] self-center text-white rounded-full py-6 !bg-secondary border-1.5 border-secondary hover:!bg-transparent hover:!text-[#466A97]">
          Confirm
        </Button>
      </div>
    </div>
  );
};

export default AddPaymentMethod;
