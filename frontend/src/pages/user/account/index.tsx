import Link from "next/link";
import DashBoardIcon from "@/assets/images/DashBoardIcon";
import EditAccountIcon from "@/assets/images/EditAccountIcon";
import PublicProfileIcon from "@/assets/images/PublicProfileIcon";
import PayInOutIcon from "@/assets/images/PayInOutIcon";
import ShieldIcon from "@/assets/images/ShieldIcon";

const tabs = [
  {
    title: "Personal Dashboard",
    route: "/user/account/privateDashboard",
    icon: <DashBoardIcon />,
  },
  {
    title: "Public Profile",
    route: "/user/account/publicProfile",
    icon: <PublicProfileIcon />,
  },
  {
    title: "Payments & Payouts",
    route: "/user/account/accountPaymentsInfo",
    icon: <PayInOutIcon />,
  },
  {
    title: "Login & Security",
    route: "/user/account/loginAndSecurity",
    icon: <ShieldIcon />,
  },
  {
    title: "Edit Profile",
    route: "/user/account/editProfile",
    icon: <EditAccountIcon />,
  },
];

const Account = () => {
  return (
    <div className="flex flex-col items-start w-full px-4 sm:px-6 md:px-10 lg:px-[150px] xlg:px-[350px] flex-1">
      <h2 className="text-5xl font-semibold mb-8">Account</h2>

      <div className="flex flex-row gap-4 flex-wrap">
        {tabs.map((tab) => (
          <Link key={tab.title} href={tab.route} className="max-720:flex-1 max-w-96 min-w-80 max-720:min-w-full max-720:max-w-full">
            <div className="bg-primary p-6 rounded-lg shadow-lg hover:bg-gray-700 transition duration-200 flex items-start justify-between cursor-pointer">
              <div className="flex flex-col items-start gap-5">
                <div className="flex justify-center items-center w-12 h-12 ">{tab.icon}</div>
                <h3 className="text-xl font-semibold">{tab.title}</h3>
              </div>
            </div>
          </Link>
        ))}
      </div>
    </div>
  );
};

export default Account;
