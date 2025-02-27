import { z } from "zod";
export const CircleCategoryEnum = z.enum(["Category1", "Category2", "Category3"]);
export const CircleCriteriaEnum = z.enum(["male", "female", "none"]);
export const CircleTypeEnum = z.enum(["PRIVATE", "PUBLIC"]);
export const CircleStatusEnum = z.enum(["PENDING", "REJECTED", "CONFIRMED"]);
export const PreviousCircleStatusEnum = z.enum(["ATTENDED", "REFUNDED"]);
export const HostedCircleStatusEnum = z.enum(["ACTIVE", "PAUSED"]);
export const GeneralCircleStatusEnum = z.enum([...CircleStatusEnum.options, ...PreviousCircleStatusEnum.options, ...HostedCircleStatusEnum.options]);

export const HostSchema = z.object({
  id: z.string().min(1),
  name: z.string().min(1),
  badge: z.string().optional(),
  image: z.string().optional(),
});

export const CircleReview = z.object({
  name: z.string().min(1),
  createdAt: z.string().date(),
  description: z.string().optional(),
  rate: z.number().max(5).min(0).default(0),
});

export const RateSchema = z.object({
  stars: z.number().max(5).min(0).default(0),
  reviewsCount: z.number().default(0),
});

export const RestaurantSchema = z.object({
  name: z.string().min(1),
  location: z.string().min(1),
  nameOnReservation: z.string().min(1),
});

const CircleGroupSchema = z.object({
  restaurant: RestaurantSchema.optional(),
  members: z.array(z.string()),
});

const CircleTimeSlotSchema = z.object({
  id: z.string(),
  dateTime: z.string().datetime(),
  isActive: z.boolean(),
  unassignedMembers: z.array(z.string()),
  groupA: CircleGroupSchema,
  groupB: CircleGroupSchema,
});

const CircleStates = z.object({
  rate: RateSchema,
  compatibilityScore: z.number().default(0),
  noShow: z.number().default(0),
  totalIncome: z.number().default(0),
});

export const PublicCircleSchema = z.object({
  id: z.string(),
  name: z.string().min(1).max(30),
  category: CircleCategoryEnum,
  criteria: CircleCriteriaEnum,
  description: z.string().max(250).optional(),
  image: z.string().optional(),
  host: HostSchema.optional(),
  price: z.number().min(0),
  country: z.string().min(2, "A valid country is required"),
  city: z.string().min(1, "A valid city is required"),
  timeSlots: z.array(
    z.object({
      id: z.string(),
      datetime: z.string().datetime(),
    })
  ),
  minAge: z.number().max(100).min(18).default(18),
  maxAge: z.number().max(100).min(18).default(18),
  featuredReviews: z.array(CircleReview),
  rate: RateSchema,
});

export const HostCircleTimingsSchema = z.object({
  id: z.string(),
  datetime: z.string().datetime(),
  active: z.boolean(),
  spotsFilled: z.number(),
});
export const HostCircleSchema = z.object({
  id: z.string(),
  name: z.string().min(1).max(30),
  category: CircleCategoryEnum,
  criteria: CircleCriteriaEnum,
  description: z.string().max(250).optional(),
  image: z.string().optional(),
  host: HostSchema.optional(),
  price: z.number().min(0),
  country: z.string().min(2, "A valid country is required"),
  city: z.string().min(1, "A valid city is required"),
  timeSlots: z.array(HostCircleTimingsSchema),
  minAge: z.number().max(100).min(18).default(18),
  maxAge: z.number().max(100).min(18).default(18),
  featuredReviews: z.array(CircleReview),
  rate: RateSchema,
});
export const CircleCardGeneralInfoSchema = z.object({
  id: z.string(),
  name: z.string().min(1).max(30),
  category: CircleCategoryEnum,
  criteria: CircleCriteriaEnum,
  description: z.string().max(250).optional(),
  image: z.string().optional(),
  price: z.number().default(0),
  dateTime: z.date(),
  status: GeneralCircleStatusEnum,
  country: z.string().min(2, "A valid country is required"),
  city: z.string().min(1, "A valid city is required"),
  minAge: z.number().max(100).min(18).default(18),
  maxAge: z.number().max(100).min(18).default(18),
  rate: RateSchema,
  location: RestaurantSchema.nullable().optional(),
});

const PendingCircleSchema = z.object({
  ...CircleCardGeneralInfoSchema.shape,
  status: z.literal("PENDING"),
});
const RejectedCircleSchema = z.object({
  ...CircleCardGeneralInfoSchema.shape,
  status: z.literal("REJECTED"),
});

const ConfirmedCircleSchema = z.object({
  ...CircleCardGeneralInfoSchema.shape,
  status: z.literal("CONFIRMED"),
  location: RestaurantSchema,
});

export const UpcomingCircleSchema = z.discriminatedUnion("status", [PendingCircleSchema, ConfirmedCircleSchema, RejectedCircleSchema], {});
export const PreviousCircleSchema = z.object({
  ...CircleCardGeneralInfoSchema.shape,
  status: PreviousCircleStatusEnum,
});

const HostedCircleSchema = z.object({
  ...CircleCardGeneralInfoSchema.shape,
  status: HostedCircleStatusEnum,
});

export const CreateCircleSchema = z.object({
  //step1
  city: z.string().min(1, "A valid city is required"),
  radius: z.number().default(10),
  //step2
  category: CircleCategoryEnum,
  //step3
  criteria: CircleCriteriaEnum,
  minAge: z.number().max(100).min(18).default(18),
  maxAge: z.number().max(100).min(18).default(18),
  //step4
  name: z.string().min(1).max(30),
  description: z.string().max(250).optional(),
  //step5
  ticketPrice: z.number().min(0),
  //step6
  firstSlot: z.string().datetime(),
  //step7
  image: z.string().optional(),
});

export type PublicCircle = z.infer<typeof PublicCircleSchema>;
export type CircleCardGeneralInfo = z.infer<typeof CircleCardGeneralInfoSchema>;
export type UpcomingCircles = z.infer<typeof UpcomingCircleSchema>;
export type CreateCircle = z.infer<typeof CreateCircleSchema>;
export type PreviousCircle = z.infer<typeof PreviousCircleSchema>;
export type GeneralCircleStatus = z.infer<typeof GeneralCircleStatusEnum>;
export type CreateCircleSchemaForm = z.infer<typeof CreateCircleSchema>;
export type CircleCategoryType = z.infer<typeof CircleCategoryEnum>;
export type CircleCriteriaType = z.infer<typeof CircleCriteriaEnum>;

export type CircleInfoCardT = Pick<
  PublicCircle,
  "id" | "name" | "city" | "timeSlots" | "description" | "minAge" | "maxAge" | "criteria" | "category" | "timeSlots" | "image"
>;

export type CircleReviewT = z.infer<typeof CircleReview>;
export type HostCircleSchemaT = z.infer<typeof HostCircleSchema>;
export type HostCircleTimingsT = z.infer<typeof HostCircleTimingsSchema>;
