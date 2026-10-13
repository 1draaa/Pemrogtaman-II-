<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'MotoLease | Presisi Mekanis dalam Pembiayaan' }}</title>
    
    <!-- Scripts & Styles -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#1e293b",
                        "on-primary-fixed": "#001b3c",
                        "secondary": "#50606f",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary-fixed-variant": "#723610",
                        "surface-container": "#eceef0",
                        "outline-variant": "#c3c6d1",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e6e8ea",
                        "inverse-on-surface": "#eff1f3",
                        "on-primary-fixed-variant": "#1f477b",
                        "surface-container-highest": "#e0e3e5",
                        "surface": "#f7f9fb",
                        "surface-tint": "#3a5f94",
                        "primary-container": "#003366",
                        "tertiary": "#381300",
                        "surface-variant": "#e0e3e5",
                        "tertiary-container": "#592300",
                        "on-secondary-fixed": "#0d1d2a",
                        "on-primary": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "inverse-primary": "#a7c8ff",
                        "secondary-fixed": "#d4e4f6",
                        "on-secondary-fixed-variant": "#394857",
                        "background": "#f7f9fb",
                        "on-background": "#191c1e",
                        "primary-fixed": "#d5e3ff",
                        "on-tertiary-container": "#d8885c",
                        "on-surface": "#191c1e",
                        "tertiary-fixed-dim": "#ffb690",
                        "error-container": "#ffdad6",
                        "secondary-container": "#d1e1f4",
                        "primary-fixed-dim": "#a7c8ff",
                        "on-secondary-container": "#556474",
                        "on-tertiary-fixed": "#341100",
                        "outline": "#737780",
                        "surface-dim": "#d8dadc",
                        "secondary-fixed-dim": "#b8c8da",
                        "error": "#ba1a1a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
        }
        .tonal-transition {
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body antialiased">
    
    <x-frontend.header />

    {{ $slot }}

    <x-frontend.footer />

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-[100] flex flex-col gap-3"></div>

    <script>
        // --- Shared Utility Functions ---
        window.formatCurrency = (value) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);
        };

        window.showToast = (message, type = 'success') => {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            const bgClass = type === 'success' ? 'bg-primary' : 'bg-secondary';
            
            toast.className = `flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg text-white transform transition-all duration-300 translate-y-10 opacity-0 ${bgClass}`;
            toast.innerHTML = `
                <span class="material-symbols-outlined text-sm">info</span>
                <span class="text-sm font-medium">${message}</span>
            `;
            
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.remove('translate-y-10', 'opacity-0'));
            setTimeout(() => {
                toast.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        };

        document.addEventListener('DOMContentLoaded', () => {
            // --- Common Event Listeners ---
            document.querySelectorAll('a[href="#"], button:not([id$="-slider"]):not(.btn-select-motor), [data-message]').forEach(el => {
                el.addEventListener('click', (e) => {
                    if (el.getAttribute('href') === '#') e.preventDefault();
                    
                    let message = el.getAttribute('data-message');
                    if (!message) {
                        const text = el.innerText.trim();
                        message = text ? `Fitur "${text}" sedang dalam pengembangan.` : "Aksi berhasil dipicu!";
                    }
                    showToast(message);
                });
            });

            const searchInput = document.querySelector('input[placeholder="Cari model..."]');
            if(searchInput) {
                searchInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        if(searchInput.value.trim()) {
                            showToast(`Mencari motor: "${searchInput.value}"`);
                            searchInput.value = '';
                        } else {
                            showToast(`Silakan masukkan kata kunci pencarian.`, 'error');
                        }
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>