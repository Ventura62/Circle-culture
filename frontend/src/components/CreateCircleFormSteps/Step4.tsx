import Dropdown from "../shared/Dropdown/Dropdown";
import { useCreateCircleContext } from "@/context/CreateCircleContext";
import { DualRangeSlider } from "../ui/dual-range-slider";
import { z } from "@/config/zodConfig";
const CircleCriteriaEnum = z.enum(["male", "female", "none"]);
type CircleCriteriaType = z.infer<typeof CircleCriteriaEnum>;
const Step4 = () => {
  const { formData, setFormData } = useCreateCircleContext();

  const extractedValues = Object.values(CircleCriteriaEnum)
    .filter((item) => item && typeof item === "object" && "values" in item)
    .map((item) => item.values)[0];

  const setCriteria = (criteria: string | number) => {
    if (
      typeof criteria === "string" &&
      extractedValues.includes(criteria as CircleCriteriaType)
    ) {
      setFormData((prev) => ({
        ...prev,
        criteria: criteria as CircleCriteriaType,
      }));
    }
  };

  const setAgeRange = (value: number[]) => {
    setFormData((prev) => ({
      ...prev,
      minAge: value[0],
      maxAge: value[1],
    }));
  };

  return (
    <div className="flex flex-col items-center gap-10 text-center font-medium">
      <div className="flex w-full flex-col gap-2 text-left">
        <h1 className="text-lg font-medium">Who can join your circle?</h1>
        <Dropdown
          placeholder
          title="Gender"
          content={extractedValues}
          value={formData.criteria}
          setValue={setCriteria}
        />
      </div>

      <div className="flex w-full flex-col gap-2 text-left">
        <h1 className="text-lg font-medium">Age range</h1>
        <p className="mb-7">Age range</p>
        <div className="flex flex-col items-start gap-0.5">
          <DualRangeSlider
            label={(value) => value}
            value={[formData.minAge, formData.maxAge]}
            min={18}
            max={60}
            step={1}
            onValueChange={setAgeRange}
          />
        </div>
      </div>
    </div>
  );
};

export default Step4;
