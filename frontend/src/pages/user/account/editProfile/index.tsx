import EditProfileCard from "@/components/EditProfileCard/EditProfileCard";
import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import { useRouter } from "next/navigation";
import React from "react";

const EditProfile = () => {
  return (
    <div className="md:px-14  lg:px-24 pb-14">
      <AccountSubHeader title="Edit Profile" enableBackPress />
      <EditProfileCard />
    </div>
  );
};

export default EditProfile;
