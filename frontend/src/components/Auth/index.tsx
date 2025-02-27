import { useAuthContext } from "@/context/AuthModalContext";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import React from "react";
import AuthForm from "./AuthForm";
import OtpForm from "./OtpForm";
import SignupForm from "./SignupForm";
import { useRouter } from "next/router";

const AuthenticationC = ({
  circleId,
  slotId,
}: {
  circleId?: string;
  slotId?: string;
}) => {
  const { isAuthModalOpen, isOtpModalOpen, isSignUpFormOpen } =
    useAuthContext();

  return (
    <>
      {isAuthModalOpen && <AuthForm />}
      {isOtpModalOpen && (
        <OtpForm
          circleId={(circleId as string) ?? undefined}
          slotId={(slotId as string) ?? undefined}
        />
      )}
      {isSignUpFormOpen && <SignupForm />}
    </>
  );
};

export default AuthenticationC;
