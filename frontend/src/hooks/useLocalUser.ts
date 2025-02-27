import { useEffect, useState } from "react";
import { useZodParser } from "./useZodParser";
import {
  PublicUser,
  User,
  UserEditPasswordForm,
  UserEditProfileForm,
  UserPublicProfileSchema,
  UserSchema,
  UserSignUpForm,
} from "@/models/User";
import { axiosPrivateInstance } from "@/config/axiosConfig";
import { UserGuest, userLoggedIn, userUnVerified } from "@/utils/User";
import { ServerErrorResponse, ServerResponse } from "@/models/ServerResponse";

export type UserHook = {
  user: User;
  userActions: {
    login: () => void;
    logout: () => void;
    signup: (userInfo: UserSignUpForm) => void;
  };
  userIsLoading: boolean;
  isLoggedIn: boolean;
};

export function useLocalUser(): UserHook {
  const [userData, setUser] = useState<User>(userLoggedIn);
  const [IsLoading, setIsLoading] = useState<boolean>(true);
  const { triggerParser } = useZodParser();
  const [isLoggedIn, setIsLoggedIn] = useState(true);
  useEffect(() => {
    if (userData.accessLevel == "Guest") {
      console.log("hereeeeeeeeeeeee");
      getUser();
    }
  }, []);

  const userLogin = async () => {
    setIsLoading(true);
    setUser(userUnVerified);
    setIsLoggedIn(true);
    setIsLoading(false);
    return;
    axiosPrivateInstance
      .post("/user/login")
      .then((response) => {
        const data = response.data;
        if (data.okay) {
          const user = triggerParser(
            data.data,
            UserSchema,
            "user/login",
            "post"
          ) as User;
          setUser(user);
          setIsLoggedIn(true);
        } else {
          setUser(UserGuest);
          return Promise.reject(new Error(data.message));
        }
      })
      .catch((err) => {
        return Promise.reject(
          err.message || "An error occurred while fetching user data."
        );
      })
      .finally(() => {
        setIsLoading(false);
      });
  };
  const userSignup = async (userInfo: UserSignUpForm) => {
    setIsLoading(true);
    setUser(userUnVerified);
    setIsLoggedIn(true);
    setIsLoading(false);
    return;
    return axiosPrivateInstance
      .post("/user/signup", userInfo)
      .then((response) => {
        const data = response.data;

        if (data.okay) {
          const user = triggerParser(
            data.data,
            UserSchema,
            "user/signup",
            "post"
          ) as User;

          setUser(user);
          setIsLoggedIn(true);

          return user;
        } else {
          setUser(UserGuest);
          return Promise.reject(new Error(data.message));
        }
      })
      .catch((err) => {
        console.error("Signup Error:", err);
        return Promise.reject(
          err.message || "An error occurred while signing up."
        );
      })
      .finally(() => {
        setIsLoading(false);
      });
  };

  const getUser = async () => {
    setIsLoading(true);
    console.log("here1");
    return axiosPrivateInstance
      .get<ServerResponse<User | null | ServerErrorResponse>>("/user")
      .then((response) => {
        const data = response.data;
        if (data.okay) {
          const user = triggerParser(
            data.data,
            UserSchema,
            "user",
            "get"
          ) as User;
          setUser(user);
        } else {
          setUser(UserGuest);
          return Promise.reject(new Error(data.message));
        }
      })
      .catch((err) => {
        return Promise.reject(
          err.message || "An error occurred while fetching user data."
        );
      })
      .finally(() => {
        console.log("here2");

        setIsLoading(false);
      });
  };

  const handleGetUserPublicProfile = async (
    id?: string
  ): Promise<PublicUser | null> => {
    setIsLoading(true);
    let publicUserData: PublicUser | null;
    if (id) {
      const PublicUser = await fetchUserPublicProfile(id);
      publicUserData = triggerParser(
        PublicUser,
        UserPublicProfileSchema,
        "use/getPublicProfile",
        "post"
      ) as PublicUser;
    } else {
      publicUserData = UserPublicProfileSchema.parse(userData);
    }
    setIsLoading(false);
    return publicUserData;
  };

  const fetchUserPublicProfile = (id: string): Promise<PublicUser | null> => {
    return axiosPrivateInstance
      .get<ServerResponse<PublicUser | ServerErrorResponse>>(
        "/user/getPublicProfile"
      )
      .then((response) => {
        const data = response.data;
        if (data.okay) {
          const publicUser = triggerParser(
            data.data,
            UserPublicProfileSchema,
            "use/getPublicProfile",
            "post"
          ) as PublicUser;
          return publicUser;
        } else {
          return Promise.reject(new Error(data.message));
        }
      })
      .catch((err) => {
        console.log(
          err.message || "An error occurred while fetching user data."
        );
        return null;
      });
  };

  const postChangePassword = (
    editPasswordForm: UserEditPasswordForm
  ): Promise<boolean> => {
    return axiosPrivateInstance
      .post<ServerResponse<boolean | ServerErrorResponse>>(
        "/user/changePassword",
        editPasswordForm
      )
      .then((response) => {
        const data = response.data;
        if (data.okay) {
          return true;
        } else {
          return Promise.reject(new Error(data.message));
        }
      })
      .catch((err) => {
        console.log(
          err.message || "An error occurred while fetching user data."
        );
        return false;
      });
  };
  const editChangeProfile = (
    editProfileForm: UserEditProfileForm
  ): Promise<User> => {
    return axiosPrivateInstance
      .post<ServerResponse<User | ServerErrorResponse>>(
        "/user/changePassword",
        editProfileForm
      )
      .then((response) => {
        const data = response.data;
        if (data.okay) {
          const parsedUser = triggerParser(
            data.data,
            UserSchema,
            "/user/changePassword",
            "post"
          ) as User;
          return parsedUser;
        } else {
          return Promise.reject(new Error(data.message));
        }
      })
      .catch((err) => {
        console.log(
          err.message || "An error occurred while fetching user data."
        );
        return userData;
      });
  };

  const clearUser = () => {
    console.log("ddddddddddddddddddddd");
    setUser(UserGuest);
    setIsLoggedIn(false);
  };

  return {
    user: userData,
    userActions: {
      login: userLogin,
      logout: clearUser,
      signup: userSignup,
    },
    userIsLoading: IsLoading,
    isLoggedIn: isLoggedIn,
  };
}
