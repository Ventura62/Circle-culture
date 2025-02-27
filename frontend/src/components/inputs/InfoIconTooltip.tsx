import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { IconDefinition, faInfoCircle } from "@fortawesome/free-solid-svg-icons";
import { JSX } from "react";

type tooltipPosition =
  | "top"
  | "top-start"
  | "top-end"
  | "right"
  | "right-start"
  | "right-end"
  | "bottom"
  | "bottom-start"
  | "bottom-end"
  | "left"
  | "left-start"
  | "left-end";

export function InfoIconTooltip({
  content,
  position = "right",
  className = "",
  icon = faInfoCircle,
}: {
  content: string;
  position?: tooltipPosition;
  className?: string;
  icon?: IconDefinition;
}): JSX.Element {
  return (
    <>
      <FontAwesomeIcon
        data-tooltip-place={position}
        data-tooltip-content={content}
        data-tooltip-id={"standardToolTip"}
        className={` ${className} cursor-pointer`}
        icon={icon}
      />
    </>
  );
}
