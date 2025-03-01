"use client";
import { useState } from "react";
import Link from "next/link";
import PersonImage from "@/assets/images/person-test.png";
import Image from "next/image";

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import ChevronBottom from "@/assets/images/ChevronBottom";
import { useLocalUserContext } from "@/context/LocalUserContextProvider";

const Dropdown = () => {
    const [open, setOpen] = useState<boolean>(false);
    const { userActions } = useLocalUserContext();
    const { logout } = userActions;
    return (
        <DropdownMenu open={open} onOpenChange={setOpen} modal={false}>
            <DropdownMenuTrigger asChild>
                <div className="relative">
                    <Image
                        className="w-[35px] h-[35px] rounded-full"
                        src={PersonImage}
                        alt="Person Img"
                    />
                    <button className="absolute bottom-0 right-0 mb-[-8px] mr-[-8px] w-5 h-5 flex items-center justify-center rounded-full bg-white border-2 border-black">
                        <ChevronBottom />
                    </button>
                </div>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-56 !bg-primary relative right-6">
                <DropdownMenuGroup>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white hover:!bg-opacity-10 hover:!text-white !font-semibold"
                    >
                        <Link href="/user/create-circle" className="w-full">
                            Create a circle
                        </Link>
                    </DropdownMenuItem>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white hover:!bg-opacity-10 hover:!text-white !font-semibold"
                    >
                        <Link href="/user/hangouts" className="w-full">
                            Upcoming hangouts
                        </Link>
                    </DropdownMenuItem>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white hover:!bg-opacity-10 hover:!text-white !font-semibold"
                    >
                        <Link href="/user/dashboard" className="w-full">
                            Manage your Circles
                        </Link>
                    </DropdownMenuItem>
                </DropdownMenuGroup>
                <DropdownMenuSeparator className="!bg-white !opacity-30" />
                <DropdownMenuGroup>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white hover:!bg-opacity-10 hover:!text-white !font-semibold"
                    >
                        <Link href="/user/account" className="w-full">
                            Account
                        </Link>
                    </DropdownMenuItem>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white hover:!bg-opacity-10 hover:!text-white !font-semibold"
                    >
                        <Link href="/home/faq" className="w-full">
                            FAQ
                        </Link>
                    </DropdownMenuItem>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white hover:!bg-opacity-10 hover:!text-white !font-semibold"
                    >
                        <Link href="/" className="w-full">
                            Help
                        </Link>
                    </DropdownMenuItem>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white hover:!bg-opacity-10 hover:!text-white !font-semibold"
                    >
                        <Link
                            href="/home"
                            onClick={() => {
                                logout();
                            }}
                            className="w-full"
                        >
                            Log out
                        </Link>
                    </DropdownMenuItem>
                </DropdownMenuGroup>
            </DropdownMenuContent>
        </DropdownMenu>
    );
};

export default Dropdown;
