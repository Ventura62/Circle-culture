import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import { useRouter } from "next/router";
import { ReactNode, useEffect, useState } from "react";

interface ProtectedRouteProps {
  children: ReactNode;
}

export const ProtectedRouteWrapper = ({ children }: ProtectedRouteProps) => {
  const router = useRouter();
  const { user, userIsLoading } = useLocalUserContext();

  const [canAccess, setCanAccess] = useState(false);

  const firstSegment = router.pathname.split("/").filter(Boolean)[0];

  const handleAccess = () => {
    return canAccessHandler({
      userAccessLevel: user.accessLevel,
      routeHeader: firstSegment,
      fullRoute: router.pathname,
    });
  };

  useEffect(() => {
    if (!userIsLoading) {
      const checkAccess = handleAccess();
      if (!checkAccess) {
        if (user.accessLevel === "Guest") {
          console.log("routing to auth");
          router.replace("/auth");
        }
        if (user.accessLevel === "UNVERIFIED_USER") {
          console.log("routing to unverified user");

          router.replace("/unverified/profilePending");
        }
      } else {
        setCanAccess(true);
      }
    }
  }, [user.accessLevel, userIsLoading]);

  if (userIsLoading) {
    console.log("returning spinner");

    return <LoadingSpinner />;
  }

  if (!canAccess) {
    console.log("returning null");

    return null;
  }
  return <>{children}</>;
};

import { UserAccessLevel } from "@/models/User";
import LoadingSpinner from "../shared/LoadingSpinner";

type routeType = {
  routeHeader: "home" | "auth" | "user" | "unverified";
  type: "GUEST" | "PUBLIC" | "USER" | "UNVERIFIED_USER";
};

const clientRoutes: routeType[] = [
  {
    routeHeader: "home",
    type: "PUBLIC",
  },
  {
    routeHeader: "auth",
    type: "GUEST",
  },
  {
    routeHeader: "user",
    type: "USER",
  },
  {
    routeHeader: "unverified",
    type: "UNVERIFIED_USER",
  },
];

const canAccessHandler = ({
  userAccessLevel,
  routeHeader,
  fullRoute,
}: {
  userAccessLevel: UserAccessLevel;
  routeHeader: string;
  fullRoute: string;
}) => {
  const currentRoute = clientRoutes.find((route) => {
    return route?.routeHeader?.toLowerCase() == routeHeader?.toLowerCase();
  });
  console.log(
    currentRoute,
    "aaaaaaaaaaaaa",
    fullRoute.split("/")[fullRoute.split("/").length - 1],
    fullRoute.split("/")[fullRoute.split("/").length - 1] === "payment"
  );
  if (!currentRoute) {
    return false;
  }

  if (currentRoute.type == "PUBLIC" && userAccessLevel !== "User") {
    console.log("here with", fullRoute.split("/")[fullRoute.split("/").length - 1] === "payment", userAccessLevel);
    if (fullRoute.split("/")[fullRoute.split("/").length - 1] === "payment") return false;
  }
  if (currentRoute.type == "GUEST" && userAccessLevel !== "Guest") {
    return false;
  }

  if (currentRoute.type == "USER" && userAccessLevel == "Guest") {
    return false;
  }
  if (currentRoute.type == "USER" && userAccessLevel == "UNVERIFIED_USER") {
    if (!fullRoute.includes("user/account")) return false;
  }
  return true;
};
