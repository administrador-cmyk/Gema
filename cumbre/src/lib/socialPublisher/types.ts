export type SocialNetwork =
  | "facebook"
  | "instagram"
  | "linkedin"
  | "pinterest"
  | "youtube"
  | "x";

export type SocialAccessOwner = "info@generatuenergia.net" | "info@gema-digital.com";

export type PublishStatus = "ready" | "published" | "skipped" | "blocked" | "failed";

export interface SocialAccountPolicy {
  network: SocialNetwork;
  ownerLogin: SocialAccessOwner;
  publicProfile: string;
  canUseApiNow: boolean;
  notes: string;
}

export interface SocialPostDraft {
  network: SocialNetwork;
  title: string;
  body: string;
  url: string;
  hashtags: string[];
  imageUrl?: string;
  boardId?: string;
}

export interface SocialPublishResult {
  network: SocialNetwork;
  status: PublishStatus;
  message: string;
  remoteId?: string;
  remoteUrl?: string;
}

export interface SocialPublisher {
  network: SocialNetwork;
  canPublish(): boolean;
  publish(draft: SocialPostDraft, options?: { dryRun?: boolean }): Promise<SocialPublishResult>;
}

export interface SocialPublisherEnv {
  META_GRAPH_VERSION?: string;
  META_FACEBOOK_PAGE_ID?: string;
  META_FACEBOOK_PAGE_ACCESS_TOKEN?: string;
  META_INSTAGRAM_BUSINESS_ACCOUNT_ID?: string;
  META_INSTAGRAM_ACCESS_TOKEN?: string;
  LINKEDIN_ORGANIZATION_ID?: string;
  LINKEDIN_ACCESS_TOKEN?: string;
  PINTEREST_ACCESS_TOKEN?: string;
  PINTEREST_DEFAULT_BOARD_ID?: string;
  YOUTUBE_CHANNEL_ID?: string;
  YOUTUBE_ACCESS_TOKEN?: string;
  X_ACCESS_TOKEN?: string;
}
