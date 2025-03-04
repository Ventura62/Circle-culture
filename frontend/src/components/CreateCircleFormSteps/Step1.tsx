import { useCreateCircleContext } from "@/context/CreateCircleContext";
import Link from "next/link";

const Step1 = () => {
    const { handleNext } = useCreateCircleContext();
    return (
        <>
            <h2 className="text-xl md:text-3xl ">
                Let’s create your first Circle!
            </h2>
            <div className=" flex md:ml-[-200px] mt-10 md:mt-20 flex-col  gap-4 font-medium text-white p-6 border-l-2 border-white max-w-2xl mx-auto">
                <h2 className="text-xl font-bold mb-2">What’s a Circle</h2>
                <p className="mb-6 text-gray-300">
                    A Circle is a small gathering (4-6 people) where guests pay
                    to join and connect. New hosts start with one Circle and can
                    grow to hundreds if successful.
                </p>

                <h2 className="text-xl font-bold mb-2">Why create a Circle</h2>
                <ul className="mb-6 list-disc list-inside text-gray-300">
                    <li>
                        Host meaningful gatherings and earn for your effort,
                        even if you can't join!
                    </li>
                    <li>
                        Review profiles, set the vibe, and join if you’d like!
                    </li>
                    <li>Be part of a movement of tackling Social Isolation</li>
                </ul>

                <h2 className="text-xl font-bold mb-2">
                    Getting Started is Easy!
                </h2>
                <ul className="list-disc list-inside text-gray-300">
                    <li>It only takes a few mins to create a Circle</li>
                    <li>
                        Your first Circle is a learning experience, and you can
                        stay anonymous if you prefer
                    </li>
                    <li>
                        If your first Circle doesn’t take off, you can always
                        try again and your rating won’t be affected!
                    </li>
                </ul>
            </div>
            <div className="flex flex-col items-center">
                <button
                    type="button"
                    onClick={handleNext}
                    className="py-2.5 mt-12 px-12 bg-secondary hover:shadow-md-centered shadow-secondary rounded-full border-2 border-secondary hover:bg-transparent hover:text-secondary transition-all duration-200"
                >
                    Get Started
                </button>
                <Link
                    href="/home/faq"
                    className=" mt-6 underline hover:opacity-80 transition-all duration-200"
                >
                    Host faq
                </Link>
            </div>
        </>
    );
};

export default Step1;
