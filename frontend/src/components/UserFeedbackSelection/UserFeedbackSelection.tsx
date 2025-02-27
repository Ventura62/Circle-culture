import { Dispatch, SetStateAction, useState } from "react";
import ReportModal from "../ReportModal/ReportModal";
import { CircleMemberFeedBack, FeedBackOptionsT } from "@/models/FeedBack";

interface UserFeedbackSelectionProps {
  circleMembers: CircleMemberFeedBack[];
  feedbackOptions: FeedBackOptionsT[];
  setCircleMembers: Dispatch<SetStateAction<CircleMemberFeedBack[]>>;
  handleNext: () => void;
}

const UserFeedbackSelection = ({
  handleNext,
  circleMembers,
  setCircleMembers,
  feedbackOptions,
}: UserFeedbackSelectionProps) => {
  const [isReportModalOpen, setIsReportModalOpen] = useState(false);
  const [selectedUser, setSelectedUser] = useState<CircleMemberFeedBack>();
  const [reportText, setReportText] = useState("");
  const openReportModal = (user: CircleMemberFeedBack) => {
    setSelectedUser(user);
    setIsReportModalOpen(true);
  };
  const handleReportSubmission = (reportText: string) => {
    setCircleMembers((prev) =>
      prev.map((member) =>
        member.id === selectedUser?.id ? { ...member, reportText } : member
      )
    );

    console.log("Report submitted:", reportText);
    setIsReportModalOpen(false);
  };

  const handleUserFeedback = (user: CircleMemberFeedBack, rate: number) => {
    setCircleMembers((prev) => {
      return prev.map((member) => {
        if (member.id == user.id) {
          member.rate = rate;
        }
        return member;
      });
    });
  };

  return (
    <>
      <div className="min-w-full overflow-x-auto max-w-[900px] px-6 lg:px-0 ms-5 max-878:ms-0">
        <div className="space-y-8 w-full min-w-[100px] pb-10">
          {isReportModalOpen && (
            <div className="fixed inset-0 bg-black opacity-50 z-40 !backdrop-blur-md"></div>
          )}
          <h2 className="text-xl md:text-2xl font-semibold pb-[15px]">
            Would you enjoy seeing the same guests in the future?{" "}
          </h2>
          <div className="mt-2 md:grid md:grid-cols-2 gap-6 max-w-[1000px] ">
            {circleMembers.map((user, index) => (
              <div
                key={user.id}
                className="flex flex-col items-start mt-6 md:mt-0 w-full space-y-6 h-fit rounded-lg p-3 pr-4"
                style={{
                  border: "0.5px solid #FFFFFF4D",
                  backgroundColor: index % 2 !== 0 ? "#232627" : "transparent",
                }}
              >
                <div className="flex items-center justify-between w-full rounded-lg">
                  <div className="flex items-center gap-4">
                    <div className="w-12 h-12 bg-gray-500 rounded-full flex-shrink-0"></div>
                    <p className="w-1/5 min-w-[120px] text-left text-lg font-medium flex-shrink-0">
                      {user.name}
                    </p>
                  </div>
                  <button
                    className="text-white  font-medium underline ml-4"
                    onClick={() => openReportModal(user)}
                  >
                    No show
                  </button>
                </div>
                <div className="flex flex-grow flex-row justify-between gap-2 w-full flex-nowrap pr-2 max-592:pr-0 ">
                  {feedbackOptions.map((option, index) => {
                    const Emoji = option.emoji;

                    return (
                      <button
                        key={option.label}
                        onClick={() => handleUserFeedback(user, option.value)}
                        className={`h-12 px-2 py-2 text-lg flex items-center justify-center max-592:gap-2 w-[120px] md:w-full max-592:w-full whitespace-nowrap transition-colors duration-200 hover:bg-gray-600 !rounded-lg gap-1 ${
                          user.rate === option.value
                            ? "bg-secondary text-white"
                            : ""
                        }`}
                        style={{ border: "0.5px solid #FFFFFF4D" }}
                      >
                        <span className="max-720:hidden max-592:block">
                          <Emoji />
                        </span>
                        <span className="text-center">{option.label}</span>
                      </button>
                    );
                  })}
                </div>
              </div>
            ))}
          </div>
          <ReportModal
            user={selectedUser}
            isOpen={isReportModalOpen}
            onClose={() => {
              setIsReportModalOpen(false);
              setReportText("");
            }}
            reportText={reportText}
            setReportText={setReportText}
            onReport={handleReportSubmission}
          />
        </div>
        <div className="flex justify-end mt-20 flex-1 mb-8">
          <button
            type="button"
            onClick={handleNext}
            className="max-470:w-full py-2.5 px-12 bg-secondary rounded-full border-2 border-secondary hover:bg-primary hover:text-[#466A97] transition-all duration-200"
          >
            Next
          </button>
        </div>
      </div>
    </>
  );
};

export default UserFeedbackSelection;
