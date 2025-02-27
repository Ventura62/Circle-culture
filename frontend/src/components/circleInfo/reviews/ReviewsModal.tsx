import React from "react";
import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faStar } from "@fortawesome/free-solid-svg-icons";
import Review from "./Review";
import { CircleReviewT } from "@/models/Circle";

const ReviewsModal = ({
  featuredReviews,
  stars,
  reviewCount,
}: {
  featuredReviews?: CircleReviewT[];
  stars?: number;
  reviewCount?: number;
}) => {
  return (
    <Dialog>
      <DialogTrigger asChild>
        <Button
          className="border-white border-2 py-6 rounded-full      w-60 bg-transparent  text-white"
          variant="outline"
        >
          Show all {featuredReviews?.length} reviews
        </Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[40vw] bg-background">
        <DialogHeader>
          <DialogTitle>
            <p className=" mb-2 font-medium text-xl">
              <span>
                <FontAwesomeIcon icon={faStar} className="fa-fw" />
                {stars ?? 0} ·
              </span>
              {reviewCount ?? 0} reviews
            </p>
          </DialogTitle>
        </DialogHeader>
        <div>
          <div className="flex h-[70vh] scroll-1 overflow-y-auto flex-col gap-16">
            {featuredReviews?.slice(0, 6).map((review: CircleReviewT) => {
              return (
                <Review
                  name={review.name}
                  createdAt={review.createdAt}
                  reviewText={review.description}
                  rate={review.rate}
                />
              );
            })}
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
};

export default ReviewsModal;
