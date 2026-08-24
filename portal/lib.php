<?php
declare(strict_types=1);

const PORTAL_DATA_DIRECTORY = __DIR__ . '/data';
const PORTAL_DATABASE_PATH = PORTAL_DATA_DIRECTORY . '/portal.sqlite';

function portal_database(): PDO
{
    if (!extension_loaded('pdo_sqlite')) {
        throw new RuntimeException('The PHP PDO SQLite extension is required for the AIS portal.');
    }

    if (!is_dir(PORTAL_DATA_DIRECTORY) && !mkdir(PORTAL_DATA_DIRECTORY, 0775, true) && !is_dir(PORTAL_DATA_DIRECTORY)) {
        throw new RuntimeException('Unable to create the portal data directory.');
    }

    $database = new PDO('sqlite:' . PORTAL_DATABASE_PATH);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $database->exec('PRAGMA busy_timeout = 5000');
    portal_initialize_database($database);

    return $database;
}

function portal_initialize_database(PDO $database): void
{
    $database->exec("CREATE TABLE IF NOT EXISTS cards (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT NOT NULL DEFAULT '',
        url TEXT NOT NULL,
        icon TEXT NOT NULL DEFAULT 'fas fa-globe',
        variant TEXT NOT NULL DEFAULT 'standard',
        badge_text TEXT NOT NULL DEFAULT '',
        badge_color TEXT NOT NULL DEFAULT '#ef4444',
        is_active INTEGER NOT NULL DEFAULT 1,
        sort_order INTEGER NOT NULL,
        created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
    )");

    if ((int) $database->query('SELECT COUNT(*) FROM cards')->fetchColumn() !== 0) {
        return;
    }

    $cards = [
        ['Join AIS Team! 💙', 'Become a part of our core team today.', 'https://ais-official.sfc.keio.ac.jp/hub/?page_id=75', 'fas fa-user-plus', 'hero', '', '#ef4444'],
        ['2026 Enoshima Trip Form', 'Signup Now!', 'https://docs.google.com/forms/d/e/1FAIpQLSd1-pWTMLevh18uKz1DgJlIpMcFaTNv_7QACqhIU7qk4BxIUA/viewform?usp=dialog', 'fas fa-lightbulb', 'highlight', 'NEW', '#ef4444'],
        ['GIGA Freshmen Hub 2026', 'Essential guides, dorm info, and orientation materials.', 'https://ais-official.sfc.keio.ac.jp/hub/?page_id=110', 'fas fa-globe', 'standard', '', '#ef4444'],
        ['AIS Official Website', 'Introduction to AIS.', 'https://ais-official.sfc.keio.ac.jp/', 'fas fa-globe', 'standard', '', '#ef4444'],
        ['AIS Todo', 'Todo Kanban', 'https://ais-official.sfc.keio.ac.jp/todo/', 'fas fa-globe', 'standard', '', '#ef4444'],
        ['AIS Hub', 'Explore events, blogs, and survival guides.', 'https://ais-official.sfc.keio.ac.jp/hub/', 'fas fa-globe', 'standard', '', '#ef4444'],
    ];
    $statement = $database->prepare('INSERT INTO cards (title, description, url, icon, variant, badge_text, badge_color, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    foreach ($cards as $position => $card) {
        $statement->execute([...$card, $position + 1]);
    }
}

function portal_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function portal_cards(PDO $database, bool $includeInactive = false): array
{
    $query = 'SELECT * FROM cards' . ($includeInactive ? '' : ' WHERE is_active = 1') . ' ORDER BY sort_order ASC, id ASC';
    return $database->query($query)->fetchAll();
}

function portal_allowed_icons(): array
{
    return ['fas fa-globe' => 'Globe', 'fas fa-user-plus' => 'Join / user', 'fas fa-lightbulb' => 'Lightbulb', 'fas fa-folder-open' => 'Folder', 'fas fa-calendar-days' => 'Calendar', 'fas fa-file-lines' => 'Document', 'fas fa-people-group' => 'People', 'fas fa-location-dot' => 'Location', 'fas fa-graduation-cap' => 'Graduation cap', 'fas fa-envelope' => 'Email'];
}

function portal_validate_card(array $input): array
{
    $card = ['title' => trim((string) ($input['title'] ?? '')), 'description' => trim((string) ($input['description'] ?? '')), 'url' => trim((string) ($input['url'] ?? '')), 'icon' => (string) ($input['icon'] ?? 'fas fa-globe'), 'variant' => (string) ($input['variant'] ?? 'standard'), 'badge_text' => trim((string) ($input['badge_text'] ?? '')), 'badge_color' => (string) ($input['badge_color'] ?? '#ef4444'), 'is_active' => isset($input['is_active']) ? 1 : 0];
    $errors = [];
    if ($card['title'] === '' || strlen($card['title']) > 100) { $errors[] = 'Title is required and must be 100 characters or fewer.'; }
    if (strlen($card['description']) > 250) { $errors[] = 'Description must be 250 characters or fewer.'; }
    $scheme = parse_url($card['url'], PHP_URL_SCHEME);
    if ($card['url'] === '' || !in_array($scheme, ['http', 'https', 'mailto'], true)) { $errors[] = 'Link must use http, https, or mailto.'; }
    if (!array_key_exists($card['icon'], portal_allowed_icons())) { $errors[] = 'Choose an icon from the list.'; }
    if (!in_array($card['variant'], ['standard', 'hero', 'highlight'], true)) { $errors[] = 'Choose a valid card style.'; }
    if (strlen($card['badge_text']) > 24) { $errors[] = 'Badge text must be 24 characters or fewer.'; }
    if (!preg_match('/^#[0-9a-fA-F]{6}$/', $card['badge_color'])) { $errors[] = 'Badge color must be a six-digit hexadecimal color.'; }
    return [$card, $errors];
}
