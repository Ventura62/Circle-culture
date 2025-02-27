import { useState } from "react";
import { Button } from "@/components/ui/button";
import {
  InputOTP,
  InputOTPGroup,
  InputOTPSlot,
  InputOTPSeparator,
} from "@/components/ui/input-otp";
import { useAuthContext } from "@/context/AuthModalContext";
import { useRouter } from "next/router";

const OtpForm = ({
  circleId,
  slotId,
}: {
  circleId?: string;
  slotId?: string;
}) => {
  const router = useRouter();
  const { phoneNumber, countryCode, submitOtp, resendOtp, isLoading } =
    useAuthContext();
  const [otpCode, setOtpCode] = useState("");
  const [canResend, setCanResend] = useState(true);
  const [countdown, setCountdown] = useState(30);

  const handleResendOtp = async () => {
    if (!canResend) return;

    await resendOtp();
    setCanResend(false);
    setCountdown(30);

    const interval = setInterval(() => {
      setCountdown((prev) => {
        if (prev === 1) {
          clearInterval(interval);
          setCanResend(true);
        }
        return prev - 1;
      });
    }, 1000);
  };
  const handleSubmit = async () => {
    const userExists = await submitOtp(otpCode);
    console.log(userExists, "sad");
    if (userExists) {
      if (circleId && slotId) {
        router.push(`/home/${circleId}/${slotId}/payment`);
      } else {
        router.push("/home");
      }
    }
  };
  return (
    <div className="flex place-items-center justify-center mt-[47px]  ">
      <div className="flex flex-col w-[350px] md:w-[500px] border-[0.5px]  border-[#DDDDDD] py-6 bg-primary rounded-lg shadow-lg">
        <div className="border-b-[0.5px] border-[#DDDDDD] pb-6 text-center">
          <p className="font-bold text-[14px] md:text-[16px]">Enter OTP</p>
        </div>

        <div className="mt-6 flex flex-col items-center">
          <h3 className="font-medium mb-[13px] md:text-[22px] text-xl ">
            We've sent an OTP to {countryCode} {phoneNumber}
          </h3>

          <InputOTP
            maxLength={6}
            value={otpCode}
            onChange={(val) => setOtpCode(val)}
            className="mb-4"
          >
            <InputOTPGroup>
              <InputOTPSlot index={0} />
              <InputOTPSlot index={1} />
              <InputOTPSlot index={2} />
            </InputOTPGroup>
            <InputOTPSeparator />
            <InputOTPGroup>
              <InputOTPSlot index={3} />
              <InputOTPSlot index={4} />
              <InputOTPSlot index={5} />
            </InputOTPGroup>
          </InputOTP>
          <div className="flex w-full px-[30px] flex-col align-center">
            <Button
              className=" w-full mt-12 py-[20px] !text-white mb-8 !bg-secondary border-1.5 border-secondary hover:!bg-transparent hover:!text-[#466A97] rounded-full"
              onClick={() => handleSubmit()}
              disabled={otpCode.length < 6 || isLoading}
            >
              {isLoading ? "Verifying..." : "Verify OTP"}
            </Button>

            <Button
              variant="ghost"
              className="underline text-gray-400 "
              onClick={handleResendOtp}
              disabled={!canResend || isLoading}
            >
              {canResend ? "Resend OTP" : `Resend in ${countdown}s`}
            </Button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default OtpForm;
