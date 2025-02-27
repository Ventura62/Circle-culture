import {
  Dispatch,
  SetStateAction,
  useCallback,
  useEffect,
  useState,
} from "react";
import Step1 from "@/components/CreateCircleFormSteps/Step1";
import Step2 from "@/components/CreateCircleFormSteps/Step2";
import Step3 from "@/components/CreateCircleFormSteps/Step3";
import Step4 from "@/components/CreateCircleFormSteps/Step4";
import Step5 from "@/components/CreateCircleFormSteps/Step5";
import Step6 from "@/components/CreateCircleFormSteps/Step6";
import Step7 from "@/components/CreateCircleFormSteps/Step7";
import Step8 from "@/components/CreateCircleFormSteps/Step8";
import Step9 from "@/components/CreateCircleFormSteps/Step9";
import Step10 from "@/components/CreateCircleFormSteps/Step10";
import { CreateCircleSchema, CreateCircleSchemaForm } from "@/models/Circle";
import axios from "axios";
import { useZodParser } from "./useZodParser";

const steps = [
  <Step1 key={1} />,
  <Step2 key={2} />,
  <Step4 key={4} />,
  <Step5 key={5} />,

  // <Step3 key={3} />,
  //  <Step4 key={4} />,
  // <Step5 key={5} />,
  <Step6 key={6} />,
  // <Step7 key={7} />,
  <Step8 key={8} />,
  <Step9 key={9} />,
  <Step10 key={10} />,
];

export const circlesData = [
  {
    id: 0,
    slug: "hikers-dinner",
    activity: "Active",
    title: "Hikers Dinner",
    rating: 4.56,
    numberOfRates: 122,
    price: 75,
    city: "Sunnyvale",
    radius: 15,
    ageRange: {
      min: 21,
      max: 27,
    },
    gender: "Ladies Only",
    category: "Artists",
    date: "Fri, Sept 17th at 4:00 PM",
  },
  {
    id: 1,
    slug: "founders-dinner",
    activity: "Paused",
    title: "Founders Dinner",
    rating: 4.56,
    numberOfRates: 122,
    price: 75,
    city: "Sunnyvale",
    radius: 15,
    ageRange: {
      min: 21,
      max: 27,
    },
    gender: "Ladies Only",
    category: "Artists",
    date: "Fri, Sept 17th at 4:00 PM",
  },
];

// export type CreateCircleFormData = {
//   city: string;
//   radius: number;
//   category: string;
//   gender: "Men Only" | "Ladies Only" | "Everyone" | "";
//   ageRange: {
//     min: number;
//     max: number;
//   };
//   circleName: string;
//   visibility: boolean;
//   ticketPrice: number | null;
//   restaurantName: string;
//   address: string;
//   nameOnReservation: string;
//   firstCircleTime: string;
//   coverImage: string;
// };

// const defaultValue: CreateCircleFormData = {
//   city: "",
//   radius: 0,
//   category: "",
//   gender: "",
//   ageRange: {
//     min: 18,
//     max: 60,
//   },
//   circleName: "",
//   visibility: true,
//   ticketPrice: null,
//   restaurantName: "",
//   address: "",
//   nameOnReservation: "",
//   firstCircleTime: "",
//   coverImage: "",
// };

export interface CreateCircleContextState {
  steps: React.ReactNode[];
  currentStep: number;
  setCurrentStep: Dispatch<SetStateAction<number>>;
  validationResults: {
    step: number;
    valid: boolean;
    message: string;
  };
  setValidationResults: Dispatch<
    SetStateAction<{ step: number; valid: boolean; message: string }>
  >;
  formData: CreateCircleSchemaForm;
  setFormData: Dispatch<SetStateAction<CreateCircleSchemaForm>>;
  handleNext: () => void;
  handleBack: () => void;
  submitCreateCircle: () => void;
}

export const useCreateCircle = (): CreateCircleContextState => {
  const [currentStep, setCurrentStep] = useState<number>(0);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const { triggerParser } = useZodParser();

  const [formData, setFormData] = useState<CreateCircleSchemaForm>({
    city: "",
    radius: 10,
    category: "Category1",
    criteria: "none",
    minAge: 18,
    maxAge: 100,
    name: "",
    description: "",
    ticketPrice: 0,
    firstSlot: "",
    image: "",
  });
  const [validationResults, setValidationResults] = useState<{
    step: number;
    valid: boolean;
    message: string;
  }>({
    step: -1,
    valid: true,
    message: "",
  });

  const validateStep = useCallback(
    (step: number) => {
      const errorMessages: string[] = [];
      let result = { step: -1, valid: true, message: "" };
      console.log(formData.category);
      const addError = (message: string) => errorMessages.push(message);

      switch (step) {
        case 1:
          if (!formData.city) addError("city");
          break;
        // case 4:
        //   if (!formData.category) addError("category of interest");
        //   break;
        case 2:
          if (!formData.criteria) addError("gender group");
          break;
        case 3:
          if (!formData.name) addError("name for the circle");
          break;
        case 4:
          if (!formData.ticketPrice) addError("ticket price");
          break;
        // case 6:
        //   if (!formData.restaurantName) addError("restaurant's name");
        //   if (!formData.address) addError("address");
        //   if (!formData.nameOnReservation) addError("name on reservation");
        //   break;
        case 5:
          if (!formData.firstSlot)
            addError("date and time for the first circle.");
          break;
        case 6:
          if (!formData.image) addError("cover image for the circle.");
          break;
        default:
          break;
      }

      if (errorMessages.length > 0) {
        result = {
          step,
          valid: false,
          message: `Please provide a ${errorMessages.join(", ")}`,
        };
      }

      setValidationResults(result);
      return result.valid;
    },
    [formData]
  );

  useEffect(() => {
    validateStep(currentStep);
  }, [formData, currentStep, validateStep]);

  useEffect(() => {
    setValidationResults({ step: -1, valid: true, message: "" });
  }, [currentStep]);

  const handleNext = () => {
    if (currentStep < steps.length && validateStep(currentStep)) {
      setCurrentStep((prev) => prev + 1);
    }
  };

  const handleBack = () => {
    if (currentStep > 0) setCurrentStep((prev) => prev - 1);
  };
  const submitCreateCircle = async () => {
    if (!validateStep(2)) {
      console.error("Validation failed. Cannot submit.");
      return Promise.reject(new Error("Please complete all required fields."));
    }

    setIsSubmitting(true);

    try {
      console.log("Submitting data:", formData);
      const response = await axios.post("/circle/create", formData);

      const data = response.data;
      if (data.okay) {
        const createdCircle = triggerParser(
          data.data,
          CreateCircleSchema,
          "/circle/create",
          "post"
        );
        console.log("Success:", createdCircle);
        return createdCircle;
      } else {
        return Promise.reject(new Error(data.message));
      }
    } catch (error) {
      console.error("Error submitting:", error);
      return Promise.reject(error);
    } finally {
      setIsSubmitting(false);
    }
  };
  return {
    steps,
    currentStep,
    setCurrentStep,
    validationResults,
    setValidationResults,
    formData,
    setFormData,
    handleNext,
    handleBack,
    submitCreateCircle,
  };
};
