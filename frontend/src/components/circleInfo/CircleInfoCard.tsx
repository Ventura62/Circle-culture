import Image from "next/image";
import React, { useState } from "react";
import { CircleInfoCardT } from "@/models/Circle";
import { AvailableSlots } from "./AvailableSlots";
import { motion } from "framer-motion";
import CircleCardImageHuge from "@/assets/images/circle-image-test-huge.png";
import { Button } from "../ui/button";
import { TiTabsOutline } from "react-icons/ti";
import { useRouter } from "next/router";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { IoChevronBack } from "react-icons/io5";
import { faChevronCircleLeft } from "@fortawesome/free-solid-svg-icons";

const CircleInfoCard = ({
  id,
  name,
  city,
  minAge,
  maxAge,
  criteria,
  category,
  description,
  timeSlots,
  image,
}: CircleInfoCardT) => {
  const route = useRouter();
  const [copied, setCopied] = useState(false);

  const copyToClipboard = async () => {
    const currentPath = window.location.href;
    try {
      await navigator.clipboard.writeText(currentPath);
      setCopied(true);
      setTimeout(() => setCopied(false), 2000);
    } catch (err) {
      console.error("Failed to copy: ", err);
    }
  };
  return (
    <div>
      <div className="flex mb-3 justify-between items-center md:mb-2">
        <IoChevronBack
          onClick={() => {
            window.history.back();
          }}
        />
        {copied ? (
          <Button onClick={copyToClipboard}>Copied!</Button>
        ) : (
          <Button
            className="border-[0.5px] bg-[#181818] w-[141px] border-textDark"
            onClick={copyToClipboard}
          >
            Tap to copy link
            <TiTabsOutline />
          </Button>
        )}
      </div>

      <motion.div className="grid grid-cols-1 md:grid-cols-2 gap-8 md:mt-[28px]">
        <div className="flex-1">
          <Image
            width={200}
            height={200}
            className="w-[650px] h-[250px] mt-2 mb-[14px] rounded-lg"
            src={image || CircleCardImageHuge}
            alt="Circle Card Logo"
          />

          <h3 className="text-[22px] md:text-[26px] line-clamp-4 font-medium">
            {name}
          </h3>
          <span className="!text-lightGray text-[16px]">
            {city} • {minAge}-{maxAge} • {criteria} • {category}
          </span>
          <p className="mt-2 text-[14px] md:text-[16px] !text-lightGray">
            {description}
          </p>
        </div>

        <div className="fixed bottom-14 lg:bottom-0 w-full left-0 md:relative md:ml-auto md:w-auto">
          <AvailableSlots timeSlots={timeSlots} circleId={id} />
        </div>
      </motion.div>
    </div>
  );
};

export default CircleInfoCard;
