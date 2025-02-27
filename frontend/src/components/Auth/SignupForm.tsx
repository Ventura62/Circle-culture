import { UserSignUpForm, UserSignUpSchema } from "@/models/User";
import { zodResolver } from "@hookform/resolvers/zod";
import React, { useState } from "react";
import { useForm } from "react-hook-form";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import { useRouter } from "next/router";
import { Switch } from "../ui/switch";
import {
  UserIcon,
  Mail,
  PhoneIcon,
  MapPin,
  Linkedin,
  Instagram,
  Calendar,
} from "lucide-react";
import InputWithIcons from "../InputWithIcon/InputWithIcon";
import ImageUploader from "../shared/ImageUploader/ImageUploader";
import Dropdown from "../shared/Dropdown/Dropdown";
import { CircleCriteriaEnum } from "@/models/Circle";
import { RadioGroup, RadioGroupItem } from "../ui/radio-group";
import { Label } from "../ui/label";
import AccountSubHeader from "../shared/AccountSubHeader/AccountSubHeader";

const SignupForm = () => {
  const { userActions } = useLocalUserContext();
  const { signup } = userActions;
  const router = useRouter();
  const [emailNotification, setEmailNotification] = useState(false);
  const [ambition, setAmbition] = useState("");
  const [lifeStatus, setLifeStatus] = useState("");
  const [formData, setFormData] = useState({
    fullName: "",
    email: "",
    phoneNumber: "+1",
    location: "",
    linkedInProfile: "",
    instagramProfile: "",
    profilePicure: "",
    gender: "",
    dob: "",
  });

  const { control, handleSubmit, reset } = useForm<UserSignUpForm>({
    resolver: zodResolver(UserSignUpSchema),
    defaultValues: {
      fullName: "",
      email: "",
      phone: "",
      address: "",
      gender: "",
      dob: "",
      profilePicture: "",
      bio: "",
      socialProfile: { linkedin: "", instagram: "" },
    },
  });
  const [isSubmitting, setSubmitting] = useState<boolean>(false);

  const submitForm = async (data: UserSignUpForm) => {
    try {
      setSubmitting(true);
      await signup(data);
      router.replace("/unverified/profilePending");
      console.log("Signup successful!");
      setSubmitting(false);
    } catch (error) {
      console.error("Signup failed:", error);
    }
  };
  const setCoverImage = (url: string) => {
    setFormData((prev) => ({
      ...prev,
      profilePicure: url as string,
    }));
  };
  const handleUploadPhoto = () => {};
  const extractedValues = Object.values(CircleCriteriaEnum)
    .filter((item) => item && typeof item === "object" && "values" in item)
    .map((item) => item.values)[0];
  return (
    <div className="md:px-14  pb-14 ">
      <AccountSubHeader title="Sign Up" enableBackPress />
      <form
        onSubmit={handleSubmit(submitForm)}
        onReset={() => reset()}
        className="space-y-8 px-6 md:px-0 w-full md:mt-10 max-w-[800px] min-w-[100px]"
      >
        <div className="flex flex-row  gap-[30px] pb-10 max-592:flex-col">
          <div className="h-40 w-40 mx-auto md:mx-6">
            <ImageUploader
              image={formData.profilePicure}
              setImage={setCoverImage}
              type="Circle"
            />
          </div>
          <div className="flex flex-col w-full mt-10 md:mt-0 gap-3 md:gap-6">
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
            <Dropdown
              placeholder
              title="Gender"
              content={extractedValues}
              value={formData.gender}
              setValue={(selectedValue) =>
                setFormData({ ...formData, gender: selectedValue as string })
              }
              className="!bg-darkGray mb-2"
            />

            <InputWithIcons
              control={control}
              field="dob"
              label="Date of birth"
              value={formData.dob}
              startIcon={Calendar}
            />
            {/* Socials */}
            <div className="flex flex-col ">
              <div className="flex flex-row text-center gap-2">
                <h2 className="text-[16px]  pb-3">Social Profile </h2>
                {"  "}
                <p>(at least 1 profile is required)</p>
              </div>
              <InputWithIcons
                control={control}
                field="socialProfile.linkedin"
                value={formData.linkedInProfile}
                startIcon={Linkedin}
              />
              <InputWithIcons
                control={control}
                field="socialProfile.instagram"
                value={formData.instagramProfile}
                startIcon={Instagram}
              />
            </div>
            <div className="w-full mt-2 text-left flex flex-col gap-2">
              <h1 className="text-[16px]">
                How do you approach life right now?{" "}
              </h1>
              <RadioGroup
                value={ambition}
                onValueChange={setAmbition}
                className="flex flex-col   md:flex-row gap-2"
              >
                <div className="flex items-center space-x-2">
                  <RadioGroupItem
                    value="amb"
                    id="visibility-visible"
                    className={`${
                      ambition === "amb" &&
                      "border-secondary border-opacity-100"
                    }`}
                  />
                  <Label htmlFor="visibility-visible" className="text-textDark">
                    Ambitious & driven
                  </Label>
                </div>
                <div className="flex items-center space-x-2">
                  <RadioGroupItem
                    value="easy"
                    id="visibility-hidden"
                    className={`${
                      ambition === "easy" &&
                      "border-secondary border-opacity-100 "
                    }`}
                  />
                  <Label htmlFor="visibility-visible" className="text-textDark">
                    Easygoing & relaxed
                  </Label>
                </div>
              </RadioGroup>
            </div>
            <div className="w-full mt-6 text-left flex flex-col  gap-2">
              <h1 className="text-[16px] ">Where are you on your journey?</h1>
              <RadioGroup
                value={lifeStatus}
                onValueChange={setLifeStatus}
                className="flex flex-col md:flex-row gap-2"
              >
                <div className="flex items-center space-x-2">
                  <RadioGroupItem
                    value="est"
                    id="visibility-visible"
                    className={`border-gray-400 text-textDark ${
                      lifeStatus === "est" &&
                      "border-secondary border-opacity-100"
                    }`}
                  />
                  <Label htmlFor="visibility-visible" className="text-textDark">
                    Established & comfortable
                  </Label>
                </div>
                <div className="flex items-center space-x-2">
                  <RadioGroupItem
                    value="exp"
                    id="visibility-hidden"
                    className={`border-gray-400 text-gray-400 ${
                      lifeStatus === "exp" &&
                      "border-secondary border-opacity-100"
                    }`}
                  />
                  <Label htmlFor="visibility-visible" className="text-textDark">
                    Exploring & figuring things out
                  </Label>
                </div>
              </RadioGroup>
            </div>
            <div className="mt-6">
              <h1 className="text-[16px]">
                How did you find out about 27 Circle?
              </h1>
              <textarea
                className="w-full p-4 mt-2 bg-primary text-white border border-gray-600 rounded-lg"
                value="I’m not homeless, I promise!"
                style={{
                  height: "120px",
                  resize: "none",
                }}
              />
            </div>

            <div className="flex bottom-14 items-center justify-center md:justify-end pt-4">
              <button
                type="submit"
                className="self-center w-[300px] max-470:w-full py-2.5 px-12 bg-secondary rounded-full border-2 border-secondary hover:bg-primary hover:text-[#466A97] transition-all duration-200"
              >
                {isSubmitting ? "Confirming..." : "Confirm"}
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  );
};

export default SignupForm;
