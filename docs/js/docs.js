document.addEventListener('DOMContentLoaded', function() {
    // Configure marked options
    marked.setOptions({
        highlight: function(code, lang) {
            if (lang && hljs.getLanguage(lang)) {
                return hljs.highlight(code, { language: lang }).value;
            }
            return hljs.highlightAuto(code).value;
        },
        breaks: true
    });

    // Get base path for GitHub Pages
    const getBasePath = () => {
        const path = window.location.pathname;
        return path.includes('/ArchPHP/') ? '/ArchPHP' : '';
    };

    // Router class
    class Router {
        constructor(routes) {
            this.routes = routes;
            this.contentDiv = document.getElementById('content');
            this.currentPath = window.location.hash.slice(1) || '/getting-started';
            this.basePath = getBasePath();
            
            // Handle initial route
            this.handleRoute();
            
            // Listen for hash changes
            window.addEventListener('hashchange', () => this.handleRoute());
        }

        async handleRoute() {
            const path = window.location.hash.slice(1) || '/getting-started';
            const route = this.routes[path] || this.routes['/404'];
            
            try {
                const response = await fetch(`${this.basePath}/markdown/${route.file}`);
                if (!response.ok) throw new Error('Page not found');
                
                const markdown = await response.text();
                this.renderContent(markdown);
                this.updateActiveLink(path);
            } catch (error) {
                console.error('Error loading page:', error);
                this.renderContent('# Error\nPage not found');
            }
        }

        renderContent(markdown) {
            this.contentDiv.innerHTML = marked.parse(markdown);
            // Apply syntax highlighting to code blocks
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
        }

        updateActiveLink(path) {
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${path}`) {
                    link.classList.add('active');
                }
            });
        }
    }

    // Define routes
    const routes = {
        '/getting-started': { file: 'getting-started.md' },
        '/installation': { file: 'installation.md' },
        '/routing': { file: 'routing.md' },
        '/controllers': { file: 'controllers.md' },
        '/views': { file: 'views.md' },
        '/database': { file: 'database.md' },
        '/security': { file: 'security.md' },
        '/api': { file: 'api.md' },
        '/404': { file: '404.md' }
    };

    // Initialize router
    const router = new Router(routes);

    // Mobile menu toggle
    const createMobileMenu = () => {
        const sidebar = document.querySelector('.sidebar');
        const menuButton = document.createElement('button');
        menuButton.className = 'mobile-menu-button';
        menuButton.innerHTML = '☰';
        document.body.insertBefore(menuButton, document.body.firstChild);

        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    };

    // Initialize mobile menu
    createMobileMenu();
}); 