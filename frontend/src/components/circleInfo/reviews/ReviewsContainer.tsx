import React, { useState } from "react";
import Review from "./Review";
import ReviewsModal from "./ReviewsModal";
import { CircleReviewT } from "@/models/Circle";
const ReviewsContainer = ({
  featuredReviews,
  stars,
  reviewCount,
}: {
  featuredReviews?: CircleReviewT[];
  stars?: number;
  reviewCount?: number;
}) => {
  return (
    <div className=" pt-8 pb-24">
      <div
        className={`${
          featuredReviews && featuredReviews?.length
            ? "grid-cols-1 xl:grid-cols-2"
            : "grid-cols-1"
        } grid gap-[42px] md:gap-[64px] gap-x-32`}
      >
        {featuredReviews && featuredReviews?.length > 0 ? (
          featuredReviews?.slice(0, 6).map((review: CircleReviewT) => {
            return (
              <Review
                name={review.name}
                createdAt={review.createdAt}
                reviewText={review.description}
                rate={review.rate}
              />
            );
          })
        ) : (
          <p className="text-center w-full text-white/50">
            There are currently no available reviews at the moment.
          </p>
        )}

        {featuredReviews && featuredReviews?.length > 6 && (
          <div className=" col-start-1">
            <ReviewsModal
              featuredReviews={featuredReviews}
              stars={stars}
              reviewCount={reviewCount}
            />
          </div>
        )}
      </div>
    </div>
  );
};

export default ReviewsContainer;
