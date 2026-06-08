import { doc, setDoc } from "firebase/firestore";

import { db } from "../firebaseConfig";
import { stabilityCollectionPath } from "./model";
import type { StabilitySnapshot } from "./types";

async function saveCollectionItems<T extends { id: string }>(
  tenantId: string,
  collection: "checks" | "events" | "recommendations" | "notifications",
  items: T[]
) {
  await Promise.all(
    items.map((item) => {
      const ref = doc(db, ...stabilityCollectionPath(tenantId, collection), item.id);
      return setDoc(ref, item, { merge: true });
    })
  );
}

export async function saveStabilitySnapshot(snapshot: StabilitySnapshot) {
  const summaryRef = doc(
    db,
    ...stabilityCollectionPath(snapshot.tenantId, "checks"),
    `summary-${Date.parse(snapshot.generatedAt)}`
  );

  await Promise.all([
    setDoc(
      summaryRef,
      {
        tenantId: snapshot.tenantId,
        status: snapshot.status,
        severity: snapshot.severity,
        generatedAt: snapshot.generatedAt,
        checkCount: snapshot.checks.length,
        eventCount: snapshot.events.length,
        recommendationCount: snapshot.recommendations.length
      },
      { merge: true }
    ),
    saveCollectionItems(snapshot.tenantId, "checks", snapshot.checks),
    saveCollectionItems(snapshot.tenantId, "events", snapshot.events),
    saveCollectionItems(snapshot.tenantId, "recommendations", snapshot.recommendations),
    saveCollectionItems(snapshot.tenantId, "notifications", snapshot.notifications)
  ]);
}
