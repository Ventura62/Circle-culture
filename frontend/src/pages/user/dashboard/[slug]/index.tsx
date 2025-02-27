import Link from "next/link";
import Input from "@/components/shared/Input/Input";
import Dropdown from "@/components/shared/Dropdown/Dropdown";
import { use, useEffect, useState } from "react";
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import { Button } from "@/components/ui/button";
import { faChevronLeft, faTrashCan } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useRouter } from "next/router";
import {
  useDeleteCircle,
  useEditCircle,
  useGetHostedCircleById,
} from "@/hooks/useHostedCircles";
import { CircleCategoryEnum, CircleCriteriaEnum } from "@/models/Circle";
import { SubmitHandler, useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import TrashIcon from "@/assets/images/TrashIcon";

type tParams = Promise<{ slug: string }>;

interface EditCircleForm {
  name: string;
  price: number;
  // category: string;
  // genders: string;
}

const items = [
  "Food",
  "Politics",
  "Sports",
  "Relationships",
  "Work",
  "Artists",
];
const circleId = "id of circle";
const CircleInfo = ({ params }: { params: tParams }) => {
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
  } = useForm<EditCircleForm>();

  const router = useRouter();
  const { slug } = router.query;
  const { circle, isLoading, error } = useGetHostedCircleById(circleId);
  const {
    deleteCircle,
    isDeleting,
    error: deleteError,
    success,
  } = useDeleteCircle();
  const {
    editCircle,
    isEditing,
    error: editError,
    success: editSuccess,
  } = useEditCircle();

  // console.log(JSON.stringify(circle));
  const [name, setName] = useState<string | undefined>(circle?.name);
  const [price, setPrice] = useState<number | null | undefined>(circle?.price);
  const [category, setCategory] = useState<
    keyof typeof CircleCategoryEnum.Enum | null | undefined
  >("Category1");
  const [criteria, setCriteria] = useState<
    keyof typeof CircleCriteriaEnum.Enum | null | undefined
  >(circle?.criteria);
  useEffect(() => {
    if (circle) {
      setName(circle.name);
      setPrice(circle.price);
      setCategory(circle.category);
      setCriteria(circle.criteria);
    }
  }, [circle]);

  const handleEditCircle = async () => {
    await editCircle(circleId, {
      category: category as keyof typeof CircleCategoryEnum.Enum,
      criteria: criteria as keyof typeof CircleCriteriaEnum.Enum,
      name: name,
      price: price ?? 1,
      description: "descript",
    });
  };

  const onSubmit: SubmitHandler<EditCircleForm> = async (data) => {
    return new Promise<void>((resolve) => {
      setTimeout(() => {
        console.log("Form submitted:", data);
        resolve();
      }, 2000);
    });
  };

  if (!circle) {
    return <p>Loading...</p>;
  }

  return (
    <div className="text-white mx-auto max-w-[68rem] pb-10 max-1100:mx-10 max-592:mx-4">
      <div className="flex items-center justify-between mb-10 max-878:flex-col max-878:gap-4 max-878:items-start">
        <div className="flex items-center gap-2">
          <Link
            href="/user/dashboard"
            type="button"
            className="hover:bg-opacity-10 p-1 rounded-md hover:bg-white"
          >
            <FontAwesomeIcon icon={faChevronLeft} />
          </Link>
          <h1 className="text-3xl max-470:text-2xl">Edit Your Circle</h1>
        </div>

        {/* Edit Option Side Buttons */}
        <div className="flex items-center gap-6 max-878:flex-1 max-878:mx-auto">
          <Link
            href={`/user/dashboard/${slug}/times`}
            className="text-center w-[130px] text-[11px] py-2 px-3 border-1.5 border-white rounded-md hover:bg-white hover:text-primary transition-all duration-200"
          >
            Edit Event Times
          </Link>
          <Link
            href={`/user/dashboard/${slug}/locations`}
            className="text-center w-[130px] text-[11px] py-2 px-3 border-1.5 border-white rounded-md hover:bg-white hover:text-primary transition-all duration-200"
          >
            Edit Locations
          </Link>
          <Link
            href={`/user/dashboard/${slug}/groups`}
            className="text-center w-[130px] text-[11px] py-2 px-3 border-1.5 border-white rounded-md hover:bg-white hover:text-primary transition-all duration-200"
          >
            Edit Groups
          </Link>
          <AlertDialog>
            <AlertDialogTrigger asChild>
              <Button
                type="button"
                className="flex bg-transparent items-center gap-2 w-fit h-12 text-lg text-[#EF2F2F] hover:text-red-700 mt-2 -ml-2"
              >
                {" "}
                <TrashIcon />
                <span className="text-[#EF2F2F]">Delete</span>
              </Button>
            </AlertDialogTrigger>
            <AlertDialogContent className="!bg-primary !text-white">
              <AlertDialogHeader>
                <AlertDialogTitle className="text-center">
                  Are you sure you want to delete this Circle?
                </AlertDialogTitle>
                <AlertDialogDescription className="text-center text-base">
                  This will permanently remove all reviews and history linked to
                  this Circle.
                </AlertDialogDescription>
              </AlertDialogHeader>
              <AlertDialogFooter className="!flex !items-center !justify-between gap-9 !mt-4 !font-normal">
                <AlertDialogCancel
                  type="button"
                  className="flex-1 !py-5 !border-1.5 border-white !bg-transparent rounded-full hover:!text-primary hover:!bg-white hover:!shadow-md-centered hover:shadow-white"
                >
                  Cancel
                </AlertDialogCancel>
                <AlertDialogAction
                  className="flex-1 !py-5 !border-1.5 border-secondary !bg-secondary rounded-full !text-white hover:!text-secondary hover:!bg-transparent hover:!shadow-md-centered hover:shadow-secondary"
                  onClick={() => deleteCircle(circleId)}
                  disabled={isDeleting}
                  type="button"
                >
                  {isDeleting ? "Deleting..." : "Delete Circle"}
                </AlertDialogAction>
              </AlertDialogFooter>
            </AlertDialogContent>
          </AlertDialog>
        </div>
      </div>

      <div>
        <form
          className="flex flex-col gap-4 max-w-[28rem]"
          onSubmit={handleSubmit(onSubmit)}
        >
          <Input
            register={register}
            required="Circle Name is Required"
            error={errors.name?.message}
            name="name"
            className="!bg-primary !w-full"
            type="text"
            placeholder="Circle Name"
            title="Circle Name"
          />
          <Input
            register={register}
            required="Price is Required"
            error={errors.price?.message}
            name="price"
            className="bg-primary !w-full"
            type="number"
            prefix="USD"
            placeholder="Price"
            title="Price"
          />
          <div className="w-full text-left flex flex-col gap-2">
            <h1>Category</h1>
            <Dropdown
              className="!bg-primary"
              title="Category"
              content={items}
              value={category ?? ""}
              setValue={(value) =>
                setCategory(value as keyof typeof CircleCategoryEnum.Enum)
              }
            />
          </div>
          <div className="w-full text-left flex flex-col gap-2">
            <h1>Genders</h1>
            <Dropdown
              className="!bg-primary"
              title="Genders"
              content={Object.values(CircleCriteriaEnum.Enum)}
              value={criteria ?? ""}
              setValue={(value) =>
                setCriteria(value as keyof typeof CircleCriteriaEnum.Enum)
              }
            />
          </div>

          <button
            type="submit"
            disabled={isSubmitting}
            className="py-2.5 mt-10 px-12 bg-secondary hover:shadow-md-centered shadow-secondary rounded-full border-2 border-secondary hover:bg-transparent hover:text-secondary disabled:!opacity-20 disabled:hover:shadow-none disabled:hover:text-white disabled:hover:bg-secondary transition-all duration-200"
          >
            {isSubmitting ? "Saving..." : "Save"}
          </button>
        </form>
      </div>
    </div>
  );
};

export default CircleInfo;
