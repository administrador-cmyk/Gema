import { useCallback, useEffect, useState } from "react";

import { runStabilityChecks } from "./collector";
import { saveStabilitySnapshot } from "./store";
import type { StabilitySnapshot } from "./types";

export function useStabilityCenter(tenantId: string | undefined) {
  const [snapshot, setSnapshot] = useState<StabilitySnapshot | null>(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const refresh = useCallback(async () => {
    if (!tenantId) {
      setError("No hay tenant autenticado para ejecutar checks de estabilidad.");
      return;
    }

    setLoading(true);
    setError(null);

    try {
      const nextSnapshot = await runStabilityChecks(tenantId);
      setSnapshot(nextSnapshot);
      await saveStabilitySnapshot(nextSnapshot);
    } catch (unknownError) {
      setError(unknownError instanceof Error ? unknownError.message : "Error desconocido al ejecutar estabilidad.");
    } finally {
      setLoading(false);
    }
  }, [tenantId]);

  useEffect(() => {
    void refresh();
  }, [refresh]);

  return {
    snapshot,
    loading,
    error,
    refresh
  };
}
