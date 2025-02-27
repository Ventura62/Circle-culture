import { Elements, PaymentElement, useElements, useStripe } from "@stripe/react-stripe-js";
import React, { useState } from "react";
import { loadStripe } from "@stripe/stripe-js";
import SetupForm from "@/components/SetupForm/SetupForm";
const stripePromise = loadStripe("pk_test_51MFkvUKcBqZZ0sjUPBNSaBeT7qOAcTe3G9qrPyYiIOw1udZ0jjFqtSsYJLBTIc5FUeUEe2oi5nYInaWArpu5wB2100wQLI8pHo");
const StripeAdd = () => {
  const options = {
    // passing the SetupIntent's client secret
    clientSecret: "seti_1QtEInKcBqZZ0sjUYgQeVI3u_secret_Rmnui32RjhALvjHCpgOLEHMMahr07nt",
    // Fully customizable with appearance API.
    appearance: {
      /*...*/
    },
  };

  return (
    <Elements stripe={stripePromise} options={options}>
      <SetupForm />
    </Elements>
  );
};

export default StripeAdd;
