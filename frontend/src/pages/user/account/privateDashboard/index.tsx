import PrivateDashboardCard from "@/components/PrivateDashboardCard/PrivateDashboardCard";
import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import { useRouter } from "next/navigation";
import React from "react";

const PrivateDashboard = () => {
  const router = useRouter();
  const handleBack = () => {
    router.back();
  };
  return (
    <div>
      <AccountSubHeader title="Private Dashboard" enableBackPress subtitle="Many forget to provide feedback, which skews the dashboard results." />
      <PrivateDashboardCard />
    </div>
  );
};

export default PrivateDashboard;
