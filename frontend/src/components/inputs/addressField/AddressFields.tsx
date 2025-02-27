import React, { useRef, useState } from "react";
import { InputTextField } from "../InputTextField";
import { AddressPredictionField } from "./AddressPredictionField";
import { Control, Path, PathValue, UseFormSetValue } from "react-hook-form";
import { Libraries, useJsApiLoader } from "@react-google-maps/api";

export type AddressPaths = {
  cityPaths: string[];
  statePaths: string[];
  zipPaths: string[];
  countyPaths: string[];
  countryPaths: string[];
};

const libraries: Libraries = ["places"];

const AddressField = <T extends object>({
  control,
  setValue,
  addressDependantPaths,
  mainAddressClassName,
  disable,
  label,
  field,
  placeHolder,
  toolTip,
  showClear,
  isRequired,
}: {
  control: Control<T>;
  setValue?: UseFormSetValue<T>;
  addressDependantPaths?: AddressPaths;
  placeHolder?: string;
  mainAddressClassName?: string;
  secondaryAddressClassName?: string;
  cityClassName?: string;
  stateClassName?: string;
  zipClassName?: string;
  countyClassName?: string;
  countryClassName?: string;
  disable?: boolean;
  label?: string;
  field: string;
  toolTip?: string;
  showClear?: boolean;
  isRequired?: boolean;
}) => {
  const [searchAddress, setSearchAddress] = useState<string | undefined>(undefined);
  const dependantFieldValues: AddressPaths | undefined = addressDependantPaths;
  const refApf = useRef<HTMLDivElement>(null);

  const { isLoaded, loadError } = useJsApiLoader({
    id: "google-map-script",
    googleMapsApiKey: process.env.NEXT_GOOGLE_MAPS_API_KEY || "",
    libraries: libraries,
  });

  const addressParser = (placeDetails: google.maps.places.PlaceResult | null) => {
    const address = placeDetails?.address_components;
    if (!address || !dependantFieldValues || !setValue) return;
    const street = address.find((item) => item.types.includes("street_number"));
    const streetName = address.find((item) => item.types.includes("route"));
    const city = address.find((item) => item.types.includes("locality"));
    const state = address.find((item) => item.types.includes("administrative_area_level_1"));
    const zip = address.find((item) => item.types.includes("postal_code"));
    const county = address.find((item) => item.types.includes("administrative_area_level_2"));
    const country = address.find((item) => item.types.includes("country"));

    const setValuesData = (paths: string[], value: string) => {
      paths.forEach((path) => setValue(path as Path<T>, value as PathValue<T, Path<T>>, { shouldDirty: true, shouldValidate: true }));
    };
    setValuesData([field], `${street?.long_name || ""} ${streetName?.long_name || ""}`);
    dependantFieldValues.cityPaths?.forEach((path) => setValuesData([path], city?.long_name || ""));
    dependantFieldValues.statePaths?.forEach((path) => setValuesData([path], state?.long_name || ""));
    dependantFieldValues.zipPaths?.forEach((path) => setValuesData([path], zip?.long_name || ""));
    dependantFieldValues.countyPaths?.forEach((path) => setValuesData([path], county?.long_name || ""));
    dependantFieldValues.countryPaths?.forEach((path) => setValuesData([path], country?.long_name || ""));
    setSearchAddress(undefined);
  };

  const onAddressAreaBlur = (e: React.FocusEvent<HTMLDivElement>) => {
    if (!refApf.current?.contains(e.relatedTarget as Node)) {
      setSearchAddress(undefined);
    }
  };

  return (
    <div onBlur={onAddressAreaBlur} role="button" className={" relative w-[100%] " + mainAddressClassName}>
      <InputTextField<T>
        placeholder={placeHolder}
        label={label}
        control={control}
        field={field}
        toolTip={toolTip}
        onFocus={(e) => setSearchAddress(e)}
        onChange={(e) => setSearchAddress(e)}
        disabled={disable || !isLoaded || loadError ? true : false}
        showClear={showClear}
        isRequired={isRequired}
      />
      {isLoaded && !loadError && <AddressPredictionField searchAddress={searchAddress} addressParser={addressParser} anchorRef={refApf} />}
    </div>
  );
};

export default AddressField;
