import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader"
import { CalendarCheck2Icon, CalendarIcon, InboxIcon } from "lucide-react"

const Notifications = () => {
  return (
    <div>
      <AccountSubHeader title="Notifications" enableBackPress />
      <div className="space-y-4 flex flex-col mx-auto max-w-3xl px-2">
          <div className="flex items-start gap-3 hover:bg-white/10 p-3 rounded-md cursor-pointer border-1.5 border-white/10 transition-all duration-200">
            <div className="flex h-8 w-8 items-center justify-center rounded-full !bg-secondary text-white">
              <CalendarIcon className="h-5 w-5" />
            </div>
            <div className="flex-1 space-y-1">
              <p className="font-medium">Your call has been confirmed</p>
              <p className="text-gray-500">5 minutes ago</p>
            </div>
          </div>
          <div className="flex items-start gap-3 hover:bg-white/10 p-3 rounded-md cursor-pointer border-1.5 border-white/10 transition-all duration-200">
            <div className="flex h-8 w-8 items-center justify-center rounded-full !bg-secondary text-white">
              <InboxIcon className="h-5 w-5" />
            </div>
            <div className="flex-1 space-y-1">
              <p className="font-medium">You have a new message</p>
              <p className="text-gray-500">1 minute ago</p>
            </div>
          </div>
          <div className="flex items-start gap-3 hover:bg-white/10 p-3 rounded-md cursor-pointer border-1.5 border-white/10 transition-all duration-200">
            <div className="flex h-8 w-8 items-center justify-center rounded-full !bg-secondary text-white">
              <CalendarCheck2Icon className="h-5 w-5" />
            </div>
            <div className="flex-1 space-y-1">
              <p className="font-medium">Your subscription is expiring soon</p>
              <p className="text-gray-500">2 hours ago</p>
            </div>
          </div>
        </div>
    </div>
  )
}

export default Notifications