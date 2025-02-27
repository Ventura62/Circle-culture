import { useEffect, useState } from 'react';
import { useZodParser } from './useZodParser';
import {
  UpcomingCircleSchema,
  PublicCircle,
  UpcomingCircles,
  CircleCategoryEnum,
  CircleCriteriaEnum,
  GeneralCircleStatusEnum
} from '@/models/Circle';
import { ServerErrorResponse, ServerResponse } from '@/models/ServerResponse';
import { axiosPrivateInstance } from '@/config/axiosConfig';

export const useGetUpcomingCircleHangoutsWHENBACKENDISDONE = () => {
  const { triggerParser } = useZodParser();
  const [upcomingCircles, setUpcomingCircles] = useState<UpcomingCircles[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchUpcomingCircles = async () => {
      setIsLoading(true);
      setError(null);

      try {
        const response =
          await axiosPrivateInstance.get<ServerResponse<UpcomingCircles[] | ServerErrorResponse>>(
            '/circle/getUpcomingCircles'
          );

        const data = response.data;
        if (data.okay) {
          //   const parsedCircles = triggerParser(
          //     data.data,
          //     UpcomingCircleSchema,
          //     "circle/getUpcomingCircles",
          //     "get"
          //   ) as UpcomingCircles[];
          // setUpcomingCircles(parsedCircles);
        } else {
          throw new Error(data.message);
        }
      } catch (err: any) {
        setError(err.message || 'Failed to fetch upcoming circles.');
        setUpcomingCircles([]);
      } finally {
        setIsLoading(false);
      }
    };

    fetchUpcomingCircles();
  }, []);

  return { upcomingCircles, isLoading, error };
};

export const useGetUpcomingCircleHangouts = () => {
  const { triggerParser } = useZodParser();
  const [upcomingCircles, setUpcomingCircles] = useState<UpcomingCircles[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchUpcomingCircles = async () => {
      setIsLoading(true);
      setError(null);

      try {
        const mockResponse: ServerResponse<UpcomingCircles[]> = {
          okay: true,
          data: [
            {
              id: 'circle_001',
              name: 'Hiking Enthusiasts',
              category: CircleCategoryEnum.Values.Category1,
              criteria: CircleCriteriaEnum.Values.male,
              description: 'Join us for amazing hiking adventures in nature!',
              image: 'https://example.com/hiking.jpg',
              price: 10,
              dateTime: new Date('2025-03-15T10:00:00Z'),
              status: GeneralCircleStatusEnum.Values.PENDING,
              country: 'US',
              city: 'San Francisco',
              minAge: 18,
              maxAge: 50,
              rate: { stars: 4.5, reviewsCount: 120 }
            },
            {
              id: 'circle_002',
              name: 'Tech Innovators',
              category: CircleCategoryEnum.Values.Category2,
              criteria: CircleCriteriaEnum.Enum.male,
              description: 'A circle for tech enthusiasts to share ideas and network.',
              image: 'https://example.com/tech.jpg',
              price: 0,
              dateTime: new Date('2025-04-01T18:30:00Z'),
              status: GeneralCircleStatusEnum.Enum.CONFIRMED,
              location: {
                name: 'hotel ',
                location: 'aaaa location',
                nameOnReservation: 'nada '
              },
              country: 'UK',
              city: 'London',
              minAge: 21,
              maxAge: 45,
              rate: { stars: 4.5, reviewsCount: 120 }
            },
            {
              id: 'circle_003',
              name: 'Book Lovers Club',
              category: CircleCategoryEnum.Values.Category3,
              criteria: CircleCriteriaEnum.Values.none,
              description: 'A cozy circle for book discussions and recommendations.',
              image: 'https://example.com/books.jpg',
              price: 5,
              dateTime: new Date('2025-02-25T15:00:00Z'),
              status: GeneralCircleStatusEnum.Values.REJECTED,
              country: 'CA',
              city: 'Toronto',
              minAge: 18,
              maxAge: 60,
              rate: { stars: 4.5, reviewsCount: 120 }
            }
          ],

          message: 'ok'
        };

        await new Promise((resolve) => setTimeout(resolve, 500));

        if (mockResponse.okay) {
          //   const parsedCircles = triggerParser(
          //     mockResponse.data,
          //     UpcomingCircleSchema,
          //     "circle/getUpcomingCircles",
          //     "get"
          //   ) as UpcomingCircles[];

          setUpcomingCircles(mockResponse.data);
        } else {
          throw new Error('Mocked API error: Unable to fetch upcoming circles');
        }
      } catch (err: any) {
        setError(err.message || 'Failed to fetch upcoming circles.');
        setUpcomingCircles([]);
      } finally {
        setIsLoading(false);
      }
    };

    fetchUpcomingCircles();
  }, []);

  return { upcomingCircles, isLoading, error };
};
