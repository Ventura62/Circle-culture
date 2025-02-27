import { useState } from "react";

import {
  Instagram,
  Linkedin,
  Mail,
  MapPin,
  UserIcon,
  PhoneIcon,
} from "lucide-react";
import InputWithIcons from "../InputWithIcon/InputWithIcon";
import { Switch } from "../ui/switch";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import { UserEditProfileForm, UserEditProfileSchema } from "@/models/User";
import ImageUploader from "../shared/ImageUploader/ImageUploader";

const EditProfileCard = () => {
  const [formData, setFormData] = useState({
    fullName: "Mariam Elsotohy",
    email: "username@hotmail.com",
    phoneNumber: "+1",
    location: "Address",
    linkedInProfile: "username linkedin",
    instagramProfile: "username insta",
    profilePicure: "",
  });

  const [readOnlyFields, setReadOnlyFields] = useState({
    fullName: true,
    email: true,
    phoneNumber: true,
    location: true,
  });

  const [emailNotification, setEmailNotification] = useState(false);
  const [isSubmitting, setSubmitting] = useState<boolean>(false);

  const defaultReport = {
    profilePicture: "",
    bio: "",
    fullName: "",
    email: "",
    phone: "",
    address: "",
    socialProfile: "",
    enableNotification: "",
    stats: "",
    joinDate: "",
  } as unknown as UserEditProfileForm;

  const { control, handleSubmit, reset, watch, setValue, formState } = useForm({
    defaultValues: defaultReport,
    resolver: zodResolver(UserEditProfileSchema),
  });

  const handleUploadPhoto = () => {};

  const handleEditField = (field: string) => {
    setReadOnlyFields((prevState: any) => ({
      ...prevState,
      [field]: !prevState[field],
    }));
  };

  const handleChange = (field: string) => (e: any) => {
    setFormData((prevState) => ({
      ...prevState,
      [field]: e.target.value,
    }));
  };
  const handleConfirm = () => {};

  const setCoverImage = (url: string) => {
    setFormData((prev) => ({
      ...prev,
      profilePicure: url as string,
    }));
  };

  return (
    <div className="min-w-full  p-6  ms-5 max-878:ms-0 mr-[8px]">
      <form
        onSubmit={handleSubmit(() => {
          setSubmitting(true);
          setTimeout(() => {
            setSubmitting(false);
          }, 1000);
        })}
        onReset={() => reset()}
        className="space-y-8 w-full max-w-[800px] min-w-[100px]"
      >
        <div className="flex flex-row  pb-5 gap-8 ">
          <div className="h-40 w-40 mx-auto mt-4">
            <ImageUploader
              image={formData.profilePicure}
              setImage={setCoverImage}
              type="Circle"
            />
          </div>

          <div className=" w-full">
            <p>Bio</p>
            <textarea
              className="w-full p-4 mt-2 bg-primary text-white border border-gray-600 rounded-lg"
              value="I’m not homeless, I promise!"
              style={{
                height: "120px",
                resize: "none",
              }}
            />
          </div>
        </div>

        <InputWithIcons
          control={control}
          field="fullName"
          label="Full Name"
          value={formData.fullName}
          startIcon={UserIcon}
        />

        <InputWithIcons
          control={control}
          field="email"
          label="Email Address"
          value={formData.email}
          startIcon={Mail}
        />

        <InputWithIcons
          control={control}
          field="phone"
          label="Phone Number"
          value={formData.phoneNumber}
          startIcon={PhoneIcon}
        />

        <InputWithIcons
          control={control}
          field="address"
          label="Location"
          value={formData.location}
          startIcon={MapPin}
        />

        {/* Socials */}
        <div className="flex flex-col">
          <h2 className="text-xl font-semibold pb-3">Social Profile*</h2>

          <InputWithIcons
            control={control}
            field="socialProfile.linkedin"
            label="LinkedIn Profile"
            value={formData.linkedInProfile}
            startIcon={Linkedin}
          />
          <InputWithIcons
            control={control}
            field="socialProfile.instagram"
            label="Instagram Profile"
            value={formData.instagramProfile}
            startIcon={Instagram}
          />
        </div>

        {/* Email and Terms */}
        <div>
          <div className="flex justify-between items-center">
            <label className="text-lg font-medium">Email Notification</label>
            <Switch
              checked={emailNotification}
              onCheckedChange={setEmailNotification}
            />
          </div>
          <div className="w-full pt-3 pl-10 bg-transparent border-b-2 border-gray-500 focus:border-white outline-none" />
          <div className="flex flex-col pt-6">
            <a
              href="/termsAndConditions"
              className="w-full pt-3 text-lg font-medium bg-transparent hover:text-blue-500 cursor-pointer"
            >
              Terms and conditions
            </a>
            <div className="w-full pt-6 pl-10 bg-transparent border-b-2 border-gray-500 focus:border-white outline-none" />
          </div>
        </div>

        <div className="flex flex-col items-center justify-center pt-4">
          <button
            type="submit"
            className="py-2.5 px-12 bg-secondary rounded-full border-2 border-secondary hover:bg-primary hover:text-[#466A97] w-full transition-all duration-200"
          >
            {isSubmitting ? "Confirming..." : "Confirm"}
          </button>
        </div>
      </form>
    </div>
  );
};

export default EditProfileCard;
