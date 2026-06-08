import { evaluateTargetResult } from "./rules";
import type { StabilityCheckResult, StabilityTarget } from "./types";

export interface ServerMetricSample {
  targetId: string;
  value: number;
  unit?: string;
  collectedAt: string;
  evidence: string[];
}

export function checksFromServerMetrics(
  targets: StabilityTarget[],
  samples: ServerMetricSample[]
): StabilityCheckResult[] {
  return samples.flatMap((sample) => {
    const target = targets.find((candidate) => candidate.id === sample.targetId);

    if (!target) {
      return [];
    }

    return [
      evaluateTargetResult(target, sample.collectedAt, {
        ok: true,
        observedValue: sample.value,
        message: `${target.label}: ${sample.value}${sample.unit ? ` ${sample.unit}` : ""}.`,
        evidence: sample.evidence
      })
    ];
  });
}
