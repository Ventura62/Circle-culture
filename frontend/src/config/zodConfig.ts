import { z } from "zod";

const customErrorMap: z.ZodErrorMap = (issue) => {
  if (issue.code == "too_small")
    return {
      message: `Must contain at least
      ${issue.minimum} element${issue.minimum !== 1 ? "s": ""}`,
    };
  if (issue.code == "too_big")
    return {
      message: `
    Must contain at most ${issue.maximum} element${issue.maximum !== 1 ? "s": ""}`,
    };
  return { message: "This field is required" };
};

z.setErrorMap(customErrorMap);

export { z };
