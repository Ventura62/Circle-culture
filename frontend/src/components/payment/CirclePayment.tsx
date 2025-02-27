import { Label } from "../ui/label";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "../ui/select";
import { Button } from "../ui/button";
import { format } from "date-fns";
import { useRouter } from "next/router";

type Props = {
  paymentDone: boolean;
  setPaymentDone: React.Dispatch<React.SetStateAction<boolean>>;
  selectedSlot?: { id?: string; datetime?: string };
};

const CirclePayment = (props: Props) => {
  const router = useRouter();
  const { push } = router;
  const { selectedSlot } = props;
  if (props.paymentDone) {
    return (
      <div>
        <p className=" text-2xl  font-medium">Your hangout is confirmed</p>
        <p className=" font-medium text-sm ">
          We emailed the dinner details, as well as how to join, to
          ebr0072@gmail.com.
        </p>
      </div>
    );
  }

  return (
    <div className="flex flex-col gap-6">
      <div className="flex flex-col">
        <Label className="text-gray-400">Date</Label>
        <p className="py-2 text-white">
          {selectedSlot?.datetime &&
            format(
              new Date(selectedSlot?.datetime ?? ""),
              "EEEE, MMM d - h:mm a"
            )}
        </p>
        <div className=" pt-[30px] border-b border-gray-400" />
      </div>
      <div>
        <Label>Pay with</Label>
        <Select>
          <SelectTrigger className=" border-px mt-4  bg-primary py-6 border-[#6A6A6A] hover:bg-white/10 outline-none transition-all duration-200">
            <SelectValue placeholder="Credit card or debit card" />
          </SelectTrigger>
          <SelectContent className="bg-primary border-white/10">
            <SelectItem
              className="hover:!bg-white/10 focus:!bg-white/10"
              value="light"
            >
              Credit Card
            </SelectItem>
            <SelectItem
              className="hover:!bg-white/10 focus:!bg-white/10"
              value="dark"
            >
              Debit Card
            </SelectItem>
            <SelectItem
              className="hover:!bg-white/10 focus:!bg-white/10"
              value="system"
            >
              Stripe
            </SelectItem>
          </SelectContent>
        </Select>
      </div>
      <p className=" text-sm mt-2">
        By selecting the button below, I agree to 27 Circle policies and that 27
        Circle can charge my payment method if any financial complications
        occur. I agree to pay the total amount shown if the Connector accepts my
        booking request.
      </p>
      <Button
        onClick={() => {
          // props.setPaymentDone(true);
          push("/user/hangouts/1");
        }}
        className="w-[100%] md:w-[250px] rounded-full mt-6 py-6 mb-8 bg-secondary border-1.5 border-secondary hover:text-[#466A97]"
      >
        Confirm and pay
      </Button>
    </div>
  );
};

export default CirclePayment;
