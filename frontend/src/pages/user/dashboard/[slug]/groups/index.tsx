import { use, useState } from "react";
import Link from "next/link";
import { DateTimePicker } from "@/components/ui/date-time-picker";
import TabGroup from "@/components/shared/TabGroup/TabGroup";
import Dropdown from "@/components/shared/Dropdown/Dropdown";
import { ScrollArea } from "@/components/ui/scroll-area";
import { IoIosArrowBack } from "react-icons/io";
import { RiDraggable } from "react-icons/ri";
import { AiOutlineLinkedin, AiOutlineInstagram } from "react-icons/ai";
import { useRouter } from "next/router";
import { circlesData } from "@/hooks/useCreateCircle";
import {
  closestCorners,
  CollisionDetection,
  DndContext,
  DragEndEvent,
  DragOverlay,
  DragStartEvent,
  Modifier,
  MouseSensor,
  pointerWithin,
  rectIntersection,
  TouchSensor,
  useDraggable,
  useDroppable,
  useSensor,
  useSensors,
} from "@dnd-kit/core";
import {
  SortableContext,
  useSortable,
  verticalListSortingStrategy,
  arrayMove,
} from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";

type tParams = Promise<{ slug: string }>;

type Column = {
  id: "unassigned" | "group 1" | "group 2";
  title: string;
  index: number;
};

const columns: Column[] = [
  { id: "unassigned", title: "Bucket", index: -1 },
  { id: "group 1", title: "Group 1", index: 0 },
  { id: "group 2", title: "Group 2", index: 1 },
];

const allGuestsTest: Guest[] = [
  {
    id: "0",
    name: "Mariam Z.",
    socialMedia: "Instagram",
    link: "#",
    bucket: "unassigned",
  },
  {
    id: "1",
    name: "Ebra Y.",
    socialMedia: "LinkedIn",
    link: "#",
    bucket: "unassigned",
  },
  {
    id: "2",
    name: "Mahmoud R.",
    socialMedia: "Instagram",
    link: "#",
    bucket: "unassigned",
  },
  {
    id: "3",
    name: "Mahmoud R.",
    socialMedia: "LinkedIn",
    link: "#",
    bucket: "unassigned",
  },
  {
    id: "4",
    name: "Jacob J.",
    socialMedia: "Instagram",
    link: "#",
    bucket: "unassigned",
  },
  {
    id: "5",
    name: "Abdul R.",
    socialMedia: "LinkedIn",
    link: "#",
    bucket: "unassigned",
  },
];

type Guest = {
  id: string;
  name: string;
  socialMedia: "Instagram" | "LinkedIn";
  link: string;
  bucket: "unassigned" | "group 1" | "group 2";
};

