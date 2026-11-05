# Zest Holdings – WordPress theme

Custom classic PHP theme (no page builder). Requires WordPress 6.2+ and PHP 7.4+.

## Install (LocalWP or live hosting)

1. **Upload the theme**: WP Admin → Appearance → Themes → Add New → Upload → `zest-theme.zip` → Activate.
   (or copy the `zest-theme` folder into `wp-content/themes/`).
2. **Create all content in one click**: Appearance → **Zest Setup** → *Create site content*.
   or with WP-CLI: `wp eval-file wp-content/themes/zest-theme/seed/seed.php`
   This creates all pages, the 3 verticals, 23 service pages, 4 sample jobs, the main and footer menus, sets Home as the front page and permalinks to `/%postname%/`.
   It is safe to run again: existing items are never overwritten.
3. **Company details**: Appearance → Customize → *Zest – Company details* (phone, emails, address, PSARA licence, map text).
4. **Recommended plugins**
   - **WP Mail SMTP**: required on most hosts so form emails are actually delivered.
   - **ACF (free)**: optional. Fields work without it through native meta boxes.
   - **Yoast SEO** or **Rank Math**: optional. The theme's own meta tags switch off automatically when either is active.

## Where to edit content

| What | Where |
|---|---|
| Home hero text, badges, stats | Pages → Home → "Home page content" box (stats: one per line as `Value \| Label`) |
| Vertical landing pages (intro, tagline, highlights) | Services → Verticals → edit |
| Service pages (text, tagline, features, industries, icon) | Services → All services |
| About "Our story" | Pages → About Us (page content) |
| Job openings | Jobs → All openings (**sample jobs are included, so review or delete them before launch**) |
| Form submissions | **Enquiries** (every form is saved here even if email fails) |
| Menus | Appearance → Menus |
| Photos | Add a *Featured image* to a service to replace its labelled placeholder |

## URLs

- `/services/`: all verticals
- `/services/security-services/`, `/services/housekeeping-facility-management/`, `/services/cafeteria-food-services/`: vertical landing pages
- `/services/<vertical>/<service>/`: service detail
- `/about/`, `/industries/`, `/smart-solutions/`, `/careers/`, `/contact/`, `/request-a-quote/`, `/privacy-policy/`

## Forms

Contact, Request a Quote and Job Application (with CV upload: PDF/DOC/DOCX, max 5 MB) use a native handler with a nonce, a honeypot, sanitisation and `wp_mail()`.
Emails go to the "Send form enquiries to" address in the Customizer. CVs are stored in `wp-content/uploads/zest-cv/` with random file names.
