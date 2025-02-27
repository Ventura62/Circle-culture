"use client";
import React from "react";

interface SocialsItemProps {
  icon: React.ReactNode;
  username: string;
}

const SocialsItem: React.FC<SocialsItemProps> = ({ icon, username }) => {
  return (
    <div className="flex items-center gap-2">
      <div className="text-white">{icon}</div>

      <span className="text-white text-lg">{username}</span>
    </div>
  );
};

export default SocialsItem;
