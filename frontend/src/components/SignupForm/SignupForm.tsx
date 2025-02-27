import React from "react";
import { Control } from "react-hook-form";
import { UserSignUpForm } from "@/models/User";
import { InputTextField } from "../inputs/InputTextField";

const SignupForm = ({ control }: { control: Control<UserSignUpForm> }) => {
  const handleUploadPhoto = () => {};

  return (
    <form className=" flex flex-row gap-x-24 text-white p-2 w-full w-md mx-[10%]">
      <div className="flex flex-col items-center">
        <div className="w-40 h-40 bg-gray-500 rounded-full flex-shrink-0 text-center"></div>
        <button className="text-white underline mt-1 text-md" onClick={handleUploadPhoto}>
          Upload new photo
        </button>
      </div>
      <div className="w-[500px]">
        {[
          { name: "fullName", label: "Full Name" },
          { name: "email", label: "Email Address" },
          { name: "phone", label: "Phone Number" },
          { name: "address", label: "Address" },
          { name: "gender", label: "Gender" },
          { name: "dob", label: "Date of Birth", type: "date" },
          { name: "bio", label: "Bio" },
          { name: "socialProfile.linkedin", label: "LinkedIn Profile" },
          { name: "socialProfile.instagram", label: "Instagram Profile" },
        ].map(({ name, label, type }) => (
          <div key={name} className="mt-4 space-y-2">
            <InputTextField key={name} field={name} control={control} type={type || "text"} label={label} />
          </div>
        ))}
      </div>
    </form>
  );
};

export default SignupForm;
