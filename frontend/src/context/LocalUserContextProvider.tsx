import { UserHook, useLocalUser } from "@/hooks/useLocalUser";
import React, { createContext, useContext, ReactNode } from "react";

// Define the type for the context

// Create the context with default values
const LocalUserContext = createContext<UserHook | undefined>(undefined);

// Provider component
export const LocalUserProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
  const user = useLocalUser();

  return <LocalUserContext.Provider value={user}>{children}</LocalUserContext.Provider>;
};

// Hook to use the user context
export const useLocalUserContext = () => {
  const context = useContext(LocalUserContext);
  if (context === undefined) {
    throw new Error("useUserContext must be used within a UserProvider");
  }
  return context;
};
