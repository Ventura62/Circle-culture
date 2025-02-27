import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faBug, faPaperPlane, faSpinner } from "@fortawesome/free-solid-svg-icons";
import { useEffect, useState } from "react";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";
import useBugReport from "@/hooks/useBugReport";
import { BugReportSubmission, SchemaBugReportSubmission } from "@/models/Bugs";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { InputTextField } from "../inputs/InputTextField";
import { InputDropdownField } from "../inputs/InputDropdownField";
import { InputTextAreaField } from "../inputs/InputTextAreaField";
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from "@/components/ui/dialog";

import { Button } from "../ui/button";

const Options_IssueType: { label: string; value: string }[] = [
  { label: "Bug", value: "Bug" },
  { label: "Feature Request", value: "Feature" },
  { label: "Question", value: "Question" },
  { label: "Other", value: "Other" },
];

const Options_NotificationMethods: { label: string; value: string }[] = [
  { label: "Email", value: "Email" },
  { label: "Phone", value: "Phone" },
  { label: "Text", value: "Text" },
  { label: "None", value: "None" },
];

export default function BugReport() {
  return (
    <Dialog>
      <DialogTrigger asChild>
        <Button variant="outline">
          <FontAwesomeIcon icon={faBug} className="m-2" />
        </Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Send us a note!</DialogTitle>
          <DialogDescription>Thank you for taking the time to tell us what is going on!</DialogDescription>
        </DialogHeader>
        <BugReportForm />

        <DialogFooter>
          <Button type="submit">Save changes</Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  );
}

function BugReportForm() {
  const { user } = useLocalUserContext();
  const [isSubmitting, setSubmitting] = useState<boolean>(false);
  const {
    actions: { addBug },
  } = useBugReport();

  const defaultReport = {
    type: "Bug",
    notificationMethod: "Email",
    description: undefined,
    email: undefined,
    phone: undefined,
    title: undefined,
    screenShot: undefined,
  } as unknown as BugReportSubmission;

  const { control, handleSubmit, reset, watch, setValue } = useForm({
    defaultValues: defaultReport,
    resolver: zodResolver(SchemaBugReportSubmission),
  });

  const contactMethod = watch("notificationMethod");

  useEffect(() => {
    if (contactMethod === "Email") {
      setValue("email", user?.email);
    }
  }, [contactMethod]);

  const doSave = async (data: BugReportSubmission) => {
    await addBug(data).then(() => {
      setSubmitting(false);
      reset();
    });
  };

  return (
    <div>
      <form
        onSubmit={handleSubmit((e) => {
          setSubmitting(true);
          doSave(e as BugReportSubmission);
        })}
        onReset={() => reset()}
        className="h-full w-full"
      >
        <div className=" flex flex-col gap-8 px-4 ">
          <div className="flex justify-start  gap-4 ">
            <div className="w-[400px]">
              <InputDropdownField
                control={control}
                field="type"
                label="Type"
                toolTip="Type of issue."
                options={Options_IssueType}
                readOnly={isSubmitting}
              />
            </div>
            <div className=" w-[100%]">
              <InputTextField
                control={control}
                field="title"
                label="Short Description"
                toolTip="Short description of the issue."
                readOnly={isSubmitting}
              />
            </div>
          </div>

          <div className="flex  gap-4">
            <div className="w-[400px]">
              <InputDropdownField
                control={control}
                field="notificationMethod"
                label="Contact Method"
                toolTip="Method of desired contact."
                options={Options_NotificationMethods}
                readOnly={isSubmitting}
              />
            </div>
            {contactMethod === "Email" && (
              <div className=" w-[100%]">
                <InputTextField
                  control={control}
                  field="email"
                  label="Contact Email"
                  toolTip="Email address, if you wish to be contacted about this issue."
                  readOnly={isSubmitting}
                />
              </div>
            )}
            {(contactMethod === "Phone" || contactMethod === "Text") && (
              <div className="w-[100%]">
                <InputTextField
                  control={control}
                  field="phone"
                  label="Contact Phone"
                  toolTip="Phone number, if you wish to be contacted about this issue."
                  readOnly={isSubmitting}
                />
              </div>
            )}
          </div>
          <div className=" w-[100%]">
            <InputTextAreaField
              control={control}
              field="description"
              label="Description"
              toolTip="Description of the issue."
              readOnly={isSubmitting}
            />
          </div>
        </div>
        <div className=" justify-center">
          <Button type="submit" className="mr-2" disabled={isSubmitting}>
            <FontAwesomeIcon icon={isSubmitting ? faSpinner : faPaperPlane} spin={isSubmitting} className="mr-2" />
            Send
          </Button>
        </div>
      </form>
    </div>
  );
}
