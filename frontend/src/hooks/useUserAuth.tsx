import { axiosPrivateInstance } from "@/config/axiosConfig";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import { useState } from "react";
export type useAuthType = {
  isAuthModalOpen: boolean;
  isOtpModalOpen: boolean;
  phoneNumber: string;
  countryCode: string;
  openAuthModal: () => void;
  closeAuthModal: () => void;
  openOtpModal: (phone: string, code: string) => void;
  closeOtpModal: () => void;
  submitOtp: (otp: string) => Promise<boolean>;
  isLoading: boolean;
  resendOtp: () => void;
  isSignUpFormOpen: boolean;
};
export const useUserAuth = (): useAuthType => {
  const [isAuthModalOpen, setIsAuthModalOpen] = useState(true);
  const [isOtpModalOpen, setIsOtpModalOpen] = useState(false);
  const [phoneNumber, setPhoneNumber] = useState("");
  const [countryCode, setCountryCode] = useState("");
  const [userExists, setUserExists] = useState(true);
  const [isLoading, setIsLoading] = useState(false);
  const { userActions } = useLocalUserContext();
  const { login } = userActions;
  const openAuthModal = () => setIsAuthModalOpen(true);
  const closeAuthModal = () => setIsAuthModalOpen(false);
  const [isSignUpFormOpen, setIsSignUpFormOpen] = useState(false);
  const openOtpModal = async (phone: string, code: string) => {
    setPhoneNumber(phone);
    setCountryCode(code);
    setIsLoading(true);

    try {
      // await requestOtp(phone, code);
      setIsAuthModalOpen(false);
      setIsOtpModalOpen(true);
      closeAuthModal();
    } catch (error) {
      console.error("Failed to request OTP:", error);
    } finally {
      setIsLoading(false);
    }
  };

  const closeOtpModal = () => {
    setIsOtpModalOpen(false);
  };

  const submitOtp = async (otp: string): Promise<boolean> => {
    setIsLoading(true);

    try {
      // const isValid = await verifyOtp(phoneNumber, countryCode, otp);
      // if (!isValid) {
      //   throw new Error("Invalid OTP. Please try again.");
      // }

      const userExists = false;
      // userExists = await checkUserExists(phoneNumber);

      closeOtpModal();

      if (!userExists) {
        setIsSignUpFormOpen(true);
      } else {
        login();
      }
      console.log("here", userExists);
      return userExists;
    } catch (error) {
      console.error("Failed to verify OTP:", error);
      return false;
    } finally {
      setIsLoading(false);
    }
  };

  const requestOtp = async (phone: string, countryCode: string) => {
    return axiosPrivateInstance
      .post("/auth/request-otp", { phone, countryCode })
      .then((response) => {
        const data = response.data;
        if (!data.okay) {
          return Promise.reject(new Error(data.message));
        }
        return true;
      })
      .catch((err) => {
        return Promise.reject(
          err.message || "An error occurred while requesting OTP."
        );
      });
  };
  const verifyOtp = async (phone: string, countryCode: string, otp: string) => {
    return axiosPrivateInstance
      .post("/auth/verify-otp", { phone, countryCode, otp })
      .then((response) => {
        const data = response.data;
        if (!data.okay) {
          return Promise.reject(new Error(data.message));
        }
        return true;
      })
      .catch((err) => {
        return Promise.reject(
          err.message || "An error occurred while verifying OTP."
        );
      });
  };
  const checkUserExists = async (phone: string) => {
    return axiosPrivateInstance
      .post("/user/check-existence", { phone })
      .then((response) => {
        const data = response.data;
        if (!data.okay) {
          return Promise.reject(new Error(data.message));
        }
        return data.exists;
      })
      .catch((err) => {
        return Promise.reject(
          err.message || "An error occurred while checking user existence."
        );
      });
  };
  const resendOtp = async () => {
    if (!phoneNumber || !countryCode) {
      console.error(
        "Phone number and country code are required to resend OTP."
      );
      return;
    }

    setIsLoading(true);
    try {
      await axiosPrivateInstance.post("/auth/resend-otp", {
        phone: phoneNumber,
        countryCode,
      });

      console.log("OTP Resent Successfully!");
    } catch (error) {
      console.error("Failed to resend OTP:", error);
    } finally {
      setIsLoading(false);
    }
  };

  return {
    isAuthModalOpen,
    isOtpModalOpen,
    isLoading,
    phoneNumber,
    countryCode,
    openAuthModal,
    closeAuthModal,
    openOtpModal,
    closeOtpModal,
    submitOtp,
    resendOtp,
    isSignUpFormOpen,
  };
};
