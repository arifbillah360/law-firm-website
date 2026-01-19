#!/usr/bin/env python3
"""
Script to convert HTML files to body-only format with inline CSS and JavaScript.
"""

import re
import os

# File mappings: source -> destination
FILE_MAPPINGS = {
    'index.html': 'body-only-pages/home-body.html',
    'index2.html': 'body-only-pages/home-v2-body.html',
    'index-r.html': 'body-only-pages/home-r-body.html',
    'index-example.html': 'body-only-pages/home-example-body.html',
    'about-us.html': 'body-only-pages/about-body.html',
    'contact.html': 'body-only-pages/contact-body.html',
    'case-results.html': 'body-only-pages/case-results-body.html',
    'our-attorneys.html': 'body-only-pages/attorneys-body.html',
    'legal-fees.html': 'body-only-pages/legal-fees-body.html',
    'practice-areas-example.html': 'body-only-pages/practice-areas-body.html',
    'catastrophic-injury.html': 'body-only-pages/practice-area-catastrophic-injury-body.html',
    'practice-areas.html': 'body-only-pages/practice-areas-main-body.html',
}

# Link replacement mappings
LINK_REPLACEMENTS = {
    'index.html': 'home-body.html',
    'index2.html': 'home-v2-body.html',
    'index-r.html': 'home-r-body.html',
    'index-example.html': 'home-example-body.html',
    'about-us.html': 'about-body.html',
    'contact.html': 'contact-body.html',
    'case-results.html': 'case-results-body.html',
    'our-attorneys.html': 'attorneys-body.html',
    'legal-fees.html': 'legal-fees-body.html',
    'practice-areas-example.html': 'practice-areas-body.html',
    'catastrophic-injury.html': 'practice-area-catastrophic-injury-body.html',
    'practice-areas.html': 'practice-areas-main-body.html',
}

def read_file(filepath):
    """Read and return file content."""
    with open(filepath, 'r', encoding='utf-8') as f:
        return f.read()

def extract_main_content(html_content):
    """Extract content inside <main> tags."""
    # Find main content
    main_match = re.search(r'<main[^>]*>(.*?)</main>', html_content, re.DOTALL | re.IGNORECASE)
    if main_match:
        return main_match.group(1)

    # Fallback: look for main-content id or similar
    main_match = re.search(r'<main\s+id="main-content"[^>]*>(.*?)</main>', html_content, re.DOTALL | re.IGNORECASE)
    if main_match:
        return main_match.group(1)

    return ""

def extract_page_scripts(html_content):
    """Extract page-specific JavaScript (not navigation or header loading)."""
    scripts = []

    # Find all script tags
    script_pattern = r'<script[^>]*>(.*?)</script>'
    script_matches = re.findall(script_pattern, html_content, re.DOTALL)

    for script in script_matches:
        # Skip header loading scripts
        if 'header.html' in script or 'footer.html' in script:
            continue
        if 'navigation.js' in script:
            continue
        if script.strip():
            scripts.append(script.strip())

    return '\n\n'.join(scripts) if scripts else ''

def update_links(content):
    """Update internal links to body-only versions."""
    for old_link, new_link in LINK_REPLACEMENTS.items():
        # Match href="filename.html" or href='filename.html'
        content = re.sub(
            rf'href=["\']({re.escape(old_link)})["\']',
            f'href="{new_link}"',
            content,
            flags=re.IGNORECASE
        )
    return content

def create_body_only_html(source_file, dest_file, css_content):
    """Create body-only HTML file."""

    # Read source HTML
    html_content = read_file(source_file)

    # Extract main content
    main_content = extract_main_content(html_content)

    if not main_content:
        print(f"Warning: No main content found in {source_file}")
        return False

    # Update links in main content
    main_content = update_links(main_content)

    # Extract page-specific scripts
    page_scripts = extract_page_scripts(html_content)

    # Build body-only HTML
    body_only_html = f"""<!-- ========================================
     SOURCE: {os.path.basename(source_file)}
     OUTPUT: {os.path.basename(dest_file)}
     BODY CONTENT ONLY (NO HEADER/FOOTER)
     ======================================== -->

<style>
    /* =====================================================
       CSS FOR BODY CONTENT ONLY
       ===================================================== */

{css_content}

</style>

<main id="main-content">
{main_content}
</main>

<script>
    /* =====================================================
       JAVASCRIPT FOR BODY CONTENT ONLY
       ===================================================== */

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {{
        anchor.addEventListener('click', function (e) {{
            const targetId = this.getAttribute('href');
            if (targetId !== '#' && targetId) {{
                e.preventDefault();
                const target = document.querySelector(targetId);
                if (target) {{
                    target.scrollIntoView({{ behavior: 'smooth' }});
                }}
            }}
        }});
    }});

    // Page-specific functionality
{page_scripts}
</script>
"""

    # Write output file
    with open(dest_file, 'w', encoding='utf-8') as f:
        f.write(body_only_html)

    print(f"Created: {dest_file}")
    return True

def main():
    """Main conversion function."""
    base_dir = '/home/user/law-firm-website'
    os.chdir(base_dir)

    # Read CSS content
    css_file = 'assets/css/style.css'
    print(f"Reading CSS from {css_file}...")
    css_content = read_file(css_file)

    # Ensure output directory exists
    os.makedirs('body-only-pages', exist_ok=True)

    # Convert each file
    success_count = 0
    for source_file, dest_file in FILE_MAPPINGS.items():
        print(f"\nConverting {source_file} -> {dest_file}")
        if os.path.exists(source_file):
            if create_body_only_html(source_file, dest_file, css_content):
                success_count += 1
        else:
            print(f"Warning: Source file not found: {source_file}")

    print(f"\n{'='*60}")
    print(f"Conversion complete: {success_count}/{len(FILE_MAPPINGS)} files converted successfully")
    print(f"{'='*60}")

if __name__ == '__main__':
    main()
