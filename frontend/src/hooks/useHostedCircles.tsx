import { useEffect, useState } from "react";
import { axiosPrivateInstance } from "@/config/axiosConfig";
import { ServerErrorResponse, ServerResponse } from "@/models/ServerResponse";
import {
  CircleCardGeneralInfo,
  CircleCardGeneralInfoSchema,
  CircleCategoryEnum,
  CircleCriteriaEnum,
  CreateCircleSchemaForm,
  HostCircleSchema,
  HostCircleSchemaT,
  HostCircleTimingsT,
} from "@/models/Circle";
import { useZodParser } from "@/hooks/useZodParser";

export const useGetUpcomingHostedCirclesBE = () => {
  const { triggerParser } = useZodParser();
  const [circles, setCircles] = useState<CircleCardGeneralInfo[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchCircles = async () => {
      setIsLoading(true);
      setError(null);
      try {
        const response = await axiosPrivateInstance.get<
          ServerResponse<CircleCardGeneralInfo[] | ServerErrorResponse>
        >("/circle/getUpcomingHostedCircles");

        const data = response.data;
        if (data.okay) {
          const parsedCircles = triggerParser(
            data.data,
            CircleCardGeneralInfoSchema.array(),
            "circle/getUpcomingHostedCircles",
            "get"
          ) as CircleCardGeneralInfo[];
          setCircles(parsedCircles);
        } else {
          throw new Error(data.message);
        }
      } catch (err: any) {
        setError(err.message || "Failed to fetch upcoming hosted circles.");
        setCircles([]);
      } finally {
        setIsLoading(false);
      }
    };

    fetchCircles();
  }, []);

  return { circles, isLoading, error };
};

export const useGetPreviousHostedCircles = () => {
  const { triggerParser } = useZodParser();
  const [circles, setCircles] = useState<CircleCardGeneralInfo[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchCircles = async () => {
      setIsLoading(true);
      setError(null);
      try {
        const response = await axiosPrivateInstance.get<
          ServerResponse<CircleCardGeneralInfo[] | ServerErrorResponse>
        >("/circle/getPreviousHostedCircles");

        const data = response.data;
        if (data.okay) {
          const parsedCircles = triggerParser(
            data.data,
            CircleCardGeneralInfoSchema.array(),
            "circle/getPreviousHostedCircles",
            "get"
          ) as CircleCardGeneralInfo[];
          setCircles(parsedCircles);
        } else {
          throw new Error(data.message);
        }
      } catch (err: any) {
        setError(err.message || "Failed to fetch previous hosted circles.");
        setCircles([]);
      } finally {
        setIsLoading(false);
      }
    };

    fetchCircles();
  }, []);

  return { circles, isLoading, error };
};

export const useGetUpcomingHostedCircles = () => {
  const [circles, setCircles] = useState<CircleCardGeneralInfo[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchMockCircles = async () => {
      setIsLoading(true);
      setError(null);

      try {
        await new Promise((resolve) => setTimeout(resolve, 800));

        const mockCircles: CircleCardGeneralInfo[] = [
          {
            id: "mock-1",
            name: "Mock Hosted Circle",
            category: "Category1",
            criteria: "male",
            description: "A great event for meeting new people!",
            image: "",
            price: 30,
            dateTime: new Date(),
            status: "CONFIRMED",
            country: "Mock Country",
            city: "Mock City",
            minAge: 18,
            maxAge: 35,
            rate: {
              stars: 4.8,
              reviewsCount: 56,
            },
          },
        ];

        setCircles(mockCircles);
      } catch (err) {
        setError("Failed to fetch mock upcoming hosted circles.");
        setCircles([]);
      } finally {
        setIsLoading(false);
      }
    };

    fetchMockCircles();
  }, []);

  return { circles, isLoading, error };
};

