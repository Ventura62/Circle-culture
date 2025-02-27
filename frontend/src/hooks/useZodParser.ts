import { z } from "zod";
import { useToastContext } from "@/context/ToastProviderContext";

export type ZodParserHook = {
  triggerParser: <T>(input: unknown, parser: z.ZodType<T>, pathName: string, requestType: "get" | "post" | "delete" | "put") => T;
};

export const useZodParser = (): ZodParserHook => {
  const { showFailToast } = useToastContext();

  const triggerParser = <T>(input: unknown, parser: z.ZodType<T>, pathName: string, requestType: "get" | "post" | "delete" | "put"): T => {
    const result = parser.safeParse(input);
    if (result.success) {
      return result.data;
    } else {
      if (!(process.env.NEXT_ENVIRONMENT as string).toLowerCase().includes("development")) {
        console.log("Parsing error");
      }
      showFailToast("Error Validating Data");

      throw new Error(result.error.message);
    }
  };
  return { triggerParser };
};
