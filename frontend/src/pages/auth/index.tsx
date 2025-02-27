import AuthenticationC from "@/components/Auth";
import { useRouter } from "next/router";
import React from "react";

const HandleAuth = () => {
  const router = useRouter();
  const { circleId, slotId } = router.query;
  return (
    <AuthenticationC
      circleId={(circleId as string) ?? undefined}
      slotId={(slotId as string) ?? undefined}
    />
  );
};

export default HandleAuth;
