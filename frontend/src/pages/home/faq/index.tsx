import { faqData, hostsFaqData } from "@/constants/constants";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@radix-ui/react-accordion";
import { ChevronDown } from "lucide-react";
import React from "react";

const FaqAccordion = () => {
    return (
        <div className="w-full max-w-[900px] mx-auto space-y-12 mb-[150px] xs:px-[20px]">
            <h2 className="text-center text-4xl font-semibold">FAQ</h2>
            <div>
                <h2 className="text-xl font-semibold text-white bg-secondary p-2">
                    Guests FAQ
                </h2>
                <Accordion type="single" collapsible>
                    {faqData.map((item, index) => (
                        <AccordionItem
                            key={index}
                            value={`${index}`}
                            className="space-y-2"
                        >
                            <AccordionTrigger className="text-xl font-medium text-white bg-transparent py-3 px-4 rounded-md w-full text-start flex flex-row items-center justify-between [&[data-state=open]>svg]:rotate-180">
                                {item.question}
                                <ChevronDown className="inline transition-transform duration-300" />
                            </AccordionTrigger>
                            <AccordionContent className="text-lg text-gray-400 py-2 px-4 bg-transparent rounded-md">
                                {item.answer}
                            </AccordionContent>
                            <div className="border-b border-gray-600" />
                        </AccordionItem>
                    ))}
                </Accordion>
            </div>
            <div>
                <h2 className="text-xl font-semibold text-white bg-secondary p-2">
                    Hosts FAQ
                </h2>
                <Accordion type="single" collapsible>
                    {hostsFaqData.map((item, index) => (
                        <AccordionItem
                            key={index}
                            value={`${index}`}
                            className="space-y-2"
                        >
                            <AccordionTrigger className="text-xl font-medium text-white bg-transparent py-3 px-4 rounded-md w-full text-start flex flex-row items-center justify-between [&[data-state=open]>svg]:rotate-180">
                                {item.question}
                                <ChevronDown className="transition-transform duration-300" />
                            </AccordionTrigger>
                            <AccordionContent className="text-lg text-gray-400 py-2 px-4 bg-transparent rounded-md">
                                {item.answer}
                            </AccordionContent>
                            <div className="border-b border-gray-600" />
                        </AccordionItem>
                    ))}
                </Accordion>
            </div>
        </div>
    );
};

export default FaqAccordion;
