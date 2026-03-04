/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./src/Resources/**/*.blade.php",
        "./src/Resources/**/*.js",
        "./src/Resources/**/*.css",
    ],

    theme: {
        container: {
            center: true,
            screens: {
                "2xl": "1440px",
            },
            padding: {
                DEFAULT: "90px",
            },
        },

        screens: {
            sm:    "525px",
            md:    "768px",
            lg:    "1024px",
            xl:    "1240px",
            "2xl": "1440px",
            1180:  "1180px",
            1060:  "1060px",
            991:   "991px",
            868:   "868px",
        },

        extend: {
            /* ─────────────────────────────────────────
               COLORES
            ───────────────────────────────────────── */
            colors: {
                navyBlue:    "#060C3B",
                lightOrange: "#F6F2EB",
                darkGreen:   "#40994A",
                darkBlue:    "#0044F2",
                darkPink:    "#F85156",

                background:  "var(--background)",
                foreground:  "var(--foreground)",

                primary: {
                    DEFAULT:    "var(--primary)",
                    foreground: "var(--primary-foreground)",
                },
                accent: {
                    DEFAULT:    "var(--accent)",
                    foreground: "var(--accent-foreground)",
                },
                muted: {
                    DEFAULT:    "var(--muted)",
                    foreground: "var(--muted-foreground)",
                },
                card: {
                    DEFAULT:    "var(--card)",
                    foreground: "var(--card-foreground)",
                },
                popover: {
                    DEFAULT:    "var(--popover)",
                    foreground: "var(--popover-foreground)",
                },
                secondary: {
                    DEFAULT:    "var(--secondary)",
                    foreground: "var(--secondary-foreground)",
                },
                destructive: {
                    DEFAULT:    "var(--destructive)",
                    foreground: "var(--destructive-foreground)",
                },

                border: "var(--border)",
                input:  "var(--input)",
                ring:   "var(--ring)",

                "chart-1": "var(--chart-1)",
                "chart-2": "var(--chart-2)",
                "chart-3": "var(--chart-3)",
                "chart-4": "var(--chart-4)",
                "chart-5": "var(--chart-5)",
            },

            /* ─────────────────────────────────────────
               FUENTES
            ───────────────────────────────────────── */
            fontFamily: {
                poppins:  ["Poppins"],
                dmserif:  ["DM Serif Display"],
                sans:     ["var(--font-body)",    "Poppins", "sans-serif"],
                heading:  ["var(--font-heading)", "DM Serif Display", "serif"],
            },

            /* ─────────────────────────────────────────
               BORDER RADIUS
            ───────────────────────────────────────── */
            borderRadius: {
                sm:   "calc(var(--radius) - 0.5rem)",
                md:   "calc(var(--radius) - 0.25rem)",
                lg:   "var(--radius)",
                xl:   "calc(var(--radius) + 0.5rem)",
                "2xl":"calc(var(--radius) + 1rem)",
                full: "9999px",
                "2.5xl": "2.5rem",
            },

            /* ─────────────────────────────────────────
               BACKDROP BLUR
            ───────────────────────────────────────── */
            backdropBlur: {
                xs:    "2px",
                sm:    "4px",
                md:    "12px",
                lg:    "16px",
                xl:    "24px",
                "2xl": "40px",
                "3xl": "60px",
            },

            /* ─────────────────────────────────────────
               KEYFRAMES
            ───────────────────────────────────────── */
            keyframes: {
                skeleton: {
                    "0%":   { backgroundPosition: "-1250px 0" },
                    "100%": { backgroundPosition: "1250px 0"  },
                },
                "on-fade": {
                    "0%":   { opacity: "0" },
                    "100%": { opacity: "1" },
                },
                "fade-in": {
                    from: { opacity: "0" },
                    to:   { opacity: "1" },
                },
                "fade-in-up": {
                    from: { opacity: "0", transform: "translateY(30px)"            },
                    to:   { opacity: "1", transform: "translateY(0)"               },
                },
                "slide-in-up": {
                    from: { opacity: "0", transform: "translateY(40px) scale(0.95)" },
                    to:   { opacity: "1", transform: "translateY(0) scale(1)"       },
                },
                float: {
                    "0%, 100%": { transform: "translateY(0px) rotate(0deg)"   },
                    "50%":      { transform: "translateY(-12px) rotate(2deg)" },
                },
                "pulse-glow": {
                    "0%, 100%": { boxShadow: "0 0 10px rgba(99, 102, 241, 0.4)" },
                    "50%":      { boxShadow: "0 0 25px rgba(99, 102, 241, 0.6)" },
                },
                shimmer: {
                    "0%":   { backgroundPosition: "-200% 0"  },
                    "100%": { backgroundPosition: "200% 0"   },
                },
                "gradient-shift": {
                    "0%":   { backgroundPosition: "0% 50%"   },
                    "50%":  { backgroundPosition: "100% 50%" },
                    "100%": { backgroundPosition: "0% 50%"   },
                },
                swing: {
                    "0%, 100%": { transform: "rotate(0deg)",   transformOrigin: "top center" },
                    "20%":      { transform: "rotate(15deg)"  },
                    "40%":      { transform: "rotate(-10deg)" },
                    "60%":      { transform: "rotate(5deg)"   },
                    "80%":      { transform: "rotate(-5deg)"  },
                },
                "accordion-down": {
                    from: { height: "0" },
                    to:   { height: "var(--radix-accordion-content-height)" },
                },
                "accordion-up": {
                    from: { height: "var(--radix-accordion-content-height)" },
                    to:   { height: "0" },
                },
            },

            /* ─────────────────────────────────────────
               ANIMATIONS
            ───────────────────────────────────────── */
            animation: {
                "fade-in":       "fade-in 0.6s ease-out forwards",
                "fade-in-up":    "fade-in-up 0.8s ease-out forwards",
                "slide-in-up":   "slide-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1)",
                float:           "float 4s ease-in-out infinite",
                "pulse-glow":    "pulse-glow 3s ease-in-out infinite",
                shimmer:         "shimmer 2s infinite",
                gradient:        "gradient-shift 3s ease infinite",
                swing:           "swing 1s ease-in-out",
                "accordion-down":"accordion-down 0.2s ease-out",
                "accordion-up":  "accordion-up 0.2s ease-out",
            },

            /* ─────────────────────────────────────────
               BOX SHADOW
            ───────────────────────────────────────── */
            boxShadow: {
                card:        "0 10px 40px -10px rgba(99, 102, 241, 0.15)",
                "card-hover":"0 20px 60px -15px rgba(99, 102, 241, 0.25)",
                glow:        "0 0 20px rgba(99, 102, 241, 0.4)",
                "glow-lg":   "0 0 40px rgba(99, 102, 241, 0.6)",
            },
        },
    },

    plugins: [],

    /* ─────────────────────────────────────────────────────────
       SAFELIST COMPLETO
       Incluye clases del header, home hero y testimonios
    ───────────────────────────────────────────────────────── */
    safelist: [
        /* Bagisto original */
        { pattern: /icon-/ },

        /* ── Opacidades de background ─── */
        "bg-background/50",
        "bg-background/60",
        "bg-background/80",
        "bg-background/95",

        /* ── Backdrop blur ─── */
        "backdrop-blur-sm",
        "backdrop-blur-md",
        "backdrop-blur-xl",
        "backdrop-blur-2xl",

        /* ── Borders ─── */
        "border-transparent",
        "border-border/30",
        "border-border/40",
        "border-border/50",

        /* ── Sombras ─── */
        "shadow-none",
        "shadow-lg",
        "shadow-xl",
        "shadow-2xl",
        "shadow-card",
        "shadow-card-hover",
        "shadow-glow",
        "shadow-glow-lg",

        /* ── Colores de texto ─── */
        "text-primary",
        "text-muted-foreground",
        "text-foreground",
        "text-destructive",
        "text-accent",
        "text-card-foreground",

        /* ── Hover de texto ─── */
        "hover:text-primary",
        "hover:text-primary/80",

        /* ── Backgrounds ─── */
        "hover:bg-primary/5",
        "hover:bg-primary/10",
        "hover:bg-destructive/5",
        "bg-primary/5",
        "bg-primary/10",
        "bg-primary/20",
        "bg-muted/50",
        "bg-card/50",
        "bg-card/80",
        "bg-background",

        /* ── Gradientes hero y secciones ─── */
        "from-primary",
        "from-primary/5",
        "from-primary/10",
        "from-primary/20",
        "via-accent",
        "via-background",
        "via-primary/5",
        "to-accent",
        "to-accent/5",
        "to-accent/10",
        "to-accent/20",
        "to-primary",
        "to-background",
        "bg-gradient-to-r",
        "bg-gradient-to-br",
        "bg-gradient-to-b",
        "bg-gradient-to-t",
        "bg-gradient-to-tr",

        /* ── Blur para orbes ─── */
        "blur-2xl",
        "blur-3xl",

        /* ── Mix blend ─── */
        "mix-blend-overlay",

        /* ── Scale hover ─── */
        "hover:scale-105",
        "hover:scale-110",

        /* ── Focus ring ─── */
        "focus:ring-2",
        "focus:ring-primary/20",
        "focus:border-primary",

        /* ── Rounded ─── */
        "rounded-full",
        "rounded-xl",
        "rounded-2xl",
        "rounded-3xl",

        /* ── Animaciones ─── */
        "animate-fade-in",
        "animate-fade-in-up",
        "animate-float",
        "animate-pulse-glow",
        "animate-shimmer",
        "animate-gradient",
        "animate-pulse",
        "animate-bounce",
        "animate-spin",
        "animate-ping",
        "animate-slide-in-up",

        /* ── Delays ─── */
        "delay-100",
        "delay-300",
        "delay-500",

        /* ── Translate para carrusel Alpine ─── */
        "translate-x-full",
        "-translate-x-full",
        "translate-y-0",
        "translate-y-4",

        /* ── Responsive hero grid (applied via @media en CSS) ─── */
        "lg:hidden",
        "hidden",
        "lg:block",
        "lg:grid-cols-2",
        "lg:grid-cols-3",
        "lg:grid-cols-4",
        "grid-cols-2",
        "grid-cols-3",

        /* ── Height utilitarios hero ─── */
        "min-h-[90vh]",
        "h-full",

        /* ── Glassmorphism ─── */
        "kv-glass",
        "glass-effect",
        "gradient-text",

        /* ── KillaVibes components ─── */
        "kv-btn-primary",
        "kv-btn-secondary",
        "kv-icon-btn",
        "kv-nav-link",
        "kv-search-input",
        "kv-badge-hot",
        "kv-card",
        "kv-skeleton",
        "kv-container",
        "kv-feature-card",
        "kv-stats-bar",
        "kv-section-badge",
        "kv-orb",
        "kv-testimonial-card",
        "kv-section-heading",
        "kv-hero-grid",
        "kv-hero-left",
        "kv-hero-right",
        "kv-features-grid",

        // ── Register KillaVibes ────────────────────────────────
        "kv-register-root",
        "kv-register-overlay",
        "kv-register-card",
        "kv-register-header",
        "kv-register-title",
        "kv-register-subtitle",
        "kv-register-icon-wrap",
        "kv-register-grid",
        "kv-register-label",
        "kv-register-input",
        "kv-register-error",
        "kv-register-actions",
        "kv-register-btn-primary",
        "kv-register-btn-secondary",
        "kv-register-newsletter",
        "kv-register-account-exists",
        "kv-register-account-exists__link",
        "kv-register-footer",
        "kv-register-logo-wrap",
        "kv-register-logo",
        "kv-field-group",
        "kv-field-group--full",
        "kv-register-orb--tr",
        "kv-register-orb--bl",
    ],
};
