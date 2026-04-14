<?php
$currentLang = function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt';

if (function_exists('loadTranslations')) {
    $translations = loadTranslations($currentLang);
}

$accessibilityWidget = $translations['accessibilityWidget'] ?? [
    'dialogLabel' => 'Accessibility settings',
    'title' => 'Accessibility',
    'description' => 'Adjust the page in real time.',
    'openLabel' => 'Open accessibility menu',
    'openTitle' => 'Accessibility',
    'close' => 'Close accessibility menu',
    'reset' => 'Restore default settings',
    'helpOpen' => 'Understand accessibility options',
    'helpDialogLabel' => 'Accessibility help',
    'helpTitle' => 'How each option works',
    'helpDescription' => 'See what each accessibility option changes on the page.',
    'helpClose' => 'Close help',
    'sections' => [
        'textSize' => 'Text size',
        'contrast' => 'Contrast',
        'links' => 'Links',
        'focus' => 'Keyboard focus',
        'motion' => 'Reduce animations',
        'letterSpacing' => 'Letter spacing',
        'lineHeight' => 'Line spacing'
    ],
    'options' => [
        'textSizeLarge' => 'Large',
        'textSizeLarger' => 'Larger',
        'contrastHigh' => 'High',
        'contrastSoft' => 'Soft',
        'linksHighlighted' => 'Highlighted',
        'focusStrong' => 'Strong',
        'motionReduced' => 'Reduced',
        'letterSpacingWide' => 'Wide',
        'letterSpacingWider' => 'Wider',
        'lineHeightRelaxed' => 'Relaxed',
        'lineHeightSpacious' => 'Spacious'
    ],
    'help' => [
        'items' => [
            'textSize' => [
                'description' => 'Increases text size for easier reading.',
                'levels' => [
                    'large' => 'First level of text increase.',
                    'larger' => 'Second level with even larger text.'
                ]
            ],
            'contrast' => [
                'description' => 'Changes page contrast to improve visual comfort.',
                'levels' => [
                    'high' => 'Stronger contrast between text and background.',
                    'soft' => 'Softer contrast for a lighter visual effect.'
                ]
            ],
            'links' => [
                'description' => 'Highlights links to make navigation points easier to notice.',
                'levels' => [
                    'highlighted' => 'Underlines and emphasizes links on the page.'
                ]
            ],
            'focus' => [
                'description' => 'Makes keyboard navigation focus more visible.',
                'levels' => [
                    'strong' => 'Shows a stronger outline on the selected element.'
                ]
            ],
            'motion' => [
                'description' => 'Reduces transitions and animations.',
                'levels' => [
                    'reduced' => 'Decreases movement effects that may cause discomfort.'
                ]
            ],
            'letterSpacing' => [
                'description' => 'Adds more space between letters.',
                'levels' => [
                    'wide' => 'Applies a moderate letter spacing increase.',
                    'wider' => 'Applies a stronger letter spacing increase.'
                ]
            ],
            'lineHeight' => [
                'description' => 'Adds more vertical space between lines of text.',
                'levels' => [
                    'relaxed' => 'Applies a moderate line spacing increase.',
                    'spacious' => 'Applies a stronger line spacing increase.'
                ]
            ]
        ]
    ],
    'announcements' => [
        'preferencesUpdated' => 'Accessibility preferences updated.',
        'preferencesReset' => 'Accessibility preferences restored.'
    ]
];

$scrollToTopLabel = isset($translations['scrollToTop']['label'])
    ? $translations['scrollToTop']['label']
    : 'Back to top';
$scrollToTopTitle = isset($translations['scrollToTop']['title'])
    ? $translations['scrollToTop']['title']
    : 'Back to top';
?>
<div
    id="accessibilityWidget"
    data-storage-key="maribeAccessibilityPreferences"
    data-preferences-updated="<?php echo htmlspecialchars($accessibilityWidget['announcements']['preferencesUpdated'], ENT_QUOTES, 'UTF-8'); ?>"
    data-preferences-reset="<?php echo htmlspecialchars($accessibilityWidget['announcements']['preferencesReset'], ENT_QUOTES, 'UTF-8'); ?>"
