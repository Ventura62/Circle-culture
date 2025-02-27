import { useStripe, useElements, PaymentElement } from "@stripe/react-stripe-js";
import { useState } from "react";

const AddPaymentsBtn = () => {
  const stripe = useStripe();
  const elements = useElements();
  const [loading, setLoading] = useState(false);
  const [paymentMethodId, setPaymentMethodId] = useState(null);

  //   const handleSubmit = async (e: any) => {
  //     e.preventDefault();
  //     if (!stripe || !elements) return;

  //     setLoading(true);

  //     const { error } = await stripe.confirmSetup({
  //       type: "card",
  //       card: elements.getElement(PaymentElement),
  //     });

  //     if (error) {
  //       console.error(error);
  //       setLoading(false);
  //     } else {
  //       console.log("PaymentMethod ID:", paymentMethod?.id);
  //       setPaymentMethodId(paymentMethod?.id);
  //       // Send this ID to your backend to store in the database
  //     }

  //     setLoading(false);
  //   };

  return (
    <button>Manage Payments</button>
    // <form onSubmit={handleSubmit}>
    //   <button type="submit" disabled={!stripe || loading}>
    //     {loading ? "Processing..." : "Add Payment Method"}
    //   </button>
    //   {paymentMethodId && <p>PaymentMethod ID: {paymentMethodId}</p>}
    // </form>
  );
};

export default AddPaymentsBtn;
