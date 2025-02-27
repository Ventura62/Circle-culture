import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import { CircleCardGeneralInfo } from "@/models/Circle";
import Image from "next/image";
import React from "react";
import CircleCardImageHuge from "@/assets/images/circle-image-test-huge.png";
import Rate from "@/components/shared/Rate";
import { Button } from "@/components/ui/button";
import { subHours, format } from "date-fns";
import { IoPlaySkipForwardOutline } from "react-icons/io5";
import { TbCreditCardRefund } from "react-icons/tb";
import { TbMapQuestion } from "react-icons/tb";
import { LuBrain } from "react-icons/lu";
import { useGetHangoutById } from "@/hooks/useGetHangoutById";
import { useRouter } from "next/router";
import LoadingSpinner from "@/components/shared/LoadingSpinner";
import { useCancelHangout } from "@/hooks/useCancelHangout";

//No hardcoded except image
type Props = {
  cardData: CircleCardGeneralInfo;
  onCancel: () => void;
  isCancelLoading: boolean;
};

const hangoutDetails = () => {
  const router = useRouter();
  const hangoutId = router.query.hangoutId;
  const { hangout, isLoading, error } = useGetHangoutById(
    (hangoutId as string) ?? ""
  );
  const { cancelHangout, isCancelHangoutLoading, cancelHangoutError, success } =
    useCancelHangout((hangoutId as string) ?? "");

  const handleCancel = async () => {
    await cancelHangout("hangout-id-123");
    if (success) {
      console.log("Hangout canceled successfully!");
    }
    if (error) {
      console.error(error);
    }
  };

  if (isLoading) return <LoadingSpinner />;
  return (
    <UpcomingCircleInfo
      cardData={hangout as CircleCardGeneralInfo}
      onCancel={handleCancel}
      isCancelLoading={isCancelHangoutLoading}
    />
  );
};

const UpcomingCircleInfo = ({ cardData, isCancelLoading, onCancel }: Props) => {
  return (
    <div className="md:px-14  lg:px-24 pb-14">
      <AccountSubHeader
        title={
          cardData?.status == "PENDING"
            ? "Group Pending Formation"
            : "Success! Group Confirmed"
        }
        enableBackPress
      />

      <div className="px-4 md:px-6">
        {/* Name , Sas , City , Age , Criteria , Category*/}
        <div>
          <h3 className="text-2xl  line-clamp-4  font-medium">
            {cardData?.name}
          </h3>
          <span className="text-white ">
            <Rate
              className="mr-2"
              rate={cardData?.rate?.stars}
              amount={cardData?.rate?.reviewsCount}
            />
            {cardData?.city} • {cardData?.minAge}-{cardData?.maxAge} •{" "}
            {cardData?.criteria} • {cardData?.category}
          </span>
        </div>

        {/* Image , InfoCard , Help Card */}
        <div className="flex flex-col lg:grid gap-14 md:gap-4 lg:grid-cols-[600px,1fr,1fr] lg:grid-rows-2 max-1100:flex max-1100:flex-col">
          <div className=" lg:w-[490px] ">
            <Image
              className="mt-2 w-full  max-h-[250px] lg:h-[300px] object-cover object-top rounded-lg "
              src={CircleCardImageHuge}
              alt="Circle Card Logo"
            />
          </div>
          <div className="self-center  w-full grid-cols-2 col-span-2 max-1100:w-full">
            {cardData?.status === "CONFIRMED" && (
              <ConfirmedInfoCards
                circleDate={cardData.dateTime}
                circleLocation={
                  cardData?.location?.location ?? "Not Yet Selected"
                }
              />
            )}
            {cardData?.status === "PENDING" && (
              <PendingInfoCards circleDate={cardData.dateTime} />
            )}
          </div>

          <div className="grid-row-2 col-span-3 border-t-[0.5px] mt-2 py-8 md:mt-[40px] ">
            {cardData?.status === "CONFIRMED" && <ConfirmedHelpCard />}
            {cardData?.status === "PENDING" && <PendingHelpCard />}
          </div>
        </div>

        {/* Cancel */}
        <div className="flex justify-center mt-12 lg:mt-2 lg:justify-end">
          <Button
            className="border-1.5 border-[#730808] !bg-[#730808] text-white w-[100%] lg:w-48 rounded-full"
            onClick={onCancel}
            disabled={isCancelLoading}
          >
            {isCancelLoading ? "Cancelling..." : "Cancel"}
          </Button>
        </div>
      </div>
    </div>
  );
};

