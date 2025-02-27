import { use, useState } from "react";
import TabGroup from "@/components/shared/TabGroup/TabGroup";
import Link from "next/link";
import { IoIosArrowBack, IoIosClose } from "react-icons/io";
import {
  XAxis,
  YAxis,
  Tooltip,
  ResponsiveContainer,
  AreaChart,
  Area,
} from "recharts";
import {
  AlertDialog,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import { Button } from "@/components/ui/button";
import { ScrollArea } from "@/components/ui/scroll-area";
import { useRouter } from "next/router";
import { circlesData } from "@/hooks/useCreateCircle";

type tParams = Promise<{ slug: string }>;

const data = [
  { week: "week 1", rating: 3, score: 2.5 },
  { week: "week 2", rating: 2.5, score: 3.2 },
  { week: "week 3", rating: 3.5, score: 4 },
  { week: "week 4", rating: 4.5, score: 2.5 },
  { week: "week 5", rating: 5, score: 4.5 },
  { week: "week 6", rating: 4.5, score: 5 },
];

const stats = {
  peopleConnected: 12,
  averageRating: 3.2,
  compatibilityScore: 4.5,
  noShow: 17,
  totalIncome: 145.24,
  feedback: 135,
};

const feedbacks = [
  {
    name: "Basma",
    date: "January 2025",
    comment:
      "The chalet is organized, clean and suitable for relaxation Loly and Dalal are helpful and friendly.",
  },
  {
    name: "Ahmed",
    date: "January 2025",
    comment:
      "Fantastic and calm gateway in all means with full privacy. The location is just spectacular and breathtaking from all aspects with beautiful sea…",
  },
  {
    name: "Salma",
    date: "January 2025",
    comment:
      "Had the best time at this charming chalet! The place was warm and cozy with a spacious terrace that offered a stunning view.",
  },
  {
    name: "Melanie",
    date: "January 2025",
    comment: "I felt very comfortable in the house! Thank you very much.",
  },
  {
    name: "Marwan",
    date: "January 2025",
    comment: "I felt very comfortable in the house! Thank you very much.",
  },
  {
    name: "Basma",
    date: "January 2025",
    comment:
      "The chalet is organized, clean and suitable for relaxation Loly and Dalal are helpful and friendly.",
  },
];

const Statistics = ({ params }: { params: tParams }) => {
  const router = useRouter();
  const { slug } = router.query;

  const [tabIndex, setTabIndex] = useState<number>(0);
  const tabs = ["Overall", "Group 1", "Group 2"];

  const circle = circlesData.find((circle) => circle.slug === slug);

  if (!circle) {
    return <p>Loading...</p>;
  }

  return (
    <div className="text-white mx-auto max-w-[68rem] max-1100:mx-10 max-592:mx-4">
      <div className="flex items-center gap-2 mb-10">
        <Link
          href="/user/dashboard"
          type="button"
          className="hover:bg-opacity-10 p-1 rounded-md hover:bg-white"
        >
          <IoIosArrowBack size={32} />
        </Link>
        <h1 className="text-3xl max-470:text-2xl">{circle.title} Statistics</h1>
      </div>

      <TabGroup tabs={tabs} tabIndex={tabIndex} setTabIndex={setTabIndex}>
        <div className="flex items-stretch gap-2.5 max-878:flex-col">
          <div className="flex flex-col flex-[0.7] gap-6 bg-primary rounded-md p-8">
            <div className="flex items-center justify-between max-780:gap-2 max-780:flex-col max-780:items-start">
              <h1 className="text-2xl">Performance Metrics</h1>
              <div className="flex items-center justify-between gap-10 ml-4 max-780:ml-6 max-470:flex-col max-470:items-start max-470:gap-0">
                <p className="relative flex items-center text-white before:content-[''] before:absolute before:h-2 before:w-2 before:rounded-full before:bg-white before:-left-4">
                  Average Rating
                </p>
                <p className="relative flex items-center text-[#5C9DFF] before:content-[''] before:absolute before:h-2 before:w-2 before:rounded-full before:bg-[#5C9DFF] before:-left-4">
                  Compatibility Score
                </p>
              </div>
            </div>
            <div className="w-full h-72">
              <ResponsiveContainer width="100%" height="100%">
                <AreaChart
                  width={500}
                  height={300}
                  data={data}
                  margin={{ top: 5, left: -26, right: 0, bottom: 5 }}
                >
                  <defs>
                    <linearGradient
                      id={`color-white`}
                      x1="0"
                      y1="0"
                      x2="0"
                      y2="1"
                    >
                      <stop
                        offset="0%"
                        stopColor="white"
                        stopOpacity={0.4}
                      ></stop>
                      <stop
                        offset="75%"
                        stopColor="white"
                        stopOpacity={0.05}
                      ></stop>
                    </linearGradient>
                  </defs>
                  <XAxis
                    tickMargin={10}
                    axisLine={false}
                    tickLine={false}
                    dataKey="week"
                  />
                  <YAxis
                    tickMargin={10}
                    domain={[2, 5]}
                    tickCount={4}
                    interval={0}
                    axisLine={false}
                    tickLine={false}
                  />
                  <Tooltip wrapperClassName="!bg-background !border-0 rounded-lg shadow-md-centered shadow-black" />
                  <Area
                    type="monotone"
                    dot={false}
                    dataKey="rating"
                    stroke="#5C9DFF"
                    fill="none"
                    strokeWidth={2}
                    strokeLinecap="round"
                    strokeDasharray="5 5"
                  />
                  <Area
                    type="monotone"
                    dot={false}
                    dataKey="score"
                    stroke="white"
                    fill="url(#color-white)"
                    strokeWidth={2}
                  />
                </AreaChart>
              </ResponsiveContainer>
            </div>
          </div>

          <div className="flex flex-col flex-[0.3] gap-6 bg-primary rounded-md p-8">
            <div>
              <p>People Connected</p>
              <p className="text-5xl">{stats.peopleConnected}</p>
            </div>
            <div className="flex flex-col *:py-3 divide-white divide-y-px divide-opacity-30">
              <div className="flex items-center justify-between">
                <p>Average Rating</p>
                <p>{stats.averageRating}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Compatibility Score</p>
                <p>{stats.compatibilityScore}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>No Show</p>
                <p>{stats.noShow}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Total Income</p>
                <p>{stats.totalIncome}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Read private feedback</p>
                <AlertDialog>
                  <AlertDialogTrigger asChild>
                    <Button
                      variant="none"
                      className="text-white rounded-full border-1.5 border-white hover:bg-white hover:text-primary !h-fit !py-1 px-4"
                    >
                      View
                    </Button>
                  </AlertDialogTrigger>
                  <AlertDialogContent className="!bg-primary !text-white rounded-xl max-592:!max-w-[calc(100%-2rem)]">
                    <AlertDialogCancel className="absolute -right-2 top-0.5">
                      <IoIosClose className="fill-white opacity-30 min-h-8 min-w-8" />
                    </AlertDialogCancel>
                    <AlertDialogHeader>
                      <AlertDialogTitle className="mt-4 flex items-center gap-6">
                        <span>{stats.averageRating}</span>
                        <span className="relative flex items-center before:content-[''] before:absolute before:top-3 before:h-2 before:w-2 before:rounded-full before:bg-white before:-left-3.5">
                          {stats.feedback} private feedback
                        </span>
                      </AlertDialogTitle>
                      <ScrollArea className="h-[calc(100vh-8rem)]">
                        {feedbacks.map((feedback, index) => (
                          <FeebackCard key={index} {...feedback} />
                        ))}
                      </ScrollArea>
                    </AlertDialogHeader>
                  </AlertDialogContent>
                </AlertDialog>
              </div>
            </div>
          </div>
        </div>

        <div className="flex items-stretch gap-2.5 max-878:flex-col">
          <div className="flex flex-col flex-[0.7] gap-6 bg-primary rounded-md p-8">
            <div className="flex items-center justify-between max-780:gap-2 max-780:flex-col max-780:items-start">
              <h1 className="text-2xl">Performance Metrics</h1>
              <div className="flex items-center justify-between gap-10 ml-4 max-780:ml-6 max-470:flex-col max-470:items-start max-470:gap-0">
                <p className="relative flex items-center text-white before:content-[''] before:absolute before:h-2 before:w-2 before:rounded-full before:bg-white before:-left-4">
                  Average Rating
                </p>
                <p className="relative flex items-center text-[#5C9DFF] before:content-[''] before:absolute before:h-2 before:w-2 before:rounded-full before:bg-[#5C9DFF] before:-left-4">
                  Compatibility Score
                </p>
              </div>
            </div>
            <div className="w-full h-72">
              <ResponsiveContainer width="100%" height="100%">
                <AreaChart
                  width={500}
                  height={300}
                  data={data}
                  margin={{ top: 5, left: -26, right: 0, bottom: 5 }}
                >
                  <defs>
                    <linearGradient
                      id={`color-white`}
                      x1="0"
                      y1="0"
                      x2="0"
                      y2="1"
                    >
                      <stop
                        offset="0%"
                        stopColor="white"
                        stopOpacity={0.4}
                      ></stop>
                      <stop
                        offset="75%"
                        stopColor="white"
                        stopOpacity={0.05}
                      ></stop>
                    </linearGradient>
                  </defs>
                  <XAxis
                    tickMargin={10}
                    axisLine={false}
                    tickLine={false}
                    dataKey="week"
                  />
                  <YAxis
                    tickMargin={10}
                    domain={[2, 5]}
                    tickCount={4}
                    interval={0}
                    axisLine={false}
                    tickLine={false}
                  />
                  <Tooltip wrapperClassName="!bg-background !border-0 rounded-lg shadow-md-centered shadow-black" />
                  <Area
                    type="monotone"
                    dot={false}
                    dataKey="rating"
                    stroke="#5C9DFF"
                    fill="none"
                    strokeWidth={2}
                    strokeLinecap="round"
                    strokeDasharray="5 5"
                  />
                  <Area
                    type="monotone"
                    dot={false}
                    dataKey="score"
                    stroke="white"
                    fill="url(#color-white)"
                    strokeWidth={2}
                  />
                </AreaChart>
              </ResponsiveContainer>
            </div>
          </div>

          <div className="flex flex-col flex-[0.3] gap-6 bg-primary rounded-md p-8">
            <div>
              <p>People Connected</p>
              <p className="text-5xl">{stats.peopleConnected}</p>
            </div>
            <div className="flex flex-col *:py-3 divide-white divide-y-px divide-opacity-30">
              <div className="flex items-center justify-between">
                <p>Average Rating</p>
                <p>{stats.averageRating}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Compatibility Score</p>
                <p>{stats.compatibilityScore}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>No Show</p>
                <p>{stats.noShow}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Total Income</p>
                <p>{stats.totalIncome}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Read private feedback</p>
                <button
                  type="button"
                  className="text-white rounded-full border-1.5 border-white hover:bg-white hover:text-primary px-4 transition-all duration-200"
                >
                  View
                </button>
              </div>
            </div>
          </div>
        </div>

        <div className="flex items-stretch gap-2.5 max-878:flex-col">
          <div className="flex flex-col flex-[0.7] gap-6 bg-primary rounded-md p-8">
            <div className="flex items-center justify-between max-780:gap-2 max-780:flex-col max-780:items-start">
              <h1 className="text-2xl">Performance Metrics</h1>
              <div className="flex items-center justify-between gap-10 ml-4 max-780:ml-6 max-470:flex-col max-470:items-start max-470:gap-0">
                <p className="relative flex items-center text-white before:content-[''] before:absolute before:h-2 before:w-2 before:rounded-full before:bg-white before:-left-4">
                  Average Rating
                </p>
                <p className="relative flex items-center text-[#5C9DFF] before:content-[''] before:absolute before:h-2 before:w-2 before:rounded-full before:bg-[#5C9DFF] before:-left-4">
                  Compatibility Score
                </p>
              </div>
            </div>
            <div className="w-full h-72">
              <ResponsiveContainer width="100%" height="100%">
                <AreaChart
                  width={500}
                  height={300}
                  data={data}
                  margin={{ top: 5, left: -26, right: 0, bottom: 5 }}
                >
                  <defs>
                    <linearGradient
                      id={`color-white`}
                      x1="0"
                      y1="0"
                      x2="0"
                      y2="1"
                    >
                      <stop
                        offset="0%"
                        stopColor="white"
                        stopOpacity={0.4}
                      ></stop>
                      <stop
                        offset="75%"
                        stopColor="white"
                        stopOpacity={0.05}
                      ></stop>
                    </linearGradient>
                  </defs>
                  <XAxis
                    tickMargin={10}
                    axisLine={false}
                    tickLine={false}
                    dataKey="week"
                  />
                  <YAxis
                    tickMargin={10}
                    domain={[2, 5]}
                    tickCount={4}
                    interval={0}
                    axisLine={false}
                    tickLine={false}
                  />
                  <Tooltip wrapperClassName="!bg-background !border-0 rounded-lg shadow-md-centered shadow-black" />
                  <Area
                    type="monotone"
                    dot={false}
                    dataKey="rating"
                    stroke="#5C9DFF"
                    fill="none"
                    strokeWidth={2}
                    strokeLinecap="round"
                    strokeDasharray="5 5"
                  />
                  <Area
                    type="monotone"
                    dot={false}
                    dataKey="score"
                    stroke="white"
                    fill="url(#color-white)"
                    strokeWidth={2}
                  />
                </AreaChart>
              </ResponsiveContainer>
            </div>
          </div>

          <div className="flex flex-col flex-[0.3] gap-6 bg-primary rounded-md p-8">
            <div>
              <p>People Connected</p>
              <p className="text-5xl">{stats.peopleConnected}</p>
            </div>
            <div className="flex flex-col *:py-3 divide-white divide-y-px divide-opacity-30">
              <div className="flex items-center justify-between">
                <p>Average Rating</p>
                <p>{stats.averageRating}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Compatibility Score</p>
                <p>{stats.compatibilityScore}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>No Show</p>
                <p>{stats.noShow}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Total Income</p>
                <p>{stats.totalIncome}</p>
              </div>
              <div className="flex items-center justify-between">
                <p>Read private feedback</p>
                <button
                  type="button"
                  className="text-white rounded-full border-1.5 border-white hover:bg-white hover:text-primary px-4 transition-all duration-200"
                >
                  View
                </button>
              </div>
            </div>
          </div>
        </div>
      </TabGroup>
    </div>
  );
};

interface Feedback {
  name: string;
  date: string;
  comment: string;
}

const FeebackCard = ({ name, date, comment }: Feedback) => {
  return (
    <div className="flex flex-col items-start gap-4 py-4">
      <div className="flex items-stretch justify-start gap-4">
        <div className="flex items-center justify-center h-12 w-12 rounded-full bg-[#232323]">
          {name.at(0)?.toUpperCase()}
        </div>
        <div className="flex flex-col items-start">
          <h1 className="text-lg">{name}</h1>
          <p className="text-white text-sm text-opacity-70">{date}</p>
        </div>
      </div>
      <p className="text-left">{comment}</p>
    </div>
  );
};

export default Statistics;
