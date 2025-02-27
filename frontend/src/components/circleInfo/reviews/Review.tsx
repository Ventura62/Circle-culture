import React from "react";
import Image from "next/image";
import TextClamp from "@/components/shared/TextClamp";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faStar } from "@fortawesome/free-solid-svg-icons";
import DefaultProfilePic from "@/assets/images/person-test.png";
import { format } from "date-fns";

type Props = {
  name: string;
  createdAt: string;
  profilePic?: string;
  reviewText?: string;
  rate: number;
  showAllText?: boolean;
};
const Review = ({
  name,
  createdAt,
  profilePic,
  reviewText,
  rate,
  showAllText = false,
}: Props) => {
  return (
    <div>
      <div className="mb-8 md:mb-3 flex-row flex items-center gap-[14px] ">
        <Image
          className="h-[55px] w-[55px] rounded-full"
          src={profilePic || DefaultProfilePic}
          alt={`${name}'s Profile`}
          width={55}
          height={55}
        />
        <div>
          <p className="text-[16px]">{name}</p>
          <span className="flex items-center gap-1 text-yellow-500">
            {/* <FontAwesomeIcon icon={faStar} className="fa-fw" />
            {rate} */}
          </span>
          <p className="text-[14px]">{format(createdAt, "MMMM,y")}</p>
        </div>
      </div>

      <TextClamp
        charLimit={showAllText ? 600 : 200}
        text={reviewText || "No review provided."}
        className="text-[14px] md:text-[16px]"
      />
    </div>
  );
};

export default Review;
