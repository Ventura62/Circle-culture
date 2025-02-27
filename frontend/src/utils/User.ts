import { User } from "@/models/User";
import { NIL as NIL_UUID } from "uuid";

export const UserGuest: User = {
  id: NIL_UUID,
  score: {
    overall: 0,
    great: 0,
    good: 0,
    reliability: 0,
  },
  stats: {
    circlesAttended: 0,
    peopleMet: 0,
    circlesHosted: 0,
    peopleConnected: 0,
  },
  fullName: "Guest",
  address: "Cairo",
  email: "no-reply@undeliverable.com",
  accessLevel: "Guest",
  phone: "00000000",
  socialProfile: {
    instagram: "",
    linkedin: "",
  },
  joinDate: new Date(),
};

export const userLoggedIn: User = {
  id: NIL_UUID,
  score: {
    overall: 0,
    great: 0,
    good: 0,
    reliability: 0,
  },
  stats: {
    circlesAttended: 0,
    peopleMet: 0,
    circlesHosted: 0,
    peopleConnected: 0,
  },
  fullName: "Mohamed Ahmed",
  address: "Cairo",
  email: "mohamedAhmed@gmail.com",
  accessLevel: "User",
  phone: "01154016600",
  socialProfile: {
    instagram: "",
    linkedin: "",
  },
  joinDate: new Date(),
};
export const userUnVerified: User = {
  id: NIL_UUID,
  score: {
    overall: 0,
    great: 0,
    good: 0,
    reliability: 0,
  },
  stats: {
    circlesAttended: 0,
    peopleMet: 0,
    circlesHosted: 0,
    peopleConnected: 0,
  },
  fullName: "Mohamed Ahmed",
  address: "Cairo",
  email: "mohamedAhmed@gmail.com",
  accessLevel: "UNVERIFIED_USER",
  phone: "01154016600",
  socialProfile: {
    instagram: "",
    linkedin: "",
  },
  joinDate: new Date(),
};
