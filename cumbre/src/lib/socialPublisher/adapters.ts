import { formatPostText } from "./content";
import type { SocialNetwork, SocialPublisher, SocialPublisherEnv, SocialPublishResult } from "./types";

type JsonRecord = Record<string, unknown>;

function skipped(network: SocialNetwork, message: string): SocialPublishResult {
  return { network, status: "skipped", message };
}

function blocked(network: SocialNetwork, message: string): SocialPublishResult {
  return { network, status: "blocked", message };
}

function ready(network: SocialNetwork, message: string): SocialPublishResult {
  return { network, status: "ready", message };
}

async function postJson(url: string, headers: HeadersInit, body: JsonRecord): Promise<JsonRecord> {
  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      ...headers,
    },
    body: JSON.stringify(body),
  });
  const payload = (await response.json().catch(() => ({}))) as JsonRecord;
  if (!response.ok) {
    const detail = typeof payload.error === "object" ? JSON.stringify(payload.error) : response.statusText;
    throw new Error(`API ${response.status}: ${detail}`);
  }
  return payload;
}

export function createFacebookPublisher(env: SocialPublisherEnv): SocialPublisher {
  const version = env.META_GRAPH_VERSION || "v20.0";
  return {
    network: "facebook",
    canPublish: () => Boolean(env.META_FACEBOOK_PAGE_ID && env.META_FACEBOOK_PAGE_ACCESS_TOKEN),
    async publish(draft, options) {
      if (!this.canPublish()) {
        return skipped("facebook", "Faltan META_FACEBOOK_PAGE_ID o META_FACEBOOK_PAGE_ACCESS_TOKEN.");
      }
      if (options?.dryRun) {
        return ready("facebook", `Dry-run listo para publicar en Facebook: ${draft.title}`);
      }

      const endpoint = `https://graph.facebook.com/${version}/${env.META_FACEBOOK_PAGE_ID}/feed`;
      const payload = await postJson(endpoint, {}, {
        message: formatPostText(draft),
        link: draft.url,
        access_token: env.META_FACEBOOK_PAGE_ACCESS_TOKEN,
      });

      return {
        network: "facebook",
        status: "published",
        message: "Post publicado en Facebook.",
        remoteId: typeof payload.id === "string" ? payload.id : undefined,
      };
    },
  };
}

export function createInstagramPublisher(env: SocialPublisherEnv): SocialPublisher {
  return {
    network: "instagram",
    canPublish: () => Boolean(env.META_INSTAGRAM_BUSINESS_ACCOUNT_ID && env.META_INSTAGRAM_ACCESS_TOKEN),
    async publish(draft, options) {
      if (!this.canPublish()) {
        return skipped("instagram", "Faltan META_INSTAGRAM_BUSINESS_ACCOUNT_ID o META_INSTAGRAM_ACCESS_TOKEN.");
      }
      if (!draft.imageUrl) {
        return blocked("instagram", "Instagram Graph API requiere imagen o video; no admite post organico solo texto.");
      }
      if (options?.dryRun) {
        return ready("instagram", `Dry-run listo para crear media container en Instagram: ${draft.title}`);
      }
      return blocked("instagram", "Conector preparado, pero requiere flujo media container + publish despues de validar permisos.");
    },
  };
}

export function createLinkedInPublisher(env: SocialPublisherEnv): SocialPublisher {
  return {
    network: "linkedin",
    canPublish: () => Boolean(env.LINKEDIN_ORGANIZATION_ID && env.LINKEDIN_ACCESS_TOKEN),
    async publish(draft, options) {
      if (!this.canPublish()) {
        return skipped("linkedin", "Faltan LINKEDIN_ORGANIZATION_ID o LINKEDIN_ACCESS_TOKEN.");
      }
      if (options?.dryRun) {
        return ready("linkedin", `Dry-run listo para publicar en LinkedIn: ${draft.title}`);
      }

      const payload = await postJson(
        "https://api.linkedin.com/v2/ugcPosts",
        { Authorization: `Bearer ${env.LINKEDIN_ACCESS_TOKEN}` },
        {
          author: `urn:li:organization:${env.LINKEDIN_ORGANIZATION_ID}`,
          lifecycleState: "PUBLISHED",
          specificContent: {
            "com.linkedin.ugc.ShareContent": {
              shareCommentary: { text: formatPostText(draft) },
              shareMediaCategory: "NONE",
            },
          },
          visibility: { "com.linkedin.ugc.MemberNetworkVisibility": "PUBLIC" },
        },
      );

      return {
        network: "linkedin",
        status: "published",
        message: "Post publicado en LinkedIn.",
        remoteId: typeof payload.id === "string" ? payload.id : undefined,
      };
    },
  };
}

export function createPinterestPublisher(env: SocialPublisherEnv): SocialPublisher {
  return {
    network: "pinterest",
    canPublish: () => Boolean(env.PINTEREST_ACCESS_TOKEN && env.PINTEREST_DEFAULT_BOARD_ID),
    async publish(draft, options) {
      const boardId = draft.boardId || env.PINTEREST_DEFAULT_BOARD_ID;
      if (!env.PINTEREST_ACCESS_TOKEN) {
        return skipped("pinterest", "Falta PINTEREST_ACCESS_TOKEN.");
      }
      if (!boardId) {
        return skipped("pinterest", "Falta PINTEREST_DEFAULT_BOARD_ID o boardId en el draft.");
      }
      if (!draft.imageUrl) {
        return blocked("pinterest", "Pinterest requiere una imagen para crear un pin por API.");
      }
      if (options?.dryRun) {
        return ready("pinterest", `Dry-run listo para crear pin en tablero ${boardId}: ${draft.title}`);
      }

      const payload = await postJson(
        "https://api.pinterest.com/v5/pins",
        { Authorization: `Bearer ${env.PINTEREST_ACCESS_TOKEN}` },
        {
          board_id: boardId,
          title: draft.title,
          description: formatPostText(draft),
          link: draft.url,
          media_source: {
            source_type: "image_url",
            url: draft.imageUrl,
          },
        },
      );

      return {
        network: "pinterest",
        status: "published",
        message: "Pin creado en Pinterest.",
        remoteId: typeof payload.id === "string" ? payload.id : undefined,
        remoteUrl: typeof payload.link === "string" ? payload.link : undefined,
      };
    },
  };
}

export function createSocialPublishers(env: SocialPublisherEnv): SocialPublisher[] {
  return [
    createFacebookPublisher(env),
    createInstagramPublisher(env),
    createLinkedInPublisher(env),
    createPinterestPublisher(env),
  ];
}
