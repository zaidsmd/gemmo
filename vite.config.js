import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import obfuscator from "rollup-plugin-obfuscator";

let fonts = [
    "resources/fonts/dripicons-v2.eot",
    "resources/fonts/dripicons-v2.svg",
    "resources/fonts/dripicons-v2.ttf",
    "resources/fonts/dripicons-v2.woff",
    "resources/fonts/fa-brands-400.eot",
    "resources/fonts/fa-brands-400.svg",
    "resources/fonts/fa-brands-400.ttf",
    "resources/fonts/fa-brands-400.woff",
    "resources/fonts/fa-brands-400.woff2",
    "resources/fonts/fa-regular-400.eot",
    "resources/fonts/fa-regular-400.svg",
    "resources/fonts/fa-regular-400.ttf",
    "resources/fonts/fa-regular-400.woff",
    "resources/fonts/fa-regular-400.woff2",
    "resources/fonts/fa-solid-900.eot",
    "resources/fonts/fa-solid-900.svg",
    "resources/fonts/fa-solid-900.ttf",
    "resources/fonts/fa-solid-900.woff",
    "resources/fonts/fa-solid-900.woff2",
    "resources/fonts/materialdesignicons-webfont.eot",
    "resources/fonts/materialdesignicons-webfont.ttf",
    "resources/fonts/materialdesignicons-webfont.woff",
    "resources/fonts/materialdesignicons-webfont.woff2",
    "resources/fonts/summernote.eot",
    "resources/fonts/summernote.ttf",
    "resources/fonts/summernote.woff",
    "resources/fonts/themify.eot",
    "resources/fonts/themify.svg",
    "resources/fonts/themify.ttf",
    "resources/fonts/themify.woff",
    "resources/fonts/typicons.css",
    "resources/fonts/typicons.eot",
    "resources/fonts/typicons.min.css",
    "resources/fonts/typicons.svg",
    "resources/fonts/typicons.ttf",
    "resources/fonts/typicons.woff",
];
let base_scss = [
    "resources/css/app-dark.scss",
    "resources/css/app.scss",
    "resources/css/bootstrap-dark.scss",
    "resources/css/bootstrap.scss",
    "resources/css/icons.scss",
];

let js = [
    "resources/js/app.js",
];


export default defineConfig({
    plugins: [
        laravel({
            input: [...fonts, ...base_scss, ...js],
            refresh: true,
        }),
        obfuscator({
            options: {
                compact: true,
                controlFlowFlattening: true,
                controlFlowFlatteningThreshold: 0.75,
                deadCodeInjection: false,
                deadCodeInjectionThreshold: 0.4,
                debugProtection: false,
                debugProtectionInterval: 0,
                disableConsoleOutput: false,
                domainLock: [],
                domainLockRedirectUrl: "about:blank",
                forceTransformStrings: [],
                identifierNamesCache: null,
                identifierNamesGenerator: "mangled-shuffled",
                identifiersDictionary: [],
                identifiersPrefix: "gero",
                ignoreImports: false,
                inputFileName: "",
                log: false,
                numbersToExpressions: false,
                optionsPreset: "medium-obfuscation",
                renameGlobals: false,
                renameProperties: false,
                renamePropertiesMode: "safe",
                reservedNames: [],
                reservedStrings: [],
                seed: 0,
                selfDefending: false,
                simplify: true,
                sourceMap: false,
                sourceMapBaseUrl: "",
                sourceMapFileName: "",
                sourceMapMode: "separate",
                sourceMapSourcesMode: "sources-content",
                splitStrings: false,
                splitStringsChunkLength: 10,
                stringArray: true,
                stringArrayCallsTransform: true,
                stringArrayCallsTransformThreshold: 0.75,
                stringArrayEncoding: ["base64"],
                stringArrayIndexesType: ["hexadecimal-number"],
                stringArrayIndexShift: true,
                stringArrayRotate: true,
                stringArrayShuffle: true,
                stringArrayWrappersCount: 1,
                stringArrayWrappersChainedCalls: true,
                stringArrayWrappersParametersMaxCount: 2,
                stringArrayWrappersType: "variable",
                stringArrayThreshold: 0.75,
                target: "browser",
                transformObjectKeys: false,
                unicodeEscapeSequence: false,
            },
        }),
    ],
    build: {
        commonjsOptions: { transformMixedEsModules: true },
    },
});
