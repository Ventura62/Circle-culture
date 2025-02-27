import { CheckCircle } from "lucide-react";
import Link from "next/link";

const FeedbackReceived = () => {
  return (
    <div className="flex flex-col items-center justify-center text-white text-center space-y-6">
      <h2 className="text-3xl font-bold">Your feedback has been received!</h2>
      <div className="w-16 h-16 flex items-center justify-center bg-[#3B5B8A] rounded-full">
        <CheckCircle className="w-10 h-10 text-white" />
      </div>
      <p className="text-xl text-gray-300 pb-6">
        Thank you for sharing your thoughts.
      </p>
      <Link
        href="/user/dashboard"
        className="px-9 py-3 bg-[#3B5B8A] rounded-full text-lg font-semibold transition-all duration-200 hover:bg-[#2E4A75]"
      >
        Back to home
      </Link>
    </div>
  );
};

export default FeedbackReceived;
