import Image from "next/image";
import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import Salute from "@/assets/images/salute.png";
import Heart from "@/assets/images/Heart.png";
import Hundred from "@/assets/images/Hundred.png";
import {
    RiLinkedinBoxLine,
    RiInstagramLine,
    RiPhoneLine,
} from "react-icons/ri";
import { IoMailOutline } from "react-icons/io5";

const userData = {
    fullName: "Jacob Anderson",
    location: "Cairo, Egypt",
    bio: "Engineer; Besties with Elon; Excited to see you all at the next Circle!",
    triosJoined: 1,
    friends: "2/15",
    socialMedia: {
        linkedin: "JacobAnderson",
        instagram: "JacobAnderson",
    },
    phone: "+1 650 727 0793",
    email: "JacobAnderson@gmail.com",
};

const PublicProfile = () => {
    return (
        <div>
            <AccountSubHeader title="Public Profile" enableBackPress />
            <div className="mx-auto !max-w-[800px] px-6 md:px-10 max-878:ms-0 mt-10 mb-[100px]">
                <div className="bg-primary rounded-lg border-1.5 border-white/35 py-12 px-24 max-656:px-10 flex flex-col gap-4">
                    <div className="flex items-center gap-6 max-656:flex-col max-656:gap-0">
                        <div className="w-44 h-44 bg-transparent relative border-8 border-white rounded-full flex-shrink-0 mb-4 flex items-center justify-center">
                            <Image
                                height={64}
                                width={64}
                                className="absolute -left-6 bg-white rounded-full p-1.5 h-10 w-10"
                                src={Salute.src}
                                alt="Monkey Emoji"
                            />
                            <Image
                                height={64}
                                width={64}
                                className="absolute left-2 -top-2 bg-white rounded-full p-1.5 h-10 w-10"
                                src={Heart.src}
                                alt="Handshake Emoji"
                            />
                            <Image
                                height={64}
                                width={64}
                                className="absolute right-0 top-0 bg-white rounded-full p-1.5 h-10 w-10"
                                src={Hundred.src}
                                alt="Hundred Emoji"
                            />
                            <div className="h-28 w-28 rounded-full bg-gray-500 border-2 border-white" />
                        </div>
                        <div className="max-656:text-center">
                            <h1 className="text-3xl">{userData.fullName}</h1>
                            <div className="flex items-center max-656:justify-center gap-2">
                                <p>{userData.location}</p>
                            </div>
                            <p>{userData.bio}</p>
                        </div>
                    </div>

                    <div className="flex items-stretch justify-center gap-4">
                        <div className="w-[46%] min-w-40 flex items-center justify-center gap-4 bg-background border-1.5 border-white/35 rounded-md p-3">
                            <Image
                                height={64}
                                width={64}
                                className="h-16 w-16 max-592:h-10 max-592:w-10"
                                src={Heart.src}
                                alt="Handshake Emoji"
                            />
                            <div>
                                <h1>Friends</h1>
                                <p className="font-bold text-xl text-center">
                                    {userData.friends}
                                </p>
                            </div>
                        </div>
                        <div className="w-[46%] min-w-40 flex items-center justify-center gap-4 bg-background border-1.5 border-white/35 rounded-md p-3">
                            <Image
                                height={64}
                                width={64}
                                className="h-16 w-16 max-592:h-10 max-592:w-10"
                                src={Heart.src}
                                alt="Handshake Emoji"
                            />
                            <div>
                                <h1>Trios Joined</h1>
                                <p className="font-bold text-xl text-center">
                                    {userData.triosJoined}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="flex flex-col divide-y-1.5 divide-white/30 mt-4 px-4">
                    <div className="text-lg flex items-center justify-start gap-2 py-1">
                        <RiLinkedinBoxLine size={24} />
                        <p>{userData.socialMedia.linkedin}</p>
                    </div>
                    <div className="text-lg flex items-center justify-start gap-2 py-1">
                        <RiInstagramLine size={24} />
                        <p>{userData.socialMedia.instagram}</p>
                    </div>
                    <div className="text-lg flex items-center justify-start gap-2 py-1">
                        <RiPhoneLine size={24} />
                        <p>{userData.email}</p>
                    </div>
                    <div className="text-lg flex items-center justify-start gap-2 py-1">
                        <IoMailOutline size={24} />
                        <p>{userData.phone}</p>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default PublicProfile;
