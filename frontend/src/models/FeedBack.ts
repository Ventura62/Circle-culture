import { z } from "zod";

export const CircleMemberFeedBackSchema = z.object({
  id: z.string(),
  name: z.string(),
  rate: z.number().max(4).min(0).default(2),
  reportDescription: z.string().optional(),
});

export const ActiveFeedBackSessionResponseSchema = z.object({
  id: z.string(),
  members: z.array(CircleMemberFeedBackSchema),
});

export const SubmitFeedBackDataSchema = z.object({
  rate: z.number().default(0),
  membersFeedBack: z.array(CircleMemberFeedBackSchema),
  publicReview: z.string().optional(),
  privateReview: z.string().optional(),
});

export type ActiveFeedBackSessionResponse = z.infer<
  typeof ActiveFeedBackSessionResponseSchema
>;

export type SubmitFeedBackData = z.infer<typeof SubmitFeedBackDataSchema>;

export type CircleMemberFeedBack = z.infer<typeof CircleMemberFeedBackSchema>;
export type FeedBackOptionsT = {
  emoji: React.ElementType;
  label: string;
  value: number;
};
