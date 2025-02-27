import { ToastAction } from "@/components/ui/toast";
import { useToast } from "@/hooks/use-toast";
import { createContext, useContext } from "react";

interface ToastContextType {
  showSuccessToast: (message: string, title?: string) => void;
  showFailToast: (
    message: string,
    title?: string,
    tryAgainFunc?: () => void
  ) => void;
}

export const ToastContext = createContext<ToastContextType | undefined>(
  undefined
);

export default function ToastProvider({
  children,
}: {
  children: React.ReactNode;
}) {
  const { toast } = useToast();

  const showSuccessToast = (message: string, title?: string) => {
    toast({
      title: title,
      description: message,
    });
  };
  const showFailToast = (
    message: string,
    title?: string,
    tryAgainFunc?: () => void
  ) => {
    toast({
      variant: "destructive",
      title: title,
      description: message,
      action: tryAgainFunc && (
        <ToastAction altText="Try again" onClick={() => tryAgainFunc()}>
          Try again
        </ToastAction>
      ),
    });
  };

  return (
    <ToastContext.Provider value={{ showSuccessToast, showFailToast }}>
      {children}
    </ToastContext.Provider>
  );
}

export const useToastContext = () => {
  const context = useContext(ToastContext);
  if (context === undefined) {
    throw new Error("useToast must be used within a ToastProvider");
  }
  return context;
};
