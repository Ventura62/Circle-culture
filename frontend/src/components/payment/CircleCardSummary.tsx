import React from "react";
import Image from "next/image";
import { twMerge } from "tailwind-merge";
import Rate from "../shared/Rate";
import { PublicCircle } from "@/models/Circle";

type CardProps = Pick<
  PublicCircle,
  "id" | "name" | "city" | "description" | "image" | "rate" | "price"
> & {
  paymentDone: boolean;
};

const CircleCardSummary = ({
  city,
  description,
  image,
  rate,
  price,
  paymentDone,
}: CardProps) => {
  return (
    <div className="flex flex-col w-[100%] md:w-[450px] gap-4 rounded-lg bg-primary p-6 border border-bright-gray">
      <div className="flex gap-4 py-3 pb-6 items-center border-b border-lightGray">
        <Image
          alt="Circle summary"
          className="w-[104px] h-[98px] rounded-md"
          src={image || "/logo.png"}
          width={80}
          height={90}
        />
        <div className="py-2">
          <p>{city}</p>
          <p className="text-xs">Room in bali</p>

          <Rate
            rate={rate?.stars ?? 0}
            amount={rate?.reviewsCount}
            shortReview
          />
        </div>
      </div>

      <div
        className={twMerge(
          "border-b py-2 hidden border-bright-gray",
          paymentDone && "block"
        )}
      >
        <p className="font-medium text-lg mb-1">Hangout details</p>
        <p>{/* {hangoutDate}, {hangoutTime} */}</p>
      </div>

      <div className={twMerge("py-2 ", paymentDone && "border-b-0")}>
        <p className="font-medium text-lg mb-1">Price details</p>
        <div className="flex justify-between items-center">
          <p>Total</p>
          <p>${price}</p>
        </div>
      </div>
    </div>
  );
};

export default CircleCardSummary;
