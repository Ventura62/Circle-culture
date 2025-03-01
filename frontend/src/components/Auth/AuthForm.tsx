import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { FcGoogle } from "react-icons/fc";
import { useState } from "react";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { useAuthContext } from "@/context/AuthModalContext";

const AuthForm = () => {
    const { openOtpModal, openSignUpForm } = useAuthContext();
    const [phoneNumber, setPhoneNumber] = useState("");
    const [countryCode, setCountryCode] = useState("");

    const handleContinue = () => {
        if (phoneNumber && countryCode) {
            openOtpModal(phoneNumber, countryCode);
        }
    };

    const handleSignUp = () => {
        openSignUpForm();
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
                        <Select
                            value={countryCode}
                            onValueChange={setCountryCode}
                        >
                            <SelectTrigger className=" border-px border-b-0 py-8 border-[#6A6A6A] rounded-b-none hover:bg-white/10 transition-all duration-200">
                                <div className="flex flex-col justify-start">
                                    <p className="!text-gray-400">
                                        Country code
                                    </p>
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
                <div className="flex items-center w-full px-6">
                    <hr className="flex-grow border-t" />
                    <span className="mx-4 text-gray-300">or</span>
                    <hr className="flex-grow border-t" />
                </div>
                <div className="flex justify-center px-6">
                    <Button className="w-full self-center mt-4 py-[22px] !text-white mb-8 !bg-white/5 border-1.5 border-white/5 hover:!bg-transparent hover:!text-[#466A97] rounded-full">
                        <FcGoogle /> Continue with Google
                    </Button>
                </div>
                <div className="text-center">
                    <p>
                        Don&apos;t have an account?{" "}
                        <span
                            onClick={handleSignUp}
                            className="underline text-blue-500 hover:text-blue-600 transition duration-300 cursor-pointer"
                        >
                            Sign Up
                        </span>
                    </p>
                </div>
            </div>{" "}
        </div>
    );
};

export default AuthForm;
