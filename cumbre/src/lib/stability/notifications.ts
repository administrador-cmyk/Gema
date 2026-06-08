import type { NotificationChannel, StabilityEvent, StabilityNotification, StabilitySeverity } from "./types";

export interface NotificationProvider {
  channel: NotificationChannel;
  configured: boolean;
  send(notification: StabilityNotification): Promise<StabilityNotification>;
}

const CHANNELS_BY_SEVERITY: Record<StabilitySeverity, NotificationChannel[]> = {
  info: ["panel"],
  warning: ["panel", "email"],
  critical: ["panel", "email", "whatsapp"],
  incident: ["panel", "email", "whatsapp"]
};

function deliveryStatusForChannel(channel: NotificationChannel) {
  return channel === "panel" ? "queued" : "requires-config";
}

export function notificationsFromEvents(events: StabilityEvent[]): StabilityNotification[] {
  return events.flatMap((event) =>
    CHANNELS_BY_SEVERITY[event.severity].map((channel) => ({
      id: `notify-${channel}-${event.id}`,
      channel,
      severity: event.severity,
      title: event.title,
      body: `${event.summary} Recomendacion: ${event.recommendation}`,
      createdAt: event.detectedAt,
      deliveryStatus: deliveryStatusForChannel(channel)
    }))
  );
}

export function createPanelNotificationProvider(): NotificationProvider {
  return {
    channel: "panel",
    configured: true,
    async send(notification) {
      return {
        ...notification,
        deliveryStatus: "sent"
      };
    }
  };
}

export function createPendingProvider(channel: Exclude<NotificationChannel, "panel">): NotificationProvider {
  return {
    channel,
    configured: false,
    async send(notification) {
      return {
        ...notification,
        deliveryStatus: "requires-config"
      };
    }
  };
}
