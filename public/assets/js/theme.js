/**
 * Theme Management System for Expenses Tracker
 * Handles Dark/Light mode switching with localStorage persistence
 */

(function () {
  "use strict";

  // Load saved theme immediately to prevent flash
  const savedTheme = localStorage.getItem("theme") || "light";
  if (savedTheme === "dark") {
    document.documentElement.classList.add("dark-mode");
    if (document.body) {
      document.body.classList.add("dark-mode");
    }
  }

  // Export theme functions to global scope
  window.themeManager = {
    /**
     * Get current theme
     */
    getTheme: function () {
      return localStorage.getItem("theme") || "light";
    },

    /**
     * Set theme
     * @param {string} theme - 'light' or 'dark'
     */
    setTheme: function (theme) {
      if (theme === "dark") {
        document.body.classList.add("dark-mode");
        localStorage.setItem("theme", "dark");
      } else {
        document.body.classList.remove("dark-mode");
        localStorage.setItem("theme", "light");
      }

      // Dispatch custom event for theme change
      window.dispatchEvent(
        new CustomEvent("themeChanged", { detail: { theme } })
      );
    },

    /**
     * Toggle between light and dark mode
     */
    toggleTheme: function () {
      const currentTheme = this.getTheme();
      const newTheme = currentTheme === "light" ? "dark" : "light";
      this.setTheme(newTheme);
      return newTheme;
    },

    /**
     * Initialize theme on page load
     */
    init: function () {
      const theme = this.getTheme();
      if (theme === "dark") {
        document.body.classList.add("dark-mode");
      }
    },
  };

  // Initialize when DOM is ready
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", function () {
      window.themeManager.init();
    });
  } else {
    window.themeManager.init();
  }
})();
