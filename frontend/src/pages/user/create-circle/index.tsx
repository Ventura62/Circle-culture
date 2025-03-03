import { Button } from "@/components/ui/button";
import CreateCircleContext, {
    CreateCircleProvider,
    useCreateCircleContext,
} from "@/context/CreateCircleContext";
import { useContext } from "react";
import { MdOutlineArrowBackIosNew } from "react-icons/md";

const CreateCircle = () => {
    const {
        steps,
        currentStep,
        handleBack,
        handleNext,
        validationResults,
        submitCreateCircle,
    } = useCreateCircleContext();
    const handleNextStep = () => {
        if (currentStep === 9) {
            submitCreateCircle();
        } else {
            handleNext();
        }
    };

    const handlePrevStep = () => {
        if (currentStep > 0) {
            handleBack();
        }
    };

    return (
        <form
            className={`${
                currentStep > 0 &&
                currentStep < steps.length - 1 &&
                "bg-primary max-w-[35rem] rounded-xl min-h-[auto]"
            } text-white max-w-[32rem] relative min-h-[32rem] flex flex-col justify-center mb-10 mx-auto max-592:mx-4`}
        >
            {currentStep > 0 && currentStep < steps.length - 1 && (
                <div className="relative py-5 border-b-1.5 border-[#656767] mb-7 w-full items-center">
                    <Button
                        type="button"
                        className="text-center font-bold absolute left-0 inset-y-0 my-auto w-fit"
                        onClick={handlePrevStep}
                    >
                        <MdOutlineArrowBackIosNew
                            className="text-4xl w-64"
                            width={32}
                            height={32}
                        />
                    </Button>
                    <h1 className="text-center font-bold ">
                        Create a new Circle
                    </h1>
                </div>
            )}
            <div className="px-10 max-780:px-4 pb-12 flex flex-col items-stretch justify-between">
                {currentStep >= 1 && currentStep < steps.length - 1 && (
                    <div className="mb-4 mx-auto flex flex-col items-end w-full">
                        <div className="w-full bg-[#D9D9D9] h-2 overflow-hidden mb-2">
                            <div
                                className="bg-secondary h-2 transition-all duration-200"
                                style={{
                                    width: `${
                                        (currentStep / (steps.length - 2)) * 100
                                    }%`,
                                }}
                            />
                        </div>

                        <p className="font-semibold text-sm">
                            {currentStep}/{steps.length - 2}
                        </p>
                    </div>
                )}

                <div key={currentStep} className="animate-slideInX min-h-44">
                    {steps[currentStep]}
                </div>

                {!validationResults.valid && (
                    <p className="text-red-600 mt-4 text-center">
                        {validationResults.message}
                    </p>
                )}
                {currentStep < steps.length - 1 && (
                    <div
                        className={`${
                            currentStep > 1
                                ? "justify-between"
                                : "justify-center"
                        } ${
                            validationResults.valid ? "mt-10" : "mt-4"
                        } flex items-stretch max-592:flex-col-reverse gap-4`}
                    >
                        {currentStep > 1 && (
                            <button
                                type="button"
                                onClick={handleBack}
                                className="py-2.5 px-12 rounded-full font-semibold border-2 border-white hover:bg-white hover:text-primary transition-all duration-200"
                            >
                                Back
                            </button>
                        )}
                        {currentStep !== 0 && (
                            <button
                                type={
                                    currentStep === steps.length - 1
                                        ? "submit"
                                        : "button"
                                }
                                onClick={handleNextStep}
                                className="py-2.5 px-12 rounded-full font-semibold border-2 border-white hover:bg-white hover:text-primary transition-all duration-200"
                            >
                                {currentStep < steps.length - 2
                                    ? "Next"
                                    : "Submit"}
                            </button>
                        )}
                    </div>
                )}
            </div>
        </form>
    );
};

export default CreateCircle;
