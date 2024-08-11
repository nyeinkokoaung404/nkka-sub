<?php

function bytesformat($bytes, $precision = 2): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}

// Get the JSON data from the request
if ((isset($_SERVER['HTTP_USER_AGENT']) and empty($_SERVER['HTTP_USER_AGENT'])) or !isset($_SERVER['HTTP_USER_AGENT'])) {
    header('Location: /');
    exit();
}

if (!function_exists('str_contains'))
    die('Please upgrade your PHP version to 8 or above');
$isTextHTML = str_contains(($_SERVER['HTTP_ACCEPT'] ?? ''), 'text/html');

const BASE_URL = "http://139.59.101.236:8000"; // Replace IP address and port and set https for SSL

$URL = BASE_URL . $_SERVER['REQUEST_URI'] ?? '';
$URL .= $isTextHTML ? '/info' : '';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 17);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
if (curl_error($ch))
    die('Error !' . __LINE__ . '<br>Please check <a href="https://github.com/AC-Lover/AC-Subcription/wiki/Error-!27">this</a>');
curl_close($ch);


$header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
$response = trim(str_replace($header_text, '', $response));
$user = json_decode($response, true);

if ($isTextHTML) {
    ?>  
            <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?= $user['username'] ?> - Sub Info</title>
        <style>
            .asli {
                background: url('https://4kwallpapers.com/images/wallpapers/windows-server-2025-3840x2400-15386.jpg') no-repeat center;
                background-size: cover;
            }
        </style>
        <style>
            /*
    ! tailwindcss v3.3.3 | MIT License | https://tailwindcss.com
    */

            /*
    1. Prevent padding and border from affecting element width. (https://github.com/mozdevs/cssremedy/issues/4)
    2. Allow adding a border to an element by just adding a border-width. (https://github.com/tailwindcss/tailwindcss/pull/116)
    */

            *,
            ::before,
            ::after {
                box-sizing: border-box;
                /* 1 */
                border-width: 0;
                /* 2 */
                border-style: solid;
                /* 2 */
                border-color: #e5e7eb;
                /* 2 */
            }

            ::before,
            ::after {
                --tw-content: '';
            }

            /*
    1. Use a consistent sensible line-height in all browsers.
    2. Prevent adjustments of font size after orientation changes in iOS.
    3. Use a more readable tab size.
    4. Use the user's configured `sans` font-family by default.
    5. Use the user's configured `sans` font-feature-settings by default.
    6. Use the user's configured `sans` font-variation-settings by default.
    */

            html {
                line-height: 1.5;
                /* 1 */
                -webkit-text-size-adjust: 100%;
                /* 2 */
                -moz-tab-size: 4;
                /* 3 */
                -o-tab-size: 4;
                tab-size: 4;
                /* 3 */
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                /* 4 */
                font-feature-settings: normal;
                /* 5 */
                font-variation-settings: normal;
                /* 6 */
            }

            /*
    1. Remove the margin in all browsers.
    2. Inherit line-height from `html` so users can set them as a class directly on the `html` element.
    */

            body {
                margin: 0;
                /* 1 */
                line-height: inherit;
                /* 2 */
            }

            /*
    1. Add the correct height in Firefox.
    2. Correct the inheritance of border color in Firefox. (https://bugzilla.mozilla.org/show_bug.cgi?id=190655)
    3. Ensure horizontal rules are visible by default.
    */

            hr {
                height: 0;
                /* 1 */
                color: inherit;
                /* 2 */
                border-top-width: 1px;
                /* 3 */
            }

            /*
    Add the correct text decoration in Chrome, Edge, and Safari.
    */

            abbr:where([title]) {
                -webkit-text-decoration: underline dotted;
                text-decoration: underline dotted;
            }

            /*
    Remove the default font size and weight for headings.
    */

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-size: inherit;
                font-weight: inherit;
            }

            /*
    Reset links to optimize for opt-in styling instead of opt-out.
    */

            a {
                color: inherit;
                text-decoration: inherit;
            }

            /*
    Add the correct font weight in Edge and Safari.
    */

            b,
            strong {
                font-weight: bolder;
            }

            /*
    1. Use the user's configured `mono` font family by default.
    2. Correct the odd `em` font sizing in all browsers.
    */

            code,
            kbd,
            samp,
            pre {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                /* 1 */
                font-size: 1em;
                /* 2 */
            }

            /*
    Add the correct font size in all browsers.
    */

            small {
                font-size: 80%;
            }

            /*
    Prevent `sub` and `sup` elements from affecting the line height in all browsers.
    */

            sub,
            sup {
                font-size: 75%;
                line-height: 0;
                position: relative;
                vertical-align: baseline;
            }

            sub {
                bottom: -0.25em;
            }

            sup {
                top: -0.5em;
            }

            /*
    1. Remove text indentation from table contents in Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=999088, https://bugs.webkit.org/show_bug.cgi?id=201297)
    2. Correct table border color inheritance in all Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=935729, https://bugs.webkit.org/show_bug.cgi?id=195016)
    3. Remove gaps between table borders by default.
    */

            table {
                text-indent: 0;
                /* 1 */
                border-color: inherit;
                /* 2 */
                border-collapse: collapse;
                /* 3 */
            }

            /*
    1. Change the font styles in all browsers.
    2. Remove the margin in Firefox and Safari.
    3. Remove default padding in all browsers.
    */

            button,
            input,
            optgroup,
            select,
            textarea {
                font-family: inherit;
                /* 1 */
                font-feature-settings: inherit;
                /* 1 */
                font-variation-settings: inherit;
                /* 1 */
                font-size: 100%;
                /* 1 */
                font-weight: inherit;
                /* 1 */
                line-height: inherit;
                /* 1 */
                color: inherit;
                /* 1 */
                margin: 0;
                /* 2 */
                padding: 0;
                /* 3 */
            }

            /*
    Remove the inheritance of text transform in Edge and Firefox.
    */

            button,
            select {
                text-transform: none;
            }

            /*
    1. Correct the inability to style clickable types in iOS and Safari.
    2. Remove default button styles.
    */

            button,
            [type='button'],
            [type='reset'],
            [type='submit'] {
                -webkit-appearance: button;
                /* 1 */
                background-color: transparent;
                /* 2 */
                background-image: none;
                /* 2 */
            }

            /*
    Use the modern Firefox focus style for all focusable elements.
    */

            :-moz-focusring {
                outline: auto;
            }

            /*
    Remove the additional `:invalid` styles in Firefox. (https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737)
    */

            :-moz-ui-invalid {
                box-shadow: none;
            }

            /*
    Add the correct vertical alignment in Chrome and Firefox.
    */

            progress {
                vertical-align: baseline;
            }

            /*
    Correct the cursor style of increment and decrement buttons in Safari.
    */

            ::-webkit-inner-spin-button,
            ::-webkit-outer-spin-button {
                height: auto;
            }

            /*
    1. Correct the odd appearance in Chrome and Safari.
    2. Correct the outline style in Safari.
    */

            [type='search'] {
                -webkit-appearance: textfield;
                /* 1 */
                outline-offset: -2px;
                /* 2 */
            }

            /*
    Remove the inner padding in Chrome and Safari on macOS.
    */

            ::-webkit-search-decoration {
                -webkit-appearance: none;
            }

            /*
    1. Correct the inability to style clickable types in iOS and Safari.
    2. Change font properties to `inherit` in Safari.
    */

            ::-webkit-file-upload-button {
                -webkit-appearance: button;
                /* 1 */
                font: inherit;
                /* 2 */
            }

            /*
    Add the correct display in Chrome and Safari.
    */

            summary {
                display: list-item;
            }

            /*
    Removes the default spacing and border for appropriate elements.
    */

            blockquote,
            dl,
            dd,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            hr,
            figure,
            p,
            pre {
                margin: 0;
            }

            fieldset {
                margin: 0;
                padding: 0;
            }

            legend {
                padding: 0;
            }

            ol,
            ul,
            menu {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            /*
    Reset default styling for dialogs.
    */

            dialog {
                padding: 0;
            }

            /*
    Prevent resizing textareas horizontally by default.
    */

            textarea {
                resize: vertical;
            }

            /*
    1. Reset the default placeholder opacity in Firefox. (https://github.com/tailwindlabs/tailwindcss/issues/3300)
    2. Set the default placeholder color to the user's configured gray 400 color.
    */

            input::-moz-placeholder,
            textarea::-moz-placeholder {
                opacity: 1;
                /* 1 */
                color: #9ca3af;
                /* 2 */
            }

            input::placeholder,
            textarea::placeholder {
                opacity: 1;
                /* 1 */
                color: #9ca3af;
                /* 2 */
            }

            /*
    Set the default cursor for buttons.
    */

            button,
            [role="button"] {
                cursor: pointer;
            }

            /*
    Make sure disabled buttons don't get the pointer cursor.
    */

            :disabled {
                cursor: default;
            }

            /*
    1. Make replaced elements `display: block` by default. (https://github.com/mozdevs/cssremedy/issues/14)
    2. Add `vertical-align: middle` to align replaced elements more sensibly by default. (https://github.com/jensimmons/cssremedy/issues/14#issuecomment-634934210)
       This can trigger a poorly considered lint error in some tools but is included by design.
    */

            img,
            svg,
            video,
            canvas,
            audio,
            iframe,
            embed,
            object {
                display: block;
                /* 1 */
                vertical-align: middle;
                /* 2 */
            }

            /*
    Constrain images and videos to the parent width and preserve their intrinsic aspect ratio. (https://github.com/mozdevs/cssremedy/issues/14)
    */

            img,
            video {
                max-width: 100%;
                height: auto;
            }

            /* Make elements with the HTML hidden attribute stay hidden by default */

            [hidden] {
                display: none;
            }

            *,
            ::before,
            ::after {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-gradient-from-position: ;
                --tw-gradient-via-position: ;
                --tw-gradient-to-position: ;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / 0.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia: ;
            }

            ::backdrop {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-gradient-from-position: ;
                --tw-gradient-via-position: ;
                --tw-gradient-to-position: ;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / 0.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia: ;
            }

            .container {
                width: 100%;
            }

            @media (min-width: 640px) {
                .container {
                    max-width: 640px;
                }
            }

            @media (min-width: 768px) {
                .container {
                    max-width: 768px;
                }
            }

            @media (min-width: 1024px) {
                .container {
                    max-width: 1024px;
                }
            }

            @media (min-width: 1280px) {
                .container {
                    max-width: 1280px;
                }
            }

            @media (min-width: 1536px) {
                .container {
                    max-width: 1536px;
                }
            }

            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border-width: 0;
            }

            .visible {
                visibility: visible;
            }

            .invisible {
                visibility: hidden;
            }

            .collapse {
                visibility: collapse;
            }

            .static {
                position: static;
            }

            .fixed {
                position: fixed;
            }

            .absolute {
                position: absolute;
            }

            .relative {
                position: relative;
            }

            .inset-0 {
                inset: 0px;
            }

            .left-0 {
                left: 0px;
            }

            .left-1\/2 {
                left: 50%;
            }

            .top-1\/2 {
                top: 50%;
            }

            .top-7 {
                top: 1.75rem;
            }

            .left-1 {
                left: 0.25rem;
            }

            .top-1 {
                top: 0.25rem;
            }

            .-z-10 {
                z-index: -10;
            }

            .z-10 {
                z-index: 10;
            }

            .z-50 {
                z-index: 50;
            }

            .-m-6 {
                margin: -1.5rem;
            }

            .m-0 {
                margin: 0px;
            }

            .m-3 {
                margin: 0.75rem;
            }

            .mx-6 {
                margin-left: 1.5rem;
                margin-right: 1.5rem;
            }

            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }

            .my-4 {
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            .my-6 {
                margin-top: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .-mb-px {
                margin-bottom: -1px;
            }

            .mb-1 {
                margin-bottom: 0.25rem;
            }

            .mb-2 {
                margin-bottom: 0.5rem;
            }

            .mb-3 {
                margin-bottom: 0.75rem;
            }

            .mb-4 {
                margin-bottom: 1rem;
            }

            .mb-6 {
                margin-bottom: 1.5rem;
            }

            .mb-8 {
                margin-bottom: 2rem;
            }

            .ml-10 {
                margin-left: 2.5rem;
            }

            .ml-2 {
                margin-left: 0.5rem;
            }

            .ml-auto {
                margin-left: auto;
            }

            .mr-2 {
                margin-right: 0.5rem;
            }

            .mr-3 {
                margin-right: 0.75rem;
            }

            .mt-10 {
                margin-top: 2.5rem;
            }

            .mt-16 {
                margin-top: 4rem;
            }

            .mt-2 {
                margin-top: 0.5rem;
            }

            .mt-3 {
                margin-top: 0.75rem;
            }

            .mt-4 {
                margin-top: 1rem;
            }

            .mt-5 {
                margin-top: 1.25rem;
            }

            .mt-6 {
                margin-top: 1.5rem;
            }

            .mt-7 {
                margin-top: 1.75rem;
            }

            .mt-8 {
                margin-top: 2rem;
            }

            .block {
                display: block;
            }

            .inline-block {
                display: inline-block;
            }

            .flex {
                display: flex;
            }

            .inline-flex {
                display: inline-flex;
            }

            .table {
                display: table;
            }

            .grid {
                display: grid;
            }

            .contents {
                display: contents;
            }

            .hidden {
                display: none;
            }

            .h-10 {
                height: 2.5rem;
            }

            .h-12 {
                height: 3rem;
            }

            .h-16 {
                height: 4rem;
            }

            .h-2 {
                height: 0.5rem;
            }

            .h-20 {
                height: 5rem;
            }

            .h-24 {
                height: 6rem;
            }

            .h-3 {
                height: 0.75rem;
            }

            .h-32 {
                height: 8rem;
            }

            .h-4 {
                height: 1rem;
            }

            .h-6 {
                height: 1.5rem;
            }

            .h-8 {
                height: 2rem;
            }

            .h-fit {
                height: -moz-fit-content;
                height: fit-content;
            }

            .max-h-\[90\%\] {
                max-height: 90%;
            }

            .max-h-\[95vh\] {
                max-height: 95vh;
            }

            .min-h-screen {
                min-height: 100vh;
            }

            .w-10 {
                width: 2.5rem;
            }

            .w-11 {
                width: 2.75rem;
            }

            .w-12 {
                width: 3rem;
            }

            .w-2 {
                width: 0.5rem;
            }

            .w-20 {
                width: 5rem;
            }

            .w-24 {
                width: 6rem;
            }

            .w-28 {
                width: 7rem;
            }

            .w-32 {
                width: 8rem;
            }

            .w-4 {
                width: 1rem;
            }

            .w-4\/5 {
                width: 80%;
            }

            .w-44 {
                width: 11rem;
            }

            .w-5 {
                width: 1.25rem;
            }

            .w-6 {
                width: 1.5rem;
            }

            .w-8 {
                width: 2rem;
            }

            .w-fit {
                width: -moz-fit-content;
                width: fit-content;
            }

            .w-full {
                width: 100%;
            }

            .min-w-\[20rem\] {
                min-width: 20rem;
            }

            .max-w-2xl {
                max-width: 42rem;
            }

            .max-w-md {
                max-width: 28rem;
            }

            .max-w-xl {
                max-width: 36rem;
            }

            .flex-1 {
                flex: 1 1 0%;
            }

            .flex-grow {
                flex-grow: 1;
            }

            .basis-1 {
                flex-basis: 0.25rem;
            }

            .basis-1\/3 {
                flex-basis: 33.333333%;
            }

            .basis-2 {
                flex-basis: 0.5rem;
            }

            .basis-2\/3 {
                flex-basis: 66.666667%;
            }

            .basis-4 {
                flex-basis: 1rem;
            }

            .border-collapse {
                border-collapse: collapse;
            }

            .origin-center {
                transform-origin: center;
            }

            .-translate-x-1\/2 {
                --tw-translate-x: -50%;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .-translate-y-1\/2 {
                --tw-translate-y: -50%;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .translate-x-1 {
                --tw-translate-x: 0.25rem;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .translate-y-1 {
                --tw-translate-y: 0.25rem;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .-translate-x-1 {
                --tw-translate-x: -0.25rem;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .-translate-y-1 {
                --tw-translate-y: -0.25rem;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .\!rotate-180 {
                --tw-rotate: 180deg !important;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)) !important;
            }

            .scale-110 {
                --tw-scale-x: 1.1;
                --tw-scale-y: 1.1;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .transform {
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .cursor-default {
                cursor: default;
            }

            .cursor-pointer {
                cursor: pointer;
            }

            .resize {
                resize: both;
            }

            .list-none {
                list-style-type: none;
            }

            .grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .grid-rows-\[0fr\] {
                grid-template-rows: 0fr;
            }

            .grid-rows-\[1fr\] {
                grid-template-rows: 1fr;
            }

            .flex-row {
                flex-direction: row;
            }

            .flex-col {
                flex-direction: column;
            }

            .flex-wrap {
                flex-wrap: wrap;
            }

            .items-center {
                align-items: center;
            }

            .justify-start {
                justify-content: flex-start;
            }

            .justify-center {
                justify-content: center;
            }

            .justify-between {
                justify-content: space-between;
            }

            .gap-2 {
                gap: 0.5rem;
            }

            .gap-x-1 {
                -moz-column-gap: 0.25rem;
                column-gap: 0.25rem;
            }

            .gap-x-2 {
                -moz-column-gap: 0.5rem;
                column-gap: 0.5rem;
            }

            .gap-x-3 {
                -moz-column-gap: 0.75rem;
                column-gap: 0.75rem;
            }

            .gap-x-4 {
                -moz-column-gap: 1rem;
                column-gap: 1rem;
            }

            .gap-y-2 {
                row-gap: 0.5rem;
            }

            .gap-y-4 {
                row-gap: 1rem;
            }

            .space-x-3> :not([hidden])~ :not([hidden]) {
                --tw-space-x-reverse: 0;
                margin-right: calc(0.75rem * var(--tw-space-x-reverse));
                margin-left: calc(0.75rem * calc(1 - var(--tw-space-x-reverse)));
            }

            .space-y-0> :not([hidden])~ :not([hidden]) {
                --tw-space-y-reverse: 0;
                margin-top: calc(0px * calc(1 - var(--tw-space-y-reverse)));
                margin-bottom: calc(0px * var(--tw-space-y-reverse));
            }

            .space-y-10> :not([hidden])~ :not([hidden]) {
                --tw-space-y-reverse: 0;
                margin-top: calc(2.5rem * calc(1 - var(--tw-space-y-reverse)));
                margin-bottom: calc(2.5rem * var(--tw-space-y-reverse));
            }

            .space-y-5> :not([hidden])~ :not([hidden]) {
                --tw-space-y-reverse: 0;
                margin-top: calc(1.25rem * calc(1 - var(--tw-space-y-reverse)));
                margin-bottom: calc(1.25rem * var(--tw-space-y-reverse));
            }

            .divide-x> :not([hidden])~ :not([hidden]) {
                --tw-divide-x-reverse: 0;
                border-right-width: calc(1px * var(--tw-divide-x-reverse));
                border-left-width: calc(1px * calc(1 - var(--tw-divide-x-reverse)));
            }

            .divide-y> :not([hidden])~ :not([hidden]) {
                --tw-divide-y-reverse: 0;
                border-top-width: calc(1px * calc(1 - var(--tw-divide-y-reverse)));
                border-bottom-width: calc(1px * var(--tw-divide-y-reverse));
            }

            .divide-blue-600> :not([hidden])~ :not([hidden]) {
                --tw-divide-opacity: 1;
                border-color: rgb(37 99 235 / var(--tw-divide-opacity));
            }

            .divide-gray-100> :not([hidden])~ :not([hidden]) {
                --tw-divide-opacity: 1;
                border-color: rgb(243 244 246 / var(--tw-divide-opacity));
            }

            .overflow-hidden {
                overflow: hidden;
            }

            .whitespace-nowrap {
                white-space: nowrap;
            }

            .rounded {
                border-radius: 0.25rem;
            }

            .rounded-2xl {
                border-radius: 1rem;
            }

            .rounded-3xl {
                border-radius: 1.5rem;
            }

            .rounded-full {
                border-radius: 9999px;
            }

            .rounded-lg {
                border-radius: 0.5rem;
            }

            .rounded-md {
                border-radius: 0.375rem;
            }

            .rounded-none {
                border-radius: 0px;
            }

            .rounded-xl {
                border-radius: 0.75rem;
            }

            .rounded-t-lg {
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
            }

            .border {
                border-width: 1px;
            }

            .border-2 {
                border-width: 2px;
            }

            .border-\[3px\] {
                border-width: 3px;
            }

            .border-b {
                border-bottom-width: 1px;
            }

            .border-b-2 {
                border-bottom-width: 2px;
            }

            .border-amber-200 {
                --tw-border-opacity: 1;
                border-color: rgb(253 230 138 / var(--tw-border-opacity));
            }

            .border-amber-600 {
                --tw-border-opacity: 1;
                border-color: rgb(217 119 6 / var(--tw-border-opacity));
            }

            .border-blue-600 {
                --tw-border-opacity: 1;
                border-color: rgb(37 99 235 / var(--tw-border-opacity));
            }

            .border-gray-200 {
                --tw-border-opacity: 1;
                border-color: rgb(229 231 235 / var(--tw-border-opacity));
            }

            .border-gray-300 {
                --tw-border-opacity: 1;
                border-color: rgb(209 213 219 / var(--tw-border-opacity));
            }

            .border-gray-400 {
                --tw-border-opacity: 1;
                border-color: rgb(156 163 175 / var(--tw-border-opacity));
            }

            .border-gray-500 {
                --tw-border-opacity: 1;
                border-color: rgb(107 114 128 / var(--tw-border-opacity));
            }

            .border-gray-600 {
                --tw-border-opacity: 1;
                border-color: rgb(75 85 99 / var(--tw-border-opacity));
            }

            .border-gray-800 {
                --tw-border-opacity: 1;
                border-color: rgb(31 41 55 / var(--tw-border-opacity));
            }

            .border-green-500 {
                --tw-border-opacity: 1;
                border-color: rgb(34 197 94 / var(--tw-border-opacity));
            }

            .border-green-600 {
                --tw-border-opacity: 1;
                border-color: rgb(22 163 74 / var(--tw-border-opacity));
            }

            .border-red-500 {
                --tw-border-opacity: 1;
                border-color: rgb(239 68 68 / var(--tw-border-opacity));
            }

            .border-yellow-500 {
                --tw-border-opacity: 1;
                border-color: rgb(234 179 8 / var(--tw-border-opacity));
            }

            .border-yellow-600 {
                --tw-border-opacity: 1;
                border-color: rgb(202 138 4 / var(--tw-border-opacity));
            }

            .border-gray-700 {
                --tw-border-opacity: 1;
                border-color: rgb(55 65 81 / var(--tw-border-opacity));
            }

            .bg-amber-200 {
                --tw-bg-opacity: 1;
                background-color: rgb(253 230 138 / var(--tw-bg-opacity));
            }

            .bg-amber-500 {
                --tw-bg-opacity: 1;
                background-color: rgb(245 158 11 / var(--tw-bg-opacity));
            }

            .bg-black\/20 {
                background-color: rgb(0 0 0 / 0.2);
            }

            .bg-blue-600 {
                --tw-bg-opacity: 1;
                background-color: rgb(37 99 235 / var(--tw-bg-opacity));
            }

            .bg-blue-700 {
                --tw-bg-opacity: 1;
                background-color: rgb(29 78 216 / var(--tw-bg-opacity));
            }

            .bg-gray-100 {
                --tw-bg-opacity: 1;
                background-color: rgb(243 244 246 / var(--tw-bg-opacity));
            }

            .bg-gray-200 {
                --tw-bg-opacity: 1;
                background-color: rgb(229 231 235 / var(--tw-bg-opacity));
            }

            .bg-gray-400 {
                --tw-bg-opacity: 1;
                background-color: rgb(156 163 175 / var(--tw-bg-opacity));
            }

            .bg-gray-50 {
                --tw-bg-opacity: 1;
                background-color: rgb(249 250 251 / var(--tw-bg-opacity));
            }

            .bg-gray-500 {
                --tw-bg-opacity: 1;
                background-color: rgb(107 114 128 / var(--tw-bg-opacity));
            }

            .bg-gray-600 {
                --tw-bg-opacity: 1;
                background-color: rgb(75 85 99 / var(--tw-bg-opacity));
            }

            .bg-gray-700 {
                --tw-bg-opacity: 1;
                background-color: rgb(55 65 81 / var(--tw-bg-opacity));
            }

            .bg-gray-800 {
                --tw-bg-opacity: 1;
                background-color: rgb(31 41 55 / var(--tw-bg-opacity));
            }

            .bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity));
            }

            .bg-gray-950 {
                --tw-bg-opacity: 1;
                background-color: rgb(3 7 18 / var(--tw-bg-opacity));
            }

            .bg-green-400 {
                --tw-bg-opacity: 1;
                background-color: rgb(74 222 128 / var(--tw-bg-opacity));
            }

            .bg-green-500 {
                --tw-bg-opacity: 1;
                background-color: rgb(34 197 94 / var(--tw-bg-opacity));
            }

            .bg-green-600 {
                --tw-bg-opacity: 1;
                background-color: rgb(22 163 74 / var(--tw-bg-opacity));
            }

            .bg-green-600\/30 {
                background-color: rgb(22 163 74 / 0.3);
            }

            .bg-indigo-700 {
                --tw-bg-opacity: 1;
                background-color: rgb(67 56 202 / var(--tw-bg-opacity));
            }

            .bg-lime-950 {
                --tw-bg-opacity: 1;
                background-color: rgb(26 46 5 / var(--tw-bg-opacity));
            }

            .bg-orange-500 {
                --tw-bg-opacity: 1;
                background-color: rgb(249 115 22 / var(--tw-bg-opacity));
            }

            .bg-orange-600 {
                --tw-bg-opacity: 1;
                background-color: rgb(234 88 12 / var(--tw-bg-opacity));
            }

            .bg-red-500 {
                --tw-bg-opacity: 1;
                background-color: rgb(239 68 68 / var(--tw-bg-opacity));
            }

            .bg-red-600 {
                --tw-bg-opacity: 1;
                background-color: rgb(220 38 38 / var(--tw-bg-opacity));
            }

            .bg-slate-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(15 23 42 / var(--tw-bg-opacity));
            }

            .bg-slate-950 {
                --tw-bg-opacity: 1;
                background-color: rgb(2 6 23 / var(--tw-bg-opacity));
            }

            .bg-stone-800 {
                --tw-bg-opacity: 1;
                background-color: rgb(41 37 36 / var(--tw-bg-opacity));
            }

            .bg-white {
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255 / var(--tw-bg-opacity));
            }

            .bg-yellow-600 {
                --tw-bg-opacity: 1;
                background-color: rgb(202 138 4 / var(--tw-bg-opacity));
            }

            .bg-black {
                --tw-bg-opacity: 1;
                background-color: rgb(0 0 0 / var(--tw-bg-opacity));
            }

            .bg-opacity-0 {
                --tw-bg-opacity: 0;
            }

            .bg-opacity-50 {
                --tw-bg-opacity: 0.5;
            }

            .bg-opacity-80 {
                --tw-bg-opacity: 0.8;
            }

            .bg-gradient-to-br {
                background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
            }

            .bg-gradient-to-r {
                background-image: linear-gradient(to right, var(--tw-gradient-stops));
            }

            .bg-none {
                background-image: none;
            }

            .from-amber-500 {
                --tw-gradient-from: #f59e0b var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(245 158 11 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-blue-500 {
                --tw-gradient-from: #3b82f6 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(59 130 246 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-cyan-400 {
                --tw-gradient-from: #22d3ee var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(34 211 238 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-cyan-500 {
                --tw-gradient-from: #06b6d4 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(6 182 212 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-emerald-500 {
                --tw-gradient-from: #10b981 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(16 185 129 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-gray-500 {
                --tw-gradient-from: #6b7280 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(107 114 128 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-green-400 {
                --tw-gradient-from: #4ade80 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(74 222 128 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-green-500 {
                --tw-gradient-from: #22c55e var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(34 197 94 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-indigo-600 {
                --tw-gradient-from: #4f46e5 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(79 70 229 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-pink-400 {
                --tw-gradient-from: #f472b6 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(244 114 182 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-purple-500 {
                --tw-gradient-from: #a855f7 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(168 85 247 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-purple-600 {
                --tw-gradient-from: #9333ea var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(147 51 234 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-red-200 {
                --tw-gradient-from: #fecaca var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(254 202 202 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-red-400 {
                --tw-gradient-from: #f87171 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(248 113 113 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-rose-500 {
                --tw-gradient-from: #f43f5e var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(244 63 94 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-slate-100 {
                --tw-gradient-from: #f1f5f9 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(241 245 249 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-slate-500 {
                --tw-gradient-from: #64748b var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(100 116 139 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-teal-400 {
                --tw-gradient-from: #2dd4bf var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(45 212 191 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-teal-500 {
                --tw-gradient-from: #14b8a6 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(20 184 166 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-yellow-500 {
                --tw-gradient-from: #eab308 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(234 179 8 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-gray-600 {
                --tw-gradient-from: #4b5563 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(75 85 99 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-gray-100 {
                --tw-gradient-from: #f3f4f6 var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(243 244 246 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .from-zinc-500 {
                --tw-gradient-from: #71717a var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(113 113 122 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }

            .via-amber-600 {
                --tw-gradient-to: rgb(217 119 6 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #d97706 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-blue-600 {
                --tw-gradient-to: rgb(37 99 235 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #2563eb var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-cyan-500 {
                --tw-gradient-to: rgb(6 182 212 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #06b6d4 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-emerald-600 {
                --tw-gradient-to: rgb(5 150 105 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #059669 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-gray-600 {
                --tw-gradient-to: rgb(75 85 99 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #4b5563 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-green-500 {
                --tw-gradient-to: rgb(34 197 94 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #22c55e var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-green-600 {
                --tw-gradient-to: rgb(22 163 74 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #16a34a var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-indigo-700 {
                --tw-gradient-to: rgb(67 56 202 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #4338ca var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-pink-500 {
                --tw-gradient-to: rgb(236 72 153 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #ec4899 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-purple-600 {
                --tw-gradient-to: rgb(147 51 234 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #9333ea var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-red-300 {
                --tw-gradient-to: rgb(252 165 165 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #fca5a5 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-red-500 {
                --tw-gradient-to: rgb(239 68 68 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #ef4444 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-rose-600 {
                --tw-gradient-to: rgb(225 29 72 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #e11d48 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-slate-200 {
                --tw-gradient-to: rgb(226 232 240 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #e2e8f0 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-slate-600 {
                --tw-gradient-to: rgb(71 85 105 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #475569 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-teal-500 {
                --tw-gradient-to: rgb(20 184 166 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #14b8a6 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-teal-600 {
                --tw-gradient-to: rgb(13 148 136 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #0d9488 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-yellow-200 {
                --tw-gradient-to: rgb(254 240 138 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #fef08a var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-yellow-600 {
                --tw-gradient-to: rgb(202 138 4 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #ca8a04 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-yellow-700 {
                --tw-gradient-to: rgb(161 98 7 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #a16207 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-yellow-800 {
                --tw-gradient-to: rgb(133 77 14 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #854d0e var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-gray-700 {
                --tw-gradient-to: rgb(55 65 81 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #374151 var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-gray-200 {
                --tw-gradient-to: rgb(229 231 235 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #e5e7eb var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .via-zinc-600 {
                --tw-gradient-to: rgb(82 82 91 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #52525b var(--tw-gradient-via-position), var(--tw-gradient-to);
            }

            .to-amber-700 {
                --tw-gradient-to: #b45309 var(--tw-gradient-to-position);
            }

            .to-blue-500 {
                --tw-gradient-to: #3b82f6 var(--tw-gradient-to-position);
            }

            .to-blue-700 {
                --tw-gradient-to: #1d4ed8 var(--tw-gradient-to-position);
            }

            .to-cyan-600 {
                --tw-gradient-to: #0891b2 var(--tw-gradient-to-position);
            }

            .to-emerald-700 {
                --tw-gradient-to: #047857 var(--tw-gradient-to-position);
            }

            .to-gray-700 {
                --tw-gradient-to: #374151 var(--tw-gradient-to-position);
            }

            .to-green-600 {
                --tw-gradient-to: #16a34a var(--tw-gradient-to-position);
            }

            .to-green-700 {
                --tw-gradient-to: #15803d var(--tw-gradient-to-position);
            }

            .to-indigo-800 {
                --tw-gradient-to: #3730a3 var(--tw-gradient-to-position);
            }

            .to-pink-600 {
                --tw-gradient-to: #db2777 var(--tw-gradient-to-position);
            }

            .to-purple-700 {
                --tw-gradient-to: #7e22ce var(--tw-gradient-to-position);
            }

            .to-red-600 {
                --tw-gradient-to: #dc2626 var(--tw-gradient-to-position);
            }

            .to-rose-700 {
                --tw-gradient-to: #be123c var(--tw-gradient-to-position);
            }

            .to-slate-300 {
                --tw-gradient-to: #cbd5e1 var(--tw-gradient-to-position);
            }

            .to-slate-700 {
                --tw-gradient-to: #334155 var(--tw-gradient-to-position);
            }

            .to-teal-600 {
                --tw-gradient-to: #0d9488 var(--tw-gradient-to-position);
            }

            .to-teal-700 {
                --tw-gradient-to: #0f766e var(--tw-gradient-to-position);
            }

            .to-yellow-200 {
                --tw-gradient-to: #fef08a var(--tw-gradient-to-position);
            }

            .to-yellow-700 {
                --tw-gradient-to: #a16207 var(--tw-gradient-to-position);
            }

            .to-gray-800 {
                --tw-gradient-to: #1f2937 var(--tw-gradient-to-position);
            }

            .to-gray-300 {
                --tw-gradient-to: #d1d5db var(--tw-gradient-to-position);
            }

            .to-zinc-700 {
                --tw-gradient-to: #3f3f46 var(--tw-gradient-to-position);
            }

            .bg-clip-padding {
                background-clip: padding-box;
            }

            .fill-current {
                fill: currentColor;
            }

            .fill-gray-400 {
                fill: #9ca3af;
            }

            .fill-gray-950 {
                fill: #030712;
            }

            .fill-lime-400 {
                fill: #a3e635;
            }

            .fill-lime-800 {
                fill: #3f6212;
            }

            .fill-lime-950 {
                fill: #1a2e05;
            }

            .fill-white {
                fill: #fff;
            }

            .fill-yellow-500 {
                fill: #eab308;
            }

            .stroke-blue-600 {
                stroke: #2563eb;
            }

            .stroke-green-600 {
                stroke: #16a34a;
            }

            .stroke-white {
                stroke: #fff;
            }

            .stroke-yellow-500 {
                stroke: #eab308;
            }

            .p-0 {
                padding: 0px;
            }

            .p-1 {
                padding: 0.25rem;
            }

            .p-10 {
                padding: 2.5rem;
            }

            .p-2 {
                padding: 0.5rem;
            }

            .p-2\.5 {
                padding: 0.625rem;
            }

            .p-4 {
                padding: 1rem;
            }

            .p-5 {
                padding: 1.25rem;
            }

            .p-8 {
                padding: 2rem;
            }

            .px-1 {
                padding-left: 0.25rem;
                padding-right: 0.25rem;
            }

            .px-10 {
                padding-left: 2.5rem;
                padding-right: 2.5rem;
            }

            .px-2 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .px-2\.5 {
                padding-left: 0.625rem;
                padding-right: 0.625rem;
            }

            .px-3 {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .px-5 {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }

            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .py-0 {
                padding-top: 0px;
                padding-bottom: 0px;
            }

            .py-1 {
                padding-top: 0.25rem;
                padding-bottom: 0.25rem;
            }

            .py-2 {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }

            .py-3 {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }

            .py-3\.5 {
                padding-top: 0.875rem;
                padding-bottom: 0.875rem;
            }

            .py-4 {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }

            .py-6 {
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }

            .pb-1 {
                padding-bottom: 0.25rem;
            }

            .pb-1\.5 {
                padding-bottom: 0.375rem;
            }

            .pb-6 {
                padding-bottom: 1.5rem;
            }

            .pb-8 {
                padding-bottom: 2rem;
            }

            .pr-1 {
                padding-right: 0.25rem;
            }

            .pt-1 {
                padding-top: 0.25rem;
            }

            .pt-10 {
                padding-top: 2.5rem;
            }

            .pt-3 {
                padding-top: 0.75rem;
            }

            .pt-4 {
                padding-top: 1rem;
            }

            .pt-7 {
                padding-top: 1.75rem;
            }

            .text-left {
                text-align: left;
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            .font-\[Vazirmatn\] {
                font-family: Vazirmatn;
            }

            .font-\[vazirmatn\] {
                font-family: vazirmatn;
            }

            .font-body {
                font-family: be vietnam pro, Shabnam, sans-serif;
            }

            .text-2xl {
                font-size: 1.5rem;
                line-height: 2rem;
            }

            .text-3xl {
                font-size: 1.875rem;
                line-height: 2.25rem;
            }

            .text-lg {
                font-size: 1.125rem;
                line-height: 1.75rem;
            }

            .text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem;
            }

            .text-xl {
                font-size: 1.25rem;
                line-height: 1.75rem;
            }

            .text-xs {
                font-size: 0.75rem;
                line-height: 1rem;
            }

            .text-5xl {
                font-size: 3rem;
                line-height: 1;
            }

            .text-base {
                font-size: 1rem;
                line-height: 1.5rem;
            }

            .font-black {
                font-weight: 900;
            }

            .font-bold {
                font-weight: 700;
            }

            .font-medium {
                font-weight: 500;
            }

            .font-normal {
                font-weight: 400;
            }

            .font-semibold {
                font-weight: 600;
            }

            .uppercase {
                text-transform: uppercase;
            }

            .leading-6 {
                line-height: 1.5rem;
            }

            .leading-\[2\.5rem\] {
                line-height: 2.5rem;
            }

            .leading-\[3\.5rem\] {
                line-height: 3.5rem;
            }

            .leading-none {
                line-height: 1;
            }

            .tracking-tight {
                letter-spacing: -0.025em;
            }

            .text-amber-600 {
                --tw-text-opacity: 1;
                color: rgb(217 119 6 / var(--tw-text-opacity));
            }

            .text-black {
                --tw-text-opacity: 1;
                color: rgb(0 0 0 / var(--tw-text-opacity));
            }

            .text-blue-600 {
                --tw-text-opacity: 1;
                color: rgb(37 99 235 / var(--tw-text-opacity));
            }

            .text-gray-200 {
                --tw-text-opacity: 1;
                color: rgb(229 231 235 / var(--tw-text-opacity));
            }

            .text-gray-300 {
                --tw-text-opacity: 1;
                color: rgb(209 213 219 / var(--tw-text-opacity));
            }

            .text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity));
            }

            .text-gray-600 {
                --tw-text-opacity: 1;
                color: rgb(75 85 99 / var(--tw-text-opacity));
            }

            .text-gray-700 {
                --tw-text-opacity: 1;
                color: rgb(55 65 81 / var(--tw-text-opacity));
            }

            .text-gray-800 {
                --tw-text-opacity: 1;
                color: rgb(31 41 55 / var(--tw-text-opacity));
            }

            .text-gray-900 {
                --tw-text-opacity: 1;
                color: rgb(17 24 39 / var(--tw-text-opacity));
            }

            .text-gray-950 {
                --tw-text-opacity: 1;
                color: rgb(3 7 18 / var(--tw-text-opacity));
            }

            .text-green-500 {
                --tw-text-opacity: 1;
                color: rgb(34 197 94 / var(--tw-text-opacity));
            }

            .text-indigo-100 {
                --tw-text-opacity: 1;
                color: rgb(224 231 255 / var(--tw-text-opacity));
            }

            .text-lime-400 {
                --tw-text-opacity: 1;
                color: rgb(163 230 53 / var(--tw-text-opacity));
            }

            .text-red-500 {
                --tw-text-opacity: 1;
                color: rgb(239 68 68 / var(--tw-text-opacity));
            }

            .text-red-600 {
                --tw-text-opacity: 1;
                color: rgb(220 38 38 / var(--tw-text-opacity));
            }

            .text-red-700 {
                --tw-text-opacity: 1;
                color: rgb(185 28 28 / var(--tw-text-opacity));
            }

            .text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity));
            }

            .text-yellow-600 {
                --tw-text-opacity: 1;
                color: rgb(202 138 4 / var(--tw-text-opacity));
            }

            .underline {
                text-decoration-line: underline;
            }

            .placeholder-gray-400::-moz-placeholder {
                --tw-placeholder-opacity: 1;
                color: rgb(156 163 175 / var(--tw-placeholder-opacity));
            }

            .placeholder-gray-400::placeholder {
                --tw-placeholder-opacity: 1;
                color: rgb(156 163 175 / var(--tw-placeholder-opacity));
            }

            .placeholder-gray-800::-moz-placeholder {
                --tw-placeholder-opacity: 1;
                color: rgb(31 41 55 / var(--tw-placeholder-opacity));
            }

            .placeholder-gray-800::placeholder {
                --tw-placeholder-opacity: 1;
                color: rgb(31 41 55 / var(--tw-placeholder-opacity));
            }

            .opacity-0 {
                opacity: 0;
            }

            .opacity-100 {
                opacity: 1;
            }

            .opacity-40 {
                opacity: 0.4;
            }

            .shadow {
                --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .shadow-lg {
                --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .shadow-md {
                --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .shadow-none {
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .shadow-sm {
                --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
                --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .shadow-xl {
                --tw-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .shadow-2xl {
                --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
                --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .shadow-amber-500 {
                --tw-shadow-color: #f59e0b;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-amber-800 {
                --tw-shadow-color: #92400e;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-blue-500 {
                --tw-shadow-color: #3b82f6;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-blue-500\/50 {
                --tw-shadow-color: rgb(59 130 246 / 0.5);
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-blue-800 {
                --tw-shadow-color: #1e40af;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-emerald-500 {
                --tw-shadow-color: #10b981;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-emerald-800 {
                --tw-shadow-color: #065f46;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-gray-500 {
                --tw-shadow-color: #6b7280;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-gray-700 {
                --tw-shadow-color: #374151;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-gray-700\/50 {
                --tw-shadow-color: rgb(55 65 81 / 0.5);
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-gray-800 {
                --tw-shadow-color: #1f2937;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-green-500 {
                --tw-shadow-color: #22c55e;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-green-500\/50 {
                --tw-shadow-color: rgb(34 197 94 / 0.5);
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-green-800 {
                --tw-shadow-color: #166534;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-green-900 {
                --tw-shadow-color: #14532d;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-pink-500 {
                --tw-shadow-color: #ec4899;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-pink-800 {
                --tw-shadow-color: #9d174d;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-purple-500 {
                --tw-shadow-color: #a855f7;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-purple-500\/50 {
                --tw-shadow-color: rgb(168 85 247 / 0.5);
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-purple-800 {
                --tw-shadow-color: #6b21a8;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-red-500 {
                --tw-shadow-color: #ef4444;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-red-500\/50 {
                --tw-shadow-color: rgb(239 68 68 / 0.5);
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-red-800 {
                --tw-shadow-color: #991b1b;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-slate-500 {
                --tw-shadow-color: #64748b;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-slate-800 {
                --tw-shadow-color: #1e293b;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-teal-500 {
                --tw-shadow-color: #14b8a6;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-teal-800 {
                --tw-shadow-color: #115e59;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-yellow-200 {
                --tw-shadow-color: #fef08a;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-yellow-300 {
                --tw-shadow-color: #fde047;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-yellow-500 {
                --tw-shadow-color: #eab308;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .shadow-yellow-800 {
                --tw-shadow-color: #854d0e;
                --tw-shadow: var(--tw-shadow-colored);
            }

            .outline-none {
                outline: 2px solid transparent;
                outline-offset: 2px;
            }

            .outline {
                outline-style: solid;
            }

            .outline-1 {
                outline-width: 1px;
            }

            .ring-4 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(4px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
            }

            .ring-blue-300 {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(147 197 253 / var(--tw-ring-opacity));
            }

            .ring-blue-800 {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(30 64 175 / var(--tw-ring-opacity));
            }

            .blur {
                --tw-blur: blur(8px);
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
            }

            .blur-sm {
                --tw-blur: blur(4px);
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
            }

            .drop-shadow {
                --tw-drop-shadow: drop-shadow(0 1px 2px rgb(0 0 0 / 0.1)) drop-shadow(0 1px 1px rgb(0 0 0 / 0.06));
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
            }

            .drop-shadow-lg {
                --tw-drop-shadow: drop-shadow(0 10px 8px rgb(0 0 0 / 0.04)) drop-shadow(0 4px 3px rgb(0 0 0 / 0.1));
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
            }

            .filter {
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
            }

            .backdrop-blur-2xl {
                --tw-backdrop-blur: blur(40px);
                -webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
                backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
            }

            .backdrop-blur-3xl {
                --tw-backdrop-blur: blur(64px);
                -webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
                backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
            }

            .backdrop-blur-md {
                --tw-backdrop-blur: blur(12px);
                -webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
                backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
            }

            .backdrop-blur-xl {
                --tw-backdrop-blur: blur(24px);
                -webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
                backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
            }

            .backdrop-filter {
                -webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
                backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
            }

            .transition {
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-backdrop-filter;
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-backdrop-filter;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }

            .transition-all {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }

            .transition-colors {
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }

            .transition-opacity {
                transition-property: opacity;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }

            .duration-100 {
                transition-duration: 100ms;
            }

            .duration-150 {
                transition-duration: 150ms;
            }

            .duration-200 {
                transition-duration: 200ms;
            }

            .duration-300 {
                transition-duration: 300ms;
            }

            .duration-75 {
                transition-duration: 75ms;
            }

            .ease-in {
                transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
            }

            .ease-in-out {
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            }

            .ease-out {
                transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }

            .after\:absolute::after {
                content: var(--tw-content);
                position: absolute;
            }

            .after\:left-\[2px\]::after {
                content: var(--tw-content);
                left: 2px;
            }

            .after\:top-\[2px\]::after {
                content: var(--tw-content);
                top: 2px;
            }

            .after\:h-5::after {
                content: var(--tw-content);
                height: 1.25rem;
            }

            .after\:w-5::after {
                content: var(--tw-content);
                width: 1.25rem;
            }

            .after\:rounded-full::after {
                content: var(--tw-content);
                border-radius: 9999px;
            }

            .after\:border::after {
                content: var(--tw-content);
                border-width: 1px;
            }

            .after\:border-gray-300::after {
                content: var(--tw-content);
                --tw-border-opacity: 1;
                border-color: rgb(209 213 219 / var(--tw-border-opacity));
            }

            .after\:bg-white::after {
                content: var(--tw-content);
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255 / var(--tw-bg-opacity));
            }

            .after\:transition-all::after {
                content: var(--tw-content);
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }

            .after\:content-\[\'\'\]::after {
                --tw-content: '';
                content: var(--tw-content);
            }

            .hover\:border-gray-300:hover {
                --tw-border-opacity: 1;
                border-color: rgb(209 213 219 / var(--tw-border-opacity));
            }

            .hover\:bg-black\/10:hover {
                background-color: rgb(0 0 0 / 0.1);
            }

            .hover\:bg-gradient-to-br:hover {
                background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
            }

            .hover\:stroke-gray-800:hover {
                stroke: #1f2937;
            }

            .hover\:text-gray-600:hover {
                --tw-text-opacity: 1;
                color: rgb(75 85 99 / var(--tw-text-opacity));
            }

            .hover\:shadow-2xl:hover {
                --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
                --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .hover\:shadow-lg:hover {
                --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .hover\:shadow-xl:hover {
                --tw-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }

            .focus\:border-blue-500:focus {
                --tw-border-opacity: 1;
                border-color: rgb(59 130 246 / var(--tw-border-opacity));
            }

            .focus\:outline-none:focus {
                outline: 2px solid transparent;
                outline-offset: 2px;
            }

            .focus\:ring-4:focus {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(4px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
            }

            .focus\:ring-blue-300:focus {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(147 197 253 / var(--tw-ring-opacity));
            }

            .focus\:ring-blue-500:focus {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity));
            }

            .focus\:ring-blue-700:focus {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(29 78 216 / var(--tw-ring-opacity));
            }

            .focus\:ring-green-300:focus {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(134 239 172 / var(--tw-ring-opacity));
            }

            .focus\:ring-pink-300:focus {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(249 168 212 / var(--tw-ring-opacity));
            }

            .focus\:ring-purple-300:focus {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(216 180 254 / var(--tw-ring-opacity));
            }

            .focus\:ring-red-300:focus {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(252 165 165 / var(--tw-ring-opacity));
            }

            .focus\:ring-teal-300:focus {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(94 234 212 / var(--tw-ring-opacity));
            }

            .peer:checked~.peer-checked\:bg-blue-600 {
                --tw-bg-opacity: 1;
                background-color: rgb(37 99 235 / var(--tw-bg-opacity));
            }

            .peer:checked~.peer-checked\:after\:translate-x-full::after {
                content: var(--tw-content);
                --tw-translate-x: 100%;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }

            .peer:checked~.peer-checked\:after\:border-white::after {
                content: var(--tw-content);
                --tw-border-opacity: 1;
                border-color: rgb(255 255 255 / var(--tw-border-opacity));
            }

            .peer:focus~.peer-focus\:outline-none {
                outline: 2px solid transparent;
                outline-offset: 2px;
            }

            .peer:focus~.peer-focus\:ring-4 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(4px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
            }

            .peer:focus~.peer-focus\:ring-blue-300 {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(147 197 253 / var(--tw-ring-opacity));
            }

            :is([dir="ltr"] .ltr\:right-10) {
                right: 2.5rem;
            }

            :is([dir="ltr"] .ltr\:ml-2) {
                margin-left: 0.5rem;
            }

            :is([dir="ltr"] .ltr\:ml-\[-10px\]) {
                margin-left: -10px;
            }

            :is([dir="ltr"] .ltr\:ml-\[-20px\]) {
                margin-left: -20px;
            }

            :is([dir="ltr"] .ltr\:mr-3) {
                margin-right: 0.75rem;
            }

            :is([dir="rtl"] .rtl\:left-10) {
                left: 2.5rem;
            }

            :is([dir="rtl"] .rtl\:ml-3) {
                margin-left: 0.75rem;
            }

            :is([dir="rtl"] .rtl\:mr-2) {
                margin-right: 0.5rem;
            }

            :is([dir="rtl"] .rtl\:mr-\[-10px\]) {
                margin-right: -10px;
            }

            :is([dir="rtl"] .rtl\:mr-\[-20px\]) {
                margin-right: -20px;
            }

            :is([dir="rtl"] .rtl\:flex-row-reverse) {
                flex-direction: row-reverse;
            }

            :is([dir="rtl"] .rtl\:justify-end) {
                justify-content: flex-end;
            }

            :is([dir="rtl"] .rtl\:space-x-reverse)> :not([hidden])~ :not([hidden]) {
                --tw-space-x-reverse: 1;
            }

            :is([dir="rtl"] .rtl\:pl-0) {
                padding-left: 0px;
            }

            @media (prefers-color-scheme: dark) {
                .dark\:border-gray-600 {
                    --tw-border-opacity: 1;
                    border-color: rgb(75 85 99 / var(--tw-border-opacity));
                }

                .dark\:border-gray-700 {
                    --tw-border-opacity: 1;
                    border-color: rgb(55 65 81 / var(--tw-border-opacity));
                }

                .dark\:bg-gray-700 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(55 65 81 / var(--tw-bg-opacity));
                }

                .dark\:bg-gray-800 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(31 41 55 / var(--tw-bg-opacity));
                }

                .dark\:bg-gray-900 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(17 24 39 / var(--tw-bg-opacity));
                }

                .dark\:bg-opacity-80 {
                    --tw-bg-opacity: 0.8;
                }

                .dark\:from-gray-600 {
                    --tw-gradient-from: #4b5563 var(--tw-gradient-from-position);
                    --tw-gradient-to: rgb(75 85 99 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
                }

                .dark\:from-gray-700 {
                    --tw-gradient-from: #374151 var(--tw-gradient-from-position);
                    --tw-gradient-to: rgb(55 65 81 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
                }

                .dark\:via-gray-700 {
                    --tw-gradient-to: rgb(55 65 81 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), #374151 var(--tw-gradient-via-position), var(--tw-gradient-to);
                }

                .dark\:via-gray-800 {
                    --tw-gradient-to: rgb(31 41 55 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), #1f2937 var(--tw-gradient-via-position), var(--tw-gradient-to);
                }

                .dark\:to-gray-800 {
                    --tw-gradient-to: #1f2937 var(--tw-gradient-to-position);
                }

                .dark\:to-gray-900 {
                    --tw-gradient-to: #111827 var(--tw-gradient-to-position);
                }

                .dark\:text-gray-200 {
                    --tw-text-opacity: 1;
                    color: rgb(229 231 235 / var(--tw-text-opacity));
                }

                .dark\:text-white {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity));
                }

                .dark\:placeholder-gray-400::-moz-placeholder {
                    --tw-placeholder-opacity: 1;
                    color: rgb(156 163 175 / var(--tw-placeholder-opacity));
                }

                .dark\:placeholder-gray-400::placeholder {
                    --tw-placeholder-opacity: 1;
                    color: rgb(156 163 175 / var(--tw-placeholder-opacity));
                }

                .dark\:shadow-2xl {
                    --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
                    --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
                    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
                }

                .dark\:shadow-lg {
                    --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                    --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
                    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
                }

                .dark\:shadow-blue-800\/80 {
                    --tw-shadow-color: rgb(30 64 175 / 0.8);
                    --tw-shadow: var(--tw-shadow-colored);
                }

                .dark\:shadow-green-800\/80 {
                    --tw-shadow-color: rgb(22 101 52 / 0.8);
                    --tw-shadow: var(--tw-shadow-colored);
                }

                .dark\:shadow-purple-800\/80 {
                    --tw-shadow-color: rgb(107 33 168 / 0.8);
                    --tw-shadow: var(--tw-shadow-colored);
                }

                .dark\:shadow-red-800\/80 {
                    --tw-shadow-color: rgb(153 27 27 / 0.8);
                    --tw-shadow: var(--tw-shadow-colored);
                }

                .dark\:hover\:stroke-gray-300:hover {
                    stroke: #d1d5db;
                }

                .dark\:hover\:text-gray-300:hover {
                    --tw-text-opacity: 1;
                    color: rgb(209 213 219 / var(--tw-text-opacity));
                }

                .dark\:focus\:border-blue-500:focus {
                    --tw-border-opacity: 1;
                    border-color: rgb(59 130 246 / var(--tw-border-opacity));
                }

                .dark\:focus\:ring-blue-500:focus {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity));
                }

                .dark\:focus\:ring-blue-800:focus {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(30 64 175 / var(--tw-ring-opacity));
                }

                .dark\:focus\:ring-green-800:focus {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(22 101 52 / var(--tw-ring-opacity));
                }

                .dark\:focus\:ring-pink-800:focus {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(157 23 77 / var(--tw-ring-opacity));
                }

                .dark\:focus\:ring-purple-800:focus {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(107 33 168 / var(--tw-ring-opacity));
                }

                .dark\:focus\:ring-red-800:focus {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(153 27 27 / var(--tw-ring-opacity));
                }

                .peer:focus~.dark\:peer-focus\:ring-blue-800 {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(30 64 175 / var(--tw-ring-opacity));
                }
            }

            @media (min-width: 640px) {
                .sm\:mx-auto {
                    margin-left: auto;
                    margin-right: auto;
                }

                .sm\:basis-1\/5 {
                    flex-basis: 20%;
                }

                .sm\:basis-4\/5 {
                    flex-basis: 80%;
                }

                .sm\:flex-row {
                    flex-direction: row;
                }

                .sm\:flex-col {
                    flex-direction: column;
                }

                .sm\:space-y-0> :not([hidden])~ :not([hidden]) {
                    --tw-space-y-reverse: 0;
                    margin-top: calc(0px * calc(1 - var(--tw-space-y-reverse)));
                    margin-bottom: calc(0px * var(--tw-space-y-reverse));
                }

                .sm\:divide-x> :not([hidden])~ :not([hidden]) {
                    --tw-divide-x-reverse: 0;
                    border-right-width: calc(1px * var(--tw-divide-x-reverse));
                    border-left-width: calc(1px * calc(1 - var(--tw-divide-x-reverse)));
                }

                .sm\:divide-blue-600\/50> :not([hidden])~ :not([hidden]) {
                    border-color: rgb(37 99 235 / 0.5);
                }

                .sm\:rounded-3xl {
                    border-radius: 1.5rem;
                }

                .sm\:rounded-xl {
                    border-radius: 0.75rem;
                }

                .sm\:px-10 {
                    padding-left: 2.5rem;
                    padding-right: 2.5rem;
                }

                .sm\:py-6 {
                    padding-top: 1.5rem;
                    padding-bottom: 1.5rem;
                }

                .sm\:text-3xl {
                    font-size: 1.875rem;
                    line-height: 2.25rem;
                }

                .sm\:text-base {
                    font-size: 1rem;
                    line-height: 1.5rem;
                }

                .sm\:text-lg {
                    font-size: 1.125rem;
                    line-height: 1.75rem;
                }

                .sm\:text-xl {
                    font-size: 1.25rem;
                    line-height: 1.75rem;
                }

                :is([dir="ltr"] .sm\:ltr\:mr-4) {
                    margin-right: 1rem;
                }

                :is([dir="ltr"] .sm\:ltr\:pl-9) {
                    padding-left: 2.25rem;
                }

                :is([dir="ltr"] .sm\:ltr\:pr-9) {
                    padding-right: 2.25rem;
                }

                :is([dir="rtl"] .sm\:rtl\:ml-4) {
                    margin-left: 1rem;
                }

                :is([dir="rtl"] .sm\:rtl\:divide-x-reverse)> :not([hidden])~ :not([hidden]) {
                    --tw-divide-x-reverse: 1;
                }

                :is([dir="rtl"] .sm\:rtl\:pl-9) {
                    padding-left: 2.25rem;
                }

                :is([dir="rtl"] .sm\:rtl\:pr-9) {
                    padding-right: 2.25rem;
                }
            }

            @media (min-width: 768px) {
                .md\:h-20 {
                    height: 5rem;
                }

                .md\:h-32 {
                    height: 8rem;
                }

                .md\:w-20 {
                    width: 5rem;
                }

                .md\:w-32 {
                    width: 8rem;
                }

                .md\:grid-cols-3 {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }

                .md\:text-2xl {
                    font-size: 1.5rem;
                    line-height: 2rem;
                }

                .md\:text-5xl {
                    font-size: 3rem;
                    line-height: 1;
                }

                :is([dir="ltr"] .md\:ltr\:ml-\[-20px\]) {
                    margin-left: -20px;
                }

                :is([dir="rtl"] .md\:rtl\:mr-\[-20px\]) {
                    margin-right: -20px;
                }
            }

            @media (min-width: 1024px) {
                .lg\:text-base {
                    font-size: 1rem;
                    line-height: 1.5rem;
                }

                .lg\:text-xl {
                    font-size: 1.25rem;
                    line-height: 1.75rem;
                }
            }
        </style>

        <!-- <link rel="stylesheet" href="../output.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/gh/rastikerdar/shabnam-font@v5.0.1/dist/font-face.css" rel="stylesheet"
            type="text/css" />

        <script src="https://cdn.jsdelivr.net/npm/alpinejs-i18n@2.4.0/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.8/dist/cdn.min.js" defer></script>
        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
        <script defer src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

        <script defer>
            const sub = "<?= $user["subscription_url"] ?>"
            let fullUrl = `${window.location.origin}<?= $user["subscription_url"] ?>`;
            if (sub.startsWith("http")) {
                fullUrl = sub;
            }

            function setHrefs() {
                document.getElementById("ios-streisand").href = `streisand://import/${fullUrl}`;
                document.getElementById("ios-v2box").href = `v2box://install-sub?url=${fullUrl}&name=Sub`
                document.getElementById("android-v2rayng").href = `v2rayng://install-config?url=${fullUrl}`;
                document.getElementById("ios-singbox").href = `sing-box://import-remote-profile?url=${fullUrl}#Sub`;
                document.getElementById("android-singbox").href = `sing-box://import-remote-profile?url=${fullUrl}#Sub`;
                document.getElementById("android-nekobox").href = `sn://subscription?url=${fullUrl}&name=Sub`;
                document.getElementById("windows-clashverge").href = `clash://install-config?url=${fullUrl}`


                // Android Apps


                // PC Apps


                // Multi Os Apps

            }

            function copyToClipboard(e, textToCopy) {
                if (e) {
                    const copyCfgBtn = e.target.closest('.btnCopy')
                    const defaultContent = copyCfgBtn.innerHTML;
                    copyCfgBtn.innerHTML = `<lord-icon class="w-8 h-8" src="https://cdn.lordicon.com/jvihlqtw.json" trigger="loop"
                                    delay="1" colors="primary:#fff,secondary:#fff">
                                </lord-icon>`

                    setTimeout(function () {
                        copyCfgBtn.innerHTML = defaultContent;
                    }, 2000);
                }
                // Create a temporary text area element
                const textArea = document.createElement("textarea");

                // Set the text content to be copied
                textArea.value = textToCopy;

                // Append the text area to the DOM
                document.body.appendChild(textArea);

                // Select the text in the text area
                textArea.select();

                try {
                    // Attempt to copy the selected text to the clipboard
                    document.execCommand("copy");
                } catch (err) {
                    console.error("Unable to copy text to clipboard:", err);
                } finally {
                    // Remove the temporary text area element
                    document.body.removeChild(textArea);
                }
            }

            function iOSversion() {
                if (/iP(hone|od|ad)/.test(navigator.platform)) {
                    // supports iOS 2.0 and later: <http://bit.ly/TJjs1V>
                    var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
                    return `${parseInt(v[1], 10)}.${parseInt(v[2], 10)}.${parseInt(v[3] || 0, 10)}`;
                }
            }

            function calculatePercentage(used, limit) {
                const parsedUsed = parseFloat(used);
                const parsedLimit = parseFloat(limit);

                if (isNaN(parsedUsed) || isNaN(parsedLimit)) {
                    return 0; // Handle invalid input
                }

                const usagePercentage = (parsedUsed / parsedLimit) * 100;
                return Math.min(usagePercentage, 100).toFixed(1); // Cap at 100%
            }
            function getChartColor(percentage) {
                return percentage < 40 ? 'text-green-500' : percentage < 80 ? 'text-yellow-600' : 'text-red-500';
            }

            function openFoXrayURL() {
                var currentURL = window.location.href;
                var encodedURL = btoa(currentURL);
                var foXrayURL = 'foxray://yiguo.dev/sub/add/?url=' + encodedURL + '#name';
                window.location.href = foXrayURL;
            }

            function openShadowrocketURL() {
                var currentURL = window.location.href;
                var encodedURL = btoa(currentURL);
                var shadowrocketLink = 'sub://' + encodedURL;
                window.location.href = shadowrocketLink;
            }

            function openDynamicModal(title, url) {
                var modal = document.getElementById("QrModal");
                let qrSize = window.innerWidth > 450 ? (window.innerHeight > 450 ? 400 : window.innerHeight - 200) : window.innerHeight > 450 ? window.innerWidth - 100 : window.innerHeight - 200;
                window.resizeTo(function () {
                    qrSize = window.innerWidth > 450 ? (window.innerHeight > 450 ? 400 : window.innerHeight - 200) : window.innerHeight > 450 ? window.innerWidth - 100 : window.innerHeight - 200;
                }, function () {
                    qrSize = window.innerWidth > 450 ? (window.innerHeight > 450 ? 400 : window.innerHeight - 200) : window.innerHeight > 450 ? window.innerWidth - 100 : window.innerHeight - 200;
                });

                var modalTitle = document.getElementById("modalTitle");
                document.getElementById("qrcode").innerHTML = ''
                new QRCode(document.getElementById("qrcode"), {
                    text: url,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    width: qrSize,
                    height: qrSize,
                    correctLevel : QRCode.CorrectLevel.L
                });

                // Set dynamic content
                modalTitle.innerText = title;
                // Show the modal
                modal.click()
                // modal.checked = true;
            }

            function extractNameFromConfigURL(url) {
                const namePattern = /#([^#]*)/;
                const match = url.match(namePattern);

                if (match) {
                    const name = decodeURIComponent(match[1]);
                    return name;
                } else if (url.startsWith("vmess://")) {
                    const encodedString = url.replace("vmess://", "");
                    const decodedString = atob(encodedString);
                    return JSON.parse(decodedString).ps
                }
                else {
                    return null; // Return null if the pattern doesn't match
                }
            }

            function detectOS() {
                const userAgent = navigator.userAgent.toLowerCase();

                if (userAgent.includes('win')) {
                    return 'Windows';
                } else if (userAgent.includes('mac') && !userAgent.includes('iphone') && !userAgent.includes('ipad')) {
                    return 'iOS';
                } else if (userAgent.includes('android')) {
                    return 'Android';
                } else if (userAgent.includes('linux')) {
                    return 'Linux';
                } else if (userAgent.includes('iphone') || userAgent.includes('ipad')) {
                    return 'iOS';
                } else {
                    return 'Unknown';
                }
            }

            window
                .matchMedia("(prefers-color-scheme: dark)")
                .addEventListener("change", function (e) {
                    getQrIcon()
                });

            function getQrIcon() {
                let dark = window.matchMedia("(prefers-color-scheme: dark)").matches;
                const btnQr = document.getElementById('qrIconBtn')
                const btnCfgs = document.getElementById('myConfigsContainer')
                btnQr.innerHTML = ""
                btnCfgs.innerHTML = ""


                if (dark) {
                    btnQr.innerHTML = `<lord-icon src="https://cdn.lordicon.com/fqrjldna.json" trigger="loop" delay="2000"
                           
                               colors="primary:#fff,secondary:#fff"
                                    class="w-10 h-10">
                               </lord-icon>`
                    btnCfgs.innerHTML = `<lord-icon class="w-8 h-8" src="https://cdn.lordicon.com/gqzfzudq.json"
                                                    trigger="loop" delay="2000" colors="primary:#fff,secondary:#fff">
                                                </lord-icon>`
                } else {
                    btnQr.innerHTML = `<lord-icon src="https://cdn.lordicon.com/fqrjldna.json" trigger="loop" delay="2000"
                           
                               colors="primary:#000,secondary:#000"
                                    class="w-10 h-10">
                               </lord-icon>`
                    btnCfgs.innerHTML = `<lord-icon class="w-8 h-8" src="https://cdn.lordicon.com/gqzfzudq.json"
                                                    trigger="loop" delay="2000" colors="primary:#000,secondary:#000">
                                                </lord-icon>`
                }
                return
            }

            function renderOS() {
                const userOS = detectOS();

                const container = document.getElementById('OsContainer');
                const iosDiv = document.getElementById('iOSContainer');
                const androidDiv = document.getElementById('AndroidContainer');
                const windowsDiv = document.getElementById('WindowsContainer');

                // Reorder the div elements based on the detected OS
                switch (userOS) {
                    case 'iOS':
                        container.removeChild(iosDiv);
                        container.insertBefore(iosDiv, container.firstChild);
                        const iosFirstChildDiv = iosDiv.querySelector('div');
                        if (iosFirstChildDiv) {
                            iosFirstChildDiv.setAttribute('x-data', '{ expanded: true }');
                        }
                        break;
                    case 'Android':
                        container.removeChild(androidDiv);
                        container.insertBefore(androidDiv, container.firstChild);
                        const androidFirstChildDiv = androidDiv.querySelector('div');
                        console.log(androidFirstChildDiv);
                        if (androidFirstChildDiv) {
                            androidFirstChildDiv.setAttribute('x-data', '{ expanded: true }');
                        }
                        break;
                    case 'Windows':
                        container.removeChild(windowsDiv);
                        container.insertBefore(windowsDiv, container.firstChild);
                        const windowsFirstChildDiv = windowsDiv.querySelector('div');
                        if (windowsFirstChildDiv) {
                            windowsFirstChildDiv.setAttribute('x-data', '{ expanded: true }');
                        }
                        break;
                    default:
                        // Handle other cases or do nothing for unsupported OS
                        break;
                }
            }

            function renderConfigs() {
                const subLinks = "[<?= "'" . implode("', '", $user['links']) . "'" ?>]";
                const configsElement = document.querySelector("#configs_section")
                const cleanedString = subLinks.replace(/[\[\]']/g, '');

                // Split the cleaned string into an array using ', ' (comma and space) as the delimiter
                const configArray = cleanedString.split(', ');
                configArray.forEach((cfg, index) => {
                    configsElement.innerHTML += `
                <div class="flex items-center bg-slate-900 px-4 py-2 rounded-lg">
                                        <span class="flex-1">${extractNameFromConfigURL(cfg)}</span>
                                        <div class="flex items-center justify-start gap-x-2">
                                            <div class="w-10 h-10 overflow-hidden">
                                                <button id="copyCfg-${index}" onclick="copyToClipboard(event,'${cfg}')" data-tooltip-target="copyLink" type="button" class="btnCopy">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" class="w-8 h-8 fill-white">
      <path fill-rule="evenodd" d="M10.5 3A1.501 1.501 0 009 4.5h6A1.5 1.5 0 0013.5 3h-3zm-2.693.178A3 3 0 0110.5 1.5h3a3 3 0 012.694 1.678c.497.042.992.092 1.486.15 1.497.173 2.57 1.46 2.57 2.929V19.5a3 3 0 01-3 3H6.75a3 3 0 01-3-3V6.257c0-1.47 1.073-2.756 2.57-2.93.493-.057.989-.107 1.487-.15z" clip-rule="evenodd" />
    </svg>

                                                </button>
                                                <div x-text="$t('copyLink')" id="copyLink" role="tooltip"
                                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">

                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                            </div>
                                            <div class="w-10 h-10 overflow-hidden">

                                                <button onclick="openDynamicModal(extractNameFromConfigURL('${cfg}'), '${cfg}')" data-tooltip-target="qrCode" type="button" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" class="w-8 h-8 fill-white">
      <path fill-rule="evenodd" d="M3 4.875C3 3.839 3.84 3 4.875 3h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 013 9.375v-4.5zM4.875 4.5a.375.375 0 00-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 00.375-.375v-4.5a.375.375 0 00-.375-.375h-4.5zm7.875.375c0-1.036.84-1.875 1.875-1.875h4.5C20.16 3 21 3.84 21 4.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5a1.875 1.875 0 01-1.875-1.875v-4.5zm1.875-.375a.375.375 0 00-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 00.375-.375v-4.5a.375.375 0 00-.375-.375h-4.5zM6 6.75A.75.75 0 016.75 6h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75A.75.75 0 016 7.5v-.75zm9.75 0A.75.75 0 0116.5 6h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zM3 14.625c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.035-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 013 19.125v-4.5zm1.875-.375a.375.375 0 00-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 00.375-.375v-4.5a.375.375 0 00-.375-.375h-4.5zm7.875-.75a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zm6 0a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zM6 16.5a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zm9.75 0a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zm-3 3a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zm6 0a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75z" clip-rule="evenodd" />
    </svg>

                                                </button>
                                                <div x-text="$t('qrCode')" id="qrCode" role="tooltip"
                                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">

                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                `
                })
            }

            Alpine.data('dataLimit', '0'); // Initialize Alpine data properties
            Alpine.data('dataUsed', '0');

            Alpine.start();
        </script>
        <script defer>
            const dataLimit = "<?= !empty($user['data_limit']) ? $user['data_limit'] : '∞'; ?>";
            const dataUsed = "<?= $user["used_traffic"] ?>";
            const expireDateInit = "<?= empty($user['expire']) ? '∞' : date('Y-m-d H:i:s', $user['expire']); ?>";
            var tmpUsage = ((parseFloat(dataUsed) / parseFloat(dataLimit)) * 100).toFixed(2);
            if (tmpUsage > 100) tmpUsage = 100;
            const dataUsage = "<?= empty($user['data_limit']) ? 100 : (((($user['used_traffic'] / $user['data_limit']) * 100) < 100 ? number_format(($user['used_traffic'] / $user['data_limit']) * 100, 2) : 100)); ?>"
            const dataChartColor = dataUsage < 40 ? "bg-green-500" : dataUsage < 80 ? "bg-yellow-600" : "bg-red-500";
            let expireDateVar = expireDateInit.includes("∞") ? "∞" : localStorage.getItem("lang") == "fa" ? new Date(expireDateInit).toLocaleString("fa-IR-u-nu-latn").replace(",", " ") : expireDateInit;
            const resetInterval = "<?php echo $user['data_limit_reset_strategy']; ?>";
            let appsJson = {
                IOS: {
                    Streisand: {
                        url: [
                            {
                                name: "IOS 14+",
                                url: "https://apps.apple.com/us/app/streisand/id6450534064",
                                best: true,
                            },
                        ],
                        tutorial: "",
                    },
                    FoXray: {
                        url: [
                            {
                                name: "IOS 16+",
                                url: "https://apps.apple.com/us/app/foxray/id6448898396",
                                best: false,
                            },
                        ],
                        tutorial: "",
                    },
                    V2Box: {
                        url: [
                            {
                                name: "IOS 14+",
                                url: "https://apps.apple.com/us/app/v2box-v2ray-client/id6446814690",
                                best: false,
                            },
                        ],
                        tutorial: "",
                    },
                    Shadowrocket: {
                        url: [
                            {
                                name: "$3.99",
                                url: "https://apps.apple.com/ca/app/shadowrocket/id932747118",
                                best: false,
                            },
                        ],
                        tutorial: "",
                    },
                },
                Android: {
                    v2rayNG: {
                        url: [
                            {
                                name: "GooglePlay",
                                url: "https://play.google.com/store/apps/details?id=com.v2ray.ang",
                                best: true,
                            },
                            {
                                name: "Github",
                                url: "https://github.com/2dust/v2rayNG/releases/download/1.8.17/v2rayNG_1.8.17.apk",
                                best: false,
                            },
                        ],
                        tutorial: "",
                    },
                    NekoBox: {
                        url: [
                            {
                                name: "Arm64",
                                url: "https://github.com/MatsuriDayo/NekoBoxForAndroid/releases/download/1.2.9/NB4A-1.2.9-arm64-v8a.apk",
                                best: false,
                            },
                            {
                                name: "Armeabi",
                                url: "https://github.com/MatsuriDayo/NekoBoxForAndroid/releases/download/1.2.9/NB4A-1.2.9-armeabi-v7a.apk",
                                best: false,
                            },
                        ],
                        tutorial: "",
                    },
                },
                Windows: {
                    nekoray: {
                        url: [
                            {
                                name: "",
                                url: "https://github.com/MatsuriDayo/nekoray/releases/download/3.26/nekoray-3.26-2023-12-09-windows64.zip",
                                best: true,
                            },
                        ],
                        tutorial: "",
                    },
                    v2rayN: {
                        url: [
                            {
                                name: "",
                                url: "https://github.com/2dust/v2rayN/releases/download/6.33/zz_v2rayN-With-Core-SelfContained.7z",
                                best: false,
                            },
                        ],
                        tutorial: "",
                    },
                },
            };
            let langJson = {
                en: {
                    active: "Active",
                    limited: "Limited",
                    expired: "Expired",
                    disabled: "Disabled",
                    dataUsage: "Data Usage: ",
                    expirationDate: "Expiration Date: ",
                    resetIntervalDay: "(Resets Every Day)",
                    resetIntervalWeek: "(Resets Every Week)",
                    resetIntervalMonth: "(Resets Every Month)",
                    resetIntervalYear: "(Resets Every Year)",
                    remainingDays: "Remaining Days: ",
                    remainingDaysSufix: " Days",
                    links: "Links",
                    apps: "Download Apps",
                    Android: "Android",
                    iOS: "iOS",
                    Windows: "Windows",
                    macOS: "macOS",
                    tutorials: "Tutorials",
                    subscription: "Subscription",
                    language: "Language",
                    settings: "Settings",
                    darkMode: "Dark mode",
                    copyAll: "Copy All",
                    proxy: "Proxy",
                    tutorial: "Tutorial",
                    download: "Download",
                    telchannel: "Telegram Channel",
                    telsupport: "Telegram Support",
                    telProxy: "Telegram Proxy",
                    v2rayNG: "Android - Download v2rayNG",
                    NekoBox: "Android - Download NekoBox",
                    SingBox: "Android - Download SingBox",
                    Streisand: "iOS - Download Streisand",
                    FoXray: "iOS - Downaload FoXray",
                    V2Box: "iOS - Download v2Box",
                    addto: "Quick Install",
                    addV2rayNG: "v2rayNG",
                    addStreisand: "Streisand",
                    addFoXray: "FoXray",
                    addNekoBox: "NekoBox",
                    addV2Box: "v2Box",
                    addShadowrocket: "Shadowrocket",
                    addsingbox: "Sing-Box",
                    addV2rayN: "v2rayN",
                    addnekoray: "Nekoray",
                    addClash: "Clash",
                    addClashMeta: "Clash Meta",
                    addClashVerge: "Clash Verge",
                    addClashX: "Clash X",
                    install: "Click on the download link to download the program for your operating system!",
                    support: "Support",
                    oneClick: "To use Config, just click on the program you are using!",
                    restofusage: "Data Usage",
                    needediOS: "iOS Version Needed: ",
                    clickForDownload: "Click on the link below to download the program",
                    clickForAdd: "Click on the link below to add the configurations into the program.",
                    copyLink: "Copy",
                    qrCode: "QrCode",
                    downloadApp: "Download Program",
                    addConfigs: "Add Configs",
                    AddtoApp: "Add to App",
                    myConfigs: "My Configs",
                    copyAllCfgs: "Copy All Configs",
                    copied: "Copied",
                    clickOutClose: "Click outside of modal to close.",
                    chooseApp: "Choose your desired program.",
                    routingTitle: "Routing - Recommended",
                    routingInfo: "By adding routing, internal websites and applications are not passed through the VPN",
                    routingIR: "Add Iran Service",
                    routingRU: "Add Russia Service",
                    myiOS: 'My iOS Version: ',
                    v2rayNGs3: "Update Subscription",
                    v2rayNGs3Info: "After step two, you need to update your subscription once. There are two images below which guides you through it.",
                    howToConnect: "How To Connect?",
                    connectInfo: "You can use your subscription through the following menu for your desired operating system.",
                    macInfo: "Note: subscription setup on Mac is the same as iOS.",
                    generalAccess: "General Access",
                    generalAccessInfo: "In this section, you have access to your configs separately which allows you to share each of them through QR Code or you can simply copy them.",
                    supTelInfo: "If there are any problems with subscription, please contact support on Telegram."
                },
                fa: {
                    active: "فعال",
                    limited: "تمام شده",
                    expired: "پایان یافته",
                    disabled: "غیرفعال",
                    dataUsage: "میزان استفاده: ",
                    expirationDate: "تاریخ پایان اشتراک: ",
                    resetIntervalDay: "(ریست روزانه)",
                    resetIntervalWeek: "(ریست هفتگی)",
                    resetIntervalMonth: "(ریست ماهانه)",
                    resetIntervalYear: "(ریست سالانه)",
                    remainingDays: "روزهای باقی‌مانده: ",
                    remainingDaysSufix: " روز",
                    links: "لینک‌ها",
                    apps: "دانلود برنامه‌ها",
                    Android: "اندروید",
                    iOS: "آی او اِس",
                    Windows: "ویندوز",
                    macOS: "مک او اِس",
                    tutorials: "آموزش‌ها",
                    subscription: "لینک اشتراک",
                    language: "زبان",
                    settings: "تنظیمات",
                    darkMode: "تم تیره",
                    copyAll: "کپی همه",
                    proxy: "پروکسی",
                    tutorial: "آموزش",
                    download: "دانلود",
                    telchannel: "کانال تلگرام",
                    telProxy: "پروکسی تلگرام",
                    telsupport: "پشتیبانی تلگرام",
                    v2rayNG: "اندروید - دانلود برنامه v2rayNG",
                    NekoBox: "اندروید - دانلود برنامه NekoBox",
                    SingBox: "اندروید - دانلود برنامه Sing-Box",
                    Streisand: "آی او اِس - دانلود برنامه Streisand",
                    FoXray: "آی او اِس - دانلود برنامه FoXray",
                    V2Box: "آی او اِس - دانلود برنامه v2Box",
                    addto: "نصب با یک کلیک",
                    addV2rayNG: "v2rayNG",
                    addStreisand: "Streisand",
                    addFoXray: "FoXray",
                    addNekoBox: "NekoBox",
                    addV2Box: "v2Box",
                    addShadowrocket: "Shadowrocket",
                    addsingbox: "Sing-Box",
                    addV2rayN: "v2rayN",
                    addnekoray: "Nekoray",
                    addClash: "Clash",
                    addClashMeta: "Clash Meta",
                    addClashVerge: "Clash Verge",
                    addClashX: "Clash X",
                    install: "برای دانلود برنامه مورد نظر نسبت به سیستم عامل خودتون روی لینک دانلود کلیک کنید!",
                    support: "پشتیبانی",
                    oneClick: "برای نصب سریع برنامه مورد نظر رو انتخاب کنید.",
                    restofusage: "میزان استفاده",
                    needediOS: "سیستم عامل مورد نیاز: ",
                    clickForDownload: "برای دانلود کردن برنامه روی لینک زیر کلیک کنید",
                    clickForAdd: "برای اضافه کردن کانفیگ‌ ها داخل برنامه روی لینک زیر کلیک کنید.",
                    copyLink: "کپی کردن",
                    qrCode: "کیوآرکد",
                    downloadApp: "دانلود برنامه",
                    addConfigs: "افزودن کانفیگ ها",
                    AddtoApp: "افزودن به برنامه",
                    myConfigs: "کانفیگ های من",
                    copyAllCfgs: "کپی کردن همه کانفیگ ها",
                    copied: "کپی شد",
                    clickOutClose: "برای بسته شدن بیرون از باکس کلیک کنید",
                    chooseApp: "برنامه مورد نظر خود را انتخاب کنید",
                    routingTitle: "مسیریابی - پیشنهادی",
                    routingInfo: "با اضافه کردن مسیریابی, وب سایت ها و برنامه های داخلی از VPN عبور داده نمیشود",
                    routingIR: "افزودن سرویس ایران",
                    routingRU: "افزودن سرویس روسیه",
                    myiOS: "سیستم عامل من",
                    v2rayNGs3: "بروزرسانی اشتراک",
                    v2rayNGs3Info: "پس از مرحله دوم، باید یک بار اشتراک خود را به روز کنید. دو تصویر شما را راهنمایی می کند.",
                    howToConnect: "چطوری وصل بشم؟",
                    connectInfo: "با استفاده از منو های زیر نسبت به سیستم عامل خود می توانید از اشتراک خود استفاده کنید.",
                    macInfo: "نکته: اتصال در مک مشابه آی او اِس است",
                    generalAccess: "دسترسی کلی",
                    generalAccessInfo: "در این بخش، شما به کانفیگ های خود به طور جداگانه دسترسی دارید که به شما امکان می دهد هر یک از آنها را از طریق کد QR به اشتراک بگذارید یا می توانید به سادگی آنها را کپی کنید.",
                    supTelInfo: "در صورت وجود هرگونه مشکل در اشتراک, با پشیتبانی تلگرام در ارتباط باشید."
                },
                ru: {
                    active: "Активен",
                    limited: "Ограничен",
                    expired: "Просрочен",
                    disabled: "Отключен",
                    dataUsage: "Использовано данных: ",
                    expirationDate: "Дата окончания срока: ",
                    resetIntervalDay: "(сбрасывает каждый день)",
                    resetIntervalWeek: "(сбрасывается каждую неделю)",
                    resetIntervalMonth: "(сбрасывается каждый месяц)",
                    resetIntervalYear: "(сбрасывается каждый год)",
                    remainingDays: "Оставшиеся дни: ",
                    remainingDaysSufix: " дней",
                    links: "ссылки",
                    apps: "Скачать программы",
                    Android: "Android",
                    iOS: "iOS",
                    Windows: "Windows",
                    macOS: "macOS",
                    tutorials: "учебники",
                    subscription: "подписка",
                    language: "язык",
                    settings: "настройки",
                    darkMode: "тёмный режим",
                    copyAll: "скопировать все",
                    proxy: "прокси",
                    tutorial: "руководство",
                    download: "Скачать",
                    telchannel: "Телеграм-канал",
                    telsupport: "Поддержка Telegram",
                    telProxy: "Прокси-сервер Telegram",
                    v2rayNG: "Android - Download v2rayNG",
                    NekoBox: "Android - Download NekoBox",
                    SingBox: "Android - Download SingBox",
                    Streisand: "iOS - Download Streisand",
                    FoXray: "iOS - Downaload FoXray",
                    V2Box: "iOS - Download v2Box",
                    addto: "Быстрая настройка",
                    addV2rayNG: "v2rayNG",
                    addStreisand: "Streisand",
                    addFoXray: "FoXray",
                    addNekoBox: "NekoBox",
                    addV2Box: "v2Box",
                    addShadowrocket: "Shadowrocket",
                    addsingbox: "Sing-Box",
                    addV2rayN: "v2rayN",
                    addnekoray: "Nekoray",
                    addClash: "Clash",
                    addClashMeta: "Clash Meta",
                    addClashVerge: "Clash Verge",
                    addClashX: "Clash X",
                    install: "Нажмите на следующие кнопки, чтобы загрузить программу для вашей операционной системы!",
                    support: "Поддержка",
                    oneClick: "Для быстрой установки конфига, выберите приложение, которое вы используете!",
                    restofusage: "Использовано данных",
                    needediOS: "Нужна версия iOS: ",
                    clickForDownload: "Нажмите на ссылку ниже, чтобы загрузить программу",
                    clickForAdd: "Нажмите на ссылку ниже, чтобы добавить конфигурации в программу",
                    copyLink: "Копировать",
                    qrCode: "QrCode",
                    downloadApp: "Скачайте программу",
                    addConfigs: "Добавьте конфиги",
                    AddtoApp: "Добавить в приложение",
                    myConfigs: "Мои конфиги",
                    copyAllCfgs: "Скопировать все конфиги",
                    copied: "Скопировано",
                    clickOutClose: "Нажмите за пределами окна, чтобы закрыть.",
                    chooseApp: "Выберите нужную вам программу",
                    routingTitle: "Роутинг — рекоммендуется",
                    routingInfo: "При добавлении роутинга, сайты внутри страны будут открываться без VPN",
                    routingIR: "Добавить Иранские сайты",
                    routingRU: "Добавить Российские сайты",
                    myiOS: 'Моя версия IOS: ',
                    v2rayNGs3: "Обновите подписку",
                    v2rayNGs3Info: "После второго шага необходимо один раз обновить подписку. Ниже приведены два изображения, которые помогут вам в этом.",
                    howToConnect: "Как подключиться?",
                    connectInfo: "Воспользоваться подпиской можно через следующее меню для нужной операционной системы",
                    macInfo: "Примечание: подключение на Mac OS аналогично IOS",
                    generalAccess: "Общий доступ",
                    generalAccessInfo: "В этом разделе вы получаете доступ к своим конфигурациям по отдельности, что позволяет делиться каждой из них с помощью QR-кода или просто копировать их.",
                    supTelInfo: "Если возникнут проблемы, обратитесь в службу поддержки в Telegram"
                },
            };
            let settings = {
                language: "fa",
            };

            function checkLang() {
                window.AlpineI18n.fallbackLocale = "fa";
                let locale = localStorage.getItem("lang") ?? settings.language;
                window.AlpineI18n.create(locale, langJson);
                AlpineI18n.locale = locale;
                document.body.setAttribute("dir", locale == "fa" ? "rtl" : "ltr");
            }

            document.addEventListener("alpine-i18n:ready", () => {
                checkLang()
                renderOS()
                getQrIcon()
            });

            // Function to set the selected language in local storage


            document.addEventListener('DOMContentLoaded', () => {
                const progressBar = document.getElementById('progress__bar')
                progressBar.style.setProperty("--value", dataUsage)
                renderOS()
                setHrefs()
                renderConfigs()
                const iOSVer = iOSversion()
                if (iOSVer) {
                    document.querySelector('#iOSVer').innerHTML = ""
                    document.querySelector('#iOSVer').innerHTML = `<div class="flex items-center gap-x-2 mb-4">
                                                        <span x-text="$t('myiOS')"></span>
                                                        <div
                                                            class="flex items-center rtl:flex-row-reverse rtl:justify-end gap-x-1">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_23_24)">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M4.36364 0C3.20633 0 2.09642 0.459739 1.27808 1.27808C0.459739 2.09642 0 3.20633 0 4.36364V19.6364C0 20.7937 0.459739 21.9036 1.27808 22.7219C2.09642 23.5403 3.20633 24 4.36364 24H19.6364C20.7937 24 21.9036 23.5403 22.7219 22.7219C23.5403 21.9036 24 20.7937 24 19.6364V4.36364C24 3.20633 23.5403 2.09642 22.7219 1.27808C21.9036 0.459739 20.7937 0 19.6364 0H4.36364ZM3.81818 8.82109C3.81818 8.53176 3.93312 8.25429 4.1377 8.0497C4.34229 7.84512 4.61976 7.73018 4.90909 7.73018C5.19842 7.73018 5.47589 7.84512 5.68048 8.0497C5.88507 8.25429 6 8.53176 6 8.82109C6 9.11042 5.88507 9.3879 5.68048 9.59248C5.47589 9.79707 5.19842 9.912 4.90909 9.912C4.61976 9.912 4.34229 9.79707 4.1377 9.59248C3.93312 9.3879 3.81818 9.11042 3.81818 8.82109ZM14.4545 10.9091C14.4545 9.912 15.3665 8.45455 17.4545 8.45455C18.2564 8.45455 18.9818 8.844 19.4782 9.25745C19.7345 9.47127 19.9604 9.71564 20.1295 9.96982C20.2833 10.2 20.4545 10.5338 20.4545 10.9091H18.8182C18.8182 10.9495 18.8236 10.9735 18.8247 10.9789C18.8095 10.9432 18.7905 10.9092 18.768 10.8775C18.6726 10.7416 18.5588 10.6197 18.4298 10.5153C18.1091 10.2469 17.7425 10.0909 17.4545 10.0909C16.2753 10.0909 16.0931 10.8087 16.0909 10.908C16.0876 10.9036 16.0887 10.908 16.0909 10.9091V10.908C16.1567 10.9741 16.2344 11.027 16.32 11.064C16.632 11.22 17.0793 11.3356 17.6531 11.4785L17.7022 11.4916C18.2105 11.6182 18.8302 11.7731 19.32 12.0185C19.8349 12.276 20.4545 12.7636 20.4545 13.6364C20.4545 14.6335 19.5425 16.0909 17.4545 16.0909C15.3665 16.0909 14.4545 14.6335 14.4545 13.6364H16.0909C16.0909 13.7302 16.2698 14.4545 17.4545 14.4545C18.6338 14.4545 18.816 13.7367 18.8182 13.6375C18.8215 13.6418 18.8204 13.6375 18.8182 13.6364V13.6375C18.7524 13.5714 18.6747 13.5184 18.5891 13.4815C18.2771 13.3255 17.8298 13.2098 17.256 13.0669L17.2069 13.0538C16.6985 12.9273 16.0789 12.7724 15.5891 12.5269C15.0742 12.2695 14.4545 11.7818 14.4545 10.9091ZM8.45455 12.2727C8.45455 10.9931 9.38182 10.0909 10.3636 10.0909C11.3455 10.0909 12.2727 10.9931 12.2727 12.2727C12.2727 13.5524 11.3455 14.4545 10.3636 14.4545C9.38182 14.4545 8.45455 13.5524 8.45455 12.2727ZM10.3636 8.45455C8.33455 8.45455 6.81818 10.2393 6.81818 12.2727C6.81818 14.3062 8.33455 16.0909 10.3636 16.0909C12.3927 16.0909 13.9091 14.3062 13.9091 12.2727C13.9091 10.2393 12.3927 8.45455 10.3636 8.45455ZM4.09091 16.0909V10.3636H5.72727V16.0909H4.09091Z"
                                                                        fill="white" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_23_24">
                                                                        <rect width="24" height="24" fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                            <span class="text-sm">${iOSVer}</span>
                                                        </div>
                                                    </div>`
                }



                const countriesSelect = document.getElementById("countries");
                function setLanguage() {
                    var selectedLanguage = countriesSelect.value;
                    localStorage.setItem("lang", selectedLanguage);
                    checkLang()
                }

                // Function to load the selected language from local storage
                function loadLanguage() {
                    var selectedLanguage = localStorage.getItem("lang");
                    if (selectedLanguage) {
                        countriesSelect.value = selectedLanguage;
                    }
                }


                // Attach event listener to the select box to update local storage when changed
                countriesSelect.addEventListener("change", setLanguage);

                // Load the selected language on page load
                window.addEventListener("load", loadLanguage);

                // Trigger the "change" event on page load to apply the saved language
                var event = new Event("change");
                countriesSelect.dispatchEvent(event);


                const copyButton = document.getElementById("copyBtn");
                copyButton.addEventListener("click", function () {
                    // Text to copy
                    const subLinks = "[<?= "'" . implode("', '", $user['links']) . "'" ?>]";

                    const cleanedString = subLinks.replace(/[\[\]']/g, '');

                    // Split the cleaned string into an array using ', ' (comma and space) as the delimiter
                    const configArray = cleanedString.split(', ');

                    // Join the array elements into a single string with each configuration on a separate line
                    const result = configArray.join('\n');

                    const copyText = document.querySelector('#copyText')

                    copyToClipboard(null, result)

                    const defaultContent = copyText.innerHTML;

                    copyText.innerHTML = `
                        <div class="flex items-center justify-start gap-x-1">
                            <lord-icon class="w-8 h-8" src="https://cdn.lordicon.com/jvihlqtw.json" trigger="loop"
                                    delay="1" colors="primary:#fff,secondary:#fff">
                                </lord-icon>
                                <span x-text="$t('copied')">/span>
                            </div>
                    `

                    setTimeout(function () {
                        copyText.innerHTML = defaultContent;
                    }, 3000);
                });
            })
        </script>

    </head>

    <body class="font-body" x-data>
        <input type="checkbox" id="QrModal" class="modal-toggle" />
        <div style="direction: ltr;" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold" id="modalTitle">Dynamic Title</h3>
                <div class="flex items-center justify-center mt-8 mb-4 bg-white py-4 rounded-3xl" id="qrcode"></div>
                <p x-text="$t('clickOutClose')" class="text-center" id="modalContent"></p>
            </div>
            <label class="modal-backdrop" for="QrModal">Close</label>
        </div>

        <div class="relative flex min-h-screen flex-col justify-center overflow-hidden asli sm:py-6 transition"
            id="page-container">
            <div
                class="relative px-6 pt-10 pb-8 shadow-main-sh rounded-none dark:shadow-main-sh-dark sm:mx-auto sm:rounded-3xl sm:px-10 bg-clip-padding backdrop-filter backdrop-blur-3xl bg-opacity-0 w-full max-w-2xl">
                <div class="mx-auto max-w-xl">
                    <div
                        class="flex mb-8 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300 dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-3xl p-8 dark:text-white text-black flex-col sm:flex-row space-y-10 sm:space-y-0 sm:divide-x sm:rtl:divide-x-reverse sm:divide-blue-600/50">
                        <div class="basis-1/3 space-y-5 flex flex-col items-center py-3 sm:ltr:pr-9 sm:rtl:pl-9" x-data>
                            <div x-text="calculatePercentage(dataUsed, dataLimit) + '%'"
                                :class="getChartColor(calculatePercentage(dataUsed, dataLimit))"
                                class="radial-progress font-black text-2xl" id="progress__bar" style="--size:9rem;
                            --thickness: 1.2rem;"></div>
                            <span class="inline-block dark:text-white text-black font-semibold text-lg"><?= $user["username"] ?></span>
                            <span
                                class="px-4 py-2 rounded-full inline-block shadow-md shadow-green-900 font-bold text-gray-200"
                                x-data="{status: '<?= $user["status"] ?>'}"
                                x-text="[status == 'active' ? $t('active') : status == 'limited' ? $t('limited') : status == 'expired' ? $t('expired') : $t('disabled')]"
                                :class="[status == 'active' ? 'bg-green-500' : status == 'limited' ? 'bg-red-600' : status == 'expired' ? 'bg-orange-600' : 'bg-gray-600']"></span>
                        </div>
                        <div x-data="{ usedTraffic: <?= $user["used_traffic"] ?>, dataLimit: <?= !empty($user['data_limit']) ? $user['data_limit'] : '∞'; ?> }"
                            class="basis-2/3 flex flex-row items-center sm:ltr:pl-9 sm:rtl:pr-9">
                            <div class="data-usage w-full">
                                <div class="dark:text-white text-black text-center mb-2"><span class="font-bold"
                                        x-text="$t('dataUsage')"></span><span dir="ltr"><?php echo bytesformat($user['used_traffic']) . ' / ' . (empty($user['data_limit']) ? '∞' : bytesformat($user['data_limit'])); ?></span>
                                </div>
                                <div class="dark:text-white text-black mt-4 text-center"><span class="font-bold"
                                        x-text="$t('expirationDate')"></span><span dir="ltr" x-data="{expireDate: ''}"
                                        x-init="Alpine.data( 'expireDate', expireDate = expireDateVar )"
                                        x-text="expireDate"></span></div>
                                <!--2023/06/31 10:43:59-->
                                <div class="dark:text-white text-black mt-3 text-sm text-center"
                                    x-text="resetInterval == 'year' ? $t('resetIntervalYear') : resetInterval == 'month' ? $t('resetIntervalMonth') : resetInterval == 'week' ? $t('resetIntervalWeek') : resetInterval == 'day' ? $t('resetIntervalDay') : ''">
                                </div>
                                <div class="dark:text-white text-black mt-5 text-center"><span class="font-bold"
                                        x-text="$t('remainingDays')"></span><span><?php echo empty($user['expire']) ? '∞' : '(' . intval(($user['expire'] - time()) / (24 * 3600)) . ')'; ?></span><span x-text="$t('remainingDaysSufix')"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-4 mb-8 text-white text-sm sm:text-base">
                        <h2 x-text="$t('howToConnect')"
                            class="my-4 text-3xl font-black leading-none tracking-tight text-white md:text-5xl">

                        </h2>
                        <p x-text="$t('connectInfo')" class="text-lg font-normal mb-4 text-gray-300 lg:text-xl"></p>
                        <div id="OsContainer" class="flex flex-col gap-y-4 text-white text-sm sm:text-base">
                            <div id="iOSContainer"
                                class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 transition-all duration-300 font-medium rounded-2xl">
                                <!-- Accordion item -->
                                <div x-data="{ expanded: false }">
                                    <h2>
                                        <button id="faqs-title-01" type="button"
                                            class="flex p-4 rtl:pl-0 items-center justify-between w-full text-left font-semibold"
                                            @click="expanded = !expanded" :aria-expanded="expanded"
                                            aria-controls="faqs-text-01">
                                            <div
                                                class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                <svg class="w-6 h-6" viewBox="0 0 18 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.987 4.5C8.987 1.5 10.487 0 13.487 0C13.487 3 11.987 4.5 8.987 4.5ZM7.66 6.133C7.018 5.838 6.282 5.5 5.323 5.5C3.194 5.5 0 7.629 0 11.887C0 16.145 2.7 22 5.323 22C6.121 22 6.653 21.734 7.186 21.468C7.718 21.202 8.25 20.936 9.049 20.936C9.847 20.936 10.512 21.202 11.178 21.468C11.843 21.734 12.508 22 13.307 22C15.142 22 17.014 19.136 17.973 15.956C17.091 15.636 15.327 13.985 15.327 11.887C15.327 9.181 16.564 7.964 17.182 7.557C16.067 6.186 14.515 5.5 13.307 5.5C12.347 5.5 11.443 5.838 10.653 6.133C10.04 6.361 9.496 6.565 9.049 6.565C8.601 6.565 8.159 6.361 7.66 6.133Z"
                                                        fill="white" />
                                                </svg>
                                                <span x-text="$t('iOS')">
                                                </span>
                                            </div>

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" :class="{'!rotate-180': expanded}"
                                                class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                    d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                            </svg>
                                        </button>
                                    </h2>
                                    <div id="faqs-text-01" role="region" aria-labelledby="faqs-title-01"
                                        class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                        :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                        <div class="overflow-hidden">
                                            <div class="p-4 pb-6">
                                                <div
                                                    class="bg-gray-700 px-4 py-2 rounded-xl mb-6 mt-4 text-sm sm:text-base">
                                                    <p x-text="$t('chooseApp')" class="text-sm"></p>
                                                </div>
                                                <div id="iOSVer">

                                                </div>
                                                <div class="flex flex-col gap-y-4">
                                                    <div
                                                        class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg width="29" height="26" viewBox="0 0 29 26"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <g clip-path="url(#clip0_20_2)">
                                                                                <path
                                                                                    d="M18.4091 4.40211C19.8954 3.36294 21.3589 2.33315 22.8308 1.31461C23.3975 0.92258 23.9623 0.519918 24.5701 0.193536C24.8231 0.0578559 25.1956 0.0522285 25.495 0.0991225C25.68 0.127884 25.9192 0.345472 25.9663 0.519917C26.0074 0.671229 25.8617 0.936336 25.7146 1.05576C25.1819 1.48843 24.6178 1.88735 24.057 2.28813C22.6504 3.29229 21.2386 4.29082 19.7483 5.34812C20.3673 5.74203 20.9353 6.11718 21.5177 6.47045C22.1713 6.86686 22.1811 6.86373 22.8151 6.4073C24.4106 5.25746 25.9944 4.09324 27.601 2.95715C27.8768 2.76207 28.2298 2.61639 28.5657 2.56825C28.7586 2.54073 29.1069 2.7108 29.1723 2.87087C29.2455 3.05094 29.1566 3.40546 29.0017 3.53614C28.2441 4.17577 27.452 4.77851 26.6519 5.37063C25.6048 6.14594 24.5394 6.89875 23.4224 7.70407C23.6577 7.87227 23.8747 8.00732 24.0662 8.16989C24.5976 8.62069 25.1852 9.03023 25.6264 9.55294C26.2885 10.337 26.3205 11.3374 26.3101 12.2897C26.2963 13.5689 26.2022 14.8501 26.0865 16.1256C26.0264 16.7877 25.5133 17.2348 25.0329 17.6618C24.7734 17.8919 24.4721 18.0814 24.178 18.2727C23.8786 18.4678 23.9047 18.626 24.1819 18.8217C25.4623 19.7277 26.7382 20.6399 28.0102 21.5565C28.3553 21.8048 28.688 22.0705 29.0148 22.3406C29.237 22.5244 29.4194 22.7439 29.252 23.0459C29.0867 23.3441 28.7834 23.5023 28.4683 23.4092C28.1115 23.3035 27.767 23.1128 27.4618 22.9002C26.0303 21.9011 24.6159 20.88 23.1897 19.8734C23.0112 19.7477 22.8099 19.6439 22.6047 19.5632C22.3027 19.4444 22.0491 19.3975 21.7458 19.6864C21.3432 20.0697 20.834 20.3529 20.3569 20.6599C20.0667 20.8463 20.1372 20.9832 20.3693 21.1439C21.7667 22.1149 23.1766 23.0703 24.5512 24.0707C25.0937 24.4658 25.8002 24.7147 26.0539 25.4131C26.0728 25.465 26.0905 25.5169 26.1133 25.5819C25.865 25.7063 25.6336 25.8352 25.3917 25.9408C25.0414 26.094 24.7544 25.9221 24.4819 25.7401C23.2609 24.9248 22.0445 24.1032 20.8229 23.2885C20.1778 22.859 19.5215 22.445 18.8784 22.0124C18.6457 21.8554 18.4868 21.8923 18.2568 22.0505C17.4142 22.6295 16.6109 23.2716 15.5913 23.5767C14.5814 23.8794 13.6448 23.7093 12.7702 23.1972C12.1885 22.8564 11.6284 22.4775 11.0832 22.0849C10.7858 21.8704 10.5538 21.8629 10.2538 22.073C8.76157 23.1141 7.25889 24.1413 5.75882 25.1718C5.45619 25.3793 5.17317 25.6388 4.83656 25.7683C4.52674 25.887 4.15417 25.9039 3.81494 25.8827C3.65742 25.8727 3.39139 25.6682 3.38943 25.5482C3.38486 25.3231 3.46656 25.0111 3.63519 24.8816C4.41301 24.2845 5.23331 23.7381 6.03792 23.1735C6.98698 22.5082 7.93735 21.8435 8.88511 21.1758C9.01191 21.0864 9.12564 20.9801 9.27597 20.8563C8.77856 20.4999 8.3256 20.1741 7.87133 19.8502C7.68832 19.7196 7.51838 19.5557 7.31314 19.4713C6.88371 19.2944 6.54709 19.5514 6.23204 19.7733C4.68361 20.8631 3.15151 21.9742 1.59262 23.0497C1.33313 23.2285 0.971023 23.3341 0.651401 23.3454C0.466425 23.3516 0.18602 23.1353 0.108239 22.9559C0.0454907 22.8114 0.159222 22.4963 0.303019 22.3863C1.44555 21.5084 2.61293 20.6606 3.77442 19.8052C4.24699 19.4576 4.71956 19.1093 5.19801 18.7698C5.42547 18.6085 5.42482 18.4559 5.22023 18.2846C4.97447 18.0783 4.75028 17.84 4.48033 17.6694C3.55676 17.0854 3.24694 16.2125 3.22603 15.2265C3.19661 13.8559 3.19335 12.4841 3.22603 11.1142C3.24825 10.1794 3.68879 9.42102 4.47445 8.84954C4.88885 8.54816 5.29083 8.23054 5.69738 7.91916C5.92027 7.74847 5.95099 7.64217 5.66797 7.44522C4.02933 6.30538 2.4103 5.13929 0.789315 3.97632C0.599111 3.84001 0.427861 3.67744 0.261841 3.51488C-0.163669 3.09846 -0.0682398 2.68892 0.531134 2.59388C0.831147 2.54636 1.23117 2.6364 1.4802 2.80647C2.87568 3.75685 4.23784 4.75225 5.61306 5.72952C6.05557 6.04403 6.51049 6.3429 6.9458 6.66553C7.25104 6.89187 7.49811 6.68303 7.71446 6.56174C8.1988 6.28975 8.64784 5.96149 9.11387 5.65887C9.48121 5.42002 9.49559 5.32311 9.14459 5.06863C7.39876 3.80312 5.64836 2.54324 3.89991 1.28148C3.87638 1.26459 3.84958 1.25084 3.8254 1.23396C3.51689 1.01387 3.2208 0.768143 3.38682 0.354851C3.50382 0.0634829 4.18163 -0.109712 4.54765 0.078489C5.03003 0.326714 5.4928 0.616207 5.9353 0.925707C7.46151 1.99364 8.97792 3.07408 10.4917 4.15826C10.7394 4.33521 10.9584 4.37022 11.2192 4.1964C11.597 3.94505 12.0107 3.73747 12.3657 3.46048C13.6932 2.42381 15.6207 2.44445 17.2495 3.60679C17.6293 3.87815 18.0202 4.13638 18.4091 4.40211ZM14.9226 17.6537C15.8449 17.7162 16.6868 17.488 17.4404 16.9616C19.6516 15.4172 21.8445 13.8484 24.0819 12.3397C25.4368 11.4256 25.41 9.6311 24.2061 8.72323C23.5642 8.23929 22.8681 7.82099 22.2014 7.36581C20.902 6.47983 19.5902 5.6101 18.3143 4.69348C17.109 3.82688 15.8521 3.11909 14.2749 3.35544C13.6677 3.44673 12.9931 3.56302 12.5081 3.88628C10.1656 5.44566 7.89094 7.0982 5.56273 8.67884C4.17117 9.6236 4.27052 11.4043 5.46992 12.2884C6.32617 12.9199 7.23797 13.4814 8.12102 14.0798C9.37532 14.9289 10.6427 15.7617 11.8735 16.6414C12.7859 17.2936 13.7494 17.7338 14.9226 17.6537ZM11.2767 21.1833C11.4081 21.3152 12.1238 21.8035 12.4454 22.0105C12.948 22.3331 13.4337 22.1887 13.5049 21.6228C13.582 21.0088 13.603 20.3623 13.4807 19.7608C13.4043 19.3832 13.0938 18.9624 12.7598 18.7335C10.2969 17.046 7.8027 15.4003 5.31501 13.7459C4.79342 13.3989 4.30516 13.5496 4.2313 14.1392C4.15548 14.7394 4.15025 15.3672 4.25026 15.9618C4.30843 16.3082 4.58034 16.6671 4.85551 16.9222C5.21566 17.2554 5.66535 17.5049 6.09544 17.7606C6.20067 17.8232 6.30852 17.6825 6.37388 17.62C5.97713 17.2304 5.74117 17.0891 5.32089 16.8471C4.77904 16.5351 4.55288 16.0556 4.49863 15.4978C4.46334 15.1315 4.48948 14.7544 4.53785 14.388C4.60909 13.8509 4.76139 13.7953 5.21435 14.0979C7.55302 15.6567 9.89169 17.2167 12.2297 18.7767C13.1846 19.4138 13.5468 20.4967 13.165 21.5628C13.0631 21.8473 12.9069 21.9217 12.6363 21.7241C12.3755 21.5334 11.9532 21.2114 11.6676 21.0595C11.5604 21.0007 11.5231 21.1833 11.2767 21.1833ZM17.7116 21.3771C17.7077 21.3258 17.3888 21.207 17.2705 21.2664C17.0345 21.3852 16.8279 21.5553 16.6051 21.6979C16.258 21.9204 16.0933 21.8729 16.0377 21.4709C15.9776 21.0357 15.9063 20.5737 15.9992 20.1554C16.0861 19.7627 16.2815 19.2825 16.5979 19.0643C19.0771 17.3542 21.5987 15.7004 24.1021 14.0216C24.4113 13.814 24.6022 13.9072 24.6348 14.2136C24.6878 14.7063 24.7172 15.209 24.6721 15.7004C24.6263 16.2044 24.3322 16.5939 23.8622 16.8665C23.4714 17.0935 23.1086 17.3649 22.7341 17.6168C22.7419 17.6637 23.0589 17.7894 23.1635 17.7306C23.4838 17.5499 23.7694 17.3136 24.0884 17.131C24.759 16.749 25.0231 16.1494 25.076 15.4516C25.1041 15.0846 25.0806 14.7082 25.0296 14.3424C24.9165 13.5271 24.4838 13.3526 23.7832 13.8197C21.4099 15.4022 19.0372 16.9853 16.6645 18.5691C15.6599 19.2394 15.2481 20.6887 15.7501 21.7791C15.9449 22.2031 16.2789 22.31 16.6855 22.0586C17.0351 21.8429 17.3705 21.6053 17.7116 21.3771ZM10.2139 20.1041C9.47075 19.6076 8.73281 19.1043 7.97787 18.6247C7.89094 18.5697 7.75172 18.7304 7.61642 18.7454C8.34783 19.3363 9.04394 19.8409 9.77338 20.3085C9.88188 20.3779 10.2035 20.1597 10.2139 20.1041ZM19.0006 20.1028C19.0032 20.1504 19.3111 20.296 19.4039 20.2366C20.1444 19.7646 20.87 19.2719 21.6007 18.7854C21.5935 18.7448 21.2621 18.6097 21.1654 18.6716C20.4346 19.1356 19.7196 19.6226 19.0006 20.1028Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M24.0884 10.2995C24.1335 11.0129 23.6041 11.3687 23.0975 11.7244C21.1745 13.0744 19.2261 14.3911 17.3253 15.7686C16.343 16.4801 15.2893 16.8771 14.0742 16.6789C13.5605 16.5952 13.0291 16.3813 12.5983 16.0981C10.8754 14.9639 9.18969 13.7784 7.48831 12.6135C6.89416 12.2071 6.251 11.8539 5.70718 11.3931C4.88427 10.6959 4.95944 9.7724 5.75294 9.19842C7.99291 7.57839 10.2825 6.02151 12.5637 4.454C13.7585 3.63304 15.6102 3.75246 16.7874 4.60093C18.0018 5.47566 19.2607 6.29412 20.5013 7.13571C21.5151 7.82349 22.5406 8.49563 23.54 9.20217C23.9047 9.4604 24.1145 9.83868 24.0884 10.2995ZM15.0645 5.96524C15.0645 7.19823 15.0645 8.38809 15.0645 9.64985C15.9449 8.97895 16.7717 8.34932 17.6312 7.69468C16.7783 7.10445 15.9939 6.5611 15.2083 6.01963C15.1762 5.99712 15.1324 5.99025 15.0645 5.96524ZM13.1559 9.87181C12.7683 9.61421 12.4408 9.39224 12.1088 9.17591C11.629 8.86328 11.1525 8.31931 10.6643 8.30868C10.1551 8.29743 9.63089 8.79825 9.11779 9.08212C8.71777 9.30346 8.32364 9.53605 7.92754 9.76364C7.93996 9.79991 7.95303 9.83618 7.96545 9.87244C9.6701 9.87181 11.3754 9.87181 13.1559 9.87181ZM16.1103 10.841C16.1005 10.8797 16.0913 10.9185 16.0815 10.9566C16.873 11.4368 17.6626 11.9195 18.4594 12.3928C18.5313 12.4354 18.6725 12.4541 18.7352 12.4153C19.5529 11.9076 20.3621 11.3874 21.2196 10.841C19.4633 10.841 17.7868 10.841 16.1103 10.841ZM15.1207 11.278C15.1207 12.4572 15.1207 13.5964 15.1207 14.8163C15.9756 14.2398 16.7358 13.7277 17.5437 13.1832C16.7044 12.5235 15.9155 11.9033 15.1207 11.278ZM21.4739 9.91871C21.485 9.89307 21.4955 9.86744 21.5066 9.8418C21.0726 9.6017 20.6399 9.35973 20.2039 9.12276C19.7124 8.85515 19.2039 8.36308 18.73 8.39059C18.2319 8.41935 17.7633 8.94456 17.2861 9.25969C16.9933 9.45289 16.7083 9.6586 16.3331 9.91933C18.1339 9.91871 19.8039 9.91871 21.4739 9.91871ZM11.3656 7.78535C12.2284 8.37371 13.0199 8.91393 13.8317 9.46728C13.8317 8.31306 13.8317 7.22887 13.8317 6.09716C12.9957 6.66927 12.2114 7.20636 11.3656 7.78535ZM13.886 14.8419C13.886 13.6621 13.886 12.5241 13.886 11.2886C13.0578 11.9283 12.3245 12.4948 11.546 13.0962C12.3513 13.6971 13.1088 14.2623 13.886 14.8419ZM12.9238 10.9047C11.3937 10.9047 9.96881 10.9047 8.45567 10.9047C9.23675 11.4718 9.94266 11.9852 10.6473 12.4966C11.4055 11.967 12.1251 11.4637 12.9238 10.9047Z"
                                                                                    fill="white" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_20_2">
                                                                                    <rect width="29" height="26"
                                                                                        fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>
                                                                        <div
                                                                            class="flex items-center justify-start gap-x-2">
                                                                            <span x-text="$t('addStreisand')">
                                                                            </span>
                                                                            <div
                                                                                class="bg-gray-100 pb-1.5 px-2 pt-1 rounded-full">

                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 24 24" fill="currentColor"
                                                                                    class="w-6 h-6 fill-yellow-500 stroke-yellow-500">
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                                                        clip-rule="evenodd" />
                                                                                </svg>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div class="flex flex-col">
                                                                            <div class="flex items-center gap-x-2">
                                                                                <span x-text="$t('needediOS')"></span>
                                                                                <div
                                                                                    class="flex items-center rtl:flex-row-reverse rtl:justify-end gap-x-1">
                                                                                    <svg width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <g clip-path="url(#clip0_23_24)">
                                                                                            <path fill-rule="evenodd"
                                                                                                clip-rule="evenodd"
                                                                                                d="M4.36364 0C3.20633 0 2.09642 0.459739 1.27808 1.27808C0.459739 2.09642 0 3.20633 0 4.36364V19.6364C0 20.7937 0.459739 21.9036 1.27808 22.7219C2.09642 23.5403 3.20633 24 4.36364 24H19.6364C20.7937 24 21.9036 23.5403 22.7219 22.7219C23.5403 21.9036 24 20.7937 24 19.6364V4.36364C24 3.20633 23.5403 2.09642 22.7219 1.27808C21.9036 0.459739 20.7937 0 19.6364 0H4.36364ZM3.81818 8.82109C3.81818 8.53176 3.93312 8.25429 4.1377 8.0497C4.34229 7.84512 4.61976 7.73018 4.90909 7.73018C5.19842 7.73018 5.47589 7.84512 5.68048 8.0497C5.88507 8.25429 6 8.53176 6 8.82109C6 9.11042 5.88507 9.3879 5.68048 9.59248C5.47589 9.79707 5.19842 9.912 4.90909 9.912C4.61976 9.912 4.34229 9.79707 4.1377 9.59248C3.93312 9.3879 3.81818 9.11042 3.81818 8.82109ZM14.4545 10.9091C14.4545 9.912 15.3665 8.45455 17.4545 8.45455C18.2564 8.45455 18.9818 8.844 19.4782 9.25745C19.7345 9.47127 19.9604 9.71564 20.1295 9.96982C20.2833 10.2 20.4545 10.5338 20.4545 10.9091H18.8182C18.8182 10.9495 18.8236 10.9735 18.8247 10.9789C18.8095 10.9432 18.7905 10.9092 18.768 10.8775C18.6726 10.7416 18.5588 10.6197 18.4298 10.5153C18.1091 10.2469 17.7425 10.0909 17.4545 10.0909C16.2753 10.0909 16.0931 10.8087 16.0909 10.908C16.0876 10.9036 16.0887 10.908 16.0909 10.9091V10.908C16.1567 10.9741 16.2344 11.027 16.32 11.064C16.632 11.22 17.0793 11.3356 17.6531 11.4785L17.7022 11.4916C18.2105 11.6182 18.8302 11.7731 19.32 12.0185C19.8349 12.276 20.4545 12.7636 20.4545 13.6364C20.4545 14.6335 19.5425 16.0909 17.4545 16.0909C15.3665 16.0909 14.4545 14.6335 14.4545 13.6364H16.0909C16.0909 13.7302 16.2698 14.4545 17.4545 14.4545C18.6338 14.4545 18.816 13.7367 18.8182 13.6375C18.8215 13.6418 18.8204 13.6375 18.8182 13.6364V13.6375C18.7524 13.5714 18.6747 13.5184 18.5891 13.4815C18.2771 13.3255 17.8298 13.2098 17.256 13.0669L17.2069 13.0538C16.6985 12.9273 16.0789 12.7724 15.5891 12.5269C15.0742 12.2695 14.4545 11.7818 14.4545 10.9091ZM8.45455 12.2727C8.45455 10.9931 9.38182 10.0909 10.3636 10.0909C11.3455 10.0909 12.2727 10.9931 12.2727 12.2727C12.2727 13.5524 11.3455 14.4545 10.3636 14.4545C9.38182 14.4545 8.45455 13.5524 8.45455 12.2727ZM10.3636 8.45455C8.33455 8.45455 6.81818 10.2393 6.81818 12.2727C6.81818 14.3062 8.33455 16.0909 10.3636 16.0909C12.3927 16.0909 13.9091 14.3062 13.9091 12.2727C13.9091 10.2393 12.3927 8.45455 10.3636 8.45455ZM4.09091 16.0909V10.3636H5.72727V16.0909H4.09091Z"
                                                                                                fill="white" />
                                                                                        </g>
                                                                                        <defs>
                                                                                            <clipPath id="clip0_23_24">
                                                                                                <rect width="24" height="24"
                                                                                                    fill="white" />
                                                                                            </clipPath>
                                                                                        </defs>
                                                                                    </svg>
                                                                                    <span class="text-sm">14+</span>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('downloadApp')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForDownload')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a href="https://apps.apple.com/us/app/streisand/id6450534064"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                                <span x-text="$t('download')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                            </a>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('addConfigs')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForAdd')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a id="ios-streisand"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-stone-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                                <span x-text="$t('AddtoApp')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                            </a>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/igpsgesd.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('routingTitle')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('routingInfo')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a href="streisand://aW1wb3J0L3JvdXRlOi8vWW5Cc2FYTjBNRERWQVFJREJBVUdEaU1rSlZWeWRXeGxjMTFrYjIxaGFXNU5ZWFJqYUdWeVZHNWhiV1ZlWkc5dFlXbHVVM1J5WVhSbFozbFVkWFZwWktJSEZ0VUlDUW9MREEwT0R4SVZXMjkxZEdKdmRXNWtWR0ZuWFdSdmJXRnBiazFoZEdOb1pYSldaRzl0WVdsdVVtbHdWMjVsZEhkdmNtdFdaR2x5WldOMFZtaDVZbkpwWktJUUVWOFFFMmRsYjNOcGRHVTZZMkYwWldkdmNua3RhWEpmRUE5eVpXZGxlSEE2TGlwY1hDNXBjaVNpRXhSWVoyVnZhWEE2YVhKZFoyVnZhWEE2Y0hKcGRtRjBaVjhRUkZSRFVDd2dWVVJRTENCSVZGUlFMQ0JJVkZSUVV5d2dVMU5JTENCVFRWUlFMQ0JUVGsxUUxDQk9WRkFzSUVaVVVDd2dVRTlRTXl3Z1NVMUJVQ3dnVkdWc2JtVjAxQmNZQ2d3WkRob1ZXMjkxZEdKdmRXNWtWR0ZuWFdSdmJXRnBiazFoZEdOb1pYSlZZbXh2WTJ1b0d4d2RIaDhnSVNKZkVCaG5aVzl6YVhSbE9tTmhkR1ZuYjNKNUxXRmtjeTFoYkd4ZkVCUm5aVzl6YVhSbE9tTmhkR1ZuYjNKNUxXRmtjMThRRVdkbGIzTnBkR1U2ZVdGb2IyOHRZV1J6WHhBVFoyVnZjMmwwWlRwemNHOTBhV1o1TFdGa2MxOFFFbWRsYjNOcGRHVTZaMjl2WjJ4bExXRmtjMThRRVdkbGIzTnBkR1U2WVhCd2JHVXRZV1J6WHhBU1oyVnZjMmwwWlRwaGJXRjZiMjR0WVdSelh4QVJaMlZ2YzJsMFpUcGhaRzlpWlMxaFpITnVBRWtBVWdBdEFFUUFhUUJ5QUdVQVl3QjBBQ0RZUE4zdTJEemQ5MXhKVUVsbVRtOXVUV0YwWTJoZkVDUTNNamt5T1RCRlJDMUdSVFpCTFRReE9VVXRPVE15TmkxRE1rVkJOREl3UmpWQk0wTUFDQUFUQUJrQUp3QXNBRHNBUUFCREFFNEFXZ0JvQUc4QWNnQjZBSUVBaUFDTEFLRUFzd0MyQUw4QXpRRVVBUjBCS1FFM0FUMEJSZ0ZoQVhnQmpBR2lBYmNCeXdIZ0FmUUNFUUllQUFBQUFBQUFBZ0VBQUFBQUFBQUFKZ0FBQUFBQUFBQUFBQUFBQUFBQUFrVT0="
                                                                                class="flex mb-4 items-center gap-x-4 w-full shadow-md px-3 py-2 bg-gradient-to-r from-green-500 via-green-600 to-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 transition-all duration-300 justify-between rounded-2xl">
                                                                                <div class="rounded-xl overflow-hidden">
                                                                                    <svg width="37" height="25"
                                                                                        viewBox="0 0 37 25" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <rect width="37" height="8.65385"
                                                                                            fill="#239F40" />
                                                                                        <rect y="16.3462" width="37"
                                                                                            height="8.65385"
                                                                                            fill="#DA0000" />
                                                                                        <rect y="8.65381" width="37"
                                                                                            height="7.69231" fill="white" />
                                                                                        <g clip-path="url(#clip0_124_53)">
                                                                                            <path
                                                                                                d="M16.6519 11.164C16.6578 11.164 16.6637 11.1683 16.6696 11.1683L16.2973 10.9873L16.1968 11.0907L16.3741 11.1769C16.545 11.1613 16.4903 11.164 16.6519 11.164Z"
                                                                                                fill="#FFB800" />
                                                                                            <path
                                                                                                d="M17.2544 11.0478L17.7095 11.3795C17.7331 11.3623 17.7686 11.3364 17.8218 11.3106C17.8277 11.3106 17.8395 11.3063 17.8455 11.302L17.3785 10.9573L17.2544 11.0478Z"
                                                                                                fill="#FFB800" />
                                                                                            <path
                                                                                                d="M13.5545 13.956C13.4954 13.788 13.6786 13.7363 13.7732 13.7234C13.9564 13.6932 14.1632 13.9086 14.4292 13.9819C14.7011 14.0594 15.0557 14.0034 15.0557 14.0034C15.0557 14.0034 15.0676 13.6716 14.9848 13.5424C14.8666 13.3571 14.843 13.1503 14.5947 13.0296C14.4706 12.9693 13.9386 13.0081 13.6727 13.0124C13.426 13.0204 13.3117 12.9801 13.2964 12.8918H13.8204V12.4997H13.2921C13.2934 12.143 13.3067 11.634 13.3712 11.457C13.4658 11.2027 13.6313 10.578 14.5829 9.86272C15.1917 9.39738 16.0428 9.07423 16.6043 8.92342C16.8703 8.85448 17.0417 8.78123 16.953 8.67351C16.888 8.58734 15.8182 8.79847 15.2035 9.02252C14.3879 9.32414 13.584 9.83687 13.0698 10.6124C12.5669 11.367 12.5327 11.8265 12.532 12.4997H12V12.8918H12.4146C12.4034 12.9318 12.396 12.9743 12.396 13.021C12.13 13.0727 12.2423 13.1374 12.2423 13.1934C12.2423 13.4002 12.5201 13.6846 12.8334 13.7449C12.928 13.7621 12.8866 13.7966 13.1053 13.956C13.2057 14.0293 13.3003 14.1456 13.4067 14.1456C13.4658 14.1456 13.5899 14.0551 13.5545 13.956Z"
                                                                                                fill="#FFB800" />
                                                                                            <path
                                                                                                d="M24.3936 16.05C24.3564 15.9496 24.3376 15.9217 24.1934 15.8906C24.1284 15.8777 24.0634 15.8777 24.0161 15.8389C23.9629 15.8044 23.9807 15.6536 23.9688 15.5674C23.957 15.4813 23.8979 15.4899 23.892 15.4209C23.8802 15.3003 23.9216 14.9771 23.9925 14.7876C24.1757 14.2964 22.5444 14.4773 22.5444 13.6673C22.5444 13.1589 23.7383 13.6242 24.158 12.8098C24.2348 12.6547 24.2644 12.2928 24.1225 12.1161C23.9925 11.9481 23.6201 11.7154 23.2891 11.6077C23.0017 11.5197 22.7643 11.5041 22.5502 11.3256L23.0291 11.0907L22.9744 11.0284C23.1448 11.094 23.1765 11.2113 23.4546 11.2113C23.9038 11.2113 24.6486 10.7158 24.489 10.2461C24.3944 10.2461 24.2289 10.2979 24.0575 10.3668C23.9393 10.4142 23.8388 10.4874 23.6674 10.4874C23.496 10.4874 23.1296 10.397 22.769 10.4702C22.5963 10.4993 21.7683 10.8469 22.0329 11.4222L21.7247 11.5723C21.6595 11.5066 21.5889 11.4442 21.5133 11.3856L21.977 11.0476L21.8529 10.9571L21.3889 11.2953C21.3077 11.2403 21.2219 11.1891 21.132 11.1422L21.9356 10.2591L21.7879 10.1858L20.9817 11.0695C20.8876 11.0272 20.79 10.9892 20.6893 10.9557L20.9427 10.5133L20.7772 10.4659L20.5274 10.9063C20.4226 10.8774 20.3151 10.8534 20.2056 10.8344L20.4875 9.79807L20.3161 9.77222L20.0341 10.8089C19.9239 10.7953 19.8128 10.7871 19.7014 10.7841V10.3108H19.5241V10.784C19.4144 10.7867 19.3047 10.7946 19.1959 10.8078L18.9094 9.77222L18.738 9.79376L19.021 10.8337C18.7821 10.8755 18.6492 10.9249 18.7026 10.9054L18.4543 10.4659L18.2888 10.5133L18.5422 10.9557C18.4432 10.9894 18.3462 11.028 18.2517 11.0717L17.4377 10.1901L17.2899 10.2591L18.1041 11.145C18.0274 11.186 17.9526 11.2305 17.8802 11.2786C17.9236 11.2627 17.9763 11.2476 18.0408 11.235C18.0587 11.2318 18.0773 11.235 18.0911 11.2436C18.2497 11.3428 18.2145 11.6082 18.1794 11.7583C18.3444 11.9056 18.4305 12.1497 18.4398 12.2782C18.9557 11.48 20.5537 11.573 20.8717 12.435C20.942 12.625 20.9455 12.7812 20.8745 12.9421C20.1933 12.8976 19.537 12.84 19.1281 12.84C18.7505 12.84 18.495 12.9796 18.275 13.2038C18.2353 13.5267 18.078 13.5846 18.0659 13.7717C18.0573 13.904 18.1143 14.0583 18.0263 14.2282C17.9385 14.3976 17.832 14.7138 17.0445 14.8015C16.8008 15.0122 16.0163 14.8364 16.1551 15.5071C16.2024 15.7355 15.836 15.576 15.5995 15.6622C15.3725 15.7415 15.2213 15.9642 15.1699 16.05H13.2944V16.2568H24.8495V16.05H24.3936V16.05ZM18.5955 10.9381C18.6076 10.9331 18.6196 10.9279 18.6316 10.9226C18.6969 10.9107 18.706 10.9028 18.5955 10.9381ZM23.2714 12.8572C23.0363 12.955 22.6418 12.9903 22.1804 12.9926C22.1994 12.9107 22.211 12.8282 22.2148 12.7452H22.8636V12.6159H22.2144C22.2104 12.535 22.1993 12.454 22.1806 12.3734L23.5579 12.1701C23.8147 12.3665 23.8608 12.6084 23.2714 12.8572ZM22.6508 11.8318L22.6147 11.7649C22.8231 11.822 23.1461 11.9274 23.3926 12.0639L22.1443 12.2451C22.1156 12.1584 22.0853 12.0868 22.0488 12.015L22.6508 11.8318ZM22.4498 11.1337C22.4498 11.0158 22.6868 10.9555 22.8924 11.0035L22.4582 11.215C22.4393 11.1711 22.4498 11.1432 22.4498 11.1337ZM22.1099 11.5417C22.2403 11.6911 22.4103 11.7138 22.5036 11.7361L21.9811 11.8951C21.9351 11.8209 21.8828 11.7496 21.825 11.6816L22.1099 11.5417ZM21.1301 11.1412C21.1137 11.1326 21.0968 11.1244 21.0801 11.1161C21.0925 11.1215 21.1198 11.1336 21.1301 11.1412ZM22.7867 15.5114C22.7454 15.6234 22.5562 15.5028 22.4262 15.589C22.2615 15.6981 22.1559 15.9546 22.1269 16.05H20.6396C20.6401 15.9722 20.664 15.7773 20.8717 15.6191C21.1672 15.3951 21.4214 15.2486 21.2914 14.8996C21.2204 14.7014 20.5289 14.3179 20.4107 14.2748C20.3279 14.2447 19.8728 14.2877 19.7842 14.5721C19.7428 14.7057 19.7605 14.8608 19.9083 15.0547C20.0265 15.2141 19.9083 15.4382 19.8255 15.533C19.6482 15.7441 19.1577 15.5588 19.0926 15.5588C18.6687 15.5588 18.6572 15.9331 18.664 16.05H17.2949C17.3436 15.6679 17.1675 15.2603 17.8101 14.7919C18.5784 14.2274 17.9224 14.9384 18.407 14.9384C19.0217 14.9384 19.9083 13.9818 20.7003 14.236C21.0904 14.3653 21.445 14.7703 22.0302 15.0159C22.1129 15.0504 22.4262 14.9987 22.5799 15.0504C22.769 15.1193 22.8517 15.3477 22.7867 15.5114Z"
                                                                                                fill="#FFB800" />
                                                                                            <path
                                                                                                d="M16.2487 12.181C16.2422 12.1804 16.239 12.1796 16.2286 12.1809C16.1062 12.1958 16.0703 12.33 16.1442 12.4005C16.1993 12.4531 16.2981 12.4531 16.3532 12.4005C16.4325 12.3248 16.3844 12.181 16.2487 12.181Z"
                                                                                                fill="#FFB800" />
                                                                                            <path
                                                                                                d="M16.9577 12.181C16.9512 12.1804 16.9479 12.1796 16.9376 12.1809C16.8152 12.1958 16.7793 12.33 16.8532 12.4005C16.9083 12.4531 17.0071 12.4531 17.0622 12.4005C17.1415 12.3248 17.0933 12.181 16.9577 12.181Z"
                                                                                                fill="#FFB800" />
                                                                                            <path
                                                                                                d="M18.2452 13.2347C18.2809 13.0067 18.2156 12.9783 18.3572 12.5493C18.4186 12.3635 18.4527 12.2755 18.346 12.0357C18.3034 11.9401 18.2418 11.8417 18.1525 11.7634C18.1867 11.62 18.2258 11.3521 18.0746 11.2575C18.067 11.2527 18.0567 11.2509 18.047 11.2527C17.85 11.2912 17.767 11.3539 17.7224 11.3875C17.6754 11.423 17.6678 11.4305 17.5892 11.4C17.3421 11.3043 17.1855 11.1669 16.55 11.1762C16.0162 11.1762 15.8324 11.3167 15.6173 11.4C15.5392 11.4303 15.5315 11.4232 15.4841 11.3875C15.4396 11.3539 15.3566 11.2912 15.1593 11.2527C15.1495 11.2509 15.1394 11.2529 15.132 11.2575C14.9805 11.3523 15.0201 11.6209 15.0541 11.7634C14.8771 11.9185 14.791 12.1807 14.791 12.3021C14.791 12.4722 14.948 12.7068 14.948 13.0494C14.948 13.3272 15.0233 13.4536 15.0856 13.5584C15.1697 13.6996 15.1743 13.7439 15.1615 13.8999C15.1444 14.107 15.1694 14.1498 15.2211 14.2564C15.3229 14.4661 15.5099 14.8055 16.6033 14.8055C16.9773 14.8055 17.432 14.7638 17.7123 14.5816C17.9048 14.4564 17.9596 14.3048 18.0026 14.2217C18.089 14.055 18.0318 13.9065 18.0406 13.7707C18.0527 13.5847 18.1995 13.5271 18.2452 13.2347ZM15.4153 11.5478C15.4117 11.5699 15.3801 11.6004 15.3346 11.6254C15.2988 11.6452 15.2694 11.6542 15.2367 11.6648C15.2168 11.5999 15.2185 11.5084 15.2318 11.4424C15.3261 11.4695 15.4187 11.5245 15.4153 11.5478ZM16.9289 13.1593C16.8885 13.2305 16.8486 13.2363 16.785 13.2363L16.7853 13.2345C16.7344 13.225 16.6721 13.1595 16.6162 13.1638C16.6132 13.1633 16.6117 13.1633 16.6092 13.1622C16.5641 13.1663 16.5617 13.1591 16.4838 13.206C16.458 13.2213 16.4371 13.2307 16.4217 13.234L16.4221 13.2363C16.358 13.2363 16.3182 13.2307 16.2777 13.1593C16.2461 13.1037 16.2443 13.0526 16.3285 12.9556C16.3882 12.8869 16.4671 12.8315 16.5823 12.8315C16.7213 12.8254 16.8055 12.8721 16.8781 12.9556C16.9623 13.0526 16.9605 13.1037 16.9289 13.1593ZM17.4304 12.4983C17.4096 12.6518 17.4173 12.6301 17.3492 12.7122C17.2788 12.7975 17.2496 12.8022 17.1552 12.8329C17.0839 12.8566 17.0963 12.8506 17.0261 12.8247C16.9623 12.8012 16.9743 12.7494 16.8624 12.6724C16.8127 12.6381 16.7885 12.6059 16.7545 12.5775C16.6774 12.5131 16.5294 12.5128 16.4521 12.5775C16.4179 12.6061 16.3939 12.6381 16.3441 12.6724C16.233 12.7489 16.2436 12.8014 16.1805 12.8247C16.1653 12.8303 16.1298 12.8442 16.1248 12.8458C16.1226 12.8473 16.1206 12.8478 16.1177 12.8487C16.0941 12.8477 16.0673 12.8381 16.0268 12.8249C15.9348 12.7951 15.9181 12.7853 15.8419 12.6936C15.7929 12.6345 15.7956 12.6421 15.7787 12.517C15.7539 12.3327 15.7177 12.2508 15.7766 12.1003C15.8281 11.9689 15.9832 11.9081 16.1674 11.9092C16.2498 11.9092 16.3371 11.9583 16.4118 12.001C16.473 12.0362 16.5309 12.0694 16.6033 12.0694C16.6757 12.0694 16.7335 12.0362 16.7948 12.001C16.8815 11.9512 16.9618 11.9092 17.0392 11.9092C17.214 11.9092 17.3788 11.9695 17.43 12.1003C17.489 12.251 17.4521 12.3372 17.4304 12.4983ZM17.9699 11.6648L17.9557 11.6602C17.8455 11.6244 17.7957 11.5749 17.7913 11.5478C17.7869 11.5218 17.8947 11.4651 17.9736 11.4428C17.9884 11.4966 17.9902 11.5988 17.9699 11.6648Z"
                                                                                                fill="#FFB800" />
                                                                                        </g>
                                                                                        <defs>
                                                                                            <clipPath id="clip0_124_53">
                                                                                                <rect width="13"
                                                                                                    height="7.69231"
                                                                                                    fill="white"
                                                                                                    transform="translate(12 8.65381)" />
                                                                                            </clipPath>
                                                                                        </defs>
                                                                                    </svg>



                                                                                </div>
                                                                                <span x-text="$t('routingIR')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                            </a>
                                                                            <a href="streisand://aW1wb3J0L3JvdXRlOi8vWW5Cc2FYTjBNRERWQVFJREJBVUdEQlVXRjFWeWRXeGxjMTFrYjIxaGFXNU5ZWFJqYUdWeVZHNWhiV1ZlWkc5dFlXbHVVM1J5WVhSbFozbFVkWFZwWktJSEVkUUlDUW9MREEwT0VGMWtiMjFoYVc1TllYUmphR1Z5Vm1SdmJXRnBibEpwY0Z0dmRYUmliM1Z1WkZSaFoxWnNhVzVsWVhLZ29ROVlaMlZ2YVhBNmNuVldaR2x5WldOMDBoSUpFQk5iYjNWMFltOTFibVJVWVdlaEZGNXlaV2RsZUhBNkxpcGNMbkoxSkcwQVVnQlZBQzBBUkFCcEFISUFaUUJqQUhUWVBOMzMyRHpkK2xwSlVFOXVSR1Z0WVc1a1h4QWtOVU5CUmpGRU5rWXRPRVV3TWkwME5EUTFMVUkxTWpjdE5rVkVRVGN3TVRZNE1UVkRDQk1aSnl3N1FFTk1XbUZrY0hkNGVvT0tqNXVkck1mU0FBQUFBQUFBQVFFQUFBQUFBQUFBR0FBQUFBQUFBQUFBQUFBQUFBQUFBUGs9"
                                                                                class="flex mb-4 items-center gap-x-4 w-full shadow-md px-3 py-2 bg-gradient-to-r from-indigo-600 via-indigo-700 to-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-700 transition-all duration-300 justify-between rounded-2xl">
                                                                                <div class="rounded-xl overflow-hidden">
                                                                                    <svg width="37" height="25"
                                                                                        viewBox="0 0 37 25" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <g clip-path="url(#clip0_106_7)">
                                                                                            <path
                                                                                                d="M37 8.33325H0V16.6666H37V8.33325Z"
                                                                                                fill="#0039A6" />
                                                                                            <path d="M37 0H0V8.33333H37V0Z"
                                                                                                fill="white" />
                                                                                            <path
                                                                                                d="M37 16.6667H0V25.0001H37V16.6667Z"
                                                                                                fill="#D52B1E" />
                                                                                        </g>
                                                                                        <defs>
                                                                                            <clipPath id="clip0_106_7">
                                                                                                <rect width="37" height="25"
                                                                                                    fill="white" />
                                                                                            </clipPath>
                                                                                        </defs>
                                                                                    </svg>

                                                                                </div>
                                                                                <span x-text="$t('routingRU')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                            </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <g clip-path="url(#clip0_20_20)">
                                                                                <path
                                                                                    d="M11.9523 10.765C12.066 11.178 11.8686 11.5256 11.5874 11.8681C8.48852 15.6661 5.39565 19.4692 2.29679 23.2672C2.12928 23.4686 1.94383 23.6752 1.71052 23.8162C1.29175 24.063 0.693518 23.9875 0.346542 23.7004C-0.0423113 23.383 -0.126064 22.9095 0.208948 22.4864C0.974689 21.5193 1.76436 20.5673 2.54805 19.6102C4.62991 17.0564 6.71176 14.4975 8.80559 11.9487C8.96711 11.7523 8.93122 11.6263 8.77568 11.44C6.22121 8.45294 3.67871 5.46088 1.14219 2.46379C0.514047 1.72333 0.669589 0.776345 1.48319 0.282706C2.29081 -0.210934 3.40352 -0.0497451 4.04364 0.700788C6.13746 3.14884 8.20735 5.60696 10.2892 8.06004C10.6781 8.52346 11.0609 8.99191 11.4677 9.44526C11.8087 9.83312 12.0121 10.2512 11.9523 10.765Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M22.7803 0.176945C23.3008 0.171908 23.6298 0.317984 23.8452 0.635324C24.0905 1.00303 24.0307 1.35563 23.7615 1.68809C22.7145 2.97759 21.6616 4.2671 20.6147 5.55661C18.9337 7.62183 17.2586 9.68706 15.5597 11.7472C15.3563 11.9941 15.3563 12.1452 15.5656 12.392C18.144 15.4495 20.7105 18.5121 23.2709 21.5797C23.8632 22.2849 23.6897 23.2168 22.906 23.6903C22.0505 24.2091 20.9737 24.0681 20.3455 23.3276C18.3534 20.9602 16.3673 18.5776 14.3811 16.2051C13.8128 15.5251 13.2445 14.8501 12.6821 14.1701C12.0899 13.4599 12.0719 12.6791 12.6462 11.9739C15.7152 8.21118 18.7901 4.45347 21.8591 0.685695C22.1163 0.383467 22.4094 0.171908 22.7803 0.176945Z"
                                                                                    fill="white" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_20_20">
                                                                                    <rect width="24" height="24"
                                                                                        fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>
                                                                        <span x-text="$t('addFoXray')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div class="flex flex-col">
                                                                            <div class="flex items-center gap-x-2">
                                                                                <span x-text="$t('needediOS')"></span>
                                                                                <div
                                                                                    class="flex items-center rtl:flex-row-reverse rtl:justify-end gap-x-1">
                                                                                    <svg width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <g clip-path="url(#clip0_23_24)">
                                                                                            <path fill-rule="evenodd"
                                                                                                clip-rule="evenodd"
                                                                                                d="M4.36364 0C3.20633 0 2.09642 0.459739 1.27808 1.27808C0.459739 2.09642 0 3.20633 0 4.36364V19.6364C0 20.7937 0.459739 21.9036 1.27808 22.7219C2.09642 23.5403 3.20633 24 4.36364 24H19.6364C20.7937 24 21.9036 23.5403 22.7219 22.7219C23.5403 21.9036 24 20.7937 24 19.6364V4.36364C24 3.20633 23.5403 2.09642 22.7219 1.27808C21.9036 0.459739 20.7937 0 19.6364 0H4.36364ZM3.81818 8.82109C3.81818 8.53176 3.93312 8.25429 4.1377 8.0497C4.34229 7.84512 4.61976 7.73018 4.90909 7.73018C5.19842 7.73018 5.47589 7.84512 5.68048 8.0497C5.88507 8.25429 6 8.53176 6 8.82109C6 9.11042 5.88507 9.3879 5.68048 9.59248C5.47589 9.79707 5.19842 9.912 4.90909 9.912C4.61976 9.912 4.34229 9.79707 4.1377 9.59248C3.93312 9.3879 3.81818 9.11042 3.81818 8.82109ZM14.4545 10.9091C14.4545 9.912 15.3665 8.45455 17.4545 8.45455C18.2564 8.45455 18.9818 8.844 19.4782 9.25745C19.7345 9.47127 19.9604 9.71564 20.1295 9.96982C20.2833 10.2 20.4545 10.5338 20.4545 10.9091H18.8182C18.8182 10.9495 18.8236 10.9735 18.8247 10.9789C18.8095 10.9432 18.7905 10.9092 18.768 10.8775C18.6726 10.7416 18.5588 10.6197 18.4298 10.5153C18.1091 10.2469 17.7425 10.0909 17.4545 10.0909C16.2753 10.0909 16.0931 10.8087 16.0909 10.908C16.0876 10.9036 16.0887 10.908 16.0909 10.9091V10.908C16.1567 10.9741 16.2344 11.027 16.32 11.064C16.632 11.22 17.0793 11.3356 17.6531 11.4785L17.7022 11.4916C18.2105 11.6182 18.8302 11.7731 19.32 12.0185C19.8349 12.276 20.4545 12.7636 20.4545 13.6364C20.4545 14.6335 19.5425 16.0909 17.4545 16.0909C15.3665 16.0909 14.4545 14.6335 14.4545 13.6364H16.0909C16.0909 13.7302 16.2698 14.4545 17.4545 14.4545C18.6338 14.4545 18.816 13.7367 18.8182 13.6375C18.8215 13.6418 18.8204 13.6375 18.8182 13.6364V13.6375C18.7524 13.5714 18.6747 13.5184 18.5891 13.4815C18.2771 13.3255 17.8298 13.2098 17.256 13.0669L17.2069 13.0538C16.6985 12.9273 16.0789 12.7724 15.5891 12.5269C15.0742 12.2695 14.4545 11.7818 14.4545 10.9091ZM8.45455 12.2727C8.45455 10.9931 9.38182 10.0909 10.3636 10.0909C11.3455 10.0909 12.2727 10.9931 12.2727 12.2727C12.2727 13.5524 11.3455 14.4545 10.3636 14.4545C9.38182 14.4545 8.45455 13.5524 8.45455 12.2727ZM10.3636 8.45455C8.33455 8.45455 6.81818 10.2393 6.81818 12.2727C6.81818 14.3062 8.33455 16.0909 10.3636 16.0909C12.3927 16.0909 13.9091 14.3062 13.9091 12.2727C13.9091 10.2393 12.3927 8.45455 10.3636 8.45455ZM4.09091 16.0909V10.3636H5.72727V16.0909H4.09091Z"
                                                                                                fill="white" />
                                                                                        </g>
                                                                                        <defs>
                                                                                            <clipPath id="clip0_23_24">
                                                                                                <rect width="24" height="24"
                                                                                                    fill="white" />
                                                                                            </clipPath>
                                                                                        </defs>
                                                                                    </svg>
                                                                                    <span class="text-sm">16+</span>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('downloadApp')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForDownload')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a href="https://apps.apple.com/us/app/foxray/id6448898396"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                                <span x-text="$t('download')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                            </a>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('addConfigs')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForAdd')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <button onclick="openFoXrayURL()"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-stone-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                                <span x-text="$t('AddtoApp')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-white bg-gradient-to-r from-slate-500 via-slate-600 to-slate-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg width="29" height="29" viewBox="0 0 29 29"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <g clip-path="url(#clip0_21_24)">
                                                                                <path
                                                                                    d="M14.4941 0.00750327C16.776 0.00750327 19.0584 -0.0142456 21.3398 0.0183779C22.2244 0.0308059 23.123 0.0888032 23.9884 0.260724C26.6126 0.782183 28.5144 2.8732 28.8391 5.54211C28.936 6.33854 28.9857 7.14584 28.9883 7.94849C29.0023 12.3206 29.0064 16.6926 28.9857 21.0647C28.9815 21.974 28.9282 22.8942 28.7775 23.789C28.3181 26.5222 26.203 28.5091 23.4518 28.8472C22.7977 28.9275 22.1363 28.987 21.4776 28.9891C16.8293 29.001 12.1811 29.0078 7.53338 28.9845C6.67365 28.9803 5.7989 28.9083 4.95833 28.7343C2.35481 28.1958 0.47376 26.1032 0.1568 23.4473C0.0656479 22.686 0.013857 21.915 0.0112674 21.1486C-0.00219821 16.7165 -0.00634141 12.2843 0.0143749 7.85217C0.0185182 6.96719 0.076524 6.07134 0.224128 5.19982C0.686103 2.47757 2.81212 0.482875 5.56532 0.158193C6.39812 0.0598045 7.24128 0.0188956 8.08029 0.0111281C10.2182 -0.00906743 12.3561 0.00439639 14.4941 0.00439639C14.4941 0.00543206 14.4941 0.0064676 14.4941 0.00750327ZM14.5008 1.23632C14.5008 1.2327 14.5008 1.22907 14.5008 1.22493C12.4349 1.22493 10.3689 1.21095 8.30299 1.23114C7.40649 1.23995 6.50429 1.26584 5.61608 1.37821C3.79666 1.60813 2.5107 2.60599 1.74471 4.26876C1.276 5.28578 1.23664 6.37945 1.23405 7.46897C1.22421 12.0813 1.22369 16.6942 1.23612 21.3065C1.23819 21.9984 1.28584 22.6954 1.37958 23.3805C1.63698 25.2581 2.67228 26.5667 4.40262 27.3144C5.35661 27.7272 6.3831 27.7593 7.40028 27.7619C12.0003 27.7722 16.6009 27.7727 21.201 27.7598C21.9287 27.7577 22.6615 27.7127 23.3824 27.6158C25.2138 27.3693 26.509 26.3787 27.2673 24.6906C27.721 23.6803 27.7629 22.6011 27.7655 21.524C27.7759 16.9956 27.7769 12.4671 27.7634 7.93865C27.7614 7.1505 27.7168 6.3577 27.6169 5.57681C27.432 4.13516 26.7121 3.00214 25.5152 2.16635C24.4856 1.44708 23.3104 1.25497 22.1032 1.24306C19.5691 1.21923 17.0349 1.23632 14.5008 1.23632Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M16.1032 8.66257C12.5276 12.4241 8.95191 16.1857 5.2991 20.028C5.2991 16.6155 5.2991 13.3055 5.2991 9.95612C4.8335 9.95612 4.41969 9.95612 3.98413 9.95612C3.98413 9.48956 3.98413 9.06234 3.98413 8.60302C5.08831 8.60302 6.19767 8.60302 7.35365 8.60302C7.35365 10.1068 7.35365 11.6215 7.35365 13.233C8.00569 12.6333 8.58524 12.102 9.1627 11.5687C10.1768 10.6324 11.1877 9.69306 12.2054 8.76096C12.2966 8.67759 12.426 8.58542 12.539 8.58386C13.7125 8.57092 14.8861 8.5761 16.0602 8.5761C16.0742 8.60509 16.0887 8.63358 16.1032 8.66257Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M13.5592 19.4894C13.8648 19.4894 14.1398 19.5019 14.4133 19.4863C14.8276 19.463 14.9244 19.3558 14.9602 18.9323C14.9669 18.8499 14.9757 18.7681 14.9861 18.6594C15.5874 18.6594 16.1778 18.6594 16.7806 18.6594C16.7806 19.4107 16.7806 20.1367 16.7806 20.8835C15.1093 20.8835 13.4588 20.8835 11.7238 20.8835C11.7595 20.1233 11.7289 19.3636 11.8589 18.6329C11.9169 18.3057 12.2562 17.9867 12.5395 17.7495C13.1366 17.2498 13.7809 16.8071 14.4055 16.34C14.492 16.2752 14.5774 16.2095 14.6593 16.1385C14.9073 15.9236 15.0451 15.6585 14.8954 15.3416C14.7525 15.0387 14.4676 14.9781 14.16 15.0278C13.8151 15.0832 13.5846 15.2727 13.5499 15.6347C13.5297 15.8449 13.5463 16.0588 13.5463 16.2872C12.9755 16.2872 12.4633 16.2872 11.8978 16.2872C11.8978 15.6844 11.8905 15.0889 11.9066 14.4939C11.9086 14.4157 12.0143 14.309 12.0977 14.2681C13.3049 13.6778 14.5583 13.5504 15.8292 14.0051C16.6097 14.2842 16.9816 15.2127 16.69 16.1665C16.5802 16.5254 16.3487 16.8961 16.0685 17.1426C15.4216 17.7117 14.7085 18.2052 14.0269 18.735C13.7944 18.9152 13.5245 19.0798 13.5592 19.4894Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M22.5004 14.0289C22.5004 12.8855 22.4978 11.8193 22.5061 10.7531C22.5066 10.678 22.5698 10.5625 22.634 10.5345C23.399 10.2016 24.1696 9.88154 25.0117 9.52734C25.0117 9.80076 25.0112 10.0094 25.0117 10.2181C25.0133 11.0218 25.0205 11.825 25.0112 12.6287C25.0097 12.7389 24.9548 12.9104 24.8745 12.9487C24.11 13.3122 23.3353 13.6529 22.5004 14.0289Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M21.7945 14.0242C21.4045 13.8482 21.0596 13.6928 20.7147 13.5364C20.3112 13.3536 19.9026 13.1812 19.509 12.9787C19.4059 12.9259 19.2847 12.7809 19.2827 12.6768C19.2656 11.6588 19.2723 10.6402 19.2723 9.57605C19.3857 9.6066 19.4743 9.62058 19.5551 9.65372C20.2304 9.93077 20.9063 10.2068 21.576 10.4973C21.6656 10.5361 21.7836 10.6506 21.7847 10.7313C21.7987 11.8084 21.7945 12.8855 21.7945 14.0242Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M19.3442 8.9645C20.2594 8.66571 21.1445 8.37624 22.0312 8.08988C22.0855 8.07227 22.1544 8.06347 22.2072 8.08004C23.1172 8.36692 24.0256 8.65794 24.9397 9.02302C24.3602 9.23636 23.761 9.40828 23.2063 9.67342C22.4859 10.0167 21.8173 10.0271 21.0958 9.67342C20.5727 9.41657 19.9999 9.2607 19.4494 9.05875C19.4287 9.05046 19.4142 9.02768 19.3442 8.9645Z"
                                                                                    fill="white" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_21_24">
                                                                                    <rect width="29" height="29"
                                                                                        fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>
                                                                        <span x-text="$t('addV2Box')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div class="flex flex-col">
                                                                            <div class="flex items-center gap-x-2">
                                                                                <span x-text="$t('needediOS')"></span>
                                                                                <div
                                                                                    class="flex items-center rtl:flex-row-reverse rtl:justify-end gap-x-1">
                                                                                    <svg width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <g clip-path="url(#clip0_23_24)">
                                                                                            <path fill-rule="evenodd"
                                                                                                clip-rule="evenodd"
                                                                                                d="M4.36364 0C3.20633 0 2.09642 0.459739 1.27808 1.27808C0.459739 2.09642 0 3.20633 0 4.36364V19.6364C0 20.7937 0.459739 21.9036 1.27808 22.7219C2.09642 23.5403 3.20633 24 4.36364 24H19.6364C20.7937 24 21.9036 23.5403 22.7219 22.7219C23.5403 21.9036 24 20.7937 24 19.6364V4.36364C24 3.20633 23.5403 2.09642 22.7219 1.27808C21.9036 0.459739 20.7937 0 19.6364 0H4.36364ZM3.81818 8.82109C3.81818 8.53176 3.93312 8.25429 4.1377 8.0497C4.34229 7.84512 4.61976 7.73018 4.90909 7.73018C5.19842 7.73018 5.47589 7.84512 5.68048 8.0497C5.88507 8.25429 6 8.53176 6 8.82109C6 9.11042 5.88507 9.3879 5.68048 9.59248C5.47589 9.79707 5.19842 9.912 4.90909 9.912C4.61976 9.912 4.34229 9.79707 4.1377 9.59248C3.93312 9.3879 3.81818 9.11042 3.81818 8.82109ZM14.4545 10.9091C14.4545 9.912 15.3665 8.45455 17.4545 8.45455C18.2564 8.45455 18.9818 8.844 19.4782 9.25745C19.7345 9.47127 19.9604 9.71564 20.1295 9.96982C20.2833 10.2 20.4545 10.5338 20.4545 10.9091H18.8182C18.8182 10.9495 18.8236 10.9735 18.8247 10.9789C18.8095 10.9432 18.7905 10.9092 18.768 10.8775C18.6726 10.7416 18.5588 10.6197 18.4298 10.5153C18.1091 10.2469 17.7425 10.0909 17.4545 10.0909C16.2753 10.0909 16.0931 10.8087 16.0909 10.908C16.0876 10.9036 16.0887 10.908 16.0909 10.9091V10.908C16.1567 10.9741 16.2344 11.027 16.32 11.064C16.632 11.22 17.0793 11.3356 17.6531 11.4785L17.7022 11.4916C18.2105 11.6182 18.8302 11.7731 19.32 12.0185C19.8349 12.276 20.4545 12.7636 20.4545 13.6364C20.4545 14.6335 19.5425 16.0909 17.4545 16.0909C15.3665 16.0909 14.4545 14.6335 14.4545 13.6364H16.0909C16.0909 13.7302 16.2698 14.4545 17.4545 14.4545C18.6338 14.4545 18.816 13.7367 18.8182 13.6375C18.8215 13.6418 18.8204 13.6375 18.8182 13.6364V13.6375C18.7524 13.5714 18.6747 13.5184 18.5891 13.4815C18.2771 13.3255 17.8298 13.2098 17.256 13.0669L17.2069 13.0538C16.6985 12.9273 16.0789 12.7724 15.5891 12.5269C15.0742 12.2695 14.4545 11.7818 14.4545 10.9091ZM8.45455 12.2727C8.45455 10.9931 9.38182 10.0909 10.3636 10.0909C11.3455 10.0909 12.2727 10.9931 12.2727 12.2727C12.2727 13.5524 11.3455 14.4545 10.3636 14.4545C9.38182 14.4545 8.45455 13.5524 8.45455 12.2727ZM10.3636 8.45455C8.33455 8.45455 6.81818 10.2393 6.81818 12.2727C6.81818 14.3062 8.33455 16.0909 10.3636 16.0909C12.3927 16.0909 13.9091 14.3062 13.9091 12.2727C13.9091 10.2393 12.3927 8.45455 10.3636 8.45455ZM4.09091 16.0909V10.3636H5.72727V16.0909H4.09091Z"
                                                                                                fill="white" />
                                                                                        </g>
                                                                                        <defs>
                                                                                            <clipPath id="clip0_23_24">
                                                                                                <rect width="24" height="24"
                                                                                                    fill="white" />
                                                                                            </clipPath>
                                                                                        </defs>
                                                                                    </svg>
                                                                                    <span class="text-sm">14+</span>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('downloadApp')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForDownload')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a href="https://apps.apple.com/us/app/v2box-v2ray-client/id6446814690"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                                <span x-text="$t('download')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                            </a>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('addConfigs')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForAdd')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a id="ios-v2box"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-stone-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                                <span x-text="$t('AddtoApp')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-white bg-gradient-to-r from-teal-500 via-teal-600 to-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg width="22" height="34" viewBox="0 0 22 34"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <g clip-path="url(#clip0_21_32)">
                                                                                <path
                                                                                    d="M21.9297 23.7404C19.723 23.3556 17.5164 22.9708 15.2717 22.5791C14.4346 24.2077 12.9509 24.888 11.0333 24.8811C9.12343 24.8743 7.61681 24.2352 6.73414 22.5379C4.5503 22.9227 2.34363 23.3075 0 23.7198C0.0608736 22.9021 0.0837012 22.1324 0.19023 21.3697C0.448943 19.5349 1.27074 17.9269 2.70127 16.58C2.95237 16.3464 3.0589 16.099 3.03607 15.7348C2.84584 12.6219 3.21869 9.5777 4.55791 6.68468C5.56993 4.49945 7.05373 2.60971 9.07016 1.08418C9.57998 0.699357 10.1278 0.355768 10.6985 0.067153C10.904 -0.0359237 11.2997 -0.0153082 11.5051 0.0946402C12.8063 0.836792 13.9781 1.74387 14.9292 2.82274C16.0478 4.08714 16.9609 5.48899 17.6077 7.01452C18.7719 9.77698 19.198 12.6288 19.0078 15.563C18.9773 15.9959 19.0915 16.3258 19.4415 16.6625C21.2525 18.3736 21.9601 20.4832 21.983 22.8059C21.983 23.0739 21.9906 23.3487 21.9982 23.6167C22.0058 23.6305 21.9906 23.6442 21.9297 23.7404ZM20.1035 21.9263C20.1415 21.8232 20.1568 21.7957 20.1568 21.7682C20.1644 21.7064 20.1644 21.6377 20.1568 21.5758C20.0426 19.6723 19.3121 18.0162 17.7827 16.6694C17.6229 16.5319 17.4555 16.3052 17.4631 16.1265C17.5772 14.2986 17.6533 12.4707 17.0826 10.6841C16.7631 9.68077 16.5348 8.64313 16.0935 7.68796C15.1347 5.61268 13.7803 3.77791 11.6953 2.45853C11.0714 2.05997 11.0105 2.05997 10.4018 2.48602C7.82226 4.27268 6.21671 6.64345 5.33405 9.43339C4.67966 11.5224 4.51986 13.6527 4.69488 15.8104C4.72531 16.1815 4.60356 16.4357 4.30681 16.6831C3.43936 17.3909 2.84584 18.2705 2.45016 19.26C2.12297 20.0778 1.94795 20.923 1.93274 21.8576C3.89591 21.5071 5.77538 21.1704 7.66246 20.8337C7.78421 21.0604 7.88313 21.2666 7.99727 21.459C8.62883 22.5035 9.5952 23.1014 10.9268 23.1426C12.3041 23.1838 13.3237 22.6203 14.0314 21.5621C14.4651 20.9093 14.4651 20.9093 15.3097 21.0604C15.3478 21.0673 15.3782 21.0742 15.4162 21.0811C16.9837 21.3628 18.536 21.6445 20.1035 21.9263Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M10.9725 34C9.84633 32.4538 8.7506 30.9695 8.42341 29.176C8.17991 27.8497 9.03975 26.5716 10.3638 26.1181C11.2616 25.8088 12.2813 26.1387 12.9509 26.9289C13.5748 27.6711 13.7727 28.5232 13.5824 29.4096C13.2096 31.1276 12.1671 32.5569 10.9725 34ZM10.8736 31.7598C10.9801 31.7598 11.0866 31.7598 11.1855 31.7529C11.528 30.997 11.9008 30.2549 12.2128 29.4852C12.4411 28.9217 12.2356 28.3857 11.8856 27.9047C11.5127 27.3825 10.8355 27.3344 10.3409 27.7673C9.89198 28.159 9.64088 28.6675 9.81589 29.1966C10.1126 30.0625 10.5159 30.9008 10.8736 31.7598Z"
                                                                                    fill="white" />
                                                                                <path
                                                                                    d="M10.9421 7.64677C12.8976 7.59867 14.4195 9.02113 14.4271 10.6429C14.4347 12.3814 12.9357 13.7627 11.041 13.7695C9.14628 13.7764 7.70814 12.4433 7.64727 10.7116C7.594 9.21354 9.22237 7.56431 10.9421 7.64677ZM12.8824 10.7528C12.8976 9.79077 12.0986 9.01425 11.0714 9.00051C10.0061 8.98677 9.06258 9.74266 9.0778 10.7253C9.09302 11.6736 9.89959 12.4227 10.9421 12.4364C12.0454 12.4433 12.8672 11.7355 12.8824 10.7528Z"
                                                                                    fill="white" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_21_32">
                                                                                    <rect width="22" height="34"
                                                                                        fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>
                                                                        <span x-text="$t('addShadowrocket')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div class="flex flex-col">
                                                                            <div class="flex items-center gap-x-2">
                                                                                <span x-text="$t('needediOS')"></span>
                                                                                <div
                                                                                    class="flex items-center rtl:flex-row-reverse rtl:justify-end gap-x-1">
                                                                                    <svg width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <g clip-path="url(#clip0_23_24)">
                                                                                            <path fill-rule="evenodd"
                                                                                                clip-rule="evenodd"
                                                                                                d="M4.36364 0C3.20633 0 2.09642 0.459739 1.27808 1.27808C0.459739 2.09642 0 3.20633 0 4.36364V19.6364C0 20.7937 0.459739 21.9036 1.27808 22.7219C2.09642 23.5403 3.20633 24 4.36364 24H19.6364C20.7937 24 21.9036 23.5403 22.7219 22.7219C23.5403 21.9036 24 20.7937 24 19.6364V4.36364C24 3.20633 23.5403 2.09642 22.7219 1.27808C21.9036 0.459739 20.7937 0 19.6364 0H4.36364ZM3.81818 8.82109C3.81818 8.53176 3.93312 8.25429 4.1377 8.0497C4.34229 7.84512 4.61976 7.73018 4.90909 7.73018C5.19842 7.73018 5.47589 7.84512 5.68048 8.0497C5.88507 8.25429 6 8.53176 6 8.82109C6 9.11042 5.88507 9.3879 5.68048 9.59248C5.47589 9.79707 5.19842 9.912 4.90909 9.912C4.61976 9.912 4.34229 9.79707 4.1377 9.59248C3.93312 9.3879 3.81818 9.11042 3.81818 8.82109ZM14.4545 10.9091C14.4545 9.912 15.3665 8.45455 17.4545 8.45455C18.2564 8.45455 18.9818 8.844 19.4782 9.25745C19.7345 9.47127 19.9604 9.71564 20.1295 9.96982C20.2833 10.2 20.4545 10.5338 20.4545 10.9091H18.8182C18.8182 10.9495 18.8236 10.9735 18.8247 10.9789C18.8095 10.9432 18.7905 10.9092 18.768 10.8775C18.6726 10.7416 18.5588 10.6197 18.4298 10.5153C18.1091 10.2469 17.7425 10.0909 17.4545 10.0909C16.2753 10.0909 16.0931 10.8087 16.0909 10.908C16.0876 10.9036 16.0887 10.908 16.0909 10.9091V10.908C16.1567 10.9741 16.2344 11.027 16.32 11.064C16.632 11.22 17.0793 11.3356 17.6531 11.4785L17.7022 11.4916C18.2105 11.6182 18.8302 11.7731 19.32 12.0185C19.8349 12.276 20.4545 12.7636 20.4545 13.6364C20.4545 14.6335 19.5425 16.0909 17.4545 16.0909C15.3665 16.0909 14.4545 14.6335 14.4545 13.6364H16.0909C16.0909 13.7302 16.2698 14.4545 17.4545 14.4545C18.6338 14.4545 18.816 13.7367 18.8182 13.6375C18.8215 13.6418 18.8204 13.6375 18.8182 13.6364V13.6375C18.7524 13.5714 18.6747 13.5184 18.5891 13.4815C18.2771 13.3255 17.8298 13.2098 17.256 13.0669L17.2069 13.0538C16.6985 12.9273 16.0789 12.7724 15.5891 12.5269C15.0742 12.2695 14.4545 11.7818 14.4545 10.9091ZM8.45455 12.2727C8.45455 10.9931 9.38182 10.0909 10.3636 10.0909C11.3455 10.0909 12.2727 10.9931 12.2727 12.2727C12.2727 13.5524 11.3455 14.4545 10.3636 14.4545C9.38182 14.4545 8.45455 13.5524 8.45455 12.2727ZM10.3636 8.45455C8.33455 8.45455 6.81818 10.2393 6.81818 12.2727C6.81818 14.3062 8.33455 16.0909 10.3636 16.0909C12.3927 16.0909 13.9091 14.3062 13.9091 12.2727C13.9091 10.2393 12.3927 8.45455 10.3636 8.45455ZM4.09091 16.0909V10.3636H5.72727V16.0909H4.09091Z"
                                                                                                fill="white" />
                                                                                        </g>
                                                                                        <defs>
                                                                                            <clipPath id="clip0_23_24">
                                                                                                <rect width="24" height="24"
                                                                                                    fill="white" />
                                                                                            </clipPath>
                                                                                        </defs>
                                                                                    </svg>
                                                                                    <span class="text-sm">12+</span>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('downloadApp')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForDownload')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a href="https://apps.apple.com/ca/app/shadowrocket/id932747118"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                                <span x-text="$t('download')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                            </a>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('addConfigs')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForAdd')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <button onclick="openShadowrocketURL()"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-stone-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                                <span x-text="$t('AddtoApp')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-white bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg width="28" height="28" viewBox="0 0 28 28"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <g clip-path="url(#clip0_43_2)">
                                                                                <path
                                                                                    d="M13.1804 27.742C12.9792 27.742 12.8083 27.6623 12.6473 27.5637C12.1244 27.2401 11.6014 26.9117 11.0784 26.5833C10.7867 26.4004 10.49 26.2175 10.1983 26.0345C9.75582 25.7577 9.31329 25.481 8.87076 25.1995C8.44332 24.9322 8.01085 24.6601 7.58341 24.3927C7.19619 24.1488 6.80898 23.9002 6.41674 23.6562C6.02953 23.4123 5.64231 23.1731 5.2551 22.9338C4.48571 22.4507 3.71631 21.9675 2.94691 21.4843C2.50941 21.2076 2.06688 20.9308 1.62938 20.654C1.52881 20.5931 1.43326 20.5227 1.33269 20.4664C1.21703 20.4007 1.10137 20.3304 0.980678 20.2741C0.689011 20.138 0.477804 19.927 0.326942 19.669C0.21631 19.486 0.13585 19.289 0.100649 19.0826C0.0855628 18.9935 0.0604192 18.909 0.0352755 18.8246C0.025218 18.8199 0.0151606 18.8152 0.0101318 18.8105C0.0101318 18.7965 0.0101318 18.7824 0.0101318 18.7636C0.0755054 18.7214 0.0755054 18.6745 0.0101318 18.6276C0.0101318 15.358 0.0101318 12.0838 0.0101318 8.81421C0.0805341 8.82359 0.0704765 8.87988 0.080534 8.91741C0.145908 9.15664 0.286712 9.34897 0.497919 9.4897C0.865017 9.73832 1.24217 9.97286 1.6143 10.2121C2.02665 10.4795 2.43901 10.7469 2.85137 11.0142C3.35424 11.3379 3.86214 11.6663 4.36502 11.9899C4.80252 12.2714 5.24002 12.5575 5.68254 12.839C6.20553 13.1767 6.73355 13.5145 7.25654 13.8522C7.77953 14.19 8.29749 14.5277 8.82048 14.8608C9.37364 15.2173 9.92177 15.5691 10.4749 15.9256C10.9074 16.2024 11.3399 16.4791 11.7723 16.7559C11.9031 16.8403 12.0238 16.9295 12.1545 17.0092C12.3506 17.1312 12.5367 17.2719 12.763 17.347C12.8133 17.361 12.8334 17.3892 12.8284 17.4408C12.8233 17.4689 12.8284 17.5018 12.8284 17.5299C12.8284 20.7103 12.8284 23.8908 12.8284 27.0712C12.8284 27.3292 12.929 27.5356 13.1452 27.6951C13.1552 27.7045 13.1653 27.7279 13.1804 27.742Z"
                                                                                    fill="#C6C6C6" />
                                                                                <path
                                                                                    d="M13.1803 27.7421C13.1652 27.7233 13.1552 27.7045 13.1351 27.6905C12.9138 27.5357 12.8182 27.3246 12.8182 27.0666C12.8182 23.8861 12.8182 20.7057 12.8182 17.5253C12.8182 17.4971 12.8182 17.4643 12.8182 17.4361C12.8233 17.3892 12.7981 17.3564 12.7529 17.3423C12.5266 17.272 12.3405 17.1266 12.1444 17.0046C12.0136 16.9248 11.8879 16.8357 11.7622 16.7513C11.3297 16.4745 10.8973 16.1978 10.4648 15.921C9.91164 15.5645 9.3635 15.2127 8.81034 14.8562C8.28736 14.5184 7.7694 14.1807 7.24641 13.8476C6.72342 13.5099 6.1954 13.1721 5.67241 12.8344C5.23491 12.5529 4.79741 12.2668 4.35488 11.9853C3.85201 11.6616 3.34411 11.3333 2.84124 11.0096C2.42888 10.7422 2.01652 10.4749 1.60417 10.2075C1.23204 9.96823 0.854885 9.729 0.487787 9.48507C0.27658 9.34434 0.130747 9.15202 0.0704022 8.91278C0.0603447 8.87525 0.0704023 8.81427 0 8.80958C0 8.72514 0 8.6454 0 8.56096C0.0150862 8.54689 0.0402298 8.53751 0.0452585 8.51874C0.12069 8.26544 0.281609 8.07311 0.507902 7.92769C0.563218 7.89016 0.623563 7.85733 0.678879 7.8198C0.880029 7.68845 1.07615 7.5618 1.2773 7.43046C1.55891 7.2522 1.84052 7.07864 2.12213 6.89569C2.45905 6.67991 2.79095 6.46413 3.12787 6.24835C3.43965 6.05133 3.75144 5.85431 4.05819 5.65729C4.13362 5.61038 4.21911 5.57755 4.26437 5.4978C4.42529 5.601 4.58118 5.70889 4.7421 5.81209C4.9181 5.92468 5.09914 6.03726 5.27514 6.14984C5.29023 6.16391 5.31034 6.17798 5.32543 6.19206C5.35057 6.20613 5.37572 6.2202 5.39583 6.23897C5.42098 6.25304 5.44612 6.26711 5.46623 6.28587C5.50646 6.30933 5.54669 6.33278 5.5819 6.35624C5.59698 6.37031 5.6171 6.38438 5.63218 6.39846C5.65733 6.41253 5.68247 6.4266 5.70259 6.44537C5.76796 6.48289 5.8283 6.52042 5.89368 6.56264C5.90876 6.57671 5.92888 6.59078 5.94396 6.60486C5.98419 6.62831 6.02442 6.65176 6.05963 6.67522C6.07471 6.68929 6.09483 6.70336 6.10991 6.71744C6.11494 6.71744 6.125 6.72213 6.13003 6.72213C6.14511 6.7362 6.16523 6.75027 6.18032 6.76435C6.20546 6.77842 6.2306 6.79249 6.25072 6.81126C6.29095 6.83471 6.33118 6.85816 6.36638 6.88162C6.38147 6.89569 6.40158 6.90976 6.41667 6.92384C6.73851 7.13493 7.06537 7.34602 7.38721 7.55711C7.64368 7.72129 7.90014 7.88547 8.15661 8.04965C8.25215 8.11064 8.3477 8.17162 8.44325 8.2326C8.45833 8.24667 8.47845 8.26074 8.49353 8.27482C8.51868 8.28889 8.53879 8.30296 8.56394 8.32173C8.56896 8.32173 8.57902 8.32642 8.58405 8.32642C8.59914 8.34049 8.61925 8.35456 8.63434 8.36864C8.64942 8.37802 8.66451 8.3874 8.6796 8.39209C8.69468 8.40616 8.7148 8.42024 8.72988 8.43431C8.73491 8.43431 8.74497 8.439 8.75 8.439C8.76509 8.45307 8.7852 8.46714 8.80029 8.48122C8.82543 8.49529 8.84555 8.50936 8.87069 8.52813C8.89583 8.5422 8.92098 8.55627 8.94109 8.57503C8.97126 8.59849 9.00646 8.61725 9.03664 8.64071C9.06178 8.65478 9.0819 8.66885 9.10704 8.68762C9.13218 8.70169 9.15733 8.71576 9.17744 8.72983C9.23276 8.76736 9.2931 8.80489 9.34842 8.84242C9.37356 8.85649 9.39368 8.87056 9.41882 8.88933C9.44396 8.9034 9.46911 8.91747 9.48922 8.93623C9.51437 8.95031 9.53951 8.96907 9.55963 8.98314C9.56968 8.98783 9.57471 8.99722 9.58477 9.00191C9.60991 9.01598 9.63003 9.03005 9.65517 9.04882C9.68032 9.06289 9.70546 9.08165 9.72557 9.09573C9.75575 9.11918 9.79095 9.14263 9.82112 9.1614C9.99713 9.27398 10.1731 9.39125 10.3491 9.50383C10.3894 9.52729 10.4296 9.54605 10.4698 9.56951C10.4849 9.58358 10.505 9.59765 10.5201 9.61172C10.5453 9.6258 10.5704 9.63987 10.5905 9.65863C10.6207 9.71023 10.671 9.73838 10.7363 9.74776C10.7464 9.75245 10.7514 9.76183 10.7615 9.76652C10.7866 9.7806 10.8068 9.79467 10.8319 9.81343C10.857 9.82751 10.8822 9.84158 10.9023 9.86034C10.9325 9.8838 10.9677 9.90256 10.9978 9.92601C11.0481 9.95416 11.0934 9.987 11.1437 10.0151C11.1688 10.0292 11.194 10.0433 11.2141 10.0621C11.2443 10.0855 11.2795 10.1043 11.3096 10.1277C11.3348 10.1418 11.3549 10.1559 11.38 10.1746C11.4052 10.1887 11.4303 10.2028 11.4504 10.2215C11.4756 10.2356 11.4957 10.2544 11.5208 10.2685C11.5359 10.2778 11.551 10.2825 11.5661 10.2919C11.5812 10.306 11.6013 10.3201 11.6164 10.3341C11.6415 10.3482 11.6667 10.3623 11.6868 10.381C11.7119 10.3951 11.732 10.4092 11.7572 10.4279C11.7874 10.4467 11.8175 10.4608 11.8477 10.4795C11.8578 10.4842 11.8678 10.4936 11.8728 10.4983C11.8879 10.5124 11.908 10.5265 11.9231 10.5405C11.9483 10.5546 11.9734 10.5687 11.9935 10.5874C12.0237 10.6109 12.0589 10.6297 12.0891 10.6531C12.1142 10.6672 12.1394 10.6859 12.1645 10.7C12.1897 10.7141 12.2098 10.7282 12.2349 10.7469C12.2399 10.7469 12.25 10.7469 12.255 10.7516C12.2701 10.7657 12.2902 10.7798 12.3053 10.7938C12.3305 10.8079 12.3556 10.822 12.3757 10.8407C12.3908 10.8501 12.4059 10.8548 12.421 10.8642C12.4361 10.8783 12.4562 10.8923 12.4713 10.9064C12.4964 10.9205 12.5216 10.9346 12.5417 10.9533C12.5668 10.9674 12.592 10.9862 12.6121 11.0002C12.6372 11.0143 12.6624 11.0284 12.6825 11.0471C12.7076 11.0612 12.7328 11.0753 12.7529 11.094C12.7629 11.1034 12.768 11.1081 12.778 11.1175C12.8032 11.1316 12.8283 11.1456 12.8484 11.1644C12.8736 11.1785 12.8987 11.1926 12.9188 11.2113C12.949 11.2348 12.9842 11.2535 13.0144 11.277C13.0194 11.277 13.0295 11.277 13.0345 11.2817C13.0496 11.2958 13.0697 11.3098 13.0848 11.3239C13.1099 11.338 13.1351 11.352 13.1552 11.3708C13.1803 11.3849 13.2055 11.399 13.2256 11.4177C13.2407 11.4271 13.2557 11.4365 13.2708 11.4412C13.2859 11.4552 13.306 11.4693 13.3211 11.4834C13.3261 11.4834 13.3362 11.4881 13.3412 11.4881C13.3563 11.5022 13.3764 11.5162 13.3915 11.5303C13.4167 11.5444 13.4418 11.5584 13.4619 11.5772C13.4871 11.5913 13.5072 11.6054 13.5323 11.6241C13.5625 11.6476 13.5977 11.6663 13.6279 11.6898C13.653 11.7039 13.6782 11.7179 13.7033 11.7367C13.7284 11.7508 13.7486 11.7648 13.7737 11.7836C13.8139 11.8446 13.8743 11.8774 13.9447 11.8962C13.9497 11.8962 13.9598 11.9009 13.9648 11.9009C13.9799 11.915 14 11.929 14.0151 11.9431C14.0402 11.9572 14.0654 11.9712 14.0855 11.99C14.1509 12.0275 14.2112 12.0651 14.2766 12.1073C14.2917 12.1214 14.3118 12.1354 14.3269 12.1495C14.352 12.1636 14.3721 12.1776 14.3973 12.1964C14.4224 12.2105 14.4476 12.2246 14.4677 12.2433C14.4978 12.2668 14.533 12.2855 14.5632 12.309C14.5884 12.3231 14.6135 12.3371 14.6336 12.3559C14.6588 12.37 14.6839 12.384 14.704 12.4028C14.7292 12.4169 14.7543 12.431 14.7744 12.4497C14.7895 12.4591 14.8046 12.4638 14.8197 12.4732C14.8348 12.4872 14.8549 12.5013 14.87 12.5154C14.8951 12.5295 14.9203 12.5435 14.9404 12.5623C14.9655 12.5764 14.9856 12.5904 15.0108 12.6092C15.0409 12.6327 15.0761 12.6514 15.1063 12.6749C15.1113 12.6749 15.1214 12.6796 15.1264 12.6796C15.1415 12.6936 15.1616 12.7077 15.1767 12.7218C15.2019 12.7359 15.227 12.7499 15.2471 12.7687C15.2723 12.7828 15.2924 12.7968 15.3175 12.8156C15.3326 12.825 15.3477 12.8297 15.3628 12.8391C15.3728 12.886 15.4181 12.8954 15.4583 12.9047C15.4935 12.9282 15.5237 12.947 15.5589 12.9704C15.584 12.9845 15.6092 12.9986 15.6293 13.0126C15.6846 13.0502 15.745 13.0877 15.8003 13.1252C15.8254 13.1393 15.8455 13.1534 15.8707 13.1674C15.8958 13.1815 15.921 13.2003 15.9411 13.2143C15.9662 13.2284 15.9914 13.2425 16.0115 13.2612C16.0215 13.2706 16.0266 13.2753 16.0366 13.2847C16.0618 13.2988 16.0819 13.3128 16.107 13.3316C16.1322 13.3457 16.1573 13.3644 16.1774 13.3785C16.2026 13.3926 16.2227 13.4114 16.2478 13.4254C16.3283 13.477 16.4088 13.5286 16.4892 13.5802C16.5295 13.6365 16.5898 13.674 16.6602 13.6928C16.6652 13.6928 16.6753 13.6975 16.6803 13.6975C16.6954 13.7116 16.7155 13.7256 16.7306 13.7397C16.7356 13.7397 16.7457 13.7444 16.7507 13.7444C16.7658 13.7585 16.7859 13.7726 16.801 13.7866C16.806 13.7866 16.8161 13.7866 16.8211 13.7913C16.8261 13.8335 16.8513 13.857 16.8965 13.857C16.9016 13.857 16.9116 13.8617 16.9167 13.8617C16.9318 13.8758 16.9519 13.8898 16.967 13.9039C16.9921 13.918 17.0122 13.932 17.0374 13.9508C17.0625 13.9649 17.0876 13.979 17.1078 13.9977C17.148 14.0212 17.1882 14.0446 17.2234 14.0681C17.2385 14.0822 17.2586 14.0962 17.2737 14.1103C17.2838 14.115 17.2888 14.1244 17.2988 14.1291C17.3139 14.1384 17.329 14.1478 17.3491 14.1525C17.3743 14.1666 17.3994 14.1854 17.4195 14.1994C17.4447 14.2135 17.4648 14.2323 17.4899 14.2463C17.5251 14.2698 17.5553 14.2886 17.5905 14.312C17.6157 14.3261 17.6408 14.3402 17.6609 14.3589C17.6861 14.373 17.7112 14.3871 17.7313 14.4058C17.7615 14.4293 17.7967 14.4527 17.8269 14.4715C17.8772 14.4996 17.9224 14.5325 17.9727 14.5606C17.9978 14.5747 18.023 14.5888 18.0431 14.6075C18.0833 14.6638 18.1437 14.7014 18.2141 14.7201C18.2392 14.7342 18.2644 14.753 18.2845 14.767C18.3297 14.8046 18.38 14.8421 18.4253 14.8796C18.4404 14.8796 18.4504 14.8796 18.4655 14.8796C18.4705 14.8937 18.4705 14.9078 18.4756 14.9218C18.4705 14.9312 18.4655 14.9359 18.4555 14.9453C18.3247 15.0297 18.194 15.1188 18.0632 15.2033C17.7715 15.3909 17.4849 15.5786 17.1932 15.7662C16.5647 16.1743 15.9361 16.5824 15.3024 16.9858C15.1013 17.1172 14.9052 17.2532 14.694 17.3658C14.5934 17.4221 14.5682 17.4737 14.5682 17.5769C14.5733 18.7449 14.5682 19.9083 14.5682 21.0763C14.5682 23.084 14.5682 25.0917 14.5682 27.0947C14.5682 27.2683 14.528 27.4278 14.4274 27.5732C14.2766 27.7984 14.0503 27.9156 13.7737 27.9532C13.7385 27.9578 13.6983 27.9532 13.6932 28.0001C13.4871 27.9954 13.2809 27.9719 13.0948 27.8875C13.2256 27.7937 13.2055 27.7655 13.1803 27.7421Z"
                                                                                    fill="#EFEFEF" />
                                                                                <path
                                                                                    d="M14.1207 0.00938175C14.1258 0.0422181 14.1459 0.0515999 14.176 0.0562908C14.4074 0.0844362 14.6286 0.1548 14.8398 0.248618C14.9555 0.300218 15.0611 0.36589 15.1667 0.431563C15.5288 0.652035 15.8858 0.877199 16.2479 1.10236C17.0424 1.59491 17.8319 2.09214 18.6265 2.58469C18.9282 2.77232 19.2299 2.96465 19.5316 3.15698C20.2156 3.58385 20.8944 4.00603 21.5783 4.4329C22.5992 5.07087 23.62 5.70883 24.6408 6.34679C25.4203 6.83464 26.2048 7.3225 26.9842 7.81035C27.2357 7.96515 27.4117 8.16686 27.4921 8.43893C27.5022 8.47177 27.5022 8.50461 27.5072 8.53744C27.4972 8.57497 27.4871 8.60781 27.4871 8.64533C27.4821 8.88457 27.3765 9.08628 27.2055 9.25984C27.0647 9.40057 26.8887 9.49908 26.7177 9.60697C26.1545 9.97286 25.5913 10.3341 25.0331 10.6999C24.8118 10.8454 24.5906 10.9908 24.3643 11.1362C24.1028 11.3051 23.8362 11.4739 23.5697 11.6428C23.5345 11.6663 23.4893 11.671 23.449 11.685C23.3987 11.6522 23.3535 11.6194 23.3032 11.5865C23.0316 11.4083 22.7601 11.23 22.4835 11.0565C22.0259 10.7609 21.5633 10.4701 21.1056 10.1746C20.5776 9.84151 20.0496 9.50846 19.5216 9.17541C19.1545 8.94086 18.7824 8.71101 18.4153 8.48115C17.8521 8.12464 17.2838 7.77283 16.7156 7.41632C15.4332 6.61886 14.1459 5.82141 12.8635 5.02396C12.3607 4.70967 11.8578 4.39538 11.3499 4.08578C11.0029 3.86999 10.6509 3.6589 10.3039 3.44781C9.97202 3.2461 9.64013 3.0444 9.3032 2.84269C9.16743 2.75825 9.03165 2.67381 8.89587 2.58938C8.92605 2.56592 8.95119 2.53778 8.98639 2.51432C9.25794 2.33607 9.52949 2.16251 9.80607 1.98894C10.2939 1.67934 10.7816 1.36505 11.2745 1.05545C11.4253 0.956944 11.5812 0.867817 11.7321 0.769308C11.9735 0.614508 12.2098 0.459708 12.4512 0.304909C12.5266 0.258 12.6071 0.211091 12.6926 0.182945C12.8585 0.131345 13.0295 0.0891271 13.1954 0.0422181C13.2156 0.0375272 13.2256 0.0140727 13.2407 0C13.5424 0.0093818 13.8291 0.00938175 14.1207 0.00938175Z"
                                                                                    fill="#EFEFEF" />
                                                                                <path
                                                                                    d="M0.00500488 18.6229C0.0703784 18.6698 0.0703784 18.7167 0.00500488 18.759C0.00500488 18.7167 0.00500488 18.6698 0.00500488 18.6229Z"
                                                                                    fill="#E2E4E4" />
                                                                                <path
                                                                                    d="M0.00500488 18.8058C0.0150624 18.8105 0.0251198 18.8152 0.0301486 18.8199C0.0200911 18.8199 0.0100336 18.8245 0.00500488 18.8245C0.00500488 18.8199 0.00500488 18.8105 0.00500488 18.8058Z"
                                                                                    fill="#E2E4E4" />
                                                                                <path
                                                                                    d="M23.459 11.4224C23.4992 11.4083 23.5445 11.3989 23.5797 11.3802C23.8462 11.2113 24.1077 11.0424 24.3742 10.8735C24.5955 10.7281 24.8218 10.5827 25.0431 10.4373C25.6063 10.0714 26.1645 9.70551 26.7277 9.34431C26.8936 9.23642 27.0747 9.1426 27.2155 8.99718C27.3865 8.82362 27.487 8.62191 27.4971 8.38267C27.4971 8.34514 27.5122 8.31231 27.5172 8.27478C27.5675 8.27478 27.6228 8.27478 27.6731 8.27478C27.8692 8.27478 27.9849 8.37329 28 8.56092C28 8.58907 28 8.61253 28 8.64067C28 11.9384 28 15.2361 28 18.5291C28 18.6557 27.9798 18.7777 27.9446 18.9044C27.8994 19.0451 27.8843 19.1952 27.834 19.3359C27.7737 19.5048 27.7083 19.6784 27.5977 19.8332C27.4418 20.0489 27.2456 20.2178 27.0244 20.3679C27.0093 20.3773 26.9992 20.3867 26.9842 20.3914C26.783 20.4571 26.6221 20.5837 26.4511 20.6869C26.2349 20.8183 26.0237 20.959 25.8125 21.0997C25.6867 21.1795 25.561 21.2545 25.4353 21.3343C25.1135 21.536 24.7967 21.7424 24.4748 21.9441C24.2234 22.1036 23.9719 22.2631 23.7205 22.4179C23.5294 22.5351 23.3383 22.6477 23.1472 22.765C22.9763 22.8682 22.8153 22.9808 22.6444 23.0887C22.4181 23.2294 22.1968 23.3748 21.9705 23.5155C21.7492 23.6563 21.528 23.7923 21.3067 23.933C21.0905 24.069 20.8692 24.2051 20.6479 24.3411C20.4367 24.4725 20.2356 24.6226 20.0143 24.7445C19.8182 24.8477 19.6472 24.9838 19.4612 25.0917C19.1997 25.2465 18.9533 25.4153 18.6968 25.5748C18.5761 25.6499 18.4504 25.7249 18.3247 25.8C18.0481 25.9736 17.7765 26.1518 17.505 26.3207C17.3441 26.4192 17.1831 26.513 17.0222 26.6162C16.7959 26.7569 16.5696 26.907 16.3434 27.0478C16.2478 27.1088 16.1472 27.1604 16.0517 27.2213C15.9159 27.3058 15.7902 27.4043 15.6494 27.4793C15.4633 27.5872 15.2773 27.6951 15.0811 27.7936C14.8649 27.8968 14.6487 27.9484 14.4123 27.9344C14.2162 27.925 14.0251 27.8781 13.8893 27.7233C13.8742 27.7045 13.8642 27.6857 13.8541 27.667C13.8592 27.6201 13.8994 27.6248 13.9346 27.6201C14.2112 27.5825 14.4324 27.4653 14.5883 27.2401C14.6889 27.0947 14.7291 26.9352 14.7291 26.7616C14.7291 24.7539 14.7291 22.7462 14.7291 20.7432C14.7291 19.5752 14.7291 18.4118 14.7291 17.2438C14.7291 17.1453 14.7543 17.089 14.8548 17.0327C15.0661 16.9201 15.2622 16.7841 15.4633 16.6527C16.0919 16.2446 16.7205 15.8412 17.3541 15.4331C17.6458 15.2455 17.9324 15.0578 18.2241 14.8702C18.3548 14.7858 18.4856 14.6966 18.6163 14.6122C18.6264 14.6122 18.6365 14.6122 18.6415 14.6122C18.6918 14.6591 18.6867 14.7201 18.6867 14.7811C18.6867 15.6489 18.6918 16.5167 18.6918 17.3845C18.7421 17.6003 18.7622 17.8255 18.8979 18.0178C18.9683 18.121 19.0689 18.1679 19.1745 18.2054C19.3505 18.2664 19.5316 18.2242 19.6975 18.1632C19.9741 18.06 20.2205 17.9099 20.4669 17.7551C20.5675 17.6941 20.663 17.6284 20.7686 17.5721C20.9296 17.4783 21.0905 17.3892 21.2464 17.2954C21.4023 17.2016 21.5581 17.1031 21.714 17.0045C21.7241 16.9999 21.7392 16.9999 21.7492 16.9952C21.7543 17.0186 21.7643 17.0421 21.7744 17.0702C21.8046 17.0561 21.8196 17.0515 21.8398 17.0421C22.1616 16.831 22.4834 16.6246 22.8002 16.4135C22.9561 16.3103 23.102 16.193 23.2277 16.057C23.3433 15.935 23.4389 15.8037 23.4992 15.6489C23.5797 15.4378 23.6048 15.2173 23.6048 15.0015C23.6099 13.9508 23.6099 12.9047 23.6048 11.8539C23.6048 11.7742 23.5898 11.6991 23.5797 11.6194C23.5747 11.6006 23.5495 11.5866 23.5344 11.5678C23.5244 11.5443 23.5143 11.5256 23.4992 11.5021C23.4842 11.4693 23.4691 11.4458 23.459 11.4224Z"
                                                                                    fill="#C6C6C6" />
                                                                                <path
                                                                                    d="M4.27447 5.50712C4.24932 5.48836 4.25435 5.47429 4.27949 5.45552C4.39013 5.38516 4.49573 5.3148 4.60636 5.24443C5.14947 4.89262 5.69257 4.5408 6.23567 4.18898C6.55248 3.98258 6.86929 3.77149 7.19113 3.56509C7.23136 3.54164 7.27159 3.52287 7.31685 3.49942C7.35205 3.49942 7.38725 3.49942 7.38725 3.45251C7.42748 3.43844 7.47274 3.43374 7.50794 3.41498C7.66383 3.32585 7.81972 3.23204 7.98064 3.14291C8.00076 3.13353 8.0259 3.12884 8.05105 3.12415C8.05607 3.12884 8.05607 3.13822 8.0611 3.14291C7.65378 3.40091 7.24142 3.65422 6.81398 3.9216C6.88438 3.96382 6.92964 3.99665 6.97993 4.0248C7.24645 4.19367 7.518 4.36254 7.78452 4.53142C7.92533 4.62054 8.06613 4.70029 8.20694 4.78942C8.34774 4.87854 8.48855 4.97236 8.63438 5.06149C8.8305 5.18345 9.03165 5.30072 9.22777 5.42269C9.56972 5.63847 9.90665 5.85894 10.2486 6.07472C10.5202 6.2436 10.7967 6.41247 11.0733 6.58134C11.5762 6.89094 12.074 7.20054 12.5719 7.51014C12.8384 7.67432 13.1049 7.84319 13.3714 8.00737C13.7788 8.26068 14.1911 8.51868 14.5985 8.77199C14.86 8.93148 15.1164 9.09566 15.3779 9.25515C16.2077 9.77115 17.0374 10.2918 17.8621 10.8078C18.5309 11.2253 19.1947 11.6475 19.8635 12.0697C20.2608 12.323 20.6581 12.5716 21.0554 12.8296C21.1509 12.8906 21.2414 12.9657 21.337 13.036C21.3169 13.0548 21.3018 13.0735 21.2766 13.0876C21.0956 13.2049 20.9146 13.3175 20.7335 13.4347C20.3664 13.674 20.0044 13.9179 19.6373 14.1571C19.4059 14.3073 19.1796 14.4527 18.9483 14.6028C18.8427 14.6685 18.7321 14.7341 18.6265 14.7951C18.6114 14.7951 18.6013 14.7951 18.5862 14.7951C18.5712 14.7247 18.5259 14.6825 18.4454 14.6825C18.4203 14.6685 18.3952 14.6497 18.375 14.6356C18.3499 14.5606 18.2845 14.5324 18.2041 14.523C18.199 14.4808 18.1689 14.4761 18.1337 14.4761C18.0834 14.448 18.0381 14.4151 17.9878 14.387C17.9828 14.3307 17.9426 14.3166 17.8923 14.3213C17.8873 14.2791 17.8571 14.2744 17.8219 14.2744C17.8169 14.2322 17.7867 14.2322 17.7515 14.2275C17.7163 14.2041 17.6861 14.1853 17.6509 14.1618C17.6509 14.1149 17.6157 14.1149 17.5805 14.1149C17.5554 14.1009 17.5302 14.0821 17.5101 14.068C17.5051 14.0446 17.5 14.0164 17.4598 14.0446C17.4498 14.0399 17.4447 14.0305 17.4347 14.0258C17.4196 14.0117 17.3995 13.9977 17.3844 13.9836C17.3441 13.9601 17.3039 13.9367 17.2687 13.9132C17.2637 13.871 17.2335 13.8663 17.1983 13.8663C17.1933 13.8241 17.1631 13.8194 17.1279 13.8194C17.1128 13.8053 17.0927 13.7913 17.0776 13.7772C17.0726 13.7772 17.0625 13.7772 17.0575 13.7725C17.0525 13.7303 17.0273 13.7068 16.9821 13.7068C16.9771 13.7068 16.967 13.7068 16.962 13.7021C16.9469 13.6881 16.9268 13.674 16.9117 13.6599C16.9066 13.6599 16.8966 13.6599 16.8916 13.6552C16.8765 13.6411 16.8564 13.6271 16.8413 13.613C16.8362 13.613 16.8262 13.613 16.8212 13.6083C16.796 13.5333 16.7306 13.5051 16.6502 13.4957C16.5697 13.4441 16.4893 13.3925 16.4088 13.3409C16.4088 13.294 16.3736 13.294 16.3384 13.294C16.3133 13.2799 16.2881 13.2612 16.268 13.2471C16.263 13.2049 16.2328 13.2049 16.1976 13.2002C16.1875 13.1908 16.1825 13.1861 16.1725 13.1767C16.1725 13.1298 16.1373 13.1298 16.1021 13.1298C16.0769 13.1158 16.0518 13.097 16.0316 13.0829C16.0266 13.0407 15.9964 13.0407 15.9612 13.0407C15.9059 13.0032 15.8456 12.9657 15.7903 12.9281C15.7852 12.8859 15.7551 12.8859 15.7199 12.8859C15.6847 12.8625 15.6545 12.8437 15.6193 12.8202C15.6143 12.7639 15.569 12.7593 15.5237 12.7546C15.5087 12.7452 15.4936 12.7405 15.4785 12.7311C15.4785 12.6842 15.4433 12.6842 15.4081 12.6842C15.3829 12.6701 15.3578 12.6561 15.3377 12.6373C15.3226 12.6232 15.3025 12.6092 15.2874 12.5951C15.2824 12.5951 15.2723 12.5951 15.2673 12.5904C15.2623 12.5341 15.222 12.5247 15.1717 12.5247C15.1667 12.4825 15.1365 12.4778 15.1013 12.4778C15.0762 12.4637 15.051 12.4497 15.0309 12.4309C15.0158 12.4168 14.9957 12.4027 14.9806 12.3887C14.9656 12.3793 14.9505 12.3746 14.9354 12.3652C14.9354 12.3183 14.9002 12.3183 14.865 12.3183C14.86 12.2761 14.8298 12.2714 14.7946 12.2714C14.7896 12.2292 14.7594 12.2292 14.7242 12.2245C14.7191 12.1682 14.6789 12.1541 14.6286 12.1588C14.6035 12.1448 14.5783 12.1307 14.5582 12.1119C14.5532 12.0697 14.523 12.0697 14.4878 12.065C14.4727 12.0509 14.4526 12.0369 14.4375 12.0228C14.3722 11.9853 14.3118 11.9477 14.2464 11.9055C14.2414 11.8633 14.2112 11.8633 14.176 11.8586C14.161 11.8445 14.1408 11.8305 14.1258 11.8164C14.1207 11.8164 14.1107 11.8164 14.1056 11.8117C14.0805 11.7366 14.0151 11.7085 13.9347 11.6991C13.9296 11.6569 13.8995 11.6522 13.8643 11.6522C13.8391 11.6381 13.814 11.6241 13.7888 11.6053C13.7838 11.549 13.7436 11.5349 13.6933 11.5396C13.6933 11.4974 13.6581 11.4927 13.6229 11.4927C13.5977 11.4786 13.5726 11.4646 13.5525 11.4458C13.5374 11.4317 13.5173 11.4177 13.5022 11.4036C13.4972 11.4036 13.4871 11.4036 13.4821 11.3989C13.467 11.3848 13.4469 11.3708 13.4318 11.3567C13.4167 11.3473 13.4016 11.3379 13.3865 11.3332C13.3815 11.291 13.3513 11.2863 13.3161 11.2863C13.3111 11.2441 13.2809 11.2441 13.2457 11.2394C13.2306 11.2253 13.2105 11.2113 13.1954 11.1972C13.1904 11.1972 13.1804 11.1972 13.1753 11.1925C13.1703 11.1362 13.1301 11.1221 13.0798 11.1268C13.0748 11.0846 13.0446 11.0799 13.0094 11.0799C13.0044 11.0377 12.9742 11.0377 12.939 11.033C12.9289 11.0236 12.9239 11.0189 12.9138 11.0096C12.9138 10.9626 12.8786 10.9626 12.8434 10.9626C12.8434 10.9157 12.8082 10.9157 12.773 10.9157C12.7479 10.9017 12.7227 10.8829 12.7026 10.8688C12.6976 10.8266 12.6624 10.8266 12.6322 10.8219C12.6171 10.8078 12.597 10.7938 12.5819 10.7797C12.5669 10.7703 12.5518 10.7656 12.5367 10.7562C12.5367 10.7093 12.5015 10.7093 12.4663 10.7093C12.4512 10.6953 12.4311 10.6812 12.416 10.6671C12.411 10.6671 12.4009 10.6671 12.3959 10.6624C12.3908 10.6202 12.3607 10.6202 12.3255 10.6155C12.3003 10.6014 12.2752 10.5827 12.25 10.5686C12.245 10.5123 12.2048 10.5029 12.1545 10.5029C12.1495 10.4607 12.1193 10.456 12.0841 10.456C12.069 10.442 12.0489 10.4279 12.0338 10.4138C12.0237 10.4091 12.0137 10.3997 12.0087 10.395C11.9986 10.3434 11.9584 10.3434 11.9181 10.3434C11.9181 10.2965 11.8829 10.2965 11.8477 10.2965C11.8427 10.2543 11.8125 10.2496 11.7773 10.2496C11.7623 10.2356 11.7421 10.2215 11.7271 10.2074C11.712 10.198 11.6969 10.1933 11.6818 10.184C11.6818 10.137 11.6466 10.137 11.6114 10.137C11.6064 10.0948 11.5762 10.0901 11.541 10.0901C11.536 10.0479 11.5058 10.0432 11.4706 10.0432C11.4656 9.98694 11.4253 9.97286 11.375 9.97755C11.375 9.93064 11.3398 9.93064 11.3046 9.93064C11.2544 9.9025 11.2091 9.86966 11.1588 9.84152C11.1538 9.78523 11.1135 9.77115 11.0633 9.77585C11.0633 9.72894 11.0281 9.72894 10.9929 9.72894C10.9878 9.68672 10.9577 9.68672 10.9225 9.68203C10.9124 9.67734 10.9074 9.66795 10.8973 9.66326C10.8722 9.60228 10.8219 9.57414 10.7515 9.57414C10.7464 9.52723 10.7163 9.52723 10.6811 9.52723C10.666 9.51315 10.6459 9.49908 10.6308 9.48501C10.5906 9.46155 10.5453 9.44748 10.5101 9.41934C10.3341 9.30675 10.1581 9.18948 9.98208 9.0769C9.97705 9.02061 9.93682 9.00654 9.88653 9.01123C9.86139 8.99716 9.83625 8.97839 9.81613 8.96432C9.8111 8.9221 9.78093 8.9221 9.74573 8.91741C9.73567 8.91272 9.73064 8.90334 9.72059 8.89865C9.72059 8.85174 9.68539 8.85174 9.65018 8.85174C9.64516 8.80483 9.61498 8.80483 9.57978 8.80483C9.57475 8.76261 9.54458 8.75792 9.50938 8.75792C9.45406 8.72039 9.39372 8.68286 9.3384 8.64534C9.33337 8.60312 9.3032 8.60312 9.268 8.60312C9.26297 8.5609 9.2328 8.5609 9.1976 8.55621C9.19257 8.49992 9.15234 8.48585 9.10205 8.49054C9.09702 8.44363 9.06685 8.44363 9.03165 8.44363C9.02662 8.40141 8.99645 8.39672 8.96125 8.39672C8.94616 8.38265 8.92605 8.36857 8.91096 8.3545C8.90593 8.3545 8.89587 8.3545 8.89084 8.34981C8.87576 8.33574 8.85564 8.32167 8.84056 8.30759C8.82547 8.29821 8.81039 8.28883 8.7953 8.28414C8.78021 8.27007 8.7601 8.25599 8.74501 8.24192C8.73998 8.24192 8.72992 8.24192 8.7249 8.23723C8.71987 8.19501 8.6897 8.19501 8.65449 8.19032C8.63941 8.17625 8.61929 8.16217 8.60421 8.1481C8.50866 8.08712 8.41312 8.02614 8.31757 7.96516C8.0611 7.80097 7.80464 7.63679 7.54817 7.47261C7.22633 7.26152 6.89947 7.05043 6.57763 6.83934C6.56254 6.82527 6.54243 6.81119 6.52734 6.79712C6.48711 6.77367 6.44688 6.75021 6.41168 6.72676C6.40665 6.68454 6.37648 6.67985 6.34128 6.67985C6.32619 6.66578 6.30607 6.6517 6.29099 6.63763C6.28596 6.63763 6.2759 6.63294 6.27087 6.63294C6.25579 6.61887 6.23567 6.60479 6.22059 6.59072C6.18036 6.56727 6.14013 6.54381 6.10493 6.52036C6.08984 6.50629 6.06972 6.49221 6.05464 6.47814C5.98926 6.44061 5.92892 6.40309 5.86355 6.36087C5.85852 6.31865 5.82834 6.31865 5.79314 6.31396C5.77806 6.29989 5.75794 6.28581 5.74286 6.27174C5.70263 6.24829 5.6624 6.22483 5.6272 6.20138C5.62217 6.15916 5.59199 6.15447 5.55679 6.15447C5.55176 6.11225 5.51656 6.11225 5.48639 6.10756C5.4713 6.09349 5.45119 6.07941 5.4361 6.06534C5.2601 5.95276 5.07906 5.84018 4.90306 5.7276C4.59128 5.71821 4.43538 5.61032 4.27447 5.50712Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M18.6213 14.7997C18.7269 14.7341 18.8376 14.6731 18.9432 14.6074C19.1745 14.462 19.4058 14.3119 19.6321 14.1618C19.9992 13.9225 20.3613 13.6786 20.7284 13.4394C20.9094 13.3221 21.0904 13.2095 21.2715 13.0922C21.2916 13.0782 21.3117 13.0594 21.3318 13.0406C21.367 13.0641 21.4073 13.0782 21.4374 13.1063C21.4777 13.1438 21.5179 13.1626 21.5732 13.1532C21.5782 13.1673 21.5782 13.1861 21.5883 13.1954C21.7241 13.3127 21.7442 13.4628 21.7442 13.627C21.7442 14.8326 21.7442 16.0428 21.7442 17.2484C21.7341 17.2531 21.719 17.2484 21.709 17.2578C21.5531 17.3563 21.3972 17.4548 21.2413 17.5486C21.0854 17.6424 20.9245 17.7316 20.7636 17.8254C20.663 17.8864 20.5624 17.9473 20.4619 18.0083C20.2154 18.1631 19.969 18.3179 19.6925 18.4164C19.5265 18.4774 19.3404 18.5196 19.1695 18.4586C19.0689 18.4211 18.9683 18.3742 18.8929 18.271C18.7571 18.074 18.732 17.8535 18.6867 17.6377C18.6867 16.7699 18.6817 15.9021 18.6817 15.0343C18.6817 14.9733 18.6867 14.9123 18.6364 14.8654C18.6314 14.856 18.6314 14.8513 18.6264 14.842C18.6264 14.8279 18.6213 14.8138 18.6213 14.7997Z"
                                                                                    fill="#9F9F9F" />
                                                                                <path
                                                                                    d="M18.199 14.5278C18.2744 14.5372 18.3398 14.5607 18.37 14.6404C18.2995 14.6216 18.2392 14.5888 18.199 14.5278Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M16.63 13.5145C16.7054 13.5239 16.7708 13.5474 16.801 13.6271C16.7306 13.6083 16.6702 13.5755 16.63 13.5145Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M13.8794 11.7366C13.9548 11.746 14.0202 11.7694 14.0504 11.8492C13.98 11.8257 13.9196 11.7976 13.8794 11.7366Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M18.4404 14.6871C18.5209 14.6871 18.5661 14.7294 18.5812 14.7997C18.536 14.7622 18.4857 14.7247 18.4404 14.6871Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M10.6459 9.64453C10.7163 9.64453 10.7666 9.67268 10.7917 9.73366C10.7263 9.72428 10.676 9.69613 10.6459 9.64453Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M8.98132 8.56091C9.03161 8.56091 9.07184 8.5703 9.07687 8.62659C9.0467 8.60782 9.0115 8.58437 8.98132 8.56091Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M12.069 10.564C12.1193 10.564 12.1595 10.5733 12.1645 10.6296C12.1343 10.6109 12.1042 10.5874 12.069 10.564Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M10.9575 9.84619C11.0078 9.84619 11.048 9.85557 11.0531 9.91186C11.0229 9.88841 10.9927 9.86965 10.9575 9.84619Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M13.6379 11.577C13.6882 11.577 13.7285 11.5864 13.7335 11.6427C13.7033 11.6239 13.6681 11.6005 13.6379 11.577Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M17.8822 14.3259C17.9325 14.3259 17.9727 14.3353 17.9777 14.3916C17.9476 14.3681 17.9174 14.3494 17.8822 14.3259Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M11.2744 10.048C11.3247 10.048 11.3649 10.0574 11.37 10.1136C11.3398 10.0949 11.3046 10.0714 11.2744 10.048Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M15.4935 12.7733C15.5388 12.778 15.584 12.7827 15.5891 12.839C15.5488 12.8296 15.5036 12.8249 15.4935 12.7733Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.77588 9.08154C9.82617 9.08154 9.8664 9.09092 9.87142 9.14722C9.84125 9.12376 9.81108 9.105 9.77588 9.08154Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M15.1315 12.5482C15.1818 12.5482 15.222 12.5576 15.227 12.6139C15.1968 12.5904 15.1667 12.567 15.1315 12.5482Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.5784 12.1869C14.6287 12.1869 14.6689 12.1963 14.6739 12.2526C14.6437 12.2291 14.6136 12.2103 14.5784 12.1869Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M13.0094 11.1737C13.0597 11.1737 13.0999 11.1831 13.1049 11.2394C13.0748 11.2206 13.0446 11.1972 13.0094 11.1737Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M16.9669 13.7208C17.0122 13.7208 17.0373 13.7443 17.0423 13.7865C16.9921 13.7818 16.9719 13.7584 16.9669 13.7208Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M11.8276 10.4092C11.8679 10.4092 11.9131 10.4092 11.9182 10.4608C11.888 10.442 11.8578 10.4279 11.8276 10.4092Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M17.7415 14.2368C17.7767 14.2368 17.8119 14.2368 17.8119 14.2837C17.7867 14.265 17.7666 14.2509 17.7415 14.2368Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M17.8118 14.2792C17.847 14.2792 17.8822 14.2792 17.8822 14.3261C17.8621 14.312 17.8369 14.2932 17.8118 14.2792Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M18.1287 14.4808C18.1639 14.4808 18.1991 14.4808 18.1991 14.5277C18.1739 14.5137 18.1488 14.4996 18.1287 14.4808Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M5.34058 6.19666C5.37578 6.19666 5.41098 6.19666 5.41098 6.24356C5.38584 6.22949 5.36069 6.21542 5.34058 6.19666Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M5.41089 6.24365C5.44609 6.24365 5.48129 6.24365 5.48129 6.29056C5.46118 6.2718 5.43603 6.25773 5.41089 6.24365Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M5.65234 6.40308C5.68754 6.40308 5.72275 6.40308 5.72275 6.44999C5.6976 6.43122 5.67749 6.41715 5.65234 6.40308Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M6.20544 6.75964C6.24065 6.75964 6.27585 6.75964 6.27585 6.80655C6.25573 6.79248 6.23059 6.77841 6.20544 6.75964Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M8.52368 8.27002C8.55888 8.27002 8.59408 8.27002 8.59408 8.31693C8.57397 8.29816 8.54883 8.28409 8.52368 8.27002Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M8.83545 8.47168C8.87065 8.47168 8.90585 8.47168 8.90585 8.51859C8.88574 8.49983 8.86059 8.48575 8.83545 8.47168Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M8.91089 8.51868C8.94609 8.51868 8.98129 8.51868 8.98129 8.56559C8.95615 8.54682 8.931 8.53275 8.91089 8.51868Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M9.07678 8.63123C9.11198 8.63123 9.14718 8.63123 9.14718 8.67813C9.12707 8.65937 9.10193 8.6453 9.07678 8.63123Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.15234 8.67358C9.18754 8.67358 9.22275 8.67358 9.22275 8.7158C9.1976 8.70642 9.17246 8.68766 9.15234 8.67358Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.39368 8.83301C9.42888 8.83301 9.46408 8.83301 9.46408 8.87992C9.43894 8.86115 9.41379 8.84708 9.39368 8.83301Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.46411 8.87988C9.49931 8.87988 9.53451 8.87988 9.53451 8.92679C9.5144 8.90803 9.48926 8.89396 9.46411 8.87988Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.53442 8.922C9.56962 8.922 9.60483 8.922 9.60483 8.96891C9.58471 8.95483 9.55957 8.93607 9.53442 8.922Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.63513 8.98779C9.67033 8.98779 9.70553 8.98779 9.70553 9.0347C9.68039 9.02063 9.65525 9.00656 9.63513 8.98779Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M10.5754 9.59766C10.6106 9.59766 10.6458 9.59766 10.6458 9.64457C10.6207 9.63049 10.5956 9.61173 10.5754 9.59766Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M10.8169 9.75696C10.8521 9.75696 10.8873 9.75696 10.8873 9.80387C10.8622 9.7851 10.842 9.77103 10.8169 9.75696Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M10.8872 9.79932C10.9224 9.79932 10.9576 9.79932 10.9576 9.84623C10.9375 9.83215 10.9124 9.81339 10.8872 9.79932Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M11.199 10.001C11.2342 10.001 11.2694 10.001 11.2694 10.0479C11.2493 10.0338 11.2241 10.0197 11.199 10.001Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M11.37 10.1136C11.4052 10.1136 11.4404 10.1136 11.4404 10.1606C11.4203 10.1465 11.3951 10.1324 11.37 10.1136Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M11.4403 10.1605C11.4755 10.1605 11.5107 10.1605 11.5107 10.2074C11.4906 10.1887 11.4655 10.1746 11.4403 10.1605Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M11.5159 10.2073C11.5511 10.2073 11.5863 10.2073 11.5863 10.2542C11.5611 10.2354 11.536 10.2213 11.5159 10.2073Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M11.6868 10.3199C11.722 10.3199 11.7572 10.3199 11.7572 10.3669C11.732 10.3481 11.7069 10.334 11.6868 10.3199Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M11.7572 10.3622C11.7924 10.3622 11.8276 10.3622 11.8276 10.4091C11.8025 10.395 11.7823 10.3763 11.7572 10.3622Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M11.9985 10.5216C12.0337 10.5216 12.0689 10.5216 12.0689 10.5685C12.0438 10.5498 12.0237 10.5357 11.9985 10.5216Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M12.2399 10.6764C12.2751 10.6764 12.3103 10.6764 12.3103 10.7233C12.2851 10.7092 12.265 10.6952 12.2399 10.6764Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M13.5675 11.5349C13.6027 11.5349 13.6379 11.5349 13.6379 11.5818C13.6128 11.5631 13.5926 11.549 13.5675 11.5349Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M12.3857 10.7703C12.4209 10.7703 12.4561 10.7703 12.4561 10.8172C12.431 10.7984 12.4059 10.7843 12.3857 10.7703Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M12.5518 10.8829C12.587 10.8829 12.6222 10.8829 12.6222 10.9298C12.602 10.9111 12.5769 10.897 12.5518 10.8829Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M12.6976 10.9719C12.7328 10.9719 12.768 10.9719 12.768 11.0188C12.7429 11.0001 12.7228 10.986 12.6976 10.9719Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M12.7679 11.0189C12.8031 11.0189 12.8383 11.0189 12.8383 11.0658C12.8182 11.0471 12.7931 11.033 12.7679 11.0189Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M12.8685 11.0846C12.9037 11.0846 12.9389 11.0846 12.9389 11.1315C12.9138 11.1127 12.8886 11.0987 12.8685 11.0846Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M12.939 11.1267C12.9742 11.1267 13.0094 11.1267 13.0094 11.1736C12.9842 11.1595 12.9641 11.1455 12.939 11.1267Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M13.1803 11.2863C13.2155 11.2863 13.2507 11.2863 13.2507 11.3332C13.2306 11.3144 13.2054 11.3003 13.1803 11.2863Z"
                                                                                    fill="#C8CCCC" />
                                                                                <path
                                                                                    d="M13.2507 11.3333C13.2859 11.3333 13.3211 11.3333 13.3211 11.3802C13.301 11.3614 13.2759 11.3473 13.2507 11.3333Z"
                                                                                    fill="#C8CCCC" />
                                                                                <path
                                                                                    d="M13.8088 11.6897C13.844 11.6897 13.8792 11.6897 13.8792 11.7366C13.8541 11.7225 13.834 11.7038 13.8088 11.6897Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.1206 11.8961C14.1558 11.8961 14.191 11.8961 14.191 11.943C14.1709 11.9243 14.1457 11.9102 14.1206 11.8961Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.4375 12.0979C14.4727 12.0979 14.5079 12.0979 14.5079 12.1448C14.4828 12.126 14.4576 12.112 14.4375 12.0979Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M14.679 12.2527C14.7142 12.2527 14.7494 12.2527 14.7494 12.2996C14.7242 12.2855 14.6991 12.2668 14.679 12.2527Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.7493 12.2996C14.7845 12.2996 14.8197 12.2996 14.8197 12.3465C14.7945 12.3277 14.7744 12.3136 14.7493 12.2996Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.8197 12.3464C14.8549 12.3464 14.8901 12.3464 14.8901 12.3933C14.87 12.3746 14.8448 12.3605 14.8197 12.3464Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M15.061 12.5012C15.0962 12.5012 15.1314 12.5012 15.1314 12.5481C15.1113 12.5341 15.0862 12.5153 15.061 12.5012Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M15.3779 12.703C15.4131 12.703 15.4483 12.703 15.4483 12.7499C15.4232 12.7358 15.398 12.7218 15.3779 12.703Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M15.6896 12.9047C15.7248 12.9047 15.76 12.9047 15.76 12.9469C15.7399 12.9375 15.7147 12.9234 15.6896 12.9047Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M15.931 13.0642C15.9662 13.0642 15.9964 13.0642 16.0014 13.1064C15.9813 13.0924 15.9562 13.0783 15.931 13.0642Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M16.0769 13.1533C16.1121 13.1533 16.1473 13.1533 16.1473 13.2002C16.1222 13.1862 16.097 13.1721 16.0769 13.1533Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M16.1724 13.2238C16.2076 13.2238 16.2428 13.2238 16.2428 13.2707C16.2227 13.2519 16.1975 13.2378 16.1724 13.2238Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M16.3182 13.3129C16.3534 13.3129 16.3886 13.3129 16.3886 13.3598C16.3635 13.3457 16.3384 13.3269 16.3182 13.3129Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M17.1128 13.8289C17.148 13.8289 17.1832 13.8289 17.1832 13.8758C17.1631 13.8617 17.1379 13.8429 17.1128 13.8289Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M17.1831 13.8756C17.2183 13.8756 17.2535 13.8756 17.2535 13.9225C17.2334 13.9038 17.2082 13.8897 17.1831 13.8756Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M17.5703 14.1243C17.6055 14.1243 17.6407 14.1243 17.6407 14.1712C17.6206 14.1524 17.5955 14.1383 17.5703 14.1243Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M6.08484 6.67517C6.09993 6.68924 6.12004 6.70332 6.13513 6.71739C6.11501 6.70332 6.09993 6.68924 6.08484 6.67517Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M11.6315 10.2732C11.6466 10.2873 11.6667 10.3013 11.6818 10.3154C11.6667 10.3013 11.6516 10.2873 11.6315 10.2732Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M8.61426 8.31689C8.62934 8.33097 8.64946 8.34504 8.66455 8.35911C8.64946 8.34504 8.63437 8.33097 8.61426 8.31689Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M10.5253 9.55542C10.5404 9.56949 10.5605 9.58357 10.5756 9.59764C10.5554 9.58357 10.5404 9.56949 10.5253 9.55542Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M14.3822 12.0555C14.3973 12.0696 14.4174 12.0837 14.4325 12.0978C14.4174 12.0837 14.4023 12.0696 14.3822 12.0555Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M6.15515 6.72205C6.17024 6.73612 6.19035 6.75019 6.20544 6.76426C6.19035 6.7455 6.17024 6.73143 6.15515 6.72205Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M11.9482 10.4795C11.9633 10.4936 11.9834 10.5076 11.9985 10.5217C11.9784 10.5076 11.9633 10.4936 11.9482 10.4795Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M8.71484 8.38269C8.72993 8.39676 8.75004 8.41084 8.76513 8.42491C8.74502 8.41084 8.72993 8.39676 8.71484 8.38269Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M17.3743 13.9883C17.3894 14.0024 17.4095 14.0164 17.4246 14.0305C17.4095 14.0164 17.3944 14.0024 17.3743 13.9883Z"
                                                                                    fill="#C8CCCC" />
                                                                                <path
                                                                                    d="M17.4497 14.0493C17.4899 14.0211 17.4899 14.0493 17.5 14.0727C17.4849 14.068 17.4648 14.0586 17.4497 14.0493Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M13.3713 11.4036C13.3864 11.4176 13.4065 11.4317 13.4216 11.4458C13.4065 11.427 13.3864 11.4129 13.3713 11.4036Z"
                                                                                    fill="#C8CCCC" />
                                                                                <path
                                                                                    d="M12.3304 10.7234C12.3455 10.7375 12.3656 10.7515 12.3807 10.7656C12.3656 10.7562 12.3506 10.7422 12.3304 10.7234Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M14.9404 12.4121C14.9555 12.4262 14.9756 12.4403 14.9907 12.4543C14.9706 12.4403 14.9555 12.4262 14.9404 12.4121Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M5.60205 6.36084C5.61714 6.37491 5.63725 6.38898 5.65234 6.40306C5.63222 6.38898 5.61714 6.37491 5.60205 6.36084Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M5.28516 6.15918C5.30024 6.17325 5.32036 6.18732 5.33544 6.2014C5.32036 6.18263 5.30527 6.16856 5.28516 6.15918Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M18.6265 14.8419C18.6316 14.8513 18.6316 14.856 18.6366 14.8654C18.6265 14.8654 18.6165 14.8654 18.6115 14.8654C18.6165 14.856 18.6215 14.8513 18.6265 14.8419Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M21.5732 13.1579C21.5179 13.1626 21.4777 13.1438 21.4374 13.111C21.4073 13.0828 21.367 13.0688 21.3318 13.0453C21.2363 12.9749 21.1508 12.8999 21.0502 12.8389C20.6529 12.5856 20.2557 12.3323 19.8584 12.079C19.1896 11.6568 18.5258 11.2393 17.857 10.8171C17.0272 10.2964 16.2025 9.78044 15.3728 9.26444C15.1113 9.10026 14.8548 8.94077 14.5933 8.78128C14.186 8.52797 13.7736 8.26997 13.3663 8.01666C13.0998 7.85248 12.8333 7.68361 12.5667 7.51942C12.0689 7.20982 11.566 6.90022 11.0682 6.59062C10.7966 6.42175 10.52 6.25757 10.2435 6.08401C9.90151 5.86823 9.56458 5.64775 9.22263 5.43197C9.02651 5.31001 8.82536 5.19274 8.62924 5.07077C8.48844 4.98165 8.34763 4.88783 8.2018 4.7987C8.06099 4.70957 7.92019 4.62983 7.77938 4.5407C7.50783 4.37183 7.24131 4.20296 6.97479 4.03408C6.9245 4.00125 6.87924 3.9731 6.80884 3.93088C7.23628 3.6635 7.64864 3.4055 8.05596 3.15219C8.05093 3.1475 8.05094 3.13812 8.04591 3.13343C8.02076 3.13812 7.99562 3.14281 7.9755 3.15219C7.81961 3.24132 7.66372 3.33514 7.5028 3.42427C7.4676 3.44303 7.42234 3.44772 7.38211 3.46179C7.45754 3.4055 7.53298 3.34452 7.61344 3.28823C7.98556 3.0443 8.35266 2.80507 8.72479 2.56583C8.73484 2.56114 8.7449 2.55645 8.75496 2.55176C8.80525 2.57052 8.8505 2.58459 8.89576 2.60336C9.03154 2.68779 9.16731 2.77692 9.30309 2.85667C9.63499 3.05838 9.96688 3.26008 10.3038 3.46179C10.6508 3.67288 11.0028 3.88397 11.3498 4.09976C11.8527 4.40936 12.3555 4.72365 12.8634 5.03794C14.1458 5.83539 15.4331 6.63284 16.7154 7.4303C17.2837 7.78211 17.8469 8.13862 18.4152 8.49513C18.7823 8.72499 19.1544 8.95953 19.5215 9.18938C20.0495 9.52244 20.5775 9.85549 21.1055 10.1885C21.5682 10.4794 22.0258 10.7749 22.4834 11.0704C22.755 11.244 23.0315 11.4223 23.3031 11.6005C23.3534 11.6333 23.3986 11.6662 23.4489 11.699C23.464 11.7225 23.4741 11.7459 23.4892 11.7694C23.4992 11.7928 23.5093 11.8116 23.5244 11.8351C23.2729 12.0039 23.0265 12.1728 22.7751 12.337C22.5639 12.4777 22.3476 12.6137 22.1364 12.7545C21.9654 12.8671 21.7995 12.9796 21.6335 13.0969C21.6134 13.111 21.5983 13.1344 21.5732 13.1579ZM8.20683 3.02554C8.19677 3.03492 8.18168 3.0443 8.17162 3.05368C8.17665 3.05838 8.17665 3.05838 8.18168 3.06307C8.19174 3.04899 8.19677 3.03492 8.20683 3.02554C8.20683 3.02085 8.21185 3.02085 8.21185 3.01616C8.21185 3.02085 8.21185 3.02085 8.20683 3.02554ZM8.09619 3.10059C8.10122 3.10528 8.11128 3.10998 8.11631 3.10998C8.12134 3.10998 8.12134 3.10059 8.12637 3.09121C8.12134 3.08652 8.11128 3.08183 8.10625 3.08183C8.10122 3.08183 8.10122 3.09121 8.09619 3.10059ZM8.28226 2.99739L8.28729 2.9927L8.28226 2.98801C8.27723 2.9927 8.27723 2.9927 8.2722 2.99739C8.27723 2.99739 8.28226 2.99739 8.28226 2.99739Z"
                                                                                    fill="#CCCCCC" />
                                                                                <path
                                                                                    d="M7.3873 3.45239C7.3873 3.4993 7.3521 3.4993 7.31689 3.4993C7.34204 3.48054 7.36215 3.46647 7.3873 3.45239Z"
                                                                                    fill="#CCCCCC" />
                                                                                <path
                                                                                    d="M21.5732 13.158C21.5934 13.1345 21.6135 13.1111 21.6386 13.0923C21.8046 12.975 21.9755 12.8624 22.1415 12.7499C22.3527 12.6091 22.5689 12.4731 22.7801 12.3324C23.0316 12.1635 23.278 11.9946 23.5294 11.8304C23.5445 11.8445 23.5696 11.8633 23.5747 11.882C23.5898 11.9571 23.5998 12.0368 23.5998 12.1166C23.5998 13.1674 23.6049 14.2134 23.5998 15.2642C23.5998 15.4847 23.5747 15.7004 23.4942 15.9115C23.4339 16.0663 23.3383 16.1977 23.2227 16.3196C23.0969 16.4557 22.9511 16.5729 22.7952 16.6761C22.4734 16.8872 22.1515 17.0936 21.8347 17.3047C21.8196 17.3141 21.7995 17.3235 21.7694 17.3329C21.7593 17.3047 21.7543 17.2813 21.7442 17.2578C21.7442 16.0523 21.7442 14.842 21.7442 13.6364C21.7442 13.4723 21.7241 13.3222 21.5883 13.2049C21.5783 13.1908 21.5783 13.172 21.5732 13.158Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M8.20686 3.02563C8.1968 3.03502 8.18674 3.04909 8.17668 3.05847C8.17165 3.05378 8.17165 3.05378 8.16663 3.04909C8.18171 3.0444 8.1968 3.03502 8.20686 3.02563Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M8.09631 3.10067C8.10134 3.09598 8.10134 3.0866 8.10637 3.08191C8.1114 3.08191 8.12146 3.0866 8.12649 3.09129C8.12146 3.09598 8.12146 3.10536 8.11643 3.11005C8.1114 3.11005 8.10134 3.10067 8.09631 3.10067Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M8.2824 2.99759C8.27737 2.99759 8.27737 2.99759 8.27234 2.9929C8.27737 2.98821 8.27737 2.98821 8.2824 2.98352L8.28743 2.98821C8.28743 2.9929 8.28742 2.99759 8.2824 2.99759Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M8.20679 3.02562C8.20679 3.02093 8.21136 3.02093 8.21136 3.01624C8.21136 3.02093 8.21136 3.02093 8.20679 3.02562Z"
                                                                                    fill="#B7B7B7" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_43_2">
                                                                                    <rect width="28" height="28"
                                                                                        fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>


                                                                        <span x-text="$t('addsingbox')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div class="flex flex-col">
                                                                            <div class="flex items-center gap-x-2">
                                                                                <span x-text="$t('needediOS')"></span>
                                                                                <div
                                                                                    class="flex items-center rtl:flex-row-reverse rtl:justify-end gap-x-1">
                                                                                    <svg width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <g clip-path="url(#clip0_23_24)">
                                                                                            <path fill-rule="evenodd"
                                                                                                clip-rule="evenodd"
                                                                                                d="M4.36364 0C3.20633 0 2.09642 0.459739 1.27808 1.27808C0.459739 2.09642 0 3.20633 0 4.36364V19.6364C0 20.7937 0.459739 21.9036 1.27808 22.7219C2.09642 23.5403 3.20633 24 4.36364 24H19.6364C20.7937 24 21.9036 23.5403 22.7219 22.7219C23.5403 21.9036 24 20.7937 24 19.6364V4.36364C24 3.20633 23.5403 2.09642 22.7219 1.27808C21.9036 0.459739 20.7937 0 19.6364 0H4.36364ZM3.81818 8.82109C3.81818 8.53176 3.93312 8.25429 4.1377 8.0497C4.34229 7.84512 4.61976 7.73018 4.90909 7.73018C5.19842 7.73018 5.47589 7.84512 5.68048 8.0497C5.88507 8.25429 6 8.53176 6 8.82109C6 9.11042 5.88507 9.3879 5.68048 9.59248C5.47589 9.79707 5.19842 9.912 4.90909 9.912C4.61976 9.912 4.34229 9.79707 4.1377 9.59248C3.93312 9.3879 3.81818 9.11042 3.81818 8.82109ZM14.4545 10.9091C14.4545 9.912 15.3665 8.45455 17.4545 8.45455C18.2564 8.45455 18.9818 8.844 19.4782 9.25745C19.7345 9.47127 19.9604 9.71564 20.1295 9.96982C20.2833 10.2 20.4545 10.5338 20.4545 10.9091H18.8182C18.8182 10.9495 18.8236 10.9735 18.8247 10.9789C18.8095 10.9432 18.7905 10.9092 18.768 10.8775C18.6726 10.7416 18.5588 10.6197 18.4298 10.5153C18.1091 10.2469 17.7425 10.0909 17.4545 10.0909C16.2753 10.0909 16.0931 10.8087 16.0909 10.908C16.0876 10.9036 16.0887 10.908 16.0909 10.9091V10.908C16.1567 10.9741 16.2344 11.027 16.32 11.064C16.632 11.22 17.0793 11.3356 17.6531 11.4785L17.7022 11.4916C18.2105 11.6182 18.8302 11.7731 19.32 12.0185C19.8349 12.276 20.4545 12.7636 20.4545 13.6364C20.4545 14.6335 19.5425 16.0909 17.4545 16.0909C15.3665 16.0909 14.4545 14.6335 14.4545 13.6364H16.0909C16.0909 13.7302 16.2698 14.4545 17.4545 14.4545C18.6338 14.4545 18.816 13.7367 18.8182 13.6375C18.8215 13.6418 18.8204 13.6375 18.8182 13.6364V13.6375C18.7524 13.5714 18.6747 13.5184 18.5891 13.4815C18.2771 13.3255 17.8298 13.2098 17.256 13.0669L17.2069 13.0538C16.6985 12.9273 16.0789 12.7724 15.5891 12.5269C15.0742 12.2695 14.4545 11.7818 14.4545 10.9091ZM8.45455 12.2727C8.45455 10.9931 9.38182 10.0909 10.3636 10.0909C11.3455 10.0909 12.2727 10.9931 12.2727 12.2727C12.2727 13.5524 11.3455 14.4545 10.3636 14.4545C9.38182 14.4545 8.45455 13.5524 8.45455 12.2727ZM10.3636 8.45455C8.33455 8.45455 6.81818 10.2393 6.81818 12.2727C6.81818 14.3062 8.33455 16.0909 10.3636 16.0909C12.3927 16.0909 13.9091 14.3062 13.9091 12.2727C13.9091 10.2393 12.3927 8.45455 10.3636 8.45455ZM4.09091 16.0909V10.3636H5.72727V16.0909H4.09091Z"
                                                                                                fill="white" />
                                                                                        </g>
                                                                                        <defs>
                                                                                            <clipPath id="clip0_23_24">
                                                                                                <rect width="24" height="24"
                                                                                                    fill="white" />
                                                                                            </clipPath>
                                                                                        </defs>
                                                                                    </svg>
                                                                                    <span class="text-sm">15+</span>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('downloadApp')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForDownload')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a href="https://apps.apple.com/us/app/sing-box/id6451272673"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                                <span x-text="$t('download')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                            </a>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('addConfigs')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForAdd')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a id="ios-singbox"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-stone-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                                <span x-text="$t('AddtoApp')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="AndroidContainer"
                                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 transition-all duration-300 font-medium rounded-2xl">
                                <!-- Accordion item -->
                                <div x-data="{ expanded: false }">
                                    <h2>
                                        <button id="faqs-title-01" type="button"
                                            class="flex p-4 rtl:pl-0 items-center justify-between w-full text-left font-semibold"
                                            @click="expanded = !expanded" :aria-expanded="expanded"
                                            aria-controls="faqs-text-01">
                                            <div
                                                class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.17 1.165C9.07551 0.997296 8.92015 0.872344 8.73609 0.816007C8.55202 0.75967 8.35334 0.776261 8.18117 0.862346C8.009 0.948432 7.87652 1.09742 7.81115 1.27847C7.74578 1.45953 7.75253 1.65878 7.83 1.835L8.667 3.51C8.00017 3.9556 7.42938 4.53028 6.98832 5.20012C6.54726 5.86996 6.24487 6.62137 6.099 7.41L5.99 8H18.01L17.901 7.41C17.7551 6.62137 17.4527 5.86996 17.0117 5.20012C16.5706 4.53028 15.9998 3.9556 15.333 3.51L16.171 1.835C16.258 1.65726 16.2713 1.45232 16.2078 1.26486C16.1444 1.07739 16.0095 0.922596 15.8324 0.834197C15.6553 0.745798 15.4505 0.730964 15.2626 0.792928C15.0746 0.854892 14.9188 0.988631 14.829 1.165L13.992 2.839C13.352 2.61401 12.6784 2.49938 12 2.5C11.3216 2.49938 10.648 2.61401 10.008 2.839L9.17 1.165ZM3.5 9C3.10218 9 2.72064 9.15804 2.43934 9.43934C2.15804 9.72064 2 10.1022 2 10.5V15.5C2 15.8978 2.15804 16.2794 2.43934 16.5607C2.72064 16.842 3.10218 17 3.5 17C3.89782 17 4.27936 16.842 4.56066 16.5607C4.84196 16.2794 5 15.8978 5 15.5V10.5C5 10.1022 4.84196 9.72064 4.56066 9.43934C4.27936 9.15804 3.89782 9 3.5 9ZM20.5 9C20.1022 9 19.7206 9.15804 19.4393 9.43934C19.158 9.72064 19 10.1022 19 10.5V15.5C19 15.8978 19.158 16.2794 19.4393 16.5607C19.7206 16.842 20.1022 17 20.5 17C20.8978 17 21.2794 16.842 21.5607 16.5607C21.842 16.2794 22 15.8978 22 15.5V10.5C22 10.1022 21.842 9.72064 21.5607 9.43934C21.2794 9.15804 20.8978 9 20.5 9ZM18 9H6V17.5C6 17.8978 6.15804 18.2794 6.43934 18.5607C6.72064 18.842 7.10218 19 7.5 19H8V21.5C8 21.8978 8.15804 22.2794 8.43934 22.5607C8.72064 22.842 9.10218 23 9.5 23C9.89782 23 10.2794 22.842 10.5607 22.5607C10.842 22.2794 11 21.8978 11 21.5V19H13V21.5C13 21.8978 13.158 22.2794 13.4393 22.5607C13.7206 22.842 14.1022 23 14.5 23C14.8978 23 15.2794 22.842 15.5607 22.5607C15.842 22.2794 16 21.8978 16 21.5V19H16.5C16.8978 19 17.2794 18.842 17.5607 18.5607C17.842 18.2794 18 17.8978 18 17.5V9Z"
                                                        fill="white" />
                                                </svg>
                                                <span x-text="$t('Android')">
                                                </span>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" :class="{'!rotate-180': expanded}"
                                                class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                    d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                            </svg>
                                        </button>
                                    </h2>
                                    <div id="faqs-text-01" role="region" aria-labelledby="faqs-title-01"
                                        class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                        :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                        <div class="overflow-hidden">
                                            <div class="p-4 pb-6">
                                                <div class="bg-gray-700 px-4 py-2 rounded-xl mb-6">
                                                    <p x-text="$t('chooseApp')" class="text-sm"></p>
                                                </div>
                                                <div class="flex flex-col gap-y-4">
                                                    <div
                                                        class="text-white bg-gradient-to-r from-slate-500 via-slate-600 to-slate-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            version="1.0" class="w-6 h-6"
                                                                            viewBox="0 0 170.000000 170.000000"
                                                                            preserveAspectRatio="xMidYMid meet">

                                                                            <g transform="translate(0.000000,170.000000) scale(0.100000,-0.100000)"
                                                                                fill="#FFF" stroke="none">
                                                                                <path
                                                                                    d="M230 1385 l0 -75 75 0 75 0 2 -549 3 -549 580 616 c319 338 582 619 583 624 2 4 -86 8 -195 8 l-198 0 -275 -257 -275 -256 -5 254 -5 254 -182 3 -183 2 0 -75z" />
                                                                            </g>
                                                                        </svg>
                                                                        <div
                                                                            class="flex items-center justify-start gap-x-2">
                                                                            <span x-text="$t('addV2rayNG')">
                                                                            </span>
                                                                            <div
                                                                                class="bg-gray-100 pb-1.5 px-2 pt-1 rounded-full">

                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 24 24" fill="currentColor"
                                                                                    class="w-6 h-6 fill-yellow-500 stroke-yellow-500">
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                                                        clip-rule="evenodd" />
                                                                                </svg>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('downloadApp')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                            </h3>
                                                                        </div>
                                                                        <p x-text="$t('clickForDownload')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                        </p>
                                                                        <a href="https://github.com/2dust/v2rayNG/releases/download/1.8.9/v2rayNG_1.8.9.apk"
                                                                            class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                            <span x-text="$t('download')"></span>
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                        </a>
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('addConfigs')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                            </h3>
                                                                        </div>
                                                                        <p x-text="$t('clickForAdd')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                        </p>
                                                                        <a id="android-v2rayng"
                                                                            class="flex mb-4 items-center gap-x-4 w-full bg-stone-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                trigger="loop" delay="2000"
                                                                                colors="primary:#fff">
                                                                            </lord-icon>
                                                                            <span x-text="$t('AddtoApp')"></span>
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                trigger="loop" delay="2000"
                                                                                colors="primary:#fff">
                                                                            </lord-icon>
                                                                        </a>
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/igpsgesd.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('v2rayNGs3')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                            </h3>
                                                                        </div>
                                                                        <p x-text="$t('v2rayNGs3Info')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                        </p>
                                                                        <div
                                                                            class="flex items-center justify start gap-x-4">
                                                                            <div class="flex-1">
                                                                                <img class="rounded-2xl w-full"
                                                                                    src="https://raw.githubusercontent.com/x0sina/marzban-sub/main/1.jpg"
                                                                                    alt="v2rayNG Step 1">
                                                                            </div>
                                                                            <div class="flex-1">
                                                                                <img class="rounded-2xl w-full"
                                                                                    src="https://raw.githubusercontent.com/x0sina/marzban-sub/main/2.jpg"
                                                                                    alt="v2rayNG Step 2">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-white bg-gradient-to-r from-rose-500 via-rose-600 to-rose-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M9.17 1.165C9.07551 0.997296 8.92015 0.872344 8.73609 0.816007C8.55202 0.75967 8.35334 0.776261 8.18117 0.862346C8.009 0.948432 7.87652 1.09742 7.81115 1.27847C7.74578 1.45953 7.75253 1.65878 7.83 1.835L8.667 3.51C8.00017 3.9556 7.42938 4.53028 6.98832 5.20012C6.54726 5.86996 6.24487 6.62137 6.099 7.41L5.99 8H18.01L17.901 7.41C17.7551 6.62137 17.4527 5.86996 17.0117 5.20012C16.5706 4.53028 15.9998 3.9556 15.333 3.51L16.171 1.835C16.258 1.65726 16.2713 1.45232 16.2078 1.26486C16.1444 1.07739 16.0095 0.922596 15.8324 0.834197C15.6553 0.745798 15.4505 0.730964 15.2626 0.792928C15.0746 0.854892 14.9188 0.988631 14.829 1.165L13.992 2.839C13.352 2.61401 12.6784 2.49938 12 2.5C11.3216 2.49938 10.648 2.61401 10.008 2.839L9.17 1.165ZM3.5 9C3.10218 9 2.72064 9.15804 2.43934 9.43934C2.15804 9.72064 2 10.1022 2 10.5V15.5C2 15.8978 2.15804 16.2794 2.43934 16.5607C2.72064 16.842 3.10218 17 3.5 17C3.89782 17 4.27936 16.842 4.56066 16.5607C4.84196 16.2794 5 15.8978 5 15.5V10.5C5 10.1022 4.84196 9.72064 4.56066 9.43934C4.27936 9.15804 3.89782 9 3.5 9ZM20.5 9C20.1022 9 19.7206 9.15804 19.4393 9.43934C19.158 9.72064 19 10.1022 19 10.5V15.5C19 15.8978 19.158 16.2794 19.4393 16.5607C19.7206 16.842 20.1022 17 20.5 17C20.8978 17 21.2794 16.842 21.5607 16.5607C21.842 16.2794 22 15.8978 22 15.5V10.5C22 10.1022 21.842 9.72064 21.5607 9.43934C21.2794 9.15804 20.8978 9 20.5 9ZM18 9H6V17.5C6 17.8978 6.15804 18.2794 6.43934 18.5607C6.72064 18.842 7.10218 19 7.5 19H8V21.5C8 21.8978 8.15804 22.2794 8.43934 22.5607C8.72064 22.842 9.10218 23 9.5 23C9.89782 23 10.2794 22.842 10.5607 22.5607C10.842 22.2794 11 21.8978 11 21.5V19H13V21.5C13 21.8978 13.158 22.2794 13.4393 22.5607C13.7206 22.842 14.1022 23 14.5 23C14.8978 23 15.2794 22.842 15.5607 22.5607C15.842 22.2794 16 21.8978 16 21.5V19H16.5C16.8978 19 17.2794 18.842 17.5607 18.5607C17.842 18.2794 18 17.8978 18 17.5V9Z"
                                                                                fill="white" />
                                                                        </svg>
                                                                        <span x-text="$t('addNekoBox')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('downloadApp')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                            </h3>
                                                                        </div>
                                                                        <p x-text="$t('clickForDownload')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                        </p>
                                                                        <a href="https://github.com/MatsuriDayo/NekoBoxForAndroid/releases/download/1.2.3/NB4A-1.2.3-arm64-v8a.apk"
                                                                            class=" flex mb-4 items-center gap-x-4 w-full
                                                                        bg-gray-800 shadow-md px-3 py-2 rounded-3xl
                                                                        justify-between">
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                            <span x-text="$t('download')"></span>
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                        </a>
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('addConfigs')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                            </h3>
                                                                        </div>
                                                                        <p x-text="$t('clickForAdd')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                        </p>
                                                                        <a id="android-nekobox" class=" flex mb-4 items-center gap-x-4 w-full
                                                                        bg-stone-800 shadow-md px-3 py-2 rounded-3xl
                                                                        justify-between">
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                trigger="loop" delay="2000"
                                                                                colors="primary:#fff">
                                                                            </lord-icon>
                                                                            <span x-text="$t('AddtoApp')"></span>
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                trigger="loop" delay="2000"
                                                                                colors="primary:#fff">
                                                                            </lord-icon>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-white bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg width="28" height="28" viewBox="0 0 28 28"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <g clip-path="url(#clip0_43_2)">
                                                                                <path
                                                                                    d="M13.1804 27.742C12.9792 27.742 12.8083 27.6623 12.6473 27.5637C12.1244 27.2401 11.6014 26.9117 11.0784 26.5833C10.7867 26.4004 10.49 26.2175 10.1983 26.0345C9.75582 25.7577 9.31329 25.481 8.87076 25.1995C8.44332 24.9322 8.01085 24.6601 7.58341 24.3927C7.19619 24.1488 6.80898 23.9002 6.41674 23.6562C6.02953 23.4123 5.64231 23.1731 5.2551 22.9338C4.48571 22.4507 3.71631 21.9675 2.94691 21.4843C2.50941 21.2076 2.06688 20.9308 1.62938 20.654C1.52881 20.5931 1.43326 20.5227 1.33269 20.4664C1.21703 20.4007 1.10137 20.3304 0.980678 20.2741C0.689011 20.138 0.477804 19.927 0.326942 19.669C0.21631 19.486 0.13585 19.289 0.100649 19.0826C0.0855628 18.9935 0.0604192 18.909 0.0352755 18.8246C0.025218 18.8199 0.0151606 18.8152 0.0101318 18.8105C0.0101318 18.7965 0.0101318 18.7824 0.0101318 18.7636C0.0755054 18.7214 0.0755054 18.6745 0.0101318 18.6276C0.0101318 15.358 0.0101318 12.0838 0.0101318 8.81421C0.0805341 8.82359 0.0704765 8.87988 0.080534 8.91741C0.145908 9.15664 0.286712 9.34897 0.497919 9.4897C0.865017 9.73832 1.24217 9.97286 1.6143 10.2121C2.02665 10.4795 2.43901 10.7469 2.85137 11.0142C3.35424 11.3379 3.86214 11.6663 4.36502 11.9899C4.80252 12.2714 5.24002 12.5575 5.68254 12.839C6.20553 13.1767 6.73355 13.5145 7.25654 13.8522C7.77953 14.19 8.29749 14.5277 8.82048 14.8608C9.37364 15.2173 9.92177 15.5691 10.4749 15.9256C10.9074 16.2024 11.3399 16.4791 11.7723 16.7559C11.9031 16.8403 12.0238 16.9295 12.1545 17.0092C12.3506 17.1312 12.5367 17.2719 12.763 17.347C12.8133 17.361 12.8334 17.3892 12.8284 17.4408C12.8233 17.4689 12.8284 17.5018 12.8284 17.5299C12.8284 20.7103 12.8284 23.8908 12.8284 27.0712C12.8284 27.3292 12.929 27.5356 13.1452 27.6951C13.1552 27.7045 13.1653 27.7279 13.1804 27.742Z"
                                                                                    fill="#C6C6C6" />
                                                                                <path
                                                                                    d="M13.1803 27.7421C13.1652 27.7233 13.1552 27.7045 13.1351 27.6905C12.9138 27.5357 12.8182 27.3246 12.8182 27.0666C12.8182 23.8861 12.8182 20.7057 12.8182 17.5253C12.8182 17.4971 12.8182 17.4643 12.8182 17.4361C12.8233 17.3892 12.7981 17.3564 12.7529 17.3423C12.5266 17.272 12.3405 17.1266 12.1444 17.0046C12.0136 16.9248 11.8879 16.8357 11.7622 16.7513C11.3297 16.4745 10.8973 16.1978 10.4648 15.921C9.91164 15.5645 9.3635 15.2127 8.81034 14.8562C8.28736 14.5184 7.7694 14.1807 7.24641 13.8476C6.72342 13.5099 6.1954 13.1721 5.67241 12.8344C5.23491 12.5529 4.79741 12.2668 4.35488 11.9853C3.85201 11.6616 3.34411 11.3333 2.84124 11.0096C2.42888 10.7422 2.01652 10.4749 1.60417 10.2075C1.23204 9.96823 0.854885 9.729 0.487787 9.48507C0.27658 9.34434 0.130747 9.15202 0.0704022 8.91278C0.0603447 8.87525 0.0704023 8.81427 0 8.80958C0 8.72514 0 8.6454 0 8.56096C0.0150862 8.54689 0.0402298 8.53751 0.0452585 8.51874C0.12069 8.26544 0.281609 8.07311 0.507902 7.92769C0.563218 7.89016 0.623563 7.85733 0.678879 7.8198C0.880029 7.68845 1.07615 7.5618 1.2773 7.43046C1.55891 7.2522 1.84052 7.07864 2.12213 6.89569C2.45905 6.67991 2.79095 6.46413 3.12787 6.24835C3.43965 6.05133 3.75144 5.85431 4.05819 5.65729C4.13362 5.61038 4.21911 5.57755 4.26437 5.4978C4.42529 5.601 4.58118 5.70889 4.7421 5.81209C4.9181 5.92468 5.09914 6.03726 5.27514 6.14984C5.29023 6.16391 5.31034 6.17798 5.32543 6.19206C5.35057 6.20613 5.37572 6.2202 5.39583 6.23897C5.42098 6.25304 5.44612 6.26711 5.46623 6.28587C5.50646 6.30933 5.54669 6.33278 5.5819 6.35624C5.59698 6.37031 5.6171 6.38438 5.63218 6.39846C5.65733 6.41253 5.68247 6.4266 5.70259 6.44537C5.76796 6.48289 5.8283 6.52042 5.89368 6.56264C5.90876 6.57671 5.92888 6.59078 5.94396 6.60486C5.98419 6.62831 6.02442 6.65176 6.05963 6.67522C6.07471 6.68929 6.09483 6.70336 6.10991 6.71744C6.11494 6.71744 6.125 6.72213 6.13003 6.72213C6.14511 6.7362 6.16523 6.75027 6.18032 6.76435C6.20546 6.77842 6.2306 6.79249 6.25072 6.81126C6.29095 6.83471 6.33118 6.85816 6.36638 6.88162C6.38147 6.89569 6.40158 6.90976 6.41667 6.92384C6.73851 7.13493 7.06537 7.34602 7.38721 7.55711C7.64368 7.72129 7.90014 7.88547 8.15661 8.04965C8.25215 8.11064 8.3477 8.17162 8.44325 8.2326C8.45833 8.24667 8.47845 8.26074 8.49353 8.27482C8.51868 8.28889 8.53879 8.30296 8.56394 8.32173C8.56896 8.32173 8.57902 8.32642 8.58405 8.32642C8.59914 8.34049 8.61925 8.35456 8.63434 8.36864C8.64942 8.37802 8.66451 8.3874 8.6796 8.39209C8.69468 8.40616 8.7148 8.42024 8.72988 8.43431C8.73491 8.43431 8.74497 8.439 8.75 8.439C8.76509 8.45307 8.7852 8.46714 8.80029 8.48122C8.82543 8.49529 8.84555 8.50936 8.87069 8.52813C8.89583 8.5422 8.92098 8.55627 8.94109 8.57503C8.97126 8.59849 9.00646 8.61725 9.03664 8.64071C9.06178 8.65478 9.0819 8.66885 9.10704 8.68762C9.13218 8.70169 9.15733 8.71576 9.17744 8.72983C9.23276 8.76736 9.2931 8.80489 9.34842 8.84242C9.37356 8.85649 9.39368 8.87056 9.41882 8.88933C9.44396 8.9034 9.46911 8.91747 9.48922 8.93623C9.51437 8.95031 9.53951 8.96907 9.55963 8.98314C9.56968 8.98783 9.57471 8.99722 9.58477 9.00191C9.60991 9.01598 9.63003 9.03005 9.65517 9.04882C9.68032 9.06289 9.70546 9.08165 9.72557 9.09573C9.75575 9.11918 9.79095 9.14263 9.82112 9.1614C9.99713 9.27398 10.1731 9.39125 10.3491 9.50383C10.3894 9.52729 10.4296 9.54605 10.4698 9.56951C10.4849 9.58358 10.505 9.59765 10.5201 9.61172C10.5453 9.6258 10.5704 9.63987 10.5905 9.65863C10.6207 9.71023 10.671 9.73838 10.7363 9.74776C10.7464 9.75245 10.7514 9.76183 10.7615 9.76652C10.7866 9.7806 10.8068 9.79467 10.8319 9.81343C10.857 9.82751 10.8822 9.84158 10.9023 9.86034C10.9325 9.8838 10.9677 9.90256 10.9978 9.92601C11.0481 9.95416 11.0934 9.987 11.1437 10.0151C11.1688 10.0292 11.194 10.0433 11.2141 10.0621C11.2443 10.0855 11.2795 10.1043 11.3096 10.1277C11.3348 10.1418 11.3549 10.1559 11.38 10.1746C11.4052 10.1887 11.4303 10.2028 11.4504 10.2215C11.4756 10.2356 11.4957 10.2544 11.5208 10.2685C11.5359 10.2778 11.551 10.2825 11.5661 10.2919C11.5812 10.306 11.6013 10.3201 11.6164 10.3341C11.6415 10.3482 11.6667 10.3623 11.6868 10.381C11.7119 10.3951 11.732 10.4092 11.7572 10.4279C11.7874 10.4467 11.8175 10.4608 11.8477 10.4795C11.8578 10.4842 11.8678 10.4936 11.8728 10.4983C11.8879 10.5124 11.908 10.5265 11.9231 10.5405C11.9483 10.5546 11.9734 10.5687 11.9935 10.5874C12.0237 10.6109 12.0589 10.6297 12.0891 10.6531C12.1142 10.6672 12.1394 10.6859 12.1645 10.7C12.1897 10.7141 12.2098 10.7282 12.2349 10.7469C12.2399 10.7469 12.25 10.7469 12.255 10.7516C12.2701 10.7657 12.2902 10.7798 12.3053 10.7938C12.3305 10.8079 12.3556 10.822 12.3757 10.8407C12.3908 10.8501 12.4059 10.8548 12.421 10.8642C12.4361 10.8783 12.4562 10.8923 12.4713 10.9064C12.4964 10.9205 12.5216 10.9346 12.5417 10.9533C12.5668 10.9674 12.592 10.9862 12.6121 11.0002C12.6372 11.0143 12.6624 11.0284 12.6825 11.0471C12.7076 11.0612 12.7328 11.0753 12.7529 11.094C12.7629 11.1034 12.768 11.1081 12.778 11.1175C12.8032 11.1316 12.8283 11.1456 12.8484 11.1644C12.8736 11.1785 12.8987 11.1926 12.9188 11.2113C12.949 11.2348 12.9842 11.2535 13.0144 11.277C13.0194 11.277 13.0295 11.277 13.0345 11.2817C13.0496 11.2958 13.0697 11.3098 13.0848 11.3239C13.1099 11.338 13.1351 11.352 13.1552 11.3708C13.1803 11.3849 13.2055 11.399 13.2256 11.4177C13.2407 11.4271 13.2557 11.4365 13.2708 11.4412C13.2859 11.4552 13.306 11.4693 13.3211 11.4834C13.3261 11.4834 13.3362 11.4881 13.3412 11.4881C13.3563 11.5022 13.3764 11.5162 13.3915 11.5303C13.4167 11.5444 13.4418 11.5584 13.4619 11.5772C13.4871 11.5913 13.5072 11.6054 13.5323 11.6241C13.5625 11.6476 13.5977 11.6663 13.6279 11.6898C13.653 11.7039 13.6782 11.7179 13.7033 11.7367C13.7284 11.7508 13.7486 11.7648 13.7737 11.7836C13.8139 11.8446 13.8743 11.8774 13.9447 11.8962C13.9497 11.8962 13.9598 11.9009 13.9648 11.9009C13.9799 11.915 14 11.929 14.0151 11.9431C14.0402 11.9572 14.0654 11.9712 14.0855 11.99C14.1509 12.0275 14.2112 12.0651 14.2766 12.1073C14.2917 12.1214 14.3118 12.1354 14.3269 12.1495C14.352 12.1636 14.3721 12.1776 14.3973 12.1964C14.4224 12.2105 14.4476 12.2246 14.4677 12.2433C14.4978 12.2668 14.533 12.2855 14.5632 12.309C14.5884 12.3231 14.6135 12.3371 14.6336 12.3559C14.6588 12.37 14.6839 12.384 14.704 12.4028C14.7292 12.4169 14.7543 12.431 14.7744 12.4497C14.7895 12.4591 14.8046 12.4638 14.8197 12.4732C14.8348 12.4872 14.8549 12.5013 14.87 12.5154C14.8951 12.5295 14.9203 12.5435 14.9404 12.5623C14.9655 12.5764 14.9856 12.5904 15.0108 12.6092C15.0409 12.6327 15.0761 12.6514 15.1063 12.6749C15.1113 12.6749 15.1214 12.6796 15.1264 12.6796C15.1415 12.6936 15.1616 12.7077 15.1767 12.7218C15.2019 12.7359 15.227 12.7499 15.2471 12.7687C15.2723 12.7828 15.2924 12.7968 15.3175 12.8156C15.3326 12.825 15.3477 12.8297 15.3628 12.8391C15.3728 12.886 15.4181 12.8954 15.4583 12.9047C15.4935 12.9282 15.5237 12.947 15.5589 12.9704C15.584 12.9845 15.6092 12.9986 15.6293 13.0126C15.6846 13.0502 15.745 13.0877 15.8003 13.1252C15.8254 13.1393 15.8455 13.1534 15.8707 13.1674C15.8958 13.1815 15.921 13.2003 15.9411 13.2143C15.9662 13.2284 15.9914 13.2425 16.0115 13.2612C16.0215 13.2706 16.0266 13.2753 16.0366 13.2847C16.0618 13.2988 16.0819 13.3128 16.107 13.3316C16.1322 13.3457 16.1573 13.3644 16.1774 13.3785C16.2026 13.3926 16.2227 13.4114 16.2478 13.4254C16.3283 13.477 16.4088 13.5286 16.4892 13.5802C16.5295 13.6365 16.5898 13.674 16.6602 13.6928C16.6652 13.6928 16.6753 13.6975 16.6803 13.6975C16.6954 13.7116 16.7155 13.7256 16.7306 13.7397C16.7356 13.7397 16.7457 13.7444 16.7507 13.7444C16.7658 13.7585 16.7859 13.7726 16.801 13.7866C16.806 13.7866 16.8161 13.7866 16.8211 13.7913C16.8261 13.8335 16.8513 13.857 16.8965 13.857C16.9016 13.857 16.9116 13.8617 16.9167 13.8617C16.9318 13.8758 16.9519 13.8898 16.967 13.9039C16.9921 13.918 17.0122 13.932 17.0374 13.9508C17.0625 13.9649 17.0876 13.979 17.1078 13.9977C17.148 14.0212 17.1882 14.0446 17.2234 14.0681C17.2385 14.0822 17.2586 14.0962 17.2737 14.1103C17.2838 14.115 17.2888 14.1244 17.2988 14.1291C17.3139 14.1384 17.329 14.1478 17.3491 14.1525C17.3743 14.1666 17.3994 14.1854 17.4195 14.1994C17.4447 14.2135 17.4648 14.2323 17.4899 14.2463C17.5251 14.2698 17.5553 14.2886 17.5905 14.312C17.6157 14.3261 17.6408 14.3402 17.6609 14.3589C17.6861 14.373 17.7112 14.3871 17.7313 14.4058C17.7615 14.4293 17.7967 14.4527 17.8269 14.4715C17.8772 14.4996 17.9224 14.5325 17.9727 14.5606C17.9978 14.5747 18.023 14.5888 18.0431 14.6075C18.0833 14.6638 18.1437 14.7014 18.2141 14.7201C18.2392 14.7342 18.2644 14.753 18.2845 14.767C18.3297 14.8046 18.38 14.8421 18.4253 14.8796C18.4404 14.8796 18.4504 14.8796 18.4655 14.8796C18.4705 14.8937 18.4705 14.9078 18.4756 14.9218C18.4705 14.9312 18.4655 14.9359 18.4555 14.9453C18.3247 15.0297 18.194 15.1188 18.0632 15.2033C17.7715 15.3909 17.4849 15.5786 17.1932 15.7662C16.5647 16.1743 15.9361 16.5824 15.3024 16.9858C15.1013 17.1172 14.9052 17.2532 14.694 17.3658C14.5934 17.4221 14.5682 17.4737 14.5682 17.5769C14.5733 18.7449 14.5682 19.9083 14.5682 21.0763C14.5682 23.084 14.5682 25.0917 14.5682 27.0947C14.5682 27.2683 14.528 27.4278 14.4274 27.5732C14.2766 27.7984 14.0503 27.9156 13.7737 27.9532C13.7385 27.9578 13.6983 27.9532 13.6932 28.0001C13.4871 27.9954 13.2809 27.9719 13.0948 27.8875C13.2256 27.7937 13.2055 27.7655 13.1803 27.7421Z"
                                                                                    fill="#EFEFEF" />
                                                                                <path
                                                                                    d="M14.1207 0.00938175C14.1258 0.0422181 14.1459 0.0515999 14.176 0.0562908C14.4074 0.0844362 14.6286 0.1548 14.8398 0.248618C14.9555 0.300218 15.0611 0.36589 15.1667 0.431563C15.5288 0.652035 15.8858 0.877199 16.2479 1.10236C17.0424 1.59491 17.8319 2.09214 18.6265 2.58469C18.9282 2.77232 19.2299 2.96465 19.5316 3.15698C20.2156 3.58385 20.8944 4.00603 21.5783 4.4329C22.5992 5.07087 23.62 5.70883 24.6408 6.34679C25.4203 6.83464 26.2048 7.3225 26.9842 7.81035C27.2357 7.96515 27.4117 8.16686 27.4921 8.43893C27.5022 8.47177 27.5022 8.50461 27.5072 8.53744C27.4972 8.57497 27.4871 8.60781 27.4871 8.64533C27.4821 8.88457 27.3765 9.08628 27.2055 9.25984C27.0647 9.40057 26.8887 9.49908 26.7177 9.60697C26.1545 9.97286 25.5913 10.3341 25.0331 10.6999C24.8118 10.8454 24.5906 10.9908 24.3643 11.1362C24.1028 11.3051 23.8362 11.4739 23.5697 11.6428C23.5345 11.6663 23.4893 11.671 23.449 11.685C23.3987 11.6522 23.3535 11.6194 23.3032 11.5865C23.0316 11.4083 22.7601 11.23 22.4835 11.0565C22.0259 10.7609 21.5633 10.4701 21.1056 10.1746C20.5776 9.84151 20.0496 9.50846 19.5216 9.17541C19.1545 8.94086 18.7824 8.71101 18.4153 8.48115C17.8521 8.12464 17.2838 7.77283 16.7156 7.41632C15.4332 6.61886 14.1459 5.82141 12.8635 5.02396C12.3607 4.70967 11.8578 4.39538 11.3499 4.08578C11.0029 3.86999 10.6509 3.6589 10.3039 3.44781C9.97202 3.2461 9.64013 3.0444 9.3032 2.84269C9.16743 2.75825 9.03165 2.67381 8.89587 2.58938C8.92605 2.56592 8.95119 2.53778 8.98639 2.51432C9.25794 2.33607 9.52949 2.16251 9.80607 1.98894C10.2939 1.67934 10.7816 1.36505 11.2745 1.05545C11.4253 0.956944 11.5812 0.867817 11.7321 0.769308C11.9735 0.614508 12.2098 0.459708 12.4512 0.304909C12.5266 0.258 12.6071 0.211091 12.6926 0.182945C12.8585 0.131345 13.0295 0.0891271 13.1954 0.0422181C13.2156 0.0375272 13.2256 0.0140727 13.2407 0C13.5424 0.0093818 13.8291 0.00938175 14.1207 0.00938175Z"
                                                                                    fill="#EFEFEF" />
                                                                                <path
                                                                                    d="M0.00500488 18.6229C0.0703784 18.6698 0.0703784 18.7167 0.00500488 18.759C0.00500488 18.7167 0.00500488 18.6698 0.00500488 18.6229Z"
                                                                                    fill="#E2E4E4" />
                                                                                <path
                                                                                    d="M0.00500488 18.8058C0.0150624 18.8105 0.0251198 18.8152 0.0301486 18.8199C0.0200911 18.8199 0.0100336 18.8245 0.00500488 18.8245C0.00500488 18.8199 0.00500488 18.8105 0.00500488 18.8058Z"
                                                                                    fill="#E2E4E4" />
                                                                                <path
                                                                                    d="M23.459 11.4224C23.4992 11.4083 23.5445 11.3989 23.5797 11.3802C23.8462 11.2113 24.1077 11.0424 24.3742 10.8735C24.5955 10.7281 24.8218 10.5827 25.0431 10.4373C25.6063 10.0714 26.1645 9.70551 26.7277 9.34431C26.8936 9.23642 27.0747 9.1426 27.2155 8.99718C27.3865 8.82362 27.487 8.62191 27.4971 8.38267C27.4971 8.34514 27.5122 8.31231 27.5172 8.27478C27.5675 8.27478 27.6228 8.27478 27.6731 8.27478C27.8692 8.27478 27.9849 8.37329 28 8.56092C28 8.58907 28 8.61253 28 8.64067C28 11.9384 28 15.2361 28 18.5291C28 18.6557 27.9798 18.7777 27.9446 18.9044C27.8994 19.0451 27.8843 19.1952 27.834 19.3359C27.7737 19.5048 27.7083 19.6784 27.5977 19.8332C27.4418 20.0489 27.2456 20.2178 27.0244 20.3679C27.0093 20.3773 26.9992 20.3867 26.9842 20.3914C26.783 20.4571 26.6221 20.5837 26.4511 20.6869C26.2349 20.8183 26.0237 20.959 25.8125 21.0997C25.6867 21.1795 25.561 21.2545 25.4353 21.3343C25.1135 21.536 24.7967 21.7424 24.4748 21.9441C24.2234 22.1036 23.9719 22.2631 23.7205 22.4179C23.5294 22.5351 23.3383 22.6477 23.1472 22.765C22.9763 22.8682 22.8153 22.9808 22.6444 23.0887C22.4181 23.2294 22.1968 23.3748 21.9705 23.5155C21.7492 23.6563 21.528 23.7923 21.3067 23.933C21.0905 24.069 20.8692 24.2051 20.6479 24.3411C20.4367 24.4725 20.2356 24.6226 20.0143 24.7445C19.8182 24.8477 19.6472 24.9838 19.4612 25.0917C19.1997 25.2465 18.9533 25.4153 18.6968 25.5748C18.5761 25.6499 18.4504 25.7249 18.3247 25.8C18.0481 25.9736 17.7765 26.1518 17.505 26.3207C17.3441 26.4192 17.1831 26.513 17.0222 26.6162C16.7959 26.7569 16.5696 26.907 16.3434 27.0478C16.2478 27.1088 16.1472 27.1604 16.0517 27.2213C15.9159 27.3058 15.7902 27.4043 15.6494 27.4793C15.4633 27.5872 15.2773 27.6951 15.0811 27.7936C14.8649 27.8968 14.6487 27.9484 14.4123 27.9344C14.2162 27.925 14.0251 27.8781 13.8893 27.7233C13.8742 27.7045 13.8642 27.6857 13.8541 27.667C13.8592 27.6201 13.8994 27.6248 13.9346 27.6201C14.2112 27.5825 14.4324 27.4653 14.5883 27.2401C14.6889 27.0947 14.7291 26.9352 14.7291 26.7616C14.7291 24.7539 14.7291 22.7462 14.7291 20.7432C14.7291 19.5752 14.7291 18.4118 14.7291 17.2438C14.7291 17.1453 14.7543 17.089 14.8548 17.0327C15.0661 16.9201 15.2622 16.7841 15.4633 16.6527C16.0919 16.2446 16.7205 15.8412 17.3541 15.4331C17.6458 15.2455 17.9324 15.0578 18.2241 14.8702C18.3548 14.7858 18.4856 14.6966 18.6163 14.6122C18.6264 14.6122 18.6365 14.6122 18.6415 14.6122C18.6918 14.6591 18.6867 14.7201 18.6867 14.7811C18.6867 15.6489 18.6918 16.5167 18.6918 17.3845C18.7421 17.6003 18.7622 17.8255 18.8979 18.0178C18.9683 18.121 19.0689 18.1679 19.1745 18.2054C19.3505 18.2664 19.5316 18.2242 19.6975 18.1632C19.9741 18.06 20.2205 17.9099 20.4669 17.7551C20.5675 17.6941 20.663 17.6284 20.7686 17.5721C20.9296 17.4783 21.0905 17.3892 21.2464 17.2954C21.4023 17.2016 21.5581 17.1031 21.714 17.0045C21.7241 16.9999 21.7392 16.9999 21.7492 16.9952C21.7543 17.0186 21.7643 17.0421 21.7744 17.0702C21.8046 17.0561 21.8196 17.0515 21.8398 17.0421C22.1616 16.831 22.4834 16.6246 22.8002 16.4135C22.9561 16.3103 23.102 16.193 23.2277 16.057C23.3433 15.935 23.4389 15.8037 23.4992 15.6489C23.5797 15.4378 23.6048 15.2173 23.6048 15.0015C23.6099 13.9508 23.6099 12.9047 23.6048 11.8539C23.6048 11.7742 23.5898 11.6991 23.5797 11.6194C23.5747 11.6006 23.5495 11.5866 23.5344 11.5678C23.5244 11.5443 23.5143 11.5256 23.4992 11.5021C23.4842 11.4693 23.4691 11.4458 23.459 11.4224Z"
                                                                                    fill="#C6C6C6" />
                                                                                <path
                                                                                    d="M4.27447 5.50712C4.24932 5.48836 4.25435 5.47429 4.27949 5.45552C4.39013 5.38516 4.49573 5.3148 4.60636 5.24443C5.14947 4.89262 5.69257 4.5408 6.23567 4.18898C6.55248 3.98258 6.86929 3.77149 7.19113 3.56509C7.23136 3.54164 7.27159 3.52287 7.31685 3.49942C7.35205 3.49942 7.38725 3.49942 7.38725 3.45251C7.42748 3.43844 7.47274 3.43374 7.50794 3.41498C7.66383 3.32585 7.81972 3.23204 7.98064 3.14291C8.00076 3.13353 8.0259 3.12884 8.05105 3.12415C8.05607 3.12884 8.05607 3.13822 8.0611 3.14291C7.65378 3.40091 7.24142 3.65422 6.81398 3.9216C6.88438 3.96382 6.92964 3.99665 6.97993 4.0248C7.24645 4.19367 7.518 4.36254 7.78452 4.53142C7.92533 4.62054 8.06613 4.70029 8.20694 4.78942C8.34774 4.87854 8.48855 4.97236 8.63438 5.06149C8.8305 5.18345 9.03165 5.30072 9.22777 5.42269C9.56972 5.63847 9.90665 5.85894 10.2486 6.07472C10.5202 6.2436 10.7967 6.41247 11.0733 6.58134C11.5762 6.89094 12.074 7.20054 12.5719 7.51014C12.8384 7.67432 13.1049 7.84319 13.3714 8.00737C13.7788 8.26068 14.1911 8.51868 14.5985 8.77199C14.86 8.93148 15.1164 9.09566 15.3779 9.25515C16.2077 9.77115 17.0374 10.2918 17.8621 10.8078C18.5309 11.2253 19.1947 11.6475 19.8635 12.0697C20.2608 12.323 20.6581 12.5716 21.0554 12.8296C21.1509 12.8906 21.2414 12.9657 21.337 13.036C21.3169 13.0548 21.3018 13.0735 21.2766 13.0876C21.0956 13.2049 20.9146 13.3175 20.7335 13.4347C20.3664 13.674 20.0044 13.9179 19.6373 14.1571C19.4059 14.3073 19.1796 14.4527 18.9483 14.6028C18.8427 14.6685 18.7321 14.7341 18.6265 14.7951C18.6114 14.7951 18.6013 14.7951 18.5862 14.7951C18.5712 14.7247 18.5259 14.6825 18.4454 14.6825C18.4203 14.6685 18.3952 14.6497 18.375 14.6356C18.3499 14.5606 18.2845 14.5324 18.2041 14.523C18.199 14.4808 18.1689 14.4761 18.1337 14.4761C18.0834 14.448 18.0381 14.4151 17.9878 14.387C17.9828 14.3307 17.9426 14.3166 17.8923 14.3213C17.8873 14.2791 17.8571 14.2744 17.8219 14.2744C17.8169 14.2322 17.7867 14.2322 17.7515 14.2275C17.7163 14.2041 17.6861 14.1853 17.6509 14.1618C17.6509 14.1149 17.6157 14.1149 17.5805 14.1149C17.5554 14.1009 17.5302 14.0821 17.5101 14.068C17.5051 14.0446 17.5 14.0164 17.4598 14.0446C17.4498 14.0399 17.4447 14.0305 17.4347 14.0258C17.4196 14.0117 17.3995 13.9977 17.3844 13.9836C17.3441 13.9601 17.3039 13.9367 17.2687 13.9132C17.2637 13.871 17.2335 13.8663 17.1983 13.8663C17.1933 13.8241 17.1631 13.8194 17.1279 13.8194C17.1128 13.8053 17.0927 13.7913 17.0776 13.7772C17.0726 13.7772 17.0625 13.7772 17.0575 13.7725C17.0525 13.7303 17.0273 13.7068 16.9821 13.7068C16.9771 13.7068 16.967 13.7068 16.962 13.7021C16.9469 13.6881 16.9268 13.674 16.9117 13.6599C16.9066 13.6599 16.8966 13.6599 16.8916 13.6552C16.8765 13.6411 16.8564 13.6271 16.8413 13.613C16.8362 13.613 16.8262 13.613 16.8212 13.6083C16.796 13.5333 16.7306 13.5051 16.6502 13.4957C16.5697 13.4441 16.4893 13.3925 16.4088 13.3409C16.4088 13.294 16.3736 13.294 16.3384 13.294C16.3133 13.2799 16.2881 13.2612 16.268 13.2471C16.263 13.2049 16.2328 13.2049 16.1976 13.2002C16.1875 13.1908 16.1825 13.1861 16.1725 13.1767C16.1725 13.1298 16.1373 13.1298 16.1021 13.1298C16.0769 13.1158 16.0518 13.097 16.0316 13.0829C16.0266 13.0407 15.9964 13.0407 15.9612 13.0407C15.9059 13.0032 15.8456 12.9657 15.7903 12.9281C15.7852 12.8859 15.7551 12.8859 15.7199 12.8859C15.6847 12.8625 15.6545 12.8437 15.6193 12.8202C15.6143 12.7639 15.569 12.7593 15.5237 12.7546C15.5087 12.7452 15.4936 12.7405 15.4785 12.7311C15.4785 12.6842 15.4433 12.6842 15.4081 12.6842C15.3829 12.6701 15.3578 12.6561 15.3377 12.6373C15.3226 12.6232 15.3025 12.6092 15.2874 12.5951C15.2824 12.5951 15.2723 12.5951 15.2673 12.5904C15.2623 12.5341 15.222 12.5247 15.1717 12.5247C15.1667 12.4825 15.1365 12.4778 15.1013 12.4778C15.0762 12.4637 15.051 12.4497 15.0309 12.4309C15.0158 12.4168 14.9957 12.4027 14.9806 12.3887C14.9656 12.3793 14.9505 12.3746 14.9354 12.3652C14.9354 12.3183 14.9002 12.3183 14.865 12.3183C14.86 12.2761 14.8298 12.2714 14.7946 12.2714C14.7896 12.2292 14.7594 12.2292 14.7242 12.2245C14.7191 12.1682 14.6789 12.1541 14.6286 12.1588C14.6035 12.1448 14.5783 12.1307 14.5582 12.1119C14.5532 12.0697 14.523 12.0697 14.4878 12.065C14.4727 12.0509 14.4526 12.0369 14.4375 12.0228C14.3722 11.9853 14.3118 11.9477 14.2464 11.9055C14.2414 11.8633 14.2112 11.8633 14.176 11.8586C14.161 11.8445 14.1408 11.8305 14.1258 11.8164C14.1207 11.8164 14.1107 11.8164 14.1056 11.8117C14.0805 11.7366 14.0151 11.7085 13.9347 11.6991C13.9296 11.6569 13.8995 11.6522 13.8643 11.6522C13.8391 11.6381 13.814 11.6241 13.7888 11.6053C13.7838 11.549 13.7436 11.5349 13.6933 11.5396C13.6933 11.4974 13.6581 11.4927 13.6229 11.4927C13.5977 11.4786 13.5726 11.4646 13.5525 11.4458C13.5374 11.4317 13.5173 11.4177 13.5022 11.4036C13.4972 11.4036 13.4871 11.4036 13.4821 11.3989C13.467 11.3848 13.4469 11.3708 13.4318 11.3567C13.4167 11.3473 13.4016 11.3379 13.3865 11.3332C13.3815 11.291 13.3513 11.2863 13.3161 11.2863C13.3111 11.2441 13.2809 11.2441 13.2457 11.2394C13.2306 11.2253 13.2105 11.2113 13.1954 11.1972C13.1904 11.1972 13.1804 11.1972 13.1753 11.1925C13.1703 11.1362 13.1301 11.1221 13.0798 11.1268C13.0748 11.0846 13.0446 11.0799 13.0094 11.0799C13.0044 11.0377 12.9742 11.0377 12.939 11.033C12.9289 11.0236 12.9239 11.0189 12.9138 11.0096C12.9138 10.9626 12.8786 10.9626 12.8434 10.9626C12.8434 10.9157 12.8082 10.9157 12.773 10.9157C12.7479 10.9017 12.7227 10.8829 12.7026 10.8688C12.6976 10.8266 12.6624 10.8266 12.6322 10.8219C12.6171 10.8078 12.597 10.7938 12.5819 10.7797C12.5669 10.7703 12.5518 10.7656 12.5367 10.7562C12.5367 10.7093 12.5015 10.7093 12.4663 10.7093C12.4512 10.6953 12.4311 10.6812 12.416 10.6671C12.411 10.6671 12.4009 10.6671 12.3959 10.6624C12.3908 10.6202 12.3607 10.6202 12.3255 10.6155C12.3003 10.6014 12.2752 10.5827 12.25 10.5686C12.245 10.5123 12.2048 10.5029 12.1545 10.5029C12.1495 10.4607 12.1193 10.456 12.0841 10.456C12.069 10.442 12.0489 10.4279 12.0338 10.4138C12.0237 10.4091 12.0137 10.3997 12.0087 10.395C11.9986 10.3434 11.9584 10.3434 11.9181 10.3434C11.9181 10.2965 11.8829 10.2965 11.8477 10.2965C11.8427 10.2543 11.8125 10.2496 11.7773 10.2496C11.7623 10.2356 11.7421 10.2215 11.7271 10.2074C11.712 10.198 11.6969 10.1933 11.6818 10.184C11.6818 10.137 11.6466 10.137 11.6114 10.137C11.6064 10.0948 11.5762 10.0901 11.541 10.0901C11.536 10.0479 11.5058 10.0432 11.4706 10.0432C11.4656 9.98694 11.4253 9.97286 11.375 9.97755C11.375 9.93064 11.3398 9.93064 11.3046 9.93064C11.2544 9.9025 11.2091 9.86966 11.1588 9.84152C11.1538 9.78523 11.1135 9.77115 11.0633 9.77585C11.0633 9.72894 11.0281 9.72894 10.9929 9.72894C10.9878 9.68672 10.9577 9.68672 10.9225 9.68203C10.9124 9.67734 10.9074 9.66795 10.8973 9.66326C10.8722 9.60228 10.8219 9.57414 10.7515 9.57414C10.7464 9.52723 10.7163 9.52723 10.6811 9.52723C10.666 9.51315 10.6459 9.49908 10.6308 9.48501C10.5906 9.46155 10.5453 9.44748 10.5101 9.41934C10.3341 9.30675 10.1581 9.18948 9.98208 9.0769C9.97705 9.02061 9.93682 9.00654 9.88653 9.01123C9.86139 8.99716 9.83625 8.97839 9.81613 8.96432C9.8111 8.9221 9.78093 8.9221 9.74573 8.91741C9.73567 8.91272 9.73064 8.90334 9.72059 8.89865C9.72059 8.85174 9.68539 8.85174 9.65018 8.85174C9.64516 8.80483 9.61498 8.80483 9.57978 8.80483C9.57475 8.76261 9.54458 8.75792 9.50938 8.75792C9.45406 8.72039 9.39372 8.68286 9.3384 8.64534C9.33337 8.60312 9.3032 8.60312 9.268 8.60312C9.26297 8.5609 9.2328 8.5609 9.1976 8.55621C9.19257 8.49992 9.15234 8.48585 9.10205 8.49054C9.09702 8.44363 9.06685 8.44363 9.03165 8.44363C9.02662 8.40141 8.99645 8.39672 8.96125 8.39672C8.94616 8.38265 8.92605 8.36857 8.91096 8.3545C8.90593 8.3545 8.89587 8.3545 8.89084 8.34981C8.87576 8.33574 8.85564 8.32167 8.84056 8.30759C8.82547 8.29821 8.81039 8.28883 8.7953 8.28414C8.78021 8.27007 8.7601 8.25599 8.74501 8.24192C8.73998 8.24192 8.72992 8.24192 8.7249 8.23723C8.71987 8.19501 8.6897 8.19501 8.65449 8.19032C8.63941 8.17625 8.61929 8.16217 8.60421 8.1481C8.50866 8.08712 8.41312 8.02614 8.31757 7.96516C8.0611 7.80097 7.80464 7.63679 7.54817 7.47261C7.22633 7.26152 6.89947 7.05043 6.57763 6.83934C6.56254 6.82527 6.54243 6.81119 6.52734 6.79712C6.48711 6.77367 6.44688 6.75021 6.41168 6.72676C6.40665 6.68454 6.37648 6.67985 6.34128 6.67985C6.32619 6.66578 6.30607 6.6517 6.29099 6.63763C6.28596 6.63763 6.2759 6.63294 6.27087 6.63294C6.25579 6.61887 6.23567 6.60479 6.22059 6.59072C6.18036 6.56727 6.14013 6.54381 6.10493 6.52036C6.08984 6.50629 6.06972 6.49221 6.05464 6.47814C5.98926 6.44061 5.92892 6.40309 5.86355 6.36087C5.85852 6.31865 5.82834 6.31865 5.79314 6.31396C5.77806 6.29989 5.75794 6.28581 5.74286 6.27174C5.70263 6.24829 5.6624 6.22483 5.6272 6.20138C5.62217 6.15916 5.59199 6.15447 5.55679 6.15447C5.55176 6.11225 5.51656 6.11225 5.48639 6.10756C5.4713 6.09349 5.45119 6.07941 5.4361 6.06534C5.2601 5.95276 5.07906 5.84018 4.90306 5.7276C4.59128 5.71821 4.43538 5.61032 4.27447 5.50712Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M18.6213 14.7997C18.7269 14.7341 18.8376 14.6731 18.9432 14.6074C19.1745 14.462 19.4058 14.3119 19.6321 14.1618C19.9992 13.9225 20.3613 13.6786 20.7284 13.4394C20.9094 13.3221 21.0904 13.2095 21.2715 13.0922C21.2916 13.0782 21.3117 13.0594 21.3318 13.0406C21.367 13.0641 21.4073 13.0782 21.4374 13.1063C21.4777 13.1438 21.5179 13.1626 21.5732 13.1532C21.5782 13.1673 21.5782 13.1861 21.5883 13.1954C21.7241 13.3127 21.7442 13.4628 21.7442 13.627C21.7442 14.8326 21.7442 16.0428 21.7442 17.2484C21.7341 17.2531 21.719 17.2484 21.709 17.2578C21.5531 17.3563 21.3972 17.4548 21.2413 17.5486C21.0854 17.6424 20.9245 17.7316 20.7636 17.8254C20.663 17.8864 20.5624 17.9473 20.4619 18.0083C20.2154 18.1631 19.969 18.3179 19.6925 18.4164C19.5265 18.4774 19.3404 18.5196 19.1695 18.4586C19.0689 18.4211 18.9683 18.3742 18.8929 18.271C18.7571 18.074 18.732 17.8535 18.6867 17.6377C18.6867 16.7699 18.6817 15.9021 18.6817 15.0343C18.6817 14.9733 18.6867 14.9123 18.6364 14.8654C18.6314 14.856 18.6314 14.8513 18.6264 14.842C18.6264 14.8279 18.6213 14.8138 18.6213 14.7997Z"
                                                                                    fill="#9F9F9F" />
                                                                                <path
                                                                                    d="M18.199 14.5278C18.2744 14.5372 18.3398 14.5607 18.37 14.6404C18.2995 14.6216 18.2392 14.5888 18.199 14.5278Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M16.63 13.5145C16.7054 13.5239 16.7708 13.5474 16.801 13.6271C16.7306 13.6083 16.6702 13.5755 16.63 13.5145Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M13.8794 11.7366C13.9548 11.746 14.0202 11.7694 14.0504 11.8492C13.98 11.8257 13.9196 11.7976 13.8794 11.7366Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M18.4404 14.6871C18.5209 14.6871 18.5661 14.7294 18.5812 14.7997C18.536 14.7622 18.4857 14.7247 18.4404 14.6871Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M10.6459 9.64453C10.7163 9.64453 10.7666 9.67268 10.7917 9.73366C10.7263 9.72428 10.676 9.69613 10.6459 9.64453Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M8.98132 8.56091C9.03161 8.56091 9.07184 8.5703 9.07687 8.62659C9.0467 8.60782 9.0115 8.58437 8.98132 8.56091Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M12.069 10.564C12.1193 10.564 12.1595 10.5733 12.1645 10.6296C12.1343 10.6109 12.1042 10.5874 12.069 10.564Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M10.9575 9.84619C11.0078 9.84619 11.048 9.85557 11.0531 9.91186C11.0229 9.88841 10.9927 9.86965 10.9575 9.84619Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M13.6379 11.577C13.6882 11.577 13.7285 11.5864 13.7335 11.6427C13.7033 11.6239 13.6681 11.6005 13.6379 11.577Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M17.8822 14.3259C17.9325 14.3259 17.9727 14.3353 17.9777 14.3916C17.9476 14.3681 17.9174 14.3494 17.8822 14.3259Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M11.2744 10.048C11.3247 10.048 11.3649 10.0574 11.37 10.1136C11.3398 10.0949 11.3046 10.0714 11.2744 10.048Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M15.4935 12.7733C15.5388 12.778 15.584 12.7827 15.5891 12.839C15.5488 12.8296 15.5036 12.8249 15.4935 12.7733Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.77588 9.08154C9.82617 9.08154 9.8664 9.09092 9.87142 9.14722C9.84125 9.12376 9.81108 9.105 9.77588 9.08154Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M15.1315 12.5482C15.1818 12.5482 15.222 12.5576 15.227 12.6139C15.1968 12.5904 15.1667 12.567 15.1315 12.5482Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.5784 12.1869C14.6287 12.1869 14.6689 12.1963 14.6739 12.2526C14.6437 12.2291 14.6136 12.2103 14.5784 12.1869Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M13.0094 11.1737C13.0597 11.1737 13.0999 11.1831 13.1049 11.2394C13.0748 11.2206 13.0446 11.1972 13.0094 11.1737Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M16.9669 13.7208C17.0122 13.7208 17.0373 13.7443 17.0423 13.7865C16.9921 13.7818 16.9719 13.7584 16.9669 13.7208Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M11.8276 10.4092C11.8679 10.4092 11.9131 10.4092 11.9182 10.4608C11.888 10.442 11.8578 10.4279 11.8276 10.4092Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M17.7415 14.2368C17.7767 14.2368 17.8119 14.2368 17.8119 14.2837C17.7867 14.265 17.7666 14.2509 17.7415 14.2368Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M17.8118 14.2792C17.847 14.2792 17.8822 14.2792 17.8822 14.3261C17.8621 14.312 17.8369 14.2932 17.8118 14.2792Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M18.1287 14.4808C18.1639 14.4808 18.1991 14.4808 18.1991 14.5277C18.1739 14.5137 18.1488 14.4996 18.1287 14.4808Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M5.34058 6.19666C5.37578 6.19666 5.41098 6.19666 5.41098 6.24356C5.38584 6.22949 5.36069 6.21542 5.34058 6.19666Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M5.41089 6.24365C5.44609 6.24365 5.48129 6.24365 5.48129 6.29056C5.46118 6.2718 5.43603 6.25773 5.41089 6.24365Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M5.65234 6.40308C5.68754 6.40308 5.72275 6.40308 5.72275 6.44999C5.6976 6.43122 5.67749 6.41715 5.65234 6.40308Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M6.20544 6.75964C6.24065 6.75964 6.27585 6.75964 6.27585 6.80655C6.25573 6.79248 6.23059 6.77841 6.20544 6.75964Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M8.52368 8.27002C8.55888 8.27002 8.59408 8.27002 8.59408 8.31693C8.57397 8.29816 8.54883 8.28409 8.52368 8.27002Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M8.83545 8.47168C8.87065 8.47168 8.90585 8.47168 8.90585 8.51859C8.88574 8.49983 8.86059 8.48575 8.83545 8.47168Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M8.91089 8.51868C8.94609 8.51868 8.98129 8.51868 8.98129 8.56559C8.95615 8.54682 8.931 8.53275 8.91089 8.51868Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M9.07678 8.63123C9.11198 8.63123 9.14718 8.63123 9.14718 8.67813C9.12707 8.65937 9.10193 8.6453 9.07678 8.63123Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.15234 8.67358C9.18754 8.67358 9.22275 8.67358 9.22275 8.7158C9.1976 8.70642 9.17246 8.68766 9.15234 8.67358Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.39368 8.83301C9.42888 8.83301 9.46408 8.83301 9.46408 8.87992C9.43894 8.86115 9.41379 8.84708 9.39368 8.83301Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.46411 8.87988C9.49931 8.87988 9.53451 8.87988 9.53451 8.92679C9.5144 8.90803 9.48926 8.89396 9.46411 8.87988Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.53442 8.922C9.56962 8.922 9.60483 8.922 9.60483 8.96891C9.58471 8.95483 9.55957 8.93607 9.53442 8.922Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M9.63513 8.98779C9.67033 8.98779 9.70553 8.98779 9.70553 9.0347C9.68039 9.02063 9.65525 9.00656 9.63513 8.98779Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M10.5754 9.59766C10.6106 9.59766 10.6458 9.59766 10.6458 9.64457C10.6207 9.63049 10.5956 9.61173 10.5754 9.59766Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M10.8169 9.75696C10.8521 9.75696 10.8873 9.75696 10.8873 9.80387C10.8622 9.7851 10.842 9.77103 10.8169 9.75696Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M10.8872 9.79932C10.9224 9.79932 10.9576 9.79932 10.9576 9.84623C10.9375 9.83215 10.9124 9.81339 10.8872 9.79932Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M11.199 10.001C11.2342 10.001 11.2694 10.001 11.2694 10.0479C11.2493 10.0338 11.2241 10.0197 11.199 10.001Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M11.37 10.1136C11.4052 10.1136 11.4404 10.1136 11.4404 10.1606C11.4203 10.1465 11.3951 10.1324 11.37 10.1136Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M11.4403 10.1605C11.4755 10.1605 11.5107 10.1605 11.5107 10.2074C11.4906 10.1887 11.4655 10.1746 11.4403 10.1605Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M11.5159 10.2073C11.5511 10.2073 11.5863 10.2073 11.5863 10.2542C11.5611 10.2354 11.536 10.2213 11.5159 10.2073Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M11.6868 10.3199C11.722 10.3199 11.7572 10.3199 11.7572 10.3669C11.732 10.3481 11.7069 10.334 11.6868 10.3199Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M11.7572 10.3622C11.7924 10.3622 11.8276 10.3622 11.8276 10.4091C11.8025 10.395 11.7823 10.3763 11.7572 10.3622Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M11.9985 10.5216C12.0337 10.5216 12.0689 10.5216 12.0689 10.5685C12.0438 10.5498 12.0237 10.5357 11.9985 10.5216Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M12.2399 10.6764C12.2751 10.6764 12.3103 10.6764 12.3103 10.7233C12.2851 10.7092 12.265 10.6952 12.2399 10.6764Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M13.5675 11.5349C13.6027 11.5349 13.6379 11.5349 13.6379 11.5818C13.6128 11.5631 13.5926 11.549 13.5675 11.5349Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M12.3857 10.7703C12.4209 10.7703 12.4561 10.7703 12.4561 10.8172C12.431 10.7984 12.4059 10.7843 12.3857 10.7703Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M12.5518 10.8829C12.587 10.8829 12.6222 10.8829 12.6222 10.9298C12.602 10.9111 12.5769 10.897 12.5518 10.8829Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M12.6976 10.9719C12.7328 10.9719 12.768 10.9719 12.768 11.0188C12.7429 11.0001 12.7228 10.986 12.6976 10.9719Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M12.7679 11.0189C12.8031 11.0189 12.8383 11.0189 12.8383 11.0658C12.8182 11.0471 12.7931 11.033 12.7679 11.0189Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M12.8685 11.0846C12.9037 11.0846 12.9389 11.0846 12.9389 11.1315C12.9138 11.1127 12.8886 11.0987 12.8685 11.0846Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M12.939 11.1267C12.9742 11.1267 13.0094 11.1267 13.0094 11.1736C12.9842 11.1595 12.9641 11.1455 12.939 11.1267Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M13.1803 11.2863C13.2155 11.2863 13.2507 11.2863 13.2507 11.3332C13.2306 11.3144 13.2054 11.3003 13.1803 11.2863Z"
                                                                                    fill="#C8CCCC" />
                                                                                <path
                                                                                    d="M13.2507 11.3333C13.2859 11.3333 13.3211 11.3333 13.3211 11.3802C13.301 11.3614 13.2759 11.3473 13.2507 11.3333Z"
                                                                                    fill="#C8CCCC" />
                                                                                <path
                                                                                    d="M13.8088 11.6897C13.844 11.6897 13.8792 11.6897 13.8792 11.7366C13.8541 11.7225 13.834 11.7038 13.8088 11.6897Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.1206 11.8961C14.1558 11.8961 14.191 11.8961 14.191 11.943C14.1709 11.9243 14.1457 11.9102 14.1206 11.8961Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.4375 12.0979C14.4727 12.0979 14.5079 12.0979 14.5079 12.1448C14.4828 12.126 14.4576 12.112 14.4375 12.0979Z"
                                                                                    fill="#C6CACA" />
                                                                                <path
                                                                                    d="M14.679 12.2527C14.7142 12.2527 14.7494 12.2527 14.7494 12.2996C14.7242 12.2855 14.6991 12.2668 14.679 12.2527Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.7493 12.2996C14.7845 12.2996 14.8197 12.2996 14.8197 12.3465C14.7945 12.3277 14.7744 12.3136 14.7493 12.2996Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M14.8197 12.3464C14.8549 12.3464 14.8901 12.3464 14.8901 12.3933C14.87 12.3746 14.8448 12.3605 14.8197 12.3464Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M15.061 12.5012C15.0962 12.5012 15.1314 12.5012 15.1314 12.5481C15.1113 12.5341 15.0862 12.5153 15.061 12.5012Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M15.3779 12.703C15.4131 12.703 15.4483 12.703 15.4483 12.7499C15.4232 12.7358 15.398 12.7218 15.3779 12.703Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M15.6896 12.9047C15.7248 12.9047 15.76 12.9047 15.76 12.9469C15.7399 12.9375 15.7147 12.9234 15.6896 12.9047Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M15.931 13.0642C15.9662 13.0642 15.9964 13.0642 16.0014 13.1064C15.9813 13.0924 15.9562 13.0783 15.931 13.0642Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M16.0769 13.1533C16.1121 13.1533 16.1473 13.1533 16.1473 13.2002C16.1222 13.1862 16.097 13.1721 16.0769 13.1533Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M16.1724 13.2238C16.2076 13.2238 16.2428 13.2238 16.2428 13.2707C16.2227 13.2519 16.1975 13.2378 16.1724 13.2238Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M16.3182 13.3129C16.3534 13.3129 16.3886 13.3129 16.3886 13.3598C16.3635 13.3457 16.3384 13.3269 16.3182 13.3129Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M17.1128 13.8289C17.148 13.8289 17.1832 13.8289 17.1832 13.8758C17.1631 13.8617 17.1379 13.8429 17.1128 13.8289Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M17.1831 13.8756C17.2183 13.8756 17.2535 13.8756 17.2535 13.9225C17.2334 13.9038 17.2082 13.8897 17.1831 13.8756Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M17.5703 14.1243C17.6055 14.1243 17.6407 14.1243 17.6407 14.1712C17.6206 14.1524 17.5955 14.1383 17.5703 14.1243Z"
                                                                                    fill="#C9CDCD" />
                                                                                <path
                                                                                    d="M6.08484 6.67517C6.09993 6.68924 6.12004 6.70332 6.13513 6.71739C6.11501 6.70332 6.09993 6.68924 6.08484 6.67517Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M11.6315 10.2732C11.6466 10.2873 11.6667 10.3013 11.6818 10.3154C11.6667 10.3013 11.6516 10.2873 11.6315 10.2732Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M8.61426 8.31689C8.62934 8.33097 8.64946 8.34504 8.66455 8.35911C8.64946 8.34504 8.63437 8.33097 8.61426 8.31689Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M10.5253 9.55542C10.5404 9.56949 10.5605 9.58357 10.5756 9.59764C10.5554 9.58357 10.5404 9.56949 10.5253 9.55542Z"
                                                                                    fill="#C8CDCD" />
                                                                                <path
                                                                                    d="M14.3822 12.0555C14.3973 12.0696 14.4174 12.0837 14.4325 12.0978C14.4174 12.0837 14.4023 12.0696 14.3822 12.0555Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M6.15515 6.72205C6.17024 6.73612 6.19035 6.75019 6.20544 6.76426C6.19035 6.7455 6.17024 6.73143 6.15515 6.72205Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M11.9482 10.4795C11.9633 10.4936 11.9834 10.5076 11.9985 10.5217C11.9784 10.5076 11.9633 10.4936 11.9482 10.4795Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M8.71484 8.38269C8.72993 8.39676 8.75004 8.41084 8.76513 8.42491C8.74502 8.41084 8.72993 8.39676 8.71484 8.38269Z"
                                                                                    fill="#C7CCCC" />
                                                                                <path
                                                                                    d="M17.3743 13.9883C17.3894 14.0024 17.4095 14.0164 17.4246 14.0305C17.4095 14.0164 17.3944 14.0024 17.3743 13.9883Z"
                                                                                    fill="#C8CCCC" />
                                                                                <path
                                                                                    d="M17.4497 14.0493C17.4899 14.0211 17.4899 14.0493 17.5 14.0727C17.4849 14.068 17.4648 14.0586 17.4497 14.0493Z"
                                                                                    fill="#C5C9C9" />
                                                                                <path
                                                                                    d="M13.3713 11.4036C13.3864 11.4176 13.4065 11.4317 13.4216 11.4458C13.4065 11.427 13.3864 11.4129 13.3713 11.4036Z"
                                                                                    fill="#C8CCCC" />
                                                                                <path
                                                                                    d="M12.3304 10.7234C12.3455 10.7375 12.3656 10.7515 12.3807 10.7656C12.3656 10.7562 12.3506 10.7422 12.3304 10.7234Z"
                                                                                    fill="#C6CBCB" />
                                                                                <path
                                                                                    d="M14.9404 12.4121C14.9555 12.4262 14.9756 12.4403 14.9907 12.4543C14.9706 12.4403 14.9555 12.4262 14.9404 12.4121Z"
                                                                                    fill="#C7CBCB" />
                                                                                <path
                                                                                    d="M5.60205 6.36084C5.61714 6.37491 5.63725 6.38898 5.65234 6.40306C5.63222 6.38898 5.61714 6.37491 5.60205 6.36084Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M5.28516 6.15918C5.30024 6.17325 5.32036 6.18732 5.33544 6.2014C5.32036 6.18263 5.30527 6.16856 5.28516 6.15918Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M18.6265 14.8419C18.6316 14.8513 18.6316 14.856 18.6366 14.8654C18.6265 14.8654 18.6165 14.8654 18.6115 14.8654C18.6165 14.856 18.6215 14.8513 18.6265 14.8419Z"
                                                                                    fill="#C9CECE" />
                                                                                <path
                                                                                    d="M21.5732 13.1579C21.5179 13.1626 21.4777 13.1438 21.4374 13.111C21.4073 13.0828 21.367 13.0688 21.3318 13.0453C21.2363 12.9749 21.1508 12.8999 21.0502 12.8389C20.6529 12.5856 20.2557 12.3323 19.8584 12.079C19.1896 11.6568 18.5258 11.2393 17.857 10.8171C17.0272 10.2964 16.2025 9.78044 15.3728 9.26444C15.1113 9.10026 14.8548 8.94077 14.5933 8.78128C14.186 8.52797 13.7736 8.26997 13.3663 8.01666C13.0998 7.85248 12.8333 7.68361 12.5667 7.51942C12.0689 7.20982 11.566 6.90022 11.0682 6.59062C10.7966 6.42175 10.52 6.25757 10.2435 6.08401C9.90151 5.86823 9.56458 5.64775 9.22263 5.43197C9.02651 5.31001 8.82536 5.19274 8.62924 5.07077C8.48844 4.98165 8.34763 4.88783 8.2018 4.7987C8.06099 4.70957 7.92019 4.62983 7.77938 4.5407C7.50783 4.37183 7.24131 4.20296 6.97479 4.03408C6.9245 4.00125 6.87924 3.9731 6.80884 3.93088C7.23628 3.6635 7.64864 3.4055 8.05596 3.15219C8.05093 3.1475 8.05094 3.13812 8.04591 3.13343C8.02076 3.13812 7.99562 3.14281 7.9755 3.15219C7.81961 3.24132 7.66372 3.33514 7.5028 3.42427C7.4676 3.44303 7.42234 3.44772 7.38211 3.46179C7.45754 3.4055 7.53298 3.34452 7.61344 3.28823C7.98556 3.0443 8.35266 2.80507 8.72479 2.56583C8.73484 2.56114 8.7449 2.55645 8.75496 2.55176C8.80525 2.57052 8.8505 2.58459 8.89576 2.60336C9.03154 2.68779 9.16731 2.77692 9.30309 2.85667C9.63499 3.05838 9.96688 3.26008 10.3038 3.46179C10.6508 3.67288 11.0028 3.88397 11.3498 4.09976C11.8527 4.40936 12.3555 4.72365 12.8634 5.03794C14.1458 5.83539 15.4331 6.63284 16.7154 7.4303C17.2837 7.78211 17.8469 8.13862 18.4152 8.49513C18.7823 8.72499 19.1544 8.95953 19.5215 9.18938C20.0495 9.52244 20.5775 9.85549 21.1055 10.1885C21.5682 10.4794 22.0258 10.7749 22.4834 11.0704C22.755 11.244 23.0315 11.4223 23.3031 11.6005C23.3534 11.6333 23.3986 11.6662 23.4489 11.699C23.464 11.7225 23.4741 11.7459 23.4892 11.7694C23.4992 11.7928 23.5093 11.8116 23.5244 11.8351C23.2729 12.0039 23.0265 12.1728 22.7751 12.337C22.5639 12.4777 22.3476 12.6137 22.1364 12.7545C21.9654 12.8671 21.7995 12.9796 21.6335 13.0969C21.6134 13.111 21.5983 13.1344 21.5732 13.1579ZM8.20683 3.02554C8.19677 3.03492 8.18168 3.0443 8.17162 3.05368C8.17665 3.05838 8.17665 3.05838 8.18168 3.06307C8.19174 3.04899 8.19677 3.03492 8.20683 3.02554C8.20683 3.02085 8.21185 3.02085 8.21185 3.01616C8.21185 3.02085 8.21185 3.02085 8.20683 3.02554ZM8.09619 3.10059C8.10122 3.10528 8.11128 3.10998 8.11631 3.10998C8.12134 3.10998 8.12134 3.10059 8.12637 3.09121C8.12134 3.08652 8.11128 3.08183 8.10625 3.08183C8.10122 3.08183 8.10122 3.09121 8.09619 3.10059ZM8.28226 2.99739L8.28729 2.9927L8.28226 2.98801C8.27723 2.9927 8.27723 2.9927 8.2722 2.99739C8.27723 2.99739 8.28226 2.99739 8.28226 2.99739Z"
                                                                                    fill="#CCCCCC" />
                                                                                <path
                                                                                    d="M7.3873 3.45239C7.3873 3.4993 7.3521 3.4993 7.31689 3.4993C7.34204 3.48054 7.36215 3.46647 7.3873 3.45239Z"
                                                                                    fill="#CCCCCC" />
                                                                                <path
                                                                                    d="M21.5732 13.158C21.5934 13.1345 21.6135 13.1111 21.6386 13.0923C21.8046 12.975 21.9755 12.8624 22.1415 12.7499C22.3527 12.6091 22.5689 12.4731 22.7801 12.3324C23.0316 12.1635 23.278 11.9946 23.5294 11.8304C23.5445 11.8445 23.5696 11.8633 23.5747 11.882C23.5898 11.9571 23.5998 12.0368 23.5998 12.1166C23.5998 13.1674 23.6049 14.2134 23.5998 15.2642C23.5998 15.4847 23.5747 15.7004 23.4942 15.9115C23.4339 16.0663 23.3383 16.1977 23.2227 16.3196C23.0969 16.4557 22.9511 16.5729 22.7952 16.6761C22.4734 16.8872 22.1515 17.0936 21.8347 17.3047C21.8196 17.3141 21.7995 17.3235 21.7694 17.3329C21.7593 17.3047 21.7543 17.2813 21.7442 17.2578C21.7442 16.0523 21.7442 14.842 21.7442 13.6364C21.7442 13.4723 21.7241 13.3222 21.5883 13.2049C21.5783 13.1908 21.5783 13.172 21.5732 13.158Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M8.20686 3.02563C8.1968 3.03502 8.18674 3.04909 8.17668 3.05847C8.17165 3.05378 8.17165 3.05378 8.16663 3.04909C8.18171 3.0444 8.1968 3.03502 8.20686 3.02563Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M8.09631 3.10067C8.10134 3.09598 8.10134 3.0866 8.10637 3.08191C8.1114 3.08191 8.12146 3.0866 8.12649 3.09129C8.12146 3.09598 8.12146 3.10536 8.11643 3.11005C8.1114 3.11005 8.10134 3.10067 8.09631 3.10067Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M8.2824 2.99759C8.27737 2.99759 8.27737 2.99759 8.27234 2.9929C8.27737 2.98821 8.27737 2.98821 8.2824 2.98352L8.28743 2.98821C8.28743 2.9929 8.28742 2.99759 8.2824 2.99759Z"
                                                                                    fill="#B7B7B7" />
                                                                                <path
                                                                                    d="M8.20679 3.02562C8.20679 3.02093 8.21136 3.02093 8.21136 3.01624C8.21136 3.02093 8.21136 3.02093 8.20679 3.02562Z"
                                                                                    fill="#B7B7B7" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_43_2">
                                                                                    <rect width="28" height="28"
                                                                                        fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>


                                                                        <span x-text="$t('addsingbox')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div class="flex flex-col">
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('downloadApp')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForDownload')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a href="https://github.com/SagerNet/sing-box/releases/download/v1.5.0-beta.6/SFA-1.5.0-beta.6-universal.apk"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                                <span x-text="$t('download')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/albqovim.json"
                                                                                    trigger="loop" delay="1500"
                                                                                    colors="primary:#fff" state="intro">
                                                                                </lord-icon>
                                                                            </a>
                                                                            <div
                                                                                class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#fff,secondary:#fff"
                                                                                    class="w-12 h-12 md:w-20 md:h-20 ">
                                                                                </lord-icon>
                                                                                <h3 x-text="$t('addConfigs')"
                                                                                    class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                </h3>
                                                                            </div>
                                                                            <p x-text="$t('clickForAdd')"
                                                                                class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            </p>
                                                                            <a id="android-singbox"
                                                                                class="flex mb-4 items-center gap-x-4 w-full bg-stone-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                                <span x-text="$t('AddtoApp')"></span>
                                                                                <lord-icon class="w-8 h-8"
                                                                                    src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                    trigger="loop" delay="2000"
                                                                                    colors="primary:#fff">
                                                                                </lord-icon>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="WindowsContainer"
                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 transition-all duration-300 font-medium rounded-2xl">
                                <!-- Accordion item -->
                                <div x-data="{ expanded: false }">
                                    <h2>
                                        <button id="faqs-title-01" type="button"
                                            class="flex p-4 rtl:pl-0 items-center justify-between w-full text-left font-semibold"
                                            @click="expanded = !expanded" :aria-expanded="expanded"
                                            aria-controls="faqs-text-01">
                                            <div
                                                class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M22.25 12.75V23.424L10.75 21.004V12.75H22.25ZM22.25 11.25V0.576L10.75 2.996V11.25H22.25ZM9.25 3.313L1.75 4.89V11.249H9.25V3.313ZM1.75 12.75H9.25V20.688L1.75 19.108V12.75Z"
                                                        fill="white" />
                                                </svg>
                                                <span x-text="$t('Windows')">
                                                </span>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" :class="{'!rotate-180': expanded}"
                                                class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                    d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                            </svg>
                                        </button>
                                    </h2>
                                    <div id="faqs-text-01" role="region" aria-labelledby="faqs-title-01"
                                        class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                        :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                        <div class="overflow-hidden">
                                            <div class="p-4 pb-6">
                                                <div class="bg-gray-700 px-4 py-2 rounded-xl mb-6">
                                                    <p x-text="$t('chooseApp')" class="text-sm"></p>
                                                </div>
                                                <div class="flex flex-col gap-y-4">
                                                    <div
                                                        class="text-white bg-gradient-to-r from-emerald-500 via-emerald-600 to-emerald-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            version="1.0" class="w-6 h-6"
                                                                            viewBox="0 0 170.000000 170.000000"
                                                                            preserveAspectRatio="xMidYMid meet">

                                                                            <g transform="translate(0.000000,170.000000) scale(0.100000,-0.100000)"
                                                                                fill="#FFF" stroke="none">
                                                                                <path
                                                                                    d="M230 1385 l0 -75 75 0 75 0 2 -549 3 -549 580 616 c319 338 582 619 583 624 2 4 -86 8 -195 8 l-198 0 -275 -257 -275 -256 -5 254 -5 254 -182 3 -183 2 0 -75z" />
                                                                            </g>
                                                                        </svg>
                                                                        <span x-text="$t('addV2rayN')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('downloadApp')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                            </h3>
                                                                        </div>
                                                                        <p x-text="$t('clickForDownload')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                        </p>
                                                                        <a href="https://github.com/2dust/v2rayN/releases/download/6.27/zz_v2rayN-With-Core-SelfContained.7z"
                                                                            class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                            <span x-text="$t('download')"></span>
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-white bg-gradient-to-r from-zinc-500 via-zinc-600 to-zinc-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M22.25 12.75V23.424L10.75 21.004V12.75H22.25ZM22.25 11.25V0.576L10.75 2.996V11.25H22.25ZM9.25 3.313L1.75 4.89V11.249H9.25V3.313ZM1.75 12.75H9.25V20.688L1.75 19.108V12.75Z"
                                                                                fill="white" />
                                                                        </svg>
                                                                        <span x-text="$t('addnekoray')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('downloadApp')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                            </h3>
                                                                        </div>
                                                                        <p x-text="$t('clickForDownload')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                        </p>
                                                                        <a href="https://github.com/MatsuriDayo/nekoray/releases/download/3.21/nekoray-3.21-2023-09-12-windows64.zip"
                                                                            class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                            <span x-text="$t('download')"></span>
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-white bg-gradient-to-r from-rose-500 via-rose-600 to-rose-700 focus:ring-4 focus:outline-none focus:ring-teal-300 transition-all duration-300 font-medium rounded-2xl">
                                                        <!-- Accordion item -->
                                                        <div x-data="{ expanded: false }">
                                                            <h2>
                                                                <button style="direction: ltr;" id="faqs-title-01"
                                                                    type="button"
                                                                    class="flex items-center p-4 justify-between w-full text-left font-semibold"
                                                                    @click="expanded = !expanded" :aria-expanded="expanded"
                                                                    aria-controls="faqs-text-01">
                                                                    <div
                                                                        class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M22.25 12.75V23.424L10.75 21.004V12.75H22.25ZM22.25 11.25V0.576L10.75 2.996V11.25H22.25ZM9.25 3.313L1.75 4.89V11.249H9.25V3.313ZM1.75 12.75H9.25V20.688L1.75 19.108V12.75Z"
                                                                                fill="white" />
                                                                        </svg>
                                                                        <span x-text="$t('addClashVerge')">
                                                                        </span>
                                                                    </div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        :class="{'!rotate-180': expanded}"
                                                                        class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                                                    </svg>
                                                                </button>
                                                            </h2>
                                                            <div id="faqs-text-01" role="region"
                                                                aria-labelledby="faqs-title-01"
                                                                class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                                                :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                                                <div class="overflow-hidden">
                                                                    <div class="p-4 pb-6">
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/mtdulhdc.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('downloadApp')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                            </h3>
                                                                        </div>
                                                                        <p x-text="$t('clickForDownload')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                        </p>
                                                                        <a href="https://github.com/zzzgydi/clash-verge/releases/download/v1.3.7/Clash.Verge_1.3.7_x64_en-US.msi"
                                                                            class="flex mb-4 items-center gap-x-4 w-full bg-gray-800 shadow-md px-3 py-2 rounded-3xl justify-between">
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                            <span x-text="$t('download')"></span>
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/albqovim.json"
                                                                                trigger="loop" delay="1500"
                                                                                colors="primary:#fff" state="intro">
                                                                            </lord-icon>
                                                                        </a>
                                                                        <div
                                                                            class="flex items-center rtl:mr-[-10px] ltr:ml-[-10px] md:rtl:mr-[-20px] md:ltr:ml-[-20px]">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/vcoyflbj.json"
                                                                                trigger="hover"
                                                                                colors="primary:#fff,secondary:#fff"
                                                                                class="w-12 h-12 md:w-20 md:h-20 ">
                                                                            </lord-icon>
                                                                            <h3 x-text="$t('addConfigs')"
                                                                                class="text-xl font-black leading-none tracking-tight text-white md:text-2xl">
                                                                                افزودن کانفیگ ها</h3>
                                                                        </div>
                                                                        <p x-text="$t('clickForAdd')"
                                                                            class="text-sm mb-4 font-normal text-white lg:text-base">
                                                                            برای اضافه کردن کانفیگ‌ ها داخل برنامه روی لینک
                                                                            زیر کلیک کنید.</p>
                                                                        <a id="windows-clashverge" class=" flex mb-4 items-center gap-x-4 w-full
                                                                        bg-stone-800 shadow-md px-3 py-2 rounded-3xl
                                                                        justify-between">
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                trigger="loop" delay="2000"
                                                                                colors="primary:#fff">
                                                                            </lord-icon>
                                                                            <span x-text="$t('AddtoApp')">افزودن به
                                                                                برنامه</span>
                                                                            <lord-icon class="w-8 h-8"
                                                                                src="https://cdn.lordicon.com/mrdiiocb.json"
                                                                                trigger="loop" delay="2000"
                                                                                colors="primary:#fff">
                                                                            </lord-icon>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p x-text="$t('macInfo')" class="text-lg font-normal mb-4 text-gray-300 lg:text-xl"></p>
                        </div>
                        <h2 x-text="$t('generalAccess')"
                            class="my-4 text-3xl font-black leading-none tracking-tight text-white md:text-5xl">

                        </h2>
                        <p x-text="$t('generalAccessInfo')" class="text-lg font-normal mb-4 text-gray-300 lg:text-xl"></p>
                        <div
                            class="collapse-arrow dark:text-white bg-gradient-to-r dark:from-gray-600 dark:via-gray-700 dark:to-gray-800 from-slate-100 via-slate-200 to-slate-300 text-black transition-all duration-300 font-medium rounded-2xl">
                            <!-- Accordion item -->
                            <div x-data="{ expanded: false }">
                                <h2>
                                    <button id="faqs-title-01" type="button"
                                        class="flex p-4 rtl:pl-0 items-center justify-between w-full text-left font-semibold"
                                        @click="expanded = !expanded" :aria-expanded="expanded"
                                        aria-controls="faqs-text-01">
                                        <div class="flex items-center justify-start gap-x-2 text-lg sm:text-xl font-medium">
                                            <div id="myConfigsContainer" class="w-8 h-8">
                                                <lord-icon class="w-8 h-8" src="https://cdn.lordicon.com/gqzfzudq.json"
                                                    trigger="loop" delay="2000" colors="primary:#fff,secondary:#fff">
                                                </lord-icon>
                                            </div>
                                            <span x-text="$t('myConfigs')">
                                            </span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" :class="{'!rotate-180': expanded}"
                                            class="w-6 h-6 mx-6 transform origin-center transition duration-200 ease-out">
                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="faqs-text-01" role="region" aria-labelledby="faqs-title-01"
                                    class="grid text-sm text-white overflow-hidden transition-all duration-300 ease-in-out"
                                    :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                    <div class="overflow-hidden">
                                        <div class="p-4 pb-6">
                                            <div id="configs_section" style="direction: ltr;"
                                                class="flex flex-col gap-y-2 pt-4">
                                                <button id="copyBtn"
                                                    class="flex mb-4 items-center justify-between bg-slate-950 px-4 py-3 text-center rounded-lg">
                                                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="loop"
                                                        delay="2000" colors="primary:#fff,secondary:#fff" class="w-10 h-10">
                                                    </lord-icon>
                                                    <span x-text="$t('copyAllCfgs')" id="copyText">
                                                    </span>
                                                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="loop"
                                                        delay="2000" colors="primary:#fff,secondary:#fff" class="w-10 h-10">
                                                    </lord-icon>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 x-text="$t('telsupport')"
                            class="mb-4 mt-8 text-3xl font-black leading-none tracking-tight text-white md:text-5xl">

                        </h2>
                        <p x-text="$t('supTelInfo')" class="text-lg font-normal mb-4 text-gray-300 lg:text-xl"></p>
                        <div class="flex flex-col gap-y-4">
                            <h2 class="font-bold text-white text-2xl mb-2" x-text="$t('sup')"></h2>
                            <a href="https://t.me/yourID"
                                class="py-3 px-4 transition-all duration-200 inline-flex gap-x-3 justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-6 h-6 fill-white"
                                    viewBox="0 0 50 50">
                                    <path
                                        d="M25,2c12.703,0,23,10.297,23,23S37.703,48,25,48S2,37.703,2,25S12.297,2,25,2z M32.934,34.375	c0.423-1.298,2.405-14.234,2.65-16.783c0.074-0.772-0.17-1.285-0.648-1.514c-0.578-0.278-1.434-0.139-2.427,0.219	c-1.362,0.491-18.774,7.884-19.78,8.312c-0.954,0.405-1.856,0.847-1.856,1.487c0,0.45,0.267,0.703,1.003,0.966	c0.766,0.273,2.695,0.858,3.834,1.172c1.097,0.303,2.346,0.04,3.046-0.395c0.742-0.461,9.305-6.191,9.92-6.693	c0.614-0.502,1.104,0.141,0.602,0.644c-0.502,0.502-6.38,6.207-7.155,6.997c-0.941,0.959-0.273,1.953,0.358,2.351	c0.721,0.454,5.906,3.932,6.687,4.49c0.781,0.558,1.573,0.811,2.298,0.811C32.191,36.439,32.573,35.484,32.934,34.375z">
                                    </path>
                                </svg>


                                <span class="sm:text-lg" x-text="$t('support')"></span>
                            </a>
                        </div>
                        <div class="flex mt-6 items-center justify-center gap-x-4 mb-4">
                            <button id="qrIconBtn"
                                onclick="openDynamicModal('<?= $user['username'] ?> Subscription' ,  window.location.href)"
                                class="bg-gray-100 border-gray-200 dark:bg-gray-700 dark:border-gray-600 rounded-xl pt-1 px-1">
                                <lord-icon src="https://cdn.lordicon.com/fqrjldna.json" trigger="loop" delay="2000"
                                    colors="primary:#000,secondary:#000" class="w-10 h-10">
                                </lord-icon>
                            </button>

                            <select style="
               text-indent:15px;
               height:50px;" id="countries"
                                class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 py-3.5 bg-gray-100 border-gray-200 placeholder-gray-800 text-black dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option value="fa">فارسی</option>
                                <option value="en">English</option>
                                <option value="ru">Русский</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
        <?php
        return;
}

$isOK = false;
foreach (explode("\r\n", $header_text) as $i => $line) {
    if ($i === 0)
        continue;
    list($key, $value) = explode(': ', $line);
    if (in_array($key, ['content-disposition', 'content-type', 'subscription-userinfo', 'profile-update-interval'])) {
        header("$key: $value");
        $isOK = true;
    }
}

if (!$isTextHTML and !$isOK)
    die('Error !' . __LINE__);


echo $response;

?>
