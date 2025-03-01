import { ChangeEventHandler, HTMLInputTypeAttribute } from "react";
import {
  FieldValues,
  Path,
  UseFormRegister,
  ValidationRule,
} from "react-hook-form";

type Props<T extends FieldValues> = {
  className?: string;
  title?: string;
  type: HTMLInputTypeAttribute | undefined;
  value?: string | number;
  onChange?: ChangeEventHandler<HTMLInputElement>;
  label?: string;
  placeholder: string;
  maxLength?: number;
  prefix?: string;
  suffix?: string;
  flex?: boolean;
  disabled?: boolean;
  containerClassName?: string;
  name?: Path<T>;
  register?: UseFormRegister<T>;
  pattern?: {
    value: RegExp;
    message: string;
  };
  error?: string;
  required?: string | ValidationRule<boolean>;
};

const Input = <T extends FieldValues>({
  type = "text",
  name,
  placeholder,
  register,
  required = false,
  pattern,
  error,
  className = "",
  onChange,
  value,
  containerClassName = "",
  disabled = false,
  flex,
  label,
  maxLength,
  prefix,
  suffix,
  title,
}: Props<T>) => {
  return (
    <div
      className={`${containerClassName} ${
        !flex ? "flex-col items-start" : "items-center"
      } relative flex gap-2`}
    >
      <h1>{title}</h1>
      <div
        className={`${label && "pt-2"} ${className} ${
          !disabled && "hover:bg-[#393C3D]"
        } flex flex-1 w-full flex-col gap-2 rounded-lg border border-white border-opacity-30 text-[#DDDDDD] text-opacity-50 p-3.5 transition-all duration-200`}
      >
        {label && <p className="text-xs">{label}</p>}
        <div className="flex items-center justify-start gap-2 overflow-hidden">
          {prefix && <span>{prefix}</span>}
          <input
            {...(register && name
              ? register(name, { required, pattern })
              : undefined)}
            type={type}
            value={value === 0 ? "" : value}
            disabled={disabled}
            onChange={onChange}
            placeholder={placeholder}
            maxLength={maxLength}
            className="outline-none flex-1 bg-transparent placeholder:text-[#FFFFFF4D] placeholder:font-semibold placeholder:text-lg"
          />
        </div>
      </div>
      {suffix && <span className="text-sm ">{suffix}</span>}
      {maxLength && (
        <p className="text-xs relative left-1 top-1">
          {(value as string).length}/{maxLength}
        </p>
      )}
      {error && (
        <p className={`text-red-600 text-xs font-medium left-2`}>{error}</p>
      )}
    </div>
  );
};

export default Input;
