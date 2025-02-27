import { ChangeEvent, useContext } from "react";
import CreateCircleContext, {
  useCreateCircleContext,
} from "@/context/CreateCircleContext";
import Input from "../shared/Input/Input";
import { RiQuestionLine } from "react-icons/ri";

const Step6 = () => {
  const { formData, setFormData } = useCreateCircleContext();

  const setTicketPrice = (e: ChangeEvent<HTMLInputElement>) => {
    const value = e.target.value;
    setFormData((prev) => ({
      ...prev,
      ticketPrice: value === "" ? 0 : Number(value),
    }));
  };

  return (
    <div className="w-full text-left flex flex-col gap-2 font-medium">
      <h1 className="font-medium text-lg">How much does each ticket cost?</h1>
      <p className="text-md">
        Important: Earnings are only paid to a registered direct deposit
        account. Without one, you forfeit your earnings; no credit or balance is
        held.
      </p>
      <Input
        type="number"
        className="!text-white"
        title="Ticket Price"
        prefix="USD"
        value={formData.ticketPrice ?? ""}
        onChange={setTicketPrice}
        placeholder="Ticket Price"
        label="Adults (ages 18 and older)"
      />
      {formData.ticketPrice !== 0 && (
        <div className="flex items-center gap-1">
          <p className="text-md">
            Earning with 6 guests: USD {(formData.ticketPrice * 4.8).toFixed(1)}
          </p>
          <div className="relative group">
            <RiQuestionLine size={16} className="cursor-pointer" />
            <div className="hidden group-hover:block top-full left-1/2 -translate-x-1/2 absolute bg-[#202425] rounded-lg shadow-xl drop-shadow-md w-60 p-4 text-sm">
              20% of the service fee helps cover platform and processing costs
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default Step6;
