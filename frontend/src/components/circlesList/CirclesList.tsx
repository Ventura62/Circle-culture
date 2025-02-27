import React from "react";
import CircleCard from "../circleCard/CircleCard";
import { PublicCircle } from "@/models/Circle";
import { NIL } from "uuid";
import { motion } from "motion/react";

const cardData: PublicCircle = {
  id: NIL,
  name: "Dinner with 27 Circle Hosts",
  rate: {
    stars: 2,
    reviewsCount: 24,
  },
  timeSlots: [
    {
      id: NIL,
      datetime: new Date().toLocaleString(),
    },
  ],
  minAge: 18,
  maxAge: 24,
  price: 12,
  criteria: "male",
  country: "Egypt",
  city: "Cairo",
  category: "Category1",
  featuredReviews: [],
};

const CirclesList = () => {
  return (
    <div className="grid grid-cols-2 md:flex flex-wrap gap-[10px] md:gap-[22px] mx-[17px] justify-center">
      {Array.from({ length: 10 }, () => ({ ...cardData })).map(
        (data, index) => (
          <motion.div
            key={data.id}
            transition={{ type: "spring", delay: 0.1 * index }}
            initial={{ y: 0, opacity: 0 }}
            animate={{ y: [10, 0], opacity: [0.2, 0.5, 1] }}
          >
            <CircleCard key={index} data={data} />
          </motion.div>
        )
      )}
    </div>
  );
};

export default CirclesList;
