import { Button } from "@/components/ui/button";
import { CheckCircle } from "lucide-react";
import { useRouter } from "next/router";

const ProfilePending = () => {
  const router = useRouter();
  return (
    <div className="flex flex-col min-h-screen items-center justify-between text-white px-6 text-center">
      <div className="flex flex-col items-center gap-2">
        <h2 className="text-xl font-bold mb-4">
          Your Profile is Almost Ready!
        </h2>
        <CheckCircle className="w-10 h-10 text-blue-500 mb-4" />

        <p className="text-lg font-semibold">
          Next Step:{" "}
          <span className="font-normal">
            Ask your reference to confirm your access.
          </span>
        </p>
        <p className="mt-4">
          You’re on the priority list!
          <br />
          Most get access within 24 hours.
          <br />
          While you wait, you can explore your dashboard!
        </p>
      </div>
      <div className="fixed bottom-16">
        {" "}
        <p className="text-sm mb-4 ">
          No reference yet? Email{" "}
          <a href="mailto:info@27circle.co" className="underline">
            info@27circle.co
          </a>{" "}
          for approval.
        </p>
        <Button
          className="max-470:w-full max-470:px-0 py-5 px-12 mb-10 text-white !bg-secondary border-1.5 border-secondary hover:!bg-transparent hover:!text-[#466A97] rounded-full
        "
          onClick={() => router.replace("/home")}
        >
          View Personal Dashboard
        </Button>
      </div>
    </div>
  );
};
export default ProfilePending;
