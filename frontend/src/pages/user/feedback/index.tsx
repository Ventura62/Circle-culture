import CircleRating from "@/components/CircleRating/CircleRating";
import FeedbackReceived from "@/components/FeedbackReceived/FeedbackReceived";
import ReviewNotesForm from "@/components/ReviewNotesForm/ReviewNotesForm";
import UserFeedbackSelection from "@/components/UserFeedbackSelection/UserFeedbackSelection";
import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import { useFeedBackContext } from "@/context/FeedBackContextProvider";
import { useToastContext } from "@/context/ToastProviderContext";
import { useRouter } from "next/router";
import { useState } from "react";
import { number } from "zod";

const FeedbackForm = () => {
  const router = useRouter();
  const {
    circleMembers,
    isLoading,
    actions,
    setCircleMembers,
    feedbackOptions,
  } = useFeedBackContext();
  const { handleSubmitFeedBack, handleICouldntAttend } = actions;
  const [step, setStep] = useState(1);
  const [rating, setRating] = useState<number>(0);

  const handleRating = (index: number) => {
    setRating(index);
  };

  const handleNext = () => {
    setStep((prev) => prev + 1);
  };
  const onSubmitReviews = async (
    publicReview?: string,
    privateNote?: string
  ) => {
    await handleSubmitFeedBack({
      privateReview: privateNote,
      publicReview,
      membersFeedBack: circleMembers,
      rate: rating ?? 1,
    });
    setStep((prev) => prev + 1);
  };
  const handleNotAttending = () => {
    handleICouldntAttend();
    router.replace("/user/dashboard");
  };

  return (
    <div className="md:px-14 lg:px-24 ">
      <AccountSubHeader
        title="Feedback"
        enableBackPress={true}
        onBackPress={
          step == 1 || step == 4
            ? undefined
            : () => {
                setStep((prev) => prev - 1);
              }
        }
        step={step == 1 || step == 4 ? undefined : `${step}/3`}
      />
      <div className="flex flex-col flex-1 ">
        {step === 1 && (
          <CircleRating
            rating={rating}
            handleRating={handleRating}
            handleNext={handleNext}
            disabled={step == 1 && !rating}
            handleNotAttending={handleNotAttending}
          />
        )}
        {step === 2 && (
          <UserFeedbackSelection
            feedbackOptions={feedbackOptions}
            circleMembers={circleMembers}
            setCircleMembers={setCircleMembers}
            handleNext={handleNext}
          />
        )}
        {step === 3 && <ReviewNotesForm onSubmitReviews={onSubmitReviews} />}
        {step === 4 && <FeedbackReceived />}
      </div>
    </div>
  );
};

export default FeedbackForm;
