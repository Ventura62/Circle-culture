import { createContext, PropsWithChildren, useContext } from "react";
import {
  useCreateCircle,
  CreateCircleContextState,
} from "@/hooks/useCreateCircle";

const CreateCircleContext = createContext<CreateCircleContextState | undefined>(
  undefined
);

export const CreateCircleProvider: React.FC<PropsWithChildren> = ({
  children,
}) => {
  const createCircleState = useCreateCircle();

  return (
    <CreateCircleContext.Provider value={createCircleState}>
      {children}
    </CreateCircleContext.Provider>
  );
};
export const useCreateCircleContext = () => {
  const context = useContext(CreateCircleContext);
  if (!context) {
    throw new Error(
      "useCreateCircleContext must be used within an AuthProvider"
    );
  }
  return context;
};
export default CreateCircleContext;
