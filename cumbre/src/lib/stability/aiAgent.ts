import type { StabilityEvent, StabilityRecommendation, StabilitySnapshot } from "./types";

export interface StabilityAiProvider {
  explain(event: StabilityEvent): Promise<StabilityRecommendation>;
}

function actionPrefix(event: StabilityEvent) {
  if (event.severity === "incident") {
    return "Incidente activo";
  }

  if (event.severity === "critical") {
    return "Riesgo critico";
  }

  if (event.severity === "warning") {
    return "Advertencia temprana";
  }

  return "Observacion";
}

export function explainEvent(event: StabilityEvent): StabilityRecommendation {
  const canAutoRemediate = Boolean(event.remediationKey) && !event.requiresHumanApproval;

  return {
    id: `ai-${event.id}`,
    severity: event.severity,
    title: `${actionPrefix(event)}: ${event.title}`,
    explanation: `${event.summary} ${event.risk}`,
    nextAction: canAutoRemediate
      ? `${event.recommendation} El sistema puede preparar una remediacion automatica permitida.`
      : `${event.recommendation} Requiere aprobacion humana antes de acciones sensibles.`,
    canAutoRemediate,
    remediationKey: event.remediationKey,
    createdAt: event.detectedAt
  };
}

export function enrichSnapshotWithAi(snapshot: StabilitySnapshot): StabilitySnapshot {
  const aiRecommendations = snapshot.events.map(explainEvent);
  const recommendationIds = new Set(snapshot.recommendations.map((recommendation) => recommendation.id));
  const mergedRecommendations = [
    ...snapshot.recommendations,
    ...aiRecommendations.filter((recommendation) => !recommendationIds.has(recommendation.id))
  ];

  return {
    ...snapshot,
    recommendations: mergedRecommendations
  };
}

export async function enrichSnapshotWithProvider(
  snapshot: StabilitySnapshot,
  provider: StabilityAiProvider
): Promise<StabilitySnapshot> {
  const providerRecommendations = await Promise.all(snapshot.events.map((event) => provider.explain(event)));
  const recommendationIds = new Set(snapshot.recommendations.map((recommendation) => recommendation.id));

  return {
    ...snapshot,
    recommendations: [
      ...snapshot.recommendations,
      ...providerRecommendations.filter((recommendation) => !recommendationIds.has(recommendation.id))
    ]
  };
}
