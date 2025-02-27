import Link from "next/link";
import { FaCircleCheck } from "react-icons/fa6";

const Step10 = () => {
  return (
    <div className="text-center flex flex-col items-center gap-4 font-medium">
      <h1 className="text-3xl font-semibold">
        Your Circle is successfully created!
      </h1>
      <FaCircleCheck size={64} className="fill-secondary" />
      <p className="max-w-[32rem] ">
        Be sure to check the Dashboard and remember to book a restaurant as you
        get closer to the date.{" "}
      </p>
      <Link
        href="/user/dashboard"
        className="py-2.5 px-12 bg-secondary hover:shadow-md-centered shadow-secondary rounded-full border-2 border-secondary hover:bg-transparent hover:text-secondary transition-all duration-200"
      >
        Next
      </Link>
    </div>
  );
};

export default Step10;
