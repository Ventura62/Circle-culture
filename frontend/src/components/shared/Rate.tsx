import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faStar } from "@fortawesome/free-solid-svg-icons";
import { cn } from "@/lib/utils";
type Props = {
  rate: number;
  amount?: number;
  className?: string;
  shortReview?: boolean;
};

const Rate = (props: Props) => {
  return (
    <span className={cn(`text-sm`, props?.className)}>
      <FontAwesomeIcon icon={faStar} className="fa-fw" size="xs" /> {props.rate}{" "}
      {props.amount && (
        <>
          ({props.amount}) {!props.shortReview && "Reviews"}
        </>
      )}
    </span>
  );
};

export default Rate;
