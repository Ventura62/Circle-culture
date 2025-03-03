import { useContext } from "react";
import Dropdown from "../shared/Dropdown/Dropdown";
import { z } from "zod";
import CreateCircleContext, {
    useCreateCircleContext,
} from "@/context/CreateCircleContext";

// Define the Zod Enum Directly
const CircleCategoryEnum = z.enum(["Category1", "Category2", "Category3"]);

// Infer the Type from Zod
type CircleCategoryType = z.infer<typeof CircleCategoryEnum>;

const Step3 = () => {
    const { formData, setFormData } = useCreateCircleContext();

    // Set Category Function
    const setCategory = (category: string | number) => {
        if (
            CircleCategoryEnum.options.includes(category as CircleCategoryType)
        ) {
            setFormData((prev) => ({
                ...prev,
                category: category as CircleCategoryType,
            }));
        }
    };

    return (
        <div className="w-full text-left flex flex-col gap-2">
            <h1 className="font-medium text-lg">Pick a Category</h1>
            <Dropdown
                title="Category"
                content={CircleCategoryEnum.options}
                value={formData.category}
                setValue={setCategory}
            />
        </div>
    );
};

export default Step3;
