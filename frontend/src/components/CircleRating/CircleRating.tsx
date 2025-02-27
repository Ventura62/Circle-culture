import RateIcon from "@/assets/images/RateIcon";
import React, { useState } from "react";
import { FaStar } from "react-icons/fa";

const CircleRating = ({
  rating,
  handleRating,
  handleNext,
  disabled,
  handleNotAttending,
}: {
  rating: number;
  handleRating: (rating: number) => void;
  handleNext: () => void;
  disabled: boolean;
  handleNotAttending: () => void;
}) => {
  const [hover, setHover] = useState<number | null>(null);

  return (
    <div className="text-center items-center mx-4 pb-4">
      <h2 className="text-xl md:text-[24px] font-semibold">
        Overall, how would you rate the Circle?
      </h2>
      <p className="text-[18px] text-textDark mb-6">
        California vibes & photoshoot
      </p>

      <div
        onMouseLeave={() => setHover(null)}
        className="flex justify-center mb-6"
      >
        {[...Array(5)].map((_, index) => (
          <button
            key={index}
            onClick={() => handleRating(index + 1)}
            className="w-12 h-12 rounded-full transition-colors duration-200"
            style={{ padding: 0, margin: "-5px", border: "none" }}
          >
            <FaStar
              onClick={() => handleRating(index + 1)}
              onMouseOver={() => setHover(index + 1)}
              size={32}
              className={`${
                index + 1 <= (hover || rating)
                  ? "fill-yellow-500"
                  : "fill-[#494949]"
              } cursor-pointer transition-all duration-200`}
            />
          </button>
        ))}
      </div>

      <span
        className="text-xl font-medium text-white hover:text-white/60 underline cursor-pointer"
        onClick={handleNotAttending}
      >
        I couldn’t attend
      </span>

      <div className="flex justify-center mt-10">
        <button
          type="button"
          onClick={handleNext}
          disabled={disabled}
          className={`mt-20 py-2.5 px-12 rounded-full border-2 transition-all duration-200
    ${
      disabled
        ? "bg-gray-400 border-gray-400 cursor-not-allowed"
        : "bg-secondary border-secondary hover:bg-primary hover:text-white"
    }`}
        >
          Next
        </button>
      </div>
    </div>
  );
};

export default CircleRating;