>
    <div id="floatingActionWidget" class="floating-action-widget" aria-hidden="false">
        <button
            type="button"
            id="accessibilityToggleButton"
            class="floating-action-widget__button floating-action-widget__button--accessibility"
            data-accessibility-open
            aria-label="<?php echo htmlspecialchars($accessibilityWidget['openLabel'], ENT_QUOTES, 'UTF-8'); ?>"
            aria-expanded="false"
            title="<?php echo htmlspecialchars($accessibilityWidget['openTitle'], ENT_QUOTES, 'UTF-8'); ?>"
        >
            <svg class="floating-action-widget__icon" viewBox="0 0 512 512" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
                <path d="M256 112a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                <path d="m432 112.8-.45.12-.42.13c-1 .28-2 .58-3 .89-18.61 5.46-108.93 30.92-172.56 30.92-59.13 0-141.28-22-167.56-29.47a73.79 73.79 0 0 0-8-2.58c-19-5-32 14.3-32 31.94 0 17.47 15.7 25.79 31.55 31.76v.28l95.22 29.74c9.73 3.73 12.33 7.54 13.6 10.84 4.13 10.59.83 31.56-.34 38.88l-5.8 45-32.19 176.19q-.15.72-.27 1.47l-.23 1.27c-2.32 16.15 9.54 31.82 32 31.82 19.6 0 28.25-13.53 32-31.94s28-157.57 42-157.57 42.84 157.57 42.84 157.57c3.75 18.41 12.4 31.94 32 31.94 22.52 0 34.38-15.74 32-31.94a57.17 57.17 0 0 0-.76-4.06L329 301.27l-5.79-45c-4.19-26.21-.82-34.87.32-36.9a1.09 1.09 0 0 0 .08-.15c1.08-2 6-6.48 17.48-10.79l89.28-31.21a16.9 16.9 0 0 0 1.62-.52c16-6 32-14.3 32-31.93S451 107.81 432 112.8z"></path>
            </svg>
        </button>

        <span class="floating-action-widget__divider" aria-hidden="true"></span>

        <button
            type="button"
            id="scrollToTopButton"
            class="floating-action-widget__button floating-action-widget__button--top"
            aria-label="<?php echo htmlspecialchars($scrollToTopLabel, ENT_QUOTES, 'UTF-8'); ?>"
            title="<?php echo htmlspecialchars($scrollToTopTitle, ENT_QUOTES, 'UTF-8'); ?>"
        >
            <i class="ph-bold ph-caret-up" aria-hidden="true"></i>
        </button>
    </div>

    <div id="accessibilityWidgetBackdrop" class="accessibility-widget__backdrop" hidden></div>

    <aside
        id="accessibilityWidgetPanel"
        class="accessibility-widget__panel"
        role="dialog"
        aria-modal="true"
        aria-label="<?php echo htmlspecialchars($accessibilityWidget['dialogLabel'], ENT_QUOTES, 'UTF-8'); ?>"
        aria-labelledby="accessibilityWidgetTitle"
        aria-describedby="accessibilityWidgetDescription"
        aria-hidden="true"
        hidden
        tabindex="-1"
    >
        <div class="accessibility-widget__header">
            <div class="accessibility-widget__header-copy">
                <h2 id="accessibilityWidgetTitle"><?php echo htmlspecialchars($accessibilityWidget['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p id="accessibilityWidgetDescription"><?php echo htmlspecialchars($accessibilityWidget['description'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div class="accessibility-widget__header-actions">
                <button
                    type="button"
                    class="accessibility-widget__icon-button"
                    data-accessibility-help-open
                    aria-label="<?php echo htmlspecialchars($accessibilityWidget['helpOpen'], ENT_QUOTES, 'UTF-8'); ?>"
                    title="<?php echo htmlspecialchars($accessibilityWidget['helpOpen'], ENT_QUOTES, 'UTF-8'); ?>"
                >
                    <i class="ph ph-question-mark" aria-hidden="true"></i>
                </button>
                <button
                    type="button"
                    class="accessibility-widget__icon-button"
                    data-accessibility-close
                    aria-label="<?php echo htmlspecialchars($accessibilityWidget['close'], ENT_QUOTES, 'UTF-8'); ?>"
                >
                    <i class="ph ph-x" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <div class="accessibility-widget__content">
            <div class="accessibility-widget__feature-list" role="list" aria-label="<?php echo htmlspecialchars($accessibilityWidget['title'], ENT_QUOTES, 'UTF-8'); ?>">
                <button
                    type="button"
                    class="accessibility-widget__feature-card"
                    data-accessibility-card="textSize"
                    data-accessibility-setting="textSize"
                    data-cycle-values="large,larger"
                    aria-labelledby="accessibilityWidgetTextSizeLabel"
                >
                    <div class="accessibility-widget__feature-card-header">
                        <span class="accessibility-widget__feature-icon" aria-hidden="true">
                            <i class="ph ph-text-aa"></i>
                        </span>
                        <div class="accessibility-widget__feature-indicators" aria-hidden="true">
                            <span class="accessibility-widget__choice-dot"></span>
                            <span class="accessibility-widget__choice-dot"></span>
                        </div>
                    </div>
                    <h3 id="accessibilityWidgetTextSizeLabel" class="accessibility-widget__feature-title"><?php echo htmlspecialchars($accessibilityWidget['sections']['textSize'], ENT_QUOTES, 'UTF-8'); ?></h3>
                </button>

                <button
                    type="button"
                    class="accessibility-widget__feature-card"
                    data-accessibility-card="contrast"
                    data-accessibility-setting="contrast"
                    data-cycle-values="high,soft"
                    aria-labelledby="accessibilityWidgetContrastLabel"
                >
                    <div class="accessibility-widget__feature-card-header">
                        <span class="accessibility-widget__feature-icon" aria-hidden="true">
                            <i class="ph ph-circle-half"></i>
                        </span>
                        <div class="accessibility-widget__feature-indicators" aria-hidden="true">
                            <span class="accessibility-widget__choice-dot"></span>
                            <span class="accessibility-widget__choice-dot"></span>
                        </div>
                    </div>
                    <h3 id="accessibilityWidgetContrastLabel" class="accessibility-widget__feature-title"><?php echo htmlspecialchars($accessibilityWidget['sections']['contrast'], ENT_QUOTES, 'UTF-8'); ?></h3>
                </button>

                <button
                    type="button"
                    class="accessibility-widget__feature-card"
                    data-accessibility-card="links"
                    data-accessibility-setting="links"
                    data-cycle-values="highlighted"
                    aria-labelledby="accessibilityWidgetLinksLabel"
                >
                    <div class="accessibility-widget__feature-card-header">
                        <span class="accessibility-widget__feature-icon" aria-hidden="true">
                            <i class="ph ph-link"></i>
                        </span>
                        <div class="accessibility-widget__feature-indicators" aria-hidden="true">
                            <span class="accessibility-widget__choice-dot"></span>
                        </div>
                    </div>
                    <h3 id="accessibilityWidgetLinksLabel" class="accessibility-widget__feature-title"><?php echo htmlspecialchars($accessibilityWidget['sections']['links'], ENT_QUOTES, 'UTF-8'); ?></h3>
                </button>

                <button
                    type="button"
                    class="accessibility-widget__feature-card"
                    data-accessibility-card="focus"
                    data-accessibility-setting="focus"
                    data-cycle-values="strong"
                    aria-labelledby="accessibilityWidgetFocusLabel"
                >
                    <div class="accessibility-widget__feature-card-header">
                        <span class="accessibility-widget__feature-icon" aria-hidden="true">
                            <i class="ph ph-key-return"></i>
                        </span>
                        <div class="accessibility-widget__feature-indicators" aria-hidden="true">
                            <span class="accessibility-widget__choice-dot"></span>
                        </div>
                    </div>
                    <h3 id="accessibilityWidgetFocusLabel" class="accessibility-widget__feature-title"><?php echo htmlspecialchars($accessibilityWidget['sections']['focus'], ENT_QUOTES, 'UTF-8'); ?></h3>
                </button>

                <button
                    type="button"
                    class="accessibility-widget__feature-card"
                    data-accessibility-card="motion"
                    data-accessibility-setting="motion"
                    data-cycle-values="reduced"
                    aria-labelledby="accessibilityWidgetMotionLabel"
                >
                    <div class="accessibility-widget__feature-card-header">
                        <span class="accessibility-widget__feature-icon" aria-hidden="true">
                            <i class="ph ph-arrows-left-right"></i>
                        </span>
                        <div class="accessibility-widget__feature-indicators" aria-hidden="true">
                            <span class="accessibility-widget__choice-dot"></span>
                        </div>
                    </div>
                    <h3 id="accessibilityWidgetMotionLabel" class="accessibility-widget__feature-title"><?php echo htmlspecialchars($accessibilityWidget['sections']['motion'], ENT_QUOTES, 'UTF-8'); ?></h3>
                </button>

                <button
                    type="button"
                    class="accessibility-widget__feature-card"
                    data-accessibility-card="letterSpacing"
                    data-accessibility-setting="letterSpacing"
                    data-cycle-values="wide,wider"
                    aria-labelledby="accessibilityWidgetLetterSpacingLabel"
                >
                    <div class="accessibility-widget__feature-card-header">
                        <span class="accessibility-widget__feature-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" focusable="false" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.19983 14H8.3539L9.55389 11H14.4458L15.6458 14H17.7998L12.9998 2H10.9998L6.19983 14ZM11.9998 4.88517 13.6458 9H10.3539L11.9998 4.88517ZM3 16V22L5 22 4.99992 20H18.9999L19 22 21 22 20.9999 16H18.9999V18H4.99992L5 16 3 16Z"></path>
                            </svg>
                        </span>
                        <div class="accessibility-widget__feature-indicators" aria-hidden="true">
                            <span class="accessibility-widget__choice-dot"></span>
                            <span class="accessibility-widget__choice-dot"></span>
                        </div>
                    </div>
                    <h3 id="accessibilityWidgetLetterSpacingLabel" class="accessibility-widget__feature-title"><?php echo htmlspecialchars($accessibilityWidget['sections']['letterSpacing'], ENT_QUOTES, 'UTF-8'); ?></h3>
                </button>

                <button
                    type="button"
                    class="accessibility-widget__feature-card"
                    data-accessibility-card="lineHeight"
                    data-accessibility-setting="lineHeight"
                    data-cycle-values="relaxed,spacious"
                    aria-labelledby="accessibilityWidgetLineHeightLabel"
                >
                    <div class="accessibility-widget__feature-card-header">
                        <span class="accessibility-widget__feature-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" focusable="false" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 7h2.5L5 3.5 1.5 7H4v10H1.5L5 20.5 8.5 17H6V7zm4-2v2h12V5H10zm0 14h12v-2H10v2zm0-6h12v-2H10v2z"></path>
                            </svg>
                        </span>
                        <div class="accessibility-widget__feature-indicators" aria-hidden="true">
                            <span class="accessibility-widget__choice-dot"></span>
                            <span class="accessibility-widget__choice-dot"></span>
                        </div>
                    </div>
                    <h3 id="accessibilityWidgetLineHeightLabel" class="accessibility-widget__feature-title"><?php echo htmlspecialchars($accessibilityWidget['sections']['lineHeight'], ENT_QUOTES, 'UTF-8'); ?></h3>
                </button>
            </div>
        </div>

        <div class="accessibility-widget__footer" data-accessibility-reset-container>
            <button type="button" class="accessibility-widget__reset-button" data-accessibility-reset>
                <?php echo htmlspecialchars($accessibilityWidget['reset'], ENT_QUOTES, 'UTF-8'); ?>
            </button>
        </div>

        <div class="accessibility-widget__help-layer" data-accessibility-help-layer hidden>
            <div class="accessibility-widget__help-backdrop" data-accessibility-help-close></div>
            <section
                id="accessibilityWidgetHelpModal"
                class="accessibility-widget__help-modal"
                role="dialog"
                aria-modal="true"
                aria-label="<?php echo htmlspecialchars($accessibilityWidget['helpDialogLabel'], ENT_QUOTES, 'UTF-8'); ?>"
                aria-labelledby="accessibilityWidgetHelpTitle"
                aria-describedby="accessibilityWidgetHelpDescription"
                tabindex="-1"
            >
                <div class="accessibility-widget__help-header">
                    <div class="accessibility-widget__help-copy">
                        <h3 id="accessibilityWidgetHelpTitle"><?php echo htmlspecialchars($accessibilityWidget['helpTitle'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p id="accessibilityWidgetHelpDescription"><?php echo htmlspecialchars($accessibilityWidget['helpDescription'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <button
                        type="button"
                        class="accessibility-widget__icon-button"
                        data-accessibility-help-close
                        aria-label="<?php echo htmlspecialchars($accessibilityWidget['helpClose'], ENT_QUOTES, 'UTF-8'); ?>"
                    >
                        <i class="ph ph-x" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="accessibility-widget__help-content">
                    <?php foreach ($accessibilityWidget['help']['items'] as $itemKey => $item): ?>
                        <article class="accessibility-widget__help-item">
                            <h4><?php echo htmlspecialchars($accessibilityWidget['sections'][$itemKey], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <ul>
                                <?php foreach ($item['levels'] as $levelKey => $levelDescription): ?>
                                    <li>
                                        <strong><?php echo htmlspecialchars($accessibilityWidget['options'][$itemKey . ucfirst($levelKey)] ?? $levelKey, ENT_QUOTES, 'UTF-8'); ?>:</strong>
                                        <?php echo htmlspecialchars($levelDescription, ENT_QUOTES, 'UTF-8'); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </aside>

    <p id="accessibilityWidgetLiveRegion" class="visually-hidden" aria-live="polite" aria-atomic="true"></p>
</div>
<script src="/src/js/accessibilityWidget.js"></script>