export const usePreviousHostedCircles = () => {
  const [circles, setCircles] = useState<CircleCardGeneralInfo[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchMockCircles = async () => {
      setIsLoading(true);
      setError(null);

      try {
        await new Promise((resolve) => setTimeout(resolve, 800));

        const mockCircles: CircleCardGeneralInfo[] = [
          {
            id: "mock-2",
            name: "Previous Hosted Event",
            category: "Category2",
            criteria: "female",
            description: "An amazing past event!",
            image: "",
            price: 20,
            dateTime: new Date(),
            status: "PAUSED",
            country: "Mock Country",
            city: "Mock City",
            minAge: 20,
            maxAge: 40,
            rate: {
              stars: 4.5,
              reviewsCount: 78,
            },
          },
        ];

        setCircles(mockCircles);
      } catch (err) {
        setError("Failed to fetch mock previous hosted circles.");
        setCircles([]);
      } finally {
        setIsLoading(false);
      }
    };

    fetchMockCircles();
  }, []);

  return { circles, isLoading, error };
};
export const useGetHostedCircleById = (circleId: string) => {
  const { triggerParser } = useZodParser();
  const [circle, setCircle] = useState<HostCircleSchemaT | null>(null);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    if (!circleId) return;

    const fetchCircle = async () => {
      setIsLoading(true);
      setError(null);

      try {
        const mockResponse: ServerResponse<HostCircleSchemaT> = {
          okay: true,
          data: {
            id: "mock-circle-123",
            name: "Mock Circle Event",
            category: "Category1",
            criteria: "male",
            description: "A great place to meet new people!",
            image: "",
            price: 25,
            country: "Mock Country",
            city: "Mock City",
            timeSlots: [
              {
                id: "slot-1",
                datetime: "2025-03-11T18:00:00Z",
                active: true,
                spotsFilled: 4,
              },
              {
                id: "slot-2",
                datetime: "2025-03-12T20:00:00Z",
                active: true,
                spotsFilled: 0,
              },
              {
                id: "slot-2",
                datetime: "2025-03-13T20:00:00Z",
                active: false,
                spotsFilled: 0,
              },
            ],
            minAge: 18,
            maxAge: 35,
            featuredReviews: [],
            rate: {
              stars: 4.5,
              reviewsCount: 32,
            },
          },
          message: "ok",
        };

        await new Promise((resolve) => setTimeout(resolve, 500));

        if (mockResponse.okay) {
          const parsedCircle = triggerParser(
            mockResponse.data,
            HostCircleSchema,
            "circle/getCircleInfo",
            "get"
          ) as HostCircleSchemaT;

          setCircle(parsedCircle);
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
export const useGetHostedCircleByIdBE = (circleId: string) => {
  const { triggerParser } = useZodParser();
  const [circle, setCircle] = useState<CircleCardGeneralInfo | null>(null);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    if (!circleId) return;

    const fetchCircle = async () => {
      setIsLoading(true);
      setError(null);

      try {
        const response = await axiosPrivateInstance.get<
          ServerResponse<CircleCardGeneralInfo | null | ServerErrorResponse>
        >(`/circle/getCircleInfo/${circleId}`);

        const data = response.data;
        if (data.okay) {
          const parsedCircle = triggerParser(
            data.data,
            CircleCardGeneralInfoSchema,
            "circle/getCircleInfo",
            "get"
          ) as CircleCardGeneralInfo;
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

export const useDeleteCircleBE = () => {
  const [isDeleting, setIsDeleting] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<boolean>(false);

  const deleteCircle = async (circleId: string) => {
    setIsDeleting(true);
    setError(null);
    setSuccess(false);

    try {
      const response = await axiosPrivateInstance.delete<
        ServerResponse<{ message: string }>
      >(`/circle/delete/${circleId}`);

      if (response.data.okay) {
        setSuccess(true);
      } else {
        throw new Error(response.data.message || "Failed to delete circle.");
      }
    } catch (err: any) {
      setError(err.message || "An error occurred while deleting the circle.");
    } finally {
      setIsDeleting(false);
    }
  };

  return { deleteCircle, isDeleting, error, success };
};
export const useDeleteCircle = () => {
  const [isDeleting, setIsDeleting] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<boolean>(false);

  const deleteCircle = async (circleId: string) => {
    setIsDeleting(true);
    setError(null);
    setSuccess(false);

    try {
      await new Promise((resolve) => setTimeout(resolve, 1000));

      if (circleId === "error") {
        throw new Error("Mocked API error: Unable to delete circle.");
      }

      setSuccess(true);
    } catch (err: any) {
      setError(err.message || "Failed to delete circle.");
    } finally {
      setIsDeleting(false);
    }
  };

  return { deleteCircle, isDeleting, error, success };
};

export const useEditCircle = () => {
  const [isEditing, setIsEditing] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<boolean>(false);

  const editCircle = async (
    circleId: string,
    {
      name,
      category,
      criteria,
      price,
      description,
    }: {
      name?: string;
      category: keyof typeof CircleCategoryEnum.Enum;
      criteria: keyof typeof CircleCriteriaEnum.Enum;
      price?: number;
      description?: string;
    }
  ) => {
    setIsEditing(true);
    setError(null);
    setSuccess(false);

    try {
      const response = await axiosPrivateInstance.put<
        ServerResponse<{ message: string }>
      >(`/circle/edit/${circleId}`, {
        name,
        category,
        criteria,
        price,
        description,
      });

      if (response.data.okay) {
        setSuccess(true);
      } else {
        throw new Error(response.data.message || "Failed to edit the circle.");
      }
    } catch (err: any) {
      setError(err.message || "An error occurred while editing the circle.");
    } finally {
      setIsEditing(false);
    }
  };

  return { editCircle, isEditing, error, success };
};

export const useEditCircleTimings = () => {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<boolean>(false);

  const editCircleTimings = async (
    circleId: string,
    timings: HostCircleTimingsT[]
  ) => {
    setIsLoading(true);
    setError(null);
    setSuccess(false);

    try {
      const response = await axiosPrivateInstance.post<ServerResponse<null>>(
        `/circle/updateTimings/${circleId}`,
        { timings }
      );

      if (response.data.okay) {
        setSuccess(true);
        return response.data.message || "Timings updated successfully!";
      } else {
        throw new Error(response.data.message || "Failed to update timings.");
      }
    } catch (error: any) {
      setError(error.message || "An error occurred while updating timings.");
      setSuccess(false);
      throw error;
    } finally {
      setIsLoading(false);
    }
  };

  return {
    editCircleTimings,
    isLoading,
    error,
    success,
  };
};
