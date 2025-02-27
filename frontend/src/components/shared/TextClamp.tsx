import { useState } from "react";
import { twMerge } from "tailwind-merge";

const TextClamp = ({
  text,
  charLimit = 50,
  seeMoreText = "Read more",
  seeLessText = "Read less",
  hideSeeMore,
  className,
}: {
  text: string;
  charLimit?: number;
  seeMoreText?: string;
  hideSeeMore?: boolean;
  className?: string;
  seeLessText?: string;
}) => {
  const [canSeeMore, setCanSeeMore] = useState(false);
  const isTextLong = text.length > charLimit;

  const truncatedText = isTextLong ? text.slice(0, charLimit) + "..." : text;

  function toggleCanSeeMore() {
    setCanSeeMore((prev) => !prev);
  }

  return (
    <div style={{ maxWidth: `${charLimit}ch`, overflow: "hidden" }}>
      <span
        data-tooltip-content={text}
        data-tooltip-id={hideSeeMore && isTextLong ? "standardToolTip" : ""}
        onClick={toggleCanSeeMore}
        className={twMerge(className)}
      >
        {canSeeMore ? text : truncatedText}
      </span>
      {isTextLong && !hideSeeMore && !canSeeMore && <span className="   underline  cursor-pointer ">{seeMoreText}</span>}
      {canSeeMore && (
        <p onClick={toggleCanSeeMore} className="text-2xs cursor-pointer  underline ">
          {seeLessText}
        </p>
      )}
    </div>
  );
};

export default TextClamp;
