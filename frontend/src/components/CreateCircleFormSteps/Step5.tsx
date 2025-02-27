import { ChangeEvent, useContext } from "react";
import { useCreateCircleContext } from "@/context/CreateCircleContext";
import Input from "../shared/Input/Input";

const Step5 = () => {
  const { formData, setFormData } = useCreateCircleContext();

  const setCircleName = (e: ChangeEvent<HTMLInputElement>) => {
    setFormData((prev) => ({
      ...prev,
      name: e.target.value,
    }));
  };
  const setCircleDescription = (e: ChangeEvent<HTMLInputElement>) => {
    setFormData((prev) => ({
      ...prev,
      description: e.target.value,
    }));
  };

  // const setVisibility = (value: string) => {
  //   setFormData((prev) => ({
  //     ...prev,
  //     visibility: value === "true",
  //   }));
  // };

  return (
    <div className="text-center flex flex-col items-center gap-8 font-medium">
      <div className="w-full text-left flex flex-col gap-2">
        <h1 className="font-medium text-lg">Name your Circle</h1>
        <p className="text-md">
          Your Circle title shows what kind of people attendees can expect. Keep
          it within 1 to 3 words since details like city, radius, and date are
          already highlighted on the card.
        </p>
        <Input
          type="text"
          value={formData.name}
          onChange={setCircleName}
          maxLength={30}
          placeholder="Circle Name"
        />
      </div>
      <div className="w-full text-left flex flex-col gap-2">
        <h1 className="font-medium text-lg">Circle Description</h1>
        <p className="text-md">
          Is this Circle for deep connections or just passing the time, for
          active participants or fans, and is it for experienced guests,
          beginners, or all?
        </p>
        <Input
          type="text"
          value={formData.description ?? ""}
          onChange={setCircleDescription}
          maxLength={250}
          placeholder="Input Circle description here"
        />
      </div>
      {/* <div className="w-full text-left flex flex-col gap-2">
        <h1 className="font-medium text-lg">
          Do you want your profile to be visible on your Circle page?
        </h1>
        <RadioGroup
          defaultValue={formData.visibility.toString()}
          value={formData.visibility.toString()}
          onValueChange={setVisibility}
          className="flex items-center gap-8"
        >
          <div className="flex items-center space-x-2">
            <RadioGroupItem
              value="true"
              id="visibility-visible"
              className={`${
                formData.visibility.toString() === "true" &&
                "border-secondary border-opacity-100"
              }`}
            />
            <Label htmlFor="visibility-visible">Visible</Label>
          </div>
          <div className="flex items-center space-x-2">
            <RadioGroupItem
              value="false"
              id="visibility-hidden"
              className={`${
                formData.visibility.toString() === "false" &&
                "border-secondary border-opacity-100"
              }`}
            />
            <Label htmlFor="visibility-hidden">Hidden</Label>
          </div>
        </RadioGroup>
      </div> */}
    </div>
  );
};

export default Step5;
