import { FlattenErrorMessages } from "@/utils/Errors";
import { Control, Controller, FieldValues, Path } from "react-hook-form";

export function InputWithIcons<T extends FieldValues>({
  control,
  field,
  label,
  value,
  onChange,
  placeholder,
  startIcon: StartIcon,
  endIcon: EndIcon,
  type = "text",
  errorMessage,
  endIconOnPress,
  onInputFocus,
  onEditPress,
  readonly = false,
}: {
  control: Control<T>;
  field: string;
  label?: string;
  value: string;
  onChange?: (e: string) => void;
  placeholder?: string;
  startIcon?: React.ElementType;
  endIcon?: React.ElementType;
  type?: string;
  errorMessage?: string;
  endIconOnPress?: () => void;
  onInputFocus?: () => void;
  onEditPress?: () => void;
  readonly?: boolean;
}) {
  return (
    <div className="mb-4 ">
      {label && <label className="text-[16px] ">{label}</label>}{" "}
      <Controller
        name={field as unknown as Path<T>}
        control={control}
        render={({ field, fieldState }) => (
          <div className="relative">
            <div className="flex items-center gap-2">
              {StartIcon && (
                <StartIcon
                  size={20}
                  className="!text-gray-400 c absolute left-2 top-2.5"
                />
              )}

              <div className="relative w-full flex flex-col">
                <input
                  ref={field.ref}
                  type={type}
                  value={
                    field.value === null || field.value === undefined
                      ? ""
                      : field.value
                  }
                  onChange={(e) => {
                    field.onChange(e.target.value);
                    if (onChange) onChange(e.currentTarget.value);
                  }}
                  placeholder={placeholder}
                  onFocus={() => {
                    if (onInputFocus) onInputFocus;
                  }}
                  readOnly={readonly}
                  id={"input-" + field}
                  autoComplete="off"
                  className="max-470:w-full py-2 pl-10 bg-transparent border-b-2 border-gray-500 focus:border-white outline-none"
                />
                {fieldState.error && (
                  <p className="text-red-500">
                    {FlattenErrorMessages(fieldState.error).join(", ")}
                  </p>
                )}
              </div>
              {EndIcon && (
                <button
                  type="button"
                  className="absolute right-2 top-4.5 transform -translate-y-1/2 text-gray-400"
                  onClick={() => {
                    if (endIconOnPress) {
                      endIconOnPress();
                    }
                  }}
                >
                  <EndIcon size={20} />
                </button>
              )}
              {onEditPress && (
                <button
                  onClick={(e) => {
                    e.stopPropagation();
                    onEditPress();
                  }}
                  className="absolute right-2 bottom-2 text-white py-2 px-6 rounded-lg border border-white font-semibold hover:text-black hover:bg-white transition-all duration-200"
                >
                  Edit
                </button>
              )}
            </div>
            {errorMessage && (
              <p className="text-red-500 text-sm">{errorMessage}</p>
            )}
          </div>
        )}
      />
    </div>
  );
}

export default InputWithIcons;
