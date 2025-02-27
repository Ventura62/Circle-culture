import Image from "next/image";
import Dropdown from "./Dropdown/Dropdown";
import Link from "next/link";
import { motion } from "framer-motion";
import NotificationDropdown from "./NotificationDropdown/NotificationDropdown";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import GuestDropDown from "./GuestDropDown/GuestDropDown";
import { User } from "@/models/User";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faBell, faCircle, faUser } from "@fortawesome/free-regular-svg-icons";
import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
import { useRouter } from "next/router";
import { cn } from "@/lib/utils";

const Navbar = () => {
  const { user, isLoggedIn } = useLocalUserContext();
  console.log(user, isLoggedIn);
  return (
    <div>
      <div className="md:flex hidden h-12 px-8 pt-12 pb-8  items-center justify-between mb-8 overflow-hidden">
        <Link href="/home" className="flex-1">
          <Image className="h-auto w-10" width={48} height={48} src="/logo.png" alt="72 Circle Logo" />
        </Link>

        <div className="flex-1 flex items-center justify-end gap-3.5">
          {user && <NotificationDropdown />}
          {isLoggedIn ? <Dropdown /> : <GuestDropDown />}
        </div>
      </div>
      <div className="md:hidden">
        <MobileNavbar user={user} />
      </div>
    </div>
  );
};
const MobileNavbar = ({ user }: { user: User }) => {
  const route = useRouter();
  const navRoutes = [
    {
      url: "/home",
      name: "Explore",
      icon: faMagnifyingGlass,
    },
    {
      url: "/user/hangouts",
      name: "Circle",
      icon: faCircle,
    },
    {
      url: "/user/notifications",
      name: "Notifications",
      icon: faBell,
    },
    {
      url: "/user/account",
      name: "Profile",
      icon: faUser,
    },
  ];
  return (
    <motion.div
      initial={{ y: 100, opacity: 0 }}
      animate={{ y: 0, opacity: 1 }}
      transition={{ duration: 0.4, ease: "easeOut" }}
      className=" fixed bottom-0 rounded-t-lg  z-50   bg-primary drop-shadow-lg w-[100vw] items-center h-16 flex justify-evenly"
    >
      {navRoutes.map((routeData) => {
        return (
          <Link
            href={routeData.url}
            className={cn("flex  justify-center gap-1 flex-col items-center w-[80px] opacity-100", {
              "opacity-60": routeData.url !== route.pathname,
            })}
          >
            <FontAwesomeIcon icon={routeData.icon} />
            <p>{routeData.name}</p>
          </Link>
        );
      })}
    </motion.div>
  );
};

export default Navbar;
