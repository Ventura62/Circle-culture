import { FlattenErrorMessages } from "@/utils/Errors";
import { Control, Controller, FieldValues, Path } from "react-hook-form";
import {
    Select,
    SelectTrigger,
    SelectContent,
    SelectItem,
} from "@/components/ui/select";
import { US, GB, EG } from "country-flag-icons/react/3x2";
import { useState } from "react";

const countryOptions = [
    {
        name: "United States",
        icon: <US title="United States" className="w-6 h-6 inline-flex mr-1" />,
        code: "+1",
    },
    {
        name: "United Kingdom",
        icon: (
            <GB title="United Kingdom" className="w-6 h-6 inline-flex mr-1" />
        ),
        code: "+44",
    },
    {
        name: "Egypt",
        icon: <EG title="Egypt" className="w-6 h-6 inline-flex mr-1" />,
        code: "+20",
    },
];

export function InputPhone<T extends FieldValues>({
    control,
    field,
    label,
    value,
    onChange,
    placeholder,
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
    endIcon?: React.ElementType;
    type?: string;
    errorMessage?: string;
    endIconOnPress?: () => void;
    onInputFocus?: () => void;
    onEditPress?: () => void;
    readonly?: boolean;
}) {
    const [country, setCountry] = useState(null);

    return (
        <div className="mb-4">
            {label && <label className="text-[16px]">{label}</label>}
            <Controller
                name={field as unknown as Path<T>}
                control={control}
                render={({ field, fieldState }) => (
                    <div className="relative">
                        <div className="flex items-center border-b-2 border-gray-500 focus-within:border-white">
                            <Select value={country} onValueChange={setCountry}>
                                <SelectTrigger className="w-fit border-none bg-transparent">
                                    <div className="flex flex-col justify-start">
                                        {!country && countryOptions[0].icon}
                                        {country &&
                                            countryOptions.filter(
                                                (c) => c.code === country
                                            )[0].icon}
                                    </div>
                                </SelectTrigger>
                                <SelectContent className="!bg-primary border-white/10">
                                    {countryOptions.map((country, index) => (
                                        <SelectItem
                                            key={index}
                                            value={country.code}
                                            className="hover:!bg-white/10 focus:!bg-white/10"
                                        >
                                            {country.icon}
                                            {country.code}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            <div className="relative w-full flex flex-col -ml-4">
                                <input
                                    ref={field.ref}
                                    type={type}
                                    value={field.value ?? ""}
                                    onChange={(e) => {
                                        const newValue = e.target.value;
                                        if (/^\+?\d*$/.test(newValue)) {
                                            field.onChange(newValue);
                                            if (onChange) onChange(newValue);
                                        }
                                    }}
                                    placeholder={
                                        placeholder ??
                                        countryOptions.filter(
                                            (c) => c.code === country
                                        )[0].code
                                    }
                                    onFocus={() =>
                                        onInputFocus && onInputFocus()
                                    }
                                    readOnly={readonly}
                                    id={"input-" + field.name}
                                    autoComplete="off"
                                    className="w-full py-2 pl-4 bg-transparent outline-none"
                                />
                                {fieldState.error && (
                                    <p className="text-red-500">
                                        {FlattenErrorMessages(
                                            fieldState.error
                                        ).join(", ")}
                                    </p>
                                )}
                            </div>
                            {EndIcon && (
                                <button
                                    type="button"
                                    className="absolute right-2 top-4.5 transform -translate-y-1/2 text-gray-400"
                                    onClick={endIconOnPress}
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
                            <p className="text-red-500 text-sm">
                                {errorMessage}
                            </p>
                        )}
                    </div>
                )}
            />
        </div>
    );
}

export default InputPhone;