const PendingInfoCards = ({ circleDate }: { circleDate: Date }) => {
  const deadlineDate = subHours(circleDate, 24);
  const formattedDate = format(deadlineDate, "MMMM do, yyyy 'at' hh:mm a");

  return (
    <div className="flex flex-col gap-4">
      <div className="bg-primary px-4 py-4 rounded-md border-2 border-white/30">
        <p className="text-lg">Your spot is pending</p>
        <p className="text-textDark">
          Find out if your group hits critical mass (4 people) by:
        </p>
        <p>{formattedDate}</p>
      </div>
      <div className="bg-primary px-6 py-4 rounded-md border-2 border-white/30">
        <p className="text-lg">Start Time</p>
        <p className="text-textDark">
          If a group is formed, your Circle starts on:
        </p>
        <p>{format(circleDate, "MMMM do, yyyy 'at' hh:mm a")}</p>
      </div>
    </div>
  );
};

const ConfirmedInfoCards = ({
  circleDate,
  circleLocation,
}: {
  circleDate: Date;
  circleLocation: string;
}) => {
  return (
    <div className="flex flex-col gap-4 max-w-[500px]">
      <div className=" bg-primary px-6 py-4 rounded-md border-2   border-white/30 ">
        <p className="   text-textDark">Date and Time</p>
        <p>{format(circleDate, "MMMM do, yyyy 'at' hh:mm a")}</p>
      </div>
      <div className=" bg-primary px-6 py-4 rounded-md  border-2   border-white/30 ">
        <p className="text-textDark">Reservation Name & Location</p>
        <p>{circleLocation}</p>
      </div>
      <div className="flex  items-center gap-4  my-2 max-470:flex-col  lg:gap-8 justify-center">
        <Button className=" w-[100%] max-1100:w-48 max-470:w-full   rounded-full py-6 px-6 bg-secondary border-1.5 border-secondary text-white hover:text-[#466A97]">
          I’ll be there
        </Button>
        <Button className="  w-[100%] max-1100:w-48 max-470:w-full  rounded-full px-6 py-6 bg-black border-white/30 border-2 text-white">
          I’ll be late
        </Button>
      </div>
    </div>
  );
};

const PendingHelpCard = () => {
  return (
    <div>
      <p className="mb-4 text-2xl">What Happens Next?</p>
      <div className=" border-2 border-white/30  flex-col flex lg:flex-row justify-between gap-14 py-4 px-6 rounded-md ">
        <div>
          <div className="flex -ml-4  items-center gap-1">
            <IoPlaySkipForwardOutline className=" text-xl" />
            <p>Next Step</p>
          </div>
          <ul>
            <li className="ml-4 text-textDark list-disc">
              {" "}
              Your Circle needs at least 4 people to form. 
            </li>
            <li className="ml-4 text-textDark list-disc">
              {" "}
              You'll receive a final confirmation and the location 24 hours
              before the start time.  
            </li>
          </ul>
        </div>
        <div>
          <div className="flex -ml-4  items-center gap-1">
            <TbCreditCardRefund className=" text-xl" />
            <p>Refund</p>
          </div>
          <ul>
            <li className="ml-4 list-disc text-textDark">
              {" "}
              If the Circle doesn’t form, you get a full refund automatically. 
            </li>
            <li className="ml-4 list-disc text-textDark">
              {" "}
              You can cancel up to 30 hours before the event for a full refund  
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};

const ConfirmedHelpCard = () => {
  return (
    <div>
      <p className="mb-4 text-2xl">What Happens Next?</p>
      <div className=" border-2 border-white/30  flex-col flex lg:flex-row justify-between gap-14 py-4 px-6 rounded-md ">
        <div>
          <div className="flex -ml-4  items-center gap-2">
            <TbMapQuestion className=" text-xl" />
            <p>What to Expect</p>
          </div>
          <ul className="">
            <li className="ml-4 list-disc text-textDark">
              {" "}
              Arrive 5 minutes early to settle in before dinner starts.
            </li>
            <li className="ml-4 list-disc text-textDark">
              You’ll be in a group of 4-6 people based on location, age, and
              other preferences.  
            </li>
            <li className="ml-4 list-disc text-textDark">
              {" "}
              Most faces may be new, but everyone’s here to have a great time!.
            </li>
          </ul>
        </div>
        <div>
          <div className="flex -ml-4  items-center gap-2">
            <LuBrain className=" text-xl" />
            <p>The 27 Circle Mindset</p>
          </div>
          <ul className="list-disc">
            <li className="ml-4 list-disc text-textDark">
              <span className="font-bold">Forget networking!</span> Friendships
              are not built on transactions. Be present, not strategic! 
            </li>
            <li className="ml-4 list-disc text-textDark">
              <span className="font-bold">Don’t hold back!</span> Say the thing,
              ask the question, you may never see them again!
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};
export default hangoutDetails;
