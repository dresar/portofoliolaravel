// Admin Panel SPA Navigation
document.addEventListener('DOMContentLoaded', function() {
    const mainContent = document.getElementById('main-content');
    const navLinks = document.querySelectorAll('.nav-link');
    let currentUrl = window.location.href;

    // Handle navigation without reload
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip if external link or has target="_blank"
            if (this.target === '_blank' || href.startsWith('http') && !href.includes(window.location.host)) {
                return;
            }

            e.preventDefault();
            navigateTo(href);
        });
    });

    // Navigation function
    function navigateTo(url) {
        if (url === currentUrl) return;

        // Show loading
        window.dispatchEvent(new CustomEvent('admin-loading', { detail: { loading: true } }));

        // Update URL without reload
        window.history.pushState({}, '', url);

        // Fetch new content
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(html => {
            // Parse HTML
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.getElementById('main-content');

            if (newContent) {
                // Update content with fade animation
                mainContent.style.opacity = '0';
                setTimeout(() => {
                    mainContent.innerHTML = newContent.innerHTML;
                    mainContent.style.opacity = '1';
                    currentUrl = url;
                    
                    // Re-initialize Alpine.js for new content
                    if (window.Alpine) {
                        window.Alpine.initTree(mainContent);
                    }

                    // Update active nav link
                    updateActiveNav();
                    
                    // Hide loading
                    window.dispatchEvent(new CustomEvent('admin-loading', { detail: { loading: false } }));
                }, 150);
            }
        })
        .catch(error => {
            console.error('Navigation error:', error);
            window.location.href = url; // Fallback to full reload
        });
    }

    // Handle browser back/forward
    window.addEventListener('popstate', function(e) {
        navigateTo(window.location.href);
    });

    // Update active nav link
    function updateActiveNav() {
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (window.location.pathname === new URL(href, window.location.origin).pathname) {
                link.classList.add('bg-indigo-50', 'text-indigo-600');
                link.classList.remove('text-gray-700');
            } else {
                link.classList.remove('bg-indigo-50', 'text-indigo-600');
                link.classList.add('text-gray-700');
            }
        });
    }

    // Initial active nav
    updateActiveNav();

    // Handle loading state
    window.addEventListener('admin-loading', function(e) {
        const loading = e.detail.loading;
        const event = new CustomEvent('alpine:update');
        window.dispatchEvent(event);
        
        // Update Alpine.js loading state if available
        if (window.Alpine && document.querySelector('[x-data*="loading"]')) {
            // Trigger Alpine update
            setTimeout(() => {
                const event = new CustomEvent('alpine:update');
                window.dispatchEvent(event);
            }, 10);
        }
    });

    // Form submission handler (AJAX)
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.classList.contains('ajax-form') || form.closest('.ajax-form')) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const url = form.action || window.location.href;
            const method = form.method || 'POST';

            // Show loading
            window.dispatchEvent(new CustomEvent('admin-loading', { detail: { loading: true } }));

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.redirect) {
                        navigateTo(data.redirect);
                    } else {
                        // Show success message
                        showNotification(data.message || 'Berhasil!', 'success');
                        // Reload current page content
                        navigateTo(window.location.href);
                    }
                } else {
                    showNotification(data.message || 'Terjadi kesalahan.', 'error');
                }
            })
            .catch(error => {
                console.error('Form submission error:', error);
                showNotification('Terjadi kesalahan saat mengirim data.', 'error');
            })
            .finally(() => {
                window.dispatchEvent(new CustomEvent('admin-loading', { detail: { loading: false } }));
            });
        }
    });

    // Delete handler
    document.addEventListener('click', function(e) {
        if (e.target.closest('[data-delete]')) {
            e.preventDefault();
            const button = e.target.closest('[data-delete]');
            const url = button.getAttribute('data-delete');
            
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                window.dispatchEvent(new CustomEvent('admin-loading', { detail: { loading: true } }));

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message || 'Item berhasil dihapus.', 'success');
                        navigateTo(window.location.href);
                    } else {
                        showNotification(data.message || 'Gagal menghapus item.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Delete error:', error);
                    showNotification('Terjadi kesalahan saat menghapus.', 'error');
                })
                .finally(() => {
                    window.dispatchEvent(new CustomEvent('admin-loading', { detail: { loading: false } }));
                });
            }
        }
    });

    // Notification function
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
});

