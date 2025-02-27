import { Dispatch, ReactNode, SetStateAction, useState } from "react";

type Props = {
  className?: string;
  tabs: string[];
  children: ReactNode[];
  tabIndex?: number;
  setTabIndex?: Dispatch<SetStateAction<number>>;
};

const TabGroup = (props: Props) => {
  const [tabIndex, setTabIndex] = useState<number>(0);

  const currentTabIndex: number = props.tabIndex || tabIndex;
  const setCurrentTabIndex: Dispatch<SetStateAction<number>> = props.setTabIndex || setTabIndex;

  return (
    <div className={`${props.className} m-10 max-780:mx-4`}>
      <div className="relative flex items-center pb-3.5 border-white border-b-1.5 border-opacity-50 text-lg mb-10">
        <div
          style={{ left: `${(currentTabIndex / props.tabs.length) * 100}%`, width: `${100 / props.tabs.length}%` }}
          className="absolute h-[1.5px] bg-white -bottom-[1.5px] transition-all duration-200"
        />
        {props.tabs.map((button, index) => (
          <button
            key={index}
            type="button"
            onClick={() => setCurrentTabIndex(index)}
            className={`${currentTabIndex !== index && "opacity-50"} text-white flex-1 hover:opacity-100 transition-all duration-200`}
          >
            {button}
          </button>
        ))}
      </div>
      <div className="overflow-hidden">
        <div
          style={{ transform: `translateX(-${currentTabIndex * 100}%)` }}
          className={`flex items-start w-full -translate-x-full transition-all duration-300`}
        >
          {props.children.map((tab, index) => (
            <div key={index} className="h-full min-w-full">
              {tab}
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default TabGroup;
