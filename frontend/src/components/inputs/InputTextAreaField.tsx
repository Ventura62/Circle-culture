import React from "react";
import { Control, Controller, FieldValues, Path } from "react-hook-form";
import FieldsHeader from "./FieldsHeader";
import { FlattenErrorMessages } from "@/utils/Errors";
import { Textarea } from "../ui/textarea";

export function InputTextAreaField<T extends FieldValues>({
  control,
  field,
  label,
  toolTip,
  readOnly = false,
  disabled = false,
  onBlur,
  onFocus,
  onChange,
  placeholder,
  showClear,
  isRequired,
}: {
  control: Control<T>;
  field: string;
  label?: string;
  toolTip?: string;
  readOnly?: boolean;
  disabled?: boolean;
  onBlur?: (e: string) => void;
  onFocus?: (e: string) => void;
  onChange?: (e: string) => void;
  placeholder?: string;
  mask?: string;
  showClear?: boolean;
  isRequired?: boolean;
}) {
  return (
    <Controller
      name={field as unknown as Path<T>}
      control={control}
      render={({ field, fieldState }) => (
        <>
          <FieldsHeader
            field={field}
            label={label}
            toolTip={toolTip}
            onChange={onChange as (val: unknown) => void}
            showClear={showClear}
            isRequired={isRequired}
          />
          <Textarea
            id={"input-" + field}
            autoComplete="off"
            value={field.value === null || field.value === undefined ? "" : field.value}
            onChange={(e) => {
              field.onChange(e.target.value);
              if (onChange) onChange(e.target.value);
            }}
            ref={field.ref}
            readOnly={readOnly === true}
            disabled={disabled === true}
            placeholder={placeholder}
            onFocus={(e) => onFocus && onFocus(e.target.value)}
            onBlur={(e) => {
              field.onBlur();
              if (onBlur) onBlur(e.target.value);
            }}
          />
          {fieldState.error && <span className="FieldError">{FlattenErrorMessages(fieldState.error).join(", ")}</span>}
        </>
      )}
    />
  );
}
