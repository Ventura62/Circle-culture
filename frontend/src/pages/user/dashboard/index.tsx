import PreviousHostedCircles from "@/components/PreviousHostedCircles/PreviousHostedCircles";
import TabGroup from "@/components/shared/TabGroup/TabGroup";
import UpcomingHostedCircles from "@/components/UpcomingHostedCircles/UpcomingHostedCircles";

const Page = () => {
  const tabs = ["Upcoming", "Previous"];

  return (
    <div className="text-white mx-auto max-w-[68rem] max-1100:mx-10 max-592:mx-0">
      <div className="flex items-center justify-between max-592:mx-4">
        <h1 className="text-3xl">Your Circles</h1>
        <a
          href="/user/create-circle"
          className="py-2.5 px-6 max-592:px-3 bg-secondary hover:shadow-md-centered shadow-secondary rounded-full border-2 border-secondary hover:bg-transparent hover:text-secondary transition-all duration-200"
        >
          Create a new Circle
        </a>
      </div>

      <TabGroup tabs={tabs}>
        <div className="flex flex-col gap-4">
          <UpcomingHostedCircles />
        </div>
        <div className="flex flex-col gap-4">
          <PreviousHostedCircles />
        </div>
      </TabGroup>
    </div>
  );
};

export default Page;
