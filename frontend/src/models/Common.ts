import * as z from "zod";

export interface Identifiable {
  id: string;
}

export const DATA_TYPE_DROPDOWN = [
  { label: "String", value: "STRING" },
  { label: "Number", value: "NUMBER" },
  { label: "Boolean", value: "BOOLEAN" },
  { label: "Date", value: "DATE" },
  { label: "Time", value: "TIME" },
  { label: "Date Time", value: "DATETIME" },
];

export const YES_NO_DROPDOWN = [
  { label: "Yes", value: true },
  { label: "No", value: false },
];

export const PhoneSchema = z.object({
  number: z.string(),
  type: z.string(),
  permissionToText: z.boolean(),
});
export const OptionalPhoneSchema = z.object({
  number: z.string().nullish(),
  type: z.string().nullish(),
  permissionToText: z.boolean().nullish(),
});

export const ValidatedPhoneSchema = z.object({
  number: z.string().min(10, "A valid phone number is required"),
  type: z.string().min(2, "A valid phone type is required"),
  permissionToText: z.boolean(),
});

export type ValidatedPhone = z.infer<typeof ValidatedPhoneSchema>;

export type Phone = z.infer<typeof PhoneSchema>;

export type OptionalPhone = z.infer<typeof OptionalPhoneSchema>;

export type DataType = "string" | "number" | "boolean" | "date" | "time" | "datetime";

export const DataTypeEnumSchema = z.enum(["STRING", "NUMBER", "BOOLEAN", "DATE", "TIME", "DATETIME"]);

export interface ErrorWithMessage {
  message?: string;
}

export const AddressSchema = z.object({
  address: z.string().min(5, "A valid address is required"),
  city: z.string().min(1, "A valid city is required"),
  state: z.string().min(1, "A valid state is required"),
  country: z.string().min(2, "A valid country is required"),
  zip: z.string().min(5, "A valid zip code is required").max(5, "A valid zip code is required").optional(),
  county: z.string().min(2, "A valid county is required").optional(),
});

export type Address = z.infer<typeof AddressSchema>;
