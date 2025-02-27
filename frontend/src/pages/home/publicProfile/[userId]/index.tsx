import PublicProfileCard from "@/components/PublicProfileCard/PublicProfileCard";
import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import { useRouter } from "next/navigation";
import React from "react";

const PublicProfile = () => {
  return (
    <div>
      <AccountSubHeader title="Public Profile" enableBackPress />
      <div className="mx-[15px]">
        <PublicProfileCard />
      </div>
    </div>
  );
};

export default PublicProfile;
