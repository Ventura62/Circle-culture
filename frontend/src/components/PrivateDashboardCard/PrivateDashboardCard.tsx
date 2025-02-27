import React from "react";
import DashboardStats from "../DashboardStats/DashboardStats";
import FriendCard from "../FriendCard/FriendCard";
import Image from "next/image";
import EmojiFullCircleImage from "../../assets/EmojiFullCircleImage.png";
import VibesScoreCard from "../VibesScoreCard/VibesScoreCard";
import { ScrollArea } from "../ui/scroll-area";
import FullCircleEmojis from "@/assets/images/PrivateDashboard.png";
import Boss from "@/assets/images/boss.png";
import HundredHeart from "@/assets/images/100.png";
import Salute from "@/assets/images/salute.png";
import Monkey from "@/assets/images/Monkey.png";
import Handshake from "@/assets/images/Handshake.png";
import Hundred from "@/assets/images/Hundred.png";

const statsData = [
  { title: "People Met", value: 120 },
  { title: "Joined", value: "Jan 24, 2025" },
  { title: "Circles Joined", value: 27 },
  { title: "Circles Hosted", value: 0 },
];

const friendsData = [
  { name: "Jeremy", location: "Cairo, Egypt", isFavorite: true },
  { name: "Mariam", location: "Giza, Egypt" },
  { name: "John", location: "Alexandria, Egypt" },
  { name: "John", location: "Alexandria, Egypt" },
  { name: "John", location: "Alexandria, Egypt" },
  { name: "John", location: "Alexandria, Egypt" },
  { name: "Jeremy", location: "Cairo, Egypt", isFavorite: true },
  { name: "Mariam", location: "Giza, Egypt" },
  { name: "Nada", location: "Giza, Egypt" },
  { name: "Nada", location: "Giza, Egypt" },

  { name: "Nada", location: "Giza, Egypt" },

  { name: "Nada", location: "Giza, Egypt" },

  { name: "Nada", location: "Giza, Egypt" },
];
const PrivateDashboardCard = () => {
  return (
    <div className="w-full max-w-[1800px] mx-auto px-0 md:px-10 lg:px-20 mb-[120px] ">
      <div className="grid grid-cols-1 gap-y-8 mx-4 md:mx-0 md:grid-cols-3 md:gap-x-[40px] md:gap-y-0 lg:gap-x-[20px]">
        {/* Column1 */}
        <div className="flex flex-col items-center md:h-[680px] h-fit !bg-primary text-white py-8 px-4 rounded-lg text-2xl font-semibold">
          <div className="h-1/3 w-full flex flex-col items-center justify-center text-center pt-5">
            <div className="w-44 h-44 md:h-40 md:w-40 bg-transparent relative border-8 md:border-0 border-white rounded-full flex-shrink-0 mb-4 flex items-center justify-center">
              <Image height={64} width={64} className="absolute md:hidden -left-6 bg-white rounded-full p-1.5 h-10 w-10" src={Monkey.src} alt="Monkey Emoji" />
              <Image height={64} width={64} className="absolute md:hidden left-2 -top-2 bg-white rounded-full p-1.5 h-10 w-10" src={Handshake.src} alt="Handshake Emoji" />
              <Image height={64} width={64} className="absolute md:hidden right-0 top-0 bg-white rounded-full p-1.5 h-10 w-10" src={Hundred.src} alt="Hundred Emoji" />
              <div className="h-28 w-28 md:h-40 md:w-40 rounded-full bg-gray-500 border-[6px] md:border-0 border-white" />
            </div>
            <h2 className="text-2xl font-semibold pb-5 text-center">Jacob Anderson</h2>
            <div className="h-px w-full bg-white/35" />
          </div>

          <div className="md:h-2/3 h-full w-full flex justify-center mt-5">
            <DashboardStats stats={statsData} />
          </div>
        </div>

        {/* Column 2 */}
        <div className="flex flex-col  md:h-[680px] h-fit md:gap-0 gap-4 !bg-primary text-white md:py-8 py-4 rounded-lg text-2xl font-semibold">
          <div className="h-1/3 mb-1.5 text-center md:flex flex-col items-center justify-center  hidden">
            <Image
              className="w-auto rounded-xl object-cover md:h-[calc(100%-16px)] relative bottom-0 h-40"
              width={200}
              height={200}
              src={FullCircleEmojis.src}
              alt="Circle Card Logo"
            />
          </div>

          {/* <div className="flex flex-col gap-2 w-full flex-grow justify-start  px-4 justify-items-center mt-2">
            <VibesScoreCard emoji="😎" title="Overall Score" score={150} />
            <VibesScoreCard emoji="🫶" title="Great Vibes" score={12} />
            <VibesScoreCard emoji="🤝" title="Good Vibes" score={20} />
            <VibesScoreCard emoji="" title="Reliability" score={"86%"} />
          </div> */}
          <div className="flex md:flex-col mt-2 gap-6 w-full flex-wrap flex-row md:flex-nowrap md:flex-grow px-4 justify-start justify-items-center h-fit">
            <VibesScoreCard className="md:w-full w-full" fullWidth emoji={Boss.src} title="Overall Score" score={120} />
            <VibesScoreCard className="md:w-full w-[42%]" emoji={HundredHeart.src} title="Connections" score={12} />
            <VibesScoreCard className="md:w-full w-[42%]" emoji={Salute.src} title="Reliability" score="86%" />
          </div>
        </div>

        {/* Column3 */}

        <div className="flex flex-col justify-center  h-[680px] !bg-primary text-white py-8 pl-6 pr-4 rounded-lg text-2xl font-semibold">
          <h3 className="text-white text-3xl pb-6">Friends</h3>
          <ScrollArea className="pr-3">
            <div className="flex flex-col justify-start">
              <FriendCard friends={friendsData} />
            </div>
          </ScrollArea>
        </div>
      </div>
    </div>
  );
};

export default PrivateDashboardCard;
