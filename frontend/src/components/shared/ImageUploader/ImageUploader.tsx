import Image from "next/image";
import { useEffect, useRef, useState } from "react";
import { useDropzone } from "react-dropzone";
import { MdOutlineCloudUpload } from "react-icons/md";

type Props = {
  image: string,
  setImage: (url: string) => void,
  type?: "Square" | "Circle",
}

const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB

const ImageUploader = ({ image, setImage, type = "Square" }: Props) => {
  const inputRef = useRef<HTMLInputElement>(null);
  const [error, setError] = useState<string | null>(null);

  const onDrop = (acceptedFiles: File[]) => {
    const file = acceptedFiles[0];

    if (!file || file.size > MAX_FILE_SIZE) {
      setError("File size must be less than 2MB.");
      return;
    }

    const reader = new FileReader();
    reader.onload = () => {
      setImage(reader.result as string);
      setError(null);
    };
    reader.readAsDataURL(file);
  };

  const { getRootProps, getInputProps, isDragActive } = useDropzone({
    onDrop,
    accept: { "image/*": [".jpeg", ".jpg", ".png", ".webp"] },
    maxSize: MAX_FILE_SIZE,
    multiple: false,
  });

  return (
    <div className="w-full text-center max-w-md mx-auto cursor-pointer">
      <div {...getRootProps()}>
        <div className={`${ !image && "border-1.5 p-8 border-secondary" } ${ type === "Circle" ? "rounded-full aspect-square": "rounded-lg border-dashed aspect-video" } relative flex flex-col items-center justify-center w-full overflow-hidden`}>
          <input ref={inputRef} {...getInputProps()} />
          {isDragActive && <div className="bg-white bg-opacity-30 absolute top-0 bottom-0 left-0 right-0" />}
          {image ? (
            <Image height={400} width={400} src={image} alt="Uploaded" className="w-full h-full object-center object-cover cursor-pointer" />
          ) : (
              <div className="flex flex-col items-center justify-center">
                <MdOutlineCloudUpload size={52} className={`fill-secondary ${ type === "Square" && "mb-4" }`} />
                {type === "Square" && <p>Drag your file(s) or <span className="text-secondary cursor-pointer hover:underline" onClick={() => inputRef.current?.click()}>browse</span></p>}
                {type === "Square" && <p className="text-white/30">Max 2 MB files are allowed</p>}
              </div>
          )}
        </div>
        {type === "Circle" && <button type="button" onClick={() => inputRef.current?.click()} className="text-white mx-auto underline hover:text-white/60 mt-1 text-md">Uploade New Photo</button>}
      </div>
      {error && <p className="text-red-500 mt-2">{error}</p>}
    </div>
  );
};

export default ImageUploader;
