import CircleCardSummary from "@/components/payment/CircleCardSummary";
import CirclePayment from "@/components/payment/CirclePayment";
import { Button } from "@/components/ui/button";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faChevronLeft } from "@fortawesome/free-solid-svg-icons";
import { useState } from "react";
import { useGetCircleById } from "@/hooks/useGetCircleById";
import { useRouter } from "next/router";
import LoadingSpinner from "@/components/shared/LoadingSpinner";
import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
export default function Payment() {
  const router = useRouter();
  const circleId = router.query.circleId;
  const slotId = router.query.slotId;

  const { circle, isLoading, error } = useGetCircleById(
    (circleId as string) ?? ""
  );
  const selectedSlot = circle?.timeSlots.find((slot) => slot.id === slotId);
  const [paymentDone, setPaymentDone] = useState(false);

  if (isLoading) {
    return <LoadingSpinner />;
  }
  return (
    <div className=" md:px-14  lg:px-24  ">
      <AccountSubHeader title="Confirm and pay" enableBackPress />
      <div className=" flex md:px-0 px-8  flex-col-reverse md:flex-row  gap-[35px] md:gap-20">
        <div className="md:ms-10  max-w-[1000px]">
          <CirclePayment
            paymentDone={paymentDone}
            setPaymentDone={setPaymentDone}
            selectedSlot={selectedSlot}
          />
        </div>

        <div className="flex-1 ">
          <CircleCardSummary
            paymentDone={paymentDone}
            id={circle?.id ?? ""}
            name={circle?.name ?? ""}
            price={circle?.price ?? 0}
            city={circle?.city ?? ""}
            rate={circle?.rate || { stars: 0, reviewsCount: 0 }}
            image={circle?.image}
          />
        </div>
      </div>
    </div>
  );
}
