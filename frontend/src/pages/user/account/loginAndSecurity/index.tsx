import LoginAndSecurityCard from "@/components/LoginSecurityCard/LoginSecurityCard";
import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import { useRouter } from "next/navigation";
import React from "react";

const LoginAndSecurity = () => {
  return (
    <div className="md:px-14  lg:px-24 pb-14">
      <AccountSubHeader title="Login & Security" enableBackPress />
      <div className="flex pe-[10px]">
        <LoginAndSecurityCard />
      </div>
    </div>
  );
};

export default LoginAndSecurity;
