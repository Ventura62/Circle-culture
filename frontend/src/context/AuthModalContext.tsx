import { createContext, useContext, ReactNode } from "react";
import { useAuthType, useUserAuth } from "@/hooks/useUserAuth";

const AuthContext = createContext<useAuthType | undefined>(undefined);

export function AuthProvider({ children }: { children: ReactNode }) {
  const auth = useUserAuth();

  return <AuthContext.Provider value={auth}>{children}</AuthContext.Provider>;
}

export const useAuthContext = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error("useAuthContext must be used within an AuthProvider");
  }
  return context;
};
