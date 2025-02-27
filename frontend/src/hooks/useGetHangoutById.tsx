import { useEffect, useState } from "react";
import { axiosPrivateInstance } from "@/config/axiosConfig";
import { ServerResponse, ServerErrorResponse } from "@/models/ServerResponse";
import { useZodParser } from "./useZodParser";
import {
  CircleCardGeneralInfoSchema,
  CircleCardGeneralInfo,
} from "@/models/Circle";

export const useGetHangoutById = (hangoutId: string) => {
  const { triggerParser } = useZodParser();
  const [hangout, setHangout] = useState<CircleCardGeneralInfo | null>(null);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    if (!hangoutId) return;

    const fetchMockHangout = async () => {
      setIsLoading(true);
      setError(null);

      try {
        const mockResponse: ServerResponse<CircleCardGeneralInfo> = {
          okay: true,
          data: {
            id: "mock-hangout-123",
            name: "Mock Hangout Event",
            category: "Category1",
            criteria: "male",
            description: "A fun place to hang out!",
            image: "",
            price: 20,
            dateTime: new Date(),
            status: "PENDING",
            country: "Mock Country",
            city: "Mock City",
            minAge: 18,
            maxAge: 35,
            rate: { stars: 4.5, reviewsCount: 32 },
          },
          message: "ok",
        };

        await new Promise((resolve) => setTimeout(resolve, 500)); // Simulated delay

        if (mockResponse.okay) {
          const parsedHangout = triggerParser(
            mockResponse.data,
            CircleCardGeneralInfoSchema,
            "hangout/getHangoutInfo",
            "get"
          ) as CircleCardGeneralInfo;

          setHangout(parsedHangout);
        } else {
          throw new Error("Mocked API error");
        }
      } catch (err: any) {
        setError(err.message || "Failed to fetch hangout info.");
        setHangout(null);
      } finally {
        setIsLoading(false);
      }
    };

    fetchMockHangout();
  }, [hangoutId]);

  return { hangout, isLoading, error };
};

export const useGetHangoutByIdWHENBEISREADY = (hangoutId: string) => {
  const { triggerParser } = useZodParser();
  const [hangout, setHangout] = useState<CircleCardGeneralInfo | null>(null);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    if (!hangoutId) return;

    const fetchHangout = async () => {
      setIsLoading(true);
      setError(null);

      try {
        const response = await axiosPrivateInstance.get<
          ServerResponse<CircleCardGeneralInfo | null | ServerErrorResponse>
        >(`/hangout/getHangoutInfo/${hangoutId}`);

        const data = response.data;
        if (data.okay) {
          const parsedHangout = triggerParser(
            data.data,
            CircleCardGeneralInfoSchema,
            "hangout/getHangoutInfo",
            "get"
          ) as CircleCardGeneralInfo;
          setHangout(parsedHangout);
        } else {
          throw new Error(data.message);
        }
      } catch (err: any) {
        setError(err.message || "Failed to fetch hangout info.");
        setHangout(null);
      } finally {
        setIsLoading(false);
      }
    };

    fetchHangout();
  }, [hangoutId]);

  return { hangout, isLoading, error };
};
