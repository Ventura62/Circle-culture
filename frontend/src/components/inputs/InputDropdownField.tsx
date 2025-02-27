import { Control, Controller, FieldValues, Path } from "react-hook-form";
import { ReactNode } from "react";
import FieldsHeader from "./FieldsHeader";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { FlattenErrorMessages } from "@/utils/Errors";
import LoadingSpinner from "../shared/LoadingSpinner";
export function InputDropdownField<T, K extends FieldValues>({
  control,
  field: fieldName,
  label,
  toolTip,
  readOnly = false,
  options,
  onChange,
  placeHolder = undefined,
  showClear,
  isRequired,
  isLoading,
}: {
  control: Control<K>;
  onChange?: (value: string) => void;
  field: string;
  label: string;
  toolTip?: string;
  readOnly?: boolean;
  options: { label: string; value: T }[];
  listItemRender?: ReactNode | ((option: T) => ReactNode);
  placeHolder?: string;
  optionKey?: string;
  showClear?: boolean;
  isRequired?: boolean;
  isLoading?: boolean;
}) {
  return (
    <Controller
      name={fieldName as unknown as Path<K>}
      control={control}
      render={({ field, fieldState }) => (
        <>
          <FieldsHeader field={field} label={label} toolTip={toolTip} showClear={showClear} isRequired={isRequired} />
          <div>
            <Select
              disabled={readOnly}
              onValueChange={(value) => {
                if (onChange) {
                  onChange(JSON.parse(value));
                }
                field.onChange(JSON.parse(value));
              }}
              defaultValue={JSON.stringify(field.value)}
            >
              <SelectTrigger>
                <SelectValue placeholder={placeHolder} />
              </SelectTrigger>
              <SelectContent>
                {isLoading ? (
                  <LoadingSpinner />
                ) : (
                  options.map((item) => {
                    return (
                      <SelectItem key={JSON.stringify(item.value)} value={JSON.stringify(item.value)}>
                        {item.label}
                      </SelectItem>
                    );
                  })
                )}
              </SelectContent>
            </Select>
          </div>
          {fieldState.error && <span className="FieldError">{FlattenErrorMessages(fieldState.error).join(", ")}</span>}
        </>
      )}
    />
  );
}
