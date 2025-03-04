import Link from "next/link";
import DashBoardIcon from "@/assets/images/DashBoardIcon";
import EditAccountIcon from "@/assets/images/EditAccountIcon";
import PublicProfileIcon from "@/assets/images/PublicProfileIcon";
import PayInOutIcon from "@/assets/images/PayInOutIcon";
import ShieldIcon from "@/assets/images/ShieldIcon";
import { CreateCircleIcon } from "@/assets/images/createCircleIcon";

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
    {
        title: "Create a circle",
        route: "/user/create-circle",
        icon: <CreateCircleIcon />,
    },
];

const Account = () => {
    return (
        <div className="flex flex-col items-start w-full px-4 sm:px-6 md:px-10 lg:px-[150px] xlg:px-[350px] flex-1">
            <h2 className="text-5xl font-semibold mb-8">Settings</h2>

            <div className="grid grid-cols-3 gap-6 max-720:grid-cols-2 max-720:gap-4 w-full">
                {tabs.map((tab) => (
                    <Link
                        key={tab.title}
                        href={tab.route}
                        className="max-720:flex-1 w-full min-w-56 max-720:min-w-full max-720:max-w-full block"
                    >
                        <div className="bg-primary p-6 rounded-lg shadow-lg hover:bg-gray-700 transition h-full duration-200 flex items-start justify-between cursor-pointer">
                            <div className="flex flex-col items-start gap-5 justify-between h-full">
                                <div className="flex justify-center items-center w-12 h-12">
                                    {tab.icon}
                                </div>
                                <h3 className="text-xl font-semibold">
                                    {tab.title}
                                </h3>
                            </div>
                        </div>
                    </Link>
                ))}
            </div>
        </div>
    );
};

export default Account;
