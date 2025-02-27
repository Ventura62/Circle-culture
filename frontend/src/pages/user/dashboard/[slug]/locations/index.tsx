import { use, useState } from "react";
import Link from "next/link";
import { IoIosArrowBack } from "react-icons/io";
import Input from "@/components/shared/Input/Input";
import { useRouter } from "next/router";
import { circlesData } from "@/hooks/useCreateCircle";

type tParams = Promise<{ slug: string }>;

const locations = [
  {
    id: 0,
    restaurantName: "",
    address: "",
    nameOnReservation: "",
  },
  {
    id: 1,
    restaurantName: "",
    address: "",
    nameOnReservation: "",
  },
];

const Locations = ({ params }: { params: tParams }) => {
  const router = useRouter();
  const { slug } = router.query;
  const circle = circlesData.find((circle) => circle.slug === slug);

  if (!circle) {
    return <p>Loading...</p>;
  }

  return (
    <div className="text-white mx-auto max-w-[68rem] max-1100:mx-10 max-592:mx-4">
      <div className="flex items-center gap-2 mb-10">
        <Link
          href={`/user/dashboard/${slug}`}
          type="button"
          className="hover:bg-opacity-10 p-1 rounded-md hover:bg-white"
        >
          <IoIosArrowBack size={32} />
        </Link>
        <h1 className="text-3xl max-470:text-2xl">Edit Locations</h1>
      </div>

      <div className="flex flex-wrap gap-4">
        {locations.map((location, index) => (
          <LocationCard key={index} location={location} />
        ))}
      </div>
    </div>
  );
};

interface LocationCard {
  id: number;
  restaurantName: string;
  address: string;
  nameOnReservation: string;
}

const LocationCard = ({ location }: { location: LocationCard }) => {
  const [restaurantName, setRestaurantName] = useState<string>(
    location.restaurantName
  );
  const [address, setAddress] = useState<string>(location.address);
  const [nameOnReservation, setNameOnReservation] = useState<string>(
    location.nameOnReservation
  );

  return (
    <div className="flex-[1_1_46%]">
      <h1 className="text-xl mb-4">Location {location.id + 1}</h1>
      <div className="flex flex-col items-stretch justify-between bg-primary border-1.5 border-white border-opacity-30 rounded-md p-4">
        <Input
          className="w-full"
          type="text"
          value={restaurantName}
          onChange={(e) => setRestaurantName(e.target.value)}
          placeholder="Restaurant Name"
        />
        <Input
          className="w-full"
          type="text"
          value={address}
          onChange={(e) => setAddress(e.target.value)}
          placeholder="Address"
        />
        <Input
          className="w-full"
          type="text"
          value={nameOnReservation}
          onChange={(e) => setNameOnReservation(e.target.value)}
          placeholder="Name on Reservation"
        />
      </div>
    </div>
  );
};

export default Locations;
