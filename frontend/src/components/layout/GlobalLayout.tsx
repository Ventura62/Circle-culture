import CompositeContextProvider from "@/context/CompositeContextProvider";
import React, { ReactNode } from "react";
import Navbar from "../shared/Navbar/Navbar";
import { Cairo } from "next/font/google";
import FeedbackForm from "@/pages/user/feedback";
import { useFeedBackContext } from "@/context/FeedBackContextProvider";
import { AnimatePresence, motion } from "motion/react";
import { useRouter } from "next/router";
import { ProtectedRouteWrapper } from "./ProtectedRouteWrapper";

const cairo = Cairo({
  variable: "--font-cairo",
  subsets: ["latin"],
});
const GlobalWrapper = ({ children }: { children: ReactNode }) => {
  const router = useRouter();

  return (
    <main className={`${cairo.variable} font-cairo pt-8  pb-24 md:py-0   `}>
      <CompositeContextProvider>
        <AnimatePresence mode="popLayout">
          <motion.div
            key={router.route}
            initial="initialState"
            animate="animateState"
            exit="exitState"
            transition={{
              duration: 0.75,
              ease: [0.43, 0.13, 0.23, 0.96],
            }}
            variants={{
              initialState: {
                opacity: 0,
                y: 50,
              },
              animateState: {
                opacity: 1,
                y: 0,
              },
              exitState: {
                opacity: 0,
                y: -50,
              },
            }}
          >
            <GlobalLayout>
              {/* <ProtectedRouteWrapper> */}
              {children}
              {/* </ProtectedRouteWrapper> */}
            </GlobalLayout>
          </motion.div>
        </AnimatePresence>
      </CompositeContextProvider>
    </main>
  );
};

const GlobalLayout = ({ children }: { children: ReactNode }) => {
  const { showFeedBack } = useFeedBackContext();
  return (
    <>
      {!showFeedBack ? (
        <div className="min-h-[100vh]">
          <Navbar />
          {children}
        </div>
      ) : (
        <>
          <FeedbackForm />
        </>
      )}
    </>
  );
};

export default GlobalWrapper;
