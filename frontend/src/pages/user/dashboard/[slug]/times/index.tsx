import { useState, useEffect } from "react";
import Link from "next/link";
import { IoIosArrowBack } from "react-icons/io";
import { DateTimePicker } from "@/components/ui/date-time-picker";
import Input from "@/components/shared/Input/Input";
import { Switch } from "@/components/ui/switch";
import { useRouter } from "next/router";
import {
  useEditCircleTimings,
  useGetHostedCircleById,
} from "@/hooks/useHostedCircles";
import { HostCircleTimingsT } from "@/models/Circle";
import { Button } from "@/components/ui/button";
const circleId = "circleid";
const Times = () => {
  const router = useRouter();
  const { slug } = router.query;
  const { circle, isLoading, error } = useGetHostedCircleById(circleId);
  const {
    editCircleTimings,
    isLoading: isUpdating,
    success,
  } = useEditCircleTimings();

  const [timings, setTimings] = useState<HostCircleTimingsT[]>([]);

  useEffect(() => {
    if (circle?.timeSlots) {
      const sortedTimings = [...circle.timeSlots].sort(
        (a, b) =>
          new Date(a.datetime).getTime() - new Date(b.datetime).getTime()
      );

      const missingSlots = 5 - sortedTimings.length;
      console.log(missingSlots);
      if (missingSlots > 0) {
        const emptySlots = Array(missingSlots)
          .fill(null)
          .map((_, index) => ({
            id: `new-slot-${index}`,
            datetime: "",
            spotsFilled: 0,
            active: false,
          }));

        setTimings([...sortedTimings, ...emptySlots]);
      } else {
        setTimings(sortedTimings);
      }
    }
  }, [circle?.timeSlots]);

  const handleUpdateTimings = async () => {
    try {
      await editCircleTimings(circleId, timings);
    } catch (err) {}
  };

  return (
    <div className="text-white mx-auto max-w-[68rem] max-1100:mx-10 max-592:mx-4">
      <div className="flex items-center gap-2 max-592:mx-4">
        <Link
          href={`/user/dashboard/${slug}`}
          type="button"
          className="hover:bg-opacity-10 p-1 rounded-md hover:bg-white"
        >
          <IoIosArrowBack size={32} />
        </Link>
        <h1 className="text-3xl max-470:text-2xl">Edit Times</h1>
      </div>

      <div className="flex flex-col gap-4 mt-6">
        {timings.map((time, index) => (
          <TimeCard
            key={time.id}
            time={time}
            updateTime={(updatedTime) => {
              const updatedTimings = [...timings];
              updatedTimings[index] = updatedTime;
              setTimings(updatedTimings);
            }}
          />
        ))}
      </div>

      <div className="my-6 flex justify-end">
        <Button
          className="px-6 py-3 bg-secondary rounded-full"
          onClick={handleUpdateTimings}
          disabled={isUpdating}
        >
          {isUpdating ? "Updating..." : "Save Changes"}
        </Button>
      </div>

      {success && (
        <p className="text-green-500 text-center mt-4">
          Timings updated successfully!
        </p>
      )}
    </div>
  );
};

type TimeCardProps = {
  time: HostCircleTimingsT;
  updateTime: (updatedTime: HostCircleTimingsT) => void;
};

const TimeCard = ({ time, updateTime }: TimeCardProps) => {
  const [date, setDate] = useState<string>(time.datetime);
  const [spotsFilled, setSpotsFilled] = useState<number | null>(
    time.spotsFilled
  );
  const [active, setActive] = useState<boolean>(time.active);

  const handleChange = () => {
    updateTime({
      id: time.id,
      datetime: date,
      spotsFilled: spotsFilled ?? 0,
      active,
    });
  };

  return (
    <div
      className={`${
        active && "opacity-50"
      } flex-1 flex items-center justify-between gap-6 max-w-[44rem] bg-primary border-1.5 border-white border-opacity-30 rounded-md py-3.5 px-5 max-656:flex-wrap`}
    >
      <DateTimePicker
        className="!flex-1 max-w-96 max-656:min-w-full"
        value={date}
        onChange={(newDate) => {
          setDate(newDate);
          handleChange();
        }}
      />
      <Input
        disabled={active}
        containerClassName="!flex-1 justify-start"
        className={`${
          active && "!border-opacity-0 !p-0"
        } w-9 !py-1 !px-2 !text-white !text-opacity-30`}
        value={spotsFilled ?? ""}
        onChange={(e) => {
          const newValue =
            e.target.value === "" ? null : Number(e.target.value);
          setSpotsFilled(newValue);
          handleChange();
        }}
        type="number"
        title="Spots Filled"
        placeholder="0"
      />
      <Switch
        checked={active}
        onClick={() => {
          setActive(!active);
          handleChange();
        }}
        className="!bg-secondary"
      />
    </div>
  );
};

export default Times;
