import { useState } from "react";
import { axiosPrivateInstance } from "@/config/axiosConfig";
import { ServerErrorResponse, ServerResponse } from "@/models/ServerResponse";
import { useZodParser } from "./useZodParser";

export const useCancelHangout = (hangoutId: string) => {
  const { triggerParser } = useZodParser();
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<boolean>(false);

  const cancelHangoutbe = async (hangoutId: string) => {
    setIsLoading(true);
    setError(null);
    setSuccess(false);

    try {
      const response = await axiosPrivateInstance.post<
        ServerResponse<{ message: string } | ServerErrorResponse>
      >(`/hangout/cancel/${hangoutId}`);

      const data = response.data;

      if (data.okay) {
        setSuccess(true);
        return data.message;
      } else {
        throw new Error(data.message);
      }
    } catch (err: any) {
      setError(err.message || "Failed to cancel the hangout.");
    } finally {
      setIsLoading(false);
    }
  };

  const cancelHangout = async (hangoutId: string) => {
    setIsLoading(true);
    setError(null);
    setSuccess(false);

    try {
      await new Promise((resolve) => setTimeout(resolve, 500));

      if (!hangoutId) {
        throw new Error("Invalid hangout ID.");
      }

      setSuccess(true);
      return "Hangout successfully canceled (mocked response).";
    } catch (err: any) {
      setError(err.message || "Failed to cancel the hangout.");
    } finally {
      setIsLoading(false);
    }
  };

  return {
    be: cancelHangoutbe,
    cancelHangout,
    isCancelHangoutLoading: isLoading,
    cancelHangoutError: error,
    success,
  };
};
