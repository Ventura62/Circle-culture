import { Button } from "@/components/ui/button";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { CircleMemberFeedBack } from "@/models/FeedBack";

interface ReportModalProps {
  user?: CircleMemberFeedBack;
  isOpen: boolean;
  onClose: () => void;
  onReport: (reportText: string) => void;
  reportText: string;
  setReportText: (rt: string) => void;
}

const ReportModal = ({ user, isOpen, onClose, onReport, reportText, setReportText }: ReportModalProps) => {
  const handleReportClick = () => {
    onReport(reportText);
    setReportText("");
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="bg-primary border border-gray-700 text-white max-w-lg">
        <DialogHeader>
          <DialogTitle className="text-lg font-semibold text-center">Report {user?.name}</DialogTitle>
        </DialogHeader>
        <p className="text-md text-white mb-4">Provide details about your experience. We’ll review and take action if needed.</p>
        <textarea
          className="w-full h-48 p-4 bg-primary border border-gray-600 rounded-lg"
          maxLength={900}
          value={reportText}
          onChange={(e) => setReportText(e.target.value)}
          placeholder="Describe the issue..."
        ></textarea>
        <div className="flex flex-row justify-between my-[30px] w-full">
          <Button className="w-[150px] text-white rounded-full py-6 !bg-transparent border border-white flex" onClick={onClose}>
            <p className="text-white">Cancel</p>
          </Button>

          <Button
            className={`w-[150px] text-white rounded-full py-6 transition-all duration-200 
    ${reportText?.trim()?.length < 3 ? "bg-gray-400 border-gray-400 cursor-not-allowed" : "!bg-secondary"}`}
            onClick={handleReportClick}
            disabled={reportText?.trim()?.length < 3}
          >
            Report
          </Button>
        </div>
      </DialogContent>
    </Dialog>
  );
};

export default ReportModal;
