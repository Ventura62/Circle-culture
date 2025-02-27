import CirclesList from "@/components/circlesList/CirclesList";
import CirclesFilter from "@/components/shared/circlesFilter/CirclesFilter";

export default function Home() {
  return (
    <div>
      <div className="flex justify-center ">
        <CirclesFilter />
      </div>
      <div className="flex flex-col mt-[22px] md:mt-[60px] ">
        <CirclesList />
      </div>
    </div>
  );
}
