import type { Config } from "tailwindcss";

export default {
  darkMode: "class",
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],

  theme: {
    extend: {
      content: {
        empty: "''",
      },
      fontFamily: {
        cairo: "var(--font-cairo)",
      },
      colors: {
        background: "#111111",
        primary: "#181818",
        textDark: "#A2A2A7",
        secondary: "#37577E",
        "bright-gray": "#6A6A6A",
        muted: "#27272A",
        lightGray: "#DDDDDD",
        darkGray: "#232627",
        sidebar: {
          DEFAULT: "hsl(var(--sidebar-background))",
          foreground: "hsl(var(--sidebar-foreground))",
          primary: "hsl(var(--sidebar-primary))",
          "primary-foreground": "hsl(var(--sidebar-primary-foreground))",
          accent: "hsl(var(--sidebar-accent))",
          "accent-foreground": "hsl(var(--sidebar-accent-foreground))",
          border: "hsl(var(--sidebar-border))",
          ring: "hsl(var(--sidebar-ring))",
        },
      },
      borderWidth: {
        px: "1px",
        "1.5": "1.5px",
      },
      screens: {
        "private-dash": {
          min: "767px",
          max: "940px",
        },
        "max-1100": {
          max: "1100px",
        },
        "max-940": {
          max: "940px",
        },
        "max-878": {
          max: "878px",
        },
        "max-780": {
          max: "780px",
        },
        "max-720": {
          max: "720px",
        },
        "max-656": {
          max: "656px",
        },
        "max-592": {
          max: "592px",
        },
        "max-470": {
          max: "470px",
        },
      },
      keyframes: {
        slideIn: {
          "0%": {
            transform: "translateY(2%)",
            opacity: "0",
          },
          "100%": {
            transform: "translateY(0%)",
            opacity: "1",
          },
        },
        slideInX: {
          "0%": {
            transform: "translateX(2%)",
            opacity: "0",
          },
          "100%": {
            transform: "translateX(0%)",
            opacity: "1",
          },
        },
        "accordion-down": {
          from: {
            height: "0",
          },
          to: {
            height: "var(--radix-accordion-content-height)",
          },
        },
        "accordion-up": {
          from: {
            height: "var(--radix-accordion-content-height)",
          },
          to: {
            height: "0",
          },
        },
        "caret-blink": {
          "0%,70%,100%": { opacity: "1" },
          "20%,50%": { opacity: "0" },
        },
      },
      animation: {
        slideIn: "slideIn 0.6s ease-out",
        slideInX: "slideInX 0.3s ease-out",
        "accordion-down": "accordion-down 0.2s ease-out",
        "accordion-up": "accordion-up 0.2s ease-out",
        "caret-blink": "caret-blink 1.25s ease-out infinite",
      },
      fontSize: {
        md: "13px",
      },
      boxShadow: {
        "md-centered": "0px 0px 14px -4px var(--tw-shadow-color)",
      },
      borderRadius: {
        "2md": "0.25rem",
      },
    },
  },
  plugins: [require("tailwindcss-animate")],
} satisfies Config;
