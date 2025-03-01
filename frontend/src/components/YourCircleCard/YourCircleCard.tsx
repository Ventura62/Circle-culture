import Image from "next/image";
import Link from "next/link";
import { FaStar } from "react-icons/fa";
import CoverImage from "@/assets/images/circle-image-test-huge.png";
import { CircleCardGeneralInfo } from "@/models/Circle";
import { useRouter } from "next/router";
import { format } from "date-fns";
import { formatStatusToColors } from "@/utils/Formatters";
//No hardcoded , only image
const YourCircleCard = ({
    circleData,
    type,
}: {
    circleData: CircleCardGeneralInfo;
    type: "hosted" | "member";
}) => {
    const route = useRouter();
    return (
        <Link
            href={`${route.pathname}/${circleData.id}`}
            className="flex items-center justify-between max-592:flex-col-reverse max-592:gap-4 max-780:mx-auto max-780:gap-2 max-780:w-full rounded-md bg-primary text-white py-3.5 px-1 gap-1 hover:bg-white/10 transition-all duration-200"
        >
            <div className="flex flex-1  flex-col max-780:min-w-[auto] max-592:w-full max-w-[600px] ">
                <div className="relative overflow-hidden w-full rounded-md mb-4 mx-8 max-780:mx-4">
                    <p
                        className={`${formatStatusToColors(
                            circleData.status
                        )} rounded-md w-fit max-592:text-xs text-sm p-1.5 border-1.5 border-white border-opacity-30 relative after:content-[''] after:absolute after:-left-[1.5px] after:-top-[1.5px] after:h-[calc(100%+3px)] after:w-1.5`}
                    >
                        <span className="ml-1">{circleData.status}</span>
                    </p>
                </div>

                {/* Name, Rate And Price*/}
                <div className="flex items-center justify-start gap-2 max-592:text-lg text-xl px-8 max-780:px-4 max-780:justify-between">
                    <span>
                        {circleData.name}{" "}
                        <span className="font-bold max-780:hidden">·</span>
                    </span>

                    {type === "hosted" && (
                        <div className="flex items-center justify-between gap-1">
                            <FaStar className="relative bottom-px" />
                            <p>
                                {circleData.rate.stars} (
                                {circleData.rate.reviewsCount})
                            </p>
                        </div>
                    )}
                    <span className="font-bold max-780:hidden">
                        · ${circleData.price}
                    </span>
                </div>

                {/* City, Age , Criteria , dateTime*/}
                <div className="flex flex-col items-start opacity-70 mb-4 px-8 max-780:px-4">
                    <p className="flex items-center gap-0 max-592:w-full max-780:flex-wrap max-780:justify-between">
                        <span className="max-592:flex-[1_1_100%] max-592:text-start max-780:flex-[1_1_48%]">
                            {circleData.city}
                        </span>
                        <span className="max-592:text-start max-780:flex-[1_1_48%] max-780:text-right whitespace-nowrap">
                            <span className="font-bold max-780:hidden">·</span>{" "}
                            Ages {`${circleData.minAge} - ${circleData.maxAge}`}
                        </span>
                        <span className="max-592:text-start max-780:flex-[1_1_30%]">
                            <span className="font-bold max-592:inline max-780:hidden">
                                ·
                            </span>{" "}
                            {circleData.criteria}
                        </span>
                        <span className="max-592:flex-[1_1_100%] max-592:text-start max-780:flex-[1_1_48%] max-780:text-right">
                            <span className="font-bold max-780:hidden">·</span>{" "}
                            {circleData.category}
                        </span>
                    </p>
                </div>
                <div className="border-t border-gray-500 max-w-[600px] mx-4 md:mx-8 "></div>
                {type == "hosted" && (
                    <div className="flex items-center justify-between gap-6 pt-6 border-white border-opacity-30 px-8">
                        <div className="flex gap-4">
                            <Link
                                href={`/user/dashboard/${circleData.id}/statistics`}
                                className="underline hover:opacity-70 transition-all duration-200"
                            >
                                Dashboard
                            </Link>
                            <Link
                                href={`/user/dashboard/${circleData.id}`}
                                className="underline hover:opacity-70 transition-all duration-200"
                            >
                                Edit
                            </Link>
                        </div>

                        <div>
                            <p className="text-textDark">
                                Upcoming event:{" "}
                                {format(
                                    circleData.dateTime,
                                    "MMMM do, yyyy 'at' hh:mm a"
                                )}
                            </p>
                        </div>
                    </div>
                )}
            </div>

            <div className="relative flex justify-end items-center bg-gray-500 h-44 max-592:h-44 overflow-hidden mr-5 rounded-lg max-780:mr-0 ">
                <Image
                    className="h-full w-full object-cover"
                    height={450}
                    width={450}
                    src={CoverImage.src}
                    alt="Circle Cover Image"
                />
            </div>
        </Link>
    );
};

export default YourCircleCard;
