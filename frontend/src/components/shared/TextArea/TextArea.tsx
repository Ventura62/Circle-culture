import { ChangeEventHandler } from "react";
import { FieldValues, Path, UseFormRegister, ValidationRule } from "react-hook-form";

type Props<T extends FieldValues> = {
    className?: string;
    title?: string;
    value?: string;
    onChange?: ChangeEventHandler<HTMLTextAreaElement>;
    label?: string;
    placeholder: string;
    maxLength?: number;
    disabled?: boolean;
    containerClassName?: string;
    name?: Path<T>;
    register?: UseFormRegister<T>;
    error?: string;
    required?: string | ValidationRule<boolean>;
};

const Textarea = <T extends FieldValues>({
                                             name,
                                             placeholder,
                                             register,
                                             required = false,
                                             error,
                                             className = "",
                                             onChange,
                                             value,
                                             containerClassName = "",
                                             disabled = false,
                                             title,
                                             maxLength,
                                         }: Props<T>) => {
    return (
        <div className={`${containerClassName} flex flex-col gap-2`}>
            {title && <h1 className="text-white text-l">{title}</h1>}
            <div
                className={`${className} flex flex-1 w-full flex-col gap-2 rounded-lg border border-white border-opacity-30 text-[#DDDDDD] text-opacity-50 p-3.5 transition-all duration-200`}
            >
                <textarea
                    {...(register && name ? register(name, { required }) : undefined)}
                    value={value}
                    disabled={disabled}
                    onChange={onChange}
                    placeholder={placeholder}
                    maxLength={maxLength}
                    className="text-white outline-none flex-1 bg-transparent placeholder:text-[#FFFFFF4D] placeholder:font-semibold placeholder:text-lg resize-none min-h-[100px]"
                />
            </div>
            {maxLength && (
                <p className="text-xs">
                    {value?.length}/{maxLength}
                </p>
            )}
            {error && <p className="text-red-600 text-xs font-medium">{error}</p>}
        </div>
    );
};

export default Textarea;
