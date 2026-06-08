import { initializeApp, getApps } from "firebase/app";
import { connectAuthEmulator, getAuth } from "firebase/auth";
import { connectFirestoreEmulator, getFirestore } from "firebase/firestore";
import { connectStorageEmulator, getStorage } from "firebase/storage";

declare const process:
  | {
      env?: Record<string, string | undefined>;
    }
  | undefined;

const firebaseConfig = {
  apiKey: "local-dev-mock-key",
  authDomain: "cumbre-erp-local.firebaseapp.com",
  projectId: "cumbre-erp-prod",
  storageBucket: "cumbre-erp-local.appspot.com"
};

export const CUMBRE_APP_ID = "cumbre-erp";

const existingApp = getApps()[0];
const app = existingApp ?? initializeApp(firebaseConfig);

export const db = getFirestore(app);
export const auth = getAuth(app);
export const storage = getStorage(app);

let emulatorsConnected = false;

function isLocalRuntime() {
  const isBrowserLocalhost =
    typeof window !== "undefined" &&
    ["localhost", "127.0.0.1"].includes(window.location.hostname);

  const isNodeDevelopment =
    typeof process !== "undefined" && process.env?.NODE_ENV === "development";

  return isBrowserLocalhost || isNodeDevelopment;
}

export function connectCumbreLocalEmulators() {
  if (!isLocalRuntime() || emulatorsConnected) {
    return;
  }

  emulatorsConnected = true;
  console.warn("Cumbre: ejecutando con Firebase Emulator Suite local.");

  connectFirestoreEmulator(db, "localhost", 8080);
  connectAuthEmulator(auth, "http://localhost:9099", { disableWarnings: true });
  connectStorageEmulator(storage, "localhost", 9199);
}

connectCumbreLocalEmulators();
