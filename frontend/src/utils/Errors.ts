import { FieldError, FieldErrors } from "react-hook-form";
import axios from "axios";
import { toTitleCase } from "./Formatters";

export function FlattenErrorMessages(error: FieldError | FieldErrors): string[] {
  return doFlattenErrorMessages(error);
}
export function FlattenUnkeyedErrorMessages(error: FieldError | FieldErrors): string[] {
  return doFlattenErrorMessages(error, undefined, undefined);
}
export function FlattenKeyedErrorMessages(error: FieldError | FieldErrors, shownKeys: string[], showFieldNames: boolean = false): string[] {
  return doFlattenErrorMessages(error, showFieldNames, shownKeys);
}

function doFlattenErrorMessages(
  error: FieldError | FieldErrors,
  showFieldNames: boolean = false,
  shownKeys?: string[],
  fieldName?: string
): string[] {
  if (!error) return []; // Early return for undefined or null errors

  const messages: string[] = [];

  // Function to handle adding messages with or without field names
  function addMessage(message: string, fieldName?: string) {
    if (showFieldNames && fieldName) {
      messages.push(`${toTitleCase(fieldName)}: ${message}`);
    } else {
      messages.push(message);
    }
  }

  if ("message" in error && typeof error.message === "string") {
    // Check if this particular field's message should be shown
    if (!fieldName || shownKeys === undefined || shownKeys.some((key) => key.toLowerCase() === fieldName.toLowerCase())) {
      addMessage(error.message, fieldName);
    }
  } else {
    // Assume `error` is an object of errors or an array of errors
    Object.entries(error).forEach(([key, value]) => {
      if (Array.isArray(value)) {
        value.forEach((item) => messages.push(...doFlattenErrorMessages(item, showFieldNames, shownKeys, key)));
      } else if (typeof value === "object" && value !== null) {
        messages.push(...doFlattenErrorMessages(value, showFieldNames, shownKeys, key));
      }
    });
  }

  return messages;
}

export function parseAxiosError(err: unknown, defaultMsg?: string): string {
  let message = defaultMsg || "An error occurred";
  if (axios.isAxiosError(err)) {
    // Handle errors thrown as a result of axios
    if (err.response) {
      // Server responded with a status code that falls out of the range of 2xx
      message = err.response.data?.message || `Server responded with status: ${err.response.status}`;
    } else if (err.request) {
      // The request was made but no response was received
      message = "No response received from the server";
    } else {
      // Something happened in setting up the request that triggered an Error
      message = err.message;
    }
  } else if (err instanceof Error) {
    // Handle generic errors
    message = err.message;
  }
  return message;
}
