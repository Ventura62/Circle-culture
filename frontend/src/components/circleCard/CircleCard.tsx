import Image from "next/image";
import CircleCardImage from "@/assets/images/circle-image-test.png";
import Link from "next/link";
import { PublicCircle } from "@/models/Circle";
import Rate from "../shared/Rate";
import { useRouter } from "next/router";
import { format } from "date-fns";

const CircleCard = ({ data }: { data: PublicCircle }) => {
  const route = useRouter();
  return (
    <Link
      href={`home/${data.id}`}
      className=" w-[100%] md:w-[315px] block hover:bg-white/10  rounded-md transition-all duration-200"
    >
      <Image
        className=" w-full h-[229px] rounded-xl"
        width={200}
        height={200}
        src={CircleCardImage.src}
        alt="Circle Card Logo"
      />

      <div className="flex flex-col lg:flex-row justify-between mt-[14px] md:mt-[8px]">
        <p
          data-tooltip-content={data.name}
          data-tooltip-id={"standardToolTip"}
          className="
        text-[14px] md:text-lg md:line-clamp-1   "
        >
          {data.name}
        </p>
      </div>
      <p
        data-tooltip-content={`${data.city},${data.country}`}
        data-tooltip-id={"standardToolTip"}
        className="text-[12px] md:text-[16px] md:line-clamp-1   text-textDark"
      >
        {data.city},{data.country}
      </p>
      <p
        data-tooltip-content={`Ages ${data.minAge}-${data.maxAge} • ${data.category}`}
        data-tooltip-id={"standardToolTip"}
        className="text-[11px] md:text-[16px] md:line-clamp-1    text-textDark"
      >
        Ages {data.minAge}-{data.maxAge} • {data.criteria} • {data.category}
      </p>
      <p className="text-[12px] md:text-[16px] !text-textDark">
        {format(data.timeSlots[0].datetime, "MMM. d 'at' h a")}
      </p>
      <hr className="opacity-40  my-[0.5px] bg-textDark" />
      <div className="flex  text-[11px] md:text-lg mt-[2px] justify-between items-center">
        <p className="font-bold text-[12px] md:text-lg">${data.price}</p>
        <div className="justify-self-end ">
          <Rate
            shortReview
            rate={data.rate.stars}
            amount={data.rate.reviewsCount}
            className="text-[12px] md:text-[18px]"
          />
        </div>
      </div>
    </Link>
  );
};

export default CircleCard;
