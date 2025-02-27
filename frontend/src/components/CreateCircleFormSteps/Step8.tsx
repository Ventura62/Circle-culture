import { useCreateCircleContext } from "@/context/CreateCircleContext";
import { DateTimePicker } from "../ui/date-time-picker";

const Step8 = () => {
  const { formData, setFormData } = useCreateCircleContext();

  const handleDateChange = (newDate: string) => {
    setFormData((prev) => ({ ...prev, firstSlot: newDate }));
  };

  return (
    <div className="w-full text-left flex flex-col gap-2 min-h-64 max-470:min-h-[22rem]">
      <h1 className="font-medium text-lg">
        When will be your first Circle’s time?
      </h1>
      <p className="text-md">
        You may share more open slots in the dashboard later
      </p>
      <DateTimePicker value={formData.firstSlot} onChange={handleDateChange} />
    </div>
  );
};

export default Step8;
