export { createSocialPublishers } from "./adapters";
export { buildInstitutionalDrafts, formatPostText, socialAccountPolicies } from "./content";
export type {
  PublishStatus,
  SocialAccessOwner,
  SocialAccountPolicy,
  SocialNetwork,
  SocialPostDraft,
  SocialPublisher,
  SocialPublisherEnv,
  SocialPublishResult,
} from "./types";

import { createSocialPublishers } from "./adapters";
import { buildInstitutionalDrafts } from "./content";
import type { SocialPublisherEnv, SocialPublishResult } from "./types";

export async function runSocialPublisherDryRun(env: SocialPublisherEnv): Promise<SocialPublishResult[]> {
  const publishers = createSocialPublishers(env);
  const drafts = buildInstitutionalDrafts();

  return Promise.all(
    publishers.map((publisher) => {
      const draft = drafts.find((item) => item.network === publisher.network);
      if (!draft) {
        return Promise.resolve({
          network: publisher.network,
          status: "skipped",
          message: "No hay draft institucional definido para esta red.",
        } satisfies SocialPublishResult);
      }
      return publisher.publish(draft, { dryRun: true });
    }),
  );
}
