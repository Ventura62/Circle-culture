import { ErrorBoundary } from "react-error-boundary";
import { AxiosResponseProvider } from "./AxiosResponseContextProvider";
import { Tooltip as ReactTooltip } from "react-tooltip";
import { FallBackRender } from "@/components/FallBackRender";
import { LocalUserProvider } from "./LocalUserContextProvider";
import { useEffect, useState } from "react";
import ToastProvider from "./ToastProviderContext";
import { CreateCircleProvider } from "./CreateCircleContext";
import { FeedBackProvider } from "./FeedBackContextProvider";
import { AuthProvider } from "./AuthModalContext";

export default function CompositeContextProvider({
  children,
}: {
  children: React.ReactNode;
}) {
  const [isMounted, setIsMounted] = useState(false);

  useEffect(() => {
    setIsMounted(true);
  }, []);

  if (!isMounted) return null;

  return (
    <>
      <ToastProvider>
        <AxiosResponseProvider>
          <LocalUserProvider>
            <FeedBackProvider>
              <CreateCircleProvider>
                <AuthProvider>
                  <ReactTooltip
                    id="standardToolTip"
                    className=" z-[10000]  rounded-lg max-w-[500px] breakWord"
                  />
                  {children}
                </AuthProvider>
              </CreateCircleProvider>
            </FeedBackProvider>
          </LocalUserProvider>
        </AxiosResponseProvider>
      </ToastProvider>
    </>
  );
}
