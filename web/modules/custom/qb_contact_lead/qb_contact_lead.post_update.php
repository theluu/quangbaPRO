<?php

/**
 * Ensures the QB Contact content type exists on existing installs.
 */
function qb_contact_lead_post_update_create_qb_contact_type(): void {
  require_once __DIR__ . '/qb_contact_lead.install';
  qb_contact_lead_ensure_contact_content_type();
}
