import React, { useState } from "react";
import { Eye, EyeOff, Lock } from "lucide-react";
import TrashIcon from "@/assets/images/TrashIcon";
import InputWithIcons from "../InputWithIcon/InputWithIcon";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { UserEditPasswordForm, UserEditPasswordSchema } from "@/models/User";
import { resolveSoa } from "dns";

const LoginAndSecurityCard = () => {
  const [currentPassword, setCurrentPassword] = useState("");
  const [newPassword, setNewPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");

  const [showCurrentPassword, setShowCurrentPassword] = useState(false);
  const [showNewPassword, setShowNewPassword] = useState(false);
  const [showConfirmPassword, setShowConfirmPassword] = useState(false);

  const [passwordTouched, setPasswordTouched] = useState(false);
  const [newPasswordTouched, setNewPasswordTouched] = useState(false);
  const [confirmPasswordTouched, setConfirmPasswordTouched] = useState(false);

  const handleToggleCurrentPassword = () =>
    setShowCurrentPassword(!showCurrentPassword);
  const handleToggleNewPassword = () => setShowNewPassword(!showNewPassword);
  const handleToggleConfirmPassword = () =>
    setShowConfirmPassword(!showConfirmPassword);

  const [isSubmitting, setSubmitting] = useState<boolean>(false);

  const defaultReport = {
    currentPassword: "",
    newPassword: "",
    passwordConfirmation: "",
  } as unknown as UserEditPasswordForm;

  const { control, handleSubmit, reset, watch, setValue, formState } = useForm({
    defaultValues: defaultReport,
    resolver: zodResolver(UserEditPasswordSchema),
  });

  const handleDeactivate = () => {
    console.log("DEACTIVATE");
  };

  const handleNeedNewPassword = () => {};
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
        className=" space-y-8 w-full max-w-[800px] min-w-[100px] "
      >
        <div className="flex flex-col ">
          <InputWithIcons
            label="Current Password"
            field="currentPassword"
            control={control}
            value={currentPassword}
            onChange={(e) => {}}
            startIcon={Lock}
            endIcon={showCurrentPassword ? Eye : EyeOff}
            type={showCurrentPassword ? "text" : "password"}
            endIconOnPress={handleToggleCurrentPassword}
            errorMessage={
              passwordTouched && currentPassword === ""
                ? "Password is required"
                : undefined
            }
            onInputFocus={() => setPasswordTouched(true)}
          />

          <button
            className="text-white text-sm underline cursor-pointer self-start"
            onClick={handleNeedNewPassword}
          >
            Need a new password?
          </button>
        </div>

        <InputWithIcons
          label="New Password"
          field="newPassword"
          control={control}
          value={newPassword}
          onChange={(e) => {}}
          startIcon={Lock}
          endIcon={showNewPassword ? Eye : EyeOff}
          type={showNewPassword ? "text" : "password"}
          errorMessage={
            newPasswordTouched && newPassword === ""
              ? "New Password is required"
              : undefined
          }
          onInputFocus={() => setNewPasswordTouched(true)}
          endIconOnPress={handleToggleNewPassword}
        />
        <InputWithIcons
          label="Confirm Password"
          field="passwordConfirmation"
          control={control}
          value={confirmPassword}
          onChange={(e) => {}}
          startIcon={Lock}
          endIcon={showConfirmPassword ? Eye : EyeOff}
          type={showConfirmPassword ? "text" : "password"}
          errorMessage={
            confirmPasswordTouched && confirmPassword === ""
              ? "Confirm Password is required"
              : undefined
          }
          onInputFocus={() => setConfirmPasswordTouched(true)}
          endIconOnPress={handleToggleConfirmPassword}
        />
        <button
          type="button"
          className="text-customRed mt-6 flex items-center gap-2 text-lg"
          onClick={handleDeactivate}
        >
          <TrashIcon />
          Deactivate
        </button>
        <div className="fixed bottom-12">
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

export default LoginAndSecurityCard;