const Groups = ({ params }: { params: tParams }) => {
  const router = useRouter();
  const { slug } = router.query;
  const circle = circlesData.find((circle) => circle.slug === slug);

  const tabs = ["Group 1", "Group 2"];
  const locations = Array.from({ length: 50 }).map(
    (_, i, a) => `TGI Fridays ${a.length - i}`
  );

  const [tabIndex, setTabIndex] = useState<number>(0);
  const [bucket, setBucket] = useState<Guest[]>(allGuestsTest);
  const [guests, setGuests] = useState<[Guest[], Guest[]]>([[], []]);
  const [allGuests, setAllGuests] = useState<Guest[]>(allGuestsTest);
  const [location1, setLocation1] = useState<string>(locations[0]);
  const [location2, setLocation2] = useState<string>(locations[0]);
  const [date, setDate] = useState<string>("");
  const [activeGuest, setActiveGuest] = useState<Guest | null>(null);

  // if (!circle) {
  //   return <p>Loading...</p>;
  // }

  const handleCardClick = (guest: Guest) => {
    const newBucket = bucket.filter((g) => g.name !== guest.name);
    setBucket(newBucket);

    const newGuests = [...guests] as [Guest[], Guest[]];
    newGuests[tabIndex] = [...newGuests[tabIndex], guest];
    setGuests(newGuests);
  };

  const handleRemove = (guest: Guest) => {
    const newGuests = [...guests] as [Guest[], Guest[]];
    newGuests[tabIndex] = newGuests[tabIndex].filter(
      (g) => g.name !== guest.name
    );
    setGuests(newGuests);

    setBucket([...bucket, guest]);
  };

  const getGuestPos = (id: string) =>
    allGuests.findIndex((guest) => guest.id === id);

  const handleDragStart = (event: DragStartEvent) => {
    const selected = allGuests[getGuestPos(event.active.id.toString())];
    // tabIndex === 1 && selected.bucket === "group 2" ? setTabIndex(0): undefined;
    setActiveGuest(selected);
    // document.body.style.setProperty("--disable-scroll", "1");
  };

  const handleDragEnd = (event: DragEndEvent) => {
    const { active, over } = event;

    if (!over) return;

    const guestId = active.id as string;
    const newBucket = over.id as Guest["bucket"];

    setAllGuests(() =>
      allGuests.map((guest) =>
        guest.id === guestId
          ? {
              ...guest,
              bucket: newBucket,
            }
          : guest
      )
    );

    setActiveGuest(null);

    // document.body.style.setProperty("--disable-scroll", "0");
  };

  const centerModifier: Modifier = ({
    transform,
    activeNodeRect,
    overlayNodeRect,
    activatorEvent,
  }) => {
    if (
      !activeNodeRect ||
      !activatorEvent ||
      !(activatorEvent instanceof MouseEvent)
    ) {
      return transform;
    }

    // Capture the mouse offset relative to the original element
    const offsetX = activatorEvent.clientX - activeNodeRect.left;
    const offsetY = activatorEvent.clientY - activeNodeRect.top;

    // Adjust for the new overlay node (dynamic size)
    const overlayWidth = overlayNodeRect?.width || activeNodeRect.width;
    const overlayHeight = overlayNodeRect?.height || activeNodeRect.height;

    return {
      ...transform,
      x: transform.x + offsetX - overlayWidth / 2,
      y: transform.y + offsetY - overlayHeight / 2,
    };
  };

  const sensors = useSensors(
    useSensor(TouchSensor, {
      activationConstraint: {
        delay: 10, // Small delay before dragging starts
        tolerance: 5, // Small movement allowed before activation
      },
    }),
    useSensor(MouseSensor)
  );

  const customCollisionDetection: CollisionDetection = (args) => {
    const collisions = pointerWithin(args); // Detect collisions with pointer
    if (!collisions.length) return rectIntersection(args); // Fallback to rect-based

    // Prioritize a specific bucket by ID (e.g., "bucket-1")
    const priorityBucketId = "unassigned"; // Change to your preferred bucket ID
    const prioritized = collisions.find(
      (collision) => collision.id === priorityBucketId
    );

    return prioritized ? [prioritized] : collisions; // If found, return it as the main collision
  };

  const customCollisionDetectionNew: CollisionDetection = (args) => {
    const { droppableContainers, pointerCoordinates } = args;
    if (!pointerCoordinates) return [];

    let currentTabIndex = -1; // Default tab index when no bucket is hovered

    // Live collision detection using getBoundingClientRect()
    const liveCollisions = droppableContainers
      .map((container, index) => {
        const bucketElement = document.getElementById(container.id.toString());
        if (!bucketElement) return null;

        const rect = bucketElement.getBoundingClientRect(); // Get real-time position

        // Check if pointer is inside the dynamically updated bounding box
        if (
          pointerCoordinates.x >= rect.left &&
          pointerCoordinates.x <= rect.right &&
          pointerCoordinates.y >= rect.top &&
          pointerCoordinates.y <= rect.bottom
        ) {
          currentTabIndex = index - 1; // Set tabIndex to the bucket index
          return { id: container.id, rect };
        }
        return null;
      })
      .filter(Boolean) as { id: string; rect: DOMRect }[];

    // Apply tabIndex to the hovered bucket
    droppableContainers.forEach((container, index) => {
      const bucketElement = document.getElementById(container.id.toString());
      if (bucketElement) {
        bucketElement.tabIndex = index === currentTabIndex ? 0 : -1;
      }
    });

    if (!liveCollisions.length) return rectIntersection(args); // Fallback to rect-based detection

    // Prioritize a specific bucket by ID (e.g., "unassigned")
    const priorityBucketId = "unassigned"; // Change to your preferred bucket ID
    const prioritized = liveCollisions.find(
      (collision) => collision.id === priorityBucketId
    );

    if (currentTabIndex !== -1) {
      setTabIndex(currentTabIndex);
    }

    return prioritized ? [prioritized] : liveCollisions; // If found, return it as the main collision
  };

  return (
    <div className="text-white flex flex-col mx-auto max-w-[68rem] pb-10 max-1100:mx-10 max-592:mx-4">
      <div className="flex items-start gap-2 mb-16 max-780:mb-8">
        <Link
          href={`/user/dashboard/${slug}`}
          type="button"
          className="hover:bg-opacity-10 p-1 rounded-md hover:bg-white"
        >
          <IoIosArrowBack size={32} />
        </Link>
        <div className="flex flex-col gap-2">
          <h1 className="text-3xl max-470:text-2xl">Edit Groups</h1>
          <p className="w-[26.25rem] max-592:w-auto max-592:-ml-12 max-592:mt-2">
            The guests in &quot;Confirmed Guests&quot; section will be
            automatically notified about the location 24hrs before the start
            time.
          </p>
        </div>
      </div>
      <DndContext
        sensors={sensors}
        onDragStart={handleDragStart}
        onDragEnd={handleDragEnd}
        collisionDetection={customCollisionDetectionNew}
      >
        <DragOverlay modifiers={[centerModifier]}>
          {activeGuest ? (
            <GuestCard
              guest={activeGuest}
              inBucket={activeGuest.bucket !== "unassigned"}
              handleCardClick={handleCardClick}
              handleRemove={handleRemove}
            />
          ) : null}
        </DragOverlay>
        <div className="flex items-start gap-9 max-780:flex-col">
          <div className="flex flex-[0.5] max-780:flex-1 max-780:w-full flex-col gap-9 ml-12 max-780:ml-0">
            <h1 className="text-2xl p-2 rounded-xl bg-opacity-45">
              {circle?.title} Hikers Dinner
            </h1>

            <div className="flex flex-col max-w-72 gap-2">
              <p>Select a date & time</p>
              <DateTimePicker
                className="bg-primary"
                value={date}
                onChange={setDate}
              />
            </div>

            <div className="min-w-64 max-780:flex-1 max-780:w-full">
              <h1 className="mb-2 text-lg">Unassigned</h1>
              {/* <ScrollArea className="border-1.5 border-white border-dashed rounded-lg h-[22.167rem] overflow-x-hidden max-780:min-h-24 max-h-fit p-3"> */}
              <Bucket
                zIndex={100}
                tabIndex={tabIndex}
                bucket={columns[0]}
                guests={allGuests.filter(
                  (guest) => guest.bucket === columns[0].id
                )}
                handleCardClick={handleCardClick}
                handleRemove={handleRemove}
              />
              {/* <SortableContext items={allGuests.filter((guest) => guest.bucket === columns[0].id)} strategy={verticalListSortingStrategy}>
                    <div ref={bucketRef} className="flex flex-col gap-3">
                      {allGuests.filter((guest) => guest.bucket === columns[0].id).map((guest) => (
                        <GuestCard
                          key={guest.id}
                          guest={guest}
                          inBucket
                          handleCardClick={handleCardClick}
                          handleRemove={handleRemove}
                        />
                      ))}
                    </div>
                  </SortableContext> */}
              {/* </ScrollArea> */}
            </div>
          </div>

          <TabGroup
            className="flex-1 !mt-0 max-780:!mx-0"
            tabs={tabs}
            tabIndex={tabIndex}
            setTabIndex={setTabIndex}
          >
            <div className="flex flex-col gap-4">
              <div className="flex flex-col max-w-72 gap-2">
                <p>Location</p>
                <Dropdown
                  className="!bg-primary !min-h-[3.25rem]"
                  title="Location"
                  content={locations}
                  value={location1}
                  setValue={(value) => setLocation1(value as string)}
                />
              </div>

              <div className="mt-5">
                <h1 className="text-lg mb-2">Confirmed Guests</h1>
                <Bucket
                  zIndex={90}
                  tabIndex={tabIndex}
                  bucket={columns[1]}
                  guests={allGuests.filter(
                    (guest) => guest.bucket === columns[1].id
                  )}
                  handleCardClick={handleCardClick}
                  handleRemove={handleRemove}
                />
                {/* <SortableContext items={allGuests.filter((guest) => guest.bucket === columns[1].id)} strategy={verticalListSortingStrategy}>
                  <div ref={group1Ref} className="border-1.5 border-white rounded-md p-3.5 flex flex-wrap gap-2.5">
                    {guests[0].length === 0 && (
                      <p className="mx-auto opacity-50 text-center">
                        There are no confirmed guests at the moment.
                      </p>
                    )}
                    {allGuests.filter((guest) => guest.bucket === columns[1].id).map((guest, index) => (
                      <GuestCard
                        key={index}
                        guest={guest}
                        handleCardClick={handleCardClick}
                        handleRemove={handleRemove}
                      />
                    ))}
                  </div>
                </SortableContext> */}
              </div>
            </div>
            <div className="flex flex-col gap-4">
              <div className="flex flex-col max-w-72 gap-2">
                <p>Location</p>
                <Dropdown
                  className="!bg-primary !min-h-[3.25rem]"
                  title="Location"
                  content={locations}
                  value={location2}
                  setValue={(value) => setLocation2(value as string)}
                />
              </div>

              <div className="mt-5">
                <h1 className="text-lg mb-2">Confirmed Guests</h1>
                <Bucket
                  zIndex={100}
                  tabIndex={tabIndex}
                  bucket={columns[2]}
                  guests={allGuests.filter(
                    (guest) => guest.bucket === columns[2].id
                  )}
                  handleCardClick={handleCardClick}
                  handleRemove={handleRemove}
                />
                {/* <SortableContext items={allGuests.filter((guest) => guest.bucket === columns[2].id)} strategy={verticalListSortingStrategy}>
                  <div ref={group2Ref} className="border-1.5 border-white rounded-md p-3.5 flex flex-wrap gap-2.5">
                    {guests[1].length === 0 && (
                      <p className="mx-auto opacity-50 text-center">
                        There are no confirmed guests at the moment.
                      </p>
                    )}
                    {allGuests.filter((guest) => guest.bucket === columns[2].id).map((guest, index) => (
                      <GuestCard
                        key={index}
                        guest={guest}
                        handleCardClick={handleCardClick}
                        handleRemove={handleRemove}
                      />
                    ))}
                  </div>
                </SortableContext> */}
              </div>
            </div>
          </TabGroup>
        </div>
      </DndContext>

      {/* <div className="flex flex-col gap-9 ml-12 max-780:ml-0">
            <div className="flex flex-col max-w-72 gap-2">
                <p>Select a date & time</p>
                <DateTimePicker className="bg-primary" value={date} onChange={setDate} />
            </div>

            <div className="flex items-start gap-6 max-780:flex-col">



            </div>
        </div> */}
    </div>
  );
};

