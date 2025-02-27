import usePlacesService from "react-google-autocomplete/lib/usePlacesAutocompleteService";
import { useEffect } from "react";
import { AutocompletePrediction } from "react-places-autocomplete";
import { cn } from "@/lib/utils";

const MAP_SW_LAT = 36.992427;
const MAP_SW_LNG = -109.060256;
const MAP_NE_LAT = 41.003444;
const MAP_NE_LNG = -102.041524;

export const AddressPredictionField = ({
  searchAddress,
  addressParser,
  anchorRef,
}: {
  searchAddress: string | undefined;
  addressParser: (location: google.maps.places.PlaceResult | null) => void;
  anchorRef: React.RefObject<HTMLDivElement | null>;
}) => {
  const { placePredictions, getPlacePredictions, placesService } = usePlacesService({
    debounce: 500,
  });

  const setLocation = (locationId: string) => {
    placesService?.getDetails({ placeId: locationId }, (placeDetails: google.maps.places.PlaceResult | null) => addressParser(placeDetails));
  };

  useEffect(() => {
    if (searchAddress && searchAddress.length >= 3) {
      return getPlacePredictions({
        input: searchAddress,
        locationBias: new google.maps.LatLngBounds(new google.maps.LatLng(MAP_SW_LAT, MAP_SW_LNG), new google.maps.LatLng(MAP_NE_LAT, MAP_NE_LNG)),
        componentRestrictions: {
          country: "us",
        },
        types: ["address"],
      });
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [searchAddress]);

  return (
    <div className="absolute w-[100%]  z-20" role="menu" ref={anchorRef} tabIndex={0}>
      {searchAddress && (
        <div className="bg-white border border-gray-300 rounded-md shadow-md z-50">
          {placePredictions.map((prediction: AutocompletePrediction, index: number) => {
            return (
              <div
                role="menuitem"
                key={index}
                className={cn(
                  "p-2 cursor-pointer hover:bg-gray-100",
                  index === 0 ? "rounded-t-md" : index === placePredictions.length - 1 ? "rounded-b-md" : ""
                )}
                onClick={(e) => {
                  setLocation(prediction.place_id);
                  e.stopPropagation();
                }}
              >
                {prediction.description}
              </div>
            );
          })}
        </div>
      )}
    </div>
  );
};
