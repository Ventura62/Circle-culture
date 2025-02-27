import Image from "next/image";
import React from "react";

interface VibesScoreCardProps {
  className?: string;
  emoji: string;
  title: string;
  score: number | string;
  fullWidth?: boolean;
}

const VibesScoreCard = ({ className = "", emoji, title, score, fullWidth = false }: VibesScoreCardProps) => {
  return (
    <div
      className={`${className} flex private-dash:flex-col min-w-36 md:items-center ${ fullWidth ? "items-center min-h-[4.5rem] md:min-h-[auto]": "md:flex-nowrap flex-wrap items-start" } md:justify-center justify-between h-fit max-940:gap-0 gap-4 bg-background text-white rounded-lg py-2 px-4 
    w-full border border-gray-600 flex-grow`}
    >
      {/* <span className="text-3xl md:block hidden">{emoji}</span> */}
      <Image className={`text-3xl md:block md:h-10 h-5 relative w-auto ${ fullWidth ? "": "md:top-0 top-0.5 md:order-1 order-2" }`} height={40} width={40} src={emoji} alt={`${title} Emoji`} />
      <span className={`font-medium md:w-auto flex-1 ml-2 ${ fullWidth ? "flex-1": "md:order-2 order-3 md:text-lg text-base" }`}>{title}</span>
      <span className={`md:text-2xl md:font-normal text-2xl font-semibold ${ fullWidth ? "": "md:w-auto w-full md:order-3 order-1" }`}>{score}</span>
    </div>
  );
};

export default VibesScoreCard;
