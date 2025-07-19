import React, { useEffect, useState } from "react";
import { XIcon } from "@heroicons/react/solid";

const paletteKeys = ["Theme1", "Theme2", "Theme3", "Theme4", "Theme5", "Theme6", "Theme7"] as const;

type PaletteKey = typeof paletteKeys[number];

const palettes: Record<PaletteKey, Record<string, string>> = {
  Theme1: {
    displayName: "Petrascia",
    primary: "#3b82f6", 
    50:  "#f8f9fa", 
    100: "#e1e4e8",   
    200: "#c5cbd3",    
    300: "#9aa5b1",  
    400: "#6c7885",   
    500: "#55606d",   
    600: "#47505c",  
    700: "#38414d",  
    800: "#2f3741",  
    900: "#1d232b",  
  },
  Theme2: {
    displayName: "Pink",
    primary: "#D11EB2",
    50:  "#f8f9fa", 
    100: "#D7CFD6",
    200: "#BEAABB",
    300: "#A2739B",
    400: "#7C5978",
    500: "#765E78",
    600: "#5A4256",
    700: "#361F32",
    800: "#280D25",
    900: "#160613",
  },
  Theme3: {
    displayName: "Purple",
    primary: "#8423C0",
    50:  "#f8f9fa", 
    100: "#D3D0D7",
    200: "#B4ABB8",
    300: "#8F7A9E",
    400: "#6D5A79",
    500: "#695C74",
    600: "#4D3F56",
    700: "#291F34",
    800: "#1B0E27",
    900: "#0E0615",
  },
  Theme4: {
    displayName: "Orange",
    primary: "#CF721B",
    50:  "#f8f9fa", 
    100: "#CBC2C0",
    200: "#B6A3A0",
    300: "#9E766F",
    400: "#765954",
    500: "#77584F",
    600: "#553E3B",
    700: "#341E1A",
    800: "#270F0A",
    900: "#150704",
  },
  Theme5: {
    displayName: "Red",
    primary: "#C81B1B",
    50:  "#f8f9fa", 
    100: "#C0B5B2",
    200: "#AD9693",
    300: "#966A68",
    400: "#71524D",
    500: "#6C554E",
    600: "#503B36",
    700: "#331C17",
    800: "#270F08",
    900: "#150603",
  },
  Theme6: {
    displayName: "Midnight",
    primary: "#6366f1",
    50:  "#f8fafc",
    100: "#f1f5f9",
    200: "#e2e8f0",
    300: "#cbd5e1",
    400: "#94a3b8",
    500: "#64748b",
    600: "#475569",
    700: "#334155",
    800: "#1e293b",
    900: "#0f172a",
  },
  Theme7: {
    displayName: "Monochrome",
    primary: "#000000",
    50:  "#ffffff",
    100: "#f5f5f5",
    200: "#e5e5e5",
    300: "#d4d4d4",
    400: "#a3a3a3",
    500: "#737373",
    600: "#525252",
    700: "#404040",
    800: "#262626",
    900: "#171717",
  },
};

const getCookie = (name: string): string | null => {
  const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
  return match ? decodeURIComponent(match[2]) : null;
};

const setCookie = (name: string, value: string, days = 30) => {
  const expires = new Date(Date.now() + days * 864e5).toUTCString();
  document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
};

const deleteCookie = (name: string) => {
  document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
};

const hexToRgbString = (hex: string) => {
  if (!/^#?([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/.test(hex)) return "0 0 0";
  let cleanHex = hex.replace("#", "");
  if (cleanHex.length === 3) {
    cleanHex = cleanHex.split("").map((x) => x + x).join("");
  }
  const bigint = parseInt(cleanHex, 16);
  const r = (bigint >> 16) & 255;
  const g = (bigint >> 8) & 255;
  const b = bigint & 255;
  return `${r} ${g} ${b}`;
};

const applyTheme = (colors: Record<string, string>) => {
  const root = document.documentElement;
  for (const [key, hex] of Object.entries(colors)) {
    root.style.setProperty(`--color-${key}`, hexToRgbString(hex));
  }
};

const clearTheme = () => {
  const root = document.documentElement;
  Object.keys(palettes.Theme1).forEach((key) => {
    root.style.removeProperty(`--color-${key}`);
  });
};

const ThemeSelector = () => {
  const [selected, setSelected] = useState<"default" | PaletteKey>("default");

  useEffect(() => {
    const saved = getCookie("theme");
    if (saved && paletteKeys.includes(saved as PaletteKey)) {
      applyTheme(palettes[saved as PaletteKey]);
      setSelected(saved as PaletteKey);
    } else {
      clearTheme();
      setSelected("default");
    }
  }, []);

  const handleThemeChange = (theme: "default" | PaletteKey) => {
    setSelected(theme);
    if (theme === "default") {
      clearTheme();
      deleteCookie("theme");
    } else {
      applyTheme(palettes[theme]);
      setCookie("theme", theme);
    }
  };

  return (
    <div className="px-4 py-2">
      <div className="flex gap-3">
        <button
          onClick={() => handleThemeChange("default")}
          className={`w-10 h-10 flex items-center justify-center rounded-full border text-sm hover:bg-gray-300 dark:hover:bg-gray-700 ${
            selected === "default" ? "ring-2 ring-revix" : ""
          }`}
          title="System Default"
        >
          <XIcon className="h-8 w-8 text-danger/50" />
        </button>

        {paletteKeys.map((name) => {
          const theme = palettes[name];
          const gradient = `conic-gradient(at top left, ${theme.primary}, ${theme[600]}, ${theme[800]})`;

          return (
            <button
              key={name}
              onClick={() => handleThemeChange(name)}
              className={`w-10 h-10 rounded-full border shadow-sm transition ${
                selected === name ? "ring-2 ring-revix" : ""
              }`}
              style={{ background: gradient }}
              title={palettes[name].displayName}
            />
          );
        })}
      </div>
    </div>
  );
};

export default ThemeSelector;

export const ThemeLoader = () => {
  useEffect(() => {
    const themeName = getCookie("theme");
    if (themeName && themeName in palettes) {
      applyTheme(palettes[themeName as keyof typeof palettes]);
    }
  }, []);

  return null;
};