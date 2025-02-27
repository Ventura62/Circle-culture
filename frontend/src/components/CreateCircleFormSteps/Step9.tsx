import { useCreateCircleContext } from "@/context/CreateCircleContext";
import { FaStar } from "react-icons/fa6";
import { format, parseISO } from "date-fns";
import ImageUploader from "../shared/ImageUploader/ImageUploader";

const Step9 = () => {
  const { formData, setFormData } = useCreateCircleContext();

  const setCoverImage = (url: string) => {
    setFormData((prev) => ({
      ...prev,
      image: url as string,
    }));
  };

  return (
    <div className="w-full text-center flex flex-col gap-2">
      <h1 className="font-medium text-lg">
        Review the description & upload the cover image for your Circle
      </h1>
      <div className="relative text-white p-2.5 bg-primary border-px border-bright-gray rounded-md flex flex-col gap-1 text-text-primary transition-all duration-200">
        <ImageUploader image={formData.image ?? ""} setImage={setCoverImage} />

        <p className="text-left font-medium text-lg">{formData.name}</p>

        <div className="flex items-center justify-between max-470:flex-col max-470:items-start max-470:gap-1">
          <p>
            {formData.city} ({formData.radius} miles)
          </p>
          <p>
            {formData.firstSlot
              ? format(parseISO(formData.firstSlot), "EEE, MMM do 'at' h:mm a")
              : "MM/DD/YYYY hh:mm aa"}
          </p>
        </div>

        <div className="flex items-center justify-between gap-3">
          <div className="flex items-center justify-between gap-3">
            <span className="relative flex items-center justify-end after:content-[''] after:absolute after:-right-2 after:h-1 after:w-1 after:rounded-full after:bg-text-primary">
              {formData.criteria}
            </span>
            <span>{formData.category}</span>
          </div>
          <span className="relative flex items-center justify-end after:content-[''] after:absolute after:-right-2 after:h-1 after:w-1 after:rounded-full after:bg-text-primary">
            Age {formData.minAge + " - " + formData.maxAge}
          </span>
        </div>

        <div className="flex items-center justify-between mt-2 font-medium">
          <div className="flex items-center justify-between gap-1">
            <FaStar className="relative bottom-px" />
            <p>New</p>
          </div>
          <p>${formData.ticketPrice}</p>
        </div>
      </div>
    </div>
  );
};

export default Step9;
