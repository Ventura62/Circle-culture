import { useState } from "react";
import Link from "next/link";

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import ChevronBottom from "@/assets/images/ChevronBottom";
import { useRouter } from "next/router";

const Dropdown = () => {
    const router = useRouter();
    const [open, setOpen] = useState<boolean>(false);
    return (
        <DropdownMenu open={open} onOpenChange={setOpen} modal={false}>
            <DropdownMenuTrigger asChild>
                <div className="relative cursor-pointer">
                    <div className="w-10 h-10 rounded-full !bg-secondary"></div>

                    <button className="absolute -bottom-1 -right-1 w-5 h-5 flex items-center justify-center rounded-full bg-white border-2 border-black">
                        <ChevronBottom />
                    </button>
                </div>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-56 !bg-primary relative right-6">
                <DropdownMenuGroup>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white/10 hover:!text-white !font-semibold"
                    >
                        <button
                            onClick={() => {
                                router.push("/auth");
                            }}
                            className="w-full text-left text-white"
                        >
                            Sign Up
                        </button>
                    </DropdownMenuItem>
                    <DropdownMenuItem
                        onClick={() => setOpen(false)}
                        className="hover:!bg-white/10 hover:!text-white !font-semibold"
                    >
                        <Link href="/home/faq" className="w-full">
                            FAQ
                        </Link>
                    </DropdownMenuItem>
                </DropdownMenuGroup>
            </DropdownMenuContent>
        </DropdownMenu>
    );
};

export default Dropdown;
