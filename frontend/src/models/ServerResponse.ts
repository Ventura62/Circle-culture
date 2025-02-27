export interface ServerResponse<T> {
  data: T;
  message: string;
  okay: boolean;
}

export interface ServerErrorResponse {
  Message: string;
  Type: string;
  StackTrace?: string;
  InnerException?: ServerErrorResponse;
}
