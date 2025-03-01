import Dropdown from "../shared/Dropdown/Dropdown";
import { SlLocationPin } from "react-icons/sl";
import { Slider } from "../ui/slider";
import { useCreateCircleContext } from "@/context/CreateCircleContext";
const Step2 = () => {
    const { formData, setFormData } = useCreateCircleContext();
    const locations = Array.from({ length: 50 }).map(
        (_, i, a) => `Los Angeles.${a.length - i}`
    );

    const setCity = (value: string | number) => {
        setFormData((prev) => ({
            ...prev,
            city: value as string,
        }));
    };

    const setValue = (value: number) => {
        setFormData((prev) => ({
            ...prev,
            radius: value,
        }));
    };

    return (
        <div className="text-center flex flex-col items-center gap-8 font-medium">
            <div className="w-full text-left flex flex-col gap-2">
                <h1 className="font-medium text-lg">
                    Select a city for your Circle:
                </h1>
                <Dropdown
                    placeholder
                    title="City"
                    content={locations}
                    value={formData.city}
                    setValue={setCity}
                />
            </div>

            <div className="w-full text-left flex flex-col gap-2">
                <h1 className="font-medium text-lg">
                    What radius should attendees be within to join your Circle?
                </h1>
                <p className="mb-7">Maximum distance</p>
                <div className="flex flex-col items-start justify-end gap-0.5 h-8">
                    {formData.radius >= 3 && (
                        <SlLocationPin size={24} className="relative -left-3" />
                    )}
                    <Slider
                        defaultValue={[formData.radius]}
                        min={0}
                        max={100}
                        step={1}
                        onValueChange={(val) => setValue(val[0])}
                    />
                </div>
            </div>
        </div>
    );
};

export default Step2;