type BucketProps = {
  bucket: Column;
  guests: Guest[];
  handleCardClick: (guest: Guest) => void;
  handleRemove: (guest: Guest) => void;
  zIndex: number;
  tabIndex: number;
};

const Bucket = ({
  handleCardClick,
  handleRemove,
  bucket,
  guests,
  zIndex,
  tabIndex,
}: BucketProps) => {
  const { setNodeRef } = useDroppable({
    id: bucket.id,
  });

  const style = {
    zIndex: zIndex,
  };

  return (
    <div
      ref={setNodeRef}
      style={style}
      id={bucket.id}
      className={`${
        bucket.index === -1 || tabIndex === bucket.index ? "bucket-visible" : ""
      } border-1.5 border-white rounded-md p-3.5 flex flex-wrap gap-2.5`}
    >
      {guests.length === 0 && (
        <p className="mx-auto opacity-50 text-center">
          There are no confirmed guests at the moment.
        </p>
      )}
      {guests.map((guest, index) => (
        <GuestCard
          key={index}
          guest={guest}
          handleCardClick={handleCardClick}
          handleRemove={handleRemove}
        />
      ))}
    </div>
  );
};

type GuestCardProps = {
  guest: Guest;
  inBucket?: boolean;
  handleCardClick: (guest: Guest) => void;
  handleRemove: (guest: Guest) => void;
};

