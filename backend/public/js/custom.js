/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict"

// Hide search element
const pathName = window.location.pathname;
(pathName === '/dashboard' ||
  pathName === '/hrd_karyawan/create' ||
  pathName === '/pengaturan'
) && $('.search-element').hide()

// Retrieve the current search parameter from the URL
const urlParams = new URLSearchParams(window.location.search)
const searchQuery = urlParams.get('search') // Get the 'search' parameter

// If there's a search query, populate the input field
if (searchQuery) {
  $('#header-search-input').val(searchQuery) // Use jQuery to set the input value
}

// Handle form submission
$('#header-search-form').on('submit', (event) => {
  event.preventDefault() // Prevent the default form submission
  const baseURL = `${window.location.origin}${window.location.pathname}` // Get the base URL
  const searchQuery = $('#header-search-input').val() // Use jQuery to get the input value
  const newURL = searchQuery ? `${baseURL}?search=${encodeURIComponent(searchQuery)}` : baseURL // Build the new URL
  window.location.href = newURL // Redirect to the new URL
})