import { ChangeEvent, useContext } from "react";
import CreateCircleContext, {
  useCreateCircleContext,
} from "@/context/CreateCircleContext";
import Input from "../shared/Input/Input";

const Step7 = () => {
  const { formData, setFormData } = useCreateCircleContext();

  const setRestaurantName = (e: ChangeEvent<HTMLInputElement>) => {
    setFormData((prev) => ({
      ...prev,
      restaurantName: e.target.value,
    }));
  };

  const setAddress = (e: ChangeEvent<HTMLInputElement>) => {
    setFormData((prev) => ({
      ...prev,
      address: e.target.value as string,
    }));
  };

  const setNameOnReservation = (e: ChangeEvent<HTMLInputElement>) => {
    setFormData((prev) => ({
      ...prev,
      nameOnReservation: e.target.value,
    }));
  };

  return (
    <div className="w-full text-left flex flex-col gap-2">
      <h1 className="font-medium text-lg">
        Enter the name and address of the first Circle&apos;s location
      </h1>
      <p className="text-md">
        The restaurant&apos;s name and location will be revealed only 24 hours
        before the start time
      </p>
      {/* <Input
        type="text"
        value={formData.restaurantName}
        onChange={setRestaurantName}
        placeholder="Restaurant Name"
      />
      <Input
        type="text"
        value={formData.address}
        onChange={setAddress}
        placeholder="Address"
      />
      <Input
        type="text"
        value={formData.nameOnReservation}
        onChange={setNameOnReservation}
        placeholder="Name on Reservation"
      /> */}
    </div>
  );
};

export default Step7;