const GuestCard = (props: GuestCardProps) => {
  const { attributes, listeners, setNodeRef, transform } = useDraggable({
    id: props.guest.id,
  });

  const style = transform
    ? {
        transform: `translate(${transform.x}px, ${transform.y}px)`,
      }
    : undefined;

  // const style = {
  //   transform: CSS.Transform.toString(transform)
  // }

  return (
    <div
      ref={setNodeRef}
      {...listeners}
      {...attributes}
      onClick={() =>
        props.inBucket ? props.handleCardClick(props.guest) : undefined
      }
      className={`${
        props.inBucket && "max-w-[240px]"
      } flex items-center justify-between flex-[1_1_49%] gap-4 max-h-fit p-4 hover:bg-[#393C3D] bg-primary rounded-lg cursor-pointer transition-all duration-200`}
      // style={style}
    >
      <div className="flex items-center justify-between gap-4">
        <RiDraggable
          onClick={() => props.handleRemove(props.guest)}
          size={28}
        />
        <h1 className="flex-1">{props.guest.name}</h1>
      </div>
      <Link href={props.guest.link}>
        {props.guest.socialMedia === "Instagram" ? (
          <AiOutlineInstagram size={24} />
        ) : (
          <AiOutlineLinkedin size={24} />
        )}
      </Link>
    </div>
  );
};

export default Groups;
