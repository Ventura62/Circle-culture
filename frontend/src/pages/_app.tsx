import GlobalWrapper from "@/components/layout/GlobalLayout";
import "@/styles/globals.css";
import { Elements } from "@stripe/react-stripe-js";
import type { AppProps } from "next/app";
import { loadStripe } from "@stripe/stripe-js";

export default function App({ Component, pageProps }: AppProps) {
  return (
    <GlobalWrapper>
      <Component {...pageProps} />
    </GlobalWrapper>
  );
}
