import * as z from "zod";

export const UserAccessLevelSchema = z.enum([
  "Guest",
  "User",
  "Admin",
  "UNVERIFIED_USER",
]);

export const UserStats = z.object({
  circlesAttended: z.number().default(0),
  peopleMet: z.number().default(0),
  circlesHosted: z.number().default(0),
  peopleConnected: z.number().default(0),
});

export const UserScore = z.object({
  overall: z.number().default(0),
  great: z.number().default(0),
  good: z.number().default(0),
  reliability: z.number().default(0),
});

export const UserSchema = z.object({
  id: z.string().min(1),
  fullName: z.string().min(1),
  score: UserScore,
  bio: z.string().optional(),
  email: z.string().email().optional(),
  profilePicture: z.string().optional(),
  phone: z.string().min(1),
  accessLevel: UserAccessLevelSchema,
  address: z.string().min(1),
  gender: z.string().optional(),
  dob: z.string().optional(),
  enableNotification: z.boolean().optional(),
  stats: UserStats,
  socialProfile: z
    .object({
      linkedin: z.string().optional(),
      instagram: z.string().optional(),
    })
    .refine((data) => {
      if (!data.linkedin && !data.instagram) {
        return false;
      }
      return true;
    }),
  lastLogon: z.date().optional(),
  joinDate: z.date(),
});

export const UserPublicProfileSchema = UserSchema.pick({
  fullName: true,
  profilePicture: true,
  address: true,
  bio: true,
  stats: true,
  socialProfile: true,
  joinDate: true,
});

export const UserEditProfileSchema = UserSchema.pick({
  profilePicture: true,
  bio: true,
  fullName: true,
  email: true,
  phone: true,
  address: true,
  socialProfile: true,
  enableNotification: true,
  stats: true,
  joinDate: true,
});

export const UserEditPasswordSchema = z
  .object({
    currentPassword: z.string().min(8),
    newPassword: z.string().min(8),
    passwordConfirmation: z.string().min(8),
  })
  .superRefine(({ newPassword, passwordConfirmation }, ctx) => {
    if (newPassword !== passwordConfirmation) {
      ctx.addIssue({
        code: "custom",
        message: "The passwords did not match",
        path: ["passwordConfirmation"],
      });
    }
  });
export const UserSignUpSchema = z.object({
  fullName: z.string().min(1, "Full Name is required"),
  email: z.string().email("Invalid email address"),
  phone: z.string().min(1, "Phone number is required"),
  address: z.string().min(1, "Address is required"),
  gender: z.string().optional(),
  dob: z.string().optional(),
  profilePicture: z.string().optional(),
  bio: z.string().optional(),
  socialProfile: z
    .object({
      linkedin: z.string().optional(),
      instagram: z.string().optional(),
    })
    .optional(),
});
export type UserAccessLevel = z.infer<typeof UserAccessLevelSchema>;
export type User = z.infer<typeof UserSchema>;
export type PublicUser = z.infer<typeof UserPublicProfileSchema>;
export type UserEditProfileForm = z.infer<typeof UserEditProfileSchema>;
export type UserEditPasswordForm = z.infer<typeof UserEditPasswordSchema>;
export type UserSignUpForm = z.infer<typeof UserSignUpSchema>;
