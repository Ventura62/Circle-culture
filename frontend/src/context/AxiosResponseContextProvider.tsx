import React, { ReactNode, useEffect } from "react";
import { AxiosResponse } from "axios";
import { ServerResponse } from "../models/ServerResponse";
import axiosInstance, { axiosPrivateInstance } from "@/config/axiosConfig";
import { useToastContext } from "./ToastProviderContext";

export const AxiosResponseProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
  const { showSuccessToast, showFailToast } = useToastContext();

  const publicBodyResponse = (response: AxiosResponse) => {
    const msg: ServerResponse<unknown> = response.data as ServerResponse<never>;
    if (msg.okay) {
      showSuccessToast(msg.message, "Success");
    } else {
      showFailToast(msg.message, "Error");
    }
    return response;
  };
  const privateBodyResponse = (response: AxiosResponse) => {
    const msg: ServerResponse<unknown> = response.data as ServerResponse<never>;
    if (!msg.okay) {
      showFailToast(msg.message, "error");
    }
    return response;
  };

  const errorResponse = (error: {
    response: {
      data: { message: string };
      statusText: string;
    };
    message: string;
  }) => {
    console.log("Error in axiosInstance interceptor", { ...error });
    showFailToast(error.response?.data.message ?? error.message, error.response?.statusText ?? "Network Error");
    return Promise.reject(error);
  };
  useEffect(() => {
    const interceptorPublic = axiosInstance.interceptors.response.use(publicBodyResponse, errorResponse);
    const interceptorPrivate = axiosPrivateInstance.interceptors.response.use(privateBodyResponse, errorResponse);
    return () => {
      axiosInstance.interceptors.response.eject(interceptorPublic);
      axiosPrivateInstance.interceptors.response.eject(interceptorPrivate);
    };
  }, []);
  return <>{children}</>;
};
