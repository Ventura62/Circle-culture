import { ControllerRenderProps, Path } from "react-hook-form";
import ClearButton from "./ClearButton";
import { InfoIconTooltip } from "./InfoIconTooltip";

const FieldsHeader = <T extends object>({
  field,
  label,
  toolTip,
  onChange,
  showClear,
  isRequired,
}: {
  field: ControllerRenderProps<T, Path<T>>;
  label?: string;
  toolTip?: string;
  onChange?: (val: unknown) => void;
  showClear?: boolean;
  isRequired?: boolean;
}) => {
  return (
    <>
      {showClear && <ClearButton field={field} externalChange={onChange} />}
      {label && (
        <label className="inputLabel" htmlFor={"input-" + field.name.replace(/\s+/g, "-")}>
          {label}
          {isRequired && <span className="text-red-500">*</span>}
        </label>
      )}

      {toolTip && <InfoIconTooltip className="ml-2" content={toolTip} />}
    </>
  );
};

export default FieldsHeader;
