import { useState } from "react";

interface ReviewNotesFormProps {
  onSubmitReviews: (pr: string, pn: string) => void;
}

const ReviewNotesForm = (props: ReviewNotesFormProps) => {
  const { onSubmitReviews } = props;

  const [tempPublicReview, setTempPublicReview] = useState("");
  const [tempPrivateNote, setTempPrivateNote] = useState("");

  const handleSubmit = () => {
    onSubmitReviews(tempPublicReview, tempPrivateNote);
  };

  return (
    <>
      <div className="min-w-full max-w-[900px] px-6  ms-5 max-878:ms-0 max-940:px-6 pr-10">
        <div className="space-y-8 w-full max-w-[800px] min-w-[100px] pb-10 ">
          <h2 className="text-[20px] md:text-2xl font-semibold mb-4">
            Last step! Write a review for this Circle
          </h2>

          <div className="w-full mb-6">
            <label className="text-[16px] md:text-[18px] font-medium">
              Write a public review for the future attendees
            </label>
            <textarea
              className="w-full h-32 p-4 bg-primary border border-gray-700 rounded-lg mt-2"
              maxLength={900}
              value={tempPublicReview}
              onChange={(e) => setTempPublicReview(e.target.value)}
              placeholder="Share your experience..."
              style={{ backgroundColor: "#232627" }}
            ></textarea>
            <p className="text-sm text-gray-400">
              {900 - tempPublicReview.length} characters left
            </p>
          </div>

          <div className="w-full mb-6">
            <label className="text-[16px] md:text-[18px] font-medium">
              Write a private note to the host
            </label>
            <textarea
              className="w-full h-32 p-4 bg-primary border border-gray-700 rounded-lg mt-2"
              maxLength={900}
              value={tempPrivateNote}
              onChange={(e) => setTempPrivateNote(e.target.value)}
              placeholder="Your feedback to the host..."
            ></textarea>
            <p className="text-sm text-gray-400">
              {900 - tempPrivateNote.length} characters left
            </p>
          </div>

          <div className="flex justify-end">
            <button
              type="button"
              onClick={handleSubmit}
              className="max-470:w-full py-2.5 px-12 bg-secondary rounded-full border-1.5 border-secondary hover:bg-primary hover:text-[#466A97] transition-all duration-200"
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </>
  );
};

export default ReviewNotesForm;
