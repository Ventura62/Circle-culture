import { format, parseISO, isValid } from "date-fns";


export function formatPhoneNumber(input: string | null): string | null {
  if (!input) return null;
  // Ensure input is only digits
  const desiredLength = 10;
  let formattedNumber = input.replace(/\D/g, "");

  // Check if the number is shorter than the desired length
  if (formattedNumber.length < desiredLength) {
    // Pad with '#' from the left
    formattedNumber = formattedNumber.padStart(desiredLength, "#");
  }

  // Insert formatting dashes for visual clarity
  // Adjust formatting according to how the number has been padded
  if (formattedNumber.includes("#")) {
    // Handling edge case where number includes '#'
    return formattedNumber.replace(/(#{0,3})(#{0,3})(#{0,4})$/, "$1-$2-$3");
  } else {
    // Typical formatting
    return formattedNumber.replace(/(\d{3})(\d{3})(\d{4})$/, "$1-$2-$3");
  }
}

export function toTitleCase(input: string): string {
  // Regular expression that finds characters following a space, underscore, or hyphen, or lowercase letters followed by uppercase letters
  const words = input.match(/[A-Z]+(?=[A-Z][a-z])|[A-Z]?[a-z]+|[A-Z]|[0-9]+/g);

  if (!words) {
    return input; // Return original input if no words are found (safety measure)
  }

  // Transform each word: capitalize the first letter and lower the rest
  const transformedWords = words.map((word) => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase());

  // Join all words with a space to create the title case string
  return transformedWords.join(" ");
}
export function toTitleCaseV2(input: string): string {
  // Regular expression that finds characters following a space, underscore, or hyphen, or lowercase letters followed by uppercase letters
  const words = input.match(/[A-Z]?[a-z]+|[A-Z]+(?=[A-Z][a-z])|[A-Z]+(?=[0-9])|[A-Z]+|[0-9]+/g);

  if (!words) {
    return input; // Return original input if no words are found (safety measure)
  }

  // Transform each word: capitalize the first letter and lower the rest
  const transformedWords = words.map((word) => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase());

  // Join all words with a space to create the title case string
  return transformedWords.join(" ");
}
export function toCamelCase(input: string): string {
  // Regular expression that finds characters following a space, underscore, or hyphen, or lowercase letters followed by uppercase letters
  const words = input.match(/[A-Z]+(?=[A-Z][a-z])|[A-Z]?[a-z]+|[A-Z]|[0-9]+/g);

  if (!words) {
    return input; // Return original input if no words are found (safety measure)
  }

  // Transform each word: capitalize the first letter and lower the rest
  const transformedWords = words.map(
    (word, index) => (index == 0 ? word.charAt(0).toLowerCase() : word.charAt(0).toUpperCase()) + word.slice(1).toLowerCase()
  );

  // Join all words with a space to create the title case string
  return transformedWords.join();
}
export function pathFormatter(path: string): string {
  const pathArray = path.split(".");
  return pathArray.map((path) => toTitleCase(path)).join(" > ");
}

export function describeSelectionConstraints(constraints: { minimum: number | null; maximum: number | null }): string {
  const { minimum, maximum } = constraints;
  if (minimum !== null && maximum !== null) {
    if (minimum === maximum) {
      return `exactly ${minimum}`;
    } else {
      return `between ${minimum} and ${maximum}`;
    }
  } else if (minimum !== null) {
    return `at least ${minimum}`;
  } else if (maximum !== null) {
    return `up to ${maximum}`;
  } else {
    return `any number of`;
  }
}

export function trimStringToWordBoundary(text: string, maxLength: number = 140, trailingIndicator: string = "..."): string {
  if (text.length <= maxLength) return text;

  // Find the index of the last space within the maxLength limit
  let lastSpaceIndex = text.substring(0, maxLength).lastIndexOf(" ");

  // If no space was found in the first maxLength characters, trim to maxLength
  if (lastSpaceIndex === -1) lastSpaceIndex = maxLength;

  // Trim string to the last space index and add ellipsis
  return text.substring(0, lastSpaceIndex) + trailingIndicator;
}

export function serialize(input: unknown): string {
  if (input == null || input == undefined) {
    return "";
  } else if (Array.isArray(input)) {
    // Use a Set to handle duplicates and map each element through the serialize function recursively
    const uniqueItems = new Set(input.map((item) => serialize(item)));
    return Array.from(uniqueItems).join(", ");
  } else if (typeof input === "object") {
    // Check for the specific keys in the order of 'value', 'name', 'label'
    const keys: string[] = ["value", "name", "label", "title", "description", "id", "displayName", "text", "key", "status", "summary", "content"];
    for (const key of keys) {
      if (key in input) {
        return String(input[key as keyof typeof input]);
      }
    }
    // If none of the specified keys exist, return "true" if the object is not null
    return "true";
  } else {
    // Convert primitive types to string
    return String(input);
  }
}

export function arrayToString(array: unknown[]): string | null {
  if (!array) return null;
  return array.join(", ");
}

export function shortenFilename(filename: string, maxLength: number): string {
  const parts = filename.split(".");
  let name, extension;

  if (parts.length < 2) {
    // No extension present
    name = filename;
    extension = "";
  } else {
    // Has extension
    extension = parts.pop()!;
    name = parts.join(".");
  }

  // Calculate the required length for the shortened name
  const shortenedNameLength = maxLength - extension.length - (extension ? 4 : 3); // 3 for "..." and 1 for the period before the extension, or just 3 for "..." if no extension

  if (shortenedNameLength <= 0) {
    return extension ? `${name[0]}...${extension}` : `${name[0]}...${name.slice(-1)}`;
  }

  const shortenedName = name.length > shortenedNameLength ? `${name.slice(0, shortenedNameLength)}...${name.slice(-1)}` : name;

  return extension ? `${shortenedName}.${extension}` : shortenedName;
}

export function transformKeys(obj: unknown): unknown {
  if (Array.isArray(obj)) {
    return obj.map(transformKeys);
  } else if (obj !== null && typeof obj === "object") {
    return Object.keys(obj).reduce((acc: Record<string, unknown>, key) => {
      const newKey = toTitleCaseV2(key);
      const value = obj[key as keyof typeof obj];
      acc[newKey] = transformKeys(value);
      return acc;
    }, {} as Record<string, unknown>);
  }
  return obj;
}

export const formattedDate = (data) => {
    const dateStr = data?.timeSlots?.[0]?.datetime;
    if (!dateStr) return "No date available";

    const date = parseISO(dateStr);
    if (!isValid(date)) {
        console.error("Invalid date:", dateStr);
        return "Invalid date";
    }

    return format(date, "MMM. d 'at' h a");
};


export const formatStatusToColors = (status: string) => {
    switch (status) {
        case "ACTIVE":
            return "after:bg-[#0EAD00]";
        case "CONFIRMED":
            return "after:bg-[#0EAD00]";
        case "ATTENDED":
            return "after:bg-[#0EAD00]";
        case "PENDING":
            return "after:bg-[#EEFF00]";
        default:
            return "after:bg-[#37577E]";
    }
}