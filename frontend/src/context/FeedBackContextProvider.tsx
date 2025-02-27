import { FeedBackHook, useFeedBack } from "@/hooks/useFeedback";
import React, { createContext, useContext, ReactNode } from "react";

const FeedBackContext = createContext<FeedBackHook | undefined>(undefined);

// Provider component
export const FeedBackProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
  const feedBackData = useFeedBack();

  return <FeedBackContext.Provider value={feedBackData}>{children}</FeedBackContext.Provider>;
};

// Hook to use the feedback context
export const useFeedBackContext = () => {
  const context = useContext(FeedBackContext);
  if (context === undefined) {
    throw new Error("useFeedBackContext must be used within a FeedBackProvider");
  }
  return context;
};
