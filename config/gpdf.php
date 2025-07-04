<?php

use Omaralalwi\Gpdf\Enums\{
    GpdfDefaultSettings as GpdfDefault,
    GpdfSettingKeys as GpdfSet,
    GpdfStorageDrivers,
    GpdfDefaultSupportedFonts
};

/**
 * Configuration file for the Gpdf package.
 *
 * This configuration file extends the dompdf options.
 *
 * GpdfDefaultSettings provides default values for each setting, which can be overridden here.
 *
 * @return array
 */
return [
    /**
     * Temporary directory for storing temporary PDF files.
     * @var string|null
     */
    GpdfSet::TEMP_DIR => sys_get_temp_dir(),

    /**
     * Directory for storing font files.
     * @var string
     */
    GpdfSet::FONT_DIR => realpath(__DIR__ . GpdfDefault::FONT_DIR) . '/',

    /**
     * Directory for storing font cache files.
     * @var string
     */
    GpdfSet::FONT_CACHE => realpath(__DIR__ . GpdfDefault::FONT_DIR) . '/', // same to font dir to avoid cache problems

    /**
     * Default font for generating PDFs.
     * @var string
     */
    GpdfSet::DEFAULT_FONT => GpdfDefaultSupportedFonts::ALMARAI, // تطابق مع خط القالب

    /**
     * Set this to `true` if you want numbers to appear in Hindi format (e.g., ١,٢,٣,٤,٥).
     * Set to `false` to display numbers in standard format (e.g., 1, 2, 3, 4, 5).
     * @var bool
     */
    GpdfSet::SHOW_NUMBERS_AS_HINDI => false,

    /**
     * Set Max number of chars you can fit in one line, default is 50
     * @var integer
     */
    GpdfSet::MAX_CHARS_PER_LINE => 150, // زيادة لتجنب التقسيم

    /**
     * Font height ratio setting.
     * @var float
     */
    GpdfSet::FONT_HEIGHT_RATIO => 1.0, // تقليل لضبط الارتفاع

    /**
     * Enable or disable font subsetting.
     * @var bool
     */
    GpdfSet::IS_FONT_SUB_SETTING_ENABLED => GpdfDefault::IS_FONT_SUB_SETTING_ENABLED,

    /**
     * Chroot directory for security purposes.
     * @var string|null
     */
    GpdfSet::CHROOT => realpath(dirname(__DIR__)),

    GpdfSet::STORAGE_PATH => GpdfDefault::STORAGE_PATH,

    GpdfSet::AWS_BUCKET => '',
    GpdfSet::AWS_REGION => '',
    GpdfSet::AWS_KEY => '',
    GpdfSet::AWS_SECRET => '',

    /**
     * Enable or disable entity conversion.
     * @var bool
     */
    GpdfSet::CONVERT_ENTITIES => GpdfDefault::CONVERT_ENTITIES,

    /**
     * Allowed protocols for remote resources.
     * @var array
     */
    GpdfSet::ALLOWED_PROTOCOLS => GpdfDefault::ALLOWED_PROTOCOLS,

    /**
     * Enable or disable artifact path validation.
     * @var bool
     */
    GpdfSet::ARTIFACT_PATH_VALIDATION => GpdfDefault::ARTIFACT_PATH_VALIDATION,

    /**
     * Path to the log output file.
     * @var string|null
     */
    GpdfSet::LOG_OUTPUT_FILE => GpdfDefault::LOG_OUTPUT_FILE,

    /**
     * Default media type for the generated PDFs.
     * @var string
     */
    GpdfSet::DEFAULT_MEDIA_TYPE => GpdfDefault::DEFAULT_MEDIA_TYPE,

    /**
     * Default paper size for the generated PDFs.
     * @var string
     */
    GpdfSet::DEFAULT_PAPER_SIZE => 'A4',

    /**
     * Default paper orientation for the generated PDFs.
     * @var string
     */
    GpdfSet::DEFAULT_PAPER_ORIENTATION => 'landscape',

    /**
     * DPI setting for the generated PDFs.
     * @var int
     */
    GpdfSet::DPI => GpdfDefault::DPI,

    /**
     * Enable or disable PHP execution in the PDFs.
     * @var bool
     */
    GpdfSet::ENABLE_PHP => GpdfDefault::IS_PHP_ENABLED,

    /**
     * Alias for ENABLE_PHP.
     * @var bool
     */
    GpdfSet::IS_PHP_ENABLED => GpdfDefault::IS_PHP_ENABLED,

    /**
     * Enable or disable remote resource fetching.
     * @var bool
     */
    GpdfSet::IS_REMOTE_ENABLED => true,

    /**
     * List of allowed remote hosts.
     * @var array
     */
    GpdfSet::ALLOWED_REMOTE_HOSTS => [
        'fonts.googleapis.com',
        'fonts.gstatic.com',
        'https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap'
    ],

    /**
     * Enable or disable JavaScript execution in the PDFs.
     * @var bool
     */
    GpdfSet::IS_JAVASCRIPT_ENABLED => true,

    /**
     * Enable or disable HTML5 parser in the PDFs.
     * @var bool
     */
    GpdfSet::IS_HTML5_PARSER_ENABLED => true,

    /**
     * Enable or disable PNG debugging.
     * @var bool
     */
    GpdfSet::DEBUG_PNG => false,

    /**
     * Enable or disable keeping temporary files.
     * @var bool
     */
    GpdfSet::DEBUG_KEEP_TEMP => false,

    /**
     * Enable or disable CSS debugging.
     * @var bool
     */
    GpdfSet::DEBUG_CSS => false,

    /**
     * Enable or disable layout debugging.
     * @var bool
     */
    GpdfSet::DEBUG_LAYOUT => false,

    /**
     * Enable or disable layout lines debugging.
     * @var bool
     */
    GpdfSet::DEBUG_LAYOUT_LINES => false, // تعطيل لمنع الحدود حول الكلمات

    /**
     * Enable or disable layout blocks debugging.
     * @var bool
     */
    GpdfSet::DEBUG_LAYOUT_BLOCKS => false,

    /**
     * Enable or disable layout inline debugging.
     * @var bool
     */
    GpdfSet::DEBUG_LAYOUT_INLINE => false,

    /**
     * Enable or disable layout padding box debugging.
     * @var bool
     */
    GpdfSet::DEBUG_LAYOUT_PADDING_BOX => false,

    /**
     * Backend used for generating PDFs.
     * @var string
     */
    GpdfSet::PDF_BACKEND => GpdfDefault::PDF_BACKEND,

    /**
     * License key for the PDF library.
     * @var string
     */
    GpdfSet::PDF_LIB_LICENSE => GpdfDefault::PDF_LIB_LICENSE,

    /**
     * HTTP context options for fetching remote resources.
     * @var resource|null
     */
    GpdfSet::HTTP_CONTEXT => GpdfDefault::HTTP_CONTEXT,
];
