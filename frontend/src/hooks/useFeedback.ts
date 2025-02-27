import { Dispatch, SetStateAction, useEffect, useState } from "react";
import { axiosPrivateInstance } from "@/config/axiosConfig";
import { ServerErrorResponse, ServerResponse } from "@/models/ServerResponse";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import {
  HeartIcon,
  ThumbsUpIcon,
  HandIcon,
  SquareX,
  Smile,
} from "lucide-react";
// import {Heart}from "@/assets/images"
import {
  ActiveFeedBackSessionResponse,
  ActiveFeedBackSessionResponseSchema,
  CircleMemberFeedBack,
  FeedBackOptionsT,
  SubmitFeedBackData,
} from "@/models/FeedBack";
import { useZodParser } from "./useZodParser";

export type FeedBackHook = {
  showFeedBack: boolean;
  isLoading: boolean;
  feedbackOptions: FeedBackOptionsT[];
  circleMembers: CircleMemberFeedBack[];
  setCircleMembers: Dispatch<SetStateAction<CircleMemberFeedBack[]>>;
  actions: {
    handleSubmitFeedBack: (feedBackData: SubmitFeedBackData) => Promise<void>;
    handleICouldntAttend: () => void;
  };
};

export function useFeedBack(): FeedBackHook {
  const { user } = useLocalUserContext();
  const [feedBackId, setFeedBackId] = useState<string | null>(null);
  const [isLoading, setIsLoading] = useState(false);
  const showFeedBack = feedBackId ? true : false;
  const { triggerParser } = useZodParser();
  const [circleMembers, setCircleMembers] = useState<CircleMemberFeedBack[]>([
    {
      name: "x",
      id: "123",
      rate: 2,
    },
    {
      name: "xw",
      id: "1232",
      rate: 3,
    },
  ]);

  const feedbackOptions: FeedBackOptionsT[] = [
    { emoji: HeartIcon, label: "Yes", value: 3 },
    { emoji: Smile, label: "Neutral", value: 2 },
    { emoji: HandIcon, label: "No", value: 1 },
  ];

  const reset = () => {
    setCircleMembers([]);
    setFeedBackId(null);
  };

  useEffect(() => {
    handleSetShowFeedBackSession();
  }, [user.accessLevel]);

  const handleSetShowFeedBackSession = async () => {
    setIsLoading(true);
    if (user.accessLevel !== "Guest") {
      const currentFeedBackData = await getShowFeedBack();
      if (currentFeedBackData) {
        setCircleMembers(currentFeedBackData?.members);
        setFeedBackId(currentFeedBackData.id);
      }
    }
    setIsLoading(false);
  };

  const handleSubmitFeedBack = async (feedBackData: SubmitFeedBackData) => {
    setIsLoading(true);
    await postFeedBack(feedBackData);
    reset();
    setIsLoading(false);
  };

  const handleICouldntAttend = () => {};

  const getShowFeedBack = (): Promise<ActiveFeedBackSessionResponse | null> => {
    return axiosPrivateInstance
      .get<ServerResponse<ActiveFeedBackSessionResponse | ServerErrorResponse>>(
        "/user/showFeedBack"
      )
      .then((response) => {
        const data = response.data;
        if (data.okay) {
          const feedBackData = triggerParser(
            data.data,
            ActiveFeedBackSessionResponseSchema,
            "/user/showFeedBack",
            "get"
          ) as ActiveFeedBackSessionResponse;
          return feedBackData;
        } else {
          return Promise.reject(new Error(data.message));
        }
      })
      .catch((err) => {
        console.log(
          err.message || "An error occurred while fetching user data."
        );
        return null;
      });
  };
  const postFeedBack = (feedBackData: SubmitFeedBackData): Promise<boolean> => {
    return axiosPrivateInstance
      .post<ServerResponse<boolean | ServerErrorResponse>>("/user/feedback")
      .then((response) => {
        const data = response.data;
        if (data.okay) {
          return true;
        } else {
          return Promise.reject(new Error(data.message));
        }
      })
      .catch((err) => {
        console.log(
          err.message || "An error occurred while fetching user data."
        );
        return false;
      });
  };

  return {
    showFeedBack,
    isLoading,
    circleMembers,
    setCircleMembers,
    feedbackOptions,
    actions: {
      handleSubmitFeedBack,
      handleICouldntAttend,
    },
  };
}
