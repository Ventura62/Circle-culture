"use client";
import React from "react";
import SocialsItem from "../SocialsItem/SocialsItem";
import StatItem from "../StatItem/StatItem";
import LocationIcon from "@/assets/LocationIcon";
import LinkedInIcon from "@/assets/images/LinkedInIcon";
import InstagramIcon from "@/assets/images/InstagramIcon";

const PublicProfileCard = () => {
  return (
    <div className="bg-primary h-full text-white p-8 rounded-lg shadow-lg max-w-4xl mt-[20px] mb-6 px-4 md:px-6 lg:px-8 mx-auto">
      {" "}
      <div className="flex sm:flex-row flex-col h-full">
        <div className="flex-1 flex flex-col items-center mb-6 sm:pr-6">
          <h2 className="text-3xl font-semibold pb-5 text-center">
            Jacob Anderson
          </h2>
          <div className="w-40 h-40 bg-gray-500 rounded-full flex-shrink-0 mb-4"></div>
          <div className="flex flex-row gap-2">
            <LocationIcon />

            <h2 className="text-lg font-semibold">Cairo, Egypt</h2>
          </div>
          <div className="mt-6 flex flex-col gap-4 w-full">
            <div className="space-y-4">
              <StatItem item="Joined" number={"Jan 24, 2025"} />
              <StatItem item="People Met" number={120} />
              <StatItem item="Circles Hosted" number={2} />
            </div>
          </div>
        </div>

        <div className="h-px w-full sm:h-auto sm:w-px bg-white/20 sm:mx-4 my-4 sm:my-0" />

        <div className="flex-1 flex flex-col items-start mb-6 sm:pl-6">
          <div className="mb-6 w-full">
            <h3 className="text-lg font-semibold">Bio</h3>
            <textarea
              className="w-full p-4 mt-2 bg-primary text-white border border-gray-600 rounded-lg"
              readOnly
              value="I’m not homeless, I promise!"
            />
          </div>
          <div className="mb-6 w-full">
            <h3 className="text-lg font-semibold">Socials</h3>
            <div className="flex gap-4 pt-2 flex-col">
              <SocialsItem icon={<LinkedInIcon />} username="RobertAnderson" />
              <SocialsItem icon={<InstagramIcon />} username="RobertAnderson" />
            </div>
          </div>
          <div className="w-full">
            <h3 className="text-xl font-semibold">Stats</h3>
            <div className="grid grid-rows-2 gap-4 mt-2">
              <div
                className="text-center border-[0.5px] border-[#FFFFFF4D] rounded-lg flex flex-row items-center
              px-6 py-4 justify-between"
              >
                <p className="text-xl text-white">Circles Hosted</p>
                <p className="text-4xl font-semibold">2</p>
              </div>

              <div
                className="text-center border-[0.5px] border-[#FFFFFF4D] rounded-lg flex flex-row items-center
              px-6 py-4 justify-between"
              >
                <p className="text-xl text-white">People Connected</p>
                <p className="text-4xl font-semibold">220</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default PublicProfileCard;
