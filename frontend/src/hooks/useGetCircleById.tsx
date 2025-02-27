import { useEffect, useState } from "react";
import { useZodParser } from "./useZodParser";
import { axiosPrivateInstance } from "@/config/axiosConfig";
import { ServerErrorResponse, ServerResponse } from "@/models/ServerResponse";
import { PublicCircle, PublicCircleSchema } from "@/models/Circle";
import CircleImage from "@/assets/images/circle-image-test.png";

export const useGetCircleByIdWHENBACKENDISDONE = (circleId: string) => {
  const { triggerParser } = useZodParser();
  const [circle, setCircle] = useState<PublicCircle | null>(null);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    if (!circleId) return;

    const fetchCircle = async () => {
      setIsLoading(true);
      setError(null);

      try {
        const response = await axiosPrivateInstance.get<ServerResponse<PublicCircle | null | ServerErrorResponse>>(
          `/circle/getCircleInfo/${circleId}`
        );

        const data = response.data;
        if (data.okay) {
          const parsedCircle = triggerParser(data.data, PublicCircleSchema, "circle/getCircleInfo", "get") as PublicCircle;
          setCircle(parsedCircle);
        } else {
          throw new Error(data.message);
        }
      } catch (err: any) {
        setError(err.message || "Failed to fetch circle info.");
        setCircle(null);
      } finally {
        setIsLoading(false);
      }
    };
    if (!circle) fetchCircle();
  }, [circleId]);

  return { circle, isLoading, error };
};

export const useGetCircleById = (circleId: string) => {
  const { triggerParser } = useZodParser();
  const [circle, setCircle] = useState<PublicCircle | null>(null);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    if (!circleId) return;

    const fetchCircle = async () => {
      setIsLoading(true);
      setError(null);

      try {
        const mockResponse: ServerResponse<PublicCircle> = {
          okay: true,
          data: {
            id: "mock-circle-123",
            name: "Mock Circle Event",
            category: "Category1",
            criteria: "male",
            description:
              "Tired of everyone in the Bay Area asking, “So, what do you do?” before they even learn your name? Yeah, same. This is dinner, not a LinkedIn convention. No business cards, no pitches, no networking; just real conversations with real people!",
            image: CircleImage.src ?? "",
            host: {
              id: "host-456",
              name: "Mock Host",
              image: "",
            },
            price: 25,
            country: "Mock Country",
            city: "Mock City",
            timeSlots: [
              { id: "slot-1", datetime: "2025-03-10T18:00:00Z" },
              { id: "slot-2", datetime: "2025-03-12T20:00:00Z" },
            ],
            minAge: 18,
            maxAge: 35,
            featuredReviews: [
              {
                name: "Mohamed Salem",
                description: "An exciting circle and i met lots of people",
                rate: 3,
                createdAt: "2025-03-12T20:00:00Z",
              },
              {
                name: "Mohamed Salem",
                description: "An exciting circle and i met lots of people",
                rate: 3,
                createdAt: "2025-03-12T20:00:00Z",
              },
              {
                name: "Mohamed Salem",
                description: "An exciting circle and i met lots of people",
                rate: 3,
                createdAt: "2025-03-12T20:00:00Z",
              },
              {
                name: "Mohamed Salem",
                description: "An exciting circle and i met lots of people",
                rate: 3,
                createdAt: "2025-03-12T20:00:00Z",
              },
              {
                name: "Mohamed Salem",
                description: "An exciting circle and i met lots of people",
                rate: 3,
                createdAt: "2025-03-12T20:00:00Z",
              },
              {
                name: "Mohamed Salem",
                description: "An exciting circle and i met lots of people",
                rate: 3,
                createdAt: "2025-03-12T20:00:00Z",
              },
              {
                name: "Mohamed Salem",
                description: "An exciting circle and i met lots of people",
                rate: 3,
                createdAt: "2025-03-12T20:00:00Z",
              },
              {
                name: "Mohamed Salem",
                description: "An exciting circle and i met lots of people",
                rate: 3,
                createdAt: "2025-03-12T20:00:00Z",
              },
            ],
            rate: {
              stars: 4.5,
              reviewsCount: 32,
            },
          },
          message: "ok",
        };

        await new Promise((resolve) => setTimeout(resolve, 500));

        if (mockResponse.okay) {
          // const parsedCircle = triggerParser(
          //   mockResponse.data,
          //   PublicCircleSchema,
          //   "circle/getCircleInfo",
          //   "get"
          // ) as PublicCircle;

          setCircle(mockResponse.data);
        } else {
          throw new Error("Mocked API error: Unable to fetch circle info");
        }
      } catch (err: any) {
        setError(err.message || "Failed to fetch circle info.");
        setCircle(null);
      } finally {
        setIsLoading(false);
      }
    };

    fetchCircle();
  }, [circleId]);

  return { circle, isLoading, error };
};
