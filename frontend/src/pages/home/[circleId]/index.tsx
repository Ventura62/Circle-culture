import CircleInfoCard from "@/components/circleInfo/CircleInfoCard";
import ReviewsContainer from "@/components/circleInfo/reviews/ReviewsContainer";
import Rate from "@/components/shared/Rate";
import Image from "next/image";
import { useRouter } from "next/router";
import { useGetCircleById } from "@/hooks/useGetCircleById";
import LoadingSpinner from "@/components/shared/LoadingSpinner";
export default function CircleInfo() {
  const router = useRouter();
  const circleId = router.query.circleId;
  const { circle, isLoading, error } = useGetCircleById(
    (circleId as string) ?? ""
  );

  if (isLoading) {
    return <LoadingSpinner />;
  }
  return (
    <div className="px-[20px]  xl:w-[80%]  mx-auto ">
      <CircleInfoCard
        id={circle?.id ?? ""}
        category={circle?.category ?? "Category1"}
        city={circle?.city ?? "Unknown City"}
        criteria={circle?.criteria ?? "none"}
        maxAge={circle?.maxAge ?? 100}
        minAge={circle?.minAge ?? 18}
        name={circle?.name ?? "Unknown Circle"}
        timeSlots={circle?.timeSlots ?? []}
        description={circle?.description ?? "No description available."}
        image={circle?.image}
        key={circle?.id ?? ""}
      />

      <div className=" mt-7 mb-[2px] md:mb-[32px] py-6 md:py-[28px] border-y-[0.5px] flex justify-between items-center border-textDark">
        <Rate
          className="text-[14px] md:text-[20px]"
          rate={circle?.rate?.stars ?? 0}
          amount={circle?.rate?.reviewsCount ?? 0}
        />
        <div className="flex items-center gap-4">
          {circle?.host?.image && (
            <Image
              width={120}
              height={120}
              className=" w-[60px] "
              src={circle?.host?.image}
              alt=""
            />
          )}
        </div>
      </div>
      <div>
        <ReviewsContainer
          featuredReviews={circle?.featuredReviews ?? []}
          stars={circle?.rate?.stars}
          reviewCount={circle?.rate?.reviewsCount}
        />
      </div>
    </div>
  );
}
