import './bootstrap';

// Theme toggle helper. Persists theme in localStorage and toggles `dark` class on <html>
const themeKey = 'site-theme';
function applyTheme(theme) {
	const html = document.documentElement;
	if (theme === 'dark') html.classList.add('dark');
	else html.classList.remove('dark');
}

function initTheme() {
	try {
		const saved = localStorage.getItem(themeKey);
		if (saved) { applyTheme(saved); return; }
		// If no saved preference, use OS-level preference
		const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
		applyTheme(prefersDark ? 'dark' : 'light');
	} catch (e) {
		// ignore localStorage errors
	}
}

function toggleTheme() {
	const html = document.documentElement;
	const isDark = html.classList.contains('dark');
	const next = isDark ? 'light' : 'dark';
	applyTheme(next);
	try { localStorage.setItem(themeKey, next); } catch (e) { /* ignore */ }
	// notify others to update the UI
	try { window.dispatchEvent(new Event('themechange')); } catch (e) { /* ignore */ }
}

// Expose for use from DOM toggles
window.toggleTheme = toggleTheme;
initTheme();

// Update the icon state on init and after toggles
function updateThemeIcon() {
    const html = document.documentElement;
    const icon = document.getElementById('theme-icon');
    if (!icon) return;
    const path = document.getElementById('theme-path');
    if (html.classList.contains('dark')) {
        // show moon (filled path)
        icon.setAttribute('class', 'w-5 h-5 text-yellow-300');
    } else {
        icon.setAttribute('class', 'w-5 h-5 text-indigo-500');
    }
}

window.addEventListener('DOMContentLoaded', updateThemeIcon);
window.addEventListener('themechange', updateThemeIcon);
// expose setter to update icon immediately
window.updateThemeIcon = updateThemeIcon;
updateThemeIcon();
