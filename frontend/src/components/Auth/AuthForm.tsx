import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { useState } from "react";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { useAuthContext } from "@/context/AuthModalContext";

const AuthForm = () => {
  const { openOtpModal } = useAuthContext();
  const [phoneNumber, setPhoneNumber] = useState("");
  const [countryCode, setCountryCode] = useState("");

  const handleContinue = () => {
    if (phoneNumber && countryCode) {
      openOtpModal(phoneNumber, countryCode);
    }
  };

  return (
    <div className="flex place-items-center justify-center mt-[47px]  ">
      <div className="flex flex-col w-[350px] md:w-[500px] border-[0.5px]  border-[#DDDDDD] py-6 bg-primary rounded-lg shadow-lg">
        <div className="border-b-[0.5px] border-[#DDDDDD] pb-6 text-center">
          <p className="font-bold text-[14px] md:text-[16px]">
            Log in or sign up
          </p>
        </div>
        <div className="px-6 mt-4">
          <h3 className="font-medium mb-[13px] md:text-[22px] text-xl mt-8">
            Welcome to 27 Circle
          </h3>

          <div className="rounded-lg !bg-darkGray">
            <Select value={countryCode} onValueChange={setCountryCode}>
              <SelectTrigger className=" border-px border-b-0 py-8 border-[#6A6A6A] rounded-b-none hover:bg-white/10 transition-all duration-200">
                <div className="flex flex-col justify-start">
                  <p className="!text-gray-400">Country code</p>
                  <SelectValue placeholder="" />
                </div>
              </SelectTrigger>
              <SelectContent className="!bg-primary border-white/10">
                <SelectItem
                  value="+1"
                  className="hover:!bg-white/10 focus:!bg-white/10"
                >
                  +1 (USA)
                </SelectItem>
                <SelectItem
                  value="+44"
                  className="hover:!bg-white/10 focus:!bg-white/10"
                >
                  +44 (UK)
                </SelectItem>
                <SelectItem
                  value="+20"
                  className="hover:!bg-white/10 focus:!bg-white/10"
                >
                  +20 (Egypt)
                </SelectItem>
              </SelectContent>
            </Select>
            <Input
              className="border-px py-8 rounded-t-none border-[#6A6A6A]"
              placeholder="Phone number"
              value={phoneNumber}
              onChange={(e) => setPhoneNumber(e.target.value)}
            />
          </div>
          <div className="flex justify-center">
            <Button
              className="w-full self-center mt-12 py-[22px] !text-white mb-8 !bg-secondary border-1.5 border-secondary hover:!bg-transparent hover:!text-[#466A97] rounded-full"
              onClick={handleContinue}
              disabled={!phoneNumber || !countryCode}
            >
              Continue
            </Button>
          </div>
        </div>
      </div>{" "}
    </div>
  );
};

export default AuthForm;
